<?php

/**
 * Copyright 2014 (mt) Media Temple, Inc. All Rights Reserved.
 */

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) )
	die( 'Forbidden' );

/**
 * Talk to the API ... see what features, site types, etc. are available
 */
class MT_Mail_Update_API {

	/**
	 * Identify our plugin.
	 * Used in HTTP headers
	 * @var string
	 */
	protected $_slug = '';

	/**
	 * Set the plugin update version.
	 * Used in HTTP headers
	 * @var string
	 */
	protected $_plugin_ver = '';

	/**
	 * GoDaddy Staging Server URL
	 * Used in HTTP headers
	 * @var string
	 */
	protected $_url = '';

        /**
         * Class Constructor
         * @return MT_Mail_Update_API
         */
        public function __construct( $slug = '', $plugin_ver = '', $url = '' ) {

                // Add data
                $this->_slug = $slug;
                $this->_plugin_ver = $plugin_ver;
                $this->_url  = $url;
        }

	/**
	 * Check for an update to this plugin
	 * @param string $version
	 * @return array|WP_Error
	 */
	public function get_self_update() {
		return $this->make_call( 'updates/plugin/' . $this->_slug );
	}
	
	/**
	 * Get the arguments to pass into wp_remote_get or wp_remote_post
	 * @global string $wp_version
	 * @global mixed $wpdb
	 * @return array
	 */
	protected function get_args() {
		global $wp_version, $wpdb;
		return array(
				'headers'   => array(
					'X-Plugin-Api-Key'        => '',
					'X-Plugin-Theme'          => '',
					'X-Plugin-Theme-Version'  => '',
					'X-Plugin-Theme-Skin'     => '',
					'X-Plugin-URL'            => '',
					'X-Plugin-WP-Version'     => $wp_version,
					'X-Plugin-Plugins'        => json_encode( array() ),
					'X-Plugin-MySQL-Version'  => $wpdb->db_version(),
					'X-Plugin-PHP-Version'    => PHP_VERSION,
					'X-Plugin-Locale'         => get_locale(),
					'X-Plugin-WP-Lang'        => ( defined( 'WP_LANG' ) ? WP_LANG : 'en_US' ),
					'X-Plugin-Version'        => $this->_plugin_ver,
					'X-Plugin-Slug'           => $this->_slug,
				)
			);
	}

	/**
	 * Talk to the API endpoint
	 * @param string $method
	 * @param array $args
	 * @param string $verb
	 * @return array|WP_Error
	 */
	protected function make_call( $method, $args = array(), $verb = 'GET' ) {
		$max_retries = 1;
		$retries     = 0;
		if ( !in_array( $verb, array( 'GET', 'POST' ) ) ) {
			return new WP_Error( 'mt_update_api_bad_verb', sprintf( __( 'Unknown verb: %s. Try GET or POST', 'mt_update' ), $verb ) );
		}
		$url = $this->_url . $method;
		while ( $retries <= $max_retries ) {
			$retries++;
			if ( 'GET' === $verb ) {
				if ( !empty( $args ) ) {
					$url .= '?' . build_query( $args );
				}
				add_filter( 'https_ssl_verify', '__return_false' );
				$result = wp_remote_get( $url, $this->get_args() );
				remove_filter( 'https_ssl_verify', '__return_false' );
			} elseif ( 'POST' === $verb ) {
				$_args = $this->get_args();
				$_args['body'] = $args;
				add_filter( 'https_ssl_verify', '__return_false' );
				$result = wp_remote_post( $url, $_args );
				remove_filter( 'https_ssl_verify', '__return_false' );
			}
			if ( is_wp_error( $result ) ) {
				break;
			} elseif ( self::_is_retryable_error( $result ) ) {	
				
				// The service is in a known maintenance condition, give a sec to recover
				sleep( apply_filters( 'mt_update_api_retry_delay', 1 ) );
				continue;
			} else {
				break;
			}
		}

		do_action( 'mt_update_api_debug_request', $url, $this->get_args() );
		do_action( 'mt_update_api_debug_response', array( 'result' => $result ) );

		if ( !is_wp_error( $result ) && '200' != $result['response']['code'] ) {
			return new WP_Error( 'mt_update_api_bad_status', sprintf( __( 'API returned bad status: %d: %s', 'mt_update' ), $result['response']['code'], $result['response']['message'] ) );
		}

		return $result;
	}
	
	/**
	 * Check if the result of a wp_remote_* call is an error and should be retried
	 * @param array $result
	 * @return bool
	 */
	protected static function _is_retryable_error( $result ) {
		if ( is_wp_error( $result ) ) {
			return false;
		}
		if ( !isset( $result['response'] ) || !isset( $result['response']['code'] ) || 503 != $result['response']['code'] ) {
			return false;
		}
		$json = json_decode( $result['body'], true );
		if ( isset( $json['status'] ) && 503 == $json['status'] && isset( $json['type'] ) && 'error' == $json['type'] && isset( $json['code'] ) && 'RetryRequest' == $json['code'] ) {
			return true;
		}
		return false;
	}
}
