<section class="faq-section cmn_pad">

<div class="container">
    <div class="faq-header hiw-header">

        <span class="twenty_four"><?php echo get_field('faq_main_title'); ?></span>

        <h2 class="title_h2"><?php echo get_field('faq_answered'); ?></h2>

    </div>

    <?php if (have_rows('faq_repeater')) : ?>

        <div class="faq-list">



            <?php while (have_rows('faq_repeater')) : the_row();



                $faq_title       = get_sub_field('faq_title');

                $faq_description = get_sub_field('faq_description');

            ?>



                <div class="faq-item">

                    <div class="faq-question">

                        <span><?php echo esc_html($faq_title); ?></span>



                        <div class="faq_icon">

                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">

                                <path d="M16 1L8.5 8.5L1 1" stroke="#112418" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />

                            </svg>

                        </div>

                    </div>



                    <div class="faq-answer">


                        <?php echo wp_kses_post($faq_description); 

                        ?>

                    </div>

                </div>



            <?php endwhile; ?>



        </div>

    <?php endif; ?>
    </div>

</section>