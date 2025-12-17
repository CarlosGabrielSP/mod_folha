<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('folhas_funcionarios_eventos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('folha_item_id')
                ->constrained('folhas_funcionarios')
                ->cascadeOnDelete();

            $table->foreignId('evento_id')
                ->constrained('eventos')
                ->cascadeOnDelete();

            $table->decimal('valor', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('folhas_funcionarios_eventos');
    }
};
