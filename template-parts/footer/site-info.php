<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<a href="<?php // echo esc_url( __( 'https://wordpress.org/', 'twentyseventeen' ) ); ?>"><?php // printf( __( 'Proudly powered by %s', 'twentyseventeen' ), 'WordPress' ); ?></a>
	<p class="copyright">
		<?php
		echo apply_filters( 'footer_copyright_filter', 'Copyright 2011-2017 @pbrocks' );
		?>
	</p>
</div><!-- .site-info -->
