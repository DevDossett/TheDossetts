<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php TD__schema_type(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <?php wp_head(); ?>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --color-night: #151515;
                --color-plum: #22133A;
                --color-wine: #500E31;
                --color-rose: #FFDDE1;
                --color-cream: #FFFFEB;
            }
        </style>
        <!-- ========== Cham & Jordan 4-ever <3 ========== -->
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
        <div id="wrapper" class="hfeed">
            <header id="header" role="banner">
                <div id="branding">
                    <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <?php
                    if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; }
                    // getting the hide home link variable
                    global $TD__hideHomeLink;
                    if(isset($TD__hideHomeLink) && $TD__hideHomeLink){

                    } else {
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span></a>';
                    }
                    
                    if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; }
                    ?>
                    </div>
                    <div id="site-description"<?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
                        <?php bloginfo( 'description' ); ?>
                    </div>
                </div>
                <?php
                    // getting the hide menu variable
                    global $TD__hideMenu;
                    // if it's set
                    if(isset($TD__hideMenu) && $TD__hideMenu){

                    } else {
                    ?>
                <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                </nav>
                    <?php
                    }
                ?>
                
            </header>
            <div id="container">
                <main id="content" role="main">