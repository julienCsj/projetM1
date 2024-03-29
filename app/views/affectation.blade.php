@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Affectation <small>@if(isset($module)){{$formation->long_title}} > {{$ue->long_title}} > {{$module->LONG_TITLE}}@endif</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("affecter")}}
        </div>
        <div class="row">
            @if($idFormation != -1)
                <div class="row pull-right margin-right-5 padding-10">
                    <a href="{{ route('planification.planificationFormation', array($formation->id))}}" class="btn btn-primary">Aller à la planification</a>
                    <a href="{{ route('moduleModification', array($formation->id, $ue->id, $module->ID))}}" class="btn btn-primary">Aller à la configuration</a>
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <ul id="menu" style="width: 100%">
                    @foreach ($lesFormations as $f1)
                        <li>
                            <a href="#">{{$f1->short_title}}</a>
                            <ul>
                                @foreach($f1->lesUE as $ue1)
                                    <li>
                                        <a href="#">{{$ue1->short_title}}</a>
                                        <ul>
                                            @foreach($ue1->lesModules as $mod1)
                                                <li>
                                                    <a href="{{ route('affectation.affectationFormation', array($f1->id, $ue1->id, $mod1->ID))}}">{{$mod1->SHORT_TITLE}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                @if($idFormation != -1)
                    <div id="tabs">
                        <ul>
                            <li>
                                <a href="#tabs-a">Les groupes de cours</a>
                            </li>
                            <li>
                                <a href="#tabs-b">Les périodes</a>
                            </li>
                        </ul>
                        <div id="tabs-a">
                            <div class="row padding-10">
                                <div id="groupes" class="col-sm-12">
                                    <h3>Création et affectation des groupes de cours pour {{$module->LONG_TITLE}}</h3>
                                    <ul>
                                        <h6>Cours pas encore affecté :</h6>
                                        @foreach($typeCours as $type)
                                            <li>{{$type->nb}} {{strtoupper($type->type)}} de {{$type->duree}} min</li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <h6>Cours déja affecté :</h6>
                                        @foreach($typeCoursDansGroupe as $typeCoursGroupe)
                                            <li>{{$typeCoursGroupe->nb}} {{strtoupper($typeCoursGroupe->type)}} de {{$typeCoursGroupe->duree}} min</li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <h6>Cours en commun avec un autre module :</h6>
                                        @foreach($typeCoursDansGroupeCommun as $typeCoursGroupeCommun)
                                            <li>{{$typeCoursGroupeCommun->nb}} {{strtoupper($typeCoursGroupeCommun->type)}} de {{$typeCoursGroupeCommun->duree}} min
                                                <a href="{{ route('affectation.affectationFormation', array($typeCoursGroupeCommun->formationID, $typeCoursGroupeCommun->ueID, $typeCoursGroupeCommun->moduleID))}}">Gérer la matière source</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <h6>Liste des groupes de cours :</h6>
                                    @foreach ($groupesCours as $groupeCours)
                                        <?php
                                        switch ($groupeCours->type) {
                                            case 'cm':
                                            $nbGroupe = $groupeCours->groupe_cm;
                                                break;
                                            case 'td':
                                            $nbGroupe = $groupeCours->groupe_td;
                                                break;
                                            case 'tp':
                                            $nbGroupe = $groupeCours->groupe_tp;
                                                break;
                                        }
                                        // Passe cette valeur à la vue pour la modal :'(
                                        $_groupesCoursEnseignantModule = array();
                                        foreach ($groupesCoursEnseignantModule as $key => $v) {
                                            if ($v->groupecours_id == $groupeCours->id)
                                                $_groupesCoursEnseignantModule[] = $v;
                                        }
                                        // Ajoute une couleur rouge au bouton si il n'a pas de données 
                                        $classBoutonRouge = " btn-success";
                                        if (sizeof($_groupesCoursEnseignantModule) == 0) {
                                            $classBoutonRouge = " btn-info";
                                        }
                                        ?>
                                        <div class="row col-sm-12">
                                            <div class="well">
                                                [{{strtoupper($groupeCours->type)}}] {{$nbCoursParGroupeCours[$groupeCours->id]}} séance(s) de {{$groupeCours->duree}} min ({{$nbGroupe}} groupe(s)) - {{$groupeCours->libelle}}
                                                <a class="btn btn-xs btn-danger pull-right" href="{{ route('affectation.supprimerGroupeCours', array($idFormation, $ue->id, $module->ID, $groupeCours->id)); }}">Supprimer</a>
                                                <button onclick='affecterAUnEnseignant({{$groupeCours->id}},{{$nbGroupe}}, "{{$groupeCours->type}}", {{json_encode($_groupesCoursEnseignantModule)}})' data-toggle="modal" data-target="#affecter" data-type="{{$groupeCours->type}}" data-type-nb-groupe="{{$nbGroupe}}" href="#" class="btn btn-xs pull-right {{$classBoutonRouge}}"><i class="fa fa-tags"></i> Modifier Affectation</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button class="btn btn-success" data-toggle="modal" data-target="#ajouter" href="#"><i class="fa fa-plus"></i> Ajouter un groupe</button>
                                </div>
                            </div>
                        </div>
                        <div id="tabs-b">
                            <div class="row padding-10">
                                <ul>
                                @foreach($periodes as $p1)
                                    <li>{{$p1['nom']}} - Du {{$p1['dateDebut']}} au {{$p1['dateFin']}} ({{count($p1['sem'])}} semaines)</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center well">Veuillez selectionner un module...</p>
                @endif
            </div>
        </div>
    </div>
</section>

@if($idFormation != -1)
<div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'un groupe de cours</h4>
            </div>
            {{ Form::open(array('route' => 'affectation.ajouterGroupeCours')) }}
            <input type="hidden" name="idModule" value="{{$module->ID}}" />
            <input type="hidden" name="idFormation" value="{{$formation->id}}">
            <input type="hidden" name="idUe" value="{{$ue->id}}">
            <div class="modal-body">
                <div class="row form-horizontal">
                    <div class="col-sm-12">
                        <div id="alerts">

                        </div>
                        <div class="form-group">
                            <label class="input">Libellé</label>
                            <input type="text" name="libelle" class="form-control" required value="{{$module->SHORT_TITLE}} "/>
                        </div>
                        <div class="form-group">
                            <label class="input">Type de séances</label>
                            <select name="type" id="selectType" class="form-control" required/>
                            <option value="-1">Selectionner un type ...</option>
                            @foreach ($typeCours as $type)
                                <option value="{{$type->type}}-{{$type->duree}}">{{strtoupper($type->type)}} de {{$type->duree}} min</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="input">Nombre de séances</label>
                            <select name="nb" id="selectNb" class="form-control" required/>

                            </select>
                        </div>
                        <div class="form-group" id="divEnCommun">
                            <label class="input">Il s'agit d'un groupe de cours en commun</label>
                            <input name="enCommun" id="enCommun" class="form-control" type="checkbox" />
                        </div>

                        <div class="form-group" id="choixModuleCommun">
                            <label>Avec quel(s) module(s) ces cours sont-ils en commun ?</label>
                            <select multiple style="width:100%" id="modulePossible" name="lesModulesEnCommun[]" class="select2">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="modal fade" id="affecter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Affectation des séances à des enseignants</h4>
            </div>
            {{ Form::open(array('route' => array('affectation.ajouterLienGroupeCoursModuleEnseignant', $idFormation, $ue->id, $module->ID))) }}
            <div class="modal-body">
                <div class="row form-horizontal">
                    <div id="affectation-formulaire" class="col-md-12">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
            <input type="hidden" name="groupe_cours_id" id="affecter_groupe_cours_id">
            {{ Form::close() }}
        </div>
    </div>
</div>
<?php
foreach($typeCoursMap as $k => $v) {
    echo "<input type=\"hidden\" id=\"$k\" value=\"$v\" />";
}
?>
@endif

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    @if($idFormation != -1)

    $('#choixModuleCommun').hide();

    function affecterAUnEnseignant(groupeCoursId, nbGroupe, type, _groupesCoursEnseignantModule) {
        var el = $("#affectation-formulaire");
        $("#affectation-formulaire .form-group").remove();
        var data = {
            "enseignant": {{json_encode($enseignants)}},
            "financement" :{{json_encode($financements)}},
            "groupeCoursId": groupeCoursId,
            "nb" : nbGroupe,
            "type" : type,
            "_groupesCoursEnseignantModule" : _groupesCoursEnseignantModule
        }

        for (var i = 0; i < data["nb"]; i++) {
            var listeEnseignant = "";
            for (var j = data["enseignant"].length - 1; j >= 0; j--) {
                listeEnseignant += "<option value='"+data["enseignant"][j]["enseignant_id"]+"' ";
                if (_groupesCoursEnseignantModule[i] != null && _groupesCoursEnseignantModule[i]["enseignant_id"] == data["enseignant"][j]["enseignant_id"]) {
                    listeEnseignant += "selected ";
                }
                listeEnseignant += ">"+data["enseignant"][j]["LASTNAME"]+" " +data["enseignant"][j]["FIRSTNAME"]+"</option>";
            };
            var listeFinancement = "";
            for (var j = data["financement"].length - 1; j >= 0; j--) {
                listeFinancement += "<option value='"+data["financement"][j]["id"]+"' ";
                if (_groupesCoursEnseignantModule[i] != null && _groupesCoursEnseignantModule[i]["financement_id"] == data["financement"][j]["id"]) {
                    listeFinancement += "selected ";
                }
                listeFinancement += ">"+data["financement"][j]["libelle"]+"</option>";
            };
            el.append('<div class="form-group"><label class="col-md-2 control-label">Groupe #'+(i+1)+'</label> <div class="col-md-5"><select name="enseignant-groupe[]" class="form-control" required="">'+listeEnseignant+'</select></div><div class="col-md-5"><select name="financement-groupe[]" class="form-control" required="">'+listeFinancement+'</select></div></div>');
        }
        $("#affecter_groupe_cours_id").val(data["groupeCoursId"]);
    }
    @endif

    $(document).ready(function() {
       // pageSetUp();

        $("#menu").menu();
        $('#tabs').tabs();
        $('#tabs2').tabs();


        @if($idFormation != -1)
        $('#selectType').change(function() {
            val = $(this).val();
            console.log(val);

            selectNb = $('#selectNB');
            nbSeance =  $('#'+val).val();
            nbSeance = parseInt(nbSeance);

            $('#selectNb').find('option').remove()
            for(i=1; i<=nbSeance-1; i++) {
                $('#selectNb').append(new Option(i, i));
            }
            $('#selectNb').append(new Option(nbSeance, nbSeance, true, true));
        });


        $('#enCommun').change(function() {
            if($(this).is(":checked")) {
                type = $('#selectType').find(":selected").val();
                nbSeance =  $('#selectNb').find(":selected").val();
                nbSeance = parseInt(nbSeance);

                if(type == -1 || isNaN(nbSeance)) {
                    $('#alerts').html("<div class=\"alert alert-warning fade in\">" +
                    "<button class=\"close\" data-dismiss=\"alert\">×</button>" +
                    "<strong>Attention</strong> Veuillez choisir un type et un nombre de séances pour continuer." +
                    "</div>");
                } else {
                    $('#alerts').html();
                    // Envoyer l'AJAX

                    var from_data = {
                        "type" : type,
                        "nb": nbSeance,
                        "idModule": "{{$module->ID}}",
                    };

                    $.ajax({
                        url: "/affectation/{{$formation->id}}/{{$ue->id}}/{{$module->ID}}/enCommun",
                        data: from_data,
                        type: "POST"
                    })
                    .done(function (html) {
                        console.log(html);
                        $('#choixModuleCommun').show();
                        $('#modulePossible').find('option').remove()
                        $.each(html, function(index, value) {
                            $('#modulePossible').append(new Option(value.LONG_TITLE, value.ID));
                        });

                    })
                    .fail(function (html) {
                        $.bigBox({
                            title: "Erreur",
                            content: "Erreur de communication avec le serveur",
                            color: "#C46A69",
                            icon: "fa fa-warning swing animated",
                            timeout: 3000
                        });
                    });
                }
                console.log("La box est check");
                console.log("Type : : "+type);
                console.log("Nombre : "+nbSeance);
            }
        });


        $('#dialog-message').dialog({
            autoOpen: false,
            modal: true,
            title: "Planifier un cours",
            buttons: [{
                html: "Annuler",
                "class": "btn btn-default",
                click: function () {
                    $(this).dialog("close");
                }
            }, {
                html: "<i class='fa fa-check'></i>&nbsp; Valider",
                "class": "btn btn-primary",
                click: function () {
                    $(this).dialog("close");
                }
            }]
        });
        @endif
    });
</script>