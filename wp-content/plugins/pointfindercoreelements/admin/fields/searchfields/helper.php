<?php


trait PointFinderFieldHelperFunctions
{
    public function PriceFieldCheck($slug){
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
	
	public function SizeFieldCheck($slug){
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
	
	public function CheckItemsParent($slug){

		$parentitem = $this->PFCFIssetControl('setupcustomfields_'.$slug.'_parent','','');

		if(!empty($parentitem)){
			
			if(class_exists('SitePress')) {
				if (is_array($parentitem)) {
					foreach ($parentitem as $key => $value) {
						$parentitem[$key] = apply_filters('wpml_object_id',$value,'pointfinderltypes',true,$this->PF_current_language());
					}
				}else{
					$parentitem = apply_filters('wpml_object_id',$parentitem,'pointfinderltypes',true,$this->PF_current_language());
				}
				return $parentitem;
				
			} else {
				return $parentitem;
			}
		}else{
			return 'none';
		}
	}


	public function ShowOnlyWidgetCheck($widget,$slug,$minisearch){
		$showonlywidget_check = 'show';
		
		$showonlywidget = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_showonlywidget','','0');
		$minisearchadm = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_minisearch','','0');
		$minisearchso = $this->PFSFIssetControl('setupsearchfields_'.$slug.'_minisearchso','','0');
		
		if ($showonlywidget == 0 && $widget == 0) {
			$showonlywidget_check = 'show';
		}elseif ($showonlywidget == 1 && $widget == 0) {
			$showonlywidget_check = 'hide';
		}else{
			$showonlywidget_check = 'show';
		}

		if ($minisearch == 1 && $minisearchadm == 0) {
			$showonlywidget_check = 'hide';
		}elseif ($minisearch == 0 && $minisearchso == 1) {
			$showonlywidget_check = 'hide';
		}

		return $showonlywidget_check;
	}
}