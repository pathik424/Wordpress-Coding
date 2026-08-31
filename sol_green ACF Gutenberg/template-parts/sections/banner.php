  <section class="hero-section">
      <div class="container">
          <div class="hero-container">
              <?php
                $image = get_field('banner_image');
                if (!empty($image)): ?>
                  <img class="hero-bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              <?php endif; ?>
              <!-- Monthly savings floating card -->
              <div class="hero-savings-card">
                  <span class="hero-savings-icon">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3 17l6-6 4 4 8-8" stroke="#1a1a1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M15 7h6v6" stroke="#1a1a1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                  </span>
                  <span class="hero-savings-text">
                      <span class="hero-savings-label"> <?php echo get_field('banner_saving'); ?></span>
                      <span class="hero-savings-value"> <?php echo get_field('banner_saving_percentage'); ?></span>
                  </span>
              </div>
              <!-- Text content -->
              <div class="hero-content">
                  <h1 class="hero-heading">
                      <?php echo get_field('banner_title'); ?>
                  </h1>
              </div>
              <div class="banner_btn_main">
                  <div class="banner_btn">
                      <?php
                        $link = get_field('banner_button');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                          <a class="black_btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
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
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
  </section>