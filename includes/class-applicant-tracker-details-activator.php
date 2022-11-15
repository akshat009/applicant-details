<?php
/**
 * Fired during plugin activation
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Applicant_Tracker_Details_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		global $wpdb;
		$table_name      = $wpdb->prefix . 'applicant_submissions';
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = "CREATE TABLE `$table_name` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`firstname` varchar(25) NOT NULL,
			`lastname` varchar(25) NOT NULL,
			`presentaddress` tinytext NOT NULL,
			`email` varchar(25) NOT NULL,
			`mobile` varchar(25) NOT NULL,
			`post` varchar(25) NOT NULL,
			`cv` varchar(250) NOT NULL,
			`created_at` TIMESTAMP NOT NULL,
			PRIMARY KEY (`id`) 
		)$charset_collate";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

	}

}
