@include('back.layout.header')
{{ Form::open(array('route' => 'post.ajouter_trajet', 'id' => "form-trajet")) }}
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Carte </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body" style="padding:0;">
                    <div class='map-wrapper' style="height:400px; width: 100%; margin:0; padding:0;">
                        <div id="map" style="height:100%; width: 100%;">
                            <p>Veuillez patienter pendant le chargement de la carte...</p>
                        </div>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
    </div>
    <div class="row">
        <article class="col-sm-12 sortable-grid ui-sortable">
            <div class="jarviswidget " id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header role="heading">
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Départ / Arrivée </h2>
                    <ul id="myTab" class="nav nav-tabs pull-right in">
                        <li class="active"> <a href="#s1" data-toggle="tab"><i class="fa fa-clock-o"></i> <span class="hidden-mobile hidden-tablet">Auto-recherche</span></a></li>
                        <li><a href="#s2" data-toggle="tab"><i class="fa fa-facebook"></i> <span class="hidden-mobile hidden-tablet">Vos adresses</span></a></li>
                         <li><a href="#s3" data-toggle="tab"><i class="fa fa-dollar"></i> <span class="hidden-mobile hidden-tablet">Information personalisée</span></a></li>
                    </ul>
                </header>
                <!-- widget div-->
                <div class="no-padding" role="content">
                    <div class="widget-body">
                        <!-- content -->
                        <div class="tab-content" id="myTabContent">
                            <input type="hidden" name="depart_lat" id="depart_lat">
                            <input type="hidden" name="depart_lon" id="depart_lon">
                            <input type="hidden" name="arrive_lat" id="arrive_lat">
                            <input type="hidden" name="arrive_lon" id="arrive_lon">
                            <input type="hidden" name="methode" id="methode" value="perso">
                            <!-- end s1 tab pane -->
                            <div id="s1" class="tab-pane active">
                                <div class="" style="margin-top:10px;">
                                    <div class="col-lg-5">
                                        <section>
                                            <label>Départ :</label>
                                            <input class="form-control input-lg" id="start" name="depart_google" type="text" placeholder="Départ">
                                        </section>
                                    </div>
                                    <div class="col-lg-5">
                                        <section>
                                            <label>Départ :</label>
                                            <input class="form-control input-lg" id="end" name="arrivee_google" type="text" placeholder="Arrivée">
                                        </section>
                                    </div>
                                    <div class="col-lg-2">
                                        <section>
                                            <button style="margin-top:22px;" class="btn btn-success btn-lg" id="submitGoogle">Générer trajet</button>
                                        </section>
                                    </div>
                                </div>
                            </div>

                            <!-- end s1 tab pane -->
                            <div id="s2" class="tab-pane fade">
                                <div class="" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <section>
                                            <label>Départ :</label>
                                            <select class="form-control input-lg" name="depart_adresse" id="selectDepart">
                                                <option disabled="" " selected="" value="0">Choisir une adresse</option>
                                                @foreach($adresses as $a)
                                                    <option value="{{$a->adresse}}">{{$a->nom}}</option>
                                                @endforeach
                                            </select>
                                        </section>
                                    </div>
                                    <div class="col-lg-6">
                                        <section>
                                            <label>Départ :</label>
                                            <select class="form-control input-lg" name="arrivee_adresse" id="selectArrivee">
                                                <option disabled="" selected="" value="0">Choisir une adresse</option>
                                                @foreach($adresses as $a)
                                                <option value="{{$a->adresse}}">{{$a->nom}}</option>
                                                @endforeach
                                            </select>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- end s2 tab pane -->

                            <div id="s3" class="tab-pane fade">
                                <div class="" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <section>
                                            <label>Départ :</label>
                                            <input class="form-control input-lg" name="depart_perso" id="" type="text" placeholder="Départ">
                                        </section>
                                    </div>
                                    <div class="col-lg-6">
                                        <section>
                                            <label>Départ :</label>
                                            <input class="form-control input-lg" name="arrivee_perso" id="" type="text" placeholder="Arrivée">
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end content -->
                    </div>
                </div>
            <!-- end widget div -->
            </div>
        </article>
    </div>
    <div class="row">
        <article class="col-sm-9">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Circonstances </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body">
                    <div class="" style="margin-top:10px;">
                        <div class="col-lg-3">
                            <section>
                                <h3>Météo</h3>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_jour">
                                    <i class="fa fa-fw fa-sun-o "></i></i> Jour</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_nuit">
                                    <i class="fa fa-fw fa-moon-o"></i></i> Nuit</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_ensoleille">
                                    <i class="fa fa-fw fa-sun-o "></i> Ensoleillé</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_pluvieux">
                                    <img src="{{asset('back/img/rain.png')}}"> Pluvieux</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_neige">
                                    <img src="{{asset('back/img/snow.png')}}"> Neige</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="meteo_brumeux">
                                    <i class="fa fa-fw fa-cloud"></i> Brumeux</label>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section>
                                <h3>Type de routes</h3>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="type_campagne">
                                    <i class="fa fa-fw fa-tree"></i> Campagne</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="type_ville">
                                    <i class="fa fa-fw fa-building"></i> Ville</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="type_montagne">
                                    <img src="{{asset('back/img/mountains.png')}}"> Montagne</label>
                                <label class="checkbox">
                                    <input type="checkbox" value="1" name="type_gd_axe">
                                    <i class="fa fa-fw fa-road"></i> Grands axes</label>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <h3>Trafic</h3>
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="trafic_fluide">
                                <img src="{{asset('back/img/fluide.png')}}"> Trafic fluide</label>
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="trafic_dense">
                                <img src="{{asset('back/img/dense.png')}}"> Trafic dense</label>
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="trafic_bouchon">
                                <img src="{{asset('back/img/bouchon.png')}}"> Bouchons</label>
                        </div>
                        <div class="col-lg-3">
                            <h3>Etat</h3>
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="etat_forme">
                                <i class="fa fa-fw fa-smile-o"></i> En forme</label>
                            <label class="checkbox">
                                <input type="checkbox" value="1" name="etat_fatigue">
                                <img src="{{asset('back/img/tired.png')}}"> Fatiqué</label>
                        </div>
                        <div class="col-lg-12">
                            <h3>Commentaires / remarques</h3>
                            <textarea class="custom-scroll" rows="8" name="remarque" style="width:100%;"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
        <article class="col-sm-3">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Statistiques </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body">
                    <div class="form-group">
                        <label>Durée :</label>
                        <div class="input-group">
                            <input data-show-meridian="false" name="duree" class="form-control" id="duree" type="text" placeholder="Choisir une valeur">
                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Distance :</label>
                        <input class="form-control spinner-both"  id="distance" name="distance" value="0">
                    </div>

                    <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group">
                            <input type="text" name="date" id="datepicker" placeholder="Choisir une date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
        <div class="col-lg-12">
            <input class="btn btn-success btn-lg btn-block" id="btn_form-trajet" type="submit" value=" Ajouter un trajet">
        </div>
    </div>
