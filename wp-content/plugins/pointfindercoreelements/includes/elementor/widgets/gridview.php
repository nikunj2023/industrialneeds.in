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


if ( ! defined( 'ABSPATH' ) ) exit;

class PointFinder_GridView extends Widget_Base {

	use PointFinderOptionFunctions;
	use PointFinderCommonFunctions;
	use PointFinderWPMLFunctions;
	use PointFinderReviewFunctions;
	use PointFinderCommonELFunctions;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		
    }

	public function show_in_panel() { return true; }

	public function get_keywords() { return [ 'pointfinder', 'grid' ]; }

	public function get_name() { return 'pointfindergridview'; }

	public function get_title() { return esc_html__( 'PF Grid View', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-gallery-grid'; }

	public function get_categories() { return [ 'pointfinder_elements' ]; }


	public function get_script_depends() {
	    return ['pointfinder-elementor-gridview'];
	}

	public function get_style_depends() {
      return [];
    }

	protected function register_controls() {


		$this->start_controls_section(
			'gridview_general',
			[
				'label' => esc_html__("PF Grid View", 'pointfindercoreelements'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'itemboxbg',
				[
					'label' => esc_html__('Listing Card Background', 'pointfindercoreelements'),
					"description" => esc_html__("Listing card area background color of the grid listing area. Optional", 'pointfindercoreelements'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render_type' => 'template',
					/*'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search' => 'background-color: {{mini_bg_color}}!important;',
					],*/
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__("Order By", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
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
				'items',
				[
					'label' => esc_html__("Listings Per Page", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 1000,
					'step' => 1,
					'default' => 12
				]
			);

			$this->add_control(
				'cols',
				[
					'label' => esc_html__("Columns", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '3',
					'options' => [
						'1'  => esc_html__('1 Column','pointfindercoreelements'),
						'2' => esc_html__('2 Columns','pointfindercoreelements'),
						'3' => esc_html__('3 Columns','pointfindercoreelements'),
						'4' => esc_html__('4 Columns','pointfindercoreelements')
					]
				]
			);

			$this->add_control(
				'grid_layout_mode',
				[
					'label' => esc_html__("Layout", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'fitRows',
					'options' => [
						'fitRows'  => esc_html__('Fit rows','pointfindercoreelements'),
						'masonry' => esc_html__('Masonry','pointfindercoreelements')
					]
				]
			);

			$this->add_control(
				'filters',
				[
					'label' => esc_html__( 'Grid Filters', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'true',
					'default' => 'true',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'featureditems',
				[
					'label' => esc_html__( 'Show Only Featured Listings', 'pointfindercoreelements' ),
					"description" => esc_html__("Enables featured items and hide another items on query.", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SWITCHER,
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
					'type' => \Elementor\Controls_Manager::SWITCHER,
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'type' => \Elementor\Controls_Manager::TEXT,
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
					'type' => \Elementor\Controls_Manager::TEXT,
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
				'pf_posts_not_in' => isset($settings['pf_posts_not_in'])?$settings['pf_posts_not_in']:'',
				'itemboxbg' => isset($settings['itemboxbg'])?$settings['itemboxbg']:'',
				'orderby' => isset($settings['orderby'])?$settings['orderby']:'date_za',
				'items' => isset($settings['items'])?$settings['items']:8,
				'cols' => isset($settings['cols'])?$settings['cols']:3,
				'grid_layout_mode' => isset($settings['grid_layout_mode'])?$settings['grid_layout_mode']:'fitRows',
				'filters' => isset($settings['filters'])?$settings['filters']:'true',
				'featureditems' => isset($settings['featureditems'])?$settings['featureditems']:'',
				'featureditemshide' => isset($settings['featureditemshide'])?$settings['featureditemshide']:'',
				'authormode'=>isset($settings['authormode'])?$settings['authormode']:0,
				'agentmode'=>isset($settings['agentmode'])?$settings['agentmode']:0,
				'author'=>isset($settings['author'])?$settings['author']:'',
				'related'=> isset($settings['related'])?$settings['related']:0,
				'relatedcpi'=> isset($settings['relatedcpi'])?$settings['relatedcpi']:0,
				'pfrandomize' => '',
				'sortby' => 'DESC',
				'tag' => isset($settings['tag'])?$settings['tag']:'',
			)
		);

		if (empty($itemboxbg)) {
			$itemboxbg = $this->PFSAIssetControl('setup22_searchresults_background2','','');
		}

		$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
		$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
		$setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');

		$gridrandno_orj = $this->PF_generate_random_string_ig();
		$gridrandno = 'pf_'.$gridrandno_orj;

		$listingtype_x = $this->PFEX_extract_type_ig($listingtype);
		$itemtype_x = ($setup3_pointposttype_pt4_check == 1) ? $this->PFEX_extract_type_ig($itemtype) : '' ;
		$conditions_x = ($setup3_pointposttype_pt4_check == 1) ? $this->PFEX_extract_type_ig($conditions) : '' ;
		$locationtype_x = ($setup3_pointposttype_pt5_check == 1) ? $this->PFEX_extract_type_ig($locationtype) : '' ;
		$features_x = ($setup3_pointposttype_pt6_check == 1) ? $this->PFEX_extract_type_ig($features) : '' ;
		$pfnonce = wp_create_nonce('pfget_listitems');


		echo "<div class='pflistgridview".$gridrandno_orj."-container pflistgridviewgr-container pflistgridajaxview clearfix' 
		data-gridorj='".$gridrandno_orj."' 
		data-grid='".$gridrandno."' 
		data-sortby='".$sortby."' 
		data-orderby='".$orderby."' 
		data-items='".$items."' 
		data-cols='".$cols."' 
		data-posts_in='".$posts_in."' 
		data-pf_posts_not_in='".$pf_posts_not_in."' 
		data-filters='".$filters."' 
		data-itemboxbg='".$itemboxbg."' 
		data-grid_layout_mode='".$grid_layout_mode."' 
		data-listingtype_x='".$listingtype_x."' 
		data-itemtype_x='".$itemtype_x."' 
		data-conditions_x='".$conditions_x."' 
		data-locationtype_x='".$locationtype_x."' 
		data-features_x='".$features_x."' 
		data-featureditems='".$featureditems."' 
		data-featureditemshide='".$featureditemshide."' 
		data-authormode='".$authormode."' 
		data-agentmode='".$agentmode."' 
		data-author='".$author."' 
		data-related='".$related."' 
		data-relatedcpi='".$relatedcpi."' 
		data-tag='".$tag."' 
		data-pfrandomize='".$pfrandomize."' 
		data-nonce='".wp_create_nonce('pfget_listitems')."' 
		data-isrtl='".is_rtl()."' 
		data-page=''
		></div>";

	}


}
