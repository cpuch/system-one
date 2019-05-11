<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    System_One
 * @subpackage System_One/public
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since  0.1
	 * @access private
	 * @var    string $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  0.1
	 * @access private
	 * @var    string $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1
	 * @param string $plugin_name       The name of the plugin.
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 0.1
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/system-one-public.css', array(), $this->version, 'all' );
	}


	/**
	 * Display the plugin shortcode.
	 *
	 * @since 0.1
	 * @param array $atts    User defined attributes in shortcode tag.
	 */
	public function shortcode_function( $atts ) {

		/**
		 * Combine user attributes with known attributes and fill in defaults when needed.
		 *
		 * The pairs should be considered to be all of the attributes which are supported
		 * by the caller and given as a list. The returned attributes will only contain
		 * the attributes in the $pairs list.
		 *
		 * If the $atts list has unsupported attributes, then they will be ignored
		 * and removed from the final returned list.
		 *
		 * @param  array  $pairs        Entire list of supported attributes and their defaults.
		 * @param  array  $atts         User defined attributes in shortcode tag.
		 * @param  string $shortcode    The name of the shortcode.
		 * @return array
		 *
		 * @link https://codex.wordpress.org/Function_Reference/shortcode_atts
		 */
		$args = shortcode_atts(
			array(
				'id' => null,
			),
			$atts,
			$this->plugin_name
		);

		// Set the System One artist ID.
		if ( ! empty( $args['id'] ) ) {
			$id = $args['id'];
		} else {
			$id = false;
		}

		// Send the request to System One API.
		$options    = get_option( 'system-one' );
		$system_one = new System_One_Api( $options['username'] );
		$response   = $system_one->get( $id );

		if ( isset( $response ) && empty( $response['data'] ) ) {
			return '<p>No shows found.</p>';
		} else {
			$shows = $response['data'];
			ob_start();
			include_once 'partials/system-one-public-shortcode.php';
			return ob_get_clean();
		}

	}

}