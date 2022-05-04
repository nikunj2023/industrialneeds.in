<?php
namespace PointFinderElementorSYS\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use PointFinderElementorSYS\Helper;
use PointFinderOptionFunctions;
use PointFinderCommonFunctions;
use PointFinderWPMLFunctions;
use PointFinderReviewFunctions;
use PointFinderCommonELFunctions;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class PointFinder_Slider extends Widget_Base {

	use PointFinderOptionFunctions;
	use PointFinderCommonFunctions;
	use PointFinderWPMLFunctions;
	use PointFinderReviewFunctions;
	use PointFinderCommonELFunctions;


	public function show_in_panel() { return true; }

	public function get_keywords() { return [ 'pointfinder', 'slide','slider','listing slider' ]; }

	public function get_name() { return 'pointfinderslider'; }

	public function get_title() { return esc_html__( 'PF Listing Slider', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-slides'; }

	public function get_categories() { return [ 'pointfinder_elements' ]; }


	public function get_script_depends() {
	    return ['jquery','owlcarousel','pointfinder-elementor-slider'];
	}

	public function get_style_depends() {
	  $st8_animate = $this->PFASSIssetControl('st8_animate','','1');
	  if ($st8_animate == 1) {
	  	return ['animate-css'];
	  }
      
    }

	protected function register_controls() {


		$this->start_controls_section(
			'slider_general',
			[
				'label' => esc_html__("PF Listing Slider", 'pointfindercoreelements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'orderby',
				[
					'label' => esc_html__("Order By", "pointfindercoreelements"),
					'type' => Controls_Manager::SELECT,
					'default' => 'title',
					'render_type' => 'ui',
					'options' => [
						'title_az'  => esc_html__('A-Z','pointfindercoreelements'),
						'title_az' => esc_html__('Z-A','pointfindercoreelements'),
						'date_az' => esc_html__('Newest','pointfindercoreelements'),
						'date_za' => esc_html__('Oldest','pointfindercoreelements'),
						'rand' => esc_html__('Random', 'pointfindercoreelements'),
						'nearby' => esc_html__('Nearby','pointfindercoreelements'),
						'mviewed' => esc_html__('Most Viewed','pointfindercoreelements'),
						'reviewcount_az' => esc_html__('Highest Rated','pointfindercoreelements'),
						'reviewcount_za' => esc_html__('Lowest Rated','pointfindercoreelements')
					]
				]
			);
			
			$this->add_control(
				'count',
				[
					'label' => esc_html__("Slide count", "pointfindercoreelements"),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 1000,
					'step' => 1,
					'default' => 5
				]
			);
			$this->add_control(
				'interval',
				[
					'label' => esc_html__("Slider speed (Sec.)", "pointfindercoreelements"),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 50,
					'step' => 1,
					'default' => 5
				]
			);
			$this->add_control(
				'mode',
				[
					'label' => esc_html__("Slider Effect", "pointfindercoreelements"),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeUp',
					'options' => [
						'fade'  => esc_html__("Fade", "pointfindercoreelements"),
						'bounce' => esc_html__("Bounce", "pointfindercoreelements"),
						'slide' => esc_html__("Slide", "pointfindercoreelements"),
						'zoom' => esc_html__("Zoom", "pointfindercoreelements"),
						'flip' => esc_html__("Flip", "pointfindercoreelements"),
						'lightspeed' => esc_html__("Light Speed", "pointfindercoreelements")
					]
				]
			);


			$this->add_control(
				'autoplay',
				[
					'label' => esc_html__( 'Auto Play', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);
			$this->add_control(
				'autoheight',
				[
					'label' => esc_html__( 'Auto Height', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => '',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'featureditems',
				[
					'label' => esc_html__( 'Show Only Featured Listings', 'pointfindercoreelements' ),
					"description" => esc_html__("Enables featured items and hide another items on query.", "pointfindercoreelements"),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => '',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'descbox',
				[
					'label' => esc_html__( 'Description Box', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);
			
		$this->end_controls_section();


		$this->start_controls_section(
			'gridview_filters',
			[
				'label' => esc_html__( 'Filters', 'pointfindercoreelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

			$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
	        $setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
	        $setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');
	        $setup3_pt14_check = $this->PFSAIssetControl('setup3_pt14_check','','0');

		 	$setup3_pointposttype_pt7 = $this->PFSAIssetControl('setup3_pointposttype_pt7','','Listing Types');
			$this->add_control(
				'listingtype',
				[
					'label' => $setup3_pointposttype_pt7,
					'label_block' => true,
					'type' => 'mxselect2',
					'multiple' => true,
					'options' => [],
					'default' => '',
					'render_type' => 'template',
					'separator' => 'none'
				]
			);

			if($setup3_pointposttype_pt4_check == 1){
				$setup3_pointposttype_pt4 = $this->PFSAIssetControl('setup3_pointposttype_pt4','','Item Types');
				$this->add_control(
					'itemtype',
					[
						'label' => $setup3_pointposttype_pt4,
						'label_block' => true,
						'type' => 'mxselect2',
						'multiple' => true,
						'options' => [],
						'default' => '',
						'render_type' => 'template',
						'separator' => 'none'
					]
				);
			}

			if($setup3_pointposttype_pt5_check == 1){
				$setup3_pointposttype_pt5 = $this->PFSAIssetControl('setup3_pointposttype_pt5','','Locations');
				$this->add_control(
					'locationtype',
					[
						'label' => $setup3_pointposttype_pt5,
						'label_block' => true,
						'type' => 'mxselect2',
						'multiple' => true,
						'options' => [],
						'default' => '',
						'render_type' => 'template',
						'separator' => 'none'
					]
				);
			}

			if($setup3_pointposttype_pt6_check == 1){
				$setup3_pointposttype_pt6 = $this->PFSAIssetControl('setup3_pointposttype_pt6','','Features');
				$this->add_control(
					'features',
					[
						'label' => $setup3_pointposttype_pt6,
						'label_block' => true,
						'type' => 'mxselect2',
						'multiple' => true,
						'options' => [],
						'default' => '',
						'render_type' => 'template',
						'separator' => 'none'
					]
				);
			}


			if($setup3_pt14_check == 1){
				$setup3_pt14 = $this->PFSAIssetControl('setup3_pt14','','Conditions');
				$this->add_control(
					'conditions',
					[
						'label' => $setup3_pt14,
						'label_block' => true,
						'type' => 'mxselect2',
						'multiple' => true,
						'options' => [],
						'default' => '',
						'render_type' => 'template',
						'separator' => 'none'
					]
				);
			}


			$this->add_control(
				'pf_posts_in',
				[
					'label' => esc_html__( 'Include: Listing IDs', 'pointfindercoreelements' ),
					'label_block' => true,
					'description' => esc_html__( 'Fill this field with listing ID numbers separated by commas (,) to retrieve only that listings. Ex: 171,172,173 (Optional)', 'pointfindercoreelements' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
					'render_type' => 'template',
					'separator' => 'none'
				]
			);

		$this->end_controls_section();

	}

	private function PF_generate_random_string_ig($name_length = 12) {
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($alpha_numeric), 0, $name_length);
	}

	private function PFGetArrayValues_ld($pfvalue){
		if(!is_array($pfvalue)){
			$pfvalue_arr = array();
			if(strpos($pfvalue,',')){
				$newpfvalues = explode(',',$pfvalue);
				foreach($newpfvalues as $newpfvalue){
					array_push($pfvalue_arr,$newpfvalue);
				}
			}else{
				array_push($pfvalue_arr,$pfvalue);
			}
			return $pfvalue_arr;
		}else{
			return $pfvalue;
		}
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		
		extract(
			array(
				'listingtype' => isset($settings['listingtype'])?$settings['listingtype']:'',
				'itemtype' => isset($settings['itemtype'])?$settings['itemtype']:'',
				'conditions' => isset($settings['conditions'])?$settings['conditions']:'',
				'locationtype' => isset($settings['locationtype'])?$settings['locationtype']:'',
				'features' => isset($settings['features'])?$settings['features']:'',
				'posts_in' => isset($settings['pf_posts_in'])?$settings['pf_posts_in']:'',
				'orderby' => isset($settings['orderby'])?$settings['orderby']:'date_za',
				'count' => isset($settings['count'])?$settings['count']:5,
				'cols' => isset($settings['cols'])?$settings['cols']:3,
				'mode' => isset($settings['mode'])?$settings['mode']:'fade',
				'interval' => isset($settings['interval'])?$settings['interval']:5,
				'featureditems' => isset($settings['featureditems'])?$settings['featureditems']:'',
				'autoplay' => isset($settings['autoplay'])?$settings['autoplay']:'yes',
				'autoheight' => isset($settings['autoheight'])?$settings['autoheight']:'',
				'descbox'=>isset($settings['descbox'])?$settings['descbox']:'yes'
			)
		);


		$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
		$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
		$setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');

		$gridrandno_orj = $this->PF_generate_random_string_ig();
		$gridrandno = 'pf_'.$gridrandno_orj;

		$listingtype_x = $this->PFEX_extract_type_ig($listingtype);
		$itemtype_x = ($setup3_pointposttype_pt4_check == 1) ? $this->PFEX_extract_type_ig($itemtype) : '' ;
		$locationtype_x = ($setup3_pointposttype_pt5_check == 1) ? $this->PFEX_extract_type_ig($locationtype) : '' ;
		$features_x = ($setup3_pointposttype_pt6_check == 1) ? $this->PFEX_extract_type_ig($features) : '' ;


			/* Get admin values */
			$setup3_pointposttype_pt1 = $this->PFSAIssetControl('setup3_pointposttype_pt1','','pfitemfinder');


			//Container & show check
			$pfcontainerdiv = 'pflistgridview'.$gridrandno_orj.'';
			$pfcontainershow = 'pflistgridviewshow'.$gridrandno_orj.'';

			$orderby = sanitize_text_field($orderby);
			$orderby_original = $orderby;
			$sortby_function_result = $this->pointfinder_sortby_selector($orderby);
			
			$pfg_orderby = $sortby_function_result[0];
			$pfg_order = $sortby_function_result[1];
			//Defaults
			$pfgetdata = array();
			$pfgetdata['orderby'] = $pfg_orderby;
			$pfgetdata['sortby'] = $pfg_order;
			$pfgetdata['count'] = $count;
			$pfgetdata['posts_in'] = $posts_in;
			$pfgetdata['mode'] = $mode;
			$pfgetdata['interval'] = $interval;
			$pfgetdata['listingtype'] = $listingtype_x;
			$pfgetdata['itemtype'] = $itemtype_x;
			$pfgetdata['locationtype'] = $locationtype_x;
			$pfgetdata['features'] = $features_x;
			$pfgetdata['featureditems'] = $featureditems;

			if($pfgetdata['count'] == 'All' || $pfgetdata['count'] == 'all' || $pfgetdata['count'] == 'ALL'){$pfgetdata['count'] = -1;}

			$args = array( 'post_type' => $setup3_pointposttype_pt1, 'post_status' => 'publish');
			if($pfgetdata['posts_in']!=''){
				$args['post__in'] = pfstring2BasicArray($pfgetdata['posts_in']);

			}

			$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
			$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
			$setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');



			if(is_array($pfgetdata)){

				$args['tax_query'] = array();

				if($pfgetdata['listingtype'] != ''){
					$pfvalue_arr_lt = $this->PFGetArrayValues_ld($pfgetdata['listingtype']);

					$fieldtaxname_lt = 'pointfinderltypes';

					if(count($args['tax_query']) > 0){
						$args['tax_query'][(count($args['tax_query'])-1)]=
						array(
								'taxonomy' => $fieldtaxname_lt,
								'field' => 'id',
								'terms' => $pfvalue_arr_lt,
								'operator' => 'IN'
						);
					}else{
						$args['tax_query']=
						array(
							'relation' => 'AND',
							array(
								'taxonomy' => $fieldtaxname_lt,
								'field' => 'id',
								'terms' => $pfvalue_arr_lt,
								'operator' => 'IN'
							)
						);
					}
				}

				if($setup3_pointposttype_pt4_check == 1){
					if($pfgetdata['locationtype'] != ''){
						$pfvalue_arr_loc = $this->PFGetArrayValues_ld($pfgetdata['locationtype']);

						$fieldtaxname_loc = 'pointfinderlocations';

						if(count($args['tax_query']) > 0){
							$args['tax_query'][(count($args['tax_query'])-1)]=
							array(
									'taxonomy' => $fieldtaxname_loc,
									'field' => 'id',
									'terms' => $pfvalue_arr_loc,
									'operator' => 'IN'
							);
						}else{
							$args['tax_query']=
							array(
								'relation' => 'AND',
								array(
									'taxonomy' => $fieldtaxname_loc,
									'field' => 'id',
									'terms' => $pfvalue_arr_loc,
									'operator' => 'IN'
								)
							);
						}
					}
				}

				if($setup3_pointposttype_pt5_check == 1){
					if($pfgetdata['itemtype'] != ''){
					$pfvalue_arr_it = $this->PFGetArrayValues_ld($pfgetdata['itemtype']);

					$fieldtaxname_it = 'pointfinderitypes';

					if(count($args['tax_query']) > 0){
						$args['tax_query'][(count($args['tax_query'])-1)]=
						array(
								'taxonomy' => $fieldtaxname_it,
								'field' => 'id',
								'terms' => $pfvalue_arr_it,
								'operator' => 'IN'
						);
					}else{
						$args['tax_query']=
						array(
							'relation' => 'AND',
							array(
								'taxonomy' => $fieldtaxname_it,
								'field' => 'id',
								'terms' => $pfvalue_arr_it,
								'operator' => 'IN'
							)
						);
					}
					}
				}

				if($setup3_pointposttype_pt6_check == 1){
					if($pfgetdata['features'] != ''){
					$pfvalue_arr_fe = $this->PFGetArrayValues_ld($pfgetdata['features']);

					$fieldtaxname_fe = 'pointfinderfeatures';

					if(count($args['tax_query']) > 0){
						$args['tax_query'][(count($args['tax_query'])-1)]=
						array(
								'taxonomy' => $fieldtaxname_fe,
								'field' => 'id',
								'terms' => $pfvalue_arr_fe,
								'operator' => 'IN'
						);
					}else{
						$args['tax_query']=
						array(
							'relation' => 'AND',
							array(
								'taxonomy' => $fieldtaxname_fe,
								'field' => 'id',
								'terms' => $pfvalue_arr_fe,
								'operator' => 'IN'
							)
						);
					}
					}
				}

				/* Start: Order Filters*/
					if(!empty($pfg_orderby)){
						if ($pfg_orderby == 'ID') {$pfg_orderby = 'date';}
						
						if($pfg_orderby == 'date' || $pfg_orderby == 'title'){
							$args['orderby'][$pfg_orderby] = $pfg_order;
						}elseif($pfg_orderby == 'rand'){
							$args['orderby']['rand'] = '';
						}elseif($pfg_orderby == 'mviewed'){
							$args['orderby']['query_key'] = 'DESC';
							$args['meta_query']['query_key'] = array('key' => 'webbupointfinder_page_itemvisitcount','type'=>'NUMERIC');
						}elseif($pfg_orderby == 'mreviewed'){
							$args['orderby']['query_key'] = 'DESC';
							$args['meta_query']['query_key'] = array('key' => 'webbupointfinder_page_itemvisitcount','type'=>'NUMERIC');
						}elseif($pfg_orderby == 'reviewcount'){
							if (class_exists('Pointfinderspecialreview_Public')) {
							 	$args['orderby']['query_review'] = $pfg_order;
								$args['meta_query']['query_review'] = array('key' => 'pfreviewx_totalperitem','type'=>'DECIMAL(2,1)');
							 }else{
							 	$args['orderby']['query_reviewor'] = $pfg_order;
								$args['meta_query']['query_review'] = array(
									'relation' => 'OR',
									'query_reviewnx'=>array(
										'key' => 'webbupointfinder_item_reviewcount',
										'compare'=>'NOT EXISTS',
										'value'=> 'completely'
									),
									'query_reviewor'=>array(
										'key' => 'webbupointfinder_item_reviewcount',
										'type'=>'DECIMAL(2,1)',
									)
								);
							 }
						}elseif($pfg_orderby == 'distance'){
							if (!empty($pflatp) && !empty($pflngp)) {
								$args['orderby']['distance'] = $pfg_order;
							}
						}else{
							$pfg_orderby_exp = explode('|',$pfg_orderby);

							$pfg_order = 'DESC';

		                    if (count($pfg_orderby_exp) == 2) {
		                        $pfg_orderby = $pfg_orderby_exp[0];
		                        $pfg_order = $pfg_orderby_exp[1];
		                    }

							if($this->PFIF_CheckFieldisNumeric_ld($pfg_orderby) == false){
								$args['orderby']['query_key']= $pfg_order;
								$args['meta_query']['query_key'] = array('key' => 'webbupointfinder_item_'.$pfg_orderby,'type'=>'CHAR');
							}else{
								$args['orderby']['query_key']= $pfg_order;
								$args['meta_query']['query_key'] = array('key' => 'webbupointfinder_item_'.$pfg_orderby,'type'=>'NUMERIC');
							}
						}
					}
				/* End: Order Filters*/
				$args['posts_per_page'] = $pfgetdata['count'];

				//Featured items filter
				if($pfgetdata['featureditems'] == 'yes'){

					$args['meta_query'] = array();

					if(count($args['meta_query']) > 0){
						$args['meta_query'][(count($args['meta_query'])-1)] = array(
							'key' => 'webbupointfinder_item_featuredmarker',
							'value' => 1,
							'compare' => '=',
							'type' => 'NUMERIC'
							);

					}else{
							$args['meta_query'] = array(
								'relation' => 'AND',
								array(
								'key' => 'webbupointfinder_item_featuredmarker',
								'value' => 1,
								'compare' => '=',
								'type' => 'NUMERIC'
							)
						);

					}
				}

			}



			//Create html codes
			echo "<div class='pfitemslider is-container'
			data-number='".$gridrandno_orj."'
			data-descbox='".$descbox."' 
			data-autoplay='".$autoplay."' 
			data-interval='".$interval."' 
			data-mode='".$mode."' 
			data-autoheight='".$autoheight."' 
			>";
			echo '<ul id="'.$gridrandno_orj.'" class="pf-item-slider owl-carousel owl-theme">';


			$setup22_searchresults_hide_lt  = $this->PFSAIssetControl('setup22_searchresults_hide_lt','','0');

			$loop = new WP_Query( $args );
				
				if($loop->post_count > 0){

					while ( $loop->have_posts() ) : $loop->the_post();

					$post_id = get_the_id();


							$ItemDetailArr = array();
							if (class_exists('SitePress')) {
								$pflang = $this->PF_current_language();
								if ($pflang) {
									$pfitemid = $this->PFLangCategoryID_ld($post_id,$pflang,$setup3_pointposttype_pt1);
								}else{
									$pfitemid = $post_id;
								}
							}else{
								$pfitemid = $post_id;
							}
							


							$featured_image = '';
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $pfitemid ), 'full' );
							$ItemDetailArr['featured_image_org'] = $featured_image[0];
							$ItemDetailArr['featured_image'] = get_post_meta($pfitemid,'webbupointfinder_item_sliderimage',true);




							if(is_array($ItemDetailArr['featured_image'])){
								if(count($ItemDetailArr['featured_image'])>0 && !empty($ItemDetailArr['featured_image']['url'])){
									$ItemDetailArr['featured_image'] = $ItemDetailArr['featured_image']['url'];
								}else{
									$ItemDetailArr['featured_image'] = $ItemDetailArr['featured_image_org'];
								}
							}else{
								$ItemDetailArr['featured_image'] = $ItemDetailArr['featured_image_org'];
							}
							$ItemDetailArr['if_title'] = get_the_title($pfitemid);
							$ItemDetailArr['if_excerpt'] = get_the_excerpt();
							$ItemDetailArr['if_link'] = get_permalink($pfitemid);
							$ItemDetailArr['if_address'] = esc_html(get_post_meta( $pfitemid, 'webbupointfinder_items_address', true ));

							$output_data = $this->PFIF_DetailText_ld($pfitemid,$setup22_searchresults_hide_lt);
							if (is_array($output_data)) {
								if (!empty($output_data['ltypes'])) {
									$output_data_ltypes = $output_data['ltypes'];
								} else {
									$output_data_ltypes = '';
								}
								if (!empty($output_data['content'])) {
									$output_data_content = $output_data['content'];
								} else {
									$output_data_content = '';
								}
								if (!empty($output_data['priceval'])) {
									$output_data_priceval = $output_data['priceval'];
								} else {
									$output_data_priceval = '';
								}
							} else {
								$output_data_priceval = '';
								$output_data_content = '';
								$output_data_ltypes = '';
							}


							echo '<li class="pf-item-slider-items">
							<img src="'.$ItemDetailArr['featured_image'].'" alt="" data-no-lazy="1" class="owl-lazy">';
							if($descbox == 'yes'){
							echo'
							<div class="pf-item-slider-description-container">
							<div class="pf-item-slider-description">
								<div class="pf-item-slider-title"><a href="'.$ItemDetailArr['if_link'].'">'.$ItemDetailArr['if_title'].'</a></div>
								<div class="pf-item-slider-address"><a href="'.$ItemDetailArr['if_link'].'">'.$ItemDetailArr['if_address'].'</a></div>
								<div class="pf-item-slider-excerpt"><p>'.wp_trim_words( $ItemDetailArr['if_excerpt'], 23, ' ...' ).'</p></div>
							</div>
							<div class="pf-item-slider-ex-container">';
							if(!empty($output_data_priceval)){
								echo'<div class="pf-item-slider-price clearfix">'.$output_data_priceval.'</div>';
							}
							echo'<div class="pf-item-slider-golink clearfix"><a href="'.get_the_permalink().'">'.esc_html__('Details','pointfindercoreelements').'</a></div>';


							echo'
							</div>';
							}
							echo'
							</li>';


					endwhile;
					wp_reset_postdata();
				}
				echo '</ul>';

	            
				echo "</div> ";


	}


}
