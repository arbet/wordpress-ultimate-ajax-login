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


jQuery(document).ready(function($) {
    
    // Detect form submission
    $("[id^='ual_form_']").submit(function ( event ) {
       
        // Prevent form from being submitted
        event.preventDefault();
        
        // Assign form to variable for later use
        var form = this;
        
        // Send POST request via AJAX
        jQuery.post(ajaxurl, {

            action:     'ual_ajax_login',
            data:       $(this).serialize()
           }, function (response) {

               // Parse JSON response
               result = $.parseJSON(response);

               // User has logged in, reload page
               if(result.logged_in === true){
                   location.reload();
               }
               
               // Invalid login, display error message
               else {
                   // Show error on regular form
                   $("[id^='ual_error_']", form).html(result.error);
                   
                   // Show error on dialog boxes
                   $("[id^='ual_dialog_]").dialog().find("[id^='ual_error_']").html(result.error);
               }

               
           });
        
    }); 
});