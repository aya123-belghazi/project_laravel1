<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // J'ai enlevé le doublon, il n'y a qu'un seul Schema::create ici
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('qte_stock');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
