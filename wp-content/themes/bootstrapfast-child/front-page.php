<?php
/**
 * Template Name: Home Page
 *
 * @package BootstrapFast Child
*/
?>
<?php
//Display the header
get_header();
?>
<?php
//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "SELECT PR.idProperties, PH.Path, PR.Description, PR.Address, PR.City, PR.State, PR.Rent, PR.Details from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE (PR.available >= CURRENT_DATE AND PR.available <= DATE_ADD(NOW(), INTERVAL 3 MONTH)) AND ParentImage=1 ORDER BY RAND() LIMIT 1", OBJECT );
?>
<?php
//Display the page content/body
?>
<div id="mid-main-content">
	<div class="mid-main-container">
		<div class="rental-offer-description">
			<h1>
				<?php echo $results[0]->Description; ?>&nbsp;| Rent: 
				<span>$<?php echo $results[0]->Rent; ?></span>
			</h1>
			<h2><?php echo $results[0]->Address, ', ', $results[0]->City, ', ', $results[0]->State; ?></h2>
			<p class="propertyDesc"><?php echo $results[0]->Details; ?></p>
		</div>
		<div class="rental-offer-image">
			<img id="image-house" alt="" src="<?php echo get_template_directory_uri(); ?>-child/photos_properties/<?php echo $results[0]->Path; ?>" width="600" hight="600">
			<p class="caption">
				<b>Available:</b> Move in READY 
			</p>
		</div>
		<div id="nav-mid-1">
			<nav id="page-reference">
				<?php wp_nav_menu( array(
				'theme_location' => 'page-reference-menu',
				'container_class' => 'page-reference-menu-class',
				'walker' => new LinkToDetails_Walker(),
				'walker_arg' => $results[0]->idProperties ) );?>
			</nav>
		</div>
	</div>
</div>
<nav id="nav-mid-2">
	<?php wp_nav_menu( array(
	'theme_location' => 'page-info-menu',
	'container_class' => 'page-info-menu-class' ) );?>
</nav>

<?php
//Display the footer
get_footer();
?>