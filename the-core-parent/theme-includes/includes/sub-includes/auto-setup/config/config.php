<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
return array(
	/**
	 * Array for demos
	 */
	'demos'              => array(
		'the-core'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),
		),
		'keynote'     => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),
		),
		'the-college' => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),
		),
		'hope'        => array(
			array(
				'name' => 'Give - WordPress Donation Plugin',
				'slug' => 'give'
			),
		),
		'creed'       => array(
			array(
				'name' => 'Give - WordPress Donation Plugin',
				'slug' => 'give'
			),
		),
		'the-trip'    => array(
			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
			),
		),
	),
	'plugins'            => array(
		array(
			'name'   => 'Revolution Slider',
			'slug'   => 'revslider',
			'source' => 'http://updates.themefuse.com/plugins/revslider.zip'
		),
		array(
			'name'   => 'LayerSlider WP',
			'slug'   => 'LayerSlider',
			'source' => 'http://updates.themefuse.com/plugins/LayerSlider.zip'
		),
	),
	'theme_id'           => 'the-core',
	'child_theme_source' => 'http://updates.themefuse.com/plugins/the-core-child.zip',
	'has_demo_content'   => true
);
