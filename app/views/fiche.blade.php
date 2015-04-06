
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
                            <a href="#tabs-b">Heures extérieures</a>
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
                                    <p class="text-center">Aucune heure externe déclarée.</p>
                            @else
                                @foreach($heuresexternes as $h)
                                    <li>{{$h->libelle}} ({{$h->nbHeure}} heures) de type {{$h->type}}. </li>
                                @endforeach
                            @endif
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
                                        <th>Charge de travail</th>
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
                                            <td>Semaine #{{$s['numSemaine']}} - {{$s['label']}}</td>
                                            <td>
                                                @if($s['cm'] + $s['td'] + $s['tp'] != 0)
                                                @if ($s['cm'] != 0)
                                                CM : {{$s['cm'] / 60}}h<br>
                                                @endif
                                                @if ($s['td'] != 0)
                                                TD : {{$s['td'] / 60}}h<br>
                                                @endif
                                                @if ($s['tp'] != 0)
                                                TP : {{$s['tp'] / 60}}h<br>
                                                @endif
                                                Total service : {{($s['cm']*$VALEUR_CM_HSERVICE + $s['td']*$VALEUR_TD_HSERVICE + $s['tp']) / 60}}h<br/>
                                                Total heures placées : {{($s['cm'] + $s['td'] + $s['tp'])/60}}h<br>
                                                @else
                                                Pas de cours assigné
                                                @endif
                                            </td>
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

                                $specifiqueCM = 0;
                                $specifiqueTD = 0;
                                $specifiqueTP = 0;

                                $hccCM = $service_global["hcc_cm"];
                                $hccTD = $service_global["hcc_td"];
                                $hccTP = $service_global["hcc_tp"];
                            ?>
                            @if($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP > 0)
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th></th>
                                    <th>Cours</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                    <th>Calcul TD = TP</th>
                                </tr>
                                <tr>
                                    <td>Service</td>
                                    <td>{{$serviceCM}}</td>
                                    <td>{{$serviceTD}}</td>
                                    <td>{{$serviceTP}}</td>
                                    <td>{{$serviceCM + $serviceTD + $serviceTP}}</td>
                                </tr>
                                <tr>
                                    <td>Spécifique</td>
                                    <td>{{$specifiqueCM}}</td>
                                    <td>{{$specifiqueTD}}</td>
                                    <td>{{$specifiqueTP}}</td>
                                    <td>{{$specifiqueCM + $specifiqueTD + $specifiqueTP}}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><strong>{{$serviceCM + $specifiqueCM}}</strong></td>
                                    <td><strong>{{$serviceTD + $specifiqueTD}}</strong></td>
                                    <td><strong>{{$serviceTP + $specifiqueTP}}</strong></td>
                                    <td><strong>{{$serviceCM + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Pourcentage</td>
                                    <td>{{round((($serviceCM*1.5 + $specifiqueCM) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</td>
                                    <td>{{round((($serviceTD + $specifiqueTD) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</td>
                                    <td>{{round((($serviceTP + $specifiqueTP) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</td>
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
                                    <td>{{$serviceCM + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP}}h</td>
                                </tr>
                                <tr>
                                    <th>Service dû effectué</th>
                                    <th>@if($serviceCM + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP > $statut->SERVICE_STATUTAIRE)
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
                                <tr>
                                    <td>Service</td>
                                    <td>{{($serviceCM + $specifiqueCM) - $hccCM}}</td>
                                    <td>{{($serviceTD + $specifiqueTD) - $hccTD}}</td>
                                    <td>{{($serviceTP + $specifiqueTP) - $hccTP}}</td>
                                    <td><strong>{{(($serviceCM + $specifiqueCM) - $hccCM)*1.5 + (($serviceTD + $specifiqueTD) - $hccTD) + (($serviceTP + $specifiqueTP) - $hccTP)}}</strong></td>
                                </tr>
                                <tr>
                                    <td>HCC</td>
                                    <td>{{$hccCM}}</td>
                                    <td>{{$hccTD}}</td>
                                    <td>{{$hccTP}}</td>
                                    <td><strong>{{round($hccCM*1.5 + $hccTD + $hccTP*(2/3),2)}}</strong></td>
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