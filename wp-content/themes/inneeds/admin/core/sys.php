<?php 

function pointfinder_register_my_page(){
    add_menu_page( esc_html__('Welcome','pointfinder'), esc_html__('Point Finder','pointfinder'), 'manage_options', 'pointfinder_tools', 'pointfinder_tools_content', 'dashicons-location' );
    add_submenu_page('pointfinder_tools', '', esc_html__("Registration","pointfinder"), 'manage_options', 'pointfinder_registration', 'pointfinder_registrationpg_content');
    add_submenu_page('pointfinder_tools', '', esc_html__("System Status","pointfinder"), 'manage_options', 'pointfinder_sysstatus', 'pointfinder_sysstatuspg_content');
}

add_action( 'admin_menu', 'pointfinder_register_my_page',7 );

function pointfinder_tools_content(){
?>

	<div class="wrap about-wrap pointfinder">
		
		<h1><?php echo esc_html__('PointFinder Directory Theme','pointfinder');?></h1>
		
	<?php
	$purchase_code = get_option('envato_purchase_code_10298703');
	$license_code = get_option('envato_license_code_10298703');
	$is_registered = false;
	if (!empty($license_code) && !empty($purchase_code)) {
		$is_registered = true;
	}

	if ( !$is_registered ){ ?>
	<div class="about-text"><?php echo sprintf(esc_html__('PointFinder is now installed and ready to use! Please %sregister%s your product to install Premium Plugins and get automatic updates.','pointfinder'),'<a href="'.admin_url('admin.php?page=pointfinder_registration').'">','</a>');?></div>
	<?php }else{ ?>
	<div class="about-text"></div>
	<?php } ?>

	  <h2 class="nav-tab-wrapper">
	  	<a href="<?php echo admin_url('admin.php?page=pointfinder_tools');?>" class="nav-tab nav-tab-active">
	       <?php echo esc_html__('Welcome','pointfinder');?></a>
	   	<a href="<?php echo admin_url('admin.php?page=pointfinder_registration');?>" class="nav-tab nav-tab"><?php echo esc_html__('Registration','pointfinder');?></a>
	   	<a href="<?php echo admin_url('admin.php?page=pointfinder_sysstatus');?>" class="nav-tab nav-tab"><?php echo esc_html__('System Status','pointfinder');?></a>
	  </h2>
	  <div class="pointfinder-main-window"><div>
	    <div class="pointfinder-main-window-content">

		<?php

			$theme = wp_get_theme();
			global $wpdb;
			if (defined("PFCOREPLUGIN_NAME_VERSION")) {
				$pluginversion = 'v'.PFCOREPLUGIN_NAME_VERSION;
			}else{
				$pluginversion = '<small style="font-size:14px">-</small>';
			}

			echo '<div class="pfawidget">';
			echo '<div class="pfawidget-body">';
		 	

		 	echo '<div class="accordion">';
		 	echo '
		 	<div class="accordion-header"><h2>'.esc_html__('THEME INFORMATION','pointfinder').'</h2></div>
					<div class="accordion-body">
						<div class="accordion-mainit">
							<div class="accordion-status-text" style="color: #8EC34B!important;">v'.$theme->version.'</div>
							'.esc_html__('Theme Version','pointfinder').'
						</div>
						<div class="accordion-mainit">
							<div class="accordion-status-text" style="color: #8EC34B!important;">'.$pluginversion.'</div>
							'.esc_html__('Core Plugin Version','pointfinder').'
						</div>
					</div>';
			
			echo '</div></div></div>';

	 		echo '<div class="pfawidget regwidget">';
			echo '<div class="pfawidget-body">';
		 	

		 	echo '<div class="accordion">';
		
			echo '
			<div class="accordion-header"><h2>'.esc_html__('THEME SUPPORT INFORMATION','pointfinder').'</h2></div>
			<div class="accordion-body">
				<div class="accordion-mainit">
					<div class="accordion-status-text"><a href="https://pointfinderdocs.wethemes.com/" target="_blank">'.esc_html__('View','pointfinder').'</a></div>
					'.esc_html__('Online Help Documentation','pointfinder').'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text"><a href="https://pointfinderdocs.wethemes.com/knowledgebase/requirements/" target="_blank">'.esc_html__('View','pointfinder').'</a></div>
					'.esc_html__('Requirements','pointfinder').'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text"><a href="https://pointfinderdocs.wethemes.com/kb/troubleshooting/" target="_blank">'.esc_html__('View','pointfinder').'</a></div>
					'.esc_html__('Troubleshooting','pointfinder').'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text"><a href="http://support.webbudesign.com/forums/topic/changelog/" target="_blank">'.esc_html__('View','pointfinder').'</a></div>
					'.esc_html__('Changelog','pointfinder').'
				</div>
			</div>
			<div id="modal-window-id" style="display:none;">
			    <p>Lorem Ipsum sit dolla amet.</p>
			</div>
			';
			echo '</div></div></div>';

			if(PFSAIssetControl('setup4_membersettings_loginregister','','1') == 1){

				$setup3_pointposttype_pt1 = PFSAIssetControl('setup3_pointposttype_pt1','','pfitemfinder');
				$pf_published_items = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",$setup3_pointposttype_pt1,'publish'));

				if(PFSAIssetControl('setup4_membersettings_frontend','','1') == 1){

					$pf_pendingapproval_items = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",$setup3_pointposttype_pt1,'pendingapproval'));
					$pf_pendingpayment_items = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",$setup3_pointposttype_pt1,'pendingpayment'));
					echo '<div class="pfawidget regwidget">';
					echo '<div class="pfawidget-body">';
				 	

				 	echo '<div class="accordion">';
					echo '
					<div class="accordion-header"><h2>'.esc_html__('MAIN SYSTEM STATUS','pointfinder').'</h2></div>
					<div class="accordion-body">
						<div class="accordion-mainit">
							<div class="accordion-status-text"><a href="'.admin_url("edit.php?post_status=publish&post_type=$setup3_pointposttype_pt1").'">'.$pf_published_items.'</a></div>
							'.esc_html__('Published','pointfinder').'
						</div>
						<div class="accordion-mainit">
							<div class="accordion-status-text"><a href="'.admin_url("edit.php?post_status=pendingapproval&post_type=$setup3_pointposttype_pt1").'">'.$pf_pendingapproval_items.'</a></div>
							'.esc_html__('Pending Approval','pointfinder').'
						</div>
						<div class="accordion-mainit">
							<div class="accordion-status-text"><a href="'.admin_url("edit.php?post_status=pendingpayment&post_type=$setup3_pointposttype_pt1").'">'.$pf_pendingpayment_items.'</a></div>
							'.esc_html__('Pending Payment','pointfinder').'
						</div>
					</div>
					';
					echo '</div></div></div>';

				}
			}
			if (PFREVSIssetControl('setup11_reviewsystem_check','','0') == 1) {
				$pf_published_reviews = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",'pointfinderreviews','publish'));
				$pf_pendingapproval_reviews = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",'pointfinderreviews','pendingapproval'));
				$pf_pendingpayment_reviews = $wpdb->get_var($wpdb->prepare("select count(ID) from $wpdb->posts where post_type='%s' and post_status='%s'",'pointfinderreviews','pendingpayment'));
				echo '<div class="pfawidget regwidget">';
				echo '<div class="pfawidget-body">';
			 	

			 	echo '<div class="accordion">';
				echo '
				<div class="accordion-header">
					<h2>'.esc_html__('REVIEW SYSTEM STATUS','pointfinder').'</h2>
				</div>
				<div class="accordion-body">
					<div class="accordion-mainit">
						<div class="accordion-status-text">'.$pf_published_reviews.'</div>
						'.esc_html__('Published','pointfinder').'
					</div>
					<div class="accordion-mainit">
						<div class="accordion-status-text">'.$pf_pendingapproval_reviews.'</div>
						'.esc_html__('Pending Approval','pointfinder').'
					</div>
					<div class="accordion-mainit">
						<div class="accordion-status-text">'.$pf_pendingpayment_reviews.'</div>
						'.esc_html__('Pending Check','pointfinder').'
					</div>
				</div>
				';
				echo '</div></div></div>';
			}
	      ?>

	    </div>
	    </div>
	  </div>
	  <div class="clear"></div>
	  </div>

	</div>
<?php
}

