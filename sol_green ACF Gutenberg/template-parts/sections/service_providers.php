<section class="services-section cmn_pad">
    <div class="container">
        <!-- Header -->
        <div class="services-header">
            <div class="services-header-text hiw-header">
                <span class="twenty_four"><?php echo get_field('service_provide_mian_title'); ?></span>
                <h2 class="title_h2"><?php echo get_field('service_provide_big_title'); ?></h2>
            </div>
        </div>
        <!-- Cards Grid -->
        <?php if (have_rows('service_list')) : ?>
            <div class="services-grid">
                <?php
                $count = 0;
                while (have_rows('service_list')) : the_row();
                    $image = get_sub_field('service_image');
                    $title = get_sub_field('service_title');
                    $desc = get_sub_field('service_descrioption');
                    $link = get_sub_field('service_link');
                    $link_url = is_array($link) ? $link['url'] : $link;
                    $link_target = is_array($link) && !empty($link['target']) ? $link['target'] : '_self';
                    $card_class = $count === 0 ? 'service-card-large' : 'service-card-small';
                ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="service-card <?php echo esc_attr($card_class); ?>">
                        <?php if (!empty($image['url'])) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="service-card-img" />
                        <?php endif; ?>
                        <div class="service-card-overlay"></div>
                        <div class="service-card-text">
                            <h4 class="service-card-title"><?php echo $title; ?></h4>
                            <div class="service-card-desc"><?php echo $desc; ?>
                        </div>
                        </div>
                    </a>
                <?php
                    $count++;
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>





<style>

    /* ===== Reset & Base ===== */

    * {

        margin: 0;

        padding: 0;

        box-sizing: border-box;

    }



    body {
        font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
        background: #ffffff;

    }







    /* ===== Section ===== */

    

</style>