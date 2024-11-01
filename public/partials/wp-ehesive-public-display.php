<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.0
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/public/partials
 */
?>

<div id="wp_ehesive_flying_banner_wrapper" class="wp_ehesive_flying_banner_wrapper">
	<?php
		echo '<ins class="_ehb"
							 style="display:inline-block;width:'.get_option('wp_ehesive_flying_banner_width').';height:'.get_option('wp_ehesive_flying_banner_height').'"
							 data-ehid="EH-0.'.get_option('wp_ehesive_flying_banner_zone_id').'">
				 </ins>';
	?>
</div>