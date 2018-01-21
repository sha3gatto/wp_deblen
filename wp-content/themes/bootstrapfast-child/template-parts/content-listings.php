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
	<div id="content-listings">
		<div id="container-listings">
			<div id="leftcolumn">
				<?php foreach ($results as $k => $v) { ?>
				<div class="picture-container">
					<a href="http://wp_deblen.7psh/details/?idProperties=<?php echo $v->idProperties; ?>">
						<img alt="" src="../wp-content/themes/bootstrapfast-child/photos_properties/<?php echo $v->Path; ?>">
					</a>
					<div class="caption">
						<p>
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
				</div>
				<?php } ?>
			</div>
			<div id="rightcolumn">
				<?php foreach ($results as $k => $v) { ?>
				<div class="description-container">
					<h1><?php echo $v->Description; ?>&nbsp;| Rent:
						<span>$<?php echo $v->Rent; ?></span>
					</h1>
					<h2>
						<?php echo $v->Address, ', ', $v->City, ', ', $v->State; ?>
					</h2>
					<p class="propertyDesc"><?php echo $v->Details; ?></p>
					<div class="menu-listings">
						<nav id="page-listings">
						<?php
						wp_nav_menu( array(
						'theme_location' => 'page-listings-menu',
						'container_class' => 'page-listings-menu-class',
						'walker' => new LinkToDetails_Walker(),
						'walker_arg' => $v->idProperties ) );?>
						</nav>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id="navigation">
				<div class="left-link">
					<?php if ($current_page > 1) { ?>
						<a class="first-link" href="http://wp_deblen.7psh/listings/?pageno=1">First</a>
						<a class="prev-link" href="http://wp_deblen.7psh/listings/?pageno=<?php echo $current_page-1; ?>">Prev</a>
					<?php } else { ?>
						<p class="off-first-link">First</p>
						<p class="off-prev-link">Prev</p>
					<?php } ?>
				</div>
				<p class="description-paging">Page <?php echo $current_page, ' of ', $pagesSum; ?></p>
				<div class="right-link">
					<?php if ($current_page < $pagesSum) { ?>
						<a class="next-link" href="http://wp_deblen.7psh/listings/?pageno=<?php echo $current_page+1; ?>">Next</a>
						<a class="last-link" href="http://wp_deblen.7psh/listings/?pageno=<?php echo $pagesSum; ?>">Last</a>
					<?php } else { ?>
						<p class="off-next-link">Next</p>
						<p class="off-last-link">Last</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</article>