<?php
/**********************************************************************************************************************************
*
* Custom Search Fields Retrieve Value Class
* This class prepared for help to create auto config file.
* Author: Webbu
*
***********************************************************************************************************************************/
if ( ! class_exists( 'PF_SF_Val' ) ){
	class PF_SF_Val{

		use PointFinderOptionFunctions;
		use PointFinderCommonFunctions;
		use PointFinderWPMLFunctions;
		use PointFinderFieldHelperFunctions;
		use PointFinderTextSearchField;
		use PointFinderDateSearchField;
		use PointFinderSelectSearchField;
		use PointFinderSliderSearchField;
		use PointFinderCheckboxSearchField;
		use PointFinderNumericSearchField;
		
		public $FieldOutput;
		public $PFHalf = 1;
		public $ScriptOutput;
		public $ScriptOutputDocReady;
		public $VSORules;
		public $VSOMessages;
		public $ListingTypeField;
		public $LocationField;
		public $fieldcount = 0;
		public $minifieldcount = 0;


		public function __construct(){}
		
		public function GetValue($title,$slug,$ftype,$widget=0,$pfgetdata=array(),$hormode=0,$minisearch=0){
			global $pfsearchfields_options;
			
			$this->fieldcount++;
			
			$showonlywidget_check = $this->ShowOnlyWidgetCheck($widget,$slug,$minisearch);

			if (($minisearch == 1 || $hormode == 1) && $showonlywidget_check == 'show' ) {
				$this->minifieldcount++;
			}

			if ($this->minifieldcount >= 6) {
				$showonlywidget_check = 'hide';
			}

			$lang_custom = '';

			
			$lang_custom = $this->PF_current_language();

			switch($ftype){
				case '1':
				/* Select Box */
					$this->pointfinder_get_search_select_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;
				
				case '2':
				/* Slider Field */
					$this->pointfinder_get_search_slider_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;
				
				case '4': /* Text Field */
					$this->pointfinder_get_search_text_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;

				case '5':
				/* Date Field */
					$this->pointfinder_get_search_date_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;

				case '6':
				/* check Box */
					$this->pointfinder_get_search_checkbox_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;

				case '7':
				/* Numeric Field */
					wp_enqueue_script('jquery-ui-spinner');
					wp_enqueue_style('pftheme-spinner');
					$this->pointfinder_get_search_numeric_field($title,$slug,$widget,$pfgetdata,$hormode,$minisearch,$showonlywidget_check,$lang_custom);
					break;
			}
					
					
		}

				
	}
}
?>