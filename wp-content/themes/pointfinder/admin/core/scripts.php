<?php
/**********************************************************************************************************************************
*
* Scripts & Styles
*
* Author: Webbu
*
***********************************************************************************************************************************/


/*------------------------------------*\
	Scripts & Styles
\*------------------------------------*/

if (!function_exists('pf_styleandscripts')) {
	function pf_styleandscripts()
	{


		if ( is_singular() ) {wp_enqueue_script( "comment-reply" );}

		/*------------------------------------*\
			Styles
		\*------------------------------------*/
		$version = time();//'2.0.0';

		if (!class_exists('Pointfindercoreelements')) {
			wp_enqueue_style('theme-stylex', get_template_directory_uri() . '/css/theme.css', array(), $version, 'all');
		}
		wp_enqueue_script('touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.6.18',true);
		wp_enqueue_style( 'font-awesome-free', get_template_directory_uri() . '/css/all.min.css',array(), '5.12.0', 'all',true);
		wp_enqueue_script('jquery.validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.19.1',true);
		wp_enqueue_script('jquery.magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0',true);
		
		wp_enqueue_script('jquery.fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1',true);
		wp_enqueue_script('jquery.smooth-scroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.min.js', array('jquery'), '2.2.0',true);
		wp_enqueue_script('jquery.ui.touch-punch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array('jquery'), '0.2.3',true);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.6',true);
		wp_enqueue_script('select2pf', get_template_directory_uri() . '/js/select2.full.min.js', array('jquery'), '4.0.13',true);
		wp_enqueue_style('select2pf', get_template_directory_uri() . '/css/select2.css', array(), '4.0.13', 'all');
		wp_enqueue_script('jquery.placeholder', get_template_directory_uri() . '/js/jquery.placeholder.min.js', array('jquery'), '0.2.4',true);
		wp_enqueue_script('jquery.typeahead', get_template_directory_uri() . '/js/jquery.typeahead.min.js', array('jquery'), '2.11.0',true);
		wp_enqueue_script('infinitescroll', get_template_directory_uri() . '/js/infinite-scroll.min.js', array('jquery'), '2.1.0',true);

		wp_enqueue_style( 'jquery.dropdown', get_template_directory_uri() . '/css/dropdown.css',array(), '2.2.0', 'all');
		wp_enqueue_script('jquery.dropdown', get_template_directory_uri() . '/js/jquery.dropdown.min.js', array('jquery'), '2.2.0',true);


		wp_enqueue_style( 'tiny-slider', get_template_directory_uri() . '/css/tiny-slider.css',array(), '2.9.3', 'all');
		

		wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/css/owl.carousel.min.css',array(), '2.3.4', 'all');
		wp_enqueue_style( 'owlcarouseltheme', get_template_directory_uri() . '/css/owl.theme.default.min.css',array(), '2.3.4', 'all');
		wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.3.4',true);

		$st8_fontello = PFASSIssetControl('st8_fontello','','1');
		$st8_animate = PFASSIssetControl('st8_animate','','1');
		if(is_rtl()){
			wp_register_style('pftheme-minified-package-css', get_template_directory_uri() . '/css/framework.min.package.rtl.css', array(), '1.9','all');
			wp_enqueue_style('pointfinder-rtl',  get_template_directory_uri()."/rtl.css", array(), '1', 'screen' );
			wp_enqueue_script('responsivemenu', get_template_directory_uri() . '/js/responsive-menu-rtl.js', array('jquery'), $version,true);
			wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/js/tiny-slider-rtl.js', array('jquery'), '2.9.3',true);
		}else{
			wp_register_style('pftheme-minified-package-css', get_template_directory_uri() . '/css/framework.min.package.css', array(), $version,'all');
			if($st8_animate == 1){wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array('pftheme-minified-package-css'), $version,'all');}		
			if($st8_fontello == 1){wp_enqueue_style('fontello', get_template_directory_uri() . '/css/fontello.css', array('pftheme-minified-package-css'), $version,'all');}
			wp_enqueue_style('golden-forms', get_template_directory_uri() . '/css/golden-forms.css', array('pftheme-minified-package-css'), $version,'all');
			//wp_register_style('owlcarousel', get_template_directory_uri() . '/css/owlcarousel.css', array(), $version,'all');
			wp_enqueue_style('magnificpopup', get_template_directory_uri() . '/css/magnificpopup.css', array('pftheme-minified-package-css'), $version,'all');
			wp_enqueue_style('typeahead', get_template_directory_uri() . '/css/typeahead.css', array('pftheme-minified-package-css'), $version,'all');

			wp_enqueue_script('responsivemenu', get_template_directory_uri() . '/js/responsive-menu.js', array('jquery'), $version,true);
			wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/js/tiny-slider.js', array('jquery'), '2.9.3',true);
		}

		wp_enqueue_style('pftheme-minified-package-css');
		wp_enqueue_style( 'theme-style', get_stylesheet_uri(),array('pftheme-minified-package-css','golden-forms'),$version);

		wp_register_style('pftheme-spinner', get_template_directory_uri() . '/css/spinner.css', array(), '1.12.1','all');

		wp_register_script('pftheme-customjs', get_template_directory_uri() . '/js/theme.js', 
			array(
				'jquery',
				'jquery-ui-core',
				'jquery-ui-draggable',
				'jquery-ui-tooltip',
				'jquery-effects-core',
				'jquery-ui-slider',
				'jquery-effects-fade',
				'jquery-effects-slide',
				'jquery-ui-dialog',
				'jquery-ui-autocomplete',
				'jquery.magnific-popup',
				'imagesloaded',
				'jquery.validate',
				'jquery.fitvids',
				'jquery.smooth-scroll',
				'jquery.ui.touch-punch',
				'isotope',
				'select2pf',
				'jquery.placeholder',
				'jquery.typeahead',
				'owlcarousel',
				'tiny-slider',
				'infinitescroll',
				'responsivemenu',
				'touchSwipe'
			), $version,true);
		wp_enqueue_script('pftheme-customjs');
		wp_localize_script( 'pftheme-customjs', 'pointfinderlcsc', array(
			'rtl' => (is_rtl())?'true':'false'
		) );
		wp_enqueue_style( 'pointfinder-ie', get_template_directory_uri() . '/css/ie.css', array('theme-style'),$version );
		wp_style_add_data( 'pointfinder-ie', 'conditional', 'IE' );
	}
}

