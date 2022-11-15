<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/admin
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Applicant_Tracker_Details_Admin {

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
		add_action( 'wp_ajax_applicant_form_process', array( $this, 'applicant_form_process' ) );
		add_action( 'wp_ajax_nopriv_applicant_form_process', array( $this, 'applicant_form_process' ) );
		add_action( 'wp_ajax_applicant_form_delete', array( $this, 'applicant_form_delete' ) );
		add_action( 'wp_ajax_applicant_form_search', array( $this, 'applicant_form_search' ) );
		add_action( 'wp_ajax_applicant_form_sort', array( $this, 'applicant_form_sort' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Applicant_Tracker_Details_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Applicant_Tracker_Details_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'applicant-submissions' ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/applicant-tracker-details-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'font-family', 'https://fonts.googleapis.com/css?family=Roboto|Varela+Round', array(), $this->version, 'all' );
			wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), $this->version, 'all' );
			wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Applicant_Tracker_Details_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Applicant_Tracker_Details_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'applicant-tracker-details-admin', plugin_dir_url( __FILE__ ) . 'js/applicant-tracker-details-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			'applicant-tracker-details-admin',
			'plugin_admin_data',
			array(
				'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
				'admin_nonce'    => wp_create_nonce( 'my_admin_nonce' ),
			),
		);
		wp_enqueue_script( 'applicant-tracker-details-admin', plugin_dir_url( __FILE__ ) . 'js/applicant-tracker-details-admin.js', array( 'jquery' ), $this->version, false );
	}
	/**
	 * Add Admin Page to Admin Menu
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {

		/**
		 * This function is used to add menu page
		 */

		add_menu_page(
			__( 'Applicatant Submissions', 'applicant-tracker-details' ),
			__( 'Applicatant Submissions', 'applicant-tracker-details' ),
			'manage_options',
			'applicant-submissions',
			array( $this, 'showlist' ),
			'dashicons-buddicons-pm',
			3
		);
	}
	/**
	 * This function is used to display the list of the data
	 */
	public function showlist() {
		include 'partials/applicant-tracker-details-admin-display.php';
	}
	/**
	 * This function is used to process and store the data
	 */
	public function applicant_form_process() {
		check_ajax_referer( 'my-nonce', 'nonce' );
		$date         = current_datetime()->format( 'Y-m-d H:i:s' );
		$firstname    = isset( $_POST['fname'] ) ? sanitize_text_field( wp_unslash( $_POST['fname'] ) ) : '';
		$lastname     = isset( $_POST['lname'] ) ? sanitize_text_field( wp_unslash( $_POST['lname'] ) ) : ' ';
		$email        = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$address      = isset( $_POST['address'] ) ? sanitize_textarea_field( wp_unslash( $_POST['address'] ) ) : ' ';
		$mobile       = isset( $_POST['mobile'] ) ? wp_unslash( intval( $_POST['mobile'] ) ) : '';
		$post_applied = isset( $_POST['post_applied'] ) ? sanitize_text_field( wp_unslash( $_POST['post_applied'] ) ) : '';
		$filename     = isset( $_FILES['cv']['name'] ) ? sanitize_text_field( wp_unslash( $_FILES['cv']['name'] ) ) : '';
		$upload       = wp_upload_bits( $filename, 'null', file_get_contents( $_FILES['cv']['tmp_name'] ) );
		global $wpdb;
		$insert=$wpdb->insert(
			'wp_applicant_submissions',
			array(
				'firstname'    => $firstname,
				'lastname'   => $lastname,
				'presentaddress' => $address,
				'email'=>$email,
				'mobile'=>$mobile,
				'post'=>$post_applied,
				'cv'=>$upload['url'],
				'created_at'=>$date,
			),
		);
		if($insert):
			$headers      = 'From: ' . get_bloginfo( 'name' ) . get_option( 'admin_email' ) . "\r\n";
			$sent_message = wp_mail(
			$email,
			'Automatic Reponse',
			'Thanks for applying for the job!!!
			 Our team will contact you shortly ',
			$headers,
			'',
			);
			wp_send_json_success();
		endif;
		wp_die();
	}
	/**
	 * This function is used to delete the data
	 */
	public function applicant_form_delete() {
		check_ajax_referer( 'my_admin_nonce', 'nonce' );
		if ( isset( $_POST['id'] ) && ( ! empty( $_POST['id'] ) ) ) {
			$uid = sanitize_text_field( wp_unslash( $_POST['id'] ) );
		}
		global $wpdb;
		$del = $wpdb->delete( 'wp_applicant_submissions', array( 'id' => $uid ) );
		if ( $wpdb->last_error ) {
			echo 'Error: ' . esc_html( $wpdb->last_error );
		}
		if($del):
			$table="";
			$rows = $wpdb->get_results( 'SELECT * FROM wp_applicant_submissions' );
			if ( $wpdb->last_error ) {
					echo 'Error: ' . esc_html( $wpdb->last_error );
			}
			$num = 0;
			foreach ( $rows as $row ) {
				$num++;
				$table.= '<tr>
				<td>' . $num . '</td>
				<td>' . $row->firstname . '</td>
				<td>' . $row->lastname . '</td>
				<td>' . $row->email . '</td>
				<td>' . $row->mobile . '</td>
				<td>' . $row->post . '</td>
				<td><a href="' . $row->cv . '" class="download" title="Download" data-toggle="tooltip"><i class="material-icons">file_download</i></a></td>
				<td>' . $row->created_at . '</td>
				<td><a href="#' . $row->id . '" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
				</tr>';
			}
		endif;
		wp_send_json_success($table);
		wp_die();

	}
	/**
	 * This function is used to implement search functionality
	 */
	public function applicant_form_search() {
		check_ajax_referer( 'my_admin_nonce', 'nonce' );
		$searchkeyword = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
		global $wpdb;
		$rows = $wpdb->get_results( 'SELECT * FROM wp_applicant_submissions  WHERE CONCAT( `firstname`, `lastname`, `presentaddress`, `email`, `mobile`, `post`) LIKE "%' . $searchkeyword . '%" ' );
		if ( $wpdb->last_error ) {
			echo 'Error: ' . esc_html( $wpdb->last_error );
		}
		$table = '';
		if ( $rows ) :
			$num = 0;
			foreach ( $rows as $row ) {
				$num++;
				$table .= '<tr>
				<td>' . $num . '</td>
				<td>' . $row->firstname . '</td>
				<td>' . $row->lastname . '</td>
				<td>' . $row->email . '</td>
				<td>' . $row->mobile . '</td>
				<td>' . $row->post . '</td>
				<td><a href="' . $row->cv . '" class="download" title="Download" data-toggle="tooltip"><i class="material-icons">file_download</i></a></td>
				<td>' . $row->created_at . '</td>
				<td><a href="#' . $row->id . '" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
				</tr>';
			}
			else :
				$table .= '<tr><td colspan="9" style="text-align: center;">nothing found!!</td></tr>';
			endif;
			wp_send_json_success( $table );
			wp_die();
	
	}
	/**
	 * This function is used to implement sort functionality by date
	 */
	public function applicant_form_sort() {
		check_ajax_referer( 'my_admin_nonce', 'nonce' );
		$orderby = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : '';
		global $wpdb;
		$rows = $wpdb->get_results( 'SELECT * FROM wp_applicant_submissions ORDER BY created_at ' . $orderby . ' ' );
		if ( $wpdb->last_error ) {
			echo 'Error: ' . esc_html( $wpdb->last_error );
		}
		$table = '';
		$num   = 0;
		foreach ( $rows as $row ) {
			$num++;
			$table .= '<tr>
			<td>' . $num . '</td>
			<td>' . $row->firstname . '</td>
			<td>' . $row->lastname . '</td>
			<td>' . $row->email . '</td>
			<td>' . $row->mobile . '</td>
			<td>' . $row->post . '</td>
			<td><a href="' . $row->cv . '" class="download" title="Download" data-toggle="tooltip"><i class="material-icons">file_download</i></a></td>
			<td>' . $row->created_at . '</td>
			<td><a href="#' . $row->id . '" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
			</tr>';
		}
		wp_send_json_success( $table );
		wp_die();
	}
	/**
	 * This function is used to add the dashboard widget
	 */
	public function add_applicant_detail_dashboard_widget() {
		wp_add_dashboard_widget( 'applicant_detail_widget', 'Latest Applications Received', array( $this, 'applicant_detail_widget_function' ), 'side', 'high' );
	}
	/**
	 * This function is the callback and displays the data in the dashboard widget
	 */
	public function applicant_detail_widget_function() {
		echo'<h3>Recent Submissions</h3>';
		global $wpdb;
		$rows = $wpdb->get_results( 'SELECT * FROM wp_applicant_submissions LIMIT 0,5' );
		if ( $wpdb->last_error ) {
			echo 'Error: ' . esc_html( $wpdb->last_error );
		}
			$num = 0;
			echo '<ul>';
		foreach ( $rows as $row ) {
			$num++;
			echo'<li>
			<span><strong>'. $num++ .'.'.'</strong></span>
			<span><strong>'. $row->firstname .'</strong> has applied for </span>
			<span><strong>'. $row->post .' </strong>post </span>
			</li>';
		}
			echo'</ul>';
	}
}
