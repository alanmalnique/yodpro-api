<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTblProblemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_problema', function(Blueprint $table)
		{
			$table->foreign('loc_id', 'tbl_problema_ibfk_1')->references('loc_id')->on('tbl_locais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usu_id', 'tbl_problema_ibfk_2')->references('usu_id')->on('tbl_usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_problema', function(Blueprint $table)
		{
			$table->dropForeign('tbl_problema_ibfk_1');
			$table->dropForeign('tbl_problema_ibfk_2');
		});
	}

}
