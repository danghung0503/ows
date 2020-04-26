<?php
use util\Router;

Router::post('/auth/sign-up', 'AuthController@signUp');
Router::post('/auth/login', 'AuthController@login');
Router::post('/auth/logout', 'AuthController@logout');
Router::get('/auth/detail', 'AuthController@detail');
Router::post('/auth/update', 'AuthController@update');
