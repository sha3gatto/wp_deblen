<?php
/**
 * Template part for displaying page content-details in page.php
 *
 * @package BootstrapFast Child
 */

?>
<?php
//Talking to the Database
global $wpdb;
$results = $wpdb->get_results( "SELECT (select PR.idProperties as prev from pr_properties PR where PR.idProperties = (select max(idProperties) from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE ParentImage=1 and idProperties < {$_GET['idProperties']})) as Previous, (select idProperties as next from pr_properties where idProperties = (select min(idProperties) from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE ParentImage=1 and PR.idProperties > {$_GET['idProperties']})) as Next, PR.idProperties, PH.PhotoID, PH.Path, PR.Description, Address, City, State, Rent, Details, SqFootage, Appliances, Heating_AC, Laundry, Utilities, Parking, YardMaintainance, Pets, School, Rent, Deposit, IFNULL(Other, 0) as Other, (SELECT GROUP_CONCAT(PH.Path) from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE PR.idProperties={$_GET['idProperties']} and ParentImage is null group by PR.idProperties) as thumbnails, if((available >= CURRENT_DATE AND available <= DATE_ADD(NOW(), INTERVAL 3 MONTH)), 1, DATE_FORMAT(available, '%M, %Y')) as MoveInReady from pr_photos PH join pr_properties PR ON (PR.idProperties=PH.PropertyID) WHERE PR.idProperties={$_GET['idProperties']} AND ParentImage=1", OBJECT );

$propdetails = [
	"Square Footage" => $results[0]->SqFootage,
	"Appliances" => $results[0]->Appliances,
	"Heating/AC" => $results[0]->Heating_AC,
	"Laundry" => $results[0]->Laundry,
	"Utilities" => $results[0]->Utilities,
	"Parking" => $results[0]->Parking,
	"Yard/Maintanance" => $results[0]->YardMaintainance,
	"Pets" => $results[0]->Pets,
	"School District" => $results[0]->School,
	"Rent" => $results[0]->Rent,
	"Deposit" => $results[0]->Deposit,
	"Other" => $results[0]->Other
];
?>
<article id="post-<?php the_ID();?>" <?php post_class();?>>
	<div id="mid-main-content">
		<div class="mid-main-container">
			<div id="details-page">
				<div id="nav-mid-3">
					<nav id="page-details">
						<?php
						wp_nav_menu( array(
						'theme_location' => 'page-details-menu',
						'container_class' => 'page-details-menu-class',
						'walker' => new LinkToPropertyInfo_Walker(),
						'walker_arg' => [$results[0]->Previous, $results[0]->Next]
						) );
						?>
					</nav>
					<span id="print-details-property">
						<?php if ($results[0]->MoveInReady == 1) { ?>
							<a class="button-form" href="request-a-waitlist">Request a waitlist</a>
						<?php } ?>
						<a class="button-form" href="javascript:window.print()" rel="nofollow">Print this page</a>
					</span>
				</div>
				<div class="rental-offer-description">
					<div id="property-head-details">
						<h1><?php echo $results[0]->Description; ?>&nbsp;| Rent:
							<span>$<?php echo $results[0]->Rent; ?></span>
						</h1>
						<h2>
							<?php echo $results[0]->Address, ', ', $results[0]->City, ', ', $results[0]->State; ?>
						</h2>
						<p class="propertyDesc"><?php echo $results[0]->Details; ?></p>
					</div>
				</div>
				<div class="rental-offer-image">
					<img name="mainimg" alt="" src="../wp-content/themes/bootstrapfast-child/photos_properties/<?php echo $results[0]->Path; ?>" width="480">
					<p class="caption">
						<b>Available:&nbsp;</b>
						<?php
							if ($results[0]->MoveInReady == 1) {
								echo 'Move in READY';
							} else {
								echo $results[0]->MoveInReady;
							}
						?>
					</p>
				</div>
				<div id="thumbnails-info">
					<p><small>Click on the thumbnail below to see larger image.</small></p>
				</div>
				<div id="property-more-details">
					<table>
						<?php foreach ($propdetails as $k => $v) { ?>
						<tr>
							<td class="right"><b><?php echo $k; ?>:</b></td> 
							<td><?php echo $v; ?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div id="thumbnails">
					<table>
						<tbody>
							<tr>
							<?php 
								$thumbnails = explode(',', $results[0]->thumbnails);
								foreach ($thumbnails as $k => $v) { ?>
									<?php if ($k == 0) { $k++; } if(($k) % 3 == 0) { ?>
									</tr><tr>
									<?php } ?>
									<td>
										<a href="#" class="thumb">
											<img onclick="mainimg.src='../wp-content/themes/bootstrapfast-child/photos_properties/<?php echo $v; ?>';" alt="" src="../wp-content/themes/bootstrapfast-child/photos_properties/<?php echo $v; ?>" width="90">
										</a>
									</td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</article>