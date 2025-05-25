<?php

use wpautoterms\admin\form\Legal_Page;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var $page Legal_Page
 */

// WARNING: #poststuff style block should reside here
?>
<style>
    #poststuff {
        display: none;
    }
</style>

<input type="hidden" name="legal_page" value="<?php echo esc_attr( $page->id() ); ?>"/>
<?php wp_nonce_field( 'legal_page_' . get_the_ID(), 'legal_page_nonce' ); ?>
<div id="legal-page-container">
	<?php
	echo $page->wizard();
	?>
</div>