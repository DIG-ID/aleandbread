<section id="signup" class="section-signup relative overflow-hidden pt-[82px] md:pt-[106px]">
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
                    <h1 class="font-bold mb-6"><?php esc_html_e('Sign Up', 'aleandbread'); ?></h1>
                    <p class="font-barlow text-[16px] opacity-75 font-normal text-blockText mb-4"><?php esc_html_e('Bitte registrieren Sie sich, um Ihr Ale & Bread Konto zu erstellen.', 'aleandbread'); ?></p>
                    <?php wc_print_notices(); ?>
                    <form method="post" class="space-y-4">
                        <?php do_action('woocommerce_register_form_start'); ?>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col !mt-6">
                                <label for="first_name" class="mb-3"><?php esc_html_e('Vorname', 'aleandbread'); ?> <span class="required" aria-hidden="true">*</span></label>
                                <input type="text" id="first_name" name="first_name" placeholder="Vorname"
                                    class="border p-2"
                                    value="<?php echo (!empty($_POST['first_name']) ? esc_attr($_POST['first_name']) : ''); ?>" required>
                            </div>
                            <div class="flex flex-col !mt-6">
                                <label for="last_name" class="mb-3"><?php esc_html_e('Nachname', 'aleandbread'); ?> <span class="required" aria-hidden="true">*</span></label>
                                <input type="text" id="last_name" name="last_name" placeholder="Nachname"
                                    class="border p-2"
                                    value="<?php echo (!empty($_POST['last_name']) ? esc_attr($_POST['last_name']) : ''); ?>" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col !mt-6">
                                <label for="email" class="mb-3"><?php esc_html_e('Email', 'aleandbread'); ?> <span class="required" aria-hidden="true">*</span></label>
                                <input type="email" id="email" name="email" placeholder="Email"
                                class="border p-2"
                                value="<?php echo (!empty($_POST['email']) ? esc_attr($_POST['email']) : ''); ?>" required>
                            </div>
                            <div class="flex flex-col !mt-6">
                                <label for="phone" class="mb-3"><?php esc_html_e('Telefonnummer', 'aleandbread'); ?></label>
                                <input type="tel" id="phone" name="phone" placeholder="Telefonnummer"
                                class="border p-2"
                                value="<?php echo (!empty($_POST['phone']) ? esc_attr($_POST['phone']) : ''); ?>">
                            </div>
                        </div>

                        <div class="flex flex-col !mt-6">
                            <label for="password" class="mb-3"><?php esc_html_e('Passwort', 'aleandbread'); ?> <span class="required" aria-hidden="true">*</span></label>
                            <input type="password" id="password" name="password" placeholder="Passwort"
                                class="w-full border p-2" required>
                        </div>

                        <div class="flex flex-col !mt-6">
                            <label for="password2" class="mb-3"><?php esc_html_e('Passwort bestätigen', 'aleandbread'); ?> <span class="required" aria-hidden="true">*</span></label>
                            <input type="password" id="password2" name="password2" placeholder="Passwort bestätigen"
                                class="w-full border p-2" required>
                        </div>

                        <div class="flex items-center !mt-6 space-x-2">
                            <input type="checkbox" name="terms" required>
                            <span class="text-[14px] text-dark"><?php esc_html_e('Ich stimme allen', 'aleandbread'); ?>&nbsp;<a href="#" class="text-[#CC332E]"><?php esc_html_e('Geschäftsbedingungen', 'aleandbread'); ?></a>&nbsp;<?php esc_html_e('und', 'aleandbread'); ?>&nbsp;<a href="#" class="text-[#CC332E]"><?php esc_html_e('Datenschutzbestimmungen zu', 'aleandbread'); ?></a></span>
                    </div>

                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <button type="submit" class="btn btn-secondary mb-6 w-full" name="register"><?php esc_html_e('Konto erstellen', 'aleandbread'); ?></button>
                        <p class="text-center text-sm">
                            <?php esc_html_e("Sie haben bereits ein Konto?", 'aleandbread'); ?>
                            <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="text-[#CC332E] font-medium hover:underline"><?php esc_html_e('Login', 'aleandbread'); ?></a>
                        </p>
                        <?php do_action('woocommerce_register_form_end'); ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>