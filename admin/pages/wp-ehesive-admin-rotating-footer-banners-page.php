<?php

/**
 * Provide a admin area view for Rotating footer banners page the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.0
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/admin/partials
 */
?>

<?php
	$all_zones = Wp_Ehesive_Admin::get_wp_ehesive_zones();
	$rotating_direction = array(
		0 => 'left',
		1 => 'right',
	);
?>

<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-header-panel.php'; ?>

<div class="nav-tab-wrapper">
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_page">General</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_shortcode">Generate shortcode</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_flying">Flying banner</a>
	<a class="nav-tab nav-tab-active" href="admin.php?page=wp_ehesive_settings_rotating_footer">Rotating banners</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings">Settings</a>
	<span class="nav-tab-ver"><?php echo 'V.' . WP_EHESIVE_VERSION; ?></span>
</div>

<div class="wrap">
	<div class="postbox-container content">
		<form method="post" action="options.php">
			<?php
					settings_fields( 'wp-ehesive-rotating-banner' );
					$wp_ehesive_rotating_banner_zone_id = get_option('wp_ehesive_rotating_banner_zone_id');
			?>
			<table class="form-table">
				<thead>
					<tr valign="top">
						<th scope="row" class="required">Select zone</th>
						<td>
							<select name="wp_ehesive_rotating_banner_zone_id" id="wp_ehesive_rotating_banner_zone_id">
								<option value="">Select a zone</option>
								<?php
									foreach ( $all_zones['data'] as $key => $zone_id ) {
										if ( $zone_id['zone_width'] > 300) {
											continue;
										}
										if ( $zone_id['zone_height'] > 50) {
											continue;
										}

										$selected_network = $wp_ehesive_rotating_banner_zone_id == $zone_id['id'] ? 'selected' : '';
										echo '<option data-width="'.$zone_id['zone_width'].'"
																	data-height="'.$zone_id['zone_height'].'"
																	value="'.$zone_id['id'].'"
																	'.$selected_network.'>'
																	.$zone_id['name'].' - '.$zone_id['zone_type'].
												 '</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</thead>
				<tbody id="rotating_banner_body" style="<?php if ( empty( $wp_ehesive_rotating_banner_zone_id ) ) { echo 'display: none;';} ?>">

					<tr>
						<th scope="row">Enable/Disable</th>
						<td>
							<input type="checkbox" name="wp_ehesive_rotating_banner_is_active" id="wp_ehesive_rotating_banner_is_active" value="yes" <?php if ( get_option('wp_ehesive_rotating_banner_is_active') == 'yes' ) { echo 'checked'; } ?> />
						</td>
					</tr>

					<tr>
						<th scope="row">Exclude pages</th>
						<td>
							<input type="text" name="wp_ehesive_rotating_banner_exclude_pages" id="wp_ehesive_rotating_banner_exclude_pages" value="<?php echo get_option('wp_ehesive_rotating_banner_exclude_pages'); ?>" />
							<p class="description">Enter page IDs separated by commas</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Rotating speed</th>
						<td>
							<input type="text" name="wp_ehesive_rotating_banner_speed" id="wp_ehesive_rotating_banner_speed" value="<?php echo get_option('wp_ehesive_rotating_banner_speed'); ?>" />
							<p class="description">The rotating speed in pixels per second, defaults to 30</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Rotating direction</th>
						<td>
							<select name="wp_ehesive_rotating_banner_direction" id="wp_ehesive_rotating_banner_direction">
								<?php
									foreach ( $rotating_direction as $direction ) {
										$selected_direction = get_option('wp_ehesive_rotating_banner_direction') == $direction ? 'selected' : '';
										echo '<option value="'.$direction.'"
																	'.$selected_direction.'>'
																	.$direction.
												 '</option>';
									}
								?>
							</select>
							<p class="description">The rotating direction, defaults to left (available: left, right)</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Cycles of rotation</th>
						<td>
							<input type="text" name="wp_ehesive_rotating_banner_cycles" id="wp_ehesive_rotating_banner_cycles" value="<?php echo get_option('wp_ehesive_rotating_banner_cycles'); ?>" />
							<p class="description">Number of cycles before pausing, defaults to 1 (pass 0 to cycle continously)</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Cycles delay</th>
						<td>
							<input type="text" name="wp_ehesive_rotating_banner_delay" id="wp_ehesive_rotating_banner_delay" value="<?php echo get_option('wp_ehesive_rotating_banner_delay'); ?>" />
							<p class="description">The delay between each cycle in ms, defaults to 2000</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Space between duplicated</th>
						<td>
							<input type="text" name="wp_ehesive_rotating_banner_space" id="wp_ehesive_rotating_banner_space" value="<?php echo get_option('wp_ehesive_rotating_banner_space'); ?>" />
							<p class="description">The space in px between the duplicated contents, defaults to 40</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Handle hover</th>
						<td>
							<select name="wp_ehesive_rotating_banner_handle_hover" id="wp_ehesive_rotating_banner_handle_hover">
								<?php
									$handle_hover_arr = array('yes', 'no');
									foreach ( $handle_hover_arr as $hover ) {
										$handle_hover = get_option('wp_ehesive_rotating_banner_handle_hover') == $hover ? 'selected' : '';
										echo '<option value="'.$hover.'"
																	'.$handle_hover.'>'
																	.$hover.
												 '</option>';
									}
								?>
							</select>
							<p class="description">Pause/restart on hover</p>
						</td>
					</tr>

				</tbody>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Submit') ?>" />
			</p>

		</form>
	</div>
	<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-sidebar.php'; ?>

</div>