<?php
if (empty($cname) || empty($email) || empty($phone) || empty($message)) {
	$cname = $email = $phone = $message = "";
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div class="container-form">
				<h1>Contact Us</h1>
				<div class="content-form">
					<p><span class="required">* required field.</span></p>
					<form id="niceform" action="<?php echo htmlspecialchars(get_site_url() . "/process-contact-us/"); ?>" method="post" name="contact_us">
						<div class="row">
							<div class="col-25">
								<label for="ContactUsName">Name</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $cname; ?>" name="cname" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="ContactUsEmail">Email</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="email" value="<?php echo $email; ?>" name="email" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="ContactUsPhone">Telephone</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<input class="frm_inp_fld" size="20" type="text" value="<?php echo $phone; ?>" name="phone" required>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for="ContactUsMessage">Message</label>
							</div>
							<span class="required">*</span>
							<div class="col-75">
								<textarea class="frm_txt_fld" name="message" rows="4" cols="40" required><?php echo $message; ?></textarea>
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