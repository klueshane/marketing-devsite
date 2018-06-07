<?php
/*
Plugin Name: Site Stager
Description: Wordpress staging and development made easy. Bundled with the Media Temple Premium Wordpress product to enable developers to stage/sync Wordpress sites.
Author: Media Temple
Version: 0.3
Plugin URI: http://www.mediatemple.net
Author URI: http://www.mediatemple.net
Copyright 2014 (mt) Media Temple, Inc. All Rights Reserved.
*/

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) ) {
    die( 'Forbidden' );
}

global $api;
global $https_server;
$mt_server = 'ac.mediatemple.net';
$https_port = '443';
$https_server = 'https://' . $mt_server . ':' . $https_port;
$api_url = 'https://wpqs.secureserver.net/v1/';
define( 'MT_UPDATE_URL', $api_url );

require_once('mt-gd-site-stager-functions.inc.php');

/* some plugin defines */
define('WPSC_URL',		plugins_url().'/mt-gd-site-stager/');
define('WPSC_TEMP_URL',		WPSC_URL.'temp/');
define('WPSC_TEMP_DIR',		dirname(__FILE__).'/'.'temp'.'/');
define('WPSC_VERSION',		'0.3');
define('ERROR_DIV',			'<div class="error">');
define( 'MT_UPDATE_DIR', realpath( dirname( __FILE__ ) ) );

function wp_mtss_remove() {
    $option_name = 'staging_sites';
    delete_option($option_name);
    $option_name = 'mtss_setup_version';
    delete_option($option_name);
}
/* What to do when the plugin is deactivated? */
register_deactivation_hook( __FILE__, 'wp_mtss_remove' );

function library_init() {
    require_once( MT_UPDATE_DIR . '/classes/class.mt-update-api.php' );
    require_once( MT_UPDATE_DIR . '/classes/class.mt-upgrader.php' );
}
add_action( 'admin_init', 'library_init' );

function init_api() {
    global $api;
    $api = new MT_Update_API();
}
add_action( 'admin_init', 'init_api' );

function self_upgrade() {
    global $api;

    // Get the current version
    $version = get_option( 'mtss_setup_version' );

    // Set default options
    if ( empty( $version ) || version_compare( $version, '0.1' ) < 0 ) {
        update_option( 'mtss_setup_version', '0.1' );
    }
                
    // Upgrade to 0.2 
    if ( empty( $version ) || version_compare( $version, '0.2' ) < 0 ) {
        update_option( 'mtss_setup_version', '0.2' );
    }

    $plugin_slug = plugin_basename( __FILE__ );
    $duration = 60 * 60 * 6; // number of seconds for transient (every 6 hours)
    $mt_upgrader = new MT_Upgrader( $plugin_slug, $duration );
    $mt_upgrader->set_api( $api );
}
add_action( 'admin_init', 'self_upgrade' );

function wp_mtss_admin_init() {
    wp_register_style( 'mtsscss', WPSC_URL.'mtss-admin.css' );
}
add_action( 'admin_init', 'wp_mtss_admin_init' );

function wp_mtss_admin_menu() {
    $mtssmainpage  = add_menu_page('(mt) Site Stager', '(mt) Site Stager', 'manage_options', 'mtss', 'wp_main_page', WPSC_URL.'mt-logo-16.png', '4.7');
    $mtssstagepage = add_submenu_page('mtss', 'Stage', 'Stage', 'manage_options', 'mtss_stage', 'mt_stage_page');
    $mtsssitespage = add_submenu_page('mtss','Sites', 'Sites', 'manage_options', 'mtss_sites', 'mt_sites_page');

    // Use the page hook suffix to hook the function that links our styles.
    add_action('admin_print_styles-' . $mtssmainpage, 'wp_mtss_styles');
    add_action('admin_print_styles-' . $mtssstagepage, 'wp_mtss_styles');
    add_action('admin_print_styles-' . $mtsssitespage, 'wp_mtss_styles');
}
add_action('admin_menu', 'wp_mtss_admin_menu');

function wp_mtss_styles() {
    wp_enqueue_style( 'mtsscss' );
}

