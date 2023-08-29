<?php

function pet_care_customize_register( $wp_customize ) {

	class Pet_Care_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}

	class Pet_Care_Dropdown_Chooser extends WP_Customize_Control{

		public $type = 'dropdown_chooser';

		public function render_content(){
			if ( empty( $this->choices ) )
	                return;
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <select class="pet-care-chosen-select" <?php $this->link(); ?>>
	                    <?php
	                    foreach ( $this->choices as $value => $label )
	                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
	                    ?>
	                </select>
	            </label>
			<?php
		}
	}

	class Pet_Care_Icon_Picker extends WP_Customize_Control{
		public $type = 'icon-picker';


		public function render_content(){
			$id = uniqid();
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <input id="pet-care-<?php echo esc_attr( $id ); ?>" placeholder="<?php esc_attr_e( 'Click here to select icon', 'pet-care' ); ?>" class="pet-care-icon-picker input" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
	            </label>
			<?php
		}
	}

	class Pet_Care_Multi_Input_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'multi-input';

		/**
		 * Control button text.
		 *
		 * @var string
		 */
		public $button_text;

		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize_multi_value_field" <?php $this->link(); ?> />
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php echo esc_html( $this->button_text ); ?></a>
			</label>
			<?php
		}
	}
	
	$wp_customize->remove_section( 'colors' );	

	/*slider customizer*/

	// slider btn label setting and control
	$wp_customize->add_setting( 'pet_care_slider_btn_label', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'pet_care_slider_btn_label', array(
		'label'           	=> esc_html__( 'Button Label', 'pet-care' ),
		'section'        	=> 'pet_business_slider_section',
		'active_callback' 	=> 'pet_business_is_slider_section_enable',
		'type'				=> 'text',
		'priority' => 15,
	) );

	// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'pet_care_slider_btn_label', array(
		'selector'            => '#featured-slider .btn-default',
		'settings'            => 'pet_care_slider_btn_label',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_care_btn_title_partial',
    ) );
}

/*service customizer*/

// about btn title setting and control
$wp_customize->add_setting( 'service_sub_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'service_sub_title', array(
	'label'           	=> esc_html__( 'Sub Title', 'pet-care' ),
	'section'        	=> 'pet_business_service_section',
	'active_callback' 	=> 'pet_business_is_service_section_enable',
	'type'				=> 'text',
	'priority' => 15,
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'service_sub_title', array(
		'selector'            => '#our-services p.section-subtitle',
		'settings'            => 'service_sub_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_service_sub_title_partial',
    ) );
}

for ( $i = 1; $i <= 3; $i++ ) :

		// service note control and setting
	$wp_customize->add_setting( 'pet_care_service_icon_' . $i,
		array(
			'sanitize_callback' => 'sanitize_text_field',
			)
		);

$wp_customize->add_control( new Pet_Care_Icon_Picker( $wp_customize,
	'pet_care_service_icon_' . $i,
	array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'pet-care' ), $i ),
		'section'           => 'pet_business_service_section',
		'active_callback'	=> 'pet_business_is_service_section_enable',
		'priority' => 25,
		)
	)
);

endfor;

/*project customizer*/

// project btn title setting and control
$wp_customize->add_setting( 'project_sub_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'project_sub_title', array(
	'label'           	=> esc_html__( 'Sub Title', 'pet-care' ),
	'section'        	=> 'pet_business_project_section',
	'active_callback' 	=> 'pet_business_is_project_section_enable',
	'type'				=> 'text',
	'priority' => 25,
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'project_sub_title', array(
		'selector'            => '#latest-projects p.section-subtitle',
		'settings'            => 'project_sub_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_project_sub_title_partial',
    ) );
}

/*shop product customizer*/

