<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.1
 * @package    System_One
 * @subpackage System_One/includes
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_Deactivator {

	/**
	 * Delete plugin options.
	 *
	 * @since 0.1
	 */
	public static function deactivate() {

		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		// Delete plugin option.
		delete_option( 'system-one' );
	}

}
