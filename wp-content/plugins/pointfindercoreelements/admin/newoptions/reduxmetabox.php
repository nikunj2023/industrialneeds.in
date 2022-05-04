<?php 
if (!trait_exists('PointFinderReduxMetaboxes')) {

    /**
     * Redux Metaboxes
     */
    trait PointFinderReduxMetaboxes
    {
        

        function pf_redux_add_metaboxes($metaboxes) {
            
            $item_post_type_name = $this->PFSAIssetControl('setup3_pointposttype_pt1','','pfitemfinder');
            $agents_post_type_name = $this->PFSAIssetControl('setup3_pointposttype_pt8','','agents');

            $setup42_itempagedetails_configuration = $this->PFSAIssetControl('setup42_itempagedetails_configuration','','');
            $setup42_itempagedetails_claim_status = $this->PFSAIssetControl('setup42_itempagedetails_claim_status','',0);

            $setup4_membersettings_paymentsystem = $this->PFSAIssetControl('setup4_membersettings_paymentsystem','','1');
            
            if (class_exists('ACF', false)) {
                $loadacf = true;
            }else{
                $loadacf = false;
            }
        /**
        *START:PAGE METABOXES
        **/
            

            if (!$loadacf) {

                $boxSections[] = array(
                    'title' => 'Header Bar',
                    'icon' => 'el-icon-cogs',
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_page_titlebararea',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Header Bar Area', 'pointfindercoreelements' ),
                            'desc'    => esc_html__( 'If it is enabled, you can edit page header bar area by using below options.', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                            ),
                            'default'  => 0
                        ),

                        array(
                            'id'       => 'webbupointfinder_page_defaultheaderbararea',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Default Header Bar', 'pointfindercoreelements' ),
                            'desc'    => esc_html__( 'If it is enabled, all variables will load from default header bar settings.', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                            ),
                            'default'  => 0,
                            'required' => array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                        ),
                        array(
                            'id' => 'webbupointfinder_page_shadowopt',
                            'type' => 'button_set',
                            'title' => esc_html__('Header Bar Shadow', 'pointfindercoreelements') ,
                            'options' => array( 
                                0 => esc_html__('Disabled', 'pointfindercoreelements'),
                                1 => esc_html__('Shadow 1', 'pointfindercoreelements'),
                                2 => esc_html__('Shadow 2', 'pointfindercoreelements'),
                                ),
                            'default' => 0,
                            'required' => array(
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                            ),
                        ) ,
                        array(
                            'id'       => 'webbupointfinder_page_titlebarareatext',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Header Bar Options', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Show', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Hide', 'pointfindercoreelements' ),
                            ),
                            'default'  => 1,
                            'required' => array(
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                            ),
                        ),
                        array(
                            'id'       => 'webbupointfinder_page_titlebarareatext-start',
                            'type'     => 'section',
                            'indent'   => true,
                            'required' => array(
                                array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                )
                        ),

                            array(
                                'id'       => 'webbupointfinder_page_titlebarcustomtext_color',
                                'type'     => 'color',
                                'title'    => esc_html__( 'Custom Text Color', 'pointfindercoreelements' ),
                                'validate' => 'color',
                                'transparent' => false,
                                'required' => array(
                                    array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                    array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                    array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                    )

                            ),
                            array(
                                'id'       => 'webbupointfinder_page_titlebarcustomtext_bgcolor',
                                'type'     => 'color',
                                'transparent' => false,
                                'validate' => 'color',
                                'title'    => esc_html__( 'Custom Text Background Color', 'pointfindercoreelements' ),
                                'required' => array(
                                    array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                    array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                    array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                    )

                            ),
                            array(
                                'id'            => 'webbupointfinder_page_titlebarcustomtext_bgcolorop',
                                'type'          => 'slider',
                                'title'         => esc_html__( 'Custom Text Background Color Opacity', 'pointfindercoreelements' ),
                                'default'       => 0,
                                'min'           => 0,
                                'step'          => .1,
                                'max'           => 1,
                                'resolution'    => 0.1,
                                'display_value' => 'text',
                                'required' => array(
                                    array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                    array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                    array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                    )
                            ),

                            array(
                                'id'       => 'webbupointfinder_page_titlebarcustomtext',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Custom Text', 'pointfindercoreelements' ),
                                'required' => array(
                                    array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                    array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                    array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                    )

                            ),

                            array(
                                'id'       => 'webbupointfinder_page_titlebarcustomsubtext',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Custom Sub Text', 'pointfindercoreelements' ),
                                'required' => array(
                                    array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                    array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                    array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                    )

                            ),
                        array(
                            'id'       => 'webbupointfinder_page_titlebarareatext-end',
                            'type'     => 'section',
                            'indent'   => false, 
                            'required' => array(
                                array( 'webbupointfinder_page_titlebarareatext', "=", 1 ),
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                                )
                        ),
                        array(
                            'id'            => 'webbupointfinder_page_titlebarcustomheight',
                            'type'          => 'slider',
                            'title'         => esc_html__( 'Custom Height(px)', 'pointfindercoreelements' ),
                            'default'       => 130,
                            'min'           => 1,
                            'step'          => 1,
                            'max'           => 500,
                            'display_value' => 'label',
                            'required' => array(
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                            ),
                        ),

                        array(
                            'id'       => 'webbupointfinder_page_titlebarcustombg',
                            'type'     => 'background',
                            'title'    => esc_html__( 'Custom Background Image', 'pointfindercoreelements' ),
                            'required' => array(
                                array( 'webbupointfinder_page_titlebararea', "=", 1 ),
                                array( 'webbupointfinder_page_defaultheaderbararea', "=", 0 )
                            ),
                        ),
                    )
                );

                $boxSections[] = array(
                    'title' => 'Transparent Menu',
                    'icon' => 'el-icon-cogs',
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_page_transparent',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Transparent Header', 'pointfindercoreelements' ),
                            'desc'    => esc_html__( 'If it is enabled, menu bar will be transparent background.', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                            ),
                            'default'  => 0
                        ),
                        array(
                            'id'       => 'webbupointfinder_page_logoadditional',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Show Additional Logo', 'pointfindercoreelements' ),
                            'desc'    => esc_html__( 'If it is enabled, system will use additional logo instead of default one.', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                            ),
                            'default'  => 0,
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ),

                        array(
                            'id' => 'webbupointfinder_page_menulinecolor',
                            'type' => 'color',
                            'mode' => 'background',
                            'transparent' => false,
                            'title' => esc_html__('Main Menu: Active Line Color', 'pointfindercoreelements') ,
                            'desc' => esc_html__('Colored line at bottom of the menu links.', 'pointfindercoreelements'),
                            'default' => '#a32222',
                            'validate' => 'color',
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ) ,
                        array(
                            'id' => 'webbupointfinder_page_menucolor',
                            'type' => 'link_color',
                            'title' => esc_html__('Main Menu: Menu Link Color', 'pointfindercoreelements') ,
                            'active' => false,
                            'default' => array(
                                'regular' => '#444444',
                                'hover' => '#a32221'
                            ) ,
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ) ,
                        array(
                            'id'       => 'webbupointfinder_page_menutextsize',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Main Menu: Bold Text', 'pointfindercoreelements' ),
                            'desc'    => esc_html__( 'If it is enabled, main menu text will be bolder', 'pointfindercoreelements' ),
                            'options'  => array(
                                '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                                '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                            ),
                            'default'  => 0,
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ),
                        array(
                            'id'        => 'webbupointfinder_page_headerbarsettings_bgcolor',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Menu Bar Background', 'pointfindercoreelements'),
                            'default'   => array('color' => '#000000', 'alpha' => '0.2'),
                            'mode'      => 'background',
                            'transparent' => true,
                            'validate'  => 'colorrgba',
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ),
                        array(
                            'id'        => 'webbupointfinder_page_headerbarsettings_bgcolor2',
                            'type'      => 'color_rgba',
                            'title'     => esc_html__('Menu Bar Background', 'pointfindercoreelements'),
                            'subtitle'     => esc_html__('Sticky Menu', 'pointfindercoreelements'),
                            'default'   => array('color' => '#000000', 'alpha' => '0.7'),
                            'mode'      => 'background',
                            'transparent' => true,
                            'validate'  => 'colorrgba',
                            'required' => array( 'webbupointfinder_page_transparent', "=", 1 ),
                        ),

                    )
                );

          
            
                $boxSections[] = array(
                    'title' => 'Footer Row',
                    'icon' => 'el-icon-cogs',
                    'fields' => array(  
                        array(
                            'id' => 'webbupointfinder_gbf_status',
                            'type' => 'button_set',
                            'title' => esc_html__('Custom Footer', 'pointfindercoreelements') ,
                            'options' => array(
                                '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                                '0' => esc_html__('Disable', 'pointfindercoreelements'),
                            ) ,
                            'default' => 0,
                        ),
                        array(
                            'id' => 'webbupointfinder_gbf_cols',
                            'type' => 'button_set',
                            'title' => esc_html__('Column Number', 'pointfindercoreelements') ,
                            'options' => array(
                                '1' => esc_html__('1', 'pointfindercoreelements') ,
                                '2' => esc_html__('2', 'pointfindercoreelements'),
                                '3' => esc_html__('3', 'pointfindercoreelements'),
                                '4' => esc_html__('4', 'pointfindercoreelements'),
                            ) ,
                            'default' => 4,
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_sidebar1',
                            'type'     => 'select',
                            'title'    => esc_html__('1st Column Widget Area', 'pointfindercoreelements'),
                            'data'     => 'sidebars',
                            'default'  => '',
                            'required' => array(array( 'webbupointfinder_gbf_cols', '>=', 1 ),array('webbupointfinder_gbf_status','=',1))
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_sidebar2',
                            'type'     => 'select',
                            'title'    => esc_html__('2nd Column Widget Area', 'pointfindercoreelements'),
                            'data'     => 'sidebars',
                            'default'  => '',
                            'required' => array(array( 'webbupointfinder_gbf_cols', '>=', 2 ),array('webbupointfinder_gbf_status','=',1))
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_sidebar3',
                            'type'     => 'select',
                            'title'    => esc_html__('3rd Column Widget Area', 'pointfindercoreelements'),
                            'data'     => 'sidebars',
                            'default'  => '',
                            'required' => array(array( 'webbupointfinder_gbf_cols', '>=', 3 ),array('webbupointfinder_gbf_status','=',1))
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_sidebar4',
                            'type'     => 'select',
                            'title'    => esc_html__('4th Column Widget Area', 'pointfindercoreelements'),
                            'data'     => 'sidebars',
                            'default'  => '',
                            'required' => array(array( 'webbupointfinder_gbf_cols', '>=', 4 ),array('webbupointfinder_gbf_status','=',1))
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_bgopt2',
                            'type'     => 'background',
                            'output'   => array( '.wpf-footer-row-move.wpf-footer-row-movepg:before' ),
                            'title'    => esc_html__('Background (Before Row)', 'pointfindercoreelements'),
                            'default'   => '#FFFFFF',
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'             => 'webbupointfinder_gbf_bgopt2w',
                            'type'           => 'dimensions',
                            'units'          => array( 'em', 'px', '%' ),
                            'units_extended' => 'true',
                            'output'   => array( '.wpf-footer-row-move.wpf-footer-row-movepg:before' ),
                            'title'          => esc_html__('Background (Before Row) Height', 'pointfindercoreelements'),
                            'width'         => false,
                            'default'        => array(
                                'height' => 0,
                            ),
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'             => 'webbupointfinder_gbf_bgopt2m',
                            'type'           => 'spacing',
                            'mode'           => 'margin',
                            'output'   => array( '.wpf-footer-row-move.wpf-footer-row-movepg:before' ),
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
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_bgopt',
                            'type'     => 'background',
                            'output'   => array( '.pointfinderexfooterclassxpg' ),
                            'title'    => esc_html__('Background', 'pointfindercoreelements'),
                            'default'   => '#FFFFFF',
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'        => 'webbupointfinder_gbf_textcolor1',
                            'type'      => 'color',
                            'output'   => array( '.pointfinderexfooterclasspg'),
                            'title'     => esc_html__('Text Color', 'pointfindercoreelements'),
                            'default' => '#000000',
                            'transparent'   => false,
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'        => 'webbupointfinder_gbf_textcolor2',
                            'type'      => 'link_color',
                            'output'   => array('.pointfinderexfooterclasspg a' ),
                            'title'     => esc_html__('Link Color', 'pointfindercoreelements'),
                            'active' => false,
                            'default' => array(
                                'regular' => '#000000',
                                'hover' => '#B32E2E'
                            ),
                            'transparent'   => false,
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'             => 'webbupointfinder_gbf_spacing',
                            'type'           => 'spacing',
                            'mode'           => 'padding',
                            'output'   => array( '.pointfinderexfooterclasspg' ),
                            'all'            => false,
                            'left'            => false,
                            'right'            => false,
                            'units'          => array( 'em', 'px', '%' ),
                            'units_extended' => 'true',
                            'title'          => esc_html__( 'Padding', 'pointfindercoreelements' ),
                            'default'        => array(
                                'padding-top'    => '50px',
                                'padding-bottom' => '50px',
                            ),
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'             => 'webbupointfinder_gbf_spacing2',
                            'type'           => 'spacing',
                            'mode'           => 'margin',
                            'output'   => array( '.pointfinderexfooterclassxpg' ),
                            'all'            => false,
                            'left'            => false,
                            'right'            => false,
                            'units'          => array( 'em', 'px', '%' ),
                            'units_extended' => 'true',
                            'title'          => esc_html__( 'Margin', 'pointfindercoreelements' ),
                            'default'        => array(
                                'padding-top'    => '0',
                                'padding-bottom' => '0',
                            ),
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),
                        array(
                            'id'       => 'webbupointfinder_gbf_border',
                            'type'     => 'border',
                            'title'    => esc_html__( 'Border', 'pointfindercoreelements' ),
                            'output'   => array( '.pointfinderexfooterclassxpg' ),
                            'all'      => false,
                            'left'            => false,
                            'right'            => false,
                            'default'  => array(
                                'border-color'  => 'transparent',
                                'border-style'  => 'solid',
                                'border-top'    => '0',
                                'border-bottom' => '0',
                            ),
                            'required' => array('webbupointfinder_gbf_status','=',1)
                        ),

                    )
                );

            

                $metaboxes = array();

                $metaboxes[] = array(
                    'id' => 'pf_page_settings',
                    'title' => esc_html__('Page Options','pointfindercoreelements'),
                    'post_types' => array('page'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'sidebar' => false, 
                    'sections' => $boxSections
                );
            }

            
            if (!$loadacf) {
                $page_options = array();
                $page_options[] = array(
                    //'title'         => esc_html__('General Settings', 'pointfindercoreelements'),
                    'icon_class'    => 'icon-large',
                    'icon'          => 'el-icon-home',
                    'fields'        => array(
                        array(
                            'id' => 'webbupointfinder_page_sidebar',
                            'title' => esc_html__( 'Sidebar', 'pointfindercoreelements' ),
                            'desc' => esc_html__( 'Please select the sidebar you would like to display on this blog page (Only for blog pages.). Note: You must first create the sidebar under PF Options > Sidebar Generator.', 'pointfindercoreelements' ),
                            'type' => 'select',
                            'data' => 'sidebars',
                            'default' => 'None',
                        ),
                    ),
                );

                $metaboxes[] = array(
                    'id'            => 'pf-page-options',
                    'title'         => esc_html__( 'Blog Sidebar', 'pointfindercoreelements' ),
                    'post_types'    => array( 'page' ),
                    'position'      => 'side', 
                    'priority'      => 'low', 
                    'sidebar'       => true,
                    'sections'      => $page_options,
                );
            }
            

        /**
        *END:PAGE METABOXES
        **/ 
            

        /**
        *START:ITEM METABOXES
        **/ 


           


            /**
            *FEATURED POINT
            **/
            
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_item_featuredmarker',
                            'type'     => 'button_set',
                            'title'    => '',
                            'default'  => '0',
                            'options'  => array(1=>esc_html__('Enable','pointfindercoreelements'),0=>esc_html__('Disable','pointfindercoreelements'))
                        ),
                    )
                );

                $metaboxes[] = array(
                    'id' => 'pf_item_featuredpoint',
                    'title' => esc_html__('Featured Point(Optional)','pointfindercoreelements'),
                    'post_types' => array($item_post_type_name),
                    'position' => 'side', 
                    'priority' => 'high', 
                    'sections' => $boxSections
                );

                
                if ($setup42_itempagedetails_claim_status == 1) {
                    $boxSections = array();
                    $boxSections[] = array(
                        'fields' => array(  
                            array(
                                'id'       => 'webbupointfinder_item_verified',
                                'type'     => 'button_set',
                                'title'    => '',
                                'default'  => '0',
                                'options'  => array(1=>esc_html__('Enable','pointfindercoreelements'),0=>esc_html__('Disable','pointfindercoreelements'))
                            ),
                        )
                    );

                    $metaboxes[] = array(
                        'id' => 'pf_item_verifiedpoint',
                        'title' => esc_html__('Verified Point(Optional)','pointfindercoreelements'),
                        'post_types' => array($item_post_type_name),
                        'position' => 'side', 
                        'priority' => 'high', 
                        'sections' => $boxSections
                    );
                }
           
                


            /**
            *FEATURED VIDEO
            **/
          
                $pf_vide_status = (isset($setup42_itempagedetails_configuration['video']['status']))?$setup42_itempagedetails_configuration['video']['status']:0;
                if( $pf_vide_status == 1){
                    $boxSections = array();
                    $boxSections[] = array(
                        'fields' => array(  
                            array(
                                'id'       => 'webbupointfinder_item_video',
                                'type'     => 'text',
                                'desc' => esc_html__( 'Please write video url.', 'pointfindercoreelements' ),
                                'class'  => 'pfwidthfix'
                            ),
                        )
                    );


                    $metaboxes[] = array(
                        'id' => 'pf_item_featuredvideo',
                        'title' => esc_html__('Featured Video','pointfindercoreelements'),
                        'post_types' => array($item_post_type_name),
                        'position' => 'side', 
                        'priority' => 'low', 
                        'sections' => $boxSections
                    );
                }
         


            $metaboxes = apply_filters( 'pointfinder_listingdetail_metabox_filter', $metaboxes );


            /**
            *SLIDER IMAGE
            **/
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_item_sliderimage',
                            'type'     => 'media',
                            'desc' => esc_html__('Recommended size width: 2000px and height: 700 px. (Better for large screens.)','pointfindercoreelements'),
                        ),
                    )
                );


                $metaboxes[] = array(
                    'id' => 'pf_item_sliderimage',
                    'title' => esc_html__('Slider Image','pointfindercoreelements'),
                    'post_types' => array($item_post_type_name),
                    'position' => 'side', 
                    'priority' => 'low', 
                    'sections' => $boxSections
                );
            
            /**
            *SLIDER IMAGE
            **/


            /**
            *HEADER IMAGE
            **/
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_item_headerimage',
                            'type'     => 'media',
                            'desc' => esc_html__('Recommended size width: 2000px and height: 485 px. (Better for large screens.)','pointfindercoreelements'),
                        ),
                    )
                );


                $metaboxes[] = array(
                    'id' => 'pf_item_headerimage',
                    'title' => esc_html__('Image for Header','pointfindercoreelements'),
                    'post_types' => array($item_post_type_name),
                    'position' => 'side', 
                    'priority' => 'low', 
                    'sections' => $boxSections
                );
      
            /**
            *HEADER IMAGE
            **/



           
            /**
            *POINT OPTIONS
            **/
                $boxSections = array();
                $boxSections[] = array(
                    'title' => '',
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_item_point_type',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Point Type', 'pointfindercoreelements' ),
                            'desc'     => esc_html__( 'Please choose a point type for this item.', 'pointfindercoreelements' ),
                            'options'  => array(
                                '3' => esc_html__( 'None (Use Category)', 'pointfindercoreelements' ),
                                '1' => esc_html__( 'Custom Image', 'pointfindercoreelements' ),
                                '2' => esc_html__( 'Predefined Icon', 'pointfindercoreelements' )
                            ),
                            'default'  => '3',
                        ),
                        array(
                            'id'       => 'webbupointfinder_item_point_type-start',
                            'type'     => 'section',
                            'indent'   => true, 
                            'required' => array( 'webbupointfinder_item_point_type', "=", '1' ),
                        ),
                            array(
                                'id'       => 'webbupointfinder_item_custom_marker',
                                'type'     => 'media',
                                'title'    => esc_html__( 'Point Icon', 'pointfindercoreelements' ),
                                'desc'     => esc_html__( 'Upload custom point icon. Default icon size: 84x101 px', 'pointfindercoreelements' ),
                                'required' => array( 'webbupointfinder_item_point_type', "=", '1' ),
                            ),
                        array(
                            'id'       => 'webbupointfinder_item_point_type-end',
                            'type'     => 'section',
                            'indent'   => false, 
                            'required' => array( 'webbupointfinder_item_point_type', "=", '1' ),
                        ),


                        array(
                            'id'       => 'webbupointfinder_item_point_type2-start',
                            'type'     => 'section',
                            'indent'   => true, 
                            'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                        ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_icontype',
                                'type'     => 'button_set',
                                'title'    => esc_html__( 'Point Icon Type', 'pointfindercoreelements' ),
                                'options'  => array(
                                    '1' => esc_html__( 'Round', 'pointfindercoreelements' ),
                                    '2' => esc_html__( 'Square', 'pointfindercoreelements' ),
                                    '3' => esc_html__( 'Dot', 'pointfindercoreelements' ),
                                ),
                                'default' => 1,
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_iconsize',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Point Icon Type', 'pointfindercoreelements' ),
                                'options'  => array(
                                    'small' => esc_html__( 'Small', 'pointfindercoreelements' ),
                                    'middle' => esc_html__( 'Middle', 'pointfindercoreelements' ),
                                    'large' => esc_html__( 'Large', 'pointfindercoreelements' ),
                                    'xlarge' => esc_html__( 'X-Large', 'pointfindercoreelements' ),
                                ),
                                'default' => 'middle',
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_bgcolor',
                                'type'     => 'color',
                                'title'    => esc_html__( 'Point Color', 'pointfindercoreelements' ),
                                'validate'     => 'color',
                                'default' => '#b00000',
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_bgcolorinner',
                                'type'     => 'color',
                                'title'    => esc_html__( 'Point Inner Color', 'pointfindercoreelements' ),
                                'validate'     => 'color',
                                'default' => '#ffffff',
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_iconcolor',
                                'type'     => 'color',
                                'title'    => esc_html__( 'Point Icon Color', 'pointfindercoreelements' ),
                                'validate'     => 'color',
                                'default' => '#b00000',
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                            array(
                                'id'       => 'webbupointfinder_item_cssmarker_iconname',
                                'type'     => 'extension_custom_icon',
                                'title'    => esc_html__( 'Point Icon', 'pointfindercoreelements' ),
                                'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                            ),
                        array(
                            'id'       => 'webbupointfinder_item_point_type2-end',
                            'type'     => 'section',
                            'indent'   => false, 
                            'required' => array( 'webbupointfinder_item_point_type', "=", '2' ),
                        ),
                    )
                );


                $metaboxes[] = array(
                    'id' => 'pf_item_settings',
                    'title' => esc_html__('Point Options (Optional)','pointfindercoreelements'),
                    'post_types' => array($item_post_type_name),
                    'position' => 'side',
                    'priority' => 'low',
                    'sections' => $boxSections
                );

            
                $setup3_pointposttype_pt9 = $this->PFSAIssetControl('setup3_pointposttype_pt9','','PF Agent');
                $setup3_pointposttype_pt6_status = $this->PFSAIssetControl('setup3_pointposttype_pt6_status','','1');
                if($setup3_pointposttype_pt6_status == 1){
                /**
                *AGENTS LIST
                **/

                    $boxSections = array();
                    $boxSections[] = array(
                        'fields' => array(  
                            array(
                                'id'       => 'webbupointfinder_item_agents',
                                'type'     => 'select',
                                'data'     => 'posts',
                                'args'     => array('post_type'=>$agents_post_type_name,'posts_per_page'=>-1),
                                'multi'    => false,
                                'desc'     => esc_html__( 'You can select an agent for this item.', 'pointfindercoreelements' ),
                            ),
                        )
                    );


                    $metaboxes[] = array(
                        'id' => 'pf_item_agents',
                        'title' => $setup3_pointposttype_pt9,
                        'post_types' => array($item_post_type_name),
                        'position' => 'side', 
                        'priority' => 'low', 
                        'sections' => $boxSections
                    );
                }
          
            
            /**
            *STREETVIEW SELECTOR
            **/
                $pf_streetview_status = (isset($setup42_itempagedetails_configuration['streetview']['status']))?$setup42_itempagedetails_configuration['streetview']['status']:0;
           
                if( $pf_streetview_status == 1 ){
                    $boxSections = array();
                    $boxSections[] = array(
                        'fields' => array(  
                            array(
                                'id'       => 'webbupointfinder_item_streetview',
                                'type'     => 'extension_streetview'
                            )
                        )
                    );

                    $metaboxes[] = array(
                        'id' => 'pf_item_streetview',
                        'title' => esc_html__('Streetview Configuration','pointfindercoreelements'),
                        'post_types' => array($item_post_type_name),
                        'position' => 'normal', 
                        'priority' => 'high', 
                        'sections' => $boxSections
                    );
                }
             


            /**
            *CUSTOM TABS
            **/
            
            
            /* Custom Tab 1*/
                if(array_key_exists('customtab1', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab1']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox1',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox1',
                            'title' => $setup42_itempagedetails_configuration['customtab1']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 1*/


            /* Custom Tab 2*/
                if(array_key_exists('customtab2', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab2']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox2',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox2',
                            'title' => $setup42_itempagedetails_configuration['customtab2']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 2*/


            /* Custom Tab 3*/
                if(array_key_exists('customtab3', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab3']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox3',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox3',
                            'title' => $setup42_itempagedetails_configuration['customtab3']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 3*/

            /* Custom Tab 4*/
                if(array_key_exists('customtab4', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab4']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox4',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox4',
                            'title' => $setup42_itempagedetails_configuration['customtab4']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 4*/

            /* Custom Tab 5*/
                if(array_key_exists('customtab5', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab5']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox5',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox5',
                            'title' => $setup42_itempagedetails_configuration['customtab5']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 5*/

            /* Custom Tab 6*/
                if(array_key_exists('customtab6', $setup42_itempagedetails_configuration)){
                    if ($setup42_itempagedetails_configuration['customtab6']['status'] == 1) {
                        $boxSections = array();
                    
                        $boxSections[] = array(
                            'fields' => array(  
                                array(
                                    'id'       => 'webbupointfinder_item_custombox6',
                                    'type'     => 'editor'
                                )
                            )
                        );


                        $metaboxes[] = array(
                            'id' => 'pf_item_custombox6',
                            'title' => $setup42_itempagedetails_configuration['customtab6']['title'],
                            'post_types' => array($item_post_type_name),
                            'position' => 'normal', 
                            'priority' => 'default', 
                            'sections' => $boxSections
                        );
                    }
                }
            /*Custom Tab 6*/

            /* Contact enable / disable */
            
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                            'id'       => 'webbupointfinder_item_cstatus',
                            'type'     => 'button_set',
                            'title'    => '',
                            'default'  => 1,
                            'desc' => esc_html__('This option created to hide contact section on the listing detail page.','pointfindercoreelements'),
                            'options'  => array(1=>esc_html__('Show','pointfindercoreelements'),0=>esc_html__('Hide','pointfindercoreelements'))
                        ),
                    )
                );

                $metaboxes[] = array(
                    'id' => 'pf_item_contacted',
                    'title' => esc_html__('Contact Section','pointfindercoreelements'),
                    'post_types' => array($item_post_type_name),
                    'position' => 'side', 
                    'priority' => 'low', 
                    'sections' => $boxSections
                );
           
        /**
        *END:ITEM METABOXES
        **/


        /**
        *START:AGENTS METABOXES
        **/ 
            $boxSections = array();
            $boxSections[] = array(
                'fields' => array(  
                 
                    array(
                            'title'  => esc_html__( 'Email Address', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_email",
                            'desc'  => esc_html__( 'This email address will contact email for sending forms.', 'pointfindercoreelements' ),
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Web Address', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_web",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Mobile Number', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_mobile",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Office Number', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_tel",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Fax Number', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_fax",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Facebook', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_face",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Twitter', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_twitter",
                            'desc'  => '',
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'LinkedIn', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_linkedin",
                            'desc'  => esc_html__( 'Please leave Linkedin empty to see Intagram', 'pointfindercoreelements' ),
                            'type'  => 'text',
                        ),
                    array(
                            'title'  => esc_html__( 'Instagram', 'pointfindercoreelements' ),
                            'id'    => "webbupointfinder_agent_instag",
                            'desc'  => '',
                            'type'  => 'text',
                        )
                    
                )
            );


            $metaboxes[] = array(
                'id' => 'pf_agents_general',
                'title' => esc_html__('Agent Information','pointfindercoreelements'),
                'post_types' => array($agents_post_type_name),
                'position' => 'normal', 
                'priority' => 'high', 
                'sections' => $boxSections
            );
           

        /**
        *END:AGENTS METABOXES
        **/

        if($setup4_membersettings_paymentsystem == 2){

            /**
            *START:MEMBERSHIP METABOXES
            **/ 
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                                'title'  => esc_html__( 'Package Description', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_description",
                                'desc'  => '',
                                'type'  => 'textarea',
                                'validate' => 'no_html',
                                'default'  => esc_html__( 'No HTML is allowed in here.', 'pointfindercoreelements' )
                            ),
                        array(
                                'title'  => esc_html__( 'Billing Time Unit', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_billing_time_unit",
                                'desc'  => esc_html__( 'Billing time range unit.', 'pointfindercoreelements' ),
                                'type'  => 'button_set',
                                'options'  => array( 'yearly' => esc_html__( 'Yearly', 'pointfindercoreelements' ), 'monthly' => esc_html__( 'Monthly', 'pointfindercoreelements' ),'daily' => esc_html__( 'Daily', 'pointfindercoreelements' ) ),
                            ),
                        array(
                                'title'  => esc_html__( 'Billing Period', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_billing_period",
                                'desc'  => esc_html__( 'Billing every x unit. IMPORTANT: Please enter max. 365 for day limit, max. 1 for year limit and max 12 for month limit. If you are using recurring payments. Because Paypal does not accept more than 1 year in the recurring payment option.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'Trial Period Permission', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_trial",
                                'desc'  => esc_html__( 'You can use a trial period for this package. Important: You can not use trial period with free packages.', 'pointfindercoreelements' ),
                                'type'  => 'button_set',
                                'options'  => array( '1' => esc_html__( 'Yes', 'pointfindercoreelements' ), '0' => esc_html__( 'No', 'pointfindercoreelements' )),
                            ),
                        array(
                                'title'  => esc_html__( 'Trial Period', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_trial_period",
                                'desc'  => esc_html__( 'Trial period for x unit.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'How many items are included?', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_itemnumber",
                                'desc'  => esc_html__( 'Type -1 for unlimited items.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'How many featured item are included?', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_fitemnumber",
                                'desc'  => esc_html__( 'Type 0 for does not permit featured items', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'How many images can upload?', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_images",
                                'desc'  => esc_html__( 'This limit for images per item.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'Price of Package', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_price",
                                'desc'  => esc_html__( 'Write 0 for free.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'Frontend Visibility', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_mp_showhide",
                                'desc'  => esc_html__( 'If you hide this package, you will not see in frontend site.', 'pointfindercoreelements' ),
                                'type'  => 'button_set',
                                'options'  => array( '1' => esc_html__( 'Show', 'pointfindercoreelements' ), '2' => esc_html__( 'Hide', 'pointfindercoreelements' ))
                            )
                        
                    )
                );


                $metaboxes[] = array(
                    'id' => 'pf_membership_general',
                    'title' => esc_html__('Membership Package Details','pointfindercoreelements'),
                    'post_types' => array('pfmembershippacks'),
                    'position' => 'normal', 
                    'priority' => 'high', 
                    'sections' => $boxSections
                );
               

            /**
            *END:MEMBERSHIP METABOXES
            **/
        }else{
            /**
            *START:PPP METABOXES
            **/ 
                $boxSections = array();
                $boxSections[] = array(
                    'fields' => array(  
                        array(
                                'title'  => esc_html__( 'Billing Period', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_lp_billing_period",
                                'desc'  => __( 'Billing for every x days. <br><strong>IMPORTANT:</strong> Recurring payments not support more than 365 days.', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'Price of Package', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_lp_price",
                                'desc'  => __( 'Write 0 for free.<br/>Note: For price currency settings - Options Panel > Frontend Upload System > Paypal Settings', 'pointfindercoreelements' ),
                                'type'  => 'text',
                                'validate' => 'numeric'
                            ),
                        array(
                                'title'  => esc_html__( 'Frontend Visibility', 'pointfindercoreelements' ),
                                'id'    => "webbupointfinder_lp_showhide",
                                'desc'  => esc_html__( 'If you hide this package, you will not see in frontend site.', 'pointfindercoreelements' ),
                                'type'  => 'button_set',
                                'default' => '1',
                                'options'  => array( '1' => esc_html__( 'Show', 'pointfindercoreelements' ), '2' => esc_html__( 'Hide', 'pointfindercoreelements' ))
                            )
                    )
                );

                $boxSections = apply_filters( 'pointfinder_special_boxsection_lp', $boxSections );
                $metaboxes[] = array(
                    'id' => 'pf_ppp_general',
                    'title' => esc_html__('Listing Package Details','pointfindercoreelements'),
                    'post_types' => array('pflistingpacks'),
                    'position' => 'normal', 
                    'priority' => 'high', 
                    'sections' => $boxSections
                );
            /**
            *END:PPP METABOXES
            **/
        }

        
        return $metaboxes;
      }
    }
    
}