<div class="banner_video">
    <?php
    // Load video settings only once (they are not sub fields)
    $autoplay      = get_field('autoplay') ? 'autoplay' : '';
    $loop          = get_field('loop') ? 'loop' : '';
    $mute          = get_field('mute') ? 'muted' : '';
    $show_controls = get_field('show_controls') ? 'controls' : '';

    if (have_rows('banner_video_sections')) :
        while (have_rows('banner_video_sections')) : the_row();

            /* =======================
             * MP4 VIDEO
             * ======================= */
            if (get_row_layout() === 'video_mp4') : ?>

                <div class="video_section mp4_video_main">
                    <?php
                    $mp4_video = get_sub_field('mp4_video_');
                    if ($mp4_video) :
                        $mp4_video_url = is_array($mp4_video) ? $mp4_video['url'] : $mp4_video;
                    ?>
                        <div class="video_main_video">
                            <video class="video-player"
                                <?php echo $autoplay ? 'autoplay ' : ''; ?>
                                <?php echo $loop ? 'loop ' : ''; ?>
                                <?php echo $mute ? 'muted ' : ''; ?>
                                <?php echo $show_controls ? 'controls ' : ''; ?>>
                                <source src="<?php echo esc_url($mp4_video_url); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                </div>

            <?php
            /* =======================
             * YOUTUBE / VIMEO
             * ======================= */
            elseif (get_row_layout() === 'video_youtubevimeo') : ?>

                <div class="video_section youtube_video">
                    <?php
                    $video_url = get_sub_field('video_url');
                    if ($video_url) {

                        preg_match('/src="([^"]+)"/', $video_url, $src_matches);
                        $iframe_src = $src_matches[1] ?? '';

                        if ($iframe_src) {
                            $params = [];

                            if ($autoplay) $params[] = 'autoplay=1';
                            if ($mute) $params[] = 'mute=1';

                            if ($loop) {
                                preg_match('/embed\/([^?]+)/', $iframe_src, $id_matches);
                                $video_id = $id_matches[1] ?? '';
                                if ($video_id) {
                                    $params[] = "loop=1&playlist={$video_id}";
                                }
                            }

                            if (!$show_controls) $params[] = 'controls=0';
                            $params[] = 'rel=0';

                            $iframe_src .= (strpos($iframe_src, '?') === false ? '?' : '&') . implode('&', $params);

                            $video_url = preg_replace(
                                '/src="([^"]+)"/',
                                'src="' . esc_url($iframe_src) . '"',
                                $video_url
                            );
                        }

                        echo $video_url;
                    }
                    ?>
                </div>

            <?php
            /* =======================
             * IMAGE
             * ======================= */
            elseif (get_row_layout() === 'image') : ?>

                <div class="image_section banner_image">
                    <?php
                    $image = get_sub_field('banner_image');
                    if ($image) :
                        $img_url = is_array($image) ? $image['url'] : $image;
                        $alt     = is_array($image) ? $image['alt'] : '';
                    ?>
                        <img src="<?php echo esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($alt); ?>">
                    <?php endif; ?>
                </div>

            <?php endif;

        endwhile;
    endif;
    ?>
</div>



<?php 


ACF :

1. Field Type : Flexible Content
   Field Name : banner_video_sections (Presentations Minimum and Maximum Layouts can be set to 1)

   In Flexible Content :
    a) Layout Name : video_youtubevimeo
        Field Type : oEmbed 
        Field Name : video_url
    b) Layout Name : video_mp4
        Field Type : File
        Field Name : mp4_video_
    c) Layout Name : image
        Field Type : Image
        Field Name : banner_image


2. Field Type : True/False
   Field Name : autoplay
3. Field Type : True/False
   Field Name : loop
4. Field Type : True/False
   Field Name : mute
5. Field Type : True/False
   Field Name : show_controls





