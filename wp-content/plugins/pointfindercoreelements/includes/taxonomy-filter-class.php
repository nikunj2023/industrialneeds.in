<?php
if (!class_exists('Tax_CTP_Filter')){
    class Tax_CTP_Filter
    {
 
        function __construct($cpt = array()){
            $this->cpt = $cpt;
            add_action( 'restrict_manage_posts', array($this,'my_restrict_manage_posts' ));
        }
  
        public function my_restrict_manage_posts() {
            global $typenow;
            $types = array_keys($this->cpt);
            if (in_array($typenow, $types)) {
                $filters = $this->cpt[$typenow];
                echo '<div class="pointfinder-cptfilters pfclearfix">';
                $this->months_dropdown($typenow);
                echo '<input type="text" name="itemnumber" value="" placeholder="'.esc_html__('Listing ID','pointfindercoreelements').'" />';
                echo '<a class="pointfinder-sh-adv"><i class="fas fa-filter"></i> '.esc_html__( "Advanced Filters", "pointfindercoreelements" ).'</a>';
                echo '<div class="pointfinder-cptfilters-adv">';
                foreach ($filters as $tax_slug) {
                    $tax_obj = get_taxonomy($tax_slug);
                    $tax_name = $tax_obj->labels->name;
                   
                    echo "<label for='pfsp_".strtolower($tax_slug)."[]'>".$tax_name."</label>";
                    echo "<select multiple='multiple' name='pfsp_".strtolower($tax_slug)."[]' id='".strtolower($tax_slug)."' class='postform'>";
                    $this->generate_taxonomy_options($tax_slug,0,0,(isset($_GET['pfsp_'.strtolower($tax_slug)])? $_GET['pfsp_'.strtolower($tax_slug)] : null));
                    echo "</select>";
                }
                echo '</div>';
                echo '</div>';
            }
        }
         
        public function generate_taxonomy_options($tax_slug, $parent = '', $level = 0,$selected = null) {
            
            if (!is_null($selected)) {

                if (is_array($selected)) {
                    $new_selected = array();
                    foreach ($selected as $selected_single) {
                        $new_selected[] = (int)$selected_single;
                    }

                    $selected = $new_selected;
                }

                $args = array('hide_empty' => 0, 'include' => $selected );
                
  
                $terms = get_terms($tax_slug,$args);
           
                foreach ($terms as $term) {
                    
                    echo '<option value='. $term->term_id, in_array($term->term_id,$selected)? ' selected="selected"' : '','>' . $term->name.'</option>';
                    
                }
            }
  
        }

        private function months_dropdown( $post_type ) {
            global $wpdb, $wp_locale;


            $extra_checks = "AND post_status != 'auto-draft'";
            if ( ! isset( $_GET['post_status'] ) || 'trash' !== $_GET['post_status'] ) {
                $extra_checks .= " AND post_status != 'trash'";
            } elseif ( isset( $_GET['post_status'] ) ) {
                $extra_checks = $wpdb->prepare( ' AND post_status = %s', $_GET['post_status'] );
            }

            $months = $wpdb->get_results(
                $wpdb->prepare(
                    "
                SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month
                FROM $wpdb->posts
                WHERE post_type = %s
                $extra_checks
                ORDER BY post_date DESC
            ",
                    $post_type
                )
            );

            $months = apply_filters( 'months_dropdown_results', $months, $post_type );

            $month_count = count( $months );

            if ( ! $month_count || ( 1 == $month_count && 0 == $months[0]->month ) ) {
                return;
            }

            $m = isset( $_GET['m'] ) ? (int) $_GET['m'] : 0;
            ?>
            <label for="filter-by-date" class="screen-reader-text"><?php _e( 'Filter by date', 'pointfindercoreelements' ); ?></label>
            <select name="m" id="filter-by-date">
                <option<?php selected( $m, 0 ); ?> value="0"><?php _e( 'All dates', 'pointfindercoreelements' ); ?></option>
            <?php
            foreach ( $months as $arc_row ) {
                if ( 0 == $arc_row->year ) {
                    continue;
                }

                $month = zeroise( $arc_row->month, 2 );
                $year  = $arc_row->year;

                printf(
                    "<option %s value='%s'>%s</option>\n",
                    selected( $m, $year . $month, false ),
                    esc_attr( $arc_row->year . $month ),
                    sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $month ), $year )
                );
            }
            ?>
            </select>
            <?php
        }
    }
}