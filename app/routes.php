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



// Connexion non obligatoire
Route::group(array('before' => 'guest'), function () { // Login not required
    Route::get('/',                  array('as' => 'dashboard',              'uses' => 'DashboardController@getIndex'));
    Route::get('formation',          array('as' => 'formation',              'uses' => 'FormationController@getFormations'));
    Route::get('matiere',            array('as' => 'matiere',                'uses' => 'MatiereController@getMatieres'));
    Route::get('enseignant',         array('as' => 'enseignant',             'uses' => 'EnseignantController@getEnseignants'));
    Route::get('calendrier',         array('as' => 'calendrier',             'uses' => 'CalendrierController@getCalendrier'));
    Route::get('affectation',        array('as' => 'affectation',            'uses' => 'AffectationController@getAffectation'));
    Route::get('voeux',              array('as' => 'voeux',                  'uses' => 'VoeuxController@getVoeux'));
    Route::get('monservice',         array('as' => 'monservice',             'uses' => 'ServiceController@getService'));
    Route::get('heuresexterieures',  array('as' => 'heuresexterieures',      'uses' => 'HeuresExternesController@getHeuresExternes'));

});

// Connexion obligatoire
Route::group(array('before' => 'auth'), function() // Login required
{
    Route::get('dashboard',                 array('as' => 'dashboard',              'uses' => 'DashboardController@getIndex'));
    Route::get('deconnexion',               array('as' => 'deconnexion',            'uses' => 'UserController@getDeconnexion'));
    Route::get('trajet/liste',              array('as' => 'trajet_liste',           'uses' => 'TrajetController@getListe'));
    Route::get('trajet/ajouter',            array('as' => 'trajet_ajouter',         'uses' => 'TrajetController@getAjouter'));
    Route::get('exporter',                  array('as' => 'exporter',               'uses' => 'ExporterController@getFormulaireExporter'));
    Route::get('timeline',                  array('as' => 'timeline',               'uses' => 'TimelineController@getTimeline'));
    Route::get('journal',                   array('as' => 'journal',                'uses' => 'TimelineController@getTimeline'));
    Route::get('contact',                   array('as' => 'contact',                'uses' => 'ContactController@getFormulaire'));
    Route::get('profil',                    array('as' => 'profil',                 'uses' => 'TimelineController@getTimeline'));
    Route::get('adresse',                   array('as' => 'adresse',                'uses' => 'AdresseController@getFormulaire'));
    Route::get('adresse/supprimer/{id}', 'AdresseController@supprimer');
    Route::get('adresse/modifier/{id}', 'AdresseController@getFormulaire');
    Route::get('trajet/supprimer/{id}', 'TrajetController@supprimer');
    Route::get('trajet/modifier/{id}', 'TrajetController@getModifier');

});

Route::post('connexion',         array('as' => 'post.connexion',        'uses' => 'UserController@postConnexion'));
Route::post('inscription',       array('as' => 'post.inscription',      'uses' => 'UserController@postInscription'));
Route::post('premiere_inscription',     array('as' => 'post.premiere_connexion','uses' => 'DashboardController@postPremiereInscription'));
Route::post('adresse/ajouter',      array('as' => 'post.adresse','uses' => 'AdresseController@ajouterAdresse'));
Route::post('trajet/ajouter',      array('as' => 'post.ajouter_trajet','uses' => 'TrajetController@ajouter'));
Route::post('trajet/modifier',      array('as' => 'post.modifier_trajet','uses' => 'TrajetController@postModifier'));
