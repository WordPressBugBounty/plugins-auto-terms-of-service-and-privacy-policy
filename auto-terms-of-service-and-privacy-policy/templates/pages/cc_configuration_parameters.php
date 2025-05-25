<?php

use wpautoterms\admin\Menu;
use wpautoterms\cpt\CPT;

if (!defined('ABSPATH')) {
	exit;
}

// Ensure all template variables are safe
$tabs_html = isset($tabs_html) && !empty($tabs_html) ? $tabs_html : '';
$footer = isset($footer) && !empty($footer) ? $footer : '';
$page_id = '';
if (isset($page) && is_object($page) && method_exists($page, 'id')) {
	$page_id = $page->id();
}
$page_id = $page_id ? $page_id : '';

?>

<div class="wrap">
	<?php if ($tabs_html): ?>
		<?php echo $tabs_html; ?>
	<?php endif; ?>
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
		<?php if ($page_id): ?>
			<?php settings_fields( $page_id ); ?>
			<?php do_settings_sections( $page_id ); ?>
		<?php endif; ?>

		<?php if ($footer): ?>
			<?php echo $footer; ?>
		<?php endif; ?>
	</form>
</div>
