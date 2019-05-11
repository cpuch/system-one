<?php
/**
 * Fired during plugin activation
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.1
 * @package    System_One
 * @subpackage System_One/includes
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_Activator {

	/**
	 * Set plugin default option values.
	 *
	 * @since 0.1
	 */
	public static function activate() {

		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		// Default values.
		$options = array(
			'username'       => '',
			'enable_cache'   => false,
		);
		add_option( 'system-one', $options );
	}

}
