<footer class="w-full max-h-16 p-8 flex items-center justify-between">
    <div class='logo logo1'>
                <!-- متد زیر تگ a , img تولید میکنه -->
                <?php the_custom_logo();?>
   </div>
   <h1><?php bloginfo("name")?></h1>
   <h2><?php bloginfo("description");?></h2>
   <div>
    <p><?php echo esc_html(get_theme_mod('footer_text','تمامی حقوق محفوظ است'));?></p>
   </div>
</footer>
<?php wp_footer();?>
</body>
</html>