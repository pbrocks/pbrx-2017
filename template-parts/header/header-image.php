<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="custom-header">

	<div class="custom-header-media">
		<?php
		$show_slider = get_theme_mod( 'slider_on' );
		if ( is_front_page() && true === $show_slider ) {
			echo do_shortcode( '[slick-slider-shortcode]' );
		} else {
			the_custom_header_markup();
		}
	?>
	</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
