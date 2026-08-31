<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sol_green
 */

?>

<footer class="site-footer">
	<div class="container">
		<div class="footer-inner">
			<div class="footer-top">

				<!-- Column 1: Logo + contact details -->
				<div class="footer-brand">

					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php
						$company_logo = get_field('company_logo', 'options');
						if (!empty($company_logo)): ?>
							<img src="<?php echo esc_url($company_logo['url']); ?>" alt="<?php echo esc_attr($company_logo['alt']); ?>" />
						<?php endif; ?>
					</a>
					<ul class="footer-contact">
						<li>
							<span class="icon-badge">
								<?php
								// Company Address
								$company_address_svg = get_field('company_address_svg', 'options');
								if (!empty($company_address_svg)): ?>
									<img src="<?php echo esc_url($company_address_svg['url']); ?>" alt="<?php echo esc_attr($company_address_svg['alt']); ?>" />
								<?php endif; ?>
							</span>
							<?php
							$company_address_details = get_field('company_address_details', 'options');
							if (! empty($company_address_details)) :
							?>
								<p>
									<?php echo  $company_address_details; ?>
								</p>
							<?php
							endif;
							?>
						</li>
						<li>
							<span class="icon-badge">
								<?php
								// Company Email
								$comapny_email_svg = get_field('comapny_email_svg', 'options');
								if (!empty($comapny_email_svg)): ?>
									<img src="<?php echo esc_url($comapny_email_svg['url']); ?>" alt="<?php echo esc_attr($comapny_email_svg['alt']); ?>" />
								<?php endif; ?>
							</span>
							<p>

							
							<a href="mailto:<?php echo get_field('comapny_email_id', 'options'); ?>">

								<?php
								$comapny_email_id = get_field('comapny_email_id', 'options');
								if (! empty($comapny_email_id)) :
								?>
									<?php echo  $comapny_email_id; ?>
								<?php
								endif;
								?>
							</a>

							</p>
						</li>
						<li>
							<span class="icon-badge">

								<?php
								// Company Phone
								$company_phone_svg = get_field('company_phone_svg', 'options');
								if (!empty($company_phone_svg)): ?>
									<img src="<?php echo esc_url($company_phone_svg['url']); ?>" alt="<?php echo esc_attr($company_phone_svg['alt']); ?>" />
								<?php endif; ?>
							</span>

							<a href="tel:<?php echo get_field('company_number', 'options'); ?>">
								<?php
								$company_number = get_field('company_number', 'options');
								if (! empty($company_number)) :
								?>
									<?php echo  $company_number; ?>
								<?php
								endif;
								?>
							</a>

						</li>
					</ul>
				</div>
				<div class="footer_menu_links">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'walker'         => new Footer_Menu_Walker(),
					));
					?>
				</div>


			</div>
		</div>

		<div class="footer-divider">
			<div class="footer-bottom">
				<?php
				// Company Copyright
				$company_copyright = get_field('company_copyright', 'options');
				if (! empty($company_copyright)) :
				?>
					<?php echo  $company_copyright; ?>
				<?php
				endif;
				?>
			</div>
		</div>
	</div>
</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