</section>
<div style="display:none" id="lesWaypts">
<input type="hidden" id="nb_waypts" name="nb_waypts" value="0">
</div>
{{Form::close()}}


@include('back.layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script src="{{asset('back/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>




<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

        var lastResponse;

        $('#btn_form-trajet').click(function(e) {
            e.preventDefault();
            waypts = lastResponse.Tb.waypoints;
            if(typeof(waypts)!='undefined') {
                waypts.forEach(lesWaypts);
            }
            function lesWaypts(element, index, array) {
                $('#lesWaypts').append('<input type="hidden" name="lat'+index+'" value="'+element.location.k+'" /> ');
                $('#lesWaypts').append('<input type="hidden" name="lon'+index+'" value="'+element.location.A+'" /> ');
                $('#nb_waypts').attr('value', index+1);
            }

            $( "#form-trajet" ).submit();

        });


        $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
        var date = new Date();
        dateString = date.getDate()+'/'+0+parseInt(date.getMonth()+1)+'/'+date.getFullYear();
        $( "#datepicker").val(dateString);


        $('#duree').timepicker('setTime', '00:00');

        $("#distance").spinner({
            min: 0,
            max: 1000,
            step: 5,
            start: 0,
            numberFormat: "C"
        });

        // Auto complete des champs pour la localisation Google maps
        var options = {
            types: ['(cities)']
        };
        var inputStart = document.getElementById('start');
        autocompleteStart = new google.maps.places.Autocomplete(inputStart, options);

        var inputEnd = document.getElementById('end');
        autocompleteEnd = new google.maps.places.Autocomplete(inputEnd, options);




        var rendererOptions = {
            draggable: true
        };
        var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
        var directionsService = new google.maps.DirectionsService();
        var map;

        var australia = new google.maps.LatLng(-25.274398, 133.775136);

        function initialize() {

            var france = new google.maps.LatLng(46.227638, 2.213749);
            var mapOptions = {
                zoom:5,
                center: france
            }
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            directionsDisplay.setMap(map);

            google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
                computeTotalDistance(directionsDisplay.getDirections());
            });


        }


        $('#selectArrivee').change(calcSelect);
        $('#selectDepart').change(calcSelect);

        $('#submitGoogle').click(calcSelectGoogle);

        function calcSelectGoogle(e) {
            e.preventDefault();

            var start = document.getElementById('start').value;
            var end = document.getElementById('end').value;

            if(start != "" && end != "") {
                var request = {
                    origin:start,
                    destination:end,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING,
                };

                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
                $('#methode').attr('value', 'google');
            }

        }

        function calcSelect(e) {
            e.preventDefault();

            var start = document.getElementById('selectDepart').value;
            var end = document.getElementById('selectArrivee').value;

            console.log(start);
            console.log(end);


            if(start != 0 && end != 0) {
                var request = {
                    origin:start,
                    destination:end,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING,
                };

                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
                $('#methode').attr('value', 'adresse');
            }
        }

        function computeTotalDistance(response) {
            console.log(response);
            dureeSeconde = response.routes[0].legs[0].duration.value;
            var d = new Date(dureeSeconde * 1000); // js fonctionne en milisecondes
            var t = [];
            t.push(d.getHours()-1);
            t.push(d.getMinutes());
            duree =  t.join(':');
            distanceKilometre = response.routes[0].legs[0].distance.value;
            distance = distanceKilometre / 1000;
            depart_lat = response.routes[0].legs[0].start_location.k;
            depart_lon = response.routes[0].legs[0].start_location.A;
            arrive_lat = response.routes[0].legs[0].end_location.k;
            arrive_lon = response.routes[0].legs[0].end_location.A;

            $('#duree').timepicker('setTime', duree);
            $('#distance').val(Math.round(distance));
            $('#depart_lat').attr('value', depart_lat);
            $('#depart_lon').attr('value', depart_lon);
            $('#arrive_lat').attr('value', arrive_lat);
            $('#arrive_lon').attr('value', arrive_lon);

            lastResponse = response;
        }

        google.maps.event.addDomListener(window, 'load', initialize);



        /*
        // Gestion de la MAP
        var directionsDisplay;

        var optionsService = {
            draggable: true
        };
        var directionsService = new google.maps.DirectionsService(optionsService);
        var map;

        function computeTotalDistance(result) {
            var total = 0;
            var myroute = result.routes[0];
            for (var i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
            }
            total = total / 1000.0;
            document.getElementById('total').innerHTML = total + ' km';
        }



        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var france = new google.maps.LatLng(46.227638, 2.213749);
            var mapOptions = {
                zoom:5,
                center: france
            }
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            directionsDisplay.setMap(map);

            google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
                computeTotalDistance(directionsDisplay.getDirections());
            });
        }

        //chemin du tracé du futur polyline


        $('#submitGoogle').click(function(e) {
            e.preventDefault();
            var start = document.getElementById('start').value;
            var end = document.getElementById('end').value;
            var request = {
                origin:start,
                destination:end,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode.DRIVING,
            };

            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    console.log(response);
                    dureeSeconde = response.routes[0].legs[0].duration.value;
                    var d = new Date(dureeSeconde * 1000); // js fonctionne en milisecondes
                    var t = [];
                    t.push(d.getHours()-1);
                    t.push(d.getMinutes());
                    duree =  t.join(':');
                    distanceKilometre = response.routes[0].legs[0].distance.value;
                    distance = distanceKilometre / 1000;
                    depart_lat = response.routes[0].legs[0].start_location.k;
                    depart_lon = response.routes[0].legs[0].start_location.A;
                    arrive_lat = response.routes[0].legs[0].end_location.k;
                    arrive_lon = response.routes[0].legs[0].end_location.A;

                    $('#duree').timepicker('setTime', duree);
                    $('#distance').val(Math.round(distance));
                    $('#depart_lat').attr('value', depart_lat);
                    $('#depart_lon').attr('value', depart_lon);
                    $('#arrive_lat').attr('value', arrive_lat);
                    $('#arrive_lon').attr('value', arrive_lon);
                    $('#methode').attr('value', 'google');
                }
            });
        });

        function calcSelect() {
            var start = document.getElementById('selectDepart').value;
            var end = document.getElementById('selectArrivee').value;

            if(start != '0' && end != '0') {
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        console.log(response);
                        dureeSeconde = response.routes[0].legs[0].duration.value;
                        var d = new Date(dureeSeconde * 1000); // js fonctionne en milisecondes
                        var t = [];
                        t.push(d.getHours()-1);
                        t.push(d.getMinutes());
                        duree =  t.join(':');
                        distanceKilometre = response.routes[0].legs[0].distance.value;
                        distance = distanceKilometre / 1000;
                        depart_lat = response.routes[0].legs[0].start_location.k;
                        depart_lon = response.routes[0].legs[0].start_location.A;
                        arrive_lat = response.routes[0].legs[0].end_location.k;
                        arrive_lon = response.routes[0].legs[0].end_location.A;

                        $('#duree').timepicker('setTime', duree);
                        $('#distance').val(Math.round(distance));
                        $('#depart_lat').attr('value', depart_lat);
                        $('#depart_lon').attr('value', depart_lon);
                        $('#arrive_lat').attr('value', arrive_lat);
                        $('#arrive_lon').attr('value', arrive_lon);
                        $('#methode').attr('value', 'adresse');
                    }
                });
            }
        }

        $('#selectArrivee').change(calcSelect);
        $('#selectDepart').change(calcSelect);

        google.maps.event.addDomListener(window, 'load', initialize);
        */
    });

</script>

</script>