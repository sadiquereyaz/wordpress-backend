<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/progress', array(
        'methods' => 'GET',
        'callback' => 'get_course_progress_percent',
        'permission_callback' => function () {
            return is_user_logged_in(); // Adjust as needed
        },
        'args' => [
            'course_id' => [
                'required' => true,
                'validate_callback' => 'is_numeric1'
            ],
            'user_id' => [
                'required' => false,
                'validate_callback' => 'is_numeric1'
            ],
            'stats' => [
                'required' => false,
                'default' => false,
            ],
        ],
    ));
});

function get_course_progress_percent($request)
{
    $course_id = (int) $request->get_param('course_id');
    $user_id   = $request->get_param('user_id');
    $get_stats = filter_var($request->get_param('stats'), FILTER_VALIDATE_BOOLEAN);

    if (empty($user_id)) {
        $user_id = get_current_user_id();
    }

    if (!function_exists('tutor')) {
        return new WP_Error('tutor_not_found', 'Tutor LMS not active', ['status' => 500]);
    }

    $utils = tutor_utils(); // Or however your code accesses this class

    if (!method_exists($utils, 'get_course_completed_percent')) {
        return new WP_Error('method_missing', 'Method not found', ['status' => 500]);
    }

    $result = $utils->get_course_completed_percent($course_id, $user_id, $get_stats);
    return rest_ensure_response($result);
}

function is_numeric1($value) {
    return is_numeric($value);
}