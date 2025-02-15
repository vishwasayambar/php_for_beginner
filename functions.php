<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

dd($_SERVER['REQUEST_URI']);

//To get to know that given url is same current url or not?
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}