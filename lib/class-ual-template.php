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

/*
 * This class holds the functions to be used with our templates
 */

class UAL_Template {
    
    // Holds the form's unique ID
    private $form_id;
    
    public function __construct() {
	
	// Generate form ID
	$this->form_id = uniqid();
    }
    
    // Outputs the form header
    public function form_header(){
	
	echo "<form id='ual_form_".$this->form_id."' class='ual_form' method='post'>";
	
    }
    
    public function error_div(){
	echo "<div class='ual_item ual_error error' id='ual_error_$this->form_id'></div>";
	
    }
    
    // Returns the form's user field
    public function user_field(){
	echo 'ual_username_'.$this->form_id;
    }
    
    public function form_id(){
	echo $this->form_id;
    }
    
}