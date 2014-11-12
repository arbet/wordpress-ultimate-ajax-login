<?php

/* 
 * Contains the options page for the plugin
 */

// Form has been submitted
if(!empty($_POST)){
    
    // Call static function to save site options
    UAL_Main::save_site_options();
}
?>

<div class="wrap">
<h2>Page Title Goes Here</h2>

<form method="post" action="options-general.php?page=ultimate_ajax_login"> 

<?php 

// Generate WP-specific form fields such as nonce field
settings_fields( 'ual-site-options' ); // Must match name in register_site_options_function

// Define the option group here, required by WP
do_settings_sections( 'ual-site-options' );


?>
<table class="form-table">	
        <tr valign="top">
        <th scope="row">Login Redirect URL</th>
        <td><input type='text' name='ual_redirect_login' value='<?php echo get_option('ual_redirect_login')?>' />
	    <p class="description">
		Absolute URL to redirect user to after logging in. If left blank, user will stay on current page
	    </p>	    	    
	</td>
        </tr>	
         <tr valign="top">
        <th scope="row">Logout Redirect URL</th>
        <td><input type='text' name='ual_redirect_logout' value='<?php echo get_option('ual_redirect_logout')?>' />
	    <p class="description">
		Absolute URL to redirect user to after logout. If left blank, user will stay on current page
	    </p>	    	    
	</td>
        </tr>		
</table> 
    
<?php
// Submit button
submit_button(); 

?>
</form>
</div>
