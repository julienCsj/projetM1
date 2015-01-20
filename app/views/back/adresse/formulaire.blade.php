@include('back.layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-8">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Liste de mes adresses </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body">
                    @foreach($adresses as $a)
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-3">
                            <div class='map-wrapper' style="height:100px; width: 100%; margin:0; padding:0;">
                                <div id="map{{$a->id_adresse}}" style="height:100%; width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{$a->nom}}</strong><br>
                                {{$a->adresse}}<br/>
                                <!--{{$a->code_postal}}, {{$a->ville}}, {{$a->departement}}, {{$a->region}}--></p>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-labeled btn-danger" href="{{URL::to('adresse/supprimer/'.$a->id_adresse)}}"> <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Supprimer </a>
                            <a class="btn btn-labeled btn-info" href="{{URL::to('adresse/modifier/'.$a->id_adresse)}}"> <span class="btn-label"><i class="glyphicon glyphicon-edit"></i></span>Modifier </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
        <article class="col-sm-4">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Ajouter une adresse </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body">
                    <div class='map-wrapper' style="height:250px; width: 100%; margin:0; padding:0; margin-bottom:15px;">
                        <div id="map" style="height:100%; width: 100%;">
                        </div>
                    </div>

                    <div class="form-group"></div>
                    {{ Form::open(array('route' => 'post.adresse')) }}
                            @if(isset($adresse))<input type="hidden" value="{{$adresse->id_adresse}}" name="id" >@endif
                            <input name="adresse" id="addresspicker_map" @if(isset($adresse)) value="{{$adresse->adresse}}" @endif class="form-control " placeholder="Adresse" type="text"><br>
                            <input name="nom" @if(isset($adresse)) value="{{$adresse->nom}}" @endif class="form-control " placeholder="Nom de l'endroit (lycée, travail)" type="text"><br>
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->lat}}" @endif name="lat" id="lat">
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->lon}}" @endif name="lng" id="lng">
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->departement}}" @endif name="departement" id="administrative_area_level_2">
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->region}}" @endif name="region" id="administrative_area_level_1">
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->ville}}" @endif name="ville" id="locality">
                            <input type="hidden" @if(isset($adresse)) value="{{$adresse->code_postal}}" @endif name="code_postal" id="postal_code">
                            @if(isset($adresse))
                                <button type="submit" class="btn btn-info btn-lg btn-block" type="button">Modifier</button>
                            @else
                                <button type="submit" class="btn btn-success btn-lg btn-block" type="button">Ajouter</button>
                            @endif
                    {{ Form::close() }}
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
    </div>
</section>


@include('back.layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script src="http://maps.google.com/maps/api/js?libraries=places&amp;?sensor=false"></script>
<script src="{{ asset('back/js/plugin/jquery.ui.addresspicker.js') }}"></script>




<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

        function initialiser(lat, lng, id) {
            var latlng = new google.maps.LatLng(lat, lng);
            //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
            //de définir des options d'affichage de notre carte
            var options = {
                center: latlng,
                zoom: 14,
                zoomControl: false,
                disableDoubleClickZoom: false,
                mapTypeControl: false,
                scaleControl: false,
                scrollwheel: false,
                panControl: false,
                streetViewControl: false,
                draggable : false,
                overviewMapControl: false,
                overviewMapControlOptions: {
                    opened: false,
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            //constructeur de la carte qui prend en paramêtre le conteneur HTML
            //dans lequel la carte doit s'afficher et les options
            var carte = new google.maps.Map(document.getElementById("map"+id), options);
        }

        @foreach($adresses as $a)
            initialiser({{$a->lat}}, {{$a->lon}}, {{$a->id_adresse}});
        @endforeach

        $(function() {
            var addresspicker = $( "#addresspicker" ).addresspicker({
                componentsFilter: 'country:FR'
            });
            var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
                regionBias: "fr",
                updateCallback: showCallback,
                mapOptions: {
                    @if(isset($adresse))
                    zoom: 16,
                    @else
                    zoom: 4,
                    @endif
                    center: new google.maps.LatLng(46, 2),
                    scrollwheel: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    scrollwheel: false,
                    panControl: false,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                },
                elements: {
                    map:      "#map",
                    lat:      "#lat",
                    lng:      "#lng",
                    street_number: '#street_number',
                    route: '#route',
                    locality: '#locality',
                    administrative_area_level_2: '#administrative_area_level_2',
                    administrative_area_level_1: '#administrative_area_level_1',
                    country:  '#country',
                    postal_code: '#postal_code',
                    type:    '#type'
                }
            });

            var gmarker = addresspickerMap.addresspicker( "marker");
            gmarker.setVisible(true);
            addresspickerMap.addresspicker( "updatePosition");

            $('#reverseGeocode').change(function(){
                $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
            });

            function showCallback(geocodeResult, parsedGeocodeResult){
                $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
            }
            // Update zoom field
            map = $("#addresspicker_map").addresspicker("map");
        });

    });

</script>

</script>