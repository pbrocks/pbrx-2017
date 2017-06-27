<?php
/**
 * Template Name: Theme Mods
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
?>

<div class="wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


<h2>Images above soon</h2>
			<?php

			echo '<h2 style="text-align:center">Data below</h2>';

			$var = get_theme_mods();
			echo '<pre>';
			// var_dump( $var );
			print_r( $var );
			echo '</pre>';
	?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php // get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
