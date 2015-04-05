@include('layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <h1>Calendrier <small>Cette page permet de gérer la formation {{$formation->long_title}}</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("calendrier")}}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">
            <div class="row well">
                <header>
                    <h2> Les périodes </h2>
                </header>
                <button id="ajouterPeriode" class="btn btn-primary ui-btn-sm"><i class="glyphicon glyphicon-plus"></i> Ajouter une nouvelle période</button>
                <hr>
                <input type="hidden" name="nbPeriode" id="nbPeriode" value="1" />
                <div class="well well-sm" id="event-container">
                    <form>
                        <fieldset>
                            <ul id="external-events" class="list-unstyled">

                            </ul>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-9">
            <!-- new widget -->
            <div>
                <!-- widget div-->
                <div>
                    <div class="widget-body no-padding">
                        <!-- content goes here -->
                        <br><br>
                        <div id='calendar' class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                        <!-- end content -->
                    </div>
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<link href='{{asset('js/plugin/fullcalendar-school/fullcalendar.css') }}' rel='stylesheet' />
<link href='{{asset('js/plugin/fullcalendar-school/fullcalendar.print.css') }}' rel='stylesheet' media='print' />
<script src='{{asset('js/plugin/fullcalendar-school/fullcalendar.js') }}'></script>

<!-- #dialog-message -->
<div id="dialog-message" title="Dialog Simple Title">
    <form id="form-status-enseignant" class="smart-form" novalidate="novalidate"></form>
        <fieldset>
            <div class="form-group">
                <label for="input-type"> Type de status</label>
                <select class="form-control select" name="status" id="input-type">
                        <option value="enseignement">Enseignement</option>
                        <option value="vacance">Vacances / Jour férié</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nom de la période</label>
                <input class="form-control" type="text" id="nomPeriode" name="nom" placeholder="Nom de la période" id="nomPeriode">
            </div>
        </fieldset>
    </form>
</div>
<!-- #dialog-message -->

<div id="dialog_simple" title="Dialog Simple Title">
    <p>
        Voulez-vous supprimer cette période ?
    </p>
</div>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();


        $("#ajouterPeriode").click(function() {
            $('#dialog-message').dialog('open');
        });



        /* initialize the external events
         -----------------------------------------------------------------*/

        function makeDraggable() {
            $('#external-events span.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        makeDraggable();

        function addPeriode() {
            var type = $("#input-type").val();
            var nom = $("#nomPeriode").val();

            if(type=="vacance") {
                $("#external-events").append("<li class=\"ui-draggable\" style=\"position: relative;\"><span class=\"bg-color-red txt-color-white external-event\" data-description=\"Périodes de vacances\" data-icon=\"fa-time\" data-attribute=\"vacance\">"+nom+"</span> </li>");
                makeDraggable();
            } else if(type=="enseignement") {
                $("#external-events").append("<li class=\"ui-draggable\" style=\"position: relative;\"><span class=\"txt-color-white external-event\" style='background-color:#3a87ad;' data-description=\"Période d'enseignement\" data-icon=\"fa-time\" data-attribute=\"enseignement\">"+nom+"</span> </li>");
                makeDraggable();
            }
            $("#nomPeriode").val("");
            $('#dialog-message').dialog("close");
        }

        /* Ajout de période
        ------------------------------------------------------------------*/
        $('#dialog-message').dialog({
            autoOpen: false,
            modal: true,
            title: "Ajouter une période",
            buttons: [{
                html: "Annuler",
                "class": "btn btn-default",
                click: function () {
                    $(this).dialog("close");
                }
            }, {
                html: "<i class='fa fa-check'></i>&nbsp; OK",
                "class": "btn btn-primary",
                click: function () {
                    addPeriode();
                }
            }]
        });

        $('#nomPeriode').keypress(function(e) {
            if(e.which == 13) {
                addPeriode();
            }
        });

        /* initialize the calendar
         -----------------------------------------------------------------*/

        $('#calendar').fullCalendar({
            header: {
                //left: 'prev,next today',
                left : '',
                center: 'title',
                //right: 'year,month,agendaWeek,agendaDay'
                right : ''
            },
            timezone: "Europe/Paris",
            //weekends : false,
            defaultView: 'year',
            firstDay: 1,
            firstMonth: 8,
            editable: true,
            events: [
                @foreach($calendrier as $event)
                {
                    title: '{{$event->nom}}',
                    start: '{{$event->dateDebut}}',
                    end: '{{$event->dateFin}}',
                    @if($event->type=='vacance')color:  '#a90329', @endif
                },
                @endforeach
            ],
            eventClick: function(calEvent, jsEvent, view){
                console.log("Suppression d'un event DEBUT");
                $('#dialog_simple').dialog({
                    autoOpen : false,
                    width : 600,
                    resizable : false,
                    modal : true,
                    title : "Supprimer la période ?",
                    buttons : [{
                        html : "<i class='fa fa-trash-o'></i>&nbsp; Supprimer",
                        "class" : "btn btn-danger",
                        click : function() {
                            $(this).dialog("close");
                            var from_data = {
                                "idFormation" : '{{$idFormation}}',
                                "eventID": calEvent._id,
                            };
                            $.ajax({
                                url: "{{$idFormation}}/supprimerPeriode",
                                data: from_data,
                                type: "POST"
                            })
                            .done(function (html) {
                                console.log(html);
                                $.bigBox({
                                    title: "Modification réalisé",
                                    content: "La période a bien été supprimée.",
                                    color: "#3276B1",
                                    icon: "fa fa-bell swing animated",
                                    timeout: 2000
                                });

                            })
                            .fail(function (html) {
                                $.bigBox({
                                    title: "Erreur",
                                    content: "Un problème est survenu !",
                                    color: "#C46A69",
                                    icon: "fa fa-warning swing animated",
                                    timeout: 3000
                                });
                            });
                            $('#calendar').fullCalendar('removeEvents', calEvent._id);
                        }
                    }, {
                        html : "<i class='fa fa-times'></i>&nbsp; Annuler",
                        "class" : "btn btn-default",
                        click : function() {
                            $(this).dialog("close");
                        }
                    }]
                });
                $('#dialog_simple').dialog('open');
                console.log("Suppression d'un event FIN");
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                var type = $(this).attr('data-attribute');
                $(this).remove();
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                if(type == "vacance") {
                    copiedEventObject.backgroundColor = "#a90329";
                    copiedEventObject.color = "#a90329";
                }

                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                var from_data = {
                    "dateDebut": copiedEventObject.start,
                    "dateFin": copiedEventObject.start,
                    "nom": copiedEventObject.title,
                    "idFormation" : '{{$idFormation}}',
                    "eventID": copiedEventObject._id,
                    "type": type,
                };
                $.ajax({
                    url: "{{$idFormation}}/ajouterPeriode",
                    data: from_data,
                    type: "POST"
                })
                .done(function (html) {
                    $.bigBox({
                        title: "Modification réalisé",
                        content: "Le status de l'enseignant a bien été modifié !",
                        color: "#3276B1",
                        icon: "fa fa-bell swing animated",
                        timeout: 2000
                    });

                })
                .fail(function (html) {
                    $.bigBox({
                        title: "Modification réalisé",
                        content: "Un problème est survenu !",
                        color: "#C46A69",
                        icon: "fa fa-warning swing animated",
                        timeout: 3000
                    });
                });
            },
            eventResize: function (event, jsEvent, ui, view) {
                var from_data = {
                    "dateFin": event.end,
                    "dateDebut": event.start,
                    "nom": event.title,
                    "idFormation": '{{$idFormation}}',
                    "eventID" : event._id,
                };
                $.ajax({
                    url: "{{$idFormation}}/modifierPeriode",
                    data: from_data,
                    type: "POST"
                })
                .done(function (html) {
                    $.bigBox({
                        title: "Modification réalisé",
                        content: "Le status de l'enseignant a bien été modifié !",
                        color: "#3276B1",
                        icon: "fa fa-bell swing animated",
                        timeout: 2000
                    });
                })
                .fail(function (html) {
                    $.bigBox({
                        title: "Modification réalisé",
                        content: "Un problème est survenu !",
                        color: "#C46A69",
                        icon: "fa fa-warning swing animated",
                        timeout: 3000
                    });
                });

            },
            eventDragStop: function( event, jsEvent, ui, view ) {
                console.log("Event DRAG : ");
                var monEvent = event;
                $('#calendar').fullCalendar('refetchEvents');
                // Comme le plugin est completement daubé :/ il faut attendre pour que l'event soit refresh !
                setTimeout(function(){
                    console.log(monEvent);
                    var from_data = {
                        "dateDebut" : monEvent.start,
                        "dateFin": monEvent.end,
                        "eventID": monEvent._id,
                        "idFormation": '{{$idFormation}}',
                    };
                    $.ajax({
                        url: "{{$idFormation}}/modifierPeriode",
                        data: from_data,
                        type: "POST"
                    })
                            .done(function (html) {
                                $.bigBox({
                                    title: "Modification réalisé",
                                    content: "Le status de l'enseignant a bien été modifié !",
                                    color: "#3276B1",
                                    icon: "fa fa-bell swing animated",
                                    timeout: 2000
                                });
                            })
                            .fail(function (html) {
                                $.bigBox({
                                    title: "Modification réalisé",
                                    content: "Un problème est survenu !",
                                    color: "#C46A69",
                                    icon: "fa fa-warning swing animated",
                                    timeout: 3000
                                });
                            });
                }, 500);

            }
        });


    });

</script>