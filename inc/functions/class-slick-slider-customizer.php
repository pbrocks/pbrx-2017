<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Slick_Slider_Customizer();

class Slick_Slider_Customizer {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'slider_customizer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'slick_slider_scripts' ) );
		add_shortcode( 'slick-slider-shortcode', array( $this, 'slick_slider_from_customizer' ) );
	}

	/**
	 * [slider_customizer description]
	 *
	 * @param  [type] $customizer_additions [description]
	 * @return [type]             [description]
	 */
	public function slider_customizer( $customizer_additions ) {
		$this->initial_controls( $customizer_additions );
		if ( get_theme_mod( 'slider_on' ) ) {
			$show_slider = get_theme_mod( 'slider_on' );
		} else {
			return;
		}
		if ( true === $show_slider ) {
			$this->slider_controls( $customizer_additions );
		}
	}

	/**
	 * A section to show how you use the default customizer controls in WordPress
	 *
	 * @param Obj $customizer_additions - Customizer Additions
	 *
	 * @return Void
	 */
	private function initial_controls( $customizer_additions ) {
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
		if ( ! class_exists( 'Customizer_Toggle_Control' ) ) {
			include_once dirname( __FILE__ ) . '/controls/checkbox/toggle-control.php';
		}
		$customizer_additions->add_control( new Customizer_Toggle_Control( $customizer_additions,
			'slider_on', array(
				'label'   => 'Show Slider',
				'description'   => 'Slide this toggle to switch on your homepage slider.',
				'section' => 'header_image',
				'type'    => 'ios',
				'priority' => 1,
			)
		) );
	}


	/**
	 * A section to show how you use the default customizer controls in WordPress
	 *
	 * @param Obj $customizer_additions - Customizer Additions
	 *
	 * @return Void
	 */
	private function slider_controls( $customizer_additions ) {
		$customizer_additions->add_section( 'customizer_slider_section', array(
			'title'          => 'Slider Controls',
			'description'          => 'Slider Controls' . __FILE__,
			'priority'       => 35,
			'panel'          => 'pbrx_2017_panel',
		) );

		$customizer_additions->add_control( new Customizer_Toggle_Control( $customizer_additions,
			'slider_on', array(
				'label'   => 'Show Slider',
				'description'   => 'Slide this toggle to switch off your homepage slider. To turn the slider on at a later time, you\'ll find this toggle under the Header Media panel.',
				'section' => 'customizer_slider_section',
				'type'    => 'ios',
				'priority' => 1,
			)
		) );

		// Select control
		$customizer_additions->add_setting( 'number_slider_images', array(
			'default'        => '3',
		) );

		$customizer_additions->add_control( 'number_slider_images', array(
			'label'   => 'Number of slider images',
			'description'   => 'Select number of images to show in slider. Currently slider will show ' . ( get_theme_mod( 'number_slider_images' ) ?get_theme_mod( 'number_slider_images' ) : '3' ) . ' images',
			'section' => 'customizer_slider_section',
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
			'priority' => 4,
		) );

		$slides = intval( get_theme_mod( 'number_slider_images' ) );

		$x = 1;

		while ( $x <= $slides ) {
			$customizer_additions->add_setting( 'slider_image_' . $x, array(
				'default'        => '',
			) );

			$customizer_additions->add_control( new WP_Customize_Image_Control( $customizer_additions, 'slider_image_' . $x, array(
				'label'   => 'Slider Image ' . $x,
				'section' => 'customizer_slider_section',
				'settings'   => 'slider_image_' . $x,
				'priority' => 8,
			) ) );
			$x++;
		}
		if ( ! class_exists( 'CustomizeImageGalleryControl\Control' ) ) {
			return;
		}

		$customizer_additions->add_setting( 'customizer_image_gallery1', array(
			'default' => array(),
			'sanitize_callback' => 'wp_parse_id_list',
		) );
		$customizer_additions->add_control( new CustomizeImageGalleryControl\Control(
			$customizer_additions,
			'customizer_image_gallery1',
			array(
				'label'    => __( 'Image Gallery Field Label' ),
				'section'  => 'customizer_slider_section',
				'settings' => 'customizer_image_gallery1',
				'type'     => 'image_gallery',
				)
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
				<?php
				$gallery_images = array(
					'slider_image_1' => 'http://customizer.dev/wp-content/uploads/2017/06/crab-stuffed-salmon.jpg',
					'slider_image_2' => 'http://customizer.dev/wp-content/uploads/2017/06/coffee-8.jpg',
					'slider_image_3' => 'http://customizer.dev/wp-content/uploads/2017/06/sandwich-8.jpg',
					'slider_image_4' => 'http://customizer.dev/wp-content/uploads/2017/06/espresso-8.jpg',
					);
				// $gallery_images = get_theme_mod( 'customizer_image_gallery1' );
				 // $gallery_images = array( '0' => '28', '1' => '4', '2' => '5' );
				foreach ( $gallery_images as $key => $mod ) {
					?>
					<div>
						<div class="img--holder" style="background-image: url( '<?php echo $mod; ?>' );">
						</div>
					</div>
					<?php
				} ?>
			</div><!-- /#slick -->
		</div><?php

	}

	/**
	 * Let's borrow some images from Unsplash to display as defaults until the user customizes with their own.
	 **/
	public function slick_slider_shortcode_defaults22() {
		?>
		<div class="container">
			<div id="slick">
				<div>
					<div class="img--holder" style="background-image: url( <?php echo get_stylesheet_directory_uri() . '/inc/images/photo-1449023859676-22e61b0c0695.jpeg'; ?>);"></div>
				</div>
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
					<div class="img--holder" style="background-image: url( <?php echo get_stylesheet_directory_uri() . '/inc/images/photo-1449023859676-22e61b0c0695.jpeg'; ?>);"></div>
				</div>
				<div>
					<div class="img--holder" style="background-image: url( <?php echo get_stylesheet_directory_uri() . '/inc/images/photo-1487241281672-301e0f542588.jpeg'; ?>);"></div>
				</div>
				<div>
					<div class="img--holder" style="background-image: url( <?php echo get_stylesheet_directory_uri() . '/inc/images/photo-1481873098652-b87c7a2fd98c.jpeg'; ?>);"></div>
				</div>
			</div><!-- /#slick -->
		</div><?php
	}
	/**
	 * Let's borrow some images from Unsplash to display as defaults until the user customizes with their own.
	 **/
	public function slick_slider_shortcode_defaults1() {
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
