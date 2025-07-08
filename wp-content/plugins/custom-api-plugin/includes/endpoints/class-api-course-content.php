<?php

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/course/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'get_course_topics_with_lessons',
        'permission_callback' => function () {
            return true;
            // return is_user_logged_in();
        },
    ]);
});

function get_course_topics_with_lessons($request)
{
    $course_id = $request['id'];
    $user_id = get_current_user_id();

    $utils = tutor_utils();
    $topics_query = $utils->get_topics($course_id);

    if (empty($topics_query->posts)) {
        return new WP_REST_Response([
            'success' => false,
            'message' => 'No topics found for this course.',
            'data'    => [],
        ], 404);
    }

    $result = [];

    foreach ($topics_query->posts as $topic) {
        $topic_id = $topic->ID;
        $topic_title = $topic->post_title;

        $contents_query = $utils->get_course_contents_by_topic($topic_id, -1);

        if (empty($contents_query) || empty($contents_query->posts)) {
            continue; // Skip if no lessons found for this topic
        }

        $lessons = [];

        foreach ($contents_query->posts as $content) {
            $lesson_id = $content->ID;
            $is_completed = $utils->is_completed_lesson($lesson_id, $user_id);

            $study_materials = get_lesson_study_materials($lesson_id);
            // if (!$study_materials || empty($study_materials)) {
            //     $study_materials = null;
            // }

            $youtube_video_id = get_youtube_video_id_from_lesson($lesson_id);

            $lessons[] = [
                'id' => $lesson_id,
                'title' => $content->post_title,
                'is_completed' => (bool)$is_completed,
                'youtube_video_id' => $youtube_video_id,
                'study_materials' => $study_materials,
            ];
        }


        $result[] = [
            'topic_id' => $topic_id,
            'topic_title' => $topic_title,
            'lessons' => $lessons,
        ];
    }
    return new WP_REST_Response([
        'success' => true,
        'message' => 'Course topics and lessons retrieved successfully.',
        'data'    => $result,
    ], 200);
}


/**
 * Get YouTube video ID from a lesson ID, else return null.
 *
 * @param int $lesson_id
 * @return string|null
 */
function get_youtube_video_id_from_lesson($lesson_id)
{
    $utils = tutor_utils();
    $video_url = $utils->get_video($lesson_id);

    if (is_array($video_url) && !empty($video_url['source'])) {
        $youtube_link = null;

        if (isset($video_url['source_youtube'])) {
            $youtube_link = $video_url['source_youtube'];
        } elseif (isset($video_url['source_vimeo'])) {
            $youtube_link = $video_url['source_vimeo'];
        } elseif (isset($video_url['source_html5'])) {
            $youtube_link = $video_url['source_html5'];
        } elseif (isset($video_url['source_external_url'])) {
            $youtube_link = $video_url['source_external_url'];
        } elseif (isset($video_url['source_embedded'])) {
            $youtube_link = $video_url['source_embedded'];
        }

        if (!empty($youtube_link)) {
            return $utils->get_youtube_video_id($youtube_link);
        }
    }

    return null;
}

// Helper function to get study materials (attachments) for a lesson
function get_lesson_study_materials($lesson_id)
{
    $attachments = tutor_utils()->get_attachments($lesson_id);
    $materials = array();

    if ($attachments && is_array($attachments)) {
        foreach ($attachments as $item) {

            // Ensure $url is a string
            if (is_object($item) && isset($item->url)) {
                $url = $item->url;
            } elseif (is_array($item) && isset($item['url'])) {
                $url = $item['url'];
            } elseif (is_string($item)) {
                $url = $item;
            } else {
                continue; // Skip invalid item
            }

            $attachment_id = attachment_url_to_postid($url);

            if ($attachment_id) {
                $file_path = get_attached_file($attachment_id);
                $materials[] = array(
                    'id' => $attachment_id,
                    'title' => get_the_title($attachment_id),
                    'filename' => basename($file_path),
                    'url' => $url,
                    'type' => get_post_mime_type($attachment_id),
                    'size' => file_exists($file_path) ? size_format(filesize($file_path)) : 'Unknown',
                );
            }
        }
    }

    return $materials;
}