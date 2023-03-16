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
        Schema::create('jeus', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description');
            $table->string('langue');
            $table->string('url_media');
            $table->integer('age_min');
            $table->integer('nombre_joueurs_min');
            $table->integer('nombre_joueurs_max');
            $table->string('duree_partie');
            $table->boolean('valide')->default(true);
            $table->foreignId('categorie_id')->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('theme_id')->references('id')->on('themes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('editeur_id')->references('id')->on('editeurs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jeus');
    }
};
