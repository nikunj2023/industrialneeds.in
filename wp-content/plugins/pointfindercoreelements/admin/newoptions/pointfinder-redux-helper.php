<?php

if (!class_exists('PointFinderNewOptionsHelper')) {
	class PointFinderNewOptionsHelper
	{
		use PointFinderOptionFunctions;
		use PointFinderCommonFunctions;
		use PointFinderCustomFieldsTrait;
		use PointFinderCustomSearchTrait;
		use PointFinderCustomPointsTrait;
	    
	    public function __construct(){}

	    public function get_custom_fields(){
	    	$setup1_slides = $this->PFSAIssetControl('setup1_slides','','');
			return $this->PFCheckStatusofVar('setup1_slides');
	    }

	    public function get_search_fields(){
	    	$setup1_slides = $this->PFSAIssetControl('setup1s_slides','','');
			return $this->PFCheckStatusofVar('setup1s_slides');
	    }

	    public function get_custom_fields_unfiltered(){
	    	return $this->PFSAIssetControl('setup1_slides','','');
	    }

	    public function get_search_fields_unfiltered(){
	    	return $this->PFSAIssetControl('setup1s_slides','','');
	    }
	}
}