<?php
require 'functions.php';
require 'database.php';


$config = require 'config.php';
$db = new Database($config['database']);

/*
 * SQL Injection Vulnerabilities Explained
 *
 * Never use user input directly in an inline SQL query.
 *
 * Example of Vulnerability:
 * -------------------------
 * Suppose we get an 'id' parameter from the URL:
 * $id = $_GET['id'];  // Example: xyz.com/?id=2 OR 1
 *
 * If we construct a query like this:
 * dd("SELECT * FROM posts WHERE id = {$id}");
 *
 * This could result in:
 * "SELECT * FROM posts WHERE id = 2 OR 1"
 *
 * The issue arises when a malicious user injects SQL, e.g.:
 * xyz.com/?id=2; DROP TABLE users;
 *
 * This would execute:
 * "SELECT * FROM posts WHERE id = 2; DROP TABLE users;"
 * causing the entire 'users' table to be deleted.
 *
 * $post = $db->query("SELECT * FROM posts WHERE id = {$id}")->fetch();
 *
 * Best Practice:
 * -------------------------
 * Always use prepared statements or parameterized queries to prevent SQL injection.
 */

/*
 * Preventing SQL Injection: Two Safe Methods
 *
 * Instead of using inline user input in queries, use prepared statements.
 * Below are two secure options:
 *
 * Option 1: Using "?" (Positional Placeholder)
 * ---------------------------------------------
 * $id = $_GET['id'];
 * $query = "SELECT * FROM posts WHERE id = ?";
 * $post = $db->query($query, [$id])->fetch();
 *
 * Option 2: Using ":param" (Named Placeholder)
 * ---------------------------------------------
 * $id = $_GET['id'];
 * $query = "SELECT * FROM posts WHERE id = :id";
 * $post = $db->query($query, [':id' => $id])->fetch();
 *
 * Both options prevent SQL injection by ensuring user input is properly escaped.
 */

$id = $_GET['id'];
$query = "SELECT * FROM posts where id = ? ";
$post = $db->query($query, [$id])->fetch();




//$posts = $db->query("SELECT * FROM posts")->fetchAll();
//$post = $db->query("SELECT * FROM posts where id = 1")->fetch();
//
//// If collection then use loop
//foreach ($posts as $post) {
//    echo "<li> $post[name] </li>";
//}

//If only one record access direct
echo $post['name'];


require 'routes.php'; // Created Dedicated route file
