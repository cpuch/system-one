<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/cpuch/
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/includes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    System_One
 * @subpackage System_One/includes
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_Api {

	/**
	 * The ID of this plugin.
	 *
	 * @since  0.1
	 * @access private
	 * @var    string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  0.1
	 * @access private
	 * @var    string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The System One username.
	 *
	 * @since  0.1
	 * @access private
	 * @var    string  $username    The System One username.
	 */
	private $username;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1
	 * @param string $username    The System One username.
	 */
	public function __construct( $username ) {

		$this->username = $username;

	}

	/**
	 * System One API only accepts GET request.
	 *
	 * @param string $artist       System One artist ID.
	 *
	 * @return false|array         The response or false on failure.
	 */
	public function get( $artist = false ) {

		$data = false;

		// Get plugin options.
		$options = get_option( 'system-one' );

		// Check if we have cached data.
		if ( $options['enable_cache'] ) {
			$data = get_transient( 'system_one_cache_' . $artist );
		}

		// Send a GET request to API.
		if ( false === $data ) {

			$url      = 'https://client.systemonesoftware.com/' . $this->username . '/json/';
			$response = wp_remote_get(
				esc_url(
					add_query_arg(
						array(
							'artist' => $artist,
						),
						$url
					)
				)
			);

			if ( is_wp_error( $response ) ) {
				return false;
			}

			// Convert the JSON body response into an array.
			if ( is_array( $response ) && ! empty( $response['body'] ) ) {
				$data = json_decode( wp_remote_retrieve_body( $response ), true );
			}

			// Set transient if cache is enabled.
			if ( $options['enable_cache'] ) {
				set_transient( 'system_one_cache_' . $artist, $data, 1 * HOUR_IN_SECONDS );
			}
		}

		return $data;

	}
}
