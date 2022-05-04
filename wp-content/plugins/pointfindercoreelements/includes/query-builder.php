<?php
/**
* Pointfinder Query Builder class for search
*/
if (!class_exists('PointfinderSearchQueryBuilder')) {

	class PointfinderSearchQueryBuilder
	{
		use PointFinderOptionFunctions;
		
		private $args = array();

		function __construct($args){
			$this->args = $args;
		}

		private function PFFindKeysInSearchFieldA_ld($pfformvar){
			$setup1s_slides = PFSAIssetControl('setup1s_slides','','');

			foreach($setup1s_slides as $setup1s_slide){
				if($setup1s_slide['url'] == $pfformvar){
					return $setup1s_slide['select'];
					break;
				}

			};
		}

		public function setQueryValues($pfformvars,$location,$searchkeys){

			if(!empty($pfformvars)){
				foreach($pfformvars as $pfformvar => $pfvalue){
					
					$process = true;

					if ($location == 'search') {
						if(in_array($pfformvar, $searchkeys)){
							$process = false;
						}
					}

					if($process && !empty($pfvalue)){
						$thiskeyftype = '';
						$thiskeyftype = $this->PFFindKeysInSearchFieldA_ld($pfformvar);
						
						//Get target field & condition
						$target = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_target','','');
						$target_condition = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_target_according','','');

						switch($thiskeyftype){
							case '1':/*Select*/
								$multiple = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_multiple','','0');

								$rvalues_check = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_rvalues_check','','0');
								
								if($rvalues_check == 0){
									$pfvalue_arr = PFGetArrayValues_ld($pfvalue);
									$fieldtaxname = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_posttax','','');
									
									if (is_array($pfvalue_arr)) {
										if (isset($pfvalue_arr[0])) {
											if (empty($pfvalue_arr[0])) {
												$pfvalue_arr = array();
											}
										}
									}

									$this->args['tax_query'][]=array(
										'taxonomy' => $fieldtaxname,
										'field' => 'id',
										'terms' => $pfvalue_arr,
										'operator' => 'IN'
									);
								}else{
									
									$target_r = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_rvalues_target','','');
									if (empty($target_r)) {
										$target_r = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_rvalues_target_target','','');
									}
									$target_condition_r = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_rvalues_target_according','','');
									

									if (is_array($pfvalue)) {
										if ($target_condition_r == '=') {
											$compare_x = 'IN';
										}else{
											$compare_x = $target_condition_r;
										}
										if(is_numeric($pfvalue)){
											$pfcomptype = 'NUMERIC';
										}else{
											$pfcomptype = 'CHAR';
										}
									}else{
										if(is_numeric($pfvalue)){
											$pfcomptype = 'NUMERIC';
										}else{
											$pfcomptype = 'CHAR';
										}

										if (strpos($pfvalue, ",") != 0) {
											$pfvalue = pfstring2BasicArray($pfvalue);
											if ($target_condition_r == '=') {
												$compare_x = 'IN';
											}else{
												$compare_x = $target_condition_r;
											}
										}else{
											$compare_x = $target_condition_r;
										}
									}
									if (!empty($pfvalue)) {
										$this->args['meta_query'][] = array(
											'key' => 'webbupointfinder_item_'.$target_r,
											'value' => $pfvalue,
											'compare' => $compare_x,
											'type' => $pfcomptype
										);
									}
								}
								
								break;
								
							case '2':/*Slider*/
								$slidertype = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_type','','');
								$pfcomptype = 'NUMERIC';
								
								if($slidertype == 'range'){ 
								$pfvalue = trim($pfvalue,"\0");
									$pfvalue_exp = explode(',',$pfvalue);
																
									$this->args['meta_query'][] = array(
										'key' => 'webbupointfinder_item_'.$target,
										'value' => array($pfvalue_exp[0],$pfvalue_exp[1]),
										'compare' => 'BETWEEN',
										'type' => $pfcomptype
									);
								}else{
									$this->args['meta_query'][] = array(
										'key' => 'webbupointfinder_item_'.$target,
										'value' => $pfvalue,
										'compare' => $target_condition,
										'type' => $pfcomptype
									);
								}
								
								
								break;
								
							case '4':/*Text*/

						  		$target = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_target_target','','');
						  		
								switch ($target) {
									case 'search_all':
											/* Get field Settings */
											$pf_searchall_title = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_searchall_title','','0');
											$pf_searchall_desc = $this->PFSFIssetControl('setupsearchfields_'.$pfformvar.'_searchall_content','','0');
											

											if (!isset($pfformvars[$pfformvar.'_sel']) && !isset($pfformvars[$pfformvar.'_val'])) {
												if ($pf_searchall_title == 1 && !($pf_searchall_title == 1 && $pf_searchall_desc == 1)) {
													$this->args['search_prod_title'] = html_entity_decode($pfvalue);
												}
												if ($pf_searchall_desc == 1 && !($pf_searchall_title == 1 && $pf_searchall_desc == 1)){
													$this->args['search_prod_desc'] = html_entity_decode($pfvalue);
												}
												if ($pf_searchall_title == 1 && $pf_searchall_desc == 1) {
													$this->args['search_prod_desc_title'] = html_entity_decode($pfvalue);
												}
											}
										
											
											if (isset($pfformvars[$pfformvar.'_sel']) && isset($pfformvars[$pfformvar.'_val'])) {
												if (in_array($pfformvars[$pfformvar.'_sel'], array('pointfinderltypes','pointfinderitypes','pointfinderconditions','pointfinderlocations','pointfinderfeatures','post_tags'))) {
													if ($pfformvars[$pfformvar.'_sel'] == 'post_tags') {
														$this->args['tax_query'][] = array(
															'taxonomy' => 'post_tag',
															'field' => 'ID',
															'terms' => $pfformvars[$pfformvar.'_val'],
															'operator' => 'IN'
														);
													}else{
														$this->args['tax_query'][] = array(
															'taxonomy' => $pfformvars[$pfformvar.'_sel'],
															'field' => 'ID',
															'terms' => $pfformvars[$pfformvar.'_val'],
															'operator' => 'IN'
														);
													}
												}elseif ($pfformvars[$pfformvar.'_sel'] == 'listings') {
													$this->args['p'] = $pfformvars[$pfformvar.'_val'];
												}else{
													if ($pf_searchall_title == 1 && !($pf_searchall_title == 1 && $pf_searchall_desc == 1)) {
														$this->args['search_prod_title'] = html_entity_decode($pfvalue);
													}
													if ($pf_searchall_desc == 1 && !($pf_searchall_title == 1 && $pf_searchall_desc == 1)){
														$this->args['search_prod_desc'] = html_entity_decode($pfvalue);
													}
													if ($pf_searchall_title == 1 && $pf_searchall_desc == 1) {
														$this->args['search_prod_desc_title'] = html_entity_decode($pfvalue);
													}
												}
											}
											
										break;
									case 'title':
											$this->args['search_prod_title'] = html_entity_decode($pfvalue);
										break;

									case 'description':
											$this->args['search_prod_desc'] = html_entity_decode($pfvalue);
										break;

									case 'title_description':
											$this->args['search_prod_desc_title'] = html_entity_decode($pfvalue);
										break;

									case 'address':
											$pfcomptype = 'CHAR';
											$this->args['meta_query'][] = array(
												'key' => 'webbupointfinder_items_address',
												'value' => $pfvalue,
												'compare' => 'LIKE',
												'type' => $pfcomptype
											);
										break;

									case 'google':

										$this->args['googlekeyword'] = $pfvalue;
										if (isset($pfformvars['pointfinder_areatype'])) {
											$this->args['areatype'] = $pfformvars['pointfinder_areatype'];
										}
										break;
									case 'post_tags':
									case 'pointfinderltypes':
									case 'pointfinderitypes':
									case 'pointfinderlocations':
									case 'pointfinderfeatures':
									case 'pointfinderconditions':
										if ($target == 'post_tags') {
											$this->args['tag'] = "".str_replace(' ', '-', strtolower($pfvalue))."";
										}else{
											$this->args['tax_query'][] = array(
												'taxonomy' => $target,
												'field' => 'name',
												'terms' => $pfvalue,
												'operator' => 'IN'
											);
										}
										break;
									case 'listingid':
										$this->args['p'] = $pfvalue;
										break;
									default:
											$pfcomptype = 'CHAR';
											$this->args['meta_query'][] = array(
												'key' => 'webbupointfinder_item_'.$target,
												'value' => $pfvalue,
												'compare' => 'LIKE',
												'type' => $pfcomptype
											);
										break;
								}


								break;

							case '5':/*Date*/
								$pfcomptype = 'NUMERIC';

								$setup4_membersettings_dateformat = PFSAIssetControl('setup4_membersettings_dateformat','','1');
								switch ($setup4_membersettings_dateformat) {
									case '1':$datetype = "d-m-Y";break;
									case '2':$datetype = "m-d-Y";break;
									case '3':$datetype = "Y-m-d";break;
									case '4':$datetype = "Y-d-m";break;
								}

								$pfvalue = date_parse_from_format($datetype, $pfvalue);

								$pfvalue = strtotime(date("Y-m-d", mktime(0, 0, 0, $pfvalue['month'], $pfvalue['day'], $pfvalue['year'])));

					     		if (!empty($pfvalue)) {
									
									$this->args['meta_query'][] = array(
										'key' => 'webbupointfinder_item_'.$target,
										'value' => intval($pfvalue),
										'compare' => "$target_condition",
										'type' => "$pfcomptype"
									);
								}

								break;

							case '6':/*checkbox*/
								
								

								if (!is_array($pfvalue)) {
									if (strpos($pfvalue, ",") != 0) {
										$pfvalue = pfstring2BasicArray($pfvalue);
									}
								}

								

								if (is_array($pfvalue)) {

									$system_cb_setup = PFSAIssetControl('system_cb_setup','',3);
									if ($system_cb_setup == 3) {

										if(is_numeric($pfvalue)){
											$pfcomptype = 'NUMERIC';
										}else{
											$pfcomptype = 'CHAR';
										}
										
										$this->args['meta_query'][] = array(
											'key' => 'webbupointfinder_item_'.$target,
											'value' => $pfvalue,
											'compare' => 'IN',
											'type' => $pfcomptype
											
										);
									}elseif ($system_cb_setup == 2) {
										$this->args['meta_query'][] = array(
											'relation' => 'AND'
										);
										foreach ($pfvalue as $pfvalue_single) {

											if(is_numeric($pfvalue_single)){
												$pfcomptype = 'NUMERIC';
											}else{
												$pfcomptype = 'CHAR';
											}

											$this->args['meta_query'][0][] = array(
												'key' => 'webbupointfinder_item_'.$target,
												'value' => $pfvalue_single,
												'compare' => '=',
												'type' => $pfcomptype
											);
										}
									}elseif ($system_cb_setup == 1) {
										$this->args['meta_query'][] = array(
											'relation' => 'OR'
										);
										foreach ($pfvalue as $pfvalue_single) {
											if(is_numeric($pfvalue_single)){
												$pfcomptype = 'NUMERIC';
											}else{
												$pfcomptype = 'CHAR';
											}

											$this->args['meta_query'][0][] = array(
												'key' => 'webbupointfinder_item_'.$target,
												'value' => $pfvalue_single,
												'compare' => '=',
												'type' => $pfcomptype
											);
										}
										
									}

									
								}else{
									if(is_numeric($pfvalue)){
										$pfcomptype = 'NUMERIC';
									}else{
										$pfcomptype = 'CHAR';
									}

									$this->args['meta_query'][] = array(
										'key' => 'webbupointfinder_item_'.$target,
										'value' => $pfvalue,
										'compare' => '=',
										'type' => $pfcomptype
										
									);
								}
								
								
								break;

							case '7':/*Numeric Field*/
								
								$pfvalue = str_replace(",","",$pfvalue);
								$pfvalue = str_replace(".","",$pfvalue);

								$this->args['meta_query'][] = array(
									'key' => 'webbupointfinder_item_'.$target,
									'value' => (int)$pfvalue,
									'compare' => $target_condition,
									'type' => 'NUMERIC'
								);
								break;
						}
					}	
				}
			}

		}


		public function getQuery(){
			
			return $this->args;
		}
	}

}