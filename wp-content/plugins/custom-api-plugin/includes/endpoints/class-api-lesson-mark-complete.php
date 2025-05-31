<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/lesson/mark-complete', array(
        'methods' => 'POST',
        'callback' => 'mark_lesson_complete',
        'permission_callback' => function () {
            return is_user_logged_in(); 
        },
        'args' => [
            'lesson_id' => [
                'required' => true,
                'type' => 'integer'
            ],
        ]
    ));
});

use Tutor\Models\LessonModel;

function mark_lesson_complete($request)
{
    $lesson_id = $request->get_param('lesson_id');
    $user_id =  get_current_user_id();

    if (! $lesson_id) {
        return new WP_REST_Response(['error' => 'Missing required parameters'], 400);
    }

    $result = LessonModel::mark_lesson_complete($lesson_id, $user_id);

    // good response format
    return new WP_REST_Response([
        'status' => 'success',
        'message' => 'Lesson marked as complete',
        'result' => $result,
    ], 200);
}