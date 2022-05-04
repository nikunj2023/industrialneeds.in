<?php
namespace PointFinderElementorSYS\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use PointFinderElementorSYS\Helper;
use PointFinderOptionFunctions;
use PointFinderCommonFunctions;
use WP_Query;
use PF_SF_Val;

if ( ! defined( 'ABSPATH' ) ) exit;

class PointFinder_Search extends Widget_Base {

	use PointFinderOptionFunctions;
	use PointFinderCommonFunctions;


	public function show_in_panel() { return true; }

	public function get_keywords() { return [ 'pointfinder', 'search' ]; }

	public function get_name() { return 'pointfindersearch'; }

	public function get_title() { return esc_html__( 'PF Search', 'pointfindercoreelements' ); }

	public function get_icon() { return 'eicon-search'; }

	public function get_categories() { return [ 'pointfinder_elements' ]; }


	public function get_script_depends() {
		$stp5_mapty = $this->PFSAIssetControl('stp5_mapty','',1);
		$wemap_geoctype = $this->PFSAIssetControl('wemap_geoctype','','');
	    if ($stp5_mapty == 1 || $wemap_geoctype == 'google') {
			return ['theme-google-api'];
		}

		if ($stp5_mapty == 4) {
			return ['theme-yandex-map'];
		}
	}

	public function get_style_depends() {
      return [];
    }

