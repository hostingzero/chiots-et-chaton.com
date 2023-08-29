<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://mimo.media
 * @since      1.0.0
 *
 * @package    Mimo_Carousel
 * @subpackage Mimo_Carousel/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mimo_Carousel
 * @subpackage Mimo_Carousel/public
 * @author     mimothemes <mimocontact@gmail.com>
 */
class Mimo_Carousel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	private $plugin_slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	protected static $plugin_roles = array(
		'editor' => array(
			'edit_mm_car_carousel' => true,
			'edit_others_mm_car_carousel' => true,
		),
		'author' => array(
			'edit_mm_car_carousel' => true,
			'edit_others_mm_car_carousel' => false,
		),
		'subscriber' => array(
			'edit_mm_car_carousel' => false,
			'edit_others_mm_car_carousel' => false,
		),
	);
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->plugin_slug = 'mm_car';
		$this->version = $version;

		// Create Custom Post Type https://github.com/jtsternberg/CPT_Core/blob/master/README.md
		register_via_cpt_core(
				array( __( 'Carousel', $this->plugin_name ), __( 'Carousels', $this->plugin_name ), 'mm_car_carousel' ), array(
					'taxonomies' => array( 'mimo_carousel_carousel_category' ),
					
					'supports'           => array( 'title' ),
					'menu_icon'           => 'dashicons-images-alt'
				)
		);

		// Create Custom Taxonomy https://github.com/jtsternberg/Taxonomy_Core/blob/master/README.md
		register_via_taxonomy_core(
				array( __( 'Category', $this->plugin_name ), __( 'Categories', $this->plugin_name ), 'mm_car_category' ), array(
					'public' => true,
					'capabilities' => array(
						'assign_terms' => 'edit_posts',
					)
				), array( 'mm_car_carousel' )
		);

		

		add_shortcode( 'mimo_carousel', array( $this, 'carousel_shortcode' ) );

	}

	public function template_chooser( $template ) {
 
	    // Post ID
	    $post_id = get_the_ID();
	 
	    // For all other CPT
	    if ( get_post_type( $post_id ) != 'mm_car_carousel' ) {
	        return $template;
	    }
	 
	    // Else use custom template
	    if ( is_single() ) {
	        return self::get_template_hierarchy( 'mimo-carousel-single' );
	    }
	 
	}

	public function get_template_hierarchy( $template ) {
 
		    // Get the template slug
		    $template_slug = rtrim( $template, '.php' );
		    $template = $template_slug . '.php';
		 
		    // Check if a custom template exists in the theme folder, if not, load the plugin template file
		    if ( $theme_file = locate_template( array( 'mimo-carousel/' . $template ) ) ) {
		        $file = $theme_file;
		    }
		    else {
		        $file = plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . '/templates/' . $template;
		    }
		 
		    return apply_filters( 'rc_repl_template_' . $template, $file );
		}


		public  function get_defaults() {


		$defaults = array(
                $this->plugin_slug . '_columns' => '4' ,
                $this->plugin_slug . '_offset' => '',
                $this->plugin_slug . '_ntax' => '' ,
                $this->plugin_slug . '_ctax' => '' ,
                $this->plugin_slug . '_showposts' => '12' ,
                $this->plugin_slug . '_imagesize' => 'medium' ,
                $this->plugin_slug . '_posttype' => 'post' ,
                $this->plugin_slug . '_related'  => 'no',
                $this->plugin_slug . '_exclude' => '' ,
                $this->plugin_slug . '_title_number' => '5',
                $this->plugin_slug . '_excerpt_number' => '10',
                $this->plugin_slug . '_hide_title' => 'no',

                $this->plugin_slug . '_hide_image' => 'no',
                $this->plugin_slug . '_hide_excerpt' => 'no',
                $this->plugin_slug . '_hide_meta' => 'no',
                $this->plugin_slug . '_hide_pagination' => 'no',
                $this->plugin_slug . '_order' => 'DESC',
                $this->plugin_slug . '_orderby' => 'date',

                //Plugin Options
                $this->plugin_slug . '_accessibility' => true , 
                $this->plugin_slug . '_adaptiveHeight' => false ,
                $this->plugin_slug . '_autoplay' => false,
                $this->plugin_slug . '_autoplaySpeed' => '3000' ,
                $this->plugin_slug . '_arrows' => true ,
                $this->plugin_slug . '_asNavFor' => '' ,
                $this->plugin_slug . '_appendArrows' => '' ,
                $this->plugin_slug . '_prevArrow' => '<button type="button" class="slick-prev">Next</button>' ,
                $this->plugin_slug . '_nextArrow' => '<button type="button" class="slick-next">Next</button>',
                $this->plugin_slug . '_centerMode' => false,
                $this->plugin_slug . '_centerPadding' => '50px',

                $this->plugin_slug . '_cssEase' => 'ease',
                $this->plugin_slug . '_dots' => false,
                $this->plugin_slug . '_draggable' => true,
                $this->plugin_slug . '_fade' => false,
                $this->plugin_slug . '_focusOnSelect' => false,
                $this->plugin_slug . '_easing' => 'linear',
                $this->plugin_slug . '_edgeFriction' => '0.15',
                $this->plugin_slug . '_infinite' => true,
                $this->plugin_slug . '_initialSlide' => '0', //Accepts progressive
                $this->plugin_slug . '_lazyLoad' => 'ondemand',
                $this->plugin_slug . '_mobileFirst' => false,

               	$this->plugin_slug . '_pauseOnHover' => true,
                $this->plugin_slug . '_pauseOnDotsHover' => false,
                $this->plugin_slug . '_respondTo' => 'window', //window,slider,min(smaller of the two)
                $this->plugin_slug . '_responsive' => 'none', //Object containing breakpoints and settings objects (see demo). Enables settings sets at given screen width. Set settings to "unslick" instead of an object to disable slick at a given breakpoint.
                $this->plugin_slug . '_rows' => '1', // Setting this to more than 1 initializes grid mode. Use slidesPerRow to set how many slides should be in each row.
                $this->plugin_slug . '_slide' => '', //Element query to use as slide
                $this->plugin_slug . '_slidesPerRow' => '1', // With grid mode intialized via the rows option, this sets how many slides are in each grid row. dver

                $this->plugin_slug . '_slidesToShow' => '1',
                $this->plugin_slug . '_slidesToScroll' => '1',
                $this->plugin_slug . '_speed' => '300',
                $this->plugin_slug . '_swipe' => true,
                $this->plugin_slug . '_swipeToSlide' => false,
                $this->plugin_slug . '_touchMove' => true,
                $this->plugin_slug . '_touchThreshold' => '5',
                $this->plugin_slug . '_useCSS' => true,
                $this->plugin_slug . '_variableWidth' => false,
                $this->plugin_slug . '_vertical' => false, 
                $this->plugin_slug . '_verticalSwiping' => false,
                $this->plugin_slug . '_rtl' => false,

                

            );

    	return $defaults;

	}

	public static function blog_slider($mimo_carousel_image_size){ ?>
			<div class="mimo_carousel-blog-slider">
				<div class="mimo_carousel-entry-thumbnail ">
					<div class="mimo_carousel-in-entry-thumbnail">
						<a data-rel="<?php the_ID(); ?>" class="mimo_carousel-post-sharer" href="<?php the_permalink(); ?>">
							<i class="fa fa-plus"></i>
						</a>
							<?php if ( has_post_thumbnail() && ! post_password_required() ) {    
									$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),$mimo_carousel_image_size ); 
									$image_full_src = wp_get_attachment_image_src( get_post_thumbnail_id(),$mimo_carousel_image_size ); ?>
							<img  class="showed" src="<?php  echo esc_url($image_src[0])  ?>" alt="" />
							<?php } else { ?>
							<img  class="showed" src="<?php  echo esc_url(plugin_dir_url( __FILE__ ) . 'img/img-placeholder.jpg' ) ; ?>" alt="" />
							<?php	} ?>
						
					</div>
				</div>
			</div>
		
				
	
	<?php }
	public static function getctas() {

    $movies = get_posts( array(
   'showposts' => -1, // we want to retrieve all of the posts
   'post_type' => 'mm_car_carousel' // this argument is required for CPT-onomies
) );

    $my_posts_array = array();

     $my_titles_array = array();

    foreach ( $movies as $movie ) {

    	$my_posts_array[] = $movie->ID ;

    	$my_titles_array[] = get_the_title($movie->ID);
	}
		 $my_last_array = array_combine($my_posts_array, $my_titles_array);

		 return  $my_last_array;

}


	public function display_carousel($args){

		$defaults = wp_parse_args(array(

			'id' => '',
		    

		));

		
	// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );

		$the_id = $args['id'];
		$mm = get_post_meta($the_id);
		foreach($mm as $value => $defaultvalue){
			
					$$value = $defaultvalue['0'];
				}

				$theclass =  $this->get_defaults();
				

				foreach($theclass as $values => $defaults){
					if(! isset($$values)) $$values = '';
				}

			 ?>
			


	
			
				<div id="mimo-carousel" class="mimo-carousel-<?php esc_attr_e($the_id); ?>">
				
				<?php 	$postsargs = array('offset' => $mm_car_offset, 'posts_per_page' => $mm_car_showposts, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1,   'post_type' => $mm_car_posttype);
						//$tags = wp_get_post_tags(get_the_id());
				
				

					if(isset($mm_car_ntax ) ) :
						//If the values are comma separated strings, we find comma
					if (strpos($mm_car_ctax, ',') !== FALSE) $mm_car_ctax = explode(',', $mm_car_ctax);
					//If it is not set
					if($mm_car_ctax == '' || ! isset($mm_car_ctax) ) :
						$mm_car_ctax = array();
						$custom_terms = get_terms($mm_car_ntax);

					foreach($custom_terms as $custom_term) {

						$mm_car_ctax[] = $custom_term->slug;
					}
						endif;

					$mm_car_ctax_query = array(
				        
				       array(
				            'taxonomy' => $mm_car_ntax,
				            'field' => 'slug',
				            'terms' => $mm_car_ctax,
				            'include_children' => true,
        					'operator' => 'IN'
				        )
				    );

				 	$postsargs['tax_query'] = $mm_car_ctax_query;



				endif;


				


				

							if(isset($mm_car_exclude) ) $postsargs['post__not_in'] = $mm_car_exclude;
						//if ($tags) :

							//$first_tag = $tags[0]->term_id;
							//$args['tag__in'] = array($first_tag);
							
						//endif;
							
				do_action('mimo_carousel_before_loop');

				$rp = new WP_Query($postsargs);
				
				if ($rp->have_posts()) :  while ($rp->have_posts() ) : $rp->the_post(); 

				$categories = get_the_category();
		 				
		 				$mimo_carousel_title = get_the_title(); 
		 				$mimo_carousel_excerpt = get_the_excerpt();  ?>

					<article class="">


						<?php 

						do_action('mimo_carousel_before_content');

						 if ( $mimo_carousel_template = locate_template( 'mimo-carousel/partials/mimo-carousel-content.php' ) ) {
						   // locate_template() returns path to file
						   // if either the child theme or the parent theme have overridden the template
						   load_template( $mimo_carousel_template, false );
						 } else {
						   // If neither the child nor parent theme have overridden the template,
						   // we load the template from the 'templates' sub-directory of the directory this file is in
						   // TODO load_template( dirname( __FILE__ ) . '/partials/mimo-carousel-content.php' );



								if($mm_car_hide_image !== 'on'): 

									self::blog_slider('medium'); 

								endif;



				 				
				 				
				 				if($mimo_carousel_title && $mm_car_hide_title !== 'on'): ?>
									
									<div class="mm-car-entry-title entry-title">
										
										<a href="<?php the_permalink(); ?>" rel="bookmark">
											
											<?php echo wp_trim_words(get_the_title(), $mm_car_title_number); ?>
										
										</a>
									
									</div>
								<?php endif; 

								if($mimo_carousel_excerpt && $mm_car_hide_excerpt !== 'on'): ?>

									<div class="mm-car-excerpt entry-content">
										
										<?php echo wp_trim_words(get_the_excerpt(), $mm_car_excerpt_number); ?>
									</div>	

								<?php endif; 



							 }

						

						do_action('mimo_carousel_after_content');?>
						</article>
							
				<?php endwhile; wp_reset_postdata(); endif; 

				do_action('mimo_carousel_after_loop');?>
				
					</div>

				
					<div class="clear"></div>
			
				

		<?php

		$mimo_car_values1 = array();
		//Pass the id of the carousel to the class
		$mimo_car_values1['theid'] = $the_id;
		//Pass all the jquery slick plugin vars

		
			$mimo_car_values1['mm_car_dots'] = $mm_car_dots;
			$mimo_car_values1['mm_car_arrows'] = $mm_car_arrows;
			$mimo_car_values1['mm_car_accessibility'] = $mm_car_accessibility;
			$mimo_car_values1['mm_car_adaptiveHeight'] = $mm_car_adaptiveHeight;
			$mimo_car_values1['mm_car_autoplay'] = $mm_car_autoplay;
			$mimo_car_values1['mm_car_autoplaySpeed'] = $mm_car_autoplaySpeed;
			$mimo_car_values1['mm_car_asNavFor'] = $mm_car_asNavFor;
			$mimo_car_values1['mm_car_appendArrows'] = $mm_car_appendArrows;
			$mimo_car_values1['mm_car_prevArrow'] = $mm_car_prevArrow;
			$mimo_car_values1['mm_car_nextArrow'] = $mm_car_nextArrow;
			$mimo_car_values1['mm_car_centerMode'] = $mm_car_centerMode;
			$mimo_car_values1['mm_car_centerPadding'] = $mm_car_centerPadding;
			$mimo_car_values1['mm_car_cssEase'] = $mm_car_cssEase;
			$mimo_car_values1['mm_car_draggable'] = $mm_car_draggable;
			$mimo_car_values1['mm_car_fade'] = $mm_car_fade;
			$mimo_car_values1['mm_car_focusOnSelect'] = $mm_car_focusOnSelect;
			$mimo_car_values1['mm_car_easing'] = $mm_car_easing;
			$mimo_car_values1['mm_car_edgeFriction'] = $mm_car_edgeFriction;
			$mimo_car_values1['mm_car_infinite'] = $mm_car_infinite;
			$mimo_car_values1['mm_car_initialSlide'] = $mm_car_initialSlide;
			$mimo_car_values1['mm_car_lazyLoad'] = $mm_car_lazyLoad;
			$mimo_car_values1['mm_car_mobileFirst'] = $mm_car_mobileFirst;
			$mimo_car_values1['mm_car_pauseOnHover'] = $mm_car_pauseOnHover;
			$mimo_car_values1['mm_car_pauseOnDotsHover'] = $mm_car_pauseOnDotsHover;
			$mimo_car_values1['mm_car_respondTo'] = $mm_car_respondTo;
			$mimo_car_values1['mm_car_responsive'] = $mm_car_responsive;
			$mimo_car_values1['mm_car_rows'] = $mm_car_rows;
			$mimo_car_values1['mm_car_slide'] = $mm_car_slide;
			$mimo_car_values1['mm_car_slidesPerRow'] = $mm_car_slidesPerRow;
			$mimo_car_values1['mm_car_slidesToShow'] = $mm_car_slidesToShow;
			$mimo_car_values1['mm_car_slidesToScroll'] = $mm_car_slidesToScroll;
			$mimo_car_values1['mm_car_speed'] = $mm_car_speed;
			$mimo_car_values1['mm_car_swipe'] = $mm_car_swipe;
			$mimo_car_values1['mm_car_swipeToSlide'] = $mm_car_swipeToSlide;
			$mimo_car_values1['mm_car_touchMove'] = $mm_car_touchMove;
			$mimo_car_values1['mm_car_touchThreshold'] = $mm_car_touchThreshold;
			$mimo_car_values1['mm_car_useCSS'] = $mm_car_useCSS;
			$mimo_car_values1['mm_car_variableWidth'] = $mm_car_variableWidth;
			$mimo_car_values1['mm_car_vertical'] = $mm_car_vertical;
			$mimo_car_values1['mm_car_verticalSwiping'] = $mm_car_verticalSwiping;
			$mimo_car_values1['mm_car_rtl'] = $mm_car_rtl;


		
		

		


		
		$mimo_car_values = json_encode($mimo_car_values1);
		wp_enqueue_script( 'cares', plugin_dir_url( __FILE__ ) . 'js/mimo-carousel-public.js', array( 'jquery' ),'', false );
		wp_localize_script( 'cares', 'mm_car_values', $mimo_car_values );
		
		//wp_localize_script( 'cares', 'mm_car_id', $the_id );

		add_action( 'wp_enqueue_scripts',  'display_carousel'  );
	}

	public function carousel_shortcode($atts) {
		// Shortcode that shows the map
		
		 extract( shortcode_atts( array(

			'id' => '',
		    

		) , $atts ) );

		 $args = array();


	
	// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $atts );

		 	self::display_carousel($args );

		  	
             

	}

	
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name . 'css2', plugin_dir_url( __FILE__ ) . 'css/mimo-carousel-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'css1', plugin_dir_url( __FILE__ ) . 'css/slick.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, false );

	}

};


