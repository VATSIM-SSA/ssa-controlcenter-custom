<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    // Tables this migration touches (expand as new errors appear)
    $tables = [
      'training_object_attachments',
      // add more table names here if the migration errors on them next
      // e.g. 'training_objects', 'training_object_versions', ...
    ];

    foreach ($tables as $t) {
      if (!Schema::hasTable($t)) {
        continue;
      }

      // Add uuid only if it doesn't exist (MySQL 8 supports IF NOT EXISTS)
      $sql = "ALTER TABLE `$t` ADD COLUMN IF NOT EXISTS `uuid` CHAR(36) NOT NULL";
      try {
        DB::statement($sql);
      } catch (\Throwable $e) {
        // Fallback for MySQL variants without IF NOT EXISTS: double-check and ignore duplicates
        if (!Schema::hasColumn($t, 'uuid')) {
          throw $e; // truly missing and failed for another reason
        }
      }

      // If the original migration adds an index/unique, make it idempotent too.
      // Example (uncomment and adjust index name/columns if needed):
      // try {
      //     DB::statement("CREATE UNIQUE INDEX IF NOT EXISTS `${t}_uuid_unique` ON `$t` (`uuid`)");
      // } catch (\Throwable $e) { /* ignore if already exists */ }
    }
  }

  public function down(): void
  {
    // Down is optional here; skipping to avoid dropping live data.
    // If you need it:
    // foreach (['training_object_attachments'] as $t) {
    //     if (Schema::hasTable($t) && Schema::hasColumn($t, 'uuid')) {
    //         DB::statement("ALTER TABLE `$t` DROP COLUMN `uuid`");
    //     }
    // }
  }
};
