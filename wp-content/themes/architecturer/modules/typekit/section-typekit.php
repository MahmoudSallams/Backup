<?php

/**
 * Typekit
 */

$priority = 0;

Kirki::add_field( 'themegoods_customize', array(
    'type' => 'title',
    'settings'  => 'tg_typekit_title',
    'label'    => esc_html__('Typekit Settings', 'architecturer' ),
    'section'  => 'general_fonts',
	'priority' => 0,
) );


Kirki::add_field( 'themegoods_customize', array(
    'type' => 'switch',
    'settings' => 'tg_enable_typekit',
    'label' => esc_html__( 'Enable Typekit', 'architecturer' ) ,
    'section' => 'general_fonts',
    'default' => 0,
    'priority' => $priority,
    'transport' => 'auto',
    'choices' => array(
        'on'  => esc_html__( 'Enable', 'architecturer' ),
        'off' => esc_html__( 'Disable', 'architecturer' )
    )
) );

Kirki::add_field( 'themegoods_customize', array(
    'type' => 'text',
    'settings' => 'tg_typekit_id',
    'label' => esc_html__( 'Typekit ID', 'architecturer' ) ,
    'section' => 'general_fonts',
    'default' => '',
    'priority' => $priority,
    'transport' => 'auto',
    'required' => array(
        array(
            'setting' => 'tg_enable_typekit',
            'operator' => '==',
            'value' => '1',
        )
    ) ,
) );

Kirki::add_field( 'themegoods_customize', array(
    'type' => 'repeater',
    'label' => esc_html__( 'Typekit Fonts', 'architecturer' ) ,
    'description' => esc_html__( 'Here you can add typekit fonts', 'architecturer' ) ,
    'settings' => 'tg_typekit_fonts',
    'priority' => $priority,
    'transport' => 'auto',
    'section' => 'general_fonts',
    'row_label' => array(
        'type' => 'text',
        'value' => esc_html__( 'Typekit Font', 'architecturer' ) ,
    ),
    'default' => array(
        array(
            'font_name' => 'Europa',
            'font_css_name' => 'europa-web',
            'font_variants' => array( 'regular', 'italic', '700', '700italic' ),
            'font_fallback' => 'sans-serif',
            'font_subsets' => 'latin'
        )
    ),
    'fields' => array(
        'font_name' => array(
            'type' => 'text',
            'label' => esc_html__( 'Name', 'architecturer' ) ,
        ) ,
        'font_css_name' => array(
            'type' => 'text',
            'label' => esc_html__( 'CSS Name', 'architecturer' ) ,
        ) ,
        'font_variants' => array(
            'type' => 'select',
            'label' => esc_html__( 'Variants', 'architecturer' ) ,
            'multiple' => 18,
            'choices' => array(
                '100' => esc_html__( '100', 'architecturer' ) ,
                '100italic' => esc_html__( '100italic', 'architecturer' ) ,
                '200' => esc_html__( '200', 'architecturer' ) ,
                '200italic' => esc_html__( '200italic', 'architecturer' ) ,
                '300' => esc_html__( '300', 'architecturer' ) ,
                '300italic' => esc_html__( '300italic', 'architecturer' ) ,
                'regular' => esc_html__( 'regular', 'architecturer' ) ,
                'italic' => esc_html__( 'italic', 'architecturer' ) ,
                '500' => esc_html__( '500', 'architecturer' ) ,
                '500italic' => esc_html__( '500italic', 'architecturer' ) ,
                '600' => esc_html__( '600', 'architecturer' ) ,
                '600italic' => esc_html__( '600italic', 'architecturer' ) ,
                '700' => esc_html__( '700', 'architecturer' ) ,
                '700italic' => esc_html__( '700italic', 'architecturer' ) ,
                '800' => esc_html__( '800', 'architecturer' ) ,
                '800italic' => esc_html__( '800italic', 'architecturer' ) ,
                '900' => esc_html__( '900', 'architecturer' ) ,
                '900italic' => esc_html__( '900italic', 'architecturer' ) ,
            )
        ),
        'font_fallback' => array(
            'type' => 'select',
            'label' => esc_html__( 'Fallback', 'architecturer' ) ,
            'choices' => array(
                'sans-serif' => esc_html__( 'Helvetica, Arial, sans-serif', 'architecturer' ) ,
                'serif' => esc_html__( 'Georgia, serif', 'architecturer' ) ,
                'display' => esc_html__( '"Comic Sans MS", cursive, sans-serif', 'architecturer' ) ,
                'handwriting' => esc_html__( '"Comic Sans MS", cursive, sans-serif', 'architecturer' ) ,
                'monospace' => esc_html__( '"Lucida Console", Monaco, monospace', 'architecturer' ) ,
            )
        ) ,
        'font_subsets' => array(
            'type' => 'select',
            'label' => esc_html__( 'Subsets', 'architecturer' ) ,
            'multiple' => 7,
            'choices' => array(
                'cyrillic' => esc_html__( 'Cyrillic', 'architecturer' ) ,
                'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'architecturer' ) ,
                'devanagari' => esc_html__( 'Devanagari', 'architecturer' ) ,
                'greek' => esc_html__( 'Greek', 'architecturer' ) ,
                'greek-ext' => esc_html__( 'Greek Extended', 'architecturer' ) ,
                'khmer' => esc_html__( 'Khmer', 'architecturer' ) ,
                'latin' => esc_html__( 'Latin', 'architecturer' ) ,
            )
        ) ,
    ) ,
    'active_callback' => array(
        array(
            'setting' => 'tg_enable_typekit',
            'operator' => '==',
            'value' => '1'
        )
    )
) );