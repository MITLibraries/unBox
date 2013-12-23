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

wp_register_script('jquery-cycle2',get_stylesheet_directory_uri().'/jquery.cycle2.min.js');
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_script('jquery-cycle2');

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
				// slideshow title
				echo '<h2><a href="#' . $category->name . '">' . $category->name . '</a></h2>';

				// slideshow
				?>
				<div class="<?php echo $category->name; ?>">
				<div class="cycle-slideshow" data-cycle-timeout="0" data-cycle-prev=".<?php echo $category->name; ?> .prev" data-cycle-next=".<?php echo $category->name; ?> .next"	data-cycle-slides="> div">
				<?php

				$args = array(
					'post_type' => 'unbox_slides',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'caller_get_posts' => 1,
					'orderby' => 'title',
					'cat' => $category->term_id,
				);
				$the_slides = null;
				$the_slides = new WP_Query($args);

				if( $the_slides->have_posts() ) {
					while ( $the_slides->have_posts() ) : $the_slides->the_post();
						get_template_part('content','slide');
					endwhile;
				}

				?>
					</div><!-- .cycle-slideshow -->
					<a href="#" class="prev">Prev</a>
					<a href="#" class="next">Next</a>
				</div>
				<?php

			}
			?>
			</div><!-- #accordion -->

		</div><!-- #content -->
	</div><!-- #primary -->

	<script>
	jQuery(document).ready(function() {	
		jQuery("#accordion").accordion({
			heightStyle: "content",
		});
	});
	</script>

<?php get_footer(); ?>