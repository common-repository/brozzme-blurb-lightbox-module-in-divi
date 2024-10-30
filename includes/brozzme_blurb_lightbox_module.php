<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28/04/2017
 * Time: 00:32
 */

class blurb_lightbox_ET_Builder extends ET_Builder_Module {

    function init() {
        $this->name             = esc_html__( 'Blurb Lightbox', B7ELBD_TEXT_DOMAIN );
        $this->slug             = 'et_pb_lightbox_blurb';
        $this->fb_support       = false;
        $this->main_css_element = '%%order_class%%.et_pb_lightbox_blurb';

        $this->whitelisted_fields = array(
            'title',
            'url',
            'url_new_window',
            'use_lightbox',
            'image',
            'alt',
            'icon_placement',
            'animation',
            'background_layout',
            'text_orientation',
            'content_new',
            'admin_label',
            'module_id',
            'module_class',
            'max_width',
            'max_width_tablet',
            'max_width_phone',
            'max_width_last_edited'
        );

        $et_accent_color = et_builder_accent_color();

        $this->fields_defaults = array(
            'url_new_window'      => array( 'off' ),
            'use_lightbox'        => array( 'on' ),
            'icon_placement'      => array( 'top' ),
            'animation'           => array( 'top' ),
            'background_layout'   => array( 'light' ),
            'text_orientation'    => array( 'left' ),
        );

        $this->advanced_options = array(
            'fonts' => array(
                'header' => array(
                    'label'    => esc_html__( 'Header', 'et_builder' ),
                    'css'      => array(
                        'main' => "{$this->main_css_element} h4, {$this->main_css_element} h4 a",
                    ),
                ),
                'body'   => array(
                    'label'    => esc_html__( 'Body', 'et_builder' ),
                    'css'      => array(
                        'line_height' => "{$this->main_css_element} p",
                    ),
                ),
            ),
            'background' => array(
                'settings' => array(
                    'color' => 'alpha',
                ),
            ),
            'border' => array(),
            'custom_margin_padding' => array(
                'css' => array(
                    'important' => 'all',
                ),
            ),
        );
        $this->custom_css_options = array(
            'blurb_image' => array(
                'label'    => esc_html__( 'Blurb Image', 'et_builder' ),
                'selector' => '.et_pb_main_blurb_image',
            ),
            'blurb_title' => array(
                'label'    => esc_html__( 'Blurb Title', 'et_builder' ),
                'selector' => 'h4',
            ),
            'blurb_content' => array(
                'label'    => esc_html__( 'Blurb Content', 'et_builder' ),
                'selector' => '.et_pb_blurb_content',
            ),
        );
    }

