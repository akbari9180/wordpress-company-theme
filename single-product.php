<?php get_header();?>
    <main>
    <?php the_post_thumbnail();?>
    <h1><?php the_title()?></h1>
    <?php
        $price = get_post_meta(get_the_ID(),'product_price',true);
        $volume = get_post_meta(get_the_ID(),'product_volume',true);
        $country = get_post_meta(get_the_ID(),'product_country',true);
     ?>

        <p class="price-product">
            قیمت: <?php echo esc_html($price); ?> تومان
        </p>
        <p>
            حجم: <?php echo esc_html($volume); ?> میلی لیتر
        </p>
        <p>
            کشورسازنده: <?php echo esc_html($country); ?>
        </p>
    <div class="post">
        <?php the_content()?>
    </div>
</main>
<?php get_footer();?>