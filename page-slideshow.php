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
wp_register_script('jquery-bbq',get_stylesheet_directory_uri().'/jquery.ba-bbq.min.js');
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_script('jquery-cycle2');
wp_enqueue_script('jquery-bbq');

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
			$i = 0;

			foreach($categories as $category) {
				// slideshow title
				echo '<h2><a href="#' . $category->name . '">' . $category->name . '</a></h2>';

				// slideshow
				?>
				<div class="<?php echo $category->slug; ?>">
				<div class="cycle-slideshow" data-cycle-timeout="0" data-cycle-prev=".<?php echo $category->slug; ?> .prev" data-cycle-next=".<?php echo $category->slug; ?> .next"	data-cycle-slides="> div">
				<?php

				$args = array(
					'post_type' => 'unbox_slides',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'caller_get_posts' => 1,
					'orderby' => 'title',
					'order' => 'ASC',
					'cat' => $category->term_id,
				);
				$the_slides = null;
				$the_slides = new WP_Query($args);

				if( $the_slides->have_posts() ) {
					while ( $the_slides->have_posts() ) : $the_slides->the_post();
						// get_template_part('content','slide');
						include( locate_template( 'content-slide.php' ) );
					endwhile;
				}

				?>
					</div><!-- .cycle-slideshow -->
					<a href="#" class="prev">Prev</a>
					<a href="#" class="next">Next</a>
				</div>
				<?php
				$i++;
			}
			?>
			</div><!-- #accordion -->

		</div><!-- #content -->
	</div><!-- #primary -->

	<script>
	jQuery(document).ready(function() {	
		// read initial state
		var x = jQuery.bbq.getState();
		var intFold = parseInt(x.active);

		jQuery("#accordion").accordion({
			active: intFold,
			heightStyle: "content",
			activate: function (event, ui) {
				var active = jQuery("#accordion").accordion('option','active');
				jQuery.bbq.pushState({'active':active},0);
			}
		});

		jQuery(window).bind('hashchange', function () {                
		    var x = jQuery.bbq.getState();
		    if (x.active == undefined) {
		        jQuery("#accordion").accordion('option', 'active', 0);
		    } else {
		        jQuery("#accordion").accordion('option', 'active', x.active);
		    }
		});

		// Since the event is only triggered when the hash changes, we need to trigger
		// the event now, to handle the hash the page may have loaded with.
		jQuery(window).trigger('hashchange');

	});
	</script>

<?php get_footer(); ?>