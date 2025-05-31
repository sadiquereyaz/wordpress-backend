<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/course/topics', array(
        'methods' => 'GET',
        'callback' => 'get_topic_by_course_id',
        'permission_callback' => function () {
            return is_user_logged_in(); // Adjust as needed
        },
        'args' => array(
            'course_id' => array(
                'required' => true,
                'validate_callback' => function ($param) {
                    return is_numeric($param);
                },
            ),
        )
    ));
});

function get_topic_by_course_id($request)
{
    $course_id = (int) $request->get_param('course_id'); 
    $user_id   = get_current_user_id();

    $utils = tutor_utils(); // Or however your code accesses this class

    if (!method_exists($utils, 'get_course_completed_percent')) {
        return new WP_Error('method_missing', 'Method not found', ['status' => 500]);
    }

    $result = $utils->get_topics(83);
    return rest_ensure_response($result);
}
