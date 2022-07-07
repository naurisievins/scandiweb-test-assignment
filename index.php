<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {

    case '':
    case '/':
        require __DIR__ . '/views/list.php';
        break;

    case '/add-product':
        require __DIR__ . '/views/add.php';
        break;

    case '/data':
        require __DIR__ . '/views/data.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

?>