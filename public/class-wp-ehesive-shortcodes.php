<?php
/**
 * wp_ehesive_ads_shortcode
 */
class wp_ehesive_ads_shortcode {

	static function init () {
		add_shortcode('wp-ehesive-ads-shortcode', array(__CLASS__, 'wp_ehesive_ads_shortcode_func'));
	}

	static function wp_ehesive_ads_shortcode_func( $atts, $content ) {
		$shortcode_zone = isset($atts['zone']) ? $atts['zone'] : '';
		$shortcode_width = isset($atts['width']) ? $atts['width'] : '';
		$shortcode_height = isset($atts['height']) ? $atts['height'] : '';
		$shortcode_css = isset($atts['custom_css']) ? $atts['custom_css'] : '';

		if ( $shortcode_zone && empty( get_option('wp_ehesive_disable_all_banners') ) ) {
			$output = '<ins class="_ehb"
											style="display:inline-block;width:'.$shortcode_width.';height:'.$shortcode_height.';'.$shortcode_css.'"
											data-ehid="EH-0.'.$shortcode_zone.'">
								</ins>';
		}
		return $output;
	}
}
