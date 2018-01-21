<?php
if (empty($cname) || empty($email) || empty($phone) || empty($message)) {
	$cname = $email = $phone = $message = "";
}
?>
<div class="container-contact-us">
	<form class="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-contact-us/"); ?>" method="post" name="contact_us">
		<fieldset>
			<legend>Contact Us</legend>
			<p><span class="error">* required field.</span></p>
			<div>
				<label for="ContactUsName">Name</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="ContactUsEmail">Email</label>
				<input class="frm_inp_fld" size="20" type="email" value="<?php echo $email; ?>" name="email" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="ContactUsPhone">Telephone</label>
				<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
				<span class="error">*</span>
			</div>
			<div>
				<label for="ContactUsMessage">Message</label>
				<textarea class="frm_txt_fld" name="message" rows="4" cols="40" required><?php echo $message; ?></textarea>
				<span class="error">*</span>
			</div>
			<div>
				<input type="submit" class="button-form" value="Submit" name="button_form">
			</div>
		</fieldset>
	</form>
</div>