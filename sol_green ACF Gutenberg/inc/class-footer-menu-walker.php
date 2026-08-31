<?php
if ( ! class_exists( 'Footer_Menu_Walker' ) ) {

	class Footer_Menu_Walker extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( $depth === 0 ) {
				$output .= '<ul class="footer-menu">';
			}
		}

		public function end_lvl( &$output, $depth = 0, $args = null ) {
			if ( $depth === 0 ) {
				$output .= '</ul></div>';
			}
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

			if ( $depth == 0 ) {

				$output .= '<div class="footer-col">';
				$output .= '<a href="#" class="footer-title">' . esc_html( $item->title ) . '</a>';

			} else {

				$output .= '<li class="menu-item">';

				$output .= sprintf(
					'<a href="%s">%s</a>',
					esc_url( $item->url ),
					esc_html( $item->title )
				);

			}
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {

			if ( $depth > 0 ) {
				$output .= '</li>';
			}
		}
	}
}
?>