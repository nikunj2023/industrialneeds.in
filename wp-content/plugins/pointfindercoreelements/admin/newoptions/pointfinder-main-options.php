<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = 'pointfindertheme_options';

$args = array(
	'opt_name'                  => $opt_name,
	'global_variable'           => 'pointfindertheme_option',
	'display_name'              => esc_html__('Point Finder Options Panel','pointfindercoreelements'),
	'display_version'           => '',
	'menu_type'                 => 'submenu',
	'allow_sub_menu'            => true,
	'page_parent'               => 'pointfinder_tools',
	'menu_title'           		=> esc_html__('Options Panel','pointfindercoreelements'),
    'page_title'           		=> esc_html__('Point Finder Options Panel', 'pointfindercoreelements'),
	'async_typography'          => false,
	'admin_bar'                 => false,
	'admin_bar_priority'        => 50,
	'dev_mode'                  => false,
	'disable_google_fonts_link' => false,
	'admin_bar_icon'            => 'dashicons-portfolio',
	'customizer'                => false,
	'open_expanded'             => false,
	'disable_save_warn'         => false,
	'page_priority'             => null,
	'page_permissions'          => 'manage_options',
	'menu_icon'                 => 'dashicons-admin-tools',
	'last_tab'                  => '',
	'page_icon'                 => 'icon-themes',
	'page_slug'                 => '_pointfinderoptions',
	'save_defaults'             => true,
	'default_show'              => false,
	'default_mark'              => '*',
	'show_import_export'        => true,
	'transient_time'            => 60 * MINUTE_IN_SECONDS,
	'output'                    => true,
	'output_tag'                => true,
	'footer_credit'             => '',
	'use_cdn'                   => false,
	'admin_theme'               => 'wp',
	'database'                  => '',
	'network_admin'             => true,
    'load_on_cron'              => true
);

Redux::setArgs( $opt_name, $args );

/* Predefined arrays */
	$country3 = array("" => "All","AFG" => "Afghanistan","ALB" => "Albania","DZA" => "Algeria","ASM" => "American Samoa","AND" => "Andorra","AGO" => "Angola","AIA" => "Anguilla","ATA" => "Antarctica","ATG" => "Antigua and Barbuda","ARG" => "Argentina","ARM" => "Armenia","ABW" => "Aruba","AUS" => "Australia","AUT" => "Austria","AZE" => "Azerbaijan","BHS" => "Bahamas","BHR" => "Bahrain","BGD" => "Bangladesh","BRB" => "Barbados","BLR" => "Belarus","BEL" => "Belgium","BLZ" => "Belize","BEN" => "Benin","BMU" => "Bermuda","BTN" => "Bhutan","BOL" => "Bolivia","BIH" => "Bosnia and Herzegovina","BWA" => "Botswana","BVT" => "Bouvet Island","BRA" => "Brazil","IOT" => "British Indian Ocean Territory","BRN" => "Brunei","BGR" => "Bulgaria","BFA" => "Burkina Faso","BDI" => "Burundi","KHM" => "Cambodia","CMR" => "Cameroon","CAN" => "Canada","CPV" => "Cape Verde","CYM" => "Cayman Islands","CAF" => "Central African Republic","TCD" => "Chad","CHL" => "Chile","CHN" => "China","CXR" => "Christmas Island","CCK" => "Cocos (Keeling) Islands","COL" => "Colombia","COM" => "Comoros","COG" => "Congo","COD" => "Congo, the Democratic Republic of the","COK" => "Cook Islands","CRI" => "Costa Rica","CIV" => "Ivory Coast","HRV" => "Croatia","CUB" => "Cuba","CYP" => "Cyprus","CZE" => "Czech Republic","DNK" => "Denmark","DJI" => "Djibouti","DMA" => "Dominica","DOM" => "Dominican Republic","ECU" => "Ecuador","EGY" => "Egypt","SLV" => "El Salvador","GNQ" => "Equatorial Guinea","ERI" => "Eritrea","EST" => "Estonia","ETH" => "Ethiopia","FLK" => "Falkland Islands (Malvinas)","FRO" => "Faroe Islands","FJI" => "Fiji","FIN" => "Finland","FRA" => "France","GUF" => "French Guiana","PYF" => "French Polynesia","ATF" => "French Southern Territories","GAB" => "Gabon","GMB" => "Gambia","GEO" => "Georgia","DEU" => "Germany","GHA" => "Ghana","GIB" => "Gibraltar","GRC" => "Greece","GRL" => "Greenland","GRD" => "Grenada","GLP" => "Guadeloupe","GUM" => "Guam","GTM" => "Guatemala","GGY" => "Guernsey","GIN" => "Guinea","GNB" => "Guinea-Bissau","GUY" => "Guyana","HTI" => "Haiti","HMD" => "Heard Island and McDonald Islands","VAT" => "Holy See (Vatican City State)","HND" => "Honduras","HKG" => "Hong Kong","HUN" => "Hungary","ISL" => "Iceland","IND" => "India","IDN" => "Indonesia","IRN" => "Iran, Islamic Republic of","IRQ" => "Iraq","IRL" => "Ireland","IMN" => "Isle of Man","ISR" => "Israel","ITA" => "Italy","JAM" => "Jamaica","JPN" => "Japan","JEY" => "Jersey","JOR" => "Jordan","KAZ" => "Kazakhstan","KEN" => "Kenya","KIR" => "Kiribati","PRK" => "Korea, Democratic People's Republic of","KOR" => "South Korea","KWT" => "Kuwait","KGZ" => "Kyrgyzstan","LAO" => "Lao People's Democratic Republic","LVA" => "Latvia","LBN" => "Lebanon","LSO" => "Lesotho","LBR" => "Liberia","LBY" => "Libya","LIE" => "Liechtenstein","LTU" => "Lithuania","LUX" => "Luxembourg","MAC" => "Macao","MKD" => "Macedonia, the former Yugoslav Republic of","MDG" => "Madagascar","MWI" => "Malawi","MYS" => "Malaysia","MDV" => "Maldives","MLI" => "Mali","MLT" => "Malta","MHL" => "Marshall Islands","MTQ" => "Martinique","MRT" => "Mauritania","MUS" => "Mauritius","MYT" => "Mayotte","MEX" => "Mexico","FSM" => "Micronesia, Federated States of","MDA" => "Moldova, Republic of","MCO" => "Monaco","MNG" => "Mongolia","MNE" => "Montenegro","MSR" => "Montserrat","MAR" => "Morocco","MOZ" => "Mozambique","MMR" => "Burma","NAM" => "Namibia","NRU" => "Nauru","NPL" => "Nepal","NLD" => "Netherlands","ANT" => "Netherlands Antilles","NCL" => "New Caledonia","NZL" => "New Zealand","NIC" => "Nicaragua","NER" => "Niger","NGA" => "Nigeria","NIU" => "Niue","NFK" => "Norfolk Island","MNP" => "Northern Mariana Islands","NOR" => "Norway","OMN" => "Oman","PAK" => "Pakistan","PLW" => "Palau","PSE" => "Palestinian Territory, Occupied","PAN" => "Panama","PNG" => "Papua New Guinea","PRY" => "Paraguay","PER" => "Peru","PHL" => "Philippines","PCN" => "Pitcairn","POL" => "Poland","PRT" => "Portugal","PRI" => "Puerto Rico","QAT" => "Qatar","REU" => "Réunion","ROU" => "Romania","RUS" => "Russia","RWA" => "Rwanda","SHN" => "Saint Helena, Ascension and Tristan da Cunha","KNA" => "Saint Kitts and Nevis","LCA" => "Saint Lucia","SPM" => "Saint Pierre and Miquelon","VCT" => "St. Vincent and the Grenadines","WSM" => "Samoa","SMR" => "San Marino","STP" => "Sao Tome and Principe","SAU" => "Saudi Arabia","SEN" => "Senegal","SRB" => "Serbia","SYC" => "Seychelles","SLE" => "Sierra Leone","SGP" => "Singapore","SVK" => "Slovakia","SVN" => "Slovenia","SLB" => "Solomon Islands","SOM" => "Somalia","ZAF" => "South Africa","SGS" => "South Georgia and the South Sandwich Islands","ESP" => "Spain","LKA" => "Sri Lanka","SDN" => "Sudan","SUR" => "Suriname","SJM" => "Svalbard and Jan Mayen","SWZ" => "Swaziland","SWE" => "Sweden","CHE" => "Switzerland","SYR" => "Syrian Arab Republic","TWN" => "Taiwan","TJK" => "Tajikistan","TZA" => "Tanzania, United Republic of","THA" => "Thailand","TLS" => "Timor-Leste","TGO" => "Togo","TKL" => "Tokelau","TON" => "Tonga","TTO" => "Trinidad & Tobago","TUN" => "Tunisia","TUR" => "Turkey","TKM" => "Turkmenistan","TCA" => "Turks and Caicos Islands","TUV" => "Tuvalu","UGA" => "Uganda","UKR" => "Ukraine","ARE" => "United Arab Emirates","GBR" => "United Kingdom","USA" => "United States","UMI" => "United States Minor Outlying Islands","URY" => "Uruguay","UZB" => "Uzbekistan","VUT" => "Vanuatu","VEN" => "Venezuela","VNM" => "Vietnam","VGB" => "Virgin Islands, British","VIR" => "Virgin Islands, U.S.","WLF" => "Wallis and Futuna","ESH" => "Western Sahara","YEM" => "Yemen","ZMB" => "Zambia","ZWE" => "Zimbabwe");

	$country2 = array("" => "All","AF" => "Afghanistan","AL" => "Albania","DZ" => "Algeria","AS" => "American Samoa","AD" => "Andorra","AO" => "Angola","AI" => "Anguilla","AQ" => "Antarctica","AG" => "Antigua and Barbuda","AR" => "Argentina","AM" => "Armenia","AW" => "Aruba","AU" => "Australia","AT" => "Austria","AZ" => "Azerbaijan","BS" => "Bahamas","BH" => "Bahrain","BD" => "Bangladesh","BB" => "Barbados","BY" => "Belarus","BE" => "Belgium","BZ" => "Belize","BJ" => "Benin","BM" => "Bermuda","BT" => "Bhutan","BO" => "Bolivia","BA" => "Bosnia and Herzegovina","BW" => "Botswana","BV" => "Bouvet Island","BR" => "Brazil","IO" => "British Indian Ocean Territory","BN" => "Brunei","BG" => "Bulgaria","BF" => "Burkina Faso","BI" => "Burundi","KH" => "Cambodia","CM" => "Cameroon","CA" => "Canada","CV" => "Cape Verde","KY" => "Cayman Islands","CF" => "Central African Republic","TD" => "Chad","CL" => "Chile","CN" => "China","CX" => "Christmas Island","CC" => "Cocos (Keeling) Islands","CO" => "Colombia","KM" => "Comoros","CG" => "Congo","CD" => "Congo, the Democratic Republic of the","CK" => "Cook Islands","CR" => "Costa Rica","CI" => "Ivory Coast","HR" => "Croatia","CU" => "Cuba","CY" => "Cyprus","CZ" => "Czech Republic","DK" => "Denmark","DJ" => "Djibouti","DM" => "Dominica","DO" => "Dominican Republic","EC" => "Ecuador","EG" => "Egypt","SV" => "El Salvador","GQ" => "Equatorial Guinea","ER" => "Eritrea","EE" => "Estonia","ET" => "Ethiopia","FK" => "Falkland Islands (Malvinas)","FO" => "Faroe Islands","FJ" => "Fiji","FI" => "Finland","FR" => "France","GF" => "French Guiana","PF" => "French Polynesia","TF" => "French Southern Territories","GA" => "Gabon","GM" => "Gambia","GE" => "Georgia","DE" => "Germany","GH" => "Ghana","GI" => "Gibraltar","GR" => "Greece","GL" => "Greenland","GD" => "Grenada","GP" => "Guadeloupe","GU" => "Guam","GT" => "Guatemala","GG" => "Guernsey","GN" => "Guinea","GW" => "Guinea-Bissau","GY" => "Guyana","HT" => "Haiti","HM" => "Heard Island and McDonald Islands","VA" => "Holy See (Vatican City State)","HN" => "Honduras","HK" => "Hong Kong","HU" => "Hungary","IS" => "Iceland","IN" => "India","ID" => "Indonesia","IR" => "Iran, Islamic Republic of","IQ" => "Iraq","IE" => "Ireland","IM" => "Isle of Man","IL" => "Israel","IT" => "Italy","JM" => "Jamaica","JP" => "Japan","JE" => "Jersey","JO" => "Jordan","KZ" => "Kazakhstan","KE" => "Kenya","KI" => "Kiribati","KP" => "Korea, Democratic People's Republic of","KR" => "South Korea","KW" => "Kuwait","KG" => "Kyrgyzstan","LA" => "Lao People's Democratic Republic","LV" => "Latvia","LB" => "Lebanon","LS" => "Lesotho","LR" => "Liberia","LY" => "Libya","LI" => "Liechtenstein","LT" => "Lithuania","LU" => "Luxembourg","MO" => "Macao","MK" => "Macedonia, the former Yugoslav Republic of","MG" => "Madagascar","MW" => "Malawi","MY" => "Malaysia","MV" => "Maldives","ML" => "Mali","MT" => "Malta","MH" => "Marshall Islands","MQ" => "Martinique","MR" => "Mauritania","MU" => "Mauritius","YT" => "Mayotte","MX" => "Mexico","FM" => "Micronesia, Federated States of","MD" => "Moldova, Republic of","MC" => "Monaco","MN" => "Mongolia","ME" => "Montenegro","MS" => "Montserrat","MA" => "Morocco","MZ" => "Mozambique","MM" => "Burma","NA" => "Namibia","NR" => "Nauru","NP" => "Nepal","NL" => "Netherlands","AN" => "Netherlands Antilles","NC" => "New Caledonia","NZ" => "New Zealand","NI" => "Nicaragua","NE" => "Niger","NG" => "Nigeria","NU" => "Niue","NF" => "Norfolk Island","MP" => "Northern Mariana Islands","NO" => "Norway","OM" => "Oman","PK" => "Pakistan","PW" => "Palau","PS" => "Palestinian Territory, Occupied","PA" => "Panama","PG" => "Papua New Guinea","PY" => "Paraguay","PE" => "Peru","PH" => "Philippines","PN" => "Pitcairn","PL" => "Poland","PT" => "Portugal","PR" => "Puerto Rico","QA" => "Qatar","RE" => "Réunion","RO" => "Romania","RU" => "Russia","RW" => "Rwanda","SH" => "Saint Helena, Ascension and Tristan da Cunha","KN" => "Saint Kitts and Nevis","LC" => "Saint Lucia","PM" => "Saint Pierre and Miquelon","VC" => "St. Vincent and the Grenadines","WS" => "Samoa","SM" => "San Marino","ST" => "Sao Tome and Principe","SA" => "Saudi Arabia","SN" => "Senegal","RS" => "Serbia","SC" => "Seychelles","SL" => "Sierra Leone","SG" => "Singapore","SK" => "Slovakia","SI" => "Slovenia","SB" => "Solomon Islands","SO" => "Somalia","ZA" => "South Africa","GS" => "South Georgia and the South Sandwich Islands","ES" => "Spain","LK" => "Sri Lanka","SD" => "Sudan","SR" => "Suriname","SJ" => "Svalbard and Jan Mayen","SZ" => "Swaziland","SE" => "Sweden","CH" => "Switzerland","SY" => "Syrian Arab Republic","TW" => "Taiwan","TJ" => "Tajikistan","TZ" => "Tanzania, United Republic of","TH" => "Thailand","TL" => "Timor-Leste","TG" => "Togo","TK" => "Tokelau","TO" => "Tonga","TT" => "Trinidad &amp; Tobago","TN" => "Tunisia","TR" => "Turkey","TM" => "Turkmenistan","TC" => "Turks and Caicos Islands","TV" => "Tuvalu","UG" => "Uganda","UA" => "Ukraine","AE" => "United Arab Emirates","GB" => "United Kingdom","US" => "United States","UM" => "United States Minor Outlying Islands","UY" => "Uruguay","UZ" => "Uzbekistan","VU" => "Vanuatu","VE" => "Venezuela","VN" => "Vietnam","VG" => "Virgin Islands, British","VI" => "Virgin Islands, U.S.","WF" => "Wallis and Futuna","EH" => "Western Sahara","YE" => "Yemen","ZM" => "Zambia","ZW" => "Zimbabwe");

	$googlemaplangs = array("ar" => "Arabic","be" => "Belarusian","bg" => "Bulgarian","bn" => "Bengali","ca" => "Catalan","cs" => "Czech","da" => "Danish","de" => "German","el" => "Greek","en" => "English","en-Au" => "English (Australian)","en-GB" => "English (Great Britain)","es" => "Spanish","eu" => "Basque","fa" => "Farsi","fi" => "Finnish","fil" => "Filipino","fr" => "French","gl" => "Galician","gu" => "Gujarati","hi" => "Hindi","hr" => "Croatian","hu" => "Hungarian","id" => "Indonesian","it" => "Italian","iw" => "Hebrew","ja" => "Japanese","kk" => "Kazakh","kn" => "Kannada","ko" => "Korean","ky" => "Kyrgyz","lt" => "Lithuanian","lv" => "Latvian","mk" => "Macedonian","ml" => "Malayalam","mr" => "Marathi","my" => "Burmese","nl" => "Dutch","no" => "Norwegian","pa" => "Punjabi","pl" => "Polish","pt" => "Portuguese","pt-BR" => "Portuguese (Brazil)","pt-PT" => "Portuguese (Portugal)","ro" => "Romanian","ru" => "Russian","sk" => "Slovak","sl" => "Slovenian","sq" => "Albanian","sr" => "Serbian","sv" => "Swedish","ta" => "Tamil","te" => "Telugu","th" => "Thai","tl" => "Tagalog","tr" => "Turkish","uk" => "Ukrainian","uz" => "Uzbek","vi" => "Vietnamese","zh-CN" => "Chinese (Simlified)","zh-TW" => "Chinese (Traditional)");

	$heremapslang = array('ara' => 'Arabic','baq' => 'Basque','cat' => 'Catalan','chi' => 'Chinese (simplified)','cht' => 'Chinese (traditional)','cze' => 'Czech','dan' => 'Danish','dut' => 'Dutch','eng' => 'English','fin' => 'Finnish','fre' => 'French','ger' => 'German','gle' => 'Gaelic','gre' => 'Greek','heb' => 'Hebrew','hin' => 'Hindi','ind' => 'Indonesian','ita' => 'Italian','nor' => 'Norwegian','per' => 'Persian','pol' => 'Polish','por' => 'Portuguese','rus' => 'Russian','sin' => 'Sinhalese','spa' => 'Spanish','swe' => 'Swedish','tha' => 'Thai','tur' => 'Turkish','ukr' => 'Ukrainian','urd' => 'Urdu','vie' => 'Vietnamese','wel' => 'Welsh');

	if (class_exists('ReduxFramework', false)) {
		$pf_sidebar_options = array(
	        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
	        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
	        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
	    );
	    $pf_sidebar_options2 = array(
	        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
	        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
	    );
	} elseif(class_exists('Redux_Core')){
		$pf_sidebar_options = array(
	        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => Redux_Core::$url . 'assets/img/2cl.png'),
	        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => Redux_Core::$url . 'assets/img/2cr.png'),
	        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => Redux_Core::$url . 'assets/img/1col.png'),
	    );
	    $pf_sidebar_options2 = array(
	        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => Redux_Core::$url . 'assets/img/2cl.png'),
	        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => Redux_Core::$url . 'assets/img/2cr.png'),
	    );
	}
	
$sections = array();


