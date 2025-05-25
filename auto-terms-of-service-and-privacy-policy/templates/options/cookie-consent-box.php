<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \wpautoterms\cpt\CPT;

/**
 * @var $box \wpautoterms\box\Box
 */

/**
 * @var $enabled bool
 */

/**
 * @var $status_text string
 */

/**
 * @var $enable_button_text string
 */
?>
<div class="postbox wpautoterms-options-box">
	<h3><?php echo $box->title(); ?>
	</h3>
	<div class="inside">
		<p class="box-infotip"><?php echo $box->infotip(); ?></p>
		<p class="box-status <?php echo $enabled ? 'enabled' : 'disabled'; ?>"
		   id="status_<?php echo $box->enable_action_id(); ?>"><?php echo $status_text; ?></p>
	</div>
	<div class="wpautoterms-box-enable-button">
		<a class="button" data-type="enable" href="javascript:void(0);"
		   id="<?php echo $box->enable_action_id(); ?>">
			<?php echo $enable_button_text; ?>
		</a>
	</div>
	<div class="wpautoterms-box-configure-button">
		<a class="button button-primary"
		   href="edit.php?post_type=<?php echo CPT::type(); ?>&page=wpautoterms_cc_customization">
			<?php _e( 'Configure', WPAUTOTERMS_SLUG ); ?>
		</a>
	</div>
</div>