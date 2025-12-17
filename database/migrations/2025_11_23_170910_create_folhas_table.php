<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('folhas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('mes');
            $table->integer('ano');
            $table->timestamps();

            // Uma folha única por mês/ano
            $table->unique(['mes', 'ano']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('folhas');
    }
};
