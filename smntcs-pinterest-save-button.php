<?php
/**
 * Plugin Name: SMNTCS Pinterest Save Button
 * Plugin URI: https://github.com/nielslange/smntcs-pinterest-save-button
 * Description: Adds a Pinterest Save Button to your images that becomes visible when a visitor hovers the image.
 * Author: Niels Lange <info@nielslange.de>
 * Author URI: https://nielslange.de
 * Text Domain: smntcs-pinterest-save-button
 * Domain Path: /languages/
 * Version: 1.5
 * Requires at least: 3.4
 * Requires PHP: 5.6
 * Tested up to: 5.3
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Pinterest Save Button
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

/**
 * Avoid direct plugin access
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '¯\_(ツ)_/¯' );
}

/**
 * Load text domain
 */
function smntcs_pinterest_save_button_load_textdomain() {
	load_plugin_textdomain( 'smntcs-pinterest-save-button', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'smntcs_pinterest_save_button_load_textdomain' );

/**
 * Add Pinterest Save Button to WordPress Customizer
 *
 * @param WP_Customize_Manager $wp_customize The instance of WP_Customize_Manager.
 * @return void
 * @since 1.0.0
 */
function smntcs_pinterest_save_button_register_customize( $wp_customize ) {
	$wp_customize->add_section(
		'pinterest_save_button_section',
		array(
			'title'    => __( 'Pinterest Save Button', 'smntcs-pinterest-save-button' ),
			'priority' => 150,
		)
	);

	$wp_customize->add_setting(
		'show_button_on_hover',
		array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'show_button_on_hover',
		array(
			'label'   => __( 'Show button on hover', 'smntcs-pinterest-save-button' ),
			'section' => 'pinterest_save_button_section',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'show_round_button',
		array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'show_round_button',
		array(
			'label'   => __( 'Show round button', 'smntcs-pinterest-save-button' ),
			'section' => 'pinterest_save_button_section',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'show_large_button',
		array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'show_large_button',
		array(
			'label'   => __( 'Show large button', 'smntcs-pinterest-save-button' ),
			'section' => 'pinterest_save_button_section',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'smntcs_pinterest_save_button_register_customize' );

/**
 * Enqueue Pinterest script
 *
 * @since 1.0.0
 */
function smntcs_pinterest_save_button_enqueue_pinterest_script() {
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
add_action( 'wp_footer', 'smntcs_pinterest_save_button_enqueue_pinterest_script' );
