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
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('last_activity');

            $table->json('location')->nullable();

            $table->after('payload', function (Blueprint $table) {
                $table->timestamp('last_active_at')->index();
                $table->timestamp('created_at')->default(DB::raw('NOW()'));
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('last_active_at');
            $table->dropColumn('location');
            $table->dropColumn('created_at');

            $table->integer('last_activity')->index();
        });
    }
};
