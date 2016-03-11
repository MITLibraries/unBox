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
			<a href="//libraries.mit.edu/" id="logoFooter">MIT Libraries</a>
			<div id="footerMainLink" class="">
				<a href="//libraries.mit.edu/archives/">Institute Archives</a> | 
				<a href="https://giving.mit.edu/givenow/add-designation.dyn?designationId=3843690">Give now <span class="hidden-phone">to the Chomsky archive</span></a>
			</div>
			<div id="socialFooter">
				<?php
					if ( is_active_sidebar( 'footer_bar' ) ) {
						dynamic_sidebar( 'footer_bar' );
					}
				?>
			</div>
		</div>
		<div id="footerFooter" class="">
			<a href="http://www.mit.edu" id="mitLogo">Massachusetts Institute of Technology</a>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
