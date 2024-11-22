<?php



//////////////////// Create Custome Breadcrumb Function/////////////////////////////////////////
function custom_breadcrumbs() {
    // Start the breadcrumb with a container and the Home link
    $breadcrumb = '<nav class="custom-breadcrumbs"><ul>';
    $breadcrumb .= '<li><a href="' . home_url() . '">בַּיִת</a></li>';
    
    // Conditionally add Catalogue Page for products
    if (is_singular('post') || strpos($_SERVER['REQUEST_URI'], '/products/') !== false) {
        $breadcrumb .= '<li><a href="' . home_url('/catalogue-page/') . '">Catalogue Page</a></li>';
    }
    
    // Check for various page types
    if (is_category() || is_single()) {
        if (is_single()) {
            // Add Product Category (or custom taxonomy if needed)
            $categories = get_the_category();
            if (!empty($categories)) {
                $breadcrumb .= '<li>' . $categories[0]->name . '</li>';
            }
            // Add Product Title
            $breadcrumb .= '<li>' . get_the_title() . '</li>';
        }
    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                $breadcrumb .= '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
        }
        $breadcrumb .= '<li>' . get_the_title() . '</li>';
    } elseif (is_archive()) {
        $breadcrumb .= '<li>' . post_type_archive_title('', false) . '</li>';
    } elseif (is_search()) {
        $breadcrumb .= '<li>Search results for: ' . get_search_query() . '</li>';
    } elseif (is_404()) {
        $breadcrumb .= '<li>404 Error</li>';
    }
    
    $breadcrumb .= '</ul></nav>';
    
    return $breadcrumb;
}

// Register Breadcrumb Shortcode
add_shortcode('custom_breadcrumbs', 'custom_breadcrumbs');

//////////////////// End Create Custome Breadcrumb Function/////////////////////////////////////////
?>