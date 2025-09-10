<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * (O que fazer ao EXECUTAR a migração)
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Adiciona a coluna para a data de nascimento
            $table->date('data_nascimento')->nullable()->after('email');

            // 2. Adiciona a coluna para o celular
            $table->string('celular', 20)->nullable()->after('data_nascimento');
        });
    }

    /**
     * Reverse the migrations.
     * (O que fazer se precisar de DESFAZER a migração)
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 3. Remove as colunas se precisar de reverter
            $table->dropColumn('data_nascimento');
            $table->dropColumn('celular');
        });
    }
};