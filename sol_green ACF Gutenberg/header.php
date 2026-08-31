<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sol_green
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'sol_green'); ?></a>






		<header class="header">
			<div class="container">
				<div class="header_main">
					<div class="header-logos">
						<?php
						$sol_green_logo = get_field('sol_green_logo', 'options');
						if (!empty($sol_green_logo)): ?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img src="<?php echo esc_url($sol_green_logo['url']); ?>" alt="<?php echo esc_attr($sol_green_logo['alt']); ?>" />
								</a>
						<?php endif; ?>

						<?php
						$approve_seller_logo = get_field('approve_seller_logo', 'options');
						if (!empty($approve_seller_logo)): ?>
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img src="<?php echo esc_url($approve_seller_logo['url']); ?>" alt="<?php echo esc_attr($approve_seller_logo['alt']); ?>" />
						</a>
							<?php endif; ?>
					</div>

					<div class="header_right right_menu">

					
					<nav class="header-menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header-menu',
								'menu_class'     => 'header-menu',
								'container'      => 'nav',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>

					

					<div class="header-actions">
						<?php
						$pay_bill = get_field('pay_bill', 'options');
						if ($pay_bill):
							$pay_bill_url = $pay_bill['url'];
							$pay_bill_title = $pay_bill['title'];
							$pay_bill_target = $pay_bill['target'] ? $pay_bill['target'] : '_self';
						?>
							<a class="btn" href="<?php echo esc_url($pay_bill_url); ?>" target="<?php echo esc_attr($pay_bill_target); ?>"><?php echo esc_html($pay_bill_title); ?></a>
						<?php endif; ?>


						<?php
						$contact_us = get_field('contact_us', 'options');
						if ($contact_us):
							$contact_us_url = $contact_us['url'];
							$contact_us_title = $contact_us['title'];
							$contact_us_target = $contact_us['target'] ? $contact_us['target'] : '_self';
						?>
							<a class="btn green-btn" href="<?php echo esc_url($contact_us_url); ?>" target="<?php echo esc_attr($contact_us_target); ?>"><?php echo esc_html($contact_us_title); ?></a>
						<?php endif; ?>
					</div>
					</div>
					<div id="mobileIcon" class="mobileIcon">
							<span></span>
						</div>
				</div>
			</div>
		</header>


