<?php
/**
 * Template Name: Page Template
 *
 * @package WordPress
 * @subpackage Hermes_theme
 * @since Hermes Themes 1.4.4
 */
get_header(); 
?>
	<div id="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				the_content(); 
			?>
			
		<?php endwhile; // end of the loop. ?>
	</div>
<?php
get_footer();
