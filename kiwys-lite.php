<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.kiwys.com/
 * @since             1.0.0
 * @package           Kiwys_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       Kiwys
 * Description:       Profitez d'un format Smart Player à intégrer directement dans votre contenu éditorial, et générez des revenus !
 * Version:           1.0.1
 * Author:            Kiwys
 * Author URI:        https://www.kiwys.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kiwys-lite
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KIWYS_LITE_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kiwys-lite-activator.php
 */
function activate_kiwys_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kiwys-lite-activator.php';
	Kiwys_Lite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kiwys-lite-deactivator.php
 */
function deactivate_kiwys_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kiwys-lite-deactivator.php';
	Kiwys_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kiwys_lite' );
register_deactivation_hook( __FILE__, 'deactivate_kiwys_lite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kiwys-lite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kiwys_lite() {

	$plugin = new Kiwys_Lite();
	$plugin->run();

}
run_kiwys_lite();
