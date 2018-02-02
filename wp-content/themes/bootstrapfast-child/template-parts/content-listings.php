<?php
/**
 * Template part for displaying page content-listings in page.php
 *
 * @package BootstrapFast Child
 */
?>
<?php

$pages_on_site = 10;
$offset = 0;
$current_page = 1;
if(!empty($_GET['pageno'])) {
	$current_page = $_GET['pageno'];
	if($current_page > 1) {	
		$offset = ($current_page - 1) * $pages_on_site;
	}
}

//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "SELECT PR.idProperties, PH.Path, PR.Description, Address, City, State, Rent, Details, if((available >= CURRENT_DATE AND available <= DATE_ADD(NOW(), INTERVAL 3 MONTH)), 1, DATE_FORMAT(available, '%M, %Y')) as MoveInReady, (select count(PhotoID) from pr_photos where ParentImage=1) as TotalRows from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE ParentImage=1 limit {$offset}, {$pages_on_site}", OBJECT );
$totalRows = $results[0]->TotalRows;
$pagesSum = ceil($totalRows / $pages_on_site);
?>
<article id="post-<?php the_ID();?>" <?php post_class();?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div id="container-listings">
				<table>
					<tbody>
						<?php foreach ($results as $k => $v) { ?>
						<tr>
							<td class="listing-row-image">
								<div class="listing-image">
									<a href="http://wp_deblen.7psh/details/?idProperties=<?php echo $v->idProperties; ?>">
										<img alt="" src="../wp-content/themes/bootstrapfast-child/photos_properties/<?php echo $v->Path; ?>" width="380">
									</a>
									<p class="caption">
										<b>Available:&nbsp;</b>
										<?php
										if ($v->MoveInReady == 1) {
											echo 'Move in READY';
										} else {
											echo $v->MoveInReady;
										}
										?>
									</p>
								</div>
							</td>
							<td class="listing-row-description">
								<div class="listing-description">
									<h1><?php echo $v->Description; ?>&nbsp;| Rent:
										<span>$<?php echo $v->Rent; ?></span>
									</h1>
									<h2>
										<?php echo $v->Address, ', ', $v->City, ', ', $v->State; ?>
									</h2>
									<p class="propertyDesc"><?php echo $v->Details; ?></p>
									<div class="nav-mid-4">
										<nav class="page-listings">
										<?php
										wp_nav_menu( array(
										'theme_location' => 'page-listings-menu',
										'container_class' => 'page-listings-menu-class',
										'walker' => new LinkToDetails_Walker(),
										'walker_arg' => $v->idProperties ) );?>
										</nav>
									</div>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div id="navigation">
					<div class="left-paging">
						<?php if ($current_page > 1) { ?>
							<a class="button-form" href="?pageno=1">First</a>
							<a class="button-form" href="?pageno=<?php echo $current_page-1; ?>">Prev</a>
						<?php } else { ?>
							<div class="disabled-paging">
								<a href="#" class="button-form">First</a>
								<a href="#" class="button-form">Prev</a>
							</div>
						<?php } ?>
					</div>
					<p class="info-paging">Page <?php echo $current_page, ' of ', $pagesSum; ?></p>
					<div class="right-paging">
						<?php if ($current_page < $pagesSum) { ?>
							<a class="button-form" href="?pageno=<?php echo $current_page+1; ?>">Next</a>
							<a class="button-form" href="?pageno=<?php echo $pagesSum; ?>">Last</a>
						<?php } else { ?>
							<div class="disabled-paging">
								<a href="#" class="button-form">Next</a>
								<a href="#" class="button-form">Last</a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>