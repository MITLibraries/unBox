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
	<h2>Click on photos to preview the collection</h2>
	<div class="first">
		<?php dynamic_sidebar( 'slideshow' ); ?>
	</div><!-- .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'diptych' ) ) : ?>
	<div class="second">
		<div class="dip">
			<h2>Recent Updates</h2>
		<?php
			// switch to news blog
			switch_to_blog(7);

			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 5,
				'caller_get_posts' => 1,
				'orderby' => 'title',
				'order' => 'ASC',
				'tag' => 'chomsky'
				);
			$the_slides = null;
			$the_slides = new WP_Query($args);

			if( $the_slides->have_posts() ) {
				while ( $the_slides->have_posts() ) : $the_slides->the_post();
					?>
					<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
						<?php the_time('F jS, Y'); ?>
					</p>
					<?php
				endwhile;
			}

			// switch back to Chomsky site
			restore_current_blog();
		?>
		</div>

		<?php dynamic_sidebar( 'diptych' ); ?>
	</div><!-- .second -->
	<?php endif; ?>
</div><!-- #secondary -->