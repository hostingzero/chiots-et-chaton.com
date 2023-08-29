=== Plugin Name ===
Contributors: mimothemes
Donate link: http://mimo.studio
Tags: carousel,jquery,posts,content,columns,slider,woocommerce,siteorigin,products,product,panels,slides,woocommerce product slider,products carousel,woocommerce slider,woocommerce carousel,WooCommerce Product images, WooCommerce widget product slideshow, WooCommerce widgets, woocommerce products carousel,autoplay slider, best product carousel, best product slider for woocommerce shop, carousel, clean woocommerce product slider, multiple product slider, product, product carousel, product content slider, product contents carousel, product slider, product slider carousel for woocommerce, ,responsive product slider, responsive product carousel, slider for woocommerce, smooth product slider, stop on hover slider, widget products slider, woo product slider, woo slider, woocommerce, woocommerce advance slider,  WooCommerce category slider,  woocommerce product carousel slider, WooCommerce Product images, woocommerce product slider, WooCommerce Products, woocommerce products carousel, woocommerce products slider, woocommerce recent product carousel, woocommerce recent product slider, woocommerce recent products, woocommerce slider wordpress ecommerce,grid slider,grid woocommerce slider,touch slider, touch carousel,choose columns, columns slider,animated slider,animated carousel,css3 carousel,css3 slider,horizontal carousel, horizontal slider, horizontal woocommerce carousel, horizontal products carousel, vertical slider, woocommerce vertical slider, siteorigin addons, Siteorigin page builder
Requires at least: 4.3
Tested up to: 4.5.2
Stable tag: 1.3.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create Custom Carousels with no code knowledge. Choose Columns, show/hide arrows/dots and a lot of options, display any taxonomy. Use it with products in Woocommerce

== Description ==

Creates a shortcode to display Carousels with custom loops. Use the shortcode like this:  [mimo_carousel id="the carousel id"] , you can use this plugin with Woocommerce to make a products carusel. Mimo Carousel plugin is completely compatible with Page Builder by Siteorigin plugin.

With its widget or shortcode, this plugin can be used to create a woocommerce products slider with 1,2,3,4 or more columns. with more than 1 column it has a carousel view that works perfectly to showcase your products or posts.

Set different options

<strong>Loop options</strong>
<ol>
	<li>-offset</li>
	<li>-Categories to show</li>
	<li>Number of posts</li>
	<li>Image size to use</li>
	<li>Custom Post Type to use, you can use Woocommerce products for example in the Carousels</li>
	<li>Exclude Post</li>
	<li>Order</li>
	<li>Order by</li>
</ol>
<strong>Design Options</strong>
<ol>
	<li>Hide Title of posts</li>
	<li>Hide Excerpt of posts</li>
	<li>Hide images of posts</li>
	<li>Use your own theme templates, for theme developers, see developer instructions</li>
</ol>
<strong>Carousel Options</strong>
<ol>
	<li>Show/Hide <strong>dots</strong></li>
	<li>Show/Hide <strong>arrows</strong></li>
	<li>Accessibility: Enables tabbing and arrow key navigation</li>
	<li>Adaptive Height: Enables adaptive height for single slide horizontal carousels.</li>
	<li>Autoplay</li>
	<li>Autoplay Speed</li>
	<li>As Nav for: Set the slider to be the navigation of other slider (Class or ID Name)</li>
	<li>draggable</li>
	<li>Kind of easing</li>
	<li>lazyLoad</li>
	<li>pauseOnHover</li>
	<li>mobileFirst : Responsive settings use mobile first calculation</li>
	<li>pauseOnDotsHover</li>
	<li>rows</li>
	<li>slidesPerRow</li>
	<li><strong>slidesToShow: Number of posts to show</strong></li>
	<li><strong>slidesToScroll</strong>: In each horizontal scroll</li>
	<li>speed</li>
	<li>touchMove</li>
	<li>vertical</li>
	<li>rtl</li>
	<li>variableWidth: Variable width slides</li>
</ol>
&nbsp;

== Installation ==



1. Upload `mimo-carousel` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use shortcode [mimo_carousel id="the carousel post id"] to display carousels

== Frequently Asked Questions ==

= It supports any custom post type ? =

Yes.


== Screenshots ==

1. Shows the widget in action just showing some products of Woocommerce plugin


== Changelog ==

= 1.0 =
* First Release


= 1.2 = 

-Improved settings for each carousel

= 1.3 = 

-Loop construction issues solved
-Solved small css issues

= 1.3.1 = 

-Loop construction issues solved

= 1.3.2 = 

-Loop construction issues solved
-Added templating 

= 1.3.3 = 

Loop construction issues solved

= 1.3.4 = 

Loop construction issues solved

= 1.3.5 = 

Added responsive behavior

== Usage instructions ==

Create your Carousels in Wordpress Dashboard/Carousels

Use shortcode [mimo_carousel id="the carousel post id"] to display carousels or use Mimo Carousel Widget

== Developer instructions ==

Apart from the options inside widget you can manipulate the before/after loop and articles content with this actions:

do_action('mimo_carousel_before_content'); // The beginnning of content inside each article
do_action('mimo_carousel_after_content'); // The end of content inside each article
do_action('mimo_carousel_before_loop'); // Out of the loop
do_action('mimo_carousel_after_loop'); // Out of the loop

Create a folder in your theme called 'mimo-carousel' and inside a folder called 'partials', then create a file insise, called 'mimo-carousel-content.php', to overwrite content template for posts. You can especify here which template to use for the posts view inside carousel. This would be normally the template called content.php in your theme.

Example of file 'mimo-carousel-content.php' :

[Example 1][markdown syntax]

    if(class_exists('Woocommerce') && get_post_type() == 'product' ) {
 		//Use woocommerce template of theme
		get_template_part( 'woocommerce/content','product');  

	} else {
		//Use post template of theme
		get_template_part( 'template-parts/content');  
	}

[markdown syntax]




Find plugin and issues solved at [Mimo Studio](http://mimo.studio  "Wordpress developer")