    function get_fields() {
        $et_accent_color = et_builder_accent_color();

        $image_icon_placement = array(
            'top' => esc_html__( 'Top', 'et_builder' ),
        );

        if ( ! is_rtl() ) {
            $image_icon_placement['left'] = esc_html__( 'Left', 'et_builder' );
        } else {
            $image_icon_placement['right'] = esc_html__( 'Right', 'et_builder' );
        }

        $fields = array(
            'title' => array(
                'label'           => esc_html__( 'Title', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'The title of your blurb will appear in bold below your blurb image.', 'et_builder' ),
            ),
            'title_url' => array(
                'label'           => esc_html__( 'Title Url', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'If you would like to make your blurb title to be link, input your destination URL here.', B7ELBD_TEXT_DOMAIN ),
            ),
            'title_url_new_window' => array(
                'label'           => esc_html__( 'Title Url Opens', 'et_builder' ),
                'type'            => 'select',
                'option_category' => 'configuration',
                'options'         => array(
                    'off' => esc_html__( 'In The Same Window', 'et_builder' ),
                    'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
                ),
                'description' => esc_html__( 'Here you can choose whether or not your title link opens in a new window', B7ELBD_TEXT_DOMAIN ),
            ),
            'use_lightbox' => array(
                'label'           => esc_html__( 'Use lightbox', 'et_builder' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'         => array(
                    'on'  => esc_html__( 'Yes', 'et_builder' ),
                    'off' => esc_html__( 'No', 'et_builder' ),

                ),
                'description' => esc_html__( 'Here you can choose whether image set below should be opened in lightbox. It\'s a little dumb with this module !', B7ELBD_TEXT_DOMAIN ),
            ),
            'image' => array(
                'label'              => esc_html__( 'Image', 'et_builder' ),
                'type'               => 'upload',
                'option_category'    => 'basic_option',
                'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
                'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
                'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
                'description'        => esc_html__( 'Upload an image to display at the top of your blurb.', 'et_builder' ),
            ),
            'alt' => array(
                'label'           => esc_html__( 'Image Alt Text', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Define the HTML ALT text for your image here.', 'et_builder' ),
            ),
            'icon_placement' => array(
                'label'             => esc_html__( 'Image Placement', B7ELBD_TEXT_DOMAIN ),
                'type'              => 'select',
                'option_category'   => 'layout',
                'options'           => $image_icon_placement,
                'description'       => esc_html__( 'Here you can choose where to place the image.', B7ELBD_TEXT_DOMAIN ),
            ),
            'animation' => array(
                'label'             => esc_html__( 'Image Animation', B7ELBD_TEXT_DOMAIN ),
                'type'              => 'select',
                'option_category'   => 'configuration',
                'options'           => array(
                    'top'    => esc_html__( 'Top To Bottom', 'et_builder' ),
                    'left'   => esc_html__( 'Left To Right', 'et_builder' ),
                    'right'  => esc_html__( 'Right To Left', 'et_builder' ),
                    'bottom' => esc_html__( 'Bottom To Top', 'et_builder' ),
                    'off'    => esc_html__( 'No Animation', 'et_builder' ),
                ),
                'description'       => esc_html__( 'This controls the direction of the lazy-loading animation.', 'et_builder' ),
            ),
            'background_layout' => array(
                'label'             => esc_html__( 'Text Color', 'et_builder' ),
                'type'              => 'select',
                'option_category'   => 'color_option',
                'options'           => array(
                    'light' => esc_html__( 'Dark', 'et_builder' ),
                    'dark'  => esc_html__( 'Light', 'et_builder' ),
                ),
                'description'       => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
            ),
            'text_orientation' => array(
                'label'             => esc_html__( 'Text Orientation', 'et_builder' ),
                'type'              => 'select',
                'option_category'   => 'layout',
                'options'           => et_builder_get_text_orientation_options(),
                'description'       => esc_html__( 'This will control how your blurb text is aligned.', 'et_builder' ),
            ),
            'content_new' => array(
                'label'             => esc_html__( 'Content', 'et_builder' ),
                'type'              => 'tiny_mce',
                'option_category'   => 'basic_option',
                'description'       => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
            ),
            'max_width' => array(
                'label'           => esc_html__( 'Image Max Width', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'layout',
                'tab_slug'        => 'advanced',
                'mobile_options'  => true,
                'validate_unit'   => true,
            ),
            'max_width_tablet' => array (
                'type'     => 'skip',
                'tab_slug' => 'advanced',
            ),
            'max_width_phone' => array (
                'type'     => 'skip',
                'tab_slug' => 'advanced',
            ),
            'max_width_last_edited' => array(
                'type'     => 'skip',
                'tab_slug' => 'advanced',
            ),
            'disabled_on' => array(
                'label'           => esc_html__( 'Disable on', 'et_builder' ),
                'type'            => 'multiple_checkboxes',
                'options'         => array(
                    'phone'   => esc_html__( 'Phone', 'et_builder' ),
                    'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
                    'desktop' => esc_html__( 'Desktop', 'et_builder' ),
                ),
                'additional_att'  => 'disable_on',
                'option_category' => 'configuration',
                'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
            ),
            'admin_label' => array(
                'label'       => esc_html__( 'Admin Label', 'et_builder' ),
                'type'        => 'text',
                'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
            ),
            'module_id' => array(
                'label'           => esc_html__( 'CSS ID', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
            'module_class' => array(
                'label'           => esc_html__( 'CSS Class', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
        );

        return $fields;
    }

    function shortcode_callback( $atts, $content = null, $function_name ) {
        $module_id             = $this->shortcode_atts['module_id'];
        $module_class          = $this->shortcode_atts['module_class'];
        $title                 = $this->shortcode_atts['title'];
        $use_lightbox          = $this->shortcode_atts['use_lightbox'];
        $image                 = $this->shortcode_atts['image'];
        $url                   = $this->shortcode_atts['image'];
        $title_url             = $this->shortcode_atts['title_url'];
        $title_url_new_window  = $this->shortcode_atts['title_url_new_window'];
        $alt                   = $this->shortcode_atts['alt'];
        $background_layout     = $this->shortcode_atts['background_layout'];
        $text_orientation      = $this->shortcode_atts['text_orientation'];
        $animation             = $this->shortcode_atts['animation'];
        $icon_placement        = $this->shortcode_atts['icon_placement'];
        $max_width             = $this->shortcode_atts['max_width'];
        $max_width_tablet      = $this->shortcode_atts['max_width_tablet'];
        $max_width_phone       = $this->shortcode_atts['max_width_phone'];
        $max_width_last_edited = $this->shortcode_atts['max_width_last_edited'];

        $module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );


        if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
            $max_width_responsive_active = et_pb_get_responsive_status( $max_width_last_edited );

            $max_width_values = array(
                'desktop' => $max_width,
                'tablet'  => $max_width_responsive_active ? $max_width_tablet : '',
                'phone'   => $max_width_responsive_active ? $max_width_phone : '',
            );

            et_pb_generate_responsive_css( $max_width_values, '%%order_class%% .et_pb_main_blurb_image img', 'max-width', $function_name );
        }

        if ( is_rtl() && 'left' === $text_orientation ) {
            $text_orientation = 'right';
        }

        if ( is_rtl() && 'left' === $icon_placement ) {
            $icon_placement = 'right';
        }


        if ( '' !== $title && '' !== $title_url ) {
            $title = sprintf( '<a href="%1$s"%3$s>%2$s</a>',
                esc_url( $title_url ),
                esc_html( $title ),
                ( 'on' === $title_url_new_window ? ' target="_blank"' : '' )
            );
        }
        if ( '' !== $title ) {
            $title = "<h4>{$title}</h4>";
        }

        $use_icon = 'off';
        if ( 'off' === $use_icon ) {
            $image = ( '' !== trim( $image ) ) ? sprintf(
                '<img src="%1$s" alt="%2$s" class="et-waypoint%3$s" />',
                esc_url( $image ),
                esc_attr( $alt ),
                esc_attr( " et_pb_animation_{$animation}" )
            ) : '';
        }

        $image = $image ? sprintf(
            '<div class="et_pb_main_blurb_image">%1$s</div>',
            ( '' !== $url
                ? sprintf(
                    '<a href="%1$s" %3$s>%2$s</a>',
                    esc_url( $url ),
                    $image,
                    'class="et_pb_lightbox_image"'
                )
                : $image
            )
        ) : '';

        $class = " et_pb_module et_pb_bg_layout_{$background_layout} et_pb_text_align_{$text_orientation}";

        $output = sprintf(
            '<div%5$s class="et_pb_blurb%4$s%6$s%7$s">
				<div class="et_pb_blurb_content">
					%2$s
					<div class="et_pb_blurb_container">
						%3$s
						%1$s
					</div>
				</div> <!-- .et_pb_blurb_content -->
			</div> <!-- .et_pb_blurb -->',
            $this->shortcode_content,
            $image,
            $title,
            esc_attr( $class ),
            ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
            ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
            sprintf( ' et_pb_blurb_position_%1$s', esc_attr( $icon_placement ) )
        );

        return $output;
    }
}
new blurb_lightbox_ET_Builder();