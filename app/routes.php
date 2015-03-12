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
    Route::get('groupe/supprimer/{id}', array('as' => 'groupe.supprimerGroupe', 'uses' => 'GroupeController@supprimerGroupe'));
    Route::post('groupe/ajouter', array('as' => 'groupe.ajouterGroupe', 'uses' => 'GroupeController@ajouterGroupe'));
    Route::post('groupe/modifier', array('as' => 'groupe.modifierGroupe', 'uses' => 'GroupeController@modifierGroupe'));

    // Route module Formation / UE / Matières
    Route::get('matiere', array('as' => 'matiere', 'uses' => 'MatiereController@getMatieres'));
    Route::get('matiere/modifier/{idFormation}/{idMatiere}', array('as' => 'matiere.modifier', 'uses' => 'MatiereController@modifierMatiere'));
    Route::post('matiere/modifier/', array('as' => 'matiere.postModifierMatiere', 'uses' => 'MatiereController@postModifierMatiere'));
    Route::get('formation/{idFormation}/matiere/{idMatiere}/enseignant/{idEnseignant}/supprimer/', array('as' => 'matiere.supprimerEnseignant', 'uses' => 'MatiereController@supprimerEnseignantMatiere'));
    Route::get('formation/{idFormation}/matiere/{idMatiere}/financement/{idFinancement}/supprimer/', array('as' => 'matiere.supprimerFinancement', 'uses' => 'MatiereController@supprimerFinancementMatiere'));

    // Routes enseignant / status
    Route::get('enseignant', array('as' => 'enseignant', 'uses' => 'EnseignantController@getEnseignants'));
    Route::post('enseignant/status', array('as' => 'enseignant.postModifierStatus', 'uses' => 'StatusEnseignantController@postModifierStatus'));
    
    // Routes module calendrier
    Route::get('calendrier', array('as' => 'calendrier', 'uses' => 'CalendrierController@getCalendrier'));
    Route::get('calendrier/{idFormation}', array('as' => 'calendrier.calendrierFormation', 'uses' => 'CalendrierController@getCalendrierFormation'));
    Route::post('calendrier/{idFormation}/ajouterPeriode', array('as' => 'calendrier.ajouterPeriode', 'uses' => 'CalendrierController@postAjouterPeriode'));
    Route::post('calendrier/{idFormation}/modifierPeriode', array('as' => 'calendrier.modifierPeriode', 'uses' => 'CalendrierController@postModifierPeriode'));
    Route::post('calendrier/{idFormation}/supprimerPeriode', array('as' => 'calendrier.supprimerPeriode', 'uses' => 'CalendrierController@postSupprimerPeriode'));

    // Routes module affectation
    Route::get('affectation', array('as' => 'affectation', 'uses' => 'AffectationController@getAffectation'));
    Route::get('affectation/{idFormation}', array('as' => 'affectation.affectationFormation', 'uses' => 'AffectationController@getAffectationFormation'));

    // Routes à classer
    Route::get('voeux', array('as' => 'voeux', 'uses' => 'VoeuxController@getVoeux'));
    Route::get('monservice', array('as' => 'monservice', 'uses' => 'ServiceController@getService'));
    Route::get('heuresexterieures', array('as' => 'heuresexterieures', 'uses' => 'HeuresExternesController@getHeuresExternes'));
    Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => 'IdentificationController@deconnexion'));
});



