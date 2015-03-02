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

		DB::insert("INSERT INTO `_groupe`(`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES (1, 'A', 'sem00001', 1);");
		DB::insert("INSERT INTO `_groupe`(`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES (2, 'C', 'sem00001', 3);");
		DB::insert("INSERT INTO `_groupe`(`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES (3, 'D', 'sem00001', 0);");
		DB::insert("INSERT INTO `_groupe`(`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES (4, 'E', 'sem00001', 0);");
		DB::insert("INSERT INTO `_groupe`(`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES (5, 'Test', 'sem00001', 2);");

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

        Schema::create('_module_enseignant', function($table){
            $table->engine = 'InnoDB';
            $table->string('module_id',50);
            $table->string('enseignant_id',50);
        });
		DB::insert("INSERT INTO `_module_enseignant`(`module_id`, `enseignant_id`) VALUES ('mod00001', 'user00012');");
		DB::insert("INSERT INTO `_module_enseignant`(`module_id`, `enseignant_id`) VALUES ('mod00001', 'user00021');");
		

        Schema::create('_module_financement', function($table){
            $table->engine = 'InnoDB';
            $table->string('module_id',50);
            $table->string('financement_id',50);
        });
		DB::insert("INSERT INTO `_module_financement`(`module_id`, `financement_id`) VALUES ('mod00001', 2);");
		DB::insert("INSERT INTO `_module_financement`(`module_id`, `financement_id`) VALUES ('mod00001', 4);");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('_module_financement');
		Schema::dropIfExists('_module_enseignant');
		Schema::dropIfExists('_calendrier');
		Schema::dropIfExists('_statusenseignant');
		Schema::dropIfExists('_typestatusenseignant');
		Schema::dropIfExists('_financement');
		Schema::dropIfExists('_groupe');
		// FAIRE les autres tables
	}

}
