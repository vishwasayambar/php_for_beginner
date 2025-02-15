# PHP Database Connection with PDO

## Understanding the Database Class

The Database class provides a wrapper for PDO (PHP Data Objects) database connections and queries. Here's a detailed breakdown:

### 1. Class Structure
```php
class Database {
    public $connection;
    
    function __construct() {
        $this->connection = new PDO(/* connection details */);
    }
    
    public function query($query) {
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }
}
```

### 2. PDO Connection String Anatomy
```php
'mysql:host=127.0.0.1;port=3306;dbname=learning;charset=utf8mb4'
```
- `mysql:` - Database driver
- `host=127.0.0.1` - Database host (localhost)
- `port=3306` - MySQL default port
- `dbname=learning` - Database name
- `charset=utf8mb4` - Character encoding

## Best Practices

### 1. Error Handling
Enhanced version with error handling:
```php
class Database {
    public $connection;
    
    function __construct() {
        try {
            $this->connection = new PDO(
                'mysql:host=127.0.0.1;port=3306;dbname=learning;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
```

### 2. Query Methods
Different ways to fetch data:
```php
// Fetch all records
$statement->fetchAll(PDO::FETCH_ASSOC);

// Fetch single record
$statement->fetch(PDO::FETCH_ASSOC);

// Fetch column
$statement->fetchColumn();
```

### 3. Prepared Statements
Secure way to handle parameters:
```php
public function query($query, $params = []) {
    $statement = $this->connection->prepare($query);
    $statement->execute($params);
    return $statement;
}

// Usage:
$db->query("SELECT * FROM users WHERE id = ?", [$id]);
// OR
$db->query("SELECT * FROM users WHERE id = :id", ['id' => $id]);
```

## Common Usage Examples

### 1. Select Query
```php
// Fetch all users
$users = $db->query("SELECT * FROM users")->fetchAll();

// Fetch single user
$user = $db->query("SELECT * FROM users WHERE id = 1")->fetch();
```

### 2. Insert Query
```php
$db->query("INSERT INTO users (name, email) VALUES (?, ?)", [
    'John Doe',
    'john@example.com'
]);
```

### 3. Update Query
```php
$db->query("UPDATE users SET name = ? WHERE id = ?", [
    'Jane Doe',
    1
]);
```

### 4. Delete Query
```php
$db->query("DELETE FROM users WHERE id = ?", [1]);
```

## Security Considerations

1. **Never Trust User Input**
   - Always use prepared statements
   - Never concatenate SQL strings directly

2. **Password Security**
   - Store database credentials securely
   - Use environment variables for sensitive data
   ```php
   $host = getenv('DB_HOST');
   $user = getenv('DB_USER');
   $pass = getenv('DB_PASS');
   ```

3. **Connection Settings**
   - Set appropriate character encoding
   - Configure error reporting
   - Set fetch modes

## Environment Configuration

### 1. Development
```php
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
```

### 2. Production
```php
error_reporting(0);
ini_set('display_errors', '0');
```

## Common PDO Constants

```php
PDO::FETCH_ASSOC    // Returns array indexed by column name
PDO::FETCH_NUM      // Returns array indexed by column number
PDO::FETCH_BOTH     // Returns array indexed by both column name and number
PDO::FETCH_OBJ      // Returns object with column names as properties
```

## Troubleshooting

Common issues and solutions:

1. **Connection Failed**
   - Check host, port, and credentials
   - Verify database exists
   - Check MySQL service is running

2. **Query Failed**
   - Verify SQL syntax
   - Check table and column names
   - Ensure proper parameter binding

3. **Character Encoding Issues**
   - Set proper charset in connection string
   - Check database and table collation

## Conclusion

The Database class provides a simple yet powerful wrapper around PDO, offering:
- Secure database connections
- Prepared statements for safety
- Flexible query execution
- Easy result fetching

Remember to:
- Always use prepared statements
- Handle errors appropriately
- Configure for your environment
- Keep security in mind

---
**Happy Coding! 🚀** 