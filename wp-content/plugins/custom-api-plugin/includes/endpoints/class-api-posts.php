<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => 'custom_api_get_posts',
        'permission_callback' => 'post_callback_permission_check',
    ));
});


function custom_api_get_posts(WP_REST_Request $request)
{
    // Get all posts
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => -1, // Get all posts
    );
    $posts = get_posts($args);  // get_posts() is a WordPress function that retrieves posts based on the specified arguments.

    if (empty($posts)) {
        return new WP_Error('no_posts', 'No posts found', array('status' => 404));
    }

    $data = array();
    foreach ($posts as $post) {
        $data[] = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'date' => $post->post_date,
            'link'    => get_permalink($post),
        );
    }

    return new WP_REST_Response($data, 200);
}

// name of the plugin is same as the folder name, which is 'custom-api-plugin'
// Note: This code is a simple example and does not include error handling or security checks.
// Note: For production use, consider adding nonce verification and permission checks to secure the endpoint.
// Note: The endpoint can be accessed by anyone, so consider adding authentication or permissions if needed.
// Note: The endpoint returns a JSON response, which is the standard format for REST API responses in WordPress.
// Note: The plugin does not include any uninstall hooks, which can be added to clean up any options or custom database tables created by the plugin.
// Note: If you want to add more functionality, consider using WordPress hooks and filters to extend the plugin's capabilities.
// Note: For more complex applications, consider using a framework like WP-API or WP-REST-API to manage your endpoints and responses.
// Note: This plugin does not include any security measures, such as input validation or sanitization, which should be implemented in production code.


function post_callback_permission_check()
{
    // Check if the user has permission to view posts
    //return current_user_can('read'); // This checks if the user can read posts
    return true;
}