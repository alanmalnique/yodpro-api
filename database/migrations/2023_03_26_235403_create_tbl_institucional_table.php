<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInstitucionalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_institucional', function(Blueprint $table)
		{
			$table->integer('inst_id', true);
			$table->integer('arq_id')->nullable()->index('fk_tbl_institucional_tbl_arquivo1');
			$table->string('inst_titulo', 60);
			$table->text('inst_texto');
			$table->smallInteger('inst_ativo')->default(1)->comment('0-N, 1-S');
			$table->smallInteger('inst_tipo')->comment('1-Banner, 2-Serviços, 3-Vantagem');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_institucional');
	}

}
