<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedagens', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('user_id', 36);
            $table->integer('status');
            $table->integer('permite_afiliacao')->nullable();
            $table->string('nome_empreendimento')->nullable();
            $table->integer('tipo_afiliacao')->nullable();
            $table->integer('regra_comissionamento')->nullable();
            $table->integer('recomendado')->nullable();
            $table->string('regiao_comercializacao', 2)->nullable();
            $table->text('regra_afiliacao')->nullable();
            $table->integer('periodo_carencia')->nullable();
            $table->decimal('comissao_total', 10, 2);
            $table->decimal('primeira_indicacao', 10, 2);
            $table->decimal('segunda_indicacao', 10, 2);
            $table->decimal('comissao_oca', 10, 2);
            $table->integer('codigo');
            $table->text('caracteristica_descricao')->nullable();
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
        Schema::dropIfExists('hospedagens');
    }
}
