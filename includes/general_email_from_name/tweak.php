<?php
// change from email name class
if ( ! class_exists( 'WB_general_email_from_name_Tweak' ) ) {
	class WB_general_email_from_name_Tweak {
		//generate email from name setting form field
		function wb_settings( ) {
			?>
			<tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Change from email name', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <input name="wb_general_tweak[<?php echo $this->option; ?>]" type="text" value="<?php echo $this->value; ?>"> 
					<br />
					<?php echo __( 'You can define any name, name will be used for all sent emails.<br/> Default name is "&#87;ordPress" This address and name will be used for all sended emails.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
			</tr>
			<?php
		}
	// function to apply filter to change the email from name
		function wb_tweak() {
			add_filter( 'wp_mail_from_name', array( $this, 'wp_mail_from_name' ) );
		}
	
		function wp_mail_from_name( $old ) {
			return $this->value;
		}
	}
}