<?php

function format_json($response) {
    header('Content-type: application/json; charset=UTF-8');
    return json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

function u($string="") {
    return urlencode($string);
}

function h($string="") {
    return htmlspecialchars($string);
}





function redirect_to($location) {
    header('Location: '.$location);
    exit();
}

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

?>