<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/products', array(
        'methods' => 'GET',
        'callback' => 'custom_api_get_products',
        'permission_callback' => '__return_true',
    ));
});

function custom_api_get_products(WP_REST_Request $request)
{
    if (!class_exists('WooCommerce')) {
        return new WP_Error('woocommerce_not_active', 'WooCommerce is not active', ['status' => 500]);
    }

    $args = ['post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1];
    $query = new WP_Query($args);

    $products = [];

    foreach ($query->posts as $post) {
        $product = wc_get_product($post->ID);
        $products[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => $product->get_price(),
            'image' => wp_get_attachment_url($product->get_image_id()),
            'link' => get_permalink($product->get_id())
        ];
    }

    return new WP_REST_Response($products, 200);
}
