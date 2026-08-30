<?php get_header(); ?>

<main>

    <!-- نمایش دسته بندی محصولات -->
     <h2>دسته‌بندی محصولات</h2>

<?php
$categories = get_terms(
    array(
        'taxonomy' => 'product_category',
        'hide_empty' => true,
    )
);
?>

<ul>

    <?php foreach ( $categories as $category ) : ?>

        <li>
            <a href="<?php echo get_term_link( $category ); ?>">
                <?php echo $category->name; ?>
            </a>
        </li>

    <?php endforeach; ?>

</ul>
    
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