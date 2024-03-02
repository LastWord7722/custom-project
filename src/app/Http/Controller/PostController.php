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

    public function show2($post, $id)
    {
        dump($post);
        dump($id);
        dumpDie('show action2');
    }
}