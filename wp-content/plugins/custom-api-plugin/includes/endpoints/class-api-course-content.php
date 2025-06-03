<?php


add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/course/(?P<id>\d+)', [
        'methods' => 'GET',
        // 'callback' => 'get_tutor_course_lessons',
        // 'callback' => 'get_course_details_by_id',
        // 'callback' => 'get_all_course_lessons',    // M-3
        'callback' => 'get_all_course_lessons_and_video',    // M-4
        'permission_callback' => function () {
            //check_tutor_functions();
            return is_user_logged_in(); 
        },
    ]);
});

function get_course_details_by_id($data)
{
    $course_id = (int) $data['id'];
    //echo "course id $course_id";

    if (get_post_type($course_id) !== 'courses') {
        return new WP_REST_Response([
            'status' => 'error',
            'message' => 'Invalid course ID.'
        ], 404);
    }

    $course = get_post($course_id);
    //echo "\npost: $course\n";

    //$course_meta = tutor_course_meta_info($course_id);
    //$instructor_ids = tutor_utils()->get_course_instructors_ids_by_course($course_id);
    /* $instructors = array_map(function ($id) {
        $user = get_userdata($id);
        return [
            'id' => $id,
            'name' => $user->display_name,
            'email' => $user->user_email
        ];
    }, $instructor_ids); */

    $lessons = tutor_utils()->get_course_contents_by_course($course_id);

    return new WP_REST_Response([
        'id' => $course->ID,
        'title' => $course->post_title,
        'content' => apply_filters('the_content', $course->post_content),
        'excerpt' => get_the_excerpt($course),
        //'instructors' => $instructors,
        //'meta' => $course_meta,
        'lessons' => $lessons,
        'featured_image' => get_the_post_thumbnail_url($course_id, 'full')
    ], 200);
}

function check_tutor_functions()
{
    $functions_to_check = array(
        // Definitely should exist
        'get_topics' => 'tutor_utils()->get_topics(123)',
        'get_lesson_count_by_course' => 'tutor_utils()->get_lesson_count_by_course(123)',
        'get_quiz_count_by_course' => 'tutor_utils()->get_quiz_count_by_course(123)',
        'count_enrolled_users_by_course' => 'tutor_utils()->count_enrolled_users_by_course(123)',
        'get_course_rating' => 'tutor_utils()->get_course_rating(123)',
        'get_course_reviews_count' => 'tutor_utils()->get_course_reviews_count(123)',
        'get_course_duration_context' => 'tutor_utils()->get_course_duration_context(123)',
        'get_course_contents_by_topic' => 'tutor_utils()->get_course_contents_by_topic(123, "courses")',
        'get_video_url' => 'tutor_utils()->get_video_url(123)',
        'get_attachments' => 'tutor_utils()->get_attachments(123)',
        'profile_url' => 'tutor_utils()->profile_url(1, false)',
        'get_quiz_option' => 'tutor_utils()->get_quiz_option(123, "time_limit")',

        // These might not exist - need alternatives
        'get_assignments_count_by_course' => 'tutor_utils()->get_assignments_count_by_course(123)',
        'get_assignment_option' => 'tutor_utils()->get_assignment_option(123, "total_mark")',
    );

    echo "<h3>Tutor LMS Function Availability Check:</h3>";

    foreach ($functions_to_check as $func_name => $func_call) {
        $method_name = explode('()->', $func_call)[1] ?? '';
        $method_name = explode('(', $method_name)[0];

        if (method_exists(tutor_utils(), $method_name)) {
            echo "✅ <strong>{$func_name}</strong>: Available<br>";
        } else {
            echo "❌ <strong>{$func_name}</strong>: NOT FOUND - Need alternative<br>";
        }
    }
}



// Permission callback - modify as needed
function tutor_course_lessons_permissions_check($request) {
    // Require user to be logged in to check completion status
    return is_user_logged_in();
    
    // Alternative: Allow public access but completion status will be null
    // return true;
}

// Helper function to get video URL from lesson
function get_lesson_video_url($lesson_id) {
    $video_source = get_post_meta($lesson_id, '_video_source', true);
    
    switch ($video_source) {
        case 'youtube':
            return get_post_meta($lesson_id, '_video_source_youtube', true);
        case 'vimeo':
            return get_post_meta($lesson_id, '_video_source_vimeo', true);
        case 'embedded':
            return get_post_meta($lesson_id, '_video_source_embedded', true);
        case 'html5':
            $html5_sources = get_post_meta($lesson_id, '_video_source_html5', true);
            return is_array($html5_sources) && !empty($html5_sources) ? $html5_sources[0] : '';
        case 'external_url':
            return get_post_meta($lesson_id, '_video_source_external_url', true);
        default:
            return '';
    }
}

// Helper function to check if lesson is completed by current user
function is_lesson_completed($lesson_id, $user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    if (!$user_id) {
        return null; // User not logged in
    }
    
    global $wpdb;
    
    $completed = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->usermeta} 
         WHERE user_id = %d 
         AND meta_key = '_tutor_lesson_completed_%d'",
        $user_id,
        $lesson_id
    ));
    
    return $completed > 0;
}

