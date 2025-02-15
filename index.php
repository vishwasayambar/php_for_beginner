<?php
require 'functions.php';
require 'database.php';


$config = require 'config.php';
$db = new Database($config['database']);
$posts = $db->query("SELECT * FROM posts")->fetchAll();
$post = $db->query("SELECT * FROM posts where id = 1")->fetch();

// If collection then use loop
foreach ($posts as $post) {
    echo "<li> $post[name] </li>";
}

//If only one record access direct
echo $post['name'];


require 'routes.php'; // Created Dedicated route file
