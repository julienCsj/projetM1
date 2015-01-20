@include('back.layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->


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



<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

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

            $("#sliderKm").ionRangeSlider({
                min: 0,
                max: 3000,
                from: 0,
                to: 3000,
                type: 'single',
                step: 10,
                postfix: " km",
                prettify: false,
                hasGrid: true
            });
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


        // fuelux wizard
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

        });


    })

</script>