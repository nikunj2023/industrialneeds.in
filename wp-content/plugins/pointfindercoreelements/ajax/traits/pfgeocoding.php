<?php 
if (!class_exists('PointFinderGeocoding')) {
	class PointFinderGeocoding extends Pointfindercoreelements_AJAX
	{
	    public function __construct(){}

	    public function pf_ajax_geocoding(){
	  	    check_ajax_referer( 'pfget_geocoding', 'security');
			header('Content-Type: application/json; charset=UTF-8;');
			$debug = 0;

			if(isset($_GET['q']) && $_GET['q']!=''){
				$searchtext = sanitize_text_field($_GET['q']);
			}

			if(isset($_GET['ctype']) && $_GET['ctype']!=''){
				$wemap_geoctype = sanitize_text_field($_GET['ctype']);
				if($wemap_geoctype == 'undefined'){
					$wemap_geoctype = 'here';
				}
			}

			if(isset($_GET['lat']) && $_GET['lat']!=''){
				$lat = floatval($_GET['lat']);
			}

			if(isset($_GET['lng']) && $_GET['lng']!=''){
				$lng = floatval($_GET['lng']);
			}

			$wemap_lang = $this->PFSAIssetControl('setup5_mapsettings_maplanguage','','');
			$country = $this->PFSAIssetControl('wemap_country','','');

			if(isset($_GET['option']) && $_GET['option']!=''){
				$option = sanitize_text_field($_GET['option']);
			}
			
			if (empty($wemap_geoctype)) {
				$response_array = array(
					"status"    => false,
				    "error"     => esc_html__('Wrong Type', 'pointfindercoreelements'),
				    "data"      => array(
				    	"found" => array()
				    )
				);
				echo json_encode($response_array);
				die();
			}


			switch ($wemap_geoctype) {
				case 'opencage':
					$wemap_opencagekey = $this->PFSAIssetControl('wemap_opencagekey','','');
					if (empty($wemap_opencagekey)) {
						$response_array = array(
							"status"    => false,
						    "error"     => esc_html__('Wrong API Info', 'pointfindercoreelements'),
						    "data"      => array(
						    	"found" => array()
						    )
						);
						echo json_encode($response_array);
						die();
					}

					if ($option == 'geocode') {
						$url = "https://api.opencagedata.com/geocode/v1/json";
						$full_url = add_query_arg( array(
						    'q' => urlencode($searchtext),
						    'key' => $wemap_opencagekey,
						    'language' => $wemap_lang,
						    'countrycode' => $country
						), $url );
					}elseif ($option == 'reverse') {
						$url = "https://api.opencagedata.com/geocode/v1/json";
						$full_url = add_query_arg( array(
						    'q' => "".$lat.",".$lng."",
						    'key' => $wemap_opencagekey,
						    'language' => $wemap_lang,
						), $url );
					}

					break;

				
				case 'photon':

					if ($option == 'geocode') {
						$url = "https://photon.komoot.de/api/";  
						$full_url = add_query_arg( array(
						    'q' => urlencode($searchtext),
						    'limit' => 10
						), $url );
					}elseif ($option == 'reverse') {
						$url = "https://photon.komoot.de/reverse";
						$full_url = add_query_arg( array(
						    'lat' => $lat,
						    'lon' => $lng,
						    'limit' => 1
						), $url );
					}
					break;

				case 'nominatim':

					if ($option == 'geocode') {
						$url = "https://nominatim.openstreetmap.org/search";  
						$full_url = add_query_arg( array(
						    'q' => urlencode($searchtext),
						    'format' => 'jsonv2',
						    'accept-language' => $wemap_lang
						), $url );
					}elseif ($option == 'reverse') {
						$url = "https://nominatim.openstreetmap.org/reverse";
						$full_url = add_query_arg( array(
						    'lat' => $lat,
						    'lon' => $lng,
						    'addressdetails' => 1,
						    'accept-language' => $wemap_lang,
						    'format' => 'jsonv2',
						    'country' => $country
						), $url );
					}
					break;

				
				case 'arcgis':
					if ($option == 'geocode') {
						$url = "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/findAddressCandidates";  
						$full_url = add_query_arg( array(
						    'singleLine' => urlencode($searchtext),
						    'f' => 'json',
						    'outFields' => 'Addr_type',
						    'maxLocations' => 10,
						    'langCode' => $wemap_lang,
						    'sourceCountry' => $country
						), $url );
					}elseif ($option == 'reverse') {
						$url = "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/reverseGeocode";
						$full_url = add_query_arg( array(
						    'location' => "".$lat.",".$lng."",
						    'maxLocations' => 10,
						    'f' => 'json',
						    'langCode' => $wemap_lang
						), $url );
					}
					break;

				
			}

			
			if (empty($full_url)) {
			 	$response_array = array(
					"status"    => false,
				    "error"     => esc_html__('Wrong URL', 'pointfindercoreelements'),
				    "data"      => array(
				    	"found" => array()
				    )
				);
				echo json_encode($response_array);
				die();
			} 
			
		
			$curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $full_url,
			    CURLOPT_USERAGENT => 'PointFinder cURL Request',
			    CURLOPT_CONNECTTIMEOUT => 10,
			    CURLOPT_TIMEOUT => 10
			));
			$resp = curl_exec($curl);
			curl_close($curl);
		
			$resp_arr = json_decode($resp);
			if($resp_arr === null) {
				$response_array = array(
					"status"    => false,
				    "error"     => esc_html__('Wrong JSON', 'pointfindercoreelements'),
				    "data"      => array(
				    	"found" => array()
				    )
				);
				echo json_encode($response_array);
				die();
			}

			$response_array = array(
				"status"    => true,
			    "error"     => null,
			    "data"      => array(
			    	"found" => array()
			    )
			);

			if ($debug == 1) {
				var_dump($full_url);
				var_dump($resp);
			}



			$response_array_reverse = '';

			switch ($wemap_geoctype) {
				case 'photon':
					if ($option == 'geocode') {
						if (isset($resp_arr->features)) {
							if (count($resp_arr->features) > 0) {
								foreach ($resp_arr->features as $single_feature) {
									$response_array['data']['found'][] = array(
										'address' => "".$single_feature->properties->name." ".$single_feature->properties->city." ".$single_feature->properties->state." ".$single_feature->properties->country."",
										'lng' => $single_feature->geometry->coordinates[0],
										'lat' => $single_feature->geometry->coordinates[1],
									);
								}
							}
						}
					}else{
						if (isset($resp_arr->features[0]->properties->name)) {
							$response_array_reverse = "".$resp_arr->features[0]->properties->name." ".$resp_arr->features[0]->properties->city." ".$resp_arr->features[0]->properties->state." ".$resp_arr->features[0]->properties->country."";
						}
					}
					break;

				case 'nominatim':
					if ($option == 'geocode') {
						if (isset($resp_arr)) {
							if (is_array($resp_arr)) {
								if (count($resp_arr) > 0) {
									foreach ($resp_arr as $resp_arr_single_nom) {
										$response_array['data']['found'][] = array(
											'address' => $resp_arr_single_nom->display_name,
											'lng' => $resp_arr_single_nom->lon,
											'lat' => $resp_arr_single_nom->lat,
										);
									}
								}
							}
						}
					}else{
						if (isset($resp_arr)) {
							$response_array_reverse = $resp_arr->display_name;	
						}
					}
					break;

				

				case 'arcgis':
					if ($option == 'geocode') {
						if (isset($resp_arr->candidates)) {
							if (count($resp_arr->candidates) > 0) {
								foreach ($resp_arr->candidates as $single_candidate) {
									$response_array['data']['found'][] = array(
										'address' => $single_candidate->address,
										'lng' => $single_candidate->location->x,
										'lat' => $single_candidate->location->y,
									);
								}
							}
						}
					}else{
						if (isset($resp_arr->address->LongLabel)) {
							$response_array_reverse = $resp_arr->address->LongLabel;
						}
					}
					break;

				

				case 'opencage':
				
					if ($option == 'reverse') {
				
						if (isset($resp_arr->results[0]->formatted)) {
							if (isset($resp_arr->results[0]->formatted) && !empty($resp_arr->results[0]->formatted)) {
								$response_array_reverse = $resp_arr->results[0]->formatted;
							}
						}
					}else{
						if ($resp_arr->status->message == "OK") {
							if (count($resp_arr->results) > 0) {
								foreach ($resp_arr->results as $ocage_result) {
									$response_array['data']['found'][] = array(
										'address' => $ocage_result->formatted,
										'lat' => $ocage_result->geometry->lat,
										'lng' => $ocage_result->geometry->lng,
									);
								}
							}
						}
					}
					break;
			}

			

			if ($option == 'geocode' && count($response_array['data']['found']) <= 0) {

				$response_array = array(
					"status"    => false,
				    "error"     => esc_html__('Nothing found', 'pointfindercoreelements'),
				    "data"      => array(
				    	"found" => array()
				    )
				);
				echo json_encode($response_array);
				die();
			}

			if ($option == 'reverse' && empty($response_array_reverse)) {
				$response_array_reverse = '';
				echo json_encode($response_array_reverse);
				die();

			}

			if ($option == 'geocode'){
				echo json_encode($response_array);
			}else{
				echo json_encode($response_array_reverse);
			}


			die();
		}
	}
}