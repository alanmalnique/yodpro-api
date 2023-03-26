<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTblProblemacomentarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_problemacomentario', function(Blueprint $table)
		{
			$table->foreign('prob_id', 'tbl_problemacomentario_ibfk_1')->references('prob_id')->on('tbl_problema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usu_id', 'tbl_problemacomentario_ibfk_2')->references('usu_id')->on('tbl_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_problemacomentario', function(Blueprint $table)
		{
			$table->dropForeign('tbl_problemacomentario_ibfk_1');
			$table->dropForeign('tbl_problemacomentario_ibfk_2');
		});
	}

}
