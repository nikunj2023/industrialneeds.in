<?php

if (!defined('ABSPATH')) exit;


if (!class_exists('ReduxFramework_extension_sidebar_slides')) {

    class ReduxFramework_extension_sidebar_slides extends ReduxFramework{
        public static $version = '1.0.0';

        function __construct( $field = array(), $value ='' ) {//, $parent
        
            //parent::__construct( $parent->sections, $parent->args );
           // $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
			
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ), 30 );      
        
        }

   
        public function render() {

            //print_r($this->value);

            echo '<div class="redux-sidebar-slides-accordion">';

            $x = 0;

            $multi = (isset($this->field['multi']) && $this->field['multi']) ? ' multiple="multiple"' : "";

            if (isset($this->value) && is_array($this->value)) {

                $slides = $this->value;

                foreach ($slides as $slide) {
                    
                    if ( empty( $slide ) ) {
                        continue;
                    }

                    $defaults = array(
                        'title' => '',
                        'description' => '',
						'rvalues' => '',
                        'sort' => '',
                        'url' => 'field'.md5(uniqid(rand(), true)),
						'standart' => '',
                        'select' => array(),
                    );
                    $slide = wp_parse_args( $slide, $defaults );
					if($slide['url'] == ''){$slide['url'] = 'field_'.md5(uniqid(rand(), true));}
                    echo '<div class="redux-sidebar-slides-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-sidebar-slides-header">' . $slide['title'] . '</span></h3><div>';
                    echo '<ul id="' . $this->field['id'] . '-ul" class="redux-sidebar-slides-list">';
                    $placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : esc_html__( 'Title', 'pointfindercoreelements' );
					
					

                    echo '<li><label for="' . $this->field['id'] . '-title_' . $x . '">' . esc_html__('Title :', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="' . esc_attr($slide['title']) . '" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
					$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : esc_html__( 'ID', 'pointfindercoreelements' );
                    echo '<li><label for="' . $this->field['id'] . '-url_' . $x . '">' . esc_html__('ID : (Do not change or remove after beginning to use widget!)', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="' . $slide['url'] . '" class="full-text slide-url" /></li>';
					echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $slide['sort'] . '" /></li>';
                    echo '<li><a href="javascript:void(0);" class="button deletion redux-sidebar-slides-remove">' . esc_html__('Delete Field', 'pointfindercoreelements') . '</a></li>';
                    echo '</ul></div></fieldset></div>';

                    $x++;
                
                }
            }

            if ($x == 0) {
                echo '<div class="redux-sidebar-slides-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-sidebar-slides-header">New Item</span></h3><div>';
                echo '<ul id="' . $this->field['id'] . '-ul" class="redux-sidebar-slides-list">';
				
          
				$placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : esc_html__( 'Title', 'pointfindercoreelements' );
                echo '<li><label for="' . $this->field['id'] . '-title_' . $x . '">' . esc_html__('Title :', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
              
				$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : esc_html__( 'ID', 'pointfindercoreelements' );
                echo '<li><label for="' . $this->field['id'] . '-url_' . $x . '">' . esc_html__('ID : (Leave empty for assigning auto unique key)', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="" class="full-text"  /></li>';
			    echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $x . '" /></li>';
                echo '<li><a href="javascript:void(0);" class="button deletion redux-sidebar-slides-remove">' . esc_html__('Delete Field', 'pointfindercoreelements') . '</a></li>';
                echo '</ul></div></fieldset></div>';

            }
            echo '</div><a href="javascript:void(0);" class="button redux-sidebar-slides-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->field['name'] . '[title][]">' . esc_html__('Add New Field', 'pointfindercoreelements') . '</a><br/>';
			
			
			
        }         

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */

        public function enqueue() {

            global $pagenow;
            $pagename = (isset($_GET['page']))?$_GET['page']:'';
            if ($pagenow == 'admin.php' && $pagename == '_pfsidebaroptions') {
                wp_enqueue_script(
                    'redux-field-sidebarslides-js',
                    PFCOREELEMENTSURLEXT . 'sidebar_slides/field_custom_slides.js',
                    array('jquery', 'jquery-ui-core', 'jquery-ui-accordion','jquery-ui-sortable'),
                    time(),
                    true
                );
                
                wp_enqueue_style(
                    'redux-field-sidebarslides-css',
                    PFCOREELEMENTSURLEXT . 'sidebar_slides/field_custom_slides.css',
                    time(),
                    true
                );
            }
           


        }

    }
}
