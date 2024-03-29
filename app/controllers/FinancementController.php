<?php

class FinancementController extends BaseController {

    public function getFinancement() {
        $data = array(
            'financements' => Financement::all(),
            'breadcrumb' => array("Scolarel", "Gestion des financements")
        );
        return View::make('financement')->with($data);
    }
    
    public function ajouterFinancement() {
        $financement = new Financement();
        $financement->libelle = Input::get('libelle');
        $financement->save();
        return Redirect::action('FinancementController@getFinancement');
    }
    
    public function supprimerFinancement($id) {
        $financement = Financement::find($id);
        $financement->delete();
        return Redirect::action('FinancementController@getFinancement');
    }
    
    public function modifierFinancement() {
        $id = Input::get('id');
        $financement = Financement::find($id);
        $financement->libelle = Input::get('libelle');
        $financement->save();
        return Redirect::action('FinancementController@getFinancement');
    }
    
    
   

}
