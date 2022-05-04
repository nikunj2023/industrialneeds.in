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

class PointFinder_PFList extends Widget_Base {

	use PointFinderOptionFunctions;
	use PointFinderCommonFunctions;
	use PointFinderWPMLFunctions;
	use PointFinderReviewFunctions;
	use PointFinderCommonELFunctions;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		
    }

	public function show_in_panel() { return true; }

	public function get_keywords() { return [ 'pointfinder', 'list' ]; }

	public function get_name() { return 'pointfinderdlist'; }

	public function get_title() { return esc_html__( 'PF Category & Location List', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-post-list'; }

	public function get_categories() { return [ 'pointfinder_elements' ]; }


	public function get_script_depends() {
	    return [];
	}

	public function get_style_depends() {
      return [];
    }

	protected function register_controls() {


		$this->start_controls_section(
			'gridview_general',
			[
				'label' => esc_html__("PF Category & Location List", 'pointfindercoreelements'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'whichtype',
				[
					'label' => esc_html__("List Type", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '3',
					'options' => [
						'pointfinderltypes'  => esc_html__('Listing Types','pointfindercoreelements'),
						'pointfinderlocations' => esc_html__('Locations','pointfindercoreelements')
					],
					'default' => 'pointfinderltypes'
				]
			);


			$this->add_control(
				'listingtype',
				[
					'label' => esc_html__('Excluding Listing Types','pointfindercoreelements'),
					'label_block' => true,
					'type' => 'mxselect2',
					'multiple' => true,
					'options' => [],
					'default' => '',
					'render_type' => 'template',
					'separator' => 'none',
					'conditions' => [
						'terms' => [
							[
								'name' => 'whichtype',
								'operator' => '==',
								'value' => 'pointfinderltypes'
							]
						]
					]
				]
			);

			$this->add_control(
				'locationtype',
				[
					'label' => esc_html__('Excluding Locations','pointfindercoreelements'),
					'label_block' => true,
					'type' => 'mxselect2',
					'multiple' => true,
					'options' => [],
					'default' => '',
					'render_type' => 'template',
					'separator' => 'none',
					'conditions' => [
						'terms' => [
							[
								'name' => 'whichtype',
								'operator' => '==',
								'value' => 'pointfinderlocations'
							]
						]
					]
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__("Order By", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'render_type' => 'ui',
					'options' => [
						'id'  => esc_html__('ID','pointfindercoreelements'),
						'name' => esc_html__('Title','pointfindercoreelements'),
						'count' => esc_html__('Count','pointfindercoreelements')
					],
					'default' => 'name'
				]
			);
			$this->add_control(
				'order',
				[
					'label' => esc_html__("Order", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'render_type' => 'ui',
					'options' => [
						'ASC'  => esc_html__('ASC','pointfindercoreelements'),
						'DESC' => esc_html__('DESC','pointfindercoreelements')
					],
					'default' => 'ASC'
				]
			);
			
			$this->add_control(
				'subcatlimit',
				[
					'label' => esc_html__("Sub Category Limit", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 1000,
					'step' => 1,
					'default' => 20
				]
			);

			$this->add_control(
				'cols',
				[
					'label' => esc_html__("Columns", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'1' => esc_html__('1 Column','pointfindercoreelements'),
						'2' => esc_html__('2 Columns','pointfindercoreelements'),
						'3' => esc_html__('3 Columns','pointfindercoreelements'),
						'4' => esc_html__('4 Columns','pointfindercoreelements')
					],
					'default' => '4'
				]
			);

			$this->add_control(
				'hideemptyformain',
				[
					'label' => esc_html__( 'Hide Empty Categories for Main Level', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => '',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'hideemptyforsub',
				[
					'label' => esc_html__( 'Hide Empty Categories for Sub Level', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => '',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'showcountmain',
				[
					'label' => esc_html__( 'Show counts for Main Level', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'showcountsub',
				[
					'label' => esc_html__( 'Show counts for Sub Level', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'viewalllink',
				[
					'label' => esc_html__( 'View All Link', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);

			$this->add_control(
				'titleuppercase',
				[
					'label' => esc_html__( 'Title Uppercase', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none'
				]
			);
	

			
			$this->add_control(
				'subcatbgcolor',
				[
					'label' => esc_html__( 'Sub Level BG Color', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render_type' => 'ui',
					'default' => '#fafafa',
					'selectors' => [
						'{{WRAPPER}} .pf-child-term' => 'background-color: {{subcatbgcolor}};',
					],
				]
			);

			$this->add_control(
				'subcattextcolor',
				[
					'label' => esc_html__( 'Sub Level Text Color', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render_type' => 'ui',
					'default' => '#494949',
					'selectors' => [
						'{{WRAPPER}} .pf-child-term' => 'color: {{subcattextcolor}};',
						'{{WRAPPER}} .pf-child-term a' => 'color: {{subcattextcolor}};'
					],
				]
			);

			$this->add_control(
				'subcattextcolor2',
				[
					'label' => esc_html__( 'Sub Level Text Hover Color', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render_type' => 'ui',
					'default' => '#000',
					'selectors' => [
						'{{WRAPPER}} .pf-child-term a:hover' => 'color: {{subcattextcolor2}};'
					],
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
				'excludingcats' => isset($settings['listingtype'])?$settings['listingtype']:'',
				'excludinglocs' => isset($settings['locationtype'])?$settings['locationtype']:'',
				'cols' => isset($settings['cols'])?$settings['cols']:4,
				'itemlimit' => isset($settings['itemlimit'])?$settings['itemlimit']:20,
				'orderby' => isset($settings['orderby'])?$settings['orderby']:'name',
				'order' => isset($settings['order'])?$settings['order']:'ASC',
				'hideemptyformain' => isset($settings['hideemptyformain'])?$settings['hideemptyformain']:'',
				'hideemptyforsub' => isset($settings['hideemptyforsub'])?$settings['hideemptyforsub']:'',
				'showcountmain' => isset($settings['showcountmain'])?$settings['showcountmain']:'',
				'whichtype' => isset($settings['whichtype'])?$settings['whichtype']:'pointfinderltypes',
				'showcountsub' => isset($settings['showcountsub'])?$settings['showcountsub']:'',

				'viewalllink' => isset($settings['viewalllink'])?$settings['viewalllink']:'',
				'titleuppercase' => isset($settings['titleuppercase'])?$settings['titleuppercase']:'',
				'subcatlimit' => isset($settings['subcatlimit'])?$settings['subcatlimit']:'',
			)
		);

		
		switch ($cols) {
			case 4:
				$cols_output = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
				break;
			case 3:
				$cols_output = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
				break;
			case 2:
				$cols_output = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
				break;
			case 1:
				$cols_output = 'col-lg-12';
				break;
			
			default:
				$cols_output = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
				break;
		}

		if ($hideemptyformain == 'yes') {$hideemptyformain = true;}else{$hideemptyformain = false;}
		if ($hideemptyforsub == 'yes') {$hideemptyforsub = true;}else{$hideemptyforsub = false;}
		if ($showcountsub == 'yes') {$show_count_child = 1;}else{$show_count_child = 0;}
		if ($showcountmain == 'yes') {$show_count_main = 1;}else{$show_count_main = 0;}
		if ($viewalllink == 'yes') {$show_viewall_child = 1;}else{$show_viewall_child = 0;}

		if($subcatlimit != 0){$subcat_limit = $subcatlimit - 1;}else{$subcat_limit = 0;}
		$title_uppercase = $titleuppercase;


		/*Extra Styles*/
		$style_text_main = ' style="';

			$style_text_main .= 'font-weight:bold;';

			if ($title_uppercase == 1) {
				$style_text_main .= 'text-transform:uppercase;';
			}

		$style_text_main .= '"';

		$taxonomies = array( 
		    $whichtype
		);

		if ($whichtype == 'pointfinderlocations') {
			$excludingcats = $excludinglocs;
		}
		if (!empty($excludingcats) && !is_array($excludingcats)) {
			$excludingcats = pfstring2BasicArray($excludingcats);
		}
		$args = array(
		    'orderby'           => $orderby, 
		    'order'             => $order,
		    'hide_empty'        => $hideemptyformain, 
		    'exclude'           => array(), 
		    'exclude_tree'      => $excludingcats, 
		    'include'           => array(),
		    'number'            => '', 
		    'fields'            => 'all', 
		    'slug'              => '',
		    'parent'            => '',
		    'hierarchical'      => true, 
		    'child_of'          => 0, 
		    'get'               => '', 
		    'name__like'        => '',
		    'description__like' => '',
		    'pad_counts'        => true, 
		    'offset'            => '', 
		    'search'            => '', 
		    'cache_domain'      => 'core',
		    'pointfinder'		=> 'directorylist'
		); 

		$listing_terms = get_terms($taxonomies, $args);

		if ($whichtype == 'pointfinderlocations') {
			$listing_meta = get_option('pointfinderlocationsex_vars');
		}else{
			$listing_meta = get_option('pointfinderltypes_vars');
		}
		

		$output = '<div class="vc_wp_posts wpb_content_element">';

		if ( ! empty( $listing_terms ) && ! is_wp_error( $listing_terms ) ) {
		    $count = count( $listing_terms );
		    $i = 0;
		    $term_list = '<ul class="pointfinder-terms-archive pf-row">';

		    if ($whichtype == 'pointfinderlocations') {
		    	foreach ( $listing_terms as $term ) {
			        if ($term->parent == 0) {

			        	/*get term specifications*/
			        	$style_text_main_custom = $iconimage_url = $this_term_icon = $this_term_catbg = $this_term_cattext = $this_term_cattext2 = $this_term_iconwidth = $hover_text = '';

			        	if (isset($listing_meta[$term->term_id])) {
			        		$this_term_icon = "";
			        		$this_term_iconwidth = "";
			        		$this_term_iconfont = (isset($listing_meta[$term->term_id]['pf_icon_of_listingfs']))? $listing_meta[$term->term_id]['pf_icon_of_listingfs']:'';
			        		$this_term_catbg = (isset($listing_meta[$term->term_id]['pf_catbg_of_listing']))? $listing_meta[$term->term_id]['pf_catbg_of_listing']:'#ededed';
			        		$this_term_catbg = (isset($listing_meta[$term->term_id]['pf_catbg_of_listing']))? $listing_meta[$term->term_id]['pf_catbg_of_listing']:'#ededed';
			        		$this_term_cattext = (isset($listing_meta[$term->term_id]['pf_cattext_of_listing']))? $listing_meta[$term->term_id]['pf_cattext_of_listing']:'#494949';
			        		$this_term_cattext2 = (isset($listing_meta[$term->term_id]['pf_cattext2_of_listing']))? $listing_meta[$term->term_id]['pf_cattext2_of_listing']:'#000';

			        		if (empty($this_term_iconwidth)) {
			        			$this_term_iconwidth = 20;
			        		}
			        		/*icon*/
			        		if (!empty($this_term_icon) && is_array($this_term_icon)) {
			        			$iconimage = wp_get_attachment_image_src($this_term_icon[0], 'full');
			        			$iconimage_url = '<span class="pf-main-term-icon"><img src="'.$iconimage[0].'" width="'.$this_term_iconwidth.'"></span>';
			        		}

			        		$style_text_main_custom .=' style="';
			        		$style_text_main_custom .= 'background-color:'.$this_term_catbg.';';
			        		$style_text_main_custom .= 'color:'.$this_term_cattext.';';

			        		$hover_text = ' data-hovercolor="'.$this_term_cattext2.'" data-standartc="'.$this_term_cattext.'"';
			        		
			        		$style_text_main_custom .='"';
			        	}



			        	$term_list .= '<li class="pf-grid-item '.$cols_output.' pf-main-term"'.$style_text_main.'>';
			        	if (!empty($this_term_iconfont)) {
			        		$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term->name ) . '"'.$style_text_main_custom.''.$hover_text.'><i class="'.$this_term_iconfont.'"></i> '. $iconimage_url . $term->name . ' ';
			        	}else{
			        		$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term->name ) . '"'.$style_text_main_custom.''.$hover_text.'>'. $iconimage_url . $term->name . ' ';
			        	}
			        	
			        	if ($show_count_main == 1) {
			        	$term_list .= '<span class="pull-right pf-main-term-number">('.$term->count.')</span>';
			        	}
			        	$term_list .= '</a>';
			        	
			        	/* Check term childs */

			        		$k = 0;
			        		$term_list_ex = '';
			        		if ($subcat_limit > 0) {
				        		$args_sub = array(
								    'orderby'           => $orderby, 
			   						'order'             => $order,
								    'hide_empty'        => $hideemptyforsub, 
								    'exclude'           => array(), 
								    'exclude_tree'      => array(), 
								    'include'           => array(),
								    'number'            => '', 
								    'fields'            => 'all', 
								    'slug'              => '',
								    'parent'            => $term->term_id,
								    'hierarchical'      => true, 
								    'child_of'          => 0, 
								    'get'               => '', 
								    'name__like'        => '',
								    'description__like' => '',
								    'pad_counts'        => true, 
								    'offset'            => '', 
								    'search'            => '', 
								    'cache_domain'      => 'core'
								); 
				        		$listing_terms_child = get_terms($taxonomies, $args_sub);
				        		foreach ($listing_terms_child as $term_child) {

				        			$term_child_check = get_terms($taxonomies, array('parent' => $term_child->term_id, 'child_of' => $term_child->term_id,'fields' => 'count'));
										
									if(absint($term_child_check) > 0){
										$term_child_count = $term_child->count + absint($term_child_check);
									}else{
										$term_child_count = $term_child->count;
									}
										
				        			if($k <= $subcat_limit){
				        				$term_list_ex .= '<li class="pf-child-term">';
				        				$term_list_ex .= '<a href="' . get_term_link( $term_child ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term_child->name ) . '" >' . $term_child->name . '</a>';
				        				if ($show_count_child == 1) {
				        					$term_list_ex .= '<span class="pull-right">('.$term_child_count.')</span>';
				        				}
				        				$term_list_ex .= '</li>';
				        				$k++;
				        			};
				        		}
			        		}
			        		if ($k > 0) {
			        			$term_list .= '<ul class="pf-child-term-main">';
			        			$term_list .= $term_list_ex;
			        			if ($show_viewall_child == 1) {
			        				$term_list .= '<li class="pf-child-term pf-child-term-viewall"><a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term->name ) . '" >' . esc_html__('View All','pointfindercoreelements') . '</a></li>';
			        			}
			        			$term_list .= '</ul>';
			        		}

			        	$term_list .= '</li>';
			        }
			    }
		    }else{
		    	foreach ( $listing_terms as $term ) {
			        if ($term->parent == 0) {

			        	/*get term specifications*/
			        	$style_text_main_custom = $iconimage_url = $this_term_icon = $this_term_catbg = $this_term_cattext = $this_term_cattext2 = $this_term_iconwidth = $hover_text = '';

			        	if (isset($listing_meta[$term->term_id])) {
			        		$this_term_icon = (isset($listing_meta[$term->term_id]['pf_icon_of_listing']))? $listing_meta[$term->term_id]['pf_icon_of_listing']:'';
			        		$this_term_iconfont = (isset($listing_meta[$term->term_id]['pf_icon_of_listingfs']))? $listing_meta[$term->term_id]['pf_icon_of_listingfs']:'';
			        		$this_term_iconwidth = (isset($listing_meta[$term->term_id]['pf_iconwidth_of_listing']))? $listing_meta[$term->term_id]['pf_iconwidth_of_listing']:'';
			        		$this_term_catbg = (isset($listing_meta[$term->term_id]['pf_catbg_of_listing']))? $listing_meta[$term->term_id]['pf_catbg_of_listing']:'#ededed';
			        		$this_term_cattext = (isset($listing_meta[$term->term_id]['pf_cattext_of_listing']))? $listing_meta[$term->term_id]['pf_cattext_of_listing']:'#494949';
			        		$this_term_cattext2 = (isset($listing_meta[$term->term_id]['pf_cattext2_of_listing']))? $listing_meta[$term->term_id]['pf_cattext2_of_listing']:'#000';

			        		if (empty($this_term_iconwidth)) {
			        			$this_term_iconwidth = 20;
			        		}
			        		/*icon*/
			        		if (!empty($this_term_icon) && is_array($this_term_icon)) {
			        			$iconimage = wp_get_attachment_image_src($this_term_icon[0], 'full');
			        			$iconimage_url = '<span class="pf-main-term-icon"><img src="'.$iconimage[0].'" width="'.$this_term_iconwidth.'"></span>';
			        		}

			        		$style_text_main_custom .=' style="';
			        		$style_text_main_custom .= 'background-color:'.$this_term_catbg.';';
			        		$style_text_main_custom .= 'color:'.$this_term_cattext.';';

			        		$hover_text = ' data-hovercolor="'.$this_term_cattext2.'" data-standartc="'.$this_term_cattext.'"';
			        		
			        		$style_text_main_custom .='"';
			        	}



			        	$term_list .= '<li class="pf-grid-item '.$cols_output.' pf-main-term"'.$style_text_main.'>';

			        	$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term->name ) . '"'.$style_text_main_custom.''.$hover_text.'>';

			        	if (!empty($this_term_iconfont)) {
			        		$term_list .= '<i class="'. $this_term_iconfont .'"></i> '. $term->name . ' ';
			        	}else{
			        		$term_list .= $iconimage_url . $term->name . ' ';
			        	}
			        	
			        	if ($show_count_main == 1) {
			        	$term_list .= '<span class="pull-right pf-main-term-number">('.$term->count.')</span>';
			        	}
			        	$term_list .= '</a>';
			        	
			        	/* Check term childs */

			        		$k = 0;
			        		$term_list_ex = '';
			        		if ($subcat_limit > 0) {
				        		$args_sub = array(
								    'orderby'           => $orderby, 
			   						'order'             => $order,
								    'hide_empty'        => $hideemptyforsub, 
								    'exclude'           => array(), 
								    'exclude_tree'      => $excludingcats, 
								    'include'           => array(),
								    'number'            => '', 
								    'fields'            => 'all', 
								    'slug'              => '',
								    'parent'            => $term->term_id,
								    'hierarchical'      => true, 
								    'child_of'          => '', 
								    'get'               => '', 
								    'name__like'        => '',
								    'description__like' => '',
								    'pad_counts'        => true, 
								    'offset'            => '', 
								    'search'            => '', 
								    'cache_domain'      => 'core',
	    							'pointfinder'		=> 'directorylist'
								); 
				        		$listing_terms_child = get_terms($taxonomies, $args_sub);

				        		foreach ($listing_terms_child as $term_child) {

				        			if($k <= $subcat_limit){
				        				
				        				$term_child_check = get_terms($taxonomies, array('parent' => $term_child->term_id, 'child_of' => $term_child->term_id,'fields' => 'count'));
										
										if(absint($term_child_check) > 0){
											$term_child_count = $term_child->count + absint($term_child_check);
										}else{
											$term_child_count = $term_child->count;
										}
				        				
				        				

				        				$term_list_ex .= '<li class="pf-child-term">';
				        				$term_list_ex .= '<a href="' . get_term_link( $term_child ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term_child->name ) . '" >' . $term_child->name . '</a>';
				        				if ($show_count_child == 1) {
				        					$term_list_ex .= '<span class="pull-right">('.$term_child_count.')</span>';
				        				}
				        				$term_list_ex .= '</li>';
				        				$k++;
				        			};
				        		}
			        		}
			        		if ($k > 0) {
			        			$term_list .= '<ul class="pf-child-term-main">';
			        			$term_list .= $term_list_ex;
			        			if ($show_viewall_child == 1) {
			        				$term_list .= '<li class="pf-child-term pf-child-term-viewall"><a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all posts under %s', 'pointfindercoreelements' ), $term->name ) . '" >' . esc_html__('View All','pointfindercoreelements') . '</a></li>';
			        			}
			        			$term_list .= '</ul>';
			        		}

			        	$term_list .= '</li>';
			        }
			    }
		    }
			    
		    $term_list .= '</ul>';
		    $term_list .= '</div>';

		    $output .=  $term_list;
		}
		
		echo $output;

	}


}
