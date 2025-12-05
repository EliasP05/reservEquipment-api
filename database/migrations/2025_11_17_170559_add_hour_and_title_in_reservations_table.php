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
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('hours_reserve')->default(1)->after('date_reserve');
            $table->string('description_reserve')->after('user_id');
            $table->string('title_reserve')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('hours_reserve')->default(1)->after('date_reserve');
            $table->string('description_reserve')->after('user_id');
            $table->string('title_reserve')->after('user_id');
        });
    }
};
