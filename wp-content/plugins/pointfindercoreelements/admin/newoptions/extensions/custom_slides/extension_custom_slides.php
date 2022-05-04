<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('ReduxFramework_extension_custom_slides')) {

    class ReduxFramework_extension_custom_slides extends ReduxFramework{

        public static $version = '1.0.0';
       
        function __construct( $field = array(), $value ='' ) {//, $parent

            $this->field = $field;
            $this->value = $value;
			
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ), 30 );      
        
        }

        public function render() {

            echo '<div class="redux-custom-slides-accordion">';

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

                    $field_type_output = (isset($this->field['options'][$slide['select']]))?$this->field['options'][$slide['select']]:'';
                    $field_slug_output = (isset($slide['url']))?$slide['url']:'';

					if($slide['url'] == ''){$slide['url'] = 'field_'.md5(uniqid(rand(), true));}
                    echo '<div class="redux-custom-slides-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-custom-slides-header">' . $slide['title'] .'</span><span class="pfinfo"><small>'. $field_type_output . ' - '.$field_slug_output.'</small></span></h3><div>';
                    echo '<ul id="' . $this->field['id'] . '-ul" class="redux-custom-slides-list">';
                    $placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : esc_html__( 'Title', 'pointfindercoreelements' );
					
					
					if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
                        $placeholder = (isset($this->field['placeholder']['options'])) ? esc_attr($this->field['placeholder']['options']) : esc_html__( 'Select an Option', 'pointfindercoreelements' );

                      

                        echo '<li><label for="' . $this->field['id'] . '-select_' . $x . '">' . esc_html__('Field Type :', 'pointfindercoreelements') . '</label><select '.$multi.' id="'.$this->field['id'].'-select_' . $x . '"  name="' . $this->field['name'] . '[' . $x . '][select]" class="redux-pfselectbox" data-placeholder="'.$placeholder.'" rows="6">';
                            echo '<option>'.$placeholder.'</option>';
							
                            foreach($this->field['options'] as $k => $v){
                                if (is_array($this->value)) {
                                    $selected = ($k == $slide['select'])?' selected="selected"':'';  
                                } else {
                                    $selected = selected($this->value, $k, false);
                                }
                                echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
								
                            }
                        echo '</select></li>';                      
                    }

                    echo '<li><label for="' . $this->field['id'] . '-title_' . $x . '">' . esc_html__('Title :', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="' . esc_attr($slide['title']) . '" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
					$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : esc_html__( 'Slug', 'pointfindercoreelements' );
                    echo '<li><label for="' . $this->field['id'] . '-url_' . $x . '">' . esc_html__('Slug :', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="' . $slide['url'] . '" class="full-text slide-url" /><small><span style="margin-top:10px;display: block;">' . esc_html__('- The "Slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers and _ (underscore). (No Spaces) This key is unique. If you change the key name, data which is related to the key will be lost.', 'pointfindercoreelements') . '</span></small></li>';
					echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $slide['sort'] . '" /></li>';
                    echo '<li><a href="javascript:void(0);" class="button deletion redux-custom-slides-remove">' . esc_html__('Delete Field', 'pointfindercoreelements') . '</a></li>';
                    echo '</ul></div></fieldset></div>';

                    $x++;
                
                }
            }

            if ($x == 0) {
                echo '<div class="redux-custom-slides-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-custom-slides-header">New Item</span></h3><div>';
                echo '<ul id="' . $this->field['id'] . '-ul" class="redux-custom-slides-list">';
				
                if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
                        $placeholder = (isset($this->field['placeholder']['select'])) ? esc_attr($this->field['placeholder']['select']) : esc_html__( 'Select an Option', 'pointfindercoreelements' );
                    

                        echo '<li><label for="' . $this->field['id'] . '-select_' . $x . '">' . esc_html__('Field Type :', 'pointfindercoreelements') . '</label><select '.$multi.' id="'.$this->field['id'].'-select_' . $x . '" data-placeholder="'.$placeholder.'" name="' . $this->field['name'] . '[' . $x . '][select]" class=" '.$this->field['class'].' redux-pfselectbox" rows="6" style="width:93%;">';
                            echo '<option>'.$placeholder.'</option>';
                            foreach($this->field['options'] as $k => $v){
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                        echo '</select></li>';                           
                }
					
				
				$placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : esc_html__( 'Title', 'pointfindercoreelements' );
                echo '<li><label for="' . $this->field['id'] . '-title_' . $x . '">' . esc_html__('Title :', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
              
				$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : esc_html__( 'Slug', 'pointfindercoreelements' );
                echo '<li><label for="' . $this->field['id'] . '-url_' . $x . '">' . esc_html__('Slug : (Leave empty for assigning auto unique key)', 'pointfindercoreelements') . '</label><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="" class="full-text"  /></li>';
			    echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $x . '" /></li>';
                echo '<li><a href="javascript:void(0);" class="button deletion redux-custom-slides-remove">' . esc_html__('Delete Field', 'pointfindercoreelements') . '</a></li>';
                echo '</ul></div></fieldset></div>';

            }
            echo '</div><a href="javascript:void(0);" class="button redux-custom-slides-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->field['name'] . '[title][]">' . esc_html__('Add New Field', 'pointfindercoreelements') . '</a><br/>';
			
			
			
        }         

        public function enqueue() {

            global $pagenow;
            $pagename = (isset($_GET['page']))?$_GET['page']:'';
            if ($pagenow == 'admin.php' && $pagename == '_pointfinderoptions') {
                
                wp_enqueue_script(
                    'redux-field-custom_slides-js',
                    PFCOREELEMENTSURLEXT. 'custom_slides/field_custom_slides.js',
                    array('jquery', 'jquery-ui-core', 'jquery-ui-accordion'),
                    time(),
                    true
                );
                
                wp_enqueue_style(
                    'redux-field-custom_slides-css',
                    PFCOREELEMENTSURLEXT. 'custom_slides/field_custom_slides.css',
                    time(),
                    true
                );
            }
           


        }

    }
}
