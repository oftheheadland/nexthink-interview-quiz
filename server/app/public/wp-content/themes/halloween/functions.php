<?php
// return all Question fields in JSON format
function get_questions($request) {
    return 'Hello World';
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