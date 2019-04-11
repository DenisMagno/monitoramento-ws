<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdososTable extends Migration
{
    private $gruposSanguineos = [
        '1' => 'A+',
        '2' => 'A-',
        '3' => 'B+',
        '4' => 'B-',
        '5' => 'O+',
        '6' => 'O-',
        '7' => 'AB+',
        '8' => 'AB-'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idosos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->enum('grupoSanguineo', array_values($this->gruposSanguineos))->comment = "1 - A+\n2 - A-\n3 - B+\n4 - B-\n5 - O+\n6 - O-\n7 - AB+\n8 - AB-";
            $table->double('peso', 5, 2);
            $table->double('altura', 3, 2);
            $table->string('logradouro');
            $table->string('numero');
            $table->string('cep');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('complemento');
            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('responsaveis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idoso');
    }
}
