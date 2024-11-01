<?php
/**
 * Ehesive ADS widget
 */
class Wp_Ehesive_ads_widget extends WP_Widget {

	/*
	 * construct
	 */
	function __construct() {
		parent::__construct(
			'wp_ehesive_ads_widget',
			'eHESIVE ADS', // title
			array( 'description' => 'Allows you to bring ADS to the right place.' )
		);
	}

	/*
	 * front
	 */
	public function widget( $args, $instance ) {
		if ( ! empty( $instance['zone'] ) && empty( get_option('wp_ehesive_disable_all_banners') ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			$user_id = 0;
			$zone = $instance['zone'];
			$width = $instance['width'];
			$height = $instance['height'];
			$custom_css = $instance['custom_css'];

			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo '<ins class="_ehb" style="display:inline-block;width:'.$width.';height:'.$height.';'.$custom_css.'" data-ehid="EH-0.'.$zone.'"></ins>';

			echo $args['after_widget'];
		}
	}

	/*
	 * admin
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ]) ? $instance[ 'title' ] : '';
		$zone = isset( $instance[ 'zone' ] ) ? $instance[ 'zone' ] : '';
		$width = isset( $instance[ 'width' ]) ? $instance[ 'width' ] : '';
		$height = isset( $instance[ 'height' ] ) ? $instance[ 'height' ] : '';
		$custom_css = isset( $instance[ 'custom_css' ] ) ? $instance[ 'custom_css' ] : '';

		$all_zones = Wp_Ehesive_Admin::get_wp_ehesive_zones( get_option('wp_ehesive_api_key'), get_option('wp_ehesive_api_secret'), get_option('wp_ehesive_site_id'), get_option('wp_ehesive_network_type') );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('zone'); ?>">Select zone:</label> 
			<select class="widefat shortcode_zone" name="<?php echo $this->get_field_name('zone'); ?>" id="<?php echo $this->get_field_id('zone'); ?>">
					<?php
						foreach ( $all_zones['data'] as $zone_id ) {
							$selected = $zone == $zone_id['id'] ? 'selected' : '';
							echo '<option data-width="'.$zone_id['zone_width'].'"
														data-height="'.$zone_id['zone_height'].'"
														value="'.$zone_id['id'].'"'
														. $selected .'>'
														.$zone_id['name'].' - '.$zone_id['zone_type'].
									 '</option>';
						}
					?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Container size width</label> 
			<input class="widefat shortcode_width" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			<span>The width of the container. Example: 100px or 100%</span>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>">Container size height</label> 
			<input class="widefat shortcode_height" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			<span>The height of the container. Example: 100px or 100%</span>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('custom_css'); ?>">Custom css</label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id('custom_css'); ?>" name="<?php echo $this->get_field_name('custom_css'); ?>"><?php echo esc_attr( $custom_css ); ?></textarea>
			<span>Custom inline css code for the block. Example: border: 1px solid #000;</span>
		</p>
		<?php 
	}

	/*
	 * saving widget settings
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['zone'] = ( ! empty( $new_instance['zone'] ) ) ? strip_tags( $new_instance['zone'] ) : 0;
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
		$instance['custom_css'] = ( ! empty( $new_instance['custom_css'] ) ) ? strip_tags( $new_instance['custom_css'] ) : '';
		return $instance;
	}
}