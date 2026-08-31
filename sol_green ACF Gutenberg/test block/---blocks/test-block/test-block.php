<?php

$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$button_text = get_field('button_text');
$button_url  = get_field('button_url');

// if ( ! $title && ! $description && ! $image && ! $button_text && ! $button_url ) {
//     $title       = 'Test Block';
//     $description = 'Your Gutenberg block is registered and rendering correctly.';
// }

?>

<section class="test-block">

    <?php if ( $image ) : ?>

        <div class="test-block-image">
            <?php
            if ( is_array( $image ) && ! empty( $image['ID'] ) ) {
                echo wp_get_attachment_image( $image['ID'], 'full' );
            } elseif ( is_numeric( $image ) ) {
                echo wp_get_attachment_image( $image, 'full' );
            } elseif ( is_string( $image ) ) {
                echo '<img src="' . esc_url( $image ) . '" alt="">';
            }
            ?>
        </div>

    <?php endif; ?>


    <?php if ( $title ) : ?>

        <h2>
            <?php echo esc_html( $title ); ?>
        </h2>

    <?php endif; ?>


    <?php if ( $description ) : ?>

        <div class="test-block-description">
            <?php echo wp_kses_post( $description ); ?>
        </div>

    <?php endif; ?>


    <?php if ( $button_text && $button_url ) : ?>

        <a href="<?php echo esc_url( $button_url ); ?>">
            <?php echo esc_html( $button_text ); ?>
        </a>

    <?php endif; ?>

</section>