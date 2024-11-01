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

<?php
	$offset_close = get_option('wp_ehesive_flying_banner_offset_close') ?
									get_option('wp_ehesive_flying_banner_offset_close') : 0;

	$time_offset = get_option('wp_ehesive_flying_banner_time_offset') ?
								 get_option('wp_ehesive_flying_banner_time_offset') : 0;

	$position_vertical = get_option('wp_ehesive_flying_banner_position_vertical');
	$position_vertical_value = get_option('wp_ehesive_flying_banner_position_vertical_value');
	$position_horizontal = get_option('wp_ehesive_flying_banner_position_horizontal');
	$position_horizontal_value = get_option('wp_ehesive_flying_banner_position_horizontal_value');

	$banner_width = get_option('wp_ehesive_flying_banner_width') ?
									get_option('wp_ehesive_flying_banner_width') : '300px';
	$banner_height = get_option('wp_ehesive_flying_banner_height') ?
									 get_option('wp_ehesive_flying_banner_height') : '250px';
	$close_text = '';

	switch ( $position_vertical ) {
		case 'top':
			$position_vertical = ! empty( $position_vertical_value ) ? 'top:'.$position_vertical_value.';' : 'top: 0;';
			$close_text = 'in-buttom';
			break;
		case 'bottom':
			$position_vertical = ! empty( $position_vertical_value ) ? 'bottom:'.$position_vertical_value.';' : 'bottom: 0;';
			break;
		default:
			$position_vertical = 'bottom: 0;';
			break;
	}

	switch ( $position_horizontal ) {
		case 'left':
			$position_horizontal = ! empty( $position_horizontal_value ) ? 'left:'.$position_horizontal_value.';' : 'left: 0;';
			break;
		case 'right':
			$position_horizontal = ! empty( $position_horizontal_value ) ? 'right:'.$position_horizontal_value.';' : 'right: 0;';
			break;
		default:
			$position_horizontal = 'right: 0;';
			break;
	}

	$styles = $position_horizontal;
	$styles .= $position_vertical;
	$styles .= 'max-width:'.$banner_width.';'.'max-height:'.$banner_height.';';
	$styles .= 'display: none;';

?>

<div id="wp_ehesive_flying_banner_wrapper" class="wp_ehesive_flying_banner_wrapper" data-timeout="<?php echo $time_offset; ?>" data-close="<?php echo $offset_close; ?>" style="<?php echo $styles; ?>">
	<div class="flying-top <?php echo $close_text; ?>">
		<span class="close"></span>
	</div>
	<?php
		echo '<ins class="_ehb"
							 style="display:inline-block;width:'.get_option('wp_ehesive_flying_banner_width').';height:'.get_option('wp_ehesive_flying_banner_height').'"
							 data-ehid="EH-0.'.get_option('wp_ehesive_flying_banner_zone_id').'">
				 </ins>';
	?>
</div>