// Helper function to get study materials (attachments) for a lesson
function get_lesson_study_materials($lesson_id) {
    $attachments = tutor_utils()->get_attachments($lesson_id);
    $materials = array();
    
    if ($attachments && is_array($attachments)) {
        foreach ($attachments as $attachment) {
            $materials[] = array(
                'id' => $attachment->ID,
                'title' => $attachment->post_title,
                'filename' => basename(get_attached_file($attachment->ID)),
                'url' => wp_get_attachment_url($attachment->ID),
                'type' => get_post_mime_type($attachment->ID),
                'size' => size_format(filesize(get_attached_file($attachment->ID))),
            );
        }
    }
    
    return $materials;
}

// Main callback function to fetch course lessons
function get_tutor_course_lessons($request) {
    $course_id = $request['id'];
    $user_id = get_current_user_id();
    
    // Check if the course exists and is published
    $course = get_post($course_id);
    
    if (!$course || $course->post_type !== 'courses' || $course->post_status !== 'publish') {
        return new WP_Error('course_not_found', 'Course not found', array('status' => 404));
    }
    
    // Check if user is enrolled (optional - remove if not needed)
    if ($user_id && !tutor_utils()->is_enrolled($course_id, $user_id)) {
        return new WP_Error('not_enrolled', 'User is not enrolled in this course', array('status' => 403));
    }
    
    $response_data = array(
        'course_id' => $course_id,
        'course_title' => $course->post_title,
        'lessons' => array(),
        'study_materials' => array()
    );
    
    // Get course topics
    $topics = tutor_utils()->get_topics($course_id);


    if ($topics && is_array($topics)) {
        foreach ($topics as $topic) {
            // Get lessons under this topic
            $lessons = tutor_utils()->get_course_contents_by_topic($topic->ID, tutor()->lesson_post_type);
            //echo "lessons: $lessons\n";
            //return rest_ensure_response($lessons);

            if ($lessons) {
                foreach ($lessons as $lesson) {
                    $video_url = get_lesson_video_url($lesson->ID);
                    $is_completed = is_lesson_completed($lesson->ID, $user_id);
                    $study_materials = get_lesson_study_materials($lesson->ID);
                    
                    $lesson_data = array(
                        'lesson_id' => $lesson->ID,
                        'lesson_name' => $lesson->post_title,
                        'video_url' => $video_url,
                        'video_source' => get_post_meta($lesson->ID, '_video_source', true),
                        'is_completed' => $is_completed,
                        'topic_id' => $topic->ID,
                        'topic_name' => $topic->post_title,
                        'lesson_order' => get_post_meta($lesson->ID, '_tutor_lesson_order', true),
                        'is_preview' => get_post_meta($lesson->ID, '_is_preview', true) === 'yes',
                        'study_materials' => $study_materials
                    );
                    
                    $response_data['lessons'][] = $lesson_data;
                    
                    // Add study materials to main array if they exist
                    if (!empty($study_materials)) {
                        foreach ($study_materials as $material) {
                            $material['lesson_id'] = $lesson->ID;
                            $material['lesson_name'] = $lesson->post_title;
                            $response_data['study_materials'][] = $material;
                        }
                    }
                }
            }
        }
    }
    
    // Sort lessons by topic and lesson order
    usort($response_data['lessons'], function($a, $b) {
        if ($a['topic_id'] == $b['topic_id']) {
            return intval($a['lesson_order']) - intval($b['lesson_order']);
        }
        return $a['topic_id'] - $b['topic_id'];
    });
    
    // Add summary statistics
    $response_data['summary'] = array(
        'total_lessons' => count($response_data['lessons']),
        'completed_lessons' => count(array_filter($response_data['lessons'], function($lesson) {
            return $lesson['is_completed'] === true;
        })),
        'total_study_materials' => count($response_data['study_materials']),
        'completion_percentage' => count($response_data['lessons']) > 0 
            ? round((count(array_filter($response_data['lessons'], function($lesson) {
                return $lesson['is_completed'] === true;
            })) / count($response_data['lessons'])) * 100, 2) 
            : 0
    );
    
    return rest_ensure_response($response_data);
}


// M-3
function get_all_course_lessons($request) {
    $course_id = $request['id'];

    $utils = tutor_utils();
    $result = $utils->get_course_contents_by_id($course_id);
    
    return rest_ensure_response($result);
}



// M-4
function get_all_course_lessons_and_video($request) {
    $course_id = $request['id'];
    $user_id = get_current_user_id();

    $utils = tutor_utils();
    $result = $utils->get_course_contents_by_id($course_id); // Get all lessons

    // Add video URLs to each lesson
    foreach ($result as &$lesson) {
        $video_url = $utils->get_video($lesson->ID);
        $is_completed = $utils->is_completed_lesson($lesson->ID, $user_id);
        

        $lesson->video_url = $video_url;
        //$lesson->is_completed = is_lesson_completed($lesson->ID);
        $lesson->is_completed = ($is_completed) ? true : false;
        $lesson->study_materials = get_lesson_study_materials($lesson->ID);
    }

    return rest_ensure_response($result);
}