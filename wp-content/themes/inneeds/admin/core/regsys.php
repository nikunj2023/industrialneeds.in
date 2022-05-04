<?php 

add_action( 'wp_ajax_pfget_registration', 'pf_ajax_registration' );
add_action( 'wp_ajax_nopriv_pfget_registration', 'pf_ajax_registration' );

if(!function_exists('pf_ajax_registration')){
	function pf_ajax_registration(){
		  
		check_ajax_referer( 'pfget_registration', 'security');
	  
		header('Content-Type: application/json; charset=UTF-8;');

		if (current_user_can('activate_plugins')) {
			
			$key = $apistatus = $dereg = $drrpcode = '';
		
			if(isset($_POST['productcode']) && $_POST['productcode']!=''){
				$key = esc_attr($_POST['productcode']);
			}
			
			if(isset($_POST['apistatus']) && $_POST['apistatus']!=''){
				$apistatus = esc_attr($_POST['apistatus']);
			}

			if(isset($_POST['dereg']) && $_POST['dereg']!=''){
				$dereg = esc_attr($_POST['dereg']);
			}

			if(isset($_POST['drrpcode']) && $_POST['drrpcode']!=''){
				$drrpcode = esc_attr($_POST['drrpcode']);
			}

			if (empty($key) && empty($apistatus) && empty($dereg) && empty($drrpcode)) {
				wp_send_json_error( esc_html__( 'One of the fields are empty.', 'pointfinder' ) );
			}

			if (!empty($drrpcode)) {
				$drrtextarea = $drrpweb = '';

				if(isset($_POST['drremail']) && $_POST['drremail']!=''){
					$drremail = esc_attr($_POST['drremail']);
				}

				if(isset($_POST['drrpweb']) && $_POST['drrpweb']!=''){
					$drrpweb = esc_attr($_POST['drrpweb']);
				}

				if (!is_email( $drremail )) {
					wp_send_json_error( esc_html__( "Please use a correct email address.","pointfinder" ));
				}

				if (empty($drrpweb)) {
					wp_send_json_error( esc_html__( "Web address is a required field.","pointfinder" ));
				}

				$response = wp_remote_post( "https://api.webbu.com/regreport.php", array(
					'method' => 'POST',
					'timeout' => 120,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array(
						'drrpcode' => $drrpcode,
						'drrpweb' => home_url( "/" ).' - User: '.$drrpweb,
						'drremail' => $drremail,
					)
				));
				
				if ( is_wp_error( $response ) ) {
				   wp_send_json_error( $response->get_error_message() );
				} else {
					if (isset($response['body'])) {
						$response_info = json_decode($response['body']);
						if (isset($response_info->status)) {

							if ($response_info->status == 'success') {
								wp_send_json_success();
							}else{
								wp_send_json_error( $response_info->reason );
							}
							
						}else{
							wp_send_json_error(wp_sprintf(esc_html__( "An error happened while we processing your request. Please contact with us by using profile page contact form %shttps://themeforest.net/user/webbu%s ", "pointfinder" ),'<a href="https://themeforest.net/user/webbu" target="_blank">','</a>'));
						}
					}else{
						wp_send_json_error(wp_sprintf(esc_html__( "An error happened while we processing your request. Please contact with us by using profile page contact form %shttps://themeforest.net/user/webbu%s ", "pointfinder" ),'<a href="https://themeforest.net/user/webbu" target="_blank">','</a>'));
					}
				}
			}

			if (!empty($dereg)) {

				$drrtextarea = $drremail = '';

				if(isset($_POST['drremail']) && $_POST['drremail']!=''){
					$drremail = esc_attr($_POST['drremail']);
				}

				if(isset($_POST['drrtextarea']) && $_POST['drrtextarea']!=''){
					$drrtextarea = esc_attr($_POST['drrtextarea']);
				}

				if (!is_email( $drremail )) {
					wp_send_json_error( esc_html__( "Please use a correct email address.","pointfinder" ));
				}

				if (empty($drrtextarea)) {
					wp_send_json_error( esc_html__( "Reason is a required field. Please type the reason of deregistration.","pointfinder" ));
				}

				

				$license_code = get_option('envato_license_code_10298703','');

				$response = wp_remote_post( "https://api.webbu.com/licensemanager.php", array(
					'method' => 'POST',
					'timeout' => 120,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array(
						'dereg' => $dereg,
						'lcode' => $license_code,
						'domain' => home_url( "/" ),
						'email' => $drremail,
						'reason' => $drrtextarea
					)
				));
				
				if ( is_wp_error( $response ) ) {
				   wp_send_json_error( $response->get_error_message() );
				} else {
					if (isset($response['body'])) {
						$response_info = json_decode($response['body']);
						if (isset($response_info->status)) {

							if ($response_info->status == 'success') {
								delete_option('envato_purchase_code_10298703');
								delete_option('envato_license_code_10298703');
								wp_send_json_success();
							}else{
								wp_send_json_error( $response_info->reason );
							}
							
						}else{
							wp_send_json_error(wp_sprintf(esc_html__( "We couldn't receive information from API server. If you having a problem while registering the theme. Please contact our support by using this form %sRegistration Problem Report Form%s ", "pointfinder" ),'<a href="#regproblemreport" class="btn">','</a>'));
						}
					}else{
						wp_send_json_error(wp_sprintf(esc_html__( "We couldn't receive information from API server. If you having a problem while registering the theme. Please contact our support by using this form %sRegistration Problem Report Form%s ", "pointfinder" ),'<a href="#regproblemreport" class="btn">','</a>'));
					}
				}
			}

			if (!empty($apistatus) && empty($key)) {
				$response = wp_remote_post( "https://api.webbu.com/apicheck.php", array(
					'method' => 'POST',
					'timeout' => 120,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array(),
					'body' => array( 'domain' => home_url( "/" ) )
				));

				$http_code = wp_remote_retrieve_response_code( $response );
				
				if ( is_wp_error( $response ) ) {
				   wp_send_json_error( $response->get_error_message() );
				} else {
					if ($http_code == 200) {
						wp_send_json_success();
					}else{
						wp_send_json_error( $http_code );
					}
				}
			}

			if (empty($key)) {
				wp_send_json_error( esc_html__( 'You must fill the license key.', 'pointfinder' ) );
			}

			
			$response = wp_remote_post( "https://api.webbu.com/licensemanager.php", array(
				'method' => 'POST',
				'timeout' => 120,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => array(),
				'body' => array( 'license' => $key, 'domain' => home_url( "/" ) ),
				'cookies' => array()
			    )
			);

			if ( is_wp_error( $response ) ) {

			   wp_send_json_error( $response->get_error_message() );

			} else {
				
				if (isset($response['body'])) {
					$response_info = json_decode($response['body']);
					if (isset($response_info->status)) {

						if ($response_info->status == 'success') {
							update_option('envato_purchase_code_10298703', $key);
							update_option('envato_license_code_10298703', $response_info->license_code);
							wp_send_json_success( esc_html__( 'Registration Successful.','pointfinder' ) );
						}else{
							wp_send_json_error( $response_info->reason );
						}
						
					}else{
						wp_send_json_error(wp_sprintf(esc_html__( "We couldn't receive information from API server. If you having a problem while registering the theme. Please contact our support by using this form %sRegistration Problem Report Form%s ", "pointfinder" ),'<a href="#regproblemreport" class="btn">','</a>'));
					}
				}else{
					wp_send_json_error(wp_sprintf(esc_html__( "We couldn't receive information from API server. If you having a problem while registering the theme. Please contact our support by using this form %sRegistration Problem Report Form%s ", "pointfinder" ),'<a href="#regproblemreport" class="btn">','</a>'));
				}
				
			}
						
		}else{
			wp_send_json_error( esc_html__( 'Only administrator can activate this system.', 'pointfinder' ) );
		}

		die();
	}
}