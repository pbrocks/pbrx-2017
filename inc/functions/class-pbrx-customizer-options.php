?<?php
new PBrx_Customizer();

class PBrx_Customizer {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'customizer_admin' ) );
		add_action( 'customize_register', array( $this, 'customize_manager_demo' ) );
	}

	/**
	 * Add the Customize link to the admin menu
	 *
	 * @return void
	 */
	public function customizer_admin() {
		add_theme_page( 'PBrx Customize', 'PBrx Customize', 'manage_options', 'customize.php' );
	}

	/**
	 * Customizer manager demo
	 *
	 * @param WP_Customizer_Manager $wp_manager
	 * @return void
	 */
	public function customize_manager_demo( $wp_manager ) {
		$this->slider_section( $wp_manager );
	    // $this->custom_sections( $wp_manager );
	}

	/**
	 * A section to show how you use the default customizer controls in WordPress
	 *
	 * @param  Obj $wp_manager - WP Manager
	 *
	 * @return Void
	 */
	private function slider_section( $wp_manager ) {
		$wp_manager->add_section( 'pbrx_customizer_section', array(
			'title'          => 'Slider Controls',
			'priority'       => 35,
		) );

		// Select control
		$wp_manager->add_setting( 'front_page_panels', array(
			'default'        => '2',
		) );

		$wp_manager->add_control( 'front_page_panels', array(
			'label'   => 'Select number of panels to show on homepage',
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
			'priority' => 4,
		) );

		$wp_manager->add_setting( 'show_slider', array(
			'default'        => '1',
		) );

		// Checkbox control
		$wp_manager->add_control( 'show_slider', array(
			'label'   => 'Show Slider',
			'section' => 'pbrx_customizer_section',
			'type'    => 'checkbox',
			'priority' => 2,
		) );

		// Textbox control
		// $wp_manager->add_setting( 'textbox_setting', array(
		// 'default'        => dirname( __FILE__ ) . '/wp-customize-image-gallery-control/customize-image-gallery-control.php',
		// ) );
		// $wp_manager->add_control( 'textbox_setting', array(
		// 'label'   => 'Text Setting',
		// 'section' => 'pbrx_customizer_section',
		// 'type'    => 'textarea',
		// 'priority' => 1,
		// ) );
		// WP_Customize_Image_Control
		$wp_manager->add_setting( 'image_setting', array(
			'default'        => '',
		) );

		$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'image_setting', array(
			'label'   => 'Image Setting',
			'section' => 'pbrx_customizer_section',
			'settings'   => 'image_setting',
			'priority' => 18,
		) ) );

		if ( ! class_exists( 'CustomizeImageGalleryControl\Control' ) ) {
			return;
		}

		$wp_manager->add_setting( 'customizer_image_gallery', array(
			'default' => array(),
			'sanitize_callback' => 'wp_parse_id_list',
		) );
		$wp_manager->add_control( new CustomizeImageGalleryControl\Control(
			$wp_manager,
			'customizer_image_gallery',
			array(
				'label'    => __( 'Image Gallery Field Label' ),
				'section'  => 'pbrx_customizer_section',
				'settings' => 'customizer_image_gallery',
				'type'     => 'image_gallery',
				'priority' => 8,
				)
		) );


	    // Add a textarea control
		require_once dirname( __FILE__ ) . '/text/textarea-custom-control.php';
		$wp_manager->add_setting( 'textarea_text_setting', array(
			'default'        => '',
		) );
		$wp_manager->add_control( new Textarea_Custom_Control( $wp_manager, 'textarea_text_setting', array(
			'label'   => 'Textarea Text Setting',
			'section' => 'pbrx_customizer_custom_section',
			'settings'   => 'textarea_text_setting',
			'priority' => 10,
		) ) );

	    // Add a text editor control
		require_once dirname( __FILE__ ) . '/text/text-editor-custom-control.php';
		$wp_manager->add_setting( 'text_editor_setting', array(
			'default'        => '',
		) );
		$wp_manager->add_control( new Text_Editor_Custom_Control( $wp_manager, 'text_editor_setting', array(
			'label'   => 'Text Editor Setting',
			'section' => 'pbrx_customizer_custom_section',
			'settings'   => 'text_editor_setting',
			'priority' => 11,
		) ) );

	    // Add a Google Font control
		require_once dirname( __FILE__ ) . '/select/google-font-dropdown-custom-control.php';
		$wp_manager->add_setting( 'google_font_setting', array(
			'default'        => '',
		) );
		$wp_manager->add_control( new Google_Font_Dropdown_Custom_Control( $wp_manager, 'google_font_setting', array(
			'label'   => 'Google Font Setting',
			'section' => 'pbrx_customizer_custom_section',
			'settings'   => 'google_font_setting',
			'priority' => 12,
		) ) );
	}
}
