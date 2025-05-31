<?php

/**
 * Simplified REST API endpoint for Tutor LMS to fetch course lessons and study materials
 * Returns only lessons with video links, completion status, and study materials
 */

// Register the custom REST API route
add_action('rest_api_init', 'register_tutor_course_lessons_endpoint');

function register_tutor_course_lessons_endpoint()
{
    register_rest_route('tutor/v1', '/course/(?P<id>\d+)/lessons', array(
        'methods' => 'GET',
        'callback' => 'get_tutor_course_lessons1',
        'permission_callback' => 'tutor_course_lessons_permissions_check1',
        'args' => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
}

// Permission callback - modify as needed
function tutor_course_lessons_permissions_check1($request)
{
    // $yId = tutor_utils()-> get_youtube_video_id("<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/oMfuX_bhrDw?si=Lh_dz0bFi3gFofIl\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>");
    //echo "\nyoutube id is: $yId\n";

    //echo "${tutor_utils()-> get_enrolled_data(5)}";
    // Require user to be logged in to check completion status

    // $firstLesson = tutor_utils()-> get_course_completed_percent();
    //echo "get_course_completed_percent: $firstLesson";
    
    return is_user_logged_in();

    // Alternative: Allow public access but completion status will be null
    // return true;
}

// Helper function to get video URL from lesson
function get_lesson_video_url1($lesson_id)
{
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
function is_lesson_completed1($lesson_id, $user_id = null)
{
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
function get_lesson_study_materials1($lesson_id)
{
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
function get_tutor_course_lessons1($request)
{
    return tutor_utils()->get_course_completed_percent();
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

            if ($lessons) {
                foreach ($lessons as $lesson) {
                    $video_url = get_lesson_video_url1($lesson->ID);
                    $is_completed = is_lesson_completed1($lesson->ID, $user_id);
                    $study_materials = get_lesson_study_materials1($lesson->ID);

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
    usort($response_data['lessons'], function ($a, $b) {
        if ($a['topic_id'] == $b['topic_id']) {
            return intval($a['lesson_order']) - intval($b['lesson_order']);
        }
        return $a['topic_id'] - $b['topic_id'];
    });

    // Add summary statistics
    $response_data['summary'] = array(
        'total_lessons' => count($response_data['lessons']),
        'completed_lessons' => count(array_filter($response_data['lessons'], function ($lesson) {
            return $lesson['is_completed'] === true;
        })),
        'total_study_materials' => count($response_data['study_materials']),
        'completion_percentage' => count($response_data['lessons']) > 0
            ? round((count(array_filter($response_data['lessons'], function ($lesson) {
                return $lesson['is_completed'] === true;
            })) / count($response_data['lessons'])) * 100, 2)
            : 0
    );

    return rest_ensure_response($response_data);
}

// Optional: Add CORS headers if needed
add_action('rest_api_init', function () {
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
    add_filter('rest_pre_serve_request', function ($value) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        return $value;
    });
});

/**
 * Usage Examples:
 * 
 * 1. Fetch course lessons and study materials:
 *    GET /wp-json/tutor/v1/course/123/lessons
 * 
 * 2. Example response structure:
 *    {
 *        "course_id": 123,
 *        "course_title": "My Course",
 *        "lessons": [
 *            {
 *                "lesson_id": 456,
 *                "lesson_name": "Introduction to PHP",
 *                "video_url": "https://youtube.com/watch?v=abc123",
 *                "video_source": "youtube",
 *                "is_completed": true,
 *                "topic_id": 789,
 *                "topic_name": "Getting Started",
 *                "lesson_order": 1,
 *                "is_preview": false,
 *                "study_materials": [
 *                    {
 *                        "id": 101,
 *                        "title": "PHP Cheat Sheet",
 *                        "filename": "php-cheat-sheet.pdf",
 *                        "url": "https://example.com/wp-content/uploads/file.pdf",
 *                        "type": "application/pdf",
 *                        "size": "2.5 MB"
 *                    }
 *                ]
 *            }
 *        ],
 *        "study_materials": [
 *            {
 *                "id": 101,
 *                "title": "PHP Cheat Sheet",
 *                "filename": "php-cheat-sheet.pdf",
 *                "url": "https://example.com/wp-content/uploads/file.pdf",
 *                "type": "application/pdf",
 *                "size": "2.5 MB",
 *                "lesson_id": 456,
 *                "lesson_name": "Introduction to PHP"
 *            }
 *        ],
 *        "summary": {
 *            "total_lessons": 10,
 *            "completed_lessons": 7,
 *            "total_study_materials": 15,
 *            "completion_percentage": 70
 *        }
 *    }
 * 
 * 3. Error responses:
 *    - 404: Course not found
 *    - 403: User not enrolled (if enrollment check is enabled)
 *    - 401: User not logged in (if authentication is required)
 */
