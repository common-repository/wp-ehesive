<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ehesive.com/
 * @since      1.0.4
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Ehesive
 * @subpackage Wp_Ehesive/admin
 * @author     ehesive <evgeniy@mciggroup.com>
 */
class Wp_Ehesive_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-ehesive-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-ehesive-admin.js', array( 'jquery' ), $this->version, false );
		$translation_array = array( 'templateUrl' => plugin_dir_url( __DIR__ ) );
		wp_localize_script( $this->plugin_name, 'plaginDir', $translation_array);

	}

	/**
	 * Adding customization pages
	 *
	 * @since    1.0.1
	 */
	public function wp_ehesive_create_menu() {

		add_menu_page(
			'eHESIVE',
			'eHESIVE',
			'administrator',
			'wp_ehesive_settings_page',
			array(
				$this,
				'wp_ehesive_settings_page'
			),
			plugin_dir_url( __FILE__ ) . '/images/Ehesive_16x16.ico'
		);
		
		if ( ! empty( get_option('wp_ehesive_network_type') ) && ! empty( get_option('wp_ehesive_site_id') ) ) {
			add_submenu_page(
				'wp_ehesive_settings_page',
				'Generate shortcode',
				'Generate shortcode',
				'administrator',
				'wp_ehesive_settings_shortcode',
				array(
					$this,
					'wp_ehesive_settings_shortcode',
				)
			);

			add_submenu_page(
				'wp_ehesive_settings_page',
				'Flying banner',
				'Flying banner',
				'administrator',
				'wp_ehesive_settings_flying',
				array(
					$this,
					'wp_ehesive_settings_flying',
				)
			);

			add_submenu_page(
				'wp_ehesive_settings_page',
				'Rotating banners',
				'Rotating banners',
				'administrator',
				'wp_ehesive_settings_rotating_footer',
				array(
					$this,
					'wp_ehesive_settings_rotating_footer',
				)
			);

			add_submenu_page(
				'wp_ehesive_settings_page',
				'Settings',
				'Settings',
				'administrator',
				'wp_ehesive_settings',
				array(
					$this,
					'wp_ehesive_settings',
				)
			);
		}
	}

	public function wp_ehesive_settings_page() {

		require_once plugin_dir_path( __FILE__ ) . '/pages/wp-ehesive-admin-general.php';

	}

	public function wp_ehesive_settings_shortcode() {

		require_once plugin_dir_path( __FILE__ ) . '/pages/wp-ehesive-admin-shortcode-page.php';

	}

	public function wp_ehesive_settings_flying() {

		require_once plugin_dir_path( __FILE__ ) . '/pages/wp-ehesive-admin-flying-page.php';

	}

	public function wp_ehesive_settings_rotating_footer() {

		require_once plugin_dir_path( __FILE__ ) . '/pages/wp-ehesive-admin-rotating-footer-banners-page.php';

	}

	public function wp_ehesive_settings() {

		require_once plugin_dir_path( __FILE__ ) . '/pages/wp-ehesive-admin-settings.php';

	}

	/**
	 * Register settings
	 *
	 * @since    1.0.1
	 */
	public function wp_ehesive_register_settings() {

		$settings_groups = array(
			'wp-ehesive-settings-group' => array(
				'api_secret', 'api_key', 'network_type', 'site_id', 'site_public_id', 'site_name',
				'disable_all_banners',
			),
			'wp-ehesive-flying-banner' => array(
				'flying_banner_zone_id', 'flying_banner_is_active', 'flying_banner_time_offset',
				'flying_banner_offset_close', 'flying_banner_position_vertical',
				'flying_banner_position_vertical_value', 'flying_banner_position_horizontal',
				'flying_banner_position_horizontal_value', 'flying_banner_width', 'flying_banner_height',
			),
			'wp-ehesive-rotating-banner' => array(
				'rotating_banner_zone_id', 'rotating_banner_is_active', 'rotating_banner_exclude_pages',
				'rotating_banner_speed', 'rotating_banner_direction', 'rotating_banner_cycles',
				'rotating_banner_space', 'rotating_banner_delay', 'rotating_banner_handle_hover',
				'rotating_banner_custom_css',
			),
			'wp-ehesive-settings' => array(
				'analytic_on',
			),
		);

		foreach ( $settings_groups as $group_k => $group ) {
			foreach ( $group as $g_value ) {
				register_setting( $group_k, 'wp_ehesive_' . $g_value );
			}
		}

	}

	/**
	* Adds one or more classes to the body tag in the dashboard.
	*
	* @param  String $classes Current body classes.
	* @return String          Altered body classes.
	*/
	public function add_wp_ehesive_admin_body_class( $classes ) {

		$screen = get_current_screen(); 
		if ( empty( $screen->id ) || strpos( $screen->id, 'ehesive' ) === false ) {
				return $classes;
		}

		return "$classes wp_ehesive_page ";

	}

	/**
	* Add a link to the settings page to the plugins list
	*
	* @param array $links array of links for the plugins, adapted when the current plugin is found.
	*
	* @return array $links
	*/
	public function add_wp_ehesive_action_links( $links, $file ) {

		$file = explode("/", $file);
		if ( $this->plugin_name == $file[0] ) {
			$settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=wp_ehesive_settings_page' ) ) . '">' . esc_html__( 'Settings', 'wp-ehesive' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	/**
	* Gets all available sites
	*/
	public static function get_wp_ehesive_sites() {
		$api_key = get_option('wp_ehesive_api_key');
		$secret = get_option('wp_ehesive_api_secret');

		if ( ! empty($api_key) && ! empty($secret) ) {
			$result = array();
			$result['data'] = array();

			foreach ( self::$network as $net_key => $net ) {

				$sign = "a=get_sites&k=" . $api_key . "&nt=" . $net_key;
				$sign = crypt( $sign, $secret );
				$sign = base64_encode($sign);

				$url = "https://secure.ehesive.com/ehesive_api/publisher_api/?a=get_sites";
				$url .= "&k=" . $api_key . "&nt=" . $net_key . "&s=" . $sign;

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);
				$json_content = curl_exec($curl);
				curl_close($curl);

				$pre_result = json_decode($json_content, true);

				$result['status'] = $pre_result['status'];
				$result['error'] = $pre_result['error'];

				if ( $result['status'] != 200 ) {
					if ( $result['status'] != 401) {
						$result = array(
							'status' => 500,
							'error' => 'Unknown error, please contact our support team.',
							'data' => array(),
						);
					} else {
						update_option('wp_ehesive_network_type', 0);
						update_option('wp_ehesive_site_id', 0);
						update_option('wp_ehesive_site_public_id', 0);
						update_option('wp_ehesive_flying_banner_zone_id', 0);
					}
					update_option('wp_ehesive_disable_all_banners', 1);
					return $result;
				}

				foreach ( $pre_result['data'] as $key => $site ) {
					$pre_result['data'][ $key ]['network_id'] = $net_key;
					$pre_result['data'][ $key ]['network'] = $net;
				}

				$result['data'] = array_merge( $result['data'], $pre_result['data'] );
				update_option('wp_ehesive_disable_all_banners', 0);
			}
		} else {
			$result = array(
				'status' => 401,
				'error' => 'Please authenticate with your ehesive.com account.',
				'data' => array(),
			);
			update_option('wp_ehesive_network_type', 0);
			update_option('wp_ehesive_site_id', 0);
			update_option('wp_ehesive_site_public_id', 0);
			update_option('wp_ehesive_flying_banner_zone_id', 0);
			update_option('wp_ehesive_disable_all_banners', 1);
		}

		return $result;
	}

	/**
	* Gets all available zones
	*/
	public static function get_wp_ehesive_zones() {
		$api_key = get_option('wp_ehesive_api_key');
		$secret = get_option('wp_ehesive_api_secret');
		$network = get_option('wp_ehesive_network_type');
		$site = get_option('wp_ehesive_site_id');

		$network = ! empty( $network ) ? $network : 1;

		$sign = "a=get_zones&k=" . $api_key . "&sid=" . $site . "&nt=" . $network;
		$sign = crypt($sign, $secret);
		$sign = base64_encode($sign);

		$url = "https://secure.ehesive.com/ehesive_api/publisher_api/?a=get_zones";
		$url .= "&k=" . $api_key . "&s=" . $secret . "&sid=" . $site . "&nt=" . $network . "&s=" . $sign;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$json_content = curl_exec($curl);
		curl_close($curl);

		$result = json_decode($json_content, true);

		return $result;
	}

	/**
	* Verify whether authentication is done
	*/
	public static function is_authenticate( $status ) {
		if ( ! empty( get_option('wp_ehesive_api_key') )
				&& !empty( get_option('wp_ehesive_api_secret') )
				&& $status == 200 ) {
			return true;
		}
		return false;
	}

	/**
	* Check whether the site is selected
	*/
	public static function is_isset_site_option() {
		if ( ! empty( get_option('wp_ehesive_network_type') )
				&& ! empty( get_option('wp_ehesive_site_id') ) ) {
			return true;
		}
		return false;
	}

	/**
	* List of network types
	*/
	public static $network = array(
		1 => 'Traditional',
		2 => 'Marijuana',
		3 => 'Mature',
		4 => 'Kryp Network',
	);

	/**
	* List of network addresses
	*/
	public static $network_url = array(
		1 => '//static-eh.ehesive.com',
		2 => '//static-eh.420cloud.com',
		3 => '//static-eh.adultgab.com',
		4 => '//static-eh.krypad.com',
	);

	public static $analytic_url = '//static-eh.ehesive.com/js/eha.js';

}