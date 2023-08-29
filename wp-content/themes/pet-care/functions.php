<?php

if ( ! function_exists( 'pet_care_enqueue_styles' ) ) :

	function pet_care_enqueue_styles() {
		wp_enqueue_style( 'pet-care-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'pet-care-style', get_stylesheet_directory_uri() . '/style.css', array( 'pet-care-style-parent' ), '1.0.0' );

		wp_enqueue_script( 'pet-care-custom', get_theme_file_uri() . '/custom.js', array(), '1.0', true );

		wp_enqueue_style( 'pet-care-fonts', pet_care_fonts_url(), array(), null );
	}

endif;

add_action( 'wp_enqueue_scripts', 'pet_care_enqueue_styles', 99 );

function pet_care_customize_control_style() {

	// simple icon picker
	wp_enqueue_style( 'simple-iconpicker-css', get_theme_file_uri() . '/simple-iconpicker.css' );

	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.css' );

	wp_enqueue_script( 'jquery-simple-iconpicker', get_theme_file_uri() . '/simple-iconpicker.js', array( 'jquery' ), '', true );

	wp_enqueue_style( 'pet-care-customize-controls', get_theme_file_uri() . '/customizer-control.css' );

	wp_enqueue_script( 'pet-care-customize-controls', get_theme_file_uri() . '/customizer-control.js', array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'pet_care_customize_control_style' );

if ( !function_exists( 'pet_care_block_editor_styles' ) ):

	function pet_care_block_editor_styles() {
		wp_enqueue_style( 'pet-care-fonts', pet_care_fonts_url(), array(), null );
	}

endif;

add_action( 'enqueue_block_editor_assets', 'pet_care_block_editor_styles' );


if ( ! function_exists( 'pet_care_fonts_url' ) ) :

function pet_care_fonts_url() {
	
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'pet-care' ) ) {
		$fonts[] = 'Poppins:400,500,600,700';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

endif;



if ( ! function_exists( 'pet_care_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Pet Business 1.0.0
	 *
	 */
	function pet_care_header_start() { ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'pet_care_header_action', 'pet_care_header_start', 10 );

if ( ! function_exists( 'pet_care_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Pet Business 1.0.0
	 *
	 */
	function pet_care_site_branding() {
		$options  = pet_business_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];		
		?>
		<div class="site-branding">
			<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php } 
			if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
				<div id="site-identity">
					<?php
					if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
						if ( pet_business_is_latest_posts() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
					} 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; 
					}?>
				</div>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'pet_care_header_action', 'pet_care_site_branding', 20 );

if ( ! function_exists( 'pet_care_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Pet Business 1.0.0
	 *
	 */
	function pet_care_site_navigation() {
		$options = pet_business_get_theme_options();
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			 <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php 
                	echo pet_business_get_svg( array( 'icon' => 'menu' ) );
					echo pet_business_get_svg( array( 'icon' => 'close' ) );
                 ?>
                <span class="menu-label">Primary Menu</span>
            </button>
			<?php  
				$search = '';
				if ( $options['nav_search_enable'] ) :
					$search = '<li class="search-menu"><a href="#">';
					$search .= pet_business_get_svg( array( 'icon' => 'search' ) );
					$search .= pet_business_get_svg( array( 'icon' => 'close' ) );
					$search .= '</a><div id="search">';
					$search .= get_search_form( $echo = false );
	                $search .= '</div><!-- #search --></li>';
                endif;

        		wp_nav_menu( array(
        			'theme_location' => 'primary',
        			'container' => 'div',
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'echo' => true,
        			'fallback_cb' => 'pet_business_menu_fallback_cb',
        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
        		) );
        	?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'pet_care_header_action', 'pet_care_site_navigation', 30 );


if ( ! function_exists( 'pet_care_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Pet Business 1.0.0
	 *
	 */
	function pet_care_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'pet_care_header_action', 'pet_care_header_end', 50 );

/**
 * List of posts for custom post choices.
 * @return Array Array of post ids and name.
 */
function pet_care_product_choices() {
    $args = array(
        'post_type'         => 'product',
        'posts_per_page'    => -1,
    );
    $posts = get_posts( $args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'pet-care' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}

require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/slider.php';

require get_theme_file_path() . '/inc/front-sections/service.php';

require get_theme_file_path() . '/inc/front-sections/project.php';

require get_theme_file_path() . '/inc/front-sections/testimonial.php';

require get_theme_file_path() . '/inc/front-sections/product.php';

require get_theme_file_path() . '/inc/front-sections/team.php';

require get_theme_file_path() . '/inc/front-sections/blog.php';

require get_theme_file_path() . '/inc/front-sections/client.php';