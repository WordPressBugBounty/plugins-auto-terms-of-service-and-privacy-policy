<?php

use wpautoterms\cpt\CPT;

if (!defined('ABSPATH')) {
	exit;
}

$page_prefix = WPAUTOTERMS_SLUG . '_';
$tabs = isset($tabs) ? $tabs : [];
$current_tab = isset($current_tab) ? $current_tab : '';

// Ensure CPT type is never null
$cpt_type = '';
try {
	$cpt_type = CPT::type();
} catch (Exception $e) {
	$cpt_type = 'wpautoterms_page';
}
$cpt_type = $cpt_type ? $cpt_type : 'wpautoterms_page';

?>
<h1><?php echo esc_html(__( 'Cookie Consent', WPAUTOTERMS_SLUG )); ?></h1>
<?php if (!empty($tabs) && is_array($tabs)): ?>
	<h2 class="nav-tab-wrapper">
		<?php foreach ($tabs as $key => $tab): ?>
			<?php 
			$tab_name = isset($tab['name']) && !empty($tab['name']) ? $tab['name'] : '';
			$tab_key = $key ? $key : '';
			
			// Skip if we don't have valid data
			if (empty($tab_key) || empty($tab_name)) {
				continue;
			}
			?>
			<a href="edit.php?post_type=<?php echo esc_attr($cpt_type); ?>&page=<?php echo esc_attr($page_prefix . $tab_key); ?>"
			   class="nav-tab <?php if ($tab_key == $current_tab): ?>nav-tab-active<?php endif; ?>">
				<?php echo esc_html(__($tab_name, WPAUTOTERMS_SLUG)); ?>
			</a>
		<?php endforeach; ?>

	</h2>
<?php endif; ?>