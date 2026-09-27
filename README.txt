=== SMNTCS Pinterest Save Button ===

Contributors:       nielslange
Tags:               pinterest, save button, pin it, social sharing, images
Requires at least:  4.7
Tested up to:       7.1
Requires PHP:       7.4
Stable tag:         2.1
License:            GPL v2 or later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html

Adds the Pinterest Save button to your images when visitors hover them, on the post types you choose.

== Description ==

SMNTCS Pinterest Save Button adds the official Pinterest Save button to the images on your site. The button appears when a visitor hovers an image, so your visitors can pin your pictures to their Pinterest boards.

= Features =

* Show the Save button when visitors hover an image
* Choose a round or a large button
* Choose the post types that show the button, for example only posts and not pages
* Turn the button off on the home page, archives, search results and profile pages
* Developers can use the smntcs_pinterest_save_button_display filter for full control

== Installation ==

1. Upload `smntcs-pinterest-save-button` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.
3. Go to `Appearance` » `Customize`.
4. Activate the Pinterest Save Button.
5. Adjust settings based on your needs.

== Frequently Asked Questions ==

= Can I show the button only on posts? =

Yes. Go to Appearance, then Customize, then Pinterest Save Button. Untick the post types that should not show the button, and untick "Show on all other pages" to hide it on the home page, archives and similar pages.

= Can I control where the button appears with code? =

Yes. Return false from the smntcs_pinterest_save_button_display filter to hide the button:

`add_filter( 'smntcs_pinterest_save_button_display', function ( $display ) { return is_singular( 'post' ) ? $display : false; } );`

== Screenshots ==

1. Upload and activate the plugin.
2. Open `Appearance → Customize`.
3. Adjust settings of Pinterest Save Button.

== Changelog ==

= 2.1 (2026.09.27) =

- Remove duplicated FAQ entries from the readme

= 2.0 (2026.09.26) =

- Test up to WordPress 7.1
- Update development dependencies and GitHub Actions
- Choose the post types that show the Save button
- Choose whether the button shows on the home page, archives and other pages
- Add the smntcs_pinterest_save_button_display filter
- Add a settings link to the plugins page
- Load the Pinterest script over HTTPS

= 1.9 (2026.08.14) =

- Test up to WordPress 7.0

= 1.8 (2025.03.23) =

- Test up to WordPress 6.8

= 1.7 (2023.12.24) =

- Test up to WordPress 6.4

= 1.6 (2022.12.03) =

- Test up to WordPress 6.1

= 1.5 (2020.01.02) =

- Test up to WordPress 5.3

= 1.4 (2019.12.30) =

- Test up to WordPress 5.2

= 1.3 (2019.06.30) =

- Test up to WordPress 5.1

= 1.2 (2019.02.19) =

- Correct text domain

= 1.1 (2019.01.14) =

- Add text domain

= 1.0 (2016.07.20) =

- Initial release
