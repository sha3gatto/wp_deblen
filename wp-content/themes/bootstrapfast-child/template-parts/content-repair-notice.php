<?php
if (empty($cname) || empty($phone) || empty($propertyAddress) || empty($problem)) {
	$cname = $phone = $propertyAddress = $problem = "";
}

//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div class="container-form">
				<h1>24 Hour Repair Notice</h1>
				<div class="content-form">
					<p>Please fill the form below.<br>Call 605-341-3404 if you have not received a response with-in 8 hours.</p>
					<p><span class="required">* required field.</span></p>
					<form id="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-repair-notice/"); ?>" method="post" name="repair_notice">
						<div class="row">
							<div class="col-25">
								<label for="RepairNoticeFullName">Your Name</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="RepairNoticePhone">Telephone</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="RepairNoticePropertyAddress">Address</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<select class="frm_select_fld" name="property_address" required>
									<option value="" selected>Select Value</option>
									<?php foreach ($results as $k => $v) { ?>
									<option value="<?php echo $v->Address; ?>"<?php echo !empty($propertyAddress) ? 'selected' : null; ?>><?php echo $v->Address; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="RepairNoticeMessage">Problem Description</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<textarea class="frm_txt_fld" name="problem" placeholder="Write something.." rows="4" cols="40" required><?php echo $problem; ?></textarea>
							</div>
						</div>
						<div class="row button-position">
							<input type="submit" class="button-form" value="Submit" name="button_form">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</article>