<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_accordion' ) ) {

        class ReduxFramework_accordion {

            public function __construct( $field = array(), $value = '', $parent = '' ) {

                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;

                if ( empty( $this->extension_dir ) ) {
                    $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                    $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
                }
            }

            public function render() {
                $defaults    = array(
                    'position'  => '',
                    'style'     => '',
                    'class'     => '',
                    'title'     => '',
                    'subtitle'  => '',
                    'open'      => '',
                    'open-icon' => 'el-plus',
                    'close-icon' => 'el-minus'
                );
                $this->field = wp_parse_args( $this->field, $defaults );

                $guid = uniqid();

                $field_id = $this->field['id'];
                $dev_mode = $this->parent->args['dev_mode'];
                $opt_name = $this->parent->args['opt_name'];
                $dev_tag  = '';

                if ( true == $dev_mode ) {
                    $dev_tag = ' data-dev-mode="' . $this->parent->args['dev_mode'] . '"
                            data-version="' . ReduxFramework_extension_accordion::$version . '"';
                }

                $add_class = '';
                if ( isset( $this->field['position'] ) && 'start' === $this->field['position'] ) {
                    $add_class = ' form-table-accordion';
                    $field_pos = 'start';
                } elseif ( ! isset( $this->field['position'] ) || ( isset( $this->field['position'] ) && 'end' === $this->field['position'] ) ) {
                    $add_class = " hide";
                    $field_pos = 'end';
                }

                echo '<input type="hidden" id="accordion-' . $this->field['id'] . '-marker" data-open-icon="' . $this->field['open-icon'] . '" data-close-icon="' . $this->field['close-icon'] . '"></td></tr></table>';

                $is_open = false;
                if (isset($this->field['open']) && $this->field['open'] == true) {
                    $is_open = true;
                }
                
                echo '<div ' . $dev_tag . ' data-state="' . $is_open . '" data-position="' . $field_pos . '" id="' . $this->field['id'] . '" class="redux-accordion-field redux-field ' . $this->field['style'] . $this->field['class'] . '">';
                echo '<div class="control">';
                echo '<div class="redux-accordion-info' . $add_class . '">';
                
                if ( ! empty( $this->field['title'] ) ) {
                    echo '<h3>' . $this->field['title'] . '</h3>';
                }

                $icon_class = '';
                if ( ! empty( $this->field['subtitle'] ) ) {
                    echo '<div class="redux-accordion-desc">' . $this->field['subtitle'] . '</div>';
                    $icon_class = ' subtitled';
                }

                echo '<span class="el el-plus' . $icon_class . '"></span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<table id="accordion-table-' . $this->field['id'] . '" data-id="' . $this->field['id'] . '" class="form-table form-table-accordion no-border' . $add_class . '"><tbody><tr class="hide"><th></th><td id="' . $guid . '">';

            }

            public function enqueue() {
                $extension = ReduxFramework_extension_accordion::getInstance();

                $min = Redux_Functions::isMin();

                wp_enqueue_script(
                    'redux-field-accordion-js',
                    $this->extension_url . 'field_accordion' . $min . '.js',
                    array( 'jquery' ),
                    time(),
                    true
                );

                wp_enqueue_style(
                    'redux-field-accordion-css',
                    $this->extension_url . 'field_accordion.css',
                    time(),
                    true
                );
            }
        }
    }