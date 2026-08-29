<?php
//اضافه کردن استایل
function add_sadaf_style(){
    wp_enqueue_style("company_style",get_stylesheet_uri());
    
}
add_action('wp_enqueue_scripts','add_sadaf_style');
//افزودن منو
function add_option_to_site(){
    register_nav_menus(
        array(
            'primary' => 'Primary Menu'
        )
    );
    //افزودن تصویر شاخص برای هر پست
     add_theme_support('post-thumbnails');
     //شاسایی عنوان مناسب برای تب
      add_theme_support('title-tag');

}
add_action('after_setup_theme','add_option_to_site');
// تنظیمات سایت بار
function sadaf_widgets_init() {

    register_sidebar(
        array(
            'name'          => 'Main Sidebar',
            'id'            => 'main-sidebar',
            'description'   => 'Sidebar اصلی سایت',
            'before_widget' => '<div class="widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        )
    );

}

add_action('widgets_init', 'sadaf_widgets_init');
