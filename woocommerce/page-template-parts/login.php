<?php
/**
 * Custom Login Template (Ale & Bread)
*/

defined('ABSPATH') || exit;

// Decide when to show the resend verification form
$show_resend = isset($_GET['check-email']);
if ( function_exists('WC') && WC()->session && WC()->session->get('ab_show_resend') === '1' ) {
    $show_resend = true;
    // Clear the one-time flag
    WC()->session->set('ab_show_resend', null);
}
?>

<section id="login" class="section-login relative overflow-hidden pt-[82px] md:pt-[106px]">
    <div class="theme-container pt-24 pb-16 md:pt-24 md:pb-48 xl:pt-40 xl:pb-28">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
                <div>
                    <h1 class="font-bold mb-6"><?php esc_html_e('Login', 'aleandbread'); ?></h1>
                    <p class="font-barlow text-[16px] opacity-75 font-normal text-blockText mb-10"><?php esc_html_e('Login, um auf dein Ale & Bread Konto zuzugreifen.', 'aleandbread'); ?></p>

                    <?php wc_print_notices(); ?>

                    <?php if ( isset($_GET['check-email']) ) : ?>
                        <div class="woocommerce-info mb-4">
                            <?php esc_html_e('Vielen Dank! Wir haben Ihnen einen Bestätigungslink per E-Mail geschickt. Bitte prüfen Sie Ihren Posteingang (und den Spam-Ordner).', 'aleandbread'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $show_resend ) : ?>
                        <div class="mb-6">
                            <?php echo do_shortcode('[ab_resend_verification]'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="space-y-4">
                        <?php do_action('woocommerce_login_form_start'); ?>

                        <div class="flex flex-col relative">
                            <label for="username" class="mb-2"><?php esc_html_e('Email', 'aleandbread'); ?></label>
                            <input type="text" id="username" name="username" placeholder="Email"
                                class="w-full border p-2 rounded"
                                value="<?php echo (!empty($_POST['username']) ? esc_attr($_POST['username']) : ''); ?>" required>
                        </div>

                        <div class="flex flex-col relative !mt-6">
                            <label for="password" class="mb-2"><?php esc_html_e('Passwort', 'aleandbread'); ?></label>
                            <input type="password" id="password" name="password" placeholder="Passwort"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="rememberme" value="forever" <?php checked(!empty($_POST['rememberme'])); ?>>
                                <span><?php esc_html_e('Angemeldet bleiben', 'aleandbread'); ?></span>
                            </label>
                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-sm text-[#CC332E] hover:underline">
                                <?php esc_html_e('Passwort vergessen?', 'aleandbread'); ?>
                            </a>
                        </div>

                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <input type="hidden" name="redirect" value="<?php echo esc_url(home_url()); ?>" />

                        <button type="submit" class="btn btn-secondary mb-6 w-full" name="login">Login</button>

                        <p class="text-center text-sm">
                            <?php esc_html_e("Du hast noch kein Konto?", 'aleandbread'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo esc_url( home_url( '/sign-up' ) ); ?>" class="text-[#CC332E] font-medium hover:underline"><?php esc_html_e('Registrieren', 'aleandbread'); ?></a>
                        </p>

                        <?php do_action('woocommerce_login_form_end'); ?>
                    </form>

                    <?php if ( function_exists( 'nextend_social_login_buttons' ) ) : ?>
                        <div class="my-6">
                            <div class="flex items-center justify-center gap-4">
                                <?php echo do_shortcode( '[nextend_social_login provider="facebook"]' ); ?>
                                <?php echo do_shortcode( '[nextend_social_login provider="google"]' ); ?>
                                <?php echo do_shortcode( '[nextend_social_login provider="twitter" style="icon"]' ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-8 hidden xl:block">
                <div class="flex justify-center items-center">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo esc_url( get_the_post_thumbnail_url(null, 'full') ); ?>" alt="Visual" class="">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
