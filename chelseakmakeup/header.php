<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset=<?php bloginfo( 'charset' ); ?>>
    <meta name=viewport content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
    <link rel=pingback href=<?php bloginfo( 'pingback_url' ); ?>>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class=page-wrap>
    <div id=modal class="modal fade">
        <div id=modal-body>
            <img id=modal-image src alt>
        </div>
    </div>
    <?php if ( is_home() && is_front_page() ) : ?>
        <div class="landing-area text-center row container-fluid">
            <div class="landing-icon-div row col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <a href=#topnav rel=home><img rel=icon alt="Chelsea K Logo" class="ck-logo landing-icon" src="http://192.168.33.20/wp-content/uploads/2017/06/logo.svg"></a>
            </div>
            <h1 class="landing-title row col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <a href=#topnav role=heading><?php bloginfo('name'); ?></a>
            </h1>
            <aside class="landing-description row col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <?php bloginfo('description'); ?>
            </aside>
            <aside class="landing-post row col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <?php query_posts( array( 'category_name' => 'landing-page-description' ) ) ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id=landing-description><?php the_content(); ?></article>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
                <a href=#topnav>
                    <div class=scroll-down-icon><?php include("images/chevron23.svg"); ?></div>
                </a>
            </aside>
        </div>
    <?php endif; ?>
    <div class=site-content>
        <header role=banner>
            <nav role=navigation class="main-navigation navbar navbar-default" role=navigation>
                <div class="nav-logo text-center">
                    <a name=topnav><img rel=icon class="ck-logo nav-icon" src="http://192.168.33.20/wp-content/uploads/2017/06/logo.svg"></a>
                </div>
                <div class=navigation-buttons aria-controls=primary-menu>
                    <?php chelseak_primary_menu(); ?>
                </div>
            </nav>
        </header>