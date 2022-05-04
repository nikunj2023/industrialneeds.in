<?php

if (!trait_exists('PointFinderTextSearchField')) {

	trait PointFinderTextSearchField
	{
	   

	    public function pointfinder_get_search_text_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
							
				$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target_target','','');

				$itemparent = $this->CheckItemsParent($target);
				
				if($itemparent == 'none'){

					$validation_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_validation_required','','0');
					$field_autocmplete = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_autocmplete','','1');

					if($validation_check == 1){
						$validation_message = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_message','','');
						
						if($this->VSOMessages != ''){
							$this->VSOMessages .= ','.$slug.':"'.$validation_message.'"';
						}else{
							$this->VSOMessages = $slug.':"'.$validation_message.'"';
						}
						
						if($this->VSORules != ''){
							$this->VSORules .= ','.$slug.':"required"';
						}else{
							$this->VSORules = $slug.':"required"';
						}
					}
					
					$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');
					$placeholder = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_placeholder','','');
					$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');


					if($column_type == 1){
						if ($this->PFHalf % 2 == 0) {
							$this->FieldOutput .= '<div class="col6 last">';
						}else{
							$this->FieldOutput .= '<div class="pfsfield">';
							$this->FieldOutput .= '<div class="row"><div class="col6 first">';
						}
						$this->PFHalf++;
					}else{
						$this->FieldOutput .= '<div class="pfsfield">';
					};

					if (array_key_exists($slug,$pfgetdata)) {
						$valtext = ' value = "'.$pfgetdata[$slug].'" ';;
					}else{
						$valtext = '';
					}

					
					if ($target == 'google') {

						$geolocfield = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_geolocfield','','0');
						$geolocfield = ($geolocfield == 1)? 'Mile':'Km';
						$geolocfield2 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_geolocfield2','','100');

						if ($widget == 0) {
							
							
							$this->FieldOutput .= '
							<div id="'.$slug.'_main" class="pfmapgoogleaddon">
								<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
									<div class="pflabelfixsearchmain">
									<div class="typeahead__container we-change-addr-input"><div class="typeahead__field"><span class="typeahead__query"><label class="pflabelfixsearch lbl-ui search"><input autocomplete="off" type="search" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' /></label> </span></div></div>

									<input type="hidden" name="pointfinder_google_search_coord" id="pointfinder_google_search_coord" class="input" value="" />
									<input type="hidden" name="pointfinder_google_search_coord_unit" id="pointfinder_google_search_coord_unit" class="input" value="'.$geolocfield.'" />
									<a class="button" id="pf_search_geolocateme" title="'.esc_html__('Locate me!','pointfindercoreelements').'"><i class="far fa-compass pf-search-locatemebut"></i><div class="pf-search-locatemebutloading"></div></a>
									<a class="button" id="pf_search_geodistance" title="'.esc_html__('Distance','pointfindercoreelements').'"><i class="fas fa-cog"></i></a>
									</div>
								
							';
							
							$this->FieldOutput .= '
								<div id="pointfinder_radius_search_mainerror" class="pointfinder-border-radius pointfinder-border-color"><div class="pfgeotriangle pf-arrow-box pf-arrow-top"></div>'.esc_html__('Please click to geolocate button to change this value.','pointfindercoreelements').'</div>
								<div id="pointfinder_radius_search_main" class="pointfinder-border-radius pointfinder-border-color">
								<div class="pfgeotriangle pf-arrow-box pf-arrow-top"></div>
									<label for="pointfinder_radius_search-view" class="pfrangelabel">'.esc_html__('Distance','pointfindercoreelements').' ('.$geolocfield.') :</label>
									<input type="text" id="pointfinder_radius_search-view" class="slider-input" disabled="" style="width: 44%;">
									<input name="pointfinder_radius_search" id="pointfinder_radius_search-view2" type="hidden" class="pfignorevalidation"> 
									<input name="pointfinder_areatype" id="pointfinder_areatype" type="hidden" class="pfignorevalidation"> 
									<div class="slider-wrapper">
										<div id="pointfinder_radius_search" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-pointfinder_radius_search">
											<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"></div>
											<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
										</div>  
									</div>
								</div> 

							</div>                        
							';
							
							
							$wemap_geoctype = $this->PFSAIssetControl('wemap_geoctype','','');
							$this->ScriptOutput .= "
							$('#pf_search_geolocateme i').on('click',function(e){
								e.stopPropagation();
								
								$('#pfsearch-draggable .typeahead__container.we-change-addr-input .typeahead__field input').css('padding-right','48px');
								$('.pf-search-locatemebut').hide('fast');
								$('.pf-search-locatemebutloading').show('fast');
								$.pfgeolocation_findme('".$slug."','".$wemap_geoctype."');
							});
							
							";
							
							$this->ScriptOutput .= '
							if($.pf_tablet2_check() && theme_scriptspf.ttstatus == 1){
					  			$("#'.$slug.'_main a").tooltip(
					  				{
									  tooltipClass: "wpfquick-tooltip",
									  position: { my: "center+50 bottom", at: "center top+8", },
									  show: {
										duration: "fast"
									  },
									  hide: {
									  	effect: "hide"
									  }
									}
					  			);
					  		}
					  		';

					  		$setup5_typs = $this->PFSAIssetControl('setup5_typs','','geocode');
							$wemap_country = $this->PFSAIssetControl('wemap_country','','');
							if ($wemap_geoctype == 'google') {

								$this->ScriptOutput .= $this->googlemaps_autocomplete_script($slug);
								
							}elseif ($wemap_geoctype == 'here') {

								$this->ScriptOutput .= $this->heremaps_autocomplete_script($slug);

							}elseif ($wemap_geoctype == 'yandex') {

								$this->ScriptOutput .= $this->yandexmaps_autocomplete_script($slug);

							}elseif ($wemap_geoctype == 'mapbox') {

								$this->ScriptOutput .= $this->mapboxmaps_autocomplete_script($slug);

							}else{
								$this->ScriptOutput .= '
								$.typeahead({
								    input: "#'.$slug.'",
								    minLength: 2,
								    accent: true,
								    dynamic:true,
								    compression: false,
								    cache: false,
									hint: false,
									loadingAnimation: true,
									cancelButton: true,
									debug: false,
									searchOnFocus: false,
									delay: 300,
									group: false,
									filter: false,
									maxItem: 10,
									maxItemPerGroup: 10,
									emptyTemplate: "'.wp_sprintf( esc_html__( "No results found for %s", "pointfindercoreelements" ), "<b>{{query}}</b>" ).'",
									template: "{{address}}",
									templateValue: "{{address}}",
									selector: {
								        cancelButton: "typeahead__cancel-button2"
								    },
								    source: {
								        "found": {
								          ajax: {
								          	type: "GET",
								              url: theme_scriptspf.ajaxurl,
								              dataType: "json",
								              path: "data.found",
								              data: {
								              	action: "pfget_geocoding",
								              	security: theme_scriptspf.pfget_geocoding,
								              	q: "{{query}}",
								              	option: "geocode",
								              	ctype: "'.$wemap_geoctype.'"
								              }
								          }
								        }
								    },
								    callback: {
								    	onLayoutBuiltAfter:function(){
											$(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#'.$slug.'").outerWidth());
											$(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#'.$slug.'").outerWidth());
											$("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
								    	},
								    	onClickBefore: function(){
											$("#pfsearch-draggable .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
							    		},
										onClickAfter: function(node, a, item, event){
											event.preventDefault();
											
											$("#'.$slug.'").val(item.address);
											
											$("#pointfinder_google_search_coord").val(item.lat+","+item.lng);
											
											$(".typeahead__cancel-button2").css("visibility","visible");
										},
										onCancel: function(node,event){
											$(".typeahead__cancel-button2").css("visibility","hidden");
											$("#pointfinder_google_search_coord").val("");
							        	}
								    }
								});';
							}
							
							$pointfinder_radius_search_val = $this->PFSAIssetControl('setup7_geolocation_distance','','10');

							if (isset($_GET['pointfinder_radius_search'])) {
								if (!empty(absint($_GET['pointfinder_radius_search']))) {
									$pointfinder_radius_search_val = absint($_GET['pointfinder_radius_search']);
								}
							}
							

							$this->ScriptOutput .= '
								$( "#pointfinder_radius_search" ).slider({
									range: "min",value:'.$pointfinder_radius_search_val.',min: 0,max: '.$geolocfield2.',step: 1,
									slide: function(event, ui) {
										$("#pointfinder_radius_search-view").val(ui.value);
										$("#pointfinder_radius_search-view2").val(ui.value);
									}
								});

								$("#pointfinder_radius_search-view").val( $("#pointfinder_radius_search").slider("value"));

												
								$(document).one("ready",function(){
									$("#pointfinder_radius_search-view2").val('.$pointfinder_radius_search_val.');
								});
							';

							$this->ScriptOutput .= "
							$('#pointfinder_radius_search').slider({
							    stop: function(event, ui) {
									var coord_value = $('#pointfinder_google_search_coord').val();
									if(coord_value != 'undefined'){
										var coord_value1 = coord_value.split(',');
										$.pointfindersetboundsex(parseFloat(coord_value1[0]),parseFloat(coord_value1[1]));	
									}
							    }
							});
							";
							
						}else{


							$nefv = $ne2fv = $swfv = $sw2fv = $pointfinder_google_search_coord1 = '';
							$wemap_geoctype = $this->PFSAIssetControl('wemap_geoctype','','google');
							if (isset($_GET['pointfinder_google_search_coord'])) {$pointfinder_google_search_coord1 = $_GET['pointfinder_google_search_coord'];}
							
							if ($minisearch == 1) {
								$statustextform2 = 'class="pfminigoogleaddon"';
							}else{$statustextform2 = 'class="pfwidgetgoogleaddon"';}


							$stp5_mapty = $this->PFSAIssetControl('stp5_mapty','',1);
							$setup42_mheight = $this->PFSAIssetControl('setup42_mheight','height','350');
							$setup42_mheight = str_replace('px', '', $setup42_mheight);
							$setup42_theight = $this->PFSAIssetControl('setup42_theight','height','400');
							$setup42_theight = str_replace('px', '', $setup42_theight);

							$we_special_key = $wemap_here_appid = $wemap_here_appcode = '';
								    
							switch ($stp5_mapty) {
								case 1:
									$we_special_key = $this->PFSAIssetControl('setup5_map_key','','');
									break;

								case 3:
									$we_special_key = $this->PFSAIssetControl('stp5_mapboxpt','','');
									break;

								case 5:
									$wemap_here_appid = $this->PFSAIssetControl('wemap_here_appid','','');
									$wemap_here_appcode = $this->PFSAIssetControl('wemap_here_appcode','','');
									break;

								case 6:
									$we_special_key = $this->PFSAIssetControl('wemap_bingmap_api_key','','');
									break;

								case 4:
									$we_special_key = $this->PFSAIssetControl('wemap_yandexmap_api_key','','');
									break;
							}

							
							
							$setup7_geolocation_distance = $this->PFSAIssetControl('setup7_geolocation_distance','',10);
							$setup7_geolocation_distance_unit = $this->PFSAIssetControl('setup7_geolocation_distance_unit','',"km");
							$setup7_geolocation_hideinfo = $this->PFSAIssetControl('setup7_geolocation_hideinfo','',1);
							$setup6_clustersettings_status = $this->PFSAIssetControl('setup6_clustersettings_status','',1);
							$stp6_crad = $this->PFSAIssetControl('stp6_crad','',100);

							wp_enqueue_script( 'theme-leafletjs' );
							wp_enqueue_style( 'theme-leafletcss');
							$this->FieldOutput .= '
							<div id="pfwidgetmap" 
							data-mode="topmap" 
						    data-lat="0" 
				    		data-lng="0" 
				    		data-zoom="12" 
				    		data-zoomm="12" 
				    		data-zoommx="12" 
				    		data-mtype="'.$stp5_mapty.'" 
				    		data-key="'.$we_special_key.'" 
				    		data-hereappid="'.$wemap_here_appid.'" 
							data-hereappcode="'.$wemap_here_appcode.'" 
							data-gldistance="'.$setup7_geolocation_distance.'" 
							data-gldistanceunit="'.$setup7_geolocation_distance_unit.'" 
							data-gldistancepopup="'.$setup7_geolocation_hideinfo.'" 
							data-found=""  
							data-cluster="'.$setup6_clustersettings_status.'" 
							data-clusterrad="'.$stp6_crad.'" 
							style="display:none;"></div>
							<div id="'.$slug.'_main" '.$statustextform2.'>
								<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
								
								<div class="pflabelfixsearchmain">
									<div class="typeahead__container we-change-addr-input"><div class="typeahead__field"><span class="typeahead__query"><label class="pflabelfixsearch lbl-ui search"><input autocomplete="off" type="search" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' /></label> </span></div></div>
									<input type="hidden" name="pointfinder_google_search_coord" id="pointfinder_google_search_coord" class="input" value="'.$pointfinder_google_search_coord1.'" />
									<input type="hidden" name="pointfinder_google_search_coord_unit" id="pointfinder_google_search_coord_unit" class="input" value="'.$geolocfield.'" />
									<a class="button" id="pf_search_geolocateme" title="'.esc_html__('Locate me!','pointfindercoreelements').'"><i class="far fa-compass pf-search-locatemebut"></i><div class="pf-search-locatemebutloading"></div></a>
									<a class="button" id="pf_search_geodistance" title="'.esc_html__('Distance','pointfindercoreelements').'"><i class="fas fa-cog"></i></a>
								</div>
							';

							$pointfinder_areatype = '';
							
							if (isset($_GET['ne'])) {$nefv = floatval($_GET['ne']);}
							if (isset($_GET['ne2'])) {$ne2fv = floatval($_GET['ne2']);}
							if (isset($_GET['sw'])) {$swfv = floatval($_GET['sw']);}
							if (isset($_GET['sw2'])) {$sw2fv = floatval($_GET['sw2']);}
							if (isset($_GET['pointfinder_radius_search'])) {$pointfinder_radius_search_val = $_GET['pointfinder_radius_search'];}
							if (isset($_GET['pointfinder_areatype'])) {$pointfinder_areatype = $_GET['pointfinder_areatype'];}
							
							if (empty($pointfinder_radius_search_val)) {
							    $pointfinder_radius_search_val = $this->PFSAIssetControl('setup7_geolocation_distance','','10');
							    if (isset($_GET['pointfinder_radius_search'])) {
									if (!empty(absint($_GET['pointfinder_radius_search']))) {
										$pointfinder_radius_search_val = absint($_GET['pointfinder_radius_search']);
									}
								}
							}
							if ($minisearch == 1) {
								$statustextform = ' style="display:none;"';
							}else{$statustextform = '';}

							$this->FieldOutput .= '
								<div id="pointfinder_radius_search_mainerror" class="pointfinder-border-radius pointfinder-border-color"><div class="pfgeotriangle pf-arrow-box pf-arrow-top"></div>'.esc_html__('Please click to geolocate button to change this value.','pointfindercoreelements').'</div>
								<div id="pointfinder_radius_search_main" class="pointfinder-border-radius pointfinder-border-color"'.$statustextform.'>
								<div class="pfgeotriangle pf-arrow-box pf-arrow-top"></div>
									<label for="pointfinder_radius_search-view" class="pfrangelabel">'.esc_html__('Distance','pointfindercoreelements').' ('.$geolocfield.') :</label>
									<input type="text" id="pointfinder_radius_search-view" class="slider-input" disabled="" style="width: 44%;">
									<input name="pointfinder_radius_search" id="pointfinder_radius_search-view2" type="hidden" class="pfignorevalidation">
									<input name="pointfinder_areatype" id="pointfinder_areatype" type="hidden" class="pfignorevalidation" value="'.$pointfinder_areatype.'">
									<div class="slider-wrapper">
										<div id="pointfinder_radius_search" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-pointfinder_radius_search">
											<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"></div>
											<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
										</div>  
									</div>
									<input type="hidden" name="ne" id="pfw-ne" class="input" value="'.$nefv.'" />
									<input type="hidden" name="ne2" id="pfw-ne2" class="input" value="'.$ne2fv.'" />
									<input type="hidden" name="sw" id="pfw-sw" class="input" value="'.$swfv.'" />
									<input type="hidden" name="sw2" id="pfw-sw2" class="input" value="'.$sw2fv.'" />
								</div> 

							</div>                        
							';
							
							$this->ScriptOutput .= "

							$(function(){
								";
								if (!empty($pointfinder_radius_search_val)) {
									$this->ScriptOutput .= "											
									$( '#pointfinder_radius_search' ).slider( 'option', 'value', ".$pointfinder_radius_search_val." );
									$( '#pointfinder_radius_search-view' ).val( ".$pointfinder_radius_search_val." );
									";

								}
								$this->ScriptOutput .= "
								
							});
				
							$('#pf_search_geolocateme i').on('click',function(e){
								e.stopPropagation();
								
								$('.pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input').css('padding-right','48px');
								$('.pf-search-locatemebut').hide('fast');
								$('.pf-search-locatemebutloading').show('fast');
								$.pfgeolocation_findme('".$slug."','".$wemap_geoctype."');
							});
							";
							
							if ($wemap_geoctype == 'google') {

								$this->ScriptOutput .= $this->googlemaps_autocomplete_script($slug);
								
							}elseif ($wemap_geoctype == 'here') {

								$this->ScriptOutput .= $this->heremaps_autocomplete_script($slug);

							}elseif ($wemap_geoctype == 'yandex') {

								$this->ScriptOutput .= $this->yandexmaps_autocomplete_script($slug);

							}elseif ($wemap_geoctype == 'mapbox') {

								$this->ScriptOutput .= $this->mapboxmaps_autocomplete_script($slug);
							}else{
								$this->ScriptOutput .= '
									$.typeahead({
									    input: "#'.$slug.'",
									    minLength: 2,
									    accent: true,
									    dynamic:true,
									    compression: false,
									    cache: false,
										hint: false,
										loadingAnimation: true,
										cancelButton: true,
										debug: true,
										searchOnFocus: false,
										delay: 300,
										group: false,
										filter: false,
										maxItem: 10,
										maxItemPerGroup: 10,
										emptyTemplate: "'.wp_sprintf( esc_html__( "No results found for %s", "pointfindercoreelements" ), "<b>{{query}}</b>" ).'",
										template: "{{address}}",
										templateValue: "{{address}}",
										selector: {
									        cancelButton: "typeahead__cancel-button2"
									    },
									    source: {
									        "found": {
									          ajax: {
								          		type: "GET",
								              	url: theme_scriptspf.ajaxurl,
								              	dataType: "json",
								              	path: "data.found",
								              	data: {
									              	action: "pfget_geocoding",
									              	security: theme_scriptspf.pfget_geocoding,
									              	q: "{{query}}",
									              	option: "geocode",
									              	ctype: "'.$wemap_geoctype.'"
								              	}
									          }
									        }
									    },
									    callback: {
									    	onLayoutBuiltAfter:function(){
												$(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#'.$slug.'").outerWidth());
												$(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#'.$slug.'").outerWidth());
												$("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
									    	},
									    	onClickBefore: function(){
									    		
												$(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
								    		},
											onClickAfter: function(node, a, item, event){
												event.preventDefault();
												
												$("#'.$slug.'").val(item.address);
												
												$("#pointfinder_google_search_coord").val(item.lat+","+item.lng);
												$.pointfindersetbounds(item.lat,item.lng);
											},
											onCancel: function(node,event){
												$("#pointfinder_google_search_coord").val("");
								        	}
									    }
									});';
							}
							
							
							$this->ScriptOutput .= "
							$('#pointfinder_radius_search').slider({
							    stop: function(event, ui) {
									var coord_value = $('#pointfinder_google_search_coord').val();
									if(coord_value != 'undefined'){
										var coord_value1 = coord_value.split(',');
										$.pointfindersetbounds(parseFloat(coord_value1[0]),parseFloat(coord_value1[1]));
									}
							    }
							});
							";

							$this->ScriptOutput .= '
								$( "#pointfinder_radius_search" ).slider({
									range: "min",value:'.$pointfinder_radius_search_val.',min: 0,max: '.$geolocfield2.',step: 1,
									slide: function(event, ui) {
										$("#pointfinder_radius_search-view").val(ui.value);
										$("#pointfinder_radius_search-view2").val(ui.value);
									}
								});

								$("#pointfinder_radius_search-view").val( $("#pointfinder_radius_search").slider("value"));

												
								$(document).one("ready",function(){
									$("#pointfinder_radius_search-view2").val('.$pointfinder_radius_search_val.');
								});
							';

						}

					}elseif ($target == 'title' || $target == 'address') {
						
						$this->FieldOutput .= '
						<div id="'.$slug.'_main" class="ui-widget">
						<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
						<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
							<input type="text" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' />
						</label>    
						</div>                        
						';
						
						if($field_autocmplete == 1){
							$this->ScriptOutput .= '
							$( "#'.$slug.'" ).on("keydown",function(){


							$( "#'.$slug.'" ).autocomplete({
							  position: { my : "right top", at: "right bottom" },
							  appendTo: "#'.$slug.'_main",
						      source: function( request, response ) {
						        $.ajax({
						          url: theme_scriptspf.ajaxurl,
						          dataType: "jsonp",
						          data: {
						          	action: "pfget_autocomplete",
						            q: request.term,
						            security: theme_scriptspf.pfget_autocomplete,
						            lang: "'.$lang_custom.'",
						            ftype: "'.$target.'"
						          },
						          success: function( data ) {
						            response( data );
						          }
						        });
						      },
						      minLength: 2,
						      select: function( event, ui ) {
						        $("#'.$slug.'").val(ui.item);
						      },
						      open: function() {
								console.log($("body").find("#'.$slug.'").outerWidth());
						        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
						        $( ".ui-autocomplete" ).css("width",$("body").find("#'.$slug.'").outerWidth());
						      },
						      close: function() {
						        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
						      }
						    });

							});
							';
						}


					}elseif ($target == 'description' || $target == 'title_description') {

						$this->FieldOutput .= '
						<div id="'.$slug.'_main" class="ui-widget">
						<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
						<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
							<input type="text" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' />
						</label>    
						</div>                        
						';

						if($field_autocmplete == 1){
							$this->ScriptOutput .= '
							$( "#'.$slug.'" ).on("keydown",function(){


							$( "#'.$slug.'" ).autocomplete({
								position: { my : "right top", at: "right bottom" },
							  appendTo: "#'.$slug.'_main",
						      source: function( request, response ) {
						        $.ajax({
						          url: theme_scriptspf.ajaxurl,
						          dataType: "jsonp",
						          data: {
						          	action: "pfget_autocomplete",
						            q: request.term,
						            security: theme_scriptspf.pfget_autocomplete,
						            lang: "'.$lang_custom.'",
						            ftype: "'.$target.'"
						          },
						          success: function( data ) {
						            response( data );
						          }
						        });
						      },
						      minLength: 2,
						      select: function( event, ui ) {
						        $("#'.$slug.'").val(ui.item);
						      },
						      open: function() {
						        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
						        $( ".ui-autocomplete" ).css("width",$("body").find("#'.$slug.'").outerWidth());
						      },
						      close: function() {
						        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
						      }
						    });

							});
							';
						}
					}elseif ($target == 'listingid') {

						$this->FieldOutput .= '
						<div id="'.$slug.'_main" class="ui-widget">
						<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
						<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
							<input type="text" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' />
						</label>    
						</div>                        
						';

						if($field_autocmplete == 1){
							$this->ScriptOutput .= '
							$( "#'.$slug.'" ).on("keydown",function(){


							$( "#'.$slug.'" ).autocomplete({
								position: { my : "right top", at: "right bottom" },
							  appendTo: "#'.$slug.'_main",
						      source: function( request, response ) {
						        $.ajax({
						          url: theme_scriptspf.ajaxurl,
						          dataType: "jsonp",
						          data: {
						          	action: "pfget_autocomplete",
						            q: request.term,
						            security: theme_scriptspf.pfget_autocomplete,
						            lang: "'.$lang_custom.'",
						            ftype: "'.$target.'"
						          },
						          success: function( data ) {
						            response( data );
						          }
						        });
						      },
						      minLength: 1,
						      select: function( event, ui ) {
						        $("#'.$slug.'").val(ui.item);
						      },
						      open: function() {
						        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
						        $( ".ui-autocomplete" ).css("width",$("body").find("#'.$slug.'").outerWidth());
						      },
						      close: function() {
						        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
						      }
						    });

							});
							';
						}
					}elseif ($target == 'search_all') {

						$searchall_click = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_searchall_click','','0');
						$setup3_pointposttype_pt7 = $this->PFSAIssetControl('setup3_pointposttype_pt7','','Listing Types');
						$setup3_pointposttype_pt4 = $this->PFSAIssetControl('setup3_pointposttype_pt4','','Item Types');
						$setup3_pointposttype_pt5 = $this->PFSAIssetControl('setup3_pointposttype_pt5','','Locations');
						$setup3_pointposttype_pt6 = $this->PFSAIssetControl('setup3_pointposttype_pt6','','Features');
						$setup3_pointposttype_pt3 = $this->PFSAIssetControl('setup3_pointposttype_pt3','','PF Items');

						if (!empty($searchall_click)) {
							$minLenght_sa = 0;
							$searchOnFocus = 'true';
							$maxItemPerGroup = 15;
						}else{
							$minLenght_sa = 1;
							$searchOnFocus = 'false';
							$maxItemPerGroup = 5;
						}

						$this->FieldOutput .= '
						<div id="'.$slug.'_main" class="ui-widget">
						<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
						<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
							<div class="typeahead__container"><div class="typeahead__field"><span class="typeahead__query">
							<input type="search" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' autocomplete="off" value="" />
							<input type="hidden" name="'.$slug.'_sel" id="'.$slug.'_sel" value=""/>
							<input type="hidden" name="'.$slug.'_val" id="'.$slug.'_val" value=""/>
							 </span></div></div>
						</label>    
						</div>                        
						';

						if($field_autocmplete == 1){
							$this->ScriptOutput .= '
							if(typeof $("#'.$slug.'").val() != "undefined"){
								$.typeahead({
								    input: "#'.$slug.'",
								    minLength: '.$minLenght_sa.',
								    accent: true,
								    compression: false,
								    cache: false,
									hint: false,
									loadingAnimation: true,
									cancelButton: true,
									debug: false,
									searchOnFocus: '.$searchOnFocus.',
									delay:300,
									group: false,
									filter: false,
									maxItem: 15,
									maxItemPerGroup: '.$maxItemPerGroup.',
									emptyTemplate: \''.esc_html__( "No result for", "pointfindercoreelements" ).' "{{query}}"\',
								    source: {
								        "listings": {
								        	display: "name",
								        	dynamic: true,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("listings", "'.$setup3_pointposttype_pt3.'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.listings",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        },
								        "pointfinderltypes": {
								        	display: "name",
								        	dynamic: false,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("pointfinderltypes", "'.$setup3_pointposttype_pt7.'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.pointfinderltypes",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        },
								        "pointfinderitypes": {
								        	display: "name",
								        	dynamic: false,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("pointfinderitypes", "'.$setup3_pointposttype_pt4.'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.pointfinderitypes",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        },
								        "pointfinderlocations": {
								        	display: "name",
								        	dynamic: false,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("pointfinderlocations", "'.$setup3_pointposttype_pt5.'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.pointfinderlocations",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        },
								        "pointfinderfeatures": {
								        	display: "name",
								        	dynamic: false,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("pointfinderfeatures", "'.$setup3_pointposttype_pt6.'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.pointfinderfeatures",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        },
								        "post_tags": {
								        	display: "name",
								        	dynamic: false,
								        	template: function (query,item) {
								        		var str = item.group;
												var group_replace = str.replace("post_tags", "'.esc_html__( 'Tags', 'pointfindercoreelements').'");
										        var output_style = item.name +"<small>"+group_replace+"</small>";
										        return output_style;
										    },
								            ajax: {
								            	type: "POST",
								                url: "'.PFCOREELEMENTSURLINC.'pfajaxhandler.php'.'",
								                dataType: "json",
								                path: "data.post_tags",
								                data: {
								                	action: "pfget_autocomplete_sa",
								                	security: theme_scriptspf.pfget_autocomplete,
								                	q: "{{query}}",
								                	lang: "'.$lang_custom.'",
								                	fslug: "'.$slug.'"
								                }
								            }
								        }
								    },
								    callback: {
								        onClickBefore: function (node, a, item, event) {
								        	$("#'.$slug.'_sel").val(item.group);
								        	$("#'.$slug.'_val").val(item.id);
								        	$(".typeahead__cancel-button").css("visibility","visible");
								        },
								        onCancel: function(node,event){
								        	$(".typeahead__cancel-button").css("visibility","hidden");
								        	return false;
								        }
								    }
								});
							}
		
							';
						}

					} else {
						
						$this->FieldOutput .= '
						<div id="'.$slug.'_main">
						<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
						<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
							<input type="text" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' />
						</label>    
						</div>                        
						';

						if($field_autocmplete == 1){
							$this->ScriptOutput .= '
							$( "#'.$slug.'" ).on("keydown",function(){

							$( "#'.$slug.'" ).autocomplete({
								position: { my : "right top", at: "right bottom" },
							  appendTo: "#'.$slug.'_main",
						      source: function( request, response ) {
						        $.ajax({
						          url: theme_scriptspf.ajaxurl,
						          dataType: "jsonp",
						          data: {
						          	action: "pfget_autocomplete",
						            q: request.term,
						            security: theme_scriptspf.pfget_autocomplete,
						            lang: "'.$lang_custom.'",
						            ftype: "'.$target.'"
						          },
						          success: function( data ) {
						            response( data );
						          }
						        });
						      },
						      minLength: 3,
						      select: function( event, ui ) {
						        $("#'.$slug.'").val(ui.item);
						      },
						      open: function() {
						        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
						        $( ".ui-autocomplete" ).css("width",$("body").find("#'.$slug.'").outerWidth());
						      },
						      close: function() {
						        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
						      }
						    });

							});
							';
						}
						
					}
					
					
					if($column_type == 1){
						if ($this->PFHalf % 2 == 0) {
							$this->FieldOutput .= '</div>';
						}else{
							$this->FieldOutput .= '</div>';
							$this->FieldOutput .= '</div></div>';
						}
					}else{
						$this->FieldOutput .= '</div>';
					};
					
					
				}
			} 
	    }

	    private function googlemaps_autocomplete_script($slug){
	    	$googlelvl1 = $this->PFSAIssetControl('googlelvl1','','1000');
			$googlelvl2 = $this->PFSAIssetControl('googlelvl2','','500');
			$googlelvl3 = $this->PFSAIssetControl('googlelvl3','','100');

			$setup5_typs = $this->PFSAIssetControl('setup5_typs','','geocode');
			$wemap_country = $this->PFSAIssetControl('wemap_country','','');

			$output = '
			function pfinitAutocomplete() {
				
				var autocomplete_input = document.getElementById("'.$slug.'");
					var autocomplete = new google.maps.places.Autocomplete(autocomplete_input,{ types: ["'.$setup5_typs.'"]});
					';
					if (!empty($wemap_country)) {
						$output .= "autocomplete.setComponentRestrictions({'country': ['".$wemap_country."']});";
					}
					$output .= '
					autocomplete.setFields(["place_id", "name", "geometry","address_component"]);
				google.maps.event.addListener(autocomplete, "place_changed", function() {
				    var place = this.getPlace();
				    
				    if (!place.geometry) {
				      console.log("Returned place contains no geometry");
				      return;
				    }

				    if(typeof place.address_components[0].types[0] != "undefined"){
				    	$("#pointfinder_areatype").val(place.address_components[0].types[0]);
				    	if(place.address_components[0].types[0] == "administrative_area_level_1"){
				    		$("#pointfinder_radius_search-view2").val('.$googlelvl1.');
				    	}
				    	if(place.address_components[0].types[0] == "administrative_area_level_2"){
				    		$("#pointfinder_radius_search-view2").val('.$googlelvl2.');
				    	}
				    	if(place.address_components[0].types[0] == "locality"){
				    		$("#pointfinder_radius_search-view2").val('.$googlelvl3.');
				    	}
				    }
				    
					$("#pointfinder_google_search_coord").val(place.geometry.location.lat()+","+place.geometry.location.lng());
				});

				autocomplete_input.addEventListener("keydown",function(e){
				    var charCode = e.charCode || e.keyCode || e.which;
				    if (charCode == 27){
				         $("#pointfinder_google_search_coord").val("");
				    }
				});

				$("#'.$slug.'").on("change",function(e){
				    if ($("#'.$slug.'").val() == ""){
				        $("#pointfinder_google_search_coord").val("");
				    }
				});

			}

			pfinitAutocomplete();
			';

			return $output;
	    }

	    private function heremaps_autocomplete_script($slug){
	    	$wemap_here_appcode = $this->PFSAIssetControl('wemap_here_appcode','','');
			$wemap_country3 = $this->PFSAIssetControl('wemap_country3','','');
			$heremapslang = $this->PFSAIssetControl('heremapslang','','eng');

			if (!empty($wemap_country3)) {
				$wemap_country3 = '&in=countryCode:'.$wemap_country3;
			}
			if (!empty($heremapslang)) {
				$heremapslang = '&lang='.$heremapslang;
			}

	    	return '
				$.typeahead({
				    input: "#'.$slug.'",
				    minLength: 2,
				    accent: true,
				    dynamic:true,
				    compression: false,
				    cache: false,
					hint: false,
					loadingAnimation: true,
					cancelButton: true,
					debug: true,
					searchOnFocus: false,
					delay: 100,
					group: false,
					filter: false,
					maxItem: 10,
					maxItemPerGroup: 10,
					emptyTemplate: "'.wp_sprintf( esc_html__( "No results found for %s", "pointfindercoreelements" ), "<b>{{query}}</b>" ).'",
					template: "{{address.label}}",
					templateValue: "{{address.label}}",
					selector: {
				        cancelButton: "typeahead__cancel-button2"
				    },
				    source: {
				        "items": {
				          ajax: {
			          		type: "GET",
			              	url: "https://geocode.search.hereapi.com/v1/geocode?q={{query}}&apiKey='.$wemap_here_appcode.'&limit=10'.$heremapslang.$wemap_country3.'",
			              	dataType: "json",
			              	path: "items",
				          }
				        }
				    },
				    callback: {
				    	onLayoutBuiltAfter:function(){
							$(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#'.$slug.'").outerWidth());
							$(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#'.$slug.'").outerWidth());
							$("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
				    	},
				    	onClickBefore: function(){
							$(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
			    		},
						onClickAfter: function(node, a, item, event){
							event.preventDefault();
							$("#'.$slug.'").val(item.address.label);
							$("#pointfinder_google_search_coord").val(item.position.lat+","+item.position.lng);
							$.pointfindersetbounds(item.position.lat,item.position.lng);
						},
						onCancel: function(node,event){
							$("#pointfinder_google_search_coord").val("");
			        	}
				    }
				});';
	    }

	    private function yandexmaps_autocomplete_script($slug){
	    	$wemap_langy = $this->PFSAIssetControl('wemap_langy','','');
			$we_special_key_yandex = $this->PFSAIssetControl('wemap_yandexmap_api_key','','');


	    	return '
				$.typeahead({
				    input: "#'.$slug.'",
				    minLength: 2,
				    accent: true,
				    dynamic:true,
				    compression: false,
				    cache: false,
					hint: false,
					loadingAnimation: true,
					cancelButton: true,
					debug: true,
					searchOnFocus: false,
					delay: 100,
					group: false,
					filter: false,
					maxItem: 10,
					maxItemPerGroup: 10,
					emptyTemplate: "'.wp_sprintf( esc_html__( "No results found for %s", "pointfindercoreelements" ), "<b>{{query}}</b>" ).'",
					template: "{{GeoObject.metaDataProperty.GeocoderMetaData.text}}",
	            	templateValue: "{{GeoObject.metaDataProperty.GeocoderMetaData.text}}",
					selector: {
				        cancelButton: "typeahead__cancel-button2"
				    },
				    source: {
				        "response.GeoObjectCollection.featureMember": {
	                    ajax: {
	                      type: "GET",
	                        url: "https://geocode-maps.yandex.ru/1.x/?geocode={{query}}&results=10&lang='.$wemap_langy.'&apikey='.$we_special_key_yandex.'&format=json",
	                        dataType: "json",
	                        path: "response.GeoObjectCollection.featureMember",
	                    }
	                  }
				    },
				    callback: {
				    	onLayoutBuiltAfter:function(){
							$(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#'.$slug.'").outerWidth());
							$(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#'.$slug.'").outerWidth());
							$("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
				    	},
				    	onClickBefore: function(){
							$(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
			    		},
						onClickAfter: function(node, a, item, event){
							event.preventDefault();
							var position = item.GeoObject.Point.pos;
		               	 	var position = position.split(" ");
							$("#'.$slug.'").val(item.GeoObject.metaDataProperty.GeocoderMetaData.text);
							$("#pointfinder_google_search_coord").val(position[1]+","+position[0]);
							$.pointfindersetbounds(position[1],position[0]);
						},
						onCancel: function(node,event){
							$("#pointfinder_google_search_coord").val("");
			        	}
				    }
				});';
	    }


	    private function mapboxmaps_autocomplete_script($slug){
	    	$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
            $we_special_key_mapbox = $this->PFSAIssetControl('stp5_mapboxpt','','');
            $wemap_country3 = $this->PFSAIssetControl('wemap_country3','','');
	    	return '
				$.typeahead({
				    input: "#'.$slug.'",
				    minLength: 2,
				    accent: true,
				    dynamic:true,
				    compression: false,
				    cache: false,
					hint: false,
					loadingAnimation: true,
					cancelButton: true,
					debug: true,
					searchOnFocus: false,
					delay: 100,
					group: false,
					filter: false,
					maxItem: 10,
					maxItemPerGroup: 10,
					emptyTemplate: "'.wp_sprintf( esc_html__( "No results found for %s", "pointfindercoreelements" ), "<b>{{query}}</b>" ).'",
					template: "{{place_name}}",
	            	templateValue: "{{place_name}}",
					selector: {
				        cancelButton: "typeahead__cancel-button2"
				    },
				    source: {
	                  "features": {
	                    ajax: {
	                      type: "GET",
	                        url: "https://api.mapbox.com/geocoding/v5/mapbox.places/{{query}}.json?limit=10&language='.$maplanguage.'&access_token='.$we_special_key_mapbox.'&types=address,place,region,country&country='.$wemap_country3.'",
	                        dataType: "json",
	                        path: "features",
	                    }
	                  }
	              },
				    callback: {
				    	onLayoutBuiltAfter:function(){
							$(".pfminigoogleaddon").find(".typeahead__list").css("width",$("#'.$slug.'").outerWidth());
							$(".pfminigoogleaddon").find(".typeahead__result").css("width",$("#'.$slug.'").outerWidth());
							$("#pfsearch-draggable .we-change-addr-input ul.typeahead__list").css("min-width",$("#pfsearch-draggable .we-change-addr-input .typeahead__field").outerWidth());
				    	},
				    	onClickBefore: function(){
							$(".pfminigoogleaddon .typeahead__container.we-change-addr-input .typeahead__field input").css("padding-right","66px");
			    		},
						onClickAfter: function(node, a, item, event){
							event.preventDefault();
							$("#'.$slug.'").val(item.place_name);
							$("#pointfinder_google_search_coord").val(item.geometry.coordinates[1]+","+item.geometry.coordinates[0]);
							$.pointfindersetbounds(item.geometry.coordinates[1], item.geometry.coordinates[0]);
						},
						onCancel: function(node,event){
							$("#pointfinder_google_search_coord").val("");
			        	}
				    }
				});';
	    }
	}

}