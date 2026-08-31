<?php

$title       = get_field( 'title' );
$description = get_field( 'description' );
$image       = get_field( 'image' );
$button_text = get_field( 'button_text' );
$button_url  = get_field( 'button_url' );

?>

<section class="test-block">

    <?php if ( $title ) : ?>
        <h2><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <?php if ( $description ) : ?>
        <p><?php echo esc_html( $description ); ?></p>
    <?php endif; ?>

    <?php if ( $image ) : ?>
        <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
    <?php endif; ?>

    <?php if ( $button_text && $button_url ) : ?>
        <a href="<?php echo esc_url( $button_url ); ?>">
            <?php echo esc_html( $button_text ); ?>
        </a>
    <?php endif; ?>

</section>