<?php get_header(); ?>

<main class="flex flex-col items-center justify-center py-20">

    <h1 class="text-6xl font-bold">
        404
    </h1>

    <h2 class="text-2xl mt-4">
        صفحه مورد نظر پیدا نشد
    </h2>

    <p class="mt-4">
        متأسفانه صفحه‌ای که به دنبال آن هستید وجود ندارد.
    </p>

    <a
        href="<?php echo esc_url(home_url('/')); ?>"
        class="mt-6 p-3 bg-amber-500"
    >
        بازگشت به صفحه اصلی
    </a>

</main>

<?php get_footer(); ?>