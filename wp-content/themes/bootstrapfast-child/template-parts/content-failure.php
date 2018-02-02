<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div class="failure">
				<h1>There are an error:</h1>
				<p><?php
					$err = ['databaseErr', 'cnameErr', 'emailErr', 'phoneErr', 'messageErr', 'propertyAddressErr', 'problemErr', 'renewalPeriodErr'];
					$strErr = '';

					foreach ($_GET as $k => $v) {
						if (in_array($k, $err)) {
							$strErr .= $v . ', ';
						}	
					}
					$l = strlen($strErr);
					$strErr = substr($strErr, 0, $l-2);
					echo $strErr;
					?>
				</p>
			</div>
		</div>
	</div>
</article>