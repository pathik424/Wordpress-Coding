

  <section class="vm-section cmn_pad">

    <div class="container">

      <div class="vm_main">

      <!-- Left: Our Vision -->

      <div class="vm-card vm-card-text">

        <span class="vm-badge"><?php echo get_field('our_vision_title'); ?></span>

        <h3 class="title_h3"><?php echo get_field('our_vision_subtitle'); ?></h3>

        <div class="vm-desc">

          <?php echo get_field('our_vision_description'); ?>


        </div>

      </div>



      <!-- Middle: blurred photo + logo -->

      <div class="vm-card vm-card-image">

        

        <?php

            $image = get_field('middle_background_image');

            if (!empty($image)): ?>

                <img class="vm-bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

            <?php endif; ?>

        <div class="vm-image-overlay"></div>



        <?php

            $middle_logo = get_field('middle_logo');

            if (!empty($middle_logo)): ?>

                <img class="vm-logo" src="<?php echo esc_url($middle_logo['url']); ?>" alt="<?php echo esc_attr($middle_logo['alt']); ?>" />

            <?php endif; ?>

      </div>



      <!-- Right: Our Mission -->

      <div class="vm-card vm-card-text">

        <span class="vm-badge"><?php echo get_field('our_mission_title'); ?></span>

        <h3 class="title_h3"><?php echo get_field('our_mission_subtitle'); ?></h3>

        <div class="vm-desc">

          <?php echo get_field('our_mission_description'); ?>

          <!-- Through expert installations and an unwavering commitment to quality, we deliver long-term savings and lasting environmental impact your trusted partner in solar. -->

        </div>

      </div>

      </div>



    </div>

  </section>



