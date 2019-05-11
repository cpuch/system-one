<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1
 * @package    System_One
 * @subpackage System_One/includes
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'system-one',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
