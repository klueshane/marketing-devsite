<?php

/**
 * @class FLMapModule
 */
class FLMapModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'          	=> __( 'Map', 'bb-booster' ),
			'description'   	=> __( 'Display a Google map.', 'bb-booster' ),
			'category'      	=> __( 'Media', 'bb-booster' ),
			'partial_refresh'	=> true,
			'icon'				=> 'location.svg',
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLMapModule', array(
	'general'       => array(
		'title'         => __( 'General', 'bb-booster' ),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'address'       => array(
						'type'          => 'textarea',
						'rows'			=> '3',
						'label'         => __( 'Address', 'bb-booster' ),
						'placeholder'   => __( '1865 Winchester Blvd #202 Campbell, CA 95008', 'bb-booster' ),
						'preview'       => array(
							'type'            => 'refresh',
						),
						'connections'	=> array( 'custom_field' ),
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __( 'Height', 'bb-booster' ),
						'default'       => '400',
						'size'          => '5',
						'description'   => 'px',
						'sanitize'		=> 'absint',
					),
				),
			),
		),
	),
));
