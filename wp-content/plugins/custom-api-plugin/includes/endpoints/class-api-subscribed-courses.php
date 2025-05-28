<?php

/**
 * Plugin Name: Custom API Plugin
 * Description: A simple plugin to create a custom API endpoint.
 * Version: 1.0.0
 */

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/subscribed-courses', [
        'methods' => 'GET',
        'callback' => 'myplugin_get_subscribed_courses_detailed',
        'permission_callback' => function () {
            return is_user_logged_in(); // JWT plugin sets current user automatically
        },
    ]);
});

function myplugin_get_subscribed_courses_detailed(WP_REST_Request $request)
{
    $user_id = get_current_user_id();

    if (!$user_id) {
        return new WP_Error('no_user', 'User not logged in', ['status' => 401]);
    }

    $course_ids = tutor_utils()->get_enrolled_courses_ids_by_user($user_id);

    $data = [];
    foreach ((array) $course_ids as $course_id) {
        $data[] = [
            'id' => $course_id,
            'title' => get_the_title($course_id),
            'link' => get_permalink($course_id),
            'thumbnail' => get_the_post_thumbnail_url($course_id),
            //'excerpt' => $course_post->post_excerpt,
            'duration' => get_tutor_course_duration_context($course_id),
            'instructor' => tutor_utils()->get_course_instructor_name($course_id),
            'progress' => (int) tutor_utils()->get_course_progress($course_id, $user_id),
            'is_completed' => tutor_utils()->is_completed_course($course_id, $user_id),
            'enrolled_date' => tutor_utils()->get_course_enroll_date($course_id, $user_id),
            'lesson_count' => $course_contents->lesson_count ?? 0,
            'rating' => $rating_data['rating_avg'] ?? 0,
            'price' => tutor_utils()->get_raw_course_price($course_id),
            'categories' => wp_get_post_terms($course_id, 'course-category', ['fields' => 'names']),
            //'categories' => $categories ? wp_list_pluck($categories, 'name') : []
        ];
    }

    return rest_ensure_response($data);
}