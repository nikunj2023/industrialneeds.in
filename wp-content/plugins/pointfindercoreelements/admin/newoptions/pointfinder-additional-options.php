<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfascontrol_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Additional Settings','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Additional Settings','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Additional Settings','pointfindercoreelements'),
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
	'page_slug'                 => '_pfasconf',
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

if (class_exists('ReduxFramework', false)) {
	$pf_sidebar_options = array(
        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
    );
} elseif(class_exists('Redux_Core')){
	$pf_sidebar_options = array(
        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => Redux_Core::$_url . 'assets/img/2cl.png'),
        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => Redux_Core::$_url . 'assets/img/2cr.png'),
        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => Redux_Core::$_url . 'assets/img/1col.png'),
    );
}


$sections = array();


/**
*Start : Global Footer
**/
    $sections[] = array(
        'id' => 'setup_gbf',
        'title' => esc_html__('Global Footer Row', 'pointfindercoreelements'),
        'icon' => 'el-icon-pencil',
        'fields' => array(
            array(
                'id' => 'applydesign',
                'type' => 'button_set',
                'title' => esc_html__('Dynamic CSS', 'pointfindercoreelements') ,
                'description' => esc_html__('Please change this option and save changes after edit the global settings by using Elementor. Also, you can use this option to regenerate dynamic styles.', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Apply', 'pointfindercoreelements') ,
                    '2' => esc_html__('Apply', 'pointfindercoreelements')
                ) ,
                'compiler' => true,
                'default' => '1',
            ) ,
            array(
                'id' => 'gbf_status',
                'type' => 'button_set',
                'title' => esc_html__('Status', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements'),
                ) ,
                'default' => 0,
                'customizer' => true
            ),
            array(
                'id' => 'gbf_cols',
                'type' => 'button_set',
                'title' => esc_html__('Column Number', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('1', 'pointfindercoreelements') ,
                    '2' => esc_html__('2', 'pointfindercoreelements'),
                    '3' => esc_html__('3', 'pointfindercoreelements'),
                    '4' => esc_html__('4', 'pointfindercoreelements'),
                ) ,
                'default' => 4,
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'       => 'gbf_sidebar1',
                'type'     => 'select',
                'title'    => esc_html__('1st Column Widget Area', 'pointfindercoreelements'),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array(array( 'gbf_cols', '>=', 1 ),array('gbf_status','=',1))
            ),
            array(
                'id'       => 'gbf_sidebar2',
                'type'     => 'select',
                'title'    => esc_html__('2nd Column Widget Area', 'pointfindercoreelements'),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array(array( 'gbf_cols', '>=', 2 ),array('gbf_status','=',1))
            ),
            array(
                'id'       => 'gbf_sidebar3',
                'type'     => 'select',
                'title'    => esc_html__('3rd Column Widget Area', 'pointfindercoreelements'),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array(array( 'gbf_cols', '>=', 3 ),array('gbf_status','=',1))
            ),
            array(
                'id'       => 'gbf_sidebar4',
                'type'     => 'select',
                'title'    => esc_html__('4th Column Widget Area', 'pointfindercoreelements'),
                'data'     => 'sidebars',
                'default'  => '',
                'required' => array(array( 'gbf_cols', '>=', 4 ),array('gbf_status','=',1))
            ),
            array(
                'id'       => 'gbf_bgopt2',
                'type'     => 'background',
                'output'   => array( '.wpf-footer-row-move:before' ),
                'title'    => esc_html__('Background (Before Row)', 'pointfindercoreelements'),
                'default'   => '#FFFFFF',
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'             => 'gbf_bgopt2w',
                'type'           => 'dimensions',
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'compiler'   => array( '.wpf-footer-row-move:before' ),
                'title'          => esc_html__('Background (Before Row) Height', 'pointfindercoreelements'),
                'width'         => false,
                'default'        => array(
                    'height' => 0,
                ),
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'             => 'gbf_bgopt2m',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'output'   => array( '.wpf-footer-row-move:before' ),
                'all'            => false,
                'left'            => false,
                'right'            => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Margin (Before Row)', 'pointfindercoreelements' ),
                'default'        => array(
                    'margin-top'    => '0',
                    'margin-bottom' => '0'
                ),
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'       => 'gbf_bgopt',
                'type'     => 'background',
                'output'   => array( '.pointfinderexfooterclassxgb' ),
                'title'    => esc_html__('Background', 'pointfindercoreelements'),
                'default'   => '#FFFFFF',
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'        => 'gbf_textcolor1',
                'type'      => 'color',
                'output'   => array( '.pointfinderexfooterclassgb'),
                'title'     => esc_html__('Text Color', 'pointfindercoreelements'),
                'default' => '#000000',
                'transparent'   => false,
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'        => 'gbf_textcolor2',
                'type'      => 'link_color',
                'compiler'   => array('.pointfinderexfooterclassgb a' ),
                'title'     => esc_html__('Link Color', 'pointfindercoreelements'),
                'active' => false,
                'default' => array(
                    'regular' => '#000000',
                    'hover' => '#B32E2E'
                ),
                'transparent'   => false,
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'             => 'gbf_spacing',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'output'   => array( '.pointfinderexfooterclassgb' ),
                'all'            => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'left'            => false,
                'right'            => false,
                'title'          => esc_html__( 'Padding', 'pointfindercoreelements' ),
                'default'        => array(
                    'padding-top'    => '50px',
                    'padding-bottom' => '50px'
                ),
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'             => 'gbf_spacing2',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'output'   => array( '.pointfinderexfooterclassxgb' ),
                'all'            => false,
                'left'            => false,
                'right'            => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Margin', 'pointfindercoreelements' ),
                'default'        => array(
                    'margin-top'    => '0',
                    'margin-bottom' => '0'
                ),
                'required' => array('gbf_status','=',1)
            ),
            array(
                'id'       => 'gbf_border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'pointfindercoreelements' ),
                'output'   => array( '.pointfinderexfooterclassxgb' ),
                'all'      => false,
                'left'            => false,
                'right'            => false,
                'default'  => array(
                    'border-color'  => 'transparent',
                    'border-style'  => 'solid',
                    'border-top'    => '0',
                    'border-right'  => '0',
                    'border-bottom' => '0',
                    'border-left'   => '0'
                ),
                'required' => array('gbf_status','=',1)
            ),


        )
    );
