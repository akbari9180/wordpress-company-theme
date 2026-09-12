<?php
function add_sadaf_assets(){
    //اضافه کردن استایل
    wp_enqueue_style("company_style", get_stylesheet_directory_uri().'/assets/css/style.css');
    //اضافه کردن فایل خروجی تیلویند(اتصال تیلویند به وردپرس)
    wp_enqueue_style("sadaf_tailwind_style", get_stylesheet_directory_uri().'/assets/css/output.css',
    array("company_style"),'1.0');
    //اضافه کردن فایل جاوااسکریپت 
    // if(is_front_page()){//فقط در صفحه اصلی اجرا شود
    //      wp_enqueue_script("company_script", get_stylesheet_directory_uri().'/assets/js/home.js',
    //      array(),'1.0',true);
    // }
    wp_enqueue_script("company_script", get_stylesheet_directory_uri().'/assets/js/home.js',
   array(),'1.0',true);
   //ساخت یک nonce برای انتقال به جاوااسکریپت
   wp_localize_script(
    'company_script',
    'ajaxData',
    array(
        'nonce' => wp_create_nonce('load_more_posts')
    ));
}
add_action('wp_enqueue_scripts','add_sadaf_assets');
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
      //قابلیت لوگوی سفارشی
      add_theme_support('custom-logo');
      //پس زمینه سفارشی
      add_theme_support('custom-background');
      //پشتیبانی از html5
      add_theme_support('html5');

}
add_action('after_setup_theme','add_option_to_site');

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
/******************************************* */
//Theme custozer سفارشی ساز تم
/******************************************* */
//سفارشی سازی اطلاعات تماس
function sadaf_customize_register($wp_customize){
    $wp_customize->add_section('contact_section',array('title'=>'اطلاعات تماس','priority'=>30));
    //برای شماره تماس
    $wp_customize->add_setting('phone_number',array('default'=>''));
    $wp_customize->add_control('phone_number',array('label'=>'شماره تماس',
    'section'=>'contact_section','type'=>'text'));
    //برای آدرس
    $wp_customize->add_setting(
    'address',
    array(
        'default' => '',
    )
);

$wp_customize->add_control(
    'address',
    array(
        'label'   => 'آدرس',
        'section' => 'contact_section',
        'type'    => 'text'
    )
);
//سفارشی سازی رنگ اصلی سایت
$wp_customize->add_section('colors_section',array('title'=>'رنگ های سایت','priority'=>31));
$wp_customize->add_setting('primary_color',array('default'=>'#3496cf'));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_color',
array('label'=>'رنگ اصلی سایت','section'=>'colors_section')));
//Footer سفارشی سازی متن
$wp_customize->add_section('footer_section',array('title'=>'Footer','priority'=>32));
$wp_customize->add_setting('footer_text',array('default'=>'تمامی حقوق محفوظ است'));
$wp_customize->add_control('footer_text',array('label'=>'متن Footer','section'=>'footer_section','type'=>'textarea'));
}
add_action('customize_register','sadaf_customize_register');
// Widget Area
function sadaf_widgets_init() {
   //Sidebar 
    register_sidebar(
        array(
            'name'          => 'Main Sidebar',
            'id'            => 'sidebar-1',
            'description'   => 'Sidebar اصلی سایت',
            'before_widget' => '<div class="widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        )
    );
    //Footer
    register_sidebar(
        array(
            'name'=>"Footer",
            'id'=>'footer-1',
            'description'=>'ناحیه ابزارک فوتر',
            'before_widget' => '<div class="widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'


        )
    );

}

add_action('widgets_init', 'sadaf_widgets_init');
// AJAX
function sadaf_load_more_posts(){
    //Nonce بررسی
    check_ajax_referer(
    'load_more_posts',
    'nonce'
);
    //گرفتن psge از جاوااسکریپت
    $page=isset($_POST['page'])?absint($_POST['page']):1;
    //یک کوئری مینویسیم برای نمایش 
    $query=new WP_Query(array(
        'post_type'=>'post',
        'posts_per_page'=>3,
        'paged'=>$page
    ));
    $html='';
     $no_more_posts=false;
    //نمایش
    while($query->have_posts()){
        
        $query->the_post();
        //HTMLوارد کردن مستقیم 
        // echo '<article>';
        // echo '<h2>' . esc_html(get_the_title()) . '</h2>';
        // echo '</article>';
        //تبدیل کد echo ->  json
        //قدم اول
        $html.='<article>';
        $html .= '<h2>
    <a href="' . esc_url(get_permalink()) . '">
        ' . esc_html(get_the_title()) . '
    </a>
</h2>';
        $html.='</article>';
    }
      if ($query->max_num_pages <= $page) {
        $no_more_posts=true;
    }
    //قدم دوم
       wp_send_json_success(array('html'=>$html,'no_more_posts' => $no_more_posts));
    //اگر با json ارسال بشن دیگه نیازی بهشون نیست
    // wp_reset_postdata();
    // wp_die();

}
add_action('wp_ajax_load_more_posts','sadaf_load_more_posts');
add_action('wp_ajax_priv_load_more_posts','sadaf_load_more_posts');