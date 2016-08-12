<?php

if ( ! class_exists( 'WB_advance_email_option_Tweak' ) ) {
	class WB_advance_email_option_Tweak {
		function wb_settings( ) {
			?>
			   <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Sender (Return-Path)', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_sender]" type="text" value="<?php echo $this->value['wb_mail_sender']; ?>">
					<br />
                                        <p><?php echo __( "Sets the Sender email (Return-Path) of the message.  If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.", WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Confirm Reading To', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_confirm_reading_to]" type="text" value="<?php echo $this->value['wb_mail_confirm_reading_to']; ?>">
					<br />
                                        <p><?php echo __( 'Sets the email address that a reading confirmation will be sent.', WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			<?php
		}
		
		function is_str_and_not_empty($var) {
			if (!is_string($var))
				return false;
		
			if (empty($var))
				return false;
		
			if ($var=='')
				return false;
		
			return true;
		}
		
		function wb_tweak() {
			
			add_action( 'phpmailer_init', array( $this, 'wp_mail_phpmailer') );
		}
		
		function wp_mail_phpmailer( &$mailer ) {
			
			$phpmailer = &$mailer;
			$wp_mail_options = $this->value;
			
			/**
			* Email priority (1 = High, 3 = Normal, 5 = low).
			* @var int
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_prior'] ) )
			$phpmailer->Priority          =$wp_mail_options['wb_mail_prior'];*/
		
			/**
			* Sets the CharSet of the message.
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_charset'] ) )
			$phpmailer->CharSet           =$wp_mail_options['wb_mail_charset'];*/
		
			/**
			* Sets the Content-type of the message.
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_content_type'] ) )
			$phpmailer->ContentType       =$wp_mail_options['wb_mail_content_type'];*/
		
			/**
			* Sets the Encoding of the message. Options for this are "8bit",
			* "7bit", "binary", "base64", and "quoted-printable".
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_encoding'] ) )
			$phpmailer->Encoding          =$wp_mail_options['wb_mail_encoding'];*/
		
			/**
			* Sets the Sender email (Return-Path) of the message.  If not empty,
			* will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_sender'] ) )
			$phpmailer->Sender            =$wp_mail_options['wb_mail_sender'];
		
			/**
			* Sets the Subject of the message.
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_body'] ) )
			$phpmailer->Subject           =$wp_mail_options['wb_mail_body'];*/
		
			/**
			* Sets the Body of the message.  This can be either an HTML or text body.
			* If HTML then run IsHTML(true).
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_body'] ) )
			$phpmailer->Body              =$wp_mail_options['wb_mail_body'];*/
		
			/**
			* Sets the text-only body of the message.  This automatically sets the
			* email to multipart/alternative.  This body can be read by mail
			* clients that do not have HTML email capability such as mutt. Clients
			* that can read HTML will view the normal Body.
			* @var string
			*/
			/*if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_altbody'] ) )
			$phpmailer->AltBody           =$wp_mail_options['wb_mail_altbody'];*/
		
			/**
			* Sets word wrapping on the body of the message to a given number of
			* characters.
			* @var int
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_word_wrap']))
			$phpmailer->WordWrap          =$wp_mail_options['wb_mail_word_wrap'];*/
		
			/**
			* Method to send mail: ("mail", "sendmail", or "smtp").
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_mailer']))
			$phpmailer->Mailer            =$wp_mail_options['wb_mail_mailer'];*/
		
			/**
			* Sets the path of the sendmail program.
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_sendmail']))
			$phpmailer->Sendmail          =$wp_mail_options['wb_mail_sendmail'];*/
		
			/**
			* Path to PHPMailer plugins.  This is now only useful if the SMTP class
			* is in a different directory than the PHP include path.
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_plugin_dir']))
			$phpmailer->PluginDir         =$wp_mail_options['wb_mail_plugin_dir'];*/
		
			/**
			* Holds PHPMailer version.
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_phpmailer_ver']))
			$phpmailer->Version           =$wp_mail_options['wb_mail_phpmailer_ver'];*/
		
		
			/**
			* Sets the email address that a reading confirmation will be sent.
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_confirm_reading_to']))
			$phpmailer->ConfirmReadingTo  =$wp_mail_options['wb_mail_confirm_reading_to'];
		
			/**
			* Sets the hostname to use in Message-Id and Received headers
			* and as default HELO string. If empty, the value returned
			* by SERVER_NAME is used or 'localhost.localdomain'.
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_host_name']))
			$phpmailer->Hostname          =$wp_mail_options['wb_mail_host_name'];*/
		
			/**
			* Sets the message ID to be used in the Message-Id header.
			* If empty, a unique id will be generated.
			* @var string
			*/
			/*if($this->is_str_and_not_empty($wp_mail_options['wb_mail_message_id']))
			$phpmailer->MessageID         =$wp_mail_options['wb_mail_message_id'];*/
		}
	
	}
}
