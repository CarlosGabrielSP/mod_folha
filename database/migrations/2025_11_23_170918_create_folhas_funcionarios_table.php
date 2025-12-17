<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('folhas_funcionarios', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('folha_id')->constrained('folhas')->cascadeOnDelete();
            $table->foreignUuid('funcionario_id')->constrained('funcionarios')->cascadeOnDelete();
            $table->string('referencia')->default('mensal');
            $table->decimal('total_proventos', 10, 2)->default(0);
            $table->decimal('total_descontos', 10, 2)->default(0);
            $table->decimal('total_liquido', 10, 2)->default(0);

            $table->timestamps();

            // Um funcionário só pode aparecer uma vez por folha
            $table->unique(['folha_id', 'funcionario_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('folhas_funcionarios');
    }
};
