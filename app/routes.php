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

Route::get('/', array('as' => 'dashboard', 'uses' => 'DashboardController@getIndex'));

// Routes module financement
Route::get('financement',           array('as' => 'financement',                      'uses' => 'FinancementController@getFinancement'));
Route::get('financement/supprimer/{id}', array('as' => 'financement.supprimerFinancement', 'uses' => 'FinancementController@supprimerFinancement'));
Route::post('financement/ajouter',   array('as' => 'financement.ajouterFinancement',   'uses' => 'FinancementController@ajouterFinancement'));
Route::post('financement/modifier/{id}',   array('as' => 'financement.modifierFinancement',   'uses' => 'FinancementController@modifierFinancement'));

// Routes module groupe
Route::get('groupe', array('as' => 'groupe', 'uses' => 'GroupeController@getGroupes'));
Route::get('groupe/supprimer/{id}', array('as' => 'groupe.supprimerGroupe', 'uses' => 'GroupeController@supprimerGroupe'));
Route::post('groupe/ajouter',   array('as' => 'groupe.ajouterGroupe',   'uses' => 'GroupeController@ajouterGroupe'));
Route::post('groupe/modifier',   array('as' => 'groupe.modifierGroupe',   'uses' => 'GroupeController@modifierGroupe'));


// Route module Formation / UE / Matières
Route::get('matiere', array('as' => 'matiere', 'uses' => 'MatiereController@getMatieres'));
Route::get('matiere/modifier/{idFormation}/{idMatiere}', array('as' => 'matiere.modifier', 'uses' => 'MatiereController@modifierMatiere'));
Route::post('matiere/modifier/', array('as' => 'matiere.postModifierMatiere', 'uses' => 'MatiereController@postModifierMatiere'));
Route::get('formation/{idFormation}/matiere/{idMatiere}/enseignant/{idEnseignant}/supprimer/', array('as' => 'matiere.supprimerEnseignant', 'uses' => 'MatiereController@supprimerEnseignantMatiere'));
Route::get('formation/{idFormation}/matiere/{idMatiere}/financement/{idFinancement}/supprimer/', array('as' => 'matiere.supprimerFinancement', 'uses' => 'MatiereController@supprimerFinancementMatiere'));


// Routes à classer

Route::get('enseignant', array('as' => 'enseignant', 'uses' => 'EnseignantController@getEnseignants'));
Route::get('calendrier', array('as' => 'calendrier', 'uses' => 'CalendrierController@getCalendrier'));
Route::get('affectation', array('as' => 'affectation', 'uses' => 'AffectationController@getAffectation'));
Route::get('voeux', array('as' => 'voeux', 'uses' => 'VoeuxController@getVoeux'));
Route::get('monservice', array('as' => 'monservice', 'uses' => 'ServiceController@getService'));
Route::get('heuresexterieures', array('as' => 'heuresexterieures', 'uses' => 'HeuresExternesController@getHeuresExternes'));
Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => ''));


