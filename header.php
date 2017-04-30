<?php
    
    /**
     * This is the template that displays all of the <head> section and everything up until <header role="banner">
     *
     * @package SinglePage
     * @since 1.0.0
     * @version 1.0.0
     */

?>

<!DOCTYPE html>

    <html <?php language_attributes(); ?> class="no-js">
    
        <head>

            <meta charset="<?php bloginfo( 'charset' ); ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="profile" href="http://gmpg.org/xfn/11">

            <?php wp_head(); ?>

        </head>

        <body <?php body_class(); ?>>

            <div id="site-wrapper">

                <header id="site-header" role="banner">
