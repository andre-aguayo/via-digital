<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateWorkboardAccessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workboard_access_types', function (Blueprint $table) {
            $table->id();
            $table->string('description')
                ->comment('Descriçao do tipo de acesso definido para o usuario aos cards e colunas');
            $table->timestamps();
        });

        /**
         * Tem a finalidade de definir o tipo de acesso ao usuario convidado ao quadro de trabalho.
         * Adiciona o acesso total apos criar a tabela pela falta de painel para gerenciar os tipos de acesso.
         */
        DB::table('workboard_access_types')->insert([
            // define o acesso total ao quadro de trabalho
            'description' => 'full_access',
        ]);
        DB::table('workboard_access_types')->insert([
            // define o acesso total ao quadro de trabalho
            'description' => 'reade_only',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workboard_access_types');
    }
}
