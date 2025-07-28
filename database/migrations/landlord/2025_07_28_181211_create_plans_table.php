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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 255)->nullable();
            $table->string('currency');
            $table->decimal('price');
            $table->boolean('is_active')->default(true);
            $table->string('billing_cycle')->comment('numbers refers to this types,monthly,annual,..');
            $table->integer('sort_order')->default(0);
            $table->integer('trial_days')->default(0);
            $table->integer('refund_days')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index('billing_cycle');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
