<?php
/*
Plugin Name: Custom Email Options
Plugin URI: https://wbcomdesigns.com/plugins/custom-email-options/
Description: Sender Email/Name Change and General Tweaks Options
Version: 1.0.4
Text Domain: wb-change-sender-email
Author: Wbcom Designs<admin@wbcomdesigns.com>
Author URI: http://www.wbcomdesigns.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

	if ( ! defined( 'ABSPATH' ) ) {
		die( '-1' );
	}
	
	define( 'WB_CHANGE_EMAIL_NAME',          'Custom Email Options' );
	define( 'WB_CHANGE_EMAIL_VERSION',       '1.0.3' );
	define( 'WB_CHANGE_EMAIL_SLUG',          'wb-change-sender-email' );
	define( 'WB_CHANGE_EMAIL_OPTION',        'wb-change-sender-email' );
	define( 'WB_ADVANCE_EMAIL_OPTION',       'wb-change-advance-email' );
	define( 'WB_SMTP_EMAIL_OPTION',       	 'wb-change-smtp-email' );
	define( 'WB_CHANGE_EMAIL_PLUGIN_PATH',   plugin_dir_path( __FILE__ ) );
	define( 'WB_CHANGE_EMAIL_PLUGIN_URL',    plugin_dir_url( __FILE__ ) );
	define( 'WB_CHANGE_EMAIL_UPDATER_ID',    200 );
	
	//Class to display html and add hooks, main class of the plugin
	if ( ! class_exists( 'wb_sender_email_tweaker_Plugin_File' ) ) {
		class wb_sender_email_tweaker_Plugin_File {
			
			//calls the default hooks on plugin activation and get values of the setting saved in the option table
			function __construct() {
				global $wb_general_tweak, $wb_advance_tweak,$wb_smtp_tweak;
				$wb_general_tweak = get_option( WB_CHANGE_EMAIL_OPTION );
				$wb_advance_tweak = get_option( WB_ADVANCE_EMAIL_OPTION );
				$wb_smtp_tweak = get_option( WB_SMTP_EMAIL_OPTION );
				if ( is_multisite() )
                                    add_action( 'network_admin_menu', array( $this, 'register_admin_menu_page' ) );
				else
                                    add_action( 'admin_menu', array( $this, 'register_admin_menu_page' ) );
				add_action( 'admin_init', array( $this, 'save_wb_general_data_pages' ) );
				add_action( 'admin_init', array( $this, 'save_wb_advance_data_pages' ) );
				add_action( 'admin_init', array( $this, 'save_wb_smtp_data_pages' ) );
				add_action( 'init', array( $this, 'wb_load_tweak' ), 99 );
				add_action( 'init', array($this, 'wb_sent_test_email' ), 10 );
                                add_action('init', array($this, 'enqueue_admin_style_func' ), 10);
				$this->test_email_msg = "";
                                $this->general = array( //array of the tab based template section to be called in particular tab
						'General Settings'	=> array(
                                                                                    'general_email_from',
                                                                                    'general_email_from_name',
                                                                                    'general_page404_redirect',
                                                                                    'general_title_wptexturize_no',
                                                                                    'general_generation_time',
                                                                                    'general_settings_remove',
                                                                                    'general_email_send_from'
                                                                            ),
                                                    'Extra Settings'	=> array(
                                                                                    'advance_email_option'
                                                                            ),
                                                    'Smtp Settings'	=> array(
                                                                                    'smtp_email_option'
                                                                            ),
                                                    'Test Email'	=> array(
                                                                                    'general_send_email_test',
                                                                                 ),
                                            );                           
			}
                        
			// Adding custom style on admin settings page
                        function enqueue_admin_style_func () {
                        
                            /********** Load CSS File *****************/
                            wp_register_style( 'custom-admin-style', WB_CHANGE_EMAIL_PLUGIN_URL.'assets/css/cop-style.css', array() );
                            wp_enqueue_style( 'custom-admin-style' );
                        }
                        
                        // Add the menu to the menu bar
			function register_admin_menu_page() {
	
				add_menu_page( 'Email Options', 'Email Options', 'manage_options', 'wb_general_tweaker', array($this,'wb_general_menu_page'), '', 81 );
			
			}
			
			function save_wb_general_data_pages()
			{
				global $wb_general_tweak, $wb_advance_tweak;
				$nonce = str_replace( ' ', '_', 'General Settings' );
					if ( isset( $_POST['save_wb_general_data_nonce'] ) && wp_verify_nonce( $_POST['save_wb_general_data_nonce'], $nonce ) )
					 {
						 $wb_general_tweak = $_POST['wb_general_tweak'];
						 update_option( WB_CHANGE_EMAIL_OPTION, $wb_general_tweak );
                                                 
					 }
                                $general_settings = get_option(WB_CHANGE_EMAIL_OPTION);
                                if ($general_settings['general_email_send_from'] != 'yes')
                                    unset($this->general['Smtp Settings']);
                                else {
                                     $this->general = array( //array of the tab based template section to be called in particular tab
							'General Settings'  => array(
											'general_email_from',
											'general_email_from_name',
											'general_page404_redirect',
											'general_title_wptexturize_no',
											'general_generation_time',
											'general_settings_remove',
                                                                                        'general_email_send_from'
										),
							'Extra Settings'	=> array(
											'advance_email_option'
										),
							'Smtp Settings'	=> array(
											'smtp_email_option'
										),
							'Test Email'		=> array(
											'general_send_email_test',
										),
					);
                                }
			}
			
			function save_wb_advance_data_pages()
			{
				global $wb_advance_tweak;
				$nonce = str_replace( ' ', '_', 'Extra Settings' );
					 
					 if ( isset( $_POST['save_wb_general_data_nonce'] ) && wp_verify_nonce( $_POST['save_wb_general_data_nonce'], $nonce ) )
					 {
						 $wb_advance_tweak = $_POST['advance_email_option'];
						 update_option( WB_ADVANCE_EMAIL_OPTION, $wb_advance_tweak );
					 }
			}
			
			function save_wb_smtp_data_pages()
			{
				global $wb_smtp_tweak;
				$nonce = str_replace( ' ', '_', 'Smtp Settings' );
					 
					 if ( isset( $_POST['save_wb_general_data_nonce'] ) && wp_verify_nonce( $_POST['save_wb_general_data_nonce'], $nonce ) )
					 {
						 $wb_smtp_tweak = $_POST['smtp_email_option'];
						 update_option( WB_SMTP_EMAIL_OPTION, $wb_smtp_tweak );
					 }
			}
			
			//Function to sent the testing email
			function wb_sent_test_email()
			{
				$nonce=str_replace( ' ', '_', 'Test Email' );
					if ( isset( $_POST['save_wb_general_data_nonce'] ) && wp_verify_nonce( $_POST['save_wb_general_data_nonce'], $nonce ) )
					 {
						global $wb_general_tweak, $wb_smtp_tweak;
						if($wb_general_tweak['general_email_send_from'] == 'yes'):					
							$errors = '';
	
							$swpsmtp_options = $wb_smtp_tweak;
					
							require_once( ABSPATH . WPINC . '/class-phpmailer.php' );
							$mail = new PHPMailer();
							
							$from_name  = utf8_decode($swpsmtp_options['wb_mail_from_name']);
							$from_email = $swpsmtp_options['wb_mail_from_email']; 
							
							$mail->IsSMTP();
							
							/* If using smtp auth, set the username & password */
							if( 'yes' == $swpsmtp_options['wb_mail_auth']){
								$mail->SMTPAuth = true;
								$mail->Username = $swpsmtp_options['wb_mail_username'];
								$mail->Password = $swpsmtp_options['wb_mail_password'];
							}
							
							/* Set the SMTPSecure value, if set to none, leave this blank */
							if ( $swpsmtp_options['wb_mail_encription'] !== '' ) {
								$mail->SMTPSecure = $swpsmtp_options['wb_mail_encription'];
							}
							
							/* Set the other options */
							$mail->Host = $swpsmtp_options['wb_mail_smtp_host'];
							$mail->Port = $swpsmtp_options['wb_mail_port']; 
							$mail->SetFrom( $from_email, $from_name );
							$mail->isHTML( true );
							$mail->Subject = utf8_decode($_POST['mail_subject']);
							$mail->MsgHTML( $_POST['mail_message'] );
							$mail->AddAddress( $_POST['mail_to'] );
							$mail->SMTPDebug = 0;
					
							/* Send mail and return result */
							if ( ! $mail->Send() )
								$errors = $mail->ErrorInfo;
							
							$mail->ClearAddresses();
							$mail->ClearAllRecipients();
								
							if ( ! empty( $errors ) ) {
								$this->test_email_msg = $errors;
							}
							else{
								$this->test_email_msg = 'Test is successful';
							}
						else:
							 if(wp_mail($_POST['mail_to'], $_POST['mail_subject'],$_POST['mail_message'])) {
								$this->test_email_msg = 'Test is successful';
							} else {
								$this->test_email_msg = 'Test failed';
							}
						endif;
					 }
			}
			
			//function to apply the settings done by the user
			function wb_load_tweak()
			{
				global $wb_general_tweak, $wb_advance_tweak,$wb_smtp_tweak;
				$cur_tab = isset($_GET['tab'])?$_GET['tab']:'';
				foreach( $this->general as $tab => $tweakval )
				{
					if( !empty( $tweakval ) ):
						$nonce = str_replace( ' ', '_', $tab );
						foreach( $tweakval as $tweak_ID )
						{
							require_once( WB_CHANGE_EMAIL_PLUGIN_PATH . "includes/{$tweak_ID}/tweak.php" );
							$tweakCls = "WB_{$tweak_ID}_Tweak";
							$tweak = new $tweakCls();
							$tweak->option = $tweak_ID;
							if($nonce == 'General_Settings')
							{
								$tweak->value = $wb_general_tweak[ $tweak_ID ];
								if( isset( $wb_general_tweak[ $tweak_ID ] ) && $wb_general_tweak[ $tweak_ID ] != "" )
                                                                    $tweak->wb_tweak(); 
							}
							else if($nonce == 'Smtp_Settings')
							{
								$tweak->value = $wb_smtp_tweak;
								if( isset( $wb_smtp_tweak ) && !empty( $wb_smtp_tweak ) )
                                                                    $tweak->wb_tweak();
							}
							else
							{
								$tweak->value = $wb_advance_tweak;
								if( isset( $wb_advance_tweak ) && !empty( $wb_advance_tweak ) )
                                                                    $tweak->wb_tweak();
							}
						}
						endif;	
				}
			}
			
			//Function to generate the tab based html view of the page
			function wb_general_menu_page()
			{
				global $wb_general_tweak,$wb_advance_tweak,$wb_smtp_tweak;
				?>
				<div class="wrap">
					<h2>Email Change and General Tweaks Options</h2>
					<h2 class="nav-tab-wrapper">
					<?php 
					$cur_tab = isset($_GET['tab'])?$_GET['tab']:'';
					foreach( $this->general as $tab=>$val )
					{
						$current = ( $cur_tab == str_replace( ' ', '_', $tab ) || ( $tab == 'General Settings' && $cur_tab == "")) ? 'nav-tab-active' : '';
						if ( is_multisite() )
                                                    $admin_url = ( $tab == 'General Settings' ) ? network_admin_url( 'admin.php?page=wb_general_tweaker' ) : network_admin_url( 'admin.php?page=wb_general_tweaker&tab='.str_replace( ' ', '_', $tab ) );
						else
                                                    $admin_url = ( $tab == 'General Settings' ) ? admin_url( 'admin.php?page=wb_general_tweaker' ) : admin_url( 'admin.php?page=wb_general_tweaker&tab='.str_replace( ' ', '_', $tab ) );
						
					echo '<a href="'.$admin_url.'" class="nav-tab '.$current.'">'.$tab.'</a>';
					}?>
				</h2>
				<?php 
				foreach( $this->general as $tab=>$tweakval )
					{
					if( !empty( $tweakval ) && $cur_tab == str_replace( ' ', '_', $tab ) || ( $tab=='General Settings' && $cur_tab=="" ) ):
					$nonce = str_replace( ' ', '_', $tab );
					?>
					<form method="POST" action="">
						<table class="form-table">
				  <?php
						foreach( $tweakval as $tweak_ID )
						{
							require_once( WB_CHANGE_EMAIL_PLUGIN_PATH . "includes/{$tweak_ID}/tweak.php" );
							$tweakCls = "WB_{$tweak_ID}_Tweak";
							$tweak = new $tweakCls();
							$tweak->option = $tweak_ID;
							if( $nonce == 'General_Settings' )
							{
								$tweak->value = $wb_general_tweak[ $tweak_ID ];
							}
							else if($nonce == 'Test_Email')
							{
								$tweak->value = $this->test_email_msg;
							}
							else if($nonce == 'Smtp_Settings')
							{
								$tweak->value = $wb_smtp_tweak;
							}
							else
							{
								$tweak->value = $wb_advance_tweak;
							}
							$tweak->wb_settings();
						}?>
						<tr valign="top">
							<td colspan="2">
							 <?php wp_nonce_field( $nonce, 'save_wb_general_data_nonce' ); ?>
							<input type="submit" name="save-wb-general-data" value="SUBMIT" /></td>
						</tr>
						</table>
					</form>
				 <?php
					endif;
					}
					?>
				</div>
				<?php
			}
		}
		new wb_sender_email_tweaker_Plugin_File();
	}
	//Activation Hook to add default option values
	function wb_sender_email_activate() {
	
		update_option( 'wb-sender-email-version', WB_CHANGE_EMAIL_VERSION );
		update_option( 'wb-sender-email-updater-id', WB_CHANGE_EMAIL_UPDATER_ID );
	}
	register_activation_hook( __FILE__, 'wb_sender_email_activate' );
	
	//Deactivation Hook to remove default option values if user has marked to delete them
	function wb_sender_email_deactivate() {
		
		$wb_general_tweak = get_option( WB_CHANGE_EMAIL_OPTION );
		if( $wb_general_tweak['general_settings_remove'] == "yes" )
		{
			delete_option( WB_CHANGE_EMAIL_OPTION );
			delete_option( WB_ADVANCE_EMAIL_OPTION );
			delete_option( WB_SMTP_EMAIL_OPTION );
			delete_option( 'wb-sender-email-version' );
			delete_option( 'wb-sender-email-updater-id' );
		}
	}
	register_deactivation_hook( __FILE__, 'wb_sender_email_deactivate' );
?>
