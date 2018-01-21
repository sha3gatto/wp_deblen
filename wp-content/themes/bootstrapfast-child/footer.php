<?php
/**
 * The template for displaying the footer.
 *
 * @package BootstrapFast Child
 */
?>
			</div><!-- #contennt -->
		</div><!-- .row -->
	</div><!-- .container -->
	<footer id="colophon" class="site-footer <?php echo esc_attr( bootstrapfast_container_type() ) ?>" role="contentinfo">
		<div class="row">
			<div class="col-md-12">
				<div id="site-info">
					<p class="copyright">
						<?php printf( pll__( '(C) DEBLEN Investments %04d | rebuilt by' ), date( 'Y' ) );?>
						<?php printf( '<a href="https://github.com/sha3gatto" rel="designer">Aleks Bujko</a>' ); ?>
					</p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>