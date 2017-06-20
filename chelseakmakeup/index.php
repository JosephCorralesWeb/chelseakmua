<?php get_header(); ?>
    <div class="content-area row container">
        <main class="grid-container" role="main">
            <div class="grid" aria-hidden="true">
                <div class="gutter-sizer" aria-hidden="true"></div>
                <?php
                    $query = new WP_Query( array( 'meta_key' => '_thumbnail_id', 'showposts' => '40' ));
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                    ?>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="grid-item modal-photos">
                            <?php the_post_thumbnail( 'full', array('class' => "modal-image" ) ); ?>
                        </div>
                    <?php endif; endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </main>
    </div>
<?php get_footer(); ?>