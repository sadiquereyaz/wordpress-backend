<?php

add_action('rest_api_init', function () {
    register_rest_route('test', '/0', array(
        'methods' => 'GET',
        'callback' => 'get_test',
        'permission_callback' => function () {
            return is_user_logged_in(); // Adjust as needed
        }
    ));
});

use Tutor\Models\LessonModel;

function get_test($request)
{
    $course_id = 83;    // dlr 

    $user_id   = get_current_user_id();

    $post_id = 109;

    $utils = tutor_utils(); // Or however your code accesses this class

    if (!method_exists($utils, 'get_course_completed_percent')) {
        return new WP_Error('method_missing', 'Method not found', ['status' => 500]);
    }

    // $result = $utils->get_course_meta_data(83);

    // $result = $utils->get_total_course();

    // $result = $utils->get_total_enrolled_course();

    // $topic_id = 85;
    // $result = $utils->get_contents_by_topic($topic_id);

    // $result = $utils->get_enrolled_courses_by_user($user_id);

    // $result = $utils->course_with_materials();  // important

    // $result = $utils->course_progress_status_context($course_id, $user_id);

    // $course_id = 83;
    // $result = $utils->get_course_contents_by_id($course_id);

    // $result = $utils->get_assignments_by_course($course_id);

    // $result = $utils->most_popular_courses();

    // $result = $utils->get_video_stream_url();

    // $result = $utils->get_video($post_id);

    // $topics_id = 85; $limit = 500;
    // $result = $utils->get_course_contents_by_topic($topics_id, $limit);

    // $result = $utils->get_completed_lesson_count_by_course($course_id = 83, $user_id = 2);

    $result = LessonModel::mark_lesson_complete($lesson_id = 87, $user_id = 2);

    return rest_ensure_response($result);
}
