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
 *
 * Template Name: Slide List
 */

wp_register_script('jquery-cycle2',get_stylesheet_directory_uri().'/jquery.cycle2.min.js');
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-cycle2');

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="cycle-slideshow"
				data-cycle-timeout="0"
				data-cycle-prev=".prev"
				data-cycle-next=".next"
				data-cycle-slides="> div">
<?php
	$args = array(
		'post_type' => 'unbox_slides',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'caller_get_posts' => 1,
		'orderby' => 'title',
	);
	$the_slides = null;
	$the_slides = new WP_Query($args);

	if( $the_slides->have_posts() ) {
		while ( $the_slides->have_posts() ) : $the_slides->the_post();
			get_template_part('content','slide');
		endwhile;
	}

	wp_reset_query();
?>
				<a href="#" class="prev">Prev</a>
				<a href="#" class="next">Next</a>
			</div><!-- .cycle-slideshow -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>