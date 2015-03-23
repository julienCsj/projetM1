<?php
class CalendrierController extends BaseController {
    public function getCalendrier()
    {
        $data = array(
            'lesFormations' => Formation::all(),
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Calendriers')
        );

        return View::make('calendrier_choix_formation')->with($data);
    }

    public function getCalendrierFormation($idFormation) {
        $formation = Formation::getFormationSimple($idFormation);

        $data = array('idFormation' => $idFormation,
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', array("link"=> URL::route('calendrier'),"label"=>'Calendriers'), $formation->long_title),
            'formation' => $formation,
            'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());

        return View::make('calendrier')->with($data);
    }

    public function postAjouterPeriode() {
        $calendrier = new Calendrier();
        $calendrier->nom = Input::get("nom");
        $calendrier->dateDebut = Input::get('dateDebut');
        $calendrier->dateFin = Input::get('dateFin');
        $calendrier->idFormation = Input::get('idFormation');
        $calendrier->type = Input::get("type");
        $calendrier->eventID = Input::get("eventID");
        $calendrier->save();

        return "Ok";
    }

    public function postModifierPeriode() {
        $idFormation = Input::get('idFormation');
        $nom = Input::get("nom");
        $eventID = Input::get("eventID");

        $calendrier = Calendrier::where('idFormation', '=', $idFormation)->where('eventID', '=', $eventID)->firstOrFail();
        $calendrier->dateFin = Input::get('dateFin');
        $calendrier->dateDebut = Input::get('dateDebut');
        $calendrier->save();

        return "Ok";
    }

    public function postSupprimerPeriode() {
        $idFormation = Input::get('idFormation');
        $idEvent = Input::get("eventID");
        $calendrier = Calendrier::where('idFormation', '=', $idFormation)->where('eventID', '=', $idEvent)->delete();
        return "Ok";
    }

    public function postCopierCalendrier()
    {
        $idFormationDst = Input::get('idFormationDst');
        $idFormationSrc = Input::get('idFormationSrc');

        // Supprimer les event du calendrier destination
        Calendrier::where("idFormation", '=', $idFormationDst)->delete();

        // Recuperer les events du calendrier source
        $lesPeriodesSources = Calendrier::where("idFormation", '=', $idFormationSrc)->get();

        // Pour chaque event, le copier dans le nouveau calendrier
        foreach($lesPeriodesSources as $p) {
            $periode = new Calendrier;
            $periode->idFormation = $idFormationDst;
            $periode->dateDebut = $p->dateDebut;
            $periode->dateFin = $p->dateFin;
            $periode->nom = $p->nom;
            $periode->type = $p->type;
            $periode->eventID = $p->eventID;
            $periode->save();
        }
        // Rediriger vers le nouveau calendrier
        return Redirect::route('calendrier.calendrierFormation', array('idFormation' => $idFormationDst));
    }
}