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
            $table->string('referencia')->index()->default('mensal');
            $table->string('matricula');
            $table->string('funcionario');
            $table->string('situacao')->default('ativo');
            $table->string('lotacao')->nullable();
            $table->string('vinculo')->nullable();
            $table->decimal('total_proventos', 10, 2)->default(0);
            $table->decimal('total_descontos', 10, 2)->default(0);
            $table->decimal('total_liquido', 10, 2)->default(0);
            $table->foreignId('cargo_id')->constrained('cargos')->nullable();
            $table->foreignId('entidade_id')->constrained('entidades');

            // Índice composto para performance em consultas por entidade e período
            $table->index(['entidade_id', 'mes', 'ano']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('folhas');
    }
};
