<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('documento')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('cod_pais_tel', 3)->nullable();
            $table->string('ddd_tel', 2)->nullable();
            $table->string('cod_pais_cel', 3)->nullable();
            $table->string('ddd_cel', 2)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('qualificacao', 20)->nullable();
            $table->integer('cep')->nullable();
            $table->string('logradouro', 100)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 25)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 100)->nullable();
            $table->integer('cep_comercial')->nullable();
            $table->string('logradouro_comercial', 100)->nullable();
            $table->integer('numero_comercial')->nullable();
            $table->string('complemento_comercial', 25)->nullable();
            $table->string('bairro_comercial', 100)->nullable();
            $table->string('cidade_comercial', 100)->nullable();
            $table->string('estado_comercial', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('logo')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
