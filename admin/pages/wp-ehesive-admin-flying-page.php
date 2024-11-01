<?php

/**
 * Provide a admin area view for flying banner page the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.1
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/admin/partials
 */
?>

<?php
	$all_zones = Wp_Ehesive_Admin::get_wp_ehesive_zones();
	$positions_vertical = array(
		0 => 'top',
		1 => 'bottom',
	);
	$positions_horizontal = array(
		0 => 'left',
		1 => 'right',
	);
?>

<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-header-panel.php'; ?>

<div class="nav-tab-wrapper">
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_page">General</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_shortcode">Generate shortcode</a>
	<a class="nav-tab nav-tab-active" href="admin.php?page=wp_ehesive_settings_flying">Flying banner</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_rotating_footer">Rotating banners</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings">Settings</a>
	<span class="nav-tab-ver"><?php echo 'V.' . WP_EHESIVE_VERSION; ?></span>
</div>

<div class="wrap">
	<div class="postbox-container content">
		<form id="flying_banner" method="post" action="options.php">
			<?php
					settings_fields( 'wp-ehesive-flying-banner' );
					$position_horizontal_value = get_option('wp_ehesive_flying_banner_position_horizontal_value');
					$position_vertical_value = get_option('wp_ehesive_flying_banner_position_vertical_value');
					$wp_ehesive_flying_banner_zone_id = get_option('wp_ehesive_flying_banner_zone_id');
			?>
			<table class="form-table">
				<thead>
					<tr valign="top">
						<th scope="row" class="required">Select zone</th>
						<td>
							<select name="wp_ehesive_flying_banner_zone_id" id="wp_ehesive_flying_banner_zone_id">
								<option value="">Select a zone</option>
								<?php
									foreach ( $all_zones['data'] as $key => $zone_id ) {
										if ( $zone_id['zone_width'] > 728) {
											continue;
										}
										if ( $zone_id['zone_height'] > 250) {
											continue;
										}

										$selected_network = $wp_ehesive_flying_banner_zone_id == $zone_id['id'] ? 'selected' : '';
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
				<tbody id="flying_banner_body" style="<?php if ( empty( $wp_ehesive_flying_banner_zone_id ) ) { echo 'display: none;';};?>">

					<tr>
						<th scope="row">Enable/Disable</th>
						<td>
							<input type="checkbox" name="wp_ehesive_flying_banner_is_active" id="wp_ehesive_flying_banner_is_active" value="yes" <?php if ( get_option('wp_ehesive_flying_banner_is_active') == 'yes' ) { echo 'checked'; } ?> />
						</td>
					</tr>

					<tr>
						<th scope="row">Time offset</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_time_offset" id="wp_ehesive_flying_banner_time_offset" value="<?php echo get_option('wp_ehesive_flying_banner_time_offset'); ?>" />
							<p class="description">After what period of time should I show the banner? The value is in seconds.</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Time offset for the button close.</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_offset_close" id="wp_ehesive_flying_banner_offset_close" value="<?php echo get_option('wp_ehesive_flying_banner_offset_close'); ?>" />
							<p class="description">After what period of time should the user close the banner? The value is in seconds.</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Vertical position</th>
						<td>
							<select name="wp_ehesive_flying_banner_position_vertical" id="wp_ehesive_flying_banner_position_vertical">
								<option value="">Select position</option>
								<?php
									foreach ($positions_vertical as $position_v) {
										$selected_network = get_option('wp_ehesive_flying_banner_position_vertical') == $position_v ? 'selected' : '';
										echo '<option value="'.$position_v.'"
																	'.$selected_network.'>'
																	.$position_v.
												 '</option>';
									}
								?>
							</select>
							<p class="description">The vertical position of the banner relative to the browser window. Default: bottom.</p>
						</td>
					</tr>

					<tr id="vertical_value" style="<?php if ( empty($position_vertical_value) ) { echo 'display: none;';}?>">
						<th scope="row">Vertical position value</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_position_vertical_value" id="wp_ehesive_flying_banner_position_vertical_value" value="<?php echo $position_horizontal_value; ?>"/>
							<p class="description">Vertical banner position value, example: 5px or 5%. Default: 0px.</p>
						</td>
					</tr>

					<tr>
						<th scope="row">Horizontal position</th>
						<td>
							<select name="wp_ehesive_flying_banner_position_horizontal" id="wp_ehesive_flying_banner_position_horizontal">
								<option value="">Select position</option>
								<?php
									foreach ( $positions_horizontal as $position_h ) {
										$selected_network = get_option('wp_ehesive_flying_banner_position_horizontal') == $position_h ?
																				'selected' : '';

										echo '<option value="'.$position_h.'"
																	'.$selected_network.'>'
																	.$position_h.
												 '</option>';
									}
								?>
							</select>
							<p class="description">The horizontal position of the banner relative to the browser window. Default: right.</p>
						</td>
					</tr>

					<tr id="horizontal_value" style="<?php if ( empty( $position_horizontal_value ) ) { echo 'display: none;'; } ?>">
						<th scope="row">Horizontal position value</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_position_horizontal_value" id="wp_ehesive_flying_banner_position_horizontal_value" value="<?php echo get_option('wp_ehesive_flying_banner_position_horizontal_value'); ?>" />
							<p class="description">Horizontal banner position value, example: 5px or 5%. Default: 0px.</p>
						</td>
					</tr>

					<tr>
						<th scope="row" class="required">Container size width</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_width" id="wp_ehesive_flying_banner_width" value="<?php echo get_option('wp_ehesive_flying_banner_width'); ?>" />
							<p class="description">Custom inline css code for the block. Example: border: 1px solid #000;</p>
						</td>
					</tr>

					<tr>
						<th scope="row" class="required">Container size height</th>
						<td>
							<input type="text" name="wp_ehesive_flying_banner_height" id="wp_ehesive_flying_banner_height" value="<?php echo get_option('wp_ehesive_flying_banner_height'); ?>" />
							<p class="description">Copy this code and paste it into the post or page.</p>
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