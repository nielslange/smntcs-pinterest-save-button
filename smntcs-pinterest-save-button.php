<?php
/*
 Plugin Name: SMNTCS Pinterest Save Button
 Description: Adds a Pinterest Save Button to your images that becomes visible when a visitor hovers the image. 
 Version: 1.1.1
 Author: Niels Lange
 Author URI: http://www.nielslange.de
 Requires at least: 4.0
 Tested up to: 4.5.2
 License: GPLv2 or later
 Text Domain: smntcs-pinterest-save-button
 */

/*
 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

 Copyright 2005-2016 Niels Lange
 */

// Avoid direct plugin access
if ( ! defined( 'ABSPATH' ) ) exit;

// Load text domain
add_action('plugins_loaded', 'smntcs_pinterest_save_button_load_textdomain');
function smntcs_pinterest_save_button_load_textdomain() {
	load_plugin_textdomain( 'smntcs-pinterest-save-button', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Add Pinterest Save Button to WordPress Customizer
add_action( 'customize_register', 'smntcs_pinterest_save_button_register_customize' );
function smntcs_pinterest_save_button_register_customize( $wp_customize ) {
	$wp_customize->add_section( 'pinterest_save_button_section', array(
		'title' 	=> __('Pinterest Save Button', 'smntcs-pinterest-save-button'),
		'priority' 	=> 150,
	));

	$wp_customize->add_setting( 'show_button_on_hover', array( 
		'default' 	=> false,
	));
	
	$wp_customize->add_control( 'show_button_on_hover', array(
		'label' 	=> __('Show button on hover', 'smntcs-pinterest-save-button'),
		'section' 	=> 'pinterest_save_button_section',
		'type' 		=> 'checkbox',
	));
	
	$wp_customize->add_setting( 'show_round_button', array(
		'default' 	=> false,
	));
	
	$wp_customize->add_control( 'show_round_button', array(
		'label' 	=> __('Show round button', 'smntcs-pinterest-save-button'),
		'section' 	=> 'pinterest_save_button_section',
		'type' 		=> 'checkbox',
	));
	
	$wp_customize->add_setting( 'show_large_button', array(
		'default' 	=> false,
	));
	
	$wp_customize->add_control( 'show_large_button', array(
		'label' 	=> __('Show large button', 'smntcs-pinterest-save-button'),
		'section' 	=> 'pinterest_save_button_section',
		'type' 		=> 'checkbox',
	));
}

// Enqueue Pinterest script
add_action('wp_footer', 'smntcs_pinterest_save_button_enqueue_pinterest_script');
function smntcs_pinterest_save_button_enqueue_pinterest_script() {
	if ( get_theme_mod('show_button_on_hover') == true ) {
		
		// Prepare standard button
		$script = '<script async defer data-pin-hover="true" data-pin-save="true" ';
		
		// Display round button (if requested)
		if ( get_theme_mod('show_round_button') == true ) $script .= 'data-pin-round="true" ';
		
		// Display large button (if requested)
		if ( get_theme_mod('show_large_button') == true ) $script .= 'data-pin-tall="true" ';
		
		// Finalize standard button
		$script .= 'src="//assets.pinterest.com/js/pinit.js"></script>';

		// Show Pinterest Save Button
		print($script);
	}
}