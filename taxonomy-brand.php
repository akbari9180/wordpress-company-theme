<?php get_header(); ?>

<main>
    <!-- نمایش عنوان وتوضیح دسته یا ترم -->

    <h1><?php single_term_title(); ?></h1>

    <div>
        <?php echo term_description(); ?>
    </div>
    
    <!-- نمایش محصولات اون ترم -->

    <?php while ( have_posts() ) : the_post(); ?>

        <article>

            <?php the_post_thumbnail(); ?>

            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <?php the_excerpt(); ?>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>