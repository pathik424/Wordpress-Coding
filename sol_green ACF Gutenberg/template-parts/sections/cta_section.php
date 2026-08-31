  <?php

    $cta_background_image = get_field('cta_background_image', 'options');

    ?>

  <section class="quote-section"

      <?php if (! empty($cta_background_image)) : ?>

      style="background-image: url('<?php echo esc_url($cta_background_image['url']); ?>');"

      <?php endif; ?>>

      <div class="quote-overlay"></div>



      <div class="quote-container">

          <div class="quote-text">

              <p class="quote-label"><?php echo get_field('cta_small_title', 'options'); ?></p>

              <h2 class="quote-heading"><?php echo get_field('cta_big_title', 'options'); ?></h2>

              <div class="quote-description">

                <!-- lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nunc ut aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc. Sed euismod, nunc ut -->

                  <?php echo get_field('cta_description', 'options'); ?>

              </div>

          </div>

          <div class="quote-action">

    

                  <?php

                    $link = get_field('cta_button','options');

                    if ($link):

                        $link_url = $link['url'];

                        $link_title = $link['title'];

                        $link_target = $link['target'] ? $link['target'] : '_self';

                    ?>

                      <a class="black_btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>

                  <?php endif; ?>

                  <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">

                      <g clip-path="url(#clip0_1_1234)">

                          <path d="M21.25 8.3501L8.75 20.8501" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />

                          <path d="M10 8.3501H21.25V19.6001" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />

                      </g>

                      <defs>

                          <clipPath id="clip0_1_1234">

                              <rect width="30" height="30" fill="white" />

                          </clipPath>

                      </defs>

                  </svg>

              </a>

          </div>

      </div>

  </section>