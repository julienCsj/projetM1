<?php
class GroupeController extends BaseController {
	public function getGroupes()
  {
      $lesGroupesParFormation = Groupe::getGroupeModule();

      $data = array(
              'notifications' => array(),
              'lesGroupesParFormation' => $lesGroupesParFormation,
              'breadcrumb' => array('#ApplicationJaneDoe', 'Groupes')
             );
      //exit(var_dump($lesGroupesParFormation));

      return View::make('groupe')->with($data);
  }

  public function supprimerGroupe($id)
  {
      $groupe = Groupe::find($id);
      $groupe->delete();
      return Redirect::action('GroupeController@getGroupes');
  }

  public function ajouterGroupe()
  {
      $groupe = new Groupe();
      $groupe->nom = Input::get('nom');
      $groupe->semestre_id = Input::get('id');
      $groupe->save();
      return Redirect::action('GroupeController@getGroupes');
  }

  public function modifierGroupe()
  {
      $id = Input::get('id');
      $groupe = Groupe::find($id);
      $groupe->nom = Input::get('nom');
      $groupe->save();
      return Redirect::action('GroupeController@getGroupes');
  }

}