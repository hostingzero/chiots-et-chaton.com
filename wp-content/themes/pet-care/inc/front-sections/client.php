<?php
/**
 * Client section
 *
 * This is the template for the content of client section
 *
 * @package Theme Palace
 * @subpackage Pet Care
 * @since Pet Care 1.0.0
 */
if ( ! function_exists( 'pet_care_add_client_section' ) ) :
    /**
    * Add client section
    *
    *@since Pet Care 1.0.0
    */
    function pet_care_add_client_section() {
        // Check if client is enabled on frontpage
         if ( get_theme_mod( 'client_section_enable' ) == false ) {
            return false;
        }

        // Render client section now.
        pet_care_render_client_section();
    }
endif;

if ( ! function_exists( 'pet_care_render_client_section' ) ) :
  /**
   * Start client section
   *
   * @return string client content
   * @since Pet Care 1.0.0
   *
   */
   function pet_care_render_client_section() {
            
        ?>

        <div id="pet_business_client_section">

         <div id="partners-logo" class="relative page-section">
                <div class="wrapper">
                    <div class="section-header">
                    <?php if( !empty( get_theme_mod( 'client_title' ) ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'client_title' ) ); ?></h2>
                    <?php endif;
                        if( !empty( get_theme_mod( 'client_subtitle' ) ) ):
                     ?>
                        <p class="section-subtitle"><?php echo esc_html( get_theme_mod( 'client_subtitle' ) ); ?></p>
                    <?php endif; ?>
                    </div><!-- .section-header -->

                    <!-- supports col-1, col-2, col-3, col-4 and col-5 -->
                    <div class="section-content col-5">
                        <?php for ( $i = 1; $i <= 5; $i++){ ?>


                           <?php if( !empty( get_theme_mod( 'client_url_'.$i ) ) && !empty( get_theme_mod( 'client_image_'.$i ) ) ): ?>
                            <article>
                                <a href="<?php echo esc_url( get_theme_mod( 'client_url_'.$i ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'client_image_'.$i ) ); ?>" alt="partner-logo-<?php echo esc_attr( $i ); ?>"></a>
                            </article>
                        <?php endif; ?>


                    <?php } ?>

                </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #partners-logo -->

            </div>
            
    <?php }
endif;