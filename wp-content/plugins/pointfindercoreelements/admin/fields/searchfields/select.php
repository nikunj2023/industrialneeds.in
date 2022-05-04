<?php

if (!trait_exists('PointFinderSelectSearchField')) {


	trait PointFinderSelectSearchField
	{
	  
	    public function pointfinder_get_search_select_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
				$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues_target_target','','');

				$parentshowonly = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_parentso','','0');
				$ajaxloads = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_ajaxloads','','0');
				$as_mobile_dropdowns = $this->PFSAIssetControl('as_mobile_dropdowns','','0');

				$itemparent = $this->CheckItemsParent($target);
				/*Check element: is it a taxonomy?*/
				$rvalues_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues_check','','0');

				if ($rvalues_check == 0) {
					$fieldtaxname = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_posttax','','');
					$fieldtaxSelected = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_posttax_selected','','');
				}

				if($itemparent == 'none'){
					$validation_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_validation_required','','0');
					$multiple = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_multiple','','0');

					if ($multiple == 1 && ($widget == 1 || $minisearch == 1)) {
						$taxmultipletype = '[]';
					}else{
						$taxmultipletype = '';
					}

					if($validation_check == 1){
						$validation_message = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_message','','');
						if($this->VSOMessages != ''){
							$this->VSOMessages .= ',"'.$slug.$taxmultipletype.'":"'.$validation_message.'"';
						}else{
							$this->VSOMessages = '"'.$slug.$taxmultipletype.'":"'.$validation_message.'"';
						}
						
						if($this->VSORules != ''){
							$this->VSORules .= ',"'.$slug.$taxmultipletype.'":"required"';
						}else{
							$this->VSORules = '"'.$slug.$taxmultipletype.'":"required"';
						}
					}

					
					
					$select2_style = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_select2','','0');
					if($select2_style == 0){
						$select2sh = ', minimumResultsForSearch: -1';
					}else{ $select2sh = '';}
					
					$placeholder = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_placeholder','','');
					if($placeholder == ''){ $placeholder = esc_html__('Please select','pointfindercoreelements');};

					$nomatch = apply_filters( 'wpml_translate_single_string', $this->PFSFIssetControl('setupsearchfields_'.$slug.'_nomatch','',''), 'admin_texts_pfsearchfields_options', '[pfsearchfields_options]setupsearchfields_'.$slug.'_nomatch' );
					
					$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');
					
					if($multiple == 1){ $multiplevar = 'multiple';}else{$multiplevar = '';};
					
					
					
					
					if($column_type == 1){
						if ($this->PFHalf % 2 == 0) {
							$this->FieldOutput .= '<div class="col6 last"><div id="'.$slug.'_main">';
						}else{
							$this->FieldOutput .= '<div class="pfsfield">';
							$this->FieldOutput .= '<div class="row"><div class="col6 first"><div id="'.$slug.'_main">';
						}
						$this->PFHalf++;
					}else{
						$this->FieldOutput .= '<div class="pfsfield">';
						$this->FieldOutput .= '<div id="'.$slug.'_main">';
					};


					/*/Begin to create Select Box*/
					if ($ajaxloads == 1 && $rvalues_check == 0 && ($fieldtaxname == 'pointfinderltypes' || $fieldtaxname == 'pointfinderlocations')) {
						if ($fieldtaxname == 'pointfinderltypes') {
							$this->ListingTypeField = $slug;
						}else{
							$this->LocationField = $slug;
						}

						if ($fieldtaxname == 'pointfinderlocations' && $multiple == 1) {
							
							$this->ScriptOutput .= '
							$("#'.$slug.'_sel").select2({
								dropdownCssClass:"pfselect2drop",
								containerCssClass:"pfselect2container",
								placeholder: "'.esc_js($placeholder).'",
								formatNoMatches:"'.esc_js($nomatch).'",
								allowClear: true'.$select2sh.'
							});

							$("#pf-resetfilters-button").on("click", function(event) {
								$("#'.$slug.'_sel").select2("val","");
							});

							$("#'.$slug.'_sel").on("select2:close", function (evt) {
								var uldiv = $(this).siblings("span.select2").find("ul");
							  	var count = uldiv.find("li").length - 1;
							  	if(count == 1){
							  		uldiv.html("<li>"+uldiv.find("li").text().replace("×","")+"</li>");
						  		}else if(count > 1){
						  			uldiv.html("<li>"+count+" '.esc_html__("locations selected","pointfindercoreelements").'</li>");
						  		}
							 	
							});
						
							';
						}else{
							$this->ScriptOutput .= '
							$("#'.$slug.'_sel").select2({
								dropdownCssClass:"pfselect2drop",
								containerCssClass:"pfselect2container",
								placeholder: "'.esc_js($placeholder).'",
								formatNoMatches:"'.esc_js($nomatch).'",
								allowClear: true'.$select2sh.'
							});

							$("#pf-resetfilters-button").on("click", function(event) {
								$("#'.$slug.'_sel").select2("val","");
							});
							';
						}
						
					}else{
						$this->ScriptOutput .= '
						$("#'.$slug.'").select2({
							dropdownCssClass:"pfselect2drop",
							containerCssClass:"pfselect2container",
							placeholder: "'.esc_js($placeholder).'",
							formatNoMatches:"'.esc_js($nomatch).'",
							allowClear: true'.$select2sh.'
						});

						$("#'.$slug.'").on("select2:close", function (evt) {
							var uldiv = $(this).siblings("span.select2").find("ul");
						  	var count = uldiv.find("li").length - 1;
						  	if(count == 1){
						  		uldiv.html("<li>"+uldiv.find("li").text().replace("×","")+"</li>");
					  		}else if(count > 1){
					  			uldiv.html("<li>"+count+" '.esc_html__("locations selected","pointfindercoreelements").'</li>");
					  		}
						 	
						});

						$("#pf-resetfilters-button").on("click", function(event) {
							$("#'.$slug.'").select2("val","");
						});';
					}

					
					if ($as_mobile_dropdowns == 1) {
						if ($ajaxloads == 1 && $rvalues_check == 0 && ($fieldtaxname == 'pointfinderltypes' || $fieldtaxname == 'pointfinderlocations')) {
							$this->ScriptOutput .= 'if(!$.pf_tablet_check()){$("#'.$slug.'_sel").select2("destroy");}';
						}else{
							$this->ScriptOutput .= 'if(!$.pf_tablet_check()){$("#'.$slug.'").select2("destroy");}';
						}
					}

					$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');
					$this->FieldOutput .= '<div class="pftitlefield">'.$fieldtext.'</div>';
					if ($ajaxloads == 1  && $rvalues_check == 0 && ($fieldtaxname == 'pointfinderltypes' || $fieldtaxname == 'pointfinderlocations')) {
						$this->FieldOutput .= '<label for="'.$slug.'_sel" class="lbl-ui select ajaxloadlabel">';
					}else{
						$this->FieldOutput .= '<label for="'.$slug.'" class="lbl-ui select">';
					}



					if ($as_mobile_dropdowns == 1) {
						$as_mobile_dropdowns_text = 'class="pf-special-selectbox" data-pf-plc="'.$placeholder.'" data-pf-stt="false"';
					} else {
						$as_mobile_dropdowns_text = '';
					}

					

					if ($ajaxloads == 1 && $rvalues_check == 0 && ($fieldtaxname == 'pointfinderltypes' || $fieldtaxname == 'pointfinderlocations')) {

						$item_defaultvalue_output = $sub_level = $sub_sub_level = $item_defaultvalue_output_orj = '';

						if ($fieldtaxname == 'pointfinderltypes') {
							if (!empty($this->ListingTypeField)) {
								if (!empty($pfgetdata[$this->ListingTypeField])) {
									$fieldtaxSelected = $pfgetdata[$this->ListingTypeField];
								}
							}
						}else{
							if (!empty($this->LocationField)) {
								if (!empty($pfgetdata[$this->LocationField])) {
									$fieldtaxSelected = $pfgetdata[$this->LocationField];
								}
							}
						}
						
						if (!empty($fieldtaxSelected)) {
							if (is_array($fieldtaxSelected) && count($fieldtaxSelected) > 1) {
								if (isset($fieldtaxSelected)) {
									$item_defaultvalue_output_orj = $fieldtaxSelected;
									$find_top_parent = $this->pf_get_term_top_most_parent($fieldtaxSelected,$fieldtaxname);

									$ci = 1;
									foreach ($fieldtaxSelected as $value) {
										$sub_level .= $value;
										if ($ci < count($fieldtaxSelected)) {
											$sub_level .= ',';
										}
										$ci++;
									}
									$item_defaultvalue_output = $find_top_parent['parent'];
								}
							}else{
								if (isset($fieldtaxSelected)) {
									$item_defaultvalue_output_orj = $fieldtaxSelected;
									$find_top_parent = $this->pf_get_term_top_most_parent($fieldtaxSelected,$fieldtaxname);

									switch ($find_top_parent['level']) {
										case '1':
											$sub_level = $fieldtaxSelected;
											break;
										
										case '2':
											$sub_sub_level = $fieldtaxSelected;
											$sub_level = $this->pf_get_term_top_parent($fieldtaxSelected,$fieldtaxname);
											break;
									}
									

									$item_defaultvalue_output = $find_top_parent['parent'];
								}
							}
						}
						
						$this->FieldOutput .= '<input type="hidden" name="'.$slug.'" id="'.$slug.'" value="'.$fieldtaxSelected.'"/>';
						if ($fieldtaxname == 'pointfinderltypes') {
							$cat_extra_opts = get_option('pointfinderltypes_covars');
						
							$subcatsarray = "var pfsubcatselect = [";
							$multiplesarray = "var pfmultipleselect = [";
						}
						$this->FieldOutput .= '<select '.$multiplevar.' id="'.$slug.'_sel" name="'.$slug.'_sel" '.$as_mobile_dropdowns_text.'>';
						
					
					}else{
						$this->FieldOutput .= '<select '.$multiplevar.' id="'.$slug.'" name="'.$slug.$taxmultipletype.'" '.$as_mobile_dropdowns_text.'>';
					}
					
					

					if($rvalues_check == 0){
					/* If this is a taxonomy */
						$fieldtaxname = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_posttax','','');
						$fieldtaxmove = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_posttax_move','','0');

						$mylat = $this->PFSAIssetControl('setup42_searchpagemap_lat','','');
						$mylng = $this->PFSAIssetControl('setup42_searchpagemap_lng','','');
						
						if($fieldtaxmove == 1 && $multiple != 1 && $widget == 0 && $ajaxloads != 1){ 
							/* If this is location and select move enabled. */
							/* GET - points per location */
							if ($this->LocationField == $slug) {
								$this->ScriptOutput .= '$( "#'.$slug.'" ).change(function(){
								
									if($( "#'.$slug.'" ).val() != ""){
											
										$.ajax({
											type: "POST",
											dataType: "JSON",
											url: theme_scriptspf.ajaxurl,
											data: { 
												"action": "pfget_taxpoint",
												"id": $( "#'.$slug.'" ).val(),
												"security": theme_scriptspf.pfget_taxpoint,
												"cl":theme_scriptspf.pfcurlang
											},
											success:function(data){
												if(data.lat != 0){
													if(typeof $.pointfinderdirectorymap != "undefined"){
														$.pointfinderdirectorymap.setView([data.lat,data.lng],$("#pfdirectorymap").data("zoom"));
													}else if(typeof $.pointfindernewmapsys != "undefined"){
														$.pointfindernewmapsys.setView([data.lat,data.lng],$("#wpf-map").data("zoom"));
													}
												}
											}
										});
										
									}else{
										if(typeof $.pointfinderdirectorymap != "undefined"){
											if($.pointfinderdirectorymap._lastCenter.lat != $("#pfdirectorymap").data("lat") && ((Math.round(parseFloat($.pointfinderdirectorymap._lastCenter.lat)) - Math.round(parseFloat($("#pfdirectorymap").data("lat")))) > 1 || (Math.round(parseFloat($.pointfinderdirectorymap._lastCenter.lat)) - Math.round(parseFloat($("#pfdirectorymap").data("lat")))) < -1)){
												$.pointfinderdirectorymap.setView([$("#pfdirectorymap").data("lat"),$("#pfdirectorymap").data("lng")],$("#pfdirectorymap").data("zoom"));
												$.pointfinderdirectorymap.fitBounds($.pointfindermarkers.getBounds(),{padding: [100,100]});
											}
										}

										if(typeof $.pointfindernewmapsys != "undefined"){
											if($.pointfindernewmapsys._lastCenter.lat != $("#wpf-map").data("lat") && ((Math.round(parseFloat($.pointfindernewmapsys._lastCenter.lat)) - Math.round(parseFloat($("#wpf-map").data("lat")))) > 1 || (Math.round(parseFloat($.pointfindernewmapsys._lastCenter.lat)) - Math.round(parseFloat($("#wpf-map").data("lat")))) < -1)){
												$.pointfindernewmapsys.setView([$("#wpf-map").data("lat"),$("#wpf-map").data("lng")],$("#wpf-map").data("zoom"));
												$.pointfindernewmapsys.fitBounds($.pointfindermarkers.getBounds(),{padding: [100,100]});
											}
										}
									}
									
									});
								';
							}
						}
						$process = 'ok';
						if($fieldtaxname != ''){

							$setup4_sbf_c1 = $this->PFSAIssetControl('setup4_sbf_c1','','1');
							$stp_syncs_it = $this->PFSAIssetControl('stp_syncs_it','',1);
							$stp_syncs_co = $this->PFSAIssetControl('stp_syncs_co','',1);
							
							if ($fieldtaxname == 'pointfinderfeatures') {
								if ($setup4_sbf_c1 == 0) {
									$process = 'not';
								}
							}

							if ($fieldtaxname == 'pointfinderitypes') {
								if ($stp_syncs_it == 0) {
									$process = 'not';
									if ($ajaxloads == 1 ) {
										$this->ScriptOutput .= '$(function(){$( "#'.$slug.'_main" ).hide();});';
									}
								}
							}

							if ($fieldtaxname == 'pointfinderconditions') {
								if ($stp_syncs_co == 0) {
									$process = 'not';
									if ($ajaxloads == 1 ) {
										$this->ScriptOutput .= '$(function(){$( "#'.$slug.'_main" ).hide();});';
									}
								}
							}
							
							if ($ajaxloads == 1) {$parentshowonly = 1;}
							
							/*Select tax auto on cat page*/

							if (isset($pfgetdata['pointfinderltypes'])) {
																
								if ($widget == 1 && !empty($pfgetdata['pointfinderltypes'])) {
									
									global $wp_query;
									if(isset($wp_query->query_vars['taxonomy'])){
										$taxonomy_name = $wp_query->query_vars['taxonomy'];
										
										if ($taxonomy_name == 'pointfinderltypes') {
											
											$term_slug = $wp_query->query_vars['term'];
							
											$term_name = get_term_by('slug', $term_slug, $taxonomy_name,'ARRAY_A');
											
											$fieldtaxSelected = $term_name['term_id'];

										}
									}
								}
							}

							/*Select tax auto on search page*/
							$fltf = $this->pointfinder_find_requestedfields('pointfinderltypes');
							if ($fltf != 'none') {
								if (isset($pfgetdata[$fltf])) {
																	
									if (!empty($pfgetdata[$fltf])) {
										
										$fieldtaxSelected = $pfgetdata[$fltf];
									}
								}
							}
								
							if ($process == 'ok') {
								$fieldvalues = get_terms($fieldtaxname,array('hide_empty'=>false)); 
								
								$this->FieldOutput .= '	<option></option>';

								if ($multiple == 1 ){
									$this->FieldOutput .= '<optgroup disabled hidden></optgroup>';
								}

								foreach( $fieldvalues as $parentfieldvalue){
									if($parentfieldvalue->parent == 0){

											if ($fieldtaxname == 'pointfinderltypes') {
												/* Multiple select & Subcat Select */
												$multiple_select = (isset($cat_extra_opts[$parentfieldvalue->term_id]['pf_multipleselect']))?$cat_extra_opts[$parentfieldvalue->term_id]['pf_multipleselect']:2;
												$subcat_select = (isset($cat_extra_opts[$parentfieldvalue->term_id]['pf_subcatselect']))?$cat_extra_opts[$parentfieldvalue->term_id]['pf_subcatselect']:2;

												if ($multiple_select == 1) {$multiplesarray .= $parentfieldvalue->term_id.',';}
												if ($subcat_select == 1) {$subcatsarray .= $parentfieldvalue->term_id.',';}
											}
										
											$mypf_text = '';
											
											if (empty($parentshowonly)) {
												$tax_class_text = 'class="pfoptheader"';
											}else{$tax_class_text = '';}

											if($fieldtaxSelected != ''){
												if (!empty($item_defaultvalue_output)) {
													if(strcmp($item_defaultvalue_output,$parentfieldvalue->term_id) == 0){$mypf_text = " selected";}
												}else{
													if(strcmp($fieldtaxSelected,$parentfieldvalue->term_id) == 0){$mypf_text = " selected";}
												}
												
											}

											if (isset($pfgetdata[$slug]) && ($widget == 1 || $minisearch == 1)) {
												if (is_array($pfgetdata[$slug])) {
													if (in_array($parentfieldvalue->term_id, $pfgetdata[$slug])) {
														$mypf_text = " selected";
													}
												}else{
													if ($parentfieldvalue->term_id == $pfgetdata[$slug]) {
														$mypf_text = " selected";
													}
												}
											}

											$this->FieldOutput .= '<option value="'.$parentfieldvalue->term_id.'"'.$mypf_text.' '.$tax_class_text.'>'.$parentfieldvalue->name.'</option>';
											
											if (empty($parentshowonly)) {
												foreach( $fieldvalues as $fieldvalue){
													if($fieldvalue->parent == $parentfieldvalue->term_id){

														if($fieldtaxSelected != ''){

															if(strcmp($fieldtaxSelected,$fieldvalue->term_id) == 0){ $fieldtaxSelectedValue = 1;}else{ $fieldtaxSelectedValue = 0;}
														}else{
															$fieldtaxSelectedValue = 0;
														}

														
														$tax_normal_output = '<option value="'.$fieldvalue->term_id.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$fieldvalue->name.'</option>';
														$tax_selected_output = '<option value="'.$fieldvalue->term_id.'" selected>&nbsp;&nbsp;&nbsp;&nbsp;'.$fieldvalue->name.'</option>';

														if($fieldtaxSelectedValue == 1 && $widget == 0 && !isset($pfgetdata[$slug])){
															$this->FieldOutput .= $tax_normal_output;
														}else{
															if (array_key_exists($slug,$pfgetdata)) {
																if (isset($pfgetdata[$slug])) {
																	if (is_array($pfgetdata[$slug])) {
																		if (in_array($fieldvalue->term_id, $pfgetdata[$slug])) {
																			$tax_normal_output = $tax_selected_output;
																		}
																	}else{
																		if ($fieldvalue->term_id == $pfgetdata[$slug]) {
																			$tax_normal_output = $tax_selected_output;
																		}else{
																			if ($fieldtaxSelectedValue == 1) {
																				$tax_normal_output = $tax_selected_output;
																			}
																		}
																	}
																	
																}
																
															}
															$this->FieldOutput .= $tax_normal_output;
														}



														$has_this_term_children = get_term_children( $fieldvalue->term_id, $fieldtaxname );

														if (count($has_this_term_children) > 0) {

															foreach( $fieldvalues as $fieldvalues2){

																if($fieldvalues2->parent == $fieldvalue->term_id){
																	if($fieldtaxSelected != ''){
																		if(strcmp($fieldtaxSelected,$fieldvalues2->term_id) == 0){ $fieldtaxSelectedValues2 = 1;}else{ $fieldtaxSelectedValues2 = 0;}
																	}else{
																		$fieldtaxSelectedValues2 = 0;
																	}

																	$subtax_normal_output = '<option value="'.$fieldvalues2->term_id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$fieldvalues2->name.'</option>';
																	$subtax_selected_output = '<option value="'.$fieldvalues2->term_id.'" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$fieldvalues2->name.'</option>';

																	if($fieldtaxSelectedValues2 == 1 && $widget == 0 && !isset($pfgetdata[$slug])){
																		$this->FieldOutput .= $subtax_normal_output;
																	}else{
																		if (array_key_exists($slug,$pfgetdata)) {
																			if (isset($pfgetdata[$slug])) {

																				if (is_array($pfgetdata[$slug])) {
																					if (in_array($fieldvalue2->term_id, $pfgetdata[$slug])) {
																						$subtax_normal_output = $subtax_selected_output;
																					}
																				}else{
																					if ($fieldvalues2->term_id == $pfgetdata[$slug]) {
																						$subtax_normal_output = $subtax_selected_output;
																					}else{
																						if ($fieldtaxSelectedValue == 1) {
																							$subtax_normal_output = $subtax_selected_output;
																						}
																					}
																				}
																			}
																		}
																		$this->FieldOutput .= $subtax_normal_output;
																	}
																}
															}
														}



													}
												}
											}
											
									}
								}

							}else{
								$this->FieldOutput .= '	<option></option>';
							}
							


						}
					}elseif($rvalues_check == 1){
					/* If not a taxonomy */

						$rvalues = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues','','');

						if(count($rvalues) > 0){$fieldvalues = $rvalues;}else{$fieldvalues = '';}/* Get element's custom values.*/

						if(count($fieldvalues) > 0){
							
							$this->FieldOutput .= '	<option></option>';

							$ikk = 0;
							foreach ($fieldvalues as $s) { 

								if (class_exists('SitePress')) {
									$s = apply_filters( 'wpml_translate_single_string', $s, 'admin_texts_pfsearchfields_options', '[pfsearchfields_options][setupsearchfields_'.$slug.'_rvalues]'.$ikk );

								}

								if ($pos = strpos($s, '=')) { 

									$tax_normal_output = '<option value="'.trim(substr($s, 0, $pos)).'">'.trim(substr($s, $pos + strlen('='))).'</option>';
									$tax_selected_output = '<option value="'.trim(substr($s, 0, $pos)).'" selected>'.trim(substr($s, $pos + strlen('='))).'</option>';

									if($widget == 1){

										if (array_key_exists($slug,$pfgetdata)) {
											if (isset($pfgetdata[$slug])) {
												if (is_array($pfgetdata[$slug])) {
													if (in_array(trim(substr($s, 0, $pos)), $pfgetdata[$slug])) {
														$tax_normal_output = $tax_selected_output;
													}
												}else{
													if (trim(substr($s, 0, $pos)) == $pfgetdata[$slug]) {
														$tax_normal_output = $tax_selected_output;
													}
												}
											}
										}
									}
									$this->FieldOutput .= $tax_normal_output;

								}
								$ikk++;
							}
						}
					}

					$this->FieldOutput .= '</select>';
					$this->FieldOutput .= '</label>';

					if ($ajaxloads == 1  && $rvalues_check == 0 && ($fieldtaxname == 'pointfinderltypes' || $fieldtaxname == 'pointfinderlocations')) {
						
						if ($fieldtaxname == 'pointfinderlocations' && $multiple != 1) {

							$ajaxloadshidetitle = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_ajaxloadshidetitle','','1');


							$this->FieldOutput .= '<div class="pf-sub-locations-container"></div><div class="pf-subsub-locations-container"></div>';
							$placeholderforlocation = $this->PFSAIssetControl('stp4_sublotyp_title','',esc_html__('Sub Location', 'pointfindercoreelements'));
							$placeholderforlocationsub = $this->PFSAIssetControl('stp4_subsublotyp_title','',esc_html__('Sub Sub Location', 'pointfindercoreelements'));
							$ajaxloadshidetitle = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_ajaxloadshidetitle','','1');
							if ($ajaxloadshidetitle == 1) {
								$placeholderforlocation = $placeholderforlocationsub = esc_html__('Please select','pointfindercoreelements');
							}

							$this->ScriptOutput .= "

								var lcslug = $('#".$slug."');
								var lcslugsel = $('#".$slug."_sel');
								var lcslugmain = $('#".$slug."_main');

							/* Start: Function for sub location types */
								$.pf_get_sublocations = function(itemid,defaultv){
									$.ajax({
								    	beforeSend:function(){
								    		
								    	},
										url: theme_scriptspf.ajaxurl,
										type: 'POST',
										dataType: 'html',
										data: {
											action: 'pfget_listingtype',
											id: itemid,
											default: defaultv,
											sname: 'pfupload_sublocations',
											stext: '".$placeholderforlocation."',
											stype: 'locations',
											stax: 'pointfinderlocations',
											alt: '".$ajaxloadshidetitle."',
											lang: '".$lang_custom."',
											security: '".wp_create_nonce('pfget_listingtype')."'
										},
									}).success(function(obj) {
										if(obj.length > 0){

											if ($.pf_tablet_check() || $('.pointfinder-mini-search #pointfinder-search-form-manual').length > 0) {
												$('label[for=\"".$slug."_sel\"]').css('display','none');
												$('.pf-sub-locations-container').append('<div class=\'pfsublocations\'>'+obj+'</div>').css('opacity',1);

												
												$('#pfupload_sublocations').select2({
													dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
													placeholder: '".$placeholderforlocation."', 
													formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
													allowClear: true, 
													minimumResultsForSearch: 10
												});

												setTimeout(function(){
													if ($('#pfupload_sublocations').hasClass('select2-hidden-accessible')) {
														$('#select2-pfupload_sublocations-container').parent().append('<span class=\"pfsublback\" title=\"".esc_html__( "Go Back", "pointfindercoreelements")."\"><i class=\"fas fa-undo\"></i></span>');

														$('.pfsublback').on('click',function(){

															$('#pfupload_sublocations').select2('close');

															$('.pf-sub-locations-container').css('opacity',0);

															lcslugsel.val(null).trigger('change');

															$('label[for=\"".$slug."_sel\"]').css('display','block');

														});
													}
												},0);

											}else{
												$('.pf-sub-locations-container').append('<div class=\'pfsublocations\'>'+obj+'</div>').css('opacity',1);	
											";

											if ($as_mobile_dropdowns != 1) {
												$this->ScriptOutput .= "
													$('#pfupload_sublocations').select2({
														dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
														placeholder: '".$placeholderforlocation."', 
														formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
														allowClear: true, 
														minimumResultsForSearch: 10
													});
												";
											}

											$this->ScriptOutput .= '}';

											$this->ScriptOutput .= '$.pf_data_pfpcl_apply();';

											if (empty($sub_sub_level)) {
											$this->ScriptOutput .= "
												$.pf_get_subsublocations($('#pfupload_sublocations').val(),'');
											";
											}
											$this->ScriptOutput .= apply_filters( "pointfinder_search_sublocations_filter", '' );
											
											$this->ScriptOutput .= "
											$('#pfupload_sublocations').change(function(){
												
												if($(this).val() != 0 && $(this).val() != null){
													lcslugmain.pfLoadingOverlay({action:'show',opacity:0.5});
													lcslug.val($(this).val()).trigger('change');
													$.pf_get_subsublocations($(this).val(),'');
												}else{
													lcslug.val(lcslugsel.val());
												}
												$('.pfsubsublocations').remove();
											});
										}
									}).complete(function(obj,obj2){
										if (obj.responseText != '') {
											if (defaultv != '') {
												lcslug.val(defaultv).trigger('change');
											}else{
												lcslug.val(itemid).trigger('change');
											}";
														
											if (!empty($sub_sub_level)) {
												$this->ScriptOutput .= "
												if (".$sub_level." == $('#pfupload_sublocations').val()) {
													$.pf_get_subsublocations('".$sub_level."','".$sub_sub_level."');
												}
												";
											}
											$this->ScriptOutput .= "
										}
										lcslugmain.pfLoadingOverlay({action:'hide'});
										
										
									});
								}


								$.pf_get_subsublocations = function(itemid,defaultv){
									$.ajax({
										url: theme_scriptspf.ajaxurl,
										type: 'POST',
										dataType: 'html',
										data: {
											action: 'pfget_listingtype',
											id: itemid,
											default: defaultv,
											sname: 'pfupload_subsublocations',
											stext: '".$placeholderforlocationsub."',
											stype: 'locations',
											stax: 'pointfinderlocations',
											alt: '".$ajaxloadshidetitle."',
											lang: '".$lang_custom."',
											alt: '".$ajaxloadshidetitle."',
											security: '".wp_create_nonce('pfget_listingtype')."'
										},
									}).success(function(obj) {
										
										if(obj.length > 0){

											if ($.pf_tablet_check() || $('.pointfinder-mini-search #pointfinder-search-form-manual').length > 0) {
												$('.pf-sub-locations-container').css('display','none').css('opacity',0);
												$('.pf-subsub-locations-container').append('<div class=\'pfsubsublocations\'>'+obj+'</div>').css('opacity',1);

											
												$('#pfupload_subsublocations').select2({
													dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
													placeholder: '".$placeholderforlocationsub."', 
													formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
													allowClear: true, 
													minimumResultsForSearch: 10
												});

												setTimeout(function(){
													if ($('#pfupload_subsublocations').hasClass('select2-hidden-accessible')) {
														$('#select2-pfupload_subsublocations-container').parent().append('<span class=\"pfsublback2\" title=\"".esc_html__( "Go Back", "pointfindercoreelements")."\"><i class=\"fas fa-undo\"></i></span>');

														$('.pfsublback2').on('click',function(){
															
															$('#pfupload_subsublocations').select2('close');

															$('.pf-subsub-locations-container').css('opacity',0);

															$('#pfupload_sublocations').val(null).trigger('change');
															$('.pf-sub-locations-container').css('display','block').css('opacity',1);
														});
													}
												},0);

											}else{
												$('.pf-subsub-locations-container').append('<div class=\'pfsubsublocations\'>'+obj+'</div>').css('opacity',1);

											";
											if ($as_mobile_dropdowns != 1) {
												$this->ScriptOutput .= "
													$('#pfupload_subsublocations').select2({
														dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
														placeholder: '".$placeholderforlocationsub."', 
														formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
														allowClear: true, 
														minimumResultsForSearch: 10
													});
												";
											}

											$this->ScriptOutput .= '}';
											$this->ScriptOutput .= '$.pf_data_pfpcl_apply();';
										

											
											$this->ScriptOutput .= apply_filters( "pointfinder_search_subsublocations_filter", '' );

											$this->ScriptOutput .= "

											$('#pfupload_subsublocations').change(function(){
												if($(this).val() != 0){
													lcslug.val($(this).val()).trigger('change');
												}else{
													lcslug.val($('#pfupload_sublocations').val())
												}
											});
										}

									}).complete(function(obj,obj2){
										if (obj.responseText != '') {
											if (defaultv != '') {
												lcslug.val(defaultv).trigger('change');
											}else{
												lcslug.val(itemid).trigger('change');
											}
										}
										lcslugmain.pfLoadingOverlay({action:'hide'});
										
									});
								}

							/* End: Function for sub location types */
							";
							$this->ScriptOutput .= "
							lcslugsel.change(function(){
								lcslugmain.css('position','relative').pfLoadingOverlay({action:'show',opacity:0.5});
								$('.pf-sub-locations-container').html('');
								lcslug.val($(this).val()).trigger('change');
								$.pf_get_sublocations($(this).val(),'');
							});
							";
						}

						if ($fieldtaxname == 'pointfinderltypes') {
							$subcatsarray .= "];";
							$multiplesarray .= "];";

							$this->ScriptOutput .= $subcatsarray . $multiplesarray;

							$this->FieldOutput .= '<div class="pf-sub-listingtypes-container"></div><div class="pf-subsub-listingtypes-container"></div>';

							$setup4_submitpage_listingtypes_title = $this->PFSAIssetControl('setup4_submitpage_listingtypes_title','','Listing Type');
							$placeholderforlistingtype = $this->PFSAIssetControl('setup4_submitpage_sublistingtypes_title','','Sub Listing Type');
							$placeholderforlistingtypesub = $this->PFSAIssetControl('setup4_submitpage_subsublistingtypes_title','','Sub Sub Listing Type');
							$setup4_submitpage_listingtypes_verror = $this->PFSAIssetControl('setup4_submitpage_listingtypes_verror','','Please select a listing type.');
							$stp4_forceu_cs = $this->PFSAIssetControl('stp4_forceu_cs','',0);
							
							$ajaxloadshidetitle = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_ajaxloadshidetitle','','1');
							if ($ajaxloadshidetitle == 1) {
								$placeholderforlistingtype = $placeholderforlistingtypesub = esc_html__('Please select','pointfindercoreelements');
							}

							$this->ScriptOutput .= "
								
								var ltslug = $('#".$slug."');
								var ltslugsel = $('#".$slug."_sel');
								var ltslugmain = $('#".$slug."_main');

								
								$.pf_get_sublistingtypes = function(itemid,defaultv){
							
									if (($.inArray(parseInt(ltslugsel.val()),pfsubcatselect) == -1) && ($.inArray(parseInt(ltslugsel.val()),pfmultipleselect) == -1)) {
										var ltsubcatmultiplecheck = true;
									}else{
										var ltsubcatmultiplecheck = false;
									}
									if ($.inArray(parseInt(ltslugsel.val()),pfmultipleselect) != -1) {
										var multiple_ex = 1;
									}else{
										var multiple_ex = 0;
									}
									$.ajax({
										url: theme_scriptspf.ajaxurl,
										type: 'POST',
										dataType: 'html',
										data: {
											action: 'pfget_listingtype',
											id: itemid,
											default: defaultv,
											sname: 'pfupload_sublistingtypes',
											stext: '".$placeholderforlistingtype."',
											stype: 'listingtypes',
											stax: 'pointfinderltypes',
											lang: '".$lang_custom."',
											multiple: multiple_ex,
											alt: '".$ajaxloadshidetitle."',
											security: '".wp_create_nonce('pfget_listingtype')."'
										},
									}).success(function(obj) {
								
										if (obj.length > 0) {
											

											if ($.pf_tablet_check() || $('.pointfinder-mini-search #pointfinder-search-form-manual').length > 0) {
												$('label[for=\"".$slug."_sel\"]').css('display','none');
												$('.pf-sub-listingtypes-container').append('<div class=\'pfsublistingtypes\'>'+obj+'</div>').css('opacity',1);
												if($('.pf-sub-listingtypes-container').is(':hidden')){
													$('.pf-sub-listingtypes-container').show();
												}
												
												$('#pfupload_sublistingtypes').select2({
													dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
													placeholder: '".$placeholderforlistingtype."', 
													formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
													allowClear: true, 
													minimumResultsForSearch: 10
												});

												if(multiple_ex == 1){
													$('#pfupload_sublistingtypes').on('select2:close', function (evt) {
														var uldiv = $(this).siblings('span.select2').find('ul');
													  	var count = uldiv.find('li').length - 1;
													 	if(count == 1){
													  		uldiv.html('<li>'+uldiv.find('li').text().replace('×','')+'</li>');
												  		}else if(count > 1){
												  			uldiv.html('<li>'+count+' ".esc_html__("categories selected","pointfindercoreelements")."</li>');
												  		}
													});
												}

											
												$('#pfsearchsubvalues').data('sli',itemid);

												if ($('#pfupload_sublistingtypes').hasClass('select2-hidden-accessible')) {
													
													if($('.pf-sub-listingtypes-container').find('.select2-selection--multiple.pfselect2container').length > 0){
														$('.pf-sub-listingtypes-container').find('.select2-selection--multiple.pfselect2container').append('<span class=\"pfsubliback\" title=\"".esc_html__( "Select Main Category", "pointfindercoreelements")."\"><i class=\"fas fa-undo\"></i></span>');
													}else{
														$('#select2-pfupload_sublistingtypes-container').parent().append('<span class=\"pfsubliback\" title=\"".esc_html__( "Select Main Category", "pointfindercoreelements")."\"><i class=\"fas fa-undo\"></i></span>');
													}

													$('.pfsubliback').on('click',function(){
														";
														if ($minisearch == 1) {
															$this->ScriptOutput .= "$('.pointfinder-mini-search').removeClass('hassubvalues');";
														}
														$this->ScriptOutput .= "
														$('#pfsearchsubvalues').css('opacity',0).hide('fast');
														$('#pfupload_sublistingtypes').select2('close');

														$('.pf-sub-listingtypes-container').css('opacity',0);

														ltslugsel.val(null).trigger('change');

														$('label[for=\"".$slug."_sel\"]').css('display','block');

													});
												}
												

											}else{
												$('.pf-sub-listingtypes-container').append('<div class=\'pfsublistingtypes\'>'+obj+'</div>').css('opacity',1);
																				
											";

											if ($as_mobile_dropdowns != 1) {
												$this->ScriptOutput .= "
													$('#pfupload_sublistingtypes').select2({
														dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
														placeholder: '".$placeholderforlistingtype."', 
														formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
														allowClear: true, 
														minimumResultsForSearch: 10
													});

													if(multiple_ex == 1){
														$('#pfupload_sublistingtypes').on('select2:close', function (evt) {
															var uldiv = $(this).siblings('span.select2').find('ul');
														  	var count = uldiv.find('li').length - 1;
														 	uldiv.html('<li>'+count+' ".esc_html__("sub listing type selected","pointfindercoreelements")."</li>');
														});
													}
												";
											}

											$this->ScriptOutput .= '}';

											$this->ScriptOutput .= '$.pf_data_pfpcl_apply();';

											if ($stp4_forceu_cs == 1) {
												$this->ScriptOutput .= "$('#pfupload_sublistingtypes').rules('add',{
													required: true,
													messages:{required:'".$setup4_submitpage_listingtypes_verror."'
												}});";
											}

											if (empty($sub_sub_level)) {
											$this->ScriptOutput .= " if ($('#pfupload_sublistingtypes').val() != 0 && ($.inArray(parseInt(ltslugsel.val()),pfmultipleselect) == -1)) {
												$.pf_get_subsublistingtypes($('#pfupload_sublistingtypes').val(),'');
											}";
											}

											$this->ScriptOutput .= "
											$('#pfupload_sublistingtypes').on('change',function(){
												
												";
												
												if ($minisearch == 1) {
													$this->ScriptOutput .= " if($.pf_tablet4e_check() && $('body').find('.pfminiadvsearch').length > 0){
														$.PFGetSubItems($('#pfupload_sublistingtypes').val(),'',0,1);
													}";
												}

												if ($hormode == 1 && $minisearch != 1){
													$this->ScriptOutput .= " if($.pf_tablet_check() ){
														$.PFGetSubItems($('#pfupload_sublistingtypes').val(),'',0,1);
													}";
												}

												$this->ScriptOutput .= "
												if($(this).val() != 0 && $(this).val() != null){
													
													if (ltsubcatmultiplecheck) {
														ltslugmain.pfLoadingOverlay({action:'show',opacity:0.5});
														ltslug.val($(this).val()).trigger('change');
														
														";
														if ($minisearch == 1) {
															$this->ScriptOutput .= "ltslugmain.pfLoadingOverlay({action:'hide'});";
														}
														$this->ScriptOutput .= "	
														if($('.pfhalfmapdraggable').length > 0 && $.pf_tablet_check()){
															ltslugsel.val($(this).val()).trigger('change');
														}
													}else{
														ltslug.val($(this).val());
													}
													if (($.inArray(parseInt(ltslugsel.val()),pfmultipleselect) == -1)) {
														ltslugmain.pfLoadingOverlay({action:'show',opacity:0.5});
														$.pf_get_subsublistingtypes($(this).val(),'');
													}
												}else{
													if (ltsubcatmultiplecheck) {
														ltslug.val(ltslugsel.val());
													}else{
														ltslugmain.pfLoadingOverlay({action:'show',opacity:0.5});
														ltslug.val(ltslugsel.val()).trigger('change');
													}
													
												}
												$('.pfsubsublistingtypes').remove();
											});
										}

									}).complete(function(obj,obj2){
										
										var fltf_get = $('.pfsearchresults-container').data('fltfget');
										var fltf_getsel = $('.pfsearchresults-container').data('fltfgetsel');

										var ltm = $('.pfsearchresults-container').data('ltm');
										var csauto = $('.pfsearchresults-container').data('csauto');

										if(ltm != '' && ltm != csauto){
											$('#pfupload_sublistingtypes').val(csauto).trigger('change');
										}

										if (obj.responseText != '') {
											
											if (defaultv != '') {
												
												if (ltsubcatmultiplecheck) {
													ltslug.val(defaultv).trigger('change');
												}else{
													ltslug.val(defaultv);
												}
											}else if(itemid != null){
												
												if (ltsubcatmultiplecheck) {
													if (typeof fltf_getsel != 'undefined' && fltf_getsel != '') {
														
														if(fltf_getsel != fltf_get){
															$('#pfupload_sublistingtypes').val(fltf_get).trigger('change');
															
														}else{
															ltslug.val(itemid).trigger('change');
															
														}
													}else{
														ltslug.val(itemid).trigger('change');
														if(itemid == ''){
															if($('#pfupload_subsublistingtypes').length > 0){
																$('#pfupload_subsublistingtypes').select2('close');
																$('.pf-subsub-listingtypes-container').css('opacity',0).css('display','none');
															}

															if($('#pfupload_sublistingtypes').length > 0){
																$('#pfupload_sublistingtypes').select2('close');
																$('.pf-sub-listingtypes-container').css('opacity',0).css('display','none');
															}
															
															$('label[for=\"".$slug."_sel\"]').css('display','block');
														}
													}
												}else{
													if (typeof fltf_getsel != 'undefined' && fltf_getsel != '') {
														if (fltf_get != '') {
															if (typeof fltf_get == 'string' ) {
																var selectedValues = fltf_get.split(',');
																$('#pfupload_sublistingtypes').val(selectedValues).trigger('change');
															}else{
																$('#pfupload_sublistingtypes').val(fltf_get).trigger('change');
															}
															var uldiv = $('#pfupload_sublistingtypes').siblings('span.select2').find('ul');
														  	var count = uldiv.find('li').length - 1;
														 	if(count == 1){
														  		uldiv.html('<li>'+uldiv.find('li').text().replace('×','')+'</li>');
													  		}else if(count > 1){
													  			uldiv.html('<li>'+count+' ".esc_html__("categories selected","pointfindercoreelements")."</li>');
													  		}
															$.PFGetSubItems(fltf_getsel,'',0,1);
														}else{
															ltslug.val(fltf_getsel);
														}
													}else{
														ltslug.val(itemid).trigger('change');
													}
													
												}
											}
											";
											
											if (!empty($sub_sub_level)) {
												$this->ScriptOutput .= "
												if (".$sub_level." == $('#pfupload_sublistingtypes').val()) {
													$.pf_get_subsublistingtypes('".$sub_level."','".$sub_sub_level."');
												}
												";
											}

										$this->ScriptOutput .= "
											ltslugmain.pfLoadingOverlay({action:'hide'});
										}
										
										
										
									});
								}

								$.pf_get_subsublistingtypes = function(itemid,defaultv){

									if (($.inArray(parseInt(itemid),pfsubcatselect) == -1) && ($.inArray(parseInt(itemid),pfmultipleselect) == -1)) {
										var ltsubcatmultiplecheck = true;
									}else{
										var ltsubcatmultiplecheck = false;
									}
									if ($.inArray(parseInt(itemid),pfmultipleselect) != -1) {
										var multiple_ex = 1;
									}else{
										var multiple_ex = 0;
									}

									$.ajax({
								    	beforeSend:function(){
								    		
								    	},
										url: theme_scriptspf.ajaxurl,
										type: 'POST',
										dataType: 'html',
										data: {
											action: 'pfget_listingtype',
											id: itemid,
											default: defaultv,
											sname: 'pfupload_subsublistingtypes',
											stext: '".$placeholderforlistingtypesub."',
											stype: 'listingtypes',
											stax: 'pointfinderltypes',
											lang: '".$lang_custom."',
											security: '".wp_create_nonce('pfget_listingtype')."'
										},
									}).success(function(obj) {
										
										if (obj.length > 0) {
											";

											if ($stp4_forceu_cs == 1) {
												$this->ScriptOutput .= "$('#pfupload_subsublistingtypes').rules('add',{required: true,messages:{required:'".$setup4_submitpage_listingtypes_verror."'}});";
											}

											$this->ScriptOutput .= "

												if ($.pf_tablet_check() || $('.pointfinder-mini-search #pointfinder-search-form-manual').length > 0) {
													$('.pf-sub-listingtypes-container').css('display','none').css('opacity',0);
													$('.pf-subsub-listingtypes-container').append('<div class=\'pfsubsublistingtypes\'>'+obj+'</div>').css('display','block').css('opacity',1);
													if($('.pf-subsub-listingtypes-container').is(':hidden')){
														$('.pf-subsub-listingtypes-container').show();
													}

												
													$('#pfupload_subsublistingtypes').select2({
														dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
														placeholder: '".$placeholderforlistingtypesub."', 
														formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
														allowClear: true, 
														minimumResultsForSearch: 10
													});

													setTimeout(function(){
														if ($('#pfupload_subsublistingtypes').hasClass('select2-hidden-accessible')) {
															$('#select2-pfupload_subsublistingtypes-container').parent().append('<span class=\"pfsubliback2\" title=\"".esc_html__( "Select Sub Category", "pointfindercoreelements")."\"><i class=\"fas fa-undo\"></i></span>');

															$('.pfsubliback2').on('click',function(){
																";
																if ($minisearch == 1) {
																	$this->ScriptOutput .= "$('.pointfinder-mini-search').removeClass('hassubvalues');";
																}
																$this->ScriptOutput .= "
																$('label[for=\"".$slug."_sel\"]').css('display','block');
																$('.pf-sub-listingtypes-container').css('opacity',1).css('display','block');
																$('.pf-subsub-listingtypes-container').css('opacity',0).css('display','none');
																$('#pfsearchsubvalues').css('opacity',0).hide('fast');
																$('#pfupload_subsublistingtypes').select2('close');
																ltslugsel.val($('#pfsearchsubvalues').data('sli')).trigger('change');
																$('#pfupload_sublistingtypes').val($('#pfsearchsubvalues').data('sli'));
																
															});
														}
													},0);

												}else{
													$('.pf-subsub-listingtypes-container').append('<div class=\'pfsubsublistingtypes\'>'+obj+'</div>').css('opacity',1);
											
												";
												if ($as_mobile_dropdowns != 1) {
													$this->ScriptOutput .= "
														$('#pfupload_subsublistingtypes').select2({
															dropdownCssClass:'pfselect2drop',containerCssClass:'pfselect2container',
															placeholder: '".$placeholderforlistingtypesub."', 
															formatNoMatches:'".esc_html__('No match found','pointfindercoreelements')."',
															allowClear: true, 
															minimumResultsForSearch: 10
														});
													";
												}
												$this->ScriptOutput .= '}';
												$this->ScriptOutput .= '$.pf_data_pfpcl_apply();';
											

											$this->ScriptOutput .= "
											$('#pfupload_subsublistingtypes').on('change',function(){
											
												if($('#pfupload_subsublistingtypes').val() != 0){

													";
													
													if ($minisearch == 1) {
														$this->ScriptOutput .= " if($.pf_tablet4e_check() && $('body').find('.pfminiadvsearch').length > 0){
															$.PFGetSubItems($('#pfupload_subsublistingtypes').val(),'',0,1);
														}";
													}

													if ($hormode == 1){
														$this->ScriptOutput .= " if($.pf_tablet_check() ){
															$.PFGetSubItems($('#pfupload_subsublistingtypes').val(),'',0,1);
														}";
													}
												$this->ScriptOutput .= "
													if (ltsubcatmultiplecheck) {
														ltslug.val($(this).val()).trigger('change');
													}else{
														ltslug.val($(this).val());
													}

												}else{
													
													if (ltsubcatmultiplecheck) {
														ltslug.val($('#pfupload_sublistingtypes').val()).trigger('change');
													}else{
														ltslug.val($('#pfupload_sublistingtypes').val());
													}
												}
											});
										}

									}).complete(function(obj,obj2){
										if (obj.responseText != '') {
											
											if (defaultv != '') {
												if (ltsubcatmultiplecheck) {
													ltslug.val(defaultv).trigger('change');
												}else{
													ltslug.val(defaultv);
												}
											}else{
												
												if (ltsubcatmultiplecheck) {
													ltslug.val(itemid);
												}else{
													ltslug.val(itemid);
												}
											}
										}
										ltslugmain.pfLoadingOverlay({action:'hide'});
										
										
									});
								}


								ltslugsel.on('change',function(){
									if($(this).val() != null){
										ltslugmain.css('position','relative').pfLoadingOverlay({action:'show',opacity:0.5});
										ltslug.val($(this).val());
										$('.pf-sub-listingtypes-container').html('');
										$.pf_get_sublistingtypes($(this).val(),'');
									}
								});
							";

							
						}
					}

					
					
					if($column_type == 1){
						if ($this->PFHalf % 2 == 0) {
							$this->FieldOutput .= '</div></div>';
						}else{
							$this->FieldOutput .= '</div>';
							$this->FieldOutput .= '</div></div></div>';
						}
					}else{
						$this->FieldOutput .= '</div>';
						$this->FieldOutput .= '</div>';
					};

					
				}/*Parent Check*/
			}
	    }
	}

	
}