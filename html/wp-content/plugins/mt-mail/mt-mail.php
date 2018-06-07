<?php
/**
 * Plugin Name: (mt) Mail
 * Text Domain: mt-mail-plugin
 * Plugin URI: http://mediatemple.net
 * Description: Access your Media Temple Webmail or GoogleApps mail
 * Version: 1.2
 * Author: Media Temple, Inc.
 * Author URI: http://mediatemple.net 
 * Plugin URI: http://mediatemple.net 
 * License: GPL2
 * Copyright 2014-2015 (mt) Media Temple, Inc. All Rights Reserved.
 */

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}

global $api;

global $mt_https_server;
$mt_server = 'ac.mediatemple.net';
$https_port = '443';
$mt_https_server = 'https://' . $mt_server . ':' . $https_port;

global $api_url;
$api_url = 'https://wpqs.secureserver.net/v1/';

global $plugin_update_ver;
$plugin_update_ver = '1.3';

function mtmail_library_init() {
    require_once( realpath( dirname( __FILE__ ) ) . '/classes/class.mt-update-api.php' );
    require_once( realpath( dirname( __FILE__ ) ) . '/classes/class.mt-upgrader.php' );
}
add_action( 'admin_init', 'mtmail_library_init' );

function mtmail_init_api() {
    global $api;
    global $api_url;
    global $plugin_update_ver;
    $api = new MT_Mail_Update_API( 'mt-mail', $plugin_update_ver, $api_url );
}
add_action( 'admin_init', 'mtmail_init_api' );

function mtmail_self_upgrade() {
    global $api;
    $plugin_slug = plugin_basename( __FILE__ );
    $duration = 60 * 60 * 6; // number of seconds for transient (every 6 hours)
    $mt_upgrader = new MT_Mail_Upgrader( __FILE__, $plugin_slug, $duration );
    $mt_upgrader->set_api( $api );
}
add_action( 'admin_init', 'mtmail_self_upgrade' );

function register_mt_mail_page(){
   add_menu_page( '(mt) Mail', '(mt) Mail', 'manage_options', 'mtmail_slug', 'mt_mail_page', plugins_url( 'mt-mail/images/mt-logo-16.png' ), '4.5' );
}
add_action( 'admin_menu', 'register_mt_mail_page' );

function mt_mail_page(){
    global $mt_https_server, $wp_version;
    $domain_name = parse_url( home_url(), PHP_URL_HOST );
    $db_name = DB_NAME;
    $url = "${mt_https_server}/rest/wpaas/get_webmail_url";
    $params = array(
        'domain_name' => $domain_name,
        'db_name'     => $db_name,
    );
    $url = add_query_arg( $params, $url );
    $response = wp_remote_get( $url, array(
        'timeout'     => 15,
        'redirection' => 5,
        'httpversion' => '1.0',
        'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
        'blocking'    => true,
        'headers'     => array(),
        'cookies'     => array(),
        'body'        => null,
        'compress'    => false,
        'decompress'  => true,
        'sslverify'   => false,
        'stream'      => false,
        'filename'    => null
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "ERROR: Something went wrong. $error_message";
    } else {
        if ( !empty( $response ) && is_array( $response ) ) {
            if ( isset( $response['body'] ) ) {
                $body = json_decode( $response['body'] );
                if ( isset( $body->mail_url ) ) {
                    $mail_url = $body->mail_url;
                    $mail_url = esc_url($mail_url);

                    // Google Apps
                    if ( strpos($mail_url, 'https://admin.google.com/') === 0 ) {
                        echo '<script type="text/javascript">window.open("' . $mail_url . '");</script>';
                        echo '<p>Please click <a href="' . $mail_url . '" target="_blank">here</a> if Google Apps did not open in a new window.</p>';
                    }
                    // Media Temple Webmail
                    else if ( !empty( $mail_url ) ) {
                        echo '<iframe src="' . $mail_url . '" seamless=seamless width=100% height=700 align=left></iframe>';
                    }
                    // Upsell Google Apps
                    else {
                        echo '<p>This WordPress plan does not include free email. For email service, please purchase and add a Google Apps for Work account.</p><a href="https://ac.mediatemple.net/catalog/router.mt?plan=google_apps&payment_term=1" target="_blank" class="btn btn--ac">Purchase Google Apps For Work</a>';
                    }
                } else {
                    echo '<p>ERROR: Could not determine your mail url. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a><br>';
                }
            } else {
                echo '<p>ERROR: Could not determine your mail url. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a><br>';
            }
        } else {
            echo '<p>ERROR: Could not determine your mail url. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a><br>';
        }
    }

}
?>
