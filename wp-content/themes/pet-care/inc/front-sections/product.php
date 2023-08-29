<?php
/**
 * Product section
 *
 * This is the template for the content of product section
 *
 * @package Theme Palace
 * @subpackage Pet Care
 * @since Pet Care 1.0.0
 */
if ( ! function_exists( 'pet_care_add_product_section' ) ) :
    /**
    * Add product section
    *
    *@since Pet Care 1.0.0
    */
    function pet_care_add_product_section() {
        
        if ( get_theme_mod( 'product_section_enable' ) == false ) {
            return false;
        }
        // Get product section details
        $section_details = array();
        $section_details = apply_filters( 'pet_care_filter_product_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render product section now.
        pet_care_render_product_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_care_get_product_section_details' ) ) :
    /**
    * product section details.
    *
    * @since Pet Care 1.0.0
    * @param array $input product section details.
    */
    function pet_care_get_product_section_details( $input ) {
        
        $content = array();
        $post_ids = array();

                for ( $i = 1; $i <= 4; $i++ ) {
                    if ( ! empty( get_theme_mod( 'product_content_woo_product_' . $i ) ) )
                        $post_ids[] = get_theme_mod( 'product_content_woo_product_' . $i );
                }
                
                $args = array(
                    'post_type'         => 'product',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => absint( 4 ),
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );  

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['content']     = pet_business_trim_content( 15 );
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';
                $page_post['id'] = get_the_ID();
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
// product section content details.
add_filter( 'pet_care_filter_product_section_details', 'pet_care_get_product_section_details' );


if ( ! function_exists( 'pet_care_render_product_section' ) ) :
  /**
   * Start product section
   *
   * @return string product content
   * @since Pet Care 1.0.0
   *
   */
   function pet_care_render_product_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="pet_business_product_section">        

        <div id="shop-products" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <?php if( !empty( get_theme_mod( 'product_title' ) ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'product_title' ) ); ?></h2>
                    <?php endif;

                    if( !empty( get_theme_mod( 'product_sub_title' ) ) ): ?>
                    <p class="section-subtitle"><?php echo esc_html( get_theme_mod( 'product_sub_title' ) ); ?></p>
                <?php endif; ?>
            </div><!-- .section-header -->

            <!-- supports col-1, col-2, col-3 and col-4 -->
            <div class="section-content">
                <ul class="products col-4">

                    <?php 
                    $i = 1;
                    foreach ( $content_details as $content ) : 
                        $product = wc_get_product( $content['id'] );
                    ?>

                    <li class="product">
                        <?php if ( ! empty( $content['image'] ) ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>">
                                </a>
                            </div><!-- .post-thumbnail -->
                        <?php endif; ?>

                        <div class="entry-container">
                            <div class="product-meta">
                                <div class="cat-links">
                                    <?php echo wc_get_product_category_list( $content['id'] ); ?>         
                                </div><!-- .cat-links -->
                            </div><!-- .product-meta -->

                            <?php if ( ! empty( $content['title'] ) ) : ?>
                                <h2 class="woocommerce-loop-product__title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            <?php endif; ?>

                            <span class="price">
                                <?php echo $product->get_price_html(); ?>
                            </span><!-- .price -->

                            <div class="button-actions">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart"><?php echo pet_business_get_svg( array( 'icon' => 'cart' ) ); ?>
                                </a>   
                            </div><!-- .button-actions -->  
                        </div><!-- .entry-container -->
                    </li>

                    <?php 
                    $i++;
                    endforeach; ?>

                </ul>
            </div><!-- .section-content -->
        </div><!-- .wrapper -->
    </div><!-- #shop-products -->

    </div>

    <?php }
endif;