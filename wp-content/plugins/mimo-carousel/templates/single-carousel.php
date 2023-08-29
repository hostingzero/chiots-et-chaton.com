<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Mimo Cube
 * @since 1.0
 */

get_header();  


$myargs = array();
$myargs['id'] = get_the_id();

$myfirstvar = new Mimo_Carousel();

$myvar = new Mimo_Carousel_Public( $myfirstvar->get_plugin_name(), $myfirstvar->get_version() );
$myvar->display_carousel( $myargs );





 get_footer(); ?>

