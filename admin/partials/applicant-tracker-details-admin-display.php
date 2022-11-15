<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

	<div class="main-content-table">
		<div class="container-fluid">
			<div class="table-responsive">
				<div class="table-wrapper">			
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Applicant Submissions</b></h2>
							</div>
							<div class="col-sm-6">
								<div class="search-box">
									<div class="input-group">								
										<input type="text" id="search" class="form-control" placeholder="Search">
										<span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped result">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Post Applied</th>
									<th>CV</th>
									<th>
									<a href="#" class = "sort" title="Sort by date"> Date <i class="material-icons date">arrow_drop_up</i></a>
									</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								global $wpdb;
								$rows = $wpdb->get_results( 'SELECT * FROM wp_applicant_submissions' );
								if ( $wpdb->last_error ) {
									echo 'Error: ' . esc_html( $wpdb->last_error );
								}
								$num = 0;
								if ( $rows ) :
									foreach ( $rows as $row ) {
										$num++;
										echo '<tr>
									<td>' . $num . '</td>
									<td>' . $row->firstname . '</td>
									<td>' . $row->lastname . '</td>
									<td>' . $row->email . '</td>
									<td>' . $row->mobile . '</td>
									<td>' . $row->post . '</td>
									<td><a href="' . $row->cv . '" class = "download" title="Download" data-toggle="tooltip"><i class="material-icons">file_download</i></a></td>
									<td>' . $row->created_at . '</td>
									<td><a href="#' . $row->id . '" class = "delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
									</tr>';
									}
							else :
								echo '<tr> <td colspan = "9" style="text-align: center;">nothing found!!</td></tr>';
							endif;
							?>
							</tbody>
					</table>
				</div>
			</div>        
		</div> 
	</div>

