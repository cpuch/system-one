<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<div class="wrap">
	<h2>System One Integration</h2>
	<div id="plugin-notice"></div>

	<form method="post" action="options.php">
	<?php
		// Grab all options.
		$options = get_option( $this->plugin_name );

		$username     = ( isset( $options['username'] ) && ! empty( $options['username'] ) ) ? esc_attr( $options['username'] ) : '';
		$enable_cache = ( isset( $options['enable_cache'] ) && ! empty( $options['enable_cache'] ) ) ? 1 : 0;
		$custom_css   = ( isset( $options['custom_css'] ) && ! empty( $options['custom_css'] ) ) ? esc_attr( $options['custom_css'] ) : '';

		settings_errors( $this->plugin_name );
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
	?>

		<table class="form-table">
			<tbody>
				<tr scope="row">
					<th>
						<label for="system-one-username"><?php esc_attr_e( 'Username', 'system-one' ); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" id="system-one-username" name="system-one[username]" value="<?php echo esc_attr( $username ); ?>" required />
						<p class="description"><?php esc_attr_e( 'Enter your System One agency username.', 'system-one' ); ?></p>
					</td>
				</tr>
				<tr scope="row">
					<th>
						<label for="system-one-enable_cache"><?php esc_attr_e( 'Enable cache', 'system-one' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="system-one-enable_cache" name="system-one[enable_cache]" value="1" <?php checked( $enable_cache, 1 ); ?> />
						<p class="description"><?php esc_attr_e( 'If enable, requests are cached for 1 hour.', 'system-one' ); ?></p>
						<p class="submit"><input type="button" class="button button-primary" name="clear-cache" value="<?php esc_attr_e( 'Clear Cache', 'system-one' ); ?>" /></p>
					</td>
				</tr>
				<tr scope="row">
					<th>
						<label for="system-one-custom_css"><?php esc_attr_e( 'Custom CSS', 'system-one' ); ?></label>
					</th>
					<td>
						<textarea class="widefat textarea" name="system-one[custom_css]" id="system-one-custom_css"><?php echo esc_attr( wp_unslash( $custom_css ) ); ?></textarea>
						<p class="description">Add your custom css.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php submit_button( __( 'Save Settings', 'system-one' ) ); ?>
	</form>
</div>
