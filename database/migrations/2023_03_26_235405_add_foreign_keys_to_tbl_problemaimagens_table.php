<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTblProblemaimagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_problemaimagens', function(Blueprint $table)
		{
			$table->foreign('prob_id', 'tbl_problemaimagens_ibfk_1')->references('prob_id')->on('tbl_problema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('arq_id', 'tbl_problemaimagens_ibfk_2')->references('arq_id')->on('tbl_arquivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_problemaimagens', function(Blueprint $table)
		{
			$table->dropForeign('tbl_problemaimagens_ibfk_1');
			$table->dropForeign('tbl_problemaimagens_ibfk_2');
		});
	}

}
