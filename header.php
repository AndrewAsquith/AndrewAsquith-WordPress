<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php


	global $page, $paged;

	wp_title( '::', true, 'right' );
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo ' :: ' . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' :: ' . sprintf( __( 'Page %s', 'andrewasquith' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="//andrew-asquith.com/common/css/bootstrap.v3.3.5.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="//andrew-asquith.com/common/favicon.ico" type="image/x-icon" />
<link rel="icon" href="//andrew-asquith.com/common/favicon.ico" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<body <?php body_class('main-body'); ?>>
<div id="page" class="hfeed">
<nav class="navbar navbar-default">
  <div id="navigation" class="container-fluid">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="skip-link screen-reader-text">
      <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'andrewasquith' ); ?>"><?php _e( 'Skip to content', 'andrewasquith' ); ?></a>
    </div>
		<?php wp_nav_menu( array('theme_location' => 'primary' )); ?>
	</div><!-- div.navigation -->
</nav>
  <div id="header" class="jumbotron">
    <div id="site-name-and-slogan">
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-name">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>
    </div>	
	</div>	<!-- div.header -->

