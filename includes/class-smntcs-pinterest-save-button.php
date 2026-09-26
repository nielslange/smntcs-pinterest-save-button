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
		add_action( 'wp_footer', [ $this, 'smntcs_pinterest_save_button_enqueue_pinterest_script' ], 10, 0 );
		add_filter( 'plugin_action_links_' . plugin_basename( dirname( __DIR__ ) . '/smntcs-pinterest-save-button.php' ), [ $this, 'add_settings_link' ] );
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
				'default' => '0',
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
				'default' => '0',
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
				'default' => '0',
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

		foreach ( self::get_post_types() as $post_type ) {
			$setting = 'smntcs_pinterest_show_on_' . $post_type->name;

			$wp_customize->add_setting(
				$setting,
				[
					'default'           => '1',
					'sanitize_callback' => 'rest_sanitize_boolean',
				]
			);

			$wp_customize->add_control(
				$setting,
				[
					/* translators: %s: Post type name, for example "Posts". */
					'label'   => sprintf( __( 'Show on %s', 'smntcs-pinterest-save-button' ), $post_type->labels->name ),
					'section' => 'pinterest_save_button_section',
					'type'    => 'checkbox',
				]
			);
		}

		$wp_customize->add_setting(
			'smntcs_pinterest_show_on_other',
			[
				'default'           => '1',
				'sanitize_callback' => 'rest_sanitize_boolean',
			]
		);

		$wp_customize->add_control(
			'smntcs_pinterest_show_on_other',
			[
				'label'       => __( 'Show on all other pages', 'smntcs-pinterest-save-button' ),
				'description' => __( 'For example the home page, archives, search results and profile pages.', 'smntcs-pinterest-save-button' ),
				'section'     => 'pinterest_save_button_section',
				'type'        => 'checkbox',
			]
		);
	}


	/**
	 * Enqueue Pinterest script
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function smntcs_pinterest_save_button_enqueue_pinterest_script() {
		if ( rest_sanitize_boolean( get_theme_mod( 'show_button_on_hover' ) ) && self::should_display() ) {

			// Prepare standard button.
			$script = '<script async defer data-pin-hover="true" data-pin-save="true" ';

			// Display round button (if requested).
			if ( rest_sanitize_boolean( get_theme_mod( 'show_round_button' ) ) ) {
				$script .= 'data-pin-round="true" ';
			}

			// Display large button (if requested).
			if ( rest_sanitize_boolean( get_theme_mod( 'show_large_button' ) ) ) {
				$script .= 'data-pin-tall="true" ';
			}

			// Finalize standard button.
			$script .= 'src="https://assets.pinterest.com/js/pinit.js"></script>';

			// Show Pinterest Save Button.
			print( $script ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Get the public post types the button can be limited to.
	 *
	 * @since 2.0
	 * @return WP_Post_Type[]
	 */
	public static function get_post_types() {
		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		unset( $post_types['attachment'] );

		return $post_types;
	}

	/**
	 * Check whether the button should load on the current page.
	 *
	 * Developers can override the result with the
	 * `smntcs_pinterest_save_button_display` filter.
	 *
	 * @since 2.0
	 * @return bool
	 */
	public static function should_display() {
		if ( is_singular() ) {
			$post_type = (string) get_post_type();
			$display   = rest_sanitize_boolean( get_theme_mod( 'smntcs_pinterest_show_on_' . $post_type, true ) );
		} else {
			$display = rest_sanitize_boolean( get_theme_mod( 'smntcs_pinterest_show_on_other', true ) );
		}

		return (bool) apply_filters( 'smntcs_pinterest_save_button_display', $display );
	}

	/**
	 * Add a settings link to the plugin row.
	 *
	 * @since 2.0
	 * @param string[] $links The plugin action links.
	 * @return string[]
	 */
	public function add_settings_link( $links ) {
		$url = admin_url( 'customize.php?autofocus[section]=pinterest_save_button_section' );
		array_unshift( $links, sprintf( '<a href="%s">%s</a>', esc_url( $url ), esc_html__( 'Settings', 'smntcs-pinterest-save-button' ) ) );

		return $links;
	}
}

new SMNTCS_Pinterest_Save_Button();
