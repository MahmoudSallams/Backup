<?php

/**
 * Custom Fonts
 */


Kirki::add_field( 'themegoods_customize', array(
    'type' => 'title',
    'settings'  => 'tg_custom_fonts_title',
    'label'    => esc_html__('Uploaded Fonts Settings', 'architecturer' ),
    'section'  => 'general_fonts',
	'priority' => 5,
) );

Kirki::add_field( 'themegoods_customize', array(
    'type' => 'repeater',
    'label' => esc_html__( 'Uploaded Fonts', 'architecturer' ) ,
    'description' => esc_html__( 'Here you can add your custom fonts', 'architecturer' ) ,
    'settings' => 'tg_custom_fonts',
    'priority' => 6,
    'transport' => 'auto',
    'section' => 'general_fonts',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_html__( 'Upload Font', 'architecturer' ) ,
    ),
    'fields' => array(
        'font_name' => array(
            'type' => 'text',
            'label' => esc_html__( 'Name', 'architecturer' ) ,
        ) ,
        'font_url' => array(
            'type' => 'upload',
            'label' => esc_html__( 'Font File (*.woff)', 'architecturer' ) ,
        ) ,
        'font_fallback' => array(
            'type' => 'select',
            'label' => esc_html__( 'Fallback', 'architecturer' ) ,
            'defalut' => esc_html__( 'Helvetica, Arial, sans-serif', 'architecturer' ),
            'choices' => array(
                'sans-serif' => esc_html__( 'Helvetica, Arial, sans-serif', 'architecturer' ) ,
                'serif' => esc_html__( 'Georgia, serif', 'architecturer' ) ,
                'display' => esc_html__( '"Comic Sans MS", cursive, sans-serif', 'architecturer' ) ,
                'handwriting' => esc_html__( '"Comic Sans MS", cursive, sans-serif', 'architecturer' ) ,
                'monospace' => esc_html__( '"Lucida Console", Monaco, monospace', 'architecturer' ) ,
            )
        ) ,
    ) 
) );