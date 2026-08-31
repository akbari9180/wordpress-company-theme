<?php get_header(); ?>

<main>

    <h1>محصولات ارزان مراقبت از پوست</h1>

    <?php

    $query = new WP_Query(
        array(
            'post_type'      => 'product',
            'posts_per_page' => 5,
            'orderby'        => 'date',
            'order'          => 'DESC',

            'tax_query' => array(
                array(
                    'taxonomy' => 'product_category',
                    'field'    => 'slug',
                    'terms'    => 'مراقبت-از-پوست',
                ),
            ),

            'meta_query' => array(
                array(
                    'key'     => 'product_price',
                    'value'   => 500000,
                    'compare' => '<',
                    'type'    => 'NUMERIC',
                ),
            ),
        )
    );

    ?>

    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

        <article>

            <?php the_post_thumbnail(); ?>

            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <?php
            $price = get_post_meta(
                get_the_ID(),
                'product_price',
                true
            );
            ?>

            <p>
                قیمت:
                <?php echo esc_html($price); ?>
                تومان
            </p>

        </article>

    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

</main>

<?php get_footer(); ?>