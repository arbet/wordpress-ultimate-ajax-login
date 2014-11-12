<?php

/* 
 * Copyright (C) 2014 Samer Bechara <sam@thoughtengineer.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// Show login form in case the user is not logged in
if( ! is_user_logged_in() ){
    // Create unique ID for our form
    $unique_id = uniqid();

?>

<form id='ual_form_<?php echo $unique_id ?>' class='ual_form' method='post'>
    <div class='ual_form_item'>
	<label for='ual_username_<?php echo $unique_id; ?>'><?php echo _e('Username'); ?></label>
	<input type="text" id='ual_username_<?php echo $unique_id; ?>' name='ual_username' class='ual_field ual_username'/>
    </div>
    <div class='ual_form_item'>
	<label for='ual_password_<?php echo $unique_id; ?>'><?php echo _e('Password'); ?></label>
	<input type='password' id='ual_password__<?php echo $unique_id; ?>' name='ual_password' class='ual_field ual_password'/>
    </div>
    <div class='ual_form_item'>
	<input type='checkbox' id='ual_remember_me_<?php echo $unique_id; ?>' name='ual_remember_me' checked='checked' />
	<label for='ual_remember_me_<?php echo $unique_id; ?>'><?php echo _e('Remember me'); ?></label>	
    </div>
    <div class='ual_item ual_error error' id='ual_error_<?php echo $unique_id; ?>'></div>
    <div class='ual_item'>
	<input type='submit' value='<?php echo _e('Login'); ?>' class='ual_field ual_button'/>
    </div>
</form>

<?php 
}

else {
    echo "<span class='ual_logged_in'>You are already logged in</span>";
}
