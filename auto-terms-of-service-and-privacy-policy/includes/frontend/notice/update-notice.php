<?php

namespace wpautoterms\frontend\notice;

use wpautoterms\admin\Options;
use wpautoterms\Updated_Posts;
use wpautoterms\cpt\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Update_Notice extends Base_Notice {
	const ID = 'update_notice';
	const COOKIE_PREFIX = 'wpautoterms-update-notice-';
	const BLOCK_CLASS = 'wpautoterms-update-notice';
	const CLOSE_CLASS = 'wpautoterms-notice-close';
	const ACTION_NAME = '_check_updates';

	public $message_multiple;
	protected $compat;

	public static function create() {
		$a = new Update_Notice( static::ID, WPAUTOTERMS_TAG . '-update-notice-container', static::BLOCK_CLASS );
		$a->message_multiple = get_option( WPAUTOTERMS_OPTION_PREFIX . $a->id() . '_message_multiple' );

		return $a;
	}

	public function init() {
		parent::init();
		if ( $this->_is_enabled() ) {
			setcookie( static::cookie_name(), 0, 0, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

	public static function cookie_name() {
		return WPAUTOTERMS_SLUG . '_cache_detector';
	}

	protected function _print_box() {
		$meta = get_post_meta( get_the_ID(), WPAUTOTERMS_SLUG . '_last_user_update' );
		if ( empty( $meta ) ) {
			return;
		}
		$last_update = $meta[0];
		$class_escaped = esc_attr( Update_Notice::BLOCK_CLASS );
		\wpautoterms\print_template( 'update-notice', array(
			'last_update'   => $last_update,
			'update_notice_disabled' => $this->_is_disabled_logged(),
			'cookie_name'   => static::COOKIE_PREFIX . $last_update,
			'cookie_value'  => $last_update,
			'class_escaped' => $class_escaped,
			'message'       => do_shortcode( $this->_message ),
			'close'         => $this->_get_close_message(),
		) );
	}

	protected function _localize_args() {
		$ret = parent::_localize_args();
		$posts = new Updated_Posts( intval( get_option( WPAUTOTERMS_OPTION_PREFIX . 'update_notice_duration' ) ),
			static::COOKIE_PREFIX, $this->_message, $this->message_multiple );
		$posts->fetch_posts();
		$ret['data'] = $posts->transform();
		$ret['ajaxurl'] = admin_url( 'admin-ajax.php' );
		$ret['action'] = WPAUTOTERMS_SLUG . static::ACTION_NAME;
		$ret['cache_detector_cookie'] = static::cookie_name();
		$ret['cache_detected'] = 1;

		return $ret;
	}

	protected function _is_enabled() {
		if ( ! parent::_is_enabled() ) {
			return false;
		}
		$type = get_post_type();
		if ( $type != CPT::type() ) {
			return false;
		}
		if ( ! is_single() ) {
			return false;
		}

		return true;
	}
}
