<section id="login" class="section-login relative overflow-hidden pt-[82px] md:pt-[106px]">
    <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
                <div>
                    <h2 class="text-3xl font-bold mb-4">Login</h2>
                    <?php wc_print_notices(); ?>
                    <form method="post" class="space-y-4">
                        <?php do_action('woocommerce_login_form_start'); ?>
                        <input type="text" name="username" placeholder="Email" class="w-full border p-2 rounded" value="<?php echo (!empty($_POST['username']) ? esc_attr($_POST['username']) : ''); ?>" required>
                        <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="rememberme" value="forever" <?php checked(!empty($_POST['rememberme'])); ?>>
                            <span>Remember me</span> <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-sm text-red-500">Forgot Password?</a>
                        </label>

                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <input type="hidden" name="redirect" value="<?php echo esc_url(home_url()); ?>" />
                        <button type="submit" class="btn btn-secondary mb-6 w-full" name="login">Login</button>
                        <p class="text-center text-sm">
                        Don’t have an account?
                        <a href="<?php echo esc_url( home_url( '/sign-up' ) ); ?>" class="text-red-500 font-medium hover:underline">Sign up</a>
                        </p>

                        
                        <?php do_action('woocommerce_login_form_end'); ?>
                    </form>
                </div>
            </div>
            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-8 hidden xl:block">
                <div class="flex justify-center items-center">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt="Visual" class="">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>