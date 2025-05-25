<?php

namespace wpautoterms\shortcode;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post_Links extends Sub_Shortcode {

	public function handle( $values, $content ) {
		global $wpautoterms_posts;
		if ( empty( $wpautoterms_posts ) ) {
			return '';
		}

		$links = array();
		foreach ( $wpautoterms_posts as $post ) {
			$links[] = '<a href="' . esc_url( get_post_permalink( $post->ID ) ) . '">' .
			           esc_html( $post->post_title ) . '</a>';
		}

		if ( count( $links ) > 1 ) {
			$last = array_pop( $links );
			$ret = join( ', ', $links );
			/* translators: %1$s is a comma-separated list of post links, %2$s is the last post link */
			$ret = sprintf( __( "%1\$s and %2\$s", 'auto-terms-of-service-and-privacy-policy' ), $ret, $last );
		} else {
			$ret = join( ', ', $links );
		}

		return $ret;
	}

}
