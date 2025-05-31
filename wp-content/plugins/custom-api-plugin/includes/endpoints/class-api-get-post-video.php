<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/post/video', array(
        'methods' => 'GET',
        'callback' => 'get_video_by_post_id',
        'permission_callback' => function () {
            return is_user_logged_in(); // Adjust as needed
        },
        'args' => [
            'post_id' => [
                'required' => true,
                'validate_callback' => function($post_id) {
                    return is_numeric($post_id);
                }
            ]
        ],
    ));
});

function get_video_by_post_id($request)
{
    $post_id = (int) $request->get_param('post_id');

    $utils = tutor_utils(); // Or however your code accesses this class

    if (!method_exists($utils, 'get_video')) {
        return new WP_Error('method_missing', 'Method not found', ['status' => 500]);
    }

    $result = $utils->get_video($post_id);

    return rest_ensure_response($result);
}