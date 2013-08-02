<?php

/**
 * Plugin Name: SSL Domain Alias
 * Plugin URI: http://wordpress.stackexchange.com/questions/38902
 * Description: Use a different domain for serving your website over SSL, set with <code>SSL_DOMAIN_ALIAS</code> in your <code>wp-config.php</code>.
 * Author: TheDeadMedic, @HypertextRanch
 * Author URI: http://wordpress.stackexchange.com/users/1685/thedeadmedic
 *
 * @package SSL_Domain_Alias
 */

/**
 * Swap out the current site domain with {@see SSL_DOMAIN_ALIAS} if the
 * protocol is HTTPS.
 *
 * This function is not bulletproof, and expects {@see SSL_DOMAIN_ALIAS} to
 * be defined.
 *
 * @todo The replacement is a simple string replacement (for speed). If the
 * domain name is matching other parts of the URL other than the host, we'll
 * need to switch to a more rigid regex.
 *
 * @param string $url
 * @return string
 */
function _use_ssl_domain_alias_for_https( $url ) {
    static $domain;
    if ( ! isset( $domain ) )
        $domain = defined( 'SSL_DOMAIN_ALIAS' ) && !empty( SSL_DOMAIN_ALIAS ) ? parse_url( get_option( 'siteurl' ), PHP_URL_HOST ) : false;

    if ( $domain && 0 === strpos( $url, 'https' ) )
        $url = str_replace( $domain, SSL_DOMAIN_ALIAS, $url );

    return $url;
}

add_filter( 'plugins_url', '_use_ssl_domain_alias_for_https', 1 );
add_filter( 'content_url', '_use_ssl_domain_alias_for_https', 1 );
add_filter( 'site_url', '_use_ssl_domain_alias_for_https', 1 );

