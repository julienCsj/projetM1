@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Affectation <small>@if(isset($module)){{$formation->long_title}} > {{$ue->long_title}} > {{$module->LONG_TITLE}}@endif</small></h1>
        <br>
        <br>
        <!-- WIDGET END -->
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            <ul id="menu" style="width: 100%">
                @foreach ($lesFormations as $f1)
                    <li>
                        <a href="#">{{$f1->short_title}}</a>
                        <ul>
                            @foreach($f1->lesUE as $ue)
                                <li>
                                    <a href="#">{{$ue->short_title}}</a>
                                    <ul>
                                        @foreach($ue->lesModules as $mod)
                                            <li>
                                                <a href="{{ route('affectation.affectationFormation', array($f1->id, $ue->id, $mod->ID))}}">{{$mod->SHORT_TITLE}}</a>
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
                                        <li>{{$type->nb}} {{strtoupper($type->type)}} de ({{$type->duree}} min)</li>
                                    @endforeach
                                </ul>
                                <ul>
                                    <h6>Cours déja affecté :</h6>
                                    @foreach($typeCoursDansGroupe as $typeCoursGroupe)
                                        <li>{{$typeCoursGroupe->nb}} {{strtoupper($typeCoursGroupe->type)}} de ({{$typeCoursGroupe->duree}} min)</li>
                                    @endforeach
                                </ul>
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
                                    ?>
                                    <div class="row col-sm-12">
                                        <div class="well">
                                            [{{strtoupper($groupeCours->type)}}] Groupe de cours de {{$groupeCours->duree}} min
                                            <a class="btn btn-xs btn-danger pull-right" href="{{ route('affectation.supprimerGroupeCours', array($idFormation, $ue->id, $module->ID, $groupeCours->id)); }}">Supprimer</a>
                                            <button onclick="affecterAUnEnseignant({{$nbGroupe}}, '{{$groupeCours->type}}', [])" data-toggle="modal" data-target="#affecter" data-type="{{$groupeCours->type}}" data-type-nb-groupe="{{$nbGroupe}}" href="#" class="btn btn-xs btn-default pull-right"><i class="fa fa-tags"></i> Modifier Affectation</button>
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
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="input">Libellé</label>
                                <input type="text" name="libelle" class="form-control" required/>

                                </select>
                            </div>
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
            {{ Form::open(array('route' => 'groupe.ajouterGroupe')) }}
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
    function affecterAUnEnseignant(nbGroupe, type, precendenteValeur) {
        var el = $("#affectation-formulaire");
        $("#affectation-formulaire .form-group").remove();
        var data = {
            "enseignant": {{json_encode($enseignants)}},
            "nb" : nbGroupe,
            "type" : type,
            "valeur" : []
        }
        var listeEnseignant = "";
        for (var i = data["enseignant"].length - 1; i >= 0; i--) {
            listeEnseignant += "<option value='"+data["enseignant"][i]["enseignant_id"]+"'>"+data["enseignant"][i]["LASTNAME"]+" " +data["enseignant"][i]["FIRSTNAME"]+"</option>";
        };
        for (var i = 0; i < data["nb"]; i++) {
            el.append('<div class="form-group"><label class="col-md-2 control-label">Groupe #'+(i+1)+'</label> <div class="col-md-10"><select name="enseignant-groupe-'+(i+1)+'" class="form-control" required="">'+listeEnseignant+'</select></div></div>');
        }
    }
    @endif

    $(document).ready(function() {
        pageSetUp();

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
            for(i=1; i<=nbSeance; i++) {
                $('#selectNb').append(new Option(i, i));
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