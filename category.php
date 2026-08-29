<?php get_header();?>
<div class="content-area">
    <main>
    <h1><?php single_cat_title(); ?></h1>
    <div class=posts>
    <?php while(have_posts()):
        the_post();?>
    <article>
        <?php the_post_thumbnail();?>
        <h2>
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
        </h2>
        <?php the_excerpt();?>
        <a href="<?php the_permalink(); ?>">ادامه مطلب</a>
    </article>
    <?php endwhile;?>
    </div>
</main>
<?php get_sidebar();?>
</div>
<?php get_footer();?>