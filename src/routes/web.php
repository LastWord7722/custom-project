<?php

use App\Http\Controller\PostController;
use App\RMVC\Route\Router;

Router::get('/post/{slug}', [PostController::class, 'index']);