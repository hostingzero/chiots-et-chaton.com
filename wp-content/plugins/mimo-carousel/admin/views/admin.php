<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Mimo_Carousel
 * @author    Mimo <mail@mimo.media>
 * @license   GPL-2.0+
 * @link      http://mimo.media
 * @copyright 2015 Mimo
 */

 

?>

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <div class="postbox">
			
			<h3 class="hndle"><span><?php _e( 'Mimo Carousel', 'mimo-carousel' ); ?></span></h3>
			
			<div class="inside">

				<p> <?php _e( 'If you like this plugin please rate it. find support at ', 'mimo-carousel' ); ?><a href="http://www.mimo.media"><?php _e( 'mimo.media', 'mimo-carousel' ); ?></a></p>

			</div>
	</div>
    <div id="tabs" class="settings-tab">
	<ul>
	    <li><a href="#tabs-1"><?php _e( 'General' ); ?></a></li>
	    <li><a href="#tabs-2"><?php _e( 'Advanced', 'mimo-carousel' ); ?></a></li>
	    
	    
	</ul>
	<div id="tabs-1" class="wrap">
		<div class="postbox">
			<h3 class="hndle"><span><?php _e( 'Under Development, please create and set the options of your carousels under Carousels/Add Carousel', 'mimo-carousel' ); ?></span></h3>
			<div class="inside">
		    
		
		   

	   		</div>
	    </div>
	</div>

	<div id="tabs-2" class="wrap">
	<div class="postbox">
		<h3 class="hndle"><span><?php _e( 'Under Development, please create and set the options of your carousels under Carousels/Add Carousel', 'mimo-carousel' ); ?></span></h3>
		<div class="inside">
		    
		
		   

	   		</div>
	    </div>
	</div>
	
	

    
</div>
