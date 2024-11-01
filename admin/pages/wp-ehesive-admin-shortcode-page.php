<?php

/**
 * Provide a admin area view for shortcode page the plugin
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

<?php $all_zones = Wp_Ehesive_Admin::get_wp_ehesive_zones(); ?>

<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-header-panel.php'; ?>

<div class="nav-tab-wrapper">
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_page">General</a>
	<a class="nav-tab nav-tab-active" href="admin.php?page=wp_ehesive_settings_shortcode">Generate shortcode</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_flying">Flying banner</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_rotating_footer">Rotating banners</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings">Settings</a>
	<span class="nav-tab-ver"><?php echo 'V.' . WP_EHESIVE_VERSION; ?></span>
</div>

<div class="wrap">
	<div class="postbox-container content">
		<form method="post" action="options.php">
			<table class="form-table">

				<tr valign="top">
					<th scope="row" class="required">Select zone</th>
					<td>
						<select name="shortcode_zone" id="shortcode_zone">
							<?php
								foreach ( $all_zones['data'] as $key => $zone_id ) {
									echo '<option data-width="'.$zone_id['zone_width'].'"
																data-height="'.$zone_id['zone_height'].'"
																value="'.$zone_id['id'].'">'
																.$zone_id['name'].' - '.$zone_id['zone_type'].
											 '</option>';
								}
							?>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row" class="required">Container size width</th>
					<td>
						<input type="text" name="shortcode_width" id="shortcode_width" value="<?php if ( sizeof( $all_zones['data'] ) ) { echo $all_zones['data'][0]['zone_width'] . "px"; } ?>" />
						<p class="description">The width of the container. Example: 100px or 100%</p>
					</td>
				</tr>

				<tr>
					<th scope="row" class="required">Container size height</th>
					<td>
						<input type="text" name="shortcode_height" id="shortcode_height" value="<?php if ( sizeof( $all_zones['data'] ) ) { echo $all_zones['data'][0]['zone_height'] . "px"; } ?>" />
						<p class="description">Height of the container. Example: 100px or 100%</p>
					</td>
				</tr>

				<tr>
					<th scope="row">Custom css</th>
					<td>
						<textarea name="custom_css" id="custom_css" cols="30" rows="10"></textarea>
						<p class="description">Custom inline css code for the block. Example: border: 1px solid #000;</p>
					</td>
				</tr>

				<tr id="shortcode-result-row">
					<th scope="row">Shortcode</th>
					<td>
						<textarea name="result-shortcode" id="result-shortcode" class="result-shortcode" cols="30" rows="10" disabled></textarea>
						<button id="copy-to-clipboard" class="button-primary copy-to-clipboard" type="button">Copy <span class="dashicons dashicons-yes copy-to-clipboard-done"></span></button>
						<p class="description">Copy this code and paste it into the post or page.</p>
					</td>
				</tr>

			</table>
			
			<p class="submit">
				<input type="button" id="generate-shortcode" class="button-primary" value="<?php _e('Generate Shortcode') ?>" />
			</p>

		</form>
	</div>
	<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-sidebar.php'; ?>

</div>