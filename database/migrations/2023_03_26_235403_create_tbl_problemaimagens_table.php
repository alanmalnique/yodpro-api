<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProblemaimagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_problemaimagens', function(Blueprint $table)
		{
			$table->integer('prob_id')->index('prob_id');
			$table->integer('arq_id')->index('arq_id');
			$table->string('probi_descricao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_problemaimagens');
	}

}
