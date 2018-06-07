<?php

include 'admin-functions/advanced-custom-fields-config.php';
include 'admin-functions/advanced-custom-fields-pro/acf.php';
include 'admin-functions/template-helpers.php';

include 'admin-functions/fields-prepopulate-data.php';
@ini_set( 'upload_max_size' , '5M' );
@ini_set( 'post_max_size', '5M');
@ini_set( 'max_execution_time', '300' );

# referenced in theme files
global $KLUE_APP_DOMAIN;
$KLUE_APP_DOMAIN = 'https://app.klue.com';


// Hotfix for Jason - add press release video template
// TODO: remove
add_theme_support( 'post-formats', array( 'video' ) );

if(WP_DEBUG) {
  // Allow outputing debug info about fields usage: (?debug=fields)
  include 'admin-functions/fields-debug.php';
}

class KlueFuncs {
  function __construct() {
    // Allow post thumbnails management in admin
    add_theme_support( 'post-thumbnails' );

    // Checks request & Handles any klue form submissions
    add_action('init', array($this, 'handle_form_request'), 1);

    // Disable different types of the rss feed
    add_action('do_feed', array($this, 'disable_feed'), 1);
    add_action('do_feed_rdf', array($this, 'disable_feed'), 1);
    add_action('do_feed_rss', array($this, 'disable_feed'), 1);
    add_action('do_feed_rss2', array($this, 'disable_feed'), 1);
    add_action('do_feed_atom', array($this, 'disable_feed'), 1);
    add_action('do_feed_rss2_comments', array($this, 'disable_feed'), 1);
    add_action('do_feed_atom_comments', array($this, 'disable_feed'), 1);

    // Remove various /admin redirects to admin panel
    remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );
  }

  function disable_feed() {
    $isFeedBot = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'feed') > -1;

    // Log feed bots (see what providers are finding us)
    if($isFeedBot) {
      klue_log('_feed_bots.txt', array($_SERVER['REQUEST_URI']));
    }

    // If User agent isn't a feed/bot then send to the index/redirect handler
    if(!$isFeedBot) {
      // Revert content type back to a normal web page
      header('Content-Type: text/html');

      // Load as a normal page (will probably be a 404, or handled as a redirect)
      include dirname(__FILE__) . '/index.php';
      die;
    }
  }

  // function to route all POST ?klue-form=* requests to the correct function/method
  function handle_form_request() {
    // Cancel function if it doesn't match our basic form request needs
    if(!isset($_GET['klue-form']) || !isset($_POST)) return;

    $form_id = (string) $_GET['klue-form'];
    $method_name = '_handle_form_request_' . $form_id;
    $method_exists = method_exists($this, $method_name);
    $valid_nonce = isset($_REQUEST['_nonce']) && wp_verify_nonce($_REQUEST['_nonce'], $form_id); // wp_create_nonce('my_form_id')

    if(!$method_exists) wp_die('Form Setup Error');
    if(!$valid_nonce) wp_die('Invalid Request');

    // Call our handler function
    $ok = call_user_func_array(array($this, $method_name), array());

    if($ok) {
      if(isset($_REQUEST['_next'])) {
        header('Location: ' . $_REQUEST['_next']);
        die;
      }
      else {
        wp_die("Thanks for your submission - we're on it! <a href=\"{$_SERVER['HTTP_REFERER']}\">&larr; back</a>");
      }
    }
    else {
      wp_die("Sorry - <strong>Please check all fields are valid</strong> and try again<br /><br /><small>Keep seeing this? Email us directly: hello@klue.com</small>");
    }
  }

  // ?klue-form=demo - Handles generic demo forms and sends to hello@klue.com
  function _handle_form_request_demo() {
    $_POST['(web page)'] = $_SERVER['HTTP_REFERER'];

    $ok = klue_mailchimp_subscribe(array(
      'api_key' => 'f4fba5223b913379ec826683370e77d4-us12',
      'list_id' => '2eb2f45391',
      'email' => $_POST['email'],
      'name' => isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : false
    ));

    if(!$ok) return false;

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => 'hello@klue.com',
        'html' => klue_key_val_array_to_html($_POST),
        'subject' => isset($_REQUEST['_subject']) ? (string) $_REQUEST['_subject'] : 'New Website Demo Form Submission',
        'from_email' => 'noreply@klue.com',
        'from_name' => 'Klue Website'
      ));

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => $_POST['email'],
        'html' => file_get_contents(get_template_directory() . '/template-includes/emails/demo_confirmation.html'),
        'subject' => 'Thanks for your interest in Klue',
        'from_email' => 'hello@klue.com',
        'from_name' => 'Klue'
      ));

    if($ok) {
      header('location: /thank-you');
      die;
    }

    return $ok;
  }

  // ?klue-form=contact - Handles contact form
  function _handle_form_request_contact() {
    $_POST['(from contact form)'] = $_SERVER['HTTP_REFERER'];

    $ok = klue_mailchimp_subscribe(array(
      'api_key' => 'f4fba5223b913379ec826683370e77d4-us12',
      'list_id' => '467a748e66',
      'email' => $_POST['email'],
      'name' => isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : false
    ));

    if(!$ok) return false;

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => 'hello@klue.com',
        'html' => klue_key_val_array_to_html($_POST),
        'subject' => 'Contact Form Submission',
        'from_email' => 'noreply@klue.com',
        'from_name' => 'Klue Website'
      ));

      if($ok) {
        header('location: /thank-you');
        die;
      }

    return $ok;
  }

  // ?klue-form=webinar_video - Handles recorded webinar email to video
  function _handle_form_request_webinar_video() {
    $_POST['(web page)'] = $_SERVER['HTTP_REFERER'];

    $ok = klue_mailchimp_subscribe(array(
        'api_key' => 'f4fba5223b913379ec826683370e77d4-us12',
        'list_id' => 'ea4eff4dab',
        'email' => $_POST['email'],
        'name' => isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : false
      ));

    if(!$ok) return false;

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => 'hello@klue.com',
        'html' => klue_key_val_array_to_html($_POST),
        'subject' => 'User Requested Pre-Recorded Webinar',
        'from_email' => 'noreply@klue.com',
        'from_name' => 'Klue Website'
      ));

    // $ok = klue_mandrill_send(array(
    //     'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
    //     'to' => $_POST['email'],
    //     'html' => file_get_contents(get_template_directory() . '/template-includes/emails/webinar_prerecorded.html'),
    //     'subject' => 'Watch: Streamline your Competitive Intelligence',
    //     'from_email' => 'hello@klue.com',
    //     'from_name' => 'Klue'
    //   ));

    if($ok) {
      header('location: /resource-inquiry');
      die;
    }

    return $ok;
  }

  // ?klue-form=resources_pm_ebook - Handles product marketers battlecard ebook form
  function _handle_form_request_resources_pm_ebook() {
    $_POST['(web page)'] = $_SERVER['HTTP_REFERER'];

    $ok = klue_mailchimp_subscribe(array(
        'api_key' => 'f4fba5223b913379ec826683370e77d4-us12',
        'list_id' => 'abac1bd2bb',
        'email' => $_POST['email'],
        'name' => isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : false
      ));

    if(!$ok) return false;

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => 'hello@klue.com',
        'html' => klue_key_val_array_to_html($_POST),
        'subject' => 'User has been sent PM Battlecard Ebook',
        'from_email' => 'noreply@klue.com',
        'from_name' => 'Klue Website'
      ));

    // $ok = klue_mandrill_send(array(
    //     'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
    //     'to' => $_POST['email'],
    //     'html' => file_get_contents(get_template_directory() . '/template-includes/emails/resources_pm_ebook.html'),
    //     'subject' => 'Klue\'s PM\'s Guide to battlecards that win',
    //     'from_email' => 'hello@klue.com',
    //     'from_name' => 'Klue'
    //   ));

    if($ok) {
      header('location: /resource-inquiry');
      die;
    }

    return $ok;
  }

  // ?klue-form=resources_pm_ebook - Handles product marketers battlecard ebook form
  function _handle_form_request_resources_winloss_ebook() {
    $_POST['(web page)'] = $_SERVER['HTTP_REFERER'];

    $ok = klue_mailchimp_subscribe(array(
        'api_key' => 'f4fba5223b913379ec826683370e77d4-us12',
        'list_id' => '57c602aa92',
        'email' => $_POST['email'],
        'name' => isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : false
      ));

    if(!$ok) return false;

    $ok = klue_mandrill_send(array(
        'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
        'to' => 'hello@klue.com',
        'html' => klue_key_val_array_to_html($_POST),
        'subject' => 'User has been sent PM Win/Loss Ebook',
        'from_email' => 'noreply@klue.com',
        'from_name' => 'Klue Website'
      ));

    // Marketing will control this through the Mailchimp UI.

    // $ok = klue_mandrill_send(array(
    //     'api_key' => 'w0Kwg0Qk5L2aEYY6rCj-PQ',
    //     'to' => $_POST['email'],
    //     'html' => file_get_contents(get_template_directory() . '/template-includes/emails/resources_winloss_ebook.html'),
    //     'subject' => 'Your Competitive Intelligence Win/Loss Checklist',
    //     'from_email' => 'hello@klue.com',
    //     'from_name' => 'Klue'
    //   ));

    if($ok) {
      header('location: /resource-inquiry/');
      die;
    }

    return $ok;
  }
}

