# PHP Configuration Management

## Understanding Configuration Files

Configuration files in PHP provide a clean way to manage application settings separately from the application logic. Here's how they work:

### 1. Basic Configuration Structure
```php
// config.php
return [
    'database' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'dbname' => 'learning',
        'charset' => 'utf8mb4'
    ],
    // Other configurations can be added here
];
```

## Key Concepts

### 1. Return vs Define
Two common approaches to configuration:

```php
// Approach 1: Using return (Recommended)
return [
    'key' => 'value'
];

// Approach 2: Using define (Less flexible)
define('CONFIG_KEY', 'value');
```

Benefits of using `return`:
- Allows for nested configurations
- Can be easily merged with other configs
- More flexible for testing and modification

### 2. Loading Configurations

```php
// Loading config file
$config = require 'config.php';

// Accessing values
$dbHost = $config['database']['host'];
```

### 3. Environment-Based Configuration

```php
// config/database.php
return [
    'development' => [
        'host' => 'localhost',
        'dbname' => 'dev_db'
    ],
    'production' => [
        'host' => 'prod.server.com',
        'dbname' => 'prod_db'
    ]
];
```

## Best Practices

### 1. Separation of Concerns
Organize configs by purpose:
```php
config/
├── database.php
├── mail.php
├── app.php
└── services.php
```

### 2. Environment Variables
Use environment variables for sensitive data:
```php
return [
    'database' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'password' => getenv('DB_PASSWORD')
    ]
];
```

### 3. Configuration Loading
Create a helper function:
```php
function config($key = null) {
    static $config;
    
    if ($config === null) {
        $config = require 'config.php';
    }
    
    return $key ? $config[$key] : $config;
}

// Usage:
$dbConfig = config('database');
```

## Controllers and Views

### 1. Basic Controller Structure
```php
// controllers/index.php
$heading = 'Home';
require 'views/index.view.php';
```

### 2. Passing Data to Views
```php
// Controller
$data = [
    'heading' => 'Home',
    'user' => $user
];

// View
extract($data); // Creates variables from array keys
```

## Security Considerations

1. **Never Include Sensitive Data**
   - Passwords
   - API keys
   - Secret tokens

2. **Use Environment Variables**
   ```php
   // .env
   DB_PASSWORD=secret

   // config.php
   'password' => getenv('DB_PASSWORD')
   ```

3. **Git Ignore**
   ```gitignore
   .env
   config/local.php
   ```

## Common Patterns

### 1. Configuration Merging
```php
$defaultConfig = require 'config/default.php';
$environmentConfig = require "config/{$env}.php";

$config = array_merge($defaultConfig, $environmentConfig);
```

### 2. Configuration Validation
```php
function validateConfig($config) {
    $required = ['host', 'dbname', 'username'];
    
    foreach ($required as $field) {
        if (!isset($config[$field])) {
            throw new Exception("Missing required config: {$field}");
        }
    }
}
```

### 3. Configuration Caching
```php
function getConfig() {
    $cachedConfig = '/path/to/cached/config.php';
    
    if (file_exists($cachedConfig)) {
        return require $cachedConfig;
    }
    
    $config = buildConfig();
    file_put_contents($cachedConfig, '<?php return ' . var_export($config, true) . ';');
    
    return $config;
}
```

## Conclusion

Good configuration management:
- Separates configuration from code
- Makes application more maintainable
- Improves security
- Facilitates different environments
- Makes testing easier

Remember to:
- Keep configurations simple
- Use environment variables for sensitive data
- Organize configs logically
- Cache when necessary
- Validate configuration values

---
**Happy Coding! 🚀** 