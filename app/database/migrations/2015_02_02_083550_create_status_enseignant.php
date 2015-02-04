<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusEnseignant extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('_typestatusenseignant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('label');
			$table->integer('heure');
			$table->integer('seul_min');
			$table->integer('seul_max');
		});
		Schema::create('_statusenseignant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('login_id',50)->nullable();
			$table->foreign('login_id')->references('user')->on('login');
			$table->integer('typestatus_id')->nullable();
			$table->foreign('typestatus_id')->references('_typestatusenseignant')->on('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('_statusenseignant');
		Schema::dropIfExists('_typestatusenseignant');
	}

}
