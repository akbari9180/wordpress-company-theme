<?php get_header();?>
    <main>
    <?php the_post_thumbnail();?>
    <h1><?php the_title()?></h1>
    <?php
        $price = get_post_meta(
            get_the_ID(),
            'product_price',
            true
        );
        ?>

        <p class="price-product">
            قیمت: <?php echo esc_html($price); ?> تومان
        </p>
    <div class="post">
        <?php the_content()?>
    </div>
</main>
<?php get_footer();?>