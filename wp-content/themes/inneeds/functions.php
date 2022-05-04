<?php

/**********************************************************************************************************************************
*
* PointFinder Functions
*
* Author: Webbu
*
***********************************************************************************************************************************/
  
if ( ! function_exists( 'pointfinder_setup' ) ){
	function pointfinder_setup() {
    
    load_theme_textdomain( 'pointfinder',get_template_directory() . '/languages');

		if (!isset($content_width)){$content_width = 1170;}

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
    add_theme_support( 'post-thumbnails');
    add_theme_support( 'bbpress' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list',) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );

		register_nav_menus(array(
			'pointfinder-main-menu' => esc_html__('Point Finder Main Menu', 'pointfinder'),
			'pointfinder-footer-menu' => esc_html__('Point Finder Footer Menu', 'pointfinder')
	    ));

		if (!class_exists("pointfinder")) {
		    global $pointfinderltypes_fevars;
		    $pointfinderltypes_fevars = get_option('pointfinderltypes_fevars');
		}
	}
}

add_action('after_setup_theme', 'pointfinder_setup');





require_once( get_template_directory().'/admin/core/navmenu-walker.php');
require_once( get_template_directory().'/admin/core/theme-functions.php' );
require_once( get_template_directory().'/admin/tgm/plugins.php');
require_once( get_template_directory().'/admin/core/scripts.php');
require_once( get_template_directory().'/admin/core/sys.php');
require_once( get_template_directory().'/admin/core/regsys.php');
require_once( get_template_directory().'/admin/core/nagsys.php');
require_once( get_template_directory().'/includes/header-template.php');
require_once( get_template_directory().'/includes/footer-template.php');

if (!function_exists('pf_theme_render_title')) {
  function pf_theme_render_title() {
    if ( ! function_exists( '_wp_render_title_tag' ) ) {
      ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <?php
    }

    $general_responsive = PFSAIssetControl('general_responsive','','1');
    if($general_responsive == 1){
      $as_mobile_zoom = PFSAIssetControl('as_mobile_zoom','','0');
      $gesturehandling = PFSAIssetControl('gesturehandling','',1);
      if ($as_mobile_zoom == '1' && $gesturehandling != 1) {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">';
      } else {
        echo '<meta name="viewport" content="width=device-width, maximum-scale=1.0">';
      }
    }
  }
}
add_action( 'wp_head', 'pf_theme_render_title');



if (!function_exists('pointfinder_init_frontendeditorfix')) {
    function pointfinder_init_frontendeditorfix(){

    if (isset($_GET['vc_action'])) {
      $vc_action = sanitize_text_field( $_GET['vc_action'] );
      if ($vc_action == 'vc_inline') {
        add_action('admin_enqueue_scripts','pf_styleandscripts');
      }
    }
  }
}
add_action( 'init', 'pointfinder_init_frontendeditorfix');


add_action( 'widgets_init', 'pointfinder_widgets_init' );
if (!function_exists('pointfinder_widgets_init')) {
  function pointfinder_widgets_init() {

      register_sidebar(array(
          'name' => esc_html__('PF Default Widget Area', 'pointfinder'),
          'description' => esc_html__('PF  Default Widget Area', 'pointfinder'),
          'id' => 'pointfinder-widget-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
          'after_title' => ''
      ));

      register_sidebar(array(
          'name' => esc_html__('PF Item Page Widget', 'pointfinder'),
          'description' => esc_html__('Widget area for item detail page.', 'pointfinder'),
          'id' => 'pointfinder-itempage-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
          'after_title' => ''
      ));

      register_sidebar(array(
          'name' => esc_html__('PF Author Page Widget', 'pointfinder'),
          'description' => esc_html__('Widget area for author detail page.', 'pointfinder'),
          'id' => 'pointfinder-authorpage-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
          'after_title' => ''
      ));

      if (function_exists('is_bbpress')) {
        register_sidebar(array(
            'name' => esc_html__('PF bbPress Sidebar', 'pointfinder'),
            'description' => esc_html__('Widget area for inner bbPress pages.', 'pointfinder'),
            'id' => 'pointfinder-bbpress-area',
            'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
            'after_widget' => '</div></div>',
            'before_title' => '',
            'after_title' => ''
        ));
      }

      if (function_exists('is_woocommerce')) {
        register_sidebar(array(
            'name' => esc_html__('PF WooCommerce Sidebar', 'pointfinder'),
            'description' => esc_html__('Widget area for inner WooCommerce pages.', 'pointfinder'),
            'id' => 'pointfinder-woocom-area',
            'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
            'after_widget' => '</div></div>',
            'before_title' => '',
            'after_title' => ''
        ));
      }

      if (function_exists('dsidxpress_InitWidgets')) {
        register_sidebar(array(
            'name' => esc_html__('PF dsIdxpress Sidebar', 'pointfinder'),
            'description' => esc_html__('Widget area for inner dsIdxpress pages.', 'pointfinder'),
            'id' => 'pointfinder-dsidxpress-area',
            'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
            'after_widget' => '</div></div>',
            'before_title' => '',
            'after_title' => ''
        ));
      }
      register_sidebar(array(
          'name' => esc_html__('PF Category Sidebar', 'pointfinder'),
          'description' => esc_html__('Widget area for Item Category Page.', 'pointfinder'),
          'id' => 'pointfinder-itemcatpage-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
          'after_title' => ''
      ));


      register_sidebar(array(
          'name' => esc_html__('PF Search Results Sidebar', 'pointfinder'),
          'description' => esc_html__('Widget area for Item Search Results Page.', 'pointfinder'),
          'id' => 'pointfinder-itemsearchres-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
          'after_title' => ''
      ));


      register_sidebar(array(
          'name' => esc_html__('PF Blog Sidebar', 'pointfinder'),
          'description' => esc_html__('Widget area for single blog page.', 'pointfinder'),
          'id' => 'pointfinder-blogpages-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
      'after_title' => ''
      ));


      register_sidebar(array(
          'name' => esc_html__('PF Blog Category Sidebar', 'pointfinder'),
          'description' => esc_html__('Widget area for blog category page.', 'pointfinder'),
          'id' => 'pointfinder-blogcatpages-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
      'after_title' => ''
      ));

      register_sidebar(array(
          'name' => esc_html__('PF Blog Search Results Sidebar', 'pointfinder'),
          'description' => esc_html__('Widget area for blog search results page.', 'pointfinder'),
          'id' => 'pointfinder-blogspages-area',
          'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
          'after_widget' => '</div></div>',
          'before_title' => '',
      'after_title' => ''
      ));

      if (class_exists('ReduxFramework', false)) {
          global $pfsidebargenerator_options;
          $setup25_sidebargenerator_sidebars = (isset($pfsidebargenerator_options['setup25_sidebargenerator_sidebars']))?$pfsidebargenerator_options['setup25_sidebargenerator_sidebars']:'';

          if(PFControlEmptyArr($setup25_sidebargenerator_sidebars)){
              if(count($setup25_sidebargenerator_sidebars) > 0){
                  foreach($setup25_sidebargenerator_sidebars as $itemvalue){
                      if (function_exists('register_sidebar') && !empty($itemvalue['title'])){
                        register_sidebar(array(
                        'name' => sanitize_title( $itemvalue['title'] ),
                        'id' => sanitize_text_field($itemvalue['url']),
                        'before_widget' => '<div id="%1$s" class="%2$s"><div class="pfwidgetinner">',
                        'after_widget' => '</div></div>',
                        'before_title' => '',
                        'after_title' => ''
                        ));
                      }
                  }
              }
          }
      }
  }
}


if (!function_exists('pointfinder_block_editor_styles')) {
  function pointfinder_block_editor_styles() {
      wp_enqueue_style( 'site-block-editor-styles', get_theme_file_uri( '/style-editor.css' ), false, '1.0', 'all' );
  } 
}
add_action( 'enqueue_block_editor_assets', 'pointfinder_block_editor_styles',99 );


