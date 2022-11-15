<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Applicant_Tracker_Details
 * @subpackage Applicant_Tracker_Details/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container">
	<form id="application_form" action="" enctype="multipart/form-data">
		<div class="first-row">
			<div class="col">
				<label for="fname">First Name</label>
				<div class="input">
					<input type="text" id="firstname" name="firstname" placeholder="Your firstname.." />
				</div>
			</div>
			<div class="col">
				<label for="lname">Last Name</label>
				<div class="input">
					<input type="text" id="lastname" name="lastname" placeholder="Your last name.." />
				</div>
			</div>
		</div>
		<div class="row">
				<label for="Present Address">Present Address</label>
			<div class="input">
				<textarea id="address" name="address" placeholder="Write something.." style="height:200px;"></textarea>
			</div>
		</div>
		<div class="row">	
				<label for="email">Email</label>
			<div class="input">
				<input type="email" id="email" name="email" placeholder="Your Email Address" />
			</div>
		</div>
		<div class="row">	
				<label for="mobile">Mobile</label>	
			<div class="input">
				<input type="text" id="mobile" name="mobile" placeholder="Your Phone Number" />
			</div>
		</div>
		<div class="row">	
				<label for="mobile">Post Name</label>
			<div class="input">
				<input type="text" id="post_applied" name="post_applied" />
			</div>
		</div>	
		<div class="row">
				<label for="mobile">Upload CV</label>
			<div class="input">
				<input type="file" name="cv_upload" id="cv_upload">
			</div>
		</div>
		<div class="row">
			<input type="submit" value="Submit" />
		</div>
	</form>
</div>
