<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_extension_accordion' ) ) {

        class ReduxFramework_extension_accordion {

            public static $version = '1.0.1';

            // Protected vars
            protected $parent;
            public $extension_url;
            public $extension_dir;
            public static $theInstance;
            public static $ext_url;
            public $field_id = '';
            private $class_css = '';

            /**
             * Class Constructor. Defines the args for the extions class
             *
             * @since       1.0.0
             * @access      public
             *
             * @param       array $parent Parent settings.
             *
             * @return      void
             */
            public function __construct( $parent ) {

                $redux_ver = ReduxFramework::$_version;

                $this->parent = $parent;

                if ( empty( $this->extension_dir ) ) {
                    $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                    $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
                    self::$ext_url       = $this->extension_url;
                }

                $this->field_name = 'accordion';

                self::$theInstance = $this;

                // Uncomment when customizer works - kp
                //include_once($this->extension_dir . 'multi-media/inc/class.customizer.php');
                //new ReduxColorSchemeCustomizer($parent, $this->extension_dir);

                add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
                    $this,
                    'overload_field_path'
                ) );
            }

            static public function getInstance() {
                return self::$theInstance;
            }

            static public function getExtURL() {
                return self::$ext_url;
            }

            // Forces the use of the embeded field path vs what the core typically would use
            public function overload_field_path( $field ) {
                
                return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
            }
        }
    }