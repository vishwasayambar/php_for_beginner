<?php
require 'functions.php';
require 'database.php';

$db = new Database();
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);
$post = $db->query("SELECT * FROM posts where id = 1")->fetch(PDO::FETCH_ASSOC);

// If collection then use loop
foreach ($posts as $post) {
    echo "<li> $post[name] </li>";
}

//If only one record access direct
echo $post['name'];


require 'routes.php'; // Created Dedicated route file
