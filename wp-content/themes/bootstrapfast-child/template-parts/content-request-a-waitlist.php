<?php
if (empty($cname) || empty($phone) || empty($propertyAddress)) {
	$cname = $phone = $propertyAddress = "";
}

//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>
<div id="container-repair-notice">
	<form class="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-request-a-waitlist/"); ?>" method="post" name="waitlist">
		<fieldset>
			<legend>Wait List</legend>
			<p>Property you seleted is not currently available for rent.</p>
			<p>Please put your email address below and we will contact you approximately 30 days before the property becomes available.</p>
			<p><span class="error">* required field.</span></p>
			<div>
				<label for="WaitListFullName">Your Name</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="WaitListPhone">Telephone</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="WaitListPropertyAddress">Address</label>
				<select class="frm_select_fld" name="property_address" required>
					<option value="" selected>Select Value</option>
					<?php foreach ($results as $k => $v) { ?>
					<option value="<?php echo $v->Address; ?>"<?php echo !empty($propertyAddress) ? 'selected' : null; ?>><?php echo $v->Address; ?></option>
					<?php } ?>
				</select>
				<span class="error">*</span>
			</div>
			<div>
				<input type="submit" class="button-form" value="Submit" name="button_form">
			</div>
		</fieldset>
	</form>
</div>