<section class="about-section cmn_pad">
    <div class="container">
        <!-- Header -->
        <div class="about-header hiw-header">
            <span class="twenty_four"><?php echo get_field('about_main_title'); ?></span>
            <h2 class="title_h2"><?php echo get_field('about_big_title'); ?></h2>
        </div>
        <!-- Content: text/stats left, image right -->
        <div class="about-content">
            <div class="about-left">
                    <?php echo get_field('about_description'); ?>
                   <!-- We believe going solar should be a smart decision, not a complicated one. Solgreen brings together trusted solar technology, thoughtful system design, and experienced installation to create energy solutions that make sense for your property today—and continue to perform for years to come. -->
                <div class="about-highlights">
                    <div class="about-checklist">
                        <h4 class="title_h4"><?php echo get_field('solar_energy_solutions_title'); ?></h4>
                        <ul>
                            <?php
                            // Check rows exists.
                            if (have_rows('solutions_list')):
                                // Loop through rows.
                                while (have_rows('solutions_list')) : the_row();
                                    // Load sub field value.
                                    $solution_title = get_sub_field('solution_title');
                                    // Do something, but make sure you escape the value if outputting directly...
                            ?>
                                    <li><span class="check-icon">✔</span> <?php echo $solution_title; ?></li>
                            <?php
                                // End loop.
                                endwhile;
                            // No value.
                            else :
                            // Do something...
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="about-image">
                                <div class="about-years-card">
                        <h3 class="about-years-number"><?php echo get_field('about_year_of_experience'); ?></h3>
                        <p class="about-years-label"><?php echo get_field('about_year_of_experience_description'); ?></p>
                    </div>
                <?php
                $image = get_field('about_right_side_image');
                if (!empty($image)): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </div>
        </div>
        <!-- Bottom Stats Row -->
        <div class="about-stats">
            <?php
            // Check rows exists.
            if (have_rows('numbering_list')):
                // Loop through rows.
                while (have_rows('numbering_list')) : the_row();
                    // Load sub field value.
                    $main_numbering = get_sub_field('main_numbering');
                    $numbering_details = get_sub_field('numbering_details');
                    // Do something, but make sure you escape the value if outputting directly...
            ?>
                    <div class="stat-card">
                        <h3 class="title_h2"><?php echo $main_numbering; ?></h3>
                        <p><?php echo $numbering_details; ?></p>
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





