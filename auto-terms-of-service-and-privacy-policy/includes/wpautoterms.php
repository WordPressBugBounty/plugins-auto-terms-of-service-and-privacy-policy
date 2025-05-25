<?php

namespace wpautoterms;

use wpautoterms\admin\form\Legal_Page;
use wpautoterms\admin\Notices;
use wpautoterms\admin\Options;
use wpautoterms\cpt\CPT;
use wpautoterms\frontend\Widget;
use wpautoterms\legal_pages;

abstract class Wpautoterms {
	protected static $_legal_pages;

	public static function init( ) {
		add_action( 'init', array( __CLASS__, 'action_init' ), -999998 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, '_enqueue_scripts' ), 1 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_enqueue_scripts' ), 1 );
		CPT::init();
		add_action( 'init', array( __CLASS__, 'init_shortcodes' ), -999997 );
		Widget::init();
		Notices::$instance = new Notices( WPAUTOTERMS_OPTION_PREFIX . 'notices' );
	}

	public static function init_shortcodes() {
		Shortcodes::init();
		Legacy_Shortcodes::init();
	}

	public static function action_init() {
		// Initialize legal pages after translations are loaded
		static::$_legal_pages = array();
		foreach ( legal_pages\Conf::get_legal_pages() as $page ) {
			$c = '\wpautoterms\admin\form\Legal_Page';
			$p = new $c( $page->id, $page->title, $page->description, $page->page_title );
			static::$_legal_pages[ $page->id ] = $p;
		}

		// Register CPT and other init actions
		CPT::register( Options::get_option( Options::LEGAL_PAGES_SLUG ) );
		do_action( WPAUTOTERMS_SLUG . '_registered_cpt' );
		add_post_type_support( 'wpautoterms_page', 'author' );
	}

	public static function _enqueue_scripts() {
		wp_enqueue_script( WPAUTOTERMS_JS_BASE, WPAUTOTERMS_PLUGIN_URL . 'js/base.js', array(
			'jquery',
			'wp-dom-ready'
		), WPAUTOTERMS_VERSION, false );
	}

	/**
	 * @return Legal_Page[]
	 */
	public static function get_legal_pages() {
		return static::$_legal_pages;
	}

	/**
	 * @param $id string
	 *
	 * @return Legal_Page|false
	 */
	public static function get_legal_page( $id ) {
		if ( ! isset( static::$_legal_pages[ $id ] ) ) {
			return false;
		}

		return static::$_legal_pages[ $id ];
	}


}
