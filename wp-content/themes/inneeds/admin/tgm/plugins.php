<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.6.1
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pointfinderh_register_required_plugins' );
function pointfinderh_register_required_plugins() {
    
    $licensekey = get_option('envato_license_code_10298703', '');

	$plugins = array(
        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true
        ),
        array(
            'name'      => 'PointFinder Core Elements',
            'slug'      => 'pointfindercoreelements',
            'required'  => true,
            'version'   => '1.2.3.1',
            'source'    => 'https://pluginscdn.webbu.com/pointfinder/pointfindercoreelements.zip'
        ),
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true
        ),
        array(
            'name'      => 'WPBakery Page Builder',
            'slug'      => 'js_composer',
            'required'  => false,
            'version'   => '6.7.0',
            'source'    => 'https://api.webbu.com/plugindownload.php?path=pointfinder/js_composer.zip&license='.$licensekey
        ),
        array(
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => false
        ),
        array(
          'name'        => 'One Click Demo Import',
          'slug'        => 'one-click-demo-import',
          'required'    => false,
        ),
    	array(
            'name'		=> 'Templatera',
            'slug'		=> 'templatera',
            'required'	=> false,
            'version'	=> '2.0.4',
            'source'	=> 'https://api.webbu.com/plugindownload.php?path=pointfinder/templatera.zip&license='.$licensekey
        ),
        array(
            'name'        => 'Ultimate Addons for Visual Composer',
            'slug'        => 'Ultimate_VC_Addons',
            'required'    => false,
            'version'     => '3.19.11',
            'source'      => 'https://api.webbu.com/plugindownload.php?path=pointfinder/Ultimate_VC_Addons.zip&license='.$licensekey
        ),
        array(
            'name'        => 'Envato Market',
            'slug'        => 'envato-market',
            'required'    => false,
            'version'     => '2.0.6',
            'source'      => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
        ),
        array(
            'name'        => 'Revolution Slider',
            'slug'        => 'revslider',
            'required'    => false,
            'version'     => '6.5.11',
            'source'      => 'https://api.webbu.com/plugindownload.php?path=pointfinder/revslider.zip&license='.$licensekey
        )

	);



	 $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );

}
