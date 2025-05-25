<?php

namespace wpautoterms\admin;


use wpautoterms\admin\action\Send_Message;
use wpautoterms\admin\page\CookieConsent_Init;
use wpautoterms\admin\page\Settings_Base;
use wpautoterms\admin\page\Compliancekits;
use wpautoterms\admin\page\Legacy_Settings;
use wpautoterms\admin\page\Settings_Page;
use wpautoterms\admin\page\Settings_Page_Advanced;
use wpautoterms\admin\page\CookieConsent_Customization;
use wpautoterms\admin\page\CookieConsent_VendorScripts;
use wpautoterms\admin\page\CookieConsent_ConfigurationParameters;
use wpautoterms\api;
use wpautoterms\cpt\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Menu {
	const VERSION = 'version';
	const LEGACY_OPTIONS = 'legacy_options';

	const PAGE_DASHBOARD = 'dashboard';
	const PAGE_HELP = 'help';
	const PAGE_SETTINGS = 'settings';
	const PAGE_SETTINGS_ADVANCED = 'settings_advanced';
	const PAGE_CC_CUSTOMIZATION = 'cc_customization';
	const PAGE_CC_VENDOR_SCRIPTS = 'cc_vendor_scripts';
	const PAGE_CC_CONFIGURATION_PARAMETERS = 'cc_configuration_parameters';
	const PAGE_COMPLIANCE_KITS = 'compliancekits';
	const PAGE_LEGACY_SETTINGS = 'legacy_settings';

	const AUTO_TOS_OPTIONS = 'atospp_plugin_options';

	/**
	 * @var Settings_Base[]
	 */
	static public $pages;

	public static function font_sizes() {
		return array(
			' ' => __( 'default', WPAUTOTERMS_SLUG ),
			'12px' => __( '12px', WPAUTOTERMS_SLUG ),
			'13px' => __( '13px', WPAUTOTERMS_SLUG ),
			'14px' => __( '14px', WPAUTOTERMS_SLUG ),
			'15px' => __( '15px', WPAUTOTERMS_SLUG ),
			'16px' => __( '16px', WPAUTOTERMS_SLUG ),
		);
	}

	public static function fonts() {
		return array(
			' ' => __( 'default', WPAUTOTERMS_SLUG ),
			'Arial, sans-serif' => __( 'Arial, sans-serif', WPAUTOTERMS_SLUG ),
			'Georgia, serif' => __( 'Georgia, serif', WPAUTOTERMS_SLUG ),
		);
	}

	public static function init() {
		$dashboard = new page\Dashboard(static::PAGE_DASHBOARD, __( 'Dashboard', WPAUTOTERMS_SLUG ) );
		$contact = new page\Help( static::PAGE_HELP, __( 'Help', WPAUTOTERMS_SLUG ) );
		$sm = new Send_Message( CPT::edit_cap(), $contact->id(), null, null,
			__( 'Access denied', WPAUTOTERMS_SLUG ), true );
		$contact->action = $sm;
		$sp = new Settings_Page( static::PAGE_SETTINGS, __( 'General Settings', WPAUTOTERMS_SLUG ),
			__( 'Settings', WPAUTOTERMS_SLUG ) );


		static::$pages = array(
			$dashboard,
			new Compliancekits( static::PAGE_COMPLIANCE_KITS, __( 'Compliance Kits', WPAUTOTERMS_SLUG ) ),
			$sp,
			new Settings_Page_Advanced( static::PAGE_SETTINGS_ADVANCED, __( 'Advanced Settings', WPAUTOTERMS_SLUG ) ),
			new CookieConsent_Customization( static::PAGE_CC_CUSTOMIZATION, __( 'Cookie Consent Customization', WPAUTOTERMS_SLUG )),
			new CookieConsent_VendorScripts( static::PAGE_CC_VENDOR_SCRIPTS, __( 'Cookie Consent Vendor Scripts', WPAUTOTERMS_SLUG )),
			new CookieConsent_ConfigurationParameters( static::PAGE_CC_CONFIGURATION_PARAMETERS, __( 'Cookie Consent Configuration Parameters', WPAUTOTERMS_SLUG )),
			new Legacy_Settings( static::PAGE_LEGACY_SETTINGS, __( 'Legacy Auto TOS & PP', WPAUTOTERMS_SLUG ) ),
			$contact,
		);

		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
	}

	public static function register_settings() {
		foreach ( static::$pages as $page ) {
			if ( $page instanceof Settings_Base || $page instanceof CookieConsent_Init) {
				$page->define_options();
			}
		}
	}

	public static function admin_menu() {
		foreach ( static::$pages as $page ) {
			$page->register_menu();
		}
	}

	public static function enqueue_scripts( $page ) {
		$prefix = CPT::type() . '_page_';
		if ( 0 != strncmp( $page, $prefix, strlen( $prefix ) ) ) {
			return;
		}
		$page = substr( $page, strlen( $prefix ) );
		foreach ( static::$pages as $p ) {
			if ( $p->id() == $page ) {
				$p->enqueue_scripts();
			}
		}
	}
}
