<?php

$router->set404('ErrorController@notFound');

$router->get('/', function() {
    echo 'Welcome to Byakugan v2.0';
});

$router->get('/about', 'ExampleController@show');
