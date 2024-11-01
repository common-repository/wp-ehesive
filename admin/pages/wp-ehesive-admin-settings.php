<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.1
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/admin/pages
 */
?>

<?php
	require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-header-panel.php';
?>
<div class="nav-tab-wrapper">
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_page">General</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_shortcode">Generate shortcode</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_flying">Flying banner</a>
	<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_rotating_footer">Rotating banners</a>
	<a class="nav-tab nav-tab-active" href="admin.php?page=wp_ehesive_settings">Settings</a>
	<span class="nav-tab-ver"><?php echo 'V.' . WP_EHESIVE_VERSION; ?></span>
</div>

<div class="wrap">
	<div class="postbox-container content">
		<form id="general-settings-form" method="post" action="options.php">
			<?php settings_fields('wp-ehesive-settings'); ?>

			<table class="form-table">

				<tr>
					<th scope="row">eHESIVE analytics</th>
					<td>
						<input type="checkbox" id="wp_ehesive_analytic_on" name="wp_ehesive_analytic_on" value="1" <?php checked( get_option('wp_ehesive_analytic_on') ) ?> />
						<p class="description">Collect site analytics.</p>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Submit') ?>" />
			</p>

		</form>
	</div>

	<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-sidebar.php'; ?>

	<div id="overlay"></div>
</div>