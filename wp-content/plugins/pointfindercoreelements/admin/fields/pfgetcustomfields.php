<?php
/**********************************************************************************************************************************
*
* Custom Detail Fields Retrieve Value Class
* This class prepared for help to create auto config file.
* Author: Webbu
*
***********************************************************************************************************************************/
if ( ! class_exists( 'PF_CF_Val' ) ){
	class PF_CF_Val{
		
		use PointFinderOptionFunctions;
		use PointFinderCommonFunctions;
		use PointFinderWPMLFunctions;

		public $FieldOutput;

		private $PFCFOptions;

		private $PFCLang;
		
		public function __construct($post_id){

			if (class_exists('SitePress')) {
				$pfcustomfields_options = get_option('pfcustomfields_options');
			}else{
				global $pfcustomfields_options;
			}
			
			$this->PFCFOptions = $pfcustomfields_options;
			$this->PFCLang = $this->PF_current_language();

		}

		function ShortNameCheck($title,$slug){
			
			$ShortName = isset($this->PFCFOptions['setupcustomfields_'.$slug.'_shortname'])?$this->PFCFOptions['setupcustomfields_'.$slug.'_shortname']:'';
			
			if(!empty($ShortName)){
				
				$output = $ShortName;
				
			}else{
				$output = isset($this->PFCFOptions['setupcustomfields_'.$slug.'_frontendname'])?$this->PFCFOptions['setupcustomfields_'.$slug.'_frontendname']:'';

				if (empty($output)) {
					$output = $title;
				}
			}
			
			return $output;

		}
		
		function PriceValueCheck($slug,$FieldValue,$FieldTitle,$pfsys=NULL,$prep=NULL){
			
			$control = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_currency_check']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_currency_check']:0;
			if($control == 1){

				$CFPrefix = $this->PFCFOptions['setupcustomfields_'.$slug.'_currency_prefix'];
				$CFSuffix_org = $this->PFCFOptions['setupcustomfields_'.$slug.'_currency_suffix'];
				$CFDecima = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_currency_decima']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_currency_decima']:0;
				$CFDecimp = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_currency_decimp']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_currency_decimp']:'.';
				if ($CFDecimp == '.') {
					$CFDecimt = ',';
				}else{
					$CFDecimt = '.';
				}
				
				if (!empty($CFSuffix_org)) {
					$CFSuffix = '<span class="pf-price-suffix">'.$CFSuffix_org.'</span>';
				}else{
					$CFSuffix = '';
				}
				/*Check field value empty? if yes write 0*/
				if($FieldValue == ''){ $FieldValue = 0;};

				if (is_numeric($FieldValue)) {
					$formatted_value = $CFPrefix .''. number_format($FieldValue, $CFDecima, $CFDecimp, $CFDecimt) . $CFSuffix;
				}else{
					$formatted_value = $CFPrefix .''.$FieldValue.''. $CFSuffix;
				}
				

				$st9_currency_status = $this->PFASSIssetControl('st9_currency_status','',0);

				if (isset($_COOKIE["pointfinder_c_code"]) && !empty($st9_currency_status)) {

					$currencyrates = get_option( 'pointfinder_currency_rates');
					$st9_currency_from = $this->PFASSIssetControl('st9_currency_from','','');

					if (isset($currencyrates[$st9_currency_from.$_COOKIE["pointfinder_c_code"]])) {
						$FieldValue = $FieldValue * $currencyrates[$st9_currency_from.$_COOKIE["pointfinder_c_code"]];
					}
					
					$locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);

					if (empty($locale)) {
						$locale = 'en_US';
					}
						$st9_currency_decimals = $this->PFASSIssetControl('st9_currency_decimals','',0);
						
						$fmt = new NumberFormatter( $locale, NumberFormatter::CURRENCY );
						$fmt->setTextAttribute(NumberFormatter::CURRENCY_CODE, $_COOKIE["pointfinder_c_code"]);
						$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, $st9_currency_decimals);

						$FieldValue = $fmt->formatCurrency($FieldValue, $_COOKIE["pointfinder_c_code"]);

						$formatted_value = $FieldValue;

						if (strlen($CFSuffix_org) > 3) {
							$formatted_value = $formatted_value .''.$CFSuffix_org;
						}
				}

				if ($prep == true) {
					if($pfsys == NULL){
						return '<li class="pf-price">'.$formatted_value.'</li>';
					}elseif($pfsys == 1){
						return ''.$FieldTitle .'<span class="pf-price">'.$formatted_value.'</span></div>';
					}elseif($pfsys == 2){
						return ''.$FieldTitle.'<span class="pfdetail-ftext pf-pricetext">'.$formatted_value.'</span></div>';
					}
				}else{
					if($pfsys == NULL){
						return '<li class="pf-price">'.$formatted_value.'</li>';
					}elseif($pfsys == 1){
						return '<div class="pflistingitem-subelement pf-price">'.$formatted_value.'</div>';
					}elseif($pfsys == 2){
						return ''.$FieldTitle.'<span class="pfdetail-ftext pf-pricetext">'.$formatted_value.'</span></div>';
					}
				}
			}
		
		}
		
		function SizeValueCheck($slug,$FieldValue,$FieldTitle,$pfsys=NULL){
			
			$control = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_size_check']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_size_check']:0;

			if($control == 1){
				
				$CFPrefix = $this->PFCFOptions['setupcustomfields_'.$slug.'_size_prefix'];
				$CFSuffix = $this->PFCFOptions['setupcustomfields_'.$slug.'_size_suffix'];
				$CFDecima = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_size_decima']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_size_decima']:0;
				$CFDecimp = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_size_decimp']))?$this->PFCFOptions['setupcustomfields_'.$slug.'_size_decimp']:'';
				if ($CFDecimp == '.') {
					$CFDecimt = ',';
				}else{
					$CFDecimt = '.';
				}
				
				//Check field value empty? if yes write 0
				if($FieldValue == ''){ $FieldValue = 0;};
				
				if($pfsys == NULL){
					return '<li>'.$FieldTitle . $CFPrefix .' '. number_format($FieldValue, $CFDecima, $CFDecimp, $CFDecimt) .' '. $CFSuffix.'<span class="pf-fieldspace"></span></li>';
				}elseif($pfsys == 1){
					return ''.$FieldTitle .'<span class="pf-ftext">'. $CFPrefix .' '. number_format($FieldValue, $CFDecima, $CFDecimp, $CFDecimt) .' '. $CFSuffix.'</span></div>';
				}elseif($pfsys == 2){
					return ''.$FieldTitle .'<span class="pfdetail-ftext">'. $CFPrefix .' '. number_format($FieldValue, $CFDecima, $CFDecimp, $CFDecimt) .' '. $CFSuffix.'</span></div>';
				}
			
			}
		
		}

		function GetValue($slug,$post_id,$ftype,$title,$pfsys=NULL,$prep=NULL){
			
			$this->FieldOutput = '';
									
			$HideTitleValue = $this->PFCFOptions['setupcustomfields_'.$slug.'_sinfowindow_hidename'];
			
			if($HideTitleValue == 1){
				if($pfsys == NULL){
					$FieldTitle = '<span class="wpfdetailtitle">'.$this->ShortNameCheck($title,$slug).':</span> ';
				}elseif($pfsys == 1){
					$FieldTitle = '<div class="pflistingitem-subelement pf-onlyitem"><span class="pf-ftitle">'.$this->ShortNameCheck($title,$slug).': </span>';
				}elseif($pfsys == 2){
					$FieldTitle = '<div class="pfdetailitem-subelement pf-onlyitem clearfix"><span class="pf-ftitle">'.$this->ShortNameCheck($title,$slug).' : </span>';
				}
			}else{
				if($pfsys == NULL){
					$FieldTitle = '';
				}elseif($pfsys == 1){
					$FieldTitle = '<div class="pflistingitem-subelement pf-onlyitem"><span class="pf-ftitle"></span>';
				}elseif($pfsys == 2){
					$FieldTitle = '<div class="pfdetailitem-subelement pf-onlyitem clearfix"><span class="pf-ftitle"></span>';
				}
			}
				
			
			/*If not have a parent field*/
			$SourceFieldValue = rwmb_meta('webbupointfinder_item_'.$slug, '',$post_id);
			
			
			/* Select box get value */
			if($ftype == 8 || $ftype == 7 ){
				
				$SourceFieldArray = $this->pfstring2KeyedArray($this->PFCFOptions['setupcustomfields_'.$slug.'_rvalues']);							
				$SourceFieldValue = (isset($SourceFieldArray[$SourceFieldValue])) ? $SourceFieldArray[$SourceFieldValue] : '' ;
			
			}elseif($ftype == 14 || $ftype == 9){
				
				$SourceFieldValue = get_post_meta( $post_id, 'webbupointfinder_item_'.$slug, false );
				$SourceFieldArray = $this->pfstring2KeyedArray($this->PFCFOptions['setupcustomfields_'.$slug.'_rvalues']);
			
				
				if(count($SourceFieldValue) > 1){

					$SourceFieldValueOut = array();
					foreach($SourceFieldValue as $SourceFieldValueSingle){
						array_push($SourceFieldValueOut,$SourceFieldArray[$SourceFieldValueSingle]);
					}
					
					$SourceFieldValue = implode(", ", $SourceFieldValueOut);
					
				}else{
					$SourceFieldValue = get_post_meta( $post_id, 'webbupointfinder_item_'.$slug, true );
					$SourceFieldValue = (isset($SourceFieldArray[$SourceFieldValue])) ? $SourceFieldArray[$SourceFieldValue] : '' ;
				}

			}elseif ($ftype == 15) {
				
				$SourceFieldValue = get_post_meta( $post_id, 'webbupointfinder_item_'.$slug, true );
				if (!empty($SourceFieldValue)) {
					$SourceFieldValue = date_i18n(get_option('date_format'),$SourceFieldValue,true);
				}

			}
		
			$FieldValue = $this->PriceValueCheck($slug,$SourceFieldValue,$FieldTitle,$pfsys,$prep);

			$FieldValue .= $this->SizeValueCheck($slug,$SourceFieldValue,$FieldTitle,$pfsys);
			
							

			/*Get link option*/
			$linkoption = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_linkoption']))? $this->PFCFOptions['setupcustomfields_'.$slug.'_linkoption']: 0;
			if ($linkoption != 0) {
				$linkprefix = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_linkprefix']))? $this->PFCFOptions['setupcustomfields_'.$slug.'_linkprefix']: '';
				switch ($linkoption) {
					case 1:
						$link_addon = 'http://';$link_addon2 = 'https://';$link_target = "target='_blank'";
						break;
					case 2:
						$link_addon = 'mailto:';$link_target = "";
						break;
					case 3:
						$link_addon = 'tel:';$link_target = "";
						break;
					case 4:
						$link_addon = $linkprefix;$link_target = "";
						break;
					default:
						$link_addon = 'http://';$link_target = "target='_blank'";
						break;
				}

				$pf_httpcheck = strpos($SourceFieldValue, 'http://');
				$pf_httpscheck = strpos($SourceFieldValue, 'https://');

				$pfweblink_field = $SourceFieldValue;

				if ($pf_httpcheck === false) {
					if ($pf_httpscheck !== false && $pf_httpcheck === false) {
						$pfweblink_field = $SourceFieldValue;
					}elseif ($pf_httpscheck === false && $pf_httpcheck !== false) {
						$pfweblink_field = $SourceFieldValue;
					}elseif ($pf_httpscheck === false && $pf_httpcheck === false) {
						$pfweblink_field = $link_addon.$SourceFieldValue;
					}
				}

				
				$linktext_output = (isset($this->PFCFOptions['setupcustomfields_'.$slug.'_linktext']))? $this->PFCFOptions['setupcustomfields_'.$slug.'_linktext']: '';
				
			}else{
				switch ($linkoption) {
					case 1:
						$link_addon = 'http://';$link_addon2 = 'https://';$link_target = "target='_blank'";
						break;
					case 2:
						$link_addon = 'mailto:';$link_target = "";
						break;
					case 3:
						$link_addon = 'tel:';$link_target = "";
						break;
					case 4:
						$link_addon = $linkprefix;$link_target = "";
						break;
					default:
						$link_addon = 'http://';$link_target = "target='_blank'";
						break;
				}
				
				$pfweblink_field = $link_addon. $SourceFieldValue;
			}

			if($FieldValue == ''){
				if($pfsys == NULL){
					if ($linkoption == 0) {
						$FieldValue = '<li>'.$FieldTitle . $SourceFieldValue.'<span class="pf-fieldspace"></span></li>';
					}else{
						$linktext = (empty($linktext_output))?$SourceFieldValue:$linktext_output;
						$FieldValue = '<li>'.$FieldTitle .'<a href="'.$pfweblink_field.'" '.$link_target.'>'.$linktext.'</a><span class="pf-fieldspace"></span></li>';
					}
				}elseif($pfsys == 1){
					if ($linkoption == 0) {
						$FieldValue = ''.$FieldTitle .'<span class="pf-ftext">'. $SourceFieldValue.'</span></div> ';
					}else{
						$linktext = (empty($linktext_output))?$SourceFieldValue:$linktext_output;
						$FieldValue = ''.$FieldTitle .'<span class="pf-ftext"><a href="'.$pfweblink_field.'" '.$link_target.'>'.$linktext.'</a></span></div> ';
					}
				}elseif($pfsys == 2){
					if ($linkoption == 0) {
						$FieldValue = ''.$FieldTitle .'<span class="pfdetail-ftext">'. $SourceFieldValue.'</span></div> ';
					}else{
						$linktext = (empty($linktext_output))?$SourceFieldValue:$linktext_output;
						$FieldValue = ''.$FieldTitle .'<span class="pfdetail-ftext"><a href="'.$pfweblink_field.'" '.$link_target.'>'.$linktext.'</a></span></div> ';
					}
				}
			}

			$this->FieldOutput = $FieldValue;	
			
			if ($SourceFieldValue != '') {
				return $this->FieldOutput;
			} 
							 
		}
			
	}
}
?>