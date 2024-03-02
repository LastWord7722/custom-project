<?php

use App\Http\Controller\PostController;
use App\RMVC\Route\Router;

Router::get('/post', [PostController::class, 'index']);
Router::get('/post/{slug}', [PostController::class, 'show']);
Router::get('/post/{slug}/for/{id}', [PostController::class, 'show2']);
