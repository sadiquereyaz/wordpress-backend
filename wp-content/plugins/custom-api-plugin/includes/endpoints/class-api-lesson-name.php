<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/course/lesson-by-topic', array(
        'methods' => 'GET',
        'callback' => 'get_test',
        'permission_callback' => function () {
            return is_user_logged_in(); // Adjust as needed
        },
        'args' => array(
            'topic_id' => array(
                'required' => true,
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                },
            ),
        ),
    ));
});

function get_lesson_name_by_topic_id($request)
{
    global $wpdb;
    $topic_id = (int) $request->get_param('topic_id');

    $contents = $wpdb->get_results(
        $wpdb->prepare(
            " SELECT *
                FROM {$wpdb->posts} AS topics
                    INNER JOIN {$wpdb->posts} AS content
                        ON content.post_parent = topics.ID
                WHERE topics.post_type = 'topics'
                    AND topics.ID = %d
                    AND content.post_status = %s
            ",
            $topic_id,
            'publish'
        )
    );
    return rest_ensure_response($contents);
}
