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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jeu_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('jeu_id')->references('id')->on('jeus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('commentaire');
            $d = new DateTime('now');
            $table->dateTime('date_com')->default($d->format("Y-m-d\\TH:i:sO"));
            $table->integer('note');
            $table->string('etat')->default("public");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
