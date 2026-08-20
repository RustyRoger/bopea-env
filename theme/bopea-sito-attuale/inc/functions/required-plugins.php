<?php
add_action( 'tgmpa_register', 'bopea_news_register_required_plugins' );
function bopea_news_register_required_plugins() {	
	$plugins = array(
		array(
			'name'               => esc_html__( 'Bopea Function', 'bopea' ),
			'slug'               => 'bopea-function',
			'source'             => 'https://jellywp.com/wpt/bopea/bopea-function.zip',
			'required'           => true,
			'version'            => '1.0.7',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),        
        array(
            'name'      => esc_html__( 'Elementor', 'bopea' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Contact Form 7', 'bopea' ),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'bopea' ),
            'slug'      => 'woocommerce',
            'required'  => true,
        )
    );	
	$config = array(
		'id'           => 'bopea',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);
	tgmpa( $plugins, $config );
}