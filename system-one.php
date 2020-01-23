<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/cpuch
 * @since             0.1
 * @package           System_One
 *
 * @wordpress-plugin
 * Plugin Name:       System One Integration
 * Plugin URI:        https://github.com/cpuch/system-one
 * Description:       Add shortcode support to display shows from the System One API.
 * Version:           0.1.4
 * Author:            Cedric Puchalver
 * Author URI:        https://github.com/cpuch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       system-one
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_VERSION', '0.1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-system-one-activator.php
 */
function activate_system_one() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-system-one-activator.php';
	System_One_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-system-one-deactivator.php
 */
function deactivate_system_one() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-system-one-deactivator.php';
	System_One_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_system_one' );
register_deactivation_hook( __FILE__, 'deactivate_system_one' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-system-one.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1
 */
function run_system_one() {

	$plugin = new System_One();
	$plugin->run();

}
run_system_one();
