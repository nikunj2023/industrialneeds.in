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
use PointFinderGridSpecificFunctions;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class PointFinder_Carousel extends Widget_Base {

	use PointFinderOptionFunctions;
	use PointFinderCommonFunctions;
	use PointFinderWPMLFunctions;
	use PointFinderReviewFunctions;
	use PointFinderCommonELFunctions;
	use PointFinderGridSpecificFunctions;


	public function show_in_panel() { return true; }

	public function get_keywords() { return [ 'pointfinder', 'carousel', 'listing carousel' ]; }

	public function get_name() { return 'pointfindercarousel'; }

	public function get_title() { return esc_html__( 'PF Listing Carousel', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-posts-carousel'; }

	public function get_categories() { return [ 'pointfinder_elements' ]; }


	public function get_script_depends() {
	    return ['jquery','owlcarousel','pointfinder-elementor-carousel'];
	}

	public function get_style_depends() {
      return [];
    }

	protected function register_controls() {


		$this->start_controls_section(
			'lcarousel_general',
			[
				'label' => esc_html__("PF Listing Carousel", 'pointfindercoreelements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'itemboxbg',
				[
					'label' => esc_html__('Listing Card Background', 'pointfindercoreelements'),
					"description" => esc_html__("Listing card area background color of the grid listing area. Optional", 'pointfindercoreelements'),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render' => 'theme',
					/*'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search' => 'background-color: {{mini_bg_color}}!important;',
					],*/
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
				'itemlimit',
				[
					'label' => esc_html__("Listings Limit", "pointfindercoreelements"),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 50,
					'step' => 1,
					'default' => 20
				]
			);

			$this->add_control(
				'cols',
				[
					'label' => esc_html__( 'Visible Listing Amount', 'pointfindercoreelements' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 2,
					'max' => 4,
					'step' => 1,
					'default' => 4,
				]
			);
			$this->add_control(
				'autoplay',
				[
					'label' => esc_html__( 'Slider Autoplay', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$this->add_control(
				'speed',
				[
					'label' => esc_html__( 'Slider Speed (second)', 'pointfindercoreelements' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 15,
					'step' => 1,
					'default' => 5
				]
			);
			$this->add_control(
				'hide_pagination_control',
				[
					'label' => esc_html__( 'Pagination Control', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => ''
				]
			);
			$this->add_control(
				'hide_prev_next_buttons',
				[
					'label' => esc_html__( 'Prev/Next Buttons', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => ''
				]
			);
			$this->add_control(
				'zeropadding',
				[
					'label' => esc_html__( 'Zero Padding', 'pointfindercoreelements' ),
					'description' => esc_html__( 'This will disable padding between items.', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => ''
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
				'featureditemshide',
				[
					'label' => esc_html__( 'Hide Featured Listings', 'pointfindercoreelements' ),
					  "description" => esc_html__("Disable featured items and show another items on query. You can not use with Only show featured items", "pointfindercoreelements"),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => '',
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

			$this->add_control(
				'pf_posts_not_in',
				[
					'label' => esc_html__( 'Exclude: Listing IDs', 'pointfindercoreelements' ),
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
		
		$output = $title =  $onclick = $custom_links = $img_size = $custom_links_target = $images = '';
		$autoplay = $autocrop = $customsize = $hide_pagination_control =  $speed = $zeropadding ='';

		extract(
			array(
				'listingtype' => isset($settings['listingtype'])?$settings['listingtype']:'',
				'itemtype' => isset($settings['itemtype'])?$settings['itemtype']:'',
				'conditions' => isset($settings['conditions'])?$settings['conditions']:'',
				'locationtype' => isset($settings['locationtype'])?$settings['locationtype']:'',
				'features' => isset($settings['features'])?$settings['features']:'',
				'posts_in' => isset($settings['pf_posts_in'])?$settings['pf_posts_in']:'',
				'pf_posts_not_in' => isset($settings['pf_posts_not_in'])?$settings['pf_posts_not_in']:'',
				'itemboxbg' => isset($settings['itemboxbg'])?$settings['itemboxbg']:'',
				'orderby' => isset($settings['orderby'])?$settings['orderby']:'date_za',
				'speed' => isset($settings['speed'])?$settings['speed']:5,
				'hide_pagination_control' => isset($settings['hide_pagination_control'])?$settings['hide_pagination_control']:'',
				'cols' => isset($settings['cols'])?$settings['cols']:3,
				'hide_prev_next_buttons' => isset($settings['hide_prev_next_buttons'])?$settings['hide_prev_next_buttons']:'',
				'zeropadding' => isset($settings['zeropadding'])?$settings['zeropadding']:'',
				'featureditems' => isset($settings['featureditems'])?$settings['featureditems']:'',
				'featureditemshide' => isset($settings['featureditemshide'])?$settings['featureditemshide']:'',
				'autoplay' => isset($settings['autoplay'])?$settings['autoplay']:'yes',
				'itemlimit' => isset($settings['itemlimit'])?$settings['itemlimit']:20,
				'related' => 0,
			)
		);

		$gal_images = '';
		$link_start = '';
		$link_end = '';
		$el_start = '';
		$el_end = '';
		$slides_wrap_start = '';
		$slides_wrap_end = '';
		$pretty_rand = $onclick == 'link_image' ? rand() : '';


		$template_directory_uri = get_template_directory_uri();
		$general_crop2 = $this->PFSizeSIssetControl('general_crop2','',1);

		$general_retinasupport = $this->PFSAIssetControl('general_retinasupport','','0');
		if($general_retinasupport == 1){$pf_retnumber = 2;}else{$pf_retnumber = 1;}

		$myrandno = rand(1, 2147483647);
		$myrandno = md5($myrandno);
		$carousel_id = 'vc-images-carousel-'.$myrandno;

		$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
		$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
		$setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');
		$setup3_pt14_check = $this->PFSAIssetControl('setup3_pt14_check','',0);

		$gridrandno_orj = PF_generate_random_string_ig();
		$gridrandno = 'pf_'.$gridrandno_orj;

		$listingtype_x = $this->PFEX_extract_type_ig($listingtype);
		$itemtype_x = ($setup3_pointposttype_pt4_check == 1) ? $this->PFEX_extract_type_ig($itemtype) : '' ;
		$conditions_x = ($setup3_pt14_check == 1) ? $this->PFEX_extract_type_ig($conditions) : '' ;
		$locationtype_x = ($setup3_pointposttype_pt5_check == 1) ? $this->PFEX_extract_type_ig($locationtype) : '' ;
		$features_x = ($setup3_pointposttype_pt6_check == 1) ? $this->PFEX_extract_type_ig($features) : '' ;

		$wpflistdata = "<div class='pflistgridview".$gridrandno_orj."-container pflistgridviewgr-container'>";

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
		$pfgrid = '';
		$pfitemboxbg = '';		

		$pfgetdata = array();
		$pfgetdata['sortby'] = $pfg_order;
		$pfgetdata['orderby'] = $pfg_orderby;
		$pfgetdata['posts_in'] = $posts_in;

		$pfgetdata['cols'] = $cols;
		$pfgetdata['itemboxbg'] = $itemboxbg;
		$pfgetdata['listingtype'] = $listingtype_x;
		$pfgetdata['itemtype'] = $itemtype_x;
		$pfgetdata['conditions'] = $conditions_x;
		$pfgetdata['locationtype'] = $locationtype_x;
		$pfgetdata['features'] = $features_x;	
		$pfgetdata['featureditems'] = $featureditems;
		$pfgetdata['featureditemshide'] = $featureditemshide;

		if($pfgetdata['cols'] != ''){$pfgrid = 'grid'.$pfgetdata['cols'];}


		$args = array( 'post_type' => $setup3_pointposttype_pt1, 'post_status' => 'publish');
		$args['posts_per_page'] = $itemlimit;

		if($pfgetdata['posts_in']!=''){
			$args['post__in'] = pfstring2BasicArray($pfgetdata['posts_in']);
		}

		if(isset($args['meta_query']) == false || isset($args['meta_query']) == NULL){
			$args['meta_query'] = array();
		}	

		if(isset($args['tax_query']) == false || isset($args['tax_query']) == NULL){
			$args['tax_query'] = array();
		}


		if ($related == 1) {
			$the_current_post_id = get_the_id();
			if(!empty($the_current_post_id)){$args['post__not_in'] = array($the_current_post_id);}
			$agent_id = get_post_meta($the_current_post_id, "webbupointfinder_item_agents",1);

			$re_li_4 = $this->PFSAIssetControl('re_li_4','','0');
			
			//Agent Filter for Related Listings
			if(!empty($agent_id) && $re_li_4 == 1){
				$args['meta_query'][] = array(
					'key' => 'webbupointfinder_item_agents',
					'value' => $agent_id,
					'compare' => '=',
					'type' => 'NUMERIC'
				);
			}
		}


		$review_system_statuscheck = $this->PFREVSIssetControl('setup11_reviewsystem_check','','0');

		if(is_array($pfgetdata)){

			// listing type
			if($pfgetdata['listingtype'] != ''){
				$pfvalue_arr_lt = $this->PFGetArrayValues_ld($pfgetdata['listingtype']);
				$fieldtaxname_lt = 'pointfinderltypes';
				$args['tax_query'][]=array(
					'taxonomy' => $fieldtaxname_lt,
					'field' => 'id',
					'terms' => $pfvalue_arr_lt,
					'operator' => 'IN'
				);
			}


			if($setup3_pointposttype_pt5_check == 1){
				// location type
				if(!empty($pfgetdata['locationtype'])){
					$pfvalue_arr_loc = $this->PFGetArrayValues_ld($pfgetdata['locationtype']);
					$fieldtaxname_loc = 'pointfinderlocations';
					$args['tax_query'][]=array(
						'taxonomy' => $fieldtaxname_loc,
						'field' => 'id',
						'terms' => $pfvalue_arr_loc,
						'operator' => 'IN'
					);
				}
			}

			if($setup3_pointposttype_pt4_check == 1){
				// item type
				if($pfgetdata['itemtype'] != ''){
					$pfvalue_arr_it = $this->PFGetArrayValues_ld($pfgetdata['itemtype']);
					$fieldtaxname_it = 'pointfinderitypes';
					$args['tax_query'][]=array(
						'taxonomy' => $fieldtaxname_it,
						'field' => 'id',
						'terms' => $pfvalue_arr_it,
						'operator' => 'IN'
					);
				}
			}

			if($setup3_pointposttype_pt6_check == 1){
				// features type
				if($pfgetdata['features'] != ''){
					$pfvalue_arr_fe = $this->PFGetArrayValues_ld($pfgetdata['features']);
					$fieldtaxname_fe = 'pointfinderfeatures';
					$args['tax_query'][]=array(
						'taxonomy' => $fieldtaxname_fe,
						'field' => 'id',
						'terms' => $pfvalue_arr_fe,
						'operator' => 'IN'
					);
				}
			}

			/* Condition */
			if($setup3_pt14_check == 1){
				if($pfgetdata['conditions'] != ''){
					$pfvalue_arr_it = $this->PFGetArrayValues_ld($pfgetdata['conditions']);
					$fieldtaxname_it = 'pointfinderconditions';
					$args['tax_query'][] = array(
						'taxonomy' => $fieldtaxname_it,
						'field' => 'id',
						'terms' => $pfvalue_arr_it,
						'operator' => 'IN'
					);
				}
			}


			if ($zeropadding !== "yes") {
				$itemspacebetween = 17;
				$pfitemboxbg = ' style="background-color:'.$pfgetdata['itemboxbg'].';"';
			}else{
				$itemspacebetween = 0;
				$pfitemboxbg = ' style="background-color:'.$pfgetdata['itemboxbg'].'; margin:0!important"';
			}

			
			$meta_key_featured = 'webbupointfinder_item_featuredmarker';
			

			if($pfgetdata['orderby'] == 'date' || $pfgetdata['orderby'] == 'title'){
				$args['orderby'] = array('meta_value_num' => 'DESC' , $pfgetdata['orderby'] => $pfgetdata['sortby']);
				if ($pfg_orderby == 'rand') {
					unset($args['orderby'][$pfgetdata['orderby']]);
					$args['orderby']['rand']='';
				}
				$args['meta_key'] = $meta_key_featured;
			}

			

			//Featured items filter
			if($pfgetdata['featureditems'] == 'yes'){
				if(isset($args['meta_key'])){unset($args['meta_key']);}
				if(isset($args['orderby']['meta_value_num'])){unset($args['orderby']['meta_value_num']);}
				$args['meta_query'][] = array( 
					'key' => 'webbupointfinder_item_featuredmarker',
					'value' => 1,
					'compare' => '=',
					'type' => 'NUMERIC'
				);
			}

			//Featured items filter
			if($pfgetdata['featureditemshide'] == 'yes'){
				if(isset($args['meta_key'])){unset($args['meta_key']);}
				if(isset($args['orderby']['meta_value_num'])){unset($args['orderby']['meta_value_num']);}
				$args['orderby'] = array($pfgetdata['orderby'] => $pfgetdata['sortby']);
				if ($pfgetdata['orderby'] == 'rand') {
					if(isset($args['orderby'][$pfgetdata['orderby']])){unset($args['orderby'][$pfgetdata['orderby']]);}
					$args['orderby']['rand']='';
				}
				$args['meta_query'][] = array(
					'key' => 'webbupointfinder_item_featuredmarker',
					'value' => 0,
					'compare' => '=',
					'type' => 'NUMERIC'
				);
			}	
		}



		$general_retinasupport = $this->PFSAIssetControl('general_retinasupport','','0');	

		$setupsizelimitconf_general_gridsize1_width = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize1','width',440);
		$setupsizelimitconf_general_gridsize1_height = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize1','height',330);


		switch($pfgrid){

			case 'grid1':
				$pf_grid_size = 1;
				$pfgrid_output = 'pf1col';
				$pfgridcol_output = '';
				break;
			case 'grid2':
				$pf_grid_size = 2;
				$pfgrid_output = 'pf2col';
				$pfgridcol_output = '';
				break;
			case 'grid3':
				$pf_grid_size = 3;
				$pfgrid_output = 'pf3col';
				$pfgridcol_output = '';
				break;
			case 'grid4':
				$pf_grid_size = 4;
				$pfgrid_output = 'pf4col';
				$pfgridcol_output = '';
				break;
			default:
				$pf_grid_size = 4;
				$pfgrid_output = 'pf4col';
				$pfgridcol_output = '';
				break;
		}


		$loop = new WP_Query( $args );
		$foundedposts = $loop->found_posts;
		/*
		print_r($loop->query).PHP_EOL;
		echo $loop->request.PHP_EOL;
		echo $loop->post_count ;
		*/
		$post_ids = wp_list_pluck($loop->posts,'ID');
		if ($setup3_pt14_check == 1) {
			$post_contidions = wp_get_object_terms($post_ids, 'pointfinderconditions', array("fields" => "all_with_object_id"));
		}
		$post_listingtypes = wp_get_object_terms($post_ids, 'pointfinderltypes', array("fields" => "all_with_object_id"));

		$pflang = $this->PF_current_language();

		echo '
		    <div class="pfsearchresults '.$pfcontainershow.' pflistgridview pflistgridview-static">';

		        echo
		        '<div class="'.$pfcontainerdiv.'-content pflistcommonview-content " style="padding:0">';//List Content begin
		        
		        
		            echo'
		                <div class="pfitemlists-content-elements owl-carousel owl-theme pointfinder-lcarousel '.$pfgrid_output.'" id="'.$myrandno.'" data-autoplay="'.$autoplay.'" 
					data-hidebuttons="'.$hide_prev_next_buttons.'" 
					data-speed="'.$speed.'" 
					data-pagination="'.$hide_pagination_control.'" 
					data-itemspacebetween="'.$itemspacebetween.'" 
					data-pf_grid_size="'.$pf_grid_size.'" 
					>';

					
					/* Variables */

						$setup22_searchresults_animation_image  = $this->PFSAIssetControl('setup22_searchresults_animation_image','','WhiteSquare');
						$setup22_searchresults_hover_image  = $this->PFSAIssetControl('setup22_searchresults_hover_image','','0');
						$setup22_searchresults_hover_video  = $this->PFSAIssetControl('setup22_searchresults_hover_video','','0');
						$setup22_searchresults_hide_address  = $this->PFSAIssetControl('setup22_searchresults_hide_address','','0');
						
						$pfbuttonstyletext = 'pfHoverButtonStyle ';
						
						switch($setup22_searchresults_animation_image){
							case 'WhiteRounded':
								$pfbuttonstyletext .= 'pfHoverButtonWhite pfHoverButtonRounded';
								break;
							case 'BlackRounded':
								$pfbuttonstyletext .= 'pfHoverButtonBlack pfHoverButtonRounded';
								break;
							case 'WhiteSquare':
								$pfbuttonstyletext .= 'pfHoverButtonWhite pfHoverButtonSquare';
								break;
							case 'BlackSquare':
								$pfbuttonstyletext .= 'pfHoverButtonBlack pfHoverButtonSquare';
								break;
							
						} 
						$st22srloc = $this->PFSAIssetControl('st22srloc','',0);
						$stp22_qwlink = $this->PFSAIssetControl('stp22_qwlink','','1');
						$st8_npsys = $this->PFASSIssetControl('st8_npsys','',0);
						$showmapfeature = $this->PFSAIssetControl('setup22_searchresults_showmapfeature','','1');
						$user_loggedin_check = is_user_logged_in();
						$pointfinderlocationsex_vars = get_option('pointfinderlocationsex_vars');
						if ($st8_npsys == 1) {
							$listing_pstyle_meta = get_option('pointfinderltypes_style_vars');
						}else{
							$listing_pstyle_meta = '';
						}
						
						$pfboptx1 = $this->PFSAIssetControl('setup22_searchresults_hide_excerpt','1','0');
						$pfboptx2 = $this->PFSAIssetControl('setup22_searchresults_hide_excerpt','2','0');
						$pfboptx3 = $this->PFSAIssetControl('setup22_searchresults_hide_excerpt','3','0');
						$pfboptx4 = $this->PFSAIssetControl('setup22_searchresults_hide_excerpt','4','0');
						
						if($pfboptx1 != 1){$pfboptx1_text = 'style="display:none"';}else{$pfboptx1_text = '';}
						if($pfboptx2 != 1){$pfboptx2_text = 'style="display:none"';}else{$pfboptx2_text = '';}
						if($pfboptx3 != 1){$pfboptx3_text = 'style="display:none"';}else{$pfboptx3_text = '';}
						if($pfboptx4 != 1){$pfboptx4_text = 'style="display:none"';}else{$pfboptx4_text = '';}
						
						switch($pfgrid_output){case 'pf1col':$pfboptx_text = $pfboptx1_text;break;case 'pf2col':$pfboptx_text = $pfboptx2_text;break;case 'pf3col':$pfboptx_text = $pfboptx3_text;break;case 'pf4col':$pfboptx_text = $pfboptx4_text;break;}		
						
						if (is_user_logged_in()) {
							$user_favorites_arr = get_user_meta( get_current_user_id(), 'user_favorites', true );
							if (!empty($user_favorites_arr)) {
								$user_favorites_arr = json_decode($user_favorites_arr,true);
							}else{
								$user_favorites_arr = array();
							}
						}						
						
						$setup16_featureditemribbon_hide = $this->PFSAIssetControl('setup16_featureditemribbon_hide','','1');
						$setup4_membersettings_favorites = $this->PFSAIssetControl('setup4_membersettings_favorites','','1');
						$setup22_searchresults_hide_re = $this->PFREVSIssetControl('setup22_searchresults_hide_re','','1');
						
						$setup16_reviewstars_nrtext = $this->PFREVSIssetControl('setup16_reviewstars_nrtext','','0');
						$setup22_searchresults_hide_lt  = $this->PFSAIssetControl('setup22_searchresults_hide_lt','','0');

						$st22srlinknw = $this->PFSAIssetControl('st22srlinknw','','0');
						$targetforitem = '';
						if ($st22srlinknw == 1) {
							$targetforitem = ' target="_blank"';
						}

					if($loop->post_count > 0){
				
						while ( $loop->have_posts() ) : $loop->the_post();
						
						$post_id = get_the_id();

						
						$ItemDetailArr = array();
						
						if ($pflang) {
							$pfitemid = $this->PFLangCategoryID_ld($post_id,$pflang,$setup3_pointposttype_pt1);
						}else{
							$pfitemid = $post_id;
						}

						
						$featured_image_stored = $this->pointfinder_featured_image_getresized($pfitemid,$template_directory_uri,$general_crop2,$general_retinasupport,$setupsizelimitconf_general_gridsize1_width,$setupsizelimitconf_general_gridsize1_height);

						$ItemDetailArr['featured_image_org'] = $featured_image_stored['featured_image_org'];
						$ItemDetailArr['featured_image'] = $featured_image_stored['featured_image'];
						$ItemDetailArr['if_title'] = get_the_title($pfitemid);
						$ItemDetailArr['if_excerpt'] = get_the_excerpt();
						$ItemDetailArr['if_link'] = get_permalink($pfitemid);;
						$ItemDetailArr['if_address'] = esc_html(get_post_meta( $pfitemid, 'webbupointfinder_items_address', true ));
						$ItemDetailArr['featured_video'] =  esc_url(get_post_meta( $pfitemid, 'webbupointfinder_item_video', true ));

						$data_values = $pfstviewcor = '';

	                      
                         $data_values .= ' data-pid="'.$pfitemid.'"';
                         $pfstviewcor = get_post_meta($pfitemid, 'webbupointfinder_items_location', true);

                         if (!empty($pfstviewcor)) {
                           $pfstviewcor = explode(',', $pfstviewcor);

                           if (count($pfstviewcor) >= 2) {
                            if (!empty($pfstviewcor[0]) && !empty($pfstviewcor[1])) {
                              $ItemDetailArr['lat'] = $pfstviewcor[0];
                              $data_values .= ' data-lat="'.$pfstviewcor[0].'"';
                              $ItemDetailArr['lng'] = $pfstviewcor[1];
                              $data_values .= ' data-lng="'.$pfstviewcor[1].'"';
                            }else{
                              $pfstviewcor = '';
                            }
                            
                           }
                         }
                         
                         $pfitemicon = $this->pf_get_markerimage($pfitemid,1,1,$st8_npsys);
                         
                         if($this->PFControlEmptyArr($pfitemicon)){
                  
                            if ($pfitemicon['is_cat'] == 1) {
                              $listing_icon = $this->pf_get_default_cat_images($pflang,$pfitemicon['cat'],$st8_npsys);

                              $data_values .= ' data-icon="'.$listing_icon.'"';
                            }

                            if ($pfitemicon['is_image'] == 1) {
                              $data_values .= ' data-icon="'.$pfitemicon['content'].'"';
                            }
                            
                          }

                         $data_values .= ' data-title="'.$ItemDetailArr['if_title'].'"';
	                      


						$post_listing_typeval = '';
						foreach ($post_listingtypes as $post_listingtype) {
							if ($pfitemid == $post_listingtype->object_id) {
								$post_listing_typeval = $post_listingtype->term_id;
							}
						}

						$output_data = $this->PFIF_DetailText_ld($pfitemid,$setup22_searchresults_hide_lt,$post_listing_typeval,$listing_pstyle_meta,'topmap');
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
						
						$fav_check = 'false';
						/*li*/echo '
							<div class="'.$pfgridcol_output.' wpfitemlistdata">
								<div class="pflist-item"'.$pfitemboxbg.$data_values.'>
								<div class="pflist-item-inner">
									<div class="pflist-imagecontainer pflist-subitem">
									';
									
									if($setup22_searchresults_hover_image == 1){
										echo "<a href='".$ItemDetailArr['if_link']."'".$targetforitem.">";
										if ($general_crop2 == 3) {
											echo "<div class='pfuorgcontainer'><img src='".$ItemDetailArr['featured_image'] ."' alt='' /></div>";
										}else{
											echo "<img src='".$ItemDetailArr['featured_image'] ."' alt='' />";
										}
										echo "</a>";
										
									}else{
										if ($general_crop2 == 3) {
											echo "<div class='pfuorgcontainer'><img src='".$ItemDetailArr['featured_image'] ."' alt='' /></div>";
										}else{
											echo "<img src='".$ItemDetailArr['featured_image'] ."' alt='' />";
										}
										echo "</a>";
										

										echo '
										<div class="pfImageOverlayH hidden-xs"></div>
										';
										if($setup22_searchresults_hover_video != 1 && !empty($ItemDetailArr['featured_video'])){	
										echo '
										<div class="pfButtons pfStyleV pfStyleVAni hidden-xs">';
										}else{
										echo '
										<div class="pfButtons pfStyleV2 pfStyleVAni hidden-xs">';
										}
											echo '
											<span class="'.$pfbuttonstyletext.' clearfix">
												<a class="pficon-imageclick" data-pf-link="'.$ItemDetailArr['featured_image_org'].'" data-pf-type="image" style="cursor:pointer">
													<i class="far fa-image"></i>
												</a>
											</span>';
											if($setup22_searchresults_hover_video != 1 && !empty($ItemDetailArr['featured_video'])){	
											echo '
											<span class="'.$pfbuttonstyletext.'">
												<a class="pficon-videoclick" data-pf-link="'.$ItemDetailArr['featured_video'].'" data-pf-type="iframe" style="cursor:pointer">
													<i class="fas fa-video"></i>
												</a>
											</span>';
											}
											echo '
											<span class="'.$pfbuttonstyletext.'">
												<a href="'.$ItemDetailArr['if_link'].'">
													<i class="fas fa-link"></i>
												</a>
											</span>
										</div>';
									}

									if ($setup16_featureditemribbon_hide != 0) {
										$featured_check_x = get_post_meta( $pfitemid, 'webbupointfinder_item_featuredmarker', true );

		                        		if (!empty($featured_check_x)) {
		                        			echo '<div class="pfribbon-wrapper-featured"><div class="pfribbon-featured">'.esc_html__('FEATURED','pointfindercoreelements').'</div></div>';
		                        		}
			                        }

			                        
			                        /* Start: Conditions */

				                        if ($setup3_pt14_check == 1 && !empty($post_contidions)) {
		                        			
		                        			foreach ($post_contidions as $post_condition) {
		                        				if ($post_condition->object_id == $pfitemid) {
		                        					$condition_term_id = $post_condition->term_id;
		                        					$condition_name = $post_condition->name;
		                        				
											
													if (isset($post_condition->term_id)) {																
				                        				$contidion_colors = $this->pf_get_condition_color($post_condition->term_id);

				                        				$condition_c = (isset($contidion_colors['cl']))? $contidion_colors['cl']:'#494949';
				                        				$condition_b = (isset($contidion_colors['bg']))? $contidion_colors['bg']:'#f7f7f7';

				                        				echo '<div class="pfconditions-tag" style="color:'.$condition_c.';background-color:'.$condition_b.'">';
					                        			echo '<a href="' . esc_url( get_term_link( $post_condition->term_id, 'pointfinderconditions' ) ) . '" style="color:'.$condition_c.';">'.$post_condition->name.'</a>';
					                        			echo '</div>';
				                        			}
				                        		}
				                        	}
											

				                        }
					                /* End: Conditions */

									
									if ($output_data_priceval != '' || ($review_system_statuscheck == 1 && $setup22_searchresults_hide_re == 0)) {
										echo '<div class="pflisting-itemband">';
									
										echo '<div class="pflist-pricecontainer">';
										/* Start: Review Stars */
				                        if($review_system_statuscheck == 1 && $setup22_searchresults_hide_re == 0){

				                        		$reviews = $this->pfcalculate_total_review($pfitemid);

				                        		if (!empty($reviews['totalresult'])) {
				                        			echo '<div class="pflist-reviewstars">';
				                        			$rev_total_res = round($reviews['totalresult']);
				                        			echo '<div class="revpoint">';
				                        			echo (strlen($reviews['totalresult']) > 1)?$reviews['totalresult']:$reviews['totalresult'].'.0';
				                        			echo '</div>';
				                        			echo '<div class="pfrevstars-wrapper-review">';
				                        			echo ' <div class="pfrevstars-review">';
				                        				for ($ri=0; $ri < $rev_total_res; $ri++) { 
				                        					echo '<i class="fas fa-star"></i> ';
				                        				}
				                        				for ($ki=0; $ki < (5-$rev_total_res); $ki++) { 
				                        					echo '<i class="far fa-star"></i> ';
				                        				}

				                        			echo '</div></div>';
				                        			echo '</div>';
				                        		}else{
				                        			if($setup16_reviewstars_nrtext == 0){
				                        				echo '<div class="pflist-reviewstars">';
					                        			echo '<div class="pfrevstars-wrapper-review">';
					                        			echo '<div class="pfrevstars-review pfrevstars-reviewbl"><i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> </div></div>';
		                        						echo '</div>';
				                        			}
				                        		}
				                        	
				                        }
					               		/* End: Review Stars */
										if ($output_data_priceval != '') {
											echo $output_data_priceval;
										}else{
											echo '<div class="pflistingitem-subelement pf-price" style="visibility: hidden;"></div>';
										}
										
										echo '</div>';
								
										echo '</div>';
									}

									if($pfgrid_output == 'pf1col'){
										echo '</div><div class="pfrightcontent">';
									}else{
										echo'
										
									</div>
									';
									}

									
									
									$title_text = $ItemDetailArr['if_title'];
									$address_text = $ItemDetailArr['if_address'];
									$excerpt_text = $ItemDetailArr['if_excerpt'];
									
									echo '
									<div class="pflist-detailcontainer pflist-subitem clearfix">
										<ul class="pflist-itemdetails">
											<li class="pflist-itemtitle pflineclamp-title"><a href="'.$ItemDetailArr['if_link'].'">'.$title_text.'</a></li>
											';

											if($setup22_searchresults_hide_address == 0){
												if (!empty($address_text)) {
													echo '<li class="pflist-address pflineclamp-address"><i class="fas fa-map-marker-alt"></i> '.$address_text.'</li>';
												}else{
													echo '<li class="pflist-address pflineclamp-address"></li>';
												}
											
											}
											echo '
										</ul>
									</div>
									';
									if($pfboptx_text != 'style="display:none"' && $pfgrid != 'grid1'){
									echo '
										<div class="pflist-excerpt pflist-subitem pflineclamp-excerpt" '.$pfboptx_text.'>'.$excerpt_text.'</div>
									';
									}
									if ((!empty($output_data_content) || !empty($output_data_priceval)) && $pfgrid != 'grid1') {
										echo '<div class="pflist-subdetailcontainer pflist-subitem"><div class="pflist-customfields">'.$output_data_content.'</div></div>';
									}

									/* Show on map text for search results and search page */
										echo '<div class="pflist-subdetailcontainer pflist-subitem pfshowmapmain clearfix">';
											if ($st22srloc == 1) {
												$location_val = $this->GetPFTermInfoX( $pfitemid, 'pointfinderlocations','',$pointfinderlocationsex_vars,'topmap');
												if (!empty($location_val)) {
													echo $location_val;
												}
											}

											if (!empty($output_data_ltypes)) {
												echo $output_data_ltypes;
											}
											echo '<div class="pfquicklinks">';
												if ($stp22_qwlink == 1) {
												echo '<a data-pfitemid="'.$pfitemid.'" class="pfquickview" title="'.esc_html__('Quick Preview','pointfindercoreelements').'">
													<i class="fas fa-search"></i>
												</a>';
												}
												

												/* Start: Favorites */
												if($setup4_membersettings_favorites == 1){
													$favoriteicon = 'fas fa-heart';
													$favtitle_text = esc_html__('Add to Favorites','pointfindercoreelements');
													if ($user_loggedin_check && count($user_favorites_arr)>0) {
														
														if (in_array($pfitemid, $user_favorites_arr)) {
															$fav_check = 'true';
															$favtitle_text = esc_html__('Remove from Favorites','pointfindercoreelements');
															$favoriteicon = 'fas fa-heart';
														}
													}

													echo '
													<a class="pf-favorites-link" data-pf-num="'.$pfitemid.'" data-pf-active="'.$fav_check.'" data-pf-item="true" title="'.$favtitle_text.'">
														<i class="'.$favoriteicon.'"></i></a>
													';
						                        }
					                    		/* End: Favorites */
					                    	echo '</div>';
										echo '</div>';
									
								/* End: Detail Texts */
									
									echo '
									</div>
								</div>
								
							</div>
						';/*li*/
							
						
							
							
						endwhile;
						              
			            echo '</div>';/*ul*/
					}
		           

					wp_reset_postdata();

					echo '</div>';//List Content End
					echo "</div></div> ";//Form End . List Data End

	}


}
