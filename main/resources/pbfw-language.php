<?php

add_action( 'plugins_loaded', 'PBFW_load_textdomain_pro' );
function PBFW_load_textdomain_pro() {
    load_plugin_textdomain( 'product-badges-for-woocommerce', false, dirname( PBFW_BASE_NAME ) . '/languages' ); 
}

function PBFW_load_my_own_textdomain_pro( $mofile, $domain ) {
    if ( 'product-badges-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( PBFW_BASE_NAME ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'PBFW_load_my_own_textdomain_pro', 10, 2 );