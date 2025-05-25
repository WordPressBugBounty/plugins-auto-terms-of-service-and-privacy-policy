<?php

use wpautoterms\cpt\CPT;

if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wpautoterms-box-page-submit">
	<input type="submit" name="submit" id="submit" class="button button-primary"
	       value="<?php _e('Save Changes'); ?>"/>
</div>
<div class="wpautoterms-box-page-back">
	<a href="edit.php?post_type=<?php echo CPT::type(); ?>&page=wpautoterms_compliancekits">
		<?php _e('Back to Compliance Kits', WPAUTOTERMS_SLUG); ?>
	</a>
</div>