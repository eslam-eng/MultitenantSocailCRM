<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('database')->unique();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['slug', 'deleted_at']);
        });
    }
};
