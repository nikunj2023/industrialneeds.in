<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfcustompoints_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Custom Point Styles for Listing Types','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Custom Point Styles','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Custom Point Styles for Listing Types','pointfindercoreelements'),
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
	'page_slug'                 => '_pfpifoptions',
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

$PointFinderNewOptionsHelper = new PointFinderNewOptionsHelper();

$sections = array();


$args = array(
    'orderby'           => 'name',
    'order'             => 'ASC',
    'hide_empty'        => false,
    'parent'            => 0,
);

$pf_get_term_details = get_terms('pointfinderltypes',$args);

$pfstart = (!empty($pf_get_term_details))? true:false;

if(!$pfstart){

    $sections[] = array(
    'id' => 'setup1xx',
    'title' => 'Information',
    'icon' => 'el-icon-info-sign',
    'fields' => array (
        array(
            'id' => 'setup1_help',
            'id' => 'notice_critical',
            'type' => 'info',
            'notice' => true,
            'style' => 'critical',
            'desc' => esc_html__('You have to set listing categories for edit this options panel.', 'pointfindercoreelements')
            ),

        )
    );

}else{
    $sections[] = array(
    'id' => 'setup1xx',
    'title' => 'Custom Points',
    'icon' => 'el-icon-wrench-alt',
    'fields' => array (
        array(
            'id' => 'setup1_help',
            'id' => 'notice_critical',
            'type' => 'info',
            'notice' => true,
            'style' => 'info',
            'desc'  => sprintf(esc_html__('Please check help documentation for information about this panel. Section name %s','pointfindercoreelements'),'<strong>'.esc_html__('PF Custom Points','pointfindercoreelements').'</strong>')
            ),
        )
    );


    foreach ($pf_get_term_details as $pf_get_term_detail) {
        if ($pf_get_term_detail->parent == 0) {

            $sections[] = $PointFinderNewOptionsHelper->PFDF($pf_get_term_detail->name,$pf_get_term_detail->term_id,'parent');

            /* Get Sub Terms */
            $args2 = array(
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => false,
                'parent'            => $pf_get_term_detail->term_id,
            );

            $pf_get_term_details_sub = get_terms('pointfinderltypes',$args2);

            $pfstart2 = (!empty($pf_get_term_details_sub))? true:false;

            if ($pfstart2) {
                foreach ($pf_get_term_details_sub as $pf_get_term_detail_sub) {
                    $sections[] = $PointFinderNewOptionsHelper->PFDF($pf_get_term_detail_sub->name,$pf_get_term_detail_sub->term_id,'sub');
                }
            }
        }
    }

    $sections[] = $PointFinderNewOptionsHelper->PFDF(esc_html__('Uncategorized','pointfindercoreelements'),'pfdefaultcat','parent');

}

Redux::setSections($opt_name,$sections);