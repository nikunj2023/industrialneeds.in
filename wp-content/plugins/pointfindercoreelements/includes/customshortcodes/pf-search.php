<?php
/*
*
* Visual Composer PointFinder Static Grid Shortcode
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PointFinderSearchShortcode extends WPBakeryShortCode {

    use PointFinderCommonFunctions;

    function __construct() {
        add_action( 'vc_after_init', array( $this, 'pointfinder_single_pf_searchw_module_mapping' ) );
        add_shortcode( 'pf_searchw', array( $this, 'pointfinder_single_pf_searchw_module_html' ) );
    }

    

    public function pointfinder_single_pf_searchw_module_mapping() {

      if ( !defined( 'WPB_VC_VERSION' ) ) {
          return;
      }

    /**
    *Start : Search ----------------------------------------------------------------------------------------------------
    **/
      vc_map( array(
        "name" => esc_html__("PF Search", 'pointfindercoreelements'),
        "base" => "pf_searchw",
        "icon" => "pfaicon-chat-empty",
        "category" => esc_html__("Point Finder", "pointfindercoreelements"),
        "description" => esc_html__("Search Widget", 'pointfindercoreelements'),
        "params" => array(
            array(
              "type" => "pf_info_line_vc_field",
              "heading" => esc_html__("Please do not try to use PF Search (Mini Search) with other search elements on the same page. Also, PF Search (Mini Search) does not support more than 5 main search fields.", "pointfindercoreelements"),
              "param_name" => "informationfield",
            ),
            array(
              "type" => "pf_info_line_field",
              "param_name" => "pf_info_field1",
             ),
            array(
              "type" => "dropdown",
              "heading" => esc_html__("One Column View", "pointfindercoreelements"),
              "param_name" => "onecolum",
              "value" => array(esc_html__("Disable", "pointfindercoreelements")=>'0',esc_html__("Enable", "pointfindercoreelements")=>'1'),
              "description" => esc_html__("You can use PF Search inputs into one column. Note, You can't use advanced search fields on one column view.", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6'
            ),
            array(
              "type" => "dropdown",
              "heading" => esc_html__("Advanced Fields", "pointfindercoreelements"),
              "param_name" => "advsearch",
              "value" => array(esc_html__("Disable", "pointfindercoreelements")=>'0',esc_html__("Enable", "pointfindercoreelements")=>'1'),
              "description" => esc_html__("You can enable/disable advanced search fields on Listing Type change.", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6'
            ),
            
            array(
              "type" => "colorpicker",
              "heading" => esc_html__('Background Color', 'pointfindercoreelements'),
              "param_name" => "mini_bg_color",
              "description" => esc_html__("Leave empty for use default color. (Optional)", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6 pffixcol',
              "group" => esc_html__("Design", "pointfindercoreelements")
              ),
            array(
              "type" => "colorpicker",
              "heading" => esc_html__('Text Color', 'pointfindercoreelements'),
              "param_name" => "mini_txt_color",
              "description" => esc_html__("Leave empty for use default color. (Optional)", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6',
              "group" => esc_html__("Design", "pointfindercoreelements")
              ),
            array(
              "type" => "colorpicker",
              "heading" => esc_html__('Search Button Background Color', 'pointfindercoreelements'),
              "param_name" => "searchbg",
              "description" => esc_html__("Leave empty for use default color. (Optional)", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6 vc_column',
              "group" => esc_html__("Design", "pointfindercoreelements")
              ),
            array(
              "type" => "colorpicker",
              "heading" => esc_html__('Search Button Text Color', 'pointfindercoreelements'),
              "param_name" => "searchtext",
              "description" => esc_html__("Leave empty for use default color. (Optional)", "pointfindercoreelements"),
              "edit_field_class" => 'vc_col-sm-6 ',
              "group" => esc_html__("Design", "pointfindercoreelements")
              ),
             array(
              "type" => "pfa_numeric",
              "heading" => esc_html__("Container Radius", "pointfindercoreelements"),
              "param_name" => "mini_radius",
              "description" => esc_html__("Please write a radius value (px) (Optional) (Numeric only)", "pointfindercoreelements"),
              "value" => '6',
              "edit_field_class" => 'vc_col-sm-6 vc_column',
              "group" => esc_html__("Design", "pointfindercoreelements")
              )
          )
        )
      );
    /**
    *End : Search ----------------------------------------------------------------------------------------------------
    **/

    }


    public function pointfinder_single_pf_searchw_module_html( $atts ) {
      $output = $title = $number = $el_class = $mini_style = '';
      extract( shortcode_atts( array(
        'searchbg' => '',
        'searchtext' => '',
        'mini_bg_color' => '',
        'mini_txt_color' => '',
        'mini_radius' => 0,
        'onecolum' => '0',
        'advsearch' => '0'
        ), $atts ) );
      
      
      /**
      *START: SEARCH ITEMS WIDGET
      **/  
            $mini_style = " style='";
            $mini_style_inner = '';
            if (!empty($mini_bg_color)) {
              $mini_style .= $mini_style_inner .= "background-color:".$mini_bg_color.';';
            }

            if (!empty($mini_txt_color)) {
              $mini_style .= $mini_style_inner .= "color:".$mini_txt_color.';';
            }
            
            if (!empty($mini_radius)) {
              $mini_style .= $mini_style_inner .= "border-radius:".$mini_radius.'px;';
            }
            $mini_style .= "'";

            if ($searchbg != '' && $searchtext != '') {
              $searchb_style = " style='color:".$searchtext."!important;background-color:".$searchbg."!important'";
            } else {
              $searchb_style = "";
            }

            $setup1s_slides = PFSAIssetControl('setup1s_slides','','');
                
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
            }
            
            $classes = ' pfministyle'.$minisearchc;

            if ($onecolum == '1') {
              $classes .= ' pfminionecolum';
            }

            if ($advsearch == '1' && $onecolum != '1') {
              $classes .= ' pfminiadvsearch';
            }

            ob_start();

              /**
              *Start: Search Form
              **/
              ?>
              <div class="pointfinder-mini-search<?php echo $classes;?>"<?php echo $mini_style;?> data-minist="<?php echo $mini_style_inner;?>">
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
                        $script_output .= '
                            $("#pointfinder-search-form-manual").validate({
                                  debug:false,
                                  onfocus: false,
                                  onfocusout: false,
                                  onkeyup: false,
                                  focusCleanup:true,
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
              ?>
              </div>
              </div>
              
              </form>
              </div>
              <?php
              /**
              *End: Search Form
              **/   


      /**
      *END: SEARCH ITEMS WIDGET
      **/

  
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

}
new PointFinderSearchShortcode();

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pointfinder_single_pf_searchw extends WPBakeryShortCode {
    }
}