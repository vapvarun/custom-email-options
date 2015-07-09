<?php
// Display memory used to generate the page class
if ( ! class_exists( 'WB_general_generation_time_Tweak' ) ) {
	class WB_general_generation_time_Tweak {
		//generate setting form field to select option to show the memory used
		function wb_settings( ) {
			?>
			<tr valign="top">
				<th scope="row">
					<label for="num_elements">
						<?php echo __( 'Show generation time', WB_CHANGE_EMAIL_SLUG ); ?>:
					</label> 
				</th>
				<td>
				   <label ><input name="wb_general_tweak[<?php echo $this->option; ?>]" type="radio" value="yes" <?php echo ( $this->value == "yes" )? ' checked="checked"' : '' ;?>> Yes</label>
				   <label ><input name="wb_general_tweak[<?php echo $this->option; ?>]" type="radio" value="" <?php echo ( $this->value == "" )? ' checked="checked"' : '' ;?>> No</label> 
					<br />
					<?php echo __( 'Only admins can see this information.<br/> Number of SQL requests, generation time and memory consumption will be shown for all pages.', WB_CHANGE_EMAIL_SLUG ); ?>
				</td>
			</tr>
		<?php
		}
		
	// function to apply action to display time taken and memory used
		function wb_tweak() {
			add_action( 'init', array( $this, 'wb_init' ) );
		}
	
		function wb_init(){
	//		if(!current_user_can('manage_options')) return;
	//		SQL requests:62. Generation time:1.248 sec. Memory consumption:45.31 mb
			add_filter( 'wp_footer', array( $this, 'wb_do' ) );
		}
	// Function to show the memory and time used
		function wb_do(){
			printf( __( 'SQL requests:%d. Generation time:%s sec. Memory consumption:', WB_CHANGE_EMAIL_SLUG ), get_num_queries(), timer_stop( 0, 3 ) );
			if ( function_exists( 'memory_get_usage' ) ) 
			{
				echo round( memory_get_usage()/1024/1024, 2 ) . ' mb ';
			}
		}
	}
}