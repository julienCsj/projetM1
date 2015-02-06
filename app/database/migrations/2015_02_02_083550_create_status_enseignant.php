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

		Schema::create('_groupe', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('nom');
			$table->string('semestre_id', 50);
			$table->foreign('semestre_id')->references('id')->on('semestre');
		});
		Schema::create('_financement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('libelle');
			$table->integer('montant');
		});
		Schema::create('_typestatusenseignant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('label');
			$table->integer('heure');
			$table->integer('heure_max');
		});
		Schema::create('_statusenseignant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('login_id',50);
			$table->foreign('login_id')->references('login')->on('user');
			$table->integer('typestatus_id')->unsigned();
			$table->foreign('typestatus_id')->references('id')->on('_typestatusenseignant');
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
		Schema::dropIfExists('_financement');
		Schema::dropIfExists('_groupe');
		// FAIRE les autres tables
	}

}
