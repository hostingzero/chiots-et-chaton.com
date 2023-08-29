<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Pet Care
	 * @since Pet Care 1.0.0
	 */

	do_action( 'pet_business_doctype' );

?>
<head>
<?php

	do_action( 'pet_business_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<?php

	do_action( 'pet_business_page_start_action' ); 

	do_action( 'pet_business_before_header' );

	do_action( 'pet_care_header_action' );

	do_action( 'pet_business_mobile_menu' );

	do_action( 'pet_business_content_start_action' );


	do_action( 'pet_business_header_image_action' );

    if ( pet_business_is_frontpage() ) {

    	$options = pet_business_get_theme_options();

    	$sorted = array( 'slider', 'cta', 'service', 'project', 'product', 'team', 'testimonial', 'blog', 'client' );
	
		foreach ( $sorted as $section ) {
			if ( $section == 'slider' || $section == 'service' || $section == 'project' || $section == 'product' || $section == 'team' || $section == 'testimonial' || $section == 'blog' || $section == 'client' ) {
				add_action( 'pet_care_primary_content', 'pet_care_add_'. $section .'_section' );
			}else{
				add_action( 'pet_care_primary_content', 'pet_business_add_'. $section .'_section' );
			}	
		}

		do_action( 'pet_care_primary_content' );
	}