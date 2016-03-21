<?php
/**
 * The main template file.
 * See: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage AndrewAsquith
 */

get_header(); ?>
		<div id="main" class="container">

			<div id="content" class="col-md-8">
			<?php get_template_part( 'loop', 'index' ); ?>
			</div><!-- #content -->
			<?php get_sidebar(); ?>
		</div><!-- #main -->

<?php 
get_footer(); 
?>
