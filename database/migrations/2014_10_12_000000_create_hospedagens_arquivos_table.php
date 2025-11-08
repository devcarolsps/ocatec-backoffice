<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedagensArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedagens_arquivos', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('user_id', 36);
            $table->char('hospedagem_id', 36);
            $table->string('filename')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable();
            $table->string('tipo')->nullable();
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
        Schema::dropIfExists('hospedagens_arquivos');
    }
}
