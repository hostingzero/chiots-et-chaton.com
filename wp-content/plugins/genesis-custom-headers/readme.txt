=== Genesis Custom Headers ===
Contributors: ndiego, outermostdesign
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TY8RB6CHZSFAG
Tags: header, genesis, custom header, featured image, Genesis Framework, genesiswp
Requires at least: 3.6
Tested up to: 5.7
Stable tag: 1.1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add custom headers to each page, post, or custom post type. Header options include: featured image, custom image, slideshows, HTML, scripts, and more. 

== Description ==

> ⚠️  **Warning**
>
> Genesis Custom Headers has reached the end of its life. The plugin was built to solve a problem that will soon no longer exist. The advent of block themes utilizing the Site Editor has superseded Genesis Custom Headers. Critical support will still be provided in the support forum, but the plugin is no longer being actively developed.

Originally designed to allow the easy addition of custom images and featured images to selected posts, this plugin was greatly expanded to provide a wide range of header content options which are listed below. It is important to mention that this plugin does *not* add headers to every page of your site like some other plugins in the WordPress plugin repository. Genesis Custom Headers allows you to add customized headers to pages, posts, and public custom post types.

Also, this plugin purposefully includes minimal styling so that custom headers can adapt to your site. Therefore, custom CSS will occasionally need to be added to achieve the precise aesthetic you are looking for. Custom CSS can be added directly from the plugin Settings Page. If you have questions or would like to request additional features, let me know in the plugin support forum. 

This plugin is only for Genesis Framework users. Genesis is a premium product of [StudioPress](http://www.studiopress.com), which has no affiliation with Genesis Custom Headers.

= Header Content Options =
* Display the featured image
* Display a custom image
* Display slideshows using shortcodes or directly using one of the natively supported slider plugins
* Display custom content (Using the Wordpress tinymce editor)
* Display iframes, or raw HTML content (Great for Google maps) 
* Run page/post specific scripts 
* Set a global header position or page/post specific header positions using Genesis hooks
* Enable custom headers on any *public* custom post type

= Natively Supported Slider Plugins =
* [Soliloquy](http://soliloquywp.com/)
* [Revolution Slider](http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380)
* [Meta Slider](http://www.metaslider.com/)
* [Slider Pro](http://codecanyon.net/item/slider-pro-wordpress-premium-slider-plugin/253501)

**Disclaimer:** 
Genesis Custom Headers does not actually include copies of the slider plugins listed above, or any slider plugin for that matter. It just supports these plugins if you already have one of them installed on your website.

= Support This Plugin = 

There are a few ways you can help support this plugin:

1. If you spot an error or bug, please let us know in the support forums. The issue will be diagnosed an a new release push out as soon as possible.
1. [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TY8RB6CHZSFAG). Time is money, and contributions from users like you really help us dedicate more hours to the continual support of this plugin.

== Installation ==

1. You have a couple options:
	* *Go to Plugins->Add New and search for "Genesis Custom Headers”. Once found, click "Install".
	* *Download the folder from Wordpress.org and zip the folder. Then upload via Plugins->Add New->Upload.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. From the ‘Plugins’ page, head directly to the plugin ‘Settings’ page to configure your global options.
4. Once the global settings have been set, navigate to a post, page, or custom post type, and edit the ‘Genesis Custom Headers’ metabox to your liking. If you have any implementation questions, please post in the plugin support forum.

**Please Note:** This plugin is only for Genesis Framework users. Genesis is a premium product by [StudioPress](http://www.studiopress.com). If you do not have Genesis 2.0+ or WordPress 3.6+, the plugin will not activate.

= Uninstall =

By default, when you deactivate and uninstall this plugin, none of the settings or data is removed from your WordPress database. To delete all data created by this plugin, navigate to the plugin ‘Settings’ page and check the appropriate box in the **Misc Settings**. Then deactivate and delete the plugin.

== Screenshots ==

1. Screenshot of Genesis Custom Headers metabox with no header options selected on a new page. 
2. Screenshot of Genesis Custom Headers metabox with all header options selected on an existing page. 
3. Screenshot of the Settings Page for Genesis Custom Headers
4. An output example using custom content on the Genesis default theme by StudioPress
5. An output example using a custom image and caption on the Genesis default theme by StudioPress

== Changelog ==

= 1.1.6 =
* Fixed conflict with Genesis 3.0

= 1.1.5 =
* Fixed bug caused by Jetpack and other theme switching plugins

= 1.1.4 =
* Fixed uninstall bug for non-Genesis users

= 1.1.3 =
* Updated informational links

= 1.1.2 =
* Updated readme
* Added uninstall setting which allows you to remove all plugin data on uninstall
* Added marketing notices for Blox Lite (sorry), which is the next iteration of this plugin

= 1.1.1 =
* Added deactivation function so plugin will deactivate if a user switches to a non-Genesis theme

= 1.1.0 =
* Added ability to enable/disable various header options from the Settings Page for a cleaner UI
* Enhanced compatibility with custom post types
* Certain comments are now hidden from non-Admins to avoid confusion

= 1.0.0 =
* Initial Release
