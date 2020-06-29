<?php
/**
 * Provide a public-facing view for the plugin shortcode
 *
 * @link       https://github.com/cpuch
 * @since      0.1
 *
 * @package    System_One
 * @subpackage System_One/public/partials
 */

?>
<table id="system-one-table">
	<thead>
		<tr>
			<th>Date</th>
			<th>Artist</th>
			<th>Venue</th>
			<th>City</th>
			<th>Country</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $shows as $show ) : ?>
		<tr>
			<td><?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $show['date']['value'] ) ) ); ?></td>
			<td><?php echo esc_attr( $show['artist']['name'] ); ?></td>
			<td><?php echo esc_attr( $show['venue']['name'] ); ?></td>
			<td><?php echo esc_attr( $show['venue']['city'] ); ?></td>
			<td><?php echo esc_attr( $countries[ $show['venue']['country'] ] ); ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table><!-- #system-one-table -->
