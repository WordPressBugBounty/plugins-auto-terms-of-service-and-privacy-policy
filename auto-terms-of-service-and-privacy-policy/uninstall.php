<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'defines.php';
require_once join( DIRECTORY_SEPARATOR, array( __DIR__, 'includes', 'cpt', 'cpt.php' ) );

/**
 * Removes the plugin data of the current site. Legal pages are the site owner's content and are kept,
 * unless wp-config.php defines WPAUTOTERMS_UNINSTALL_DELETE_PAGES as true.
 */
function wpautoterms_uninstall_site() {
	global $wpdb;

	wpautoterms\cpt\CPT::unregister_roles();

	$like = array(
		$wpdb->esc_like( WPAUTOTERMS_OPTION_PREFIX ) . '%',
		$wpdb->esc_like( '_transient_' . WPAUTOTERMS_OPTION_PREFIX ) . '%',
		$wpdb->esc_like( '_transient_timeout_' . WPAUTOTERMS_OPTION_PREFIX ) . '%',
	);
	foreach ( $like as $pattern ) {
		$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE %s", $pattern ) );
	}
	// Settings of the 1.x plugin, kept for the legacy shortcodes.
	delete_option( 'atospp_plugin_options' );

	if ( defined( 'WPAUTOTERMS_UNINSTALL_DELETE_PAGES' ) && WPAUTOTERMS_UNINSTALL_DELETE_PAGES ) {
		$ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s",
			wpautoterms\cpt\CPT::type() ) );
		foreach ( $ids as $id ) {
			// Deletes the revisions, meta and term relationships of the page too.
			wp_delete_post( $id, true );
		}
	}

	flush_rewrite_rules();
}

if ( is_multisite() ) {
	foreach ( get_sites( array( 'fields' => 'ids', 'number' => 0 ) ) as $site_id ) {
		switch_to_blog( $site_id );
		wpautoterms_uninstall_site();
		restore_current_blog();
	}
} else {
	wpautoterms_uninstall_site();
}