/**
*End : Global Footer
**/



/**
*Start : SOCIAL LOGIN SETTINGS
**/
    $sections[] = array(
        'id' => 'setup40_sociallogins',
        'icon' => 'el-icon-key',
        'title' => esc_html__('Social Login Settings', 'pointfindercoreelements'),
        'fields' => array(
                array(
                    'id'        => 'setup40_sociallogins_info1',
                    'type'      => 'info',
                    'notice'    => true,
                    'style'     => 'info',
                    'desc'      => esc_html__('This section required User Login System activation. Please activate from Frontend Settings.', 'pointfindercoreelements'),
                ),
                array(
                    'id' => 'setup4_membersettings_facebooklogin',
                    'type' => 'button_set',
                    'title' => esc_html__('Facebook Login', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ) ,
                    'default' => '0',
                ) ,
                array(
                    'id'        => 'setup4_membersettings_facebooklogin_appid',
                    'type'      => 'text',
                    'title'     => esc_html__('Facebook Login: APP ID', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_facebooklogin','=','1'),
                    )
                ),
                array(
                    'id'        => 'setup4_membersettings_facebooklogin_secretid',
                    'type'      => 'text',
                    'title'     => esc_html__('Facebook Login: Secret ID', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_facebooklogin','=','1'),
                    )
                ),


                array(
                    'id' => 'setup4_membersettings_twitterlogin',
                    'type' => 'button_set',
                    'title' => esc_html__('Twitter Login', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ) ,
                    'default' => '0',
                ) ,

                array(
                    'id'        => 'setup4_membersettings_twitterlogin_appid',
                    'type'      => 'text',
                    'title'     => esc_html__('Twitter Login: Key', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_twitterlogin','=','1'),
                    )
                ),
                array(
                    'id'        => 'setup4_membersettings_twitterlogin_secretid',
                    'type'      => 'text',
                    'title'     => esc_html__('Twitter Login: Secret Key', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_twitterlogin','=','1'),
                    )
                ),


                array(
                    'id' => 'setup4_membersettings_googlelogin',
                    'type' => 'button_set',
                    'title' => esc_html__('Google + Login', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ) ,
                    'default' => '0',
                ) ,

                array(
                    'id'        => 'setup4_membersettings_googlelogin_clientid',
                    'type'      => 'text',
                    'title'     => esc_html__('Google + Login: Clien ID', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_googlelogin','=','1'),
                    )
                ),
                array(
                    'id'        => 'setup4_membersettings_googlelogin_secretid',
                    'type'      => 'text',
                    'title'     => esc_html__('Google + Login: Client Secret', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_googlelogin','=','1'),
                    )
                ),



                


                array(
                    'id' => 'setup4_membersettings_vklogin',
                    'type' => 'button_set',
                    'title' => esc_html__('VK Login', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ) ,
                    'default' => '0',
                ) ,

                array(
                    'id'        => 'setup4_membersettings_vklogin_clientid',
                    'type'      => 'text',
                    'title'     => esc_html__('VK Login: Application ID', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_vklogin','=','1'),
                    )
                ),
                array(
                    'id'        => 'setup4_membersettings_vklogin_secretid',
                    'type'      => 'text',
                    'title'     => esc_html__('VK Login: Secure Key', 'pointfindercoreelements'),
                    'hint'      => array('content' =>esc_html__('Please check help documentation for instruction.', 'pointfindercoreelements')),
                    'default'   => '',
                    'required' => array(
                        array('setup4_membersettings_vklogin','=','1'),
                    )
                ),


            )

    );
/**
*End : SOCIAL LOGIN SETTINGS
**/


