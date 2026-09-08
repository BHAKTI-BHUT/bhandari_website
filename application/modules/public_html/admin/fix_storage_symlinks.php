<?php
// Standalone Storage & Upload Symlink/Directory Fixer
// Executed via: https://bhandaripackersandmovers.in/admin/fix_storage_symlinks.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$currentPublicDir = __DIR__; // e.g. /home/u466475909/public_html/admin or local public

// Try to locate Laravel Root Path
$possibleLaravelRoots = [
    realpath(__DIR__ . '/..'),
    realpath(__DIR__ . '/../../ServiceHub'),
    realpath(__DIR__ . '/../../domains/bhandaripackersandmovers.in/ServiceHub'),
    '/home/u466475909/domains/bhandaripackersandmovers.in/ServiceHub',
    '/home/u466475909/servicehub'
];

$laravelRoot = null;
foreach ($possibleLaravelRoots as $path) {
    if ($path && is_dir($path) && file_exists($path . '/bootstrap/app.php')) {
        $laravelRoot = $path;
        break;
    }
}

function copyDirRecursive($src, $dst) {
    if (!is_dir($src)) return 0;
    if (!is_dir($dst)) @mkdir($dst, 0777, true);
    $copiedCount = 0;
    $dir = @opendir($src);
    if (!$dir) return 0;
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                $copiedCount += copyDirRecursive($src . '/' . $file, $dst . '/' . $file);
            } else {
                if (!file_exists($dst . '/' . $file) || filemtime($src . '/' . $file) > filemtime($dst . '/' . $file)) {
                    if (@copy($src . '/' . $file, $dst . '/' . $file)) {
                        @chmod($dst . '/' . $file, 0777);
                        $copiedCount++;
                    }
                }
            }
        }
    }
    closedir($dir);
    return $copiedCount;
}

$logs = [];

if (!$laravelRoot) {
    $logs[] = "❌ Could not find Laravel root path!";
} else {
    $logs[] = "✅ Detected Laravel Root: <code>" . htmlspecialchars($laravelRoot) . "</code>";
    $logs[] = "✅ Current Web Public Folder: <code>" . htmlspecialchars($currentPublicDir) . "</code>";

    // 1. Ensure required target directories exist with proper permissions
    $targetsToEnsure = [
        $laravelRoot . '/storage/app/public',
        $laravelRoot . '/storage/app/public/documents',
        $laravelRoot . '/public/uploads',
        $laravelRoot . '/public/uploads/profile',
        $laravelRoot . '/public/uploads/settings',
        $laravelRoot . '/public/uploads/booking_proofs',
    ];

    foreach ($targetsToEnsure as $dir) {
        if (!is_dir($dir)) {
            if (@mkdir($dir, 0777, true)) {
                $logs[] = "📁 Created directory: <code>$dir</code>";
            } else {
                $logs[] = "⚠️ Could not create directory: <code>$dir</code>";
            }
        }
        @chmod($dir, 0777);
    }

    // 2. Setup Symlinks / File Mirrors: [Link in Web Public] => [Target Directory]
    $linksToCreate = [
        'storage'   => $laravelRoot . '/storage/app/public',
        'uploads'   => $laravelRoot . '/public/uploads',
        'documents' => $laravelRoot . '/storage/app/public/documents',
    ];

    foreach ($linksToCreate as $linkName => $targetPath) {
        $linkPath = $currentPublicDir . '/' . $linkName;

        // Skip if target doesn't exist
        if (!is_dir($targetPath)) {
            $logs[] = "⚠️ Target path for <b>$linkName</b> does not exist: <code>$targetPath</code>";
            continue;
        }

        // If linkPath is the exact same physical directory as targetPath, no link needed (local dev)
        if (realpath($linkPath) && realpath($linkPath) === realpath($targetPath) && !is_link($linkPath)) {
            $logs[] = "ℹ️ <b>$linkName</b> is already the physical target directory itself. No symlink needed.";
            continue;
        }

        // Check existing link/directory
        if (file_exists($linkPath) || is_link($linkPath)) {
            if (is_link($linkPath)) {
                $currentTarget = @readlink($linkPath);
                if ($currentTarget === $targetPath || realpath($linkPath) === realpath($targetPath)) {
                    $logs[] = "✅ Symlink <b>$linkName</b> already points to <code>$targetPath</code>.";
                    continue;
                } else {
                    @unlink($linkPath);
                    $logs[] = "🔄 Removed outdated symlink for <b>$linkName</b>.";
                }
            } else if (is_dir($linkPath)) {
                // Physical folder exists at linkPath (e.g. uploads folder on shared host)
                // Copy any files inside linkPath to targetPath so nothing is lost
                copyDirRecursive($linkPath, $targetPath);
            }
        }

        $linkCreated = false;
        // Check if symlink function is enabled on PHP
        if (function_exists('symlink')) {
            if (@symlink($targetPath, $linkPath)) {
                $logs[] = "🎉 Successfully created symlink: <code>$linkName</code> &rarr; <code>$targetPath</code>";
                $linkCreated = true;
            }
        }
        
        if (!$linkCreated && function_exists('exec')) {
            @exec("ln -s " . escapeshellarg($targetPath) . " " . escapeshellarg($linkPath), $out, $ret);
            if ($ret === 0 && (is_link($linkPath) || file_exists($linkPath))) {
                $logs[] = "🎉 Successfully created symlink via shell (ln -s): <code>$linkName</code> &rarr; <code>$targetPath</code>";
                $linkCreated = true;
            }
        }

        if (!$linkCreated) {
            // Symlink is disabled in php.ini on Hostinger. Perform recursive file copy sync.
            $copied = copyDirRecursive($targetPath, $linkPath);
            $logs[] = "📁 <b>PHP symlink() disabled on server:</b> Synced <b>$copied</b> files directly from <code>$targetPath</code> to <code>$linkPath</code>.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Storage & Upload Symlink / Directory Fixer</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 40px; background: #0f172a; color: #f8fafc; }
        .card { max-width: 750px; margin: 0 auto; background: #1e293b; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); border: 1px solid #334155; }
        h2 { color: #38bdf8; margin-top: 0; }
        .log-box { background: #090d16; padding: 16px; border-radius: 8px; font-family: monospace; font-size: 13px; line-height: 1.8; color: #cbd5e1; border: 1px solid #1e293b; margin-top: 15px; }
        code { color: #f43f5e; background: #27151a; padding: 2px 6px; border-radius: 4px; }
        .btn { display: inline-block; padding: 10px 20px; background: #0284c7; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; margin-top: 20px; }
        .btn:hover { background: #0369a1; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🔗 Storage & Upload Symlink / Directory Fixer</h2>
        <p>This script fixes image 404 errors by linking or mirroring storage, uploads, and documents into the web public folder.</p>
        
        <div class="log-box">
            <?= implode("<br>", $logs) ?>
        </div>

        <a href="./" class="btn">Go to Admin Dashboard</a>
    </div>
</body>
</html>
