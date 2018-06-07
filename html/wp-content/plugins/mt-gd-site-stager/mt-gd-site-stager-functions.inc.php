<?php
/**
 * Sanitize message
 * ugly hack to remove code references in messages
 *
 * @param $msg string message to sanitize
 *
 * @return string sanitized message
 */
function sanitize_msg( $msg ) {
    $pattern = '/ at \/usr\/share\/.+/';
    if ( preg_match( $pattern, $msg, $matches ) ) {
        if ( !empty( $matches ) && is_array( $matches ) ) {
            $msg = substr( $msg, 0, -strlen( $matches[0] ) );
        }
    }
    return $msg;
}
