<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_usuario', function(Blueprint $table)
		{
			$table->integer('usu_id', true);
			$table->integer('arq_id')->nullable()->index('arq_id');
			$table->string('usu_nome', 150);
			$table->string('usu_email', 150);
			$table->string('usu_senha');
			$table->string('usu_celular', 16);
			$table->boolean('usu_ativo')->default(1)->comment('0-N, 1-S');
			$table->text('usu_tokenpush')->nullable();
			$table->dateTime('usu_dthrcadastro');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_usuario');
	}

}
