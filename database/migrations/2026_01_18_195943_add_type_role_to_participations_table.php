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
        Schema::table('participations', function (Blueprint $table) {
            // Ajout du champ enum
            $table->enum('typeRole', ['principal', 'secondaire'])->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participations', function (Blueprint $table) {
            //
        });
    }
};
