# PHP Superglobals

## Introduction
Superglobals are built-in PHP variables that are **always accessible**, regardless of scope. They allow you to retrieve and manipulate data such as user inputs, session data, environment variables, and more.

## List of PHP Superglobals

| Superglobal      | Description |
|-----------------|-------------|
| `$_GET`        | Collects data sent via URL query parameters (e.g., `?id=10`). |
| `$_POST`       | Collects data sent via form submission using the `POST` method. |
| `$_REQUEST`    | Contains both `$_GET` and `$_POST` values. |
| `$_SERVER`     | Provides server and execution environment details. |
| `$_FILES`      | Handles file uploads via forms. |
| `$_COOKIE`     | Stores cookies sent from the client to the server. |
| `$_SESSION`    | Stores session variables for tracking users across pages. |
| `$_ENV`        | Stores environment variables. |
| `$_GLOBALS`    | Stores all global variables. |

---

## 1. `$_GET` Example (URL Parameters)
```php
// URL: http://example.com/page.php?name=Sunny&age=30
echo "Hello, " . $_GET['name'];  // Output: Hello, Sunny
echo "Your age is " . $_GET['age'];  // Output: Your age is 30
```

---

## 2. `$_POST` Example (Form Submission)
```php
<!-- HTML Form -->
<form method="post" action="submit.php">
    <input type="text" name="username">
    <input type="submit" value="Submit">
</form>

<?php
// submit.php
echo "Welcome, " . $_POST['username'];
?>
```

---

## 3. `$_REQUEST` (Both GET & POST)
```php
echo $_REQUEST['username']; // Works for both GET & POST
```

---

## 4. `$_SERVER` Example
```php
echo $_SERVER['PHP_SELF'];   // Current script name
echo $_SERVER['HTTP_HOST'];  // Hostname
echo $_SERVER['REMOTE_ADDR']; // Visitor's IP Address
```

---

## 5. `$_FILES` (File Upload Handling)
```php
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="Upload">
</form>

<?php
// upload.php
move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
echo "File uploaded successfully!";
?>
```

---

## 6. `$_COOKIE` (Storing Data in the Browser)
```php
setcookie("username", "Sunny", time() + 3600, "/"); // Set a cookie
echo $_COOKIE['username']; // Output: Sunny
```

---

## 7. `$_SESSION` (User Tracking)
```php
session_start();
$_SESSION['user'] = 'Sunny';

echo $_SESSION['user']; // Output: Sunny
```

---

## 8. `$_ENV` (Environment Variables)
```php
echo $_ENV['PATH']; // Output system path
```

---

## 9. `$_GLOBALS` (Access Global Variables)
```php
$name = "Sunny";
function greet() {
    echo $_GLOBALS['name'];
}
greet(); // Output: Sunny
```

---

## Conclusion
PHP superglobals are essential for handling user input, managing sessions, interacting with servers, and retrieving system information. They are **predefined, accessible anywhere, and crucial** for PHP development.

---
**Happy Coding! 🚀**

