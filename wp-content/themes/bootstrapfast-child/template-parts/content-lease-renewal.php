<?php
if (empty($cname) || empty($phone) || empty($propertyAddress) || empty($renewalPeriod)) {
	$cname = $phone = $propertyAddress = $renewalPeriod = "";
}

//Talking to the Database
global $wpdb;
$results1 = $wpdb->get_results( "select period, renewal_period from pr_renewal_period", OBJECT );
$results2 = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div class="container-form">
				<h1>Lease Renewal</h1>
				<div class="content-form">
					<p>Please complete the form below.</p>
					<p>You will receive a lease addendum by mail with-in three business days. Please be sure to sign the addendum and return one copy while retaining a copy for your records. If you have not received the addendum in a timely manner please call me at 605-341-3404.</p>
					<p>Thank you in advance.</p>
					<p><span class="required">* required field.</span></p>
					<form id="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-lease-renewal/"); ?>" method="post" name="lease_renewal">
						<div class="row">
							<div class="col-25">
								<label for="LeaseRenewalRenewalPeriod">Renewal Period</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<select class="frm_select_fld" name="renewal_period" required>
									<option value="" selected>Select Value</option>
									<?php foreach ($results1 as $k => $v) { ?>
									<option value="<?php echo $v->period; ?>"<?php echo !empty($renewalPeriod) ? 'selected' : null; ?>><?php echo $v->renewal_period; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="LeaseRenewalFullName">Your Name</label>
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
								<label for="LeaseRenewalAddress">Address</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<select class="frm_select_fld" name="property_address" required>
									<option value="" selected>Select Value</option>
									<?php foreach ($results2 as $k => $v) { ?>
									<option value="<?php echo $v->Address; ?>"<?php echo !empty($propertyAddress) ? 'selected' : null; ?>><?php echo $v->Address; ?></option>
									<?php } ?>
								</select>
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