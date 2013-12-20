<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-accordion');

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div id="accordion">
			<?php 
			// Get list of categories other than "Uncategorized"
			$args = array(
				'orderby' => 'id',
				'exclude' => 1,
				);
			$categories = get_categories($args);

			foreach($categories as $category) {
				// slide title
				echo '<h2><a href="#' . $category->name . '">' . $category->name . '</a></h2>';


				echo '<p>List of slides</p>';
			}
			?>
			</div>
			<hr>
			<?php 
			// Arguments
			$args = array(
				'post_type' => 'unbox_slides',
				'cat' => '3',
				);
			// The Query
			$the_query = new WP_Query($args); 

			// The Loop
			if ($the_query->have_posts() ) {
				echo '<p>Post</p>';
			} else {
				echo '<p>Nothing found</p>';
			}
			?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<script>
	jQuery(document).ready(function() {	
		jQuery("#accordion").accordion();
	});
	</script>

<?php get_footer(); ?>