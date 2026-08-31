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

            <?php
        $price = get_post_meta(get_the_ID(),'product_price',true);
        $volume = get_post_meta(get_the_ID(),'product_volume',true);
        $country = get_post_meta(get_the_ID(),'product_country',true);
     ?>

        <p class="price-product">
            قیمت: <?php echo esc_html($price); ?> تومان
        </p>
        <div class="info-product">
            <p>
            حجم: <?php echo esc_html($volume); ?> میلی لیتر
        </p>
        <p>
            کشورسازنده: <?php echo esc_html($country); ?>
        </p>

        </div>
</article>
    <?php endwhile; ?>

</main>

<?php get_footer(); ?>