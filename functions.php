<?php
/**
 * UnBox functions and definitions.
 *
 * @package WordPress
 * @subpackage unBox
 * @since unBox 1.0
 */

add_theme_support( 'post-thumbnails' );

// Remove canonical links, allowing AddThis to see URL fragments (deep linking into slideshow).
remove_action( 'wp_head', 'rel_canonical' );

/**
 * Register masthead widget area
 */
function masthead_widgets_init() {
	register_sidebar( array(
			'name' => 'Masthead',
			'id' => 'masthead',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<div class="semantic">',
			'after_title' => '</div>',
		)
	);
}
add_action( 'widgets_init', 'masthead_widgets_init' );

/**
 * Register slideshow widget area
 */
function slideshow_widgets_init() {
	register_sidebar( array(
			'name' => 'Slideshow Bar',
			'id' => 'slideshow',
			'before_widget' => '<div class="card">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title"><h2>',
			'after_title' => '</h2></div>',
		)
	);
}
add_action( 'widgets_init', 'slideshow_widgets_init' );

/**
 * Register diptych widget area
 */
function diptych_widgets_init() {
	register_sidebar( array(
			'name' => 'Diptych Bar',
			'id' => 'diptych',
			'before_widget' => '<div class="dip">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'diptych_widgets_init' );

/**
 * Register footer widget area
 */
function footer_widgets_init() {
	register_sidebar( array(
			'name' => 'Footer',
			'id' => 'footer_bar',
			'before_widget' => '<div class="foot">',
			'after_widget' => '</div>',
			'before_title' => '<div class="semantic">',
			'after_title' => '</div>',
		)
	);
}
add_action( 'widgets_init', 'footer_widgets_init' );

add_filter( 'put_trailing_linebreak', '__return_false' );

/**
 * Register unbox_tabs post type
 */
function unbox_tabs_init() {
	$unbox_tabs_labels = array(
		'name' => _x( 'Tabs', 'post type general name' ),
		'singular_name' => _x( 'Tab', 'post type singular name' ),
		'all_items' => __( 'All Tabs' ),
		'add_new' => _x( 'Add new tab', 'tabs' ),
		'add_new_item' => __( 'Add new tab' ),
		'edit_item' => __( 'Edit tab' ),
		'new_item' => __( 'New tab' ),
		'view_item' => __( 'View tab' ),
		'search_items' => __( 'Search in tabs' ),
		'not_found' => __( 'No tabs found' ),
		'not_found_in_trash' => __( 'No tabs found in trash' ),
		'parent_item_colon' => '',
	);
	$args = array(
		'labels' => $unbox_tabs_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title' ),
	);
	register_post_type( 'unbox_tabs', $args );
}
add_action( 'init', 'unbox_tabs_init' );

/**
 * Register unbox_slides post type
 */
function unbox_slides_init() {
	$unbox_slides_labels = array(
		'name' => _x( 'Slides', 'post type general name' ),
		'singular_name' => _x( 'Slide', 'post type singular name' ),
		'all_items' => __( 'All Slides' ),
		'add_new' => _x( 'Add new slide', 'slides' ),
		'add_new_item' => __( 'Add new slide' ),
		'edit_item' => __( 'Edit slide' ),
		'new_item' => __( 'New slide' ),
		'view_item' => __( 'View slide' ),
		'search_items' => __( 'Search in slidess' ),
		'not_found' => __( 'No slides found' ),
		'not_found_in_trash' => __( 'No slides found in trash' ),
		'parent_item_colon' => '',
	);
	$args = array(
		'labels' => $unbox_slides_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array( 'title' ),
		'taxonomies' => array( 'category' ),
	);
	register_post_type( 'unbox_slides', $args );
}
add_action( 'init', 'unbox_slides_init' );

/**
 * Add "Tab" as an option theme front page
 */
function add_unbox_tabs_to_dropdown( $pages ) {
	$args = array(
		'post_type' => 'unbox_tabs',
	);
	$items = get_posts( $args );
	$pages = array_merge( $pages, $items );

	return $pages;
}
add_filter( 'get_pages', 'add_unbox_tabs_to_dropdown' );

/**
 * Enable front apge to have tabbed display
 */
function enable_front_page_unbox_tabs( $query ) {
	if ( '' == $query->query_vars['post_type'] && 0 != $query->query_vars['page_id'] ) {
		$query->query_vars['post_type'] = array( 'page', 'unbox_tabs' );
	}
}
add_action( 'pre_get_posts', 'enable_front_page_unbox_tabs' );

/**
 * Example widget code
 * From http://pippinsplugins.com/simple-wordpress-widget-template/
 */
class unbox_card_widget extends WP_Widget {

	/** constructor -- name this the same as the class above */
	function __construct() {
		parent::WP_Widget( false, $name = 'Image Card Widget' );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$link 		= $instance['link'];
		$image_attr = wp_get_attachment_image_src( $instance['image'], 'full' );

		?>
			<?php echo $before_widget; ?>
				<div class="image"><a href="<?php echo $link;?>"><img src="<?php echo $image_attr[0]; ?>" width="<?php echo $image_attr[1]; ?>" height="<?php echo $image_attr[2]; ?>"></a></div>
				<?php if ( $title ) {
					echo $before_title . '<a href="' . $link . '" class="' . sanitize_title_with_dashes( $title ) . '">' .  $title . '</a>' . $after_title;
				}
				?>
			<?php echo $after_widget; ?>
		<?php
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['image'] = $new_instance['image'];
		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {

		$title 	= esc_attr( $instance['title'] );
		$link 	= esc_attr( $instance['link'] );
		$image 	= esc_attr( $instance['image'] );

		$args = array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => null, // Any parent.
		);
		$attachments = get_posts( $args );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link URL' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
			<?php
			if ( $attachments ) {
				foreach ( $attachments as $post ) {
					?><option value="<?php echo $post->ID; ?>"<?php if ( $image == $post->ID ) { echo ' selected="selected"'; } ?>><?php echo $post->post_title; ?></option><?php
				}
			}
			?>
			</select>
		</p>
		<?php
	}
} // end class unbox_card_widget
add_action( 'widgets_init', create_function( '', 'return register_widget("unbox_card_widget");' ) );
