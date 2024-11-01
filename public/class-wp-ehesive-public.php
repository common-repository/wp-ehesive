<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.0
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/public
 * @author     ehesive <evgeniy@mciggroup.com>
 */
class Wp_Ehesive_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-ehesive-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-ehesive-public.js', array( 'jquery' ), $this->version, false );
		$network = get_option('wp_ehesive_network_type');

		if ( ! empty($network) && empty( get_option('wp_ehesive_disable_all_banners') ) ) {
			$link = Wp_Ehesive_Admin::$network_url[$network];
			wp_enqueue_script( $this->plugin_name . '_ehb', $link . '/js/ehb.js', array( 'jquery' ), $this->version, true );
		}

		if ( ! empty( get_option('wp_ehesive_rotating_banner_zone_id') )
				&& empty( get_option('wp_ehesive_disable_all_banners') )
				&& get_option('wp_ehesive_rotating_banner_is_active') == 'yes'
				&& $this->wp_ehesive_rotating_banner_exludet_pages() ) {
			wp_enqueue_script( $this->plugin_name . '_jquery.simplemarquee', plugin_dir_url( __FILE__ ) . '/js/jquery.simplemarquee.js', array( 'jquery' ), $this->version, true );
		}
	}

	public function wp_ehesive_widgets_load() {
		if ( ! empty( get_option('wp_ehesive_site_id') ) && empty( get_option('wp_ehesive_disable_all_banners') ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-ehesive-widget.php';
			register_widget( 'Wp_Ehesive_ads_widget' );
		}
	}

	public function wp_ehesive_flying_banner() {
		if ( ! empty( get_option('wp_ehesive_flying_banner_zone_id') )
				&& empty( get_option('wp_ehesive_disable_all_banners') )
				&& get_option('wp_ehesive_flying_banner_is_active') == 'yes' ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-ehesive-public-flying-banner-display.php';
		}
	}

	public function wp_ehesive_rotating_banner() {
		if ( ! empty( get_option('wp_ehesive_rotating_banner_zone_id') )
				&& empty( get_option('wp_ehesive_disable_all_banners') )
				&& get_option('wp_ehesive_rotating_banner_is_active') == 'yes'
				&& $this->wp_ehesive_rotating_banner_exludet_pages() ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-ehesive-rotating-banners.php';
			$rotating_banner = new Wp_Ehesive_rotating_banner();
			$rotating_banner->init( $this->plugin_name );
		}
	}

	public function wp_ehesive_rotating_banner_exludet_pages() {
		$exludet_pages = ! empty( get_option('wp_ehesive_rotating_banner_exclude_pages') ) ?
										 preg_split("/[\s,]+/", get_option('wp_ehesive_rotating_banner_exclude_pages')) :
										 array();
		if ( ! in_array( get_the_ID(), $exludet_pages ) ) {
			return true;
		}
		return false;
	}

	public function wp_ehesive_analytic_code() {
		if ( get_option('wp_ehesive_analytic_on') == 1 ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-ehesive-public-analytic-code.php';
		}
	}
}