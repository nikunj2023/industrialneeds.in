<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class PointFinder_Elementor_Modules {

	const VERSION = '1.2.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.1.0';
	const MINIMUM_PHP_VERSION = '7.3';
	const MXSELECT2 = 'mxselect2';

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {

		if (!defined('ELEMENTOR_VERSION')) {
			return;
		} 

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		require_once( PFCOREELEMENTSDIR . 'includes/elementor/fields/restapi-select.php' );

		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ],10,1 );

		require_once( 'plugin.php' );
	}



	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pointfindercoreelements' ),
			'<strong>' . esc_html__( 'PointFinder Core Elements', 'pointfindercoreelements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pointfindercoreelements' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pointfindercoreelements' ),
			'<strong>' . esc_html__( 'PointFinder Core Elements', 'pointfindercoreelements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pointfindercoreelements' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}


	public function register_controls($controls_manager) {
		$controls_manager->register_control( self::MXSELECT2, new \Elementor\PF_Control_Select2());
	}
}

new PointFinder_Elementor_Modules();