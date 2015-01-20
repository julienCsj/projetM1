@include('back.layout.header')

<?php
function minToHour($minutes)
{
    $h = floor( $minutes / 60 );
    $m = $minutes % 60;
    if($h == 0) {
        if($m > 1) return $m.' minutes';
        return $m.' minute';
    }
    if($h > 1) return $h. ' heures et '.$m. ' minutes';
    return $h. ' heure et '.$m.  ' minutes';
}
?>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12 sortable-grid ui-sortable">
            <div class="jarviswidget " id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header role="heading">
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Liste des trajets</h2>
                </header>

                <!-- widget div-->
                <div class="" role="content">
                    <div class="widget-body">
                        @if(sizeof($lesTrajets) == 0)
                            <p class="text-center font-md">Aucun trajet à afficher</p>
                            <p class="text-center font-sm">Il semble que vous n'ayez pas encore ajouté de trajet a votre carnet. Vous pouvez le faire <a href="{{URL::route('trajet_ajouter')}}">ici</a>.</p>
                        @endif
                        @foreach($lesTrajets as $t)
                        <div class="row" style="margin-top:10px; margin-left:0px;">
                            <div class="col-md-3">
                                <div class='map-wrapper' style="height:200px; width: 100%; margin:0; padding:0;">
                                    <div id="map{{$t->id_trajet}}" style="height:100%; width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p><strong class="font-md">{{$t->depart}} <i class="glyphicon glyphicon-arrow-right" style="margin-left: 10px; margin-right:10px;"></i>  {{$t->arrivee}}</strong><br>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <section>
                                            @if($t->jour == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-sun-o "></i></i> Jour</label>
                                            @endif

                                            @if($t->nuit == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-moon-o"></i></i> Nuit</label>
                                            @endif
                                            @if($t->meteo_ensoleille == 1)<label class="checkbox">

                                                <i class="fa fa-fw fa-sun-o "></i> Ensoleillé</label>
                                            @endif
                                            @if($t->meteo_pluvieux == 1)<label class="checkbox">
                                                <img src="{{asset('back/img/rain.png')}}"> Pluvieux</label>
                                            @endif
                                            @if($t->meteo_neige == 1)<label class="checkbox">
                                                <img src="{{asset('back/img/snow.png')}}"> Neige</label>
                                            @endif
                                            @if($t->meteo_brumeux == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-cloud"></i> Brumeux</label>
                                            @endif
                                        </section>
                                    </div>
                                    <div class="col-lg-3">
                                        <section>
                                            @if($t->type_campagne == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-tree"></i> Campagne</label>
                                            @endif
                                            @if($t->type_agglo == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-building"></i> Ville</label>
                                            @endif
                                            @if($t->type_montagne == 1)<label class="checkbox">
                                                <img src="{{asset('back/img/mountains.png')}}"> Montagne</label>
                                            @endif
                                            @if($t->type_gd_axe == 1)<label class="checkbox">
                                                <i class="fa fa-fw fa-road"></i> Grands axes</label>
                                            @endif
                                        </section>
                                    </div>
                                    <div class="col-lg-3">
                                        @if($t->trafic_fluide == 1)<label class="checkbox">
                                            <img src="{{asset('back/img/fluide.png')}}"> Trafic fluide</label>
                                        @endif
                                        @if($t->trafic_dense == 1)<label class="checkbox">
                                            <img src="{{asset('back/img/dense.png')}}"> Trafic dense</label>
                                        @endif
                                        @if($t->trafic_bouchon == 1)<label class="checkbox">
                                            <img src="{{asset('back/img/bouchon.png')}}"> Bouchons</label>
                                        @endif
                                    </div>
                                    <div class="col-lg-3">
                                        @if($t->etat_forme == 1)<label class="checkbox">
                                            <i class="fa fa-fw fa-smile-o"></i> En forme</label>
                                        @endif
                                        @if($t->etat_fatigue == 1)<label class="checkbox">
                                            <img src="{{asset('back/img/tired.png')}}"> Fatiqué</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <h4 class="font-md"><strong>{{$t->distance}} km</strong>
                                            <br>
                                            <small>parcourus</small></h4>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <h4 class="font-md"><strong>{{minToHour($t->duree)}}</strong>
                                            <br>
                                            <small>de conduite</small></h4>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <?php
                                        $myDateTime = DateTime::createFromFormat('Y-m-d', $t->date);
                                        $newDate = $myDateTime->format('d/m/Y');?>
                                        <h4 class="font-md"><strong>{{$newDate}}</strong>
                                            <br>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2 text-center">
                                <a class="btn btn-labeled btn-danger" href="{{URL::to('trajet/supprimer/'.$t->id_trajet)}}" style="margin-top:40px;"> <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Supprimer </a>
                                <a class="btn btn-labeled btn-info" href="{{URL::to('trajet/modifier/'.$t->id_trajet)}}" style="margin-top:10px;"> <span class="btn-label"><i class="glyphicon glyphicon-edit"></i>    </span>&nbsp;&nbsp;Modifier&nbsp;&nbsp;</a>
                            </div>
                        </div>
                        <div class="timeline-seperator text-center"> </span>

                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            {{$lesTrajets->links()}}
        </article>
    </div>
</section>


@include('back.layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script src="http://maps.google.com/maps/api/js?libraries=places&amp;?sensor=false"></script>



<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

        var directionsService = new Array();
        var directionsDisplay = new Array();

        function initialize(lat, lon, id) {
            directionsDisplay[id] = new google.maps.DirectionsRenderer();
            var centre = new google.maps.LatLng(lat, lon);
            var mapOptions = {
                zoom:5,
                center: centre,
                scrollwheel: false,
                mapTypeControl: false,
                scaleControl: false,
                scrollwheel: false,
                panControl: false,
                streetViewControl: false
            }
            map = new google.maps.Map(document.getElementById('map'+id), mapOptions);
            directionsDisplay[id].setMap(map);
        }

        function afficherItineraire(lat_depart, lon_depart, lat_arrivee, lon_arrive, id, waypts) {
            var start = new google.maps.LatLng(lat_depart, lon_depart);
            var end = new google.maps.LatLng(lat_arrivee, lon_arrive);


            if(waypts.size != 0) {
                var request = {
                    origin:start,
                    destination:end,
                    waypoints: waypts,
                    travelMode: google.maps.TravelMode.DRIVING
                };
            } else {
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
            }

            directionsService[id].route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay[id].setDirections(response);
                    console.log(response);
                }
            });
        }


        @foreach($lesTrajets as $t)
            @if($t->lat_depart != '' && $t->lon_depart != '' && $t->lat_arrivee != '' && $t->lon_arrivee != '')
                directionsService[{{$t->id_trajet}}] = new google.maps.DirectionsService();
                initialize({{$t->lat_depart}}, {{$t->lon_depart}}, {{$t->id_trajet}});
                // calcul des waypoint
                waypts = [];
                @foreach($t->waypts as $w)
                    waypts.push({
                        location:new google.maps.LatLng({{$w->lat}},  {{$w->lon}}),
                        stopover:true
                 });
                @endforeach
                console.log(waypts);
                afficherItineraire({{$t->lat_depart}}, {{$t->lon_depart}}, {{$t->lat_arrivee}}, {{$t->lon_arrivee}}, {{$t->id_trajet}}, waypts);
            @else
                $('#map'+{{$t->id_trajet}}).html('<p class="text-center font-md" style="margin-top:50px;">Aperçu non disponible</p> <p class="text-center font-sm">Utiliser l\'ajout via Google Maps ou via des adresses pour avoir un aperçu.</p>').attr('class', 'well bg-color-teal');
            @endif
        @endforeach;

    });

</script>

</script>