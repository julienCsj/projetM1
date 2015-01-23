@include('back.layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-check"></i> </span>
                    <h2 id="titreWizard"> </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="row">
                            {{ Form::open(array('route' => 'post.premiere_connexion', 'id' => 'wizard-1', 'novalidate' => 'novalidate')) }}
                                <div id="bootstrap-wizard-1" class="col-sm-12">
                                    <div class="form-bootstrapWizard">
                                        <ul class="bootstrapWizard form-wizard">
                                            <li class="active" data-target="#step1">
                                                <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Avancement de votre AAC</span> </a>
                                            </li>
                                            <li data-target="#step2">
                                                <a href="#tab2" data-toggle="tab"> <span class="step" id="step2">2</span> <span class="title">Adresse</span> </a>
                                            </li>
                                            <li data-target="#step3">
                                                <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Informations générales</span> </a>
                                            </li>
                                            <li data-target="#step4">
                                                <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Finalisation</span> </a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <h3><strong>Etape 1 </strong> - Avancement de votre AAC</h3>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info">Avez-vous déjà effectué vos premiers kilomètres ?</div>
                                                    <label class="radio">
                                                        <input type="radio" value="1" class="required" name="avancement" id="radioOui">
                                                        <i></i>Oui, j'ai déjà commencé mon AAC</label>

                                                    <label class="radio">
                                                        <input type="radio" value="0" name="avancement" id="radioNon">
                                                        <i></i>Non, je n'ai pas encore commencé mon AAC</label>
                                                </div>

                                                <div class="col-lg-12" id="step1hide">
                                                    <div class="form-group" name="slider" id="sliderKm">
                                                        <input id="sliderKm" type="text" name="nbKm" value="" data-type="integer" data-step="10" data-postfix=" Km" data-hasgrid="true">
                                                        <input id="km" type="hidden" name="km">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <br>

                                            <h3><strong>Etape 2</strong> - Adresse</h3>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info">Afin de fournir un premier point de départ a vos trajet, nous souhaitons connaitre votre adresse.<br/>
                                                        Cette information n'est pas obligatoire. Vous pouvez ajouter des adresses par la suite en cliquant sur "Adresses" dans le menu.</div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Adresse de votre domicile</label>
                                                        <div class="col-md-10">
                                                            <input name="adresse" id="addresspicker_map" class="form-control " placeholder="Adresse de votre domicile" type="text"><br>
                                                            <input type="hidden" name="lat" id="lat">
                                                            <input type="hidden" name="lng" id="lng">
                                                            <input type="hidden" name="departement" id="administrative_area_level_1">
                                                            <input type="hidden" name="region" id="administrative_area_level_2">
                                                            <input type="hidden" name="ville" id="locality">
                                                            <input type="hidden" name="code_postal" id="postal_code">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class='map-wrapper' style="height:400px; width: 100%">
                                                        <div id="map"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab3">
                                            <br>
                                            <h3><strong>Etape 3</strong> - Informations personnelles & profil</h3>
                                            <div class="alert alert-info">L'ensemble de ces informations sont facultatives.</div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
                                                            <input type="text" id="fname" name="nom" placeholder="Nom" class="form-control input-lg">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
                                                            <input type="text" id="lname" name="prenom" placeholder="Prénom" class="form-control input-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-file fa-lg fa-fw"></i></span>
                                                            <input type="file" id="" name="avatar" placeholder="Choisir un avatar" class="form-control input-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info">Souhaitez-vous activer le journal de conduite ?
                                                    Le journal de conduite est un espace accesible aux personnes auxquelles vous donnez une URL. Cela permet a ces personne de suivre votre prograssion
                                                    a distance.<br>Vous pouvez gérer ce journal en cliquant dans le menu sur l'item "Gérer mon journal".</div>
                                                    <label class="radio">
                                                        <input type="radio" value="1" class="required" name="journal" checked="checked" id="journalOui">
                                                        <i></i>Oui, je souhaite activer le journal de conduite</label>

                                                    <label class="radio">
                                                        <input type="radio" value="0" name="journal" id="journalNon">
                                                        <i></i>Non, je ne souhaite pas activer le journal de conduite</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <br>
                                            <h3><strong>Etape 4</strong> - Informations générales et finalisation</h3>
                                            <br>
                                            <h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Terminé</strong></h1>
                                            <h4 class="text-center">Nous vous remercions ! Cliquez sur "Envoyer" pour commencer a remplir votre carnet AAC en ligne.</h4>
                                                <br>
                                            <button type="submit" class="btn btn-success btn-lg btn-block" type="button">
                                                Envoyer !
                                            </button>
                                                <br>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <ul class="pager wizard no-margin">
                                                        <!--<li class="previous first disabled">
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                        </li>-->
                                                        <li class="previous disabled">
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-default" id="prev"> Précédant </a>
                                                        </li>
                                                        <!--<li class="next last">
                                                        <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                        </li>-->
                                                        <li class="next">
                                                            <a href="javascript:void(0);" class="btn btn-lg txt-color-darken" id="next"> Suivant </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->
    </div>
</section>

@include('back.layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->
<script src="back/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="back/js/plugin/fuelux/wizard/wizard.min.js"></script>
<script src="back/js/plugin/ion-slider/ion.rangeSlider.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="back/js/plugin/jquery.ui.addresspicker.js"></script>
<script src="back/js/plugin/jquery-form/jquery-form.min.js"></script>



<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

        $('#date_naissance').datepicker({
            dateFormat : 'dd.mm.yy',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>'
        });

        $(function() {
            var addresspicker = $( "#addresspicker" ).addresspicker({
                componentsFilter: 'country:FR'
            });
            var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
                regionBias: "fr",
                updateCallback: showCallback,
                mapOptions: {
                    zoom: 4,
                    center: new google.maps.LatLng(46, 2),
                    scrollwheel: false,
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

        $('#step2').click(function() {
            setTimeout(function() {
                google.maps.event.trigger(map, 'resize');
                map.setZoom( map.getZoom() );
            }, 100);
        });

        $('#next').click(function() {
            setTimeout(function() {
                google.maps.event.trigger(map, 'resize');
                map.setZoom( map.getZoom() );
            }, 100);
        });

        $('#prev').click(function() {
            setTimeout(function() {
                google.maps.event.trigger(map, 'resize');
                map.setZoom( map.getZoom() );
            }, 100);
        });


        $('#step1hide').hide();
        $('#radioOui').click(function() {
            $('#step1hide').show();
            setTimeout(function() {
                $("#sliderKm").ionRangeSlider({
                    min: 0,
                    max: 3000,
                    from: 0,
                    to: 3000,
                    type: 'single',
                    step: 10,
                    postfix: " km",
                    prettify: false,
                    hasGrid: true,
                    onChange: function(obj) {
                        console.log(obj);
                        $('#km').attr('value', obj.fromNumber);
                    }
                });
            }, 10);

        });


        $('#radioNon').click(function() {
            $('#step1hide').hide();
        });



        $('#titreWizard').html("Première connexion");

        //Bootstrap Wizard Validations

        var $validator = $("#wizard-1").validate({

            rules: {
                adresse: {
                    required: true
                },
                avancement: {
                    required: true
                }
            },

            messages: {
                adresse: "Merci de choisir une adresse",
                avancement: "Veuillez sellectionner une option"
            },

            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#bootstrap-wizard-1').bootstrapWizard({
            'tabClass': 'form-wizard',
            'onNext': function (tab, navigation, index) {
                var $valid = $("#wizard-1").valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                } else {
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                        'complete');
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                        .html('<i class="fa fa-check"></i>');
                }
            }
        });


        /*// fuelux wizard
        var wizard = $('.wizard').wizard();

        wizard.on('finished', function (e, data) {
            //$("#fuelux-wizard").submit();
            //console.log("submitted!");
            $.smallBox({
                title: "Congratulations! Your form was submitted",
                content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
                color: "#5F895F",
                iconSmall: "fa fa-check bounce animated",
                timeout: 4000
            });

        });*/


    })

</script>