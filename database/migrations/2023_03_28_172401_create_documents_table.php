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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->bigInteger('category_id');
            //bigInteger aceita numero inteiro e numero negativos
            //unsignedBigInteger aceita apenas numeros inteiros nao negativos
            $table->unsignedBigInteger('category_id');
            $table->string('title', 60);
            $table->text('contents');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
