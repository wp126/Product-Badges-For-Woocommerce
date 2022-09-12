<?php

add_action('admin_init', 'PBFW_check_plugin_state');
function PBFW_check_plugin_state() {
  	if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
    	set_transient( get_current_user_id() . 'pbfwerror', 'message' );
  	}
}


add_action( 'admin_notices', 'PBFW_show_notice');
function PBFW_show_notice() {
    if ( get_transient( get_current_user_id() . 'pbfwerror' ) ) {

      	deactivate_plugins( PBFW_BASE_NAME );

      	delete_transient( get_current_user_id() . 'pbfwerror' );

      	echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
    }
}