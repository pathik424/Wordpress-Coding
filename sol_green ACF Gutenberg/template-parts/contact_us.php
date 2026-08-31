<?php

/*

 * Template Name: Contact Us Page

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

            <span class="highlight"><?php echo get_field('contact_us_title'); ?>

        </p>

        <h2 class="title_h2"><?php echo get_field('contact_us_subtitle'); ?></h2>

    </div>

</section>



<div class="contact-section-wrapper cmn_pad">

    <div class="container">

        <div class="contact_main">



            <!-- LEFT COLUMN -->

            <div class="contact-left-col">

                <h2 class="title_h2">

                    <?php echo get_field('quote_title'); ?>

                </h2>

                <div class="desc">

                 

                    <?php echo get_field('quote_description'); 
                    ?>

                </div>



                <ul class="contact-info-list">





                    <li>

                        <span class="icon-circle">

                            <!-- Location SVG -->

                            <?php

                            // Company Address

                            $company_address_svg = get_field('company_address_svg', 'options');

                            if (!empty($company_address_svg)): ?>

                                <img src="<?php echo esc_url($company_address_svg['url']); ?>" alt="<?php echo esc_attr($company_address_svg['alt']); ?>" />

                            <?php endif; ?>

                        </span>

                        <span class="info-text">

                            <?php

                            $company_address_details = get_field('company_address_details', 'options');

                            if (! empty($company_address_details)) :

                            ?>

                                <?php echo  $company_address_details; ?>

                            <?php

                            endif;

                            ?>

                        </span>

                    </li>





                    <li>

                        <span class="icon-circle">

                            <!-- Location SVG -->

                            <?php

                            // Company Address

                            $comapny_email_svg = get_field('comapny_email_svg', 'options');

                            if (!empty($comapny_email_svg)): ?>

                                <img src="<?php echo esc_url($comapny_email_svg['url']); ?>" alt="<?php echo esc_attr($comapny_email_svg['alt']); ?>" />

                            <?php endif; ?>

                        </span>

                        <a href="mailto:<?php echo get_field('comapny_email_id', 'options'); ?>">

                            <span class="info-text">

                                <?php

                                $comapny_email_id = get_field('comapny_email_id', 'options');

                                if (! empty($comapny_email_id)) :

                                ?>

                                    <?php echo  $comapny_email_id; ?>

                                <?php

                                endif;

                                ?>

                            </span>

                        </a>

                    </li>





                    <li>



                        <span class="icon-circle">

                            <!-- Location SVG -->

                            <?php

                            // Company Address

                            $company_phone_svg = get_field('company_phone_svg', 'options');

                            if (!empty($company_phone_svg)): ?>

                                <img src="<?php echo esc_url($company_phone_svg['url']); ?>" alt="<?php echo esc_attr($company_phone_svg['alt']); ?>" />

                            <?php endif; ?>

                        </span>

                        <a href="tel:<?php echo get_field('company_number', 'options'); ?>">

                            <span class="info-text">

                                <?php

                                $company_number = get_field('company_number', 'options');

                                if (! empty($company_number)) :

                                ?>

                                    <?php echo  $company_number; ?>

                                <?php

                                endif;

                                ?>

                            </span>

                        </a>

                    </li>



                </ul>



                <div class="social-follow">

                    <p><?php echo get_field('follow_us_title'); ?></p>

                    <div class="social-icons">



                        <?php



                        // Check rows exists.

                        if (have_rows('follow_us_logo')):



                            // Loop through rows.

                            while (have_rows('follow_us_logo')) : the_row();



                                // Load sub field value.

                                $sub_value = get_sub_field('sub_field');

                                // Do something, but make sure you escape the value if outputting directly...

                        ?>

                                <?php

                                $link = get_sub_field('logo_link');

                                if ($link):

                                    $link_url = $link['url'];

                                    $link_title = $link['title'];

                                    $link_target = $link['target'] ? $link['target'] : '_self';

                                ?>

                                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="icon-circle">



                                        <?php

                                        $image = get_sub_field('logo_list');

                                        if (!empty($image)): ?>

                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                                        <?php endif; ?>

                                    </a>



                                <?php endif; ?>

                        <?php

                            // End loop.

                            endwhile;



                        // No value.

                        else :

                        // Do something...

                        endif;

                        ?>



                    </div>

                </div>

            </div>



            <!-- RIGHT COLUMN -->

            <div class="contact-right-col">

                <h2 class="title_h2">Send Message</h2>

                <!-- Ensure your shortcode ID matches your actual CF7 ID -->

                <?php echo do_shortcode('[contact-form-7 id="d881575" title="Contact form"]'); ?>

            </div>


        </div>
    </div>
</div>


<div class="contact-map-section">

    <div class="container">
<div class="contact-map">
    <?php

    $map = get_field('google_map');



    if (!empty($map)) {

        echo $map;
    }

    ?>
    </div>

</div>
</div>












<?php

get_footer();

?>