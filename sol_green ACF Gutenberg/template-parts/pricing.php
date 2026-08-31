<?php

/*

 * Template Name: Pricing Page

 *

 */

get_header(); ?>







<section class="contact-banner">



    <?php

    $image = get_field('background_image');

    if (!empty($image)): ?>

        <img class="contact-banner-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

    <?php endif; ?>

    <div class="contact-banner-overlay"></div>



    <div class="contact-banner-content">

        <p class="contact-banner-label">

            <span class="highlight"><?php echo get_field('pricing_title'); ?>

        </p>

        <h2 class="title_h2"><?php echo get_field('pricing_sub_title'); ?></h2>

    </div>

</section>





<section class="pricing-section cmn_pad">

    <div class="container">



        <!-- Tabs (dynamic via ACF `pricing_tabs` repeater) -->

        <div class="pricing-tabs" role="tablist">

            <?php if (have_rows('pricing_tabs')) :

                $tab_index = 0;

                while (have_rows('pricing_tabs')) : the_row();

                    $tab_title = get_sub_field('tab_title');

                    $tab_slug = sanitize_title($tab_title);

            ?>

                    <button class="pricing-tab <?php echo $tab_index === 0 ? 'is-active' : ''; ?>" data-tab="<?php echo esc_attr($tab_slug); ?>" role="tab" aria-selected="<?php echo $tab_index === 0 ? 'true' : 'false'; ?>">

                        <?php echo esc_html($tab_title); ?>

                    </button>

            <?php

                    $tab_index++;

                endwhile;

            endif;

            ?>

        </div>



        <!-- Panels (one per tab) -->

        <?php if (have_rows('pricing_tabs')) :

            $panel_index = 0;

            // Rewind to loop panels; have_rows can be used again because we are outside the previous loop

            while (have_rows('pricing_tabs')) : the_row();

                $panel_title = get_sub_field('tab_title');

                $panel_slug = sanitize_title($panel_title);

        ?>

                <div class="pricing-panel <?php echo $panel_index === 0 ? 'is-active' : ''; ?>" data-panel="<?php echo esc_attr($panel_slug); ?>">



                    <ul class="pricing-notes">

                        <?php if (have_rows('warranty_list')) :

                            while (have_rows('warranty_list')) : the_row();

                                $warranty = get_sub_field('warranty_text');

                        ?>

                                <li><?php echo esc_html($warranty); ?></li>

                        <?php

                            endwhile;

                        endif;

                        ?>

                    </ul>



                    <div class="pricing-cards">



                        <?php if (have_rows('pricing_cards')) :

                            while (have_rows('pricing_cards')) : the_row();

                                $package_title   = get_sub_field('package_title');

                                $starting_label  = get_sub_field('starting_label');

                                $price           = get_sub_field('price');

                                $get_now_link    = get_sub_field('get_now_link');

                        ?>

                                <div class="pricing-card">

                                    <span class="pricing-card-tag"><?php echo esc_html($package_title); ?></span>



                                    <p class="pricing-card-label"><?php echo esc_html($starting_label); ?></p>

                                    <h3 class="pricing-card-price"><?php echo esc_html($price); ?></h3>



                                    <hr class="pricing-card-divider" />



                                    <ul class="pricing-card-list">

                                        <?php if (have_rows('pricing_features')) :

                                            while (have_rows('pricing_features')) : the_row();

                                                $feature = get_sub_field('pricing_features_list');

                                        ?>

                                                <li>

                                                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">

<path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.527C3.86137 10.2599 3.19758 16.4394 5.56852 18.0151C8.99525 15.8748 10.2675 5.22302 20 0C13.5821 0.62708 8.16208 6.92877 5.90726 12.9501C5.4456 9.32954 1.30871 6.84471 0 10.527Z" fill="#3FA644"/>

</svg>

                                                <?php echo esc_html($feature); ?>

                                                </li>

                                        <?php

                                            endwhile;

                                        endif;

                                        ?>

                                    </ul>



                                    <?php

                                    $link_url = '#';

                                    $link_title = 'Get Now';

                                    $link_target = '';

                                    if ($get_now_link && is_array($get_now_link)) {

                                        $link_url = ! empty($get_now_link['url']) ? $get_now_link['url'] : $link_url;

                                        $link_title = ! empty($get_now_link['title']) ? $get_now_link['title'] : $link_title;

                                        $link_target = ! empty($get_now_link['target']) ? $get_now_link['target'] : '';

                                    }

                                    ?>



                                    <a href="<?php echo esc_url($link_url); ?>" class="black_btn" <?php echo $link_target ? ' target="' . esc_attr($link_target) . '"' : ''; ?>>

                                        <?php echo esc_html($link_title); ?>

                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                            <path d="M7 17L17 7M17 7H8M17 7V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />

                                        </svg>

                                    </a>

                                </div>

                        <?php

                            endwhile;

                        endif;

                        ?>



                    </div>

                </div>

        <?php

                $panel_index++;

            endwhile;

        endif;

        ?>



    </div>

</section>





<?php get_template_part('template-parts/sections/cta_section'); ?>







<?php

get_footer();

?>