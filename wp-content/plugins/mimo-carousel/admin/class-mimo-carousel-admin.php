<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://mimo.media
 * @since      1.0.0
 *
 * @package    Mimo_Carousel
 * @subpackage Mimo_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mimo_Carousel
 * @subpackage Mimo_Carousel/admin
 * @author     mimothemes <mimocontact@gmail.com>
 */
class Mimo_Carousel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//MIMO Change the plugin slug for others plugins
		$this->prefix = 'mm_car_';



	}
	public function cpt_dashboard_support( $items = array() ) {
		$post_types = array('mm_car_carousel');
		foreach ( $post_types as $type ) {
			if ( !post_type_exists( $type ) ) {
				continue;
			}
			$num_posts = wp_count_posts( $type );
			if ( $num_posts ) {
				$published = intval( $num_posts->publish );
				$post_type = get_post_type_object( $type );
				$text = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, $this->plugin_name );
				$text = sprintf( $text, number_format_i18n( $published ) );
				if ( current_user_can( $post_type->cap->edit_posts ) ) {
					$items[] = '<a class="' . $post_type->name . '-count" href="edit.php?post_type=' . $post_type->name . '">' . sprintf( '%2$s', $type, $text ) . "</a>\n";
				} else {
					$items[] = sprintf( '%2$s', $type, $text ) . "\n";
				}
			}
		}
		return $items;
	}

	 /**
	 * Only return default value if we don't have a post ID (in the 'post' query variable)
	 *
	 * @param  bool  $default On/Off (true/false)
	 * @return mixed          Returns true or '', the blank default
	 */
	public function set_checkbox_default_for_new_post( $default ) {
	    return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
	}


	public function prefix_sanitize_text_callback( $value, $field_args, $field ) {

    /*
     * Do your custom sanitization. 
     * strip_tags can allow whitelisted tags
     * http://php.net/manual/en/function.strip-tags.php
     */
    $value = strip_tags( $value, '<p><button><a><br><br/>' );

    return $value;
}

	/**
	 * NOTE:     Your metabox on Map CPT
	 *
	 * @since    1.0.0
	 */
	public function mm_car_metaboxes() {
		// Start with an underscore to hide fields from custom fields list

		

$orderby = array(
					'none' => 'None', 
					'ID' => 'Id',
					'author' => 'Author',
					'title' => 'Title',
					'name' => 'Name',
					'type'=> 'Type',
					'date'=> 'Date',
					'modified'=> 'Modified',
					'parent'=> 'Parent',
					'rand'=> 'Random',
					'comment_count'=> 'Comment count',
					'menu_order'=> 'Menu order',
					'meta_value' => 'Meta value',
					'meta_value_num'=> 'Meta Vvalue number',
					'post_in' => 'Post in'
					);

$orders = array('ADD' => 'Ascendent', 'DESC' => 'Descendant');

	// Get posts types array
				$mmargs = array(
				   'public'   => true,
				   '_builtin' => false
				);

				$output = 'names'; // names or objects, note names is the default
				$operator = 'and'; // 'and' or 'or'

				$posttypes = get_post_types( $mmargs, $output, $operator );
				array_unshift($posttypes, 'post'); 
				$imageoptions = $posttypes;
		
		$mm_car_map_metabox = new_cmb2_box( array(
			
			'id' => $this->plugin_name . '_car_options',
			'title' => __( 'Carousel Options', 'mimo-carousel' ),
			'object_types' => array( 'mm_car_carousel' ), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
				) 
		);

		

		

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Post Type',
		    'desc'             => 'Select an option',
		    'id'               => $this->prefix . 'posttype',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'post',
		    'options'          => $imageoptions,
		) );

		

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Taxonomy to use',
		    'desc'             => 'Select a taxonomy to list',
		    'id'               => $this->prefix . 'ntax',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'medium',
		    'options'          => get_taxonomies(),
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Terms',
		    'desc'    => 'Terms to show, use slugs separated by commas',
		    'default' => '',
		    'id'      =>  $this->prefix . 'ctax',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Number of posts',
		    'desc'    => 'Number of posts to show in the carousel',
		    'default' => '12',
		    'id'      =>  $this->prefix . 'showposts',
		    'type'    => 'text'
		) );

		


		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Image size',
		    'desc'             => 'Select an option',
		    'id'               => $this->prefix . 'imagesize',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'medium',
		    'options'          => get_intermediate_image_sizes(),
		) );


		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Offset',
		    'desc'    => 'Number of posts to offset in the carousel',
		    'default' => '0',
		    'id'      =>  $this->prefix . 'offset',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Show Related Posts',
		    'desc' => 'Show only related posts, when published in single view',
		    'id'   => $this->prefix . 'related',
		    'type' => 'checkbox'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Exclude posts',
		    'desc'    => 'IDs of posts to hide in the carousel, separated by commas',
		    'default' => '0',
		    'id'      =>  $this->prefix . 'exclude',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Order',
		    'desc'             => 'Select an option',
		    'id'               => $this->prefix . 'order',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'ADD',
		    'options'          => $orders,
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Order by',
		    'desc'             => 'Select an option',
		    'id'               => $this->prefix . 'orderby',
		    'type'             => 'select',
		    'default'          => 'title',
		    'options'          => $orderby,
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'rows',
		    'desc'    => 'Setting this to more than 1 initializes grid mode. Use slidesPerRow to set how many slides should be in each row.',
		    'default' => '1',
		    'id'      =>  $this->prefix . 'rows',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slide',
		    'desc'    => 'Element query to use as slide',
		    'default' => '',
		    'id'      =>  $this->prefix . 'slide',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesPerRow',
		    'desc'    => 'With grid mode intialized via the rows option, this sets how many slides are in each grid row. dver',
		    'default' => '2',
		    'id'      =>  $this->prefix . 'slidesPerRow',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesToShow',
		    'desc'    => 'Number of slides to show',
		    'default' => '4',
		    'id'      =>  $this->prefix . 'slidesToShow',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesToScroll',
		    'desc'    => 'Number of slides to scroll',
		    'default' => '2',
		    'id'      =>  $this->prefix . 'slidesToScroll',
		    'type'    => 'text'
		) );


		$mm_car_map_metabox->add_field( array(
		    'name'    => 'speed',
		    'desc'    => 'Slide/Fade animation speed',
		    'default' => '300',
		    'id'      =>  $this->prefix . 'speed',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'swipe',
		    'desc' => 'Enable swiping',
		    'id'   => $this->prefix . 'swipe',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'swipeToSlide',
		    'desc' => 'Allow users to drag or swipe directly to a slide irrespective of slidesToScroll',
		    'id'   => $this->prefix . 'swipeToSlide',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'touchMove',
		    'desc' => 'Enable slide motion with touch',
		    'id'   => $this->prefix . 'touchMove',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'touchThreshold',
		    'desc'    => 'To advance slides, the user must swipe a length of (1/touchThreshold) * the width of the slider',
		    'default' => '5',
		    'id'      =>  $this->prefix . 'touchThreshold',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Title Words',
		    'desc'    => 'Number of words in the title of each post',
		    'default' => '5',
		    'id'      =>  $this->prefix . 'title_number',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Excerpt Words',
		    'desc'    => 'Number of words in the excerpt of each post',
		    'default' => '15',
		    'id'      =>  $this->prefix . 'excerpt_number',
		    'type'    => 'text'
		) );
	    
	    $mm_car_map_metabox->add_field( array(
		    'name' => 'Hide Title',
		    'desc' => 'Hide the title of posts',
		    'id'   => $this->prefix . 'hide_title',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Hide Excerpt',
		    'desc' => 'Hide the excerpt of posts',
		    'id'   => $this->prefix . 'hide_excerpt',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Hide Image',
		    'desc' => 'Hide the image of posts',
		    'id'   => $this->prefix . 'hide_image',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		
		    

		

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Dots',
		    'desc' => 'Show the pagination dots',
		    'id'   => $this->prefix . 'dots',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Arrows',
		    'desc' => 'Show the pagination arrows',
		    'id'   => $this->prefix . 'arrows',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Accessibility',
		    'desc' => 'Enables tabbing and arrow key navigation',
		    'id'   => $this->prefix . 'accessibility',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)

		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Adaptive Height',
		    'desc' => 'Enables adaptive height for single slide horizontal carousels.',
		    'id'   => $this->prefix . 'adaptiveHeight',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Autoplay',
		    'desc' => 'Autoplay the carousel',
		    'id'   => $this->prefix . 'autoplay',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );


		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Autoplay Speed',
		    'desc'    => 'Number in miliseconds',
		    'default' => '3000',
		    'id'      =>  $this->prefix . 'autoplaySpeed',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'As Nav For',
		    'desc'    => 'Set the slider to be the navigation of other slider (Class or ID Name)',
		    'default' => '',
		    'id'      =>  $this->prefix . 'asNavFor',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'Append Arrows',
		    'desc'    => 'Change where the navigation arrows are attached (Selector, htmlString, Array, Element, jQuery object)',
		    'default' => '',
		    'id'      =>  $this->prefix . 'appendArrows',
		    'type'    => 'text'
		) );

		//$mm_car_map_metabox->add_field( array(
		    //'name'    => 'Prev Arrow',
		    //'desc'    => 'Allows you to select a node or customize the HTML for the "Previous" arrow.',
		    //'default' => '<button type="button" class="slick-prev">Next</button>',
		    //'id'      =>  $this->prefix . 'prevArrow',
		    //'type'    => 'text',
    		//'sanitization_cb' => 'self::prefix_sanitize_text_callback',
		//) );

		//$mm_car_map_metabox->add_field( array(
		    //'name'    => 'Next Arrow',
		    //'desc'    => 'Allows you to select a node or customize the HTML for the "Next" arrow',
		    //'default' => '<button type="button" class="slick-next">Next</button>',
		    //'id'      =>  $this->prefix . 'nextArrow',
		    //'type'    => 'text',
    		//'sanitization_cb' => 'self::prefix_sanitize_text_callback',
		//) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'Center Mode',
		    'desc' => 'Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.',
		    'id'   => $this->prefix . 'centerMode',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'centerPadding',
		    'desc'    => 'Side padding when in center mode (px or %)',
		    'default' => '50px',
		    'id'      =>  $this->prefix . 'centerPadding',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'cssEase',
		    'desc'             => 'CSS3 Animation Easing',
		    'id'               => $this->prefix . 'cssEase',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'ease',
		    'options'          => array('linear' => 'linear','ease' => 'ease','ease-in' => 'ease-in','ease-out' => 'ease-out','ease-in-out' => 'ease-in-out','step-start' => 'step-start','step-end' => 'step-end'),
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'draggable',
		    'desc' => 'Enable mouse dragging',
		    'id'   => $this->prefix . 'draggable',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );
  

  		$mm_car_map_metabox->add_field( array(
		    'name' => 'fade',
		    'desc' => 'Enable fade',
		    'id'   => $this->prefix . 'fade',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'focusOnSelect',
		    'desc' => 'Enable focus on selected element (click)',
		    'id'   => $this->prefix . 'focusOnSelect',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );


		$mm_car_map_metabox->add_field( array(
		    'name'             => 'Easing',
		    'desc'             => 'Add easing for jQuery animate. Use with easing libraries or default easing methods',
		    'id'               => $this->prefix . 'easing',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'linear',
		    'options'          => array('linear' => 'linear','easeOutbounce' => 'easeOutbounce','easeInBounce' => 'easeInBounce'),
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'edgeFriction',
		    'desc'    => 'Resistance when swiping edges of non-infinite carousels. Use number ex.: "0.30"',
		    'default' => '0.15',
		    'id'      =>  $this->prefix . 'edgeFriction',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'infinite',
		    'desc' => 'Infinite loop sliding',
		    'id'   => $this->prefix . 'infinite',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'initialSlide',
		    'desc'             => 'Slide to start on',
		    'default' => '1',
		    'id'      =>  $this->prefix . 'initialSlide',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'lazyLoad',
		    'desc' => 'Set lazy loading technique. Accepts "ondemand" or "progressive"',
		    'id'               => $this->prefix . 'lazyLoad',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'ondemand',
		    'options'          => array('ondemand' => 'ondemand','progressive'  => 'progressive') ,
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'mobileFirst',
		    'desc' => 'Responsive settings use mobile first calculation',
		    'id'   => $this->prefix . 'mobileFirst',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'pauseOnHover',
		    'desc' => 'Pause Autoplay On Hover',
		    'id'   => $this->prefix . 'pauseOnHover',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'pauseOnDotsHover',
		    'desc' => 'Pause Autoplay when a dot is hovered',
		    'id'   => $this->prefix . 'pauseOnDotsHover',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'respondTo',
		    'desc'             => 'Width that responsive object responds to(the smaller of the two).',
		    'id'               => $this->prefix . 'respondTo',
		    'type'             => 'select',
		    'show_option_none' => true,
		    'default'          => 'window',
		    'options'          => array('window' => 'window','slider' => 'slider','min' => 'min'),
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'             => 'responsive',
		    'desc'             => 'Object containing breakpoints and settings objects (see demo). Enables settings sets at given screen width. Set settings to "unslick" instead of an object to disable slick at a given breakpoint.',
		    'id'               => $this->prefix . 'responsive',
		    'type'    => 'text',
		    'default'          => 'none',
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'rows',
		    'desc'    => 'Setting this to more than 1 initializes grid mode. Use slidesPerRow to set how many slides should be in each row.',
		    'default' => '1',
		    'id'      =>  $this->prefix . 'rows',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slide',
		    'desc'    => 'Element query to use as slide',
		    'default' => '',
		    'id'      =>  $this->prefix . 'slide',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesPerRow',
		    'desc'    => 'With grid mode intialized via the rows option, this sets how many slides are in each grid row. dver',
		    'default' => '2',
		    'id'      =>  $this->prefix . 'slidesPerRow',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesToShow',
		    'desc'    => 'Number of slides to show',
		    'default' => '4',
		    'id'      =>  $this->prefix . 'slidesToShow',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'slidesToScroll',
		    'desc'    => 'Number of slides to scroll',
		    'default' => '2',
		    'id'      =>  $this->prefix . 'slidesToScroll',
		    'type'    => 'text'
		) );


		$mm_car_map_metabox->add_field( array(
		    'name'    => 'speed',
		    'desc'    => 'Slide/Fade animation speed',
		    'default' => '300',
		    'id'      =>  $this->prefix . 'speed',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'swipe',
		    'desc' => 'Enable swiping',
		    'id'   => $this->prefix . 'swipe',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'swipeToSlide',
		    'desc' => 'Allow users to drag or swipe directly to a slide irrespective of slidesToScroll',
		    'id'   => $this->prefix . 'swipeToSlide',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'touchMove',
		    'desc' => 'Enable slide motion with touch',
		    'id'   => $this->prefix . 'touchMove',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name'    => 'touchThreshold',
		    'desc'    => 'To advance slides, the user must swipe a length of (1/touchThreshold) * the width of the slider',
		    'default' => '5',
		    'id'      =>  $this->prefix . 'touchThreshold',
		    'type'    => 'text'
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'useCSS',
		    'desc' => 'Enable/Disable CSS Transitions',
		    'id'   => $this->prefix . 'useCSS',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(true)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'variableWidth',
		    'desc' => 'Variable width slides',
		    'id'   => $this->prefix . 'variableWidth',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'vertical',
		    'desc' => 'Vertical slide mode',
		    'id'   => $this->prefix . 'vertical',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'verticalSwiping',
		    'desc' => 'Vertical swipe mode',
		    'id'   => $this->prefix . 'verticalSwiping',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		$mm_car_map_metabox->add_field( array(
		    'name' => 'rtl',
		    'desc' => 'Change the sliders direction to become right-to-left',
		    'id'   => $this->prefix . 'rtl',
		    'type' => 'checkbox',
		    'default' => self::set_checkbox_default_for_new_post(false)
		) );

		
  

	}
	
	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mimo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mimo_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mimo-carousel-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mimo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mimo_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mimo-carousel-admin.js', array( 'jquery', 'jquery-ui-tabs' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
				__( 'Mimo Carousel Settings', 'mimo-carousel' ), 'Mimo Carousel', 'manage_options', 'mimo-carousel-settings', array( $this, 'display_plugin_admin_page' )
		);
		/*
		 * Settings page in the menu
		 * 
		 */
		//$this->plugin_screen_hook_suffix = add_menu_page( __( 'Wp Maps Settings', 'mimo-carousel' ), $this->plugin_name, 'manage_options', 'mimo-carousel-settings', array( $this, 'display_plugin_admin_page' ), 'dashicons-location', 81);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		return array_merge(
				array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=' ) . '">' . __( 'Settings', 'mimo-carousel' ) . '</a>'
				), $links
		);
	}

}
