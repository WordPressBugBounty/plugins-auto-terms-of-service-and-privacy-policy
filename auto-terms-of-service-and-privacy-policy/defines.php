<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPAUTOTERMS_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR );
define( 'WPAUTOTERMS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'WPAUTOTERMS_TAG', 'wpautoterms' );
define( 'WPAUTOTERMS_SLUG', 'wpautoterms' );
define( 'WPAUTOTERMS_OPTION_PREFIX', WPAUTOTERMS_SLUG . '_' );
define( 'WPAUTOTERMS_LEGAL_PAGES_DIR', 'legal-pages' . DIRECTORY_SEPARATOR );
define( 'WPAUTOTERMS_OPTION_ACTIVATED', 'activated' );
define( 'WPAUTOTERMS_JS_BASE', WPAUTOTERMS_SLUG . '_base' );
define( 'WPAUTOTERMS_COOKIE_CONSENT_VERSION', '4.2.0' );
define( 'WPAUTOTERMS_COOKIE_CONSENT_URL', 'https://www.termsfeed.com/public/cookie-consent/' . WPAUTOTERMS_COOKIE_CONSENT_VERSION . '/cookie-consent.js' );
