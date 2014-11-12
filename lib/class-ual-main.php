<?php

/*
 * Ultimate AJAX Login main file which contains all code logic
 * @author Samer Bechara <sam@thoughtengineer.com>
 */
class UAL_Main {
    
    public function __construct() {

	// Register our widget, if any
	add_action( 'widgets_init', function(){
	     register_widget( 'UAL_Widget' );
	});	
	
	// Register our shortcode
	add_shortcode('ultimate_ajax_login', array($this,'insert_shortcode') );
	
	// Register  options page on site admin and network admin
	add_action('admin_menu', array($this, 'register_site_options_pages'));
    }
    
    /*
     * Inserts a shortcode into our website
     * @param $atts The shortcode attributes passed by user
     * 
     */
    public function insert_shortcode($atts) {
	
	// Default attributes for shortcode
	$default = array('key1' => 'val1', 'key2' => 'val2');
	
	// Merge user attributes with our default attributes	
	$atts = shortcode_atts($default, $atts, 'ultimate_ajax_login');
	
	// Send back our widget
	return the_widget('UAL_Widget',$atts);
    }
    
    /*
     * Registers site options page
     */
    public function register_site_options_pages(){
	
	// Add site settings page
	add_submenu_page( 'options-general.php', 'Ultimate AJAX Login Options', 'Ultimate AJAX Login', 'manage_options', 'ultimate_ajax_login', array($this, 'display_site_options_page') );	
	// Login redirect option
	register_setting( 'ual-site-options', 
		'ual_redirect_logout', 
		'esc_url_raw' // Validates the URL
	);
	
	// Logout redirect option
	register_setting( 'ual-site-options', 
		'ual_redirect_login', 
		'esc_url_raw' // Validates the URL
	);	
		
    }
    
    
    /*
     * Saves site-specific options
     */
    static function save_site_options(){
	
	// Read $_POST fields, and use update_option function to save
	update_option('ual_redirect_login', $_POST['ual_redirect_login']);
	update_option('ual_redirect_logout', $_POST['ual_redirect_logout']);
	
    }
    
    /*
     * Displays site options page
     */
      
    public function display_site_options_page(){
	require (UAL_PATH.'/inc/views/site-options.php'); 
    }
    
}