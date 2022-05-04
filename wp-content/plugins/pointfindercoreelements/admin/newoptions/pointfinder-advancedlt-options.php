<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfadvancedcontrol_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Advanced Listing Type Settings','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Advanced Listing Type Config','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Advanced Listing Type Config','pointfindercoreelements'),
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
	'page_slug'                 => '_pfadvancedlimitconf',
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

global $pfsidebargenerator_options;
$setup25_sidebargenerator_sidebars = (isset($pfsidebargenerator_options['setup25_sidebargenerator_sidebars']))?$pfsidebargenerator_options['setup25_sidebargenerator_sidebars']:'';
$widget_arr = array();

if (!empty($setup25_sidebargenerator_sidebars) && isset($setup25_sidebargenerator_sidebars)) {
 
 foreach ($setup25_sidebargenerator_sidebars as $single_widget) {
     $widget_arr[$single_widget['url']] = $single_widget['title']; 
 }
}
 

/**
*Start : Advanced Controls
**/

    $taxonomies = array( 'pointfinderltypes');

    $args = array(
        'orderby'           => 'name', 
        'order'             => 'ASC',
        'hide_empty'        => false, 
        'exclude'           => array(), 
        'exclude_tree'      => array(), 
        'include'           => array(),
        'number'            => '', 
        'fields'            => 'all', 
        'slug'              => '',
        'parent'            => 0,
        'hierarchical'      => true, 
        'child_of'          => 0, 
        'get'               => '', 
        'name__like'        => '',
        'description__like' => '',
        'pad_counts'        => false, 
        'offset'            => '', 
        'search'            => '', 
        'cache_domain'      => 'core'
    ); 

    $terms = get_terms($taxonomies, $args);
    
    foreach ($terms as $term) {
        $sections[] = array(
            'id' => 'setupadvancedconfig_'.$term->term_id,
            'title' => $term->name,
            'icon' => 'el-icon-cogs',
            'fields' => array(
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_advanced_status',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Advanced Settings', 'pointfindercoreelements' ),
                    'desc'     => esc_html__('If this enabled, you can enable/disable modules on item page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Enable','pointfindercoreelements'),
                        '0' => esc_html__('Disable','pointfindercoreelements')
                    ),
                    'default'  => '0'
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_reviewmodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Reviews', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_commentsmodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Comments', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_featuresmodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Features', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_ohoursmodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Opening Hours', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_videomodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Video Module on Upload Page', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_claimsmodule',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Claim Listings', 'pointfindercoreelements' ),
                    'desc'     => esc_html__( 'Show/Hide this module on the item detail page.', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__('Show','pointfindercoreelements'),
                        '0' => esc_html__('Hide','pointfindercoreelements')
                    ),
                    'default'  => '1',
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id' => 'setupadvancedconfig_'.$term->term_id.'_configuration',
                    'type' => 'extension_itempage',
                    'title' => esc_html__('Item Detail Page Section Config', 'pointfindercoreelements') ,
                    'subtitle' => esc_html__('You can reorder positions of sections by using move icon. If want to disable any section please click and select disable.', 'pointfindercoreelements').'<br/><br/>'.esc_html__('Please check below options to edit Information Tab Content', 'pointfindercoreelements'),
                    'default' => array(),
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id'       => 'setupadvancedconfig_'.$term->term_id.'_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__('Item Detail Page Custom Sidebar', 'pointfindercoreelements'), 
                    'desc'     => esc_html__('Custom sidebar for only this listing type items.', 'pointfindercoreelements'),
                    'options'  => $widget_arr,
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                ),
                array(
                    'id' => 'setupadvancedconfig_'.$term->term_id.'_headersection',
                    'type' => 'button_set',
                    'title' => esc_html__('Item Detail Page Header', 'pointfindercoreelements') ,
                    'options' => array(
                        0 => esc_html__('Standard Header', 'pointfindercoreelements') ,
                        1 => esc_html__('Map Header', 'pointfindercoreelements'),
                        2 => esc_html__('No Header', 'pointfindercoreelements'),
                        3 => esc_html__('Image Header', 'pointfindercoreelements'),
                    ) ,
                    'desc'     => esc_html__('Page Header for only this listing type items.', 'pointfindercoreelements'),
                    'default' => 2,
                    'required' => array('setupadvancedconfig_'.$term->term_id.'_advanced_status','=',1)
                )
            )
        );
    }
    
/**
*End : Advanced Controls
**/

Redux::setSections($opt_name,$sections);