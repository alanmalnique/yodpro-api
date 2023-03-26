<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProblemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_problema', function(Blueprint $table)
		{
			$table->integer('prob_id', true);
			$table->integer('usu_id')->index('usu_id');
			$table->integer('loc_id')->index('loc_id');
			$table->dateTime('prob_datahora');
			$table->string('prob_titulo', 50)->default('');
			$table->text('prob_descricao');
			$table->boolean('prob_status')->default(1)->comment('1-Aberto, 2-Finalizado');
			$table->dateTime('prob_dthrfinalizado')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_problema');
	}

}
