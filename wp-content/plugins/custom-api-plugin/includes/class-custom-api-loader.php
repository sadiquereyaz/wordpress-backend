<?php

class Custom_API_Loader
{

    public static function init_endpoints()
    {
        //echo 'Custom API Plugin: Initializing endpoints';

        $base_path = plugin_dir_path(__FILE__) . 'endpoints/';

        require_once $base_path . 'class-api-dummy.php';
        require_once $base_path . 'class-api-posts.php';
        require_once $base_path . 'class-api-products.php';
        //require_once $base_path . 'class-api-courses.php';

        // Each file will register its own endpoint
    }
}
