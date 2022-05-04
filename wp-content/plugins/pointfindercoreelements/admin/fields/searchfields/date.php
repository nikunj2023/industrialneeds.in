<?php

if (!trait_exists('PointFinderDateSearchField')) {


	trait PointFinderDateSearchField
	{
	  
	    public function pointfinder_get_search_date_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom)
	    {
	       if ($showonlywidget_check == 'show') {
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-datepicker');
				

				$column_type = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_column','','0');
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
					};
					
					
				}
			} 
	    }
	}

	
}