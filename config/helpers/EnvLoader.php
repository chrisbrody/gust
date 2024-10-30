<?php
// config/EnvLoader.php

class EnvLoader
{
    public static function load($file)
    {
        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Remove comments and trim whitespace
                $line = trim(preg_replace('/\s*#.*$/', '', $line));
                if (!empty($line)) {
                    list($key, $value) = explode('=', $line, 2);
                    putenv(trim($key) . '=' . trim($value)); // Set the environment variable
                    $_ENV[trim($key)] = trim($value); // Optional: Set it in the $_ENV array
                }
            }
        } else {
            throw new Exception("The .env file does not exist: " . $file);
        }
    }
}