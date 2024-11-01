<?php

/**
 * Provide a public-facing view for rotating footer banners
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
<div class="wp-ehesive-rotating-banner-wrapper">
	<div class="wp-ehesive-rotating-banner-slider">
		<?php
		$len = 7;
			for ( $i = 0; $i < $len; $i++ ) {
				echo '<div class="wp-ehesive-rotating-banner-item">';
					echo '<ins class="_ehb"
										 style="display:inline-block;width:300px;height:50px"
										 data-ehid="EH-0.'.get_option('wp_ehesive_rotating_banner_zone_id').'">
							 </ins>';
				echo '</div>';
			}
		?>
	</div>
</div>