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
		<div id="vendor-script-add">
			<h3>Add a new Vendor Script</h3>
			<table>
				<tbody>
					<tr>
						<td>
							
							<table class="form-table" role="presentation">
								<tbody>
									<tr>
										<th scope="row">Name</th>
										<td><input type="text" class="" name="wpautoterms_vendor_script_name" id="wpautoterms_vendor_script_name" value="" placeholder="Google Analytics"></td>
									</tr>
									<tr>
										<th>Type</th>
										<td>
											<div>
												<label><input type="radio" name="wpautoterms_vendor_script_type" value="strictly-necessary" checked="checked"> <strong>Strictly Necessary</strong> (i.e. account login related cookies)</label>
											</div>
											<div>
												<label><input type="radio" name="wpautoterms_vendor_script_type" value="functionality"> <strong>Functionality</strong> (i.e. remembering user choices)</label>
											</div>
											<div>
												<label><input type="radio" name="wpautoterms_vendor_script_type" value="tracking"> <strong>Tracking and Performance</strong> (i.e. Google Analytics)</label>
											</div>
											<div>
												<label><input type="radio" name="wpautoterms_vendor_script_type" value="targeting"> <strong>Targeting and Advertising</strong> (i.e. Google AdSense, Google AdWords)</label>
											</div>
										</td>
									</tr>
									<tr>
										<th>Script</th>
										<td>
											<textarea name="wpautoterms_vendor_script_code" id="wpautoterms_vendor_script_code" cols="80" rows="6" placeholder="&#x3C;script async src=&#x22;https://www.googletagmanager.com/gtag/js?id=ID&#x22;&#x3E;&#x3C;/script&#x3E;&#x3C;script&#x3E;window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag(&#x27;js&#x27;, new Date());gtag(&#x27;config&#x27;, &#x27;ID&#x27;);&#x3C;/script&#x3E;"></textarea>
										</td>
									</tr>
									<tr>
										<th></th>
										<td><button type="button" class="button button-primary" id="add-vendor-script">Add vendor script</button></td>
									</tr>
								</tbody>
							</table>
							
						</td>
					</tr>
				</tbody>
			</table>


		</div>
		
		<h3>Vendor Scripts</h3>

		<div id="vendor-scripts">
			<table class="wp-list-table wp-list-table widefat fixed striped table-view-list hidden">
				<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Code</th>
					<th>Order</th>
					<th>Options</th>
				</tr>
				</thead>
				<tbody id="the-list"></tbody>
			</table>
		</div>
		<?php if ($page_id): ?>
			<?php settings_fields( $page_id ); ?>
			<?php do_settings_sections( $page_id ); ?>
		<?php endif; ?>

		<?php if ($footer): ?>
			<?php echo $footer; ?>
		<?php endif; ?>
	</form>
</div>
