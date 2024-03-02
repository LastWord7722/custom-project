<?php

function dump($var)
{
    static $int=0;
    echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
    print_r($var);
    echo '</pre>';
    $int++;

}

function dumpDie($var)
{
    dump($var);
    die();
}