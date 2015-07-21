<?php 

/*
Plugin Name: Astrofoni
Plugin URI: ww.astrofoni.com
Description: Dünyanın en büyük astroloji servisi
Version: 1.0
Author: barisoner.com
Author URI: http://barisoner.com/
Text Domain: astrofoni
*/

/*
 * Global değişkenkler
 */
$plugin_url = WP_PLUGIN_URL . '/wpastrofoni';
$options = array();
$display_json = true;
$site_url = network_site_url();

/*
 * Admin menüsünü 'Settings' altında gösteriyorum
 */

function wpastrofoni_menu() {

	add_options_page (
		'Astrofoni Wordpress Plugini',
		'Astrofoni',
		'manage_options',
		'wpastrofoni',
		'wpastrofoni_options_page'
		);
}
add_action('admin_menu','wpastrofoni_menu');

function wpastrofoni_options_page() {

	if (!current_user_can('manage_options')) {
		wp_die('Bu alana girmeye yetkiniz yok.');
	}

	global $plugin_url;
	global $options;
	global $display_json;
	global $site_url;
	

	if (isset($_POST['wpastrofoni_form_submitted'])) {
		$hidden_field = esc_html($_POST['wpastrofoni_form_submitted']);

		if ($hidden_field == 'Y') {
			$wpastrofoni_id = esc_html($_POST['wpastrofoni_id']);
			$wpastrofoni_profile =  wpastrofoni_get_profile($wpastrofoni_id);
			$options['wpastrofoni_id'] = $wpastrofoni_id;
			$options['wpastrofoni_profile'] = $wpastrofoni_profile;
			$options['last_updated'] = time();

			update_option('wpastrofoni', $options);

		}
	}
	$options = get_option('wpastrofoni');
	if ($options != '') {
		$wpastrofoni_id = $options['wpastrofoni_id'];
		$wpastrofoni_profile = $options['wpastrofoni_profile'];
	}
	
	require('inc/options_page_wrapper.php');
}

class Wpastrofoni_widget extends WP_Widget {

	function wpastrofoni_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Astrofoni Eklentisi' );
	}

	function widget( $args, $instance ) {
		// Widget output
		extract($args);
		$title = apply_filters('widget_ttle', $instance['title']);

		$options = get_option('wpastrofoni');
		$wpastrofoni_profile = $options['wpastrofoni_profile'];

		require('inc/front-end.php');
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$title = esc_attr($instance['title']);
		$selected_code = esc_attr($instance['title']);

		$options = get_option('wpastrofoni');
		$wpastrofoni_profile = $options['wpastrofoni_profile'];

		require('inc/widget-fields.php');
	}
}

function wpastrofoni_register_widgets() {
	register_widget( 'Wpastrofoni_widget' );
}

add_action( 'widgets_init', 'wpastrofoni_register_widgets' );


function wpastrofoni_get_profile($wpastrofoni_id) {
	$json_feed_url = 'http://widget.astrofoni.com/manage/access?id=' . $wpastrofoni_id . '&access_key=12345678';
	$args = array('timeout' => 120);

	$json_feed = wp_remote_get($json_feed_url, $args);

	$wpastrofoni_profile = json_decode($json_feed['body']);

	return $wpastrofoni_profile;

}

function wpastrofoni_styles () {
	//wp_enqueue_style('wpastrofoni_styles', plugin_url('wpastrofoni/style.css'));
}
add_action('admin_head', 'wpastrofoni_styles');

?>