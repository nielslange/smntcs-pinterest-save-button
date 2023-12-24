<?php
/**
 * Plugin Name:           SMNTCS Pinterest Save Button
 * Plugin URI:            https://github.com/nielslange/smntcs-pinterest-save-button
 * Description:           Adds a Pinterest Save Button to your images that becomes visible when a visitor hovers the image.
 * Author:                Niels Lange
 * Author URI:            https://nielslange.de
 * Text Domain:           smntcs-pinterest-save-button
 * Version:               1.7
 * Requires PHP:          5.6
 * Requires at least:     3.4
 * License:               GPL v2 or later
 * License URI:           https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SMNTCS_Pinterest_Save_Button
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Load plugin classes.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-smntcs-pinterest-save-button.php';
