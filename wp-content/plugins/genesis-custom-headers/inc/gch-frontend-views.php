<?php

defined( 'WPINC' ) or die;

add_action( 'wp', 'gch_enable_header_frontend' );
/**
 * Make sure we can use Genesis Custom Header on given page/post
 * If so, add custom header using print_header()
 */
function gch_enable_header_frontend() {

	// Bail early if Genesis isn't installed
	if ( ! function_exists( 'genesis_get_option' ) ) {
		return;
	}
	
	// Get our global plugin settings
	$gch_header_position		= genesis_get_option( 'header_position', 'genesis-custom-header' );
	$gch_header_priority		= genesis_get_option( 'header_priority', 'genesis-custom-header' );
	$gch_force_header_position	= genesis_get_option( 'force_header_position', 'genesis-custom-header' );
	
	// Get page/post meta data
	$custom	= get_post_custom();
	$gch_enable_custom_position   = (isset($custom[ '_gch_enable_custom_position' ][0]) ? $custom[ '_gch_enable_custom_position' ][0] : '');
	$gch_custom_header_position   = (isset($custom[ '_gch_custom_header_position' ][0]) ? $custom[ '_gch_custom_header_position' ][0] : 'genesis_after_header');
	$gch_custom_header_priority   = (isset($custom[ '_gch_custom_position_priority' ][0]) ? $custom[ '_gch_custom_position_priority' ][0] : '1');

	// Setup our header position variable
	$header_position = '';
	$header_priority = '';
	
	// Determine how $header_position should be set, either global or custom position
	if ( $gch_force_header_position == 1 ) {
		$header_position = $gch_header_position;
		$header_priority = $gch_header_priority;  
	} else {
		if ( $gch_enable_custom_position == 1 ) {
			$header_position = $gch_custom_header_position;
			$header_priority = $gch_custom_header_priority;  
		} else {
			$header_position = $gch_header_position;
			$header_priority = $gch_header_priority; 
		}
	}
		
	// Create an array of all available post types including all public custom post types
	$available_post_array = array_merge( array('page', 'post'), get_post_types( array( 'public' => true, '_builtin' => false ), 'names', 'and' ) );
	
	// Create an empty array for our activated post types
	$activated_posts = array();
	
	// Fill our array with [post_type => activated]
	foreach ( $available_post_array as $available_post ) {
		$activated_posts[$available_post] = genesis_get_option( 'enable_' . $available_post, 'genesis-custom-header' ) == 1 ? 1: 0;
	}
	
	// Get the post type of the current page
	$type = get_post_type( get_the_ID() );
	
	// If we are on a singular page, check to see if custom headers should be shown on this page
	if ( is_singular() ) {
		foreach ( $activated_posts as $activated_post => $activated ) {
			if ( $type == $activated_post && $activated == 1 ) {
				add_action( $header_position , 'gch_print_header', $header_priority ); // The priority is important, we want this to be added first
			} 
		}
	}
	
}


add_action( 'wp_head', 'gch_custom_css' );
/**
 * Adds custom css to frontend
 */
function gch_custom_css() {

	// Bail early if Genesis isn't installed
	if ( ! function_exists( 'genesis_get_option' ) ) {
		return;
	}

	// Get our global plugin settings
	$gch_enable_header_css  = genesis_get_option( 'enable_header_css', 'genesis-custom-header' );
	$gch_header_css 		= genesis_get_option( 'header_css', 'genesis-custom-header' );
	
	// If custom header css is enabled, print in header
	if ( $gch_enable_header_css == 1 ) {
		echo '<style type="text/css">';
		echo "/*Custom CSS generated by the Genesis Custom Header plugin*/\n\n" . esc_attr( $gch_header_css ) ;
		echo '</style>';
	}
	
}


/**
 * Add featured image, slider, or content to each page
 */