if ( class_exists( 'WooCommerce' ) ) {

// Add Product section
$wp_customize->add_section( 'pet_business_product_section', array(
	'title'             => esc_html__( 'Product','pet-care' ),
	'description'       => esc_html__( 'Product Section options.', 'pet-care' ),
	'panel'             => 'pet_business_front_page_panel',
	'priority' 			=> 45,
) );

// Product content enable control and setting
$wp_customize->add_setting( 'product_section_enable', array(
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Care_Switch_Control( $wp_customize, 'product_section_enable', array(
	'label'             => esc_html__( 'Product Section Enable', 'pet-care' ),
	'section'           => 'pet_business_product_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );

// product title setting and control
$wp_customize->add_setting( 'product_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __( 'Our Lattest Products', 'pet-care' ),
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'product_title', array(
	'label'           	=> esc_html__( 'Title', 'pet-care' ),
	'section'        	=> 'pet_business_product_section',
	'active_callback' 	=> 'pet_care_is_product_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'product_title', array(
		'selector'            => '#shop-products h2.section-title',
		'settings'            => 'product_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_product_title_partial',
    ) );
}

// product sub title
$wp_customize->add_setting( 'product_sub_title', array(
	'default'			=> __( 'A cultural icon is a person or artifact that is recognized by members', 'pet-care' ),
	'sanitize_callback' => 'sanitize_textarea_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'product_sub_title', array(
	'label'             => esc_html__( 'Sub title', 'pet-care' ),
	'section'           => 'pet_business_product_section',
	'active_callback'	=> 'pet_care_is_product_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'product_sub_title', array(
		'selector'            => '#shop-products .section-subtitle',
		'settings'            => 'product_sub_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_product_sub_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :

		// product pages drop down chooser control and setting
		$wp_customize->add_setting( 'product_content_woo_product_' . $i, array(
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( new Pet_Care_Dropdown_Chooser( $wp_customize, 'product_content_woo_product_' . $i, array(
			'label'             => sprintf( esc_html__( 'Select Product %d', 'pet-care' ), $i ),
			'section'           => 'pet_business_product_section',
			'choices'			=> pet_care_product_choices(),
			'active_callback'	=> 'pet_care_is_product_section_enable',
		) ) );

endfor;

}

/*Team customizer*/

// btn title setting and control
$wp_customize->add_setting( 'team_sub_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'team_sub_title', array(
	'label'           	=> esc_html__( 'Sub Title', 'pet-care' ),
	'section'        	=> 'pet_business_team_section',
	'active_callback' 	=> 'pet_business_is_team_section_enable',
	'type'				=> 'text',
	'priority' => 25,
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'team_sub_title', array(
		'selector'            => '#our-team p.section-subtitle',
		'settings'            => 'team_sub_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_team_sub_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :

	// team social
	$wp_customize->add_setting( 'team_social_'. $i, array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new Pet_Care_Multi_Input_Custom_Control( $wp_customize, 'team_social_'. $i, array(
		'label'             => sprintf( esc_html__( 'Social %d', 'pet-care' ), $i ),
		'button_text'       => esc_html__( 'Add social.', 'pet-care' ),
		'section'           => 'pet_business_team_section',
		'active_callback' 	=> 'pet_business_is_team_section_enable',
		'priority'			=> 35,
	) ) );

endfor;

/*blog customizer*/

// btn title setting and control
$wp_customize->add_setting( 'blog_sub_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'blog_sub_title', array(
	'label'           	=> esc_html__( 'Sub Title', 'pet-care' ),
	'section'        	=> 'pet_business_blog_section',
	'active_callback' 	=> 'pet_business_is_blog_section_enable',
	'type'				=> 'text',
	'priority' => 35,
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blog_sub_title', array(
		'selector'            => '#latest-posts p.section-subtitle',
		'settings'            => 'blog_sub_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_care_blog_sub_title_partial',
    ) );
}

/*partners logo customizer*/

// Add Client section
$wp_customize->add_section( 'pet_business_client_section', array(
	'title'             => esc_html__( 'Client','pet-care' ),
	'description'       => esc_html__( 'Client Section options.', 'pet-care' ),
	'panel'             => 'pet_business_front_page_panel',
	'priority' => 100,
) );

// Client content enable control and setting
$wp_customize->add_setting( 'client_section_enable', array(
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Care_Switch_Control( $wp_customize, 'client_section_enable', array(
	'label'             => esc_html__( 'Client Section Enable', 'pet-care' ),
	'section'           => 'pet_business_client_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );

// blog title setting and control
$wp_customize->add_setting( 'client_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> __( 'Our Main Clients' , 'pet-care' ),
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'client_title', array(
	'label'           	=> esc_html__( 'Title', 'pet-care' ),
	'section'        	=> 'pet_business_client_section',
	'active_callback' 	=> 'pet_care_is_client_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'client_title', array(
		'selector'            => '#partners-logo h2.section-title',
		'settings'            => 'client_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_care_client_title_partial',
    ) );
}

// blog btn title setting and control
$wp_customize->add_setting( 'client_subtitle', array(
	'sanitize_callback' => 'sanitize_textarea_field',
	'default'			=> __('A cultural icon is a person or artifact that is recognized by members', 'pet-care'),
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'client_subtitle', array(
	'label'           	=> esc_html__( 'Sub title', 'pet-care' ),
	'section'        	=> 'pet_business_client_section',
	'active_callback' 	=> 'pet_care_is_client_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'client_subtitle', array(
		'selector'            => '#partners-logo p.section-subtitle',
		'settings'            => 'client_subtitle',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_care_client_subtitle_partial',
    ) );
}

for ( $i = 1; $i <= 5; $i++ ) :
	// client number control and setting
	$wp_customize->add_setting( 'client_image_'.$i, array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'client_image_'.$i, array(
		'label'             => sprintf( esc_html__( 'Image %d', 'pet-care' ), $i ),
		'section'           => 'pet_business_client_section',
		'active_callback'   => 'pet_care_is_client_section_enable',
	) ) );

	// client custom date
	$wp_customize->add_setting( 'client_url_'.$i, array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'client_url_'.$i, array(
		'label'             => sprintf( esc_html__( 'Link %d', 'pet-care' ), $i ),
		'section'           => 'pet_business_client_section',
		'active_callback'	=> 'pet_care_is_client_section_enable',
	) );

endfor;


}
add_action( 'customize_register', 'pet_care_customize_register' );


/*=============active callback=====================*/

function pet_care_is_about_section_enable( $control ) {
	return ( $control->manager->get_setting( 'about_section_enable' )->value() );
}

function pet_care_is_product_section_enable( $control ) {
	return ( $control->manager->get_setting( 'product_section_enable' )->value() );
}

function pet_care_is_counter_section_enable( $control ) {
	return ( $control->manager->get_setting( 'counter_section_enable' )->value() );
}

function pet_care_is_client_section_enable( $control ) {
	return ( $control->manager->get_setting( 'client_section_enable' )->value() );
}


/*=============partial refresh=====================*/

if ( ! function_exists( 'pet_care_btn_title_partial' ) ) :
    // pet_care_slider_btn_label
    function pet_care_btn_title_partial() {
        return esc_html( get_theme_mod( 'pet_care_slider_btn_label' ) );
    }
endif;

if ( ! function_exists( 'pet_business_about_btn_title_partial' ) ) :
    // about_btn_title
    function pet_business_about_btn_title_partial() {
        return esc_html( get_theme_mod( 'about_btn_title' ) );
    }
endif;

if ( ! function_exists( 'pet_business_service_sub_title_partial' ) ) :
    // service_sub_title
    function pet_business_service_sub_title_partial() {
        return esc_html( get_theme_mod( 'service_sub_title' ) );
    }
endif;

if ( ! function_exists( 'pet_business_project_sub_title_partial' ) ) :
    // project_sub_title
    function pet_business_project_sub_title_partial() {
        return esc_html( get_theme_mod( 'project_sub_title' ) );
    }
endif;

if ( ! function_exists( 'pet_business_product_title_partial' ) ) :
    // product_title
    function pet_business_product_title_partial() {
        return esc_html( get_theme_mod( 'product_title' ) );
    }
endif;

if ( ! function_exists( 'pet_business_product_sub_title_partial' ) ) :
    // product_sub_title
    function pet_business_product_sub_title_partial() {
        return esc_html( get_theme_mod( 'product_sub_title' ) );
    }
endif;

if ( ! function_exists( 'pet_business_team_sub_title_partial' ) ) :
    // team_sub_title
    function pet_business_team_sub_title_partial() {
        return esc_html( get_theme_mod( 'team_sub_title' ) );
    }
endif;

if ( ! function_exists( 'pet_care_blog_sub_title_partial' ) ) :
    // blog_sub_title
    function pet_care_blog_sub_title_partial() {
        return esc_html( get_theme_mod( 'blog_sub_title' ) );
    }
endif;

if ( ! function_exists( 'pet_care_client_title_partial' ) ) :
    // client_title
    function pet_care_client_title_partial() {
        return esc_html( get_theme_mod( 'client_title' ) );
    }
endif;

if ( ! function_exists( 'pet_care_client_subtitle_partial' ) ) :
    // client_subtitle
    function pet_care_client_subtitle_partial() {
        return esc_html( get_theme_mod( 'client_subtitle' ) );
    }
endif;