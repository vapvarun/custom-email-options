<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
 
	delete_option( WB_CHANGE_EMAIL_OPTION );
	delete_option( WB_ADVANCE_EMAIL_OPTION );
	delete_option( 'wb-sender-email-version' );
	delete_option( 'wb-sender-email-updater-id' );

?>