function stage_site() {
    global $https_server;
    check_ajax_referer( 'stage-site' );
    $step = 'CREATE_STAGE_SITE';
    $parent_domain = $_POST['site'];
    $parent_db = DB_NAME;
    $option_name = 'staging_sites';
    $url = "${https_server}/rest/wpaas/create_staging_account";
    $response = wp_remote_post( $url, array(
        'method' => 'POST',
        'timeout' => 20,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'sslverify' => false,
        'body' => array( 'domain_name' => $parent_domain, 'db_name' => $parent_db ),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo '<p><span class="mtss-error">ERROR: Something went wrong. $error_message</span>';
    } else {
//        echo 'Response:<pre>';
//        print_r( $response );
        if ( !empty( $response ) && is_array( $response ) ) {
            if ( isset( $response['body'] ) ) {
                $body = json_decode( $response['body'] );
                if ( !empty( $body->domain ) ) {
                    $domain = $body->domain;
                    if ( get_option( $option_name ) !== false ) {
                        // The option already exists, so we just update it.
                        $tmp = get_option( $option_name );
                        array_push($tmp, $body);
                        update_option( $option_name, $tmp );
                    } else {
                        // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                        $deprecated = null;
                        $autoload = 'no';
                        if (add_option( $option_name, $body, $deprecated, $autoload ) ) {
                        } else {
                            echo '<br><span class="mtss-fatal">FATAL: Wordpress problem adding option ' . $option_name . '. Please contact MT Support.</span><br>';
                        }
                    }
                    echo '<br><span class="mtss-info">INFO: Created Staging Site <a href="http://' . $domain . '/" target="_blank" >http://' . $domain . '</a></span><br>';
                } elseif ( !empty( $body->message ) ) {
                    $msg = sanitize_msg( $body->message ); 
                    echo '<br><span class="mtss-error">ERROR: ' . $msg . '</span><br>';
                } else {
                    echo '<br><span class="mtss-error">ERROR: ' . $step . ': http error but no status message. Click Sites submenu to see if it was created.</span><br>';
                }
            } else {
                echo '<p><span class="mtss-error">ERROR: No response body. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
            }
        } else {
            echo '<p><span class="mtss-error">ERROR: No response. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
        }
//        echo '</pre>';
    }
    die();
}
add_action( 'wp_ajax_stage', 'stage_site' );

function show_stage_form( $site_type ) {
    $site_name = parse_url( home_url(), PHP_URL_HOST );
    $tag = preg_replace('/\./', '_', $site_name);
    $stage_id = 'stage_' . $tag;
    $nonce_tag = 'stage-site';
    $nonce = wp_create_nonce( $nonce_tag );
?>
<script  type='text/javascript'>
var count = 0;

// When the document loads do everything inside here ...
jQuery(document).ready(function(){
        jQuery('#<?php echo $stage_id; ?>').click(function() { //start function when Stage button is clicked
                jQuery.ajax({
                        type: "post",url: "admin-ajax.php",data: { action: 'stage', site: escape( jQuery( '#site' ).val() ), _ajax_nonce: '<?php echo $nonce; ?>' },
                        beforeSend: function() {  //fadeIn loading just when link is clicked
                                jQuery("div#loading").fadeIn('fast');
                        },
                        success: function(html){ //so, if data is retrieved, store it in html
                                jQuery("div#loading").fadeOut('slow');
                                jQuery("div#formstatus").html( html ); //show the html inside formstatus div
                        }
                }); //close jQuery.ajax
                return false;
        })
})
</script>
<style type='text/css'>
#loading { clear:both; background:url(images/loading.gif) center top no-repeat; text-align:center;padding:33px 0px 0px 0px; font-size:12px;display:none; font-family:Verdana, Arial, Helvetica, sans-serif; }
</style>
<div class="wrap">
<form action='' method='POST' id='helloworld4form'>
<?php
if ($site_type === 'live') {
    $tag = 'Live Site: ';
    $name = 'site';
    $id = $name;
} elseif ($site_type === 'stage') {
    $tag = 'Stage Site: ';
    $name = 'site';
    $id = $name;
}
?><p><b><?php echo $tag; ?></b><input type='text' class='readonly' name='<?php echo $name; ?>' id='<?php echo $id; ?>' value='<?php echo $site_name; ?>' readonly />
<input type='submit' class='button' name='action' id='<?php echo $stage_id; ?>' value='Stage' />
</p>
</form>
<div id='loading'>PROCESSING</div>
<p><div id='formstatus'></div></p>
</div>
<?php
}

function mt_stage_page() {
?>
<div class="mtss-wrapper">
<a href="http://mediatemple.net" target="_blank"><img src="<?php echo WPSC_URL; ?>mt.png" align="left" /></a>
<div class="mtss-title">Media Temple Site Stager</div><br>
<div class="mtss-version">v <?php echo WPSC_VERSION; ?></div><br>
<?php
    show_stage_form('live');
?>
</div>
<?php
}

function show_sites_to_sync() {
    global $https_server;
    $step = 'LIST_STAGING_SITES';
    $nonce_tag = 'sync-site';
    $nonce = wp_create_nonce( $nonce_tag );
    $option_name = 'staging_sites';
    $domain_name = parse_url( home_url(), PHP_URL_HOST );
    $db_name = DB_NAME;
    $b_got_list = 0;
    $url = "${https_server}/rest/wpaas/list_related_accounts";
    $response = wp_remote_post( $url, array(
        'method' => 'POST',
        'timeout' => 20,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'sslverify' => false,
        'body' => array( 'domain_name' => $domain_name, 'db_name' => $db_name ),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo '<p><span class="mtss-error">ERROR: Something went wrong. $error_message</span>';
    } else {
//        echo 'Response:<pre>';
//        print_r( $response );
        if ( !empty( $response ) && is_array( $response ) ) {
            if ( isset( $response['body'] ) ) {
                $body = json_decode( $response['body'] );
                if ( !empty( $body->staging ) && is_array( $body->staging ) ) {
                    $b_got_list = 1;
                    $stage_array = $body->staging;
                    if ( get_option( $option_name ) !== false ) {
                        update_option( $option_name, $stage_array );
                    } else {
                        // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                        $deprecated = null;
                        $autoload = 'no';
                        if ( add_option( $option_name, $stage_array, $deprecated, $autoload ) ) {
                        } else {
                            echo '<br><span class="mtss-fatal">FATAL: ' . $step . ': Problem adding option ' . $option_name . '. Please contact MT Support.</span><br>';
                        }
                    }
                } else {
                    echo '<p><span class="mtss-info">INFO: ' . $step . ': There are no staging sites to list</span><br>';
                }
            } else {
                echo '<p><span class="mtss-error">ERROR: ' . $step . ': No response body. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
            }
        } else {
            echo '<p><span class="mtss-error">ERROR: ' . $step . ': No response. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
        }
//        echo '</pre>';
    }

    if ( $b_got_list && ( $staging_sites = get_option($option_name) ) !== false ) {
        $staging_site_count = count($staging_sites);
        if ( $staging_site_count > 0 ) {
?>
<script type='text/javascript'>
var count = <?php echo count($staging_sites); ?>

// When the document loads do everything inside here ...
jQuery(document).ready(function(){
<?php
            $cnt = 0;
            foreach ($staging_sites as $site_name) {
                $cnt++;
                $site_prefix = array_shift(explode('.', $site_name->domain));
                $stage_id = 'deploy_' . $site_prefix . $cnt;
                $delete_id = 'delete_' . $site_prefix . $cnt;
                $loading_id = 'loading_' . $site_prefix . $cnt;
?>
    jQuery('#<?php echo $stage_id; ?>').click(function() { //start function when Sync button is clicked
        jQuery.ajax({
            type: "post",url: "admin-ajax.php",data: { action: 'sync', site: escape( jQuery( '#site_<?php echo $stage_id; ?>' ).val() ), dbname: escape( jQuery( '#dbname_<?php echo $stage_id; ?>' ).val() ), _ajax_nonce: '<?php echo $nonce; ?>' },
            beforeSend: function() {  //fadeIn loading just when link is clicked
                                jQuery('div#<?php echo $loading_id; ?>').fadeIn('fast');
            },
            success: function(html){ //so, if data is retrieved, store it in html
                                jQuery('div#<?php echo $loading_id; ?>').fadeOut('slow');
                                jQuery('div#formstatus').html( html ); //show the html inside formstatus div
            }
        }); //close jQuery.ajax
        return false;
    })
    jQuery('#<?php echo $delete_id; ?>').click(function() { //start function when Delete button is clicked
        jQuery.ajax({
            type: "post",url: "admin-ajax.php",data: { action: 'delete_staging', site: escape( jQuery( '#site_<?php echo $stage_id; ?>' ).val() ), dbname: escape( jQuery( '#dbname_<?php echo $stage_id; ?>' ).val() ), _ajax_nonce: '<?php echo $nonce; ?>' },
            beforeSend: function() {  //fadeIn loading just when link is clicked
                                jQuery('div#<?php echo $loading_id; ?>').fadeIn('fast');
            },
            success: function(html){ //so, if data is retrieved, store it in html
                                jQuery('div#<?php echo $loading_id; ?>').fadeOut('slow');
                                jQuery('div#formstatus').html( html ); //show the html inside formstatus div
                                var re = /(error|warning):/i;
                                var found = html.match(re);
                                if (found == null) {
                                    jQuery('div#sync_<?php echo $stage_id; ?>').remove(); //remove the DOM div element for this site
                                    count--;
                                    if (count == 0) { // if all sites removed, then remove Delete All button
                                        jQuery('#delete_all').remove();
                                        alert('All staging sites deleted');
                                    }
                                }
            }
        }); //close jQuery.ajax
        return false;
    })
<?php
            }
?>
    jQuery('#delete_all_id').click(function() { //start function when Delete All button is clicked
        jQuery.ajax({
            type: "post",url: "admin-ajax.php",data: { action: 'delete_all_staging', _ajax_nonce: '<?php echo $nonce; ?>' },
            beforeSend: function() {  //fadeIn loading just when link is clicked
                                jQuery('div#loading').fadeIn('fast');
            },
            success: function(html){ //so, if data is retrieved, store it in html
                                jQuery('div#loading').fadeOut('slow');
                                jQuery('div#formstatus').html( html ); //show the html inside formstatus div
<?php
            $cnt = 0;
            foreach ($staging_sites as $site_name) {
                $cnt++;
                $site_prefix = array_shift(explode('.', $site_name->domain));
                $stage_id = 'deploy_' . $site_prefix . $cnt;
?>
                                jQuery('div#sync_<?php echo $stage_id; ?>').remove(); // remove individual site DOM div element
<?php
            }
?>
                                jQuery('#delete_all').remove(); // remove Delete All button
                                alert('All staging sites deleted');
            }
        }); //close jQuery.ajax
        return false;
    })
})
</script>
<style type='text/css'>
#loading { clear:both; background:url(images/loading.gif) center top no-repeat; text-align:center;padding:33px 0px 0px 0px; font-size:12px;display:none; font-family:Verdana, Arial, Helvetica, sans-serif; }
<?php
            $cnt = 0;
            foreach ($staging_sites as $site_name) {
                $cnt++;
                $site_prefix = array_shift(explode('.', $site_name->domain));
                $loading_id = 'loading_' . $site_prefix . $cnt;
?>
#<?php echo $loading_id; ?> { clear:both; background:url(images/loading.gif) center top no-repeat; text-align:center;padding:33px 0px 0px 0px; font-size:12px;display:none; font-family:Verdana, Arial, Helvetica, sans-serif; }
<?php
            }
?>
</style>
<div class="wrap">
<?php
            $cnt = 0;
            foreach ($staging_sites as $site_name) {
                $cnt++;
                $site_prefix = array_shift(explode('.', $site_name->domain));
                $stage_id = 'deploy_' . $site_prefix . $cnt;
                $delete_id = 'delete_' . $site_prefix . $cnt;
                $loading_id = 'loading_' . $site_prefix . $cnt;
?>
<div id='sync_<?php echo $stage_id; ?>'>
<form action='' method='POST' id='sync_form'>
<p><b>Staging Site:</b> <input type='text' name='site' id='site_<?php echo $stage_id; ?>' value='<?php echo $site_name->domain; ?>' size=28 readonly />
<b>Staging DB Name:</b> <input type='text' name='dbname' id='dbname_<?php echo $stage_id; ?>' value='<?php echo $site_name->db_name; ?>' size=15 readonly />
<input type='submit' class='button' name='action' id='<?php echo $stage_id; ?>' value='Sync' />
<input type='submit' class='button' name='action' id='<?php echo $delete_id; ?>' value='Delete' />
</p></form>
<div id='<?php echo $loading_id; ?>'>PROCESSING</div>
</div>
<?php
            }
?>
<div id='delete_all'>
<p><form action='' method='POST' id='delete_all_form'>
<input type='submit' class='button' name='action' id='delete_all_id' value='Delete All' />
</form></p>
<div id='loading'>DELETING ALL SITES</div>
</div>
<p><div id='formstatus'></div></p>
</div> 
<?php
        } // end of staging_site_count
    } // end of get_option check
} // end function

function sync_site() {
    global $https_server;
    check_ajax_referer( 'sync-site' );
    $step = 'SYNC_STAGING_TO_LIVE';
    $parent_domain = $_POST['site'];
    $parent_db = DB_NAME;
    $url = "${https_server}/rest/wpaas/sync_staging_changes";
    $response = wp_remote_post( $url, array(
        'method' => 'POST',
        'timeout' => 20,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'sslverify' => false,
        'body' => array( 'domain_name' => $_POST['site'], 'db_name' => $_POST['dbname'] ),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo '<p><span class="mtss-error">ERROR: Something went wrong. $error_message</span>';
    } else {
//        echo 'Response:<pre>';
//        print_r( $response );
        if ( !empty( $response ) && is_array( $response ) ) {
            if ( isset( $response['body'] ) ) {
                $body = json_decode( $response['body'] );
                if ( $body == 1 ) {
                    echo '<span class="mtss-info">INFO: Site ' . $_POST['site'] . ' Synced!</span><br>';
                } elseif ( !empty( $body->message ) ) {
                    $msg = sanitize_msg( $body->message ); 
                    echo '<br><span class="mtss-error">ERROR: ' . $msg . '</span><br>';
                } else {
                    echo '<span class="mtss-error">ERROR: Sync failed for site ' . $_POST['site'] . '</span><br>';
                }
            } else {
                echo '<p><span class="mtss-error">ERROR: No response body. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
            }
        } else {
            echo '<p><span class="mtss-error">ERROR: No response. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
        }
//        echo '</pre>';
    }
    die();
}
add_action( 'wp_ajax_sync', 'sync_site' );

function mt_sites_page() {
?>
<div class="mtss-wrapper">
<a href="http://mediatemple.net" target="_blank"><img src="<?php echo WPSC_URL; ?>mt.png" align="left" /></a>
<div class="mtss-title">Media Temple Site Stager</div><br>
<div class="mtss-version">v <?php echo WPSC_VERSION; ?></div><br>
<?php
    show_sites_to_sync();
?>
</div>
<?php
}

function delete_staging_site() {
    global $https_server;
    check_ajax_referer( 'sync-site' );
    $step = 'DELETE_STAGING_SITE';

    if ( !empty( $_POST['dbname'] ) ) {

        $url = "${https_server}/rest/wpaas/delete_staging_account";
        $response = wp_remote_post( $url, array(
            'method' => 'POST',
            'timeout' => 20,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(),
            'sslverify' => false,
            'body' => array( 'domain_name' => $_POST['site'], 'db_name' => $_POST['dbname'] ),
            'cookies' => array()
        ));

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo '<p><span class="mtss-error">ERROR: Something went wrong. $error_message</span>';
        } else {
//        echo 'Response:<pre>';
//            print_r( $response );
            if ( !empty( $response ) && is_array( $response ) ) {
                if ( isset( $response['body'] ) ) {
                    $body = json_decode( $response['body'] );
                    if ( !empty( $body->status ) ) {
                        if ( $body->status === 'ok' ) {
                            // Delete staging site option from wp_options table
                            $option_name = 'staging_sites';
                            if ( get_option( $option_name ) !== false ) {
                                // The option already exists, so we just update it.
                                $tmp = get_option( $option_name );
                                if ( ( $sitekey = array_search($_POST['site'], $tmp ) ) !== false ) {
                                    unset($tmp[$sitekey]);
                                }
                                update_option( $option_name, $tmp );
                            }
                            echo '<br><span class="mtss-info">INFO: Staging site ' . $_POST['site'] . ' deleted</span><br>';
                        } else {
                            echo '<br><span class="mtss-error">ERROR: Status not ok. Problem deleting staging site. Please contact MT Support.</span><br>';
                        }
                    } elseif ( !empty( $body->message ) ) {
                        $msg = sanitize_msg( $body->message ); 
                        echo '<br><span class="mtss-error">ERROR: ' . $msg . '</span><br>';
                    } else {
                        echo '<br><span class="mtss-error">ERROR: Status empty. Problem deleting staging site. Please contact MT Support.</span><br>';
                    }
                } else {
                    echo '<p><span class="mtss-error">ERROR: No response body. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
                }
            } else {
                echo '<p><span class="mtss-error">ERROR: No response. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
            }
//            echo '</pre>';
        }
    } else {
        echo '<br><span class="mtss-warning">WARNING: ' . $step . ': Could not delete staging site (no database name). Site is probably still in setup phase. Refresh the page and try again in 30 seconds.</span><br>';
    }
    die();
}
add_action( 'wp_ajax_delete_staging', 'delete_staging_site' );

function delete_all_staging_sites() {
    global $https_server;
    check_ajax_referer( 'sync-site' );
    $step = 'DELETE_ALL_STAGING_SITES';
    $parent_domain = parse_url( home_url(), PHP_URL_HOST );
    $parent_db = DB_NAME;
    $option_name = 'staging_sites';
    $url = "${https_server}/rest/wpaas/delete_all_staging_accounts";
    $response = wp_remote_post( $url, array(
        'method' => 'POST',
        'timeout' => 20,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'sslverify' => false,
        'body' => array( 'domain_name' => $parent_domain, 'db_name' => $parent_db ),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo '<p><span class="mtss-error">ERROR: Something went wrong. $error_message</span>';
    } else {
//        echo 'Response:<pre>';
//        print_r( $response );
        if ( !empty( $response ) && is_array( $response ) ) {
            if ( isset( $response['body'] ) ) {
                $body = json_decode( $response['body'] );
                if ( !empty( $body->status ) ) {
                    if ( $body->status === 'ok' ) {
                        if ( get_option( $option_name ) !== false ) {
                            // The option exists, so we just delete it.
                            if ( delete_option( $option_name ) !== false ) {
                                echo '<br><span class="mtss-info">INFO: All staging sites deleted</span><br>';
                            } else {
                                echo '<br><span class="mtss-error">ERROR: Problem deleting all staging sites</span><br>';
                            }
                        }
                    } else {
                        echo '<br><span class="mtss-error">ERROR: Problem deleting all staging sites. Please contact MT Support.</span><br>';
                    }
                } elseif ( !empty( $body->message ) ) {
                    $msg = sanitize_msg( $body->message ); 
                    echo '<br><span class="mtss-error">ERROR: ' . $msg . '</span><br>';
                } else {
                    echo '<br><span class="mtss-error">ERROR: No ok status returned. Please contact MT Support.</span><br>';
                }
            } else {
                echo '<p><span class="mtss-error">ERROR: No response body. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
            }
        } else {
            echo '<p><span class="mtss-error">ERROR: No response. Please contact MT Support <a href="http://www.mediatemple.net/help" target="_blank">http://www.mediatemple.net/help</a></span><br>';
        }
//        echo '</pre>';
    }
    die();
}
add_action( 'wp_ajax_delete_all_staging', 'delete_all_staging_sites' );

// #####################################################################################
// ################                  MAIN PAGE                 #########################
// #####################################################################################
function wp_main_page() {
?>
<div class="mtss-wrapper">
<a href="http://mediatemple.net" target="_blank"><img src="<?php echo WPSC_URL; ?>mt.png" align="left" /></a>
<div class="mtss-title">Media Temple Site Stager</div><br>
<div class="mtss-version">v <?php echo WPSC_VERSION; ?></div><br>
<div class="info">
<h3>Welcome!</h3>
<p>
This plugin is being offered as a way for site developers to create copies<br>
of their live site, make changes, and then merge the changes back to their<br>
live site, essentially creating a pseudo development environment in which<br>
for them to work. Happy developing! We welcome your feedback!<br>
<p>
<h3>Usage</h3><p>
Under the Site Stager menu on the left...
<p>
Step 1. Click the Stage submenu to create a staging account. The site in the<br>
text box is your live site
<p>
Step 2. Click Sites submenu to see all of your staging accounts. This is where<br>
you can perform sync and delete actions. On the Sites page, clicking the Sync<br>
button will sync the staging site back to the live site. The Delete button is<br>
self-explanatory.<br>
<p>
<h3>Support</h3>
<p>
This plugin is in it's initial phase. Please contact <a href="http://mediatemple.net/help" target="_blank">Media Temple Support</a> with<br>
any error messages so that we can further assist.<br>
<p>
<h3>FAQ</h3>
<p>
<b>What is a stage site?</b><br>
A stage site is essentially a copy of your live site. You can make development<br>
changes on the stage site, and when you're ready to "go live," sync your<br>
changes back to the live site
<p>
<b>What are the wordpress login credentials of my new staging site?</b><br>
same as your live site
<p>
<b>When I click 'Sites', why is my Staging DB Name empty?</b><br>
Your site is in setup phase, and the db name is not available yet. Simply wait<br>
about 10 seconds and refresh the page
<p>
See the <a href="http://mediatemple.net/blog/news/welcome-to-the-future-of-managed-wordpress-hosting/" target="_blank">Media Temple Wordpress Blog</a> for more info about the product.
<p>
</div>
</div>
<?php
}
?>
