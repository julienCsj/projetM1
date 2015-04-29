
@include('layout.header')
<?php
$arrayMonthTotext = array(
    "1" => "jan",
    "2" => "fév",
    "3" => "mars",
    "4" => "avr",
    "5" => "mai",
    "6" => "juin",
    "7" => "juil",
    "8" => "août",
    "9" => "sept",
    "10" => "oct",
    "11" => "nov",
    "12" => "déc"
);
?>
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Aide Génération fiche @if(isset($enseignant)) de {{ucfirst($enseignant->FIRSTNAME)}} {{ucfirst($enseignant->LASTNAME)}} @endif <small></small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("generationFiche")}}
        </div>
        <!-- NEW WIDGET START -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <ul id="menu" style="width: 100%">
                    <label>Choisir un enseignant</label>
                    <select multiple style="width:100%" name="lesEnseignants[]" class="selectmumtiple">
                        @foreach ($lesEnseignants as $e)
                            <option value="{{route('generationFicheProf', array($e->LOGIN))}}">{{ucfirst($e->FIRSTNAME)}} {{ucfirst($e->LASTNAME)}}</option>
                        @endforeach
                    </select>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                @if($idEnseignant != -1)
                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#tabs-a">Voeux</a>
                        </li>
                        <li>
                            <a href="#tabs-b">Heures complémentaires</a>
                        </li>
                        <li>
                            <a href="#tabs-c">Service de l'enseignant par semaine</a>
                        </li>
                        <li>
                            <a href="#tabs-d">Service de l'enseignant global</a>
                        </li>
                    </ul>
                    <div id="tabs-a">
                        <div class="row padding-10">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Lundi</th>
                                    <th>Mardi</th>
                                    <th>Mercredi</th>
                                    <th>Jeudi</th>
                                    <th>Vendredi</th>
                                    <th>Samedi</th>
                                </tr>
                                </thead>
                                <tbody id="tab_voeux">
                                <tr>
                                    <th>8h - 9h30</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>9h30 - 11h</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>11h - 12h30</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>12h30 - 13h30</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>13h30 - 15h</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>15h - 16h30</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>16h30 - 18h</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>18h - 19h30</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                <tr>
                                    <th>19h30 - 21h</th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                    <th><button class="btn"></button></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tabs-b">
                        <div class="row padding-10">
                            <ul>
                            @if(count($heuresexternes) == 0)
                                    <p class="text-center">Aucune heure complementaire déclarée.</p>
                            @else

                                        <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Intitulé</th>
                                                <th>Etablissement</th>
                                                <th>Diplome</th>
                                                <th>N° UE</th>
                                                <th>Type</th>
                                                <th>CM</th>
                                                <th>TD</th>
                                                <th>TP</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($heuresexternes as $heure)
                                                    <tr>
                                                        <td>{{ $heure->intitule }}</td>
                                                        <td>{{ $heure->etablissement }}</td>
                                                        <td>{{ $heure->diplome }}</td>
                                                        <td>{{ $heure->numeroUE }}</td>
                                                        <td>{{ $heure->type }}</td>
                                                        <td>{{ $heure->nbHeureCM }}</td>
                                                        <td>{{ $heure->nbHeureTD }}</td>
                                                        <td>{{ $heure->nbHeureTP }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                            @endif
                                {{ Form::open(array('route' => 'heuresexterieures.ajouter')) }}
                                <input type="hidden" name="enseignantID" value="{{$enseignant->LOGIN}}">
                                <input type="hidden" name="fromFiche" value="true" />
                                <div class="row padding-10">
                                    <div class="form-group col-md-3">
                                        <label>Int. ens.</label>
                                        <input class="form-control spinner-both" type="text" name="intitule" value="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Etab.</label>
                                        <input class="form-control spinner-both" type="text" name="etablissement" value="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Diplome</label>
                                        <input class="form-control spinner-both" type="text" name="diplome" value="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>No UE</label>
                                        <input class="form-control spinner-both" type="text" name="numeroUE" value="">
                                    </div>
                                </div>
                                <div class="row padding-10">
                                    <div class="form-group col-md-2">
                                        <label>Type</label>
                                        <select class="form-control" name="type">
                                            <option value="iut">Services IUT</option>
                                            <option value="mfca">Services MFCA</option>
                                            <option value="ups hors iut mfca">Services UPS hors IUT et MFCA</option>
                                            <option value="pres">Service PRES hors UPS</option>
                                            <option value="hors pres et ups">Service hors PRES et UPS</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>CM</label>
                                        <input class="form-control spinner-both" type="number" name="nbHeureCM" value="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>TD</label>
                                        <input class="form-control spinner-both" type="number" name="nbHeureTD" value="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>TP</label>
                                        <input class="form-control spinner-both" type="number" name="nbHeureTP" value="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>&nbsp;</label>
                                        <input class="form-control btn btn-success" type="submit"  value="Ajouter">
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </div>
                    <div id="tabs-c">
                        <div class="row padding-10">
                            <?php $i = 0; ?>
                            <!-- NEW WIDGET START -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mois</th>
                                        <th><i class="fa fa-calendar"></i> N° Semaine</th>
                                        <th>CM</th>
                                        <th>TD</th>
                                        <th>TP</th>
                                        <th>HETD</th>
                                        <th>Total heures placées</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $printMonth = true;
                                        $precedentMonth = -1;
                                    ?>
                                    @foreach($service as $s)
                                        <tr class="@if($s['cm'] + $s['td'] + $s['tp'] == 0)
                                                info
                                                @else
                                                success
                                                @endif
                                        ">
                                            <td>
                                                <?php
                                                    $d = new DateTime();
                                                    $d->setISODate($s['annee'],$s['numSemaine'],1);    
                                                    $mois = date("n", $d->getTimestamp());
                                                    if ($mois != $precedentMonth) {
                                                        $printMonth = true;
                                                    }
                                                    $precedentMonth = $mois;
                                                ?>
                                                @if($printMonth)
                                                    {{$arrayMonthTotext[$mois]}}
                                                    <?php $printMonth = false; ?>
                                                @endif
                                            </td>
                                            <td>{{$s['label']}}</td>
                                            @if($s['cm'] + $s['td'] + $s['tp'] != 0)
                                            <td>
                                                @if ($s['cm'] != 0)
                                                {{$s['cm'] / 60}}h<br>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($s['td'] != 0)
                                                {{$s['td'] / 60}}h<br>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($s['tp'] != 0)
                                                {{$s['tp'] / 60}}h<br>
                                                @endif
                                            </td>
                                            <td>
                                                {{($s['cm'] * 1.5 + $s['td'] + $s['tp']/1.5)/60}}h<br>
                                            </td>
                                            <td>
                                                {{($s['cm'] + $s['td'] + $s['tp'])/60}}h<br>
                                            </td>
                                            @else
                                            <td colspan="5"></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tabs-d">
                        <div class="row padding-10">
                            <?php
                                $serviceCM = $service_global["cm"];
                                $serviceTD = $service_global["td"];
                                $serviceTP = $service_global["tp"];

                                $serviceCM_iut = $service_global["cm_iut"];
                                $serviceTD_iut = $service_global["td_iut"];
                                $serviceTP_iut = $service_global["tp_iut"];

                                $serviceCM_mfca = $service_global["cm_mfca"];
                                $serviceTD_mfca = $service_global["td_mfca"];
                                $serviceTP_mfca = $service_global["tp_mfca"];

                                $serviceCM_ups_hors_iut_mfca = $service_global["cm_ups hors iut mfca"];
                                $serviceTD_ups_hors_iut_mfca = $service_global["td_ups hors iut mfca"];
                                $serviceTP_ups_hors_iut_mfca = $service_global["tp_ups hors iut mfca"];

                                $serviceCM_hors_pres_et_ups = $service_global["cm_hors pres et ups"];
                                $serviceTD_hors_pres_et_ups = $service_global["td_hors pres et ups"];
                                $serviceTP_hors_pres_et_ups = $service_global["tp_hors pres et ups"];

                                $serviceCM_autre = $service_global["cm_autre"];
                                $serviceTD_autre = $service_global["td_autre"];
                                $serviceTP_autre = $service_global["tp_autre"];

                                $totalServiceCM = $serviceCM + $serviceCM_iut + $serviceCM_mfca + $serviceCM_ups_hors_iut_mfca + $serviceCM_hors_pres_et_ups;
                                $totalServiceTD = $serviceTD + $serviceTD_iut + $serviceTD_mfca + $serviceTD_ups_hors_iut_mfca + $serviceTD_hors_pres_et_ups;
                                $totalServiceTP = $serviceTP + $serviceTP_iut + $serviceTP_mfca + $serviceTP_ups_hors_iut_mfca + $serviceTP_hors_pres_et_ups;

                                $total = $totalServiceCM + $totalServiceTD + $totalServiceTP;
                                $totalHeureService = $totalServiceCM + $totalServiceTD + $totalServiceTP;
                                if ($totalHeureService == 0) {
                                    $totalHeureService = 1;
                                }
                                $pourcentageCM = $totalServiceCM / $totalHeureService;
                                $pourcentageTD = $totalServiceTD / $totalHeureService;
                                $pourcentageTP = $totalServiceTP / $totalHeureService;
                            ?>
                            @if($totalHeureService > 0)
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th></th>
                                    <th>Cours</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                    <th>Calcul TD = TP</th>
                                </tr>
                                <tr>
                                    <td>Heures IUT</td>
                                    <td>{{$serviceCM}}</td>
                                    <td>{{$serviceTD}}</td>
                                    <td>{{$serviceTP}}</td>
                                    <td>{{$serviceCM * $VALEUR_CM_HSERVICE + $serviceTD * $VALEUR_TD_HSERVICE + $serviceTP * $VALEUR_TP_HSERVICE}}</td>
                                </tr>
                                <tr>
                                    <td>Complement d'heures IUT</td>
                                    <td>{{$serviceCM_iut}}</td>
                                    <td>{{$serviceTD_iut}}</td>
                                    <td>{{$serviceTP_iut}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Heures UPS hors IUT et MFCA</td>
                                    <td>{{$serviceCM_ups_hors_iut_mfca}}</td>
                                    <td>{{$serviceTD_ups_hors_iut_mfca}}</td>
                                    <td>{{$serviceTP_ups_hors_iut_mfca}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Heures hors PRES et UPS</td>
                                    <td>{{$serviceCM_hors_pres_et_ups}}</td>
                                    <td>{{$serviceTD_hors_pres_et_ups}}</td>
                                    <td>{{$serviceTP_hors_pres_et_ups}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Heures MFCA</td>
                                    <td>{{$serviceCM_mfca}}</td>
                                    <td>{{$serviceTD_mfca}}</td>
                                    <td>{{$serviceTP_mfca}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Heures PRES hors UPS</td>
                                    <td>{{$serviceCM_autre}}</td>
                                    <td>{{$serviceTD_autre}}</td>
                                    <td>{{$serviceTP_autre}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><strong>{{$totalServiceCM}}</strong></td>
                                    <td><strong>{{$totalServiceTD}}</strong></td>
                                    <td><strong>{{$totalServiceTP}}</strong></td>
                                    <td><strong>{{$totalServiceCM * $VALEUR_CM_HSERVICE + $totalServiceTD * $VALEUR_TD_HSERVICE + $totalServiceTP * $VALEUR_TP_HSERVICE}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Pourcentage</td>
                                    <td>{{round($pourcentageCM*100,2)}}%</td>
                                    <td>{{round($pourcentageTD*100,2)}}%</td>
                                    <td>{{round($pourcentageTP*100,2)}}%</td>
                                    <td></td>
                                </tr>
                            </table>

                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <td>Service statutaire</td>
                                    <td>{{$statut->SERVICE_STATUTAIRE}}h</td>
                                </tr>
                                <tr>
                                    <td>Service dû</td>
                                    <td>{{$statut->SERVICE_STATUTAIRE}}h</td>
                                </tr>
                                <tr>
                                    <td>Service en TD = TP</td>
                                    <td>{{$totalServiceCM * $VALEUR_CM_HSERVICE + $totalServiceTD * $VALEUR_TD_HSERVICE + $totalServiceTP * $VALEUR_TP_HSERVICE}}h</td>
                                </tr>
                                <tr>
                                    <th>Service dû effectué</th>
                                    <th>@if($totalHeureService > $statut->SERVICE_STATUTAIRE)
                                     OUI 
                                     @else 
                                     NON 
                                     @endif</th>
                                </tr>
                            </table>

                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th>Repartition</th>
                                    <th>Cours</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                    <th>Total en eq. TD</th>
                                </tr>
                                <?php
                                    // HeureService est égal à totalHeureService mais a pour max le service service statuaire
                                    $heureService = $statut->SERVICE_STATUTAIRE;
                                    if ($totalHeureService < $statut->SERVICE_STATUTAIRE) {
                                        $heureService = $totalHeureService;
                                    }
                                    $totalHeureServiceCM = $heureService * $pourcentageCM / $VALEUR_CM_HSERVICE;
                                    $totalHeureServiceTD = $heureService * $pourcentageTD / $VALEUR_TD_HSERVICE;
                                    $totalHeureServiceTP = $heureService * $pourcentageTP / $VALEUR_TP_HSERVICE;
                                ?>
                                <tr>
                                    <td>Service</td>
                                    <td>{{round($totalHeureServiceCM, 2)}}</td>
                                    <td>{{round($totalHeureServiceTD, 2)}}</td>
                                    <td>{{round($totalHeureServiceTP, 2)}}</td>
                                    <td><strong>{{round($totalHeureServiceCM * $VALEUR_CM_HSERVICE + $totalHeureServiceTD * $VALEUR_TD_HSERVICE + $totalHeureServiceTP * $VALEUR_TP_HSERVICE, 2)}}</strong></td>
                                </tr>
                                <tr>
                                    <td>HCC</td>
                                    <td>{{round($totalServiceCM - $totalHeureServiceCM, 2)}}</td>
                                    <td>{{round($totalServiceTD - $totalHeureServiceTD, 2)}}</td>
                                    <td>{{round($totalServiceTP - $totalHeureServiceTP, 2)}}</td>
                                    <td><strong>{{round(($totalServiceCM - $totalHeureServiceCM)*$VALEUR_CM_HSERVICE_HCC + ($totalServiceTD - $totalHeureServiceTD) * $VALEUR_TD_HSERVICE_HCC + ($totalServiceTP - $totalHeureServiceTP) * $VALEUR_TP_HSERVICE_HCC,2)}}</strong></td>
                                </tr>
                            </table>
                            @else
                                    <p class="text-center">Aucune heure attribuée à cet enseignant.</p>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                    <div class="well text-align-center">Veuillez choisir un enseignant ...</div>
                @endif
                <br />
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    function initializeButton(data) {
        for (var j = 0; j < 6; j++) { // chaque jour
            for (var i = 0; i < 9; i++) { // chaque créneau horaire
                if (j==5 && i > 2) {
                    // does nothing on samedi morning
                    break;
                }
                var button = $("#tab_voeux tr:eq("+i+") th:eq("+(j+1)+") button");
                if (data[j][i]) {
                    button.html("Disponible")
                            .addClass("btn-success btn-disponibilite disabled")
                            .attr("data-dispo", 1);
                } else {
                    button.html("Indisponible")
                            .addClass("btn-warning btn-disponibilite disabled")
                            .attr("data-dispo", 0);
                }
                button.attr("data-jour",j).attr("data-creneau", i);
            }
        }
        $(".btn-disponibilite").bind('click', function () {
            var dispo = ($(this).attr("data-dispo") == 0 ? 1 : 0);
            modifier_voeux(dispo,
                    $(this).attr("data-jour"),
                    $(this).attr("data-creneau"));
            return false;
        })
    }
    function modifier_voeux(dispo, jour, creneau) {
        var from_data = {
            "dispo" : parseInt(dispo),
            "jour" : parseInt(jour),
            "creneau" : parseInt(creneau),
        };
        $.ajax({
            url: "voeux",
            data: from_data,
            type: "POST"
        })
                .done(function (html) {
                    $.bigBox({
                        title: "Modification réalisé",
                        content: "Vos voeux ont bien été mis à jour !",
                        color: "#3276B1",
                        icon: "fa fa-bell swing animated",
                        timeout: 2000
                    });
                    // modifie la valeur dans le tableau
                    var button = $("#tab_voeux tr:eq("+from_data["creneau"] +") th:eq("+(from_data["jour"]+1)+") button");
                    if (from_data["dispo"] == 1) {
                        button
                                .attr("data-dispo", 1)
                                .removeClass("btn-warning")
                                .addClass("btn-success")
                                .html("Disponible");
                    } else {
                        button
                                .attr("data-dispo", 0)
                                .removeClass("btn-success")
                                .addClass("btn-warning")
                                .html("Indisponible");
                    }
                })
                .fail(function (html) {
                    $.bigBox({
                        title: "Echec de la modification",
                        content: "Un problème est survenu !",
                        color: "#C46A69",
                        icon: "fa fa-warning swing animated",
                        timeout: 3000
                    });
                });
    }

    $(document).ready(function () {
        $('#tabs').tabs();
        $("#menu").menu();

        $('.selectmumtiple').select2()
                .on("select2-selecting", function(e) {
                    console.log("selecting val=" + e.val + " choice=" + e.object.text);
                    window.location.replace(e.val);
                });

        @if($idEnseignant != -1)
        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
        var data = {{json_encode($voeux)}};
        initializeButton(data);
        @endif
    });





</script>