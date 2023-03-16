<?php

use App\Models\User;
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
        Schema::create('achat', function (Blueprint $table) {
            $table->primary(['user_id', 'jeu_id']);
            $table->foreignId('user_id')->references('id')->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('jeu_id')->references('id')->on('jeu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $d = new DateTime('now');
            $table->dateTime('date_achat')->default($d->format("Y-m-d\\TH:i:sO"));
            $table->string('lieu_achat');
            $table->integer('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat');
    }
};
