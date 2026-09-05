<?php get_header(); ?>

<main>

    <h1>
        نتایج جستجو برای:
        <?php echo esc_html( get_search_query() ); ?>
    </h1>

    <?php if ( have_posts() ) : ?>

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

    <?php else : ?>

        <p>نتیجه‌ای برای جستجوی شما پیدا نشد.</p>

    <?php endif; ?>

</main>

<?php get_footer(); ?>