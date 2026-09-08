<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Laravel core files ko load karein
require __DIR__.'/../../ServiceHub/vendor/autoload.php';
$app = require_once __DIR__.'/../../ServiceHub/bootstrap/app.php';

// Console kernel load karein commands run karne ke liye
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

try {
    echo "<h2>Laravel Self-Healing Migration Script</h2>";

    // 1. Check if table already exists
    $tableExists = Schema::hasTable('personal_access_tokens');
    echo "Initial check - Table 'personal_access_tokens' exists: " . ($tableExists ? "<b>YES</b>" : "<b>NO</b>") . "<br>";

    if ($tableExists) {
        echo "<h3 style='color:green;'>Table already exists! No action needed.</h3>";
        exit;
    }

    // 2. Check for migration files in database/migrations
    $migrationsDir = base_path('database/migrations');
    $files = scandir($migrationsDir);
    $migrationFileFound = false;
    $migrationFileName = '';

    foreach ($files as $file) {
        if (str_contains($file, 'create_personal_access_tokens_table')) {
            $migrationFileFound = true;
            $migrationFileName = $file;
            break;
        }
    }

    if (!$migrationFileFound) {
        echo "Migration file not found on server. Creating it...<br>";
        $migrationContent = '<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(\'personal_access_tokens\', function (Blueprint $table) {
            $table->id();
            $table->morphs(\'tokenable\');
            $table->text(\'name\');
            $table->string(\'token\', 64)->unique();
            $table->text(\'abilities\')->nullable();
            $table->timestamp(\'last_used_at\')->nullable();
            $table->timestamp(\'expires_at\')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(\'personal_access_tokens\');
    }
};';
        
        $migrationFileName = '2026_07_02_080329_create_personal_access_tokens_table.php';
        File::put($migrationsDir . '/' . $migrationFileName, $migrationContent);
        echo "Created migration file: <b>" . $migrationFileName . "</b> in server migrations folder.<br>";
    } else {
        echo "Migration file exists: <b>" . $migrationFileName . "</b><br>";
    }

    // 3. Check migrations table in DB
    $dbRecord = DB::table('migrations')->where('migration', 'LIKE', '%' . 'create_personal_access_tokens_table' . '%')->first();

    if ($dbRecord) {
        echo "Found migration record in DB: <b>" . $dbRecord->migration . "</b>. Deleting it to force re-run...<br>";
        DB::table('migrations')->where('id', $dbRecord->id)->delete();
        echo "Deleted migration record from DB.<br>";
    } else {
        echo "No migration record found in DB.<br>";
    }

    // 4. Run migrate
    echo "Running migrate command...<br>";
    $kernel->call('migrate', ['--force' => true]);
    echo "<pre>" . $kernel->output() . "</pre>";

    // 5. Final check
    $finalCheck = Schema::hasTable('personal_access_tokens');
    echo "Final check - Table 'personal_access_tokens' exists: " . ($finalCheck ? "<b style='color:green;'>YES (Success!)</b>" : "<b style='color: #FC5D09;'>NO (Failed!)</b>") . "<br>";

} catch (\Exception $e) {
    echo "<h2 style='color: #FC5D09;'>Error occurred:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}