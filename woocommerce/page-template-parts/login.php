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
    <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
                <div>
                    <h2 class="text-3xl font-bold mb-4">Login</h2>

                    <?php wc_print_notices(); ?>

                    <?php if ( isset($_GET['check-email']) ) : ?>
                        <div class="woocommerce-info mb-4">
                            <?php esc_html_e('Thanks! We’ve emailed you a confirmation link. Please check your inbox (and spam).', 'your-textdomain'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $show_resend ) : ?>
                        <div class="mb-6">
                            <?php echo do_shortcode('[ab_resend_verification]'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="space-y-4">
                        <?php do_action('woocommerce_login_form_start'); ?>

                        <div class="flex flex-col">
                            <label for="username" class="mb-3">Email</label>
                            <input type="text" id="username" name="username" placeholder="Email"
                                class="w-full border p-2 rounded"
                                value="<?php echo (!empty($_POST['username']) ? esc_attr($_POST['username']) : ''); ?>" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="password" class="mb-3">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password"
                                class="w-full border p-2 rounded" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="rememberme" value="forever" <?php checked(!empty($_POST['rememberme'])); ?>>
                                <span>Remember me</span>
                            </label>
                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-sm text-[#CC332E] hover:underline">
                                <?php esc_html_e('Forgot Password?', 'your-textdomain'); ?>
                            </a>
                        </div>

                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <input type="hidden" name="redirect" value="<?php echo esc_url(home_url()); ?>" />

                        <button type="submit" class="btn btn-secondary mb-6 w-full" name="login">Login</button>

                        <p class="text-center text-sm">
                            <?php esc_html_e("Don’t have an account?", 'your-textdomain'); ?>
                            <a href="<?php echo esc_url( home_url( '/sign-up' ) ); ?>" class="text-[#CC332E] font-medium hover:underline"><?php esc_html_e('Sign up', 'your-textdomain'); ?></a>
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
