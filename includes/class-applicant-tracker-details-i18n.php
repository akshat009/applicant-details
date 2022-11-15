<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Applicant_Tracker_Details_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'applicant-tracker-details',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
