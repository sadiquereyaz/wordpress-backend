<?php

/**
 * Registers a custom REST API endpoint for retrieving published courses.
 *
 * This endpoint is available at /wp-json/custom/v1/courses and returns a list of all published courses.
 * Each course includes details such as ID, title, excerpt, permalink, thumbnail URL, publish date,
 * instructor name, duration, price, categories, and full content.
 *
 * The endpoint is publicly accessible (no authentication required).
 *
 * @action rest_api_init Registers the custom REST route.
 * @function custom_api_get_courses Callback function to fetch and format course data.
 *
 * @param WP_REST_Request $request The REST API request object.
 * @return WP_REST_Response List of courses with relevant details, or an empty array if none found.
 */



add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/courses', array(
        'methods' => 'GET',
        'callback' => 'custom_api_get_courses',
        'permission_callback' => '__return_true',
    ));
});

function custom_api_get_courses(WP_REST_Request $request)
{
    $args = array(
        'post_type'      => 'courses',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if (is_wp_error($query)) {
        return new WP_REST_Response([
            'success' => false,
            'message' => 'Failed to retrieve courses.',
            'data'    => [],
        ], 500);
    }

    if (!$query->have_posts()) {
        return new WP_REST_Response([
            'success' => true,
            'message' => 'No courses found.',
            'data'    => [],
        ], 200);
    }

    $courses = [];

    foreach ($query->posts as $post) {
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $thumbnail_url = null;
        if ($thumbnail_id) {
            $thumbnail_url = wp_get_attachment_url($thumbnail_id);
        }
        $courses[] = array(
            'id'          => $post->ID,
            'title'       => get_the_title($post),
            // 'excerpt'     => get_the_excerpt($post),
            'link'        => get_permalink($post),
            'cover_url'   => $thumbnail_url,
            'thumbnail_resized'   => get_the_post_thumbnail_url($post->ID, 'medium'),
            'date'        => get_the_date('', $post),
            //'instructor'  => tutor_utils()->get_course_instructor_name($post->ID),
            'duration'    => wp_strip_all_tags(get_tutor_course_duration_context($post->ID)),
            'price'       => tutor_utils()->get_raw_course_price($post->ID),
            'categories'  => wp_get_post_terms($post->ID, 'course-category', array('fields' => 'names')),
            // 'content' => wp_strip_all_tags(apply_filters('the_content', $post->post_content)),
            'content' => apply_filters('the_content', $post->post_content),
        );
    }

    return new WP_REST_Response([
        'success' => true,
        'message' => 'Courses retrieved successfully.',
        'data'    => $courses,
    ], 200);
}