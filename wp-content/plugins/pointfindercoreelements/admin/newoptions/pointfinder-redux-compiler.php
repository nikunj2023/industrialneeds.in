<?php
defined( 'ABSPATH' ) || exit;

if (!class_exists('PointFinderCompilerActions')) {

	class PointFinderCompilerActions
	{
		use PointFinderOptionFunctions;
		use PointFinderReduxMetaboxes;

		public $newoptions = array();

	    public function __construct(){
	        
	    }


	    public function pointfinder_options_compiler_action($options, $css){
				
			if (!empty($css)) {
				$this->newoptions = $options;
				$css = $this->general_css_generate($options, $css);
			}
			
			$redux = ReduxFrameworkInstances::get_instance('pointfindertheme_options');

	        $uploads = wp_upload_dir();
	        $upload_dir = trailingslashit($uploads['basedir']);
	        $upload_dir = $upload_dir . '/pfstyles';

	        if ( ! is_dir( $upload_dir ) ) {
	          $redux->filesystem->execute( "mkdir", $upload_dir );
	        }

	        $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-main' . '.css';

	        $redux->filesystem->execute( 
	            'put_contents', 
	            $filename, 
	            array( 
	                'content' => $css
	            ) 
	        );
		}

		public function pointfinder_custompoints_compiler_action($options, $css) {

	        $redux = ReduxFrameworkInstances::get_instance('pfcustompoints_options');

	        $uploads = wp_upload_dir();
	        $upload_dir = trailingslashit($uploads['basedir']);
	        $upload_dir = $upload_dir . '/pfstyles';

	        if ( ! is_dir( $upload_dir ) ) {
	          $redux->filesystem->execute( "mkdir", $upload_dir );
	        }

	        $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-custompoints' . '.css';

	        $redux->filesystem->execute( 
	            'put_contents', 
	            $filename, 
	            array( 
	                'content' => $css
	            ) 
	        );

	    }

		public function pointfinder_additional_options_compiler_action($options, $css) {

			if (!empty($css)) {
				$this->newoptions = $options;
				$css = $this->additional_css_generate($options, $css);
			}

            $redux = ReduxFrameworkInstances::get_instance('pfascontrol_options');

            $uploads = wp_upload_dir();
            $upload_dir = trailingslashit($uploads['basedir']);
            $upload_dir = $upload_dir . '/pfstyles';

            if ( ! is_dir( $upload_dir ) ) {
              $redux->filesystem->execute( "mkdir", $upload_dir );
            }

            $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-pbstyles' . '.css';

            $redux->filesystem->execute( 
                'put_contents', 
                $filename, 
                array( 
                    'content' => $css
                ) 
            );
        }

        public function pointfinder_search_fields_compiler_action($options, $css) {
	        $redux = ReduxFrameworkInstances::get_instance('pfsearchfields_options');

	        $uploads = wp_upload_dir();
	        $upload_dir = trailingslashit($uploads['basedir']);
	        $upload_dir = $upload_dir . '/pfstyles';

	        if ( ! is_dir( $upload_dir ) ) {
	          $redux->filesystem->execute( "mkdir", $upload_dir );
	        }

	        $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-search' . '.css';

	        $redux->filesystem->execute( 
	            'put_contents', 
	            $filename, 
	            array( 
	                'content' => $css
	            ) 
	        );
	    }


	    public function pointfinder_review_compiler_action($options, $css){

            $redux = ReduxFrameworkInstances::get_instance('pfitemreviewsystem_options');

            $uploads = wp_upload_dir();
            $upload_dir = trailingslashit($uploads['basedir']);
            $upload_dir = $upload_dir . '/pfstyles';

            if ( ! is_dir( $upload_dir ) ) {
              $redux->filesystem->execute( "mkdir", $upload_dir );
            }

            $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-review' . '.css';

            $redux->filesystem->execute( 
                'put_contents', 
                $filename, 
                array( 
                    'content' => $css
                ) 
            );
        }


        public function pointfinder_size_compiler_action($options, $css) {

            if (!empty($options)) {
                $this->newoptions = $options;
                $css = $this->pointfinder_size_css_generate($options, $css);
            }


            $redux = ReduxFrameworkInstances::get_instance($this->args['opt_name']);

            $uploads = wp_upload_dir();
            $upload_dir = trailingslashit($uploads['basedir']);
            $upload_dir = $upload_dir . '/pfstyles';

            if ( ! is_dir( $upload_dir ) ) {
              $redux->filesystem->execute( "mkdir", $upload_dir );
            }

            $filename = trailingslashit($uploads['basedir']) . '/pfstyles/pf-style-psizestyles' . '.css';

            $redux->filesystem->execute( 
                'put_contents', 
                $filename, 
                array( 
                    'content' => $css
                ) 
            );
        }


		private function PFSAIssetControlN($field, $field2 = '', $default = '',$icl_exit = 0){

			if($field2 == ''){
			  if (!isset($this->newoptions[''.$field.''])) {
			    return $default;
			  }
			  if ($this->newoptions[''.$field.''] == "") {
			    return $default;
			  }
			  return $this->newoptions[''.$field.''];
			}else{
			  if (!isset($this->newoptions[''.$field.''][''.$field2.''])) {
			    return $default;
			  }
			  if ($this->newoptions[''.$field.''][''.$field2.''] == "") {
			    return $default;
			  }
			  return $this->newoptions[''.$field.''][''.$field2.''];
			};
		}

		private function PFSizeSIssetControlN($field, $field2 = '', $default = '',$icl_exit = 0){

            if($field2 == ''){
              if (!isset($this->newoptions[''.$field.''])) {
                return $default;
              }
              if ($this->newoptions[''.$field.''] == "") {
                return $default;
              }
              return $this->newoptions[''.$field.''];
            }else{
              if (!isset($this->newoptions[''.$field.''][''.$field2.''])) {
                return $default;
              }
              if ($this->newoptions[''.$field.''][''.$field2.''] == "") {
                return $default;
              }
              return $this->newoptions[''.$field.''][''.$field2.''];
            };
        }


        private function pointfinder_size_css_generate($options,$csstext){
        	$setupsizelimitconf_general_gallerysize2_h = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gallerysize2','height','100');
            $setupsizelimitconf_general_gallerysize2_w = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gallerysize2','width','112');

            $setupsizelimitconf_general_gallerysize1_h = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gallerysize1','height','566');
            $setupsizelimitconf_general_gallerysize1_w = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gallerysize1','width','848');

            $setupsizelimitconf_general_gridsize2_height = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gridsize2','height',416);
            $setupsizelimitconf_general_gridsize3_height = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gridsize3','height',270);
            $setupsizelimitconf_general_gridsize4_width = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gridsize4','width',263);
            $setupsizelimitconf_general_gridsize4_height = $this->PFSizeSIssetControlN('setupsizelimitconf_general_gridsize4','height',197);


            $csstext .= "#pfitemdetail-slider-sub li img{height:".$setupsizelimitconf_general_gallerysize2_h."px;}";
            $csstext .= "#pfitemdetail-slider li img{height:auto!important;max-height:".$setupsizelimitconf_general_gallerysize1_h."px;}";
            $csstext .= "#pfitemdetail-slider li .pfshoworiginalitemphotomain img{height:auto!important;max-height:100%;}";

            $csstext .= "#pfitemdetail-slider-sub li .pfshoworiginalitemphoto{max-width:".$setupsizelimitconf_general_gallerysize2_w."px!important;width:".$setupsizelimitconf_general_gallerysize2_w."px;height:".$setupsizelimitconf_general_gallerysize2_h."px;text-align:center;}";
            $csstext .= "#pfitemdetail-slider li .pfshoworiginalitemphotomain{max-width:".$setupsizelimitconf_general_gallerysize1_w."px!important;width:".$setupsizelimitconf_general_gallerysize1_w."px;height:".$setupsizelimitconf_general_gallerysize1_h."px;text-align:center;}";


            $csstext .= '.pfitemlists-content-elements.pf4col .wpfitemlistdata .pflist-imagecontainer .pfuorgcontainer img{max-height: '.$setupsizelimitconf_general_gridsize4_height.'px!important;width: auto;max-width:100%;}';
            $csstext .= '.pfitemlists-content-elements.pf3col .wpfitemlistdata .pflist-imagecontainer .pfuorgcontainer img{max-height: '.$setupsizelimitconf_general_gridsize3_height.'px!important;width: auto;max-width:100%;}';
            $csstext .= '.pfitemlists-content-elements.pf2col .wpfitemlistdata .pflist-imagecontainer .pfuorgcontainer img{max-height: '.$setupsizelimitconf_general_gridsize2_height.'px!important;width: auto;max-width:100%;}';
            $csstext .= '.pfitemlists-content-elements.pf1col .wpfitemlistdata .pflist-imagecontainer .pfuorgcontainer img{max-height: '.$setupsizelimitconf_general_gridsize4_height.'px!important;width: auto;max-width: '.$setupsizelimitconf_general_gridsize4_width.'px!important;}';
            $csstext .= '.pfitemlists-content-elements.pf1col .wpfitemlistdata .pflist-imagecontainer .pfuorgcontainer{text-align: center;min-width: '.$setupsizelimitconf_general_gridsize4_width.'px!important;}';
            return $csstext;
        }

		private function additional_css_generate($options,$csstext){
			$setup18_headerbarsettings_padding = $this->PFSAIssetControlN('setup18_headerbarsettings_padding','margin-top',30);
            $setup18_headerbarsettings_padding_number = str_replace('px', '', $setup18_headerbarsettings_padding);

            $setup17_logosettings_sitelogo_height = $this->PFSAIssetControlN('setup17_logosettings_sitelogo_height','height',30);
            $setup17_logosettings_sitelogo_height_number = str_replace('px', '', $setup17_logosettings_sitelogo_height);


            $pointfinder_navwrapper_height = ($setup18_headerbarsettings_padding_number*2) + $setup17_logosettings_sitelogo_height_number;

            $setup21_widgetsettings_3_slider_capt = (isset($options['setup21_widgetsettings_3_slider_capt']['color']))?$options['setup21_widgetsettings_3_slider_capt']['color']:'#000000';
            $general_postitembutton_bordercolor = (isset($options['general_postitembutton_bordercolor']['color']))?$options['general_postitembutton_bordercolor']['color']:'#ededed';
            $general_postitembutton_borderr = (isset($options['general_postitembutton_borderr']))?$options['general_postitembutton_borderr']:'0';
            $general_postitembutton_button_mtop = (isset($options['general_postitembutton_button_mtop']))?$options['general_postitembutton_button_mtop']:'26';

            $csstext .= '.pf-item-slider .pf-item-slider-golink:hover{background-color:'.$setup21_widgetsettings_3_slider_capt.'}';
            $csstext .= '#pfpostitemlink a,#pfpostitemlinkmobile {height: auto!important;line-height: 0px!important;margin-top: '.$general_postitembutton_button_mtop.'px!important;border-radius:'.$general_postitembutton_borderr.'px!important}';
          
            $csstext .= '@media (max-width:1199px){#pfpostitemlink{top:'.(($pointfinder_navwrapper_height - $general_postitembutton_button_mtop)).'px}}';

            return $csstext;
		}

		private function general_css_generate($options,$csstext){

			/*
			* Start: Get variables
			*/	
				$pfstickyhead = $this->PFSAIssetControlN('pfstickyhead','','1');
				$setup18_headerbarsettings_bordersettings = $this->PFSAIssetControlN('setup18_headerbarsettings_padding_menu','border-color','#cccccc');
				$setup22_searchresults_text_typo = $this->PFSAIssetControlN('setup22_searchresults_text_typo','color','#000');
				$setup18_headerbarsettings_menusubmenuwidth = $this->PFSAIssetControlN('setup18_headerbarsettings_menusubmenuwidth','','190');
				$setup_footerbar_text = $this->PFSAIssetControlN('setup_footerbar_text','regular','#ffffff');
				$setup_footerbar_text_copy_align = $this->PFSAIssetControlN('setup_footerbar_text_copy_align','','left');
				
				$setup_footerbar_status = $this->PFSAIssetControlN('setup_footerbar_status','','1');
				$setup_footerbar_bg = $this->PFSAIssetControlN('setup_footerbar_bg','','#fff');
				

				/*Info Window*/
				$setup10_infowindow_width = $this->PFSAIssetControlN('setup10_infowindow_width','','350');
				$setup10_infowindow_height = $this->PFSAIssetControlN('setup10_infowindow_height','','136');
				$setup10_infowindow_img_width = $this->PFSAIssetControlN('setup10_infowindow_img_width','','154');

				$setup12_searchwindow_background_mobile = $this->PFSAIssetControlN('setup12_searchwindow_background_mobile','','#384b56');

				$setup10_infowindow_background = $this->PFSAIssetControlN('setup10_infowindow_background','color','#ffffff');
				$s10_iw_w_m = $this->PFSAIssetControlN('s10_iw_w_m','','184');
				$s10_iw_h_m = $this->PFSAIssetControlN('s10_iw_h_m','','136');

				/*Start: Menu Variables*/

					/*Top Bar Variables*/
					$setup12_searchwindow_topbarbackground_ex = $this->PFSAIssetControlN('setup12_searchwindow_topbarbackground_ex','hover','#ffffff');
					$setup12_searchwindow_topbarhovercolor = $this->PFSAIssetControlN('setup12_searchwindow_topbarhovercolor','hover','#b00000');
					$setup12_searchwindow_sbuttonbackground1_ex = $this->PFSAIssetControlN('setup12_searchwindow_sbuttonbackground1_ex','hover','#ffffff');
					$setup12_searchwindow_background_activeline = $this->PFSAIssetControlN('setup12_searchwindow_background_activeline','','#b00000');

					/*Sub Menu: Bottom Border*/

					$setup18_headerbarsettings_bordersettingssub = $this->PFSAIssetControlN('setup18_headerbarsettings_bordersettingssub','','');
					$setup18_headerbarsettings_bordersettingssub_color = (isset($setup18_headerbarsettings_bordersettingssub['border-color']))?$setup18_headerbarsettings_bordersettingssub['border-color']:'#efefef';

				/*End: Menu variables*/


				/*Search Window Variables*/
				$setup12_searchwindow_background = $this->PFSAIssetControlN('setup12_searchwindow_background','rgba','#494949');
				$setup12_searchwindow_context = $this->PFSAIssetControlN('setup12_searchwindow_context','','#ffffff');


				$setup42_itempagedetails_8_styles_buttoncolor = $this->PFSAIssetControlN('setup42_itempagedetails_8_styles_buttoncolor','regular','#494949');
				$setup42_itempagedetails_8_styles_buttoncolor_h = $this->PFSAIssetControlN('setup42_itempagedetails_8_styles_buttoncolor','hover','#494949');
				$setup42_itempagedetails_8_styles_buttontextcolor = $this->PFSAIssetControlN('setup42_itempagedetails_8_styles_buttontextcolor','regular','#ffffff');
				$setup42_itempagedetails_8_styles_buttontextcolor_h = $this->PFSAIssetControlN('setup42_itempagedetails_8_styles_buttontextcolor','hover','#ffffff');


				$tcustomizer_typographyh_main_bg = $this->PFSAIssetControlN('tcustomizer_typographyh_main_bg','background-color','#ffffff');
				

				$tcustomizer_typographyh_main = $this->PFSAIssetControlN('tcustomizer_typographyh_main','font-size','14px');


				$tcustomizer_typographyh_main_color = $this->PFSAIssetControlN('tcustomizer_typographyh_main','color','#494949');
				$setup30_dashboard_styles_bodyborder = $this->PFSAIssetControlN('setup30_dashboard_styles_bodyborder','','#ebebeb');
				$setup42_itempagedetails_8_styles_elementcolor = $this->PFSAIssetControlN('setup42_itempagedetails_8_styles_elementcolor','','#a32221');
				$setup18_headerbarsettings_menulinecolor = $this->PFSAIssetControlN('setup18_headerbarsettings_menulinecolor','','');
				$stp28_mmenu_menulinecolor = $this->PFSAIssetControlN('stp28_mmenu_menulinecolor','','');


				$setup13_mapcontrols_barbackground = $this->PFSAIssetControlN('setup13_mapcontrols_barbackground','','#28353d');
				$setup13_mapcontrols_barhoverbackground = $this->PFSAIssetControlN('setup13_mapcontrols_barhoverbackground','','#3c4e5a');
				$setup13_mapcontrols_barhovercolor = $this->PFSAIssetControlN('setup13_mapcontrols_barhovercolor','','#ffffff');


				$setup18_headerbarsettings_menucolor = $this->PFSAIssetControlN('setup18_headerbarsettings_menucolor','regular','#fafafa');

				


			$csstext .= '.pfreadmorelink:hover{color:'.$this->pf_hex_color_mod($setup22_searchresults_text_typo,-40).'}';

			/*Lighter text for Ui Item*/
				$csstext .= '.pfnavmenu .pfnavsub-menu{min-width:'.$setup18_headerbarsettings_menusubmenuwidth.'px;}';
				$csstext .= '.wpf-footer,.wpf-footer-text{color:'.$setup_footerbar_text.'!important;}';
				$csstext .= '.wpf-footer-text{text-align:'.$setup_footerbar_text_copy_align.'}';
				


			

			/* Start: Info Window*/
				$csstext .= '#pfsearch-draggable.pfshowmobile,#pfsearch-draggable.pfshowmobile .pfsearch-content,#pfsearch-draggable.pfshowmobile .pfitemlist-content,#pfsearch-draggable.pfshowmobile .pfmapopt-content,#pfsearch-draggable.pfshowmobile .pfuser-content{background-color:'.$setup12_searchwindow_background_mobile.'}';
				$csstext .= '.wpfarrow{border-color:'.$setup10_infowindow_background.' transparent transparent transparent;}';
				if ($this->PointFindergetContrast($setup10_infowindow_background) == 'white') {
					$csstext .= '.wpfinfowindow .pfloadingimg{background-image: url('.PFCOREELEMENTSURLPUBLIC.'images/info-loading-bl.gif)!important;background-size: 24px 24px;background-repeat: no-repeat;background-position: center;}';
				}

				if ($this->PointFindergetContrast($tcustomizer_typographyh_main_bg) == 'white') {
					$csstext .= '.pfsearchresults-loading .pfloadingimg{background-image: url('.PFCOREELEMENTSURLPUBLIC.'images/info-loading-bl.gif)!important;background-size: 24px 24px;background-repeat: no-repeat;background-position: center;}';
				}

				if($setup10_infowindow_width != 350){
					$csstext .= '@media (min-width: 568px){.wpfarrow,#item-map-page .wpfarrow{left:'.(($setup10_infowindow_width/2)-8).'px!important;}}';
				}

				if($s10_iw_w_m != 184){
					$csstext .= '@media (max-width: 568px){.wpfarrow,#item-map-page .wpfarrow{left:'.(($s10_iw_w_m/2)-8).'px!important;}}';
				}

				if($setup10_infowindow_img_width != 154){
					$csstext .= '.wpfinfowindow .wpfimage-wrapper,#item-map-page .wpfinfowindow .wpfimage-wrapper{width:'.$setup10_infowindow_img_width.'px!important}';
				}

				if($setup10_infowindow_width != 350 || $setup10_infowindow_height != 136){
					$csstext .= '@media (min-width: 568px){.wpfinfowindow,html #item-map-page .wpfinfowindow{width:'.$setup10_infowindow_width.'px;height:'.$setup10_infowindow_height.'px;}.wpfinfowindow .wpftext{height:'.$setup10_infowindow_height.'px;}}';
				}

				if ($s10_iw_w_m != 184 && $s10_iw_h_m != 136) {
					$csstext .= '@media (max-width: 568px){html #wpf-map .wpfinfowindow,html #item-map-page .wpfinfowindow{width:'.$s10_iw_w_m.'px;height:'.$s10_iw_h_m.'px;}.wpfinfowindow .wpftext{height:'.$s10_iw_h_m.'px;}}';
				}

			/* End: Info Window*/






			/* Start: Search Window & Map Controls Buttons/Colors/etc... */

				$searchconfig_count = 0;
				for ($i=1; $i <= 2; $i++) {
					if ($this->PFSAIssetControlN('setup12_searchwindow_buttonconfig'.$i,'','1') == 1) {
						$searchconfig_count = $searchconfig_count + 1;
					}
				}
				if($searchconfig_count == 2){
					$csstext .= '.pfsearch-draggable-window .pfsearch-header ul li{width:33.333333334%;}@media (max-width: 568px) {.pfsearch-draggable-window .pfsearch-header ul li{width:50%;}}';
				}elseif($searchconfig_count == 1){
					$csstext .= '.pfsearch-draggable-window .pfsearch-header ul li{width:50%;}@media (max-width: 568px) {.pfsearch-draggable-window .pfsearch-header ul li{width:100%;}}';
				}elseif($searchconfig_count == 0){
					$csstext .= '.pfsearch-draggable-window .pfsearch-header ul li{width:100%;}';
				}

				$csstext .= '#pfsearch-draggable.ui-draggable .pfdragcontent{color:'.$setup12_searchwindow_context.'!important;}';
				$csstext .= '.pfadditional-filters:after{border-bottom-color:rgb('.$this->pointfindermobilehex2rgb($setup12_searchwindow_context).');border-bottom-color:rgba('.$this->pointfindermobilehex2rgb($setup12_searchwindow_context).',0.32);}';
				$csstext .= '.pfsopenclose i,.pfsopenclose2 i,.pfsopenclose2{color:'.$setup12_searchwindow_context.'}.pfsopenclose2:hover{color:'.$this->pf_hex_color_mod($setup12_searchwindow_context,-20).'}';
				


				/* Pin Opacities */
				$csstext .= '.pf-map-pin-1{opacity:1;}.pf-map-pin-1:hover,.pf-map-pin-x:hover{opacity:1!important}';
				

			/* End: Search Window Buttons */


			/*Box shadow color change for different bg*/

				$setup18_headerbarsettings_menucolor2_bg3 = $this->PFSAIssetControlN('setup18_headerbarsettings_menucolor2_bg3','regular','#ffffff');

				$stp28_mmenu_menucolor2_bg3 = $this->PFSAIssetControlN('stp28_mmenu_menucolor2_bg3','regular','#272c2e');

			/* Start: General Settings (Border etc...) */
				$csstext .= '.wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu{background-color:'.$setup18_headerbarsettings_menucolor2_bg3.'!important}';
				$csstext .= '#pf-primary-navmobile.pf-primary-navclass .pfnavmenu .pfnavsub-menu{background-color:'.$stp28_mmenu_menucolor2_bg3.'!important}';
				$csstext .= '#pf-primary-navmobile.pf-primary-navclass .pfnavmenu .pfnavsub-menu li.menu-item-has-children:hover{background-color:'.$stp28_mmenu_menucolor2_bg3.'!important}';
				$csstext .= '.wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu li,#pf-topprimary-nav .pfnavmenu .pfnavsub-menu li{border-bottom:1px solid '.$setup18_headerbarsettings_bordersettingssub_color.'}';
				$csstext .= '#pf-search-button-halfmap,.pfselect2drop.select2-drop,.pfsearchresults .golden-forms .select, .pfsearchresults .golden-forms .select:hover,hr,.widgetheader,.dsidx-prop-title,#dsidx-listings .dsidx-primary-data,.pfwidgetinner .select,.pfwidgetinner .select:hover,.widget_pfitem_recent_entries ul li,#jstwitter .tweet,.pfwidgetinner .dsidx-search-widget select,.pf-bbpress-forum-container .bbp-pagination,.pf-bbpress-forum-container .bbp-topic-form,.pf-bbpress-forum-container .bbp-reply-form,#bbpress-forums fieldset.bbp-form input,#bbpress-forums fieldset.bbp-form textarea,#bbpress-forums li.bbp-header,.bbp-search-form input,.bbp-submit-wrapper button,.dsidx-widget li, .dsidx-list li,#dsidx-actions,#dsidx-header,#dsidx-description,#dsidx-secondary-data,.dsidx-supplemental-data,#dsidx-map,.dsidx-contact-form,#dsidx-contact-form-header,.dsidx-details h3,#dsidx-property-types,#bbp-user-navigation,#dsidx textarea,#dsidx table,#dsidx-contact-form-submit,.dsidx-search-widget input,.widget_search input,.pf_pageh_title .pf_pageh_title_inner,.pf-agentlist-pageitem .pf-itempage-sidebarinfo-elname,.pfajax_paginate >.page-numbers >li >a,.pfstatic_paginate >.page-numbers >li >a,.pf-item-title-bar,.pf-itempage-sharebar,.pf-itempage-sharebar .pf-sharebar-others li a,.pf-itempage-sharebar .pf-sharebar-others li:first-child,.pf-itempage-sharebar .pf-sharebar-icons li,.pf-itempage-sharebar .pf-sharebar-others li:last-child a,.ui-tabgroup >.ui-panels >[class^="ui-tab"],.pfitempagecontainerheader,.pf-itempage-ohours ul li,.pfdetailitem-subelement,.pfmainreviewinfo,.pf-itempage-subheader,.review-flag-link,.pf-itemrevtextdetails,.comments .comment-body,.pfreviews .pfreview-body,.pfajax_paginate >.page-numbers >li,.pfstatic_paginate >.page-numbers >li,.pf-authordetail-page .pf-itempage-sidebarinfo-elname,.pf-itempage-subheader,.pf-itempage-maindiv .ui-tabs,.pf-itempage-maindiv .pf-itempagedetail-element, .pftrwcontainer.pfrevformex,.pf-itempage-uaname,#pfuaprofileform .select, #pfuaprofileform .button, .pfmu-payment-area .select, .pfmu-payment-area .select:hover, .pfmu-itemlisting-inner .pfmu-userbuttonlist-item .button, .pfmu-itemlisting-inner .pfmu-userbuttonlist-item .button:hover,.pfuaformsidebar .pf-sidebar-cartitems .pftotal,#pfuaprofileform .pfmu-itemlisting-inner,#bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic,.post-minfo,.pf-post-comment-inner,.pointfinder-post .post-minfo,.post-mtitle,.widget_pfitem_recent_entries .golden-forms .button.pfsearch,.pf-uadashboard-container .pfalign-right,.post,.post-mtitle,.single-post .post-minfo,.pf-singlepost-clink,#pf-contact-form-submit,.pf-notfound-page .btn-success,.golden-forms .input,.pflist-item-inner .pflist-subitem,.pfheaderbarshadow2,.comment-reply-title small a,.comment-body .reply,#item-map-page,.widget_pfitem_recent_entries .pf-widget-itemlist li:last-child,.widget_pfitem_recent_entries .pf-widget-itemlist li,.pf-enquiry-form-ex,.pointfinder-comments-paging a,.pfwidgetinner,.pf-page-links,.pfsubmit-title,.pfsubmit-inner,.pf-itempage-br-xm-nh,.pf-itempage-br-xm,.pf-item-extitlebar,.itp-featured-img,.wpf-header.pfshrink,#pf-itempage-page-map-directions .gdbutton,#pf-itempage-page-map-directions .gdbutton2,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.pf-dash-userprof2 .pf-dash-packageinfo .pf-dash-pinfo-col,.pf-membership-package-box,.pf-membership-upload-option,.pf-lpacks-upload-option,.pf-membership-price-header,.pf-dash-errorview-plan,#pfuaprofileform .mce-panel,.pf-listing-item-inner-addinfo ul li,.pf-listing-item-inner-addinfo,#pfuaprofileform .pfhtitle .pfmu-itemlisting-htitle,#pfuaprofileform .pfhtitle,#pfuaprofileform .pfmu-itemlisting-container .pfmu-itemlisting-inner,#pfuaprofileform .pfmu-itemlisting-container.pfmu-itemlisting-container-new .pfmu-itemlisting-inner,.pflistingtype-selector-main label,.pfpack-selector-main label,.pfitemlists-content-elements.pf1col .pflist-item,.pfsearchresults-header .select,.pfsearchresults-header .select:hover,.pfselect2container .select2-choice,.pfselect2container .select2-choices,.pfselect2container,.pointfinder-border-color,.pfajax_paginate >.page-numbers >li >.current, .pfstatic_paginate >.page-numbers >li >.current,.pflistgridajaxview .select,.pfitemlists-content-elements.pf3col .pflist-imagecontainer,.pfitemlists-content-elements.pf2col .pflist-imagecontainer,.pfitemlists-content-elements.pf4col .pflist-imagecontainer,.pflist-imagecontainer.pflist-subitem.pointfindernoimg + .pflist-detailcontainer.pflist-subitem,.pflist-imagecontainer.pflist-subitem.pointfinderhideallimg + .pflist-detailcontainer.pflist-subitem,.select2-container--default .select2-selection--single,.golden-forms textarea,.golden-forms .checkbox,.pfgeotriangle.pf-arrow-box,.select2-dropdown.pfselect2drop,.select2-container--default .select2-search--dropdown .select2-search__field{border-color:'.$setup30_dashboard_styles_bodyborder.'!important;}';
				$csstext .= '.pf-arrow-top:after{border-bottom-color:'.$setup30_dashboard_styles_bodyborder.'!important;}';
				$csstext .= '.pf-halfmap-list-container hr, .pf-halfmap-list-container hr::before{background-color:'.$setup30_dashboard_styles_bodyborder.'!important;}';
				$csstext .= '.openedonlybutton[data-status="active"],#pf-search-button-halfmap,.pf-membership-price-header,#pfcoverimageuploadfilepicker,#pffeaturedfileuploadfilepicker{background-color:'.$setup42_itempagedetails_8_styles_buttoncolor.';color:'.$setup42_itempagedetails_8_styles_buttontextcolor.';}';

				$csstext .= '.widget_pfitem_recent_entries .pf-widget-itemlist li:hover {box-shadow: 0 0 10px '.$setup30_dashboard_styles_bodyborder.';}';
				$csstext .= '.pfwidgetinner.pfemptytitle{border-top:1px solid '.$setup30_dashboard_styles_bodyborder.'}';
				$csstext .= '.pfdetailitem-subelement .pfdetail-ftext.pf-pricetext{color:'.$setup42_itempagedetails_8_styles_elementcolor.'!important;}';
				$csstext .= '.pf-arrow-up {border-bottom-color:'.$setup30_dashboard_styles_bodyborder.'}';
				$csstext .= '.pfwidgettitle .widgetheader:after,.pf_pageh_title .pf_pageh_title_inner:after,.pf-item-title-bar:after,.pfitempagecontainerheader:after,.pf-itempage-subheader:after,.pfmu-itemlisting-htitle.pfexhtitle:after,.pf-agentlist-pageitem .pf-itempage-sidebarinfo-elname:after,.post-mtitle:after,.single-post .post-title:after,.dsidx-prop-title:after, #dsidx-listings .dsidx-listing .dsidx-primary-data:after,#dsidx-actions:after,.pf-itempage-sidebarinfo .pf-itempage-sidebarinfo-userdetails ul .pf-itempage-sidebarinfo-elname:after{border-color:'.$setup42_itempagedetails_8_styles_elementcolor.'}';


				/*General Button Style*/
				$csstext .= '#pointfinder-search-form .golden-forms .slider-wrapper, #pointfinder-search-form .golden-forms .sliderv-wrapper{background:'.$setup12_searchwindow_sbuttonbackground1_ex.'!important;}';
				/*.golden-forms select, .golden-forms select optgroup,*/
				$csstext .= '#pfsearch-draggable .slider-input,.golden-forms input, .golden-forms button, .golden-forms textarea, .wpcf7 input, .wpcf7 button, .wpcf7 select, .wpcf7 textarea,.select2-results .select2-result-label,.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt,.woocommerce .cart .button, .woocommerce .cart input.button .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt,#pf-itempage-page-map-directions .gdbutton,#pf-itempage-page-map-directions .gdbutton2{font-size:'.$tcustomizer_typographyh_main.';}';
				$csstext .= '#pfuaprofileform .select,#pfuaprofileform .select-multiple,#pfuaprofileform .button,.pfmu-payment-area .select,.pfmu-payment-area .select:hover,.pfmu-itemlisting-inner .pfmu-userbuttonlist-item .button,.widget_tag_cloud a,.golden-forms #commentform .button,.ui-tabgroup >.ui-tabs >[class^="ui-tab"],.pfmu-itemlisting-inner .pfmu-userbuttonlist-item .button:hover,.woocommerce #content input.button.alt,.woocommerce .cart .button, .woocommerce .cart input.button .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt{border:1px solid '.$setup30_dashboard_styles_bodyborder.'}';

				/*Woocommerce addons */
				$csstext .= '.woocommerce #content input.button.alt,.woocommerce .cart .button, .woocommerce .cart input.button .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt{color:'.$setup42_itempagedetails_8_styles_buttontextcolor.';}';
				$csstext .= '.woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce .cart .button:hover, .woocommerce .cart input.button:hover .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,#pf-search-button-halfmap:hover,#pfcoverimageuploadfilepicker:hover,#pffeaturedfileuploadfilepicker:hover{color:'.$setup42_itempagedetails_8_styles_buttontextcolor_h.';}';

				$csstext .= '.woocommerce #content input.button.alt,.woocommerce .cart .button, .woocommerce .cart input.button .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt{background-color:'.$setup42_itempagedetails_8_styles_buttoncolor.';}';
				$csstext .= '.woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce .cart .button:hover, .woocommerce .cart input.button:hover .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,#pf-search-button-halfmap:hover,#pfcoverimageuploadfilepicker:hover,#pffeaturedfileuploadfilepicker:hover{background-color:'.$setup42_itempagedetails_8_styles_buttoncolor_h.';}';


				$frtd_typo_btc = $this->PFSAIssetControlN('frtd_typo_btc','regular','#434a54');
				$frtd_typo_bbgc = $this->PFSAIssetControlN('frtd_typo_bbgc','regular','#f7f7f7');

				$csstext .= '.pf-sidebar-menu li a .pfbadge{background-color:'.$frtd_typo_btc.';color:'.$frtd_typo_bbgc.';}';
				$csstext .= '.pfuaformsidebar .pf-sidebar-menu li.pf-dash-userprof:hover{background-color:'.$frtd_typo_bbgc.';}';
				$csstext .= '.widget_tag_cloud a{background-color:'.$setup42_itempagedetails_8_styles_buttoncolor.';color:'.$setup42_itempagedetails_8_styles_buttontextcolor.';}';
				/*$csstext .= '.pfajax_paginate > .page-numbers > li > .current,.pfstatic_paginate > .page-numbers > li > .current,.pointfinder-comments-paging .current,.pointfinder-comments-paging a:hover,.pfajax_paginate > .page-numbers > li > a:hover,.pfstatic_paginate > .page-numbers > li > a:hover{background-color:'.$setup42_itempagedetails_8_styles_elementcolor.'!important;}';*/


				/*Tab System*/
				$csstext .= '.pftogglemenulist li[data-pf-toggle="active"]{background-color:'.$setup12_searchwindow_background.'!important;}';
				$csstext .= '.pftogglemenulist li[data-pf-toggle="active"] i{color:'.$setup12_searchwindow_context.'!important;}';
				$csstext .= '@media (max-width: 568px) {.pftogglemenulist li[data-pf-toggle="active"]{background-color:'.$setup12_searchwindow_background_mobile.'!important;}}';
				$csstext .= '.pftogglemenulist li[data-pf-toggle="active"]:after{border-color:'.$setup12_searchwindow_background_activeline.'!important;}';
				$csstext .= '.ui-tabgroup >.ui-tabs >[class^="ui-tab"]{color:'.$this->pf_hex_color_mod($tcustomizer_typographyh_main_color,30).';background-color:'.$this->pf_hex_color_mod($tcustomizer_typographyh_main_bg,-5).'}';
				$csstext .= '.ui-tabgroup >.ui-tabs >[class^="ui-tab"]:hover{color:'.$setup42_itempagedetails_8_styles_elementcolor.';}';
				$csstext .= '.comment-reply-title small a,.comment-body .reply{background-color:'.$this->pf_hex_color_mod($tcustomizer_typographyh_main_bg,-5).'}';
				$csstext .= '.ui-tabgroup >input.ui-tab1:checked ~ .ui-tabs >.ui-tab1, .ui-tabgroup >input.ui-tab2:checked ~ .ui-tabs >.ui-tab2, .ui-tabgroup >input.ui-tab3:checked ~ .ui-tabs >.ui-tab3, .ui-tabgroup >input.ui-tab4:checked ~ .ui-tabs >.ui-tab4, .ui-tabgroup >input.ui-tab5:checked ~ .ui-tabs >.ui-tab5, .ui-tabgroup >input.ui-tab6:checked ~ .ui-tabs >.ui-tab6, .ui-tabgroup >input.ui-tab7:checked ~ .ui-tabs >.ui-tab7, .ui-tabgroup >input.ui-tab8:checked ~ .ui-tabs >.ui-tab8, .ui-tabgroup >input.ui-tab9:checked ~ .ui-tabs >.ui-tab9{color:'.$setup42_itempagedetails_8_styles_elementcolor.'; background-color:'.$tcustomizer_typographyh_main_bg.';}';
				$csstext .= '.ui-tabgroup >input.ui-tab1:checked ~ .ui-tabs >.ui-tab1:after, .ui-tabgroup >input.ui-tab2:checked ~ .ui-tabs >.ui-tab2:after, .ui-tabgroup >input.ui-tab3:checked ~ .ui-tabs >.ui-tab3:after, .ui-tabgroup >input.ui-tab4:checked ~ .ui-tabs >.ui-tab4:after, .ui-tabgroup >input.ui-tab5:checked ~ .ui-tabs >.ui-tab5:after, .ui-tabgroup >input.ui-tab6:checked ~ .ui-tabs >.ui-tab6:after, .ui-tabgroup >input.ui-tab7:checked ~ .ui-tabs >.ui-tab7:after, .ui-tabgroup >input.ui-tab8:checked ~ .ui-tabs >.ui-tab8:after, .ui-tabgroup >input.ui-tab9:checked ~ .ui-tabs >.ui-tab9:after, .ui-tabgroup >input.ui-tab10:checked ~ .ui-tabs >.ui-tab10:after, .ui-tabgroup >input.ui-tab11:checked ~ .ui-tabs >.ui-tab11:after, .ui-tabgroup >input.ui-tab12:checked ~ .ui-tabs >.ui-tab12:after, .ui-tabgroup >input.ui-tab13:checked ~ .ui-tabs >.ui-tab13:after, .ui-tabgroup >input.ui-tab14:checked ~ .ui-tabs >.ui-tab14:after, .ui-tabgroup >input.ui-tab15:checked ~ .ui-tabs >.ui-tab15:after{border-color:'.$tcustomizer_typographyh_main_bg.'}';

				$csstext .= '.ui-tabgroup >input.ui-tab1:checked ~ .ui-tabs >.ui-tab1:before, .ui-tabgroup >input.ui-tab2:checked ~ .ui-tabs >.ui-tab2:before, .ui-tabgroup >input.ui-tab3:checked ~ .ui-tabs >.ui-tab3:before, .ui-tabgroup >input.ui-tab4:checked ~ .ui-tabs >.ui-tab4:before, .ui-tabgroup >input.ui-tab5:checked ~ .ui-tabs >.ui-tab5:before, .ui-tabgroup >input.ui-tab6:checked ~ .ui-tabs >.ui-tab6:before, .ui-tabgroup >input.ui-tab7:checked ~ .ui-tabs >.ui-tab7:before, .ui-tabgroup >input.ui-tab8:checked ~ .ui-tabs >.ui-tab8:before, .ui-tabgroup >input.ui-tab9:checked ~ .ui-tabs >.ui-tab9:before, .ui-tabgroup >input.ui-tab10:checked ~ .ui-tabs >.ui-tab10:before, .ui-tabgroup >input.ui-tab11:checked ~ .ui-tabs >.ui-tab11:before, .ui-tabgroup >input.ui-tab12:checked ~ .ui-tabs >.ui-tab12:before, .ui-tabgroup >input.ui-tab13:checked ~ .ui-tabs >.ui-tab13:before, .ui-tabgroup >input.ui-tab14:checked ~ .ui-tabs >.ui-tab14:before, .ui-tabgroup >input.ui-tab15:checked ~ .ui-tabs >.ui-tab15:before{border-color:'.$setup42_itempagedetails_8_styles_elementcolor.'}';

				/*Footer Extra Styles*/
					$csstext .= '#pf-footer-row #wp-calendar tbody td:hover{background-color:'.$this->pf_hex_color_mod('#fafafa',10).'}';
					$csstext .= '#pf-footer-row #wp-calendar tbody #today{background-color:'.$this->pf_hex_color_mod('#fafafa',10).'}';
					$csstext .= '#pf-footer-row .widget_pfitem_recent_entries ul li,#pf-footer-row #jstwitter .tweet{border-bottom-color:'.$setup30_dashboard_styles_bodyborder.'!important}';
			/* End: General Settings (Border etc...) */



			/* Start: Favorites Ribbon */
				$setup41_favsystem_bgcolor = $this->PFSAIssetControlN('setup41_favsystem_bgcolor','','#fff');
				$setup41_favsystem_linkcolor_hover = $this->PFSAIssetControlN('setup41_favsystem_linkcolor','hover','#B32E2E');
				$csstext .= 'html .pflist-imagecontainer .RibbonCTR .Triangle:after,html .wpfimage-wrapper .RibbonCTR .Triangle:after{border-top: 40px solid '.$setup41_favsystem_bgcolor.';}';
				$csstext .= '.pflist-imagecontainer .RibbonCTR .Sign a[data-pf-active=true] i,.wpfimage-wrapper .RibbonCTR .Sign a[data-pf-active=true] i{color:'.$setup41_favsystem_linkcolor_hover.'}';
			/* End: Favorites Ribbon */



			

			/*$csstext .= '#pfuaprofileform .pfhtitle,.pf-listing-item-inner-addinfo{background-color:'.$this->pf_hex_color_mod($tcustomizer_typographyh_main_bg,-5).'}';*/

			

			$csstext .= '.leaflet-bar.leaflet-control button,.leaflet-bar.leaflet-control a,.leaflet-control-layers.leaflet-control{background-color:'.$setup13_mapcontrols_barbackground.'}';
			$csstext .= '.leaflet-bar.leaflet-control button:hover,.leaflet-bar.leaflet-control a:hover{background-color:'.$setup13_mapcontrols_barhoverbackground.'}';
			$csstext .= '.leaflet-bar.leaflet-control button,.leaflet-bar.leaflet-control a{color:'.$setup13_mapcontrols_barhovercolor.'}';
			


			/* Logo Settings */
				$setup18_headerbarsettings_padding = (isset($options['setup18_headerbarsettings_padding']))?$options['setup18_headerbarsettings_padding']:'';
				$setup18_headerbarsettings_padding = (isset($setup18_headerbarsettings_padding['margin-top']))?$setup18_headerbarsettings_padding['margin-top']:30;
				$setup18_headerbarsettings_padding_number = str_replace('px', '', $setup18_headerbarsettings_padding);
				
				$setup17_logosettings_sitelogo = (isset($options['setup17_logosettings_sitelogo']))?$options['setup17_logosettings_sitelogo']:'';
				if (!is_array($setup17_logosettings_sitelogo)) {
					$setup17_logosettings_sitelogo = array('url'=>'','width'=>188,'height'=>30);
				}
				$setup17_logosettings_sitelogo_height = (!empty($setup17_logosettings_sitelogo["height"]))?$setup17_logosettings_sitelogo["height"]:30;
				$setup17_logosettings_sitelogo_height_number = str_replace('px', '', $setup17_logosettings_sitelogo_height);
				$setup17_logosettings_sitelogo_width = (!empty($setup17_logosettings_sitelogo["width"]))?$setup17_logosettings_sitelogo["width"]:188;
				$setup17_logosettings_sitelogo_width_number = str_replace('px', '', $setup17_logosettings_sitelogo_width);

			/* Mobile Logo Settings */
				$stp28_mmenu_logose = $this->PFSAIssetControlN('stp28_mmenu_logose','','');


			/*
			* New variables
			* $pointfinder_navwrapper_height = Logo & Margin heights calculated.
			* $pfpadding_half = Half of the padding height for scrolled menu.
			* $pointfinder_navwrapper_height_shrink = Half of the navwrapper height for scrolled. (For mobile and scrolled menu)
			*/

				$pointfinder_navwrapper_height = ($setup18_headerbarsettings_padding_number*2) + $setup17_logosettings_sitelogo_height_number;
				$setup18_headerbarsettings_bordersettings_height = $this->PFSAIssetControlN('setup18_headerbarsettings_bordersettings','border-bottom','1px');
				if ($setup18_headerbarsettings_bordersettings_height != '0px') {
					$calc_height_1 = absint(str_replace("px","",$setup18_headerbarsettings_bordersettings_height));
					$calc_height_1 = $calc_height_1 + $pointfinder_navwrapper_height;

					$csstext .= '@media (min-width: 1025px){.pf-primary-navclass .pfnav-megasubmenu{top:'.$calc_height_1.'px;}}';
				}
				$pfpadding_half = $setup18_headerbarsettings_padding_number / 2;
				$pfpadding_halfnew = $setup18_headerbarsettings_padding_number / 1.4;
				$pointfinder_navwrapper_height_shrink = ($pfpadding_half * 2) + ($setup17_logosettings_sitelogo_height_number/2);
				$general_toplinedstatus = (isset($options['general_toplinedstatus']))?$options['general_toplinedstatus']:0;
				$topmenubarsize = 0;
				if ($general_toplinedstatus == 1) {
					$topmenubarsize = (isset($options['gn_toplineheight']))?$options['gn_toplineheight']:'30';;
				}

			/* Mobile Logo CSS */
				
				if ($stp28_mmenu_logose == '2') {
					$setup17_logosettings_sitelogo2 = $this->PFSAIssetControlN('setup17_logosettings_sitelogo2','','');
					if (!is_array($setup17_logosettings_sitelogo2)) {
						$setup17_logosettings_sitelogo2 = array('url'=>'','width'=>188,'height'=>30);
					}
					$setup17_logosettings_sitelogo2_height = (!empty($setup17_logosettings_sitelogo2["height"]))?$setup17_logosettings_sitelogo2["height"]:30;
					$setup17_logosettings_sitelogo2_height_number = str_replace('px', '', $setup17_logosettings_sitelogo2_height);
					$setup17_logosettings_sitelogo2_width = (!empty($setup17_logosettings_sitelogo2["width"]))?$setup17_logosettings_sitelogo2["width"]:188;
					$setup17_logosettings_sitelogo2_width_number = str_replace('px', '', $setup17_logosettings_sitelogo2_width);
					$csstext .= '.pf-logo-container.pfmobilemenulogo{background-image:url('.$setup17_logosettings_sitelogo2["url"].');background-size:'.$setup17_logosettings_sitelogo2_width_number.'px '.$setup17_logosettings_sitelogo2_height_number.'px;width: '.$setup17_logosettings_sitelogo2_width_number.'px;}';
					/* Retina Logo Settings */
					$setup17_logosettings_sitelogo22x = (isset($options['setup17_logosettings_sitelogo22x']))?$options['setup17_logosettings_sitelogo22x']:'';
					if (!is_array($setup17_logosettings_sitelogo22x)) {
						$setup17_logosettings_sitelogo22x = array('url'=>'','width'=>188,'height'=>30);
					}
					$setup17_logosettings_sitelogo22x_height = (!empty($setup17_logosettings_sitelogo22x["height"]))?$setup17_logosettings_sitelogo22x["height"]:30;
					$setup17_logosettings_sitelogo22x_height_number = str_replace('px', '', $setup17_logosettings_sitelogo22x_height);
					$setup17_logosettings_sitelogo22x_width = (!empty($setup17_logosettings_sitelogo22x["width"]))?$setup17_logosettings_sitelogo22x["width"]:188;
					$setup17_logosettings_sitelogo22x_width_number = str_replace('px', '', $setup17_logosettings_sitelogo22x_width);
					if(is_array($setup17_logosettings_sitelogo22x)){
						if(count($setup17_logosettings_sitelogo22x)>0){
							$csstext .= '@media only screen and (-webkit-min-device-pixel-ratio: 1.5),(min-resolution: 144dpi){ .pf-logo-container.pfmobilemenulogo{background-image:url('.$setup17_logosettings_sitelogo22x["url"].');background-size:'.($setup17_logosettings_sitelogo22x_width_number/2).'px '.($setup17_logosettings_sitelogo22x_height_number/2).'px;width: '.($setup17_logosettings_sitelogo22x_width_number/2).'px;}}';
						}
					}
				}else{
					$csstext .= '.pf-logo-container.pfmobilemenulogo{background-image:url('.$setup17_logosettings_sitelogo["url"].');background-size:'.$setup17_logosettings_sitelogo_width_number.'px '.$setup17_logosettings_sitelogo_height_number.'px;width: '.$setup17_logosettings_sitelogo_width_number.'px;}';
				}
				



			/* Logo CSS */
				$csstext .= '.wpf-header .pf-logo-container{margin:'.$setup18_headerbarsettings_padding_number.'px 0;height: '.$setup17_logosettings_sitelogo_height_number.'px;}';
				$csstext .= '.pf-logo-container{background-image:url('.$setup17_logosettings_sitelogo["url"].');background-size:'.$setup17_logosettings_sitelogo_width_number.'px '.$setup17_logosettings_sitelogo_height_number.'px;width: '.$setup17_logosettings_sitelogo_width_number.'px;}';

				$csstext .= '.wpf-header.pfshrink .pf-logo-container{height: '.($setup17_logosettings_sitelogo_height_number).'px;margin:'.$setup18_headerbarsettings_padding_number.'px 0;}';
				$csstext .= '.wpf-header.pfshrink .pf-logo-container{background-size:'.($setup17_logosettings_sitelogo_width_number).'px '.($setup17_logosettings_sitelogo_height_number).'px;width: '.($setup17_logosettings_sitelogo_width_number).'px;}';

				$csstext .= '@media (max-width: 568px) {.wpf-header .pf-logo-container{height: '.($setup17_logosettings_sitelogo_height_number/1.4).'px;margin:'.$pfpadding_halfnew.'px 0;}.wpf-header .pf-logo-container{background-size:'.($setup17_logosettings_sitelogo_width_number/1.4).'px '.($setup17_logosettings_sitelogo_height_number/1.4).'px;width: '.($setup17_logosettings_sitelogo_width_number/1.4).'px;}}';

				$csstext .= '@media (max-width: 1024px) {.wpf-header .pf-logo-container.pfmobilemenulogo{height: '.($setup17_logosettings_sitelogo_height_number/1.2).'px;margin:30px 0 0 0;}.wpf-header .pf-logo-container.pfmobilemenulogo{background-size:'.($setup17_logosettings_sitelogo_width_number/1.2).'px '.($setup17_logosettings_sitelogo_height_number/1.2).'px;width: '.($setup17_logosettings_sitelogo_width_number/1.2).'px;}}';

			/*Navigation Wrapper Setting*/
				$csstext .= '@media (max-width: 568px) {.wpf-header .wpf-navwrapper{height:'.$pointfinder_navwrapper_height_shrink.'px;}}';
				$csstext .= '.wpf-header .elementor-shape-top{margin-top:'.($pointfinder_navwrapper_height + $topmenubarsize ).'px}';

			/*Main Menu Settings - .pf-primary-navclass li.current_page_item > a, */
				$csstext .= '.pf-primary-navclass .pfnavmenu li.selected > .pfnavsub-menu{ border-top:1.4px solid '.$setup18_headerbarsettings_menulinecolor.';}';
				$csstext .= '.pf-primary-navclass .pfnavmenu li > a:hover{ border-bottom:2px solid '.$setup18_headerbarsettings_menulinecolor.';}';
				$csstext .= '.wpf-header .pf-menu-container{margin-top:0;}';
				$csstext .= '.wpf-header.pfshrink .pf-menu-container{margin:0;}';

				$csstext .= '.wpf-header.pfshrink .pf-primary-navclass .pfnavmenu .main-menu-item > a{height:'.$pointfinder_navwrapper_height.'px;line-height:'.$pointfinder_navwrapper_height.'px;}';
				$csstext .= '.wpf-header .pf-primary-navclass .pfnavmenu .main-menu-item > a{height:'.$pointfinder_navwrapper_height.'px;line-height:'.$pointfinder_navwrapper_height.'px;}';

			/*Main Menu Settings(mobile) - .pf-primary-navclass li.current_page_item > a, */
				$csstext .= '.pfmobilemenucontainer .pf-primary-navclass .pfnavmenu li.selected > .pfnavsub-menu{ border-top:1px solid '.$stp28_mmenu_menulinecolor.';}';
				$csstext .= '.pfmobilemenucontainer .pf-primary-navclass .pfnavmenu li > a:hover{ border-bottom:2px solid '.$stp28_mmenu_menulinecolor.';}';
				$csstext .= '.pf-menu-container .pfmobilemenucontainer {margin-top:0;}';
				$csstext .= '.pfmobilemenucontainer.pfshrink .pf-menu-container{margin:0;}';

				$csstext .= '.pfmobilemenucontainer .pfshrink .pf-primary-navclass .pfnavmenu .main-menu-item > a{height:'.$pointfinder_navwrapper_height.'px;line-height:'.$pointfinder_navwrapper_height.'px;}';
				$csstext .= '.pfmobilemenucontainer  .pf-primary-navclass .pfnavmenu .main-menu-item > a{height:'.$pointfinder_navwrapper_height.'px;line-height:'.$pointfinder_navwrapper_height.'px;}';

			/*Body Container*/
				$csstext .= '#pfhalfmapmapcontainer{min-height:calc(100vh - '.(($pointfinder_navwrapper_height + $topmenubarsize )).'px)} .pf-halfmap-list-container{min-height:calc(100vh - '.(($pointfinder_navwrapper_height + $topmenubarsize )+30).'px)}';
				$csstext .= '.pfhalfpagemapview .wpf-container{margin:'.($pointfinder_navwrapper_height + $topmenubarsize).'px 0 0 0;}';
				if ($pfstickyhead == '1') {
					$csstext .= '.wpf-header{position:fixed;}';
					$csstext .= '.wpf-container{margin:'.($pointfinder_navwrapper_height + $topmenubarsize ).'px 0 0 0;}';
					$csstext .= '.pftransparenthead section.pf-defaultpage-header{margin-top:'.($pointfinder_navwrapper_height + $topmenubarsize ).'px}';
				}

				$topmenubarsizem = 0;
				if ($general_toplinedstatus == '1') {
					$topmenubarsizem = (isset($options['gn_toplineheight']))?$options['gn_toplineheight']:'30';
				}
				$csstext .= '.wpf-header .pftopline, .wpf-header .pf-sociallinks .pf-sociallinks-item{height:'.$topmenubarsizem.'px!important}';
				$csstext .= '.wpf-header .pf-sociallinks .pf-sociallinks-item a{width:'.$topmenubarsizem.'px!important; height:'.$topmenubarsizem.'px!important; line-height:'.$topmenubarsizem.'px!important;}';
				$csstext .= '.pf-my-account.pfloggedin a, .pf-login-register a{line-height:'.$topmenubarsizem.'px!important;}';
				
				$csstext .= '@media (max-width: 1024px) {';
				if ($pfstickyhead == '1') {
					$csstext .= '.wpf-container{margin:0;}';
					$csstext .= '.pfhalfpagemapview .wpf-container{margin:'.(($setup17_logosettings_sitelogo_height_number)*3).'px 0 0 0;}';
					$csstext .= '#pfhalfmapmapcontainer{min-height:calc(100vh - '.(($setup17_logosettings_sitelogo_height_number)*3).'px)}';
				}
				$csstext .= '}';

				$csstext .= '@media (max-width:1024px) and (orientation: landscape) {';
				$csstext .= '.pfhalfpagemapview .wpf-container{margin:'.(($setup17_logosettings_sitelogo_height_number)*3).'px 0 0 0;}';
				$csstext .= '#pfhalfmapmapcontainer{min-height:calc(100vh - '.(($setup17_logosettings_sitelogo_height_number)*3).'px)}';
				$csstext .= '}';

				$csstext .= '@media (max-width: 768px) {';
				
				
				$csstext .= '#pfhalfmapmapcontainer{min-height: 350px;} .pf-halfmap-list-container{min-height:calc(100vh - '.(($pointfinder_navwrapper_height + $topmenubarsizem )+30).'px)}';
				$csstext .= '.pfhalfpagemapview .wpf-container{margin:'.(($setup17_logosettings_sitelogo_height_number)*3).'px 0 0 0;}';
				
				if ($pfstickyhead == '1') {
					$csstext .= '.wpf-container{margin:0;}';
					$csstext .= '#pfuaprofileform div.mce-fullscreen{margin:'.($pointfinder_navwrapper_height + $topmenubarsizem + 45 ).'px 0 0 0;}';
					$csstext .= '.pftransparenthead section.pf-defaultpage-header{margin-top:'.($pointfinder_navwrapper_height + $topmenubarsizem ).'px}';
				}
				$csstext .= '}';



				$csstext .= '@media (max-width: 765px) {';
				$csstext .= '.pfhalfpagemapview .wpf-container{margin:'.(($setup17_logosettings_sitelogo_height_number/1.4)*3).'px 0 0 0;}';
				$csstext .= '}';

			/*Box shadow color change for different bg*/

				if ($this->PointFindergetContrast($setup18_headerbarsettings_menucolor2_bg3) == 'white') {
					$csstext .= '.pfnavmenu .pfnavsub-menu{box-shadow: 0 0 80px rgba(255, 255, 255, 0.04)!important;}';
				}


			/*Mobile Menu Settings*/
				//$csstext .= '#pf-topprimary-navmobi,#pf-topprimary-navmobi2{border:1px solid '.$setup18_headerbarsettings_bordersettings.';}';
				//$csstext .= '#pf-topprimary-navmobi .pf-nav-dropdownmobi li,#pf-topprimary-navmobi2 .pf-nav-dropdownmobi li{border-bottom:1px solid '.$setup18_headerbarsettings_bordersettings.';}';
				/*$csstext .= '#pf-primary-nav-button,#pf-topprimary-nav-button2,#pf-topprimary-nav-button,#pf-primary-search-button{border-color: '.$setup18_headerbarsettings_menucolor.';}';*/
				$csstext .= '@media (max-width: 1024px) {#pf-topprimary-nav-button,#pf-topprimary-nav-button2,#pf-primary-nav-button,#pf-primary-search-button{top: '.$setup18_headerbarsettings_padding_number.'px;z-index:3}}';
				$csstext .= '@media (max-width: 568px) {#pf-topprimary-nav-button,#pf-topprimary-nav-button2,#pf-primary-nav-button,#pf-primary-search-button{top:'.(round($pfpadding_halfnew/1.4)).'px;z-index:3}}';


			/* Retina Logo Settings */
				$setup17_logosettings_sitelogo2x = (isset($options['setup17_logosettings_sitelogo2x']))?$options['setup17_logosettings_sitelogo2x']:'';
				if (!is_array($setup17_logosettings_sitelogo2x)) {
					$setup17_logosettings_sitelogo2x = array('url'=>'','width'=>188,'height'=>30);
				}
				$setup17_logosettings_sitelogo2x_height = (!empty($setup17_logosettings_sitelogo2x["height"]))?$setup17_logosettings_sitelogo2x["height"]:30;
				$setup17_logosettings_sitelogo2x_height_number = str_replace('px', '', $setup17_logosettings_sitelogo2x_height);
				$setup17_logosettings_sitelogo2x_width = (!empty($setup17_logosettings_sitelogo2x["width"]))?$setup17_logosettings_sitelogo2x["width"]:188;
				$setup17_logosettings_sitelogo2x_width_number = str_replace('px', '', $setup17_logosettings_sitelogo2x_width);
				if(is_array($setup17_logosettings_sitelogo2x)){
					if(count($setup17_logosettings_sitelogo2x)>0){
						$csstext .= '@media only screen and (-webkit-min-device-pixel-ratio: 1.5),(min-resolution: 144dpi){ .pf-logo-container{background-image:url('.$setup17_logosettings_sitelogo2x["url"].');background-size:'.($setup17_logosettings_sitelogo2x_width_number/2).'px '.($setup17_logosettings_sitelogo2x_height_number/2).'px;width: '.($setup17_logosettings_sitelogo2x_width_number/2).'px;}}';
					}
				}

			/* Border Radios Module */
				$generalbradius = (isset($options['generalbradius']))?$options['generalbradius']:'';
				if ($generalbradius == 1) {
					$border_radius_level = (isset($options['generalbradiuslevel']))?$options['generalbradiuslevel']:'0';
					$csstext .= '#pfupload_address{border-bottom-right-radius:0!important; border-bottom-left-radius:0!important;}';
					$csstext .= '.golden-forms .checkbox{border-radius:4px}';

					/* Full Border */
					$csstext .= '.itp-featured-img,.pf-itempage-sidebarinfo .pf-itempage-sidebarinfo-social .pf-sociallinks-item,.pf-itempage-sidebarinfo-social a.pf-itempage-sidebarinfo-social-all.button,.pfselect2container .select2-choice,.pfselect2container .select2-choices,.pfdropdown .dropdown-toggle,.pfsearchresults-header .select,.pflistgridajaxview .select,.dropdown-below .dropdown-menu-wrapper,.pftrwcontainer #pf-ajax-enquiry-form .pfsearchformerrors,#pf-review-form .pfsearchformerrors,.sidebar-widget .pfsearchformerrors,.pfagentlistrow .pf-itempage-sidebarinfo-photo::after,.ui-desc-single img.itp-featured-img,div#pfupload_map,.pfreview-body .review-author-image,.widget_pfitem_recent_entries .pf-widget-itemlist li,.pf-itempage-sidebarinfo .pf-itempage-sidebarinfo-photo img,.pf-tabfirst #pf-itempage-gallery .owl-carousel .owl-wrapper-outer, .golden-forms .textarea,.select2-search input,.pf-up-but,.slider-wrapper,.ui-slider-range,#pfuaprofileform .pfsearchformerrors,.pftcmcontainer.golden-forms .textarea,#pf-review-form .textarea,.wpfinfowindow,#pfcontrol > .pfcontrol-header ul li,.pfpack-selector-main label,#pffeaturedfileuploadfilepicker,#pfdropzoneupload,.golden-forms .input, .golden-forms .lbl-ui,.golden-forms .button, .golden-forms a.button,#pfuaprofileform .input, #pfuaprofileform .textarea, #pfuaprofileform span.button,.pflist-item,#pf-search-button,#pf-resetfilters-button, #pf-search-button-manual,.pointfinder-mini-search,input.pflistingtypeselector:empty ~ label,input.pflistingtypeselector:checked ~ label,#pointfinder_radius_search_main,.leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-bar,.leaflet-touch .leaflet-bar a,.leaflet-bar button:last-of-type,.leaflet-bar button:first-of-type,.pfinfoloading,#pfsearch-draggable .we-change-addr-input ul.typeahead__list,.leaflet-control-layers,#pffeaturedimageuploadfilepicker,#pfuploadfeaturedimg_remove,#pfuploadfeaturedfile_remove,#pfcoverimageuploadfilepicker,.golden-forms .notification,.pf-dash-userprof2 .pf-dash-purchaselink,.pf-membership-splan-button,.pf-dash-userprof2 .pf-dash-renewlink,.pf-dash-userprof2 .pf-dash-changelink,.pf-dash-userprof2 .pf-dash-cancelbanklink,.leaflet-bar.leaflet-control a,.leaflet-control-locate a,.pfselect2container,.select2-results .select2-highlighted,.pointfinder-border-radius,.pfajax_paginate >.page-numbers >li >span, .pfajax_paginate >.page-numbers >li >a, .pfstatic_paginate >.page-numbers >li >span, .pfstatic_paginate >.page-numbers >li >a,#pfuaprofileform .mce-btn-group .mce-btn,#pfuaprofileform .mce-tinymce,#wp-link-wrap,#wp-link-wrap .button,#pf-membersystem-dialog,.ui-autocomplete, #pf-membersystem-dialog .pftrwcontainer-overlay,#pf-membersystem-dialog .golden-forms.wrapper.mini, .pointfinder-dialog, #pfitemdetail-slider-mw,.select2-results__option--highlighted[aria-selected],.select2-results__option[aria-selected="true"],.pfminisearch .pfuserloading,.psearchdraggable .pfuserloading{border-radius: '.$border_radius_level.'px!important;}';


					/* Border top left/right */
					$csstext .= '#pfuaprofileform .pfhtitle,.pfsubmit-title,.pfuaformsidebar .pf-sidebar-menu li:first-child,.leaflet-bar a.leaflet-control-zoom-in:first-child,.pointfinder-border-top-lr-radius,#pfuaprofileform .mce-toolbar-grp.mce-container.mce-panel.mce-first.mce-last,#pfuaprofileform .mce-tinymce.mce-container.mce-panel,.pfitemlists-content-elements.pf4col .pflist-imagecontainer,.pfitemlists-content-elements.pf3col .pflist-imagecontainer,.pfitemlists-content-elements.pf2col .pflist-imagecontainer,.pflist-imagecontainer.pflist-subitem.pointfindernoimg + .pflist-detailcontainer.pflist-subitem,.pflist-imagecontainer.pflist-subitem.pointfinderhideallimg + .pflist-detailcontainer.pflist-subitem{border-top-left-radius:'.$border_radius_level.'px!important;border-top-right-radius:'.$border_radius_level.'px!important;}';

					/* Border top left - bottom left*/
					$csstext .= 'input.pflistingtypeselector:checked ~ label:before,input.pflistingtypeselector:empty ~ label:before,#pfitemdetail-slider-sub-mw{border-top-left-radius:'.$border_radius_level.'px!important;border-bottom-left-radius:'.$border_radius_level.'px!important;}';

					/* Border top right - bottom right*/
					$csstext .= '#pfitemdetail-slider-sub-mw{border-top-right-radius:'.$border_radius_level.'px!important;border-bottom-right-radius:'.$border_radius_level.'px!important;}';

					/* border bottom left/right*/
					$csstext .= '.select2-drop,#pfsearch-draggable .pfdragcontent,#pfuaprofileform .pfmu-itemlisting-container .pfmu-itemlisting-inner:last-of-type,.pfuaformsidebar .pf-sidebar-menu li:last-child,.pfsubmit-inner,#pfuaprofileform .pfupload-featured-item-box,input.pfpackselector:checked ~ label,input.pfpackselector:empty ~ label,input.pfpackselector:checked ~ label:after,input.pfpackselector:empty ~ label:after,.pflist-item-inner .pflist-subitem:last-child,.leaflet-bar a.leaflet-control-zoom-out:last-child,.pointfinder-border-bottom-lr-radius,#pfuaprofileform .mce-statusbar.mce-container.mce-panel.mce-stack-layout-item.mce-last,.typeahead__dropdown, .typeahead__list,.pointfinder-mini-search.hassubvalues #pfsearchsubvalues{border-bottom-left-radius:'.$border_radius_level.'px!important;border-bottom-right-radius:'.$border_radius_level.'px!important;}';

					/* Border top left */
					$csstext .= '.wpfinfowindow .wpfimage-wrapper,.pointfinder-border-topl-radius{border-top-left-radius:'.$border_radius_level.'px!important;}';

					/* Border bottom left */
					$csstext .= '.wpfinfowindow .wpfimage-wrapper,.pointfinder-border-bottoml-radius{border-bottom-left-radius:'.$border_radius_level.'px!important;}';


					$csstext .= '.pfradius-triangle-up {top: -8px!important;}';

					$setup45_bgcolor_color = $this->PFSAIssetControlN('setup45_bgcolor','color','#333333');
					$setup45_bgcolor_alpha = $this->PFSAIssetControlN('setup45_bgcolor','alpha','0.9');
					$setup45_bgcolor_status = pointfinderhex2rgbex($setup45_bgcolor_color,$setup45_bgcolor_alpha);
					$csstext .= '.pointfinderarrow_box.bottom:after,.pointfinderarrow_box.center:after{border-top-color:'.$setup45_bgcolor_status['rgb'].';border-top-color:'.$setup45_bgcolor_status['rgba'].';}';
					$csstext .= '.pointfinderarrow_box.left:after{border-right-color:'.$setup45_bgcolor_status['rgb'].';border-right-color:'.$setup45_bgcolor_status['rgba'].';}';
				}


				$setup56_searchpagemap_height = $this->PFSAIssetControlN('setup56_searchpagemap_height','height','500px');
				$setup56_mheight_theight = $this->PFSAIssetControlN('setup56_mheight_theight','height','400px');
				$setup56_mheight = $this->PFSAIssetControlN('setup56_mheight','height','390px');

				$csstext .= '#pftopmapmapcontainer,#pftopmapmapcontainer #wpf-map{height:'.$setup56_searchpagemap_height.';}';
				$csstext .= '@media (max-width: 1024px) {#pftopmapmapcontainer,#pftopmapmapcontainer #wpf-map{height:'.$setup56_mheight_theight.';}}';
				$csstext .= '@media (max-width: 568px) {#pftopmapmapcontainer,#pftopmapmapcontainer #wpf-map{height:'.$setup56_mheight.';}}';

				/* Mobile Menu System */
				$stp28_mmenu_menulocation = $this->PFSAIssetControlN('stp28_mmenu_menulocation','','left');

				$csstext .= '#pf-topprimary-navmobi2,
				#pf-topprimary-navmobi{
					'.$stp28_mmenu_menulocation.':-290px;
				}


				@media (max-width: 1024px){
					.wpf-header .pf-menu-container,
					#pf-primary-navmobile{
						'.$stp28_mmenu_menulocation.':-290px;
					}
				}
				@media (max-width: 568px) {
					.wpf-header .pf-menu-container{
						'.$stp28_mmenu_menulocation.':-290px;
					}
				}
				';

				$stp28_bb2 = $this->PFSAIssetControlN('stp28_bb2','color','#e2e2e2');
				$csstext .= '.pfmobilemenucontainer .pf-sidebar-divider{border-color:'.$stp28_bb2.'}';

				$setup22_searchresults_hide_excerpt_rl = $this->PFSAIssetControlN('setup22_searchresults_hide_excerpt_rl','','2');
				$csstext .= '.pflineclamp-excerpt{-webkit-line-clamp: '.$setup22_searchresults_hide_excerpt_rl.'!important; }';
				$setup22_tarl = $this->PFSAIssetControlN('setup22_tarl','','1');
				$csstext .= '.pflineclamp-title{-webkit-line-clamp: '.$setup22_tarl.'!important; }';
				$setup22_aarl = $this->PFSAIssetControlN('setup22_aarl','','1');
				$csstext .= '.pflineclamp-address{-webkit-line-clamp: '.$setup22_aarl.'!important; }';
				$setup10_tarl = $this->PFSAIssetControlN('setup10_tarl','','1');
				$csstext .= '.pflineclamp-title-iw{-webkit-line-clamp: '.$setup10_tarl.'!important; }';
				$setup10_aarl = $this->PFSAIssetControlN('setup10_aarl','','1');
				$csstext .= '.pflineclamp-address-iw{-webkit-line-clamp: '.$setup10_aarl.'!important; }';

			/* Custom CSS */
				$pf_general_csscode = (isset($options['pf_general_csscode']))?$options['pf_general_csscode']:'';
				if (!empty($pf_general_csscode)) {$csstext .= $pf_general_csscode;}


			

			if ($pfstickyhead != '1') {
				$csstext .= '#pfheadernav.wpf-header{position:relative}';
				$csstext .= '.pfhalfpagemapview #pfheadernav.wpf-header{position:fixed}';
				$csstext .= '.admin-bar #pfheadernav{margin-top:0!important}';
				$csstext .= '.admin-bar.pfhalfpagemapview #pfheadernav{margin-top:32px!important}';
			}
			
			return $csstext;

		}

		private function pf_hex_color_mod($hex, $diff) {
			$rgb = str_split(trim($hex, '# '), 2);

			foreach ($rgb as &$hex) {
				$dec = hexdec($hex);
				if ($diff >= 0) {
					$dec += $diff;
				}
				else {
					$dec -= abs($diff);
				}
				$dec = max(0, min(255, $dec));
				$hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
			}

			return '#'.implode($rgb);
		}

		private function PointFindergetContrast( $color) {

			$hex = str_replace( '#', '', $color );

			$c_r = hexdec( substr( $hex, 0, 2 ) );
			$c_g = hexdec( substr( $hex, 2, 2 ) );
			$c_b = hexdec( substr( $hex, 4, 2 ) );

			$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

			return $brightness > 155 ? 'black' : 'white';
		}

		private function pointfindermobilehex2rgb($hex) {
		   $hex = str_replace("#", "", $hex);

		   if(strlen($hex) == 3) {
		      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   } else {
		      $r = hexdec(substr($hex,0,2));
		      $g = hexdec(substr($hex,2,2));
		      $b = hexdec(substr($hex,4,2));
		   }

		   return $r.','.$g.','.$b;
		}
	}
}