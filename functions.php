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
function sadaf_product_info_metabox(){
    add_meta_box(
        'product_info',
        'اطلاعات محصول',
        'sadaf_product_info_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes','sadaf_product_info_metabox');
//تابع محتوای متا باکس بالا:price/volum/country
function sadaf_product_info_callback($post){
    $price=get_post_meta($post->ID,'product_price',true);
    $volume=get_post_meta($post->ID,'product_volume',true);
    $country=get_post_meta($post->ID,'product_country',true);
    ?>
    <p>
        <label for="product_price">قیمت :</label>
        <input type="text" id="product_price" name="product_price" 
        value="<?php echo esc_attr($price);?>" style="width:100%;">
    </p>
    <p>
        <label for="product_volume">حجم :</label>
        <input type="text" id="product_volume" name="product_volume" 
        value="<?php echo esc_attr($volume);?>" style="width:100%;">
    </p>
    <p>
        <label for="product_country">کشورسازنده :</label>
        <input type="text" id="product_country" name="product_country" 
        value="<?php echo esc_attr($country);?>" style="width:100%;">
    </p>
 <?php   
}
//دخیره مقدار متاباکس در دیتابیس
function sadaf_save_product_info($post_id){
    
   if(isset($_POST['product_price'])){
     $price = sanitize_text_field($_POST['product_price']);//اعتبارسنجی و پاکسازی ورودی کاربر قبل از ذخیره در دیتابیس
     update_post_meta($post_id,'product_price',$price);
   }
   if(isset($_POST['product_volume'])){
     $volume = sanitize_text_field($_POST['product_volume']);//اعتبارسنجی و پاکسازی ورودی کاربر قبل از ذخیره در دیتابیس
     update_post_meta($post_id,'product_volume',$volume);
   }
   if(isset($_POST['product_country'])){
     $country = sanitize_text_field($_POST['product_country']);//اعتبارسنجی و پاکسازی ورودی کاربر قبل از ذخیره در دیتابیس
     update_post_meta($post_id,'product_country',$country);
   }
}
add_action('save_post_product', 'sadaf_save_product_info');
// اضافه هوک جهت تمرین
//Action Hook
// function sadaf_hook(){
//  echo "<h1>تخفیفات ویژه سال نو</h1>";
// }
// add_action('sadaf_start_site','sadaf_hook');

// //Filter Hook
// function sadaf_change_product_title($title) {
// //بررسی کنه که عنوان محصول،در لوپ اصلی باشه تا فقط عنوان محصولات تغییر کنه(بررسی جایگاه)
//     if (
//         get_post_type() === 'product'
//         && in_the_loop()
//         && is_main_query()
//     ) {
//         return $title . '🐥';
//     }

//     return $title;
// }

// add_filter('the_title', 'sadaf_change_product_title');
/**************************************************** */
//Shortcode معمولی
// function sadaf_shortcode_hello(){
//     return "<h2>سلام از سایت صدف شاپ</h2>";
// }
// add_shortcode('hello','sadaf_shortcode_hello');
// ShortCode با اتربیوت
// function sadaf_shortcode_hello($atts){
//     $name=$atts['name'];
//     return '<h1> سلام '.$name.'</h1>';
// }
// add_shortcode('hello','sadaf_shortcode_hello');
//shortcode_atts()استفاده از 
// function sadaf_hello($atts){
//     $atts=shortcode_atts(array('name'=> 'دوست عزیز'),$atts);
//     return '<h1>سلام '.esc_html($atts['name']).'</h1>';
// }
// add_shortcode('hello','sadaf_hello');
//ترکیب Shortcode + WP_Query
//با استفاده از شورت کد بگیم 3 محصول جدید رو نمایش بده
function sadaf_products_shortcode($atts){
    $atts=shortcode_atts(array("count"=>3),$atts);
    $query=new WP_Query(
        array(
            'post_type'=>'product',
            'posts_per_page'=>$atts["count"],
            'orderby'=>'date',
            'order'=>'DESC'
        )
    );
    $output='';
    while($query->have_posts()){
       $query->the_post();
        // $output.='<article>';
        // $output.='<h2>'.esc_html(get_the_title()).'</h2>';//فقط عنوان محصول
        // $output.='</article>'; 
        $output.= '<article><h2>'.esc_html(get_the_title()).'</h2></article>';
    }
Wp_reset_postdata();
return $output;
}
add_shortcode('products','sadaf_products_shortcode');