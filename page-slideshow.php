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
wp_register_script('jquery-cycle2-swipe',get_stylesheet_directory_uri().'/jquery.cycle2.swipe.min.js');
wp_register_script('jquery-cycle2-swipe-ios',get_stylesheet_directory_uri().'/ios6fix.js');
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
               <div class="slideshow" id="<?php echo $category->slug; ?>">
                   <?php

                   $args = array(
                      'post_type' => 'unbox_slides',
                      'post_status' => 'publish',
                      'posts_per_page' => -1,
                      'ignore_sticky_posts' => true,
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
              <ul class="control" data-show="<?php echo $category->slug; ?>">
                  <li><a class="prev"><span class="semantic">Prev</span></a></li>
                  <li><a class="next"><span class="semantic">Next</span></a></li>
              </ul>
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
    var theA, theB, theC, theD;
    var x = jQuery.bbq.getState();
    if (x.slide === undefined) {
        theA = 0;
        theB = 0;
        theC = 0;
        theD = 0;
    } else {
        var theSlide = x.slide;
        var theTempShow = theSlide.substring(0, 1);
        var theTempSlide = theSlide.substring(1, 2);
        if (theTempShow == "a") {
            theA = theTempSlide;
        } else if (theTempShow == "b") {
            theB = theTempSlide;
        } else if (theTempShow == "c") {
            theC = theTempSlide;
        } else if (theTempShow == "d") {
            theD = theTempSlide;
        }
    }
    var intFold = parseInt(x.active,10);

    jQuery("#accordion").accordion({
        active: intFold,
        heightStyle: "content",
        activate: function (event, ui) {
            var active = jQuery("#accordion").accordion('option', 'active');
            jQuery.bbq.pushState({'active': active}, 0);
            if (active === 0) {
               theSlide = 'a' + jQuery("#mit").data("cycle.opts").currSlide;
            } else if (active == 1) {
                theSlide = 'b' + jQuery("#linguistics").data("cycle.opts").currSlide;
            } else if (active == 2) {
                theSlide = 'c' + jQuery("#activism").data("cycle.opts").currSlide;
            } else if (active == 2) {
                theSlide = 'd' + jQuery("#political-writings").data("cycle.opts").currSlide;
            }
            jQuery.bbq.pushState({'slide': theSlide}, 0);
        }
    });

   jQuery("#mit").cycle({
       allowWrap: false,
       timeout: 0,
       slides: '> div.cycleslide',
       startingSlide: theA,
       swipe: true
   });

   jQuery("#linguistics").cycle({
       allowWrap: false,
       timeout: 0,
       slides: '> div.cycleslide',
       startingSlide: theB,
       swipe: true
   });

   jQuery("#activism").cycle({
       allowWrap: false,
       timeout: 0,
       slides: '> div.cycleslide',
       startingSlide: theC,
       swipe: true
   });

   jQuery("#political-writings").cycle({
       allowWrap: false,
       timeout: 0,
       slides: '> div.cycleslide',
       startingSlide: theD,
       swipe: true
   });

    jQuery(window).bind('hashchange', function () {
        var x = jQuery.bbq.getState();
        var a = jQuery("#mit").data("cycle.opts").currSlide;
        var b = jQuery("#linguistics").data("cycle.opts").currSlide;
        var c = jQuery("#activism").data("cycle.opts").currSlide;
        var d = jQuery("#political-writings").data("cycle.opts").currSlide;
        if (x.active === undefined) {
            jQuery("#accordion").accordion('option', 'active', 0);
        } else {
            jQuery("#accordion").accordion('option', 'active', x.active);
        }
    });

    // Since the event is only triggered when the hash changes, we need to trigger
    // the event now, to handle the hash the page may have loaded with.
    jQuery(window).trigger('hashchange');

    jQuery(".control a").click(function () {
        // what was clicked on
        var theControl = jQuery(this).attr('class');
        var theShow = jQuery(this).parents("ul.control").attr('data-show').toLowerCase();
        var theThing = document.getElementById(theShow);
        // get the relevant show's current slide
        if (theControl == 'next') {
           jQuery(theThing).cycle('next');
        } else if (theControl == 'prev') {
           jQuery(theThing).cycle('prev');
        }
        var newSlide = jQuery(theThing).data("cycle.opts").currSlide+1;
        var theLength = jQuery(theThing).data("cycle.opts").slideCount;
        if(newSlide == 1 || newSlide == theLength){
          jQuery(this).addClass('hidden');
        } else {
          jQuery(".control a").removeClass('hidden');
        }
        if(theShow=='mit') {
           var theSlide = 'a' + jQuery(theThing).data("cycle.opts").currSlide;
        } else if (theShow == 'linguistics') {
           var theSlide = 'b' + jQuery(theThing).data("cycle.opts").currSlide;
        } else if (theShow == 'activism') {
           var theSlide = 'c' + jQuery(theThing).data("cycle.opts").currSlide;
        } else if (theShow == 'political-writings') {
           var theSlide = 'd' + jQuery(theThing).data("cycle.opts").currSlide;
        }
        jQuery.bbq.pushState({'slide': theSlide}, 0);
   });

  // Remote control of accordion via a.remote links (inline in slides)
  jQuery("a.remote").click(function(e) {
    var x = jQuery.bbq.getState();
    var y = x.active;
    if(y>=3) {
      y = 0;
    } else {
      y++;
    }
    jQuery("#accordion").accordion('option','active',y);
    e.preventDefault();
  });

});
</script>

<?php get_footer(); ?>
