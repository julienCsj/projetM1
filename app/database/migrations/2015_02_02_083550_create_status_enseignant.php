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
            $table->integer("sous_groupe");
			$table->foreign('semestre_id')->references('id')->on('semestre');
		});


		Schema::create('_financement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('libelle');
		});

        DB::insert("INSERT INTO `_financement`(`libelle`) VALUES ('IUT');");
        DB::insert("INSERT INTO `_financement`(`libelle`) VALUES ('MFCA');");
        DB::insert("INSERT INTO `_financement`(`libelle`) VALUES ('Autre');");

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
        DB::insert("INSERT INTO `_typestatusenseignant`(`label`, `heure`, `heure_max`) VALUES ('Enseignant vacataire', 187,187);");
        DB::insert("INSERT INTO `_typestatusenseignant`(`label`, `heure`, `heure_max`) VALUES ('Enseignant du secondaire', 384,768);");
		DB::insert("INSERT INTO `_typestatusenseignant`(`label`, `heure`, `heure_max`) VALUES ('PAST', 96,192);");
		
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
            $table->string('eventID', 5);
        });

        Schema::create('_module_enseignant', function($table){
            $table->engine = 'InnoDB';
            $table->string('module_id',50);
            $table->string('enseignant_id',50);
			$table->foreign('enseignant_id')->references('login')->on('user');
        });

		

        Schema::create('_module_financement', function($table){
            $table->engine = 'InnoDB';
            $table->string('module_id',50);
            $table->string('financement_id',50);
        });

		Schema::create('_groupecours', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('moduleID');
            $table->string('formationID');
            $table->string('libelle');
        });

        Schema::create('_groupecours_cours', function($table){
            $table->engine = 'InnoDB';
            $table->increments('coursID');
            $table->string('groupecoursID');
        });

        Schema::create('_planification', function($table){
            $table->engine = 'InnoDB';
            $table->string('groupecoursID');
            $table->string('calendrierID');
            $table->integer('semaine');
        });

        Schema::create('_enseignant_voeux', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('enseignant_id',50);
			$table->foreign('enseignant_id')->references('login')->on('user');
            $table->integer('jour');
            $table->integer('creneau');
        });

        Schema::create('_cours', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('formationID');
            $table->string('ueID');
            $table->string('moduleID');
            $table->string('type');
            $table->integer('duree');
            $table->integer('dansGroupe');
            $table->integer('dansGroupeCommun');
            $table->integer('planifier');
        });

        Schema::create('_heuresexternes', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('enseignantID');
            $table->string('type');
            $table->string('intitule');
            $table->string('etablissement');
            $table->string('diplome');
            $table->string('numeroUE');
            $table->integer('nbHeureCM');
            $table->integer('nbHeureTD');
            $table->integer('nbHeureTP');

        });

        Schema::create('_groupecours_module_enseignant', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('groupecours_id');
            $table->string('module_id');
            $table->string('id_groupe');
            $table->string('enseignant_id');
            $table->string('financement_id');
        });

        Schema::create('_config', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('annee');
            $table->string('dateRentree');
            $table->string('dateFin');
            $table->string('valeurCMEnHService');
            $table->string('valeurTDEnHService');
            $table->string('valeurTPEnHService');
            $table->string('valeurCMEnHServiceHCC');
            $table->string('valeurTDEnHServiceHCC');
            $table->string('valeurTPEnHServiceHCC');
        });
        DB::insert("INSERT INTO `_config`(`id`, `annee`, `dateRentree`, `dateFin`, `valeurCMEnHService`, `valeurTDEnHService`, `valeurTPEnHService`, `valeurCMEnHServiceHCC`, `valeurTDEnHServiceHCC`, `valeurTPEnHServiceHCC`) VALUES (1,'2014', '09/03/2014', '07/12/2015', '1.5', '1', '1', '1.5', '1', '0.66666666');");

        Schema::create('_groupecours_cours_encommun', function($table){
            $table->engine = 'InnoDB';
            $table->string('coursID');
            $table->string('groupecoursID');
            $table->string('moduleDst');
            $table->string('moduleSce');
        });


    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
    {
        Schema::dropIfExists('_enseignant_voeux');
        Schema::dropIfExists('_module_financement');
        Schema::dropIfExists('_module_enseignant');
        Schema::dropIfExists('_calendrier');
        Schema::dropIfExists('_statusenseignant');
        Schema::dropIfExists('_typestatusenseignant');
        Schema::dropIfExists('_financement');
        Schema::dropIfExists('_groupe');
        Schema::dropIfExists('_groupecours');
        Schema::dropIfExists('_groupecours_cours');
        Schema::dropIfExists('_enseignant_voeux');
        Schema::dropIfExists('_cours');
        Schema::dropIfExists('_heuresexternes');
        Schema::dropIfExists('_planification');
        Schema::dropIfExists('_groupecours_module_enseignant');
        Schema::dropIfExists('_config');
        Schema::dropIfExists('_groupecours_cours_encommun');
    }
}
