<section class="how-it-works cmn_pad">
    <div class="container">
        <div class="hiw-header">
            <span class="twenty_four"><?php echo get_field('easy_steps_title'); ?></span>
            <h2 class="title_h2"><?php echo get_field('easy_steps_big_title'); ?></h2>
        </div>
        <div class="hiw-steps">
            <?php
            // Check rows exists.
            if (have_rows('easy_steps_list')):
                // Loop through rows.
                while (have_rows('easy_steps_list')) : the_row();
            ?>
                    <!-- Step 1 -->
                    <div class="hiw-step">
                        <div class="hiw-icon-circle">
                            <?php
                            $image = get_sub_field('steps_svg_image');
                            if (!empty($image)): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                        <p class="hiw-step-label"><?php echo get_sub_field('steps_count'); ?></p>
                        <h4 class="title_h4"><?php echo get_sub_field('steps_title'); ?></h4>
                        <p class="hiw-step-desc">
                           <?php  echo get_sub_field('steps_description'); ?>
                           <!-- Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit perspiciatis vitae voluptas non, architecto beatae aliquam obcaecati doloribus omnis consectetur molestias tenetur eaque et nulla animi exercitationem reiciendis ipsam? Placeat totam iste similique eaque aliquid sint ab, autem veniam, cumque esse nemo rerum? Magnam saepe est iste dicta! Eius, expedita. -->
                        </p>
                    </div>
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
</section>







