<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use wpautoterms\admin\Menu;
use wpautoterms\legal_pages;
use wpautoterms\Wpautoterms;


/**
 * @var $pages_by_type array
 */

// WARNING: #poststuff style block should reside here
?>
<style>
    #poststuff {
        display: none;
    }
</style>

<div id="wpautoterms_notice">
	<?php
	if ( ! get_option( WPAUTOTERMS_OPTION_PREFIX . 'settings_warning_disable' ) ) {
		?>
        <div class="info settings-error notice wpautoterms-is-dismissible">
            <div class="wpautoterms-notice-permanent-hide">
                <label><input type="checkbox" data-type="permanent-dismiss" data-name="settings_warning_disable"/>
					<?php _e( 'do not show again', WPAUTOTERMS_SLUG ); ?>
                </label>
            </div>
            <p>
				<?php _e( 'Please make sure the website information is correct at the', WPAUTOTERMS_SLUG ); ?>
                <strong><a href="<?php
					echo esc_url( admin_url( 'edit.php?post_type=' . \wpautoterms\cpt\CPT::type() . '&page=' . WPAUTOTERMS_SLUG . '_' . Menu::PAGE_SETTINGS ) );
					?>"><?php _e( 'Settings page', WPAUTOTERMS_SLUG ); ?></a></strong>
				<?php _e( 'before you create a legal page.', WPAUTOTERMS_SLUG ); ?>
            </p>
            <button type="button" class="notice-dismiss" data-type="dismiss-button"
                    data-name="settings_warning_disable">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', WPAUTOTERMS_SLUG ); ?></span>
            </button>
        </div>
		<?php
	}
	if ( ! empty( $agreement_error ) ) {
		?>
        <div class="info error notice wpautoterms-is-dismissible">
            <p>
				<?php echo esc_html( sprintf( _x( '%s: %s', 'Agreement generation error', WPAUTOTERMS_SLUG ),
					__( 'Agreement generation error', WPAUTOTERMS_SLUG ), $agreement_error ) ); ?>
            </p>
            <button type="button" class="notice-dismiss" data-type="dismiss-button">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', WPAUTOTERMS_SLUG ); ?></span>
            </button>
        </div>
		<?php
	}
	?>
</div>

<div class="postbox-container" id="legal-page-create-selector">
	<?php
	foreach ( legal_pages\Conf::get_groups() as $agreement ) {
		$pages = legal_pages\Conf::get_legal_pages( $agreement->id );
		if ( empty( $pages ) ) {
			continue;
		}
		?>

		<?php
		foreach ( $pages as $page_info ) {
			$page  = Wpautoterms::get_legal_page( $page_info->id );
			$avail = $page->availability();
			?>
            <div class="postbox wpautoterms-options-box<?php if ( $page_info->is_paid ) {
				echo ' wpautoterms-paid';
			} ?>">
                <h3><?php echo esc_html( $page_info->title ); ?>
					<?php if ( $pages_by_type[ $page_info->id ] > 0 ) { ?>
                        <span class="wpautoterms-legal-page-count">
                                    (<?php echo esc_html( $pages_by_type[ $page_info->id ] ); ?>)</span>
					<?php } ?>
                </h3>
                <div class="inside"><?php if ( $avail !== true ) { ?>
                        <p><?php echo esc_html( $avail ); ?></p>
					<?php } ?>
                    <p><?php echo esc_html( $page_info->description ); ?></p>
                </div>
                <div class="wpautoterms-box-configure-button">
                    <a class="button<?php if ( $avail === true ) {
						echo ' button-primary';
					} else {
						echo ' wpautoterms-button-disabled';
					} ?>" href="<?php
					echo esc_url( wp_nonce_url( admin_url( 'post-new.php?post_type=wpautoterms_page&page_name=' . $page_info->id ), 'add-post' ) );
					?>" id="<?php echo esc_attr( $page_info->id ); ?>">
						<?php _e( 'Create', WPAUTOTERMS_SLUG ); ?>
                    </a>
                </div>
            </div>
		<?php }
		?>

		<?php
	}
	?>

    <div class="postbox wpautoterms-options-box">
        <h3>
			<?php _e( 'Custom Legal Page', WPAUTOTERMS_SLUG ); ?>
        </h3>
        <div class="inside">
            <p><?php _e( 'Create your own custom legal page and manage it through TermsFeed AutoTerms.', WPAUTOTERMS_SLUG ); ?></p>
        </div>
        <div class="wpautoterms-box-configure-button<?php if ( $avail !== true ) {
			echo ' wpautoterms-link-disable';
		} ?>">
            <a class="button button-primary" href="<?php
			echo esc_url( wp_nonce_url( admin_url( 'post-new.php?post_type=wpautoterms_page&page_name=custom' ), 'add-post' ) );
			?>" id="legal-page-custom">
				<?php _e( 'Create', WPAUTOTERMS_SLUG ); ?>
            </a>
        </div>
    </div>

</div>
<noscript><?php _e( 'Please, enable javascript to continue.', WPAUTOTERMS_SLUG ); ?></noscript>
