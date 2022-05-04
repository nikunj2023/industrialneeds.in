<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfsidebargenerator_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Sidebar Generator','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Sidebar Generator','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Sidebar Generator', 'pointfindercoreelements'),
	'async_typography'          => false,
	'admin_bar'                 => false,
	'admin_bar_priority'        => 50,
	'dev_mode'                  => false,
	'disable_google_fonts_link' => false,
	'admin_bar_icon'            => 'dashicons-portfolio',
	'customizer'                => false,
	'open_expanded'             => false,
	'disable_save_warn'         => false,
	'page_priority'             => null,
	'page_permissions'          => 'manage_options',
	'menu_icon'                 => 'dashicons-admin-tools',
	'last_tab'                  => '',
	'page_icon'                 => 'icon-themes',
	'page_slug'                 => '_pfsidebaroptions',
	'save_defaults'             => true,
	'default_show'              => false,
	'default_mark'              => '*',
	'show_import_export'        => true,
	'transient_time'            => 60 * MINUTE_IN_SECONDS,
	'output'                    => true,
	'output_tag'                => true,
	'footer_credit'             => '',
	'use_cdn'                   => true,
	'admin_theme'               => 'wp',
	'database'                  => '',
	'network_admin'             => true,
);

Redux::setArgs( $opt_name, $args );


$sections = array();

/**
*Start : SIDEBAR GENERATOR STARTED
**/
    $sections[] = array(
        'id' => 'setup25_sidebargenerator',
        'title' => esc_html__('Sidebar Generator', 'pointfindercoreelements'),
        'icon' => 'el-icon-view-mode',
        'fields' => array(
            array(
                'id'=>'setup25_sidebargenerator_sidebars',
                'type' => 'extension_sidebar_slides',
                'title' => esc_html__('Sidebar Name', 'pointfindercoreelements'),
                'subtitle' => esc_html__('Please add sidebar name per line.', 'pointfindercoreelements'),
                'add_text' => esc_html__('Add More', 'pointfindercoreelements'),
                'show_empty' => false
            )
        )
    );
/**
*End : SIDEBAR GENERATOR STARTED
**/

Redux::setSections($opt_name,$sections);