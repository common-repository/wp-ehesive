<?php

/**
 * Add the analytics code to the site.
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
<!-- eHesive Analytics code start -->
	<script>!function(e,n,t,c,d,s,a,i){a=n.createElement(t),i=n.getElementsByTagName("head")[0],a.async=1,a.defer=1,a.src=c,i.appendChild(a),a.onload=function(){b(d,n,a,s)}}(window,document,"script","<?php echo Wp_Ehesive_Admin::$analytic_url; ?>","<?php echo get_option('wp_ehesive_site_public_id'); ?>","<?php echo get_option('wp_ehesive_network_type'); ?>");</script>
<!-- eHesive Analytics code end -->