<?php
// return all Question fields in JSON format
function get_questions($request) {    
    $quiz_fields = get_fields(14); // quiz page ID is 14 - get_fields() will return all ACF fields for that item
    $response = new WP_REST_Response($quiz_fields);
    $response->set_status(200);
    return $response;
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'get_questions',array(
                  'methods'  => 'GET',
                  'callback' => 'get_questions'
        ));
    });

// return all Character fields in JSON format
function get_characters($request) {
    return 'Hello World';
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'get_characters',array(
                    'methods'  => 'GET',
                    'callback' => 'get_characters'
        ));
    });