<?php

/**
 * Plugin Name:       PointFinder Core Elements
 * Plugin URI:        https://themeforest.net/user/webbu/portfolio
 * Description:       PointFinder theme core elements plugin.
 * Version:           1.2.3.1
 * Author:            Webbu
 * Author URI:        https://themeforest.net/user/webbu
 * License:           Themeforest Split License
 * License URI:       https://themeforest.net/licenses/terms/regular
 * Text Domain:       pointfindercoreelements
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

$theme = wp_get_theme();

if ($theme->get_template() != 'pointfinder') {
	add_action( 'admin_notices', 'pointfindertheme_notice');
}

if ($theme->get_template() == 'pointfinder') {
	remove_action( 'admin_notices', 'pointfindertheme_notice');
}

/*if (!class_exists('ReduxFramework', false)) {
	add_action( "plugins_loaded", function(){
		deactivate_plugins("redux-framework/redux-framework.php");
		activate_plugin("redux-framework/redux-framework.php");
	});
	add_action( 'admin_notices', 'pointfindertheme_notice2');
}*/

function pointfindertheme_notice() {
	echo sprintf( '<div class="updated"><p><strong>PointFinder Core Plugin</strong> %s <strong>PointFinder Theme</strong> %s</p></div>', esc_html__( 'requires', 'pointfindercoreelements' ), esc_html__( 'to be installed and activated on your site.', 'pointfindercoreelements' ) );
}

function pointfindertheme_notice2() {
	echo sprintf( '<div class="updated"><p><strong>PointFinder Core Plugin</strong> %s <strong>Redux Framework Plugin</strong> %s</p></div>', esc_html__( 'requires', 'pointfindercoreelements' ), esc_html__( 'to be installed and activated on your site. Please activate Redux Framework plugin or deactivate and activate again to solve this issue.', 'pointfindercoreelements' ) );
}



if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        if ( class_exists( 'ReduxFrameworkPlugin', false ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
add_action( 'redux/loaded', 'remove_demo' );



define( 'BSF_PRODUCTS_NOTICES', false);
define( 'PFCOREPLUGIN_NAME_VERSION', '1.2' );
define( 'PFCOREELEMENTSDIR', plugin_dir_path( __FILE__ ) );
define( 'PFCOREELEMENTSURL', plugin_dir_url( __FILE__ ) );
define( 'PFCOREELEMENTSURLADMIN', plugin_dir_url( __FILE__ ).'admin/' );
define( 'PFCOREELEMENTSURLPUBLIC', plugin_dir_url( __FILE__ ).'public/' );
define( 'PFCOREELEMENTSURLINC', plugin_dir_url( __FILE__ ).'includes/' );
define( 'PFCOREELEMENTSURLEXT', plugin_dir_url( __FILE__ ).'admin/newoptions/extensions/' );

function activate_pointfindercoreelements() {
	require_once PFCOREELEMENTSDIR . 'includes/class-pointfindercoreelements-activator.php';
	Pointfindercoreelements_Activator::activate();
}

function deactivate_pointfindercoreelements() {
	require_once PFCOREELEMENTSDIR . 'includes/class-pointfindercoreelements-deactivator.php';
	Pointfindercoreelements_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pointfindercoreelements' );
register_deactivation_hook( __FILE__, 'deactivate_pointfindercoreelements' );

require PFCOREELEMENTSDIR . 'includes/backup-functions.php';
require PFCOREELEMENTSDIR . 'includes/traits/options.php';
require PFCOREELEMENTSDIR . 'includes/class-pointfindercoreelements.php';
function run_pointfindercoreelements() {

	$plugin = new Pointfindercoreelements();
	$plugin->run();

}
run_pointfindercoreelements();