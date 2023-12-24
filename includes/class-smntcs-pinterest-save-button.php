<?php
/**
 * Registeres the Pinterest Save Button in the WordPress Customizer.
 *
 * @package SMNTCS_Pinterest_Save_Button
 */

/**
 * SMNTCS_Pinterest_Save_Button class
 */
class SMNTCS_Pinterest_Save_Button {

	/**
	 * Constructor to set up action hooks.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'smntcs_pinterest_save_button_register_customize' ] );
		add_action( 'wp_footer', [ $this, 'smntcs_pinterest_save_button_enqueue_pinterest_script' ] );

	}

	/**
	 * Register the Pinterest Save Button in the WordPress Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize The WP_Customize_Manager instance.
	 * @return void
	 */
	public function smntcs_pinterest_save_button_register_customize( $wp_customize ) {
		$wp_customize->add_section(
			'pinterest_save_button_section',
			[
				'title'    => __( 'Pinterest Save Button', 'smntcs-pinterest-save-button' ),
				'priority' => 150,
			]
		);

		$wp_customize->add_setting(
			'show_button_on_hover',
			[
				'default' => false,
			]
		);

		$wp_customize->add_control(
			'show_button_on_hover',
			[
				'label'   => __( 'Show button on hover', 'smntcs-pinterest-save-button' ),
				'section' => 'pinterest_save_button_section',
				'type'    => 'checkbox',
			]
		);

		$wp_customize->add_setting(
			'show_round_button',
			[
				'default' => false,
			]
		);

		$wp_customize->add_control(
			'show_round_button',
			[
				'label'   => __( 'Show round button', 'smntcs-pinterest-save-button' ),
				'section' => 'pinterest_save_button_section',
				'type'    => 'checkbox',
			]
		);

		$wp_customize->add_setting(
			'show_large_button',
			[
				'default' => false,
			]
		);

		$wp_customize->add_control(
			'show_large_button',
			[
				'label'   => __( 'Show large button', 'smntcs-pinterest-save-button' ),
				'section' => 'pinterest_save_button_section',
				'type'    => 'checkbox',
			]
		);
	}


	/**
	 * Enqueue Pinterest script
	 *
	 * @since 1.0.0
	 */
	public function smntcs_pinterest_save_button_enqueue_pinterest_script() {
		if ( true === get_theme_mod( 'show_button_on_hover' ) ) {

			// Prepare standard button.
			$script = '<script async defer data-pin-hover="true" data-pin-save="true" ';

			// Display round button (if requested).
			if ( true === get_theme_mod( 'show_round_button' ) ) {
				$script .= 'data-pin-round="true" ';
			}

			// Display large button (if requested).
			if ( true === get_theme_mod( 'show_large_button' ) ) {
				$script .= 'data-pin-tall="true" ';
			}

			// Finalize standard button.
			$script .= 'src="//assets.pinterest.com/js/pinit.js"></script>';

			// Show Pinterest Save Button.
			print( $script ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

new SMNTCS_Pinterest_Save_Button();
