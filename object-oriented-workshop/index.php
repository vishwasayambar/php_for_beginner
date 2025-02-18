<?php
require 'vendor/autoload.php';
use src\Storage;


try {
    Storage::resolve()->put('test.txt', 'Hello World!');
} catch (Exception $e) {
    echo $e->getMessage();
}
