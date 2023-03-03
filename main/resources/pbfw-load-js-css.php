<?php

//Add JS and CSS on Backend
add_action( 'admin_enqueue_scripts', 'PBFW_load_script_style_admin');
function PBFW_load_script_style_admin() {
  	wp_enqueue_style( 'PBFW_admin_style', PBFW_PLUGIN_DIR . '/assets/css/pbfw_admin_style.css', false, '1.0.0' );
  	wp_enqueue_script( 'PBFW_admin_script', PBFW_PLUGIN_DIR . '/assets/js/pbfw_admin_script.js', array( 'jquery', 'select2'), false, '1.0.0', true );
  	wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
  	wp_enqueue_style( 'woocommerce_admin_styles-css', WP_PLUGIN_URL. '/woocommerce/assets/css/admin.css',false,'1.0',"all");
  	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker-alpha', PBFW_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
    $badge_define = get_post_meta(get_the_ID() ,'badge_define',true );
    $pbfw_background=get_post_meta(get_the_ID(), 'pbfw_background' ,true );
    $pbfw_image_position=get_post_meta(get_the_ID(), 'pbfw_image_position' ,true );
    wp_localize_script('PBFW_admin_script', 'pbfwDATA', array(
    	'badge_define' => $badge_define,
    	'pbfw_background' =>  $pbfw_background,
    	'pbfw_image_position'=>$pbfw_image_position,
	));
}

//Add JS and CSS on Frontend
add_action( 'wp_enqueue_scripts',  'PBFW_load_script_style_front');
function PBFW_load_script_style_front() {
	wp_enqueue_style( 'PBFW_front_style', PBFW_PLUGIN_DIR . '/assets/css/pbfw_front_style.css', false, '1.0.0' );
}