<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    System_One
 * @subpackage System_One/admin
 * @author     Cedric Puchalver <cedric.puchalver@gmail.com>
 */
class System_One_Admin {

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
	 * @since    0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1
	 * @param string $plugin_name    The name of this plugin.
	 * @param string $version        The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 0.1.2
	 * @param string $hook_suffix    The page hook suffix.
	 */
	public function enqueue_scripts( $hook_suffix ) {

		// Only register if we are on the plugin settings page.
		if ( 'toplevel_page_system-one' === $hook_suffix ) {

			// Use minified libraries if SCRIPT_DEBUG is turned off.
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/system-one-admin' . $suffix . '.js', array(), $this->version, true );
		}
	}

	/**
	 * Register the admin menu into the WordPress Dashboard menu.
	 *
	 * @since 0.1
	 */
	public function add_plugin_admin_menu() {
		add_menu_page(
			'System One',
			'System One',
			'manage_options',
			'system-one',
			array( $this, 'display_plugin_setup_page' ),
			plugin_dir_url( __FILE__ ) . 'images/logo.png',
			90
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since 0.1
	 * @param array $links    Array of links.
	 */
	public function add_plugin_action_links( $links ) {

		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=system-one' ) . '">' . __( 'Settings', 'system-one' ) . '</a>',
		);

		return array_merge( $settings_link, $links );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 0.1
	 */
	public function display_plugin_setup_page() {
		include_once 'partials/system-one-admin-display.php';
	}

	/**
	 * Validate fields from admin area plugin settings form.
	 *
	 * @param  mixed $input as field form settings form.
	 * @return mixed as validated fields
	 */
	public function validate( $input ) {

		$new_input = array();

		$new_input['username']     = ( isset( $input['username'] ) && ! empty( $input['username'] ) ) ? sanitize_text_field( $input['username'] ) : '';
		$new_input['enable_cache'] = ( isset( $input['enable_cache'] ) && ! empty( $input['enable_cache'] ) ) ? true : false;

		$system_one = new System_One_Api( $new_input['username'] );
		$response   = $system_one->get();

		if ( ! isset( $response ) ) {
			$new_input['username'] = '';
			add_settings_error( $this->plugin_name, 'username', 'Invalid username.', 'error' );
		}

		return $new_input;

	}

	/**
	 * Register plugin settings.
	 */
	public function register_plugin_options() {
		register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate' ) );
	}

	/**
	 * Clear plugin cache.
	 *
	 * @since 0.1.2
	 */
	public function clear_system_one_cache() {
		global $wpdb;

		$table = $wpdb->options;
		$where = array(
			'option_name' => '_transient_system_one_cache_%',
		);
		$query = $wpdb->query(
			"DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%system_one_cache_%'"
		);

		die();
	}


}
