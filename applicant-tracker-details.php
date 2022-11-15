<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/akshat009/
 * @since             1.0.0
 * @package           Applicant_Tracker_Details
 *
 * @wordpress-plugin
 * Plugin Name:       Applicant Tracker
 * Plugin URI:        https://https://github.com/akshat009/applicant-details
 * Description:       This plugin allows you to track the job application received
 * Version:           1.0.0
 * Author:            Akshat Saxena
 * Author URI:        https://https://github.com/akshat009/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       applicant-tracker-details
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
define( 'APPLICANT_TRACKER_DETAILS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-applicant-tracker-details-activator.php
 */
function activate_applicant_tracker_details() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-applicant-tracker-details-activator.php';
	Applicant_Tracker_Details_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-applicant-tracker-details-deactivator.php
 */
function deactivate_applicant_tracker_details() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-applicant-tracker-details-deactivator.php';
	Applicant_Tracker_Details_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_applicant_tracker_details' );
register_deactivation_hook( __FILE__, 'deactivate_applicant_tracker_details' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-applicant-tracker-details.php';

/**
 * Define the variable for storing the path, used for including the files
 */
define( 'APPLICANT_TRACKER_DETAILS_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Define the variable for storing the url of our plugin
 */
define( 'APPLICANT_TRACKER_DETAILS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_applicant_tracker_details() {

	$plugin = new Applicant_Tracker_Details();
	$plugin->run();

}
run_applicant_tracker_details();
