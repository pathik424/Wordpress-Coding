  <section class="brands-section cmn_pad">

    <div class="container">



      <!-- Header -->

      <div class="brands-header hiw-header">

        <span class="twenty_four"><?php echo get_field('brand_main_title'); ?></span>

        <h2 class="title_h2">

          <?php echo get_field('brand_big_title'); ?>

        </h2>

      </div>



      <?php



      // Check rows exists.

      if (have_rows('brand_list')):



        // Loop through rows.

        while (have_rows('brand_list')) : the_row();



          // Load sub field value.

          $brand_section = get_sub_field('brand_section');

          // Do something, but make sure you escape the value if outputting directly...

      ?>

          <!-- ===================== Panels row ===================== -->

          <div class="brand-row">

            <span class="title_h4"><?php echo $brand_section; ?></span>



            <div class="brand-swiper swiper" data-direction="normal">

              <div class="swiper-wrapper brand-wrapper">



                <?php



                // Check rows exists.

                if (have_rows('brand_logo_list')):



                  // Loop through rows.

                  while (have_rows('brand_logo_list')) : the_row();



                    // Load sub field value.



                    // Do something, but make sure you escape the value if outputting directly...

                ?>





                    <div class="swiper-slide">

                      <?php

                      $link = get_sub_field('brand_logo_link');

                      if ($link):

                        $link_url = $link['url'];

                        $link_title = $link['title'];

                        $link_target = $link['target'] ? $link['target'] : '_self';

                      ?>

                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" rel="noopener noreferrer">

                          <?php

                          $image = get_sub_field('brand_logo');

                          if (!empty($image)): ?>

                            <img class="brand-logo" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                          <?php endif; ?>

                        </a>

                      <?php endif; ?>

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

  </section>



  