<?php

if ( ! class_exists( 'WB_smtp_email_option_Tweak' ) ) {
	class WB_smtp_email_option_Tweak {
		function wb_settings( ) {
			?>
			 <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'From Email Address', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_from_email]" type="text" value="<?php echo $this->value['wb_mail_from_email']; ?>"> 
					<br />
                                        <p><?php echo __( 'This email address will be used in the "From" field.', WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'From Name', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_from_name]" type="text" value="<?php echo $this->value['wb_mail_from_name']; ?>">
					<br />
                                        <p><?php echo __( 'This text will be used in the "FROM" field', WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'SMTP Host', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_smtp_host]" type="text" value="<?php echo $this->value['wb_mail_smtp_host']; ?>">
					<br />
                                        <p><?php echo __( 'Your mail server', WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Type of Encription', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <label ><input name="<?php echo $this->option; ?>[wb_mail_encription]" type="radio" value="" <?php echo ($this->value['wb_mail_encription']=="")?' checked="checked"':'';?>> None</label>
				   <label ><input name="<?php echo $this->option; ?>[wb_mail_encription]" type="radio" value="ssl" <?php echo ($this->value['wb_mail_encription']=="ssl")?' checked="checked"':'';?>> SSL</label> 
				   <label ><input name="<?php echo $this->option; ?>[wb_mail_encription]" type="radio" value="tsl" <?php echo ($this->value['wb_mail_encription']=="tsl")?' checked="checked"':'';?>> TSL</label> 
					<br />
                                        <p><?php echo __( 'For most servers SSL is the recommended option', WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'SMTP Port', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_port]" type="text" value="<?php echo $this->value['wb_mail_port']; ?>">
					<br />
                                        <p><?php echo __( "The port to your mail server", WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'SMTP Authentication', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <label ><input name="<?php echo $this->option; ?>[wb_mail_auth]" type="radio" value="yes" <?php echo ($this->value['wb_mail_auth']=="yes")?' checked="checked"':'';?>> Yes</label>
				   <label ><input name="<?php echo $this->option; ?>[wb_mail_auth]" type="radio" value="" <?php echo ($this->value['wb_mail_auth']=="")?' checked="checked"':'';?>> No</label> 
					<br />
                                        <p><?php echo __( "This options should always be checked 'Yes'", WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'SMTP username', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_username]" type="text" value="<?php echo $this->value['wb_mail_username']; ?>">
					<br />
                                        <p><?php echo __( "The username to login to your mail server", WB_CHANGE_EMAIL_SLUG ); ?></p>
				</td>
              </tr>
			  <tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'SMTP Password', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="<?php echo $this->option; ?>[wb_mail_password]" type="password" value="<?php echo $this->value['wb_mail_password']; ?>">
					<br />
                                        <p><?php echo __( 'The password to login to your mail server', WB_CHANGE_EMAIL_SLUG ); ?></p>
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
			global $wb_general_tweak;
			if($wb_general_tweak['general_email_send_from'] == 'yes')
			add_action( 'phpmailer_init', array( $this, 'wp_mail_phpmailer') );
		}
		
		function wp_mail_phpmailer( &$mailer ) {
			$phpmailer = &$mailer;
			$wp_mail_options = $this->value;
			$phpmailer->IsSMTP();
			
			
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_from_email'] ) )
			$phpmailer->From          =$wp_mail_options['wb_mail_from_email'];
		
			
			
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_from_name'] ) )
			$phpmailer->FromName           =$wp_mail_options['wb_mail_from_name'];
		
			
			/* Set the SMTPSecure value */
			if ( $wp_mail_options['wb_mail_encription'] !== '' ) {
				$phpmailer->SMTPSecure = $wp_mail_options['wb_mail_encription'];
			}
		
			
			
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_smtp_host'] ) )
			$phpmailer->Host          =$wp_mail_options['wb_mail_smtp_host'];
		
			
			
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_port'] ) )
			$phpmailer->Port            =$wp_mail_options['wb_mail_port'];
		
			
			if( 'yes' == $wp_mail_options['wb_mail_auth'] ):
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_auth'] ) )
			$phpmailer->SMTPAuth = true;  
		
			/**
			* Sets the Body of the message.  This can be either an HTML or text body.
			* If HTML then run IsHTML(true).
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_username'] ) )
			$phpmailer->Username              =$wp_mail_options['wb_mail_username'];
		
			/**
			* Sets the text-only body of the message.  This automatically sets the
			* email to multipart/alternative.  This body can be read by mail
			* clients that do not have HTML email capability such as mutt. Clients
			* that can read HTML will view the normal Body.
			* @var string
			*/
			if( $this->is_str_and_not_empty( $wp_mail_options['wb_mail_password'] ) )
			$phpmailer->Password          =$wp_mail_options['wb_mail_password'];
		
			endif;
		}
	
	}
}
