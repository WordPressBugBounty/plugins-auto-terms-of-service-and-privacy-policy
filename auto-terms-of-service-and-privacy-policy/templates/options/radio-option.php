<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="<?php echo $classes; ?>"<?php echo $attrs; ?>>
	<?php
	foreach ( $values as $k => $v ) {
		$k = trim( $k );
		if ( trim( $k ) == $value ) {
			$selected = ' checked="checked"';
		} else {
			$selected = '';
		}
		?>
		<div class="radio-value">
			<input type="radio" name="<?php echo $name; ?>"
			       value="<?php echo esc_attr( $k ); ?>"<?php echo $selected; ?>
			       id="radio-<?php echo $name; ?>-<?php echo esc_attr( $k ); ?>">
			<label for="radio-<?php echo $name; ?>-<?php echo esc_attr( $k ); ?>"><?php echo esc_html( $v ); ?></label>
		</div>
		<?php
	}
	?>
</div>
<span class="wpautoterms-hidden" data-name="<?php echo $name; ?>" data-type="notice"></span>
<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'option-suffix.php';
