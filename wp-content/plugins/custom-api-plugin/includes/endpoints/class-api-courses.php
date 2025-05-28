<?php

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
        'post_type'      => 'courses', // Adjust if your LMS uses a different slug (e.g., 'lp_course' for LearnPress)
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return new WP_REST_Response([], 200);
    }

    $courses = [];

    foreach ($query->posts as $post) {
        $courses[] = array(
            'id'          => $post->ID,
            'title'       => get_the_title($post),
            'excerpt'     => get_the_excerpt($post),
            'link'        => get_permalink($post),
            'thumbnail'   => get_the_post_thumbnail_url($post->ID, 'medium'),
            'date'        => get_the_date('', $post),
            'instructor'  => get_post_meta($post->ID, 'instructor_name', true), 
            'duration'    => get_post_meta($post->ID, 'course_duration', true), 
            // 'lesson_count' => count(get_post_meta($post->ID, 'lessons', true)), 
            'rating'      => get_post_meta($post->ID, 'course_rating', true), 
            'price'       => get_post_meta($post->ID, 'course_price', true), 
            'categories'  => wp_get_post_terms($post->ID, 'course-category', array('fields' => 'names')), 
            'tags'        => wp_get_post_terms($post->ID, 'course-tag', array('fields' => 'names')), 
            'content'     => apply_filters('the_content', $post->post_content), // Get the full content of the course
            // 'meta'        => get_post_meta($post->ID), // Get all meta data for the course
            
        );
    }

    return new WP_REST_Response($courses, 200);
}