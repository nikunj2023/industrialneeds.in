<?php 

if (!class_exists('PointFinderDynamicCSS')) {

	class PointFinderDynamicCSS
	{
		use PointFinderOptionFunctions;
		
		public function __construct(){}

		

		public function pointfinder_dynamic_css(){

			$csstext = '';$css = '';
			global $pointfindertheme_option;

			$options = $pointfindertheme_option;


			/* Start: WPML Language Selector for Mobile*/
				$csstext .= '#pf-primary-search-button{right:100px!important;}';
				$csstext .= '#pf-primary-nav-button{right:55px!important;}';
			/* End: WPML Language Selector for Mobile*/
			/* Start: Transparent Header Addon */
				
				$style_text = $logocsstext = $transparent_header_el = "";

				if (class_exists('ACF',false)) {
	                $loadacf = true;
	            }else{
	                $loadacf = false;
	            }

				if (!is_search()) {
					global $post;
					if (isset($post->ID)) {
						$transparent_header = get_post_meta( $post->ID, 'webbupointfinder_page_transparent', true );

						if (!empty($transparent_header)) {

							if ($loadacf) {

								$menulinecolor = get_field( 'webbupointfinder_page_menulinecolor',$post->ID );
								$menucolor = get_field( 'webbupointfinder_page_menucolor',$post->ID );
								$menubg = get_field("webbupointfinder_page_headerbarsettings_bgcolor",$post->ID );
								$menubg_sticky = get_field( 'webbupointfinder_page_headerbarsettings_bgcolor2',$post->ID );
								$menutextb = get_field( 'webbupointfinder_page_menutextsize',$post->ID );
								$logoadditional = get_field( 'webbupointfinder_page_logoadditional',$post->ID );

								if( have_rows('webbupointfinder_page_menucolor', $post->ID) ){

									$menucolor = array();

								    while( have_rows('webbupointfinder_page_menucolor', $post->ID) ){
								    	the_row();
								    	
								    	$menucolor['regular'] = get_sub_field('regular');
								    	$menucolor['hover'] = get_sub_field('hover');
								    }
								}
							}else{
								$menulinecolor = get_post_meta( $post->ID, 'webbupointfinder_page_menulinecolor', true );
								$menucolor = get_post_meta( $post->ID, 'webbupointfinder_page_menucolor', true );
								$menubg = get_post_meta( $post->ID, 'webbupointfinder_page_headerbarsettings_bgcolor', true );
								$menubg_sticky = get_post_meta( $post->ID, 'webbupointfinder_page_headerbarsettings_bgcolor2', true );
								$menutextb = get_post_meta( $post->ID, 'webbupointfinder_page_menutextsize', true );
								$logoadditional = get_post_meta( $post->ID, 'webbupointfinder_page_logoadditional', true );
							}
							$submenucolor = $this->PFSAIssetControl('setup18_headerbarsettings_menucolor2','regular','#282828');
							$submenuhcolor = $this->PFSAIssetControl('setup18_headerbarsettings_menucolor2','hover','#000000');
							

							if (!empty($logoadditional)) {

								/* Logo for this bar */
								$setup18_headerbarsettings_padding = $this->PFSAIssetControl('setup18_headerbarsettings_padding','margin-top','30');
								$setup18_headerbarsettings_padding_number = str_replace('px', '', $setup18_headerbarsettings_padding);
								
								$setup17_logosettings_sitelogo = $this->PFSAIssetControl('setup17_logosettings_sitelogo2','','');
								if (!is_array($setup17_logosettings_sitelogo)) {
									$setup17_logosettings_sitelogo = array('url'=>'','width'=>188,'height'=>30);
								} 
								$setup17_logosettings_sitelogo_height = (!empty($setup17_logosettings_sitelogo["height"]))?$setup17_logosettings_sitelogo["height"]:30;
								$setup17_logosettings_sitelogo_height_number = str_replace('px', '', $setup17_logosettings_sitelogo_height);
								$setup17_logosettings_sitelogo_width = (!empty($setup17_logosettings_sitelogo["width"]))?$setup17_logosettings_sitelogo["width"]:188;
								$setup17_logosettings_sitelogo_width_number = str_replace('px', '', $setup17_logosettings_sitelogo_width);

								$setup17_logosettings_sitelogo2x = $this->PFSAIssetControl('setup17_logosettings_sitelogo22x','','');
								if (!is_array($setup17_logosettings_sitelogo2x)) {
									$setup17_logosettings_sitelogo2x = array('url'=>'','width'=>188,'height'=>30);
								}
								$setup17_logosettings_sitelogo2x_height = (!empty($setup17_logosettings_sitelogo2x["height"]))?$setup17_logosettings_sitelogo2x["height"]:30;
								$setup17_logosettings_sitelogo2x_height_number = str_replace('px', '', $setup17_logosettings_sitelogo2x_height);
								$setup17_logosettings_sitelogo2x_width = (!empty($setup17_logosettings_sitelogo2x["width"]))?$setup17_logosettings_sitelogo2x["width"]:188;
								$setup17_logosettings_sitelogo2x_width_number = str_replace('px', '', $setup17_logosettings_sitelogo2x_width);

								$pfpadding_half = $setup18_headerbarsettings_padding_number / 2;

								/*Logo Settings*/
									$logocsstext .= '.wpf-header.pftransparenthead .pf-logo-container, .wpf-header.pftransparenthead .pf-logo-container.additionallogo{margin:'.$setup18_headerbarsettings_padding.' 0;height: '.$setup17_logosettings_sitelogo_height_number.'px;}';
									$logocsstext .= '.wpf-header.pftransparenthead .pf-logo-container, .wpf-header.pftransparenthead .pf-logo-container.additionallogo{background-image:url('.$setup17_logosettings_sitelogo["url"].');background-size:'.$setup17_logosettings_sitelogo_width_number.'px '.$setup17_logosettings_sitelogo_height_number.'px;width: '.$setup17_logosettings_sitelogo_width_number.'px;}';

									$logocsstext .= '@media (max-width: 568px) {.wpf-header.pftransparenthead .pf-logo-container{height: '.($setup17_logosettings_sitelogo_height_number/2).'px;margin:'.$pfpadding_half.'px 0;}.wpf-header.pftransparenthead .pf-logo-container{background-size:'.($setup17_logosettings_sitelogo_width_number/2).'px '.($setup17_logosettings_sitelogo_height_number/2).'px;width: '.($setup17_logosettings_sitelogo_width_number/2).'px;}}';



								/* Retina Logo Settings */
									if(is_array($setup17_logosettings_sitelogo2x)){
										if(count($setup17_logosettings_sitelogo2x)>0){
											$logocsstext .= '@media only screen and (-webkit-min-device-pixel-ratio: 1.5),(min-resolution: 144dpi){.wpf-header.pftransparenthead .pf-logo-container{background-image:url('.$setup17_logosettings_sitelogo2x["url"].');background-size:'.($setup17_logosettings_sitelogo2x_width_number/2).'px '.($setup17_logosettings_sitelogo2x_height_number/2).'px;width: '.($setup17_logosettings_sitelogo2x_width_number/2).'px;}}';
										}
									}
							}



							
							$csstext .= "@media (min-width: 1025px) {";
							$csstext .= $logocsstext;


							if (!empty($menucolor)) {
								$csstext .= ".wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li a,.wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li.selected > a{color:".$menucolor['regular'].";}";
			                    $csstext .= ".wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li a:hover,.wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li.selected > a:hover{color:".$menucolor['hover'].";}";
			                    $csstext .= ".wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link{color:".$submenucolor."!important}";
			                     $csstext .= ".wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link:hover{color:".$submenuhcolor."!important}";
							}

							if (!empty($menulinecolor)) {
								$csstext .= ".wpf-header.pftransparenthead #pf-primary-nav li.current_page_item > a,.wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li > a:hover{border-bottom: 2px solid ".$menulinecolor.";}";
								$csstext .= ".wpf-header.pftransparenthead #pf-primary-nav .pfnavmenu li.selected > .pfnavsub-menu{border-top: 2px solid ".$menulinecolor.";}";
							}

							if (!empty($menubg) && !$loadacf) {
								$csstext .= ".wpf-header.pftransparenthead{background:".$menubg['color'].";background:".$menubg['rgba'].";}";
							}

							if ($loadacf) {
								
								if (isset($menubg["color"])) {
									$csstext .= ".wpf-header.pftransparenthead{background:".$menubg['color'].";background:rgba(".$this->pointfindermobilehex2rgb($menubg['color']).",".$menubg['opacity'].");}";
								}
							}


							if (!empty($menubg_sticky) && !$loadacf) {
								$csstext .= ".wpf-header.pftransparenthead.pfshrink{background:".$menubg_sticky['color'].";background:".$menubg_sticky['rgba'].";}";
							}

							if ($loadacf) {
								
								if (isset($menubg_sticky["color"])) {
									$csstext .= ".wpf-header.pftransparenthead.pfshrink{background:".$menubg_sticky['color'].";background:rgba(".$this->pointfindermobilehex2rgb($menubg_sticky['color']).",".$menubg_sticky['opacity'].");}";
								}
							}

							$csstext .= "}";

						}

						if ($loadacf) {
							
							$webbupointfinder_gbf_status = get_field( 'webbupointfinder_gbf_status', $post->ID);

							if (!empty($webbupointfinder_gbf_status)) {

								
								if( have_rows('webbupointfinder_gbf_bgopt2', $post->ID) ){

									$csstext .= '.wpf-footer-row-move.wpf-footer-row-movepg:before{';

								    while( have_rows('webbupointfinder_gbf_bgopt2', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= 'background-color:'.get_sub_field('color').';';
								    	$csstext .= 'background-image: url('.get_sub_field('image').');';
								    	$csstext .= 'background-repeat:'.get_sub_field('repeat').';';
								    	$csstext .= 'background-size:'.get_sub_field('size').';';
								    	$csstext .= 'background-position:'.get_sub_field('position').';';
								    }

								    $csstext .= '}';
								}

								if( have_rows('webbupointfinder_gbf_bgopt2w', $post->ID) ){

									$csstext .= '.wpf-footer-row-move.wpf-footer-row-movepg:before{';

								    while( have_rows('webbupointfinder_gbf_bgopt2w', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= 'height:'.get_sub_field('height').get_sub_field('unit').';';
								    	
								    }

								    $csstext .= '}';
								}

								if( have_rows('webbupointfinder_gbf_bgopt2m', $post->ID) ){

									$csstext .= '.wpf-footer-row-move.wpf-footer-row-movepg:before{';

								    while( have_rows('webbupointfinder_gbf_bgopt2m', $post->ID) ){
								    	the_row();
								    	$unit = get_sub_field('unit');
								    	$csstext .= 'margin-top:'.get_sub_field('top').$unit.';';
								    	$csstext .= 'margin-bottom:'.get_sub_field('bottom').$unit.';';
								    }

								    $csstext .= '}';
								}
								
								if( have_rows('webbupointfinder_gbf_bgopt', $post->ID) ){

									$csstext .= '.pointfinderexfooterclassxpg{';

								    while( have_rows('webbupointfinder_gbf_bgopt', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= 'background-color:'.get_sub_field('color').';';
								    	$csstext .= 'background-image: url('.get_sub_field('image').');';
								    	$csstext .= 'background-repeat:'.get_sub_field('repeat').';';
								    	$csstext .= 'background-size:'.get_sub_field('size').';';
								    	$csstext .= 'background-position:'.get_sub_field('position').';';
								    }

								    $csstext .= '}';
								}

								$webbupointfinder_gbf_textcolor1 = get_field( 'webbupointfinder_gbf_textcolor1',$post->ID );
								$csstext .= '.pointfinderexfooterclasspg{color:'.$webbupointfinder_gbf_textcolor1.';}';

								if( have_rows('webbupointfinder_gbf_textcolor2', $post->ID) ){
								    while( have_rows('webbupointfinder_gbf_textcolor2', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= '.pointfinderexfooterclasspg a{color:'.get_sub_field('regular').';}';
								    	$csstext .= '.pointfinderexfooterclasspg a:hover{color:'.get_sub_field('hover').';}';
								    }
								}

								if( have_rows('webbupointfinder_gbf_spacing', $post->ID) ){

									$csstext .= '.pointfinderexfooterclasspg{';

								    while( have_rows('webbupointfinder_gbf_spacing', $post->ID) ){
								    	the_row();
								    	$unit = get_sub_field('unit');
								    	$csstext .= 'padding-top:'.get_sub_field('top').$unit.';';
								    	$csstext .= 'padding-bottom:'.get_sub_field('bottom').$unit.';';
								    }

								    $csstext .= '}';
								}

								if( have_rows('webbupointfinder_gbf_spacing2', $post->ID) ){

									$csstext .= '.pointfinderexfooterclassxpg{';

								    while( have_rows('webbupointfinder_gbf_spacing2', $post->ID) ){
								    	the_row();
								    	$unit = get_sub_field('unit');
								    	$csstext .= 'margin-top:'.get_sub_field('top').$unit.';';
								    	$csstext .= 'margin-bottom:'.get_sub_field('bottom').$unit.';';
								    }

								    $csstext .= '}';
								}

								if( have_rows('webbupointfinder_gbf_border', $post->ID) ){

									$csstext .= '.pointfinderexfooterclassxpg{';

								    while( have_rows('webbupointfinder_gbf_border', $post->ID) ){
								    	the_row();
								    	$top_w = get_sub_field('top');
								    	$bottom_w = get_sub_field('bottom');
								    	$unit = get_sub_field('unit');

								    	if (!empty($top_w) || !empty($top_w)) {
								    		if (!empty($top_w)) {
								    			$csstext .= 'border-top:'.$top_w.$unit.';';
								    		}
									    	if (!empty($bottom_w)) {
									    		$csstext .= 'border-bottom:'.$bottom_w.$unit.';';
									    	}
									    	$csstext .= 'border-style:solid;';
									    	$csstext .= 'border-color:'.get_sub_field('color').';';
								    	}
								    	
								    }

								    $csstext .= '}';
								}

							}

							$pf_sbmt_status = get_field( 'pf_sbmt_status', $post->ID);
							if (!empty($pf_sbmt_status)) {

								if( have_rows('pf_sbmt_textcolor', $post->ID) ){
								    while( have_rows('pf_sbmt_textcolor', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a, #pfpostitemlinkmobile{color:'.get_sub_field('regular').'!important;}';
								    	$csstext .= '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a:hover, #pfpostitemlinkmobile:hover{color:'.get_sub_field('hover').'!important;}';
								    }
								}

								if( have_rows('pf_sbmt_backgroundcolor', $post->ID) ){
								    while( have_rows('pf_sbmt_backgroundcolor', $post->ID) ){
								    	the_row();
								    	
								    	$csstext .= '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a, #pfpostitemlinkmobile{background-color:'.get_sub_field('regular').'!important;}';
								    	$csstext .= '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a:hover, #pfpostitemlinkmobile:hover{background-color:'.get_sub_field('hover').'!important;}';
								    }
								}

								if( have_rows('pf_sbmt_border', $post->ID) ){

									$csstext .= '.wpf-header #pf-primary-nav .pfnavmenu #pfpostitemlink a, #pfpostitemlinkmobile{';

								    while( have_rows('pf_sbmt_border', $post->ID) ){
								    	the_row();
								    	$color = get_sub_field('color');
								    	$width = get_sub_field('width');
								    	$type = get_sub_field('type');
								    	$radius = get_sub_field('radius');

								    	if (!empty($width)) {
								    		$csstext .= 'border:'.$width.'px '.$type.' '.$color.'!important;';
								    	}

								    	if (!empty($radius)) {
								    		$csstext .= 'border-radius:'.$radius.'px!important;';
								    	}
								    	
								    }

								    $csstext .= '}';
								}

								
							}
						}
					}
				}
			/* End: Transparent Header Addon */


			if(is_tax() || is_tag() || is_category() || is_search()){
				$general_ct_page_layout = $this->PFSAIssetControl('general_ct_page_layout','','1');
				if( $general_ct_page_layout == 3 ) {
					$csstext .= "html{height:100%;background-color:#ffffff!important}";
				}
			}

			wp_add_inline_style( 'pf-main-compiler', $csstext );
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