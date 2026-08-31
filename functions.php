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
//taxonomy افزودن 
//product_category براساس 
function sadaf_register_product_taxonomy(){
    register_taxonomy(
    'product_category',
    'product',
    array(
        'label'        => 'دسته‌بندی محصولات',
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array(
            'slug' => 'product-category'
        ),
    )
);
}
add_action('init','sadaf_register_product_taxonomy');
//براساس برند
function sadaf_register_barand_taxonomy(){
    register_taxonomy(
        'brand',
        'product',
        array(
            'label'=>'برندها',
            'public'=>true,
            'hierarchical' => false,
            'rewrite'=>array(
                'slug'=>'brand'
            )
            
        )
    );
}
add_action('init','sadaf_register_barand_taxonomy');
//custom Field افزودن
function sadaf_product_price_metabox(){
    add_meta_box(
        'product_price',
        'اطلاعات محصول',
        'sadaf_product_price_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes','sadaf_product_price_metabox');
//تابع محتوای متا باکس بالا
function sadaf_product_price_callback($post){
    $price=get_post_meta($post->ID,
    'product_price',true);
    ?>
    <label for="product_price">قیمت :</label>
    <input type="text" id="product_price" name="product_price" 
    value="<?php echo esc_attr($price);?>" style="width:100%;">
 <?php   
}
//دخیره مقدار متاباکس در دیتابیس
function sadaf_save_product_price($post_id){
    
   if(isset($_POST['product_price'])){
     $price = sanitize_text_field($_POST['product_price']);//اعتبارسنجی و پاکسازی ورودی کاربر قبل از ذخیره در دیتابیس
     update_post_meta($post_id,'product_price',$price);
   }
}
add_action('save_post_product', 'sadaf_save_product_price');