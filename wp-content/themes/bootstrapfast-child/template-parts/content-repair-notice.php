<?php
if (empty($cname) || empty($phone) || empty($propertyAddress) || empty($problem)) {
	$cname = $phone = $propertyAddress = $problem = "";
}

//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>
<div id="container-repair-notice">
	<form class="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-repair-notice/"); ?>" method="post" name="repair_notice">
		<fieldset>
			<legend>24 Hour Repair Notice</legend>
			<p>Please fill the form below.</p>
			<p>Call 605-341-3404 if you have not received a response with-in 8 hours.</p>
			<p><span class="error">* required field.</span></p>
			<div>
				<label for="RepairNoticeFullName">Your Name</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="RepairNoticePhone">Telephone</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="RepairNoticePropertyAddress">Address</label>
				<select class="frm_select_fld" name="property_address" required>
					<option value="" selected>Select Value</option>
					<?php foreach ($results as $k => $v) { ?>
					<option value="<?php echo $v->Address; ?>"<?php echo !empty($propertyAddress) ? 'selected' : null; ?>><?php echo $v->Address; ?></option>
					<?php } ?>
				</select>
				<span class="error">*</span>
			</div>
			<div>
				<label for="RepairNoticeMessage">Problem Description</label>
				<textarea class="frm_txt_fld" name="problem" rows="4" cols="40" required><?php echo $problem; ?></textarea>
				<span class="error">*</span>
			</div>
			<div>
				<input type="submit" class="button-form" value="Submit" name="button_form">
			</div>
		</fieldset>
	</form>
</div>