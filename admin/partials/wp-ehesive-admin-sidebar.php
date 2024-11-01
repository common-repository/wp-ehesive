<?php

/**
 * Provide a admin area view for the plugin
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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="postbox-container aside">
	<div id="side-sortables" class="meta-box-sortables ui-sortable">
		<div class="postbox">
			<div class="inside">
				<a class="right-sidebar-btn" href="https://www.ehesive.com/" target="_blank">Go to eHESIVE site</a>
				<?php
					if ( Wp_Ehesive_Admin::is_isset_site_option() ) :
						$site_stats_arg = '&id=' . get_option('wp_ehesive_site_id') . '&nt=' . get_option('wp_ehesive_network_type');
				?>
					<a class="right-sidebar-btn" href="https://secure.ehesive.com/?pg=stats<?php echo $site_stats_arg; ?>" target="_blank">Site analytics</a>
				<?php endif; ?>
				<a class="right-sidebar-btn" href="https://secure.ehesive.com/?pg=profile" target="_blank">Edit Account</a>
				<a class="right-sidebar-btn" href="https://secure.ehesive.com/?pg=contact" target="_blank">Contact Us</a>
			</div>
		</div>
	</div>
</div>