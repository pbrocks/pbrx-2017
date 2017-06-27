<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Slick_Slider_Customizer();

class Slick_Slider_Customizer {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'slider_customizer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'slick_slider_scripts' ) );
		add_shortcode( 'slick-slider-shortcode', array( $this, 'slick_slider_shortcode_defaults' ) );
	}

	/**
	 * [slider_customizer description]
	 *
	 * @param  [type] $customizer_additions [description]
	 * @return [type]             [description]
	 */
	public function slider_customizer( $customizer_additions ) {
		$this->slider_controls( $customizer_additions );
	}

	/**
	 * A section to show how you use the default customizer controls in WordPress
	 *
	 * @param Obj $customizer_additions - Customizer Additions
	 *
	 * @return Void
	 */
	private function slider_controls( $customizer_additions ) {
		/**
		 * Checkbox control
		 */
		$customizer_additions->add_setting(
			'slider_on', array(
				'default'        => '0',
			)
		);

		/**
		 * Adding a Checkbox Toggle
		 */
		require_once dirname( __FILE__ ) . '/controls/checkbox/toggle-control.php';
		$customizer_additions->add_control( new Customizer_Toggle_Control( $customizer_additions,
			'slider_on', array(
				'label'   => 'Show Slider',
				'description'   => 'Slide this toggle to switch on your homepage slider.',
				'section' => 'static_front_page',
				'type'    => 'ios',
				'priority' => 1,
			)
		) );

		// Select control
		$customizer_additions->add_setting( 'front_page_ps', array(
			'default'        => '3',
		) );

		$customizer_additions->add_control( 'front_page_ps', array(
			'label'   => 'Homepage Panels',
			'description'   => 'Select number of panels to show on homepage and then in the Theme Options section select your pages.',
			'section' => 'static_front_page',
			'type'    => 'select',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
			),
			'priority' => 1,
		) );

	}

	public function slick_slider_scripts() {
		wp_enqueue_style( 'slick-slider', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css' );
		wp_enqueue_style( 'slick-theme', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css' );
		wp_enqueue_script( 'slick-slider', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/inc/css/slick.css' );
		wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/inc/js/slick.js', array( 'jquery' ), false, true );
	}



	public function slick_slider_display() {

		// $show_slider = get_theme_mod( 'show_slider' );
		// if ( '1' === $show_slider ) {
			self::slick_slider_shortcode_defaults();
		// }
	}

	/**
	 * Adds Settings admin menu page via ACF
	 **/
	public function slick_slider_from_customizer() {
		?>
		<div class="container">
			<div id="slick">
				<?php $gallery_images = get_theme_mod( 'customizer_image_gallery' );
				 // $gallery_images = array( '0' => '28', '1' => '4', '2' => '5' );
				foreach ( $gallery_images as $key => $mod ) {
					?>
					<div>
						<?php  ?>
						<div class="img--holder" style="background-image: url( '<?php echo wp_get_attachment_url( $mod ); ?>' );"></div>
					</div>
					<?php
				} ?>
			</div><!-- /#slick -->
		</div><?php

	}

	/**
	 * Let's borrow some images from Unsplash to display as defaults until the user customizes with their own.
	 **/
	public function slick_slider_shortcode_defaults() {
		?>
		<div class="container">
			<div id="slick">
				<div>
					<div class="img--holder" style="background-image: url(//images.unsplash.com/photo-1449023859676-22e61b0c0695?dpr=1&auto=format&fit=crop&w=767&h=431&q=80&cs=tinysrgb&crop=&bg=);"></div>
				</div>
				<div>
					<div class="img--holder" style="background-image: url(//images.unsplash.com/photo-1481873098652-b87c7a2fd98c?dpr=1&auto=format&fit=crop&w=767&h=511&q=80&cs=tinysrgb&crop=&bg=);"></div>
				</div>
				<div>
					<div class="img--holder" style="background-image: url(//images.unsplash.com/photo-1487241281672-301e0f542588?dpr=1&auto=format&fit=crop&w=767&h=511&q=80&cs=tinysrgb&crop=&bg=);"></div>
				</div>
			</div><!-- /#slick -->
		</div><?php
	}
}
