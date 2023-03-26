<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProblemacomentarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_problemacomentario', function(Blueprint $table)
		{
			$table->integer('probc_id', true);
			$table->integer('prob_id')->index('prob_id');
			$table->integer('usu_id')->index('usu_id');
			$table->dateTime('probc_datahora');
			$table->text('probc_comentario');
			$table->boolean('probc_ativo')->default(1)->comment('0-N, 1-S
');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_problemacomentario');
	}

}
