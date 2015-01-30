<?php

class FinancementController extends BaseController {

    public function getFinancement() {
        $data = array(
            'financements' => Financement::all(),
            'breadcrumb' => array("#Application sans nom", "Gestion des financements")
        );
        return View::make('financement')->with($data);
    }
    
    public function ajouterFinancement() {
        $financement = new Financement();
        $financement->montant = Input::get('montant');
        $financement->libelle = Input::get('libelle');
        $financement->save();
        return Redirect::action('FinancementController@getFinancement');
    }
    
    public function supprimerFinancement($id) {
        $financement = Financement::find($id);
        $financement->delete();
        return Redirect::action('FinancementController@getFinancement')->with($data);
    }
    
    public function modifierFinancement() {
        $id = Input::get('id');
        $financement = Financement::find($id);
        $financement->montant = Input::get('montant');
        $financement->libelle = Input::get('libelle');
        $financement->save();
        return Redirect::action('FinancementController@getFinancement');
    }

}
