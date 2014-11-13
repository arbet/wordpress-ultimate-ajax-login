<?php
/*
 * Name: Classic Form Template
 * Description: Displays an AJAX-based classic form template
 * Type: Login
 * 
 * Instructions for modifying this template
 * 
 * DO NOT MODIFY THE ABOVE HEADERS, OR IT WILL STOP WORKING
 * Create a folder inside your active theme directory named ultimate_ajax_login and paste this inside it
 * 
 * 
 * Feel free to move things around as you wish, but keep the IDs for the fields as they are
 */

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

// Create new template object
$ual = new UAL_Template();

?>

<?php $ual->form_header(); ?>
    <div class='ual_form_item'>
	<label for='ual_username_<?php $ual->form_id(); ?>'><?php echo _e('Username'); ?></label>
	<input type="text" id='ual_username_<?php $ual->form_id(); ?>' name='ual_username' class='ual_field ual_username'/>
    </div>
    <div class='ual_form_item'>
	<label for='ual_password_<?php $ual->form_id(); ?>'><?php echo _e('Password'); ?></label>
	<input type='password' id='ual_password_<?php $ual->form_id(); ?>' name='ual_password' class='ual_field ual_password'/>
    </div>
    <div class='ual_form_item'>
	<input type='checkbox' id='ual_remember_me_<?php $ual->form_id(); ?>' name='ual_remember_me' checked='checked' />
	<label for='ual_remember_me_<?php $ual->form_id(); ?>'><?php echo _e('Remember me'); ?></label>	
    </div>
    <div class='ual_item ual_error error' id='ual_error_<?php $ual->form_id(); ?>'></div>
    <div class='ual_item'>
	<input type='submit' value='<?php echo _e('Login'); ?>' class='ual_field ual_button'/>
    </div>
</form>
