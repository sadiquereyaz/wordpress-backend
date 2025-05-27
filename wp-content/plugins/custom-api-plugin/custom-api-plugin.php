<?php

/**
 * Plugin Name: Custom API Plugin
 * Description: Registers multiple custom REST API endpoints.
 * Version: 1.0.0
 */

defined('ABSPATH') || exit;

// Include the loader
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-api-loader.php';

// Initialize all API endpoints
add_action('init', ['Custom_API_Loader', 'init_endpoints']);
