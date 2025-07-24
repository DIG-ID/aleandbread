<section id="login" class="section-login relative overflow-hidden pt-[82px] md:pt-[106px]">
    <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2 hidden xl:block">
                <div class="flex justify-center items-center">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt="Visual" class="">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-span-2 md:col-span-4 xl:col-span-5 md:col-start-2 xl:col-start-7">
                <div>
                    <h2 class="text-3xl font-bold mb-4">Sign Up</h2>
                    <?php wc_print_notices(); ?>
                    <form method="post" class="space-y-4">
                        <?php do_action('woocommerce_register_form_start'); ?>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="first_name" placeholder="First name" class="border p-2 rounded" value="<?php echo (!empty($_POST['first_name']) ? esc_attr($_POST['first_name']) : ''); ?>" required>
                            <input type="text" name="last_name" placeholder="Last name" class="border p-2 rounded" value="<?php echo (!empty($_POST['last_name']) ? esc_attr($_POST['last_name']) : ''); ?>" required>
                        </div>
                        <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" value="<?php echo (!empty($_POST['email']) ? esc_attr($_POST['email']) : ''); ?>" required>
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full border p-2 rounded" value="<?php echo (!empty($_POST['phone']) ? esc_attr($_POST['phone']) : ''); ?>">
                        <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>
                        <input type="password" name="password2" placeholder="Confirm Password" class="w-full border p-2 rounded" required>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="terms" required>
                            <span>I agree to all the <a href="#" class="text-red-500">Terms and Privacy Policies</a></span>
                        </label>

                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <button type="submit" class="btn btn-secondary mb-6 w-full" name="register">Create account</button>
                        <?php do_action('woocommerce_register_form_end'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>