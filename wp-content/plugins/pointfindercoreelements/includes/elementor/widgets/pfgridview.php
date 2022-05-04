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

class PointFinder_PFGridView extends Widget_Base {

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

	public function get_name() { return 'pointfindergridviewpf'; }

	public function get_title() { return esc_html__( 'PF Category & Location Grid View', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-gallery-grid'; }

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
				'label' => esc_html__("PF Category & Location Grid View", 'pointfindercoreelements'),
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
					'label' => esc_html__('Listing Types','pointfindercoreelements'),
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
					'label' => esc_html__('Locations','pointfindercoreelements'),
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
				'style',
				[
					'label' => esc_html__("Layout Type", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'grid' => esc_html__('Grid List','pointfindercoreelements'),
						'masonry'  => esc_html__('Tiled Masonry List','pointfindercoreelements')
					],
					'default' => 'grid'
				]
			);

			$this->add_control(
				'effect',
				[
					'label' => esc_html__("Animation", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::SELECT,
					'render_type' => 'ui',
					'options' => [
						'1'  => esc_html__('Effect 1','pointfindercoreelements'),
						'2' => esc_html__('Effect 2','pointfindercoreelements'),
						'3' => esc_html__('Effect 3','pointfindercoreelements')
					],
					'default' => '1'
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
						'name' => esc_html__('Title','pointfindercoreelements')
					],
					'default' => 'name'
				]
			);
			$this->add_control(
				'sortby',
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
				'itemlimit',
				[
					'label' => esc_html__("Listing Type Limit", "pointfindercoreelements"),
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
						'grid2' => esc_html__('2 Columns','pointfindercoreelements'),
						'grid3' => esc_html__('3 Columns','pointfindercoreelements'),
						'grid4' => esc_html__('4 Columns','pointfindercoreelements')
					],
					'default' => 'grid4'
				]
			);
			$setup22_searchresults_background2 = $this->PFSAIssetControl('setup22_searchresults_background2','','#fafafa');
			$this->add_control(
				'textcolor',
				[
					'label' => esc_html__( 'Text Color', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'render_type' => 'ui',
					'default' => $setup22_searchresults_background2,
					'selectors' => [
						'{{WRAPPER}} .pf-main-term-icon-ct i' => 'color: {{textcolor}}!important;',
						'{{WRAPPER}} .pf-tiled-gallery-ctname' => 'color: {{textcolor}}!important;',
						'{{WRAPPER}} .pf-tiled-gallery-ctcount' => 'color: {{textcolor}}!important;'
					],
				]
			);

			$this->add_control(
				'showparent',
				[
					'label' => esc_html__( 'Show Only Parent', 'pointfindercoreelements' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'true',
					'default' => 'true',
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
				'locationtype' => isset($settings['locationtype'])?$settings['locationtype']:'',
				'cols' => isset($settings['cols'])?$settings['cols']:'grid4',
				'itemlimit' => isset($settings['itemlimit'])?$settings['itemlimit']:20,
				'orderby' => isset($settings['orderby'])?$settings['orderby']:'name',
				'sortby' => isset($settings['sortby'])?$settings['sortby']:'DESC',
				'style' => isset($settings['style'])?$settings['style']:'grid',
				'effect' => isset($settings['effect'])?$settings['effect']:'1',
				'showparent' => isset($settings['showparent'])?$settings['showparent']:'true',
				'whichtype' => isset($settings['whichtype'])?$settings['whichtype']:'pointfinderltypes',
			)
		);

		$output = $image = $iconimage = $term_icon_area  = $background_effect = '';


          if (!empty($effect)) {
            switch ($effect) {case 1:$background_effect = 'BackgroundRR';case 2:$background_effect = 'BackgroundRS';break;case 3:$background_effect = 'BackgroundS';break;}
          }else{
            $background_effect = 'BackgroundRR';
          }

          if ($whichtype == 'pointfinderltypes') {
          	$listing_meta = get_option('pointfinderltypes_vars');
          }else{
          	$listing_meta = get_option('pointfinderlocationsex2_vars');
          	$listingtype = $locationtype;
          }

          

          if (!is_array($listingtype) && !empty($listingtype)) {
              $listingtypes = pfstring2BasicArray($listingtype,',');
          }elseif(empty($listingtype)){
              $listingtypes = get_terms(array(
                  'taxonomy' => $whichtype,
                  'orderby' => $orderby,
                  'order' => $sortby,
                  'hide_empty' => false,
                  'number' => $itemlimit,
                  'fields' => 'ids',
                  'parent' => (!empty($showparent))? 0 : ''
              ));
          }elseif(!empty($listingtype)){
          	$listingtypes = $listingtype;
          }

        $template_directory_uri = get_template_directory_uri();
        $general_crop2 = $this->PFSizeSIssetControl('general_crop2','',1);
        $general_retinasupport = $this->PFSAIssetControl('general_retinasupport','','0');
        if($general_retinasupport == 1){$pf_retnumber = 2;}else{$pf_retnumber = 1;}
        $gridrandno_orj = $this->PF_generate_random_string_ig();

        if($style == 'grid'){
            $setupsizelimitconf_general_gridsize2_height = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize2','height',416);
            $setupsizelimitconf_general_gridsize2_width = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize2','width',555);
            $setupsizelimitconf_general_gridsize3_height = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize3','height',270);
            $setupsizelimitconf_general_gridsize3_width = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize3','width',360);
            $setupsizelimitconf_general_gridsize4_width = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize4','width',263);
            $setupsizelimitconf_general_gridsize4_height = $this->PFSizeSIssetControl('setupsizelimitconf_general_gridsize4','height',197);

            switch($cols){
                case 'grid2':
                    $pfgrid_output = 'pf2col';
                    $pfgridcol_output = 'col-lg-6 col-md-6 col-sm-6';
                    $featured_image_width = $setupsizelimitconf_general_gridsize2_width*$pf_retnumber;
                    $featured_image_height = $setupsizelimitconf_general_gridsize2_height*$pf_retnumber;
                    break;
                case 'grid3':
                    $pfgrid_output = 'pf3col';
                    $pfgridcol_output = 'col-lg-4 col-md-6 col-sm-6';
                    $featured_image_width = $setupsizelimitconf_general_gridsize3_width*$pf_retnumber;
                    $featured_image_height = $setupsizelimitconf_general_gridsize3_height*$pf_retnumber;
                    break;
                case 'grid4':
                    $pfgrid_output = 'pf4col';
                    $pfgridcol_output = 'col-lg-3 col-md-4 col-sm-6';
                    $featured_image_width = $setupsizelimitconf_general_gridsize4_width*$pf_retnumber;
                    $featured_image_height = $setupsizelimitconf_general_gridsize4_height*$pf_retnumber;
                    break;
                default:
                    $pfgrid_output = 'pf4col';
                    $pfgridcol_output = 'col-lg-3 col-md-4 col-sm-6';
                    $featured_image_width = $setupsizelimitconf_general_gridsize4_width*$pf_retnumber;
                    $featured_image_height = $setupsizelimitconf_general_gridsize4_height*$pf_retnumber;
                break;
            }


            $output .= '<ul class="pf-tiled-term-gallery '.$gridrandno_orj.' pfitemlists-content-elements '.$pfgrid_output.'">';
                foreach ($listingtypes as $listingtype_single) {

                    $term_info = get_term_by( 'id', $listingtype_single, $whichtype);
              $iconimage = $term_icon_area = '';
                    $term_count = '';
                if ($term_info != false) {
                  if ($term_info->count > 1) {
                      $term_count = $term_info->count .' '. esc_html__( 'Listings', 'pointfindercoreelements' );
                  }elseif($term_info->count == 1){
                      $term_count = $term_info->count .' '. esc_html__( 'Listing', 'pointfindercoreelements' );
                  }
                      $this_term_icon = (isset($listing_meta[$listingtype_single]['pf_icon_of_listing']))? $listing_meta[$listingtype_single]['pf_icon_of_listing']:'';
                      if ($whichtype == 'pointfinderltypes') {
                      	$this_term_iconfont = (isset($listing_meta[$listingtype_single]['pf_icon_of_listingfs']))? $listing_meta[$listingtype_single]['pf_icon_of_listingfs']:'';
                      }else{
                      	$this_term_iconfont = (isset($listing_meta[$listingtype_single]['pf_icon_of_listingfs2']))? $listing_meta[$listingtype_single]['pf_icon_of_listingfs2']:'';
                      }

                      $img_arr = $this->pointfinder_featured_image_getresized_ex($listing_meta,$listingtype_single,$template_directory_uri,$general_crop2,$general_retinasupport,$featured_image_width,$featured_image_height);

                      if (!empty($img_arr['featured_image'])) {

                          $term_link = get_term_link($term_info->slug,$whichtype);
                          if (isset($this_term_icon[0])) {
                              $iconimage = wp_get_attachment_image_src($this_term_icon[0], 'full');
                          }

                          if (!empty($this_term_iconfont)) {
                            $term_icon_area = '<div class="pf-main-term-icon-ct"><i class="'.$this_term_iconfont.'"></i></div> ';
                          }else{
                            if (isset($iconimage[0])) {
                                $term_icon_area = '<div class="pf-main-term-icon-ct"><img src="'.$iconimage[0].'"></div>';
                            }
                          }
                          
                          $output .= '<li class="pf-tiled-gallery-image pfgallery-item animated fadeIn '.$pfgridcol_output.'">';
                          $output .= '<div class="termgutter-sizer"><a href="'.$term_link.'">';
                              $output .= ''.$term_icon_area.'<div class="PXXImageWrapper '.$background_effect.'"><img src="'.$img_arr['featured_image'].'" alt=""/><div class="ImageOverlayTi"></div><div class="ImageOverlayTix"></div><div class="pf-tiled-gallery-ctname">'.$term_info->name.'</div><div class="pf-tiled-gallery-ctcount">'.$term_count.'</div></div>';
                          $output .= '</a></div>';
                          $output .= '</li>';
                      }
                    }
                }
            $output .= '</ul>';

            $output .= '<script>
            (function($) {
            "use strict";
                $(function() {
                    $(".'.$gridrandno_orj.'").isotope({
                      layoutMode: "fitRows",
                      fitRows: {
                         gutter: 0
                      },
                      itemSelector: ".'.$gridrandno_orj.' .pfgallery-item"
                    });
                });
            })(jQuery);
            </script>
            ';


        }else{


          $output .= '<ul class="pf-tiled-term-gallery pfmasonry '.$gridrandno_orj.'">';
            foreach ($listingtypes as $listingtype_single) {
              $term_info = get_term_by( 'id', $listingtype_single, $whichtype);
              $iconimage = $term_icon_area = '';
              if ($term_info->count > 1) {
                $term_count = $term_info->count .' '. esc_html__( 'Listings', 'pointfindercoreelements' );
              }elseif($term_info->count = 1){
                $term_count = $term_info->count .' '. esc_html__( 'Listing', 'pointfindercoreelements' );
              }else{
                $term_count = '';
              }
              $this_term_icon = (isset($listing_meta[$listingtype_single]['pf_icon_of_listing']))? $listing_meta[$listingtype_single]['pf_icon_of_listing']:'';

              $this_masonry_size = (isset($listing_meta[$listingtype_single]['pf_masonry_size']))? $listing_meta[$listingtype_single]['pf_masonry_size']:'';


              if (isset($this_masonry_size[0])) {
                $this_masonry_size = $this_masonry_size[0];
              }

              switch ($this_masonry_size) {
                case 'l':
                  $class_of_this = 'pfmsgrid-item--large';
                  $img_arr = $this->pointfinder_featured_image_getresized_ex($listing_meta,$listingtype_single,$template_directory_uri,1,0,564,564);
                  break;

                case 'w':
                  $class_of_this = 'pfmsgrid-item--medium';
                  $img_arr = $this->pointfinder_featured_image_getresized_ex($listing_meta,$listingtype_single,$template_directory_uri,1,0,564,277);
                  break;

                default:
                  $class_of_this = 'pfmsgrid-item--box';
                  $img_arr = $this->pointfinder_featured_image_getresized_ex($listing_meta,$listingtype_single,$template_directory_uri,1,0,277,277);
                  break;
              }

              $this_term_iconfont = (isset($listing_meta[$listingtype_single]['pf_icon_of_listingfs']))? $listing_meta[$listingtype_single]['pf_icon_of_listingfs']:'';

              if (!empty($img_arr['featured_image'])) {



                $term_link = get_term_link($term_info->slug,$whichtype);
                if (isset($this_term_icon[0])) {
                  $iconimage = wp_get_attachment_image_src($this_term_icon[0], 'full');
                }

                if (!empty($this_term_iconfont)) {
                  $term_icon_area = '<div class="pf-main-term-icon-ct"><i class="'.$this_term_iconfont.'"></i></div> ';
                }else{
                  if (isset($iconimage[0])) {
                      $term_icon_area = '<div class="pf-main-term-icon-ct"><img src="'.$iconimage[0].'"></div>';
                  }
                }
                

                $output .= '<li class="pf-tiled-gallery-image pfgallery-item animated fadeIn pfmsgrid-item '.$class_of_this.'">';
                $output .= '<div class="termgutter-sizer"><a href="'.$term_link.'">';
                  $output .= ''.$term_icon_area.'<div class="PXXImageWrapper '.$background_effect.'"><img src="'.$img_arr['featured_image'].'" alt=""/><div class="ImageOverlayTi"></div><div class="ImageOverlayTix"></div><div class="pf-tiled-gallery-ctname">'.$term_info->name.'</div><div class="pf-tiled-gallery-ctcount">'.$term_count.'</div></div>';
                $output .= '</a></div>';
                $output .= '</li>';
              }
            }
          $output .= '</ul>';

          $output .= '<script>
          (function($) {
            "use strict";
              $(function() {
              var $grid = $(".'.$gridrandno_orj.'").masonry({
                itemSelector: ".'.$gridrandno_orj.' .pfgallery-item",
                layoutMode: "masonry",
                columnWidth: ".'.$gridrandno_orj.' .pfmsgrid-item--box",
                gutter: 10,
              });

              $grid.imagesLoaded().progress( function() {
                $grid.masonry("layout");
              });
            });
          })(jQuery);
          </script>
          ';
        }

        echo $output;


	}


}
