<?php

namespace wpautoterms\legal_pages;

abstract class Conf {
	const GROUP_TEST = 'test';
	const GROUP_PRIVACY_POLICY = 'privacy_policy';
	const GROUP_TERMS_CONDITIONS = 'terms_conditions';
	const GROUP_COOKIES_POLICY = 'cookies_policy';
	const GROUP_RETURN_POLICY = 'return_policy';
	const GROUP_DISCLAIMER = 'disclaimer';
	const GROUP_EULA = 'eula';

	protected static $_pages;
	protected static $_groups;

	protected static function _create_groups() {
		if (!did_action('init')) {
			add_action('init', array(__CLASS__, '_create_groups'), -999997);
			return;
		}

		$arr = array(
			new Group( static::GROUP_TEST, __( 'Test Agreements', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_PRIVACY_POLICY, __( 'Privacy Policy', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_TERMS_CONDITIONS, __( 'Terms & Conditions', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_COOKIES_POLICY, __( 'Cookies Policy', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_RETURN_POLICY, __( 'Return & Refund Policy', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_DISCLAIMER, __( 'Disclaimer', WPAUTOTERMS_SLUG ) ),
			new Group( static::GROUP_EULA, __( 'EULA', WPAUTOTERMS_SLUG ) ),
		);
		static::$_groups = array_combine( array_map( function ( $x ) {
			return $x->id;
		}, $arr ), $arr );
	}

	protected static function _create_pages() {
		if (!did_action('init')) {
			add_action('init', array(__CLASS__, '_create_pages'), -999996);
			return;
		}

		static::$_pages = array(
			// Privacy Policy
			new Page( 'privacy-policy',
				static::get_group( static::GROUP_PRIVACY_POLICY ),
				__( 'Privacy Policy', WPAUTOTERMS_SLUG ),
				__( 'Create a Privacy Policy page for your WordPress website.', WPAUTOTERMS_SLUG ),
				false,
				__( 'Privacy Policy', WPAUTOTERMS_SLUG )
			),

			// Terms & Conditions
			new Page( 'terms-and-conditions',
				static::get_group( static::GROUP_TERMS_CONDITIONS ),
				__( 'Terms and Conditions', WPAUTOTERMS_SLUG ),
				__( 'Create a Terms and Conditions page for your WordPress website.', WPAUTOTERMS_SLUG ),
				false
			),

			// Cookies Policy
			new Page( 'cookies-policy',
				static::get_group( static::GROUP_COOKIES_POLICY ),
				__( 'Cookies Policy', WPAUTOTERMS_SLUG ),
				__( 'Create a Cookies Policy page for your WordPress website.', WPAUTOTERMS_SLUG ),
				false
			),
		);
	}

	/**
	 * @param $id
	 *
	 * @return Group
	 */
	protected static function get_group( $id ) {
		$g = static::get_groups();

		return $g[ $id ];
	}

	/**
	 * @return Group[]
	 */
	public static function get_groups() {
		if ( static::$_groups == null ) {
			static::_create_groups();
		}

		return static::$_groups;
	}

	/**
	 * @param null|string $group_id
	 *
	 * @return Page[]
	 */
	public static function get_legal_pages( $group_id = null ) {
		if ( static::$_pages == null ) {
			static::_create_pages();
		}
		if ( $group_id == null ) {
			return static::$_pages;
		}

		return array_filter( static::$_pages, function ( $x ) use ( $group_id ) {
			return $x->group->id == $group_id;
		} );
	}
}
