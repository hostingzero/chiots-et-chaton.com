<?php 

// register Mimo_Carousel_Display_Widget widget
function register_mimo_carousel() {
    register_widget( 'Mimo_Carousel_Display_Widget' );
}
add_action( 'widgets_init', 'register_mimo_carousel' );

/**
 * Adds Mimo_Carousel_Display_Widget widget.
 */
class Mimo_Carousel_Display_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'mimo_carousel', // Base ID
			__('Mimo Carousel', 'mimo-carousel'), // Name
			array( 'description' => __( 'Display your Carousel', 'mimo-carousel' ),
			 'panels_groups' => array('mimo'), 
			 'panels_icon' => 'dashicons dashicons-yes',) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$posttype = apply_filters( 'widget_posttype', $instance['posttype'] );
		
		
		
		$id = $args['widget_id'];

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title']; 
			
			//Output
			
		
		$myargs = array();
$myargs['id'] = $posttype;

$myfirstvar = new Mimo_Carousel();

$myvar = new Mimo_Carousel_Public( $myfirstvar->get_plugin_name(), $myfirstvar->get_version() );
$myvar->display_carousel( $myargs );

			
		

	 
	

	

echo $args['after_widget'];
	}
	     
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$posttype = isset($instance['posttype']) ? esc_attr($instance['posttype']) : '';
		
		
		
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','mimo-carousel' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'posttype' ); ?> "><?php _e('Choose a Carousel:', 'mimo-carousel'); ?></label>
		<select id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>" value="<?php echo esc_attr( $posttype ); ?>" type="select">
		      <?php 

				$posttypes = Mimo_Carousel_Public::getctas();

				$imageoptions = $posttypes;
				  foreach ($imageoptions as $option => $optionname) {
					  
					  echo '<option value="' . $option . '" id="' . $option . '"', $posttype == $option ? ' selected="selected"' : '', '>', $optionname, '</option>'; } ?>

		</select>
	</p>

		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posttype'] = ( ! empty( $new_instance['posttype'] ) ) ? strip_tags( $new_instance['posttype'] ) : '';
		
		
		
		
		return $instance;
	}

} // class Mimo_Carousel_Display_Widget
?>