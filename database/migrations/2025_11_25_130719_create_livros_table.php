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
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->unsignedBigInteger('categoria_id'); // chave estrangeira
            $table->string('autor')->nullable();
            $table->integer('ano')->nullable();
            $table->integer('quantidade')->default(1);
            $table->timestamps();

            $table->string('capa')->nullable(); // campo para imagem
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
