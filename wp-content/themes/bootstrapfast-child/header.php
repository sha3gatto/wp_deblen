<?php
/**
 * The header.
 *
 * @package BootstrapFast Child
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<div class="<?php echo esc_attr( bootstrapfast_container_type() ); ?>">
		<div class="row">
			<header id="masthead" class="site-header col-xs-12 <?php echo esc_attr( bootstrapfast_main_header_style() ); ?>" role="banner">
				<div class="site-branding">
					<div id="site-header">
						<?php the_custom_logo(); ?>
					</div>
					<div id="btnResidential">
						<p class="site-title"><?php bloginfo( 'name' ); ?></p>
					</div>
					<div id="btnSmart">
						<img src="<?php echo get_bloginfo( 'wpurl' )?>/wp-content/uploads/2018/01/equalhousing.png" alt=""/>
					</div>
				</div><!-- .site-branding -->
			</header><!-- #masthead -->
			<div id="content" class="site-content col-xs-12 <?php echo esc_attr( bootstrapfast_main_body_style() ) ?>">
