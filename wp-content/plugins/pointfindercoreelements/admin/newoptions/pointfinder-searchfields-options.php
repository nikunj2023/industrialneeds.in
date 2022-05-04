<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfsearchfields_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Search Fields','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Search Fields Config','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Point Finder Search Fields', 'pointfindercoreelements'),
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
	'page_slug'                 => '_pfsifoptions',
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

$PointFinderNewOptionsHelper = new PointFinderNewOptionsHelper();
$setup1_slides = $PointFinderNewOptionsHelper->get_search_fields_unfiltered();
$pfstart = $PointFinderNewOptionsHelper->get_search_fields();

if(!$pfstart){

	$sections[] = array(
	'id' => 'setup1',
	'title' => 'Information',
	'icon' => 'el-icon-info-sign',
	'fields' => array (
		array(
			'id' => 'setup1_help',
			'id' => 'notice_critical',
			'type' => 'info',
			'notice' => true,
			'style' => 'critical',
			'desc' => esc_html__('Please first create search fields from <strong>PF Options > System Setup > Search Fields</strong> then you can see field detail setting on this control panel. If you install theme first time, please check installation steps from help documentations.', 'pointfindercoreelements')
			),

		)
	);

}else{
	$sections[] = array(
	'id' => 'setup1',
	'title' => 'Search Fields',
	'icon' => 'el-icon-search-alt',
	'fields' => array (
		array(
			'id' => 'setup1_help',
			'id' => 'notice_critical',
			'type' => 'info',
			'notice' => true,
			'style' => 'info',
            'desc'  => sprintf(esc_html__('Please check help documentation for information about this panel. Section name %s','pointfindercoreelements'),'<strong>'.esc_html__('PF Search Fields','pointfindercoreelements').'</strong>')
			),

		)
	);



	foreach ($setup1_slides as &$value) {
		if (!empty($value['url'])) {
			$sections[] = $PointFinderNewOptionsHelper->SDF($value['title'],$value['url'],$value['select']);
		}

	}

}

Redux::setSections($opt_name,$sections);