<?php get_header();?>
    <main>
    <?php the_post_thumbnail();?>
    <h1><?php the_title()?></h1>
    <div class="post">
        <?php the_content()?>
    </div>
</main>
<?php get_footer();?>