/**
*Start : Twitter Widget
**/
    $sections[] = array(
        'id' => 'setuptwitter_widget',
        'title' => esc_html__('Twitter Widget', 'pointfindercoreelements'),
        'icon' => 'el-icon-twitter',
        'fields' => array(
            array(
                'id' => 'setuptwitterwidget_general_help',
                'type' => 'info',
                'notice' => true,
                'style' => 'info',
                'desc' => esc_html__('Please fill below the information if you are planning to use Twitter Widget. You can find more information about configuration by using our documentation.', 'pointfindercoreelements')
            ) ,

            array(
                'id' => 'setuptwitterwidget_conkey',
                'type' => 'text',
                'title' => esc_html__('Consumer Key', 'pointfindercoreelements') ,
            ) ,
            array(
                'id' => 'setuptwitterwidget_consecret',
                'type' => 'text',
                'title' => esc_html__('Consumer Secret', 'pointfindercoreelements') ,
            ),

            array(
                'id' => 'setuptwitterwidget_acckey',
                'type' => 'text',
                'title' => esc_html__('Access Token Key', 'pointfindercoreelements') ,
            ) ,
            array(
                'id' => 'setuptwitterwidget_accsecret',
                'type' => 'text',
                'title' => esc_html__('Access Token Secret', 'pointfindercoreelements') ,
            ),



        )
    );
/**
*End : Twitter Widget
**/

