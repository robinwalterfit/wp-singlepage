<?php

    /**
     * SinglePage's functions and definitions
     *
     * @author Robin Walter @link{https://robinwalterfit.com/}
     * @package SinglePage
     * @since 1.0.0
     * @version 1.0.0
     */

        /**
         * Setup Theme
         *
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which runs
         * before the init hook. The init hook is too late for some features, such as indicating
         * support post thumbnails.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_setup' ) ) :

                function singlepage_setup() {

                    /**
                     * Make theme available for translation.
                     * Translations can be placed in the /languages/ directory.
                     */

                        load_theme_textdomain( 'singlepage', get_template_directory() . '/languages' );
                
                    /**
                     * Add default posts and comments RSS feed links to <head>.
                     */

                        add_theme_support( 'automatic-feed-links' );

                    /*
                     * Let WordPress manage the document title.
                     * By adding theme support, we declare that this theme does not use a
                     * hard-coded <title> tag in the document head, and expect WordPress to
                     * provide it for us.
                     */

                        add_theme_support( 'title-tag' );
                
                    /**
                     * Enable support for post thumbnails and featured images.
                     */

                        add_theme_support( 'post-thumbnails' );

                        add_image_size( 'singlepage-featured-image', 3840, 2160, true );

                        add_image_size( 'singlepage-thumbnail-avatar', 100, 100, true );
                
                    /**
                     * Add support for two custom navigation menus.
                     */

                        register_nav_menus( array(

                            'main'   => __( 'Main menu', 'singlepage' ),
                            'service' => __( 'Service menu', 'singlepage' ),
                            'social' => __( 'Social networks', 'singlepage' )

                        ) );

                        add_theme_support( 'custom-logo' );
                
                    /*
                     * Switch default core markup for search form, comment form, and comments
                     * to output valid HTML5.
                     */

                        add_theme_support(
                            
                            'html5',
                            array(

                                'caption',
                                'comment-form',
                                'comment-list',
                                'gallery'
                
                            )
                        
                        );

                    /*
                     * Enable support for Post Formats.
                     *
                     * See: https://codex.wordpress.org/Post_Formats
                     */

                        add_theme_support(
                        
                            'post-formats',
                            array(

                                'aside',
                                'audio',
                                'gallery',
                                'link',
                                'image',
                                'quote',
                                'video'

                            )
                        
                        );

                }

            endif; // singlepage_setup

        add_action( 'after_setup_theme', 'singlepage_setup' );

        /**
         * Custom logo setup
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_logo_setup' ) ) :

                function singlepage_logo_setup() {

                    $defaults = array(

                        'flex-height' => true,
                        'flex-width'  => true,
                        'height'      => 1080,
                        'header-text' => array( 'site-title', 'site-description' ),
                        'width'       => 3840

                    );

                    add_theme_support( 'custom-logo', $defaults );

                }

            endif; // singlepage_logo_setup

        add_action( 'after_setup_theme', 'singlepage_logo_setup' );

        /**
         * Initialize the widgets
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_widgets_init' ) ) :

                function singlepage_widgets_init() {

                    register_sidebar( array(

                        'after_title'   => '</h2>',
                        'after_widget'  => '</li>',
                        'before_title'  => '<h2 class="widget_title">',
                        'before_widget' => '<li id="%1$s" class="widget %2$s">',
                        'class'         => 'sidebar-widgets',
                        'description'   => __( 'This sidebar is used, if there is no other sidebar usable for this post or page.', 'singlepage' ),
                        'id'            => 'sidebar',
                        'name'          => __( 'Default sidebar', 'singlepage' )
                        
                    ) );

                }

            endif; // singlepage_widgets_init

        add_action( 'widgets_init', 'singlepage_widgets_init' );

        /**
         * Register custom fonts.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_fonts_url' ) ) :

                function singlepage_fonts_url() {

                    $fonts_url = '';

                    $font_families = array(

                        'Courgette:400',                                                                                // cursive
                        'Didact Gothic:400',                                                                            // sans-serif
                        'Karla:400,400i,700,700i',                                                                      // sans-serif
                        'Libre Franklin:300,300i,400,400i,600,600i,800,800i',                                           // sans-serif
                        'Lobster:400',                                                                                  // cursive
                        'Lobster Two:400,400i,700,700i',                                                                // cursive
                        'Material Icons:400',
                        'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',  // sans-serif
                        'Nova Oval:400',                                                                                // cursive
                        'Poiret One:400',                                                                               // cursive
                        'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i',                                 // sans-serif
                        'Sansita:400,400i,700,700i,800,800i,900,900i'                                                   // sans-serif

                    );

                    $query_args = array(

                        'family' => urlencode( implode( '|', $font_families ) ),
                        'subset' => urlencode( 'cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese' )

                    );

                    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

                    return esc_url_raw( $fonts_url );

                }

            endif; // singlepage_fonts_url

        /**
         * Handles JavaScript detection.
         *
         * Adds a `js` class to the root `<html>` element when JavaScript is detected.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_javascript_detection' ) ) :

                function singlepage_javascript_detection() {

                    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

                }

            endif; // singlepage_javascript_detection

        add_action( 'wp_head', 'singlepage_javascript_detection', 0 );

        /**
         * Handles Bootstrap functions activation.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_bootstrap_functions' ) ) :

                function singlepage_bootstrap_functions() {

                    echo '<script>(function($){$(document).ready(function(){$(\'[ data-toggle="tooltip" ]\').tooltip();});})(jQuery);</script>';
                    echo '<script>(function($){$(document).ready(function(){$(\'[ data-toggle="popover" ]\').popover();});})(jQuery);</script>';

                }

            endif; // singlepage_bootstrap_functions

        add_action( 'wp_footer', 'singlepage_bootstrap_functions', 20 );

        /**
         * Add a pingback url auto-discovery header for singularly identifiable articles.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_pingback_header' ) ) :

                function singlepage_pingback_header() {

                    if ( is_singular() && pings_open() ) {

                        printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );

                    }

                }

            endif; // singlepage_pingback_header

        add_action( 'wp_head', 'singlepage_pingback_header' );

        /**
         * Enqueue scripts and styles.
         *
         * @since 1.0.0
         * @version 1.0.0
         */

            if ( !function_exists( 'singlepage_scripts' ) ) :

                function singlepage_scripts() {

                    // Add custom fonts, used in the main stylesheet.
                    wp_enqueue_style( 'singlepage-fonts', singlepage_fonts_url(), array(), null );

                    // Bootstrap stylesheet.
                    wp_enqueue_style( 'bootstrap-style', get_theme_file_uri( '/bootstrap/css/bootstrap.css' ) );

                    // Theme stylesheet.
                    wp_enqueue_style( 'singlepage-style', get_stylesheet_uri() );

                    // jQuery is needed!
                    wp_enqueue_script( 'jquery' );

                    // Bootstrap JavaScript
                    wp_enqueue_script( 'bootstrap-script', get_theme_file_uri( '/bootstrap/js/bootstrap.js' ), array(), '3.3.7', true );

                    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

                        wp_enqueue_script( 'comment-reply' );

                    }

                }

            endif; // singlepage_scripts

        add_action( 'wp_enqueue_scripts', 'singlepage_scripts' );
