<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('features', function (Blueprint $table) {
            Schema::create('features', function (Blueprint $table) {
                $table->id();
                $table->string('slug');
                $table->json('name'); // as it will be translatable
                $table->tinyInteger('group')->comment('is features for limits or for modules values from enum Feature Group'); // limit = numeric quota, feature = boolean
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // After table creation, run raw SQL
            DB::statement('
                            ALTER TABLE features
                            ADD COLUMN slug_unique VARCHAR(255)
                            GENERATED ALWAYS AS (IF(deleted_at IS NULL, slug, NULL)) STORED
                        ');

            DB::statement('CREATE UNIQUE INDEX unique_slug_not_deleted ON features (slug_unique)');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