/**
*Start : PAGE SIDEBAR SETTINGS
**/
    $sections[] = array(
            'id' => 'setup_item_pagessidebars',
            'title' => esc_html__('Inner Page Sidebars', 'pointfindercoreelements'),
            'icon' => 'el-icon-indent-right',
            'fields' => array(
                array(
                    'id'        => 'setup_item_blogpage_sidebarpos',
                    'type'  => 'image_select',
                    'title'     => esc_html__('Sidebar Position : Single Blog Page', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('This settings only cover single blog page.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Blog Sidebar', 'pointfindercoreelements'),
                    'options'   => $pf_sidebar_options,
                    'default'   => '2'
                ),
                array(
                    'id'        => 'setup_item_blogcatpage_sidebarpos',
                    'type'  => 'image_select',
                    'title'     => esc_html__('Sidebar Position : Blog Category Page', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('This settings only cover blog category page.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Blog Category Sidebar', 'pointfindercoreelements'),
                    'options'   => $pf_sidebar_options,
                    'default'   => '2'
                ),
				array(
                    'id'        => 'setup_item_blogspage_sidebarpos',
                    'type'  => 'image_select',
                    'title'     => esc_html__('Sidebar Position : Blog Search Results Page', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('This settings only cover blog category page.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Blog Search Sidebar', 'pointfindercoreelements'),
                    'options'   => $pf_sidebar_options,
                    'default'   => '2'
                ),
                
                
                array(
                    'id' => 'setupbbpress_general_sidebarpos',
                    'type'  => 'image_select',
                    'title' => esc_html__('Sidebar Position : bbPress Inner Page', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('If you are using bbPress forums, below settings will help you to change inner page settings.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > bbPress Inner Widget', 'pointfindercoreelements'),
                    'options' => $pf_sidebar_options,
                    'default'   => '2'
                ),
                array(
                    'id' => 'setup_item_idx_sidebarpos',
                    'type'  => 'image_select',
                    'title' => esc_html__('Sidebar Position : dsIDX Page', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('This settings only cover dsIDX page.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF dsidxpress Sidebar', 'pointfindercoreelements'),
                    'options' => $pf_sidebar_options,
                    'default'   => '2'
                ),
                array(
                    'id' => 'setup_item_woocom_sidebarpos',
                    'type'  => 'image_select',
                    'title' => esc_html__('Sidebar Position : Woocommerce Pages', 'pointfindercoreelements'),
                    'subtitle' => esc_html__('This settings only cover WooCommerce pages.', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF WooCommerce Sidebar', 'pointfindercoreelements'),
                    'options' => $pf_sidebar_options,
                    'default'   => '2'
                ),

            )
        );
/**
*End : PAGE SIDEBAR SETTINGS
**/



/**
*Start : Invoice Settings
**/
    $sections[] = array(
        'id' => 'setup_invoices',
        'title' => esc_html__('Invoice Settings', 'pointfindercoreelements'),
        'icon' => 'el-icon-file-edit-alt',
        'fields' => array(
            array(
                'id' => 'setup_invoices_sh',
                'type' => 'button_set',
                'title' => esc_html__('Invoices in Menu', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Show', 'pointfindercoreelements') ,
                    '0' => esc_html__('Hide', 'pointfindercoreelements')
                ) ,
                'default' => 1

            ) ,

            array(
                'id'    => 'setup_invoices_info',
                'type'  => 'info',
                'style' => 'info',
                'title' => __( 'Invoice System', 'pointfindercoreelements' ),
                'desc'  => __( 'You can set an invoice prefix and change some settings by using below options.', 'pointfindercoreelements' )
            ),
            array(
                'id' => 'setup_invoices_prefix',
                'type' => 'text',
                'title' => esc_html__('Invoice Prefix', 'pointfindercoreelements') ,
                'desc' => esc_html__('Ex: PFI for PFI121318', 'pointfindercoreelements'),
                'default' => 'PFI'
            ),

            array(
                'id' => 'setup_invoices_vatnum',
                'type' => 'text',
                'title' => esc_html__('Your VAT Number', 'pointfindercoreelements')
            ),
            array(
                'id' => 'setup_invoices_usertit',
                'type' => 'text',
                'title' => esc_html__('Invoice Title', 'pointfindercoreelements'),
                'desc' => esc_html__('Company name or full name.', 'pointfindercoreelements'),
            ),
            array(
                'id' => 'setup_invoices_usercountry',
                'type' => 'text',
                'title' => esc_html__('Invoice Country', 'pointfindercoreelements'),
                'desc' => esc_html__('Your country name', 'pointfindercoreelements'),
            ),
            array(
                'id' => 'setup_invoices_address',
                'type' => 'textarea',
                'title' => esc_html__('Invoice Address', 'pointfindercoreelements'),
                'desc' => esc_html__('Your full address', 'pointfindercoreelements'),
            ),



    /**
    *Start: Invoice Template Settings
    **/
            array(
                'id'        => 'setup_invoices_sitename',
                'type'      => 'text',
                'title'     => esc_html__('Site Name', 'pointfindercoreelements'),
                'default'   => '',
                'hint' => array(
                    'content'   => esc_html__('Please write site name for invoice header.','pointfindercoreelements')
                )
            ),
            array(
                'id' => 'setup_inv_temp_rtl',
                'type' => 'button_set',
                'title' => esc_html__('Text Direction', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Show Right to Left', 'pointfindercoreelements') ,
                    '0' => esc_html__('Show Left to Right', 'pointfindercoreelements')
                ) ,
                'default' => '0'

            ) ,

            array(
                'id' => 'setup_inv_temp_logo',
                'type' => 'button_set',
                'title' => esc_html__('Template Logo', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Show Logo', 'pointfindercoreelements') ,
                    '0' => esc_html__('Show Text', 'pointfindercoreelements')
                ) ,
                'default' => '1'

            ) ,

            array(
                'id'        => 'setup_inv_temp_logotext',
                'type'      => 'text',
                'title'     => esc_html__('Logo Text', 'pointfindercoreelements'),
                'required'   => array('setup_inv_temp_logo','=','0'),
                'text_hint' => array(
                    'title'     => '',
                    'content'   => esc_html__('Please type your logo text. Ex: Pointfinder','pointfindercoreelements')
                )
            ),

            array(
                'id'        => 'setup_inv_temp_mainbgcolor',
                'type'      => 'color',
                'title'     => esc_html__('Main Background Color', 'pointfindercoreelements'),
                'default'   => '#F0F1F3',
                'validate'  => 'color',
                'transparent'   => false
            ),

            array(
                'id'        => 'setup_inv_temp_headerfooter',
                'type'      => 'color',
                'title'     => esc_html__('Header / Footer: Background Color', 'pointfindercoreelements'),
                'default'   => '#f7f7f7',
                'validate'  => 'color',
                'transparent'  => false
            ),

            array(
                'id'        => 'setup_inv_temp_headerfooter_line',
                'type'      => 'color',
                'title'     => esc_html__('Header / Footer: Line Color', 'pointfindercoreelements'),
                'default'   => '#F25555',
                'validate'  => 'color',
                'transparent'  => false
            ),


            array(
                'id'        => 'setup_inv_temp_headerfooter_text',
                'type'      => 'link_color',
                'title'     => esc_html__('Header / Footer: Text/Link Color', 'pointfindercoreelements'),
                'active'    => false,
                'visited'   => false,
                'compiler'  => false,
                'default'   => array(
                    'regular'   => '#494949',
                    'hover'     => '#F25555',
                )
            ),

            array(
                'id'        => 'setup_inv_temp_contentbg',
                'type'      => 'color',
                'title'     => esc_html__('Content: Background Color', 'pointfindercoreelements'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                 'transparent'  => false
            ),

            array(
                'id'        => 'setup_inv_temp_contenttext',
                'type'      => 'link_color',
                'title'     => esc_html__('Content: Text/Link Color', 'pointfindercoreelements'),
                'active'    => false,
                'visited'   => false,
                'compiler'  => false,
                'default'   => array(
                    'regular'   => '#494949',
                    'hover'     => '#F25555',
                )
            ),

            array(
                'id'        => 'setup_inv_temp_footertext',
                'type'      => 'textarea',
                'title'     => esc_html__('Footer Text', 'pointfindercoreelements'),
                'desc'      => esc_html__('%%siteurl%% : Site URL', 'pointfindercoreelements').'<br>'.esc_html__('%%sitename%% : Site Name', 'pointfindercoreelements'),
                'default'   => 'This is an automated email from <a href="%%siteurl%%">%%sitename%%</a>'
            ),

    )
);
    /**
    *End: Invoice Template Settings
    **/
/**
*End : Invoice Settings
**/

/**
*Start : Speed Up Settings
**/
    $sections[] = array(
        'id' => 'setup_speed',
        'title' => esc_html__('Site Speed Optimization', 'pointfindercoreelements'),
        'icon' => 'el-icon-wrench',
        'fields' => array(

            array(
                'id' => 'st8_fontello',
                'type' => 'button_set',
                'title' => esc_html__("Fontello Icons", 'pointfindercoreelements') ,
                'desc' => esc_html__('This will disable the Fontello Icons from all theme functions.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            array(
                'id' => 'st8_flaticons',
                'type' => 'button_set',
                'title' => esc_html__("Flat Icons", 'pointfindercoreelements') ,
                'desc' => esc_html__('This will disable the Flat Icons from all theme functions. All map icons are using the Flat Icons. Please make sure you changed all icon names to the FontAwesome icons before disable this option.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            /*
            array(
                'id' => 'st8_mapsys',
                'type' => 'button_set',
                'title' => esc_html__("Map System", 'pointfindercoreelements') ,
                'desc' => esc_html__('This will disable the Map System from all theme functions.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            */
            array(
                'id' => 'st8_animate',
                'type' => 'button_set',
                'title' => esc_html__("Animate.css", 'pointfindercoreelements') ,
                'desc' => esc_html__('This will disable the Animate.css from all theme functions.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            



        )
    );
/**
*End : Speed Up Settings
**/


/**
*Start : Category Based Settings
**/
    $sections[] = array(
        'id' => 'setup_cbased',
        'title' => esc_html__('Advanced Settings', 'pointfindercoreelements'),
        'icon' => 'el-icon-cogs',
        'fields' => array(
            array(
                'id' => 'st8_nasys',
                'type' => 'button_set',
                'title' => esc_html__('Category Based: Advanced Listing Types System', 'pointfindercoreelements') ,
                'desc' => esc_html__('If you are planning to use more than 50 listing types, then this system is recommended. If this is enabled, Advanced Listing Types Config Panel will disappear.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            array(
                'id' => 'st8_npsys',
                'type' => 'button_set',
                'title' => esc_html__('Category Based: Custom Point Style System', 'pointfindercoreelements') ,
                'desc' => esc_html__('If you are planning to use more than 50 listing types, then this system is recommended. If this is enabled, the Custom Point Styles Config Panel will disappear.', 'pointfindercoreelements') ,
                "default" => 1,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            array(
                'id'        => 'st8_npsys-start',
                'type'      => 'section',
                'title'     => esc_html__('Default Point Setting', 'pointfindercoreelements'),
                'subtitle' => esc_html__("If system can not found a configuration for the listing type then will use this settings. Configuration strongly recommended. This system only working with New Custom Point Style System", 'pointfindercoreelements') ,
                'indent'    => true,
                'required'  => array('st8_npsys','=',1)
            ),
                array(
                    'id' => 'cpoint_type',
                    'type' => 'button_set',
                    'title' => esc_html__('Point Type','pointfindercoreelements'),
                    "default" => 0,
                    'options' => array(1 => esc_html__('Custom Image','pointfindercoreelements'), 0 => esc_html__('Predefined Icon','pointfindercoreelements')),
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_bgimage',
                    'type' => 'media',
                    'title' => esc_html__('Point Image','pointfindercoreelements'),
                    'required'  => array(array('st8_npsys','=',1),array('cpoint_type','=',1))
                ) ,

                array(
                    'id' => 'cpoint_icontype',
                    'type' => 'button_set',
                    'title' => esc_html__('Point Icon Type','pointfindercoreelements'),
                    "default" => 1,
                    'options' => array(1 => esc_html__('Round','pointfindercoreelements'), 2 => esc_html__('Square','pointfindercoreelements'),3 => esc_html__('Dot','pointfindercoreelements')),
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_iconsize',
                    'type' => 'button_set',
                    'title' => esc_html__('Point Icon Type','pointfindercoreelements'),
                    "default" => 'middle',
                    'options' => array('small' => esc_html__('Small','pointfindercoreelements'), 'middle' => esc_html__('Middle','pointfindercoreelements'), 'large' => esc_html__('Large','pointfindercoreelements'), 'xlarge' => esc_html__('X-Large','pointfindercoreelements')),
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_bgcolor',
                    'type' => 'color',
                    'title' => esc_html__('Point Color','pointfindercoreelements'),
                    "default" => '#b00000',
                    "transparent" => false,
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_bgcolorinner',
                    'type' => 'color',
                    'title' => esc_html__('Point Inner Color','pointfindercoreelements'),
                    "default" => '#ffffff',
                    "transparent" => false,
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_iconcolor',
                    'type' => 'color',
                    'title' => esc_html__('Point Icon Color','pointfindercoreelements'),
                    "default" => '#b00000',
                    "transparent" => false,
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_iconnamefs',
                    'type' => 'text',
                    'title' => esc_html__('Point FontAwesome Icon','pointfindercoreelements'),
                    'description' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>').'<br>'.esc_html__('Note, you can leave an unselected predefined icon section if you want to use the FontAwesome icon.','pointfindercoreelements'),
                    'required'  => array('st8_npsys','=',1)
                ) ,
                array(
                    'id' => 'cpoint_iconname',
                    'type' => 'extension_custom_icon',
                    'title' => esc_html__('Point Predefined Icon','pointfindercoreelements'),
                    'required'  => array('st8_npsys','=',1)
                ) ,


            array(
                'id' => 'st8_npsys-end',
                'type' => 'section',
                'indent' => false,
                'required'  => array('st8_npsys','=',1)
            )
        )
    );

/**
*Start : Currency Settings
**/
    $sections[] = array(
        'id' => 'setup_currency',
        'title' => esc_html__('Multiple Currency', 'pointfindercoreelements'),
        'icon' => 'el-icon-usd',
        'fields' => array(

            array(
                    'id'        => 'st9_currency_inf',
                    'type'      => 'info',
                    'notice'    => true,
                    'style'     => 'info',
                    'desc'      => esc_html__('Our multiple currency system changed with PointFinder v1.8.8 Please update your API key for continue to use multiple currency system.', 'pointfindercoreelements').'<br/>'.esc_html__('We are using Yahoo Finance API previously and Yahoo discontinue that system. Now our system using Currencylayer.com API.', 'pointfindercoreelements'),
                ),
            array(
                'id' => 'st9_currency_status',
                'type' => 'button_set',
                'title' => esc_html__("Currency Converter", 'pointfindercoreelements') ,
                'desc' => esc_html__('If this enabled, Pointfinder will get currency rates from Yahoo Finance with selected time range.', 'pointfindercoreelements') ,
                "default" => 0,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ),
            ) ,
            array(
                'id' => 'st9_currency_when',
                'type' => 'button_set',
                'title' => esc_html__('Refresh Rate', 'pointfindercoreelements') ,
                "default" => 'twicedaily',
                'options' => array(
                    'hourly' => esc_html__('Hourly', 'pointfindercoreelements') ,
                    'twicedaily' => esc_html__('Twice Daily', 'pointfindercoreelements'),
                    'daily' => esc_html__('Daily', 'pointfindercoreelements'),
                ),
                'required' => array('st9_currency_status','=',1)
            ) ,
            array(
                'id' => 'st9_currency_from',
                'type' => 'text',
                'title' => esc_html__('Convert Currency From', 'pointfindercoreelements') ,
                'desc' => sprintf(esc_html__('Please write 3 char currency code. You can find currency codes from %s https://en.wikipedia.org/wiki/ISO_4217 %s', 'pointfindercoreelements'),'<a href="https://en.wikipedia.org/wiki/ISO_4217" target="_blank">','</a>').'<br/><strong>'.esc_html__('Currencylayer does allow to use USD currency for source if you using free plan. Please signup a paid plan for use different currencies.', 'pointfindercoreelements').'</strong>',
                "default" => 'USD',
                'required' => array('st9_currency_status','=',1)
            ) ,
            array(
                'id' => 'st9_currency_key',
                'type' => 'text',
                'title' => esc_html__('Currency Layer API Key', 'pointfindercoreelements') ,
                'desc' => sprintf(esc_html__('Please copy and write currencylayer.com API key from %s https://currencylayer.com %s', 'pointfindercoreelements'),'<a href="https://currencylayer.com" target="_blank">','</a>'),
                "default" => '',
                'required' => array('st9_currency_status','=',1)
            ) ,
            array(
                'id' => 'st9_currency_to',
                'type' => 'textarea',
                'title' => esc_html__('Available Currencies', 'pointfindercoreelements') ,
                'desc' => sprintf(esc_html__('Please write currency codes with comma separated. Ex: EUR,GPB,TRY %s You can find currency codes from %s https://en.wikipedia.org/wiki/ISO_4217 %s', 'pointfindercoreelements'),'<br>','<a href="https://en.wikipedia.org/wiki/ISO_4217" target="_blank">','</a>').'<br/>'.esc_html__('Please do not leave space between commas', 'pointfindercoreelements'),
                "default" => '',
                'required' => array('st9_currency_status','=',1)
            ),
            array(
                'id' => 'st9_currency_decimals',
                'type' => 'button_set',
                'title' => esc_html__('Currency Decimals', 'pointfindercoreelements') ,
                "default" => '0',
                'options' => array(
                    '0' => esc_html__('0', 'pointfindercoreelements') ,
                    '2' => esc_html__('2', 'pointfindercoreelements'),
                    '3' => esc_html__('3', 'pointfindercoreelements'),
                ),
                'required' => array('st9_currency_status','=',1)
            ) ,

        )
    );
/**
*End : Currency Settings
**/






/**
*Start : PAGE BUILDER SETTINS
**/
    $sections[] = array(
        'id' => 'general_pbcustomizer',
        'title' => esc_html__('Page Builder Styles', 'pointfindercoreelements'),
        'icon' => 'el-icon-website',
        'fields' => array()

    );
    /**
    *Page Builder: Info Boxes
    **/
    $sections[] = array(
        'id' => 'setup21_widgetsettings_4',
        'subsection' => true,
        'title' => esc_html__('Page Builder: Info Boxes', 'pointfindercoreelements'),
        'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s You can change PF Info Box Typography.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_infobox.png" class="description-img" />'),
        'fields' => array(
                array(
                    'id' => 'setup21_iconboxsettings_title_typo',
                    'type' => 'typography',
                    'title' => esc_html__('Info Box Title Area', 'pointfindercoreelements') ,
                    'google' => true,
                    'font-backup' => true,
                    'font-size' => false,
                    'line-height' => false,
                    'text-align' => false,
                    'compiler' => array(
                        '.pf-iconbox-wrapper .pf-iconbox-title'
                    ) ,
                    'units' => 'px',
                    'color' => false,
                    'default' => array(
                        'font-weight' => '600',
                        'font-family' => 'Open Sans',
                        'google' => true,

                    ) ,
                ) ,
                array(
                    'id' => 'setup21_iconboxsettings_typ1_typo',
                    'type' => 'typography',
                    'title' => esc_html__('Info Box Text Area', 'pointfindercoreelements') ,
                    'google' => true,
                    'font-backup' => true,
                    'font-size' => false,
                    'line-height' => false,
                    'text-align' => false,
                    'color' => false,
                    'compiler' => array(
                        '.pf-iconbox-wrapper .pf-iconbox-text',
                        '.pf-iconbox-wrapper .pf-iconbox-readmore'
                    ) ,
                    'units' => 'px',
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Open Sans',
                        'google' => true,
                    ) ,
                )
        )
    );



    /**
    *Page Builder: Item Slider
    **/
    $sections[] = array(
        'id' => 'setup21_widgetsettings_3',
        'subsection' => true,
        'title' => esc_html__('Page Builder: Item Slider', 'pointfindercoreelements'),
        'desc' => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Blue area on the image refers to PF Items Slider.','pointfindercoreelements').'<br/>'.esc_html__('You can change styles of this area by using below options.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_itemslider.png" class="description-img" />'),
        'fields' => array(
                array(
                    'id'        => 'setup21_widgetsettings_3_slider_capt',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Description Box Background', 'pointfindercoreelements'),
                    'default'   => array('color' => '#000', 'alpha' => '0.8'),
                    'compiler'  => array(
                        '.pf-item-slider .pf-item-slider-description',
                        '.pf-item-slider .pf-item-slider-price',
                        '.pf-item-slider .pf-item-slider-golink'
                    ),
                    'mode'      => 'background',
                    'validate'  => 'colorrgba',
                ),
                array(
                    'id' => 'setup21_widgetsettings_3_title_color',
                    'type' => 'link_color',
                    'title' => esc_html__('Title/Type Area Link Color', 'pointfindercoreelements') ,
                    'compiler' => array(
                        '.pf-item-slider-description .pf-item-slider-title a',
                        '.pf-item-slider .pflistingitem-subelement.pf-price',
                        '.pf-item-slider .pf-item-slider-golink a'
                    ) ,
                    'active' => false,
                    'default' => array(
                        'regular' => '#fff',
                        'hover' => '#efefef'
                    )
                ) ,
                array(
                    'id' => 'setup21_widgetsettings_3_title_typo',
                    'type' => 'typography',
                    'title' => esc_html__('Title Area Typography', 'pointfindercoreelements') ,
                    'google' => true,
                    'font-backup' => true,
                    'compiler' => array(
                        '.pf-item-slider-description .pf-item-slider-title',
                        '.pf-item-slider .pflistingitem-subelement.pf-price',
                        '.pf-item-slider .pf-item-slider-golink'
                    ) ,
                    'units' => 'px',
                    'color' => false,
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Roboto Condensed',
                        'google' => true,
                        'font-size' => '25px',
                        'line-height' => '25px',
                        'text-align' => 'left'
                    )
                ) ,
                array(
                    'id' => 'setup21_widgetsettings_3_address_color',
                    'type' => 'link_color',
                    'title' => esc_html__('Address Area Link Color', 'pointfindercoreelements') ,
                    'compiler' => array(
                        '.pf-item-slider-description .pf-item-slider-address a'
                    ) ,
                    'active' => false,
                    'default' => array(
                        'regular' => '#fff',
                        'hover' => '#efefef'
                    )
                ) ,
                array(
                    'id' => 'setup21_widgetsettings_3_address_typo',
                    'type' => 'typography',
                    'title' => esc_html__('Address Typography', 'pointfindercoreelements') ,
                    'google' => true,
                    'font-backup' => true,
                    'compiler' => array(
                        '.pf-item-slider-description .pf-item-slider-address'
                    ) ,
                    'units' => 'px',
                    'color' => false,
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Open Sans',
                        'google' => true,
                        'font-size' => '14px',
                        'line-height' => '16px',
                        'text-align' => 'left'
                    )
                ),
                array(
                    'id' => 'setup21_widgetsettings_3_typ1_typo',
                    'type' => 'typography',
                    'title' => esc_html__('Excerpt Area Typography', 'pointfindercoreelements') ,
                    'google' => true,
                    'font-backup' => true,
                    'compiler' => array(
                        '.pf-item-slider-description .pf-item-slider-excerpt'
                    ) ,
                    'units' => 'px',
                    'color' => true,
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Open Sans',
                        'google' => true,
                        'font-size' => '12px',
                        'line-height' => '15px',
                        'color' => '#fff',
                        'text-align' => 'left'
                    )
                )
        )
    );
/**
*End : PAGE BUILDER SETTINS
**/



/**
*Start : POST BUTTON STYLES
**/

     $sections[] = array(
        'id' => 'general_postitembutton',
        'title' => esc_html__('Post New Point Button', 'pointfindercoreelements'),
        'icon' => 'el-icon-plus',
        'fields' => array(
            array(
                'id' => 'general_postitembutton_status',
                'type' => 'button_set',
                'title' => esc_html__('Desktop: Button Status', 'pointfindercoreelements') ,
                'default' => 1,
                'options' => array(
                    '1' => esc_html__('Show', 'pointfindercoreelements') ,
                    '0' => esc_html__('Hide', 'pointfindercoreelements')
                ),
            ),
            array(
                'id' => 'general_postitembutton_mstatus',
                'type' => 'button_set',
                'title' => esc_html__('Mobile: Button Status', 'pointfindercoreelements') ,
                'default' => 1,
                'options' => array(
                    '1' => esc_html__('Show', 'pointfindercoreelements') ,
                    '0' => esc_html__('Hide', 'pointfindercoreelements')
                ),
            ),
            
            array(
                'id' => 'general_postitembutton_linkcolor',
                'type' => 'link_color',
                'title' => esc_html__('Text Color', 'pointfindercoreelements') ,
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '#pfpostitemlinkmobile'
                ) ,
                'active' => false,
                'default' => array(
                    'regular' => '#fff',
                    'hover' => '#efefef'
                )
            ) ,

            array(
                'id' => 'general_postitembutton_linkcolor_typo',
                'type' => 'typography',
                'title' => esc_html__('Text Typography', 'pointfindercoreelements') ,
                'google' => true,
                'font-backup' => true,
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '#pfpostitemlinkmobile'
                ) ,
                'units' => 'px',
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'default' => array(
                    'font-weight' => '400',
                    'font-family' => 'Open Sans',
                    'google' => true,
                    'font-size' => '12px'
                )
            ),
            array(
                'id' => 'general_postitembutton_bgcolor',
                'type' => 'extension_custom_link_color',
                'mode' => 'background',
                'title' => esc_html__('Background Color', 'pointfindercoreelements') ,
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '#pfpostitemlinkmobile'
                ) ,
                'active' => false,
                'default' => array(
                    'regular' => '#ad2424',
                    'hover' => '#ce2f2f'
                )
            ) ,

            array(
                'id'       => 'general_postitembutton_border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border Option', 'pointfindercoreelements' ),
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '#pfpostitemlinkmobile'
                ) ,
                'all'      => true,
                'default'  => array(
                    'border-color'  => '#efefef',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
            array(
                'id'      => 'general_postitembutton_borderr',
                'type'    => 'spinner',
                'title'   => esc_html__( 'Border Radius', 'pointfindercoreelements' ),
                'desc'    => esc_html__( 'px', 'pointfindercoreelements' ),
                'default' => '50',
                'min'     => '0',
                'step'    => '1',
                'max'     => '100',
                'compiler' => true
            ),
            array(
                'id' => 'general_postitembutton_iconstatus',
                'type' => 'button_set',
                'title' => esc_html__('Icon Status', 'pointfindercoreelements') ,
                'default' => 0,
                'options' => array(
                    '1' => esc_html__('Show', 'pointfindercoreelements') ,
                    '0' => esc_html__('Hide', 'pointfindercoreelements')
                ),
                'compiler' => true
            ),
            array(
                'id' => 'general_postitembutton_htext',
                'type' => 'button_set',
                'title' => esc_html__('Hide Text', 'pointfindercoreelements') ,
                'subtitle' => esc_html__('Only available on Desktop view', 'pointfindercoreelements') ,
                'default' => '0',
                'options' => array(
                    '1' => esc_html__('Yes', 'pointfindercoreelements') ,
                    '0' => esc_html__('No', 'pointfindercoreelements')
                ),
                'required' => array('general_postitembutton_iconstatus','=',1)
            ),
            array(
                'id' => 'general_postitembutton_httip',
                'type' => 'button_set',
                'title' => esc_html__('Hide Tooltip', 'pointfindercoreelements') ,
                'subtitle' => esc_html__('Only available on Desktop view', 'pointfindercoreelements') ,
                'default' => 1,
                'options' => array(
                    '1' => esc_html__('Yes', 'pointfindercoreelements') ,
                    '0' => esc_html__('No', 'pointfindercoreelements')
                ),
                'required' => array('general_postitembutton_iconstatus','=',1)
            ),
            array(
                'id' => 'pnewiconname',
                'type' => 'text',
                'title' => esc_html__('Icon Class Name', 'pointfindercoreelements') ,
                'desc' => esc_html__('Please use Fontawesome 5 Free Icon class name.', 'pointfindercoreelements') ,
                'default' => 'fas fa-plus',
                'required' => array('general_postitembutton_iconstatus','=',1)
            ) ,
            array(
                'id' => 'pnewiconsize',
                'type' => 'typography',
                'title' => esc_html__('Icon Size', 'pointfindercoreelements') ,
                'google' => false,
                'font-backup' => false,
                'font-family' => false,
                'font-style' => false,
                'font-weight' => false,
                'font-backup' => false,
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a i',
                    '#pfpostitemlinkmobile i'
                ) ,
                'units' => 'px',
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'subsets' => false,
                'default' => array(
                    'font-size' => '11px'
                ),
                'preview' => false,
                'required' => array('general_postitembutton_iconstatus','=',1)
            ),
            array(
                'id'             => 'general_postitembutton_innerpadding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array('px'),
                'compiler' => array(
                    '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '.wpf-header.pfshrink #pf-primary-nav .pfnavmenu #pfpostitemlink a',
                    '#pfpostitemlinkmobile'
                ) ,
                'units_extended' => 'false',
                'title'          => esc_html__( 'Inner Padding Option', 'pointfindercoreelements' ),
                'default'        => array(
                    'padding-top'    => '17px',
                    'padding-right'  => '20px',
                    'padding-bottom' => '17px',
                    'padding-left'   => '20px'
                )
            ),

            array(
                'id' => 'general_postitembutton_buttontext',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'pointfindercoreelements') ,
                'default' => esc_html__('Post New Point', 'pointfindercoreelements') ,
            ) ,

            array(
                'id'      => 'general_postitembutton_button_mtop',
                'type'    => 'spinner',
                'title'   => esc_html__( 'Button Top Margin (px)', 'pointfindercoreelements' ),
                'default' => '30',
                'min'     => '0',
                'step'    => '1',
                'max'     => '300',
                'compiler' => true
            ),

        )

    );

/**
*End : POST BUTTON STYLES
**/

Redux::setSections($opt_name,$sections);