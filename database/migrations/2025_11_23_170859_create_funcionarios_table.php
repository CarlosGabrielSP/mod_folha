<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('entidade_id')->constrained('entidades')->cascadeOnDelete();
            $table->string('nome');
            $table->string('matricula');
            $table->char('cpf', 11);

            $table->foreignId('cargo_id')->constrained('cargos');
            $table->date('data_admissao');
            $table->date('data_demissao')->nullable();

            $table->string('email')->nullable();
            $table->string('telefone')->nullable();

            $table->foreignId('id_lotacoes')->constrained('lotacoes');
            $table->foreignId('id_vinculos')->constrained('vinculos');
            $table->foreignId('id_situacoes')->constrained('situacoes');

            $table->timestamps();

            // Unique por entidade (permite mesmo CPF/matrícula em entidades diferentes)
            $table->unique(['entidade_id', 'matricula']);
            $table->unique(['entidade_id', 'cpf']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
