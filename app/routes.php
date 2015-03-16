<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
    // Routes module Identification
    Route::post('/connexion', array('as' => 'post.connexion', 'uses' => 'IdentificationController@postFormulaireConnexion'));
    Route::get('/', array('as' => 'connexion', 'uses' => 'IdentificationController@getFormulaireConnexion'));

Route::group(array('before' => 'auth'), function () { // Login required
    // Dashboard
    Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@getIndex'));

    // Routes module financement
    Route::get('financement', array('as' => 'financement', 'uses' => 'FinancementController@getFinancement'));
    Route::get('financement/supprimer/{id}', array('as' => 'financement.supprimerFinancement', 'uses' => 'FinancementController@supprimerFinancement'));
    Route::post('financement/ajouter', array('as' => 'financement.ajouterFinancement', 'uses' => 'FinancementController@ajouterFinancement'));
    Route::post('financement/modifier/{id}', array('as' => 'financement.modifierFinancement', 'uses' => 'FinancementController@modifierFinancement'));

    // Routes module groupe
    Route::get('groupe', array('as' => 'groupe', 'uses' => 'GroupeController@getGroupes'));
    Route::get('groupe/{idFormation}', array('as' => 'groupeModification', 'uses' => 'GroupeController@getGroupes'));

    Route::get('groupe/supprimer/{idFormation}/{idGroupe}', array('as' => 'groupe.supprimerGroupe', 'uses' => 'GroupeController@supprimerGroupe'));
    Route::post('groupe/ajouter', array('as' => 'groupe.ajouterGroupe', 'uses' => 'GroupeController@ajouterGroupe'));
    Route::post('groupe/modifier', array('as' => 'groupe.modifierGroupe', 'uses' => 'GroupeController@modifierGroupe'));

    // Route module Formation / UE / Matières
    Route::get('module', array('as' => 'module', 'uses' => 'ModuleController@getModules'));
    Route::get('module/{idFormation}/{idUe}/{idModule}', array('as' => 'moduleModification', 'uses' => 'ModuleController@getModules'));
    Route::post('module/modifier/', array('as' => 'module.postModifierModule', 'uses' => 'ModuleController@postModifierModule'));
    Route::get('formation/{idFormation}/ue/{idUe}/module/{idModule}/enseignant/{idEnseignant}/supprimer/', array('as' => 'module.supprimerEnseignant', 'uses' => 'ModuleController@supprimerEnseignantModule'));
    Route::get('formation/{idFormation}/ue/{idUe}/module/{idModule}/financement/{idFinancement}/supprimer/', array('as' => 'module.supprimerFinancement', 'uses' => 'ModuleController@supprimerFinancementModule'));
    Route::get('formation/{idFormation}/ue/{idUe}/module/{idModule}/cours/{idCours}/supprimer/', array('as' => 'module.supprimerCours', 'uses' => 'ModuleController@supprimerCours'));


    // Routes enseignant / status
    Route::get('enseignant', array('as' => 'enseignant', 'uses' => 'EnseignantController@getEnseignants'));
    Route::post('enseignant/status', array('as' => 'enseignant.postModifierStatus', 'uses' => 'StatusEnseignantController@postModifierStatus'));
    Route::get('enseignant/{idEnseignant}/voeux', array('as' => 'voeux.getVoeuxProfesseur', 'uses' => 'VoeuxController@getVoeuxProfesseur'));

    // Routes enseignant / voeux
    Route::get('voeux', array('as' => 'voeux', 'uses' => 'VoeuxController@getVoeux'));
    Route::post('voeux', array('as' => 'voeux', 'uses' => 'VoeuxController@editVoeux'));

    // Visualisation des voeux par le responsable de la plannification
    Route::get('voeuxEnseignant', array('as' => 'voeuxenseignant', 'uses' => 'VoeuxController@showVoeux'));
    Route::get('voeuxEnseignant/{idEnseignant}', array('as' => 'voeuxenseignant.voir', 'uses' => 'VoeuxController@showVoeux'));
    
    // Routes module calendrier
    Route::get('calendrier', array('as' => 'calendrier', 'uses' => 'CalendrierController@getCalendrier'));
    Route::post('calendrier/copier', array('as' => 'calendrier.copierCalendrier', 'uses' => 'CalendrierController@postCopierCalendrier'));
    Route::get('calendrier/{idFormation}', array('as' => 'calendrier.calendrierFormation', 'uses' => 'CalendrierController@getCalendrierFormation'));
    Route::post('calendrier/{idFormation}/ajouterPeriode', array('as' => 'calendrier.ajouterPeriode', 'uses' => 'CalendrierController@postAjouterPeriode'));
    Route::post('calendrier/{idFormation}/modifierPeriode', array('as' => 'calendrier.modifierPeriode', 'uses' => 'CalendrierController@postModifierPeriode'));
    Route::post('calendrier/{idFormation}/supprimerPeriode', array('as' => 'calendrier.supprimerPeriode', 'uses' => 'CalendrierController@postSupprimerPeriode'));

    // Routes module affectation
    Route::get('affectation', array('as' => 'affectation', 'uses' => 'AffectationController@getAffectation'));
    Route::get('affectation/{idFormation}', array('as' => 'affectation.affectationFormation', 'uses' => 'AffectationController@getAffectationFormation'));

    // Routes module heures externe
    Route::get('heuresexterieures', array('as' => 'heuresexterieures', 'uses' => 'HeuresExternesController@getHeuresExternes'));
    Route::post('heuresexterieures', array('as' => 'heuresexterieures.ajouter', 'uses' => 'CalendrierController@postAjouterHeure'));
    Route::get('heuresexterieures/{idHeure}', array('as' => 'heuresexterieures.supprimer', 'uses' => 'HeuresExternesController@getSupprimerHeure'));



    // Routes à classer
    Route::get('monservice', array('as' => 'monservice', 'uses' => 'ServiceController@getService'));
    Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => 'IdentificationController@deconnexion'));
});

Route::get('/test', function()
{
    exit(var_dump(Calendrier::getPeriodesEnseignement("sem00001")));
});



