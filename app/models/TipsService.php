<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 19/03/15
 * Time: 10:40
 */

class TipsService {

    public static function getTip($pageName) {
        $lesTips = array(
            "financement" => "Cette page permet de lister, d'ajouter et de modifier les sources de financements. Il sera ensuite possible d'assigner une liste de financements à chaque module.",
            "groupe" => "Cette page permet de gérer un ensemble de groupes pour chaque formation.",
            "uemodule" => "Ce module vous permet de gérer les informations associées aux différents modules telles que les effectifs, la charge en termes d'heures de cours, les enseignants qui interviennent dans la matière ainsi que les financements associés.",
            "enseignant" => "Cette page vous permet de visualiser la liste des enseignants et de mettre a jour leur statut.",
            "calendrier" => "Pour supprimer une période, il faut cliquer dessus, puis valider la suppression.",
            "calendrier_choix" => "Choisissez une formation pour gérer ses périodes. Vous pouvez aussi copier le calendrier d'une formation dans une autre.",
            "affecter" => "",
            "planification" => "Sur cette page, vous pouvez affecter des cours à des périodes en glissant-déposant les groupes de cours.",
            "planification_choix" => "Choisissez une formation pour commencer à planifier les cours.",
            "generationFiche" => "",
            "voeux" => "En tant qu'enseignant, cette page vous permet de faire des voeux sur votre présence ou non a l'IUT. Ces voeux seront ensuite consultable par le responsable de la planification.",
            "monService" => "En tant qu'enseignant, cette page vous permet de visualiser votre charge de travail par semaine.",
            "heuresExternes" => "Cette page vous permez de déclarer vos heures exterieures à l'IUT. Cela permet au responsable de la planification de générer vos fiches ******** plus facilement.",
            "config" => "",
        );

        $retour = ($lesTips[$pageName] == "") ? 'TO DO' : $lesTips[$pageName];
        return $retour;
    }
}