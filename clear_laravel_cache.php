<?php
header('Content-Type: text/plain');

$cache_dir = '/home/u466475909/domains/bhandaripackersandmovers.in/ServiceHub/bootstrap/cache';

echo "=== Laravel Cache Cleaner ===\n\n";

if (!is_dir($cache_dir)) {
    // Try relative path fallback if absolute path differs
    $cache_dir = __DIR__ . '/../ServiceHub/bootstrap/cache';
}

if (is_dir($cache_dir)) {
    echo "Found cache directory at: $cache_dir\n";
    $files = glob($cache_dir . '/*.php');
    if (empty($files)) {
        echo "No cached php files found.\n";
    } else {
        foreach ($files as $file) {
            if (unlink($file)) {
                echo "✅ Deleted: " . basename($file) . "\n";
            } else {
                echo "❌ Failed to delete: " . basename($file) . "\n";
            }
        }
    }
} else {
    echo "❌ Cache directory not found. Checked:\n";
    echo "1. /home/u466475909/domains/bhandaripackersandmovers.in/ServiceHub/bootstrap/cache\n";
    echo "2. " . __DIR__ . "/../ServiceHub/bootstrap/cache\n";
}
