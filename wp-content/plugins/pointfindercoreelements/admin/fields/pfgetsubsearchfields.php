<?php
/**********************************************************************************************************************************
*
* Custom Sub Search Fields Retrieve Value Class
* This class prepared for help to create auto config file.
* Author: Webbu
*
***********************************************************************************************************************************/
if ( ! class_exists( 'PF_SFSUB_Val' ) ){
	class PF_SFSUB_Val{
		
		use PointFinderOptionFunctions;
		use PointFinderCommonFunctions;
		use PointFinderWPMLFunctions;

		public $FieldOutput;
		public $PFHalf = 1;
		public $ScriptOutput;
		public $ScriptOutputDocReady;
		public $VSORules;
		public $VSOMessages;


		public function __construct(){}
		
		private function PriceFieldCheck($slug){
			if($this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_check','','0') == 1){
				return array(
					'CFPrefix' => apply_filters( 'wpml_translate_single_string', $this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_prefix','',''), 'admin_texts_pfcustomfields_options', '[pfcustomfields_options]setupcustomfields_'.$slug.'_currency_prefix' ),
					'CFSuffix' => apply_filters( 'wpml_translate_single_string', $this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_suffix','',''), 'admin_texts_pfcustomfields_options', '[pfcustomfields_options]setupcustomfields_'.$slug.'_currency_suffix' ),
					'CFDecima' => $this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_decima','','0'),
					'CFDecimp' => $this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_decimp','','.'),
					'CFDecimt' => ($this->PFCFIssetControl('setupcustomfields_'.$slug.'_currency_decimp','','.') == '.')? ',':'.'
				);
			}else{return 'none';	}
		}
		
		private function SizeFieldCheck($slug){
			if($this->PFCFIssetControl('setupcustomfields_'.$slug.'_size_check','','0') == 1){
				$CFDecimp = $this->PFCFIssetControl('setupcustomfields_'.$slug.'_size_decimp','','.');
				if ($CFDecimp == '.') {
					$CFDecimt = ',';
				}else{
					$CFDecimt = '.';
				}

				return array(
					'CFPrefix' => $this->PFCFIssetControl('setupcustomfields_'.$slug.'_size_prefix','',''),
					'CFSuffix' => $this->PFCFIssetControl('setupcustomfields_'.$slug.'_size_suffix','',''),
					'CFDecima' => $this->PFCFIssetControl('setupcustomfields_'.$slug.'_size_decima','','0'),
					'CFDecimp' => $CFDecimp,
					'CFDecimt' => $CFDecimt
				);
			}else{return 'none';	}
		}
		
		private function CheckItemsParent($slug){
			$RelationFieldName = 'setupcustomfields_'.$slug.'_parent';

			$ParentItem = $this->PFCFIssetControl($RelationFieldName,'','');

			if(!empty($ParentItem)){
				
				if(class_exists('SitePress')) {
					if (is_array($ParentItem)) {
						foreach ($ParentItem as $key => $value) {
							$ParentItem[$key] = apply_filters( 'wpml_object_id',$value,'pointfinderltypes',true,$this->PF_current_language());
						}
					}else{
						$ParentItem = apply_filters( 'wpml_object_id',$ParentItem,'pointfinderltypes',true,$this->PF_current_language());
					}
					return $ParentItem;
					
				} else {
					return $ParentItem;
				}
			}else{
				return 'none';
			}
		}
		
		
		public function GetValue($title,$slug,$ftype,$widget,$pfgetdata = array(),$fieldparentitem = '',$hormode = 0,$pflang = ""){
					
					if (empty($widget)) {
						$widget = 0;
					}
					if (class_exists('SitePress') && !empty($pflang)) {
			            do_action( 'wpml_switch_language', $pflang );
					}

					if (!empty($pfgetdata)) {
						$pfgetdata = json_decode(base64_decode($pfgetdata),true);
					}else{
						$pfgetdata = array();
					}

					$showonlywidget = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_showonlywidget','','0');
					$showonlywidget_check = 'show';

					if ($showonlywidget == 0 && $widget == 0) {
						$showonlywidget_check = 'show';
					}elseif ($showonlywidget == 1 && $widget == 0) {
						$showonlywidget_check = 'hide';
					}else{
						$showonlywidget_check = 'show';
					}
					
					switch($ftype){
						case '1':
						/* Select Box */
							
							if ($showonlywidget_check == 'show') {
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues_target_target','','');
								$itemparent = $this->CheckItemsParent($target);
								$placeholder = '';
								/*Check element: is it a taxonomy?*/
								$rvalues_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues_check','','0');
								if($itemparent != 'none' && $rvalues_check == 1){
									if(in_array($fieldparentitem, $itemparent)){

										$select2sh = $multiplevar = $taxmultipletype = '';

										$validation_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_validation_required','','0');
										$as_mobile_dropdowns = $this->PFSAIssetControl('as_mobile_dropdowns','','0');
										$select2_style = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_select2','','0');
										$placeholder = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_placeholder','','');
										$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');
										$multiple = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_multiple','','0');
										$rvalues = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues','','');
										$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');

										if($validation_check == 1){
											$validation_message = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_message','','');
											$this->ScriptOutput .= '
												$("#'.$slug.'").rules( "add", {
												  required: true,
												  messages: {
												    required: "'.$validation_message.'",
												  }
												});
											';
										}
										
										if($select2_style == 0){$select2sh = ', minimumResultsForSearch: -1';}

										if($placeholder == ''){ $placeholder = esc_html__('Please select','pointfindercoreelements');}
								
										$nomatch = apply_filters( 'wpml_translate_single_string', $this->PFSFIssetControl('setupsearchfields_'.$slug.'_nomatch','','0'), 'admin_texts_pfsearchfields_options', '[pfsearchfields_options]setupsearchfields_'.$slug.'_nomatch');

										if(empty($nomatch)){ $nomatch = '';}
										
										if($multiple == 1){$multiplevar = 'multiple';}
										
										if ($multiple == 1 ) {$taxmultipletype = '[]';}
										
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
										}


										/*/Begin to create Select Box*/
										$this->ScriptOutput .= '$("#'.$slug.'").select2({dropdownCssClass:"pfselect2drop",containerCssClass:"pfselect2container",placeholder: "'.esc_js($placeholder).'", formatNoMatches:"'.esc_js($nomatch).'",allowClear: true,dropdownAutoWidth:true, width: "100%"'.$select2sh.'});';
										
										
										if ($as_mobile_dropdowns == 1) {
											$this->ScriptOutput .= 'if(!$.pf_tablet_check()){$("#'.$slug.'").select2("destroy");}';
										}

										
										$this->FieldOutput .= '<div class="pftitlefield">'.$fieldtext.'</div>';
										$this->FieldOutput .= '<label for="'.$slug.'" class="lbl-ui select">';


										if ($as_mobile_dropdowns == 1) {
											$as_mobile_dropdowns_text = 'class="pf-special-selectbox"  data-pf-plc="'.$placeholder.'" data-pf-stt="false"';
										} else {
											$as_mobile_dropdowns_text = '';
										}

										

										$this->FieldOutput .= '<select '.$multiplevar.' id="'.$slug.'" name="'.$slug.$taxmultipletype.'" '.$as_mobile_dropdowns_text.'>';

											

											if(count($rvalues) > 0){$fieldvalues = $rvalues;}else{$fieldvalues = '';}/* Get element's custom values.*/

											if(count($fieldvalues) > 0){
												
												$this->FieldOutput .= '	<option></option>';
												
												if ($multiple == 1 ){
													$this->FieldOutput .= '<optgroup disabled hidden></optgroup>';
												}
												$ikk = 0;

												foreach ($fieldvalues as $s) { 

													$s = apply_filters( 'wpml_translate_single_string', $s, 'admin_texts_pfsearchfields_options', '[pfsearchfields_options][setupsearchfields_'.$slug.'_rvalues]'.$ikk );

													if ($pos = strpos($s, '=')) { 
														
														$sword_output_last = '	<option value="'.trim(substr($s, 0, $pos)).'">'.substr($s, $pos + strlen('=')).'</option>';

														if($widget == 1){
															
															if (array_key_exists($slug,$pfgetdata)) {
																if (isset($pfgetdata[$slug])) {
																	
																	$sword_soutput = '	<option value="'.trim(substr($s, 0, $pos)).'" selected>'.substr($s, $pos + strlen('=')).'</option>';

																	if (is_array($pfgetdata[$slug])) {
																		if (in_array(trim(substr($s, 0, $pos)), $pfgetdata[$slug])) {
																			$sword_output_last = $sword_soutput;
																		}
																	}else{
																		if (trim(substr($s, 0, $pos)) == $pfgetdata[$slug]) {
																			$sword_output_last = $sword_soutput;
																		}
																	}
																}
															}

														}
														$this->FieldOutput .= $sword_output_last;
													}
													$ikk++;
												}
											}

										$this->FieldOutput .= '</select>';
										$this->FieldOutput .= '</label>';
										
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
									}
								}/*Parent Check*/

							
								

							}/*Show only widget end.*/


							break;
						
						case '2':
						/* Slider Field */
						
							if ($showonlywidget_check == 'show') {
								
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');

								$itemparent = $this->CheckItemsParent($target);
								if($itemparent != 'none'){
								if(in_array($fieldparentitem, $itemparent)){								
									
									$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');
									$slidertype = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_type','','');
									$fmin = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_min','','0');
									$fmax = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_max','','1000000');
									$fsteps = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_steps','','1');
									$fcolor = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_colorslider','','#3D637C');
									$fcolor2 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_colorslider2','','#444444');
									$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');	
								
									$itempriceval = $this->PriceFieldCheck($target);
									$itemsizeval = $this->SizeFieldCheck($target);
									

									if($slidertype == 'range'){ $slidertype = 'true';}

									$svalue = '';
									
									if (!empty($pfgetdata)) {
										if (array_key_exists($slug,$pfgetdata)) {
											if($slidertype == 'true'){ 
												$valuestext = 'values:'.'['.$pfgetdata[$slug].'],'; 
												$slidertypetext = 'range: '.$slidertype.',';
											}
											if($slidertype == 'min'){ 
												$valuestext = 'value:'.$pfgetdata[$slug].',';
												$slidertypetext = 'range: \''.$slidertype.'\',';
											}
											if($slidertype == 'max'){ 
												$valuestext = 'value:'.$pfgetdata[$slug].',';
												$slidertypetext = 'range: \''.$slidertype.'\',';
											}
										}else{
											if($slidertype == 'true'){ 
												$valuestext = 'values:'.'['.$fmin.','.$fmax.'],'; 
												$slidertypetext = 'range: '.$slidertype.',';
											}
											if($slidertype == 'min'){ 
												$valuestext = 'value:'.$fmin.',';
												$slidertypetext = 'range: \''.$slidertype.'\',';
											}
											if($slidertype == 'max'){ 
												$valuestext = 'value:'.$fmax.',';
												$slidertypetext = 'range: \''.$slidertype.'\',';
											}
										}
									}else{
										if($slidertype == 'true'){ 
											$valuestext = 'values:'.'['.$fmin.','.$fmax.'],'; 
											$slidertypetext = 'range: '.$slidertype.',';
										}
										if($slidertype == 'min'){ 
											$valuestext = 'value:'.$fmin.',';
											$slidertypetext = 'range: \''.$slidertype.'\',';
										}
										if($slidertype == 'max'){ 
											$valuestext = 'value:'.$fmax.',';
											$slidertypetext = 'range: \''.$slidertype.'\',';
										}
									}
									
									if($itempriceval != 'none'){
										$suffixtext = '+"'.$itempriceval['CFSuffix'].'"';
										$suffixtext2 = '+" - "';
										$prefixtext = '"'.$itempriceval['CFPrefix'].'"+';
										$prefixtext2 = '+"'.$itempriceval['CFPrefix'].'"+';
										$prefixtext3 = $itempriceval['CFPrefix'];
									}elseif($itemsizeval != 'none'){
										$suffixtext = '+"'.$itemsizeval['CFSuffix'].'"';
										$suffixtext2 = '+" - "';
										$prefixtext = '"'.$itemsizeval['CFPrefix'].'"+';
										$prefixtext2 = '+"'.$itemsizeval['CFPrefix'].'"+';
										$prefixtext3 = $itemsizeval['CFPrefix'];
									}else{
										$suffixtext = '';
										$suffixtext2 = '" - "';
										$prefixtext = '';
										$prefixtext2 = '';
										$prefixtext3 = '';
									}
									
									//Create script for this slider.

									$slideroptions = '{'.$slidertypetext.''.$valuestext.'min: '.esc_js($fmin).',max: '.esc_js($fmax).',step: '.esc_js($fsteps).',slide: function(event, ui) {';
										
									$slideroptions .= '$("#'.$slug.'-view").';
									if($slidertype == 'true'){
										if($itempriceval != 'none'){
											$slideroptions .='val('.$prefixtext.' number_format(ui.values[0], '.$itempriceval['CFDecima'].', "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") + " - '.$prefixtext3.'" + number_format(ui.values[1], '.$itempriceval['CFDecima'].', "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") '.$suffixtext.');';
											
											
										}elseif($itemsizeval != 'none'){
											$slideroptions .='val('.$prefixtext.' number_format(ui.values[0], '.$itemsizeval['CFDecima'].', "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'") + " - '.$prefixtext3.'" + number_format(ui.values[1], '.$itemsizeval['CFDecima'].', "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'")  '.$suffixtext.');';
											
										}else{
											$slideroptions  .='val(ui.values[0] + " - " + ui.values[1]);';
											
										}
									}else{
										if($itempriceval != 'none'){
											$slideroptions .='val('.$prefixtext.' number_format(ui.value, "'.$itempriceval['CFDecima'].'", "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") '.$suffixtext.');';
											
										}elseif($itemsizeval != 'none'){
											//$slideroptions  .='val('.$prefixtext.' ui.value '.$suffixtext.');';
											$slideroptions .='val('.$prefixtext.' number_format(ui.value, "'.$itemsizeval['CFDecima'].'", "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'") '.$suffixtext.');';
											
										}else{
											$slideroptions .='val(ui.value);';
											
										}
									}
									
									$slideroptions .= '$("#'.$slug.'-view2").';
									if($slidertype == 'true'){
										$slideroptions .='val(ui.values[0]+","+ui.values[1]);';
									}else{
										$slideroptions .='val(ui.value);';
									}
									
									$slideroptions .='}}';
									
									$this->ScriptOutput .= '$( "#'.$slug.'" ).slider('.$slideroptions.');';


									$this->ScriptOutput .= '
									$("#pf-resetfilters-button").on("click", function(event) {
										$("#'.$slug.'-view2").val("");
										$( "'.$slug.'" ).slider( "destroy" );
										$( "#'.$slug.'" ).slider('.$slideroptions.');
									});
									';
									
									$this->ScriptOutput .='$( "#'.$slug.'" ).addClass("ui-slider-'.$slug.'");';
									
									if($slidertype == 'true'){
										if($itempriceval != 'none'){
											$this->ScriptOutput .='$("#'.$slug.'-view").val('.$prefixtext.' number_format($("#'.$slug.'").slider("values",0), '.$itempriceval['CFDecima'].', "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") '.$suffixtext2.''.$prefixtext2.'number_format($("#'.$slug.'").slider("values",1), '.$itempriceval['CFDecima'].', "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") '.$suffixtext.');';
										}elseif($itemsizeval != 'none'){
											$this->ScriptOutput .='$("#'.$slug.'-view").val('.$prefixtext.' number_format($("#'.$slug.'").slider("values", 0), '.$itemsizeval['CFDecima'].', "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'")  '.$suffixtext2.''.$prefixtext2.' number_format($("#'.$slug.'").slider("values", 1), '.$itemsizeval['CFDecima'].', "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'") '.$suffixtext.');';
										}else{
											$this->ScriptOutput .='$("#'.$slug.'-view").val($("#'.$slug.'").slider("values", 0) + " - " + $("#'.$slug.'").slider("values", 1));';
										}
									}else{
										if($itempriceval != 'none'){
											$this->ScriptOutput .='$("#'.$slug.'-view").val( '.$prefixtext.' number_format($("#'.$slug.'").slider("value"), '.$itempriceval['CFDecima'].', "'.$itempriceval['CFDecimp'].'", "'.$itempriceval['CFDecimt'].'") '.$suffixtext.');';
										}elseif($itemsizeval != 'none'){
											$this->ScriptOutput .='$("#'.$slug.'-view").val( '.$prefixtext.' number_format($("#'.$slug.'").slider("value"), '.$itemsizeval['CFDecima'].', "'.$itemsizeval['CFDecimp'].'", "'.$itemsizeval['CFDecimt'].'") '.$suffixtext.');';
										}else{
											$this->ScriptOutput .='$("#'.$slug.'-view").val( $("#'.$slug.'").slider("value"));';
										}
									}
									
									
									$this->ScriptOutputDocReady .= '$(document).one("ready",function(){$.pfsliderdefaults.fields["'.$slug.'_main"] = $("#'.$slug.'-view").val()});';
												
									
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
									
									//Slider size calculate
									if(strlen($fmax) <=3){
										$slidersize = ((strlen($fmax)*8))+10;
									}else{
										if($suffixtext != ''){
											$slidersize = ((strlen($fmax)*8)*2)+70;
										}else{
											$slidersize = ((strlen($fmax)*8)*2)+50;
										}
									}
									//Output for this field
									$this->FieldOutput .= ' <div id="'.$slug.'_main"><label for="'.$slug.'-view" class="pfrangelabel">'.$fieldtext.'</label>
															<input type="text" id="'.$slug.'-view" class="slider-input" style="width:'.$slidersize.'px" disabled>';
									
									$this->FieldOutput .= '<input name="'.$slug.'" id="'.$slug.'-view2" type="hidden" class="pfignorevalidation" value="">';
									
									$this->FieldOutput .= '<div class="slider-wrapper">';
									if ($slidertype == 'true') {
										$this->FieldOutput .= '<div id="'.$slug.'" class="pfrangeorj"></div>';
									}else{
										$this->FieldOutput .= '<div id="'.$slug.'"></div>';
									}
									
									$this->FieldOutput .= '</div></div>';
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

									if (!empty($pfgetdata)) {
										if (array_key_exists($slug,$pfgetdata)) {
											$this->ScriptOutput .= '$( "#'.$slug.'-view2" ).val("'.$pfgetdata[$slug].'");';
										}
									}
								}
								}
							}
							break;
						
						case '4':
						/* Text Field */
							
							if ($showonlywidget_check == 'show') {
								
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target_target','','');

								$itemparent = $this->CheckItemsParent($target);
								
								if($itemparent != 'none'){
								if(in_array($fieldparentitem, $itemparent)){

									$validation_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_validation_required','','0');
									$field_autocmplete = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_autocmplete','','1');

									if($validation_check == 1){
										$validation_message = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_message','','');

										$this->ScriptOutput .= '
											$("#'.$slug.'").rules( "add", {
											  required: true,
											  messages: {
											    required: "'.$validation_message.'",
											  }
											});
										';
								    }
									
									$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');
									$placeholder = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_placeholder','','');
									$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');

									$geolocfield = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_geolocfield','','0');
									$geolocfield = ($geolocfield == 1)? 'Mile':'Km';
									$geolocfield2 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_geolocfield2','','100');
									
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
									if (!empty($pfgetdata)) {
										if (array_key_exists($slug,$pfgetdata)) {
											$valtext = ' value = "'.$pfgetdata[$slug].'" ';;
										}else{
											$valtext = '';
										}
									}else{
										$valtext = '';
									}
									if ($target == 'title' || $target == 'address') {
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
											  appendTo: ".pflabelfixsearch'.$slug.'",
										      source: function( request, response ) {
										        $.ajax({
										          url: theme_scriptspf.ajaxurl,
										          dataType: "jsonp",
										          data: {
										          	action: "pfget_autocomplete",
										            q: request.term,
										            security: theme_scriptspf.pfget_autocomplete,
										            lang: "'.$pflang.'",
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
											  appendTo: ".pflabelfixsearch'.$slug.'",
										      source: function( request, response ) {
										        $.ajax({
										          url: theme_scriptspf.ajaxurl,
										          dataType: "jsonp",
										          data: {
										          	action: "pfget_autocomplete",
										            q: request.term,
										            security: theme_scriptspf.pfget_autocomplete,
										            lang: "'.$pflang.'",
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
										      },
										      close: function() {
										        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
										      }
										    });

											});
											';
										}
									} else {
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
											  appendTo: ".pflabelfixsearch'.$slug.'",
										      source: function( request, response ) {
										        $.ajax({
										          url: theme_scriptspf.ajaxurl,
										          dataType: "jsonp",
										          data: {
										          	action: "pfget_autocomplete",
										            q: request.term,
										            security: theme_scriptspf.pfget_autocomplete,
										            lang: "'.$pflang.'",
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
							break;

						case '5':
						/* Date Field */
							
							if ($showonlywidget_check == 'show') {
								wp_enqueue_script('jquery-ui-core');
								wp_enqueue_script('jquery-ui-datepicker');

								$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');
								if (empty($target)) {
									$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target_target','','');
								}

								$itemparent = $this->CheckItemsParent($target);
								if($itemparent != 'none'){
									if(in_array($fieldparentitem, $itemparent)){

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

										
											
										$this->FieldOutput .= '
										<div id="'.$slug.'_main">
										<label for="'.$slug.'" class="pftitlefield">'.$fieldtext.'</label>
										<label class="lbl-ui pflabelfixsearch pflabelfixsearch'.$slug.'">
											<input type="text" name="'.$slug.'" id="'.$slug.'" class="input" placeholder="'.$placeholder.'"'.$valtext.' />
										</label>    
										</div>                        
										';

										$setup4_membersettings_dateformat = $this->PFSAIssetControl('setup4_membersettings_dateformat','','1');
										$setup3_modulessetup_openinghours_ex2 = $this->PFSAIssetControl('setup3_modulessetup_openinghours_ex2','','1');
										$yearselection = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_yearselection','','0');
										$date_field_rtl = (!is_rtl())? 'false':'true';
										$date_field_ys = (empty($yearselection))?'false':'true';

										switch ($setup4_membersettings_dateformat) {
											case '1':$date_field_format = 'dd/mm/yy';break;
											case '2':$date_field_format = 'mm/dd/yy';break;
											case '3':$date_field_format = 'yy/mm/dd';break;
											case '4':$date_field_format = 'yy/dd/mm';break;
											default:$date_field_format = 'dd/mm/yy';break;
										}

										$yearrange1 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_yearrange1','','2000');
										$yearrange2 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_yearrange2','',date("Y"));

										if (!empty($yearrange1) && !empty($yearrange2)) {
											$yearrangesetting = 'yearRange:"'.$yearrange1.':'.$yearrange2.'",';
										}elseif (!empty($yearrange1) && empty($yearrange2)) {
											$yearrangesetting = 'yearRange:"'.$yearrange1.':'.date("Y").'",';
										}else{
											$yearrangesetting = '';
										}

										$this->ScriptOutput .= "
											$(function(){
												$( '#".$slug."' ).datepicker({
											      changeMonth: $date_field_ys,
											      changeYear: $date_field_ys,
											      isRTL: $date_field_rtl,
											      dateFormat: '$date_field_format',
											      firstDay: $setup3_modulessetup_openinghours_ex2,/* 0 Sunday 1 monday*/
											      $yearrangesetting
											      prevText: '',
											      nextText: '',
											      beforeShow: function(input, inst) {
												       $('#ui-datepicker-div').addClass('pointfinder-map-datepicker');
												   }
											    });
											});
							            ";

										if($column_type == 1){
											if ($this->PFHalf % 2 == 0) {
												$this->FieldOutput .= '</div>';
											}else{
												
												$this->FieldOutput .= '</div>';
												
												$this->FieldOutput .= '</div></div>';
											}
										}else{
											
											$this->FieldOutput .= '</div>';
											
										}
									}
								}
							}
							break;

						case '6':
						/* check Box */
							if ($showonlywidget_check == 'show') {
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');
								if (empty($target)) {
									$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target_target','','');
								}

								$itemparent = $this->CheckItemsParent($target);

								if($itemparent != 'none'){
									if(in_array($fieldparentitem, $itemparent)){
										$validation_check = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_validation_required','','0');
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
										
										$this->FieldOutput .= '<div class="pfsfield">';
										$this->FieldOutput .= '<div id="'.$slug.'_main">';
										
										$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');
										$this->FieldOutput .= '<div class="pftitlefield">'.$fieldtext.'</div>';
										//$this->FieldOutput .= '<label for="'.$slug.'" class="lbl-ui checkbox">';
										$this->FieldOutput .= '<div class="option-group">';

										$rvalues = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_rvalues','','');

										if(count($rvalues) > 0){$fieldvalues = $rvalues;}else{$fieldvalues = '';}

										if(count($fieldvalues) > 0){
											
											$ikk = 0;
											$widget_checkbox = '';
											if ($widget != 0) {
												$widget_checkbox = '[]';
											}

											foreach ($fieldvalues as $s) { 

												$s = apply_filters( 'wpml_translate_single_string', $s, 'admin_texts_pfsearchfields_options', '[pfsearchfields_options][setupsearchfields_'.$slug.'_rvalues]'.$ikk );
	
												if ($pos = strpos($s, '=')) { 

													$this->FieldOutput .= '<span class="goption">';
					   								$this->FieldOutput .= '<label class="options">';


													$checkbox_output = '<input type="checkbox" name="'.$slug.$widget_checkbox.'" value="'.trim(substr($s, 0, $pos)).'" /><span class="checkbox"></span></label><label for="'.$slug.'">'.trim(substr($s, $pos + strlen('='))).'</label>';

													if (array_key_exists($slug,$pfgetdata)) {
														if (isset($pfgetdata[$slug])) {
															if (is_array($pfgetdata[$slug])) {
																if (in_array(trim(substr($s, 0, $pos)), $pfgetdata[$slug])) {
																	$checkbox_output = '<input type="checkbox" name="'.$slug.$widget_checkbox.'" value="'.trim(substr($s, 0, $pos)).'" checked /><span class="checkbox"></span></label><label for="'.$slug.'">'.trim(substr($s, $pos + strlen('='))).'</label>';
																}
															}else{
																if (trim(substr($s, 0, $pos)) == $pfgetdata[$slug]) {
																	$checkbox_output = '<input type="checkbox" name="'.$slug.$widget_checkbox.'" value="'.trim(substr($s, 0, $pos)).'" checked /><span class="checkbox"></span></label><label for="'.$slug.'">'.trim(substr($s, $pos + strlen('='))).'</label>';
																}
															}
														}
													}

													$this->FieldOutput .= $checkbox_output;

													
												}
												$this->FieldOutput .= '</span>';
												$ikk++;
											}
										}

										$this->FieldOutput .= '</div>';
										
										
										
										$this->FieldOutput .= '</div>';
										
										$this->FieldOutput .= '</div>';
									
									}
									
								}/*Parent Check*/
							}
							break;

						case '7':

							if ($showonlywidget_check == 'show') {
						
								$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');

								$itemparent = $this->CheckItemsParent($target);
								
								if($itemparent != 'none'){			
								if(in_array($fieldparentitem, $itemparent)){
									$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');

									//Check price item
									$itempriceval = $this->PriceFieldCheck($target);
									
									
									//Check size item
									$itemsizeval = $this->SizeFieldCheck($target);


									//Min value, max value, steps, color
									$fmin = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_min','','0');
									$fmax = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_max','','1000000');
									$fsteps = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_steps','','1');
									$fstart = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_startwith','','0');
									$fieldarrows = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldarrows','','1');
									$placeholder = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_placeholder','','');
									
									$svalue = '';
								

									
									if($itempriceval != 'none'){
										$suffixtext = '+"'.$itempriceval['CFSuffix'].'"';
										$suffixtext2 = '+" - "';
										$prefixtext = '"'.$itempriceval['CFPrefix'].'"+';
										$prefixtext2 = '+"'.$itempriceval['CFPrefix'].'"+';
										$prefixtext3 = $itempriceval['CFPrefix'];
										$decimt = $itempriceval['CFDecimt'];
									}elseif($itemsizeval != 'none'){
										$suffixtext = '+"'.$itemsizeval['CFSuffix'].'"';
										$suffixtext2 = '+" - "';
										$prefixtext = '"'.$itemsizeval['CFPrefix'].'"+';
										$prefixtext2 = '+"'.$itemsizeval['CFPrefix'].'"+';
										$prefixtext3 = $itemsizeval['CFPrefix'];
										$decimt = '';
									}else{
										$suffixtext = '';
										$suffixtext2 = '" - "';
										$prefixtext = '';
										$prefixtext2 = '';
										$prefixtext3 = '';
										$decimt = '';
									}
									
									if ($fieldarrows == 1) {
										$noarrow_css = '';
									}else{
										$noarrow_css = ' pfnoarrow';
									}
									
									$slideroptions = '{
										min: '.esc_js($fmin).',
										max: '.esc_js($fmax).',
										step: '.esc_js($fsteps).',
										start: '.esc_js($fstart).',
										classes: {"ui-spinner": "pfspinner'.$noarrow_css.'"},
										change: function( event, ui ) {
											$("#'.$slug.'").spinner( "value",function(index, value) {
												return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "'.$decimt.'")
											});
										}
									}';
												
									
									
									
									$this->ScriptOutput .= '$( "#'.$slug.'" ).spinner('.$slideroptions.');';


									$this->ScriptOutput .= '
									$("#pf-resetfilters-button").on("click", function(event) {
										$( "'.$slug.'" ).spinner( "destroy" );
										$( "#'.$slug.'" ).spinner('.$slideroptions.');
									});

									$("#'.$slug.'").keyup(function(event) {
									  if(event.which >= 37 && event.which <= 40) return;
									  $(this).val(function(index, value) {
									    return value
									    .replace(/\D/g, "")
									    .replace(/\B(?=(\d{3})+(?!\d))/g, "'.$decimt.'")
									    ;
									  });
									});
									';
									
									
									
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
									
										
									//Output for this field
									$this->FieldOutput .= ' <div id="'.$slug.'_main"><label for="'.$slug.'" class="lbl-ui">'.$fieldtext.'<input type="text" id="'.$slug.'" name="'.$slug.'" class="input pfspinner" placeholder="'.$placeholder.'"></label></div>';
										
										
										
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

							break;
					}
					
					
		}

				
	}
}
?>