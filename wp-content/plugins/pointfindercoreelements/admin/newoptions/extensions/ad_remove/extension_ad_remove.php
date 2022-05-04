<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ReduxFramework_extension_ad_remover', false ) ) {


	class ReduxFramework_extension_ad_remove {

		public static $version = '1.0.0';

		protected $parent;
		public $extension_url;
		public $extension_dir;
		public static $theInstance;
		public static $ext_url;
		public $field_id = '';
		private $class_css = '';

		public function __construct( $parent ) {

			$redux_ver = ReduxFramework::$_version;


			$this->parent = $parent;

			if ( version_compare( $redux_ver, '3.5.8.15' ) < 0 ) {
				$this->parent->admin_notices[] = array(
					'type' => 'error',
					'msg' => 'The Redux Ad Removal extension required Redux Framework version 3.5.8.15 or higher and will disabled until a Redux update is applied.<br/><br/>You are running Redux Framework version ' . $redux_ver,
					'id' => 'r_ad1492',
					'dismiss' => false,
				);

				return;
			}


			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
				self::$ext_url       = $this->extension_url;
			}


			$this->field_name = 'ad_remove';


			self::$theInstance = $this;


			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
				&$this,
				'overload_field_path'
			) );

			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/aDBW_filter', array( $this, 'dashboard' ) );
			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/aNF_filter', array( $this, 'newsflash' ) );
			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/aNFM_filter', array( $this, 'newsflash' ) );
			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/aURL_filter', array( $this, 'ads' ) );
		}

		public function ads() {
			return '';
		}

		public function dashboard() {
			return 'dat';
		}

		public function newsflash() {
			return 'bub';
		}

		static public function getInstance() {
			return self::$theInstance;
		}

		static public function getExtURL() {
			return self::$ext_url;
		}


		public function overload_field_path( $field ) {
			return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}
	}
}