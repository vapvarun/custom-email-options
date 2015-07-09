<?php

if ( ! class_exists( 'WB_advance_email_option_Tweak' ) ) {
	class WB_advance_email_option_Tweak {
		function wb_settings( ) {
			?>
			<tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Email Priority', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_prior]" type="text" value="<?php echo $this->value['wb_mail_prior']; ?>"> 
					<br />
					<?php echo __( 'Email priority (1 = High, 3 = Normal, 5 = low).', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'CharSet', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_charset]" type="text" value="<?php echo $this->value['wb_mail_charset']; ?>">
					<br />
					<?php echo __( 'Sets the CharSet of the message.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Content-type', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_content_type]" type="text" value="<?php echo $this->value['wb_mail_content_type']; ?>">
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Encoding', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_encoding]" type="text" value="<?php echo $this->value['wb_mail_encoding']; ?>">
					<br />
					<?php echo __( 'Sets the Encoding of the message. Options for this are "8bit", "7bit", "binary", "base64", and "quoted-printable".', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Sender (Return-Path)', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_sender]" type="text" value="<?php echo $this->value['wb_mail_sender']; ?>">
					<br />
					<?php echo __( "Sets the Sender email (Return-Path) of the message.  If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Subject', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_subject]" type="text" value="<?php echo $this->value['wb_mail_subject']; ?>">
					<br />
					<?php echo __( "Sets the Subject of the message.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Body', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <textarea cols="15" rows="5" style="width: 153px;" name="<?php echo $this->option; ?>[wb_mail_body]"><?php echo $this->value['wb_mail_body']; ?></textarea> 
					<br />
					<?php echo __( "Sets the Body of the message.  This can be either an HTML or text body. If HTML then run IsHTML(true).", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Alternative Body', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <textarea cols="15" rows="5" style="width: 153px;" name="<?php echo $this->option; ?>[wb_mail_altbody]"><?php echo $this->value['wb_mail_altbody']; ?></textarea> 
					<br />
					<?php echo __( "Sets the text-only body of the message.  This automatically sets the email to multipart/alternative.  This body can be read by mail clients that do not have HTML email capability such as mutt. Clients that can read HTML will view the normal Body.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'WordWrap', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_word_wrap]" type="text" value="<?php echo $this->value['wb_mail_word_wrap']; ?>">
					<br />
					<?php echo __( "Sets word wrapping on the body of the message to a given number of characters.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Mailer', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_mailer]" type="text" value="<?php echo $this->value['wb_mail_mailer']; ?>">
					<br />
					<?php echo __( 'Method to send mail: ("mail", "sendmail", or "smtp").', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Sendmail Program', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_sendmail]" type="text" value="<?php echo $this->value['wb_mail_sendmail']; ?>">
					<br />
					<?php echo __( 'Sets the path of the sendmail program.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'PHPMailer Plugins Path', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_plugin_dir]" type="text" value="<?php echo $this->value['wb_mail_plugin_dir']; ?>">
					<br />
					<?php echo __( 'Path to PHPMailer plugins.  This is now only useful if the SMTP class is in a different directory than the PHP include path.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'PHPMailer Version', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_phpmailer_ver]" type="text" value="<?php echo $this->value['wb_mail_phpmailer_ver']; ?>">
					<br />
					<?php echo __( 'Holds PHPMailer version.', WB_CHANGE_EMAIL_SLUG ); ?>
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
					<?php echo __( 'Sets the email address that a reading confirmation will be sent.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Hostname', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_host_name]" type="text" value="<?php echo $this->value['wb_mail_host_name']; ?>">
					<br />
					<?php echo __( "Sets the hostname to use in Message-Id and Received headers and as default HELO string. If empty, the value returned by SERVER_NAME is used or 'localhost.localdomain'.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'MessageID', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_message_id]" type="text" value="<?php echo $this->value['wb_mail_message_id']; ?>">
					<br />
					<?php echo __( "Sets the message ID to be used in the Message-Id header. If empty, a unique id will be generated.", WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
			</tr>
			<?php
		}
		
		function is_string_and_not_empty($var) {
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
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_prior'] ) )
			$phpmailer->Priority          =$wp_mail_options['wb_mail_prior'];
		
			/**
			* Sets the CharSet of the message.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_charset'] ) )
			$phpmailer->CharSet           =$wp_mail_options['wb_mail_charset'];
		
			/**
			* Sets the Content-type of the message.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_content_type'] ) )
			$phpmailer->ContentType       =$wp_mail_options['wb_mail_content_type'];
		
			/**
			* Sets the Encoding of the message. Options for this are "8bit",
			* "7bit", "binary", "base64", and "quoted-printable".
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_encoding'] ) )
			$phpmailer->Encoding          =$wp_mail_options['wb_mail_encoding'];
		
			/**
			* Sets the Sender email (Return-Path) of the message.  If not empty,
			* will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_subject'] ) )
			$phpmailer->Sender            =$wp_mail_options['wb_mail_subject'];
		
			/**
			* Sets the Subject of the message.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_body'] ) )
			$phpmailer->Subject           =$wp_mail_options['wb_mail_body'];
		
			/**
			* Sets the Body of the message.  This can be either an HTML or text body.
			* If HTML then run IsHTML(true).
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_body'] ) )
			$phpmailer->Body              =$wp_mail_options['wb_mail_body'];
		
			/**
			* Sets the text-only body of the message.  This automatically sets the
			* email to multipart/alternative.  This body can be read by mail
			* clients that do not have HTML email capability such as mutt. Clients
			* that can read HTML will view the normal Body.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_altbody'] ) )
			$phpmailer->AltBody           =$wp_mail_options['wb_mail_altbody'];
		
			/**
			* Sets word wrapping on the body of the message to a given number of
			* characters.
			* @var int
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_word_wrap']))
			$phpmailer->WordWrap          =$wp_mail_options['wb_mail_word_wrap'];
		
			/**
			* Method to send mail: ("mail", "sendmail", or "smtp").
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_mailer']))
			$phpmailer->Mailer            =$wp_mail_options['wb_mail_mailer'];
		
			/**
			* Sets the path of the sendmail program.
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_sendmail']))
			$phpmailer->Sendmail          =$wp_mail_options['wb_mail_sendmail'];
		
			/**
			* Path to PHPMailer plugins.  This is now only useful if the SMTP class
			* is in a different directory than the PHP include path.
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_plugin_dir']))
			$phpmailer->PluginDir         =$wp_mail_options['wb_mail_plugin_dir'];
		
			/**
			* Holds PHPMailer version.
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_phpmailer_ver']))
			$phpmailer->Version           =$wp_mail_options['wb_mail_phpmailer_ver'];
		
		
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
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_host_name']))
			$phpmailer->Hostname          =$wp_mail_options['wb_mail_host_name'];
		
			/**
			* Sets the message ID to be used in the Message-Id header.
			* If empty, a unique id will be generated.
			* @var string
			*/
			if($this->is_str_and_not_empty($wp_mail_options['wb_mail_message_id']))
			$phpmailer->MessageID         =$wp_mail_options['wb_mail_message_id'];
		}
	
	}
}