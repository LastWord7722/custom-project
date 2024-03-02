<?php

namespace App\Http\Controller;

class PostController extends Controller
{
    public function index()
    {
        dumpDie('index action');
    }

    public function show($post)
    {
        dump($post);
        dumpDie('show action');
    }
}