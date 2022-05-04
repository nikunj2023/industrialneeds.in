<?php

if (!trait_exists('PointFinderNumericSearchField')) {


	trait PointFinderNumericSearchField
	{
	  
	    public function pointfinder_get_search_numeric_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
						
				$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');

				$itemparent = $this->CheckItemsParent($target);
				
				if($itemparent == 'none'){			

					$fieldtext = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_fieldtext','','');

					$itempriceval = $this->PriceFieldCheck($target);
					
					$itemsizeval = $this->SizeFieldCheck($target);


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
	}

	
}