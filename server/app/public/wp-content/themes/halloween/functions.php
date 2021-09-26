<?php
// return all Question fields in JSON format
function get_questions($request) {    
    $quiz_fields = get_fields(14); // quiz page ID is 14 - get_fields() will return all ACF fields for that item
    $response = new WP_REST_Response($quiz_fields);
    $response->set_status(200);
    return $response;
}

// return all Character fields in JSON format
function get_characters($request) {
    $character_fields = array(get_fields(77), get_fields(61), get_fields(67), get_fields(58)); 
    $response = new WP_REST_Response($character_fields);
    $response->set_status(200);
    return $response;
}

add_action('rest_api_init', function () {
    register_rest_route( 'api', 'get_characters',array(
                    'methods'  => 'GET',
                    'callback' => 'get_characters'
        ));
    register_rest_route( 'api', 'get_questions',array(
            'methods'  => 'GET',
            'callback' => 'get_questions'
        ));
    });