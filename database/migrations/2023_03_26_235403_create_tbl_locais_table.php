<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLocaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_locais', function(Blueprint $table)
		{
			$table->integer('loc_id', true);
			$table->string('loc_descricao', 80);
			$table->string('loc_endereco')->nullable();
			$table->string('loc_latitude', 45)->nullable();
			$table->string('loc_longitude', 45)->nullable();
			$table->boolean('loc_ativo')->default(1)->comment('0-N, 1-S');
			$table->dateTime('loc_dthrcadastro');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_locais');
	}

}
