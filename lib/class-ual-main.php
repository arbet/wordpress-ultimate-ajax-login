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
	
	// Defaults to no redirect, and uses the classic template
	$default = array('redirect_login' => '', 'template' => 'classic', 'theme' => 'smoothness');
	
	// Merge user attributes with our default attributes	
	$all_atts = shortcode_atts($default, $atts, 'ultimate_ajax_login');
	
	// Send back our widget
	return the_widget('UAL_Widget',$all_atts);
    }
    
    /*
     * Registers site options page
     */
    public function register_site_options_pages(){
	
	// Add site settings page
	add_submenu_page( 'options-general.php', 'Ultimate AJAX Login Options', 'Ultimate AJAX Login', 'manage_options', 'ultimate_ajax_login', array($this, 'display_site_options_page') );	
	
	// Login redirect option
	register_setting( 'ual-site-options', 
		'ual_redirect_login', 
		'esc_url_raw' // Validates the URL
	);
	
	// Login Button text
	register_setting( 'ual-site-options', 
		'ual_login_button_text', 
		'wp_kses_post' // Allows HTML tags
	);		
		
    }
    
    
    /*
     * Saves site-specific options
     */
    static function save_site_options(){
	
	// Get login redirect URL
	$redirect_login = $_POST['ual_redirect_login'];
	
	// Get login button text
	$login_button_text = $_POST['ual_login_button_text'];
	
	// Validate the URL
	$sanitized_location = wp_sanitize_redirect($redirect_login);	
	$valid_location = wp_validate_redirect($sanitized_location, admin_url());
	
	// Read $_POST fields, and use update_option function to save
	update_option('ual_redirect_login', $valid_location);
	update_option('ual_login_button_text', $login_button_text);
	
    }
    
    /*
     * Displays site options page
     */
      
    public function display_site_options_page(){
	require (UAL_PATH.'/inc/views/site-options.php'); 
    }
    
}