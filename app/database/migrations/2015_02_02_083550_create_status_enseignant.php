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
		Schema::dropIfExists('_statusenseignant');
		Schema::dropIfExists('_typestatusenseignant');
		Schema::dropIfExists('_financement');
		Schema::dropIfExists('_groupe');
        Schema::dropIfExists('_calendrier');

		Schema::create('_groupe', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('nom');
			$table->string('semestre_id', 50);
            $table->integer("sous_groupe");
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
		// Creation des types de status enseignant primaires
		DB::insert("INSERT INTO `_typestatusenseignant`(`id`, `label`, `heure`, `heure_max`) VALUES (1,'Heure fixe', 0,0);");
		DB::insert("INSERT INTO `_typestatusenseignant`(`label`, `heure`, `heure_max`) VALUES ('Enseignant chercheur', 192,384);");
		
		Schema::create('_statusenseignant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('login_id',50);
			$table->foreign('login_id')->references('login')->on('user');
			$table->integer('typestatus_id')->unsigned();
			$table->foreign('typestatus_id')->references('id')->on('_typestatusenseignant');
			$table->integer('taux_horaire_specifique');
			$table->integer('volume_horaire');
		});

        Schema::create('_calendrier', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('idFormation',50);
            $table->string('dateDebut',255);
            $table->string('dateFin',255);
            $table->string('nom',255);
            $table->string('type',255);
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
