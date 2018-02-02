<?php
if (empty($cname) || empty($phone) || empty($propertyAddress)) {
	$cname = $phone = $propertyAddress = "";
}

//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "select Address from  pr_properties", OBJECT );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div class="container-form">
				<h1>Wait List</h1>
				<div class="content-form">
					<p>Property you seleted is not currently available for rent. Please put your email address below and we will contact you approximately 30 days before the property becomes available.</p>
					<p><span class="required">* required field.</span></p>
					<form id="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-request-a-waitlist/"); ?>" method="post" name="waitlist">
						<div class="row">
							<div class="col-25">
								<label for="WaitListFullName">Your Name</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="WaitListPhone">Telephone</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="WaitListPropertyAddress">Address</label>
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
						<div class="row button-position">
							<input type="submit" class="button-form" value="Submit" name="button_form">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</article>