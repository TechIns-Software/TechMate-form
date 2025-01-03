<?php
try {
    $dotenvPath = __DIR__ . '/.env';

    if (!is_readable($dotenvPath)) {
        throw new Exception('Could not initialize environment');
    }

    $file = fopen($dotenvPath, 'r');
    if ($file) {
        while (($line = fgets($file)) !== false) {
            if (empty($line) || $line[0] === '#') {
                continue;
            }
            $parts = explode('=', $line, 2);
            if (count($parts) != 2) {
                throw new Exception('Invalid line in .env file: ' . $line);
            }
            list($name, $value) = $parts;
            $name = trim($name);
            $value = trim($value);
            $value = trim($value, "'\"");
            $value = rtrim($value, "'\"");
            if (!preg_match('/^[A-Z_]+$/', $name) || false === $value) {
                throw new Exception('Invalid line in .env file: ' . $line);
            }
            $_ENV[$name] = $value;
        }
        fclose($file);
    } else {
        throw new Exception('Could not open .env file');
    }
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage()
    ]);
    exit;
}