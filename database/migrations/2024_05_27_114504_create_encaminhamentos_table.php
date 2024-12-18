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
        Schema::create('encaminhamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id');
            $table->foreignId('tipoEncaminhamento_id');
            $table->foreignId('team_id');
            $table->string('status');
            $table->string('anexos');
            $table->longText('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encaminhamentos');
    }
};