function gch_print_header() {

	// Bail early if Genesis isn't installed
	if ( ! function_exists( 'genesis_get_option' ) ) {
		return;
	}
	
	// Get our global plugin settings
	$gch_disable_header_wrap 		    = genesis_get_option( 'disable_header_wrap', 'genesis-custom-header' );	
	$gch_global_enable_header_image 	= genesis_get_option( 'enable_header_image', 'genesis-custom-header' ) ;
	$gch_global_enable_header_slideshow = genesis_get_option( 'enable_header_slideshow', 'genesis-custom-header' ) ;
	$gch_global_enable_header_content 	= genesis_get_option( 'enable_header_content', 'genesis-custom-header' ) ;
	$gch_global_enable_header_raw 		= genesis_get_option( 'enable_header_raw', 'genesis-custom-header' ) ;
	
	$custom	= get_post_custom();
	
	// Get page/post meta data
	$gch_enable_header			= (isset($custom[ '_gch_enable_header' ][0]) ? $custom[ '_gch_enable_header' ][0] : 0);
	$gch_enable_image			= (isset($custom[ '_gch_enable_image' ][0]) ? $custom[ '_gch_enable_image' ][0] : 0);
	$gch_image_type				= (isset($custom[ '_gch_image_type' ][0]) ? $custom[ '_gch_image_type' ][0] : '');
	$gch_custom_image  			= (isset($custom[ '_gch_custom_image' ][0]) ? $custom[ '_gch_custom_image' ][0] : '');
	$gch_custom_image_alt		= (isset($custom[ '_gch_custom_image_alt' ][0]) ? $custom[ '_gch_custom_image_alt' ][0] : '');
  	$gch_image_caption			= (isset($custom[ '_gch_image_caption' ][0]) ? $custom[ '_gch_image_caption' ][0] : '');
	$gch_background_image		= (isset($custom[ '_gch_background_image' ][0]) ? $custom[ '_gch_background_image' ][0] : 0);
  	$gch_enable_slideshow  		= (isset($custom[ '_gch_enable_slideshow' ][0]) ? $custom[ '_gch_enable_slideshow' ][0] : 0);
	$gch_slider_shortcode		= (isset($custom[ '_gch_slider_shortcode' ][0]) ? $custom[ '_gch_slider_shortcode' ][0] : '');
	$gch_soliloquy_slider		= (isset($custom[ '_gch_soliloquy_slider' ][0]) ? $custom[ '_gch_soliloquy_slider' ][0] : '');
	$gch_revolution_slider  	= (isset($custom[ '_gch_revolution_slider' ][0]) ? $custom[ '_gch_revolution_slider' ][0] : '');
	$gch_meta_slider			= (isset($custom[ '_gch_meta_slider' ][0]) ? $custom[ '_gch_meta_slider' ][0] : '');
	$gch_sliderpro_slider  		= (isset($custom[ '_gch_sliderpro_slider' ][0]) ? $custom[ '_gch_sliderpro_slider' ][0] : '');
  	$gch_enable_custom_content	= (isset($custom[ '_gch_enable_custom_content' ][0]) ? $custom[ '_gch_enable_custom_content' ][0] : 0);
	$gch_custom_content  		= (isset($custom[ '_gch_custom_content' ][0]) ? $custom[ '_gch_custom_content' ][0] : '');
	$gch_enable_header_raw      = (isset($custom[ '_gch_enable_header_raw' ][0]) ? $custom[ '_gch_enable_header_raw' ][0] : 0);
	$gch_header_raw  		    = (isset($custom[ '_gch_header_raw' ][0]) ? $custom[ '_gch_header_raw' ][0] : '');

  	// If the header is been enabled, do stuff...		
	if ( $gch_enable_header == 1 ) {
	
	
		// Add header structure, and disable wrap selector if desired
		echo '<div class="gch-header"><div class="gch-header-inner ';
		if ( $gch_disable_header_wrap != 1 ){
			echo 'wrap';
		}
		echo '">';
		
		
		// Display header image, custom or featured
		if ( $gch_global_enable_header_image == 1 && $gch_enable_image == 1 ) {
			// Check to see if the current post/page/custom post type has a featured image set
			$thumbnail = has_post_thumbnail( get_the_ID() );
			
			// Print our image
			if ( $gch_image_type == 'custom' && $gch_custom_image != '' ) {
				if ( $gch_background_image == 1 ) {
					echo '<div class="gch-header-image"><div class="gch-header-image-inner" style="background-image: url(' . esc_url( $gch_custom_image ) . ')">';
				} else {
					echo '<div class="gch-header-image"><div class="gch-header-image-inner">';
					echo '<img src="' . esc_url( $gch_custom_image ) . '" alt="' . $gch_custom_image_alt . '" />';
				}
				
				// Print the caption if there is one
				if ( $gch_image_caption != '' ) {
					echo '<div class="gch-caption"><div class="gch-caption-inner">';
					echo wp_kses_post( $gch_image_caption );
					echo '</div></div>';
				}
				echo '</div></div>';
			} else if ( $gch_image_type == 'featured' && $thumbnail == true ) {
				if ( $gch_background_image == 1 ) {
					echo '<div class="gch-header-image"><div class="gch-header-image-inner" style="background-image: url(' . esc_url( $gch_custom_image ) . ')">';
				} else {
					echo '<div class="gch-header-image"><div class="gch-header-image-inner">';
					echo the_post_thumbnail( 'full' );
				}
				// Print the caption if there is one
				if ( $gch_image_caption != '' ) {
					echo '<div class="gch-caption"><div class="gch-caption-inner">';
					echo wp_kses_post( $gch_image_caption );
					echo '</div></div>';
				}
				echo '</div></div>';
			}
		}
		
		
		// Display header slider
		if ( $gch_global_enable_header_slideshow == 1 && $gch_enable_slideshow == 1 ) {
			
			// Allows us to use is_plugin_active on the frontend
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			
			echo '<div class="gch-header-slider">';
			
				//Display generic slider using a slider shortcode
				if ( isset( $gch_slider_shortcode ) && $gch_slider_shortcode != '' ) {
					echo '<div class="gch-slider-shortcode">';
						echo do_shortcode( ( $gch_slider_shortcode ) ); 
					echo '</div>';
				}
			
				// Display Soliloquy Slider if active				 
				if ( is_plugin_active( 'soliloquy/soliloquy.php' ) ) { 
					gch_display_soliloquy_sliders( $gch_soliloquy_slider );
				}
			
				// Display Revolution Slider if active
				if ( is_plugin_active( 'revslider/revslider.php' ) ) { 
					gch_display_revolution_sliders( $gch_revolution_slider );
				} 
			
				// Display Meta Slider if active				
				if ( is_plugin_active( 'ml-slider/ml-slider.php' ) ) { 
					gch_display_metaslider_sliders( $gch_meta_slider );
				}
			
				// Display Slider PRO slider if active		 
				if ( is_plugin_active( 'slider-pro/slider-pro.php' ) ) {
					gch_display_sliderpro_sliders( $gch_sliderpro_slider );
				}
			
			echo '</div>';
    	
    	}
		
		
		// Display custom content
		if ( $gch_global_enable_header_content == 1 && $gch_enable_custom_content == 1 ) {
			echo '<div class="gch-header-content">';
				echo do_shortcode( wp_kses_post( $gch_custom_content ) );   //do_shortcode needed to enable shortcode functionality (perhaps not the most elegant way of doing this)
			echo '</div>';
		}
		
		
		// Display header scripts
		if ( $gch_global_enable_header_raw == 1 && $gch_enable_header_raw == 1 ) {
			echo '<div class="gch-header-scripts">';
				echo do_shortcode( $gch_header_raw );   
			echo '</div>';
		}
		
		echo '</div></div>';
 	}

}

?>