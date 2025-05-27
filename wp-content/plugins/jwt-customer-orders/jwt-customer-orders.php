<?php
/*
Plugin Name: JWT Customer Orders Access
Description: Allows customers to view their own orders through the REST API
Version: 1.0
*/

add_filter( 'woocommerce_rest_check_permissions', 'allow_subscriber_to_view_orders', 10, 4 );
function allow_subscriber_to_view_orders( $permission, $context, $object_id, $post_type ) {
    if ( 'shop_order' === $post_type && 'read' === $context ) {
        $user = wp_get_current_user();
        if ( in_array( 'subscriber', (array) $user->roles, true ) ) {
            return true;
        }
    }
    return $permission;
}

// rest api change: custom plugin is created to allow customers to view their own orders