new KlueFuncs();

//
// Utils, as follows
//

function klue_key_val_array_to_html($arr) {
  $arr = array_filter($arr);
  $html = "";

  foreach ($arr as $key => $value) {
    if($key == '_nonce') continue;
    $html .= "\n<div>{$key}: <strong>" . ((string) $value) . "</strong></div>";
  }

  return $html;
}

function klue_mailchimp_subscribe($opts) {
  $data_center_id = explode('-', $opts['api_key'])[1];
  $url = sprintf('https://%s.api.mailchimp.com/2.0/lists/subscribe.json', $data_center_id);

  $post = array(
    'apikey' => $opts['api_key'],
    'id' => $opts['list_id'],
    'email' => array('email' => $opts['email']),
    'double_optin' => false,
    'update_existing' => true
  );

  if(isset($opts['name']) && $opts['name']) {
    $parts = is_array($opts['name']) ? $opts['name'] : explode(' ', $opts['name']);
    $post['merge_vars'] = array('FNAME' => $parts[0]);
    if(isset($parts[1])) {
      $post['merge_vars']['LNAME'] = $parts[1];
    }
  }

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($post)
  ));
  $output = @json_decode(curl_exec($curl), true);
  curl_close($curl);

  return !!isset($output['email']);
}

function klue_mandrill_send($opts) {
  $message_post = array(
    'subject' => $opts['subject'],
    'from_email' => $opts['from_email'],
    'from_name' => $opts['from_name'],
    'to' => array(),
    'html' => $opts['html'],
    'auto_text' => true
  );

  $opts['to'] = array_filter(is_array($opts['to']) ? $opts['to'] : explode(',', $opts['to']));
  foreach ($opts['to'] as $email) $message_post['to'][] = array('type' => 'to', 'email' => $email);

  $post = array(
    'key' => $opts['api_key'],
    'async' => false,
    'message' => $message_post
  );

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://mandrillapp.com/api/1.0/messages/send.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($post)
  ));
  $output = @json_decode(curl_exec($curl), true);
  curl_close($curl);

  return isset($output[0]['status']) && $output[0]['status'] == 'sent';
}

function klue_log($filename, $additional_data = array()) {
  $log_data = array();
  $log_data[] = current_time('r');
  $log_data = array_merge($log_data, $additional_data);
  $log_data[] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: '(no ref)';
  $log_data[] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '(no ua)';
  $log_data[] = $_SERVER['REMOTE_ADDR'];

  $logline = implode("\t| ", $log_data) . "\n";
  @file_put_contents(ABSPATH . '../' . $filename, $logline, FILE_APPEND);
}

function blog_colour($counter)
{
    if($counter % 5 == 0)
    {
        return "blogitem__color--green";
    }
    else if($counter % 5 == 1)
    {
        return "blogitem__color--mediumpurple";
    }
    else if($counter % 5 == 2)
    {
        return "blogitem__color--red";
    }
    else if($counter % 5 == 3)
    {
        return "blogitem__color--lightpurple";
    }
    else
    {
        return "blogitem__color--darkpurple";
    }
}
