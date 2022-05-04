<?php

if (!trait_exists('PointFinderCheckboxSearchField')) {

	trait PointFinderCheckboxSearchField
	{
	   

	    public function pointfinder_get_search_checkbox_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
				$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target','','');
				if (empty($target)) {
					$target = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_target_target','','');
				}
				
				$itemparent = $this->CheckItemsParent($target);

				if($itemparent == 'none'){
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

							if (class_exists('SitePress')) {
								$s = apply_filters( 'wpml_translate_single_string', $s, 'admin_texts_pfsearchfields_options', '[pfsearchfields_options][setupsearchfields_'.$slug.'_rvalues]'.$ikk );
							}

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
			}
	    }
	    
	}

}