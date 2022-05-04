<?php

if ( !defined ( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists ( 'ReduxFramework_extension_itempage' ) ) {

    class ReduxFramework_extension_itempage {

        public static $version = '1.0.0';
        
        function __construct ( $field = array(), $value = '' ) {
            $this->field = $field;
            $this->value = $value;
        }


        public function render () {

            $defaults = array(
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true,
                ),
                'content_title' => esc_html__( 'Slide', 'pointfindercoreelements' )
            );

            $this->field = wp_parse_args ( $this->field, $defaults );
            $ip_options = array('1' => esc_html__('Enable', 'pointfindercoreelements') ,'0' => esc_html__('Disable', 'pointfindercoreelements'));
            $ip_options2 = array('1' => esc_html__('Left', 'pointfindercoreelements'),'2' => esc_html__('Right', 'pointfindercoreelements') ,'0' => esc_html__('Disable', 'pointfindercoreelements'));

            echo '<div class="redux-extension_itempage-accordion" data-new-content-title="' . esc_attr ( sprintf ( esc_html__( 'New %s', 'pointfindercoreelements' ), $this->field[ 'content_title' ] ) ) . '">';

           

            if ( isset ( $this->value ) && is_array ( $this->value ) && !empty ( $this->value ) ) {
                $slides = $this->value;
               
                
                
                if (!array_key_exists('customtab1', $this->value)) {
                 
                    $newslides = array( array(
                        'ftitle'=>'customtab1',
                        'title' => esc_html__('Custom Tab 1', 'pointfindercoreelements'),
                        'sort' => '9',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab2',
                        'title' => esc_html__('Custom Tab 2', 'pointfindercoreelements'),
                        'sort' => '10',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab3',
                        'title' => esc_html__('Custom Tab 3', 'pointfindercoreelements'),
                        'sort' => '11',
                        'status' => 0
                    ));
                    $slides = array_merge($slides,$newslides);

                }

                if (!array_key_exists('events', $this->value)) {
                    $newslides = array(array(
                        'ftitle'=>'events',
                        'title' => esc_html__('Event Details', 'pointfindercoreelements'),
                        'sort' => '12',
                        'status' => 0
                    ));
                    $slides = array_merge($slides,$newslides);
                }

                if (!array_key_exists('customtab4', $this->value)) {
                    $newslides2 = array( array(
                        'ftitle'=>'customtab4',
                        'title' => esc_html__('Custom Tab 4', 'pointfindercoreelements'),
                        'sort' => '13',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab5',
                        'title' => esc_html__('Custom Tab 5', 'pointfindercoreelements'),
                        'sort' => '14',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab6',
                        'title' => esc_html__('Custom Tab 6', 'pointfindercoreelements'),
                        'sort' => '15',
                        'status' => 0
                    ));
                    $slides = array_merge($slides,$newslides2);
                }

            }else{
                $slides = array(
                    array(
                        'ftitle'=>'gallery',
                        'title' => esc_html__('Gallery', 'pointfindercoreelements'),
                        'sort' => '1',
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'informationbox',
                        'title' => esc_html__('Information', 'pointfindercoreelements'),
                        'sort' => '2',
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'description1',
                        'title' => esc_html__('Description', 'pointfindercoreelements'),
                        'sort' => '3',
                        'fimage' => 1,
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'description2',
                        'title' => esc_html__('Details', 'pointfindercoreelements'),
                        'sort' => '4',
                        'fimage' => 1,
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'location',
                        'title' => esc_html__('Map View', 'pointfindercoreelements'),
                        'sort' => '5',
                        'mheight' => 390,
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'streetview',
                        'title' => esc_html__('Street View', 'pointfindercoreelements'),
                        'sort' => '6',
                        'mheight' => 390,
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'video',
                        'title' => esc_html__('Video', 'pointfindercoreelements'),
                        'sort' => '7',
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'contact',
                        'title' => esc_html__('Contact', 'pointfindercoreelements'),
                        'sort' => '8',
                        'status' => 1
                    ),
                    array(
                        'ftitle'=>'customtab1',
                        'title' => esc_html__('Custom Tab 1', 'pointfindercoreelements'),
                        'sort' => '9',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'events',
                        'title' => esc_html__('Event Details', 'pointfindercoreelements'),
                        'sort' => '12',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab2',
                        'title' => esc_html__('Custom Tab 2', 'pointfindercoreelements'),
                        'sort' => '10',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab3',
                        'title' => esc_html__('Custom Tab 3', 'pointfindercoreelements'),
                        'sort' => '11',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab4',
                        'title' => esc_html__('Custom Tab 4', 'pointfindercoreelements'),
                        'sort' => '13',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab5',
                        'title' => esc_html__('Custom Tab 5', 'pointfindercoreelements'),
                        'sort' => '14',
                        'status' => 0
                    ),
                    array(
                        'ftitle'=>'customtab6',
                        'title' => esc_html__('Custom Tab 6', 'pointfindercoreelements'),
                        'sort' => '15',
                        'status' => 0
                    )

                );
            }
            

            foreach ( $slides as $slide ) {

                if ( empty ( $slide ) ) {
                    continue;
                }

                $defaults = array(
                    'ftitle'=> '',
                    'title' => '',
                    'sort' => '',
                    'mheight' => 390,
                    'fimage' => 0,
                    'status' => 0,
                    'mcontent'=>''
                );
                $slide = wp_parse_args ( $slide, $defaults );

               
                echo '<div class="redux-extension_itempage-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-extension_itempage-header">' . $slide[ 'title' ] . '</span></h3><div>';

               

                echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-extension_itempage-list">';

                /**
                *Start: Title of Field
                **/
                    $placeholder = esc_html__( 'Title', 'pointfindercoreelements' );
                    echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-title_' . $slide[ 'ftitle' ] . '" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][title]' . $this->field['name_suffix'] . '" value="' . esc_attr ( $slide[ 'title' ] ) . '" placeholder="' . $placeholder . '" class="full-text extension_itempage-title" /></li>';
                /**
                *End: Title of Field
                **/




                /**
                *Start: Status of Field
                **/
                    echo '<li class="pf-button-container">';
                    echo '<span class="pf-inner-title">'.esc_html__('Status','pointfindercoreelements').' : </span>';
                    echo '<div class="buttonset ui-buttonset">';
                    
                    
                    foreach ( $ip_options as $k => $v ) {

                        $selected = '';
                        
                        $multi_suffix = "";
                        $type         = "radio";
                        $selected     = checked( $slide['status'], $k, false );
                        

                        echo '<input data-id="' . $this->field[ 'id' ] . '-status_' . $slide[ 'ftitle' ] . '" type="' . $type . '" id="' . $this->field[ 'id' ] . '-status_' . $slide[ 'ftitle' ] . '-buttonset' . $k . '" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][status]" class="buttonset-item" value="' . $k . '" ' . $selected . '/>';
                        echo '<label for="' . $this->field[ 'id' ] . '-status_' . $slide[ 'ftitle' ] . '-buttonset' . $k . '">' . $v . '</label>';
                    }

                    echo '</div></li>';

                    
                /**
                *End: Status of Field
                **/



                
             
                

                if ($slide[ 'ftitle' ] == 'description1' || $slide[ 'ftitle' ] == 'description2') {
                    /**
                    *Start: Featured Image of Field
                    **/
                        echo '<li class="pf-button-container">';
                        echo '<span class="pf-inner-title">'.esc_html__('Featured Image','pointfindercoreelements').' : </span>';
                        echo '<div class="buttonset ui-buttonset">';
                        
                        
                        foreach ( $ip_options2 as $k => $v ) {

                            $selected = '';
                            
                            $multi_suffix = "";
                            $type         = "radio";
                            $selected     = checked( $slide['fimage'], $k, false );
                            

                            echo '<input data-id="' . $this->field[ 'id' ] . '-fimage_' . $slide[ 'ftitle' ] . '" type="' . $type . '" id="' . $this->field[ 'id' ] . '-fimage_' . $slide[ 'ftitle' ] . '-buttonset' . $k . '" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][fimage]" class="buttonset-item" value="' . $k . '" ' . $selected . '/>';
                            echo '<label for="' . $this->field[ 'id' ] . '-fimage_' . $slide[ 'ftitle' ] . '-buttonset' . $k . '">' . $v . '</label>';
                        }

                        echo '</div></li>';

                        
                    /**
                    *End: Featured Image of Field
                    **/
                }


                if ($slide[ 'ftitle' ] == 'location' || $slide[ 'ftitle' ] == 'streetview') {

                    /**
                    *Start: Height of Field
                    **/
                        echo '<li>';
                        echo '<span class="pf-inner-title">'.esc_html__('Map Height','pointfindercoreelements').' : </span>';
                        echo '
                        <input type="text" id="' . $this->field[ 'id' ] . '-mheight_' . $slide[ 'ftitle' ] . '" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][mheight]' . $this->field['name_suffix'] . '" value="' . $slide[ 'mheight' ] . '" class="full-text2 extension_itempage-mheight" />px</li>';
                    /**
                   * End: Height of Field
                    **/

                }

               
                echo '<li><input type="hidden" class="extension_itempage-sort" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][sort]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $slide[ 'ftitle' ] . '" value="' . $slide[ 'sort' ] . '" /></li>';
                echo '<li><input type="hidden" class="extension_itempage-ftitle" name="' . $this->field[ 'name' ] . '[' . $slide[ 'ftitle' ] . '][ftitle]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-ftitle_' . $slide[ 'ftitle' ] . '" value="' . $slide[ 'ftitle' ] . '" /></li>';
                echo '</ul></div></fieldset></div>';
       
            }
            

            
            echo '</div><br/>';

        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue () {
            global $pagenow, $post_type;
            $pagename = (isset($_GET['page']))?$_GET['page']:'';
            if (
                    (
                        $pagenow == 'admin.php' && 
                        (
                            $pagename == '_pointfinderoptions' || 
                            $pagename == '_pfadvancedlimitconf'
                        )
                    ) || 
                    (
                        (
                            $pagenow == 'post.php' || $pagenow == 'post-new.php'
                        ) &&
                        (   $post_type == 'pfaltsettings'
                        )
                    ) 
                ) {
                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script (
                    'redux-field-itempage-js', 
                    PFCOREELEMENTSURLEXT . 'itempage/field_itempage.js', 
                    array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion'), 
                    time(), 
                    true
                );

                wp_enqueue_style(
                    'redux-field-itempage-css',
                    PFCOREELEMENTSURLEXT . 'itempage/field_itempage.css',
                    time(),
                    false
                );      
            }

                     
            

        }
    }

}