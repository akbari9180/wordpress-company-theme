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
//custom post type اضافه کردن
function sadaf_register_post_type(){
    register_post_type('product',array(
        'labels'=> array(
            'name'=>'محصولات',
            'singular_name'=>'محصول',
            'add_new'=>'افزودن محصول',
            'add_new_item'=>'افزودن محصول جدید',
            'edit_item'=>'ویرایش محصول',
            'all_items'=>'همه محصولات'
        ),
        'public'=>true,
        'menu_icon'=>'dashicons-cart',
        'supports'=> array(
            'title','editor','thumbnail'
        ),
        'has_archive'=>true,
        'rewrite'=> array(
            'slug'=>'products'
        )
    ));
}
add_action('init','sadaf_register_post_type');
