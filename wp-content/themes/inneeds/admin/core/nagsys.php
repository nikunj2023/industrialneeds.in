<?php 

add_action( 'wp_ajax_pfget_nagsystem', 'pf_ajax_nagsystem' );
add_action( 'wp_ajax_nopriv_pfget_nagsystem', 'pf_ajax_nagsystem' );

if(!function_exists('pf_ajax_nagsystem')){
	function pf_ajax_nagsystem(){
		check_ajax_referer( 'pfget_nagsystem', 'security');
		header('Content-Type: application/json; charset=UTF-8;');
		
		$nstatus = $result = $nname = '';
		
		if(isset($_POST['nstatus']) && $_POST['nstatus']!=''){
			$nstatus = esc_attr($_POST['nstatus']);
		}

		if(isset($_POST['nname']) && $_POST['nname']!=''){
			$nname = esc_attr($_POST['nname']);
		}

		global $current_user;
	    $user_id = $current_user->ID;

	    if (!empty($user_id)) {
    		if ($nstatus == 0) {
    			update_user_meta($user_id, $nname, true);
    			$result = 1;
    		}else{
    			delete_user_meta($user_id, $nname);
    			$result = 1;
    		}
    		echo json_encode($result);
	    }

		die();
	}
}


add_action( 'admin_notices', 'pointfinder_new_version_notice');
add_action( 'admin_notices', 'pointfinder_register_notice');
add_action( 'admin_notices', 'pointfinder_register_notice_nd');

if(!function_exists('pointfinder_new_version_notice')){
	function pointfinder_new_version_notice() {
		if (current_user_can('activate_plugins')) {

			$pointfinder_new_version_warning = get_user_meta( get_current_user_id(), 'pointfinder_v2x_warningx', true);
			if (empty($pointfinder_new_version_warning)) {
				$class = 'notice notice-warning is-dismissible pointfinderdismisss';
				$message = '<strong>'.esc_html__( 'IMPORTANT (PointFinder Theme)', 'pointfinder' ).'</strong>';
				$message .= '<br/>'. wp_sprintf(esc_html__( 'Please read update the update procedures: %sPointFinder v1.x.x & v2.x.x Update Steps and Procedures%s', 'pointfinder'),"<a href='https://pointfinderdocs.wethemes.com/knowledgebase/pointfinder-v1-x-x-v2-x-x-update-steps-and-procedures/' target='_blank'>","</a>");
				$message .= '<button type="button" class="notice-dismiss">
					<span class="screen-reader-text">'.esc_html__( 'Dismiss this notice.', 'pointfinder' ).'</span>
				</button>';
				printf( '<div class="%1$s" id="pointfindernndismiss1"><p>%2$s</p></div>', esc_attr( $class ), $message);
			}

		}
	}
}


if(!function_exists('pointfinder_register_notice')){
	function pointfinder_register_notice() {
			
		$purchase_code = get_option('envato_purchase_code_10298703');
		$pointfinder_reg_warning = get_user_meta( get_current_user_id(), 'pointfinder_reg_warningx', true);
		if (empty($purchase_code) && empty($pointfinder_reg_warning)) {
			$class = 'notice notice-error is-dismissible';
			$message = wp_sprintf(esc_html__('PointFinder not registered yet. Please %sregister%s your product to install Premium Plugins and get automatic updates.','pointfinder'),'<a href="'.admin_url('admin.php?page=pointfinder_registration').'">','</a>');
			$message .= '<button type="button" class="notice-dismiss">
				<span class="screen-reader-text">'.esc_html__( 'Dismiss this notice.', 'pointfinder' ).'</span>
			</button>';
			printf( '<div class="%1$s" id="pointfinderregdismiss"><p>%2$s</p></div>', esc_attr( $class ), $message);
		}

	}
}


if(!function_exists('pointfinder_register_notice_nd')){
	function pointfinder_register_notice_nd() {
		
		$screen = get_current_screen();
		$post_type_name = PFSAIssetControl("setup3_pointposttype_pt1","","pfitemfinder");
		$agent_post_type_name = PFSAIssetControl("setup3_pointposttype_pt8","","agents");

		if (isset($screen->base)) {
			if (in_array($screen->base,array(
				'point-finder_page__pointfinderoptions',
				'point-finder_page__pfasconf',
				'point-finder_page__pfcifoptions',
				'point-finder_page__pfsifoptions',
				'point-finder_page__pfmailoptions',
				'point-finder_page__pfsidebaroptions',
				'point-finder_page__pfrevsystemconf',
				'point-finder_page__pfsizelimitconf',
				'point-finder_page__pfpgconf',
				'point-finder_page__pfpifoptions',
				'point-finder_page__pfadvancedlimitconf',
				'point-finder_page_pfwpmlstring',
			)) ||
				($screen->base == 'edit' && $screen->post_type == $post_type_name)
				||
				($screen->base == 'edit' && $screen->post_type == $agent_post_type_name)
				||
				($screen->base == 'edit' && $screen->post_type == 'pflistingpacks')
			) {
				$purchase_code = get_option('envato_purchase_code_10298703');
				$pointfinder_reg_warning = get_user_meta( get_current_user_id(), 'pointfinder_reg_warningx', true);
				
				if (empty($purchase_code) && !empty($pointfinder_reg_warning)) {
					$class = 'notice notice-error is-nondismissible';
					$message = wp_sprintf(esc_html__('PointFinder not registered yet. Please %sregister%s your product to install Premium Plugins and get automatic updates.','pointfinder'),'<a href="'.admin_url('admin.php?page=pointfinder_registration').'">','</a>');
					
					printf( '<div class="%1$s" id="pointfinderregnondismiss"><p>%2$s</p></div>', esc_attr( $class ), $message);
				}
			}
		}
	}
}