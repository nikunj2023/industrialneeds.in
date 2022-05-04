<?php

if (!trait_exists('PointFinderSliderSearchField')) {


	trait PointFinderSliderSearchField
	{
	  
	    public function pointfinder_get_search_slider_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
						
				$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');

				$itemparent = $this->CheckItemsParent($target);
				
				if($itemparent == 'none'){								
					
					$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');

					//Check price item
					$itempriceval = $this->PriceFieldCheck($target);
					
					
					//Check size item
					$itemsizeval = $this->SizeFieldCheck($target);
						
					// Get slider type.
					$slidertype = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_type','','');
					if($slidertype == 'range'){ $slidertype = 'true';}


					//Min value, max value, steps, color
					$fmin = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_min','','0');
					$fmax = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_max','','1000000');
					$fsteps = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_steps','','1');
					$fcolor = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_colorslider','','#3D637C');
					$fcolor2 = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_colorslider2','','#444444');
					$svalue = '';
					
					$slidertypetext = $valuestext = '';
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
					
						//Slider size calculate
						if(strlen($fmax) <=3){
							$slidersize = ((strlen($fmax)*8))+4;
						}else{
							if($suffixtext != ''){
								$slidersize = ((strlen($fmax)*8)*2)+70;
							}else{
								$slidersize = ((strlen($fmax)*8)*2)+50;
							}
						}
						//Output for this field
						$this->FieldOutput .= ' <div id="'.$slug.'_main"><label for="'.$slug.'-view" class="pfrangelabel">'.$fieldtext.'</label><input type="text" id="'.$slug.'-view" class="slider-input" style="width:'.$slidersize.'px" disabled>';
						$this->FieldOutput .= '<input name="'.$slug.'" id="'.$slug.'-view2" type="hidden" class="pfignorevalidation" value="">';
						$this->FieldOutput .= ' <div class="slider-wrapper"><div id="'.$slug.'"></div>  </div></div>';
						
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

					
					if (array_key_exists($slug,$pfgetdata)) {
						$this->ScriptOutput .= '$( "#'.$slug.'-view2" ).val("'.$pfgetdata[$slug].'");';
					}
				}
			}
	    }
	}

	
}