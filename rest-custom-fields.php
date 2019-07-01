<?php
/**
 * Plugin Name: Rest Custom Fields
 * Plugin URI:  https://github.com/LesterGallagher/rest-custom-fields
 * Description: Exposes Custom Meta Fields from pages on rest api.
 * Version:     0.1.0
 * Author:      Sem Postma
 * Author URI:  http://github.com/LesterGallagher
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: rest-custom-fields
 *
 * @since 1.0
 */


/*

The MIT License (MIT)

Copyright (c) 2019 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Simple_Jwt_Authentication {

	protected $plugin_name;
	protected $plugin_version;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		$this->plugin_name    = 'rest-custom-fields';
		$this->plugin_version = '0.1.0';

		// Load all dependency files.
		$this->load_dependencies();

		// Activation hook
		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		// Deactivation hook
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// Localization
		// add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Loads all dependencies in our plugin.
	 *
	 * @since 1.0
	 */
	public function load_dependencies() {

		// // Load all Composer dependencies
		// $this->include_file( 'vendor/autoload.php' );
		// $this->include_file( 'class-simple-jwt-authentication-api.php' );

		// // Admin specific includes
		// if ( is_admin() ) {
		// 	$this->include_file( 'admin/class-simple-jwt-authentication-settings.php' );
		// 	$this->include_file( 'admin/class-simple-jwt-authentication-profile.php' );
		// }

		// $this->include_file( 'class-simple-jwt-authentication-rest.php' );

		$this->include_file( 'rest-api.php' );
	}

	/**
	 * Includes a single file located inside /includes.
	 *
	 * @param string $path relative path to /includes
	 * @since 1.0
	 */
	private function include_file( $path ) {
		$plugin_name    = $this->plugin_name;
		$plugin_version = $this->plugin_version;

		$includes_dir = trailingslashit( plugin_dir_path( __FILE__ ) . 'includes' );
		if ( file_exists( $includes_dir . $path ) ) {
			include_once $includes_dir . $path;
		}
	}

	/**
	 * The code that runs during plugin activation.
	 *
	 * @since    1.0
	 */
	public function activate() {

	}

	/**
	 * The code that runs during plugin deactivation.
	 *
	 * @since    1.0
	 */
	public function deactivate() {

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0
	 */
	public function load_textdomain() {

		load_plugin_textdomain(
			'rest-custom-fields',
			false,
			basename( dirname( __FILE__ ) ) . '/languages/'
		);

	}

}

/**
 * Begins execution of the plugin.
 *
 * @since    1.0
 */
new Simple_Jwt_Authentication();
