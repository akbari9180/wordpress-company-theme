<?php

$name = '';
$email = '';
$phone = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['contact_nonce']) &&
        wp_verify_nonce(
            $_POST['contact_nonce'],
            'contact_form'
        )
    ) {

        if (
            isset(
                $_POST['full_name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['message']
            )
        ) {

            $name = sanitize_text_field($_POST['full_name']);
            $email = sanitize_email($_POST['email']);
            $phone = sanitize_text_field($_POST['phone']);
            $message = sanitize_textarea_field($_POST['message']);
        }
    }
}

get_header();
?>

<main>

    <h1><?php the_title(); ?></h1>

    <div>

        <h2>با ما در ارتباط باشید</h2>

        <form
            method="POST"
            action=""
            class="flex flex-col gap-6 items-center justify-center mt-2.5"
        >

            <input
                type="text"
                name="full_name"
                placeholder="نام"
            >

            <input
                type="email"
                name="email"
                placeholder="ایمیل"
            >

            <input
                type="text"
                name="phone"
                placeholder="شماره تماس"
            >

            <textarea
                name="message"
                placeholder="پیام شما"
            ></textarea>

            <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>

            <button
                type="submit"
                class="p-2.5 bg-amber-500 cursor-pointer"
            >
                ارسال
            </button>

        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $name !== ''): ?>

            <p>
                نام:
                <?php echo esc_html($name); ?>
            </p>

            <p>
                ایمیل:
                <?php echo esc_html($email); ?>
            </p>

            <p>
                شماره:
                <?php echo esc_html($phone); ?>
            </p>

            <p>
                پیام:
                <?php echo esc_html($message); ?>
            </p>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>