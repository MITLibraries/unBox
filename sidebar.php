<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php
if ( ! is_active_sidebar( 'slideshow' ) && ! is_active_sidebar( 'diptych' ) )
	return;

// If we get this far, we have widgets. Let do this.
?>
<div id="secondary" role="complementary">
	<?php if ( is_active_sidebar( 'slideshow' ) ) : ?>
	<div class="first">
		<?php dynamic_sidebar( 'slideshow' ); ?>
	</div><!-- .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'diptych' ) ) : ?>
	<div class="second">
		<?php dynamic_sidebar( 'diptych' ); ?>
	</div><!-- .second -->
	<?php endif; ?>
</div><!-- #secondary -->