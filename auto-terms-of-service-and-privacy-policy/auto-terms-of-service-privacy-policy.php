<?php
/*
Plugin Name: TermsFeed AutoTerms
Plugin URI: https://www.termsfeed.com
Description: Privacy Policy Generator, Cookie Consent, GDPR, CCPA, Terms & Conditions, Disclaimer, Cookies Policy, EULA
Author: TermsFeed
Author URI: https://www.termsfeed.com
Version: 3.0.0
License: GPLv2 or later
Text Domain: auto-terms-of-service-and-privacy-policy
Domain Path: /languages
*/

/*

DISCLAIMER: TermsFeed AutoTerms is provided with the purpose of helping you with compliance. While we do our best to provide you useful information to use as a starting point, nothing can substitute professional legal advice in drafting your legal agreements and/or assisting you with compliance. We cannot guarantee any conformity with the law, which only a lawyer can do. We are not attorneys. We are not liable for any content, code, or other errors or omissions or inaccuracies. This plugin provides no warranties or guarantees. Nothing in this plugin, therefore, shall be considered legal advice and no attorney-client relationship is established. Please note that in some cases, depending on your legislation, further actions may be required to make your WordPress website compliant with the law.

*/

/*

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

namespace wpautoterms;

use wpautoterms\admin\Admin;
use wpautoterms\api\Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'defines.php';

function get_version( $file_name ) {
	// Initialize WP_Filesystem
	if ( ! function_exists( 'WP_Filesystem' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}
	WP_Filesystem();
	global $wp_filesystem;
	
	// Read the file contents using WP_Filesystem
	$file_contents = $wp_filesystem->get_contents( $file_name );
	if ( $file_contents === false ) {
		die( 'Unexpected error, could not read file ' . esc_html( $file_name ) );
	}
	
	// Split into lines and search for version
	$lines = explode( "\n", $file_contents );
	$cmp = 'Version:';
	$len = strlen( $cmp );
	
	foreach ( $lines as $line ) {
		$line = ltrim( $line );
		if ( strncasecmp( $line, $cmp, $len ) === 0 ) {
			return trim( substr( $line, $len ) );
		}
	}
	
	die( 'Could not find version in ' . esc_html( $file_name ) );
}

define( 'WPAUTOTERMS_VERSION', get_version( __FILE__ ) );

// Load core files that don't use translations
require_once WPAUTOTERMS_PLUGIN_DIR . 'api.php';
require_once WPAUTOTERMS_PLUGIN_DIR . 'deactivate.php';
require_once WPAUTOTERMS_PLUGIN_DIR . 'includes' . DIRECTORY_SEPARATOR . 'autoload.php';

// Initialize the plugin
$_query = new Query(WPAUTOTERMS_API_URL, WP_DEBUG);
Wpautoterms::init();

if (is_admin()) {
    Admin::init($_query);
} else {
    Frontend::init();
}

// Load translations at init
add_action('init', function() {
    if ( ! defined( 'WPAUTOTERMS_SLUG' ) ) {
        define( 'WPAUTOTERMS_SLUG', 'wpautoterms' );
    }
    load_plugin_textdomain('wpautoterms', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}, -999999);

// Targeted PHP 8 compatibility - only for our plugin pages
add_action('admin_init', function() {
    if (isset($_GET['page']) && is_string($_GET['page'])) {
        $page = sanitize_text_field($_GET['page']);
        if (!empty($page) && strpos($page, 'wpautoterms_') === 0) {
            // Only protect our plugin's admin pages
            global $title;
            if ($title === null) {
                $title = '';
            }
        }
    }
}, 1);

register_deactivation_hook( __FILE__, '\wpautoterms\deactivate' );

function template_exists($__template) {
	$__path = WPAUTOTERMS_PLUGIN_DIR . 'templates/' . $__template . '.php';
	if(file_exists($__path)) {
		return true;
	}
	return false;
}

function print_template( $__template, $args = array(), $__to_buffer = false ) {
	if ( ! $__template ) {
		return false;
	}
	if ( false !== strstr( '..', $__template ) ) {
		return false;
	}
	
	// Convert null scalar values to empty strings to prevent PHP 8 deprecation warnings
	$args = array_map( function( $value ) {
		// Only convert null values to empty strings, preserve other types
		return $value === null ? '' : $value;
	}, $args );
	
	extract( $args );
	$__path = WPAUTOTERMS_PLUGIN_DIR . 'templates/' . $__template . '.php';
	if ( $__to_buffer ) {
		ob_start();
	}
	include $__path;
	if ( $__to_buffer ) {
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret ? $ret : '';
	}
	return true;
}

// Additional safety wrapper for WordPress translation functions
function safe_translate($text, $domain = 'default') {
	if ($text === null || $text === false) {
		return '';
	}
	return __($text, $domain);
}

// Wrapper functions to prevent null values from reaching WordPress core functions
function safe_settings_fields($option_group) {
	if (empty($option_group) || $option_group === null) {
		return;
	}
	settings_fields($option_group);
}

function safe_do_settings_sections($page) {
	if (empty($page) || $page === null) {
		return;
	}
	do_settings_sections($page);
}

function safe_esc_attr($text) {
	if ($text === null) {
		return '';
	}
	return esc_attr($text);
}

function safe_esc_html($text) {
	if ($text === null) {
		return '';
	}
	return esc_html($text);
}