/**
*Start : GENERAL SETTINS
**/
	/**
	*General Settings
	**/
	$sections[] = array(
		'id' => 'general',
		'title' => esc_html__('General Settings', 'pointfindercoreelements'),
		'icon' => 'el-icon-cogs',
		'fields' => array(
			array(
				'id' => 'applydesign',
				'type' => 'button_set',
				'title' => esc_html__('Dynamic CSS', 'pointfindercoreelements') ,
				'description' => esc_html__('Please change this option and save changes after edit the global settings by using Elementor. Also, you can use this option to regenerate dynamic styles.', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Apply', 'pointfindercoreelements') ,
					'2' => esc_html__('Apply', 'pointfindercoreelements')
				) ,
				'compiler' => true,
				'default' => '1',
			) ,
			array(
				'id' => 'eldisable',
				'type' => 'button_set',
				'title' => esc_html__('Elementor Support', 'pointfindercoreelements') ,
				'description' => esc_html__('Please disable this option if you do not want to use elementor on your theme.', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '0',
			) ,
			array(
				'id' => 'tandcfreg',
				'type' => 'button_set',
				'title' => esc_html__('Terms & Conditions Section', 'pointfindercoreelements') ,
				'description' => esc_html__('This option enables or disables Terms and Conditions section from the forms.', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '0',
			) ,
			array(
				'id' => 'eldisableglbl',
				'type' => 'button_set',
				'title' => esc_html__('Elementor Global CSS', 'pointfindercoreelements') ,
				'description' => esc_html__('This option enables or disables the Elementor Global CSS file load. Please do not disable this option if you are using Elementor while editing global design settings.', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1',
				'compiler' => true,
				'required' => array('eldisable', '=', '1')
			) ,
			array(
				'id' => 'general_hideadminbar',
				'type' => 'button_set',
				'title' => esc_html__('Admin Bar to Admins', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Show', 'pointfindercoreelements') ,
					'0' => esc_html__('Hide', 'pointfindercoreelements')
				) ,
				'default' => '1',
			) ,
			array(
				'id' => 'setup4_membersettings_hideadminbar',
				'type' => 'button_set',
				'title' => esc_html__('Admin Bar to Users', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Show', 'pointfindercoreelements') ,
					'0' => esc_html__('Hide', 'pointfindercoreelements')
				) ,
				'default' => '0'
			) ,
			array(
				'id' => 'general_retinasupport',
				'type' => 'button_set',
				'title' => esc_html__('Retina Images', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1',
			) ,

			array(
				'id' => 'general_responsive',
				'type' => 'button_set',
				'title' => esc_html__('Responsive Feature', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1',
			) ,
			array(
				'id' => 'setup3_modulessetup_breadcrumbs',
				'type' => 'button_set',
				'title' => esc_html__('Breadcrumbs Module', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1'
			),
			array(
                'id'        => 'as_tags_cloud',
                'type'      => 'spinner',
                'title'     => esc_html__('Tags Cloud Limit', 'pointfindercoreelements'),
                'desc'      => esc_html__('Limit for tags cloud widget.', 'pointfindercoreelements'),
                'default'   => '45',
                'min'       => '2',
                'step'      => '1',
                'max'       => '100'
            )

		) ,
	);

	/**
	*Logo Settings
	**/
	$sections[] = array(
		'id' => 'setup18_headerbarsettings',
		'subsection' => true,
		'title' => esc_html__('Logo Settings', 'pointfindercoreelements'),
		'fields' => array(

				array(
                    'id'        => 'setup17_logosettings_sitelogo',
                    'type'      => 'media',
                    'readonly'  => false,
                    'url'       => true,
                    'title'     => esc_html__('Logo', 'pointfindercoreelements'),
                    'hint'     => array('content' => esc_html__('This is non-retina logo.', 'pointfindercoreelements')),
                    'compiler' => true
                ),
                array(
                    'id'        => 'setup17_logosettings_sitelogo2x',
                    'type'      => 'media',
                    'url'       => true,
                    'readonly'  => false,
                    'title'     => esc_html__('Retina Logo (2x)', 'pointfindercoreelements'),
                    'hint'     => array('content' => esc_html__('This is retina logo. Please upload 2x size.', 'pointfindercoreelements')),
                    'compiler' => true
                ),

                array(
                    'id'        => 'setup17_logosettings_sitelogo2',
                    'type'      => 'media',
                    'url'       => true,
                    'readonly'  => false,
                    'title'     => esc_html__('Additional Logo', 'pointfindercoreelements'),
                    'hint'     => array('content' => esc_html__('The additional logo was built to upload additional logo variations like the white/dark edition of your logo. After upload, you can use this logo on your pages by using panels.', 'pointfindercoreelements')),
                    'compiler' => true
                ),
                array(
                    'id'        => 'setup17_logosettings_sitelogo22x',
                    'type'      => 'media',
                    'url'       => true,
                    'readonly'  => false,
                    'title'     => esc_html__('Retina Additonal Logo (2x)', 'pointfindercoreelements'),
                    'hint'     => array('content' => esc_html__('This is retina logo. Please upload 2x size.', 'pointfindercoreelements')),
                    'compiler' => true
                ),
                array(
                    'id'            => 'setup18_headerbarsettings_padding',
                    'type'          => 'spacing',
                    'mode'          => 'margin',
                    'all'			=> false,
                    'right'         => false,
                    'bottom'        => false,
                    'left'          => false,
                    'top' 			=> true,
                    'units'         => array('px'),
                    'units_extended'=> 'false',
                    'display_units' => 'true',
                    'title'         => esc_html__('Logo Top Margin', 'pointfindercoreelements'),
                    'desc'          => esc_html__('Logo area top margin.', 'pointfindercoreelements'),
                    'compiler'		=> true,
                    'default'       => array(
                        'margin-top'    => '30px',
                    ),
                )

		) ,
	);


	/**
	*Custom Css
	**/
	$sections[] = array(
		'id' => 'general_css',
		'title' => esc_html__('Custom Css', 'pointfindercoreelements'),
		'subsection' => true,
		'fields' => array(
			array(
                'id'        => 'pf_general_csscode',
                'type'      => 'ace_editor',
                'title'     => esc_html__('CSS Code', 'pointfindercoreelements'),
                'subtitle'  => esc_html__('Paste your CSS code here.', 'pointfindercoreelements'),
                'mode'      => 'css',
                'theme'     => 'monokai',
                'desc'      => __('Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.', 'pointfindercoreelements'),
                'default'   => "",
                'compiler' => true
            ),
		) ,
	);
/**
*End : GENERAL SETTINS
**/




/**
*Start : THEME CUSTOMIZER
**/
	$sections[] = array(
		'id' => 'general_tcus',
		'title' => esc_html__('Theme Customizer', 'pointfindercoreelements'),
		'icon' => 'el-icon-magic',
		'fields' => array(
			
            /*
            array(
                'id'         => 'oneclicktheme',
                'type'       => 'image_select',
                'presets'    => true,
                'full_width' => true,
                'title'      => esc_html__('One Click Theme Change', 'pointfindercoreelements'),
                'subtitle'   => esc_html__('This option will change all layout settings with one click. Please becarefull while using because this option will override your existing options panel styles. I strongly recommend you to backup your panel before apply.', 'pointfindercoreelements'),
                'default'    => 0,
                'compiler'   => true,
                'options'    => array(
                    '1' => array(
                        'alt'     => 'Dark Mode',
                        'img'     => ReduxFramework::$_url . '../sample/presets/preset1.png',
                        'presets' => array(
                            'switch-on'     => 1,
                            'switch-off'    => 1,
                            'switch-parent' => 1
                        )
                    ),
                    '2' => array(
                        'alt'     => 'Light Mode',
                        'img'     => ReduxFramework::$_url . '../sample/presets/preset2.png',
                        'presets' => '{"opt-slider-label":"1", "opt-slider-text":"10"}'
                    ),
                ),
            ),*/
		)

	);
	/**
	*Top Line: Styles
	**/
	$sections[] = array(
		'id' => 'setup27_socialiconsbarstyles',
		'subsection' => true,
		'title' => esc_html__('Top Line', 'pointfindercoreelements'),
		
		'fields' => array(
				array(
                    'id' => 'general_toplinedstatus',
                    'type' => 'button_set',
                    'title' => esc_html__('Desktop: Topline Status', 'pointfindercoreelements') ,
                    'default' => 1,
                    'compiler' => true,
                    'options' => array(
                        '1' => esc_html__('Show', 'pointfindercoreelements') ,
                        '0' => esc_html__('Hide', 'pointfindercoreelements')
                    ),
                ),
                array(
	                'id'      => 'gn_toplineheight',
	                'type'    => 'spinner',
	                'title'   => esc_html__('Topline Height', 'pointfindercoreelements'),
	                'default' => '30',
	                'min'     => '30',
	                'step'    => '1',
	                'max'     => '100',
	                'compiler' => true
	            ),
				array(
					'id' => 'setup19_socialiconsbarsettings_phoneemail_typo',
					'type' => 'typography',
					'title' => esc_html__('Top Line Area Typography', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('This section will affect Phone/Email/My Account menu texts', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'color' => false,
					'line-height' => false,
					'compiler' => array(
						'.wpf-header .pf-sociallinks .pf-infolinks-item a span',
						'#pf-topprimary-nav .pfnavmenu li a',
						'.pointfinder-currency-changer'

					) ,
					'units' => 'px',
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '13px'
					) ,

				) ,
				array(
					'id' => 'setup19_socialiconsbarsettings_theme_bg',
					'type' => 'color',
					'mode' => 'background',
					'transparent' => false,
					'compiler' => array(
						'.wpf-header .pftopline'
					) ,
					'title' => esc_html__('Top Line Area Background', 'pointfindercoreelements') ,
					'default' => '#28353d',
					'validate' => 'color',

				) ,
				array(
					'id' => 'setup27_socialiconsbarstyles_theme_textcolor',
					'type' => 'link_color',
					'title' => esc_html__('Top Line Area Text Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'.wpf-header .pf-sociallinks .pf-sociallinks-item a',
						'.wpf-header .pf-sociallinks .pf-sociallinks-item.pf-infolinks-item a',
						'#pf-topprimary-nav .pfnavmenu li a',
						'.wpf-header .pf-sociallinks .pf-sociallinks-item',
						'.wpf-header .pf-sociallinks .pf-sociallinks-item.pf-infolinks-item',
						'#pf-topprimary-nav .pfnavmenu li',
						'.pointfinder-currency-changer:after',
						'.pointfinder-currency-changer'
					) ,
					'default' => array(
						'regular' => '#e8e8e8',
						'hover' => '#fff'
					) ,
				) ,
				array(
					'id' => 'setup27_socialiconsbarstyles_dropdown_backgrounds',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'#pf-topprimary-nav .pfnavmenu .pfnavsub-menu li'
					) ,
					'title' => esc_html__('My Account: Dropdown Menu Background', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#28353d',
						'hover' => '#a32221'
					) ,
					'validate' => 'color',

				) ,
				array(
					'id' => 'setup27_socialiconsbarstyles_dropdown_textc',
					'type' => 'link_color',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'#pf-topprimary-nav .pfnavmenu .pfnavsub-menu li'
					) ,
					'title' => esc_html__('My Account: Dropdown Menu Text', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#fff',
						'hover' => '#fff'
					) ,
					'validate' => 'color',

				) ,

		)
	);

	/**
	*Top Line: Social Links
	**/
	$sections[] = array(
		'id' => 'setup19_socialiconsbarsettings',
		'subsection' => true,
		'title' => esc_html__('Top Line: Social Links', 'pointfindercoreelements'),
		
		'fields' => array(

				array(
					'id' => 'setup19_socialiconsbarsettings_main',
					'type' => 'switch',
					'title' => esc_html__('Top Line: Social Links', 'pointfindercoreelements') ,
					'on' => esc_html__('Enable', 'pointfindercoreelements') ,
					'off' => esc_html__('Disable', 'pointfindercoreelements'),
					'default' => '1'
				) ,
                array(
                    'id'        => 'setup19_socialiconsbarsettings_envelope_link',
                    'type'      => 'text',
                    'title'     => esc_html__('Email Link URL', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_phone_link',
                    'type'      => 'text',
                    'title'     => esc_html__('Phone Link URL', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),


				array(
                    'id'        => 'setup19_socialiconsbarsettings_facebook',
                    'type'      => 'text',
                    'title'     => esc_html__('Facebook Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_twitter',
                    'type'      => 'text',
                    'title'     => esc_html__('Twitter Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_linkedin',
                    'type'      => 'text',
                    'title'     => esc_html__('Linkedin Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                
                array(
                    'id'        => 'setup19_socialiconsbarsettings_pinterest',
                    'type'      => 'text',
                    'title'     => esc_html__('Pinterest Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_dribbble',
                    'type'      => 'text',
                    'title'     => esc_html__('Dribbble Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_dropbox',
                    'type'      => 'text',
                    'title'     => esc_html__('Dropbox Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_flickr',
                    'type'      => 'text',
                    'title'     => esc_html__('Flickr Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_github',
                    'type'      => 'text',
                    'title'     => esc_html__('Github Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_instagram',
                    'type'      => 'text',
                    'title'     => esc_html__('Instagram Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_rss',
                    'type'      => 'text',
                    'title'     => esc_html__('RSS Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_skype',
                    'type'      => 'text',
                    'title'     => esc_html__('Skype Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_tumblr',
                    'type'      => 'text',
                    'title'     => esc_html__('Tumblr Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_vk',
                    'type'      => 'text',
                    'title'     => esc_html__('VK Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),
                array(
                    'id'        => 'setup19_socialiconsbarsettings_youtube',
                    'type'      => 'text',
                    'title'     => esc_html__('Youtube Link', 'pointfindercoreelements'),
                    'required' => array('setup19_socialiconsbarsettings_main','=',1)
                ),

			) ,
	);



	/**
	*Menu Layout
	**/
	$sections[] = array(
		'id' => 'setup28_menustyles',
		'subsection' => true,
		'title' => esc_html__('Desktop Menu', 'pointfindercoreelements'),
		'fields' => array(

			array(
			    'id'        => 'accb1',
			    'type'      => 'accordion',
			    'title'     => esc_html__('General Settings', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'pfstickyhead',
					'type' => 'button_set',
					'title' => esc_html__('Sticky Menu', 'pointfindercoreelements') ,
					'compiler' => true,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				),
				array(
					'id' => 'pffullwlayoutheader',
					'type' => 'button_set',
					'title' => esc_html__('Full Width Menu', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				),
            array(
			    'id'        => 'acce1',
			    'type'      => 'accordion',
			    'position'  => 'end'
			),
            array(
			    'id'        => 'accb2',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Main Menu', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
                    'id'        => 'setup18_headerbarsettings_bgcolor',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Menu Bar Background', 'pointfindercoreelements'),
                    'default'   => array('color' => '#f7f7f7', 'alpha' => '1'),
                    'compiler'    => array('.wpf-header'),
                    'mode'      => 'background',
                    'transparent' => false,
                    'validate'  => 'colorrgba',
                ),
                array(
                    'id'        => 'setup18_headerbarsettings_bgcolor2',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Menu Bar Background', 'pointfindercoreelements'),
                    'subtitle'     => esc_html__('Sticky Menu', 'pointfindercoreelements'),
                    'default'   => array('color' => '#f7f7f7', 'alpha' => '0.9'),
                    'compiler'    => array('.wpf-header.pfshrink'),
                    'mode'      => 'background',
                    'transparent' => false,
                    'validate'  => 'colorrgba',
                ),
                array(
                    'id'        => 'setup18_headerbarsettings_bordersettings',
                    'type'      => 'border',
                    'title'     => esc_html__('Menu Bottom Border Color', 'pointfindercoreelements'),
                    'compiler'    => array('.wpf-header'),
                    'all' => false,
                    'right'  => false,
                    'top'  => false,
                    'left'  => false,
                    'style' => false,
                    'bottom' => true,
                    'default'   => array(
                        'border-color'  => '#f7f7f7',
                        'border-style'  => 'solid',
                        'border-top'    => '0',
                        'border-right'  => '0',
                        'border-bottom' => '1px',
                        'border-left'   => '0'
                    )
                ),
				array(
					'id' => 'setup18_headerbarsettings_menulinecolor',
					'type' => 'color',
					'mode' => 'background',
					'transparent' => false,
					'title' => esc_html__('Active Line Color', 'pointfindercoreelements') ,
					'desc' => esc_html__('Colored line at bottom of the menu links.', 'pointfindercoreelements'),
					'default' => '#a32222',
					'validate' => 'color',
					'compiler' => true
				) ,
				array(
					'id' => 'setup18_headerbarsettings_menucolor',
					'type' => 'link_color',
					'title' => esc_html__('Menu Link Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'.wpf-header .pf-primary-navclass .pfnavmenu li a',
						'.wpf-header .pf-primary-navclass .pfnavmenu li.selected > a',
						'.pf-blank-th'
					) ,
					'default' => array(
						'regular' => '#444444',
						'hover' => '#a32221'
					) ,
				) ,
				array(
					'id' => 'setup18_headerbarsettings_menutypo',
					'type' => 'typography',
					'title' => esc_html__('Menu Typography', 'pointfindercoreelements') ,
					'google' => true,
					'color' => false,
					'font-backup' => false,
					'compiler' => array(
						'.wpf-header .pf-primary-navclass .pfnavmenu li a'
					) ,
					'units' => 'px',
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Open Sans',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '18px',
					) ,

				) ,
			array(
			    'id'        => 'acce2',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb3',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Sub Menu', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
                        'id'            => 'setup18_headerbarsettings_menusubmenuwidth',
                        'type'          => 'slider',
                        'title'         => esc_html__( 'Sub Menu: Menu Width', 'pointfindercoreelements' ),
                        'default'       => 214,
                        'min'           => 50,
                        'step'          => 1,
                        'max'           => 1170,
                        'display_value' => 'text',
                        'compiler' => true
                    ),
				array(
					'id' => 'setup18_headerbarsettings_menucolor2_bg3',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'.wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu li'
					) ,
					'title' => esc_html__('Sub Menu: Background Color', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#ffffff',
						'hover' => '#ededed'
					) ,

				) ,
				array(
					'id' => 'setup18_headerbarsettings_menucolor2',
					'type' => 'link_color',
					'title' => esc_html__('Sub Menu: Text Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'.wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link'
					) ,
					'default' => array(
						'regular' => '#282828',
						'hover' => '#000000'
					) ,
				) ,
				array(
                    'id'        => 'setup18_headerbarsettings_bordersettingssub',
                    'type'      => 'border',
                    'title'     => esc_html__('Sub Menu: Bottom Border', 'pointfindercoreelements'),
                    'all' => false,
                    'compiler' => true,
                    'right'  => false,
                    'top'  => false,
                    'left'  => false,
                    'style' => false,
                    'bottom' => false,
                    'default'   => array(
                        'border-color'  => '#ffffff',
                        'border-style'  => 'solid',
                        'border-top'    => '0',
                        'border-right'  => '0',
                        'border-bottom' => '1px',
                        'border-left'   => '0'
                    )
                ),
				array(
					'id' => 'setup18_headerbarsettings_menutypo2',
					'type' => 'typography',
					'title' => esc_html__('Sub Menu: Menu Typography', 'pointfindercoreelements') ,
					'google' => true,
					'color' => false,
					'font-backup' => false,
					'compiler' => array(
						'.wpf-header .pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link'
					) ,
					'units' => 'px',
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Open Sans',
						'google' => true,
						'font-size' => '12px',
						'line-height' => '18px',
					) ,
				) ,
			array(
			    'id'        => 'acce3',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

		)
	);


	$sections[] = array(
		'id' => 'stp28_mmenu',
		'subsection' => true,
		'title' => esc_html__('Mobile Menu', 'pointfindercoreelements'),
		'fields' => array(

			array(
			    'id'        => 'accb4',
			    'type'      => 'accordion',
			    'title'     => esc_html__('General Settings', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'stp28_mmenu_logo',
					'type' => 'button_set',
					'title' => esc_html__('Logo', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'compiler' => true,
					'default' => '1'
				),
				array(
					'id' => 'stp28_mmenu_logose',
					'type' => 'button_set',
					'title' => esc_html__('Logo Type', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Main Logo', 'pointfindercoreelements') ,
						'2' => esc_html__('Additional Logo', 'pointfindercoreelements')
					) ,
					'default' => '2',
					'required' => array('stp28_mmenu_logo','=','1')
				),
				array(
					'id' => 'stp28_mmenu_menulocation',
					'type' => 'button_set',
					'title' => esc_html__('Menu Location', 'pointfindercoreelements') ,
					'options' => array(
						'left' => esc_html__('Left', 'pointfindercoreelements') ,
						'right' => esc_html__('Right', 'pointfindercoreelements')
					) ,
					'compiler' => true,
					'default' => 'left'
				),
				array(
                    'id' => 'as_mobile_dropdowns',
                    'type' => 'button_set',
                    'title' => esc_html__('Mobile Dropdowns', 'pointfindercoreelements') ,
                    'desc' => esc_html__('If this setting enabled, system will use mobile friendly dropdowns.', 'pointfindercoreelements'),
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements'),
                    ) ,
                    'default' => '0',
                ) ,
				array(
					'id' => 'stp28_mmenu_buttoncolor',
					'type' => 'link_color',
					'title' => esc_html__('Menu: Button Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'#pf-primary-nav-button',
						'#pf-topprimary-nav-button2',
						'#pf-topprimary-nav-button',
						'#pf-primary-search-button'
					) ,
					'default' => array(
						'regular' => '#272c2e',
						'hover' => '#4881d6'
					) ,
				) ,
				array(
                    'id'        => 'stp28_mmenu_buttonborder',
                    'type'      => 'border',
                    'title'     => esc_html__('Menu: Border Color', 'pointfindercoreelements'),
                    'all' => false,
                    'compiler' => array(
						'#pf-primary-nav-button',
						'#pf-topprimary-nav-button2',
						'#pf-topprimary-nav-button',
						'#pf-primary-search-button',
						'.psearchdraggable.mobilesearch .pfadditional-filters:after',
						'.psearchdraggable.mobilesearch #pf-search-button-halfmap',
						'.psearchdraggable.mobilesearch #pf-resetfilters-button'
					) ,
                    'right'  => false,
                    'top'  => false,
                    'left'  => false,
                    'style' => false,
                    'bottom' => false,
                    'default'   => array(
                        'border-color'  => '#e2e2e2',
                        'border-style'  => 'solid',
                        'border-top'    => '0',
                        'border-right'  => '0',
                        'border-bottom' => '1px',
                        'border-left'   => '0'
                    )
                ),
                array(
                    'id'        => 'stp28_bb2',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Menu: Divider Color', 'pointfindercoreelements'),
                    'default'   => array('color' => '#ffffff', 'alpha' => '0.5'),
                    'compiler'  => true,
                    'transparent' => false,
                    'validate'  => 'colorrgba',
                ),
				array(
                    'id'        => 'stp28_mmenu_menubg',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Menu Background', 'pointfindercoreelements'),
                    'default'   => array('color' => '#ffffff', 'alpha' => '1'),
                    'compiler'    => array(
                    	'.pfmobilemenucontainer #pf-primary-navmobile',
                    	'.pfmobilemenucontainer #pf-topprimary-navmobi',
                    	'.pfmobilemenucontainer #pf-topprimary-navmobi2',
                    	'.pfmobilemenucontainer .pf-menu-container',
                    	'.psearchdraggable.mobilesearch',
                    	'.psearchdraggable.mobilesearch .pfuserloading'
                    ),
                    'mode'      => 'background',
                    'transparent' => false,
                    'validate'  => 'colorrgba',
                ),
            array(
			    'id'        => 'acce4',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb5',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Main Menu', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
                array(
					'id' => 'stp28_mmenu_menulinecolor',
					'type' => 'color',
					'mode' => 'background',
					'transparent' => false,
					'title' => esc_html__('Main Menu: Active Line Color', 'pointfindercoreelements') ,
					'desc' => esc_html__('Colored line at bottom of the menu links.', 'pointfindercoreelements'),
					'default' => '#a32222',
					'validate' => 'color',
					'compiler' => true
				) ,
				array(
					'id' => 'stp28_mmenu_menucolor',
					'type' => 'link_color',
					'title' => esc_html__('Main Menu: Menu Link Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'.pfmobilemenucontainer .pf-primary-navclass .pfnavmenu li a',
						'.pfmobilemenucontainer .pf-primary-navclass .pfnavmenu li.selected > a',
						'#pf-topprimary-navmobi .pf-nav-dropdownmobi li a',
						'#pf-topprimary-navmobi2 .pf-nav-dropdownmobi li a',
						'.psearchdraggable.mobilesearch .pfadditional-filters'
					) ,
					'default' => array(
						'regular' => '#444444',
						'hover' => '#a32221'
					) ,
				) ,
				array(
					'id' => 'stp28_mmenu_menutypo',
					'type' => 'typography',
					'title' => esc_html__('Main Menu: Menu Typography', 'pointfindercoreelements') ,
					'google' => true,
					'color' => false,
					'font-backup' => false,
					'compiler' => array(
						'.pfmobilemenucontainer .pf-primary-navclass .pfnavmenu li a',
						'#pf-topprimary-navmobi .pf-nav-dropdownmobi li a',
						'#pf-topprimary-navmobi2 .pf-nav-dropdownmobi li a'
					) ,
					'units' => 'px',
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Open Sans',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '18px',
					)

				) ,
			array(
			    'id'        => 'acce5',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb6',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Sub Menu', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'stp28_mmenu_menucolor2_bg3',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'#pf-primary-navmobile.pf-primary-navclass .pfnavmenu .pfnavsub-menu li'
					) ,
					'title' => esc_html__('Sub Menu: Background Color', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#ffffff',
						'hover' => '#ededed'
					) ,
					'validate' => 'color',

				) ,
				array(
					'id' => 'stp28_mmenu_menucolor2',
					'type' => 'link_color',
					'title' => esc_html__('Sub Menu: Text Color', 'pointfindercoreelements') ,
					'active' => false,
					'compiler' => array(
						'#pf-primary-navmobile.pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link',
						'.pfnewlanguageselection .langbarpf'
					) ,
					'default' => array(
						'regular' => '#282828',
						'hover' => '#000000'
					) ,
				) ,
				array(
                    'id'        => 'stp28_mmenu__bordersettingssub',
                    'type'      => 'border',
                    'title'     => esc_html__('Sub Menu: Bottom Border', 'pointfindercoreelements'),
                    'all' => false,
                    'compiler' => true,
                    'right'  => false,
                    'top'  => false,
                    'left'  => false,
                    'style' => false,
                    'bottom' => false,
                    'default'   => array(
                        'border-color'  => '#ffffff',
                        'border-style'  => 'solid',
                        'border-top'    => '0',
                        'border-right'  => '0',
                        'border-bottom' => '1px',
                        'border-left'   => '0'
                    )
                ),
				array(
					'id' => 'stp28_mmenu_menutypo2',
					'type' => 'typography',
					'title' => esc_html__('Sub Menu: Menu Typography', 'pointfindercoreelements') ,
					'google' => true,
					'color' => false,
					'font-backup' => false,
					'compiler' => array(
						'#pf-primary-navmobile.pf-primary-navclass .pfnavmenu .pfnavsub-menu > li a.sub-menu-link'
					) ,
					'units' => 'px',
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Open Sans',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '18px',
					) ,
				) ,
			array(
			    'id'        => 'acce6',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
		)
	);
	/**
	*Header Bar Layout
	**/
	$sections[] = array(
		'id' => 'setup43_themecustomizer1',
		'title' => esc_html__('Header Bar', 'pointfindercoreelements'),
		'subsection' => true,
		'heading'     => esc_html__('Default Page Header Bar', 'pointfindercoreelements'),
        'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Blue area on the image refers to Default Header Bar. You can define a default header bar when header bar could not be created by user. Ex:bbPress inner pages, DSI IDX inner pages, 404 page, category page, archive page etc..', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_forheader.png" class="description-img" />'),
		'fields' => array(
				array(
					'id' => 'setup43_themecustomizer_headerbar_shadowopt',
					'type' => 'button_set',
					'title' => esc_html__('Header Bar Shadow', 'pointfindercoreelements') ,
					'options' => array(
						0 => esc_html__('Disabled', 'pointfindercoreelements'),
						1 => esc_html__('Shadow 1', 'pointfindercoreelements'),
						2 => esc_html__('Shadow 2', 'pointfindercoreelements'),
						),
					'default' => 2
				) ,
                array(
                    'id'        => 'setup43_themecustomizer_titlebarcustomtext_color',
                    'type'      => 'color',
                    'compiler'    => array('.pf-defaultpage-header .main-titlebar-text','.pf-defaultpage-header .pf-breadcrumbs #pfcrumbs li a','.pf-defaultpage-header .pf-breadcrumbs #pfcrumbs li','.pf-itempage-header','.pf-breadcrumbs #pfcrumbs li a','.pf-breadcrumbs #pfcrumbs li'),
                    'title'     => esc_html__('Text Color', 'pointfindercoreelements'),
                    'validate'  => 'color',
                    'default'	=> '#333333',
                    'transparent'  => false,
                ),
                array(
                    'id'       => 'setup43_themecustomizer_titlebarcustomtext_bgcolor',
                    'type'     => 'color',
                    'transparent' => false,
                    'validate' => 'color',
                    'title'    => esc_html__( 'Text Background Color', 'pointfindercoreelements' )
                ),
                array(
                    'id'            => 'setup43_themecustomizer_titlebarcustomtext_bgcolorop',
                    'type'          => 'slider',
                    'title'         => esc_html__( 'Text Background Color Opacity', 'pointfindercoreelements' ),
                    'default'       => 0,
                    'min'           => 0,
                    'step'          => .1,
                    'max'           => 1,
                    'resolution'    => 0.1,
                    'display_value' => 'text'
                ),
				array(
					'id' => 'setup43_themecustomizer_titlebarcustomheight',
					'type' => 'dimensions',
					'compiler'  => array('.pf-defaultpage-header','.pf-defaultpage-header .col-lg-12','.pf-itempage-header','.pf-itempage-header .col-lg-12'),
					'units' => 'px',
					'units_extended' => 'false',
					'width' => 'false',
					'title' => esc_html__('Height', 'pointfindercoreelements') ,
					'default' => array(
						'height' => 100,
					)
				) ,
				array(
                    'id'        => 'setup43_themecustomizer_titlebarcustombg',
                    'type'      => 'background',
                    'compiler'    => array('.pf-defaultpage-header','.pf-itempage-header'),
                    'title'     => esc_html__('Background', 'pointfindercoreelements'),
                    'default'  => array(
				        'background-color' => '#f9f9f9',
				    )

                )

		)
	);


	/**
	*Page Layout
	**/
	$sections[] = array(
		'id' => 'general_typography',
		'subsection' => true,
		'title' => esc_html__('Page Defaults', 'pointfindercoreelements') ,
		'fields' => array(
		/**
		*Body Area
		**/
			array(
				'id' => 'generalbradius',
				'type' => 'button_set',
				'compiler' => true,
				'title' => esc_html__('Global Rounded Borders', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1'
			),
			array(
                'id'      => 'generalbradiuslevel',
                'type'    => 'spinner',
                'title'   => esc_html__('Border Radius Size (px)', 'pointfindercoreelements'),
                'default' => '8',
                'min'     => '0',
                'compiler' => true,
                'step'    => '1',
                'max'     => '100',
                'required' => array('generalbradius','=','1')
            ),
			array(
				'id' => 'tcustomizer_colors_linkcolor',
				'type' => 'link_color',
				'title' => esc_html__('Body: Link Color', 'pointfindercoreelements') ,
				'compiler' => array(
					'html a'
				) ,
				'default' => array(
					'regular' => '#444',
					'hover' => '#000'
				) ,
			) ,
			array(
				'id' => 'tcustomizer_typographyh_main_fontheading',
				'type' => 'typography',
				'title' => esc_html__('Body: Heading Typography', 'pointfindercoreelements') ,
				'google' => true,
				'font-backup' => false,
				'compiler' => array(
					'.pfwidgettitle .widgetheader',
					'.dsidx-prop-title',
					'.dsidx-prop-title a',
					'.pfuaformsidebar .pf-sidebar-header',
					'#dsix-listings .dsidx-primary-data',
					'#dsidx-listings .dsidx-primary-data a',
					'.ui-tabgroup >.ui-tabs >[class^="ui-tab"]',
					'.pfitempagecontainerheader',
					'.pf-item-title-bar .pf-item-title-text',
					'.pf_pageh_title .pf_pageh_title_inner',
					'.pfdetailitem-subelement .pfdetail-ftext.pf-pricetext',
					'.pf-agentlist-pageitem .pf-itempage-sidebarinfo-elname',
					'.pf-authordetail-page .pf-itempage-sidebarinfo-elname',
					'.post-mtitle'
				) ,
				'units' => 'px',
				'default' => array(
					'color' => '#333333',
					'font-weight' => '600',
					'font-family' => 'Open Sans',
					'google' => true,
					'font-size' => '16px',
					'line-height' => '20px',
				) ,
			) ,
			array(
				'id' => 'tcustomizer_typographyh_main',
				'type' => 'typography',
				'title' => esc_html__('Body: Typography', 'pointfindercoreelements') ,
				'google' => true,
				'font-backup' => false,
				'compiler' => array(
					'body',
					'.pfwidgetinner div.dsidx-results-widget',
					'.pfwidgetinner div.dsidx-results-widget p'
				) ,
				'units' => 'px',
				'default' => array(
					'color' => '#494949',
					'font-weight' => '400',
					'font-family' => 'Open Sans',
					'google' => true,
					'font-size' => '12px',
					'line-height' => '16px',
				) ,
			) ,
			array(
				'id' => 'tcustomizer_typographyh_main_bg',
				'type' => 'background',
				'title' => esc_html__('Body: Background', 'pointfindercoreelements') ,
				'compiler' => array(
					'body'
				) ,

			) ,
			array(
                'id'        => 'setup30_bodyhmbg',
                'type'      => 'color',
                'mode'		=> 'background',
                'title'     => esc_html__('Body: Half Map Page Background', 'pointfindercoreelements'),
                'default'   => '#F5F7FA',
                'transparent' => false,
                'compiler' => array(
                	'.pf-halfmap-list-container'
                )
            ),
			
			array(
                'id'        => 'setup30_dashboard_styles_bodyborder',
                'type'      => 'color',
                'mode'		=> 'background',
                'title'     => esc_html__('Body: Border Color', 'pointfindercoreelements'),
                'default'   => '#ebebeb',
                'transparent' => false,
                'compiler' => true
            ),
		/**
		*Content Area
		**/


			array(
			    'id'       => 'setup42_itempagedetails_8_styles_buttoncolor',
			    'type'     => 'extension_custom_link_color',
			    'mode'     => 'background',
			    'title'    => esc_html__('Body: Button Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pf-uadashboard-container .golden-forms .pfmyitempagebuttons',
			    	'.pf-uadashboard-container .golden-forms .pfmyitempagebuttonsex',
			    	'.pf-notfound-page .btn-success',
			    	'.widget_pfitem_recent_entries .golden-forms .button.pfsearch',
			    	'.pftcmcontainer.golden-forms .button',
			    	'#pf-contact-form-submit',
			    	'.pf-enquiry-form-ex',
			    	'.golden-forms #commentform .button',
			    	'#pf-itempage-page-map-directions .gdbutton',
			    	'.woocommerce ul.products li.product .button',
			    	'.woocommerce a.added_to_cart',
			    	'.woocommerce #respond input#submit',
			    	'.woocommerce a.button',
			    	'.woocommerce button.button',
			    	'.woocommerce input.button',
			    	'#pf-search-button.pfhfmap-src',
			    	'.pfajax_paginate > .page-numbers > li > .current',
			    	'.pfstatic_paginate > .page-numbers > li > .current',
			    	'.pointfinder-comments-paging .current',
			    	'.pointfinder-comments-paging a:hover',
			    	'.pfajax_paginate > .page-numbers > li > a:hover',
			    	'.pfstatic_paginate > .page-numbers > li > a:hover',
			    	'#pf-membersystem-dialog .form-buttons .button',
			    	'.owl-carousel.owl-theme .owl-dots .owl-dot span',
			    	'.owl-carousel.owl-theme .owl-dots .owl-dot:hover span'
			    	) ,
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#f7f7f7',
			        'hover'    => '#a32221',
			    )
			),
			array(
			    'id'       => 'setup42_itempagedetails_8_styles_buttontextcolor',
			    'type'     => 'link_color',
			    'title'    => esc_html__('Body: Button Text Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pf-uadashboard-container .golden-forms .pfmyitempagebuttons',
			    	'.pf-uadashboard-container .golden-forms .pfmyitempagebuttonsex',
			    	'.pf-notfound-page .btn-success',
			    	'.widget_pfitem_recent_entries .golden-forms .button.pfsearch',
			    	'.pftcmcontainer.golden-forms .button',
			    	'#pf-contact-form-submit',
			    	'.golden-forms #commentform .button',
			    	'.pf-enquiry-form-ex',
			    	'#pf-itempage-page-map-directions .gdbutton',
			    	'.woocommerce ul.products li.product .button',
			    	'.woocommerce a.added_to_cart',
			    	'.woocommerce #respond input#submit',
			    	'.woocommerce a.button',
			    	'.woocommerce button.button',
			    	'.woocommerce input.button',
			    	'#pf-search-button.pfhfmap-src',
			    	'.pfajax_paginate > .page-numbers > li > .current',
			    	'.pfstatic_paginate > .page-numbers > li > .current',
			    	'.pointfinder-comments-paging .current',
			    	'.pointfinder-comments-paging a:hover',
			    	'.pfajax_paginate > .page-numbers > li > a:hover',
			    	'.pfstatic_paginate > .page-numbers > li > a:hover',
			    	'#pf-membersystem-dialog .form-buttons .button'
			    	) ,
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#4c4c4c',
			        'hover'    => '#ffffff',
			    )
			),

			array(
			    'id'       => 'stp43rbc',
			    'type'     => 'extension_custom_link_color',
			    'mode'     => 'background',
			    'title'    => esc_html__('Body: Reset Button Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pfhalfpagemapview .colhorsearch a#pf-resetfilters-button'
			    	) ,
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#656D78',
			        'hover'    => '#434A54',
			    )
			),
			array(
			    'id'       => 'stp43rbc2',
			    'type'     => 'link_color',
			    'title'    => esc_html__('Body: Reset Button Text Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pfhalfpagemapview .colhorsearch a#pf-resetfilters-button'
			    	) ,
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#fff',
			        'hover'    => '#ffffff',
			    )
			),

			array(
			    'id'       => 'setup42_itempagedetails_8_styles_elementcolor',
			    'type'     => 'color',
			    'transparent'	=> false,
			    'title'    => esc_html__('Body: Title Subline Color', 'pointfindercoreelements'),
			    'default'  => '#a32221',
			    'validate' => 'color',
			    'compiler' => true
			),
			array(
			    'id'       => 'setup42_sltbg',
			    'type'     => 'color',
			    'mode'     => 'background',
			    'title'    => esc_html__('Body: Selectbox Hover BG Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.select2-container--default .pfselect2drop .select2-results__option--highlighted[aria-selected]',
			    	'.select2-container--classic .pfselect2drop .select2-results__option--highlighted[aria-selected]'
			    	) ,
			    'transparent' => false,
			    'default'  => '#3875d7'
			),
			array(
			    'id'       => 'setup42_sltbg2',
			    'type'     => 'color',
			    'title'    => esc_html__('Body: Selectbox Hover Text Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.select2-container--default .pfselect2drop .select2-results__option--highlighted[aria-selected]',
			    	'.select2-container--classic .pfselect2drop .select2-results__option--highlighted[aria-selected]'
			    	) ,
			    'transparent' => false,
			    'default'  => '#ffffff'
			),

		)
	);


	

	/**
	*Frontend Dashboard Layout
	**/
	$sections[] = array(
		'id' => 'frtd_typo',
		'subsection' => true,
		'title' => esc_html__('Frontend Dashboard', 'pointfindercoreelements') ,
		'fields' => array(
			array(
				'id' => 'frtd_typoi',
				'type' => 'info',
				'notice' => true,
				'style' => 'info',
				'desc'      => esc_html__("You can customize frontend user dashboard styles by using this section.", 'pointfindercoreelements'),
			),
			array(
                'id'        => 'frtd_typo_tx',
                'type'      => 'color',
                'title'     => esc_html__('Body: Table Heading Text Color', 'pointfindercoreelements'),
                'default'   => '#434a54',
                'transparent' => false,
                'compiler' => array(
                	'#pfuaprofileform .pfhtitle', 
                	'.pf-listing-item-inner-addinfo',
                	'.pf-listing-item-inner-addpinfo',
                	'.pfsubmit-title',
                	'input.pfpackselector:empty ~ label:after',
                	'input.pflistingtypeselector:empty ~ label:before',
                	'#pffeaturedfileuploadfilepicker',
                	'#pfcoverimageuploadfilepicker',
                	'#pffeaturedimageuploadfilepicker',
                	'#pfuploadfeaturedimg_remove',
                	'#pfuploadfeaturedfile_remove',
                	'.pfuploadcoverimg-container',
                	'div#pfdropzoneupload'
                )
            ),
			array(
                'id'        => 'frtd_typo_tbg',
                'type'      => 'color',
                'mode'		=> 'background',
                'title'     => esc_html__('Body: Table Heading BG Color', 'pointfindercoreelements'),
                'default'   => '#f5f7fa',
                'transparent' => false,
                'compiler' => array(
                	'#pfuaprofileform .pfhtitle', 
                	'.pf-listing-item-inner-addinfo',
                	'.pf-listing-item-inner-addpinfo',
                	'.pfsubmit-title',
                	'input.pfpackselector:empty ~ label:after',
                	'input.pflistingtypeselector:empty ~ label:before',
                	'#pffeaturedfileuploadfilepicker',
                	'#pfcoverimageuploadfilepicker',
                	'#pffeaturedimageuploadfilepicker',
                	'#pfuploadfeaturedimg_remove',
                	'#pfuploadfeaturedfile_remove',
                	'.pfuploadcoverimg-container',
                	'div#pfdropzoneupload'
                )
            ),
            array(
                'id'        => 'frtd_typo_bbc',
                'type'     => 'border',
                'style'		=> true,
                'color'		=> true,
                'all'		=> true,
                'title'     => esc_html__('Menu: Border Color', 'pointfindercoreelements'),
                'compiler'   => array(
                	'.pfuaformsidebar .pf-sidebar-menu li'
                ),
                'default'  => array(
                    'border-color'  => '#e3e6ea',
                    'border-style'  => 'solid',
                    'border-top' => '1px',
                    'border-right' => '1px',
                    'border-bottom' => '1px',
                    'border-left' => '1px',
                    'border-width' => '1px'
                ),
            ),
			array(
			    'id'       => 'frtd_typo_bbgc',
			    'type'     => 'extension_custom_link_color',
			    'mode'     => 'background',
			    'title'    => esc_html__('Menu: Button Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pfuaformsidebar .pf-sidebar-menu li'
		    	) ,
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#f7f7f7',
			        'hover'    => '#f5f7fa',
			    )
			),
			array(
			    'id'       => 'frtd_typo_btc',
			    'type'     => 'link_color',
			    'title'    => esc_html__('Menu: Button Text Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pfuaformsidebar .pf-sidebar-menu li a'
		    	),
			    'active'	=> false,
			    'visited'	=> false,
			    'default'  => array(
			        'regular'  => '#434a54',
			        'hover'    => '#434a54',
			    )
			),
			array(
			    'id'       => 'frtd_typo_btc2',
			    'type'     => 'color',
			    'transparent' => false,
			    'title'    => esc_html__('Menu: Text Color', 'pointfindercoreelements'),
			    'compiler' => array(
			    	'.pfuaformsidebar .pf-dash-usernamef',
			    	'.pf-dash-packageinfo'
		    	),
			    'default'  => '#434a54'
			),

		)
	);




	/**
	*Validation Error Styles
	**/
	$sections[] = array(
		'id' => 'setup16_searchnotifications',
		'subsection' => true,
		'title' => esc_html__('Error Notifications', 'pointfindercoreelements') ,
		'desc' => '<p class="description">'.esc_html__('You can edit Validation Error Notification Layout by using below options.', 'pointfindercoreelements').'</p>' ,
		'heading' => esc_html__('Validation Error Notification Layout', 'pointfindercoreelements') ,
		'fields' => array(
			array(
				'id' => 'setup16_searchnotifications_searcherrorbg',
				'type' => 'color_rgba',
				'title' => esc_html__('Background', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => sprintf(esc_html__('%s color of error window.', 'pointfindercoreelements'),'Background'),
				) ,
				'default' => array(
					'color' => '#921c1c',
					'alpha' => '0.95'
				) ,
				'compiler' => array(
					'.pfsearchformerrors',
					'.pfusrfault'
				) ,
				'mode' => 'background',
				'validate' => 'colorrgba',
				'transparent' => false,
			) ,
			array(
				'id' => 'setup16_searchnotifications_searcherrortext',
				'type' => 'color',
				'transparent' => false,
				'compiler' => array(
					'.pfsearchformerrors > ul',
					'.pfusrfault'
				) ,
				'title' => esc_html__('Text Color', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => sprintf(esc_html__('%s color of error window.', 'pointfindercoreelements'),'Text'),
				) ,
				'default' => '#FFFFFF',
				'validate' => 'color'
			) ,
			array(
				'id' => 'setup16_searchnotifications_searcherrorclosebg_ex',
				'type' => 'link_color',
				'mode' => 'background',
				'transparent' => false,
				'active' => false,
				'compiler' => array(
					'#pfsearch-err-button'
				) ,
				'title' => esc_html__('Close Button Background', 'pointfindercoreelements') ,
				'default' => array(
					'regular' => '#FFFFFF',
					'hover' => '#efefef'
				) ,
				'validate' => 'color',
				'hint' => array(
					'content' => sprintf(esc_html__('%s color of close button.', 'pointfindercoreelements'),'Background'),
				) ,


			) ,

			array(
				'id' => 'setup16_searchnotifications_searcherrorclosetext',
				'type' => 'color',
				'compiler' => array(
					'#pfsearch-err-button'
				) ,
				'title' => esc_html__('Close Button Text Color', 'pointfindercoreelements') ,
				'default' => '#530000',
				'validate' => 'color',
				'transparent' => false,
				'hint' => array(
					'content' => sprintf(esc_html__('%s color of close button.', 'pointfindercoreelements'),'Text'),
				) ,
			) ,
		)
	);



	/**
	*Featured Item Ribbon
	**/
	$sections[] = array(
		'id' => 'setup16_featureditemribbon',
		'subsection' => true,
		'title' => esc_html__('Featured Listing Ribbon', 'pointfindercoreelements') ,
		'fields' => array(
			array(
				'id' => 'setup16_featureditemribbon_hide',
				'type' => 'button_set',
				'title' => esc_html__('Status', 'pointfindercoreelements') ,
				'default' => 1,
				'options' => array(
					'1' => esc_html__('Show', 'pointfindercoreelements') ,
					'0' => esc_html__('Hide', 'pointfindercoreelements')
				),
				'desc' => esc_html__('If this disabled, Featured Listing Ribbon will be hidden for all items.', 'pointfindercoreelements') ,
			),
			array(
				'id' => 'setup16_featureditemribbon_bg',
				'type' => 'color_rgba',
				'title' => esc_html__('Background Color', 'pointfindercoreelements') ,
				'default' => array(
					'color' => '#5eb524',
					'alpha' => '0.9'
				) ,
				'compiler' => array('.pfribbon-featured','.pfribbon-featured2') ,
				'mode' => 'background',
				'validate' => 'colorrgba',
				'transparent' => false,
				'required' => array('setup16_featureditemribbon_hide','=',1)
			),
			array(
				'id' => 'setup16_featureditemribbon_text',
				'type' => 'color',
				'transparent' => false,
				'compiler' => array('.pfribbon-featured','.pfribbon-featured2') ,
				'title' => esc_html__('Text Color', 'pointfindercoreelements') ,
				'default' => '#FFFFFF',
				'validate' => 'color',
				'required' => array('setup16_featureditemribbon_hide','=',1)
			)
		)
	);

	/**
	* Tooltip System
	**/
	$sections[] = array(
		'id' => 'setup45_ttsys',
		'subsection' => true,
		'title' => esc_html__('Tooltips', 'pointfindercoreelements') ,
		'fields' => array(
			array(
				'id' => 'setup45_status',
				'type' => 'button_set',
				'title' => esc_html__('Status', 'pointfindercoreelements') ,
				'default' => 1,
				'options' => array(
					'1' => esc_html__('Show', 'pointfindercoreelements') ,
					'0' => esc_html__('Hide', 'pointfindercoreelements')
				)
			),
			array(
				'id' => 'setup45_bgcolor',
				'type' => 'color_rgba',
				'title' => esc_html__('Background Color', 'pointfindercoreelements') ,
				'default' => array(
					'color' => '#333333',
					'alpha' => '0.9'
				) ,
				'compiler' => array(
					'.pointfinderarrow_box',
					'.wpfquick-tooltip'
				) ,
				'mode' => 'background',
				'validate' => 'colorrgba',
				'transparent' => false,
				'required' => array('setup45_status','=',1)
			),
			array(
				'id' => 'setup45_txcolor',
				'type' => 'color',
				'transparent' => false,
				'compiler' => array(
					'.wpfquick-tooltip'
				) ,
				'title' => esc_html__('Text Color', 'pointfindercoreelements') ,
				'default' => '#FFFFFF',
				'validate' => 'color',
				'required' => array('setup45_status','=',1)
			)
		)
	);


/**
*END : THEME CUSTOMIZER
**/



/**
*START: FOOTER AREA
**/
	$sections[] = array(
		'id' => 'setup_footerbar',
		'title' => esc_html__('Footer Bar', 'pointfindercoreelements'),
		'subsection' => true,
		'fields' => array(
				array(
                    'id'       => 'setup_footerbar_status',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Footer Bar', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                        '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                    ),
                    'compiler' => true,
                    'default'  => '1'
                ),
                array(
                    'id'       => 'setup_footerbar_width',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Full Width', 'pointfindercoreelements' ),
                    'options'  => array(
                        '1' => esc_html__( 'Enable', 'pointfindercoreelements' ),
                        '0' => esc_html__( 'Disable', 'pointfindercoreelements' ),
                    ),
                    'compiler' => true,
                    'default'  => '0',
                    'required' => array('setup_footerbar_status','=','1')
                ),
				array(
                    'id'        => 'setup_footerbar_border',
                    'type'      => 'border',
                    'title'     => esc_html__('Border Color', 'pointfindercoreelements'),
                    'compiler'    => array(
                    	'.wpf-footer'
                    	),
                    'all'		=> false,
                    'default'   => array(
                        'border-color'  => '#efefef',
                        'border-style'  => 'dotted',
                        'border-top'    => '1px',
                        'border-right'  => '0px',
                        'border-bottom' => '0px',
                        'border-left'   => '0px'
                    ),
                    'required' => array('setup_footerbar_status','=','1')
                ),
                array(
                    'id'       => 'setup_footerbar_bg',
                    'type'     => 'color',
                    'mode'     => 'background',
                    'compiler'   => array( '.wpf-footer' ),
                    'title'    => esc_html__( 'Background Color', 'pointfindercoreelements' ),
                    'default'  => '#ffffff',
                    'validate' => 'color',
                    'required' => array('setup_footerbar_status','=','1')
                ),
                array(
                    'id'       => 'setup_footerbar_text',
                    'type'     => 'link_color',
                    'title'    => esc_html__( 'Text Color', 'pointfindercoreelements' ),
                    'compiler'   => array( '.wpf-footer a' ),
                    'active'    => false,
                    'visited'   => false,
                    'default'  => array(
                        'regular' => '#ffffff',
                        'hover'   => '#efefef',
                    ),
                    'required' => array('setup_footerbar_status','=','1')
                ),
                array(
                    'id'       => 'setup_footerbar_text_copy',
                    'type'     => 'editor',
                    'title'    => esc_html__( 'Copyright Text', 'pointfindercoreelements' ),
                    'subtitle' => esc_html__( 'Enter the text that displays in the copyright bar. HTML markup can be used.', 'pointfindercoreelements' ),
                    'validate' => 'html',
                    'args'    => array(
	                    'wpautop'       => false,
	                    'media_buttons' => false,
	                    'textarea_rows' => 5,
	                    'teeny'         => false,
	                    'quicktags'     => true,
	                ),
                    'required' => array('setup_footerbar_status','=','1')
                ),
                array(
                    'id'       => 'setup_footerbar_text_copy_align',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Copyright Text Align', 'pointfindercoreelements' ),
                    'options'  => array(
                        'left' => esc_html__( 'Left', 'pointfindercoreelements' ),
                        'right' => esc_html__( 'Right', 'pointfindercoreelements' ),
                    ),
                    'default'  => 'left',
                    'compiler' => true,
                    'required' => array('setup_footerbar_status','=','1')
                ),
		)

	);
/**
*END: FOOTER AREA
**/




/**
*Start : GRID LIST SETTINGS
**/
	$sections[] = array(
		'id' => 'setup22_searchresults',
		'title' => esc_html__('Grid Settings', 'pointfindercoreelements'),
        'desc'      => '<p class="description">'.esc_html__('You can customize all item listing variables. This changes will affect search results and all listing areas like item carousel, item listing grid.', 'pointfindercoreelements').'</p>',
		'icon' => 'el-icon-th',
		'fields' => array(

				array(
					'id' => 'setup22_searchresults_grid_layout_mode',
					'type' => 'button_set',
					'title' => esc_html__('Default Grid Layout View', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Fitrows', 'pointfindercoreelements') ,
						'0' => esc_html__('Masonry', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Archive, Category, Tags, Search, Agent Page, Author Page and Grid Lists using this setting.', 'pointfindercoreelements') ,
				),



				array(
					'id' => 'setup22_searchresults_defaultsortbytype',
					'type' => 'select',
					'title' => esc_html__('Default: Sortby Type', 'pointfindercoreelements') ,
					'options' => array(
						'title_az'=>esc_html__('A-Z','pointfindercoreelements'),
						'title_za'=>esc_html__('Z-A','pointfindercoreelements'),
						'date_az'=>esc_html__('Newest','pointfindercoreelements'),
						'date_za'=>esc_html__('Oldest','pointfindercoreelements'),
						'rand' => esc_html__('Random', 'pointfindercoreelements'),
						'nearby'=>esc_html__('Nearby','pointfindercoreelements'),
						'mviewed'=>esc_html__('Most Viewed','pointfindercoreelements'),
						'reviewcount_az'=>esc_html__('Highest Rated','pointfindercoreelements'),
						'reviewcount_za'=>esc_html__('Lowest Rated','pointfindercoreelements')
					) ,
					'default' => 'date_az',
					'desc' => esc_html__('Default sortby type for listings.','pointfindercoreelements').' '.esc_html__('Archive, Category, Tags, Search, Agent Page, Author Page and Grid Lists using this setting.', 'pointfindercoreelements'),
				),
				array(
					'id' => 'setup22_featrand',
					'type' => 'button_set',
					'title' => esc_html__('Featured Listings: Random List', 'pointfindercoreelements') ,
					'default' => '0',
					'options' => array(
						'0' => esc_html__('Yes', 'pointfindercoreelements'),
						'1' => esc_html__('No', 'pointfindercoreelements')
					),
					'desc' => esc_html__('If this enabled, system will show random featured listings on grid lists.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_feated',
					'type' => 'button_set',
					'title' => esc_html__('Featured Listings: Optimization', 'pointfindercoreelements') ,
					'default' => '0',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'desc' => esc_html__('If this enabled, system will show featured listings on the grid while sort option not selected. Otherwise featured listings will be visible on the top of the grid.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_searchresults_defaultppptype',
					'type' => 'spinner',
					'title' => esc_html__('Default: Listing Per Page', 'pointfindercoreelements') ,
					'default' => '10',
                    'min'     => '0',
                    'step'    => '1',
                    'max'     => '100',
                    'desc' => esc_html__('Archive, Category, Tags, Search, Agent Page, Author Page and Grid Lists using this setting.', 'pointfindercoreelements') ,
				),
		    	array(
					'id' => 'setup22_searchresults_status_sortby',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: Sort By Selection', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),
				
				array(
					'id' => 'setup22_searchresults_status_number',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: Number of Item Selection', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_ohours',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: Opening Hours', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements'),
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('This filter is only working with "Type 3" of the Opening Hours System.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_searchresults_status_2colh',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: 1 Column Listing Box', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_searchresults_status_2col',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: 2 Column Listing Box', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_searchresults_status_3col',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: 3 Column Listing Box', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),
				array(
					'id' => 'setup22_searchresults_status_4col',
					'type' => 'button_set',
					'title' => esc_html__('Search Results: 4 Column Listing Box', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Widget/Mini Search/Map Search Results Page using this setting.', 'pointfindercoreelements') ,
				),

		) ,
	);


	/**
	*Listing Card Settings
	**/
	$sections[] = array(
		'id' => 'setup22_searchresults_0',
		'subsection' => true,
		'title' => esc_html__('General Grid Settings', 'pointfindercoreelements'),
		'desc' => '<p class="description">'.esc_html__('Below options will affect item box styles on the search listing and item box setting for grid listing (Only Address & Excerpt Settings).', 'pointfindercoreelements').'</p>',
		'fields' => array(
				array(
					'id' => 'setup22_searchresults_background',
					'type' => 'color',
					'title' => esc_html__('Search Results Container Background', 'pointfindercoreelements') ,
					'default' => '#28353d',
					'compiler' => array(
						'.pfsearchresults .pfsearchresults-content'
					) ,
					'transparent' => false,
					'mode' => 'background',
					'validate' => 'color',
					'hint' => array(
						'content' => esc_html__('Listing map search results area container background color', 'pointfindercoreelements')
					)
				) ,
				array(
					'id' => 'setup22_searchresults_headerbackground',
					'type' => 'color',
					'title' => esc_html__('Search/Grid Default Header Background', 'pointfindercoreelements') ,
					'default' => '#fafafa',
					'compiler' => array(
						'.pfsearchresults .pfsearchresults-header'
					) ,
					'transparent' => false,
					'mode' => 'background',
					'validate' => 'color',
					'hint' => array(
						'content' => esc_html__('Item search results listing area header background color', 'pointfindercoreelements')
					)
				) ,
				
				array(
					'id' => 'setup22_searchresults_background2',
					'type' => 'color',
					'title' => esc_html__('Default Listing Card Background', 'pointfindercoreelements') ,
					'default' => '#ffffff',
					'compiler' => array(
						'.pfsearchresults-content .pflist-item'
					) ,
					'transparent' => false,
					'mode' => 'background',
					'validate' => 'color',
					'hint' => array(
						'content' => esc_html__('Item box text area background color (Under the Image Area)', 'pointfindercoreelements')
					)
				) ,
				array(
					'id' => 'setup22_searchresults_hide_address',
					'type' => 'button_set',
					'title' => esc_html__('Default Listing Card Address Area', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),

				),
				array(
					'id' => 'setup22_searchresults_hide_lt',
					'type' => 'button_set',
					'title' => esc_html__('Listing Type Text', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements'),
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'st22srlinklt',
					'type' => 'button_set',
					'title' => esc_html__('Listing Type Text Link', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'st22srloc',
					'type' => 'button_set',
					'title' => esc_html__('Location Info', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements'),
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Warning: This will make your grid list slower.', 'pointfindercoreelements') ,
				) ,
				array(
					'id' => 'st22srlinknw',
					'type' => 'button_set',
					'title' => esc_html__('Open New Window for Item Detail', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				) ,


				array(
					'id' => 'setup22_searchresults_hide_excerpt',
					'type' => 'checkbox',
					'title' => esc_html__('Listing Card Excerpt Area', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('This function will show/hide excerpt area by item box columns.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => '' . esc_html__('1 Columns Box Excerpt', 'pointfindercoreelements') ,
						'2' => '' . esc_html__('2 Columns Box Excerpt', 'pointfindercoreelements') ,
						'3' => '' . esc_html__('3 Columns Box Excerpt', 'pointfindercoreelements'),
						'4' => '' . esc_html__('4 Columns Box Excerpt', 'pointfindercoreelements')
					) ,
					'default' => array(
						'1' => '1',
						'2' => '0',
						'3' => '0',
						'4' => '0'
					)
				) ,
				array(
	                'id' => 'setup22_tarl',
	                'type'          => 'slider',
	                'title' => esc_html__('Title Area Row Limit', 'pointfindercoreelements'),
	                'default'       => 1,
	                'min'           => 1,
	                'step'          => 1,
	                'max'           => 4,
	                'display_value' => 'text',
	                'compiler' => true
	            ),
	            array(
	                'id' => 'setup22_aarl',
	                'type'          => 'slider',
	                'title' => esc_html__('Address Area Row Limit', 'pointfindercoreelements'),
	                'default'       => 1,
	                'min'           => 1,
	                'step'          => 1,
	                'max'           => 4,
	                'display_value' => 'text',
	                'compiler' => true
	            ),
	            array(
	                'id' => 'setup22_searchresults_hide_excerpt_rl',
	                'type'          => 'slider',
	                'title' => esc_html__('Excerpt Area Row Limit', 'pointfindercoreelements'),
	                'default'       => 2,
	                'min'           => 1,
	                'step'          => 1,
	                'max'           => 4,
	                'display_value' => 'text',
	                'compiler' => true
	            ),
				array(
					'id' => 'setup22_searchresults_showmapfeature',
					'type' => 'button_set',
					'title' => esc_html__('Show On Map Link', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'stp22_qwlink',
					'type' => 'button_set',
					'title' => esc_html__('Quick View Link', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'setup22_search_rmb',
					'type' => 'button_set',
					'title' => esc_html__('Read More Button', 'pointfindercoreelements') ,
					'default' => 0,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements'),
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'setup22_fdate',
					'type' => 'button_set',
					'title' => esc_html__('Date Custom Field', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Show Only Date', 'pointfindercoreelements'),
						'2' => esc_html__('Show Date & Time', 'pointfindercoreelements')
					)

				) ,




		) ,
	);


	/**
	*Listing Card Image Settings
	**/
	$sections[] = array(
		'id' => 'setup22_searchresults_1',
		'subsection' => true,
		'title' => esc_html__('Listing Card Image Settings', 'pointfindercoreelements'),
		'desc' => '<p class="description">'.esc_html__('Below settings will affect item image on the listing.', 'pointfindercoreelements').'</p>',
		'fields' => array(
			array(
				'id' => 'hideallimages',
				'type' => 'button_set',
				'title' => esc_html__('Hide All Images', 'pointfindercoreelements') ,
				'default' => 0,
				'compiler' => true,
				'options' => array(
					'0' => esc_html__('Show', 'pointfindercoreelements'),
					'1' => esc_html__('Hide', 'pointfindercoreelements')
				)
			),
			array(
				'id' => 'hidenoimages',
				'type' => 'button_set',
				'title' => esc_html__('Hide Not Found Images', 'pointfindercoreelements') ,
				'default' => 0,
				'compiler' => true,
				'options' => array(
					'0' => esc_html__('Show', 'pointfindercoreelements'),
					'1' => esc_html__('Hide', 'pointfindercoreelements')
				)
			) ,
			array(
				'id' => 'setup22_searchresults_hover_image',
				'type' => 'button_set',
				'title' => esc_html__('Image Hover Buttons', 'pointfindercoreelements') ,
				'default' => 0,
				'options' => array(
					'0' => esc_html__('Show', 'pointfindercoreelements'),
					'1' => esc_html__('Hide', 'pointfindercoreelements')
				)
			) ,
			array(
				'id' => 'setup22_searchresults_1_linkcolor',
				'type' => 'link_color',
				'title' => esc_html__('Icon Link Color', 'pointfindercoreelements') ,
				'compiler' => array(
					'.pflist-item .pfHoverButtonStyle > a'
				) ,
				'active' => false,
				'default' => array(
					'regular' => '#000000',
					'hover' => '#B32E2E'
				),
				'required' => array('setup22_searchresults_hover_image','=','0')
			) ,

			array(
				'id' => 'setup22_searchresults_hover_video',
				'type' => 'button_set',
				'required' => array('setup22_searchresults_hover_image','=','0'),
				'title' => esc_html__('Image Hover Video Button', 'pointfindercoreelements'),
				'default' => 0,
				'options' => array(
					'0' => esc_html__('Show', 'pointfindercoreelements'),
					'1' => esc_html__('Hide', 'pointfindercoreelements')
				),

			) ,
			array(
				'id' => 'setup22_searchresults_animation_image',
				'type' => 'select',
				'required' => array('setup22_searchresults_hover_image','=','0') ,
				'title' => esc_html__('Image Hover Button Styles', 'pointfindercoreelements') ,
				'options' => array(
					'WhiteRounded' => esc_html__('White Rounded', 'pointfindercoreelements') ,
					'BlackRounded' => esc_html__('Black Rounded', 'pointfindercoreelements') ,
					'WhiteSquare' => esc_html__('White Square', 'pointfindercoreelements') ,
					'BlackSquare' => esc_html__('Black Square', 'pointfindercoreelements')
				) ,
				'default' => 'WhiteSquare',

			)

		) ,
	);


	/**
	*Listing Card Typography
	**/
	$sections[] = array(
		'id' => 'setup22_searchresults_2',
		'subsection' => true,
		'title' => esc_html__('Listing Card Typography', 'pointfindercoreelements'),
		'desc' => '<p class="description">'.esc_html__('Below settings will affect listing item variables such as Title, Address, Text color font etc.', 'pointfindercoreelements').'</p>',
		'fields' => array(
				array(
					'id' => 'setup22_searchresults_title_color',
					'type' => 'link_color',
					'title' => esc_html__('Title Area Link Color', 'pointfindercoreelements') ,
					'compiler' => array(
						'.pflist-itemdetails .pflist-itemtitle a',
						'.pfshowmapmain a',
						'.pfquicklinks a'
					) ,
					'active' => false,
					'default' => array(
						'regular' => '#2b7ff5',
						'hover' => '#7a7a7a'
					)
				) ,
				array(
					'id' => 'setup22_searchresults_title_typo',
					'type' => 'typography',
					'title' => esc_html__('Title Area', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.pflist-itemdetails .pflist-itemtitle a'
					) ,
					'units' => 'px',
					'color' => false,
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Ubuntu Condensed',
						'google' => true,
						'font-size' => '18px',
						'line-height' => '21px',
						'text-align' => 'left'
					)
				) ,
				array(
					'id' => 'setup22_searchresults_text_typo',
					'type' => 'typography',
					'title' => esc_html__('Detail Text Area', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.pflistingitem-subelement.pf-onlyitem .pf-ftext',
						'.pflistingitem-subelement.pf-onlyitem .pf-ftitle',
						'.pfreadmorelink',
						'.pflistingitem-subelement.pf-ititem .pf-ftitle',
						'.pflist-item .pflist-excerpt'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '16px',
						'color' => '#7a7a7a',
						'text-align' => 'left'
					)
				) ,
				array(
					'id' => 'setup22_searchresults_text_typo2',
					'type' => 'color',
					'compiler' => array(
						'.pflistingitem-subelement.pf-onlyitem .pf-ftitle',
						'.pfreadmorelink',
						'.pflistingitem-subelement.pf-ititem .pf-ftitle'
					) ,
					'transparent' => false,
					'title' => esc_html__('Detail Text Area Title Color', 'pointfindercoreelements') ,
					'default' => '#494949',
					'validate' => 'color',

				) ,
				array(
					'id' => 'setup22_searchresults_price_typo',
					'type' => 'typography',
					'title' => esc_html__('Price & Listing Type Area', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.pflistingitem-subelement.pf-price',
						'.pflistingitem-subelement.pf-price a'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Ubuntu Condensed',
						'google' => true,
						'font-size' => '20px',
						'line-height' => '20px',
						'color' => '#ffffff',
						'text-align' => 'right'
					)
				) ,
				array(
					'id' => 'setup22_searchresults_address_typo',
					'type' => 'typography',
					'title' => esc_html__('Address Area', 'pointfindercoreelements') ,
					'required' => array('setup22_searchresults_hide_address', '=', 0),
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.pflist-itemdetails > .pflist-address',
						'.pflist-itemdetails .pflist-location'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Ubuntu Condensed',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '17px',
						'color' => '#686868',
						'text-align' => 'left'
					)
				) ,
		) ,
	);


/**
*End : GRID LIST SETTINGS
**/








/**
*START: Registration SYSTEM
**/
$sections[] = array(
	'id' => 'stpregsystem',
	'title' => esc_html__('Registration System', 'pointfindercoreelements') ,
	'icon' => 'el-icon-user',
	'fields' => array(
		array(
			'id' => 'setup4_membersettings_loginregister',
			'desc' => esc_html__('Warning: If it is disabled, User Submission, Favorite, Review Systems will be disabled. (Former data will not be affected.)', 'pointfindercoreelements') ,
			'type' => 'button_set',
			'title' => esc_html__('User Login / Register System', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '1'
		) ,
		array(
            'id' => 'as_redirect_logins',
            'type' => 'button_set',
            'title' => esc_html__('Redirect Login Attempts', 'pointfindercoreelements') ,
            'desc' => esc_html__('If this setting enabled, all login attemps redirect to Point Finder Login System.', 'pointfindercoreelements') ,
            'options' => array(
                '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                '0' => esc_html__('Disable', 'pointfindercoreelements'),
            ) ,
            'default' => '0',
        ) ,
		array(
            'id' => 'as_autologin',
            'type' => 'button_set',
            'title' => esc_html__('Auto Login After Registration', 'pointfindercoreelements') ,
            'desc' => esc_html__('If this setting enabled, all users auto login after registration without email confirmation', 'pointfindercoreelements') ,
            'options' => array(
                '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                '0' => esc_html__('Disable', 'pointfindercoreelements'),
            ) ,
            'default' => '0',
        ) ,
		array(
            'id' => 'redfreg',
            'type' => 'select',
            'title' => esc_html__('Redirection Page', 'pointfindercoreelements') ,
            'desc' => esc_html__('Where do you want to redirect user after login?', 'pointfindercoreelements') ,
            'options' => array(
                '1' => esc_html__('User Profile Page', 'pointfindercoreelements') ,
                '2' => esc_html__('User Itemlist Page', 'pointfindercoreelements'),
                '3' => esc_html__('Home Page', 'pointfindercoreelements'),
                '4' => esc_html__('Submit New Item page', 'pointfindercoreelements'),
                '5' => esc_html__('Custom page', 'pointfindercoreelements')
            ) ,
            'default' => '1',
        ) ,
        array(
			'id' => 'redfregc',
			'type' => 'text',
			'title' => esc_html__('Custom Page URL', 'pointfindercoreelements') ,
			'required' => array('redfreg','=','5'),
		) ,
		array(
			'id' => 'usnfield',
			'type' => 'button_set',
			'title' => esc_html__('Username Changes', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '1',
		) ,
		array(
			'id' => 'passffreg',
			'type' => 'button_set',
			'title' => esc_html__('Password Field', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '0',
		) ,
		array(
			'id' => 'fnffreg',
			'type' => 'button_set',
			'title' => esc_html__('First Name Field', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '0',
		) ,
		array(
			'id' => 'fnffreg_req',
			'type' => 'button_set',
			'title' => esc_html__('First Name Required?', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Yes', 'pointfindercoreelements') ,
				'0' => esc_html__('No', 'pointfindercoreelements')
			) ,
			'default' => '0',
			'required' => array('fnffreg','=','1'),
		) ,
		array(
			'id' => 'lnffreg',
			'type' => 'button_set',
			'title' => esc_html__('Last Name Field', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '0',
		) ,
		array(
			'id' => 'lnffreg_req',
			'type' => 'button_set',
			'title' => esc_html__('Last Name Required?', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Yes', 'pointfindercoreelements') ,
				'0' => esc_html__('No', 'pointfindercoreelements')
			) ,
			'default' => '0',
			'required' => array('lnffreg','=','1'),
		) ,
		array(
			'id' => 'phoneffreg',
			'type' => 'button_set',
			'title' => esc_html__('Phone Field', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '0',
		) ,
		array(
			'id' => 'phoneffreg_req',
			'type' => 'button_set',
			'title' => esc_html__('Phone Required?', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Yes', 'pointfindercoreelements') ,
				'0' => esc_html__('No', 'pointfindercoreelements')
			) ,
			'default' => '0',
			'required' => array('phoneffreg','=','1'),
		) ,
		array(
			'id' => 'mobileffreg',
			'type' => 'button_set',
			'title' => esc_html__('Mobile Field', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '0',
		) ,
		array(
			'id' => 'mobileffreg_req',
			'type' => 'button_set',
			'title' => esc_html__('Mobile Required?', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Yes', 'pointfindercoreelements') ,
				'0' => esc_html__('No', 'pointfindercoreelements')
			) ,
			'default' => '0',
			'required' => array('mobileffreg','=','1'),
		) ,


	)
);
/**
*END: Registration SYSTEM
**/






/**
*Start : FRONTEND SUBMISSON SETTINS
**/
	$pages = get_pages( array('post_status' => 'publish') );
	$pagecount = count($pages);

	if ($pagecount < 100 ) {
		$pages_arr = array();
		foreach ($pages as $single_page) {
			$pages_arr[$single_page->ID] = $single_page->post_title.' ['.$single_page->ID.']';
		}
		$page_type = 'select';
	}else{
		$pages_arr = array();
		$page_type = 'text';
	}
	
	/**
	*Submission System
	**/
	$sections[] = array(
		'id' => 'setup26_frontend',
		'title' => esc_html__('Frontend Upload System', 'pointfindercoreelements') ,
		'icon' => 'el-icon-upload',
		'fields' => array(
				array(
					'id' => 'setup4_membersettings_dashboard',
					'type' => $page_type,
					'options' => $pages_arr,
					'title' => esc_html__('Dashboard Page', 'pointfindercoreelements') ,
					'desc' => ($page_type == 'text')?esc_html__('This page is welcome page which will be seen by users after login. It must be selected. Please copy and paste page ID', 'pointfindercoreelements'): esc_html__('This page is welcome page which will be seen by users after login. It must be selected.', 'pointfindercoreelements'),
				) ,

				array(
					'id' => 'setup4_membersettings_frontend',
					'desc' => esc_html__('If it is disabled, only User Item Submission will be disabled. Favorite & Review Systems will not be affected.', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('User Item Submission', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'setup31_userpayments_orderprefix',
					'type' => 'text',
					'title' => esc_html__('Order ID Prefix', 'pointfindercoreelements') ,
					'default' => 'PF',
					'hint'      => array(
                		'content' => esc_html__('Prefix for order ID number. Ex: PF276325', 'pointfindercoreelements')
                	),
				) ,
            	array(
					'id' => 'setup4_membersettings_paymentsystem',
					'desc' => esc_html__('Please do not change system after begin to use the site.', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('Payment System', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Pay Per Post System', 'pointfindercoreelements') ,
						'2' => esc_html__('Membership Package System', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
				array(
					'id' => 'setup4_mem_terms',
					'desc' => esc_html__('Enable/Disable Terms and Conditions while purchasing plan.', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('Terms & Conditions for Membership', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'required' => array('setup4_membersettings_paymentsystem','=',2),
					'default' => '1'
				) ,

				array(
					'id' => 'setup4_ppp_terms',
					'desc' => esc_html__('Enable/Disable Terms and Conditions while uploading item.', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('Terms & Conditions for Item Upload', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
				array(
					'id' => 'setup4_ppp_catprice',
					'type' => 'button_set',
					'title' => esc_html__('Category Pricing', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'required' => array('setup4_membersettings_paymentsystem','=',1),
					'default' => '0'
				) ,
				array(
					'id' => 'setup4_pricevat',
					'type' => 'button_set',
					'title' => esc_html__('VAT/TAX (Included)', 'pointfindercoreelements') ,
					'desc' => esc_html__("If this enabled, Pointfinder will show percentage tax into the price area.", 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,

				array(
                    'id'        => 'setup4_pv_pr',
                    'type'      => 'spinner',
                    'title'     => esc_html__('VAT/TAX Percentage', 'pointfindercoreelements'),
                    'desc'      => esc_html__('Decimal number for price value. ', 'pointfindercoreelements'),
                    'default'   => '0',
                    'min'       => '0',
                    'step'      => '1',
                    'max'       => '90',
                    'required' => array('setup4_pricevat','=',1),
                ),
                array(
					'id' => 'viewcount_hideshow_f',
					'type' => 'button_set',
					'title' => esc_html__('View Count Frontend', 'pointfindercoreelements') ,
					'desc' => esc_html__('View count for item details and frontend dashboard.', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
				),


		),

	);


	/**
	* Payment Settings
	**/
	$sections[] = array(
		'id' => 'setup20_dbp',
		'subsection' => true,
		'title' => esc_html__('Payment Settings', 'pointfindercoreelements'),
		'fields' => array(
				array(
                    'id'        => 'setup20_paypalsettings_info1',
                    'type'      => 'info',
                    'notice'    => true,
                    'style'     => 'info',
                    'desc'      => esc_html__('Below settings will affect price value which is used in payment gateways.', 'pointfindercoreelements')
                ),
				array(
                    'id'        => 'setup20_paypalsettings_paypal_api_packagename',
                    'type'      => 'text',
                    'title'     => esc_html__('Payment Title', 'pointfindercoreelements'),
                    'default'	=> esc_html__('PointFinder Payment:','pointfindercoreelements')
                ),
                array(
                    'id'        => 'setup20_paypalsettings_paypal_price_short',
                    'type'      => 'text',
                    'title'     => esc_html__('Money Sign', 'pointfindercoreelements'),
                    'default'	=> '$'
                ),
                array(
					'id' => 'setup20_paypalsettings_paypal_price_pref',
					'type' => 'button_set',
					'title' => esc_html__('Money Sign Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Before the price', 'pointfindercoreelements') ,
						'0' => esc_html__('After the price', 'pointfindercoreelements')
					),
					'default' => '1'
				),
				array(
                    'id'        => 'setup20_1111',
                    'type'      => 'info',
                    'notice'    => true,
                    'style'     => 'info',
                    'desc'      => esc_html__("Below settings will affect price value which is used in frontend upload form and my listings page.", 'pointfindercoreelements')
                ),
				array(
                    'id'        => 'setup20_decimals_new',
                    'type'      => 'spinner',
                    'title'     => esc_html__('Decimals', 'pointfindercoreelements'),
                    'desc'      => esc_html__('Decimal number for price value. ', 'pointfindercoreelements'),
                    'default'   => '2',
                    'min'       => '0',
                    'step'      => '1',
                    'max'       => '3',
                ),
                array(
					'id' => 'setup20_paypalsettings_decimalpoint',
					'type' => 'text',
					'title' => esc_html__('Decimal Point', 'pointfindercoreelements') ,
					'default' => '.',
					'class' => 'small-text'
				),
				array(
					'id' => 'setup20_paypalsettings_thousands',
					'type' => 'text',
					'title' => esc_html__('Thousands Separator', 'pointfindercoreelements') ,
					'default' => ',',
					'class' => 'small-text'
				)
			)
	);


	/**
	*Upload Settings
	**/
		$sections[] = array(
			'id' => 'setup31_userpayments',
			'subsection' => true,
			'title' => esc_html__('Uploaded Item Settings', 'pointfindercoreelements') ,
			'fields' => array(

					array(
						'id' => 'stp_hlp1',
						'type' => 'info',
						'notice' => true,
						'style' => 'info',
						'title' => esc_html__('Rules for Items', 'pointfindercoreelements') ,
						'desc' => esc_html__('Below options will affect all new uploaded items.', 'pointfindercoreelements')
					) ,
					array(
						'id' => 'setup31_userlimits_userpublish',
						'type' => 'button_set',
						'title' => esc_html__('New Uploaded Item Status', 'pointfindercoreelements') ,
						'desc' => '<strong>'.esc_html__('Warning:','pointfindercoreelements').'</strong>'.esc_html__('If this option is changed to "Publish"; all items directly will be published after payment is completed. We recommend you to use "Pending for Approval" option to check and approve all submitted items before releasing on your website.', 'pointfindercoreelements') ,
						'options' => array(
							'1' => esc_html__('Publish Directly', 'pointfindercoreelements') ,
							'0' => esc_html__('Pending for Approval', 'pointfindercoreelements')
						) ,
						'default' => '0'

					) ,
					array(
						'id' => 'setup31_userlimits_userpublishonedit',
						'type' => 'button_set',
						'title' => esc_html__('Edited Item Status', 'pointfindercoreelements') ,
						'desc' => '<strong>'.esc_html__('Warning:','pointfindercoreelements').'</strong>'.esc_html__(' If this option is changed to "Publish"; all items directly will be published after payment is completed. We recommend you to use "Pending for Approval" option to check and approve all submitted items before releasing on your website.', 'pointfindercoreelements') ,
						'options' => array(
							'1' => esc_html__('Publish Directly', 'pointfindercoreelements') ,
							'0' => esc_html__('Pending for Approval', 'pointfindercoreelements')
						) ,
						'default' => '0'

					) ,
					array(
                        'id'        => 'setup31_userpayments_pendinglimit',
                        'type'      => 'spinner',
                        'title'     => esc_html__('Pending Payment Waiting Time', 'pointfindercoreelements'),
                        'desc'		=> esc_html__('This is the waiting period for pending payment. Item or Membership Subscription will be removed after waiting period runs out. Please set variable 0 to disable.', 'pointfindercoreelements'),
                        'default'   => '10',
                        'min'       => '0',
                        'step'      => '1',
                        'max'       => '1000000',
                    ),
                    array(
						'id' => 'setp_renew_date',
						'type' => 'button_set',
						'title' => esc_html__('Renew Listing Post Date', 'pointfindercoreelements') ,
						'desc' => esc_html__('if this option enabled, the system will renew post date on listing plan change/renew.', 'pointfindercoreelements') ,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						) ,
						'default' => '0'

					),
					array(
						'id' => 'setp_renew_datefr',
						'type' => 'button_set',
						'title' => esc_html__('Renew Listing Post Date (Free)', 'pointfindercoreelements') ,
						'desc' => esc_html__('if this option enabled, the system will renew post date on free listing plan renew.', 'pointfindercoreelements') ,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						) ,
						'default' => '0'

					),
					array(
						'id' => 'setp_renew_datef',
						'type' => 'button_set',
						'title' => esc_html__('Renew Listing Post Date on Featured Listing Update', 'pointfindercoreelements') ,
						'desc' => esc_html__('if this option enabled, the system will renew post date on listing featured option update.', 'pointfindercoreelements') ,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						) ,
						'default' => '0'

					)
			)
		);
	/**
	*Upload Settings
	**/

	/**
	*Dashboard Page Configurations
	**/
	$sections[] = array(
		'id' => 'setup29_dashboard_contents',
		'subsection' => true,
		'title' => esc_html__('Page Configurations', 'pointfindercoreelements'),
		'heading' => '',
		'fields' => array(

			array(
                'id'        => 'setup29_dashboard_contents_profile_page_layout',
                'type'      => 'image_select',
                'title'     => esc_html__('Default Dashboard Page Layout', 'pointfindercoreelements'),
                'options'   => array(
                    '2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                    '3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                ),
                'default'   => '3'
            ),
			/* Profile Page */
			array(
			    'id'        => 'accb7',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Profile Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_profile_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'Profile Page'
                ),
                array(
                    'id'        => 'setup29_dashboard_contents_profile_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'Profile'
                ),
				array(
					'id' => 'setup29_dashboard_contents_profile_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements') ,
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''
				) ,
				array(
					'id' => 'setup29_dashboard_contents_profile_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_profile_page','!=','')

				),
            array(
			    'id'        => 'acce7',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

            /* Submit Page */
            array(
			    'id'        => 'accb8',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Submit Listing Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_submit_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'Submit New Item'

                ),
                array(
                    'id'        => 'setup29_dashboard_contents_submit_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'Submit Item'

                ),
                array(
                    'id'        => 'setup29_dashboard_contents_submit_page_titlee',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title (Edit)', 'pointfindercoreelements'),
                    'default'   => 'Edit Item'

                ),
				array(
					'id' => 'setup29_dashboard_contents_submit_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements'),
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''

				) ,
				array(
					'id' => 'setup29_dashboard_contents_submit_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_submit_page','!=','')

				) ,

            array(
			    'id'        => 'acce8',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

            /* My Items Page */
            array(
			    'id'        => 'accb9',
			    'type'      => 'accordion',
			    'title'     => esc_html__('My Listings Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_my_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'My Items Page'
                ),
                array(
                    'id'        => 'setup29_dashboard_contents_my_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'My Items'
                ),
				array(
					'id' => 'setup29_dashboard_contents_my_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements') ,
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''
				) ,
				array(
					'id' => 'setup29_dashboard_contents_my_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_my_page','!=','')
				) ,

            array(
			    'id'        => 'acce9',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

            /* Favorites page */
            array(
			    'id'        => 'accb10',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Favorites Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_favs_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'My Favorites Page'
                ),
                array(
                    'id'        => 'setup29_dashboard_contents_favs_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'My Favorites'
                ),
				array(
					'id' => 'setup29_dashboard_contents_favs_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements') ,
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''
				) ,
				array(
					'id' => 'setup29_dashboard_contents_favs_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_favs_page','!=','')
				) ,

            array(
			    'id'        => 'acce10',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),


            /* Reviews Page */
            array(
			    'id'        => 'accb11',
			    'type'      => 'accordion',
			    'title'     => esc_html__('My Reviews Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_rev_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'My Reviews Page'
                ),
                array(
                    'id'        => 'setup29_dashboard_contents_rev_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'My Reviews'
                ),
				array(
					'id' => 'setup29_dashboard_contents_rev_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements') ,
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''
				) ,
				array(
					'id' => 'setup29_dashboard_contents_rev_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_rev_page','!=','')
				) ,

            array(
			    'id'        => 'acce11',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

            /* Invoices Page */
            array(
			    'id'        => 'accb12',
			    'type'      => 'accordion',
			    'title'     => esc_html__('My Invoices Page', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
            	array(
                    'id'        => 'setup29_dashboard_contents_inv_page_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Title', 'pointfindercoreelements'),
                    'default'   => 'My Invoices Page'
                ),
                array(
                    'id'        => 'setup29_dashboard_contents_inv_page_menuname',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Menu Name', 'pointfindercoreelements'),
                    'default'   => 'My Invoices'
                ),
				array(
					'id' => 'setup29_dashboard_contents_inv_page',
					'title' => esc_html__('Content Page', 'pointfindercoreelements') ,
					'type' => $page_type,
					'options' => $pages_arr,
					'desc'  => ($page_type == 'text')?esc_html__('Please copy and paste page ID', 'pointfindercoreelements'):''
				) ,
				array(
					'id' => 'setup29_dashboard_contents_inv_page_pos',
					'type' => 'button_set',
					'title' => esc_html__('Content Position', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Top of the Page', 'pointfindercoreelements') ,
						'0' => esc_html__('Bottom of the Page', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup29_dashboard_contents_rev_page','!=','')
				) ,
			array(
			    'id'        => 'acce12',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),



		)

	);




	/**
	*Submission Page Settings
	**/
	$sections[] = array(
		'id' => 'setup4_submitpage',
		'subsection' => true,
		'title' => esc_html__('Upload Page Settings', 'pointfindercoreelements') ,
		'fields' => array(
			array(
				'id' => 'ltype_st_check',
				'type' => 'button_set',
				'title' => esc_html__('Listing Type Selector Style', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Checkbox', 'pointfindercoreelements') ,
					'2' => esc_html__('Dropdown', 'pointfindercoreelements')
				) ,
				'default' => '1'
			),
			array(
                'id'        => 'setup4_submitpage_titletip',
                'type'      => 'textarea',
                'title'     => esc_html__('Title Area Tooltip', 'pointfindercoreelements'),
                'subtitle'  => '<strong>'.esc_html__('OPTIONAL :','pointfindercoreelements').' </strong>'.sprintf(esc_html__('You can add a tooltip on %s field.', 'pointfindercoreelements'),'Title'),
                'validate'  => 'no_html',

            ),
			array(
				'id' => 'setup4_sbp_dh',
				'type' => 'button_set',
				'title' => esc_html__('Description Status', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				),
				'default' => '1'

			) ,
			array(
				'id' => 'setup4_desc_ed',
				'type' => 'button_set',
				'title' => esc_html__('Description TinyMCE Editor', 'pointfindercoreelements') ,
				'description' => esc_html__('If this option disabled, system will disable custom tabs tinymce option too.', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				),
				'default' => '1'

			) ,
            array(
				'id' => 'setup4_submitpage_descriptionvcheck',
				'type' => 'button_set',
				'title' => esc_html__('Description Validation', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				),
				'default' => '0'

			) ,
			array(
				'id' => 'setup4_submitpage_video',
				'type' => 'button_set',
				'title' => esc_html__('Featured Video Area', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1'
			) ,
			array(
				'id' => 'stp4_psttags',
				'type' => 'button_set',
				'title' => esc_html__('Post Tags Area', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1'
			) ,
			array(
				'id' => 'setup4_submitpage_messagetorev',
				'type' => 'button_set',
				'title' => esc_html__('Message to Reviewer Area', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('Enable', 'pointfindercoreelements') ,
					'0' => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => '1'

			) ,
			array(
			    'id'        => 'accb13',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Events Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'eare_status',
					'type' => 'button_set',
					'title' => esc_html__('Event Area Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
            	array(
					'id' => 'earea_y1',
					'type' => 'text',
					'title' => esc_html__('Start Year', 'pointfindercoreelements') ,
					'default' => date("Y"),
					'required' => array('eare_status','=',1)
				),
				array(
					'id' => 'earea_y2',
					'type' => 'text',
					'title' => esc_html__('End Year', 'pointfindercoreelements') ,
					'default' => (date("Y")+10),
					'required' => array('eare_status','=',1)
				),
				array(
					'id' => 'eare_times',
					'type' => 'button_set',
					'title' => esc_html__('Time Fields', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('eare_status','=',1)
				) ,
				array(
					'id' => 'earea_vcheck',
					'type' => 'button_set',
					'title' => esc_html__('Event Area Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'default' => '0',
					'required' => array('eare_status','=',1)

				) ,
				array(
					'id' => 'earea_verror',
					'type' => 'text',
					'title' => esc_html__('Event Area Validation Error', 'pointfindercoreelements') ,
					'required'	=> array(array('earea_vcheck','=','1'),array('eare_status','=',1)),
					'default' => esc_html__('Please choose event date and time.', 'pointfindercoreelements')
				) ,
            array(
			    'id'        => 'acce13',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

            array(
			    'id'        => 'accb14',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Address/Map Selection Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
                array(
					'id' => 'st4_sp_med',
					'type' => 'button_set',
					'title' => esc_html__('Address/Map Area', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
				array(
					'id' => 'setup4_submitpage_maparea_title',
					'type' => 'text',
					'title' => esc_html__('Address/Map Area Title', 'pointfindercoreelements') ,
					'default' => esc_html__('Address', 'pointfindercoreelements'),
					'required' => array('st4_sp_med','=',1)
				) ,
				array(
                    'id'        => 'setup4_submitpage_maparea_tooltip',
                    'type'      => 'textarea',
                    'title'     => esc_html__('Address/Map Area Tooltip', 'pointfindercoreelements'),
                    'subtitle'  => '<strong>'.esc_html__('OPTIONAL :','pointfindercoreelements').' </strong>'.sprintf(esc_html__('You can add a tooltip on %s area.', 'pointfindercoreelements'),'Address'),
                    'validate'  => 'no_html',
					'default' => esc_html__('Please select a location by moving marker.', 'pointfindercoreelements'),
					'required' => array('st4_sp_med','=',1)

                ),
                array(
					'id' => 'st4_sp_med2',
					'type' => 'button_set',
					'title' => esc_html__('Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,

				array(
					'id' => 'st4_sp_medst',
					'type' => 'button_set',
					'title' => esc_html__('Streetview Selection (Frontend)', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
			array(
			    'id'        => 'acce14',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

			array(
			    'id'        => 'accb15',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Custom Tabs Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
			
				array(
					'id' => 'stp4_ctt1',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 1', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt1_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 1 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt2',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 2', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt2_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 2 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt3',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 3', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt3_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 3 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt4',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 4', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt4_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 4 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt5',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 5', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt5_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 5 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt6',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 6', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'stp4_ctt6_t',
					'type' => 'button_set',
					'title' => esc_html__('Custom Tab 6 TinyMCE', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
			array(
			    'id'        => 'acce15',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb16',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Image Upload Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
                array(
					'id' => 'setup4_submitpage_imageupload',
					'type' => 'button_set',
					'title' => esc_html__('Image Upload Area', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'

				) ,
            	array(
					'id' => 'setup4_submitpage_status_old',
					'type' => 'button_set',
					'title' => esc_html__('Old Style Upload System', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0',
					'required'	=> array('setup4_submitpage_imageupload','=','1'),

				) ,
                array(
                    'id'        => 'setup4_submitpage_imagelimit',
                    'type'      => 'spinner',
                    'title'     => esc_html__('Image Upload Limit', 'pointfindercoreelements'),

                    'default'   => '10',
                    'min'       => '1',
                    'step'      => '1',
                    'max'       => '100',
                    'required'	=> array('setup4_submitpage_imageupload','=',1)
                ),
                array(
                    'id'        => 'setup4_submitpage_imagesizelimit',
                    'type'      => 'spinner',
                    'title'     => esc_html__('Image Upload Size Limit', 'pointfindercoreelements'),
                    'desc'     => esc_html__('mb (megabayt)', 'pointfindercoreelements'),
                    'default'   => '2',
                    'min'       => '1',
                    'step'      => '1',
                    'max'       => '20',
                    'required'	=> array('setup4_submitpage_imageupload','=',1)
                ),
                array(
					'id' => 'setup4_submitpage_featuredverror_status',
					'type' => 'button_set',
					'title' => esc_html__('Image Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('setup4_submitpage_imageupload','=','1'),

				) ,
                
				array(
					'id' => 'setup4_coviup',
					'type' => 'button_set',
					'title' => esc_html__('Header Image Upload', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0',
					'required'	=> array('setup4_submitpage_imageupload','=','1'),

				) ,
				array(
					'id' => 'setup4_coviup_req',
					'type' => 'button_set',
					'title' => esc_html__('Header Image Upload Required', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '0',
					'required'	=> array('setup4_submitpage_imageupload','=','1'),

				) ,
			array(
			    'id'        => 'acce16',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

			array(
			    'id'        => 'accb17',
			    'type'      => 'accordion',
			    'title'     => esc_html__('File Upload Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
             	array(
					'id' => 'stp4_fupl',
					'type' => 'button_set',
					'title' => esc_html__('File Upload Area', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'

				) ,
                array(
                    'id'        => 'stp4_Filelimit',
                    'type'      => 'spinner',
                    'title'     => esc_html__('File Upload Limit', 'pointfindercoreelements'),

                    'default'   => '10',
                    'min'       => '1',
                    'step'      => '1',
                    'max'       => '100',
                    'required'	=> array('stp4_fupl','=',1)
                ),
                array(
                    'id'        => 'stp4_Filesizelimit',
                    'type'      => 'spinner',
                    'title'     => esc_html__('File Upload Size Limit', 'pointfindercoreelements'),
                    'desc'     => esc_html__('mb (megabayt)', 'pointfindercoreelements'),
                    'default'   => '2',
                    'min'       => '1',
                    'step'      => '1',
                    'max'       => '20',
                    'required'	=> array('stp4_fupl','=',1)
                ),
                array(
					'id' => 'stp4_err_st',
					'type' => 'button_set',
					'title' => esc_html__('File Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required'	=> array('stp4_fupl','=','1'),

				),
				array(
					'id' => 'stp4_allowed',
					'type' => 'text',
					'title' => esc_html__('Allowed file extensions', 'pointfindercoreelements') ,
					'required'	=> array('stp4_fupl','=','1'),
					'desc' => esc_html__('Please write like: doc,pdf,zip', 'pointfindercoreelements'),
					'default' => 'jpg,jpeg,gif,png,pdf,rtf,csv,zip, x-zip, x-zip-compressed,rar,doc,docx,docm,dotx,dotm,docb,xls,xlt,xlm,xlsx,xlsm,xltx,xltm,ppt,pot,pps,pptx,pptm'
				) ,

			array(
			    'id'        => 'acce17',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb18',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Listing Types Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup4_submitpage_listingtypes_title',
					'type' => 'text',
					'title' => esc_html__('Selection Box Title', 'pointfindercoreelements') ,
					'default' => esc_html__('Listing Type', 'pointfindercoreelements')
				) ,

				array(
					'id' => 'setup4_submitpage_sublistingtypes_title',
					'type' => 'text',
					'title' => esc_html__('Sub Selection Box Title', 'pointfindercoreelements') ,
					'default' => esc_html__('Sub Listing Type', 'pointfindercoreelements')
				) ,

				array(
					'id' => 'setup4_submitpage_subsublistingtypes_title',
					'type' => 'text',
					'title' => esc_html__('2nd Sub Selection Box Title', 'pointfindercoreelements') ,
					'default' => esc_html__('Sub Sub Listing Type', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'setup4_submitpage_listingtypes_verror',
					'type' => 'text',
					'title' => esc_html__('Selection Box Validation Error', 'pointfindercoreelements') ,
					'default' => esc_html__('Please select a listing type.', 'pointfindercoreelements')
				),
				array(
					'id' => 'stp4_forceu',
					'type' => 'button_set',
					'title' => esc_html__('Force users to select sub category', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0

				),
            array(
			    'id'        => 'acce18',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
            array(
			    'id'        => 'accb19',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Item Types Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			    'required'	=> array('setup3_pointposttype_pt4_check','=','1')
			),
            	array(
					'id' => 'setup4_submitpage_itemtypes_check',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'required'	=> array('setup3_pointposttype_pt4_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'setup4_submitpage_itemtypes_title',
					'type' => 'text',
					'title' => esc_html__('Selection Box Title', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_itemtypes_check','=','1'),
						array('setup3_pointposttype_pt4_check','=','1')
					),
					'default' => esc_html__('Item Type', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'setup4_submitpage_itemtypes_multiple',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Multiple', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Multiple Selection', 'pointfindercoreelements') ,
						'0' => esc_html__('Single Selection', 'pointfindercoreelements')
					) ,
					'required'	=> array(
						array('setup4_submitpage_itemtypes_check','=','1'),
						array('setup3_pointposttype_pt4_check','=','1')
					),
					'default' => '0'

				) ,
				array(
					'id' => 'setup4_submitpage_itemtypes_validation',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'required'	=> array('setup4_submitpage_itemtypes_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'setup4_submitpage_itemtypes_verror',
					'type' => 'text',
					'title' => esc_html__('Selection Box Validation Error', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_itemtypes_check','=','1'),
						array('setup4_submitpage_itemtypes_validation','=','1')
					),
					'default' => esc_html__('Please select an item type.', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'stp_hlp3',
					'type' => 'info',
					'notice' => true,
					'style' => 'warning',
					'desc' => esc_html__('This taxonomy currently disabled by Options Panel > System Setup > Post Type Setup', 'pointfindercoreelements'),
					'required'	=> array('setup3_pointposttype_pt4_check','=','0'),
				) ,
				
            array(
			    'id'        => 'acce19',
			    'type'      => 'accordion',
			    'position'  => 'end',
			    'required'	=> array('setup3_pointposttype_pt4_check','=','1')
			),

            array(
			    'id'        => 'accb20',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Locations Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			    'required'	=> array('setup3_pointposttype_pt5_check','=','1'),
			),
            	array(
					'id' => 'setup4_submitpage_locationtypes_check',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'required'	=> array('setup3_pointposttype_pt5_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'setup4_submitpage_locationtypes_title',
					'type' => 'text',
					'title' => esc_html__('Selection Box Title', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
					),
					'default' => esc_html__('Location', 'pointfindercoreelements')
				) ,

				array(
					'id' => 'stp4_loc_new',
					'type' => 'button_set',
					'title' => esc_html__('Location System with AJAX', 'pointfindercoreelements') ,
					'desc' => esc_html__('This options enable 3 level location with AJAX load & User locations option. But disable multiple location select & group options.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1')
					),
					'default' => '0'

				) ,
				array(
					'id' => 'stp4_loc_add',
					'type' => 'button_set',
					'title' => esc_html__('Users Can Add Location', 'pointfindercoreelements') ,
					'desc' => esc_html__('This options enable to add locations for users.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
						array('stp4_loc_new','=','1')
					),
					'default' => '0'

				) ,
				array(
					'id' => 'stp4_loc_level',
					'type' => 'button_set',
					'title' => esc_html__('Users Can Add Location: Level', 'pointfindercoreelements') ,
					'desc' => esc_html__('Please choose level of custom location', 'pointfindercoreelements') ,
					'options' => array(
						'2' => esc_html__('Sub Location (2)', 'pointfindercoreelements') ,
						'3' => esc_html__('Sub Sub Location (3)', 'pointfindercoreelements')
					) ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
						array('stp4_loc_new','=','1')
					),
					'default' => 3

				) ,
				array(
					'id' => 'stp4_sublotyp_title',
					'type' => 'text',
					'title' => esc_html__('2nd Selection Box Title', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
						array('stp4_loc_new','=','1')
					),
					'default' => esc_html__('Sub Location', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'stp4_subsublotyp_title',
					'type' => 'text',
					'title' => esc_html__('3rd Selection Box Title', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
						array('stp4_loc_new','=','1')
					),
					'default' => esc_html__('Sub Sub Location', 'pointfindercoreelements')
				) ,

				array(
					'id' => 'setup4_submitpage_locationtypes_multiple',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Multiple', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Multiple Selection', 'pointfindercoreelements') ,
						'0' => esc_html__('Single Selection', 'pointfindercoreelements')
					) ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup3_pointposttype_pt5_check','=','1'),
						array('stp4_loc_new','=','0')
					),
					'default' => '0'

				) ,
				array(
					'id' => 'setup4_submitpage_locationtypes_validation',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'required'	=> array('setup4_submitpage_locationtypes_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'setup4_submitpage_locationtypes_verror',
					'type' => 'text',
					'title' => esc_html__('Selection Box Validation Error', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_locationtypes_check','=','1'),
						array('setup4_submitpage_locationtypes_validation','=','1')
					),
					'default' => esc_html__('Please select a location type.', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'stp_hlp4',
					'type' => 'info',
					'notice' => true,
					'style' => 'warning',
					'desc' => esc_html__('This taxonomy currently disabled by Options Panel > System Setup > Post Type Setup', 'pointfindercoreelements'),
					'required'	=> array('setup3_pointposttype_pt5_check','=','0'),
				) ,
            array(
			    'id'        => 'acce20',
			    'type'      => 'accordion',
			    'position'  => 'end',
			    'required'	=> array('setup3_pointposttype_pt5_check','=','1'),
			),
            array(
			    'id'        => 'accb21',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Features Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			    'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
			),
            	array(
					'id' => 'setup4_submitpage_featurestypes_title',
					'type' => 'text',
					'title' => __('Selection Box Title', 'pointfindercoreelements') ,
					'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
					'default' => __('Features', 'pointfindercoreelements')
				) ,
            	array(
					'id' => 'setup4_submitpage_featurestypes_check',
					'type' => 'button_set',
					'title' => esc_html__('Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'stp_hlp5',
					'type' => 'info',
					'notice' => true,
					'style' => 'warning',
					'desc' => esc_html__('This taxonomy currently disabled by Options Panel > System Setup > Post Type Setup', 'pointfindercoreelements'),
					'required'	=> array('setup3_pointposttype_pt6_check','=','0'),
				) ,
            array(
			    'id'        => 'acce21',
			    'type'      => 'accordion',
			    'position'  => 'end',
			    'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
			),
            array(
			    'id'        => 'accb22',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Conditions Area', 'pointfindercoreelements'),
			    'open' 		=> false,
			    'position'  => 'start',
			    'required'	=> array('setup4_submitpage_conditions_check','=','1'),
			),
            	array(
					'id' => 'setup4_submitpage_conditions_title',
					'type' => 'text',
					'title' => esc_html__('Selection Box Title', 'pointfindercoreelements') ,
					'default' => esc_html__('Conditions', 'pointfindercoreelements'),
					'required'	=> array('setup4_submitpage_conditions_check','=','1'),
				) ,
            	array(
					'id' => 'setup4_submitpage_conditions_check',
					'type' => 'button_set',
					'title' => esc_html__('Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0,
					'required'	=> array('setup4_submitpage_conditions_check','=','1'),

				) ,
				array(
					'id' => 'setup4_submitpage_conditions_validation',
					'type' => 'button_set',
					'title' => esc_html__('Selection Box Validation', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'required'	=> array('setup4_submitpage_conditions_check','=','1'),
					'default' => '1'

				) ,
				array(
					'id' => 'setup4_submitpage_conditions_verror',
					'type' => 'text',
					'title' => esc_html__('Selection Box Validation Error', 'pointfindercoreelements') ,
					'required'	=> array(
						array('setup4_submitpage_conditions_check','=','1'),
						array('setup4_submitpage_conditions_validation','=','1')
					),
					'default' => esc_html__('Please select a condition.', 'pointfindercoreelements'),
				) ,
				array(
					'id' => 'stp_hlp55',
					'type' => 'info',
					'notice' => true,
					'style' => 'warning',
					'desc' => esc_html__('This taxonomy currently disabled by Options Panel > System Setup > Post Type Setup', 'pointfindercoreelements'),
					'required'	=> array('setup3_pt14_check','=','0'),
				) ,
            array(
			    'id'        => 'acce22',
			    'type'      => 'accordion',
			    'position'  => 'end',
			    'required'	=> array('setup4_submitpage_conditions_check','=','1'),
			),
		)
	);


	/**
	*Profile Page Settings
	**/
		$sections[] = array(
			'id' => 'stp_prf',
			'subsection' => true,
			'title' => esc_html__('Profile Page Settings', 'pointfindercoreelements') ,
			'fields' => array(
				array(
					'id' => 'stp_prf_vat',
					'type' => 'button_set',
					'title' => esc_html__('Vat Field', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => 1

				) ,
				array(
					'id' => 'stp_prf_country',
					'type' => 'button_set',
					'title' => esc_html__('Country Field', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => 1

				) ,
				array(
					'id' => 'stp_prf_address',
					'type' => 'button_set',
					'title' => esc_html__('Address Field', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => 1

				) ,
				array(
					'id' => 'stp_prf_city',
					'type' => 'button_set',
					'title' => esc_html__('City Field', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => 1

				),
				array(
                    'id' => 'st11_accremoval',
                    'type' => 'button_set',
                    'title' => esc_html__("Account Data Removal", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ) ,
				array(
                    'id' => 'st11_userdel',
                    'type' => 'button_set',
                    'title' => esc_html__("Delete User Account Data", 'pointfindercoreelements') ,
                    'desc' => esc_html__('if this option enabled, the system will remove the user account data and all information while processing "User Data Removal Request". This option will not remove the user completely. The system will remove, metadata that belongs to this theme, membership package and recurring payments that belong to the membership if it exists.', 'pointfindercoreelements') ,
                    "default" => 0,
                    'options' => array(
                        '1' => esc_html__('Yes', 'pointfindercoreelements') ,
                        '0' => esc_html__('No', 'pointfindercoreelements')
                    ),
                    "required" => array("st11_accremoval","=","1")
                ) ,
                array(
                    'id' => 'st11_listingdel',
                    'type' => 'button_set',
                    'title' => esc_html__("Delete User Listings and Order Records", 'pointfindercoreelements') ,
                    'desc' => esc_html__('if this option enabled, the system will remove the user listings (including media attachments), listing recurring payments and all order records while processing "User Data Removal Request"') ,
                    "default" => 0,
                    'options' => array(
                        '1' => esc_html__('Yes', 'pointfindercoreelements') ,
                        '0' => esc_html__('No', 'pointfindercoreelements')
                    ),
                    "required" => array("st11_accremoval","=","1")
                ) ,

			)
		);
	/**
	*Profile Page Settings
	**/



	/**
	*Pay per post Settings
	**/
	$sections[] = array(
		'id' => 'st31_up2',
		'subsection' => true,
		'title' => esc_html__('PPP Default Package', 'pointfindercoreelements') ,
		'heading' => esc_html__('Pay Per Post Default Package', 'pointfindercoreelements') ,
		'fields' => array(
				array(
					'id' => 'stp31_up2_pn',
					'type' => 'text',
					'title' => esc_html__('First Package: Name', 'pointfindercoreelements') ,
					'default' => esc_html__('Basic Package', 'pointfindercoreelements'),
					'hint'      => array(
                		'content' => esc_html__('This is the first pay per post package name area.', 'pointfindercoreelements')
                	),
				),
				array(
                    'id'        => 'setup31_userpayments_priceperitem',
                    'type'      => 'spinner',
                    'title'     => esc_html__('First Package: Price', 'pointfindercoreelements'),
                    'desc'		=> esc_html__('Write 0 for free. You can define price sign and currency from Paypal Settings.', 'pointfindercoreelements'),
                    'default'   => '10',
                    'min'       => '0',
                    'step'      => '1',
                    'max'       => '100000'
                ),
                array(
                    'id'        => 'setup31_userpayments_timeperitem',
                    'type'      => 'spinner',
                    'title'     => esc_html__('First Package: Duration', 'pointfindercoreelements'),
                    'desc'		=> esc_html__('Time unit: days', 'pointfindercoreelements'),
                    'default'   => '10',
                    'min'       => '0',
                    'step'      => '1',
                    'max'       => '1000000'
                ),
                array(
					'id' => 'stp_hlp6',
					'type' => 'info',
					'notice' => true,
					'style' => 'info',
					'desc' => sprintf(esc_html__('Please check %s Listing Packages page %s for define more package.', 'pointfindercoreelements'),'<a href="'.admin_url('edit.php?post_type=pflistingpacks').'"><strong>','</strong></a>')
				),
				array(
					'id' => 'stp31_userfree',
					'type' => 'button_set',
					'title' => esc_html__('User Free Plan Renew', 'pointfindercoreelements') ,
					'desc'		=> esc_html__('If this enabled, user can renew free plans forever.', 'pointfindercoreelements'),
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0

				) ,
				array(
					'id' => 'stp31_freeplne',
					'type' => 'button_set',
					'title' => esc_html__('User Free Plan Not Expire', 'pointfindercoreelements') ,
					'desc'		=> esc_html__('If this enabled, free plan never expires.', 'pointfindercoreelements'),
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0

				) ,
				array(
					'id' => 'stp31_displn',
					'type' => 'button_set',
					'title' => esc_html__('Disable Plan View', 'pointfindercoreelements') ,
					'desc'		=> esc_html__('If this enabled, the system will disable Listing Package section. You can use this option if you only using free plan and do not want to show that area.', 'pointfindercoreelements'),
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0

				)

		)

	);


	/**
	*Pay per post Limits
	**/
	$sections[] = array(
		'id' => 'setup31_userpayments_1',
		'subsection' => true,
		'title' => esc_html__('My Listing Limits', 'pointfindercoreelements') ,
		'fields' => array(
				array(
					'id' => 'stp_hlp7',
					'type' => 'info',
					'notice' => true,
					'style' => 'info',
					'title' => esc_html__('Limits for Items', 'pointfindercoreelements') ,
					'desc' => esc_html__('Below options will affect all user items.', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'setup31_userlimits_useredit',
					'type' => 'button_set',
					'title' => esc_html__('Can user edit published items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
				array(
					'id' => 'setup31_userlimits_userdelete',
					'type' => 'button_set',
					'title' => esc_html__('Can user remove published items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1'

				) ,
				array(
					'id' => 'setup31_userlimits_userdelete_pendingapproval',
					'type' => 'button_set',
					'title' => esc_html__('Can user remove pending approval items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1'

				) ,
				array(
					'id' => 'setup31_userlimits_useredit_pendingpayment',
					'type' => 'button_set',
					'title' => esc_html__('Can user edit pending payment items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('setup4_membersettings_paymentsystem','=',1)
				) ,
				array(
					'id' => 'setup31_userlimits_userdelete_pendingpayment',
					'type' => 'button_set',
					'title' => esc_html__('Can user remove pending payment items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('setup4_membersettings_paymentsystem','=',1)

				) ,
				array(
					'id' => 'setup31_userlimits_useredit_rejected',
					'type' => 'button_set',
					'title' => esc_html__('Can user edit rejected items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
				array(
					'id' => 'setup31_userlimits_userdelete_rejected',
					'type' => 'button_set',
					'title' => esc_html__('Can user remove rejected items?', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1'

				) ,
			)
	);


	/**
	*Featured Item Settings
	**/
	$sections[] = array(
		'id' => 'setup32_featureditems',
		'subsection' => true,
		'title' => esc_html__('Featured Listing Settings', 'pointfindercoreelements') ,
		'fields' => array(
                array(
					'id' => 'setup31_userpayments_featuredoffer',
					'type' => 'button_set',
					'title' => esc_html__('Featured Item Offer Area', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'

				) ,
				array(
                    'id'        => 'setup31_userpayments_featuredoffer-start',
                    'type'      => 'section',
                    'indent'    => true,
                    'required'	=>array('setup31_userpayments_featuredoffer','=','1'),
                ),

                	array(
						'id' => 'stpfeaallon',
						'type' => 'button_set',
						'title' => esc_html__('Featured Item Always On', 'pointfindercoreelements') ,
						'desc'	=> esc_html__('Featured Item area will be automatically enabled on new entries.', 'pointfindercoreelements'),
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						) ,
						'required'	=>array('setup31_userpayments_featuredoffer','=','1'),
						'default' => '0'

					) ,

                	array(
						'id' => 'setup31_userpayments_titlefeatured',
						'type' => 'text',
						'title' => esc_html__('Title for Featured Item', 'pointfindercoreelements') ,
						'required'	=>array('setup31_userpayments_featuredoffer','=','1'),
						'default' => esc_html__('Featured Item','pointfindercoreelements')
					) ,
                    array(
                        'id'        => 'setup31_userpayments_pricefeatured',
                        'type'      => 'spinner',
                        'title'     => esc_html__('Price for Featured Item', 'pointfindercoreelements'),
                        'desc'		=> esc_html__('This option can not be free! You can define price sign and currency on Paypal Settings. This price only works with Pay Per Post System', 'pointfindercoreelements'),
                        'default'   => '5',
                        'min'       => '1',
                        'step'      => '1',
                        'max'       => '10000000',
                        'required'	=> array(array('setup31_userpayments_featuredoffer','=',1),array('setup4_membersettings_paymentsystem','=',1))
                    ),

                    array(
                        'id'        => 'stp31_daysfeatured',
                        'type'      => 'spinner',
                        'title'     => esc_html__('Duration for Featured Item', 'pointfindercoreelements'),
                        'desc'		=> esc_html__('You can define duration for featured item option. This option only works with Pay Per Post System', 'pointfindercoreelements'),
                        'default'   => '3',
                        'min'       => '1',
                        'step'      => '1',
                        'max'       => '10000000',
                        'required'	=> array(array('setup31_userpayments_featuredoffer','=',1),array('setup4_membersettings_paymentsystem','=',1))
                    ),

                    array(
	                    'id'        => 'setup31_userpayments_textfeatured',
	                    'type'      => 'textarea',
	                    'title'     => esc_html__('Description for Featured Listing Card', 'pointfindercoreelements'),
	                    'default'	=> esc_html__('Featured item option have more visibility than others. Enable this option and appear on top of listings.','pointfindercoreelements'),
	                    'required'	=> array('setup31_userpayments_featuredoffer','=',1)
	                ),
	                array(
                        'id'        => 'setup31_userpayments_featuredbgc',
                        'type'      => 'color',
                        'transparent' => false,
                        'compiler'	=> array('#pfuaprofileform .pfupload-featured-item-box'),
                        'mode'      => 'background',
                        'title'     => esc_html__('Background Color for Box', 'pointfindercoreelements'),
                        'default'   => '#fae7a2',
                        'validate'  => 'color',
                        'required'	=> array('setup31_userpayments_featuredoffer','=',1)
                    ),
                    array(
                        'id'        => 'setup31_userpayments_featuredtextc',
                        'type'      => 'color',
                        'compiler'	=> array('#pfuaprofileform .pfupload-featured-item-box'),
                        'transparent' => false,
                        'title'     => esc_html__('Text Color for Box', 'pointfindercoreelements'),
                        'default'   => '#494949',
                        'validate'  => 'color',
                        'required'	=> array('setup31_userpayments_featuredoffer','=',1)
                    ),

                array(
                    'id'        => 'setup31_userpayments_featuredoffer-end',
                    'type'      => 'section',
                    'indent'    => false,
                    'required'	=>array('setup31_userpayments_featuredoffer','=','1')
                ),
              )
	);





	/**
	*Paypal Settings
	**/
	$sections[] = array(
		'id' => 'setup20_paypalsettings',
		'subsection' => true,
		'title' => esc_html__('Paypal Settings', 'pointfindercoreelements'),
		'fields' => array(
				array(
					'id' => 'setup20_paypalsettings_paypal_status',
					'type' => 'button_set',
					'title' => esc_html__('Paypal Payment System', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0
				) ,
				array(
					'id' => 'setup20_paypalsettings_paypal_sandbox',
					'desc' => esc_html__('If you are using LIVE site please disable this after test.', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('Sandbox(TEST) Mode', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('setup20_paypalsettings_paypal_status','=','1')
				) ,
				array(
					'id' => 'setup31_userpayments_recurringoption',
					'type' => 'button_set',
					'title' => esc_html__('Paypal Recurring Payments', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1',
                    'required' => array('setup20_paypalsettings_paypal_status','=','1')
				) ,

				array(
					'id' => 'setup20_paypalsettings_paypal_verified',
					'desc' => esc_html__('If this option is enabled: Pointfinder will only accept payments from verified Paypal Users', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'title' => esc_html__('Accept Only Verified Users', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0',
					'required' => array('setup20_paypalsettings_paypal_status','=','1')
				) ,
				array(
                    'id'        => 'setup20_paypalsettings_paypal_price_unit',
                    'type'      => 'text',
                    'title'     => esc_html__('Paypal Price Unit', 'pointfindercoreelements'),
                    'default'	=> 'USD',
                    'hide'	=> true,
                    'required' => array('setup20_paypalsettings_paypal_status','=','1'),
                    'desc'		=> sprintf(esc_html__('You can find all currency codes on this page %s', 'pointfindercoreelements'),'<a href="https://developer.paypal.com/docs/classic/api/currency_codes/" target="_blank">https://developer.paypal.com/docs/classic/api/currency_codes/</a>'),
                ),
				array(
                    'id'        => 'setup20_paypalsettings_paypal_api_user',
                    'type'      => 'text',
                    'title'     => esc_html__('Paypal API User', 'pointfindercoreelements'),
                    'required' => array('setup20_paypalsettings_paypal_status','=','1')
                ),
                array(
                    'id'        => 'setup20_paypalsettings_paypal_api_pwd',
                    'type'      => 'text',
                    'title'     => esc_html__('Paypal API Password', 'pointfindercoreelements'),
                    'required' => array('setup20_paypalsettings_paypal_status','=','1')
                ),
                array(
                    'id'        => 'setup20_paypalsettings_paypal_api_signature',
                    'type'      => 'text',
                    'title'     => esc_html__('Paypal API Signature', 'pointfindercoreelements'),
                    'required' => array('setup20_paypalsettings_paypal_status','=','1')
                ),
                array(
					'id' => 'setup20_paypalsettings_decimals',
					'type' => 'button_set',
					'title'     => esc_html__('Decimals', 'pointfindercoreelements'),
                    'desc'      => esc_html__('Decimal number for price value. ', 'pointfindercoreelements'),
					'options' => array(
						'2' => '2' ,
						'0' => '0'
					) ,
					'default' => '2',
					'required' => array('setup20_paypalsettings_paypal_status','=','1'),
				)
			) ,
	);


	/**
	*Stripe Settings
	**/
	$sections[] = array(
		'id' => 'setup20_stripesettings',
		'subsection' => true,
		'title' => esc_html__('Stripe Settings', 'pointfindercoreelements'),
		'fields' => array(
				array(
					'id' => 'setup20_stripesettings_status',
					'type' => 'button_set',
					'title' => esc_html__('Stripe Payment System', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
                    'id'        => 'setup20_stripesettings_secretkey',
                    'type'      => 'text',
                    'title'     => esc_html__('Secret Key', 'pointfindercoreelements'),
                    'required' => array('setup20_stripesettings_status','=','1')
                ),
                array(
                    'id'        => 'setup20_stripesettings_publishkey',
                    'type'      => 'text',
                    'title'     => esc_html__('Publishable Key', 'pointfindercoreelements'),
                    'required' => array('setup20_stripesettings_status','=','1')
                ),
                array(
                    'id'        => 'setup20_stripesettings_sitename',
                    'type'      => 'text',
                    'title'     => esc_html__('Site Name', 'pointfindercoreelements'),
                    'desc' => esc_html__('This will seen in payment box. Ex: Stripe.com', 'pointfindercoreelements') ,
                    'required' => array('setup20_stripesettings_status','=','1')
                ),
                array(
                    'id'        => 'setup20_stripesettings_currency',
                    'type'      => 'text',
                    'title'     => esc_html__('Stripe Currency', 'pointfindercoreelements'),
                    'default'	=> 'USD',
                    'required' => array('setup20_stripesettings_status','=','1'),
                    'desc'		=> sprintf(esc_html__('Three-letter ISO currency code, in lowercase. Must be a %ssupported currency%s.', 'pointfindercoreelements'),'<a href="https://support.stripe.com/questions/which-currencies-does-stripe-support" target="_blank">','</a>'),
                ),
                array(
					'id' => 'setup20_stripesettings_decimals',
					'type' => 'button_set',
					'title' => esc_html__('Decimals', 'pointfindercoreelements') ,
					'desc'      => sprintf(esc_html__('Please check this page: %s DECIMAL INFO %s %s If your currency listed in this page please use decimal number 0', 'pointfindercoreelements'),'<a href="https://support.stripe.com/questions/which-zero-decimal-currencies-does-stripe-support" target="_blank">','</a>','<br/>'),
					'options' => array(
						'2' => '2' ,
						'0' => '0'
					) ,
					'default' => '2',
					'required' => array('setup20_stripesettings_status','=','1'),
				),
				array(
					'id' => 'stpromo',
					'type' => 'button_set',
					'title' => esc_html__('Allow Promo Codes', 'pointfindercoreelements'),
					'desc' => esc_html__('Please enable to allow Stripe Promo Codes.', 'pointfindercoreelements'),
					'options' => array(
						'1' => esc_html__('Yes', 'pointfindercoreelements') ,
						'0' => esc_html__('No', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('setup20_stripesettings_status','=','1'),
				),
				array(
					'id' => 'billingad',
					'type' => 'button_set',
					'title' => esc_html__('Billing Address', 'pointfindercoreelements'),
					'desc' => esc_html__('Please enable if you want to require a billing address on every payment.', 'pointfindercoreelements'),
					'options' => array(
						'required' => esc_html__('Required', 'pointfindercoreelements') ,
						'auto' => esc_html__('Not Required', 'pointfindercoreelements')
					) ,
					'default' => 'auto',
					'required' => array('setup20_stripesettings_status','=','1'),
				)
		)
	);

	/**
	*Bank Deposit Settings
	**/
	$sections[] = array(
		'id' => 'setup20_bankdepositsettings',
		'subsection' => true,
		'title' => esc_html__('Bank Deposit Settings', 'pointfindercoreelements'),
		'fields' => array(
				array(
					'id' => 'setup20_paypalsettings_bankdeposit_status',
					'type' => 'button_set',
					'title' => esc_html__('Bank Deposit System', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
                    'id'        => 'setup20_bankdepositsettings_text',
                    'type'      => 'textarea',
                    'title'     => esc_html__('Bank Deposit Page Instruction', 'pointfindercoreelements'),
                    'subtitle'  => esc_html__('This text will be seen after bank transfer payment option is selected.', 'pointfindercoreelements'),
                    'required'	=> array('setup20_paypalsettings_bankdeposit_status','=','1'),
                    'validate'      => 'html_custom',
                    'allowed_html'  => array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array(), 'p' => array( 'align' => true, 'dir' => true, 'lang' => true, 'xml:lang' => true, ), 'b' => array(), 'blockquote' => array( 'cite' => true, 'lang' => true, 'xml:lang' => true, ), 'div' => array( 'align' => true, 'dir' => true, 'lang' => true, 'xml:lang' => true, ), 'font' => array( 'color' => true, 'face' => true, 'size' => true, ), 'h1' => array( 'align' => true, ), 'h2' => array( 'align' => true, ), 'h3' => array( 'align' => true, ), 'h4' => array( 'align' => true, ), 'h5' => array( 'align' => true, ), 'h6' => array( 'align' => true, ), 'ul' => array( 'type' => true, ), 'li' => array( 'align' => true, 'value' => true, ), ) ),

			) ,
	);
/**
*End : FRONTEND SUBMISSON SETTINS
**/




/**
*Start : SYSTEM SETUP
**/
	$sections[] = array(
		'id' => 'setup23_systemsetup',
		'title' => esc_html__('System Setup', 'pointfindercoreelements'),
		'icon' => 'el-icon-wrench',
		'fields' => array(

				array(
					'id' => 'system_search_setup',
					'type' => 'button_set',
					'title' => esc_html__('System Keyword Search Setup', 'pointfindercoreelements') ,

					'options' => array(
						'1' => esc_html__('By using OR operator', 'pointfindercoreelements') ,
						'2' => esc_html__('By using AND operator', 'pointfindercoreelements'),
						'3' => esc_html__('By using Exact word', 'pointfindercoreelements'),
						'4' => esc_html__('By using Mixed word', 'pointfindercoreelements')
					) ,
					'default' => '3',
					'desc' => esc_html__('Examples: My search word is "my word"', 'pointfindercoreelements').'<br/>'.
					esc_html__('If options OR option selected: System will use %my% or %word% and show too much results.', 'pointfindercoreelements').'<br/>'.
					esc_html__('If options AND option selected: System will use %my% and %word% and show less results.', 'pointfindercoreelements').'<br/>'.
					esc_html__('If options "Exact Word" option selected: System will use %my word% and show less results.', 'pointfindercoreelements').'<br/>'.
					esc_html__('If options "Mixed" option selected: System will use (%my% and %word%) or (%my word%)  and show less results.', 'pointfindercoreelements'),
				) ,
				array(
					'id' => 'system_cb_setup',
					'type' => 'button_set',
					'title' => esc_html__('System Checkbox Search Setup', 'pointfindercoreelements') ,

					'options' => array(
						'1' => esc_html__('By using OR operator', 'pointfindercoreelements') ,
						'2' => esc_html__('By using AND operator', 'pointfindercoreelements'),
						'3' => esc_html__('By using IN operator', 'pointfindercoreelements')
					) ,
					'default' => '3'
				) ,

				array(
                    'id'        => 'setup4_membersettings_dateformat',
                    'type'      => 'select',
                    'title'     => esc_html__('Date field: Date Format', 'pointfindercoreelements'),
                    'options'   => array(
                        '1' => 'dd/mm/yyyy',
                        '2' => 'mm/dd/yyyy',
                        '3' => 'yyyy/mm/dd',
                        '4' => 'yyyy/dd/mm'
                    ),
                    'default'   => '1'
            	),
			) ,
	);


	/**
	*Custom Detail Fields
	**/
	$sections[] = array(
		'id' => 'setup1',
		'title' => 'Custom Detail Fields',
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'stp_hlp10',
				'type' => 'info',
				'notice' => true,
				'style' => 'critical',
				'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements'),
				'desc' => esc_html__('Please configure this section before you use the theme. If you change the configuration after using the theme, data that is related to these sections will be lost.', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'setup1_slides',
				'type' => 'extension_custom_slides',
				'title' => esc_html__('Custom Fields', 'pointfindercoreelements') ,
				'placeholder' => array(
					'title' => esc_html__('Write a field name like Bedroom', 'pointfindercoreelements') ,
					'select' => esc_html__('Select Field Type', 'pointfindercoreelements') ,
					'url' => esc_html__('Slug: unique name. Leave blank for auto assign.', 'pointfindercoreelements') ,
				) ,
				'options' => array(
					"1" => esc_html__("Text","pointfindercoreelements"),
					"2" => esc_html__("URL","pointfindercoreelements"),
					"3" => esc_html__("Email","pointfindercoreelements"),
					"4" => esc_html__("Number","pointfindercoreelements"),
					"5" => esc_html__("Textarea","pointfindercoreelements"),
					"9" => esc_html__("Checkbox","pointfindercoreelements"),
					"7" => esc_html__("Radio Button","pointfindercoreelements"),
					"8" => esc_html__("Select Box","pointfindercoreelements"),
					"14" => esc_html__("Select Box(Multiple)","pointfindercoreelements"),
					"15" => esc_html__("Date","pointfindercoreelements"),
				) ,

			) ,
		)
	);



	/**
	*Search Fields
	**/
	$sections[] = array(
		'id' => 'setup1s',
		'title' => esc_html__('Search Fields', 'pointfindercoreelements'),
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'stp_hlp13',
				'type' => 'info',
				'notice' => true,
				'style' => 'critical',
				'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements'),
				'desc' => esc_html__('Please configure this section before you use the theme. If you change the configuration after using the theme, data that is related to these sections will be lost.', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'setup1s_slides',
				'type' => 'extension_custom_slides',
				'title' => esc_html__('Custom Search Fields', 'pointfindercoreelements') ,
				'placeholder' => array(
					'title' => esc_html__('Write a search field name like Price', 'pointfindercoreelements') ,
					'select' => esc_html__('Select Field Type', 'pointfindercoreelements') ,
					'url' => esc_html__('Slug: unique name. Leave blank for auto assign.', 'pointfindercoreelements') ,
				) ,
				'options' => array(
					"1" => esc_html__("Select Box (Dropdown)","pointfindercoreelements"),
					"2" => esc_html__("Slider","pointfindercoreelements"),
					"4" => esc_html__("Text Field","pointfindercoreelements"),
					"5" => esc_html__("Date","pointfindercoreelements"),
					"6" => esc_html__("Checkbox","pointfindercoreelements"),
					"7" => esc_html__("Numeric Text (Spinner)","pointfindercoreelements")
				)
			) ,
		)
	);


	/**
	*Post types Setup
	**/
	$sections[] = array(
		'id' => 'setup3_pointposttype',
		'title' => esc_html__('Post Type Setup', 'pointfindercoreelements') ,
		'subsection' => true,
		'fields' => array(

			array(
				'id' => 'stp_hlp16',
				'type' => 'info',
				'notice' => true,
				'style' => 'critical',
				'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements'),
				'desc' => esc_html__('Please configure this section before you use the theme. If you change the configuration after using the theme, data that is related to these sections will be lost.', 'pointfindercoreelements').'<br/ >'.esc_html__('You may need to flush the rewrite rules after changing this. You can do it manually by going to the Permalink Settings page and re-saving the rules', 'pointfindercoreelements').'<br/ ><strong>'.esc_html__('Please use small caps on "Post Type Name & Category x Pretty Name','pointfindercoreelements').'</strong>'.'<br/ ><strong>'.esc_html__('Please use don\'t use "type" or "category" word as "Post Type Name" or "Category x Pretty Name','pointfindercoreelements').'</strong>'
			) ,
			array(
			    'id'        => 'accb30',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Item Post Type', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt1',
					'type' => 'text',
					'title' => esc_html__('Post Type Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " pfitemfinder ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('Please do not change after adding any map point. Otherwise your existing Points in the system might be lost.', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('Must be only text or numbers, no spaces and special chars & please use small caps!!', 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'pfitemfinder'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt2',
					'type' => 'text',
					'title' => esc_html__('Singular Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:','pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing agents.', 'pointfindercoreelements') ,
					'default' => 'PF Item'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt3',
					'type' => 'text',
					'title' => esc_html__('Plural Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:','pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing agents.', 'pointfindercoreelements') ,
					'default' => 'PF Items'
				) ,
			array(
			    'id'        => 'acce30',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb31',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Category 1 Options', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt7',
					'type' => 'text',
					'title' => esc_html__('Category Plural Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Listing Types ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Listing Types'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt7s',
					'type' => 'text',
					'title' => esc_html__('Category Single Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Listing Type ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Listing Type'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt7p',
					'type' => 'text',
					'title' => esc_html__('Category Pretty Name', 'pointfindercoreelements') ,
					'desc' => esc_html__("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy (taxonomy's name slug) & please use small caps!!", 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'listings'
				) ,
				array(
					'id' => 'stp4_forceu_cs',
					'type' => 'button_set',
					'title' => esc_html__('Force users to select sub category', 'pointfindercoreelements') ,
					'desc' => esc_html__('This option will work with search field selection and force users to select sub level category.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0

				),
			array(
			    'id'        => 'acce31',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb32',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Category 2 Options', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt4',
					'type' => 'text',
					'title' => esc_html__('Category Plural Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', "Item Types ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Item Types'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt4s',
					'type' => 'text',
					'title' => esc_html__('Category Single Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Item Type").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Item Type'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt4p',
					'type' => 'text',
					'title' => esc_html__('Category Pretty Name', 'pointfindercoreelements') ,
					'desc' => esc_html__("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy (taxonomy's name slug) & please use small caps!!", 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'types'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt4_check',
					'type' => 'button_set',
					'title' => esc_html__('Category Status', 'pointfindercoreelements') ,
					"default" => '1',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,

				) ,
			array(
			    'id'        => 'acce32',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb33',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Category 3 Options', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt5',
					'type' => 'text',
					'title' => esc_html__('Category Plural Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Locations ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Locations'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt5s',
					'type' => 'text',
					'title' => esc_html__('Category Single Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Location ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Location'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt5p',
					'type' => 'text',
					'title' => esc_html__('Category Pretty Name', 'pointfindercoreelements') ,
					'desc' => esc_html__("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy (taxonomy's name slug) & please use small caps!!", 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'area'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt5_check',
					'type' => 'button_set',
					'title' => esc_html__('Category Status', 'pointfindercoreelements') ,
					"default" => '1',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,

				) ,
			array(
			    'id'        => 'acce33',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb34',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Category 4 Options', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt6',
					'type' => 'text',
					'title' => esc_html__('Category Plural Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Features ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Features'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt6s',
					'type' => 'text',
					'title' => esc_html__('Category Single Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Feature ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Feature'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt6p',
					'type' => 'text',
					'title' => esc_html__('Category Pretty Name', 'pointfindercoreelements') ,
					'desc' => esc_html__("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy (taxonomy's name slug) & please use small caps!!", 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'feature'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt6_check',
					'type' => 'button_set',
					'title' => esc_html__('Category Status', 'pointfindercoreelements') ,
					"default" => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,

				) ,
			array(
			    'id'        => 'acce34',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb35',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Category 5 Options', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pt14',
					'type' => 'text',
					'title' => esc_html__('Category Plural Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Conditions ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Conditions'
				) ,
				array(
					'id' => 'setup3_pt14s',
					'type' => 'text',
					'title' => esc_html__('Category Single Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " Condition ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'Condition'
				) ,
				array(
					'id' => 'setup3_pt14p',
					'type' => 'text',
					'title' => esc_html__('Category Pretty Name', 'pointfindercoreelements') ,
					'desc' => esc_html__("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy (taxonomy's name slug) & please use small caps!!", 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'condition'
				) ,
				array(
					'id' => 'setup3_pt14_check',
					'type' => 'button_set',
					'title' => esc_html__('Category Status', 'pointfindercoreelements') ,
					"default" => 1,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,

				) ,
			array(
			    'id'        => 'acce35',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb36',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Agents Post Type', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt6_status',
					'type' => 'button_set',
					'title' => esc_html__('Post Type Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 1
				) ,
				array(
					'id' => 'setup3_pointposttype_pt8',
					'type' => 'text',
					'title' => esc_html__('Post Type Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " agents ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('Please do not change after adding any map point. Otherwise your existing "Points" in the system might be lost.', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('Must be only text or numbers, no spaces and special chars & please use small caps!!', 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'agents'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt9',
					'type' => 'text',
					'title' => esc_html__('Singular Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:', 'pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'PF Agent'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt10',
					'type' => 'text',
					'title' => esc_html__('Plural Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:', 'pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing points.', 'pointfindercoreelements') ,
					'default' => 'PF Agents'
				) ,
			array(
			    'id'        => 'acce36',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb37',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Testimonials Post Type', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup3_pointposttype_pt11',
					'type' => 'text',
					'title' => esc_html__('Post Type Name', 'pointfindercoreelements') ,
					'desc' => sprintf('<strong>'.esc_html__('Existing name: %s','pointfindercoreelements').'</strong>', " pftestimonials ").'<br/><strong> '.esc_html__('Important :','pointfindercoreelements').' </strong>'.esc_html__('Please do not change after adding any map point. Otherwise your existing "Testimonials" in the system might be lost.', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('Must be only text or numbers, no spaces and special chars & please use small caps!!.', 'pointfindercoreelements') ,
					'validate' => 'no_special_chars',
					'default' => 'pftestimonials'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt13',
					'type' => 'text',
					'title' => esc_html__('Singular Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:', 'pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing testimonials.', 'pointfindercoreelements') ,
					'default' => 'Testimonial'
				) ,
				array(
					'id' => 'setup3_pointposttype_pt12',
					'type' => 'text',
					'title' => esc_html__('Plural Name', 'pointfindercoreelements') ,
					'desc' => '<strong>'.esc_html__('Important:', 'pointfindercoreelements').'</strong>'.esc_html__('This change will not affect your existing testimonials.', 'pointfindercoreelements') ,
					'default' => 'PF Testimonials'
				) ,
			array(
			    'id'        => 'acce37',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
		)
	);



	/**
	*Connections Setup
	**/
	$sections[] = array(
		'id' => 'stp_syncs',
		'title' => esc_html__('Listing Type Connections', 'pointfindercoreelements') ,
		'subsection' => true,
		'fields' => array(

			array(
				'id' => 'stp_hlplt1',
				'type' => 'info',
				'notice' => true,
				'style' => 'warning',
				'title' => esc_html__('INFORMATION', 'pointfindercoreelements'),
				'desc' => esc_html__("You can manage the connection between Listing Types and other taxonomies by using the below settings. If you can't find your taxonomy setting below, please check Post Type Setup from the left menu.",'pointfindercoreelements').'<br/>'.esc_html__("If this selection is enabled, the system will hide all taxonomy elements until Listing Type select, which is connected with this taxonomy element.","pointfindercoreelements"),

			) ,
			array(
				'id' => 'section-stp_syncs1-start',
				'type' => 'section',
				'title' => esc_html__('Connection between Listing Type and Features Taxonomy', 'pointfindercoreelements') ,
				'indent' => true,
				'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
			) ,
				array(
					'id' => 'setup4_sbf_c1',
					'type' => 'button_set',
					'title' => esc_html__('Features Taxonomy Connection Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Disable Connection', 'pointfindercoreelements') ,
						'0' => esc_html__('Enable Connection', 'pointfindercoreelements')
					) ,

					'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
					'default' => 1

				) ,
			array(
				'id' => 'section-stp_syncs1-end',
				'type' => 'section',
				'indent' => false,
				'required'	=> array('setup3_pointposttype_pt6_check','=','1'),
			),


			array(
				'id' => 'section-stp_syncs2-start',
				'type' => 'section',
				'title' => esc_html__('Connection between Listing Type and Item Types Taxonomy', 'pointfindercoreelements') ,
				'indent' => true,
				'required'	=> array('setup3_pointposttype_pt4_check','=','1'),
			) ,
				array(
					'id' => 'stp_syncs_it',
					'type' => 'button_set',
					'title' => esc_html__('Item Types Taxonomy Connection Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Disable Connection', 'pointfindercoreelements') ,
						'0' => esc_html__('Enable Connection', 'pointfindercoreelements')
					) ,
					'required'	=> array('setup3_pointposttype_pt4_check','=','1'),
					'default' => 1

				) ,
			array(
				'id' => 'section-stp_syncs2-end',
				'type' => 'section',
				'indent' => false,
				'required'	=> array('setup3_pointposttype_pt4_check','=','1'),
			),



			array(
				'id' => 'section-stp_syncs3-start',
				'type' => 'section',
				'title' => esc_html__('Connection between Listing Type and Conditions Taxonomy', 'pointfindercoreelements') ,
				'indent' => true,
				'required'	=> array('setup3_pt14_check','=','1'),
			) ,
				array(
					'id' => 'stp_syncs_co',
					'type' => 'button_set',
					'title' => esc_html__('Conditions Taxonomy Connection Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Disable Connection', 'pointfindercoreelements') ,
						'0' => esc_html__('Enable Connection', 'pointfindercoreelements')
					) ,
					'required'	=> array('setup3_pt14_check','=','1'),
					'default' => 1

				) ,
			array(
				'id' => 'section-stp_syncs3-end',
				'type' => 'section',
				'indent' => false,
				'required'	=> array('setup3_pt14_check','=','1'),
			)
		)
	);

/**
*End: SYSTEM SETUP
**/



/**
*START: Favorites SYSTEM
**/
$sections[] = array(
	'id' => 'setup41_favsystem',
	'title' => esc_html__('Favorites System', 'pointfindercoreelements') ,
	'icon' => 'el-icon-star',
	'fields' => array(
		array(
			'id' => 'stp_hlp17',
			'type' => 'info',
			'notice' => true,
			'style' => 'warning',
			'desc' => esc_html__('Activation & Deactivation will not cause any data loss.', 'pointfindercoreelements')
		) ,
		array(
			'id' => 'setup4_membersettings_favorites',
			'type' => 'button_set',
			'title' => esc_html__('Status', 'pointfindercoreelements') ,
			'options' => array(
				'1' => esc_html__('Enable', 'pointfindercoreelements') ,
				'0' => esc_html__('Disable', 'pointfindercoreelements')
			) ,
			'default' => '1',
		) ,
		array(
			'id' => 'setup41_favsystem_linkcolor',
			'type' => 'link_color',
			'title' => esc_html__('Heart Icon Color', 'pointfindercoreelements') ,
			'compiler' => array(
				'.pflist-imagecontainer .RibbonCTR .Sign i',
				'.wpfimage-wrapper .RibbonCTR .Sign i',
				'.anemptystylesheet'
			) ,
			'active' => false,
			'default' => array(
				'regular' => '#000000',
				'hover' => '#B32E2E'
			),
			'required' => array('setup4_membersettings_favorites','=','1')
		) ,
		array(
			'id' => 'setup41_favsystem_bgcolor',
			'type' => 'color',
			'transparent' => false,
			'compiler' => true,
			'title' => esc_html__('Heart Icon Background', 'pointfindercoreelements') ,
			'default' => '#fff',
			'required' => array('setup4_membersettings_favorites','=','1')
		) ,

	)
);
/**
*END: Favorites SYSTEM
**/






/**
*Start : MAP SETTINS
**/
	$sections[] = array(
		'id' => 'setup5_mapsettings',
		'title' => esc_html__('Map Settings', 'pointfindercoreelements') ,
		'icon' => 'el-icon-globe',
		'fields' => array(
			array(
			    'id'        => 'accb24',
			    'type'      => 'accordion',
			    'title'     => esc_html__('General Settings', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup42_searchpagemap_lat',
					'type' => 'text',
					'title' => esc_html__('Default Latitude', 'pointfindercoreelements') ,
					'desc' => sprintf(esc_html__('This coordinate for auto center on that point. %s Please click here for finding your coordinates', 'pointfindercoreelements'),'<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">','</a>') ,
					'default' => '40.712784'
				) ,
				array(
					'id' => 'setup42_searchpagemap_lng',
					'type' => 'text',
					'title' => esc_html__('Default Longitude', 'pointfindercoreelements') ,
					'desc' => sprintf(esc_html__('This coordinate for auto center on that point. %s Please click here for finding your coordinates', 'pointfindercoreelements'),'<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">','</a>') ,
					'default' => '-74.005941'
				) ,
				array(
					'id' => 'setup42_searchpagemap_zoom',
					'type' => 'spinner',
					'title' => esc_html__('Desktop View Zoom', 'pointfindercoreelements') ,
					"default" => "12",
					"min" => "6",
					"step" => "1",
					"max" => "19"
				) ,
				array(
					'id' => 'setup42_searchpagemap_mobile',
					'type' => 'spinner',
					'title' => esc_html__('Mobile View Zoom', 'pointfindercoreelements') ,
					"default" => "10",
					"min" => "6",
					"step" => "1",
					"max" => "19"
				) ,
				array(
                    'id' => 'as_mobile_zoom',
                    'type' => 'button_set',
                    'title' => esc_html__('Mobile Zoom', 'pointfindercoreelements') ,
                    'desc' => esc_html__('If this setting enabled, system will enable zoom on mobile view. Important: Gesture Handling must be disabled to work with this option.', 'pointfindercoreelements') ,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements'),
                    ) ,
                    'default' => '0',
                ) ,
				array(
					'id' => 'gesturehandling',
					'title' => esc_html__('Gesture Handling', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'options' => array(
						1 => esc_html__('Enable', 'pointfindercoreelements'),
						0 => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 1
				) ,
				array(
					'id' => 'poihandle',
					'title' => esc_html__('Point of Interests (Google)', 'pointfindercoreelements') ,
					'type' => 'button_set',
					'options' => array(
						1 => esc_html__('Enable', 'pointfindercoreelements'),
						0 => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => 0
				) ,
			array(
			    'id'        => 'acce24',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb23',
			    'type'      => 'accordion',
			    'title'     => esc_html__('Map Service Provider Settings', 'pointfindercoreelements'),
			    'open' 		=> true,
			    'position'  => 'start',
			),

	            array(
					'id' => 'stp5_mapty',
					'title' => esc_html__('System Map Type', 'pointfindercoreelements') ,
					'type' => 'select',
					'options' => array(
						1 => esc_html__('Google Maps', 'pointfindercoreelements'),
						2 => esc_html__('Open Street Maps', 'pointfindercoreelements'),
						3 => esc_html__('Mapbox', 'pointfindercoreelements'),
						4 => esc_html__('Yandex Maps', 'pointfindercoreelements'),
	                    5 => esc_html__('Here Maps', 'pointfindercoreelements'),
	                    6 => esc_html__('Bing Maps', 'pointfindercoreelements')
					) ,
					'default' => 1
				) ,
				array(
	                'id'       => 'setup5_mapsettings_maplanguage',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Map Language', 'pointfindercoreelements' ),
	                'desc'     => esc_html__( 'You can change google map language.', 'pointfindercoreelements' ),
	                'options'  => $googlemaplangs,
	                'default'  => 'en'
	            ),
	            array(
	                'id'       => 'heremapslang',
	                'type'     => 'select',
	                'title'    => esc_html__( 'HERE Maps Language', 'pointfindercoreelements' ),
	                'desc'     => esc_html__( 'You can change google map language.', 'pointfindercoreelements' ),
	                'options'  => $heremapslang,
	                'default'  => 'eng',
	                'required' => array('stp5_mapty','=','5')
	            ),
				array(
	                'id'       => 'wemap_langy',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Yandex Map Language', 'pointfindercoreelements' ),
	                'desc'    => esc_html__( 'Supported languages listed.', 'pointfindercoreelements' ),
	                'options'  => array(
	                	"tr_TR" => "Turkish (only for maps of Turkey)",
	                	"en_RU" => "response in English, Russian map features",
	                	"en_US" => "response in English, American map features",
	                	"ru_RU" => "Russian (default)",
	                	"uk_UA" => "Ukrainian",
	                	"be_BY" => "Belarusian",
	                ),
	                'default'  => 'ru_RU',
	                'required' => array('stp5_mapty','=','4')
	               
	            ),
				
				array(
					'id' => 'setup5_map_key',
					'title' => esc_html__('Google Map API Key (HTTP Restiricted)', 'pointfindercoreelements') ,
					'type' => 'text',
					'desc' => "For API Usage Limits : <a href=\"https://cloud.google.com/maps-platform/pricing/sheet/\" target=\"_blank\">https://cloud.google.com/maps-platform/pricing/sheet/</a><br>For API HELP : <a href=\"https://pointfinderdocs.wethemes.com/knowledgebase/how-to-create-google-map-api-key/\" target=\"_blank\">How to create google map api key?</a><br>For Sample : <a href=\"https://pointfinderdocs.wethemes.com/knowledgebase/how-to-create-an-http-restricted-api-key-on-google/\" target=\"_blank\">How to create an HTTP restricted API key on Google?</a>",
					'subtitle' => esc_html__('This is for frontend and backend Google Maps API & Streetview API functions.', 'pointfindercoreelements') ,
				) ,
				array(
					'id' => 'stp5_osmsrv',
					'title' => esc_html__('Open Street Maps Server', 'pointfindercoreelements') ,
					'type' => 'text',
					'subtitle' => esc_html__("Please do not change this if you don't know OSM Server system.", 'pointfindercoreelements') ,
					'required' => array('stp5_mapty', '=','2'),
					'default' => "https://tile.openstreetmap.org"
				) ,
				array(
					'id' => 'stp5_mapboxpt',
					'title' => esc_html__('Mapbox Public Token', 'pointfindercoreelements') ,
					'type' => 'text',
					'subtitle' => esc_html__('Please add mapbox public token if want to use mapbox on your map system.', 'pointfindercoreelements') ,
					'desc' => esc_html__('Required', 'pointfindercoreelements') ,
					'required' => array('stp5_mapty', '=','3')
				) ,

				array(
	                'id'        => 'wemap_yandexmap_api_key',
	                'type'      => 'text',
	                'title'     => esc_html__( 'Yandex Map API Key', 'pointfindercoreelements' ),
	                'desc'  => esc_html__( 'Please add this key if you using one of these services; Yandex Geolocation or Map Service', 'pointfindercoreelements' ),
	                'required'  => array('stp5_mapty','=','4')
	            ),
	            array(
	                'id'        => 'wemap_bingmap_api_key',
	                'type'      => 'text',
	                'title'     => esc_html__( 'Bing Map API Key', 'pointfindercoreelements' ),
	                'desc'  => esc_html__( 'Please add this key if you using one of these services; Bing Map Service', 'pointfindercoreelements' ),
	                'required'  => array('stp5_mapty','=','6')
	            ),
	            array(
	                'id'        => 'wemap_here_appid',
	                'type'      => 'text',
	                'title'     => esc_html__( 'HERE Map JS App ID', 'pointfindercoreelements' ),
	                'desc'  	=> wp_sprintf(esc_html__( 'This information required while using HERE Maps API. Please check %sthis page%s for create API key.', 'pointfindercoreelements' ),
	                	'<a href="https://developer.here.com/documentation" target="_blank">','</a>'
	            	),
	                'required'  => array('stp5_mapty','=','5'),
	            ),
	            array(
	                'id'        => 'wemap_here_appcode',
	                'type'      => 'text',
	                'title'     => esc_html__( 'HERE Map JS Api Key', 'pointfindercoreelements' ),
	                'desc'  	=> wp_sprintf(esc_html__( 'This information required while using HERE Maps API. Please check %sthis page%s for create API key.', 'pointfindercoreelements' ),
	                	'<a href="https://developer.here.com/documentation" target="_blank">','</a>'
	            	),
	                'required'  => array('stp5_mapty','=','5'),
	            ),
		 	array(
			    'id'        => 'acce23',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb25',
			    'type'      => 'accordion',
			    'title'    => esc_html__( 'Geocoding Service Provider Settings', 'pointfindercoreelements' ),
			    'open' 		=> true,
			    'position'  => 'start',
			),
            
	            array(
	                'id'       => 'wemap_geoctype',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Geocoding Service', 'pointfindercoreelements' ),
	                'options'  => array(
	                	'google' => 'Google',
	                    'mapbox' => 'Mapbox',
	                    'yandex' => 'Yandex',
	                    'nominatim' => 'Nominatim',
	                    'photon' => 'Photon',
	                    'here' => 'HERE Geocoder',
	                    'arcgis' => 'ArcGis',
	                    'opencage' => 'OpenCage'
	                ),
	                'desc'  => wp_sprintf(esc_html__( "PointFinder using 3rd party geocoding services provided from; %sHere Maps%s, %sMapbox%s, Google Maps, Yandex Maps, %sArcGis Maps%s, %sNominatim%s and %sPhoton%s. We are always recommend you to use Google Geocoding service for better results.", 'pointfindercoreelements' ),
	                	'<a href="https://developer.here.com/documentation" target="_blank">','</a>',
	                	'<a href="https://docs.mapbox.com/" target="_blank">','</a>',
	                	'<a href="https://developers.arcgis.com" target="_blank">','</a>',
	                	'<a href="https://nominatim.openstreetmap.org/" target="_blank">','</a>',
	                	'<a href="https://photon.komoot.de/" target="_blank">','</a>'
	                ),
	                'default'  => 'google'
	            ),
	            array(
	                'id'        => 'googlelvl1',
	                'type'      => 'text',
	                'title'     => esc_html__( 'State Default Distance', 'pointfindercoreelements' ),
	                'desc'  	=> esc_html__( 'Default distance for states.', 'pointfindercoreelements'),
	                'default'  => '1000',
	                'required'  => array('wemap_geoctype','=','google'),
	            ),
	            array(
	                'id'        => 'googlelvl2',
	                'type'      => 'text',
	                'title'     => esc_html__( 'County Default Distance', 'pointfindercoreelements' ),
	                'desc'  	=> esc_html__( 'Default distance for counties.', 'pointfindercoreelements'),
	                'default'  => '500',
	                'required'  => array('wemap_geoctype','=','google'),
	            ),
	            array(
	                'id'        => 'googlelvl3',
	                'type'      => 'text',
	                'title'     => esc_html__( 'City Default Distance', 'pointfindercoreelements' ),
	                'desc'  	=> esc_html__( 'Default distance for cities.', 'pointfindercoreelements'),
	                'default'  => '100',
	                'required'  => array('wemap_geoctype','=','google'),
	            ),
	            array(
	                'id'       => 'setup5_typs',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Google Autocomplete Result Type', 'pointfindercoreelements' ),
	                'desc'    => wp_sprintf(esc_html__( 'Please check %sthis page%s to learn more information.', 'pointfindercoreelements' ),'<a href="https://developers.google.com/places/web-service/autocomplete#place_types" target="_blank">','</a>'),
	                'options'  => array(
	                	"address" => esc_html__("Autocomplete: return only address results.","pointfindercoreelements"),
	                	"geocode" => esc_html__("Autocomplete: return only geocoding results.","pointfindercoreelements"),
	                	"establishment" => esc_html__("Autocomplete: return only business results.","pointfindercoreelements"),
	                	"locality" => esc_html__("Autocomplete: return only locality results.","pointfindercoreelements"),
	                	"sublocality" => esc_html__("Autocomplete: return only sublocality results.","pointfindercoreelements"),
	                	"postal_code" => esc_html__("Autocomplete: return postal code results.","pointfindercoreelements"),
	                	"country" => esc_html__("Autocomplete: return country results.","pointfindercoreelements"),
	                	"administrative_area_level_1" => esc_html__("Autocomplete: return administrative_area_level_1 results.","pointfindercoreelements"),
	                	"administrative_area_level_2" => esc_html__("Autocomplete: return administrative_area_level_2 results.","pointfindercoreelements"),
	                	"administrative_area_level_3" => esc_html__("Autocomplete: return administrative_area_level_3 results.","pointfindercoreelements"),
	                ),
	                'default'  => 'geocode',
	                'required' => array('wemap_geoctype','=','google')
	               
	            ),
	            array(
	                'id'        => 'wemap_opencagekey',
	                'type'      => 'text',
	                'title'     => esc_html__( 'OpenCage Geocode API Key', 'pointfindercoreelements' ),
	                'desc'  => esc_html__( 'Please add this key if you using one of these services; OpenCage Geocode', 'pointfindercoreelements' ),
	                'required' => array('wemap_geoctype','=','opencage')
	            ),
	            array(
	                'id'       => 'wemap_country',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Map Service Country Limit', 'pointfindercoreelements' ),
	                'options'  => $country2,
	                'required' => array('wemap_geoctype','=',array('nominatim','mapbox','google','opencage'))
	            ),
	            array(
	                'id'       => 'wemap_country3',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Map Service Country Limit', 'pointfindercoreelements' ),
	                'options'  => $country3,
	                'required' => array('wemap_geoctype','=','here')
	            ),
	            
	        array(
			    'id'        => 'acce25',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			),

	);


	/**
	*Map Notifications
	**/
	$sections[] = array(
		'id' => 'setup15_mapnotifications',
		'title' => esc_html__('Notifications', 'pointfindercoreelements') ,
		'subsection' => true,
        'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Map Notifications: This notification will create a toggle window on the top of the map and show number of found items after search and site entrance.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_formapnotify.png" class="description-img" />'),
		'fields' => array(

			array(
				'id' => 'setup15_mapnotifications_notbg',
				'type' => 'color_rgba',
				'title' => esc_html__('Notification Content Background', 'pointfindercoreelements') ,
				'default' => array(
					'color' => '#FFFFFF',
					'alpha' => '1'
				) ,
				'compiler' => array(
					'.pfnotificationwindow'
				) ,
				'mode' => 'background',
				'validate' => 'colorrgba',
				'transparent' => false,
			) ,
			array(
                'id'        => 'setup15_mapnotifications_notbg_border',
                'type'      => 'border',
                'title'     => esc_html__('Notification Content Border Color', 'pointfindercoreelements'),
                'compiler'    => array('.pfnotificationwindow'),
                'all' => true,
                'right'  => true,
                'top'  => true,
                'left'  => true,
                'style' => true,
                'bottom' => true,
                'color' => true,
                'default'   => array(
                    'border-color'  => '#e0e0e0',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),

			array(
				'id' => 'setup15_mapnotifications_nottext_typo',
				'type' => 'typography',
				'title' => esc_html__('Notification Content Text Typography', 'pointfindercoreelements') ,
				'google' => true,
				'font-backup' => false,
				'compiler' => array(
					'.pfnotificationwindow',
					'.pfnotificationwindow a',
					'.pfnot-err-button'
				) ,
				'units' => 'px',
				'default' => array(
					'color' => '#2978a5',
					'font-weight' => '400',
					'font-family' => 'Roboto',
					'google' => true,
					'font-size' => '12px',
					'line-height' => '16px',
				) ,
			) ,
			array(
					'id' => 'setup15_mapnotifications_searcherrorclosebg_ex',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'.pfnot-err-button',
						'.pfnotificationwindow'
					) ,
					'title' => esc_html__('Notification Indicator Background', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#2978a5',
						'hover' => '#2963a5'
					) ,
					'validate' => 'color',

				) ,
			 
			array(
				'id' => 'stp_hlp18',
				'type' => 'info',
				'notice' => true,
				'style' => 'info',
				'desc' => '<strong>'.esc_html__('Info:', 'pointfindercoreelements').'</strong>'.esc_html__('Below settings will affect "Not Found" error notification.', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'setup15_mapnotifications_autoplay_e',
				'type' => 'switch',
				'title' => esc_html__('Notification Mode', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => esc_html__('If you choose Auto option, You should arrange a time range below.', 'pointfindercoreelements')
				) ,
				'default' => 1,
				'on' => esc_html__('Auto', 'pointfindercoreelements') ,
				'off' => esc_html__('Manual', 'pointfindercoreelements') ,
			) ,
			array(
				'id' => 'setup15_mapnotifications_autoclosetime_e',
				'required' => array('setup15_mapnotifications_autoplay_e',"=",1),
				'type' => 'spinner',
				'title' => esc_html__('Auto Close Duration', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => esc_html__('1000 milisec = 1 sec.', 'pointfindercoreelements')
				) ,
				'default' => '5000',
				'min' => '1000',
				'step' => '1000',
				'max' => '20000',
			) ,
			
			array(
				'id' => 'stp_hlp19',
				'type' => 'info',
				'notice' => true,
				'style' => 'info',
				'desc' => '<strong>'.esc_html__('Info:', 'pointfindercoreelements').'</strong>'.esc_html__('Below settings will affect "Listings Found" info notification.', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'setup15_mapnotifications_dontshow_i',
				'type' => 'switch',
				'title' => esc_html__('On Site Entrance', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => esc_html__('Show/Hide listings found notification on site entrance.', 'pointfindercoreelements')
				) ,
				'default' => '0',
				'on' => esc_html__('Hide', 'pointfindercoreelements') ,
				'off' => esc_html__('Show', 'pointfindercoreelements') ,
			) ,
			array(
				'id' => 'setup15_mapnotifications_autoplay_i',
				'type' => 'switch',
				'title' => esc_html__('Notification Mode', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => esc_html__('If you choose Auto option, You should arrange a time range below.', 'pointfindercoreelements')
				) ,
				'default' => 1,
				'on' => esc_html__('Auto', 'pointfindercoreelements') ,
				'off' => esc_html__('Manual', 'pointfindercoreelements') ,
			) ,
			array(
				'id' => 'setup15_mapnotifications_autoclosetime_i',
				'required' => array('setup15_mapnotifications_autoplay_i',"=",1) ,
				'type' => 'spinner',
				'title' => esc_html__('Auto Close Duration', 'pointfindercoreelements') ,
				'hint' => array(
					'content' => esc_html__('1000 milisec = 1 sec.', 'pointfindercoreelements')
				) ,
				'default' => '5000',
				'min' => '1000',
				'step' => '1000',
				'max' => '20000',
			)
		)
	);

	/**
	*Map Control Settings
	**/
	$sections[] = array(
		'id' => 'setup13_mapcontrols',
		'title' => esc_html__('Control Buttons', 'pointfindercoreelements') ,
		'subsection' => true,
		'heading'   => esc_html__('Map Control Buttons', 'pointfindercoreelements'),
        'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Below settings will affect map zoom, geolocate, home button controls.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_formapcontrols.png" class="description-img" />'),
		'fields' => array(

			array(
				'id' => 'setup13_mapcontrols_position',
				'title' => esc_html__('Position of Map Buttons', 'pointfindercoreelements') ,
				'type' => 'button_set',
				'options' => array(
					1 => esc_html__('Left', 'pointfindercoreelements'),
					0 => esc_html__('Right', 'pointfindercoreelements')
				) ,
				'default' => 0
			) ,
			
			array(
				'id' => 'setup13_mapcontrols_barbackground',
				'type' => 'color',
				'title' => esc_html__('Button Background', 'pointfindercoreelements') ,
				'default' => '#28353d',
				'mode' => 'background',
				'validate' => 'color',
				'transparent' => false,
				'compiler' => true

			) ,
			array(
				'id' => 'setup13_mapcontrols_barhoverbackground',
				'type' => 'color',
				'title' => esc_html__('Button Hover', 'pointfindercoreelements') ,
				'default' => '#3c4e5a',
				'mode' => 'background',
				'validate' => 'color',
				'transparent' => false,
				'compiler' => true

			) ,
			array(
				'id' => 'setup13_mapcontrols_barhovercolor',
				'type' => 'color',
				'title' => esc_html__('Icon Color', 'pointfindercoreelements') ,
				'default' => '#ffffff',
				'validate' => 'color',
				'transparent' => false,
				'compiler' => array('.leaflet-control-layers label')
			) ,
		)
	);


	/**
	*Search Window
	**/
	$sections[] = array(
		'id' => 'setup12_searchwindowpf',
		'title' => esc_html__('Search Window', 'pointfindercoreelements') ,
		'heading'   => esc_html__('Draggable Search Tab Window Settings', 'pointfindercoreelements'),
        'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Below settings will affect draggable search tab window on the map.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_formapsearch.png" class="description-img" />'),
        'subsection' => true,
		'fields' => array(
			array(
                'id' => 'as_hormode_close',
                'type' => 'button_set',
                'title' => esc_html__('Map Search: Horizontal Mode Close', 'pointfindercoreelements') ,
                'desc' => esc_html__('If this setting enabled, horizontal map search window will be closed at start.', 'pointfindercoreelements') ,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements'),
                ) ,
                'default' => '0',
            ) ,
			array(
				'id' => 'setup5_mapsettings_mapautoopen',
				'title' => esc_html__('Auto Open Search Results', 'pointfindercoreelements') ,
				'type' => 'button_set',
				'options' => array(
					1 => esc_html__('Enable', 'pointfindercoreelements'),
					0 => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => 0
			) ,
			array(
				'id' => 'setup12_searchwindow_buttonconfig1',
				'type' => 'button_set',
				'title' => '<i class="el el-icon-move"></i> ' . esc_html__('Drag Window Tab Button', 'pointfindercoreelements') ,
				'options' => array(
					1 => esc_html__('Enable', 'pointfindercoreelements'),
					0 => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => 1,
				'compiler' => true
			) ,
			array(
				'id' => 'setup12_searchwindow_buttonconfig2',
				'type' => 'button_set',
				'title' => '<i class="el el-info-circle"></i> ' . esc_html__('Map Info Tab Button', 'pointfindercoreelements') ,
				'options' => array(
					1 => esc_html__('Enable', 'pointfindercoreelements'),
					0 => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'default' => 1,
				'compiler' => true
			) ,
		
			array(
				'id' => 'setup12_searchwindow_startpositions',
				'type' => 'button_set',
				'title' => esc_html__('Start Position', 'pointfindercoreelements') ,
				'options' => array(
					1 => esc_html__('Left', 'pointfindercoreelements'),
					0 => esc_html__('Right', 'pointfindercoreelements')
				) ,
				'default' => 1
			) ,

			array(
				'id' => 'setup12_searchwindow_tooltips',
				'type' => 'button_set',
				'title' => esc_html__('Tooltips', 'pointfindercoreelements') ,
				'options' => array(
					1 => esc_html__('Enable', 'pointfindercoreelements'),
					0 => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'hint' => array(
					'content' => esc_html__('Mouseover tooltips.', 'pointfindercoreelements')
				) ,
				'default' => 1
			),
			array(
				'id' => 'setup12_searchwindow_mapinfotext',
				'type' => 'editor',
				'title' => esc_html__('MapInfo Content', 'pointfindercoreelements') ,
				'default' => esc_html__('This is map info content.', 'pointfindercoreelements'),
				'subtitle' => esc_html__('You can edit mapinfo tab content from this editor.', 'pointfindercoreelements'),
			) ,
			array(
				'id' => 'setup12_searchwindow_mapinfotypo',
				'type' => 'typography',
				'title' => esc_html__('MapInfo Typography', 'pointfindercoreelements') ,
				'google' => true,
				'color' => false,
				'font-backup' => false,
				'compiler' => array(
					'#pfsearch-draggable .pfitemlist-content'
				) ,
				'units' => 'px',
				'default' => array(
					'color' => '#fff',
					'font-weight' => '400',
					'font-family' => 'Roboto',
					'google' => true,
					'font-size' => '12px',
					'line-height' => '16px',
				) ,
			) ,
		) ,
	);


	/**
	*Search Window Styles
	**/
	$sections[] = array(
		'id' => 'setup12_searchwindowpf_1',
		'subsection' => true,
		'title' => esc_html__('Search Window Styles', 'pointfindercoreelements') ,
		'desc'      => sprintf('<p class="description descriptionpf descriptionpfimg">'.esc_html__('%s Below settings will affect the draggable search window and horizontal search window on the map.', 'pointfindercoreelements').'</p>','<img src="'.PFCOREELEMENTSURLADMIN . 'options/images/image_formapsearch.png" class="description-img" />'),
		'fields' => array(
				array(
					'id' => 'setup12_searchwindow_background',
					'type' => 'color_rgba',
					'title' => esc_html__('Content Background', 'pointfindercoreelements') ,
					'default' => array(
						'color' => '#000000',
						'alpha' => '0.5'
					) ,
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable .pfsearch-content',
						'#pfsearch-draggable.ui-draggable .pfitemlist-content',
						'#pfsearch-draggable.ui-draggable .pfmapopt-content',
						'#pfsearch-draggable.ui-draggable .pfuser-content'
					) ,
					'mode' => 'background',
					'validate' => 'colorrgba',
					'transparent' => false,
				) ,
				array(
					'id' => 'setup12_searchwindow_background_mobile',
					'type' => 'color',
					'title' => esc_html__('Content Background for Mobile', 'pointfindercoreelements') ,
					'default' => '#384b56',
					'mode' => 'background',
					'validate' => 'color',
					'compiler' => true,
					'transparent' => false,
				) ,
				array(
					'id' => 'setup12_searchwindow_context',
					'type' => 'color',
					'title' => esc_html__('Content Text Color', 'pointfindercoreelements') ,
					'default' => '#FFFFFF',
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable label',
						'#pfsearch-draggable.ui-draggable .slider-input',
						'#pfsearch-draggable.ui-draggable .pfdragcontent'
					),
					'validate' => 'color',
					'transparent' => false,

				) ,
				array(
					'id' => 'setup12_searchwindow_topbarbackground_ex',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'active' => false,
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable > .pfsearch-header ul li',
						'.wpfui-tooltip'
					) ,
					'title' => esc_html__('Top Bar Background', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#28353d',
						'hover' => '#3c4e5a'
					) ,
					'validate' => 'color',


				) ,

				array(
					'id' => 'setup12_searchwindow_topbarhovercolor',
					'type' => 'link_color',
					'title' => esc_html__('Top Bar Icon Color', 'pointfindercoreelements') ,
					'active' => false,
					'default' => array('regular'=>'#ffffff','hover'=>'#ffffff'),
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable > .pfsearch-header ul li > i',
						'.wpfui-tooltip'
					) ,
				) ,
				array(
					'id' => 'setup12_searchwindow_background_activeline',
					'type' => 'color',
					'title' => esc_html__('Top Bar Button Active Line', 'pointfindercoreelements') ,
					'default' => '#b00000',
					'mode' => 'background',
					'validate' => 'color',
					'compiler' => true,
					) ,
				array(
					'id' => 'setup12_searchwindow_sbuttonbackground1_ex',
					'type' => 'extension_custom_link_color',
					'mode' => 'background',
					'transparent' => false,
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable #pf-search-button',
						'#pfsearch-draggable.ui-draggable .pfmaptype-control .pfmaptype-control-ul .pfmaptype-control-li',
						'#pfsearch-draggable.ui-draggable .pfmaptype-control .pfmaptype-control-layers-ul .pfmaptype-control-layers-li'
					) ,
					'active' => false,
					'title' => esc_html__('Search Button Color', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#28353d',
						'hover' => '#284862',
					)
				) ,
				array(
					'id' => 'setup12_searchwindow_sbuttonbackground1_exfont',
					'type' => 'link_color',
					'transparent' => false,
					'compiler' => array(
						'#pfsearch-draggable.ui-draggable #pf-search-button',
						'#pfsearch-draggable.ui-draggable .pfmaptype-control .pfmaptype-control-ul .pfmaptype-control-li',
						'#pfsearch-draggable.ui-draggable .pfmaptype-control .pfmaptype-control-layers-ul .pfmaptype-control-layers-li'
					) ,
					'active' => false,
					'title' => esc_html__('Search Button Text Color', 'pointfindercoreelements') ,
					'default' => array(
						'regular' => '#ffffff',
						'hover' => '#FFFFFF',
					)
				) ,


		)
	);

	/**
	*Cluster Settings
	**/
	$sections[] = array(
		'id' => 'setup6_clustersettings',
		'title' => esc_html__('Cluster Settings', 'pointfindercoreelements') ,
		'subsection' => true,
        'desc'      => '<p class="description">'.esc_html__('Cluster feature will put markers into a container and show only number of total marker in this container. You can enable or disable this feature as you want.', 'pointfindercoreelements').'</p>',
		'fields' => array(
			array(
				'id' => 'setup6_clustersettings_status',
				'type' => 'button_set',
				'title' => esc_html__('Cluster Feature', 'pointfindercoreelements') ,
				'options' => array(
					1 => esc_html__('Enable', 'pointfindercoreelements'),
					0 => esc_html__('Disable', 'pointfindercoreelements')
				) ,
				'hint' => array(
					'content' => esc_html__('Cluster feature must be enabled to see cluster options.', 'pointfindercoreelements')
				),
				'default' => 1
			) ,

			array(
				'id' => 'stp6_crad',
				'type' => 'spinner',
				'required' => array('setup6_clustersettings_status','=','1') ,
				'title' => esc_html__('Radius', 'pointfindercoreelements') ,
				"default" => "100",
				"min" => "10",
				"step" => "1",
				"max" => "1000",
				'hint' => array(
					'content' => esc_html__('Cluster radius') ,
				)
			) ,
			
		)
	);

	/**
	*Geolocation Settings
	**/
	$sections[] = array(
		'id' => 'setup7_geolocation',
		'title' => esc_html__('Auto Geolocation Settings', 'pointfindercoreelements') ,
		'subsection' => true,
		'fields' => array(
			array(
				'id' => 'setup7_geolocation_status',
				'type' => 'switch',
				'title' => esc_html__('Status', 'pointfindercoreelements') ,
				"default" => 0,
				'on' => esc_html__('Enable', 'pointfindercoreelements') ,
				'off' => esc_html__('Disable', 'pointfindercoreelements') ,
				'desc' => esc_html__('If this option is enabled, visitors will see geolocation of themselves on-site entrance (Only if the PF Directory Map element exist on the home page.).', 'pointfindercoreelements')
			) ,
			
			array(
				'id' => 'setup7_geolocation_distance',
				'type' => 'spinner',
				'required' => array('setup7_geolocation_status','=','1') ,
				'title' => esc_html__('Default Distance', 'pointfindercoreelements') ,
				"default" => "10",
				"min" => "1",
				"step" => "1",
				"max" => "1000",
				'hint' => array(
					'content' => esc_html__('This is the default geolocation circle radius distance.  Default:10', 'pointfindercoreelements') ,
				)
			) ,
			array(
				'id' => 'setup7_geolocation_distance_unit',
				'type' => 'button_set',
				'required' => array('setup7_geolocation_status','=','1') ,
				'title' => esc_html__('Distance Unit', 'pointfindercoreelements') ,
				'options' => array(
					'km' => 'Km',
					'm' => 'Mile'
				) ,
				'default' => 'km',
			) ,
			array(
				'id' => 'setup7_geolocation_hideinfo',
				'type' => 'switch',
				'required' => array('setup7_geolocation_status','=','1') ,
				'title' => esc_html__('Distance Unit Info Popup', 'pointfindercoreelements') ,
				'on' => esc_html__('Enable', 'pointfindercoreelements') ,
				'off' => esc_html__('Disable', 'pointfindercoreelements') ,
				"default" => '1',
			) ,
		)
	);

/**
*End : MAP SETTINS
**/



	/**
	*Info Window Settings
	**/
	$sections[] = array(
		'id' => 'setup10_infowindow',
		'title' => esc_html__('Info Window', 'pointfindercoreelements') ,
		'heading'   => '',
		'icon' => 'el-icon-comment',
		'fields' => array(
			array(
			    'id'        => 'accb28',
			    'type'      => 'accordion',
			    'title'    => esc_html__( 'General Settings', 'pointfindercoreelements' ),
			    'open' 		=> true,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup10_infowindow_width',
					'type' => 'spinner',
					'title' => esc_html__('Window Width for Desktop', 'pointfindercoreelements') ,
					'default' => 350,
					'min' => 196,
					'step' => 1,
					'max' => 600,
					'compiler' => true,
				) ,
				array(
					'id' => 'setup10_infowindow_height',
					'type' => 'spinner',
					'title' => esc_html__('Window Height for Desktop', 'pointfindercoreelements') ,
					'default' => 136,
					'min' => 136,
					'step' => 1,
					'max' => 300,
					'compiler' => true,
				) ,
				array(
					'id' => 's10_iw_w_m',
					'type' => 'spinner',
					'title' => esc_html__('Window Width for Mobile', 'pointfindercoreelements') ,
					'default' => 184,
					'min' => 184,
					'step' => 1,
					'max' => 600,
					'compiler' => true,
				) ,
				array(
					'id' => 's10_iw_h_m',
					'type' => 'spinner',
					'title' => esc_html__('Window Height for Mobile', 'pointfindercoreelements') ,
					'default' => 136,
					'min' => 136,
					'step' => 1,
					'max' => 300,
					'compiler' => true,
				) ,
				array(
					'id' => 'setup10_infowindow_background',
					'type' => 'color_rgba',
					'title' => esc_html__('Background Color', 'pointfindercoreelements') ,
					'default' => array(
						'color' => '#fffbf5',
						'alpha' => '1.0'
					) ,
					'compiler' => array(
						'.wpfinfowindow',
						'.wpfinfowindow .pfinfoloading',
						'.wpfinfowindow .leaflet-popup-content-wrapper',
						'.wpfinfowindow .leaflet-popup-tip'
					) ,
					'transparent' => false,
					'mode' => 'background',
					'validate' => 'colorrgba',
				) ,
				array(
					'id' => 'setup10_infowindow_hide_lt',
					'type' => 'button_set',
					'title' => esc_html__('Listing Type Text', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				) ,
				array(
					'id' => 'setup10_infowindow_hide_lt_text',
					'required' => array('setup10_infowindow_hide_lt','=','0') ,
					'type' => 'text',
					'title' => esc_html__('Listing Type Text Title', 'pointfindercoreelements') ,
					'default' => '',
				) ,
				array(
					'id' => 'setup10_infowindow_hide_it',
					'type' => 'button_set',
					'title' => esc_html__('Item Type Text', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				) ,
				array(
					'id' => 'setup10_infowindow_hide_it_text',
					'required' => array('setup10_infowindow_hide_it','=','0') ,
					'type' => 'text',
					'title' => esc_html__('Item Type Shortname', 'pointfindercoreelements') ,
					'default' => esc_html__('Type:', 'pointfindercoreelements'),
				) ,
			array(
			    'id'        => 'acce28',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb26',
			    'type'      => 'accordion',
			    'title'    => esc_html__( 'Image Area', 'pointfindercoreelements' ),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup10_infowindow_hide_image',
					'type' => 'button_set',
					'title' => esc_html__('Status', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				) ,
				array(
					'id' => 'setup10_infowindow_img_width',
					'required' => array('setup10_infowindow_hide_image','=','0') ,
					'type' => 'slider',
					'title' => esc_html__('Image Width', 'pointfindercoreelements') ,
					'default' => 154,
					'min' => 154,
					'step' => 1,
					'max' => 200,
					'compiler' => true,
					'display_value' => 'text',
					'hint' => array(
						'content' => esc_html__('(px) (Only for desktop site / Not mobile) Default: 154', 'pointfindercoreelements')
					)
				) ,
				array(
					'id' => 'setup10_infowindow_hide_ratings',
					'type' => 'button_set',
					'required' => array('setup10_infowindow_hide_image','=','0') ,
					'title' => esc_html__('Image Review Stars', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),

				) ,
				array(
					'id' => 'setup10_infowindow_hover_image',
					'type' => 'button_set',
					'required' => array('setup10_infowindow_hide_image','=','0') ,
					'title' => esc_html__('Image Hover Buttons', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				) ,
				array(
					'id' => 'setup10_infowindow_hover_video',
					'type' => 'button_set',
					'required' => array('setup10_infowindow_hide_image','=','0') ,
					'title' => esc_html__('Image Video Button', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				) ,
				array(
					'id' => 'setup10_infowindow_animation_image',
					'type' => 'select',
					'required' => array('setup10_infowindow_hide_image','=','0') ,
					'title' => esc_html__('Hover Button Styles', 'pointfindercoreelements') ,
					'options' => array(
						'WhiteRounded' => esc_html__('White Rounded', 'pointfindercoreelements') ,
						'BlackRounded' => esc_html__('Black Rounded', 'pointfindercoreelements') ,
						'WhiteSquare' => esc_html__('White Square', 'pointfindercoreelements') ,
						'BlackSquare' => esc_html__('Black Square', 'pointfindercoreelements')
					) ,
					'default' => 'WhiteSquare',
				) ,
			array(
			    'id'        => 'acce26',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),
			array(
			    'id'        => 'accb27',
			    'type'      => 'accordion',
			    'title'    => esc_html__( 'Address Area', 'pointfindercoreelements' ),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup10_infowindow_hide_address',
					'type' => 'button_set',
					'title' => esc_html__('Status', 'pointfindercoreelements') ,
					"default" => 0,
					'options' => array(
						'0' => esc_html__('Show', 'pointfindercoreelements') ,
						'1' => esc_html__('Hide', 'pointfindercoreelements')
					),
				),
				array(
	                'id' => 'setup10_tarl',
	                'type'          => 'slider',
	                'title' => esc_html__('Title Area Row Limit', 'pointfindercoreelements'),
	                'default'       => 1,
	                'min'           => 1,
	                'step'          => 1,
	                'max'           => 4,
	                'display_value' => 'text',
	                'compiler' => true
	            ),
	            array(
	                'id' => 'setup10_aarl',
	                'type'          => 'slider',
	                'title' => esc_html__('Address Area Row Limit', 'pointfindercoreelements'),
	                'default'       => 1,
	                'min'           => 1,
	                'step'          => 1,
	                'max'           => 4,
	                'display_value' => 'text',
	                'compiler' => true
	            ),
	        array(
			    'id'        => 'accb27',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

			array(
			    'id'        => 'accb29',
			    'type'      => 'accordion',
			    'title'    => esc_html__( 'Typography Settings', 'pointfindercoreelements' ),
			    'open' 		=> false,
			    'position'  => 'start',
			),
				array(
					'id' => 'setup10_infowindow_title_color',
					'type' => 'link_color',
					'title' => esc_html__('Title Area Link Color', 'pointfindercoreelements') ,
					'compiler' => array(
						'.wpfinfowindow .wpftext > .wpftitle a',
						'.wpfinfowindow .wptitle a',
						'.wpfinfowindow .wpf-closeicon i',
						'.wpfinfowindow.leaflet-popup a.leaflet-popup-close-button'
					) ,
					'active' => false,
					'default' => array(
						'regular' => '#333333',
						'hover' => '#b00000'
					)
				) ,
				array(
					'id' => 'setup10_infowindow_title_typo',
					'type' => 'typography',
					'title' => esc_html__('Title Area Typography', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.wpfinfowindow .wpftext > .wpftitle a'
					) ,
					'units' => 'px',
					'color' => false,
					'default' => array(
						'font-weight' => '700',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '15px',
						'line-height' => '18px'
					)
				) ,
				array(
					'id' => 'setup10_infowindow_text_typo',
					'type' => 'typography',
					'title' => esc_html__('Text Area Typography', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.wpfinfowindow .wpftext .wpfdetail'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '400',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '20px',
						'color' => '#3a3a3a'
					)
				) ,
				array(
					'id' => 'setup10_infowindow_text_typo2',
					'type' => 'color',
					'compiler' => array(
						'.wpfdetailtitle'
					) ,
					'transparent' => false,
					'title' => esc_html__('Text Area Title Color', 'pointfindercoreelements') ,
					'default' => '#3a3a3a',
					'validate' => 'color',
					'hint' => array(
						'content' => esc_html__('Pick a color for text area title. Ex: Beds:', 'pointfindercoreelements')
					)
				) ,
				array(
					'id' => 'setup10_infowindow_price_typo',
					'type' => 'typography',
					'title' => esc_html__('Price Area Typography', 'pointfindercoreelements') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.pfinfowindowdlist > .pf-price'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '700',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '16px',
						'line-height' => '19px',
						'color' => '#b00000'
					) ,
				) ,
				array(
					'id' => 'setup10_infowindow_address_typo',
					'type' => 'typography',
					'title' => esc_html__('Address Typography', 'pointfindercoreelements') ,
					'required' => array('setup10_infowindow_hide_address','=','0') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.wpfinfowindow .wpftext > .wpfaddress'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '700',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '18px',
						'color' => '#3a3a3a'
					)
				) ,
				array(
					'id' => 'setup10_infowindow_lt_it_typo',
					'type' => 'typography',
					'title' => esc_html__('Listing/Item Type Typography', 'pointfindercoreelements') ,
					'required' => array('setup10_infowindow_hide_address','=','0') ,
					'google' => true,
					'font-backup' => false,
					'compiler' => array(
						'.wpfinfowindow .wpfdetail .pfliittype'
					) ,
					'units' => 'px',
					'color' => true,
					'default' => array(
						'font-weight' => '700',
						'font-family' => 'Roboto Condensed',
						'google' => true,
						'font-size' => '13px',
						'line-height' => '18px',
						'color' => '#747474'
					)
				) ,
				array(
					'id' => 'setup10_infowindow_lt_it_typo_a',
					'type' => 'link_color',
					'title' => esc_html__('Listing/Item Type Link Color', 'pointfindercoreelements') ,
					'compiler' => array(
						'.wpfinfowindow .wpfdetail .pfliittype a'
					) ,
					'active' => false,
					'default' => array(
						'regular' => '#333333',
						'hover' => '#b00000'
					)
				) ,
			array(
			    'id'        => 'accb29',
			    'type'      => 'accordion',
			    'position'  => 'end',
			),

		) ,
	);
/**
*End : POINT SETTINS
**/






/**
*Start : ITEM PAGE DETAILS SETTINS
**/

	$sections[] = array(
		'id' => 'setup42_itempagedetails',
		'title' => esc_html__('Listing Detail Page', 'pointfindercoreelements'),
		'icon' => 'el-icon-file-edit-alt',
		'fields' => array(
				array(
					'id' => 'setup3_modulessetup_headersection',
					'type' => 'button_set',
					'title' => esc_html__('Page Header', 'pointfindercoreelements') ,
					'options' => array(
						0 => esc_html__('Standard Header', 'pointfindercoreelements') ,
						1 => esc_html__('Map Header', 'pointfindercoreelements'),
						2 => esc_html__('No Header', 'pointfindercoreelements'),
						3 => esc_html__('Image Header', 'pointfindercoreelements'),
					) ,
					'default' => 2
				) ,
				array(
                    'id'        => 'setup42_itempagedetails_sidebarpos',
                    'type'      => 'image_select',
                    'title'     => esc_html__('Sidebar Position', 'pointfindercoreelements'),
                    'options'   => array(
                        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                    ),
                    'default'   => '2'
                ),
               
                array(
					'id' => 'postd_hideshow',
					'type' => 'button_set',
					'title' => esc_html__('Post Date Status', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
				),
				array(
					'id' => 'viewcount_hideshow',
					'type' => 'button_set',
					'title' => esc_html__('View Count Status', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
				),

                array(
					'id' => 'setup3_modulessetup_awfeatures',
					'type' => 'button_set',
					'title' => esc_html__('Features : Show Only Available', 'pointfindercoreelements') ,
					'desc' => esc_html__('If this enabled, Features section will hide unavailable options.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'ftshlink',
					'type' => 'button_set',
					'title' => esc_html__('Features : Link Options', 'pointfindercoreelements') ,
					'desc' => esc_html__('If this enabled, Features section will hide linked to the feature page.', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'setup3_modulessetup_openinghours',
					'type' => 'button_set',
					'title' => esc_html__('Opening Hours Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '0'
				) ,
				array(
					'id' => 'setup3_modulessetup_openinghours_ex',
					'type' => 'button_set',
					'title' => esc_html__('Opening Hours Type', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Type 1 (Single Field)', 'pointfindercoreelements') ,
						'0' => esc_html__('Type 2 (Daily)', 'pointfindercoreelements'),
						'2' => esc_html__('Type 3 (Daily with Selector)', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'required' => array('setup3_modulessetup_openinghours','=','1')
				) ,
				array(
					'id' => 'setup3_modulessetup_openinghours_ex2',
					'type' => 'button_set',
					'title' => esc_html__('Opening Hours : Start Day', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Monday', 'pointfindercoreelements') ,
						'0' => esc_html__('Sunday', 'pointfindercoreelements')
					) ,
					'default' => '1',

				) ,
				array(
					'id' => 'setup3_modulessetup_allow_comments',
					'type' => 'button_set',
					'title' => esc_html__('Comments Status', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					) ,
					'default' => '1'
				) ,
                array(
					'id' => 'setup42_itempagedetails_share_bar',
					'type' => 'button_set',
					'title' => esc_html__('Share Bar Status', 'pointfindercoreelements') ,
					'desc' => esc_html__('You can edit this module elements by using PF Settings > Additional Details > Share Bar Module section.', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
				),
				
				
				array(
					'id' => 'pr_it_v',
					'type' => 'button_set',
					'title' => esc_html__('Show All Level of Categories', 'pointfindercoreelements') ,
					'desc' => esc_html__('If this option enabled then you can see all level of Listing type, Item type and Location on the Listing Detail Page.', 'pointfindercoreelements') ,
					'default' => '0',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				),
				array(
					'id' => 'di_tags_v',
					'type' => 'button_set',
					'title' => esc_html__('Tags Area Status', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				),
				
				
				array(
					'id' => 'setup42_itempagedetails_configuration',
					'type' => 'extension_itempage',
					'title' => esc_html__('Page Section Config', 'pointfindercoreelements') ,
					'subtitle' => esc_html__('You can reorder the positions of sections by using the move icon. If you want to disable any section please click and select disable. Please check the below options to edit Information Tab Content.Note, Events and Contact Section can not place into the tabs area.', 'pointfindercoreelements'),
					'default' => array()
				),


				array(
                    'id'        => 'setup42_itempagedetails_config3',
                    'type'      => 'extension_custom_sorter',
                    'title'     => esc_html__('Information Section', 'pointfindercoreelements'),
                    'subtitle'      => esc_html__('You can organize Information Section Content by using area.', 'pointfindercoreelements'),
                    'options'   => array(
                        'enabled'   => array(
                            'description'	=> array('name'=>esc_html__('Description', 'pointfindercoreelements'),'clstype'=>'pfsingle'),
                            'details'	=> array('name'=>sprintf('%s & %s',esc_html__('Details', 'pointfindercoreelements'),esc_html__('Opening Hours', 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                        ),
                        'disabled'  => array(
                        	'details1'	=> array('name'=>esc_html__("Details", 'pointfindercoreelements'),'clstype'=>'pfsingle'),
                            'ohours1'	=> array('name'=>esc_html__("Opening Hours", 'pointfindercoreelements'),'clstype'=>'pfsingle'),
                            'ohours3'	=> array('name'=>sprintf('%s & %s',esc_html__("Opening Hours", 'pointfindercoreelements'),esc_html__("Description", 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                            'details2'	=> array('name'=>sprintf('%s & %s',esc_html__("Details", 'pointfindercoreelements'),esc_html__("Description", 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                            'details2x'	=> array('name'=>sprintf('%s & %s',esc_html__("Description", 'pointfindercoreelements'),esc_html__("Details", 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                            'details4'	=> array('name'=>sprintf('%s + %s & %s',esc_html__("Details", 'pointfindercoreelements'),esc_html__("Opening Hours", 'pointfindercoreelements'),esc_html__("Description", 'pointfindercoreelements')),'clstype'=>'pftriple1'),
                            'details4x'	=> array('name'=>sprintf('%s & %s + %s',esc_html__("Description", 'pointfindercoreelements'),esc_html__("Details", 'pointfindercoreelements'),esc_html__("Opening Hours", 'pointfindercoreelements')),'clstype'=>'pftriple2'),
                        ),

                    ),
					'required' => array(
						array('setup3_modulessetup_openinghours','=','1')
					)

                ),
				array(
                    'id'        => 'setup42_itempagedetails_config4',
                    'type'      => 'extension_custom_sorter',
                    'title'     => esc_html__("Information Section", 'pointfindercoreelements'),
                    'subtitle'      => esc_html__("You can organize Information Tab Content by using this section.", 'pointfindercoreelements'),
                    'options'   => array(
                        'enabled'   => array(
                            'details2'	=> array('name'=>sprintf('%s & %s',esc_html__("Details", 'pointfindercoreelements'),esc_html__("Description", 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                        ),
                        'disabled'  => array(
                        	'description'	=> array('name'=>esc_html__("Description", 'pointfindercoreelements'),'clstype'=>'pfsingle'),
                        	'details2x'	=> array('name'=>sprintf('%s & %s',esc_html__("Description", 'pointfindercoreelements'),esc_html__("Details", 'pointfindercoreelements')),'clstype'=>'pfdouble'),
                        	'details1'	=> array('name'=>esc_html__("Details", 'pointfindercoreelements'),'clstype'=>'pfsingle'),
                        ),

                    ),
                    'required' => array(
						array('setup3_modulessetup_openinghours','=','0')
					)

                ),


		)
	);

	/**
	*Author Page Settings
	**/
	$sections[] = array(
		'id' => 'setup42_itempagedetails_55',
		'subsection' => true,
		'title' => esc_html__('Author Page Settings', 'pointfindercoreelements'),
		'heading'   => esc_html__('Author/Agent Page Settings ', 'pointfindercoreelements'),
		'fields' => array(
				 array(
                    'id'        => 'setup42_itempagedetails_sidebarpos_auth',
                    'type'      => 'image_select',
                    'title'     => esc_html__('Sidebar Position', 'pointfindercoreelements'),
                    'options'   => array(
                        '1' => array('alt' => esc_html__('Left','pointfindercoreelements'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                        '2' => array('alt' => esc_html__('Right','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                        '3' => array('alt' => esc_html__('Disable','pointfindercoreelements'), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                    ),
                    'default'   => '2'
                ),
				array(
					'id' => 'authorpmap',
					'type' => 'button_set',
					'title' => esc_html__('Map Header', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					) ,
					'default' => '1'
				)
		)
	);


	/**
	*Gallery Settings
	**/
	$sections[] = array(
		'id' => 'setup42_itempagedetails_3',
		'subsection' => true,
		'title' => esc_html__('Gallery Settings', 'pointfindercoreelements'),
		'fields' => array(

                	array(
						'id' => 'setup42_itempagedetails_gallery_thumbs',
						'type' => 'button_set',
						'title' => esc_html__('Thumbnails', 'pointfindercoreelements') ,
						'default' => 0,
						'options' => array(
							'1' => esc_html__('Hide', 'pointfindercoreelements') ,
							'0' => esc_html__('Show', 'pointfindercoreelements')
						),
						'hint' => array(
							'content' => esc_html__('If you want to hide thumbnails under the gallery photo please change this option.', 'pointfindercoreelements')
						),
					) ,
					array(
						'id' => 'setup42_itempagedetails_gallery_effect',
						'type' => 'button_set',
						'title' => esc_html__('Image Effect', 'pointfindercoreelements') ,
						'default' => 'none',
						'options' => array(
							'fade' => esc_html__('Fade', 'pointfindercoreelements') ,
							'zoom' => esc_html__('Zoom', 'pointfindercoreelements'),
							'flip' => esc_html__('Flip', 'pointfindercoreelements'),
							'none' => esc_html__('None', 'pointfindercoreelements')
						),
					) ,
					array(
						'id' => 'setup42_itempagedetails_gallery_autoplay',
						'type' => 'button_set',
						'title' => esc_html__('Auto Play for Slide Photos', 'pointfindercoreelements') ,
						'default' => 0,
						'options' => array(
							'1' => esc_html__('Yes', 'pointfindercoreelements') ,
							'0' => esc_html__('No', 'pointfindercoreelements')
						),
					) ,
					array(
						'id'        => 'setup42_itempagedetails_gallery_interval',
						'type'      => 'spinner',
						'title' => esc_html__('Auto Slider Speed', 'pointfindercoreelements') ,
						'default'   => 300,
						'min'       => 0,
						'step'      => 100,
						'max'       => 20000,
						'required'	=> array(
							array('setup42_itempagedetails_gallery_autoplay','=','1'),

							)

					),
					array(
						'id' => 'setup42_itempagedetails_gallery_autoheight',
						'type' => 'button_set',
						'title' => esc_html__('Auto Height for Slide Photos', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Yes', 'pointfindercoreelements') ,
							'0' => esc_html__('No', 'pointfindercoreelements')
						),
					) ,

					array(
						'id' => 'di_lbox_v',
						'type' => 'button_set',
						'title' => esc_html__('Gallery Lightbox', 'pointfindercoreelements') ,
						'default' => '1',
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						),

					),
					array(
						'id' => 'setup42_itempagedetails_featuredimage',
						'type' => 'button_set',
						'title' => esc_html__('Featured Image on Gallery', 'pointfindercoreelements') ,
						'default' => '1',
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						),
					),
		)
	);

	/**
    *Start : Share Bar Module Settings
    **/
        $sections[] = array(
            'id' => 'setup_sharebar',
            'title' => esc_html__('Share Bar Settings', 'pointfindercoreelements'),
            'subsection' => true,
            'desc' => esc_html__('You can customize Listing Detail Page > Share Bar icons by using below settings.', 'pointfindercoreelements') ,
            'fields' => array(

                array(
                    'id' => 'st10_f_s',
                    'type' => 'button_set',
                    'title' => esc_html__("Facebook", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ) ,
                array(
                    'id' => 'st10_t_s',
                    'type' => 'button_set',
                    'title' => esc_html__("Twitter", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ),
                array(
                    'id' => 'st10_l_s',
                    'type' => 'button_set',
                    'title' => esc_html__("Linkedin", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ) ,
                array(
                    'id' => 'st10_p_s',
                    'type' => 'button_set',
                    'title' => esc_html__("Pinterest", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ) ,
                array(
                    'id' => 'st10_v_s',
                    'type' => 'button_set',
                    'title' => esc_html__("VK", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                ) ,
                array(
                    'id' => 'st10_w_s',
                    'type' => 'button_set',
                    'title' => esc_html__("Whatsapp", 'pointfindercoreelements') ,
                    "default" => 1,
                    'options' => array(
                        '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                        '0' => esc_html__('Disable', 'pointfindercoreelements')
                    ),
                )
            )
        );
    /**
    *End : Share Bar Module Settings
    **/

	/**
	*Contact Settings
	**/
	$sections[] = array(
		'id' => 'setup42_itempagedetails_4',
		'subsection' => true,
		'title' => esc_html__('Contact Settings', 'pointfindercoreelements'),
		'fields' => array(
				array(
					'id' => 'sb_contact',
					'type' => 'button_set',
					'title' => esc_html__('Sidebar Contact Area', 'pointfindercoreelements') ,
					'desc' => esc_html__('If this option enabled, contact area will be moved to sidebar', 'pointfindercoreelements') ,
					'default' => '0',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),

				),
				array(
                    'id'        => 'setup42_itempagedetails_contact_status-start',
                    'type'      => 'section',
                    'title'     => esc_html__('Extra Options', 'pointfindercoreelements'),
                    'indent'    => true,
                ),

                	array(
						'id' => 'setup42_cname',
						'type' => 'button_set',
						'title' => esc_html__('Name/Company', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
                	array(
						'id' => 'setup42_itempagedetails_contact_photo',
						'type' => 'button_set',
						'title' => esc_html__('Photo', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_moreitems',
						'type' => 'button_set',
						'title' => esc_html__('More Items', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_phone',
						'type' => 'button_set',
						'title' => esc_html__('Phone', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_mobile',
						'type' => 'button_set',
						'title' => esc_html__('Mobile Phone', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_email',
						'type' => 'button_set',
						'title' => esc_html__('Email Address', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_url',
						'type' => 'button_set',
						'title' => esc_html__('Web Address', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_sociallinks',
						'type' => 'button_set',
						'title' => esc_html__('Social Links', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,
					array(
						'id' => 'setup42_itempagedetails_contact_form',
						'type' => 'button_set',
						'title' => esc_html__('Contact Form', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Show', 'pointfindercoreelements') ,
							'0' => esc_html__('Hide', 'pointfindercoreelements')
						)
					) ,

                array(
                    'id'        => 'setup42_itempagedetails_contact_status-end',
                    'type'      => 'section',
                    'indent'    => false,
                ),


		)
	);


	/**
	*Report Settings
	**/
	$sections[] = array(
		'id' => 'setup42_itempagedetails_report',
		'subsection' => true,
		'title' => esc_html__('Report Listing Settings', 'pointfindercoreelements'),
        'desc'      => '<p class="description">'.esc_html__('You can change report item setting by using below options. All reports will sent to your main email which defined on PF Mail System. Also you can configure report mail template by using PF Mail System Options Panel.', 'pointfindercoreelements').'</p>',
		'fields' => array(
					array(
						'id' => 'stp_hlp22',
						'type' => 'info',
						'notice' => true,
						'style' => 'critical',
						'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements') ,
						'desc' => esc_html__('It seems like you disabled Share Bar from Listing Detail Page > Share Bar section. Please enable this feature first.', 'pointfindercoreelements'),
						'required' => array('setup42_itempagedetails_share_bar','=','0')
					) ,
                	array(
						'id' => 'setup42_itempagedetails_report_status',
						'type' => 'button_set',
						'title' => esc_html__('Status', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						),
						'required' => array('setup42_itempagedetails_share_bar','=','1')
					) ,

					array(
						'id' => 'setup42_itempagedetails_report_regstatus',
						'type' => 'button_set',
						'title' => esc_html__('Registered User', 'pointfindercoreelements') ,
						'default' => 1,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						),
						'desc' => esc_html__('If this enabled, only registered users can report a listing.', 'pointfindercoreelements') ,
						'required' => array('setup42_itempagedetails_share_bar','=','1')
					) ,

		)
	);


	/**
	*Claim Settings
	**/
	$sections[] = array(
		'id' => 'setup42_itempagedetails_claim',
		'subsection' => true,
		'title' => esc_html__('Claim Listing Settings', 'pointfindercoreelements'),
        'desc'      => '<p class="description">'.esc_html__('You can change claim listing setting by using below options. All reports will sent to your main email which defined on PF Mail System. Also you can configure claim mail template by using PF Mail System Options Panel.', 'pointfindercoreelements').'</p>',
		'fields' => array(
					array(
						'id' => 'stp_hlp23',
						'type' => 'info',
						'notice' => true,
						'style' => 'critical',
						'title' => esc_html__('IMPORTANT NOTICE', 'pointfindercoreelements') ,
						'desc' => esc_html__('It seems like you disabled Share Bar from Listing Detail Page > Share Bar section. Please enable this feature first.', 'pointfindercoreelements'),
						'required' => array('setup42_itempagedetails_share_bar','=','0')
					) ,
                	array(
						'id' => 'setup42_itempagedetails_claim_status',
						'type' => 'button_set',
						'title' => esc_html__('Status', 'pointfindercoreelements') ,
						'default' => 0,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						),
						'required' => array('setup42_itempagedetails_share_bar','=','1')
					) ,

					array(
						'id' => 'setup42_itempagedetails_claim_regstatus',
						'type' => 'button_set',
						'title' => esc_html__('Registered User', 'pointfindercoreelements') ,
						'default' => 0,
						'options' => array(
							'1' => esc_html__('Enable', 'pointfindercoreelements') ,
							'0' => esc_html__('Disable', 'pointfindercoreelements')
						),
						'desc' => esc_html__('If this enabled, only registered users can claim an item.', 'pointfindercoreelements') ,
						'required' => array('setup42_itempagedetails_share_bar','=','1')
					) ,
					array(
						'id' => 'setup42_itempagedetails_claim_validtext',
						'type' => 'text',
						'title' => esc_html__('Valid Badge Text', 'pointfindercoreelements') ,
						'default' => esc_html__('Listing verified by admin as genuine', 'pointfindercoreelements'),
						'required' => array('setup42_itempagedetails_share_bar','=','1')
					) ,

		)
	);



	/**
	*Related Listings Settings Settings
	**/
	$sections[] = array(
		'id' => 'stp42_rlt',
		'subsection' => true,
		'title' => esc_html__('Related Listing Settings', 'pointfindercoreelements'),
		'fields' => array(
					
				array(
					'id' => 're_li_1',
					'type' => 'button_set',
					'title' => esc_html__('Related Listings', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements') ,
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
				),
				array(
					'id' => 're_li_2',
					'type' => 'button_set',
					'title' => esc_html__('Related Listing Type', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Carousel', 'pointfindercoreelements') ,
						'0' => esc_html__('Ajax Grid', 'pointfindercoreelements')
					),
					'required' => array('re_li_1','=','1')
				),
				array(
					'id' => 're_li_3',
					'type' => 'button_set',
					'title' => esc_html__('Related Listing Filters', 'pointfindercoreelements') ,
					'default' => '1',
					'options' => array(
						'1' => esc_html__('Listing Type Only', 'pointfindercoreelements') ,
						'2' => esc_html__('Listing Type & Location', 'pointfindercoreelements'),
						'3' => esc_html__('Custom Field', 'pointfindercoreelements')
					),
					'required' => array('re_li_1','=','1')
				),
				array(
					'id' => 're_li_6',
					'type' => 'text',
					'title' => esc_html__('Custom Field Slug', 'pointfindercoreelements') ,
					'desc' => esc_html__('Please add a custom field slug to apply custom field filters to the related listings section.', 'pointfindercoreelements') ,
					'default' => '',
					'required' => array(
						array('re_li_1','=','1'),
						array('re_li_3','=','3')
					)
				),
				array(
					'id' => 're_li_4',
					'type' => 'button_set',
					'title' => esc_html__('Related Listing Agent Filter', 'pointfindercoreelements') ,
					'default' => '0',
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'0' => esc_html__('Disable', 'pointfindercoreelements')
					),
					'required' => array('re_li_1','=','1')
				),
				array(
					'id' => 're_li_5',
					'type' => 'spinner',
					'title' => esc_html__('Related Listing Carousel Limit', 'pointfindercoreelements') ,
					'default' => 20,
					'min'       => 0,
					'step'      => 1,
					'max'       => 100,
					'required' => array(array('re_li_1','=','1'),array('re_li_2','=','1'))
				),
		)
	);


/**
*End : ITEM PAGE DETAILS SETTINS
**/




/**
*Start : SEARCH RESULTS PAGE SETTINGS
**/

	$sections[] = array(
		'id' => 'setup42_searchpagemap',
		'title' => esc_html__('Search Results Page', 'pointfindercoreelements'),
		'heading'   => esc_html__('Search Widget: Results Page', 'pointfindercoreelements'),
        'desc'      => '<p class="description">'.esc_html__('Below settings will customize search widget results page.', 'pointfindercoreelements').'</p>',
		'icon' => 'el-icon-search-alt',
		'fields' => array(
			array(
				'id' => 'setup42_searchpagemap_headeritem',
				'type' => 'button_set',
				'title' => esc_html__('Header of Page', 'pointfindercoreelements') ,
				"default" => 0,
				'options' => array(
					0 => esc_html__('Default', 'pointfindercoreelements'),
					1 => esc_html__('Map Header', 'pointfindercoreelements') ,
					2 => esc_html__('Half Map Page', 'pointfindercoreelements')
				)
			),
			array(
                'id' => 'setup_item_searchresults_sidebarpos',
                'type'  => 'image_select',
                'title' => esc_html__('Sidebar Position', 'pointfindercoreelements'),
                'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Search Results Sidebar', 'pointfindercoreelements'),
                'options' => $pf_sidebar_options,
                'default'   => '2',
                'required' => array('setup42_searchpagemap_headeritem','less',2)
            ),
            array(
                'id'        => 'stpmappos_src',
                'type'  => 'image_select',
                'title'     => esc_html__('Map Position', 'pointfindercoreelements'),
                'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Category Sidebar', 'pointfindercoreelements'),
                'options'   => $pf_sidebar_options2,
                'default'   => '2',
                'required' => array('setup42_searchpagemap_headeritem','=',2)
            ),
			array(
				'id' => 'setup42_dlcfcx',
				'type' => 'select',
				'title' => esc_html__('Default Listing Columns', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('1 Column (Row Listing)', 'pointfindercoreelements') ,
					'2' => esc_html__('2 Columns', 'pointfindercoreelements') ,
				) ,
				'default' => '2',
				'desc' => esc_html__('This section is only for desktop view. On mobile and tablet view, system will make auto selection and hide other grid options.','pointfindercoreelements'),
				'required' => array('setup42_searchpagemap_headeritem','=','2')

			),
			array(
				'id' => 'setup22_searchresults_defaultlistingtype',
				'type' => 'select',
				'title' => esc_html__('Default Listing Columns', 'pointfindercoreelements') ,
				'options' => array(
					'1' => esc_html__('1 Column (Row Listing)', 'pointfindercoreelements') ,
					'2' => esc_html__('2 Columns', 'pointfindercoreelements') ,
					'3' => esc_html__('3 Columns', 'pointfindercoreelements') ,
					'4' => esc_html__('4 Columns', 'pointfindercoreelements')
				) ,
				'default' => '4',
				'desc' => esc_html__('This section is only for desktop view. On mobile and tablet view, system will make auto selection and hide other grid options.','pointfindercoreelements'),
				'required' => array('setup42_searchpagemap_headeritem','less',2)

			),
			array(
				'id' => 'setup42_searchpagemap_height',
				'type' => 'dimensions',
				'units' => 'px',
				'units_extended' => 'false',
				'width' => 'false',
				'title' => esc_html__('Map Area Height', 'pointfindercoreelements') ,
				'default' => array('height' => 550),
				'required' => array('setup42_searchpagemap_headeritem','=','1')
			) ,
			array(
				'id' => 'setup42_mheight',
				'type' => 'dimensions',
				'units' => 'px',
				'units_extended' => 'false',
				'width' => 'false',
				'title' => esc_html__('Map Area Height (Mobile)', 'pointfindercoreelements') ,
				'default' => array('height' => 390),
				'required' => array('setup42_searchpagemap_headeritem','greater',0),
				'desc' => esc_html__('Between 0 - 568 px screen size', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'setup42_theight',
				'type' => 'dimensions',
				'units' => 'px',
				'units_extended' => 'false',
				'width' => 'false',
				'title' => esc_html__('Map Area Height (Tablet)', 'pointfindercoreelements') ,
				'default' => array('height' => 400),
				'required' => array('setup42_searchpagemap_headeritem','greater',0),
				'desc' => esc_html__('Between 568 - 992 px screen size', 'pointfindercoreelements')
			) ,
			array(
				'id' => 'stp42_fltrs',
				'type' => 'button_set',
				'title' => esc_html__('Grid Filters', 'pointfindercoreelements') ,
				'default' => 1,
				'options' => array(
					'1' => esc_html__('Show', 'pointfindercoreelements'),
					'0' => esc_html__('Hide', 'pointfindercoreelements')
				),
				'desc' => esc_html__('Sort By, Sort and Column Filters.', 'pointfindercoreelements')
			),
			array(
				'id' => 'stp42_snum',
				'type' => 'spinner',
				'title' => esc_html__('Halfmap Search Column Number', 'pointfindercoreelements') ,
				'default' => 3,
				'min'       => 1,
				'step'      => 1,
				'max'       => 4,
				'required' => array('setup42_searchpagemap_headeritem','=','2')
			),
		)
	);

/**
*End : SEARCH RESULTS PAGE SETTINGS
**/

/**
*End : CATEGORY PAGE SETTINGS
**/
$sections[] = array(
		'id' => 'stp56_catp',
		'title' => esc_html__('Category Page', 'pointfindercoreelements'),
		'heading'   => esc_html__('Category, Archive Page Settings', 'pointfindercoreelements'),
        'desc'      => '<p class="description">'.esc_html__('Below settings will customize all category and archive pages.', 'pointfindercoreelements').'</p>',
		'icon' => 'el-icon-briefcase',
		'fields' => array(

				array(
					'id' => 'general_ct_page_layout',
					'type' => 'button_set',
					'title' => esc_html__('Page Layout', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Default', 'pointfindercoreelements') ,
						'2' => esc_html__('Map Header', 'pointfindercoreelements'),
						'3' => esc_html__('Half Page & Map', 'pointfindercoreelements')
					) ,
					'default' => '1',
					'desc' => esc_html__('Listing Types, Item Types, Features, Conditions, Post Tags pages will use this setting.', 'pointfindercoreelements') ,
				),
				array(
                    'id'        => 'setup_item_catpage_sidebarpos',
                    'type'  => 'image_select',
                    'title'     => esc_html__('Sidebar Position', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Category Sidebar', 'pointfindercoreelements'),
                    'options'   => $pf_sidebar_options,
                    'default'   => '2',
                    'required' => array('general_ct_page_layout','<','3')
                ),
                array(
                    'id'        => 'stpmappos_cat',
                    'type'  => 'image_select',
                    'title'     => esc_html__('Map Position', 'pointfindercoreelements'),
                    'desc' => esc_html__('Please edit widgets on Appearance > Widgets > PF Category Sidebar', 'pointfindercoreelements'),
                    'options'   => $pf_sidebar_options2,
                    'default'   => '2',
                    'required' => array('general_ct_page_layout','=','3')
                ),
                array(
					'id' => 'setup22_dlcfcx',
					'type' => 'select',
					'title' => esc_html__('Default Listing Columns', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('1 Column (Row Listing)', 'pointfindercoreelements') ,
						'2' => esc_html__('2 Columns', 'pointfindercoreelements') ,
					) ,
					'default' => '2',
					'desc' => esc_html__('This section is only for desktop view. On mobile and tablet view, system will make auto selection and hide other grid options.','pointfindercoreelements'),
					'required' => array('general_ct_page_layout','=','3')

				),
				array(
					'id' => 'setup22_dlcfc',
					'type' => 'select',
					'title' => esc_html__('Default Listing Columns', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('1 Column (Row Listing)', 'pointfindercoreelements') ,
						'2' => esc_html__('2 Columns', 'pointfindercoreelements') ,
						'3' => esc_html__('3 Columns', 'pointfindercoreelements') ,
						'4' => esc_html__('4 Columns', 'pointfindercoreelements')
					) ,
					'default' => '3',
					'desc' => esc_html__('This section is only for desktop view. On mobile and tablet view, system will make auto selection and hide other grid options.','pointfindercoreelements'),
					'required' => array('general_ct_page_layout','<','3')

				),
				array(
					'id' => 'setup56_searchpagemap_height',
					'type' => 'dimensions',
					'compiler' => true,
					'units' => 'px',
					'units_extended' => 'false',
					'width' => 'false',
					'title' => esc_html__('Map Area Height', 'pointfindercoreelements') ,
					'default' => array('height' => 550),
					'required' => array('general_ct_page_layout','=','2'),
					'desc' => esc_html__('> 992 px screen width size', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'setup56_mheight_theight',
					'type' => 'dimensions',
					'compiler' => true,
					'units' => 'px',
					'units_extended' => 'false',
					'width' => 'false',
					'title' => esc_html__('Map Area Height (Tablet)', 'pointfindercoreelements') ,
					'default' => array('height' => 400),
					'required' => array('general_ct_page_layout','greater','1'),
					'desc' => esc_html__('Between 568 - 992 px screen width size', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'setup56_mheight',
					'type' => 'dimensions',
					'compiler' => true,
					'units' => 'px',
					'units_extended' => 'false',
					'width' => 'false',
					'title' => esc_html__('Map Area Height (Mobile)', 'pointfindercoreelements') ,
					'default' => array('height' => 390),
					'required' => array('general_ct_page_layout','greater','1'),
					'desc' => esc_html__('Between 0 - 568 px screen width size', 'pointfindercoreelements')
				) ,
				array(
					'id' => 'general_ct_page_filters',
					'type' => 'button_set',
					'title' => esc_html__('Search Filters', 'pointfindercoreelements') ,
					'options' => array(
						'1' => esc_html__('Enable', 'pointfindercoreelements') ,
						'2' => esc_html__('Disable', 'pointfindercoreelements'),
					) ,
					'default' => 1
				),
				array(
					'id' => 'stp44_snum',
					'type' => 'spinner',
					'title' => esc_html__('Halfmap Search Column Number', 'pointfindercoreelements') ,
					'default' => 3,
					'min'       => 1,
					'step'      => 1,
					'max'       => 4,
					'required' => array(array('general_ct_page_filters','=','1'),array('general_ct_page_layout','=','3'))
				),
				array(
					'id' => 'setup22_searchresults_status_catfilters',
					'type' => 'button_set',
					'title' => esc_html__('Grid Filters', 'pointfindercoreelements') ,
					'default' => 1,
					'options' => array(
						'1' => esc_html__('Show', 'pointfindercoreelements'),
						'0' => esc_html__('Hide', 'pointfindercoreelements')
					),
					'desc' => esc_html__('Sort By, Sort and Column Filters.', 'pointfindercoreelements')
				),
	)
);
/**
*End : CATEGORY PAGE SETTINGS
**/


/**
*Start : reCaptcha
**/
    $sections[] = array(
        'id' => 'setupreCaptcha_general',
        'title' => esc_html__('reCaptcha Settings', 'pointfindercoreelements'),
        'icon' => 'el-icon-lock',
        'fields' => array(
            array(
                'id' => 'rehlp1',
                'type' => 'info',
                'notice' => true,
                'style' => 'info',
                'desc' => sprintf(esc_html__('Secure your forms with %s. To use Google reCaptcha v3 you must obtain a free API key for your domain. To obtain one, visit: %s', 'pointfindercoreelements'),'<a href="https://www.google.com/recaptcha/admin" target="_blank">Google reCapthca</a>','<a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a>')
            ) ,
            array(
                'id' => 'recaptchast',
                'type' => 'button_set',
                'title' => esc_html__('Google reCaptcha v3', 'pointfindercoreelements') ,
                'default' => 0,
                'options' => array(
                    '1' => esc_html__('Enable', 'pointfindercoreelements') ,
                    '0' => esc_html__('Disable', 'pointfindercoreelements')
                )
            ) ,
           
            array(
                'id' => 'repubk',
                'type' => 'text',
                'title' => esc_html__('Public Key', 'pointfindercoreelements') ,
                'required' => array('recaptchast','=',1)
            ) ,
            array(
                'id' => 'reprik',
                'type' => 'text',
                'title' => esc_html__('Private Key', 'pointfindercoreelements') ,
                'required' => array('recaptchast','=',1)
            )
        )
    );
/**
*End : reCaptcha
**/


Redux::setSections($opt_name,$sections);