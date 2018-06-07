<?php

$path = $path; //needed
$match = array();

#
# redirect routes. Follows the same format as .htaccess
# (having redirects here means that we dont have to touch the sensitive htaccess file
# and as this is just loaded on the 404 page, same page name conflicts will be avoided)
#

# public app routes
$match['^feed/?(.*?)$'] = 'https://app.klue.com/feed/$1';
$match['^posts/(.*?)$'] = 'https://app.klue.com/posts/$1';
$match['^posts/?$'] = 'https://app.klue.com/posts';
$match['^messages/?$'] = 'https://app.klue.com/messages';
$match['^alerts/?$'] = 'https://app.klue.com/alerts';
$match['^users/(.*?)$'] = 'https://app.klue.com/users/$1';
$match['^users/?$'] = 'https://app.klue.com/users';
$match['^profile/(.*?)$'] = 'https://app.klue.com/profile/$1';
$match['^profile/?$'] = 'https://app.klue.com/profile';
$match['^privacy/?$'] = 'https://app.klue.com/privacy';
$match['^terms/?(.*?)$'] = 'https://app.klue.com/terms/$1';
$match['^guides/?(.*?)$'] = 'https://app.klue.com/guides/$1';
$match['^support/?(.*?)$'] = '/contact/'; # on iOS install page (as of 05/17)
$match['^faq/?(.*?)$'] = 'https://app.klue.com/faq/$1';
$match['^tools/?(.*?)$'] = 'https://app.klue.com/tools/$1';

# assets
$match['^klue-logo-email.png'] = 'https://app.klue.com/klue-logo-email.png';// Logo in all KlueApp sent emails (added 2017/03)
$match['^wp-content/((.*?).[pdf,jpg,png])$'] = '/content/$1';// Temp, redirect broken PDF link in sent campaign emails (added 2017/04)

# less public app routes
$match['^api/(.*?)$'] = 'https://app.klue.com/api/$1';
$match['^tools/button/?$'] = 'https://app.klue.com/tools/button';
$match['^tools/google_alerts/?$'] = 'https://app.klue.com/tools/google_alerts';
$match['^signup/?$'] = 'https://app.klue.com/';
$match['^signin/?$'] = 'https://app.klue.com/';
$match['^account/(.*?)$'] = 'https://app.klue.com/account/$1'; // Here for GET requests. POSTS handled below
$match['^z/wiki/'] = 'http://zombo.com/';

# internal redirect (klue staff only, comes from a link in app emails)
$match['^impersonate/user/(.*?)$'] = 'https://app.klue.com/impersonate/user/$1';
$match['^impersonate/?$'] = 'https://app.klue.com/impersonate';

# chrome extension - special message instead
if(preg_match('#^ext/#', $path . '/')) {
  status_header(200);
  klue_log('_klue_log_theme_404s.txt', array('CHROME EXT', $_SERVER['REQUEST_URI']));
  die('<style>body{font-family:sans-serif;margin:20px;}</style><h4>Please update your Klue Button</h4><p>We\'ve made a big change to the klue button which requires an extension update to continue. Chrome may do this automatically upon restart</p>');
}

# api - different message for non-get requests, otherwise it will just redirect
if(preg_match('#^api/#', $path . '/') && $_SERVER['REQUEST_METHOD'] !== 'GET') {
  status_header(400);
  klue_log('_klue_log_theme_404s.txt', array('API', $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']));
  die(json_encode(array('error' => 'Server Error (API Domain has moved)')));
}

# account - special redirect for SSO logins
if(preg_match('#^account/#', $path . '/', $pattern_matches) && $_SERVER['REQUEST_METHOD'] !== 'GET') {
  status_header(200);
  klue_log('_klue_log_theme_redirects.txt', array('SSO POST', $_SERVER['REQUEST_URI']));
  post_redirect('https://app.klue.com' . $_SERVER['REQUEST_URI'], $_POST);
  die;
}

# make redirect if theres a matching regexp
foreach ($match as $regexp => $url) {
  if(preg_match('#' . $regexp . '#', trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'), $pattern_matches)) {
    foreach ($pattern_matches as $key => $value) {
      $url = str_replace('$' . $key, $value, $url);
    }

    if(isset($_GET) && count($_GET)) {
      $url .= '?' . http_build_query($_GET);
    }

    klue_log('_klue_log_theme_redirects.txt', array($_SERVER['HTTP_HOST'], $regexp, $url));

    header("HTTP/1.1 301 Moved Permanently");
    header('Location: ' . $url);
    die;
  }
}

// log all 404 requests
klue_log('_klue_log_theme_404s.txt', array($_SERVER['REQUEST_URI']));

function post_redirect($url, $post_params = array()) {
  $inputs = array();

  foreach ($post_params as $key => $value) {
    $inputs[] = '<input type="hidden" name="' . $key . '" value="' . $value . '" />'; // htmlspecialchars((string) $value, ENT_QUOTES)
  }

  // output HTML form with post values
  echo '<html><head><script type="text/javascript">window.onload = function() { document.forms[0].submit() }</script>'
  . '</head><body><form action="' . $url . '" method="POST">'
  . implode('', $inputs) . '</form></body></html>';

  die;
}
