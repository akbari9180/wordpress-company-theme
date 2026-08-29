<?php get_header(); ?>

<main>

    <h1>محصولات</h1>

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