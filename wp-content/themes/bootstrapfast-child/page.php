<?php
/**
 * The template for displaying all pages
 *
 * @package BootstrapFast Child
 */

global $wp_query;
$templatePageName = $wp_query->query_vars["pagename"];
if (substr($templatePageName, 0, 7) === 'process') {
	while( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', $templatePageName );
	endwhile;
} else {
	get_header();
	while( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', $templatePageName );
	endwhile;
	get_footer();
}