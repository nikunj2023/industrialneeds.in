<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfsizecontrol_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Size Limits','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Size Limits Config','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Size Limits Config','pointfindercoreelements'),
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
	'page_slug'                 => '_pfsizelimitconf',
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
*Start : Image Sizes 
**/
    $sections[] = array(
        'id' => 'setupsizelimitconf_general',
        'title' => esc_html__('Image Size Settings', 'pointfindercoreelements'),
        'icon' => 'el-icon-resize-full',
        'fields' => array(
            array(
                'id'     => 'setupsizelimitconf_general_gridsize1_help1',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'critical',
                'title'  => esc_html__( 'IMPORTANT', 'pointfindercoreelements' ),
                'desc'   => esc_html__( 'Please make sure you are changing correctly. Because these settings will change all your image sizes.', 'pointfindercoreelements' )
            ),
            /*Start:(Ajax Grid / Static Grid / Item Carousel)*/
            array(
               'id' => 'setupsizelimitconf_general_gridsize1-start',
               'type' => 'section',
               'title' => esc_html__('Item Detail Page Gallery Image Sizes', 'pointfindercoreelements'),
               'subtitle' => esc_html__('This sizes will effect Item Page Image Gallery', 'pointfindercoreelements'),
               'indent' => true 
            ),
                array(
                    'id' => 'general_crop',
                    'type' => 'button_set',
                    'title' => esc_html__('Item Page Gallery Images', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Force Crop', 'pointfindercoreelements') ,
                        '2' => esc_html__('Use Default', 'pointfindercoreelements'),
                        '3' => esc_html__("Use Original", 'pointfindercoreelements')
                    ) , 
                    'default' => '1',
                    'desc'           => esc_html__('Please use Force Crop for same sized images. Use Default for leave free size. Use Original for resized and centered images (best for vertical images.)', 'pointfindercoreelements'),
                    'compiler' => true
                ) ,
                array(
                    'id'             => 'setupsizelimitconf_general_gallerysize1',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Item Page Gallery Photos Min. Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (848x566)',
                    'default'        => array(
                        'width'  => 848,
                        'height' => 566,
                    ),
                    'compiler' => true
                ),
                array(
                    'id'             => 'setupsizelimitconf_general_gallerysize2',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Item Page Gallery (THUMB) Photos Min. Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (112x100)',
                    'default'        => array(
                        'width'  => 112,
                        'height' => 100,
                    ),
                    'compiler' => true
                ),
            array(
               'id' => 'setupsizelimitconf_general_gridsize1-end',
               'type' => 'section',
               'indent' => false 
            ),
            /*End:(Ajax Grid / Static Grid / Item Carousel)*/   


            /*Start:(VC_Carousel, VC_Image_Carousel, VC_Client Carousel, VC_Gallery)*/
            array(
               'id' => 'setupsizelimitconf_general_gridsize2-start',
               'type' => 'section',
               'title' => esc_html__('Grid/Carousel Image Sizes', 'pointfindercoreelements'),
               'subtitle' => esc_html__('This sizes will effect Visual Composer Post Carousel, PF Image Carousel, PF Client Carousel, PF Grid Images', 'pointfindercoreelements'),
               'indent' => true 
            ),
                array(
                    'id' => 'general_crop2',
                    'type' => 'button_set',
                    'title' => esc_html__('Grid Photos Images', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Force Crop', 'pointfindercoreelements') ,
                        '2' => esc_html__('Use Default', 'pointfindercoreelements'),
                        '3' => esc_html__("Use Original", 'pointfindercoreelements')
                    ) , 
                    'default' => '1',
                    'desc'           => esc_html__('Please use Force Crop for same sized images. Use Default for leave free size. Use Original for resized and centered images (best for vertical images.)', 'pointfindercoreelements'),
                    'compiler' => true
                ) ,
                array(
                    'id'             => 'setupsizelimitconf_general_gridsize1',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Grid Photos Min. Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (440x330)',
                    'default'        => array(
                        'width'  => 440,
                        'height' => 330,
                    ),
                    'compiler' => true
                ),
                array(
                    'id'             => 'setupsizelimitconf_general_gridsize2',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('2 Cols. Min Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (555x416)',
                    'default'        => array(
                        'width'  => 555,
                        'height' => 416,
                    ),
                    'compiler' => true
                ),
                array(
                    'id'             => 'setupsizelimitconf_general_gridsize3',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('3 Cols. Min Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (360x270)',
                    'default'        => array(
                        'width'  => 360,
                        'height' => 270,
                    ),
                    'compiler' => true
                ),
                array(
                    'id'             => 'setupsizelimitconf_general_gridsize4',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('4 Cols. Min Size (Width/Height)', 'pointfindercoreelements'),
                    'desc'           => esc_html__('All size units (px)', 'pointfindercoreelements').' (263x197)',
                    'default'        => array(
                        'width'  => 263,
                        'height' => 197,
                    ),
                    'compiler' => true
                ),

            array(
               'id' => 'setupsizelimitconf_general_gridsize2-start',
               'type' => 'section',
               'indent' => false 
            ),
            /*End:(VC_Carousel, VC_Image_Carousel, VC_Client Carousel, VC_Gallery)*/

        )
    );
/**
*End : Image Sizes
**/

Redux::setSections($opt_name,$sections);