# Core PHP Routing Explained

## Basic Routing Concepts

Routing in core PHP is the process of directing HTTP requests to the appropriate handlers based on the URL. Here's how it works:

### 1. URL Processing

```php
// Get the URL path
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
```

This extracts the path portion of the URL:
- `http://localhost:8080/about` → `/about`
- `http://localhost:8080/contact?id=1` → `/contact`

### 2. Route Definition

Routes can be defined in two ways:

#### Using if/else statements (Basic Approach)
```php
if ($url === '/') {
    require 'controllers/index.php';
} else if ($url === '/about') {
    require 'controllers/about.php';
}
```

#### Using Associative Array (Better Approach)
```php
$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
];
```

### 3. Route Handling

```php
function routeToController($url, $routes) {
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
    } else {
        abort(404);
    }
}
```

### 4. Error Handling

```php
function abort($code = 404) {
    http_response_code($code);
    require "views/{$code}.php";
    die();
}
```

## Advanced Routing Features

### 1. URL Parameters
```php
// URL: /users/123
$routes = [
    '/users/{id}' => 'controllers/user.php'
];

function matchRoute($url, $route) {
    $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $route);
    return preg_match("#^$pattern$#", $url);
}
```

### 2. HTTP Method Handling
```php
$routes = [
    'GET' => [
        '/' => 'controllers/index.php',
    ],
    'POST' => [
        '/submit' => 'controllers/submit.php'
    ]
];

$method = $_SERVER['REQUEST_METHOD'];
```

### 3. Middleware Implementation
```php
function authenticate() {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        die();
    }
}

$routes = [
    '/dashboard' => [
        'controller' => 'controllers/dashboard.php',
        'middleware' => 'authenticate'
    ]
];
```

## Best Practices

1. **Separation of Concerns**
   - Keep routing logic separate from controllers
   - Use a dedicated routing file (e.g., `routes.php`)

2. **Clean URLs**
   - Use URL rewriting with `.htaccess`:
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^ index.php [QSA,L]
   ```

3. **Security Considerations**
   - Validate and sanitize URL parameters
   - Implement proper error handling
   - Use HTTPS for secure routes

## Example Project Structure

```
project/
├── controllers/
│   ├── index.php
│   ├── about.php
│   └── contact.php
├── views/
│   ├── 404.php
│   └── index.view.php
├── routes.php
└── index.php
```

## Common Functions

### URL Checker
```php
function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}
```

### Debug Helper
```php
function dd($value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
```

## Conclusion

Core PHP routing provides a foundation for building web applications without frameworks. While simple, it can be extended to handle complex routing scenarios through careful implementation of routing logic and proper organization of code.

Remember:
- Keep routes organized and maintainable
- Implement proper error handling
- Consider security implications
- Use URL rewriting for clean URLs
- Separate routing logic from business logic

---
**Happy Coding! 🚀** 