add_action('wp_enqueue_scripts', 'pf_styleandscripts');


function pointfinder_admin_scripts(){
	
	$screen = get_current_screen();

	if ($screen->base == 'point-finder_page_pointfinder_registration' ) {
    	wp_enqueue_style( 'pointfinder-light-modal', get_template_directory_uri() . '/admin/assets/css/light-modal.css', array(), '1.0', 'all' );
    }

	wp_register_script( 'pointfinder-admin-main', get_template_directory_uri() . '/admin/assets/js/pointfinder-admin.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_style( 'pointfinder-admin-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,700,500|Roboto+Condensed:400,500,600,700', false ); 
	wp_enqueue_style('pointfinder-admin-main', get_template_directory_uri() . '/admin/assets/css/pointfinder-admin.css', array(), '1.0', 'all');
	wp_enqueue_script('pointfinder-admin-main');
	wp_localize_script( 'pointfinder-admin-main', 'pointfinderadminmain', array(
		'nagsysnonce' => wp_create_nonce('pfget_nagsystem'),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'pfget_registration' => wp_create_nonce( 'pfget_registration' ),
		'buttonwaitreg' => esc_html__( "Checking...", "pointfinder" ),
		'buttonwaitregorh' => esc_html__( "Verify", "pointfinder" ),
		'authtstatusfa' => wp_sprintf(esc_html__( "The API server is offline. If you having a problem while registering the theme. Please contact our support by using this form %shttps://wethemes.com/registration-problem-report/%s ", "pointfinder" ),'<a href="https://wethemes.com/registration-problem-report/" target="_blank">','</a>'),
		'authtstatussu' => esc_html__( "The API server is online and ready for registration. ", "pointfinder" ),
		'regsccmes' => esc_html__( "Congratulations, registration completed. This page will be refreshed automatically in 5 seconds.", "pointfinder" ),
		'rsending' => '<span class="dashicons dashicons-clock"></span> '.esc_html__( 'Request Sending...', 'pointfinder' ),
		'rsendingcmp' => '<span class="dashicons dashicons-yes-alt" style="color:green;"></span> '.esc_html__( 'Your request approved. The page will be refresh in 3 seconds.', 'pointfinder' ),
		'rsendingfail' => '<span class="dashicons dashicons-dismiss" style="color:red;"></span> '
	) );
}
add_action( 'admin_enqueue_scripts', 'pointfinder_admin_scripts');