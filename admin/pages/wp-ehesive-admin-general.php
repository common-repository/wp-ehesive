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
 * @subpackage Wp_Ehesive/admin/partials
 */
?>

<?php
	require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-header-panel.php';
	$all_sites = Wp_Ehesive_Admin::get_wp_ehesive_sites();
	$all_network = Wp_Ehesive_Admin::$network;
?>
<div class="nav-tab-wrapper">
	<a class="nav-tab nav-tab-active" href="admin.php?page=wp_ehesive_settings_page">General</a>
	<?php if ( Wp_Ehesive_Admin::is_isset_site_option() && $all_sites['status'] == 200 ) : ?>
		<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_shortcode">Generate shortcode</a>
		<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_flying">Flying banner</a>
		<a class="nav-tab" href="admin.php?page=wp_ehesive_settings_rotating_footer">Rotating banners</a>
		<a class="nav-tab" href="admin.php?page=wp_ehesive_settings">Settings</a>
	<?php endif; ?>
	<span class="nav-tab-ver"><?php echo 'V.' . WP_EHESIVE_VERSION; ?></span>
</div>

<div class="wrap">
	<div class="postbox-container content">
		<?php if ( $all_sites['status'] != 200 ) : ?>
			<div class="notice">
				<?php if ( $all_sites['status'] == 500 ) : ?>
					<?php echo $all_sites['error'] . ' <a href="https://secure.ehesive.com/?pg=contact" target="_blank">Contact Us</a>'; ?>
				<?php else: ?>
					<?php echo $all_sites['error'] . ' <a href="https://secure.ehesive.com/?pg=publisher_api" target="_blank">view api</a>'; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<form id="general-settings-form" method="post" action="options.php">
			<?php settings_fields('wp-ehesive-settings-group'); ?>
			<input type="hidden" id="wp_ehesive_network_type" name="wp_ehesive_network_type" value="<?php echo get_option('wp_ehesive_network_type'); ?>" />
			<input type="hidden" id="wp_ehesive_site_id" name="wp_ehesive_site_id" value="<?php echo get_option('wp_ehesive_site_id'); ?>" />
			<input type="hidden" id="wp_ehesive_site_public_id" name="wp_ehesive_site_public_id" value="<?php echo get_option('wp_ehesive_site_public_id'); ?>" />
			<input type="hidden" id="wp_ehesive_site_name" name="wp_ehesive_site_name" value="<?php echo get_option('wp_ehesive_site_name'); ?>" />
			<input type="hidden" id="wp_ehesive_api_key" name="wp_ehesive_api_key" value="<?php echo get_option('wp_ehesive_api_key'); ?>" />
			<input type="hidden" id="wp_ehesive_api_secret" name="wp_ehesive_api_secret" value="<?php echo get_option('wp_ehesive_api_secret'); ?>" />

			<table class="form-table">

				<tr>
					<th scope="row">eHESIVE Authenticate</th>
					<td>
						<?php if ( Wp_Ehesive_Admin::is_authenticate( $all_sites['status'] ) ) : ?>
							<a class="right-sidebar-btn modal-btn" href="https://secure.ehesive.com/" data-modal="#modal_authenticate" target="_blank">Re-Authenticate with your eHESIVE account</a>
						<?php else: ?>
							<a class="right-sidebar-btn modal-btn" href="https://secure.ehesive.com/" data-modal="#modal_authenticate" target="_blank">Authenticate with your eHESIVE account</a>
						<?php endif; ?>
					</td>
				</tr>

				<?php if ( Wp_Ehesive_Admin::is_authenticate( $all_sites['status'] ) ) : ?>
					<tr valign="top">
						<th scope="row">Site info</th>
						<td>
							<?php
								if ( Wp_Ehesive_Admin::is_isset_site_option() ) {
									echo '<p>Network type: '. $all_network[ get_option("wp_ehesive_network_type") ] .'</p>
											 <p>Site: '. get_option("wp_ehesive_site_name") .'</p>
											 <p><a href="#" data-modal="#modal_select_site" class="modal-btn">Click here to change site.</a></p>';
								} else {
									echo '<a href="#" data-modal="#modal_select_site" class="right-sidebar-btn modal-btn">Click here to choose a site.</a>';
								}
							?>
						</td>
					</tr>
				<?php endif; ?>
			</table>
		</form>
	</div>

	<?php require_once plugin_dir_path( __FILE__ ) . '../partials/wp-ehesive-admin-sidebar.php'; ?>

	<div id="modal_select_site" class="modal">
		<span id="modal_close" data-modal="#modal_select_site"><i class="fa fa-times" aria-hidden="true"></i></span>
		<ul id="sites" class="sites">
			<?php
				foreach ( $all_sites['data'] as $key => $site ) {
					echo '<li><label>
							 <input type="radio"
									id="site_'.$site["id"].'"
									class="site_radio" name="site"
									value="'.$site["id"].'"
									data-network="'.$site["network_id"].'"
									data-public-id="'.$site["public_id"].'"
									data-name="'.$site["name"].'">
							 Network: '.$site["network"]. ' | Site: '.$site["name"].
							 '</label></li>';
				}
			?>
		</ul>
		<a id="site-select" data-modal="#modal_select_site" href="" class="right-sidebar-btn">Select</a>
	</div>

	<div id="modal_authenticate" class="modal">
		<span id="modal_close" data-modal="#modal_authenticate"><i class="fa fa-times" aria-hidden="true"></i></span>
		<table class="form-table">
			<tr>
				<th scope="row">eHESIVE API Key</th>
			</tr>
			<tr>
				<td>
					<input type="text" id="api_key" name="api_key" value="<?php echo get_option('wp_ehesive_api_key'); ?>" />
				</td>
			</tr>

			<tr>
				<th scope="row">eHESIVE API Secret</th>
			</tr>
			<tr>
				<td>
					<input type="text" id="api_secret" name="api_secret" value="<?php echo get_option('wp_ehesive_api_secret'); ?>" />
				</td>
			</tr>
		</table>
		<a id="authenticate" data-modal="#modal_authenticate" href="" class="right-sidebar-btn">Authenticate</a>
	</div>

	<div id="overlay"></div>
</div>