<?php 
if (!class_exists('PointFinderGETUserChange')) {
	class PointFinderGETUserChange extends Pointfindercoreelements_AJAX
	{
	    public function __construct(){}

	    public function pf_ajax_authorchangesystem(){
		  	check_ajax_referer( 'pfget_featuresystem', 'security');
		  
			header('Content-Type: application/json;charset=UTF-8;');

			$q = $output = '';
			
			if(isset($_POST['q']) && $_POST['q']!=''){
				$q = sanitize_text_field($_POST['q']);
			}

			global $wpdb;

			$output_arr = array();

			$results = $wpdb->get_results($wpdb->prepare("SELECT ID,user_login FROM $wpdb->users where user_login like %s","%$q%"),'ARRAY_A');
			
			if (is_array($results)) {
				foreach ($results as $value) {
					$output_arr[]= array("id"=>$value['ID'], "nickname" => $value['user_login']);
				}
			}

			echo json_encode($output_arr);
			
			die();
		} 
	  
	}
}