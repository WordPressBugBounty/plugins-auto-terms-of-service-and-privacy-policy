<?php

namespace wpautoterms\admin\action;

use wpautoterms\Action_Base;

class Toggle_Action extends Action_Base {
	protected $_option_name;

	public function set_option_name( $name ) {
		$this->_option_name = $name;
	}

	protected function _handle( $admin_post ) {
		$option = ! (bool) get_option( $this->_option_name, false );
		update_option( $this->_option_name, $option );
		wp_send_json( array(
				'enabled' => $option ? 1 : 0
			)
		);
	}
}