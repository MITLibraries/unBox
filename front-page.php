<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-tabs');

get_header(); ?>

	<div id="primary" class="site-content">

		<div id="content" role="main">

			<div id="tabs" class="tabs-bottom">
				<ul>
					<li><a href="#tabs-1"><?php the_field('tab_1_label'); ?></a></li>
					<li><a href="#tabs-2"><?php the_field('tab_2_label'); ?></a></li>
					<li><a href="#tabs-3"><?php the_field('tab_3_label'); ?></a></li>
				</ul>
				<div class="tabs-spacer"></div>
				<div id="tabs-1"><?php the_field('tab_1_content'); ?></div>
				<div id="tabs-2"><?php the_field('tab_2_content'); ?></div>
				<div id="tabs-3"><?php the_field('tab_3_content'); ?></div>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

  <script>
  jQuery(document).ready(function() {	
  	// Convert main content to tabs
  	jQuery("#tabs").tabs();
    // fix the classes
    jQuery( ".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *" )
      .removeClass( "ui-corner-all ui-corner-top" )
      .addClass( "ui-corner-bottom" );
    // move the nav to the bottom
    jQuery( ".tabs-bottom .ui-tabs-nav" ).appendTo( ".tabs-bottom" );

  });
  </script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>