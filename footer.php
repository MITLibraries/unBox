<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div id="footerHeader" class="footerHeader">
			<a href="http://libraries.mit.edu/" id="logoFooter">MIT Libraries</a>
			<div id="footerMainLink" class="">
				<a href="https://giving.mit.edu/givenow/add-designation.dyn?designationId=3843690">Give Now</a>
			</div>
			<div id="footerSubLink" class="hidden-phone">
				<a href="http://libraries.mit.edu/archives/">Institute Archives</a>
			</div>
			<div id="socialFooter">
				<?php if ( is_active_sidebar( 'footer_bar' ) ) : ?>
					<?php dynamic_sidebar( 'footer_bar' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>