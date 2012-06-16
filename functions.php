<?php
/**
 * @package WordPress
 * @subpackage andrewasquith
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'andrewasquith', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );


if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Remove various things
 */

remove_filter( 'the_content', 'capital_P_dangit' ); 
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );
remove_action('wp_head', 'wp_generator');


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function andrewasquith_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'andrewasquith' ) . '</a>';
}

/**
 * Replaces "[...]"  with an ellipsis and continue_reading_link().
 *
 * @return string and ellipsis
 */
function andrewasquith_auto_excerpt_more( $more ) {
	return ' &hellip;' . andrewasquith_continue_reading_link();
}
add_filter( 'excerpt_more', 'andrewasquith_auto_excerpt_more' );



function andrewasquith_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'andrewasquith_remove_recent_comments_style' );


/**
 * This theme uses wp_nav_menus() for the header menu.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'andrewasquith' )) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 *	This theme supports editor styles
 */

//add_editor_style("/css/layout-style.css");

/**
 * Disable the admin bar in 3.1
 */
//show_admin_bar( false );

/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function andrewasquith_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'andrewasquith' ),
		'id' => 'sidebar',
		'description' => __( 'The sidebar widget area', 'andrewasquith' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'andrewasquith_widgets_init' );


function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	
}


if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
} 

if ( ! function_exists( 'andrewasquith_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 */
function andrewasquith_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'andrewasquith' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'andrewasquith' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'andrewasquith_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function andrewasquith_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'andrewasquith' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'andrewasquith' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'andrewasquith' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


?>