function pointfinder_registrationpg_content(){
$token = '';
$items = '';
$is_registered = false;
$purchase_code = get_option('envato_purchase_code_10298703');
$license_code = get_option('envato_license_code_10298703');

$regclass = 'unregistered';
if (!empty($license_code) && !empty($purchase_code)) {
	$is_registered = true;$regclass = 'registered';
}
?>
	<div class="wrap about-wrap pointfinder">

    <h1><?php echo esc_html__('PointFinder Directory Theme','pointfinder');?></h1>
	<?php if ( !$is_registered ){ ?>
    <div class="about-text"><?php echo esc_html__('You can enable Quick setup and Premium plugin support by registering your product.','pointfinder');?></div>
	<?php }else{ ?>
	<div class="about-text"></div>
	<?php } ?>
    <h2 class="nav-tab-wrapper">
    	<a href="<?php echo admin_url('admin.php?page=pointfinder_tools');?>" class="nav-tab nav-tab">
         <?php echo esc_html__('Welcome','pointfinder');?></a>
     	<a href="<?php echo admin_url('admin.php?page=pointfinder_registration');?>" class="nav-tab nav-tab-active"><?php echo esc_html__('Registration','pointfinder');?></a>
     	<a href="<?php echo admin_url('admin.php?page=pointfinder_sysstatus');?>" class="nav-tab nav-tab"><?php echo esc_html__('System Status','pointfinder');?></a>
    </h2>
    
    <div class="pointfinder-main-window">
      
      <br/>
      <div class="pointfinder-main-window-content pf-box-reg <?php echo esc_attr($regclass);?>">
            <?php if ( $is_registered ) :

         		echo '<div class="pfawidget regwidget">';
				echo '<div class="pfawidget-body">';
			 	

			 	echo '<div class="accordion">';
			 	echo '
			 	<div class="accordion-header"><h2>'.esc_html__('REGISTRATION STATUS','pointfinder').'</h2></div>
				<div class="accordion-body">
					 <p class="about-description">'.esc_html__( 'Congratulations! Your product is registered.', 'pointfinder' ).'</p>
				</div>';
		

				echo '
				<div class="accordion-header"><h2>'.esc_html__('REGISTRATION INFORMATION','pointfinder').'</h2></div>
				<div class="accordion-body">
					<div class="accordion-mainit">
						<div class="accordion-status-text">'.$purchase_code.'</div>
						'.esc_html__('Purchase Code','pointfinder').'
					</div>
					<div class="accordion-mainit">
						<div class="accordion-status-text">'.$license_code.'</div>
						'.esc_html__('License Code','pointfinder').'
					</div>
					<div class="accordion-mainit">
						<div class="accordion-status-text"><a href="#pfderegisterrequest" class="pfderegisterrequest">'.esc_html__( "CLICK HERE TO DEREGISTER",'pointfinder').'</a></div>
						'.esc_html__('Online Deregistration','pointfinder').'
						<br/><small>'.wp_sprintf(esc_html__('Deregistrations are not unlimited. Please read %sthis article%s to learn more information about deregistrations.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/theme-licences-and-activation/" target="blank">','</a>').'</small>
					</div>
				</div>
				
				';
				echo '</div></div></div>';
              ?>
              <div id="pfderegisterrequest" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false" class="light-modal" >
              	<div class="pointfinderderegisterrequest light-modal-content pf-light-modal">
              		<div class="light-modal-header">
		                <h3 class="light-modal-heading"><?php echo esc_html__( "Online Deregistration Form", "pointfinder" );?></h3>
		                <a href="#" class="light-modal-close-icon" aria-label="close">&times;</a>
		            </div>
		            <div class="light-modal-body">
	                  	<p><?php esc_attr_e( 'All form fields are required to send this request.', 'pointfinder' ); ?><br/><small><?php echo wp_sprintf(esc_html__('Deregistrations are not unlimited. Please read %sthis article%s to learn more information about deregistrations.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/theme-licences-and-activation/" target="blank">','</a>');?></small></p>
	                  	<label for="drremail"><?php esc_attr_e( 'Email Address', 'pointfinder' ); ?></label>
					    <input type="text" name="drremail" id="drremail" class="pointfinder-product-code-field" value="<?php echo get_bloginfo('admin_email');?>">
					    <label for="drrpcode"><?php esc_attr_e( 'Purchase Code', 'pointfinder' ); ?></label>
	                    <input type="text" name="drrpcode" id="drrpcode" class="pointfinder-product-code-field" value="<?php echo esc_attr($purchase_code);?>">
	                    <label for="drrtextarea"><?php esc_attr_e( 'Reason', 'pointfinder' ); ?></label>
	                    <textarea name="drrtextarea" id="drrtextarea" class="pointfinder-product-code-field"></textarea>
	                    <input type="submit" name="submit" id="pointfinder_deregister" class="button button-primary button-large pointfinder-deregister" value="<?php esc_attr_e( 'Send Request', 'pointfinder' ); ?>">
	                    <div class="process-pf"></div>
	                </div>

            	</div>
			</div>
            <?php else : ?>
              <p class="about-description"><?php esc_attr_e( 'Please add your PointFinder Theme Purchase Code.', 'pointfinder' ); ?></p>
              <div>
              <form id="pointfinder_product_registration" method="post">
                <input type="text" name="productcode" id="productcode" class="pointfinder-product-code" value="<?php echo esc_attr($purchase_code);?>">
                
                <input type="submit" name="submit" id="pointfinder_register" class="button button-primary button-large pointfinder-register" value="<?php esc_attr_e( 'Verify', 'pointfinder' ); ?>">
                <input type="button" name="submit" id="pointfinder_api_check" class="button button-secondary-pf button-large pointfinder-api-check" value="<?php esc_attr_e( 'Check API Server Status', 'pointfinder' ); ?>">
              	
              </form>
          	  <div class="auth-check-section"><span class="auth-status notchecked"></span><span class="auth-tstatus"></span></div>

          	    <div id="regproblemreport" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false" class="light-modal" >
                  	<div class="pointfinderderegisterrequest light-modal-content pf-light-modal">
                  		<div class="light-modal-header">
			                <h3 class="light-modal-heading"><?php echo esc_html__( "Registration Problem Report", "pointfinder" );?></h3>
			                <a href="#" class="light-modal-close-icon" aria-label="close">&times;</a>
			            </div>
			            <div class="light-modal-body">
		                  	<p><?php esc_attr_e( 'All form fields are required to send this request.', 'pointfinder' ); ?><br/><small><?php esc_html_e('This form only built to report registration problems. Please use our support forum for your support requests.','pointfinder');?></small></p>
		                  	<label for="drremail"><?php esc_attr_e( 'Email Address', 'pointfinder' ); ?></label>
						    <input type="text" name="drremail" id="drremail" class="pointfinder-product-code-field" value="<?php echo get_bloginfo('admin_email');?>">
						    <label for="drrpcode"><?php esc_attr_e( 'Purchase Code', 'pointfinder' ); ?></label>
		                    <input type="text" name="drrpcode" id="drrpcode" class="pointfinder-product-code-field" value="<?php echo esc_attr($purchase_code)?>">
		                    <label for="drrpweb"><?php esc_attr_e( 'Website', 'pointfinder' ); ?></label>
		                    <input type="text" name="drrpweb" id="drrpweb" class="pointfinder-product-code-field" value="<?php echo home_url("/");?>">
		                    <input type="submit" name="submit" id="pointfinder_regreport" class="button button-primary button-large pointfinder-regreport" value="<?php esc_attr_e( 'Send Report', 'pointfinder' ); ?>">
		                    <div class="process-pf"></div>
		                </div>

                	</div>
				</div>


				<div id="deregproblemreport" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false" class="light-modal" >
                  	<div class="pointfinderderegisterrequest light-modal-content pf-light-modal">
                  		<div class="light-modal-header">
			                <h3 class="light-modal-heading"><?php echo esc_html__( "Registration Problem Report", "pointfinder" );?></h3>
			                <a href="#" class="light-modal-close-icon" aria-label="close">&times;</a>
			            </div>
			            <div class="light-modal-body">
		                  	<p><?php esc_attr_e( 'All form fields are required to send this request.', 'pointfinder' ); ?><br/><small><?php esc_html_e('This form only built to report deregistration problems. Please use our support forum for your support requests.','pointfinder');?></small></p>
		                  	<label for="drremail"><?php esc_attr_e( 'Email Address', 'pointfinder' ); ?></label>
						    <input type="text" name="drremail" id="drremail" class="pointfinder-product-code-field" value="<?php echo get_bloginfo('admin_email');?>">
						    <label for="drrpcode"><?php esc_attr_e( 'Purchase Code', 'pointfinder' ); ?></label>
		                    <input type="text" name="drrpcode" id="drrpcode" class="pointfinder-product-code-field" value="<?php echo esc_attr($purchase_code);?>">
		                    <label for="drrpweb"><?php esc_attr_e( 'Website', 'pointfinder' ); ?></label>
		                    <input type="text" name="drrpweb" id="drrpweb" class="pointfinder-product-code-field" value="<?php echo home_url("/");?>">
		                    <label for="drrtextarea"><?php esc_attr_e( 'Reason', 'pointfinder' ); ?></label>
	                    	<textarea name="drrtextarea" id="drrtextarea" class="pointfinder-product-code-field"></textarea>
		                    <input type="submit" name="submit" id="pointfinder_deregreport" class="button button-primary button-large pointfinder-deregreport" value="<?php esc_attr_e( 'Send Report', 'pointfinder' ); ?>">
		                    <div class="process-pf"></div>
		                </div>

                	</div>
				</div>
          	  <?php endif; ?>

            <?php if ( !$is_registered ) : ?>
            <div style="font-size:16px;line-height:27px;">
              <hr>

              <h3><?php esc_html_e( 'Where can I find my Envato Purchase Code?', 'pointfinder' ); ?></h3>
              
              <ol>
                <li><?php echo wp_sprintf(esc_html__( 'Access your %sThemeForest downloads%s with the account that was used to purchase PointFinder.', 'pointfinder' ),'<a href="https://themeforest.net/downloads" target="_blank">','</a>'); ?></li>
                <li><?php esc_html_e( "Look for PointFinder in your list of purchases, click the Download button and select 'License Certificate & Purchase Code'", 'pointfinder' );?></li>
                <li><?php esc_html_e( "Copy the 'Item Purchase Code' into the field 'Envato Purchase Code' of the Registration page.", 'pointfinder' );?></li>
                <li><?php esc_html_e( "Paste it to the above input area and click verify and wait until the system verifies it", 'pointfinder' );?></li>
              </ol>
              <small><?php esc_html_e( "Please contact our support team if you have any problem while registering.", 'pointfinder' );?></small>
            </div>
            <?php endif; ?>

                </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    </div>

  </div>
  <?php
}


function pointfinder_sysstatuspg_content(){
$is_registered = false;
$purchase_code = get_option('envato_purchase_code_10298703');
$license_code = get_option('envato_license_code_10298703');

if (!empty($license_code) && !empty($purchase_code)) {
	$is_registered = true;
}
?>

	<div class="wrap about-wrap pointfinder">
		
		<h1><?php echo esc_html__('PointFinder Directory Theme','pointfinder');?></h1>
	<?php if(!$is_registered){?>
	  <div class="about-text"><?php echo wp_sprintf(esc_html__('PointFinder is now installed and ready to use! Please %sregister%s your product to install Premium Plugins and get automatic updates.','pointfinder'),'<a href="'.admin_url('admin.php?page=pointfinder_registration').'">','</a>');?></div>
	<?php }else{?>
		<div class="about-text"></div>
	<?php }?>
	  <h2 class="nav-tab-wrapper">
	  	<a href="<?php echo admin_url('admin.php?page=pointfinder_tools');?>" class="nav-tab">
	       <?php echo esc_html__('Welcome','pointfinder');?></a>
	   	<a href="<?php echo admin_url('admin.php?page=pointfinder_registration');?>" class="nav-tab nav-tab"><?php echo esc_html__('Registration','pointfinder');?></a>
		<a href="<?php echo admin_url('admin.php?page=pointfinder_sysstatus');?>" class="nav-tab nav-tab nav-tab-active"><?php echo esc_html__('System Status','pointfinder');?></a>
	  </h2>
	  <div class="pointfinder-main-window"><div>
	    <div class="pointfinder-main-window-content">
		<?php
	     	
	     	global $wpdb;
			


			echo '<div class="pfawidget">';
			echo '<div class="pfawidget-body">';

		 	echo '<div class="accordion">';

			$ssl_text = $api_text = $api_text2 = $dash_text = $miv_text = $met_text = $ml_text = $pms_text = $umfs_text = $curl_text = $php_text = $mfu_text = $mit_text = '';

			$miv_css = $met_css = $api_css = $api_css2 = $ssl_css = $dash_css = $ml_css = $pms_css = $umfs_css = $curl_css = $php_css = $mfu_css = $mit_css = ' pf-st-ok';

			$ssl_check = (is_ssl())? '<span class="dashicons dashicons-yes"></span>':'<span class="dashicons dashicons-no-alt"></span>';
			if (!is_ssl()) {
				$ssl_text = '<br/><small>'.wp_sprintf(esc_html__('You are not using ssl and you may have problems on google map. Please read %sthis article%s.','pointfinder'),'<a href="https://support.wethemes.com/forums/topic/no-https-then-say-goodbye-to-geolocation-in-chrome-50/" target="blank">','</a>').'</small>';
				$ssl_css = '';
			}


			$setup4_membersettings_dashboard = PFSAIssetControl('setup4_membersettings_dashboard','','');
			$dash_check = (!empty($setup4_membersettings_dashboard))? '<span class="dashicons dashicons-yes"></span>':'<span class="dashicons dashicons-no-alt"></span>';
			if (empty($setup4_membersettings_dashboard)) {
				$dash_text = '<br/><small>'.wp_sprintf(esc_html__('Your dashboard page not configured and you may have problems on you site. Please read %sthis article%s.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/page-not-found-while-submitting-new-item/" target="blank">','</a>').'</small>';
				$dash_css = '';
			}

			echo '
			<div class="accordion-header">
				<h2>'.esc_html__('SYSTEM HEALTH CHECK','pointfinder').'</h2>
			</div>
			<div class="accordion-body">
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$ssl_css.'">'.$ssl_check.'</div>
					'.esc_html__('SSL Check','pointfinder').$ssl_text.'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$dash_css.'">'.$dash_check.'</div>
					'.esc_html__('Dashboard Page Check','pointfinder').$dash_text.'
				</div>
			</div>
			';


			$miv_check = ini_get('max_input_vars');

			if ($miv_check <= 10000) {
				$miv_text = '<br/><small>'.wp_sprintf(esc_html__('You have to increase this value to 10000 otherwise you may have problems while saving admin options. Please read %sthis article%s.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/what-is-this-message-there-was-a-problem-with-your-action-please/" target="blank">','</a>').'</small>';
				$miv_css = '';
			}

			$ml_check = ini_get('memory_limit');
			if (in_array($ml_check, array('32M','64M','128M','256M'))) {
				$ml_text = '<br/><small>'.wp_sprintf(esc_html__('You have to increase this value otherwise you may have problems. Please read %sthis article%s.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/increasing-the-wordpress-memory-limit/" target="blank">','</a>').'</small>';
				$ml_css = '';
			}

			$met_check = ini_get('max_execution_time');
			if (($met_check < 600) || $met_check == 0 ) {
				$met_text = '<br/><small>'.esc_html__('You have to increase this value otherwise you may have problems. Recommended value: 400 or more','pointfinder').'</small>';
				$met_css = '';
			}

			$pms_check = ini_get('post_max_size');
			if (in_array($pms_check, array('2M','4M','8M','16M'))) {
				$pms_text = '<br/><small>'.wp_sprintf(esc_html__('You have to increase this value otherwise you may have problems. Please read %sthis article%s.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/requirements/" target="blank">','</a>').'</small>';
				$pms_css = '';
			}

			$umfs_check = ini_get('post_max_size');
			if (in_array($umfs_check, array('2M','4M','8M','16M'))) {
				$umfs_text = '<br/><small>'.wp_sprintf(esc_html__('You have to increase this value otherwise you may have problems. Please read %sthis article%s.','pointfinder'),'<a href="https://pointfinderdocs.wethemes.com/knowledgebase/requirements/" target="blank">','</a>').'</small>';
				$umfs_css = '';
			}

			$php_version_num = (function_exists('phpversion'))?phpversion():'';
			$curl_version_num = (function_exists('curl_version'))?curl_version():'';
			$curl_version_num = (isset($curl_version_num['version']))?$curl_version_num['version']:'<span class="dashicons dashicons-no-alt"></span>';

			$mfu_check = ini_get('max_file_uploads');
			$mit_check = ini_get('max_input_time');

			if(version_compare($curl_version_num, "7.34.0", "<=")){
				$curl_text = '<br/><small>'.wp_sprintf(esc_html__('You have to use v7.34.0 with TLS 1.2 for Paypal Payments otherwise you may have problems. Please read %sthis article%s.','pointfinder'),'<a href="https://developer.paypal.com/docs/api/info-security-guidelines/#:~:text=PayPal%20has%20updated%20its%20services,vulnerabilities%20that%20have%20been%20deprecated." target="blank">','</a>').'</small>';
				$curl_css = '';
			}

			if(version_compare($php_version_num, "5.6.0", "<=")){
				$php_text = '<br/><small>'.esc_html__('You have to use php v5.6.x otherwise you may have problems.','pointfinder').'</small>';
				$php_css = '';
			}


			if ($mfu_check < 20) {
				$mfu_text = '<br/><small>'.esc_html__('You have to increase this value otherwise you may have problems. Recommended value: 20 or more','pointfinder').'</small>';
				$mfu_css = '';
			}

			if ($mit_check < 20) {
				$mit_text = '<br/><small>'.esc_html__('You have to increase this value otherwise you may have problems. Recommended value: 20 or more','pointfinder').'</small>';
				$mit_css = '';
			}
			echo '</div></div></div>';


			echo '<div class="pfawidget">';
			echo '<div class="pfawidget-body">';

		 	echo '<div class="accordion">';
			echo '
			<div class="accordion-header">
				<h2>'.esc_html__('PHP VARIABLES CHECK','pointfinder').'</h2>
			</div>
			<div class="accordion-body">
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$miv_css.'">'.$miv_check.'</div>
					'.esc_html__('max_input_vars','pointfinder').$miv_text.'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$ml_css.'">'.$ml_check.'</div>
					'.esc_html__('memory_limit','pointfinder').$ml_text.'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$met_css.'">'.$met_check.'</div>
					'.esc_html__('max_execution_time','pointfinder').$met_text.'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$pms_css.'">'.$pms_check.'</div>
					'.esc_html__('post_max_size','pointfinder').$pms_text.'
				</div>
				<div class="accordion-mainit">
					<div class="accordion-status-text'.$umfs_css.'">'.$umfs_check.'</div>
					'.esc_html__('upload_max_filesize','pointfinder').$umfs_text.'
				</div>

				<div class="accordion-mainit">
					<div class="accordion-status-text'.$mfu_css.'">'.$mfu_check.'</div>
					'.esc_html__('max_file_uploads','pointfinder').$mfu_text.'
				</div>

				<div class="accordion-mainit">
					<div class="accordion-status-text'.$mit_css.'">'.$mit_check.'</div>
					'.esc_html__('max_input_time','pointfinder').$mit_text.'
				</div>

				<div class="accordion-mainit">
					<div class="accordion-status-text'.$curl_css.'">'.$curl_version_num.'</div>
					'.esc_html__('cURL Version Check','pointfinder').$curl_text.'
				</div>

				<div class="accordion-mainit">
					<div class="accordion-status-text'.$php_css.'">'.$php_version_num.'</div>
					'.esc_html__('Php Version Check','pointfinder').$php_text.'
				</div>
			</div>
			';

			echo '</div></div></div>';
	      ?>

	    </div>
	    </div>
	  </div>
	  <div class="clear"></div>
	  </div>

	</div>
<?php
}