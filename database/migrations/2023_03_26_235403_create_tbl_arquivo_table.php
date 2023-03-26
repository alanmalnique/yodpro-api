<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblArquivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_arquivo', function(Blueprint $table)
		{
			$table->integer('arq_id', true);
			$table->string('arq_nome');
			$table->date('arq_data');
			$table->string('arq_pasta', 50);
			$table->string('arq_extensao', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_arquivo');
	}

}
