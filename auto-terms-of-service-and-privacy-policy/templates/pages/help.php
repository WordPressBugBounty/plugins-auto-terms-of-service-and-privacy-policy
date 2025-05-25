<?php

use wpautoterms\admin\action\Send_Message;
use wpautoterms\admin\Options;
use wpautoterms\cpt\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var $page \wpautoterms\admin\page\Help
 */
$current_user = wp_get_current_user();
$data = $page->action->get_data();
$site_name = Options::get_option( Options::SITE_NAME );
$site_url = Options::get_option( Options::SITE_URL );
$email = $current_user->user_email;
$site_info = Send_Message::DEFAULT_SITE_INFO;
$text = '';
$is_error = isset( $_GET['error'] ) ? (bool) sanitize_text_field( wp_unslash( $_GET['error'] ) ) : false;
$message = isset( $_GET['message'] ) ? sanitize_text_field( wp_unslash( $_GET['message'] ) ) : '';
if ( ! empty( $data ) ) {
	if ( isset( $data['site_name'] ) ) {
		$site_name = $data['site_name'];
	}
	if ( isset( $data['site_url'] ) ) {
		$site_url = $data['site_url'];
	}
	if ( isset( $data['email'] ) ) {
		$email = $data['email'];
	}
	if ( isset( $data['text'] ) ) {
		$text = $data['text'];
	}
	if ( isset( $data['site_info'] ) ) {
		$site_info = $data['site_info'];
	}
}
?>
<div class="wrap">
    <h2><?php echo esc_html( $page->title() ); ?></h2>

    <div id="wpautoterms_notice">
		<?php
		if ( ! empty( $message ) ) {
			echo '<div class="updated ' . ( $is_error ? 'error' : 'notice' ) .
			     ' is-dismissible"><p><strong>' . $message . '</strong></p></div>';
		} ?>
    </div>

    <div id="poststuff">
        <div class="wpautoterms-help-page-container">
            <div data-type="accordion" class="wpautoterms-help-page-help">
				<?php
				include "help-q-a.php";
				?>
            </div>

            <div class="wpautoterms-help-page-form-button">
                <span class="wpautoterms-help-page-no-answer-text"><?php _e( 'Couldn\'t find your answer?', WPAUTOTERMS_SLUG ); ?></span>
                <input type="button" id="wpautoterms_contact_button" class="button button-primary"
                       value="<?php _e( 'Send us a message', WPAUTOTERMS_SLUG ); ?>">
            </div>

            <div id="wpautoterms_form_container" class="wpautoterms-help-page-form">
                <h3>
                    <?php _e( 'Send Us a Message', WPAUTOTERMS_SLUG ); ?>
                    <a href="#" id="wpautoterms_form_container_hide">
                        <small class="wpautoterms-small"><?php esc_html_e( 'hide', WPAUTOTERMS_SLUG ); ?></small>
                    </a>
                </h3>

                <p>In order to troubleshoot any issues you may have with the plugin <strong>please help us by sending us the following information in an email.</strong><br />The more information we have the better we can help.</p>
                <ul>
                    <li>
                        <p>&#x25fb; If it's a server error, please send us the <strong>error_log</strong> file.</p>
                    </li>
                    <li>
                        <p>&#x25fb; Attach full-page screenshots showing the error. Please send full-page screenshots.</p>
                    </li>
                    <li>
                        <p>&#x25fb; Copy-paste the <strong>"Site information"</strong> from below. Add it in a .txt file and attach it or copy-paste it in the email.</p>
                        <div class="ui-accordion">
                            <textarea name="wpautoterms_site_information" id="wpautoterms_site_information"
                                      cols="30" rows="10" data-site-name="<?php echo $site_name; ?>" data-site-url="<?php echo $site_url; ?>" data-email="<?php echo $email; ?>">
                            </textarea>
                            <small><span id="wpautoterms_copy_site_information">Copy to clipboard</span></small>
                        </div>
                    </li>
                </ul>
                <p><strong>Send your bug report and the above information to <a href="mailto:office@termsfeed.com?subject=Issue report from <?php echo $site_name; ?> (<?php echo $site_url; ?>)">office@termsfeed.com</a></strong></p>

            </div>
        </div>
    </div>

</div>
