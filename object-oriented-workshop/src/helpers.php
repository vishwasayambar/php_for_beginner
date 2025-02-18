<?php

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable with a default fallback
     *
     * @param string $key The environment variable name
     * @param mixed $default The default value if environment variable is not set
     * @return mixed
     */
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('config')) {
    /**
     * Gets a configuration value from config files
     *
     * @param string $key Dot notation key (e.g., 'aws.s3_key')
     * @param mixed $default Default value if key not found
     * @return mixed
     */
    function config($key, $default = null)
    {
        $configPath = dirname(__DIR__) . '/config/app.php';
        $config = require $configPath;

        $keys = explode('.', $key);
        $value = $config;

        foreach ($keys as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}

if (!function_exists('base_path')) {
    /**
     * Get the project root path
     *
     * @param string $path Additional path to append
     * @return string
     */
    function base_path($path = '')
    {
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
} 