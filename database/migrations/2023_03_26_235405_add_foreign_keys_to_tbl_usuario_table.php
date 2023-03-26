<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTblUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_usuario', function(Blueprint $table)
		{
			$table->foreign('arq_id', 'tbl_usuario_ibfk_1')->references('arq_id')->on('tbl_arquivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_usuario', function(Blueprint $table)
		{
			$table->dropForeign('tbl_usuario_ibfk_1');
		});
	}

}
