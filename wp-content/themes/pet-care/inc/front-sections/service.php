<?php
/**
 * Service section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Pet Business 1.0.0
 */
if ( ! function_exists( 'pet_care_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since Pet Business 1.0.0
    */
    function pet_care_add_service_section() {
    	$options = pet_business_get_theme_options();
        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'pet_business_section_status', true, 'service_section_enable' );

        if ( true !== $service_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'pet_care_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render service section now.
        pet_care_render_service_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since Pet Business 1.0.0
    * @param array $input service section details.
    */
    function pet_business_get_service_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['service_content_page_' . $i] ) )
                $page_ids[] = $options['service_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['content']     = pet_business_trim_content( 20 );
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';
                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// service section content details.
add_filter( 'pet_care_filter_service_section_details', 'pet_business_get_service_section_details' );


if ( ! function_exists( 'pet_care_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since Pet Business 1.0.0
   *
   */
   function pet_care_render_service_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

         <div id="pet_business_service_section">

        <div id="our-services" class="relative page-section">
                <div class="wrapper">
                    <div class="section-header">
                       <?php if ( ! empty( $options['service_title'] ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( $options['service_title'] ); ?></h2>
                    <?php endif; ?>

                    <?php if ( ! empty( get_theme_mod( 'service_sub_title' ) ) ) : ?>
                        <p class="section-subtitle"><?php echo esc_html( get_theme_mod( 'service_sub_title' ) ); ?></p>

                    <?php endif; ?>

                    </div><!-- .section-header -->

                    <!-- supports col-1, col-2,col-3 and col-4 -->
                    <div class="section-content clear col-3">

                    <?php $i=1; foreach ($content_details as $content ):

                        $icon = !empty( get_theme_mod( 'pet_care_service_icon_' . $i ) ) ? get_theme_mod( 'pet_care_service_icon_' . $i ) : 'fa-edit';

                     ?>

                        <article>
                            <div class="services-wrapper">
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><i class="fa <?php echo esc_attr( $icon ); ?>"></i></a>
                                </div><!-- .featured-image -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['content'] ); ?></p>
                                </div><!-- .entry-content -->
                            </div>
                        </article>
                        
                    <?php $i++; endforeach; ?>

                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #our-services -->

            </div>

    <?php }
endif;