<?php

/*
 * Add Typekit Fonts
 * */

class kirkiAddFonts {
    public $custom_fonts;
    public function __construct() {

        $theme_info = wp_get_theme();
        $this->theme_version = $theme_info[ 'Version' ];

        $this->custom_fonts = get_theme_mod( 'tg_custom_fonts' );

        if ( ! empty( $this->custom_fonts ) ){
            add_action( 'wp_enqueue_scripts', array( $this, 'load_custom_fonts' ) );
        }
        add_filter( 'kirki/fonts/google_fonts', array( $this, 'add_custom_fonts' ) );
    }
    
    public function load_custom_fonts() {
        $custom_css = '';
        
        if ( ! empty( $this->custom_fonts ) ) 
        {
            foreach( $this->custom_fonts as $key=>$custom_font ){
	            $custom_css.='
                	@font-face {
	                	font-family: "'.$custom_font[ 'font_name' ].'";
	                	src: url('.esc_url($custom_font[ 'font_url' ]).') format("woff");
	                }
                ';
            }
        }

        wp_add_inline_style( 'architecturer-screen', $custom_css );
    }

    public function add_custom_fonts( $google_fonts ){
        $my_custom_fonts = array();
        if ( ! empty( $this->custom_fonts ) ) {
            foreach( $this->custom_fonts as $key=>$custom_font )
            {
                $my_custom_fonts[ $custom_font[ 'font_name' ] ] = array(
                    'label' => $custom_font[ 'font_name' ],
                    'category' => $custom_font[ 'font_fallback' ]
                );
            }
        }
        //var_dump($my_custom_fonts); die;
        return array_merge_recursive( $my_custom_fonts, $google_fonts );
    }
}

new kirkiAddFonts;