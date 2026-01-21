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
        Schema::create('commande_produit', function (Blueprint $table) {
        // ATTENTION : J'ai supprimé la ligne $table->id(); ici pour éviter le conflit

        $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
        $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
        $table->integer('qte_cmd');

        // On définit la clé primaire sur la paire des deux IDs
        $table->primary(['commande_id', 'produit_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_produit');
    }
};
