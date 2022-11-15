<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 */

/**
 * The shortcode-specific functionality of the plugin.
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Applicant_Tracker_Details_Shortcode {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Function to create content for displaying in the shortcode
	 */
	public function showform() {
		ob_start();
		include APPLICANT_TRACKER_DETAILS_PATH . 'public/partials/applicant-tracker-details-public-display.php';
		return ob_get_clean();
	}


}
