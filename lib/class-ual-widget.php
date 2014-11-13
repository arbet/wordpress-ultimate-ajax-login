<?php

/*
 * Implements our User Posts Per Page widget
 * @author Samer Bechara <sam@thoughtengineer.com>
 */
class UAL_Widget extends WP_Widget {

    // Holds the widget instance array
    private $instance = false;

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

	// Call parent constructior
	parent::__construct(
		'ual_widget', // Base ID
		__('Ultimate AJAX Login', 'ultimate-ajax-login'), // Name
		array( 'description' => __( 'Displays the Ultimate AJAX Login form' ), ) // Args
	);	
	
	// Include Ajax library on frontend, uncomment if not needed
	add_action( 'wp_head', array( $this, 'add_ajax_library' ) );
	
	// Enqueue JS file
	wp_enqueue_script( 'ual-widget-js', UAL_URL.'inc/js/widget.js', array('jquery') );
	
	// Enqueue CSS file
	wp_enqueue_style( 'ual-widget-css', UAL_URL.'inc/css/widget.css', array('jquery') );
	
	// Add ajax action on the frontend for logged in and non-logged in users
	add_action( 'wp_ajax_ual_ajax_login', array($this,'login_user') );
	add_action( 'wp_ajax_nopriv_ual_ajax_login', array($this,'login_user') );
    }
    
    /**
     * Adds the WordPress Ajax Library to the frontend.
     */
    public function add_ajax_library() {

	$html = '<script type="text/javascript">';
	    $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
	$html .= '</script>';

	echo $html;

    }
    
    /*
     * Logs in the user to wordpress
     */
    public function login_user(){
	
	// Get AJAX-submitted form data
	$form_data = array();
	parse_str($_POST['data'], $form_data);
	
	// Extract user credentials
	$credentials = array('user_login' => $form_data['ual_username'],
				'user_password' => $form_data['ual_password'],
				'remember'	=> $form_data['ual_remember_me']    );
	
	// Signon user
	$user = wp_signon($credentials);
	
	// User not signed in properly
	if (is_wp_error($user)){
	    $response['error'] = $user->get_error_message();
	    $response['logged_in'] = false;
	}
	
	// User successfully logged in
	else {
	    $response['logged_in'] = true;
	}
	
	// Encode and send data
	echo json_encode($response);
	
	die(); // Required for all AJAX calls
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {		     	        	 
	
	// Show template based on user status
	if( ! is_user_logged_in() ){

	    $this->load_template('widget-logged-out.php');
	}
	
	
	else {

	    $this->load_template('widget-logged-in.php');

	}

    }

    /**
     * Outputs the widget options fields under Appearance->Widgets
     *
     * @param array $instance The widget instance
     */
    public function form( $instance ) {

	/*// If widget_option_field is set, use it
	if ( isset( $instance[ 'widget_option_field' ] ) ) {
	    $widget_option_field = $instance[ 'widget_option_field' ];
	}
	// Use default widget_option_field
	else {
	    $widget_option_field = 'Posts Per Page';
	}
   
	?>
	<p>
	    <!-- Widget Option Title Field -->
	    <label for="<?php echo $this->get_field_id( 'widget_option_field' ); ?>"><?php _e( 'Option Title' ); ?></label> 
	    <input class="widefat" id="<?php echo $this->get_field_id( 'widget_option_field' ); ?>" name="<?php echo $this->get_field_name( 'widget_option_field' ); ?>" type="text" value="<?php echo esc_attr( $widget_option_field ); ?>">
	</p>

	<?php 
	*/
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {

	// Initialize instance
	$instance = array();
	
	// Set widget widget_option_field based on user entered option
	$instance['widget_option_field'] = ( ! empty( $new_instance['widget_option_field'] ) ) ? strip_tags( $new_instance['widget_option_field'] ) : '';	    

	// Return values to be saved
	return $instance;	    
    }
    
    /*
     * Loads template from the theme directory ultimate_ajax_login if it exists
     * Reverts to template folder in plugin if nothing found
     * @param string $name  The full template name, e.g. widget-logged-in.php
     */
    
    public function load_template($template_name){
	
	// Set template path to current theme folder
	$template_path = 'ultimate_ajax_login';
	
	// Set default path
	$default_path = UAL_PATH.'/templates/';
	
	// Find template in theme folder
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);
	
	// Template not found
	if (! $template ) {
	    $template = $default_path.$template_name;
	}
	
	// Require template parser
	require_once(UAL_PATH.'/lib/class-ual-template.php');
	
	// Load template
	require_once($template);
    }
    
}