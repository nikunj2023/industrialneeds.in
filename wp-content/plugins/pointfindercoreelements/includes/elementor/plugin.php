<?php
namespace PointFinderElementorSYS;


class Plugin {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function __construct() {

		add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_categories' ],10,1);
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_scripts' ], 999);
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'editor_styles' ], 999);

		add_action( 'elementor/frontend/after_register_styles', [ $this, 'preview_styles' ]);
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ]);
		//add_action( 'elementor/preview/enqueue_styles', [ $this, 'preview_styles' ]);
		//add_action( 'elementor/preview/enqueue_scripts', [ $this, 'preview_scripts' ]);
		//add_action( 'elementor/element/page-settings/section_page_style/before_section_end',  [ $this, 'page_settings_controls'],10, 2);
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ], 0);

		add_action( "elementor/widget/pointfinderlogocarousel/skins_init", [ $this, 'widget_scripts' ]);


		//add_action( 'elementor/element/global-settings/style/before_section_start', [ $this, 'global_page_settings'],10, 2);

	}


	private function pointfinder_get_all_sidebars(){
		global $wp_registered_sidebars;
		$options = array();
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$options[ $sidebar['id'] ] = $sidebar['name'];
		}
		return $options;
	}
	

	public function widget_scripts() {
		wp_register_script('owlcarousel', 
			PFCOREELEMENTSURL . 'includes/elementor/assets/js/owl.carousel.min.js', array('jquery'), '2.3.4',true);
		wp_register_script('pointfinder-elementor-carousel', PFCOREELEMENTSURL . 'includes/elementor/assets/js/carousel.js', ['owlcarousel'],'2.0',true);

		wp_register_script('pointfinder-elementor-gridview', PFCOREELEMENTSURL . 'includes/elementor/assets/js/ajaxlist.js', ['jquery','jquery.dropdown'],'2.0',true);


		wp_register_script('pointfinder-elementor-logo-carousel', PFCOREELEMENTSURL . 'includes/elementor/assets/js/logocarousel.js', ['owlcarousel'],'1.9.2',true);

		wp_register_script('pointfinder-elementor-slider', PFCOREELEMENTSURL . 'includes/elementor/assets/js/slider.js', ['owlcarousel'],'2.0',true);
		
		wp_register_script('pointfinder-elementor-testimonials', PFCOREELEMENTSURL . 'includes/elementor/assets/js/testimonials.js', ['owlcarousel'],'1.9.2',true);
	}

	public function editor_styles(){
		wp_enqueue_style( 'pointfinder-elementor-editor', PFCOREELEMENTSURL . 'includes/elementor/assets/css/pf-editor.css', array(), '1.0');
	}


	private function include_widgets_files() {
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/directory-map.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/contact-map.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/contact-form.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/text-seperator.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/logo-carousel.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/testimonials.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/agentlist.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/search.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/gridview.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/slider.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/carousel.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/pfgridview.php' );
		require_once( PFCOREELEMENTSDIR . 'includes/elementor/widgets/pflist.php' );
	}

	public function register_widgets() {
		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Directory_Map() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Contact_Map() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Contact_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Text_Separator() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Logo_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_AgentList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Search() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_GridView() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_PFGridView() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\PointFinder_PFList() );

	}


	public function add_widget_categories($elements_manager) {
		$elements_manager->add_category(
			'pointfinder_elements',
			[
				'title' => esc_html__( 'Point Finder Elements', 'pointfindercoreelements' ),
				'icon'  => 'eicon-font',
			]
		);
	}


	public function editor_scripts() {

		wp_enqueue_script(
			'pointfinder-elements-editor',
			PFCOREELEMENTSURL . 'includes/elementor/assets/js/pointfinderelementor_editor.js',
			[
				'elementor-editor',
			],
			'2.0',
			true
		);

		wp_localize_script( 'pointfinder-elements-editor','pointfinderelmlocalize', array(
			'plselect' => esc_html__( "Please select", "pointfindercoreelements"),
			'nores' => esc_html__( "No results found", "pointfindercoreelements"),
			'searching' => esc_html__( "Searching...", "pointfindercoreelements"),
			'resload' => esc_html__( "The results could not be loaded.", "pointfindercoreelements"),
			'resturl' => get_rest_url(),
			'ajaxurl' => PFCOREELEMENTSURLINC . 'pfajaxhandler.php',
			'globaledit' => esc_html__( "Edit Globally", "pointfindercoreelements"),
		));
	}

	public function preview_styles() {
	  wp_register_style( 'animate-css', PFCOREELEMENTSURL . 'includes/elementor/assets/css/animate.min.css', array(), '3.7.2');
	}

	public function preview_scripts() {

	   
	}


	
}

Plugin::instance();