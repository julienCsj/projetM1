
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Aide Génération fiche <small></small></h1>
        <br/>
        <br/>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info fade in">
                <strong>A propos de cette page.</strong> {{TipsService::getTip("generationFiche")}}
            </div>
        </div>
        <!-- NEW WIDGET START -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <ul id="menu" style="width: 100%">
                    @foreach ($lesEnseignants as $e)
                        <li>
                            <a href="{{route('generationFicheProf', array($e->LOGIN))}}">{{ucfirst($e->FIRSTNAME)}} {{ucfirst($e->LASTNAME)}}</a>
                        </li>
                    @endforeach
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
                                </tr>
                                <tr>
                                    <th>9h30 - 11h</th>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tabs-b">
                        <div class="row padding-10">
                            <ul>
                            @foreach($heuresexternes as $h)
                                <li>{{$h->libelle}} ({{$h->nbHeure}} heures) de type {{$h->type}}. </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="tabs-c">
                        <div class="row padding-10">
                            Calendrier
                        </div>
                    </div>
                    <div id="tabs-d">
                        <div class="row padding-10">
                            <?php
                                $serviceCM = 16.5;
                                $serviceTD = 326.5;
                                $serviceTP = 14;

                                $specifiqueCM = 0;
                                $specifiqueTD = 3;
                                $specifiqueTP = 0;

                                $hccCM = 7.2;
                                $hccTD = 143.4;
                                $hccTP = 6.1;

                            ?>

                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th></th>
                                    <th>Cours</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                    <th>Calcul TD = TP</th>
                                </tr>
                                <tr>
                                    <th>Service</th>
                                    <th>{{$serviceCM}}</th>
                                    <th>{{$serviceTD}}</th>
                                    <th>{{$serviceTP}}</th>
                                    <th>{{$serviceCM + $serviceTD + $serviceTP}}</th>
                                </tr>
                                <tr>
                                    <th>Spécifique</th>
                                    <th>{{$specifiqueCM}}</th>
                                    <th>{{$specifiqueTD}}</th>
                                    <th>{{$specifiqueTP}}</th>
                                    <th>{{$specifiqueCM + $specifiqueTD + $specifiqueTP}}</th>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th><strong>{{$serviceCM + $specifiqueCM}}</strong></th>
                                    <th><strong>{{$serviceTD + $specifiqueTD}}</strong></th>
                                    <th><strong>{{$serviceTP + $specifiqueTP}}</strong></th>
                                    <th><strong>{{$serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP}}</strong></th>
                                </tr>
                                <tr>
                                    <th>Pourcentage</th>
                                    <th>{{round((($serviceCM*1.5 + $specifiqueCM) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</th>
                                    <th>{{round((($serviceTD + $specifiqueTD) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</th>
                                    <th>{{round((($serviceTP + $specifiqueTP) / ($serviceCM*1.5 + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP)*100),2)}}%</th>
                                    <th></th>
                                </tr>
                            </table>

                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th>Service statutaire</th>
                                    <th>{{$statut->SERVICE_STATUTAIRE}}h</th>
                                </tr>
                                <tr>
                                    <th>Service dû</th>
                                    <th>{{$statut->SERVICE_STATUTAIRE}}h</th>
                                </tr>
                                <tr>
                                    <th>Service en TD = TP</th>
                                    <th>{{$serviceCM + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP}}h</th>
                                </tr>
                                <tr>
                                    <th>Service dû effectué</th>
                                    <th>{{$serviceCM + $serviceTD + $serviceTP + $specifiqueCM + $specifiqueTD + $specifiqueTP}}h</th>
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
                                    <th>Service</th>
                                    <th>{{($serviceCM + $specifiqueCM) - $hccCM}}</th>
                                    <th>{{($serviceTD + $specifiqueTD) - $hccTD}}</th>
                                    <th>{{($serviceTP + $specifiqueTP) - $hccTP}}</th>
                                    <th><strong>{{(($serviceCM + $specifiqueCM) - $hccCM)*1.5 + (($serviceTD + $specifiqueTD) - $hccTD) + (($serviceTP + $specifiqueTP) - $hccTP)}}</strong></th>
                                </tr>
                                <tr>
                                    <th>HCC</th>
                                    <th>{{$hccCM}}</th>
                                    <th>{{$hccTD}}</th>
                                    <th>{{$hccTP}}</th>
                                    <th><strong>{{round($hccCM*1.5 + $hccTD + $hccTP*(2/3),2)}}</strong></th>
                                </tr>
                            </table>
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
        for (var j = 0; j < 5; j++) { // chaque jour
            for (var i = 0; i < 7; i++) { // chaque créneau horaire
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
        pageSetUp();
        $('#tabs').tabs();
        $("#menu").menu();

        @if($idEnseignant != -1)
        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
        var data = {{json_encode($voeux)}};
        initializeButton(data);
        @endif
    });





</script>