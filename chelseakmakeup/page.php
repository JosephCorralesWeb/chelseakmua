<?php get_header(); ?>
    <div class="content-area row container">
        <main class="posts container col-xs-12 col-sm-8 col-sm-offset-2" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="post-content" role="article"><?php the_content(); ?></article>
            <?php endwhile; endif; //end loop ?>
        </main>
    </div>
<?php get_footer(); ?>