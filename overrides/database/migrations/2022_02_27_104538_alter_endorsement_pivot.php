<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    // Create pivot WITH a composite PK to satisfy DO's sql_require_primary_key
    Schema::create('endorsement_rating', function (Blueprint $table) {
      $table->unsignedBigInteger('endorsement_id');
      $table->unsignedInteger('rating_id');
      // ✅ DO-compliant: add a primary key
      $table->primary(['endorsement_id', 'rating_id']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('endorsement_rating');
  }
};
