<?php
if (empty($cname) || empty($phone) || empty($propertyAddress) || empty($renewalPeriod)) {
	$cname = $phone = $propertyAddress = $renewalPeriod = "";
}

//Talking to the Database
global $wpdb;
$results1 = $wpdb->get_results( "select period, renewal_period from pr_renewal_period", OBJECT );
$results2 = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>

<div id="container-lease-renewal">
	<form class="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-lease-renewal/"); ?>" method="post" name="lease_renewal">
		<fieldset>
			<legend>Lease Renewal</legend>
			<p>Please complete the form below.</p>
			<p>You will receive a lease addendum by mail with-in three business days.</p>
			<p>Please be sure to sign the addendum and return one copy while retaining a copy for your records.</p>
			<p>If you have not received the addendum in a timely manner please call me at 605-341-3404.</p>
			<p>Thank you in advance.</p>
			<p><span class="error">* required field.</span></p>
			<div>
				<label for="LeaseRenewalRenewalPeriod">Renewal Period</label>
				<select class="frm_select_fld" name="renewal_period" required>
					<option value="" selected>Select Value</option>
					<?php foreach ($results1 as $k => $v) { ?>
					<option value="<?php echo $v->period; ?>"<?php echo !empty($renewalPeriod) ? 'selected' : null; ?>><?php echo $v->renewal_period; ?></option>
					<?php } ?>
				</select>
				<span class="error">*</span>
			</div>
			<div>
				<label for="LeaseRenewalFullName">Your Name</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="RepairNoticePhone">Telephone</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="LeaseRenewalAddress">Address</label>
				<select class="frm_select_fld" name="property_address" required>
					<option value="" selected>Select Value</option>
					<?php foreach ($results2 as $k => $v) { ?>
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