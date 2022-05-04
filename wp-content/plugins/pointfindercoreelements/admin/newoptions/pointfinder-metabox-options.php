<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pointfinderthemefmb_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => 'Point Finder FMB Options Panel',
	'display_version'           => '',
	'menu_type'                 => 'hidden',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> 'PF FMB Options',
    'page_title'           		=> 'PF FMB Options',
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
	'page_slug'                 => '_optsdsdsions',
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

$sections[] = array(
	'id' => 'sadasdefergdvd12312fsdfsd',
	'title' => 'yyy',
	'fields' => array()
);

Redux::setSections($opt_name,$sections);