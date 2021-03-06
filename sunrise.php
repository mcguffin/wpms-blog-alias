<?php


// namespace BlogAlias;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'FU!' );
}


function blog_alias_site_not_found( $current_site, $domain, $path ) {

	if ( '' === get_site_option( 'multisite_blog_alias_sunrise_active' ) ) {
		return;
	}

	require_once ABSPATH . WPINC . '/kses.php'; // dep of pluggable.php
	require_once ABSPATH . WPINC . '/pluggable.php'; // wp_sanitize_redirect()
	require_once ABSPATH . WPINC . '/formatting.php'; // untrailingslashit()
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'include/autoload.php';

	$model = BlogAlias\Model\AliasDomains::instance();

	if ( $result = $model->fetch_one_by( 'domain_alias', $domain ) ) {
		global $wpdb;

		// get site url
		// #11 $wpdb->options is not set during sunrise. Need to trigger it manually here.
		$wpdb->set_blog_id( $result->blog_id );
		$site_url = get_option( 'siteurl' );

		$add_path = defined( 'WPMU_BLOG_ALIAS_REDIRECT_WITH_PATH' )
			? WPMU_BLOG_ALIAS_REDIRECT_WITH_PATH
			: get_site_option( 'blog_alias_redirect_with_path' );

		if ( $add_path ) {
			$redirect = untrailingslashit( $site_url ) . $path;
		} else {
			$redirect = trailingslashit( $site_url );
		}

		http_response_code( 301 );
		header( "X-Redirect-By: WPMS-Blog-Alias" );
		header( 'Location: ' . wp_sanitize_redirect( $redirect ) );

		exit();
	}
}

add_action( 'ms_site_not_found', 'blog_alias_site_not_found', 10, 3 );
