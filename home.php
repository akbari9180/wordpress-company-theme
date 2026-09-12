<?php get_header(); ?>

<main>

    <h1>بلاگ</h1>

    <div id="posts-container">

        <?php

        $query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'paged'          => 1
        ));

        while ($query->have_posts()) {

            $query->the_post();

            ?>

            <article>

            <h2>
                 <a href="<?php echo esc_url(get_permalink()); ?>">
                  <?php echo esc_html(get_the_title()); ?>
                 </a>
             </h2>

            </article>

            <?php
        }

        wp_reset_postdata();
        ?>

    </div>

    <button id="load-more" class='p-2.5 bg-amber-400 border-2 text-2xl text-amber-50 curser-pointer'>
        نمایش پست بیشتر
    </button>

</main>

<?php get_footer(); ?>