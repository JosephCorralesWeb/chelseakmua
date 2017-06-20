<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
    <div class="content-area row container">
        <main class="posts container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 offset-3" role="main">
            <?php $the_query = new WP_Query( array( 'category_name' => 'blog' ) ); ?>
            <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <article itemscope itemtype="http://schema.org/blogPosting" role="article" class="post">
                <div itemprop="about" class="post-title"><?php the_title(); ?></div>
                <div itemprop="dateCreated" class="post-date"><?php the_time( 'F j, Y' ); ?></div>
                <div itemprop="articleBody" class="post-content"><?php the_content(); ?></div>
                </article>
            <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <article class="post-content no-posts"><?php _e( 'There is nothing posted here yet.' ); ?></article>
            <?php endif; ?>
        </main>
    </div>
<?php get_footer(); ?>