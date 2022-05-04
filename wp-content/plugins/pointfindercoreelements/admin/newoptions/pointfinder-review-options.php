<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pfitemreviewsystem_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => '',
	'display_name'              => esc_html__('Point Finder Review System','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Review System Config','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Review System Config','pointfindercoreelements'),
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
	'page_slug'                 => '_pfrevsystemconf',
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

Redux::set_args( $opt_name, $args );


$sections = array();

/**
*START: REVIEW SYSTEM
**/
    $sections[] = array(
        'id' => 'setup11_reviewsystem',
        'title' => esc_html__('Review System', 'pointfindercoreelements') ,
        'icon' => 'el-icon-tasks',
        'fields' => array(
            array(
                'id' => 'setup1_help2_rw',
                'type' => 'info',
                'notice' => true,
                'style' => 'critical',
                'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements'),
                'desc' => esc_html__('Please configure these sections before you use theme. If you change configuration after using theme, data which is related to these sections will be lost.', 'pointfindercoreelements')
            ) ,

            array(
                'id' => 'setup1_help3_rw',
                'type' => 'info',
                'notice' => true,
                'style' => 'warning',
                'desc' => esc_html__('Activation & Deactivation will not cause any data loss.', 'pointfindercoreelements')
            ) ,
            array(
                'id' => 'setup11_reviewsystem_check',
                'type' => 'button_set',
                'title' => esc_html__('Review System', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ) ,
                "default" => 0
            ) ,
            array(
                'id' => 'setup11_reviewsystem_usertype',
                'type' => 'button_set',
                'title' => esc_html__('Registered Users', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ) ,
                "default" => 0,
                'desc' => esc_html__('Only registered user can review.', 'pointfindercoreelements'),
                'required' => array('setup11_reviewsystem_check','=','1') ,
            ) ,
            array(
                'id' => 'setup11_reviewsystem_flagfeature',
                'type' => 'button_set',
                'title' => esc_html__('Review Flag Feature', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ) ,
                "default" => 1,
                'desc' => esc_html__('Only registered user can flag a review.', 'pointfindercoreelements'),
                'required' => array('setup11_reviewsystem_check','=','1') ,
            ) ,
            array(
                'id' => 'setup11_reviewsystem_singlerev',
                'type' => 'button_set',
                'title' => esc_html__('Single Review', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                ) ,
                "default" => 1,
                'desc' => esc_html__('Users can send only one review per item.', 'pointfindercoreelements'),
                'required' => array('setup11_reviewsystem_check','=','1')
            ) ,
            array(
                'id' => 'setup11_reviewsystem_revstatus',
                'type' => 'button_set',
                'title' => esc_html__('New Submitted Review Status', 'pointfindercoreelements') ,
                'options' => array(
                        '1' => esc_html__('Publish Directly', 'pointfindercoreelements') ,
                        '0' => esc_html__('Pending for Approval', 'pointfindercoreelements')
                    ) ,
                "default" => 0,
                'required' => array('setup11_reviewsystem_check','=','1') ,
            ) ,
            array(
                'id'            => 'setup11_reviewsystem_revperpage',
                'type'          => 'slider',
                'title'         => esc_html__( 'Review Per Page', 'pointfindercoreelements' ),
                'desc'          => esc_html__( 'How many review want to show per page in item detail?', 'pointfindercoreelements' ),
                'default'       => 3,
                'min'           => 0,
                'step'          => 1,
                'max'           => 15,
                'display_value' => 'text',
                'required' => array('setup11_reviewsystem_check','=','1') ,
            ),
            array(
                'id' => 'setup11_reviewsystem_criterias',
                'type' => 'multi_text',
                'required' => array('setup11_reviewsystem_check','=','1') ,
                'title' => esc_html__('Review Criterias', 'pointfindercoreelements') ,
                'desc' => esc_html__('Please enter custom criterias here. Ex: Neigborhood', 'pointfindercoreelements')
            ) ,



        )
    );


    /**
    *Review Fields
    **/
    $sections[] = array(
        'id' => 'setup11_reviewsystemfields',
        'title' => esc_html__('Review Fields', 'pointfindercoreelements') ,
        'icon' => 'el-icon-wrench-alt',
        'fields' => array(
            array(
                'id' => 'setup1_help4_rw',
                'type' => 'info',
                'notice' => true,
                'style' => 'info',
                'desc' => esc_html__('You can edit review field by using below options.', 'pointfindercoreelements'),
            ) ,
            array(
                'id'        => 'setup11_reviewsystem_emailarea-start',
                'type'      => 'section',
                'title'     => esc_html__('Email Area', 'pointfindercoreelements'),
                'indent'    => true,
                'subtitle'  => esc_html__('Email address field options.', 'pointfindercoreelements'),
            ),
                array(
                    'id' => 'setup11_reviewsystem_emailarea',
                    'type' => 'button_set',
                    'title' => esc_html__('Email Address Field', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Show', 'pointfindercoreelements') ,
                        '0' => esc_html__('Hide', 'pointfindercoreelements')
                    ) ,
                    "default" => 1,
                ) ,
                array(
                    'id' => 'setup11_reviewsystem_emailarea_req',
                    'type' => 'button_set',
                    'title' => esc_html__('Email Address Status', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Required', 'pointfindercoreelements') ,
                        '0' => esc_html__('Optional', 'pointfindercoreelements')
                    ) ,
                    'default' => 0,
                    'required' => array('setup11_reviewsystem_emailarea','=','1')

                ) ,
            array(
                'id'        => 'setup11_reviewsystem_emailarea-end',
                'type'      => 'section',
                'indent'    => false,
            ),
            array(
                'id'        => 'setup11_reviewsystem_mesarea-start',
                'type'      => 'section',
                'title'     => esc_html__('Message Area', 'pointfindercoreelements'),
                'indent'    => true,
                'subtitle'  => esc_html__('Message field options.', 'pointfindercoreelements'),
            ),
                array(
                    'id' => 'setup11_reviewsystem_mesarea',
                    'type' => 'button_set',
                    'title' => esc_html__('Message Area Field', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Show', 'pointfindercoreelements') ,
                        '0' => esc_html__('Hide', 'pointfindercoreelements')
                    ) ,
                    "default" => 1,
                ) ,
                array(
                    'id' => 'setup11_reviewsystem_mesarea_req',
                    'type' => 'button_set',
                    'title' => esc_html__('Message Area Status', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Required', 'pointfindercoreelements') ,
                        '0' => esc_html__('Optional', 'pointfindercoreelements')
                    ) ,
                    'default' => 0,
                    'required' => array('setup11_reviewsystem_mesarea','=','1')
                ) ,
            array(
                'id'        => 'setup11_reviewsystem_mesarea-end',
                'type'      => 'section',
                'indent'    => false,
            ),

        )
    );

    /**
    *Review Stars
    **/
    $sections[] = array(
        'id' => 'setup16_reviewstars',
        'title' => esc_html__('Review Band', 'pointfindercoreelements') ,
        'icon' => 'el-icon-brush',
        'fields' => array(
            array(
                'id' => 'setup16_reviewstars_bg',
                'type' => 'color_rgba',
                'title' => esc_html__('Info Window Review Band BG Color', 'pointfindercoreelements') ,
                'default' => array(
                    'color' => '#000000',
                    'alpha' => '0.5'
                ) ,
                'compiler' => array('.wpfinfowindow .pfrevstars-wrapper-review','.wpfinfowindow2 .pfrevstars-wrapper-review') ,
                'mode' => 'background',
                'validate' => 'colorrgba',
                'transparent' => false,
            ) ,
            array(
                'id' => 'setup16_reviewstars_text3',
                'type' => 'color',
                'transparent' => false,
                'compiler' => array(
                    '.wpfinfowindow .pflist-imagecontainer .pfrevstars-wrapper-review i',
                    '.wpfinfowindow  .pfrevstars-wrapper-review .pfrevstars-review',
                    '.wpfinfowindow2 .pflist-imagecontainer .pfrevstars-wrapper-review i',
                    '.wpfinfowindow2  .pfrevstars-wrapper-review .pfrevstars-review'
                    ) ,
                'title' => esc_html__('Text/Star Icon Color(For Info Window)', 'pointfindercoreelements') ,
                'default' => '#FFB400',
                'validate' => 'color'
            ) ,
            array(
                'id' => 'setup16_reviewstars_text',
                'type' => 'color',
                'transparent' => false,
                'compiler' => array('.pflist-imagecontainer .pfrevstars-wrapper-review i','.pfrevstars-wrapper-review .pfrevstars-review') ,
                'title' => esc_html__('Text/Star Icon Color', 'pointfindercoreelements') ,
                'default' => '#FFB400',
                'validate' => 'color'
            ) ,

            array(
                'id' => 'setup16_reviewstars_text2',
                'type' => 'color',
                'transparent' => false,
                'compiler' => array(
                    '.pfrevstars-wrapper-review .pfrevstars-review.pfrevstars-reviewbl',
                    '.pflist-imagecontainer .pfrevstars-wrapper-review .pfrevstars-reviewbl i'
                ) ,
                'title' => esc_html__('Text/Star Icon Color(Empty Stars)', 'pointfindercoreelements') ,
                'default' => '#9E9E9E',
                'validate' => 'color'
            ) ,

            array(
                'id' => 'setup22_searchresults_hide_re',
                'type' => 'button_set',
                'title' => esc_html__('Review Band Status', 'pointfindercoreelements') ,
                'subtitle' => esc_html__('This status for grid system and info window system.', 'pointfindercoreelements') ,
                'default' => 1,
                'options' => array(
                    '0' => esc_html__('Show', 'pointfindercoreelements') ,
                    '1' => esc_html__('Hide', 'pointfindercoreelements')
                )
            ),

            array(
                'id' => 'setup16_reviewstars_nrtext',
                'type' => 'button_set',
                'title' => esc_html__('Empty Reviews', 'pointfindercoreelements') ,
                'default' => 0,
                'options' => array(
                    '0' => esc_html__('Show empty stars', 'pointfindercoreelements') ,
                    '1' => esc_html__('Show nothing', 'pointfindercoreelements')
                )
            )
        )
    );
/**
*End: REVIEW SYSTEM
**/

Redux::set_sections($opt_name,$sections);
