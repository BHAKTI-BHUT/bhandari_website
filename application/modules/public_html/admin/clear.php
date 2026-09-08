<?php
// Standalone Cache Cleaner - runs directly without booting Laravel framework
// Safe to execute even when Laravel crashes with route/config cache errors.

$cacheDir = __DIR__ . '/../bootstrap/cache';
$deletedFiles = [];
$errors = [];

if (is_dir($cacheDir)) { 
    $files = glob($cacheDir . '/*.php');
    if ($files) {
        foreach ($files as $file) {
            $filename = basename($file);
            if (is_file($file)) {
                if (@unlink($file)) {
                    $deletedFiles[] = $filename;
                } else {
                    $errors[] = $filename;
                }
            }
        }
    }
}

if (function_exists('opcache_reset')) {
    @opcache_reset();
}

// Try running Artisan clear commands as second phase if autoloader works
$artisanOutput = "";
try {
    if (file_exists(__DIR__ . '/../vendor/autoload.php') && file_exists(__DIR__ . '/../bootstrap/app.php')) {
        require_once __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $artisanOutput = \Illuminate\Support\Facades\Artisan::output();
    }
// Helper for recursive copy
if (!function_exists('clearCopyDirRecursive')) {
    function clearCopyDirRecursive($src, $dst) {
        if (!is_dir($src)) return 0;
        if (!is_dir($dst)) @mkdir($dst, 0777, true);
        $count = 0;
        $dir = @opendir($src);
        if (!$dir) return 0;
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $count += clearCopyDirRecursive($src . '/' . $file, $dst . '/' . $file);
                } else {
                    if (!file_exists($dst . '/' . $file) || filemtime($src . '/' . $file) > filemtime($dst . '/' . $file)) {
                        if (@copy($src . '/' . $file, $dst . '/' . $file)) {
                            @chmod($dst . '/' . $file, 0777);
                            $count++;
                        }
                    }
                }
            }
        }
        closedir($dir);
        return $count;
    }
}

// Auto Repair Storage & Upload Symlinks if missing
$symlinkLogs = [];
try {
    $currentPublicDir = __DIR__;
    $possibleRoots = [
        realpath(__DIR__ . '/..'),
        realpath(__DIR__ . '/../../ServiceHub'),
        realpath(__DIR__ . '/../../domains/bhandaripackersandmovers.in/ServiceHub'),
        '/home/u466475909/domains/bhandaripackersandmovers.in/ServiceHub',
        '/home/u466475909/servicehub'
    ];
    $laravelRoot = null;
    foreach ($possibleRoots as $p) {
        if ($p && is_dir($p) && file_exists($p . '/bootstrap/app.php')) {
            $laravelRoot = $p;
            break;
        }
    }
    if ($laravelRoot) {
        $targets = [
            $laravelRoot . '/storage/app/public',
            $laravelRoot . '/storage/app/public/documents',
            $laravelRoot . '/public/uploads',
            $laravelRoot . '/public/uploads/profile',
            $laravelRoot . '/public/uploads/settings',
            $laravelRoot . '/public/uploads/booking_proofs',
        ];
        foreach ($targets as $t) {
            if (!is_dir($t)) @mkdir($t, 0777, true);
            @chmod($t, 0777);
        }
        $links = [
            'storage'   => $laravelRoot . '/storage/app/public',
            'uploads'   => $laravelRoot . '/public/uploads',
            'documents' => $laravelRoot . '/storage/app/public/documents',
        ];
        foreach ($links as $linkName => $targetPath) {
            $linkPath = $currentPublicDir . '/' . $linkName;
            if (!is_dir($targetPath)) continue;
            if (realpath($linkPath) && realpath($linkPath) === realpath($targetPath) && !is_link($linkPath)) {
                $symlinkLogs[] = "<b>$linkName</b>: OK (Physical Directory)";
                continue;
            }
            if (file_exists($linkPath) || is_link($linkPath)) {
                if (is_link($linkPath)) {
                    if (realpath($linkPath) === realpath($targetPath)) {
                        $symlinkLogs[] = "<b>$linkName</b>: OK (Symlink Active)";
                        continue;
                    }
                    @unlink($linkPath);
                } else if (is_dir($linkPath)) {
                    clearCopyDirRecursive($linkPath, $targetPath);
                }
            }
            $linkDone = false;
            if (function_exists('symlink')) {
                if (@symlink($targetPath, $linkPath)) {
                    $symlinkLogs[] = "<b>$linkName</b>: ✅ Created Symlink to $targetPath";
                    $linkDone = true;
                }
            }
            if (!$linkDone && function_exists('exec')) {
                @exec("ln -s " . escapeshellarg($targetPath) . " " . escapeshellarg($linkPath), $o, $r);
                if ($r === 0 && (is_link($linkPath) || file_exists($linkPath))) {
                    $symlinkLogs[] = "<b>$linkName</b>: ✅ Created Shell Symlink to $targetPath";
                    $linkDone = true;
                }
            }
            if (!$linkDone) {
                $c = clearCopyDirRecursive($targetPath, $linkPath);
                $symlinkLogs[] = "<b>$linkName</b>: 📁 Synced $c files directly (PHP symlink disabled)";
            }
        }
    }
} catch (\Throwable $se) {
    $symlinkLogs[] = "Notice: " . $se->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cache Cleared</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 40px; background: #f8fafc; color: #1e293b; }
        .card { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; }
        h2 { color: #166534; margin-top: 0; display: flex; align-items: center; gap: 8px; }
        .badge { background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: 600; }
        .file-list { background: #f1f5f9; padding: 12px 16px; border-radius: 6px; font-family: monospace; font-size: 13px; margin: 12px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #2563eb; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; margin-top: 15px; }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="card">
        <h2>✅ Caches Cleared Successfully!</h2>
        <p>All compiled cache files in <code>bootstrap/cache/</code> were deleted directly.</p>
        
        <?php if (!empty($deletedFiles)): ?>
            <div class="file-list">
                <strong>Deleted Cache Files:</strong><br>
                <?= implode('<br>', array_map('htmlspecialchars', $deletedFiles)) ?>
            </div>
        <?php else: ?>
            <p><em>No leftover cached files were found in <code>bootstrap/cache/</code>.</em></p>
        <?php endif; ?>

        <?php if ($artisanOutput): ?>
            <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:10px; border-radius:6px; font-size:12px; margin-top:10px; white-space:pre-wrap; max-height:150px; overflow:auto;">
                <strong>Artisan Output:</strong><br><?= htmlspecialchars($artisanOutput) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($symlinkLogs)): ?>
            <div style="background:#ecfdf5; border:1px solid #a7f3d0; padding:12px; border-radius:6px; font-size:13px; margin-top:15px; color:#065f46;">
                <strong>🔗 Storage & Upload Symlink Status:</strong><br>
                <?= implode('<br>', $symlinkLogs) ?>
            </div>
        <?php endif; ?>

        <a href="/" class="btn">Return to Website</a>
    </div>
</body>
</html>

