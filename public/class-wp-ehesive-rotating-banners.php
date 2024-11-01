<?php
/**
 * Ehesive rotating footer banners
 */
class Wp_Ehesive_rotating_banner {

	public function init ( $plugin_name ) {
		$this->rotating_banner_view();
		if ( wp_script_is( $plugin_name . '_jquery.simplemarquee', $list = 'enqueued' ) ) {
			wp_add_inline_script( $plugin_name . '_jquery.simplemarquee', $this->rotating_banner_script(), 'after' );
		}
	}

	/*
	 * front
	 */
	public function rotating_banner_view() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-ehesive-public-rotating-footer-banners-display.php';
	}

	/*
	 * Setups the marquee with the given options.
	 */
	public function rotating_banner_script() {
		$js_str  = 'jQuery( window ).load( function() {';
			$js_str .= 'jQuery("body").css( "paddingBottom", "50px");';
			$js_str .= 'jQuery(".wp-ehesive-rotating-banner-slider").simplemarquee({';

			if ( get_option('wp_ehesive_rotating_banner_speed') != '' ) {
				$js_str .= 'speed: ' . get_option('wp_ehesive_rotating_banner_speed') . ',';
			}
			if ( get_option('wp_ehesive_rotating_banner_direction') != '' ) {
				$js_str .= 'direction: "' . get_option('wp_ehesive_rotating_banner_direction') . '",';
			}
			if ( get_option('wp_ehesive_rotating_banner_cycles') != '' ) {
				$cycles = get_option('wp_ehesive_rotating_banner_cycles');
				if ( $cycles == 0 ) {
					$js_str .= 'cycles: Infinity,';
				} else {
					$js_str .= 'cycles: ' . get_option('wp_ehesive_rotating_banner_cycles') . ',';
				}
			}
			if ( get_option('wp_ehesive_rotating_banner_space') != '' ) {
				$js_str .= 'space: ' . get_option('wp_ehesive_rotating_banner_space') . ',';
			}
			if ( get_option('wp_ehesive_rotating_banner_delay') != '' ) {
				$js_str .= 'delayBetweenCycles: ' . get_option('wp_ehesive_rotating_banner_delay') . ',';
			}
			if ( get_option('wp_ehesive_rotating_banner_handle_hover') == 'yes' ) {
				$js_str .= 'handleHover: true,';
			} else {
				$js_str .= 'handleHover: false,';
			}
			$js_str .= 'handleResize: false';
			$js_str .= '});';
		$js_str .= '});';
		return $js_str;
	}
}