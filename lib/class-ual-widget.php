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
    

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {		     	        	    
	
	/* Widget logic and output goes here */
	require (UAL_PATH.'/inc/views/widget-output.php');

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
    
}