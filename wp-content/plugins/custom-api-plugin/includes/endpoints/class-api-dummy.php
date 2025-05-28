<?php

add_action('rest_api_init', 'registerCustomEndpoints'); // Hook to register custom endpoints when the REST API is initialized


function registerCustomEndpoints()
{

    register_rest_route('custom/v1', '/dummy', array(     // endpoint URL: {base-url}/wp-json/custom/v1/dummy-data
        'methods' => 'GET',
        'callback' => 'custom_api_dummy_callback',     // Callback function to handle the request. a callback function is a function that is passed as an argument to another function.
        'permission_callback' => '__return_true', // Allow public access for demonstration
    ));
}

function custom_api_dummy_callback(WP_REST_Request $request)
{
    return new WP_REST_Response([
        'message' => 'Dummy endpoint works!',
        'userid' => get_current_user_id(),
        'timestamp' => current_time('mysql')
    ], 200);
}