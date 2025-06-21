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
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->datetime('data_ocorrencia');
            $table->enum('status', ['pendente', 'em_andamento', 'resolvido', 'cancelado'])->default('pendente');
            $table->enum('prioridade', ['baixa', 'media', 'alta', 'critica'])->default('media');
            $table->integer('progresso')->default(0);
            $table->unsignedBigInteger('local_id');
            $table->unsignedBigInteger('equipamento_id');
            $table->boolean('editavel')->default(true);
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index(['status', 'prioridade']);
            $table->index(['local_id']);
            $table->index(['equipamento_id']);
            $table->index(['usuario_id']);
            $table->index('data_ocorrencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorios');
    }
};
