<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeforest.net/user/webbu
 * @since      1.0.0
 *
 * @package    Pointfindercoreelements
 * @subpackage Pointfindercoreelements/admin
 */

class Pointfindercoreelements_Admin {
	use PointFinderOptionFunctions,
	PointFinderCommonFunctions,
	PointFinderWPMLFunctions,
	PointFinderCUFunctions,
	PointFinderMailSystem,
	PointFinderMembershipPackages,
	PointFinderPPPPackages,
	PointFinderListingBackendFilters,
	PointFinderListingBackendReviewMetabox,
	PointFinderReviewFunctions,
	PointFinderMOrderMetaboxes,
	PointFinderOrderMetaboxes,
	PointFinderStatusChangeFunctions,
	PointFinderListingMetabox,
	PointfinderInvoicesMetabox,
	PointFinderScheduleFunctions,
	PointFinderUserProfileModifications,
	PointFinderListingTypeConnections,
	PointFinderWPMLStringGenerator;

	private $plugin_name;
	private $version;
	private $post_type_name;
	private $agent_post_type_name;

	public function __construct($plugin_name, $version, $post_type_name, $agent_post_type_name) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->agent_post_type_name = $agent_post_type_name;
		$this->post_type_name = $post_type_name;
	}

	public function enqueue_styles_scripts() {

		global $pagenow;
		global $post_type;

		$wemap_langy = $we_special_key = '';

		wp_register_style('pfadminstyles', PFCOREELEMENTSURLADMIN . 'css/style.css', array(), '1.0', 'all');
	    wp_register_style('redux-custompf-css', PFCOREELEMENTSURLADMIN . 'options/custom/custom.css', array() , '','all');

	    wp_register_style('pfsearch-goldenforms-css', PFCOREELEMENTSURLADMIN .'css/golden-forms.css', array(), '1.0', 'all');
	    
		$screen = get_current_screen();
		$pagename = (isset($_GET['page']))?$_GET['page']:'';

		if ($pagenow == 'admin.php' && $pagename == '_pointfinderoptions') {
			wp_enqueue_style('redux-custompf-css');
	    }

		if(($pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array($post_type, array($this->post_type_name,'page','post')) ){
			wp_enqueue_style('pfadminstyles');
		}

		if(($pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array($post_type, array('pointfinderreviews')) ){
			
			wp_enqueue_style('pfadminstyles');
		}

		wp_register_script('pfa-contactmap-js', PFCOREELEMENTSURLINC . 'vcextend/assets/js/contactmap.js', array('jquery'), '1.0',true);
	    wp_register_style('pfa-contactmap-css', PFCOREELEMENTSURLINC . 'vcextend/assets/css/contactmap.css', array(), '1.0', 'all');

		wp_register_script('pfa-select2-js', PFCOREELEMENTSURLINC . 'vcextend/assets/js/select2.min.js', array('jquery'), '3.5.4',true);
		wp_register_style('pfa-select2-css', PFCOREELEMENTSURLINC . 'vcextend/assets/css/select2.css', array(), '3.5.4', 'all');
		wp_register_style('pfa-vcextend-css', PFCOREELEMENTSURLINC . 'vcextend/assets/css/vc_extend.css', array(), '1.0.0', 'all');
		wp_register_script('pfa-scripts-js', PFCOREELEMENTSURLINC . 'vcextend/assets/js/scripts.js', array('jquery'), '1.0',true);

	    
		if (in_array($screen->post_type,array('pointfinderreviews','pointfinderorders','pointfinderorders','pointfinderinvoices'))) {
			wp_register_style('metabox-custom.', PFCOREELEMENTSURLADMIN . 'css/metabox-custom.css', array(), '1.0', 'all');
			wp_enqueue_style('metabox-custom.');
		}

		if ($screen->post_type == $this->post_type_name) {

			wp_register_script('theme-timepicker', PFCOREELEMENTSURLADMIN . 'js/jqueryui/jquery-ui-timepicker-addon.min.js', array(
				'jquery',
				'jquery-ui-core',
				'jquery-ui-datepicker',
				'jquery-ui-slider'
			), '4.0',true);
			wp_enqueue_script('theme-timepicker');

			wp_enqueue_style('jquery-ui-smoothnesspf3', PFCOREELEMENTSURLADMIN . "css/jquery-ui.min.css", false, null);
			wp_enqueue_style('jquery-ui-smoothnesspf2', PFCOREELEMENTSURLADMIN . "css/jquery-ui.structure.min.css", false, null);
			wp_enqueue_style('jquery-ui-smoothnesspf', PFCOREELEMENTSURLADMIN . "css/jquery-ui.theme.min.css", false, null);

			wp_register_style( 'jquery-ui-core', PFCOREELEMENTSURLADMIN . "css/jqueryui/jquery.ui.core.css", array(), '1.8.17' );
			wp_register_style( 'jquery-ui-theme', PFCOREELEMENTSURLADMIN . "css/jqueryui/jquery.ui.theme.css", array(), '1.8.17' );
			wp_enqueue_style( 'jquery-ui-datepicker', PFCOREELEMENTSURLADMIN . "css/jqueryui/jquery.ui.datepicker.css", array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17' );

			
		}

		if ((($pagenow != "term.php" || $pagenow != 'edit-tags.php') && !in_array($screen->taxonomy, array('pointfinderitypes', 'pointfinderfeatures', 'pointfinderconditions')))) {
			wp_register_script(
				'listingpage-scriptspf',
				PFCOREELEMENTSURLADMIN . 'js/listingpage-scripts.js',
				array('jquery'),
				'1.0.0',
				true
			);
	        wp_enqueue_script('listingpage-scriptspf');
	        wp_localize_script( 'listingpage-scriptspf', 'listingpagescriptspf', array(
				'ps' => esc_html__('Please type something','pointfindercoreelements'),
				'resturl' => get_rest_url()
			));
		}

		if(($pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array($post_type, array($this->post_type_name,'page','post','pointfinderreviews')) ){

	    	wp_enqueue_script('pfa-contactmap-js');
	    	wp_enqueue_style('pfa-contactmap-css');
			wp_enqueue_script('pfa-scripts-js');
			wp_enqueue_script('pfa-select2-js');
			wp_enqueue_style('pfa-select2-css');
			wp_enqueue_style('pfa-vcextend-css');
		}


		if ($post_type == $this->post_type_name) {
			wp_register_style('itempage-custom.', PFCOREELEMENTSURLADMIN .'css/itempage-custom.css', array(), '1.0', 'all');
			wp_enqueue_style('itempage-custom.');
		}
		if ($post_type == $this->post_type_name && is_rtl()) {
			wp_register_style('itempage-custom-rtl.', PFCOREELEMENTSURLADMIN .'css/itempage-custom-rtl.css', array(), '1.0', 'all');
			wp_enqueue_style('itempage-custom-rtl.');
		}

		$special_codes = get_current_screen();

		if ((($pagenow == "term.php" || $pagenow == 'edit-tags.php') && in_array($special_codes->taxonomy, array('pointfinderitypes', 'pointfinderfeatures', 'pointfinderconditions'))) || ($pagenow == 'post.php' && $post_type == $this->post_type_name) || ($pagenow == 'post-new.php' && $post_type == $this->post_type_name) || ($pagenow == 'edit.php' && $post_type == $this->post_type_name)) {
			
			wp_enqueue_style('selectize', PFCOREELEMENTSURLADMIN .'css/selectize.css', array(), '0.13.0', 'all');
			wp_enqueue_style('selectize-theme', PFCOREELEMENTSURLADMIN .'css/selectize.default.css', array(), '0.13.0', 'all');
			wp_enqueue_script('selectize', PFCOREELEMENTSURLADMIN .'js/selectize.min.js', array('jquery'), '0.13.0',true);
			
			if (!($pagenow == 'post.php' && $post_type == $this->post_type_name) && !($pagenow == 'post-new.php' && $post_type == $this->post_type_name)) {
				wp_enqueue_script('selectize-custom', PFCOREELEMENTSURLADMIN .'js/selectize-custom.js', array('selectize'), '1.0',true);
			}else{
				wp_enqueue_style('pfsearch-goldenforms-css');
			}

			/*wp_register_style('bootstrap-fadmincss', PFCOREELEMENTSURLADMIN .'css/bootstrap-3.3.2.min.css', array(), '3.3.2', 'all');
			wp_enqueue_style('bootstrap-fadmincss');

			wp_register_style('bootstrap-mselect', PFCOREELEMENTSURLADMIN .'css/bootstrap-multiselect.css', array(), '2.0', 'all');
			wp_enqueue_style('bootstrap-mselect');

			wp_register_script('bootstrap-fadmin', PFCOREELEMENTSURLADMIN .'js/bootstrap-3.3.2.min.js', array('jquery'), '3.3.2',true);
			wp_enqueue_script('bootstrap-fadmin');

			wp_register_script('bootstrap-mselectjs', PFCOREELEMENTSURLADMIN .'js/bootstrap-multiselect.js', array('jquery','bootstrap-fadmin'), '2.0',true);
			wp_enqueue_script('bootstrap-mselectjs');*/

		}

		if (($pagenow == 'post.php' && $post_type == $this->post_type_name) || ($pagenow == 'post-new.php' && $post_type == $this->post_type_name)) {
			wp_enqueue_style( 'font-awesome-free', PFCOREELEMENTSURLPUBLIC . 'css/all.min.css',array(), '5.11.2', 'all');
			wp_enqueue_script('jquery.typeahead', get_template_directory_uri() . '/js/jquery.typeahead.min.js', array('jquery'), '2.11.0',true);
			wp_enqueue_script( 'theme-leafletjs', PFCOREELEMENTSURLPUBLIC . 'js/leaflet.js', array( 'jquery' ), '1.5.1', false );
			wp_enqueue_style( 'theme-leafletcss', PFCOREELEMENTSURLPUBLIC . 'css/leaflet.css', array(), '1.5.1', 'all');
			wp_localize_script( 'theme-leafletjs', 'theme_leafletjs', array(
				'zoomin' => esc_html__('Zoom in','pointfindercoreelements'),
				'zoomout' => esc_html__('Zoom out','pointfindercoreelements'),
			));
			$we_special_key = $wemap_langy = $wemap_ee_appid = $wemap_here_appcode = $heremapslang = $we_special_key_mapbox = $we_special_key_google = $we_special_key_yandex = $we_special_key_bing = $wemap_country3 = $maplanguage = '';

			$pointfindergeosecurity = get_option( 'pointfindergeosecurity');

			if (empty($pointfindergeosecurity)) {
				$pointfindergeosecuritymax = getrandmax();
				$pointfindergeosecurity = rand(9999,$pointfindergeosecuritymax);
				update_option( 'pointfindergeosecurity', $pointfindergeosecurity );
			}

			$wemap_country3 = $this->PFSAIssetControl('wemap_country3','','');

			$stp5_mapty = $this->PFSAIssetControl('stp5_mapty','',1);
			$wemap_geoctype = $this->PFSAIssetControl('wemap_geoctype','','');

	        
	        $googlelvl1 = $this->PFSAIssetControl('googlelvl1','','1000');
			$googlelvl2 = $this->PFSAIssetControl('googlelvl2','','500');
			$googlelvl3 = $this->PFSAIssetControl('googlelvl3','','100');
			$wemap_here_appcode = $this->PFSAIssetControl('wemap_here_appcode','','');
			$setup5_mapsettings_zoom = $this->PFSAIssetControl('setup42_searchpagemap_zoom','','12');
			$st4_sp_medst = $this->PFSAIssetControl('st4_sp_medst','','0');

			switch ($stp5_mapty) {
				case 1:
					$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
					$we_special_key_google = $this->PFSAIssetControl('setup5_map_key','','');
	            case 3:
	            	$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
	                $we_special_key_mapbox = $this->PFSAIssetControl('stp5_mapboxpt','','');
	                break;

	            case 5:
	                $wemap_here_appid = $this->PFSAIssetControl('wemap_here_appid','','');
	                $wemap_here_appcode = $this->PFSAIssetControl('wemap_here_appcode','','');
	                $heremapslang = $this->PFSAIssetControl('heremapslang','','eng');
	                break;
	            case 4:
	            	$wemap_langy = $this->PFSAIssetControl('wemap_langy','','');
					$we_special_key_yandex = $this->PFSAIssetControl('wemap_yandexmap_api_key','','');

	            case 6:
	                $we_special_key_bing = $this->PFSAIssetControl('wemap_bingmap_api_key','','');
	                break;
	        }

	        switch ($wemap_geoctype) {
	        	case 'google':
	        		$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
					$we_special_key_google = $this->PFSAIssetControl('setup5_map_key','','');
	        		break;

	        	case 'yandex':
	        		$wemap_langy = $this->PFSAIssetControl('wemap_langy','','');
					$we_special_key_yandex = $this->PFSAIssetControl('wemap_yandexmap_api_key','','');
	        		break;

	        	case 'mapbox':
	        		$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
	        		$we_special_key_mapbox = $this->PFSAIssetControl('stp5_mapboxpt','','');
	        		break;

	        	case 'here':
	        		$heremapslang = $this->PFSAIssetControl('heremapslang','','eng');
	        		$wemap_here_appid = $this->PFSAIssetControl('wemap_here_appid','','');
	                $wemap_here_appcode = $this->PFSAIssetControl('wemap_here_appcode','','');
	        		break;
	        	
	        }

	        if (empty($we_special_key_google)) {
		     	$setup42_itempagedetails_configuration = $this->PFSAIssetControl('setup42_itempagedetails_configuration','','');
		        $pf_streetview_status = (isset($setup42_itempagedetails_configuration['streetview']['status']))?$setup42_itempagedetails_configuration['streetview']['status']:0;
		        if( $pf_streetview_status == 1 ){
		        	$maplanguage = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','en');
					$we_special_key_google = $this->PFSAIssetControl('setup5_map_key','','');
		        }
	        }

	        if (!empty($we_special_key_yandex)) {
	        	wp_register_script('theme-yandex-map', "https://api-maps.yandex.ru/2.1/?lang=".$wemap_langy."&apikey=".$we_special_key_yandex,array('jquery','theme-leafletjs'));
	        	wp_enqueue_script('theme-yandex-map');
	        }

	        if (!empty($we_special_key_google)) {
	        	wp_register_script('theme-google-api', "https://maps.googleapis.com/maps/api/js?key=$we_special_key_google&libraries=places&language=$maplanguage",array('jquery','theme-leafletjs'));
	        	wp_enqueue_script('theme-google-api');
	        }

			wp_register_script('theme-map-functionspf', PFCOREELEMENTSURLPUBLIC . 'js/theme-map-functions.js', array('jquery','theme-leafletjs'), '2.0',true);

			wp_enqueue_script('theme-map-functionspf');
			wp_localize_script( 'theme-map-functionspf', 'theme_map_functionspf', array(
				'ajaxurl' => PFCOREELEMENTSURLINC . 'pfajaxhandler.php',
				'template_directory' => PFCOREELEMENTSURL,
				'resizeword' => esc_html__('Resize','pointfindercoreelements'),
				'pfcurlang' => $this->PF_current_language(),
				'defmapdist' => $this->PFSAIssetControl('setup7_geolocation_distance','',10),
				'pfget_geocoding' => wp_create_nonce('pfget_geocoding'),
				'st4_sp_medst' => $st4_sp_medst,
				'googlelvl1' => $googlelvl1,
				'googlelvl2' => $googlelvl2,
				'googlelvl3' => $googlelvl3,
				'heremapslang' => $heremapslang,
				'wemap_here_appcode' => $wemap_here_appcode,
				'wemap_country3' => $wemap_country3,
				'we_special_key' => $we_special_key,
				'wemap_langy' => $wemap_langy,
				'we_special_key_yandex' => $we_special_key_yandex,
				'we_special_key_mapbox' => $we_special_key_mapbox,
				'we_special_key_google' => $we_special_key_google,
				'we_special_key_bing' => $we_special_key_bing,
				'wemap_langy' => $wemap_langy,
				'maplanguage' => $maplanguage,
				'wemap_country3' => $wemap_country3
			));
			
			wp_register_script('pointfinder-itempagescripts', PFCOREELEMENTSURLADMIN .'js/itempage.js', array('jquery','theme-map-functionspf','jquery.typeahead'), '1.0',true);
			wp_enqueue_script('pointfinder-itempagescripts');

			$setup13_mapcontrols_position = $this->PFSAIssetControl('setup13_mapcontrols_position','','1');
			$setup6_clustersettings_status = $this->PFSAIssetControl('setup6_clustersettings_status','',1);
			$setup45_status = $this->PFSAIssetControl('setup45_status','',1);
			$gesturehandling = $this->PFSAIssetControl('gesturehandling','',1);
			if ($gesturehandling == 1) {
				$gesturehandling_status = 'true';
			}else{
				$gesturehandling_status = 'false';
			}
			
			if ($setup13_mapcontrols_position == 1) {
				$setup13_mapcontrols_position = 'topleft';
			}else{
				$setup13_mapcontrols_position = 'topright';
			}

			

			wp_localize_script('pointfinder-itempagescripts', 'theme_scriptspf', array(
				'ajaxurl' => PFCOREELEMENTSURLINC . 'pfajaxhandler.php',
				'homeurl' => esc_url(home_url("/")),
				'fullscreen' => esc_html__('Fullscreen', 'pointfindercoreelements'),
				'fullscreenoff' => esc_html__('Exit Fullscreen', 'pointfindercoreelements'),
				'locateme' => esc_html__('Locate me!', 'pointfindercoreelements'),
				'locatefound' => esc_html__('You are here!', 'pointfindercoreelements'),
				'pfcurlang' => $this->PF_current_language(),
				'returnhome' => esc_html__("Return Home","pointfindercoreelements"),
				'lockunlock' => esc_html__("Lock Dragging","pointfindercoreelements"),
				'lockunlock2' => esc_html__("Unlock Dragging","pointfindercoreelements"),
				'getdirections' => esc_html__("Get Directions","pointfindercoreelements"),
				'pfget_geocoding' => wp_create_nonce('pfget_geocoding'),
				'bposition' => $setup13_mapcontrols_position,
				'clusterstatus' => $setup6_clustersettings_status,
				'ttstatus' => $setup45_status,
				'gesturehandling' => $gesturehandling_status
			));
		}

        


	}

	public function pointfinder_rest_prepare_function($response, $taxonomy){
		if ( in_array($taxonomy->name,array('pointfinderfeatures','pointfinderltypes','pointfinderconditions', 'pointfinderitypes')) ) {
			$response->data['visibility']['show_ui'] = false;
		}
		return $response;
	}

	public function create_post_type_pointfinder(){

	    /**
	    *Start: Get Admin Values
	    **/

	        $setup3_pointposttype_pt2 = $this->PFSAIssetControl('setup3_pointposttype_pt2','','PF Item');
	        $setup3_pointposttype_pt3 = $this->PFSAIssetControl('setup3_pointposttype_pt3','','PF Items');
	        $setup3_pointposttype_pt4 = $this->PFSAIssetControl('setup3_pointposttype_pt4','','Item Types');
	        $setup3_pointposttype_pt4s = $this->PFSAIssetControl('setup3_pointposttype_pt4s','','Item Type');
	        $setup3_pointposttype_pt4p = $this->PFSAIssetControl('setup3_pointposttype_pt4p','','types');
	        $setup3_pointposttype_pt5 = $this->PFSAIssetControl('setup3_pointposttype_pt5','','Locations');
	        $setup3_pointposttype_pt5s = $this->PFSAIssetControl('setup3_pointposttype_pt5s','','Location');
	        $setup3_pointposttype_pt5p = $this->PFSAIssetControl('setup3_pointposttype_pt5p','','area');
	        $setup3_pointposttype_pt6 = $this->PFSAIssetControl('setup3_pointposttype_pt6','','Features');
	        $setup3_pointposttype_pt6s = $this->PFSAIssetControl('setup3_pointposttype_pt6s','','Feature');
	        $setup3_pointposttype_pt6p = $this->PFSAIssetControl('setup3_pointposttype_pt6p','','feature');
	        $setup3_pointposttype_pt7 = $this->PFSAIssetControl('setup3_pointposttype_pt7','','Listing Types');
	        $setup3_pointposttype_pt7s = $this->PFSAIssetControl('setup3_pointposttype_pt7s','','Listing Type');
	        $setup3_pointposttype_pt7p = $this->PFSAIssetControl('setup3_pointposttype_pt7p','','listing');
	        $setup3_pointposttype_pt9 = $this->PFSAIssetControl('setup3_pointposttype_pt9','','PF Agent');
	        $setup3_pointposttype_pt10 = $this->PFSAIssetControl('setup3_pointposttype_pt10','','PF Agents');
	        $setup3_pointposttype_pt11 = $this->PFSAIssetControl('setup3_pointposttype_pt11','','testimonials');
	        $setup3_pointposttype_pt12 = $this->PFSAIssetControl('setup3_pointposttype_pt12','','PF Testimonials');
	        $setup3_pointposttype_pt13 = $this->PFSAIssetControl('setup3_pointposttype_pt13','','Testimonial');

	        $setup3_pt14 = $this->PFSAIssetControl('setup3_pt14','','Conditions');
	        $setup3_pt14s = $this->PFSAIssetControl('setup3_pt14s','','Condition');
	        $setup3_pt14p = $this->PFSAIssetControl('setup3_pt14p','','condition');
	        $setup3_pt14_check = $this->PFSAIssetControl('setup3_pt14_check','','0');

	        $setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
	        $setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
	        $setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');
	    /**
	    *End: Get Admin Values
	    **/


	    /**
	    *Start: Reviews Post Type
	    **/
	    	register_post_type('pointfinderreviews',
                array(
                'labels' => array(
                    'name' => esc_html__( 'PF Reviews', 'pointfindercoreelements' ),
                    'singular_name' => esc_html__( 'PF Review', 'pointfindercoreelements' ),
                    'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'edit' => esc_html__('Edit', 'pointfindercoreelements'),
                    'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                    'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),esc_html__( 'Review', 'pointfindercoreelements' )),
                ),
                'public' => true,
        		'menu_position' => 209,
        		'menu_icon' => 'dashicons-format-status',
                'hierarchical' => true,
        		'show_tagcloud' => false,
                'show_in_nav_menus' => false,
                'has_archive' => true,
                'supports' => array('title','editor'),
                'can_export' => true,
                'show_in_rest' => false,
        		'taxonomies' => array(),
        		'register_meta_box_cb' => array($this,'pointfinder_reviews_add_meta_box'),
            ));
	    	

	    /**
	    *End: Reviews Post Type
	    **/


	    /**
	    *Start: Orders Post Type
	    **/
	    	register_post_type('pointfinderorders',
                array(
                'labels' => array(
                    'name' => esc_html__( 'PF Orders', 'pointfindercoreelements' ),
                    'singular_name' => esc_html__( 'PF Order', 'pointfindercoreelements' ),
                    'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'edit' => esc_html__('Edit', 'pointfindercoreelements'),
                    'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),esc_html__( 'Orders', 'pointfindercoreelements' )),
                    'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                ),
                'public' => true,
        		'menu_position' => 208,
        		'menu_icon' => 'dashicons-feedback',
                'hierarchical' => true,
        		'show_tagcloud' => false,
                'show_in_nav_menus' => false,
                'has_archive' => true,
                'supports' => false,
                'can_export' => true,
        		'taxonomies' => array(),
        		//'register_meta_box_cb' => array($this,'pointfinder_orders_add_meta_box'),

            ));

	    /**
	    *End: Orders Post Type
	    **/

	    /**
	    *Start: Orders for membership Post Type
	    **/
	    	register_post_type('pointfindermorders',
                array(
                'labels' => array(
                    'name' => esc_html__( 'PF Orders', 'pointfindercoreelements' ),
                    'singular_name' => esc_html__( 'PF Order', 'pointfindercoreelements' ),
                    'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'edit' => esc_html__('Edit', 'pointfindercoreelements'),
                    'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),esc_html__( 'Orders', 'pointfindercoreelements' )),
                    'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                    'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),esc_html__( 'Order', 'pointfindercoreelements' )),
                ),
                'public' => true,
                'menu_position' => 208,
                'menu_icon' => 'dashicons-feedback',
                'hierarchical' => true,
                'show_tagcloud' => false,
                'show_in_nav_menus' => false,
                'has_archive' => true,
                'supports' => false,
                'can_export' => true,
                'taxonomies' => array(),
                'register_meta_box_cb' => array($this,'pointfinder_morders_add_meta_box'),

            ));

	    /**
	    *End: Orders for membership Post Type
	    **/

	    /**
	    *Start: Invoices Post Type
	    **/

	    	register_post_type('pointfinderinvoices',
                array(
                'labels' => array(
                    'name' => esc_html__( 'PF Invoices', 'pointfindercoreelements' ),
                    'singular_name' => esc_html__( 'PF Invoice', 'pointfindercoreelements' ),
                    'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'edit' => esc_html__('Edit', 'pointfindercoreelements'),
                    'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),esc_html__( 'Invoices', 'pointfindercoreelements' )),
                    'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                    'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),esc_html__( 'Invoice', 'pointfindercoreelements' )),
                ),
                'public' => true,
                'menu_position' => 210,
                'menu_icon' => 'dashicons-list-view',
                'hierarchical' => true,
                'show_tagcloud' => false,
                'show_in_nav_menus' => false,
                'has_archive' => true,
                'supports' => false,
                'can_export' => true,
                'taxonomies' => array(),
                'register_meta_box_cb' => array($this,'pointfinder_minvoices_add_meta_box'),

            ));

	        
	    /**
	    *End: Invoices Post Type
	    **/


	    /**
	    *Start: Testimonials Post Type
	    **/
	        register_post_type(''.$setup3_pointposttype_pt11.'',
	          array(
	          'labels' => array(
	              'name' => ''.$setup3_pointposttype_pt12.'',
	              'singular_name' => ''.$setup3_pointposttype_pt13.'',
	              'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'edit' => esc_html__('Edit', 'pointfindercoreelements'),
	              'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt12),
	              'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	              'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),$setup3_pointposttype_pt13),
	          ),
	          'public' => true,
	      		'menu_position' => 207,
	      		'menu_icon' => 'dashicons-format-chat',
	          'hierarchical' => true,
	      		'show_tagcloud' => false,
	          'show_in_nav_menus' => false,
	          'has_archive' => true,
	          'supports' => array(
	              'title',
	              'editor',
	          ),
	          'can_export' => true,
	      		'taxonomies' => array(),
	          'show_in_rest' => false,

	        ));
	    /**
	    *End: Testimonials Post Type
	    **/



	    /**
	    *Start: Agents Post Type
	    **/
	        
            register_post_type(''.$this->agent_post_type_name.'',
                array(
                'labels' => array(
                    'name' => ''.$setup3_pointposttype_pt10.'',
                    'singular_name' => ''.$setup3_pointposttype_pt9.'',
                    'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'edit' => esc_html__('Edit', 'pointfindercoreelements'),
                    'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt10),
                    'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                    'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),$setup3_pointposttype_pt9),
                ),
                'public' => true,
        		'menu_position' => 206,
        		'menu_icon' => 'dashicons-businessman',
                'hierarchical' => true,
        		'show_tagcloud' => false,
                'has_archive' => true,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'can_export' => true,
        		'taxonomies' => array(),
                'rewrite' => true,
                'show_in_rest' => false,

            ));

	    /**
	    *End: Agents Post Type
	    **/



	    /**
	    *Start: PF Items Post Type
	    **/
	      register_post_type(''.$this->post_type_name.'',
	        array(
	          'labels' => array(
	          'name' => ''.$setup3_pointposttype_pt3.'',
	          'singular_name' => ''.$setup3_pointposttype_pt2.'',
	          'add_new' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'edit' => esc_html__('Edit', 'pointfindercoreelements'),
	          'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'new_item' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'view' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'view_item' => wp_sprintf(esc_html__( 'View %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt3),
	          'not_found' => wp_sprintf(esc_html__( 'No %s found', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	          'not_found_in_trash' => wp_sprintf(esc_html__( 'No %s found in Trash', 'pointfindercoreelements' ),$setup3_pointposttype_pt2),
	        ),
	        'public' => true,
	        'menu_position' => 202,
	        'menu_icon' => 'dashicons-location-alt',
	        'hierarchical' => true,
	        'show_tagcloud' => false,
	        'has_archive' => true,
	        'supports' => array(
	          'title',
	          'editor',
	          'thumbnail',
	          'excerpt',
	          'page-attributes',
	          'tags'
	        ),
	        'can_export' => true,
	        'taxonomies' => array('post_tag'),
	        'show_in_rest' => false
	        ));
	    /**
	    *End: PF Items Post Type
	    **/



	    /**
	    *Start: Listing Types Taxonomy
	    **/
	    	  $labels = array(
	      		'name' => ''.$setup3_pointposttype_pt7.'',
	      		'singular_name' => ''.$setup3_pointposttype_pt7s.'',
	      		'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7),
	      		'popular_items' => wp_sprintf(esc_html__( 'Popular %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7),
	      		'all_items' => wp_sprintf(esc_html__( 'All %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7),
	      		'parent_item' => null,
	      		'parent_item_colon' => null,
	      		'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'update_item' => wp_sprintf(esc_html__( 'Update %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'new_item_name' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'separate_items_with_commas' => wp_sprintf(esc_html__( 'Separate %s with commas', 'pointfindercoreelements' ),$setup3_pointposttype_pt7),
	      		'add_or_remove_items' => wp_sprintf(esc_html__( 'Add or remove %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'choose_from_most_used' => wp_sprintf(esc_html__( 'Choose from the most used %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt7s),
	      		'menu_name' => ''.$setup3_pointposttype_pt7.'',
	    	  );


	    	  register_taxonomy('pointfinderltypes',''.$this->post_type_name.'',array(
	        		'hierarchical' => true,
	        		'labels' => $labels,
	        		'show_ui' => true,
	        		'show_admin_column' => true,
	                'show_in_nav_menus' => true,
	        		'update_count_callback' => '_update_post_term_count',
	        		'query_var' => true,
	        		'rewrite' => array( 'slug' => $setup3_pointposttype_pt7p,'hierarchical'=>true ),
	        		'sort' => true,
	            'show_in_rest' => false
	    	  ));
	    /**
	    *End: Listing Types Taxonomy
	    **/



	    /**
	    *Start: Item Types Taxonomy
	    **/
	        if($setup3_pointposttype_pt4_check == 1){
	        	  $labels = array(
	        		'name' => ''.$setup3_pointposttype_pt4.'',
	        		'singular_name' => ''.$setup3_pointposttype_pt4.'',
	        		'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4),
	        		'popular_items' => wp_sprintf(esc_html__( 'Popular %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4),
	        		'all_items' => wp_sprintf(esc_html__( 'All %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4),
	        		'parent_item' => null,
	        		'parent_item_colon' => null,
	        		'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'update_item' => wp_sprintf(esc_html__( 'Update %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'new_item_name' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'separate_items_with_commas' => wp_sprintf(esc_html__( 'Separate %s with commas', 'pointfindercoreelements' ),$setup3_pointposttype_pt4),
	        		'add_or_remove_items' => wp_sprintf(esc_html__( 'Add or remove %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'choose_from_most_used' => wp_sprintf(esc_html__( 'Choose from the most used %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt4s),
	        		'menu_name' => ''.$setup3_pointposttype_pt4.'',
	        	  );


	        	  register_taxonomy('pointfinderitypes',''.$this->post_type_name.'',array(
	                'show_in_nav_menus' => true,
	        		'hierarchical' => true,
	        		'labels' => $labels,
	        		'show_ui' => true,
	        		'show_admin_column' => false,
	                'show_in_nav_menus' => true,
	        		'update_count_callback' => '_update_post_term_count',
	        		'query_var' => true,
	        		'rewrite' => array( 'slug' => $setup3_pointposttype_pt4p,'hierarchical'=>true),
	        		'sort' => true,
	                'show_in_rest' => false
	        	  ));
	        }
	    /**
	    *End: Item Types Taxonomy
	    **/



	    /**
	    *Start: Locations Taxonomy
	    **/
	        if($setup3_pointposttype_pt5_check == 1){
	        	  $labels = array(
	        		'name' => ''.$setup3_pointposttype_pt5.'',
	        		'singular_name' => ''.$setup3_pointposttype_pt5.'',
	        		'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5),
	        		'popular_items' => wp_sprintf(esc_html__( 'Popular %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5),
	        		'all_items' => wp_sprintf(esc_html__( 'All %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5),
	        		'parent_item' => null,
	        		'parent_item_colon' => null,
	        		'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'update_item' => wp_sprintf(esc_html__( 'Update %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'new_item_name' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'separate_items_with_commas' => wp_sprintf(esc_html__( 'Separate %s with commas', 'pointfindercoreelements' ),$setup3_pointposttype_pt5),
	        		'add_or_remove_items' => wp_sprintf(esc_html__( 'Add or remove %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'choose_from_most_used' => wp_sprintf(esc_html__( 'Choose from the most used %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt5s),
	        		'menu_name' => ''.$setup3_pointposttype_pt5.'',
	        	  );

	        	  register_taxonomy('pointfinderlocations',''.$this->post_type_name.'',array(
	        		'hierarchical' => true,
	        		'labels' => $labels,
	        		'show_ui' => true,
	        		'show_admin_column' => false,
	                'show_in_nav_menus' => true,
	        		'update_count_callback' => '_update_post_term_count',
	        		'query_var' => true,
	        		'rewrite' => array( 'slug' => $setup3_pointposttype_pt5p,'hierarchical'=>true ),
	                'show_in_rest' => false
	        	  ));

	        }
	    /**
	    *End: Locations Taxonomy
	    **/



	    /**
	    *Start: Features Taxonomy
	    **/

	        if($setup3_pointposttype_pt6_check == 1){
	        	  $labels = array(
	        		'name' => ''.$setup3_pointposttype_pt6.'',
	        		'singular_name' => ''.$setup3_pointposttype_pt6.'',
	        		'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6),
	        		'popular_items' => wp_sprintf(esc_html__( 'Popular %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6),
	        		'all_items' => wp_sprintf(esc_html__( 'All %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6),
	        		'parent_item' => null,
	        		'parent_item_colon' => null,
	        		'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'update_item' => wp_sprintf(esc_html__( 'Update %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'new_item_name' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'separate_items_with_commas' => wp_sprintf(esc_html__( 'Separate %s with commas', 'pointfindercoreelements' ),$setup3_pointposttype_pt6),
	        		'add_or_remove_items' => wp_sprintf(esc_html__( 'Add or remove %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'choose_from_most_used' => wp_sprintf(esc_html__( 'Choose from the most used %s', 'pointfindercoreelements' ),$setup3_pointposttype_pt6s),
	        		'menu_name' => ''.$setup3_pointposttype_pt6.'',
	        	  );

	        	  register_taxonomy('pointfinderfeatures',''.$this->post_type_name.'',array(
	        		'hierarchical' => true,
	        		'labels' => $labels,
	        		'show_ui' => true,
	        		'show_admin_column' => false,
	                'show_in_nav_menus' => true,
	        		'update_count_callback' => '_update_post_term_count',
	        		'query_var' => true,
	        		'rewrite' => array( 'slug' => $setup3_pointposttype_pt6p,'hierarchical'=>true ),
	                'show_in_rest' => false
	        	  ));


	        	}

	    /**
	    *End: Features Taxonomy
	    **/



	    /**
	    *Start: Conditions Taxonomy
	    **/

	        if($setup3_pt14_check == 1){
	              $labels = array(
	                'name' => ''.$setup3_pt14.'',
	                'singular_name' => ''.$setup3_pt14.'',
	                'search_items' =>  wp_sprintf(esc_html__( 'Search %s', 'pointfindercoreelements' ),$setup3_pt14),
	                'popular_items' => wp_sprintf(esc_html__( 'Popular %s', 'pointfindercoreelements' ),$setup3_pt14),
	                'all_items' => wp_sprintf(esc_html__( 'All %s', 'pointfindercoreelements' ),$setup3_pt14),
	                'parent_item' => null,
	                'parent_item_colon' => null,
	                'edit_item' => wp_sprintf(esc_html__( 'Edit %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'update_item' => wp_sprintf(esc_html__( 'Update %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'add_new_item' => wp_sprintf(esc_html__( 'Add New %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'new_item_name' => wp_sprintf(esc_html__( 'New %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'separate_items_with_commas' => wp_sprintf(esc_html__( 'Separate %s with commas', 'pointfindercoreelements' ),$setup3_pt14),
	                'add_or_remove_items' => wp_sprintf(esc_html__( 'Add or remove %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'choose_from_most_used' => wp_sprintf(esc_html__( 'Choose from the most used %s', 'pointfindercoreelements' ),$setup3_pt14s),
	                'menu_name' => ''.$setup3_pt14.'',
	              );

	              register_taxonomy('pointfinderconditions',''.$this->post_type_name.'',array(
	                'hierarchical' => true,
	                'labels' => $labels,
	                'show_ui' => true,
	                'show_admin_column' => false,
	                'show_in_nav_menus' => true,
	                'update_count_callback' => '_update_post_term_count',
	                'query_var' => true,
	                'rewrite' => array( 'slug' => $setup3_pt14p,'hierarchical'=>true ),
	                'show_in_rest' => false
	              ));


	            }

	    /**
	    *End: Conditions Taxonomy
	    **/


	}

	public function pf_custom_post_status(){

		register_post_status( 'pendingapproval', array(
			'label'                     => esc_html__( 'Pending Approval', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Pending Approval <span class="count">(%s)</span>', 'Pending Approval <span class="count">(%s)</span>' , 'pointfindercoreelements'),
		) );

		register_post_status( 'rejected', array(
			'label'                     => esc_html__( 'Rejected', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Rejected <span class="count">(%s)</span>', 'Rejected <span class="count">(%s)</span>' , 'pointfindercoreelements'),
		) );


		register_post_status( 'pendingpayment', array(
			'label'                     => esc_html__( 'Pending Payment', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Pending Payment <span class="count">(%s)</span>', 'Pending Payment <span class="count">(%s)</span>' , 'pointfindercoreelements'),
		) );

		register_post_status( 'completed', array(
			'label'                     => esc_html__( 'Payment Completed', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Payment Completed <span class="count">(%s)</span>', 'Payment Completed <span class="count">(%s)</span>', 'pointfindercoreelements' ),
		) );

		register_post_status( 'pfcancelled', array(
			'label'                     => esc_html__( 'Payment Cancelled', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Payment Cancelled <span class="count">(%s)</span>', 'Payment Cancelled <span class="count">(%s)</span>', 'pointfindercoreelements' ),
		) );

		register_post_status( 'pfsuspended', array(
			'label'                     => esc_html__( 'Payment Suspended', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Payment Suspended <span class="count">(%s)</span>', 'Payment Suspended <span class="count">(%s)</span>', 'pointfindercoreelements' ),
		) );

		register_post_status( 'pfonoff', array(
			'label'                     => esc_html__( 'Deactived by User', 'pointfindercoreelements' ),
			'public'                    => true,
			'exclude_from_search'       => true,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count'               => _n_noop( 'Deactived by User <span class="count">(%s)</span>', 'Deactived by User <span class="count">(%s)</span>', 'pointfindercoreelements' ),
		) );
	}

	public function pfconditions_remove_parent_category(){
			if ( 'pointfinderconditions' != $_GET['taxonomy'] ){
					return;
                        }

			$parent = 'parent()';

			if ( isset( $_GET['action'] ) ){
					$parent = 'parent().parent()';

			?>
					<script type="text/javascript">
							jQuery(document).ready(function($)
							{
									$('label[for=parent]').<?php echo esc_html($parent); ?>.remove();
							});
					</script>
			<?php
                        }
	}

	public function pointfinder_remove_submenu_cpts() {
			global $submenu;
			unset($submenu['edit.php?post_type=pointfinderinvoices'][10]);
			unset($submenu['edit.php?post_type=pointfindermorders'][10]);
			unset($submenu['edit.php?post_type=pointfinderorders'][10]);
			unset($submenu['edit.php?post_type=pointfinderreviews'][10]);
	}

	public function pointfinder_remove_unwanted_cpts(){
			$screen = get_current_screen();

			if (isset($screen->post_type)) {
					switch ($screen->post_type) {
							case 'pointfinderorders':
									echo '<style type="text/css">#titlediv{margin-bottom: 10px;}.row-actions .view {display:none;}.wrap .page-title-action{display:none;}</style>';
									break;
							case 'pointfindermorders':
									echo '<style type="text/css">#titlediv{margin-bottom: 10px;}.row-actions .view {display:none;}.wrap .page-title-action{display:none;}</style>';
									break;
							case 'pointfinderreviews':
									echo '<style type="text/css">#titlediv{margin-bottom: 10px;}#edit-slug-box{display: none;}#favorite-actions {display:none;}.wrap .page-title-action{display:none;}.tablenav .bulkactions{display:none;}</style>';
									break;

					}
			}

	}

	public function pointfinder_remove_unwanted_pra($actions, $page_object){
			global $post;

			$setup3_pointposttype_pt11 = $this->PFSAIssetControl('setup3_pointposttype_pt11','','pftestimonials');
			switch ($page_object->post_type) {
					case 'pointfindermorders':
					case 'pointfinderorders':
					case 'pointfinderinvoices':
							unset($actions['edit']);unset($actions['inline hide-if-no-js']);unset($actions['edit_as_new_draft']);
							break;
					case 'pointfinderreviews':
							unset($actions['view']);
							unset($actions['inline hide-if-no-js']);
							unset($actions['edit_as_new_draft']);
							unset( $actions['trash'] );
							$actions['trash'] = "<a class='submitdelete' title='" . esc_attr(esc_html__('Delete this item permanently','pointfindercoreelements')) . "' href='" . get_delete_post_link($post->ID, '', true) . "'>" . esc_html__('Delete','pointfindercoreelements') . "</a>";
							if ($post->post_status == 'pendingapproval') {
									$actions['view'] = "<a class='submitdelete' title='" . esc_attr(esc_html__('Publish this item permanently','pointfindercoreelements')) . "' href='" . admin_url("edit.php?post_type=pointfinderreviews&publishrevid=".$post->ID) . "'>" . esc_html__('Publish','pointfindercoreelements') . "</a>";
							}
							break;
					case $setup3_pointposttype_pt11:
							unset($actions['view']);
							break;
					case $this->post_type_name:
							if ($post->post_status == 'pendingapproval' || $post->post_status == 'pendingpayment' || $post->post_status == 'rejected') {
									$actions['inline'] = "<a class='submitdelete' title='" . esc_attr(esc_html__('Publish this item permanently','pointfindercoreelements')) . "' href='" . admin_url("edit.php?post_type=".$this->post_type_name."&publishitemid=".$post->ID) . "'>" . esc_html__('Publish','pointfindercoreelements') . "</a>";
							}

							if ($post->post_status == 'pendingapproval' || $post->post_status == 'pendingpayment' || $post->post_status == 'publish') {
									$actions['reject'] = "<span class='trash'><a class='submitdelete' title='" . esc_attr(esc_html__('Reject this item permanently','pointfindercoreelements')) . "' href='" . admin_url("edit.php?post_type=".$this->post_type_name."&rejectitemid=".$post->ID) . "'>" . esc_html__('Reject','pointfindercoreelements') . "</a></span>";
							}
							break;
			}
			return $actions;
	}

	public function pointfinder_unwanted_remove_meta_box($post_type) {

			switch ($post_type) {
					case 'pfmembershippacks':
							remove_meta_box( 'mymetabox_revslider_0', 'pfmembershippacks', 'normal' );
							break;
					case 'pointfinderorders':
							remove_meta_box( 'submitdiv', 'pointfinderorders','side');
							remove_meta_box( 'slugdiv', 'pointfinderorders','normal');
							remove_meta_box( 'mymetabox_revslider_0', 'pointfinderorders', 'normal' );
							break;
					case 'pointfindermorders':
							remove_meta_box( 'submitdiv', 'pointfindermorders','side');
							remove_meta_box( 'slugdiv', 'pointfindermorders','normal');
							remove_meta_box( 'mymetabox_revslider_0', 'pointfindermorders', 'normal' );
							break;
					case $this->post_type_name:
							remove_meta_box( 'authordiv', $this->post_type_name, 'normal' );
							remove_meta_box( 'mymetabox_revslider_0', $this->post_type_name, 'normal' );
							break;
					case 'pointfinderreviews':
							remove_meta_box( 'submitdiv', 'pointfinderreviews','side');
							remove_meta_box( 'slugdiv', 'pointfinderreviews','normal');
							remove_meta_box( 'mymetabox_revslider_0', 'pointfinderreviews', 'normal' );
							break;
					case 'pointfinderinvoices':
							remove_meta_box( 'submitdiv', 'pointfinderinvoices','side');
							remove_meta_box( 'slugdiv', 'pointfinderinvoices','normal');
							remove_meta_box( 'mymetabox_revslider_0', 'pointfinderinvoices', 'normal' );
							break;
			}
	}

	public function pointfinder_disable_months_dropdown($disable, $post_type){
		if ($this->post_type_name == $post_type) {
			return true;
		}
		return $disable;
	}

	public function pointfinder_admin_body_class($classes){
		global $typenow;
		if ($this->post_type_name == $typenow) {
			$classes .= ' pointfinderlistingspage';
		}
		return $classes;
	}

	public function pointfinder_admin_head_custompost_listing() {
			global $post_type;

			/* Main post type filters */
			if($post_type == $this->post_type_name){
					$setup3_pointposttype_pt4_check = $this->PFSAIssetControl('setup3_pointposttype_pt4_check','','1');
					$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
					$setup3_pointposttype_pt6_check = $this->PFSAIssetControl('setup3_pointposttype_pt6_check','','1');
					$setup3_pt14_check = $this->PFSAIssetControl('setup3_pt14_check','','1');
					
					$pftaxarray = array('pointfinderltypes');
					if($setup3_pointposttype_pt4_check == 1){$pftaxarray[] = 'pointfinderitypes';}
					if($setup3_pointposttype_pt5_check == 1){$pftaxarray[] = 'pointfinderlocations';}
					if($setup3_pointposttype_pt6_check == 1){$pftaxarray[] = 'pointfinderfeatures';}
					if($setup3_pt14_check == 1){$pftaxarray[] = 'pointfinderconditions';}
							
					new Tax_CTP_Filter(array($this->post_type_name => $pftaxarray));
					

					/* One click item approval */
					if (isset($_GET['publishitemid']) && current_user_can( 'activate_plugins' )) {
						 if (!empty($_GET['publishitemid'])) {
									$itemid = sanitize_text_field($_GET['publishitemid']);
									if (get_post_status($itemid) != 'publish') {
											wp_update_post(array('ID' => $itemid, 'post_status' => 'publish'));
									}
						 }
					}

					/* One click item reject */
					if (isset($_GET['rejectitemid']) && current_user_can( 'activate_plugins' )) {
						 if (!empty($_GET['rejectitemid'])) {
									$itemid = sanitize_text_field($_GET['rejectitemid']);
									if (get_post_status($itemid) != 'rejected') {
											wp_update_post(array('ID' => $itemid, 'post_status' => 'rejected'));
									}
						 }
					}

			}

			/* One click review approval */
			if ($post_type == 'pointfinderreviews') {
					if (isset($_GET['publishrevid']) && current_user_can( 'activate_plugins' )) {
						 if (!empty($_GET['publishrevid'])) {
									$revid = sanitize_text_field($_GET['publishrevid']);
									if (get_post_status($revid) != 'publish') {
											wp_update_post(array('ID' => $revid, 'post_status' => 'publish'));
									}
						 }
					}
			}

	}


	public function pointfinder_widgets_initialization(){
	    register_widget( 'pf_recent_items_w' );
	    register_widget( 'pf_featured_items_w' );
	    register_widget( 'pf_search_items_w' );
	    register_widget( 'pf_twitter_w' );
	    register_widget( 'pf_featured_agents_w' );
	}

	public function pointfinder_query_cleanup_filter($args){

		if (isset($args['meta_query'])) {
			if (empty($args['meta_query'])) {
				unset($args['meta_query']);
			}
		}
		if (isset($args['tax_query'])) {
			if (empty($args['tax_query'])) {
				unset($args['tax_query']);
			}
		}

		if (isset($pfgetdata['manual_args']['meta_query'])) {
			if (empty($pfgetdata['manual_args']['meta_query'])) {
				unset($pfgetdata['manual_args']['meta_query']);
			}
		}
		if (isset($pfgetdata['manual_args']['tax_query'])) {
			if (empty($pfgetdata['manual_args']['tax_query'])) {
				unset($pfgetdata['manual_args']['tax_query']);
			}
		}
		return $args;
	}

	public function pointfinder_custompoints_filter(){

		$st8_npsys = $this->PFASSIssetControl('st8_npsys','',0);
		$st8_nasys = $this->PFASSIssetControl('st8_nasys','',0);
		

		if (absint($st8_npsys) != 1 && class_exists('ReduxFramework', false) && class_exists('PointFinderNewOptionsHelper') ) {
			require_once PFCOREELEMENTSDIR . 'admin/newoptions/pointfinder-custompoints-options.php';
		}
		if (absint($st8_nasys) != 1 && class_exists('ReduxFramework', false) && class_exists('PointFinderNewOptionsHelper') ) {
			require_once PFCOREELEMENTSDIR . 'admin/newoptions/pointfinder-advancedlt-options.php';
		}
	}


	public function pointfinder2_TAX_register_taxonomy_meta_boxes()
	{
		
		$pf_extra_taxonomyfields = array();

		/*For locations*/
			$setup3_pointposttype_pt5_check = $this->PFSAIssetControl('setup3_pointposttype_pt5_check','','1');
			if ($setup3_pointposttype_pt5_check == 1) {
				$pf_extra_taxonomyfields[] = array(
					'title' => esc_html__('Coordinates for This Location','pointfindercoreelements'),			
					'taxonomies' => array('pointfinderlocations'),			
					'id' => 'pointfinderlocations_vars',					
					
					'fields' => array(							
						array(
							'name' => esc_html__('Lat Coordinate','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__('This coordinate for lat point. %sPlease click here for find your coordinates','pointfindercoreelements'),'<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">','</a>'),
							'id' => 'pf_lat_of_location',
							'type' => 'text'						
						),
						
						
						array(
							'name' => esc_html__('Lng Coordinate','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__('This coordinate for lat point. %sPlease click here for find your coordinates','pointfindercoreelements'),'<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">','</a>'),
							'id' => 'pf_lng_of_location',
							'type' => 'text'						
						),
						
					)
				);

				$pf_extra_taxonomyfields[] = array(
					'title' => esc_html__("WPBakery Page Builder : Location List Specifications",'pointfindercoreelements'),			
					'taxonomies' => array('pointfinderlocations'),			
					'id' => 'pointfinderlocationsex_vars',					
					
					'fields' => array(

						array(
							'name' => esc_html__('FontAwesome Icon','pointfindercoreelements').'<small> '.esc_html__('(NEW)','pointfindercoreelements').'</small>',
							'id'   => 'pf_icon_of_listingfs',
							'type' => 'text',
							'desc' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>'),
						),					
						array(
							'name' => esc_html__('Category Background Color','pointfindercoreelements'),
							'id'   => 'pf_catbg_of_listing',
							'type' => 'color',
						),
						array(
							'name' => esc_html__('Category Text Color','pointfindercoreelements'),
							'id'   => 'pf_cattext_of_listing',
							'type' => 'color',
						),
						array(
							'name' => esc_html__('Category Text Hover Color','pointfindercoreelements'),
							'id'   => 'pf_cattext2_of_listing',
							'type' => 'color',
						)
						
					)
				);

				$pf_extra_taxonomyfields[] = array(
					'title' => esc_html__("WPBakery Page Builder : Image Grid Settings",'pointfindercoreelements'),			
					'taxonomies' => array('pointfinderlocations'),			
					'id' => 'pointfinderlocationsex2_vars',
					'fields' => array(					
						array(
							'name' => esc_html__('Icon Image','pointfindercoreelements'),
							'id'   => 'pf_icon_of_listing',
							'type' => 'image',
						),
						array(
							'name' => esc_html__('FontAwesome Icon','pointfindercoreelements').'<small> '.esc_html__('(NEW)','pointfindercoreelements').'</small>',
							'id'   => 'pf_icon_of_listingfs2',
							'type' => 'text',
							'desc' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>'),
						),
						array(
							'name' => esc_html__('Grid Gallery Image','pointfindercoreelements'),
							'id'   => 'pf_timage_of_listing',
							'type' => 'image',
						),
						array(
							'name' => esc_html__('Grid Gallery Size','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__('Please select grid gallery size for masonry tiled gallery.','pointfindercoreelements'),'<br/>'),
							'id'   => 'pf_masonry_size',
							'type' => 'radio',
							'options' => array(
								'large' => esc_html__('Large','pointfindercoreelements'),
								'wide' => esc_html__('Wide','pointfindercoreelements'),
								'box' => esc_html__('Box','pointfindercoreelements')
								),
							'std'  => 'box',
						),
						
					)
				);
			}


		/*For listing Types*/
		
			if ($this->PFASSIssetControl('st8_npsys','',0) == 1) {
				$pf_extra_taxonomyfields[] = array(
					'title' => esc_html__('Listing Type Point Style Settings','pointfindercoreelements'),			
					'taxonomies' => array('pointfinderltypes'),			
					'id' => 'pointfinderltypes_style_vars',
					'parentonly' => false,				
					'fields' => array(	
						array(
							'name' => esc_html__('Point Type','pointfindercoreelements'),
							'id'   => 'cpoint_type',
							'type' => 'radio',
							'options' => array(
								'0' => esc_html__('Not Selected','pointfindercoreelements'),
								'1' => esc_html__('Custom Image','pointfindercoreelements'),
								'2' => esc_html__('Predefined Icon','pointfindercoreelements')
								),
							'std'  => 0,
						),

						array(
							'name' => esc_html__('Icon Image','pointfindercoreelements'),
							'id'   => 'cpoint_bgimage',
							'type' => 'image',
						),
						
						array(
							'name' => esc_html__('Point Icon Type','pointfindercoreelements'),
							'id'   => 'cpoint_icontype',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Round','pointfindercoreelements'), 
								'2' => esc_html__('Square','pointfindercoreelements'),
								'3' => esc_html__('Dot','pointfindercoreelements')
							),
							'std'  => 1,
						),
						array(
							'name' => esc_html__('Point Icon Size','pointfindercoreelements'),
							'id'   => 'cpoint_iconsize',
							'type' => 'radio',
							'options' => array(
								'small' => esc_html__('Small','pointfindercoreelements'), 
								'middle' => esc_html__('Middle','pointfindercoreelements'), 
								'large' => esc_html__('Large','pointfindercoreelements'), 
								'xlarge' => esc_html__('X-Large','pointfindercoreelements')
							),
							'std'  => 'middle',
						),
						array(
							'name' => esc_html__("Point Color",'pointfindercoreelements'),
							'id'   => 'cpoint_bgcolor',
							'type' => 'color',
						),
						array(
							'name' => esc_html__("Point Inner Color",'pointfindercoreelements'),
							'id'   => 'cpoint_bgcolorinner',
							'type' => 'color',
						),
						array(
							'name' => esc_html__("Point Icon Color",'pointfindercoreelements'),
							'id'   => 'cpoint_iconcolor',
							'type' => 'color',
						),
						array(
							'name' => esc_html__('Point FontAwesome Icon','pointfindercoreelements').'<small> '.esc_html__('(NEW)','pointfindercoreelements').'</small>',
							'id'   => 'cpoint_iconnamefs',
							'type' => 'text',
							'desc' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>').'<br>'.esc_html__('Note, you can leave an unselected predefined icon section if you want to use the FontAwesome icon.','pointfindercoreelements'),
						),
						array(
							'name' => esc_html__('Point Predefined Icon','pointfindercoreelements'),
							'id'   => 'cpoint_iconname',
							'type' => 'iconselector',
							'std'  => '',
						)
					)
				);
			}


			$pf_extra_taxonomyfields[] = array(
				'title' => esc_html__('Listing Type Page Standart Default Settings','pointfindercoreelements'),			
				'taxonomies' => array('pointfinderltypes'),			
				'id' => 'pointfinderltypesas_vars',
				'parentonly' => true,				
				'fields' => array(	
					array(
						'name' => esc_html__('Header Type','pointfindercoreelements'),
						'desc' => wp_sprintf(esc_html__("If this option enabled, Pointfinder will change default header to your selection.",'pointfindercoreelements'),'<br/>'),
						'id'   => 'pf_cat_imagebg',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__("Image Background",'pointfindercoreelements'),
							'2' => esc_html__("Standard Header",'pointfindercoreelements'),
							'3' => esc_html__("No Header",'pointfindercoreelements')
							),
						'std'  => 2,
					),
					array(
						'name' => esc_html__("Header Height",'pointfindercoreelements'),
						'desc' => esc_html__("Only numeric! Ex: 100",'pointfindercoreelements'),
						'id'   => 'pf_cat_headerheight',
						'type' => 'text',
						'std'  => 140,
					),
					array(
						'name' => esc_html__("Category Text Color",'pointfindercoreelements'),
						'id'   => 'pf_cat_textcolor',
						'type' => 'color',
					),
					array(
						'name' => esc_html__("Category Background Color",'pointfindercoreelements'),
						'id'   => 'pf_cat_backcolor',
						'type' => 'color',
					),
					array(
						'name' => esc_html__("Background Image",'pointfindercoreelements'),
						'id'   => 'pf_cat_bgimg',
						'type' => 'image',
					),
					array(
						'name'    => esc_html__("Background Repeat",'pointfindercoreelements'),
						'id'      => 'pf_cat_bgrepeat',
						'type'    => 'select',
						'options' => array(
							'repeat' => esc_html__("Repeat",'pointfindercoreelements'),
							'no-repeat' => esc_html__("No Repeat",'pointfindercoreelements')
						),
					),
					array(
						'name'    => esc_html__("Background Size",'pointfindercoreelements'),
						'id'      => 'pf_cat_bgsize',
						'type'    => 'select',
						'options' => array(
							'cover' => esc_html__("Cover",'pointfindercoreelements'),
							'contain' => esc_html__("Contain",'pointfindercoreelements'),
							'inherit' => esc_html__("Inherit",'pointfindercoreelements')
						),
					),
					array(
						'name'    => esc_html__("Background Position",'pointfindercoreelements'),
						'id'      => 'pf_cat_bgpos',
						'type'    => 'select',
						'options' => array(
							'left top' => esc_html__("Left Top",'pointfindercoreelements'),
							'left center' => esc_html__("Left center",'pointfindercoreelements'),
							'left bottom' => esc_html__("Left Bottom",'pointfindercoreelements'),
							'center top' => esc_html__("Center Top",'pointfindercoreelements'),
							'center center' => esc_html__("Center Center",'pointfindercoreelements'),
							'center bottom' => esc_html__("Center Bottom",'pointfindercoreelements'),
							'right top' => esc_html__("Right Top",'pointfindercoreelements'),
							'right center' => esc_html__("Right center",'pointfindercoreelements'),
							'right bottom' => esc_html__("Right Bottom",'pointfindercoreelements')
						),
					),
				)
			);

			$pf_extra_taxonomyfields[] = array(
				'title' => esc_html__('WPBakery Page Builder : Directory List & Image Grid Settings','pointfindercoreelements'),			
				'taxonomies' => array('pointfinderltypes'),			
				'id' => 'pointfinderltypes_vars',
				'parentonly' => true,				
				'fields' => array(	
					array(
						'name' => esc_html__('Icon Image','pointfindercoreelements'),
						'id'   => 'pf_icon_of_listing',
						'type' => 'image',
					),
					array(
						'name' => esc_html__('FontAwesome Icon','pointfindercoreelements').'<small> '.esc_html__('(NEW)','pointfindercoreelements').'</small>',
						'id'   => 'pf_icon_of_listingfs',
						'type' => 'text',
						'desc' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>'),
					),
					array(
						'name' => esc_html__('Icon Width','pointfindercoreelements'),
						'desc' => esc_html__('Please write only number.','pointfindercoreelements'),
						'id'   => 'pf_iconwidth_of_listing',
						'type' => 'text',
						'std'  => 20,
					),
					array(
						'name' => esc_html__('Category Background Color','pointfindercoreelements'),
						'id'   => 'pf_catbg_of_listing',
						'type' => 'color',
					),
					array(
						'name' => esc_html__('Category Text Color','pointfindercoreelements'),
						'id'   => 'pf_cattext_of_listing',
						'type' => 'color',
					),
					array(
						'name' => esc_html__('Category Text Hover Color','pointfindercoreelements'),
						'id'   => 'pf_cattext2_of_listing',
						'type' => 'color',
					),
					array(
						'name' => esc_html__('Grid Gallery Image','pointfindercoreelements'),
						'id'   => 'pf_timage_of_listing',
						'type' => 'image',
					),
					array(
						'name' => esc_html__('Grid Gallery Size','pointfindercoreelements'),
						'desc' => wp_sprintf(esc_html__('Please select grid gallery size for masonry tiled gallery.','pointfindercoreelements'),'<br/>'),
						'id'   => 'pf_masonry_size',
						'type' => 'radio',
						'options' => array(
							'large' => esc_html__('Large','pointfindercoreelements'),
							'wide' => esc_html__('Wide','pointfindercoreelements'),
							'box' => esc_html__('Box','pointfindercoreelements')
							),
						'std'  => 'box',
					)
				)
			);

			$pf_extra_taxonomyfields[] = array(
				'title' => esc_html__('Frontend Upload Form Settings','pointfindercoreelements'),			
				'taxonomies' => array('pointfinderltypes'),			
				'id' => 'pointfinderltypes_fevars',
				'parentonly' => true,			
				'fields' => array(	
					array(
						'name' => esc_html__('Address Area','pointfindercoreelements'),
						'desc' => esc_html__('Hide Address Area from frontend form.','pointfindercoreelements'),
						'id'   => 'pf_address_area',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Show','pointfindercoreelements'),
							'2' => esc_html__('Hide','pointfindercoreelements')
							),
						'std'  => 1,
					),
					array(
						'name' => esc_html__('Location Area','pointfindercoreelements'),
						'desc' => esc_html__('Hide Location Area from frontend form.','pointfindercoreelements'),
						'id'   => 'pf_location_area',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Show','pointfindercoreelements'),
							'2' => esc_html__('Hide','pointfindercoreelements')
							),
						'std'  => 1,
					),
					array(
						'name' => esc_html__('Image Upload Area','pointfindercoreelements'),
						'desc' => esc_html__('Hide Image Upload Area from frontend form.','pointfindercoreelements'),
						'id'   => 'pf_image_area',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Show','pointfindercoreelements'),
							'2' => esc_html__('Hide','pointfindercoreelements')
							),
						'std'  => 1,
					),
					array(
						'name' => esc_html__('Header Image Upload Area','pointfindercoreelements'),
						'desc' => esc_html__('Hide Image Upload Area from frontend form.','pointfindercoreelements'),
						'id'   => 'pf_header_area',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Show','pointfindercoreelements'),
							'2' => esc_html__('Hide','pointfindercoreelements')
							),
						'std'  => 1,
					),
					array(
						'name' => esc_html__('File Upload Area','pointfindercoreelements'),
						'desc' => esc_html__('Hide File Upload Area from frontend form.','pointfindercoreelements'),
						'id'   => 'pf_file_area',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Show','pointfindercoreelements'),
							'2' => esc_html__('Hide','pointfindercoreelements')
							),
						'std'  => 1,
					)
				)
			);

			$pf_extra_taxonomyfields[] = array(
				'title' => esc_html__('Listing Type Additional Settings','pointfindercoreelements'),			
				'taxonomies' => array('pointfinderltypes'),			
				'id' => 'pointfinderltypes_covars',	
				'parentonly' => true,					
				'fields' => array(	
					array(
						'name' => esc_html__('Price','pointfindercoreelements'),
						'desc' => wp_sprintf(esc_html__('This value using for category pricing feature. %s You can add only %s numeric %s values inside of this box. (Only for Pay per post system)','pointfindercoreelements'),'<br/>','<strong>','</strong>'),
						'id'   => 'pf_categoryprice',
						'type' => 'text',
						'std'  => 0,
					),
					array(
						'name' => esc_html__('Multiple Sub Category Select','pointfindercoreelements'),
						'desc' => wp_sprintf(esc_html__('If this option enabled, then user can select more than one sub listing type. %s Warning: If this feature enabled, you can not use third level for this sub listing type.','pointfindercoreelements'),'<br/>'),
						'id'   => 'pf_multipleselect',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Enable','pointfindercoreelements'),
							'2' => esc_html__('Disable','pointfindercoreelements')
							),
						'std'  => 2,
					),
					array(
						'name' => esc_html__('Sub Category Fields','pointfindercoreelements'),
						'desc' => wp_sprintf(esc_html__('If this option enabled, you do not need to define custom fields for sub categories of this listing type . %s Warning: If this feature enabled, you can not use third level for this sub listing type.','pointfindercoreelements'),'<br/>'),
						'id'   => 'pf_subcatselect',
						'type' => 'radio',
						'options' => array(
							'1' => esc_html__('Enable','pointfindercoreelements'),
							'2' => esc_html__('Disable','pointfindercoreelements')
							),
						'std'  => 2,
					)
				)
			);


			
			

			if ($this->PFASSIssetControl('st8_nasys','',0) == 1) {

				$pfsidebarlist = array();
				global $pfsidebargenerator_options;
				if (isset($pfsidebargenerator_options['setup25_sidebargenerator_sidebars'])) {
					foreach ( $pfsidebargenerator_options['setup25_sidebargenerator_sidebars'] as $key => $value ) { 
				  		if (isset($value['url']) && isset($value['title'])) {
				  			$pfsidebarlist[ucwords( $value['url'] )] = ucwords( $value['title'] );
				  		}
				 	}
				}

			
				$pf_extra_taxonomyfields[] = array(
					'title' => esc_html__('Listing Type Advanced Settings','pointfindercoreelements'),			
					'taxonomies' => array('pointfinderltypes'),			
					'id' => 'pointfinderltypes_aslvars',	
					'parentonly' => true,					
					'fields' => array(	
						array(
							'name' => esc_html__('Advanced Settings','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("You should enable first for use this settings.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_advanced_status',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Reviews','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_reviewmodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Comments','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_commentsmodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Features','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_featuresmodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Opening Hours','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_ohoursmodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Video Module on Upload Page','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_videomodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Claim Listings','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Show/Hide this module on the item detail page.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_claimsmodule',
							'type' => 'radio',
							'options' => array(
								'1' => esc_html__('Enable','pointfindercoreelements'),
								'0' => esc_html__('Disable','pointfindercoreelements')
								),
							'std'  => 0,
						),
						array(
							'name' => esc_html__('Item Detail Page Section Config','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("You can reorder the positions of sections by using the move icon. If you want to disable any section please click and select disable. Please check the below options to edit Information Tab Content. Note, Events and Contact Section can not place into the tabs area.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_configuration',
							'type' => 'configcreator'
						),
						array(
							'name' => esc_html__('Item Detail Page Custom Sidebar','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Custom sidebar for only this listing type items.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_sidebar',
							'type' => 'select',
							'options' => $pfsidebarlist,
						),
						array(
							'name' => esc_html__('Item Detail Page Header','pointfindercoreelements'),
							'desc' => wp_sprintf(esc_html__("Page Header for only this listing type items.",'pointfindercoreelements'),'<br/>'),
							'id'   => 'pflt_headersection',
							'type' => 'select',
							'options' => array(
								0 => esc_html__('Standard Header', 'pointfindercoreelements') ,
			                    1 => esc_html__('Map Header', 'pointfindercoreelements'),
			                    2 => esc_html__('No Header', 'pointfindercoreelements'),
			                    3 => esc_html__('Image Header', 'pointfindercoreelements'),
								)
						)
					)
				);
			}


		/* For Conditions */

			$pf_extra_taxonomyfields[] = array(
				'title' => esc_html__('Settings','pointfindercoreelements'),			
				'taxonomies' => array('pointfinderconditions'),			
				'id' => 'pointfindercondition_vars',
				'parentonly' => true,				
				'fields' => array(	
					array(
						'name' => esc_html__('Background Color','pointfindercoreelements'),
						'id'   => 'pf_condition_bg',
						'type' => 'color',
					),
					array(
						'name' => esc_html__('Text Color','pointfindercoreelements'),
						'id'   => 'pf_condition_text',
						'type' => 'color',
					)
				)
			);

		if ( !class_exists( 'Pointfinder_Taxonomy_Meta' ) ){
			return;
                }

		foreach ( $pf_extra_taxonomyfields as $pf_extra_taxonomyfield )
		{
			new Pointfinder_Taxonomy_Meta( $pf_extra_taxonomyfield );
		}
	}

	public function pointfinder_remove_redux_redirection($location,$status) {
		$redux_url = admin_url( 'tools.php?page=redux-about' );
	    if ($location == $redux_url) {
	    	$location = admin_url('index.php');
	    }
	    return $location;
	}

	public function pointfinder_ultimate_and_vc_options() {
		$ultimate_vc_addons_redirect = get_option( 'ultimate_vc_addons_redirect');
		if ($ultimate_vc_addons_redirect == true) {
			$pf_ultimate_constants = array(
				'ULTIMATE_NO_UPDATE_CHECK' => true,
				'ULTIMATE_NO_EDIT_PAGE_NOTICE' => true,
				'ULTIMATE_NO_PLUGIN_PAGE_NOTICE' => true
			);

			update_option('ultimate_constants',$pf_ultimate_constants);
			update_option('ultimate_theme_support','enable');
			update_option('ultimate_updater','disabled');
			update_option('ultimate_vc_addons_redirect',false);
			
			defined('ULTIMATE_USE_BUILTIN');
			define('BSF_PRODUCT_NAGS', false);

			set_transient( '_vc_page_welcome_redirect', 0, 30 );
		}
	}
	
	public function pointfinder_new_vcSetAsTheme() {
	    vc_set_as_theme();
	}


	public function pointfinder_post_type_filter( $use_block_editor, $post_type ) {
		if ( $this->post_type_name == $post_type ) {
			return false;
		}

		return $use_block_editor;
	}



	public function pf_publish_bulk_action($bulk_actions){
		$bulk_actions['publishpf'] = esc_html__( 'Publish', 'pointfindercoreelements');
		$bulk_actions['rejectpf'] = esc_html__( 'Reject', 'pointfindercoreelements');
  		return $bulk_actions;
	}

	public function pf_publish_bulk_action_handler($redirect_to, $doaction, $post_ids ){
		if ( $doaction !== 'publishpf' ) {
			return $redirect_to;
		}
		foreach ( $post_ids as $post_id ) {
			wp_update_post(array('ID' => $post_id, 'post_status' => 'publish'));
		}
		$redirect_to = add_query_arg( 'bulk_published_listings', count( $post_ids ), $redirect_to );
		return $redirect_to;
	}

	public function pf_reject_bulk_action_handler($redirect_to, $doaction, $post_ids ){
		if ( $doaction !== 'rejectpf' ) {
			return $redirect_to;
		}
		foreach ( $post_ids as $post_id ) {
			wp_update_post(array('ID' => $post_id, 'post_status' => 'rejected'));
		}
		$redirect_to = add_query_arg( 'bulk_rejected_listings', count( $post_ids ), $redirect_to );
		return $redirect_to;
	}

	public function pf_publish_bulk_action_admin_notice() {
	  if ( ! empty( $_REQUEST['bulk_published_listings'] ) ) {
	    $emailed_count = intval( $_REQUEST['bulk_published_listings'] );
	    printf( '<div id="message" class="updated fade">' .
	      _n( 'Published %s listings.',
	        'Published %s listings.',
	        $emailed_count,
	        'pointfindercoreelements'
	      ) . '</div>', $emailed_count );
	  }
	}

	public function pf_reject_bulk_action_admin_notice() {
	  if ( ! empty( $_REQUEST['bulk_rejected_listings'] ) ) {
	    $emailed_count = intval( $_REQUEST['bulk_rejected_listings'] );
	    printf( '<div id="message" class="updated fade">' .
	      _n( 'Rejected %s listings.',
	        'Rejected %s listings.',
	        $emailed_count,
	        'pointfindercoreelements'
	      ) . '</div>', $emailed_count );
	  }
	}

	public function pointfinder_disable_ptbranding(){return true;}
	public function pointfinder_disable_regeneratethumbs(){return false;}
	public function pointfinder_disable_popupconfirmationocdi(){return false;}

	public function pointfinder_ocdi_after_import( $selected_import ) {

		$main_options = 'pointfindertheme_options';

		if ( 'Multi Directory' === $selected_import['import_file_name'] ) {

			echo $selected_import['import_file_name']." ". esc_html__( "Mode After Import Actions", "pointfindercoreelements" );

			$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
			$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
	                'pointfinder-main-menu' => $main_menu->term_id,
	                'pointfinder-footer-menu' => $footer_menu->term_id
	            )
	        );

	        $page_number = get_page_by_title('Home Page + Mini Search','OBJECT','page');

            if (isset($page_number)) {
              $page_number = $page_number->ID;
            }else{
              $page_number = 7;
            }
            update_option( 'pointfinder_cssstyle','multidirectory' );

            
            $dashboard_page = get_page_by_title('Dashboard','OBJECT','page');
            if (isset($dashboard_page)) {
            	Redux::setOption($main_options,'setup4_membersettings_dashboard', $dashboard_page->ID);
            }

            global $wpdb;
            $megamenu_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",12));
            $hide_id1 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",13));
            $hide_id2 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",20));
            $hide_id3 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",27));
            $hide_id4 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",34));
            $megamenu_id2 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",41));
            $hide_id5 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",56));
            $hide_id6 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",72));

            update_post_meta( $megamenu_id, '_menu_item_megamenu', 1 );
            update_post_meta( $megamenu_id, '_menu_item_columnvalue', 4 );

            update_post_meta( $megamenu_id2, '_menu_item_megamenu', 1 );
            update_post_meta( $megamenu_id2, '_menu_item_columnvalue', 4 );

            update_post_meta( $hide_id1, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id2, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id3, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id4, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id5, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id6, '_menu_item_megamenu_hide', 1 );

		}elseif ('Real Estate' === $selected_import['import_file_name']) {

			echo $selected_import['import_file_name']." ". esc_html__( "Mode After Import Actions", "pointfindercoreelements" );

			$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
			$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
	                'pointfinder-main-menu' => $main_menu->term_id,
	                'pointfinder-footer-menu' => $footer_menu->term_id
	            )
	        );

	        $page_number = get_page_by_title('Home Page','OBJECT','page');

            if (isset($page_number)) {
              $page_number = $page_number->ID;
            }else{
              $page_number = 7;
            }

            /* CSS trigger */
            update_option( 'pointfinder_cssstyle','realestate' );

            

            $dashboard_page = get_page_by_title('Dashboard','OBJECT','page');

            if (isset($dashboard_page)) {
            	Redux::setOption($main_options,'setup4_membersettings_dashboard', $dashboard_page->ID);
            }

            /* Mega Menu Works */
            global $wpdb;
            $megamenu_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",45));
            $hide_id1 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",46));
            $hide_id2 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",53));
            $hide_id3 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",60));
            $hide_id4 = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts where post_type = %s and menu_order = %d","nav_menu_item",67));

            update_post_meta( $megamenu_id, '_menu_item_megamenu', 1 );
            update_post_meta( $megamenu_id, '_menu_item_columnvalue', 4 );

            update_post_meta( $hide_id1, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id2, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id3, '_menu_item_megamenu_hide', 1 );
            update_post_meta( $hide_id4, '_menu_item_megamenu_hide', 1 );
			
		}elseif ('Car Dealer' === $selected_import['import_file_name']) {

			echo $selected_import['import_file_name']." ". esc_html__( "Mode After Import Actions", "pointfindercoreelements" );

			$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
			$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
	                'pointfinder-main-menu' => $main_menu->term_id,
	                'pointfinder-footer-menu' => $footer_menu->term_id
	            )
	        );

	        $page_number = get_page_by_title('Home','OBJECT','page');

            if (isset($page_number)) {
              $page_number = $page_number->ID;
            }else{
              $page_number = 7;
            }
            update_option( 'pointfinder_cssstyle','cardealer' );

            
            $dashboard_page = get_page_by_title('Dashboard','OBJECT','page');
            if (isset($dashboard_page)) {
            	Redux::setOption($main_options,'setup4_membersettings_dashboard', $dashboard_page->ID);
            }
		}

		/* Set Home Pages */
		$page_on_front = get_option('page_on_front');
		$show_on_front = get_option('show_on_front');
		if (false !== $page_on_front) {update_option( 'page_on_front', $page_number );}else{add_option( 'page_on_front', $page_number );}
		if ($show_on_front ==! false) {update_option( 'show_on_front', 'page' );}else{add_option( 'show_on_front', 'page' );}
	}

	public function pointfinder_ocdi_before_import_files($selected_import){

		$main_options = 'pointfindertheme_options';

		if ( 'Multi Directory' === $selected_import['import_file_name'] ) {
			Redux::setOption($main_options,'setup3_pointposttype_pt1', 'listing');
			Redux::setOption($main_options,'setup3_pointposttype_pt11', 'pftestimonials');
			Redux::setOption($main_options,'setup3_pt14_check', 1);
		} elseif('Real Estate' === $selected_import['import_file_name']){
			Redux::setOption($main_options,'setup3_pointposttype_pt1', 'properties');
			Redux::setOption($main_options,'setup3_pointposttype_pt11', 'pftestimonials');
			Redux::setOption($main_options,'setup3_pt14_check', 1);
			Redux::setOption($main_options,'setup3_pt14', 'conditions');
		} elseif('Car Dealer' === $selected_import['import_file_name']){
			Redux::setOption($main_options,'setup3_pointposttype_pt1', 'cars');
			Redux::setOption($main_options,'setup3_pointposttype_pt8', 'dealers');
			Redux::setOption($main_options,'setup3_pt14_check', 0);
		}
	}

	public function pointfinder_ocdi_import_files() {
		$licensekey = get_option('envato_license_code_10298703', '');
		return array(
			array(
				'import_file_name'             => 'Multi Directory',
				'categories'                   => array( esc_html__( 'Directory', 'pointfindercoreelements') ),
				'import_widget_file_url'     => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=widgets.json&license='.$licensekey,
				'import_file_url'            => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=content.xml&license='.$licensekey,
	            'import_redux'               => array(
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options.json&license='.$licensekey,
	                    'option_name' => 'pointfindertheme_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_mail.json&license='.$licensekey,
	                    'option_name' => 'pointfindermail_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_customfields.json&license='.$licensekey,
	                    'option_name' => 'pfcustomfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_searchfields.json&license='.$licensekey,
	                    'option_name' => 'pfsearchfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_custompoints.json&license='.$licensekey,
	                    'option_name' => 'pfcustompoints_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_reviews.json&license='.$licensekey,
	                    'option_name' => 'pfitemreviewsystem_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_advanced.json&license='.$licensekey,
	                    'option_name' => 'pfadvancedcontrol_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=multidirectory&file=theme_options_additional.json&license='.$licensekey,
	                    'option_name' => 'pfascontrol_options',
	                )
	            ),
				'import_preview_image_url'     => PFCOREELEMENTSURLADMIN . 'images/multicat.jpg',
				'preview_url'                  => 'https://pointfindertheme.com/multidirectory'
			),
			array(
				'import_file_name'             => 'Real Estate',
				'categories'                   => array( esc_html__( 'Real Estate', 'pointfindercoreelements') ),
				'import_file_url'            => 'https://api.webbu.com/dccontent.php?mode=demo&file=content.xml&license='.$licensekey,
				'import_widget_file_url'     => 'https://api.webbu.com/dccontent.php?mode=demo&file=widgets.json&license='.$licensekey,
				'import_redux'           => array(
					array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options.json&license='.$licensekey,
	                    'option_name' => 'pointfindertheme_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options_mail.json&license='.$licensekey,
	                    'option_name' => 'pointfindermail_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options_customfields.json&license='.$licensekey,
	                    'option_name' => 'pfcustomfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options_searchfields.json&license='.$licensekey,
	                    'option_name' => 'pfsearchfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options_custompoints.json&license='.$licensekey,
	                    'option_name' => 'pfcustompoints_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=demo&file=theme_options_additional.json&license='.$licensekey,
	                    'option_name' => 'pfascontrol_options',
	                )
				),
				'import_preview_image_url'     => PFCOREELEMENTSURLADMIN . 'images/realestate.jpg',
				'preview_url'                  => 'https://pointfindertheme.com/demo',
			),
			array(
				'import_file_name'             => 'Car Dealer',
				'categories'                   => array( esc_html__( 'Car Dealer', 'pointfindercoreelements') ),
				'import_file_url'            => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=content.xml&license='.$licensekey,
				'import_widget_file_url'     => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=widgets.json&license='.$licensekey,
				'import_redux'           => array(
					array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options.json&license='.$licensekey,
	                    'option_name' => 'pointfindertheme_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options_mail.json&license='.$licensekey,
	                    'option_name' => 'pointfindermail_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options_customfields.json&license='.$licensekey,
	                    'option_name' => 'pfcustomfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options_searchfields.json&license='.$licensekey,
	                    'option_name' => 'pfsearchfields_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options_custompoints.json&license='.$licensekey,
	                    'option_name' => 'pfcustompoints_options',
	                ),
	                array(
	                    'file_url'    => 'https://api.webbu.com/dccontent.php?mode=cardealer&file=theme_options_additional.json&license='.$licensekey,
	                    'option_name' => 'pfascontrol_options',
	                )
				),
				'import_preview_image_url'     => PFCOREELEMENTSURLADMIN . 'images/cardealer.jpg',
				'preview_url'                  => 'https://pointfindertheme.com/cardealer',
			)
		);
	}


	public function PFProcessNameFilter($value){
		switch ($value) {
			case 'BankTransferCancel':
				return esc_html__('Bank Transfer Cancellation','pointfindercoreelements');
				break;
			case 'BankTransfer':
				return esc_html__('Bank Transfer Request','pointfindercoreelements');
				break;
			case 'CancelPayment':
				return esc_html__('Payment Cancelled by User','pointfindercoreelements');
				break;
			case 'DoExpressCheckoutPayment':
				return esc_html__('Express Checkout Process End','pointfindercoreelements');
				break;
			case 'DoExpressCheckoutPaymentStripe':
				return esc_html__('Stripe Payment Checkout Process End','pointfindercoreelements');
				break;
			case 'DoExpressCheckoutPaymentPags':
			case 'DoExpressCheckoutPaymentPayu':
			case 'DoExpressCheckoutPaymentIyzico':
			case 'DoExpressCheckoutPaymentiDeal':
			case 'DoExpressCheckoutPaymentRobo':
				return esc_html__('Payment Checkout Process End','pointfindercoreelements');
				break;
			case 'CreateRecurringPaymentsProfile':
				return esc_html__('Recurring Payment Profile Creation','pointfindercoreelements');
				break;
			case 'ManageRecurringPaymentsProfileStatus':
				return esc_html__('Recurring Payment Profile Cancellation','pointfindercoreelements');
				break;
			case 'GetExpressCheckoutDetails':
				return esc_html__('Getting Express Checkout Details','pointfindercoreelements');
				break;
			case 'SetExpressCheckout':
				return esc_html__('Checkout Process Started','pointfindercoreelements');
				break;
			case 'SetExpressCheckoutStripe':
				return esc_html__('Stripe Payment Checkout Process Started','pointfindercoreelements');
				break;
			case 'GetRecurringPaymentsProfileDetails':
				return esc_html__('Recurring Payment Control','pointfindercoreelements');
				break;
			case 'RecurringPayment':
				return esc_html__('Recurring Payment Received','pointfindercoreelements');
				break;
			case 'RecurringPaymentPending':
				return esc_html__('Recurring Payment Pending','pointfindercoreelements');
				break;
		}
	}

	public function PFU_GetPostOrderDate($value) {
		global $wpdb;
		$result = $wpdb->get_var( $wpdb->prepare( 
			"SELECT post_date FROM $wpdb->posts WHERE ID = %d", 
			$value
		) );
		return $result;
	}

	public function pointfinder_register_erasers($erasers){

		if ($this->PFSAIssetControl('st11_listingdel','',0) == 1) {
			$erasers[] = array(
				'eraser_friendly_name' => esc_html__('User Listings and Order Records','pointfindercoreelements'),
				'callback'             => array( $this, 'pointfinder_user_listing_eraser' ),
			);
		}


		if ($this->PFSAIssetControl('st11_userdel','',0) == 1) {
			$erasers[] = array(
				'eraser_friendly_name' => esc_html__('User Account Data','pointfindercoreelements'),
				'callback'             => array( $this, 'pointfinder_user_account_eraser' ),
			);
		}

		return $erasers;
	}

	public function pointfinder_user_account_eraser($email_address, $page = 1){

		if ( empty( $email_address ) ) {
			return array(
				'items_removed'  => false,
				'items_retained' => false,
				'messages'       => array('Email empty - Account Data do not removed.'),
				'done'           => true,
			);
		}

		$user = get_user_by( 'email', $email_address );
		$messages = array();
		$items_removed  = false;
		$items_retained = false;

		delete_user_meta( $user->ID, 'first_name' );
		delete_user_meta( $user->ID, 'last_name' );
		delete_user_meta( $user->ID, 'user_phone' );
		delete_user_meta( $user->ID, 'user_mobile' );
		delete_user_meta( $user->ID, 'user_twitter' );
		delete_user_meta( $user->ID, 'user_facebook' );
		delete_user_meta( $user->ID, 'user_linkedin' );
		delete_user_meta( $user->ID, 'user_vatnumber' );
		delete_user_meta( $user->ID, 'user_country' );
		delete_user_meta( $user->ID, 'user_city' );
		delete_user_meta( $user->ID, 'user_country' );
		delete_user_meta( $user->ID, 'user_address' );
		delete_user_meta( $user->ID, 'description' );
		delete_user_meta( $user->ID, 'user_photo' );
		$items_removed  = true;
		$messages[] = esc_html__('PointFinder : User Meta Data Removed','pointfindercoreelements');

		$setup4_membersettings_paymentsystem = $this->PFSAIssetControl('setup4_membersettings_paymentsystem','','1');
          
		if ($setup4_membersettings_paymentsystem == 2) {

			$order_id = $membership_user_activeorder = get_user_meta( $user->ID, 'membership_user_activeorder', true );
	        $membership_user_recurring = get_user_meta( $user->ID, 'membership_user_recurring', true );

	      

	        $recurring_status = get_post_meta( $order_id, 'pointfinder_order_recurring',true);

	        if (!empty($order_id) && $recurring_status == 1 && $membership_user_recurring == 1) {

	        	$pointfinder_order_recurringid = get_post_meta( $order_id, 'pointfinder_order_recurringid', true );

	        	update_post_meta( $order_id, 'pointfinder_order_recurring', 0 );
	            update_user_meta( $user->ID, 'membership_user_recurring', 0);

	            $this->PF_Cancel_recurring_payment_member(
	             array(
	                    'user_id' => $user->ID,
	                    'profile_id' => $pointfinder_order_recurringid,
	                    'item_post_id' => $order_id,
	                    'order_post_id' => $order_id,
	                )
             	);

	            $messages[] = esc_html__('PointFinder : User recurring membership profile cancelled.','pointfindercoreelements');
	        }
	        
	        
	        wp_delete_post($order_id);

			delete_user_meta( $user->ID, 'membership_user_activeorder' );
			delete_user_meta( $user->ID, 'membership_user_package' );
			delete_user_meta( $user->ID, 'membership_user_item_limit' );
			delete_user_meta( $user->ID, 'membership_user_package_id' );
			delete_user_meta( $user->ID, 'membership_user_package' );
			delete_user_meta( $user->ID, 'membership_user_featureditem_limit' );
			delete_user_meta( $user->ID, 'membership_user_image_limit' );
			delete_user_meta( $user->ID, 'membership_user_trialperiod' );
			delete_user_meta( $user->ID, 'membership_user_recurring' );
			delete_user_meta( $user->ID, 'membership_user_package' );

			$messages[] = esc_html__('PointFinder : User membership profile order removed.','pointfindercoreelements');

		}


		return array(
			'items_removed'  => $items_removed,
			'items_retained' => $items_retained,
			'messages'       => $messages,
			'done'           => true,
		);
	}

	public function pointfinder_user_listing_eraser($email_address, $page = 1){
	
		if ( empty( $email_address ) ) {
			return array(
				'items_removed'  => false,
				'items_retained' => false,
				'messages'       => array('Email empty - Listings do not removed.'),
				'done'           => true,
			);
		}

		$user = get_user_by( 'email', $email_address );
		$messages = array();
		$items_removed  = false;
		$items_retained = false;

		if ( isset($user->ID) ) {
			
			global $wpdb;

			$results = $wpdb->get_results($wpdb->prepare( "SELECT ID, post_author FROM $wpdb->posts WHERE post_author = %s and post_type = %s", $user->ID,$this->post_type_name));

			
			$setup4_membersettings_paymentsystem = $this->PFSAIssetControl('setup4_membersettings_paymentsystem','','1');

			if ($setup4_membersettings_paymentsystem == 2) {
				$user_account_remove_permission = $this->PFSAIssetControl('st11_userdel','',0);

				$membership_user_package_id = get_user_meta( $user->ID, 'membership_user_package_id', true );
                $packageinfox = $this->pointfinder_membership_package_details_get($membership_user_package_id);

                $membership_user_activeorder = get_user_meta( $user->ID, 'membership_user_activeorder', true );
			}

		 	if (is_array($results) && count($results)>0) {

		 		/* Remove Listings */
		 		foreach ($results as $single_result) {

		 			$old_status_featured = false;
	                $old_status_featured = get_post_meta( $single_result->ID, 'webbupointfinder_item_featuredmarker', true );

	                if ($setup4_membersettings_paymentsystem == 2) {
	                	/* - Creating record for process system. */
	                    $this->PFCreateProcessRecord(
	                      array( 
	                        'user_id' => $single_result->ID,
	                        'item_post_id' => $membership_user_activeorder,
	                        'processname' => esc_html__('Item deleted by ACCOUNT ERASER TOOL.','pointfindercoreelements'),
	                        'membership' => 1
	                        )
	                    );

	                    if ($user_account_remove_permission != 1) {
							/*Membership limits for item /featured limit*/
		                
			                $membership_user_item_limit = get_user_meta( $user->ID, 'membership_user_item_limit', true );
			                $membership_user_featureditem_limit = get_user_meta( $user->ID, 'membership_user_featureditem_limit', true );

			                if ($membership_user_item_limit >= 0){

			                    $membership_user_item_limit = $membership_user_item_limit + 1;

			                    if ($membership_user_item_limit <= $packageinfox['webbupointfinder_mp_itemnumber']) {
			                      update_user_meta( $user->ID, 'membership_user_item_limit', $membership_user_item_limit);
			                    }

			                }

			                if($old_status_featured != false && $old_status_featured != 0){

			                  $membership_user_featureditem_limit = $membership_user_featureditem_limit + 1;

			                  if ($membership_user_featureditem_limit <= $packageinfox['webbupointfinder_mp_fitemnumber']) {
			                    update_user_meta( $user->ID, 'membership_user_featureditem_limit', $membership_user_featureditem_limit);
			                  } 

		                	}
		                }
	                }else{

                	 	$order_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s and meta_value = %s", 'pointfinder_order_itemid',$single_result->ID));

		                $pointfinder_order_recurring = get_post_meta( $order_id, 'pointfinder_order_recurring', true );
		                if($pointfinder_order_recurring == 1){
		                  do_action('pointfinder_recurring_itemremove_actions',array('user_id' => $user->ID, 'post_id' => $single_result->ID, 'order_id' => $order_id));
		                  $pointfinder_order_recurringid = get_post_meta( $order_id, 'pointfinder_order_recurringid', true );
		                  $this->PF_Cancel_recurring_payment(
		                   array( 
	                          'user_id' => $user->ID,
	                          'profile_id' => $pointfinder_order_recurringid,
	                          'item_post_id' => $single_result->ID,
	                          'order_post_id' => $order_id,
		                      )
		                   );
		                }

		                wp_delete_post($order_id);
	                }


	                $delete_item_images = get_post_meta($single_result->ID, 'webbupointfinder_item_images');
	                if (!empty($delete_item_images)) {foreach ($delete_item_images as $item_image) {wp_delete_attachment($item_image,true);}}
	                wp_delete_attachment(get_post_thumbnail_id( $single_result->ID ),true);
	                wp_delete_post($single_result->ID);
	                $items_removed = true;

		 		}

		 		if ($items_removed) {$messages[] = esc_html__('PointFinder : All Listings and Orders Removed.','pointfindercoreelements');}
			}
			
		}

		return array('items_removed' => $items_removed,'items_retained' => $items_retained,'messages' => $messages,'done' => true,);
	}

	/*
	* Start : ACF Field Filters
	*/
		private function pointfinder_get_registered_sidebars(){
			global $wp_registered_sidebars;
		    $sidebars = $wp_registered_sidebars;
		    $sidebar_options = array();
		    foreach ( $sidebars as $sidebar ){
		       $sidebar_options[$sidebar['id']] = $sidebar['name'];
		    }

		    return $sidebar_options;
		}

		public function pointfinder_acf_sidebar_filter($field){
			$field["choices"] = $this->pointfinder_get_registered_sidebars();
			return $field;
		}

		
		public function pointfinder_field_5fa3eb2a5c43e_filter($field){

			$bgcolor_old = get_post_meta( get_the_ID(), "webbupointfinder_page_headerbarsettings_bgcolor2", true);

			$value = array();

			if (isset($bgcolor_old["color"])) {
				$field["field_5fa3eb2a5c43f"] = $bgcolor_old["color"];
			}

			if (isset($bgcolor_old["alpha"])) {
				$field["field_5fa3eb2a5c440"] = $bgcolor_old["alpha"];
			}

			if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}

		public function pointfinder_field_5fa3e8f72ab13_filter($field){

			$bgcolor_old = get_post_meta( get_the_ID(), "webbupointfinder_page_headerbarsettings_bgcolor", true);

			$value = array();

			if (isset($bgcolor_old["color"])) {
				$field["field_5fa3eac6b3e7d"] = $bgcolor_old["color"];
			}

			if (isset($bgcolor_old["alpha"])) {
				$field["field_5fa3e98c2ab14"] = $bgcolor_old["alpha"];
			}

			if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}

		public function pointfinder_field_5fa3e75bb3d70_filter($field){

			$linkcolor = get_post_meta( get_the_ID(), "webbupointfinder_page_menucolor", true);

			$value = array();

			if (isset($linkcolor["regular"])) {
				$field["field_5fa3e7e0b3d71"] = $linkcolor["regular"];
			}

			if (isset($linkcolor["hover"])) {
				$field["field_5fa3e7f5b3d72"] = $linkcolor["hover"];
			}

			if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}


		public function pointfinder_field_5fa42830927b4_filter($field){

		    $custombg = get_post_meta( get_the_ID(), "webbupointfinder_page_titlebarcustombg", true);

		    $value = array();

		    if (isset($custombg["background-color"])) {
		    	$value["field_5fa42884927b6"] = $custombg["background-color"];
		    }
		    if (isset($custombg["background-image"])) {
		    	$value["field_5fa4289a927b7"] = absint($custombg["media"]["id"]);
		    }
		    if (isset($custombg["background-repeat"])) {
		    	$value["field_5fa428e2927b8"] = $custombg["background-repeat"];
		    }
		    if (isset($custombg["background-size"])) {
		    	$value["field_5fa429a0927b9"] = $custombg["background-size"];
		    }
		    if (isset($custombg["background-position"])) {
		    	$value["field_5fa42a0a927ba"] = $custombg["background-position"];
		    }

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}


		public function pointfinder_field_5fa473756196e_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_bgopt2", true);

			$value = array();

		    if (isset($custombg["background-color"])) {
		    	$value["field_5fa473756196f"] = $custombg["background-color"];
		    }
		    if (isset($custombg["background-image"])) {
		    	$value["field_5fa4737561970"] = absint($custombg["media"]["id"]);
		    }
		    if (isset($custombg["background-repeat"])) {
		    	$value["field_5fa4737561971"] = $custombg["background-repeat"];
		    }
		    if (isset($custombg["background-size"])) {
		    	$value["field_5fa4737561972"] = $custombg["background-size"];
		    }
		    if (isset($custombg["background-position"])) {
		    	$value["field_5fa4737561973"] = $custombg["background-position"];
		    }

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}


		public function pointfinder_field_5fa473fa61974_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_bgopt2w", true);

			$value = array();

		    if (isset($custombg["height"])) {
		    	$value["field_5fa4741961975"] = $custombg["height"];
		    }
		    if (isset($custombg["unit"])) {
		    	$value["field_5fa4737561970"] = $custombg["unit"];
		    }
		   

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }
		    
			return $field;
		}


		public function pointfinder_field_5fa474d861977_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_bgopt2m", true);

			$value = array();

		    if (isset($custombg["margin-top"])) {
		    	$value["field_5fa474d861978"] = $custombg["margin-top"];
		    }
		    if (isset($custombg["margin-bottom"])) {
		    	$value["field_5fa474fc6197a"] = $custombg["margin-bottom"];
		    }
		    if (isset($custombg["unit"])) {
		    	$value["field_5fa474d861979"] = $custombg["unit"];
		    }
		   

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }
		    
			return $field;
		}

		public function pointfinder_field_5fa4759261985_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_bgopt", true);

			$value = array();

		    if (isset($custombg["background-color"])) {
		    	$value["field_5fa4759361986"] = $custombg["background-color"];
		    }
		    if (isset($custombg["background-image"])) {
		    	$value["field_5fa4759361987"] = absint($custombg["media"]["id"]);
		    }
		    if (isset($custombg["background-repeat"])) {
		    	$value["field_5fa4759361988"] = $custombg["background-repeat"];
		    }
		    if (isset($custombg["background-size"])) {
		    	$value["field_5fa4759361989"] = $custombg["background-size"];
		    }
		    if (isset($custombg["background-position"])) {
		    	$value["field_5fa475936198a"] = $custombg["background-position"];
		    }

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}


		public function pointfinder_field_5fa475e36198c_filter($field){

			$linkcolor = get_post_meta( get_the_ID(), "webbupointfinder_gbf_textcolor1", true);

			$value = array();

			if (isset($linkcolor["regular"])) {
				$field["field_5fa475fb6198d"] = $linkcolor["regular"];
			}

			if (isset($linkcolor["hover"])) {
				$field["field_5fa476146198e"] = $linkcolor["hover"];
			}

			if (!empty($value)) {
		    	$field["value"] = $value;
		    }

			return $field;
		}

		public function pointfinder_field_5fa4766c6198f_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_spacing", true);

			$value = array();

		    if (isset($custombg["padding-top"])) {
		    	$value["field_5fa4766c61990"] = $custombg["padding-top"];
		    }
		    if (isset($custombg["padding-bottom"])) {
		    	$value["field_5fa4766c61991"] = $custombg["padding-bottom"];
		    }
		    if (isset($custombg["unit"])) {
		    	$value["field_5fa4766c61992"] = $custombg["unit"];
		    }
		   

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }
		    
			return $field;
		}


		public function pointfinder_field_5fa476a561993_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_spacing2", true);

			$value = array();

		    if (isset($custombg["margin-top"])) {
		    	$value["field_5fa476a561994"] = $custombg["margin-top"];
		    }
		    if (isset($custombg["margin-bottom"])) {
		    	$value["field_5fa476a561995"] = $custombg["margin-bottom"];
		    }
		    if (isset($custombg["unit"])) {
		    	$value["field_5fa476a561996"] = $custombg["unit"];
		    }
		   

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }
		    
			return $field;
		}

		public function pointfinder_field_5fa476c961997_filter($field){

			$custombg = get_post_meta( get_the_ID(), "webbupointfinder_gbf_border", true);

			$value = array();

		    if (isset($custombg["border-color"])) {
		    	$value["field_5fa477016199b"] = $custombg["border-color"];
		    }
		    if (isset($custombg["unit"])) {
		    	$value["field_5fa476c96199a"] = $custombg["unit"];
		    }
		    if (isset($custombg["border-top"])) {
		    	$value["field_5fa476c961998"] = $custombg["border-top"];
		    }
		    if (isset($custombg["border-bottom"])) {
		    	$value["field_5fa476c961999"] = $custombg["border-bottom"];
		    }
		   

		    if (!empty($value)) {
		    	$field["value"] = $value;
		    }
		    
			return $field;
		}
		


	/*
	* End : ACF Field Filters
	*/


	public function pointfinder_acf_init_settings() {
	    acf_update_setting('show_admin', true);
	    acf_update_setting('l10n_textdomain', 'pointfindercoreelements');
	}

	/*
	* Start : ACF Fields
	*/
		public function pointfinder_register_acf_fields(){
			if( function_exists('acf_add_local_field_group') ){
				/*
				* Start : Blog Sidebar
				*/
					acf_add_local_field_group(array(
						'key' => 'group_5fa3ebf229670',
						'title' => __( 'Blog Sidebar', "pointfindercoreelements" ),
						'fields' => array(
							array(
								'key' => 'field_5fa3ecdc5a373',
								'label' => __( 'Sidebar', "pointfindercoreelements" ),
								'name' => 'webbupointfinder_page_sidebar',
								'type' => 'select',
								'instructions' => __( "Please select the sidebar you would like to display on this blog page (Only for blog pages.). Note: You must first create the sidebar under PF Options > Sidebar Generator.", "pointfindercoreelements" ),
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => 'Title',
								),
								'default_value' => false,
								'allow_null' => 1,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
						),
						'location' => array(
							array(
								array(
									'param' => 'post_type',
									'operator' => '==',
									'value' => 'page',
								),
							),
						),
						'menu_order' => 0,
						'position' => 'side',
						'style' => 'default',
						'label_placement' => 'top',
						'instruction_placement' => 'field',
						'hide_on_screen' => '',
						'active' => true,
						'description' => '',
					));
				/*
				* End : Blog Sidebar
				*/


				/*
				* Start : Page Options 
				*/
					acf_add_local_field_group(array(
						'key' => 'group_5fa3e51c89202',
						'title' => __('Page Options', 'pointfindercoreelements'),
						'fields' => array(
							array(
								'key' => 'field_5fa3e61eb09fe',
								'label' => __('Header Bar', 'pointfindercoreelements'),
								'name' => '',
								'type' => 'tab',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'placement' => 'left',
								'endpoint' => 0,
							),
							array(
								'key' => 'field_5fa403a01c01b',
								'label' => __('Header Bar Area', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebararea',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, you can edit page header bar area by using below options.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa403db1c01c',
								'label' => __('Default Header Bar', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_defaultheaderbararea',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, all variables will load from default header bar settings.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403a01c01b',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa403fe1c01d',
								'label' => __('Header Bar Shadow', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_shadowopt',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, all variables will load from default header bar settings.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403a01c01b',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									0 => __('Disabled', 'pointfindercoreelements'),
									1 => __('Shadow 1', 'pointfindercoreelements'),
									2 => __('Shadow 2', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa406b44d0ad',
								'label' => __('Header Bar Height', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomheight',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => 120,
								'placeholder' => '',
								'prepend' => '',
								'append' => 'px',
								'min' => 1,
								'max' => 500,
								'step' => 1,
							),
							array(
								'key' => 'field_5fa404591c020',
								'label' => __('Header Bar Text Options', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarareatext',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, all variables will load from default header bar settings.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403a01c01b',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Show', 'pointfindercoreelements'),
									0 => __('Hide', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 1,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa404e71c024',
								'label' => __('Header Bar Text: Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomtext_color',
								'type' => 'color_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '35',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
							),
							array(
								'key' => 'field_5fa405f8b2821',
								'label' => __('Header Bar Text: Background Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomtext_bgcolor',
								'type' => 'color_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '35',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
							),
							array(
								'key' => 'field_5fa40618b2822',
								'label' => __('Header Bar Text: BG Opacity', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomtext_bgcolorop',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '30',
									'class' => '',
									'id' => '',
								),
								'default_value' => 0,
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => 0,
								'max' => 1,
								'step' => '0.1',
							),
							array(
								'key' => 'field_5fa4066fb2823',
								'label' => __('Header Bar Text: Custom Text', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomtext',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5fa40687b2824',
								'label' => __('Header Bar Text: Custom Sub Text', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustomsubtext',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5fa42830927b4',
								'label' => __('Header Bar Background', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_titlebarcustombg',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa404591c020',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa403db1c01c',
											'operator' => '==',
											'value' => '0',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa42884927b6',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
									),
									array(
										'key' => 'field_5fa4289a927b7',
										'label' => __('Image', 'pointfindercoreelements'),
										'name' => 'image',
										'type' => 'image',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
										'preview_size' => 'thumbnail',
										'library' => 'all',
										'min_width' => '',
										'min_height' => '',
										'min_size' => '',
										'max_width' => '',
										'max_height' => '',
										'max_size' => '',
										'mime_types' => 'jpg,png,jpeg',
									),
									array(
										'key' => 'field_5fa428e2927b8',
										'label' => __('Repeat', 'pointfindercoreelements'),
										'name' => 'repeat',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'no-repeat' => __('No Repeat', 'pointfindercoreelements'),
											'repeat' => __('Repeat', 'pointfindercoreelements'),
											'repeat-x' => __('Repeat Horizontally', 'pointfindercoreelements'),
											'repeat-y' => __('Repeat Vertically', 'pointfindercoreelements'),
											'inherit' => __('Inherit', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa429a0927b9',
										'label' => __('Size', 'pointfindercoreelements'),
										'name' => 'size',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'inherit' => __('Inherit', 'pointfindercoreelements'),
											'cover' => __('Cover', 'pointfindercoreelements'),
											'contain' => __('Contain', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa42a0a927ba',
										'label' => __('Position', 'pointfindercoreelements'),
										'name' => 'position',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'left top' => __('Left Top', 'pointfindercoreelements'),
											'left center' => __('Left Center', 'pointfindercoreelements'),
											'left bottom' => __('Left Bottom', 'pointfindercoreelements'),
											'center top' => __('Center Top', 'pointfindercoreelements'),
											'center center' => __('Center Center', 'pointfindercoreelements'),
											'center bottom' => __('Center Bottom', 'pointfindercoreelements'),
											'right top' => __('Right Top', 'pointfindercoreelements'),
											'right center' => __('Right Center', 'pointfindercoreelements'),
											'right bottom' => __('Right Bottom', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa3e640b09ff',
								'label' => __('Transparent Menu', 'pointfindercoreelements'),
								'name' => '',
								'type' => 'tab',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'placement' => 'left',
								'endpoint' => 0,
							),
							array(
								'key' => 'field_5fa3e66fb0a01',
								'label' => __('Transparent Header', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_transparent',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, the menu bar will be a transparent background.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa3e6b6b0a02',
								'label' => __('Show Additional Logo', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_logoadditional',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, the system will use an additional logo instead of the default one.', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa3e6fab0a03',
								'label' => __('Main Menu: Active Line Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_menulinecolor',
								'type' => 'color_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '#a32222',
							),
							array(
								'key' => 'field_5fa3e75bb3d70',
								'label' => __('Main Menu: Menu Link Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_menucolor',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa3e7e0b3d71',
										'label' => __('Regular', 'pointfindercoreelements'),
										'name' => 'regular',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#444444',
									),
									array(
										'key' => 'field_5fa3e7f5b3d72',
										'label' => __('Hover', 'pointfindercoreelements'),
										'name' => 'hover',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#a32221',
									),
								),
							),
							array(
								'key' => 'field_5fa3e8c46ee8a',
								'label' => __('Main Menu: Bold Text', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_menutextsize',
								'type' => 'button_group',
								'instructions' => __('If it is enabled, main menu text will be bolder', 'pointfindercoreelements'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa3e8f72ab13',
								'label' => __('Menu Bar Background', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_headerbarsettings_bgcolor',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa3eac6b3e7d',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#000000',
									),
									array(
										'key' => 'field_5fa3e98c2ab14',
										'label' => __('Opacity', 'pointfindercoreelements'),
										'name' => 'opacity',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '0,2',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 1,
										'step' => '0.1',
									),
								),
							),
							array(
								'key' => 'field_5fa3eb2a5c43e',
								'label' => __('Menu Bar Background (Sticky)', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_page_headerbarsettings_bgcolor2',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa3e66fb0a01',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa3eb2a5c43f',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#000000',
									),
									array(
										'key' => 'field_5fa3eb2a5c440',
										'label' => __('Opacity', 'pointfindercoreelements'),
										'name' => 'opacity',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '50',
											'class' => '',
											'id' => '',
										),
										'default_value' => '0,2',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 1,
										'step' => '0.1',
									),
								),
							),
							array(
								'key' => 'field_5fa3e649b0a00',
								'label' => __('Footer Row', 'pointfindercoreelements'),
								'name' => '',
								'type' => 'tab',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'placement' => 'left',
								'endpoint' => 0,
							),
							array(
								'key' => 'field_5fa446bca913a',
								'label' => __('Custom Footer', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_status',
								'type' => 'button_group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa446f2a913b',
								'label' => __('Column Number', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_cols',
								'type' => 'button_group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('1', 'pointfindercoreelements'),
									2 => __('2', 'pointfindercoreelements'),
									3 => __('3', 'pointfindercoreelements'),
									4 => __('4', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 4,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_5fa4473ba913c',
								'label' => __('1st Column Widget Area', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_sidebar1',
								'type' => 'select',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '2',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '3',
										),
									),
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '4',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
								),
								'default_value' => false,
								'allow_null' => 1,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
							array(
								'key' => 'field_5fa44760a913d',
								'label' => __('2nd Column Widget Area', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_sidebar2',
								'type' => 'select',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '2',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '3',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '4',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
								),
								'default_value' => false,
								'allow_null' => 1,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
							array(
								'key' => 'field_5fa4477aa913e',
								'label' => __('3rd Column Widget Area', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_sidebar3',
								'type' => 'select',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '3',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '4',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
								),
								'default_value' => false,
								'allow_null' => 1,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
							array(
								'key' => 'field_5fa44789a913f',
								'label' => __('4th Column Widget Area', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_sidebar4',
								'type' => 'select',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446f2a913b',
											'operator' => '==',
											'value' => '4',
										),
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
								),
								'default_value' => false,
								'allow_null' => 1,
								'multiple' => 0,
								'ui' => 0,
								'return_format' => 'value',
								'ajax' => 0,
								'placeholder' => '',
							),
							array(
								'key' => 'field_5fa473756196e',
								'label' => __('Background (Before Row)', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_bgopt2',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa473756196f',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
									),
									array(
										'key' => 'field_5fa4737561970',
										'label' => __('Image', 'pointfindercoreelements'),
										'name' => 'image',
										'type' => 'image',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
										'preview_size' => 'thumbnail',
										'library' => 'all',
										'min_width' => '',
										'min_height' => '',
										'min_size' => '',
										'max_width' => '',
										'max_height' => '',
										'max_size' => '',
										'mime_types' => 'jpg,png,jpeg',
									),
									array(
										'key' => 'field_5fa4737561971',
										'label' => __('Repeat', 'pointfindercoreelements'),
										'name' => 'repeat',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'no-repeat' => __('No Repeat', 'pointfindercoreelements'),
											'repeat' => __('Repeat', 'pointfindercoreelements'),
											'repeat-x' => __('Repeat Horizontally', 'pointfindercoreelements'),
											'repeat-y' => __('Repeat Vertically', 'pointfindercoreelements'),
											'inherit' => __('Inherit', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa4737561972',
										'label' => __('Size', 'pointfindercoreelements'),
										'name' => 'size',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'inherit' => __('Inherit', 'pointfindercoreelements'),
											'cover' => __('Cover', 'pointfindercoreelements'),
											'contain' => __('Contain', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa4737561973',
										'label' => __('Position', 'pointfindercoreelements'),
										'name' => 'position',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'left top' => __('Left Top', 'pointfindercoreelements'),
											'left center' => __('Left Center', 'pointfindercoreelements'),
											'left bottom' => __('Left Bottom', 'pointfindercoreelements'),
											'center top' => __('Center Top', 'pointfindercoreelements'),
											'center center' => __('Center Center', 'pointfindercoreelements'),
											'center bottom' => __('Center Bottom', 'pointfindercoreelements'),
											'right top' => __('Right Top', 'pointfindercoreelements'),
											'right center' => __('Right Center', 'pointfindercoreelements'),
											'right bottom' => __('Right Bottom', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa473fa61974',
								'label' => __('Background Height (Before Row)', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_bgopt2w',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa4741961975',
										'label' => __('Height', 'pointfindercoreelements'),
										'name' => 'height',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa4748a61976',
										'label' => __('Unit', 'pointfindercoreelements'),
										'name' => 'unit',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'px' => __('px', 'pointfindercoreelements'),
											'em' => __('em', 'pointfindercoreelements'),
											'%' => __('%', 'pointfindercoreelements'),
										),
										'default_value' => 'px',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa474d861977',
								'label' => __('Margin (Before Row)', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_bgopt2m',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa474d861978',
										'label' => __('Top', 'pointfindercoreelements'),
										'name' => 'top',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa474fc6197a',
										'label' => __('Bottom', 'pointfindercoreelements'),
										'name' => 'bottom',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa474d861979',
										'label' => __('Unit', 'pointfindercoreelements'),
										'name' => 'unit',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'px' => __('px', 'pointfindercoreelements'),
											'em' => __('em', 'pointfindercoreelements'),
											'%' => __('%', 'pointfindercoreelements'),
										),
										'default_value' => 'px',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa4759261985',
								'label' => __('Background', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_bgopt',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa4759361986',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
									),
									array(
										'key' => 'field_5fa4759361987',
										'label' => __('Image', 'pointfindercoreelements'),
										'name' => 'image',
										'type' => 'image',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
										'preview_size' => 'thumbnail',
										'library' => 'all',
										'min_width' => '',
										'min_height' => '',
										'min_size' => '',
										'max_width' => '',
										'max_height' => '',
										'max_size' => '',
										'mime_types' => 'jpg,png,jpeg',
									),
									array(
										'key' => 'field_5fa4759361988',
										'label' => __('Repeat', 'pointfindercoreelements'),
										'name' => 'repeat',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'no-repeat' => __('No Repeat', 'pointfindercoreelements'),
											'repeat' => __('Repeat', 'pointfindercoreelements'),
											'repeat-x' => __('Repeat Horizontally', 'pointfindercoreelements'),
											'repeat-y' => __('Repeat Vertically', 'pointfindercoreelements'),
											'inherit' => __('Inherit', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa4759361989',
										'label' => __('Size', 'pointfindercoreelements'),
										'name' => 'size',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'inherit' => __('Inherit', 'pointfindercoreelements'),
											'cover' => __('Cover', 'pointfindercoreelements'),
											'contain' => __('Contain', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa475936198a',
										'label' => __('Position', 'pointfindercoreelements'),
										'name' => 'position',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'left top' => __('Left Top', 'pointfindercoreelements'),
											'left center' => __('Left Center', 'pointfindercoreelements'),
											'left bottom' => __('Left Bottom', 'pointfindercoreelements'),
											'center top' => __('Center Top', 'pointfindercoreelements'),
											'center center' => __('Center Center', 'pointfindercoreelements'),
											'center bottom' => __('Center Bottom', 'pointfindercoreelements'),
											'right top' => __('Right Top', 'pointfindercoreelements'),
											'right center' => __('Right Center', 'pointfindercoreelements'),
											'right bottom' => __('Right Bottom', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa475b56198b',
								'label' => __('Text Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_textcolor1',
								'type' => 'color_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '#000000',
							),
							array(
								'key' => 'field_5fa475e36198c',
								'label' => __('Link Color', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_textcolor2',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa475fb6198d',
										'label' => __('Regular', 'pointfindercoreelements'),
										'name' => 'regular',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#000000',
									),
									array(
										'key' => 'field_5fa476146198e',
										'label' => __('Hover', 'pointfindercoreelements'),
										'name' => 'hover',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#B32E2E',
									),
								),
							),
							array(
								'key' => 'field_5fa4766c6198f',
								'label' => __('Padding', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_spacing',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa4766c61990',
										'label' => __('Top', 'pointfindercoreelements'),
										'name' => 'top',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 50,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa4766c61991',
										'label' => __('Bottom', 'pointfindercoreelements'),
										'name' => 'bottom',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 50,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa4766c61992',
										'label' => __('Unit', 'pointfindercoreelements'),
										'name' => 'unit',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'px' => __('px', 'pointfindercoreelements'),
											'em' => __('em', 'pointfindercoreelements'),
											'%' => __('%', 'pointfindercoreelements'),
										),
										'default_value' => 'px',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa476a561993',
								'label' => __('Margin', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_spacing2',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa476a561994',
										'label' => __('Top', 'pointfindercoreelements'),
										'name' => 'top',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa476a561995',
										'label' => __('Bottom', 'pointfindercoreelements'),
										'name' => 'bottom',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 9999,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa476a561996',
										'label' => __('Unit', 'pointfindercoreelements'),
										'name' => 'unit',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'px' => __('px', 'pointfindercoreelements'),
											'em' => __('em', 'pointfindercoreelements'),
											'%' => __('%', 'pointfindercoreelements'),
										),
										'default_value' => 'px',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
								),
							),
							array(
								'key' => 'field_5fa476c961997',
								'label' => __('Border', 'pointfindercoreelements'),
								'name' => 'webbupointfinder_gbf_border',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5fa446bca913a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_5fa476c961998',
										'label' => __('Top', 'pointfindercoreelements'),
										'name' => 'top',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 1,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa476c961999',
										'label' => __('Bottom', 'pointfindercoreelements'),
										'name' => 'bottom',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => 0,
										'max' => 1,
										'step' => 1,
									),
									array(
										'key' => 'field_5fa476c96199a',
										'label' => __('Unit', 'pointfindercoreelements'),
										'name' => 'unit',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'px' => __('px', 'pointfindercoreelements'),
											'em' => __('em', 'pointfindercoreelements'),
											'%' => __('%', 'pointfindercoreelements'),
										),
										'default_value' => 'px',
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_5fa477016199b',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
									),
								),
							),
							array(
								'key' => 'field_600c50e6d5e10',
								'label' => __('Point Button', 'pointfindercoreelements'),
								'name' => '',
								'type' => 'tab',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'placement' => 'left',
								'endpoint' => 0,
							),
							array(
								'key' => 'field_600c5165d5e16',
								'label' => __('Status', 'pointfindercoreelements'),
								'name' => 'pf_sbmt_status',
								'type' => 'button_group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									1 => __('Enable', 'pointfindercoreelements'),
									0 => __('Disable', 'pointfindercoreelements'),
								),
								'allow_null' => 0,
								'default_value' => 0,
								'layout' => 'horizontal',
								'return_format' => 'value',
							),
							array(
								'key' => 'field_600c5134d5e12',
								'label' => __('Text Color', 'pointfindercoreelements'),
								'name' => 'pf_sbmt_textcolor',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_600c5165d5e16',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_600c5134d5e13',
										'label' => __('Regular', 'pointfindercoreelements'),
										'name' => 'regular',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#000000',
									),
									array(
										'key' => 'field_600c5134d5e14',
										'label' => __('Hover', 'pointfindercoreelements'),
										'name' => 'hover',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#B32E2E',
									),
								),
							),
							array(
								'key' => 'field_600c51a4d5e18',
								'label' => __('Background Color', 'pointfindercoreelements'),
								'name' => 'pf_sbmt_backgroundcolor',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_600c5165d5e16',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_600c51a4d5e19',
										'label' => __('Regular', 'pointfindercoreelements'),
										'name' => 'regular',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#000000',
									),
									array(
										'key' => 'field_600c51a4d5e1a',
										'label' => __('Hover', 'pointfindercoreelements'),
										'name' => 'hover',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '#B32E2E',
									),
								),
							),
							array(
								'key' => 'field_600c51b9d5e1b',
								'label' => __('Border', 'pointfindercoreelements'),
								'name' => 'pf_sbmt_border',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_600c5165d5e16',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'layout' => 'table',
								'sub_fields' => array(
									array(
										'key' => 'field_600c51d4d5e1c',
										'label' => __('Color', 'pointfindercoreelements'),
										'name' => 'color',
										'type' => 'color_picker',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
									),
									array(
										'key' => 'field_600c51edd5e1d',
										'label' => __('Width (px)', 'pointfindercoreelements'),
										'name' => 'width',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
									array(
										'key' => 'field_600c5208d5e1e',
										'label' => __('Type', 'pointfindercoreelements'),
										'name' => 'type',
										'type' => 'select',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'choices' => array(
											'solid' => __('Solid', 'pointfindercoreelements'),
											'dashed' => __('Dashed', 'pointfindercoreelements'),
											'dotted' => __('Dotted', 'pointfindercoreelements'),
										),
										'default_value' => false,
										'allow_null' => 0,
										'multiple' => 0,
										'ui' => 0,
										'return_format' => 'value',
										'ajax' => 0,
										'placeholder' => '',
									),
									array(
										'key' => 'field_600c5243d5e1f',
										'label' => __('Radius	(px)', 'pointfindercoreelements'),
										'name' => 'radius',
										'type' => 'number',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
								),
							),
						),
						'location' => array(
							array(
								array(
									'param' => 'post_type',
									'operator' => '==',
									'value' => 'page',
								),
							),
						),
						'menu_order' => 0,
						'position' => 'normal',
						'style' => 'default',
						'label_placement' => 'top',
						'instruction_placement' => 'label',
						'hide_on_screen' => '',
						'active' => true,
						'description' => '',
					));
				/*
				* End : Page Options 
				*/
			}
		}


	/*
	* End : ACF Fields
	*/

	public function unregister_cpts(){

		if (wp_doing_ajax() && isset($_POST['action']) && $_POST['action'] == 'heartbeat') {
			
		}else{
			$setup4_membersettings_loginregister = $this->PFSAIssetControl('setup4_membersettings_loginregister','','1');
	        $setup4_membersettings_frontend = $this->PFSAIssetControl('setup4_membersettings_frontend','','1');
	        $setup4_membersettings_paymentsystem = $this->PFSAIssetControl('setup4_membersettings_paymentsystem','','1');
	        $setup3_pointposttype_pt6_status = $this->PFSAIssetControl('setup3_pointposttype_pt6_status','','1');
	        $setup11_reviewsystem_check = $this->PFREVSIssetControl('setup11_reviewsystem_check','','0');
	        
         	if($setup3_pointposttype_pt6_status != 1){
            	unregister_post_type(''.$this->agent_post_type_name.'');
	        }
	        if($setup11_reviewsystem_check != 1){
	        	unregister_post_type('pointfinderreviews');
	        }
	        if(($setup4_membersettings_frontend != 1 && $setup4_membersettings_loginregister != 1) || $setup4_membersettings_paymentsystem != 1){
	        	unregister_post_type('pointfinderorders');
	        	unregister_post_type('pflistingpacks');
	        }
	        if(($setup4_membersettings_frontend != 1 && $setup4_membersettings_loginregister != 1) || $setup4_membersettings_paymentsystem != 2){
	        	unregister_post_type('pointfindermorders');
	        	unregister_post_type('pfmembershippacks');
	        }
	        if($setup4_membersettings_frontend != 1 && $setup4_membersettings_loginregister != 1){
	        	unregister_post_type('pointfinderinvoices');
	        }
		}
		
	}

}