	protected function register_controls() {


		$this->start_controls_section(
			'search_general',
			[
				'label' => esc_html__("PF Search", 'pointfindercoreelements'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'onecolum',
				[
					'label' => esc_html__( 'One Column View', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => ''
				]
			);
			$this->add_control(
				'advsearch',
				[
					'label' => esc_html__( 'Advanced Fields', 'pointfindercoreelements' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'ON', 'pointfindercoreelements' ),
					'label_off' => esc_html__( 'OFF', 'pointfindercoreelements' ),
					'return_value' => 'yes',
					'default' => ''
				]
			);
			$this->add_control(
				'mini_bg_color',
				[
					'label' => esc_html__('Container Background Color', 'pointfindercoreelements'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search' => 'background-color: {{mini_bg_color}}!important;',
					],
				]
			);
			$this->add_control(
				'searchbg',
				[
					'label' => esc_html__('Search Button Background Color', 'pointfindercoreelements'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search #pf-search-button-manual' => 'background-color: {{searchbg}}!important;',
					],
				]
			);
			$this->add_control(
				'searchtext',
				[
					'label' => esc_html__('Search Button Text Color', 'pointfindercoreelements'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search #pf-search-button-manual' => 'color: {{searchtext}}!important;',
					],
				]
			);
			
			$this->add_control(
				'mini_radius',
				[
					'label' =>esc_html__("Container Radius", "pointfindercoreelements"),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'default' => 6,
					'selectors' => [
						'{{WRAPPER}} .pointfinder-mini-search' => 'border-radius: {{mini_radius}}px!important;',
					],
				]
			);
		
			
		$this->end_controls_section();

	}

	

	protected function render() {

		$settings = $this->get_settings_for_display();
		$output = $title = $number = $el_class = $mini_style = $onecolum = '';
		extract(
			array(
				'onecolum' => isset($settings['onecolum'])?$settings['onecolum']:'',
				'advsearch' => isset($settings['advsearch'])?$settings['advsearch']:'',
				'searchbg' => isset($settings['searchbg'])?$settings['searchbg']:'',
				'searchtext' => isset($settings['searchtext'])?$settings['searchtext']:'',
				'mini_radius' => isset($settings['mini_radius'])?$settings['mini_radius']:6,
				'mini_bg_color' => isset($settings['mini_bg_color'])?$settings['mini_bg_color']:'',
				'mini_txt_color' => isset($settings['mini_txt_color'])?$settings['mini_txt_color']:''
			)
		);

		
            $mini_style_inner = '';
            if (!empty($mini_bg_color)) {
              $mini_style_inner .= "background-color:".$mini_bg_color.';';
            }

            if (!empty($mini_txt_color)) {
              $mini_style_inner .= "color:".$mini_txt_color.';';
            }
            
            if (!empty($mini_radius)) {
              $mini_style_inner .= "border-radius:".$mini_radius.'px;';
            }
      

            if ($searchbg != '' && $searchtext != '') {
              $searchb_style = " style='color:".$searchtext."!important;background-color:".$searchbg."!important'";
            } else {
              $searchb_style = "";
            }
	      
	      	$setup1s_slides = $this->PFSAIssetControl('setup1s_slides','','');
            
			if(is_array($setup1s_slides)){
			    
			/**
			*Start: Get search data & apply to query arguments.
			**/

			    $pfgetdata = $_GET;
			    
			    if(is_array($pfgetdata)){
			        
			        $pfformvars = array();
			        
			        foreach ($pfgetdata as $key => $value) {
			            if (!empty($value) && $value != 'pfs') {
			                $pfformvars[$key] = $value;
			            }
			        }
			        
			        $pfformvars = $this->PFCleanArrayAttr('PFCleanFilters',$pfformvars);

			    }       
			/**
			*End: Get search data & apply to query arguments.
			**/
			$PFListSF = new PF_SF_Val();

			foreach ($setup1s_slides as $value) {

			  $PFListSF->GetValue($value['title'],$value['url'],$value['select'],1,$pfformvars,1,1); 
			    
			}

			$minisearchc = $PFListSF->minifieldcount;
			if ($minisearchc > 5) {
			  $minisearchc = 5;
			}

			$classes = ' pfministyle'.$minisearchc;

            if ($onecolum == 'yes') {
              $classes .= ' pfminionecolum';
            }

            if ($advsearch == 'yes' && $onecolum != 'yes') {
              $classes .= ' pfminiadvsearch';
            }


			

          /**
          *Start: Search Form
          **/
          ?>
          <div class="pointfinder-mini-search<?php echo $classes;?>" data-minist="<?php echo $mini_style_inner;?>">
          <form id="pointfinder-search-form-manual" class="pfminisearch" method="get" action="<?php echo esc_url(home_url("/")); ?>" data-ajax="false">
          <div class="pfsearch-content golden-forms">
          <div class="pf-row">
          <?php 
            
            if(is_array($setup1s_slides)){
                /*Get Listing Type Item Slug*/
				$fltf = $this->pointfinder_find_requestedfields('pointfinderltypes');

				$pfformvars_json = (isset($pfformvars))?json_encode($pfformvars):json_encode(array());
            
                if (!is_rtl()) {
                  echo $PFListSF->FieldOutput;
                }
                echo '<div class="pfsbutton">';
                
                echo '<input type="hidden" name="s" value=""/>';
                echo '<input type="hidden" name="serialized" value="1"/>';
                echo '<input type="hidden" name="action" value="pfs"/>';
                echo '<a class="button pfsearch" id="pf-search-button-manual"'.$searchb_style.'><i class="fas fa-search"></i> <span>'.esc_html__('SEARCH', 'pointfindercoreelements').'</span></a>';
                $script_output = '
                (function($) {
                    "use strict";

                    $(function(){
                    '.$PFListSF->ScriptOutput;
                    $script_output .= 'var pfsearchformerrors = $(".pfsearchformerrors");
                    
                        $("#pointfinder-search-form-manual").validate({
                              debug:false,
                              onfocus: false,
                              onfocusout: false,
                              onkeyup: false,
                              rules:{'.$PFListSF->VSORules.'},messages:{'.$PFListSF->VSOMessages.'},
                              ignore: ".select2-input, .select2-focusser, .pfignorevalidation",
                              validClass: "pfvalid",
                              errorClass: "pfnotvalid pfaddnotvalidicon pfnotvalidamini pointfinder-border-color pointfinder-border-radius pf-arrow-box pf-arrow-top",
                              errorElement: "div",
                              errorContainer: "",
                              errorLabelContainer: "",
                        });
                    ';

                    if ($fltf != 'none') {
                        $script_output .= '
                        setTimeout(function(){
                           $(".select2-container" ).attr("title","");
                           $("#'.$fltf.'" ).attr("title","")
                            
                        },0);

                        $("#'.$fltf.'_sel").on("change",function(e) {
                          if($.pf_tablet4e_check() && $("body").find(".pfminiadvsearch").length > 0){
                            $.PFGetSubItems($(this).val(),"",0,1);
                          }
                        });
                        ';
                    }
                    $script_output .= '
                    });'.$PFListSF->ScriptOutputDocReady;
                }

                if (!empty($category_selected_auto)) {
                    $script_output .= '
                        $(function(){
                            if ($("#'.$fltf.'" )) {
                                $("#'.$fltf.'" ).select2("val","'.$category_selected_auto.'");
                            }
                        });
                    ';
                }
                $script_output .='})(jQuery);';

                wp_add_inline_script('theme-scriptspf',$script_output,'after');

                echo '</div>';
                if (is_rtl()) {
                  echo $PFListSF->FieldOutput;
                }
                unset($PFListSF);
            }
          ?>
          </div>
          </div>
          </form>
          </div>
          <?php
          /**
          *End: Search Form
          **/   

	}


}
