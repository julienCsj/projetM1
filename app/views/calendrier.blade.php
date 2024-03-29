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
/*
 * Date Format 1.2.3
 * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
 * MIT license
 *
 * Includes enhancements by Scott Trenda <scott.trenda.net>
 * and Kris Kowal <cixar.com/~kris.kowal/>
 *
 * Accepts a date, a mask, or a date and a mask.
 * Returns a formatted version of the given date.
 * The date defaults to the current date/time.
 * The mask defaults to dateFormat.masks.default.
 */

var dateFormat = function () {
    var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
        timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
        timezoneClip = /[^-+\dA-Z]/g,
        pad = function (val, len) {
            val = String(val);
            len = len || 2;
            while (val.length < len) val = "0" + val;
            return val;
        };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var _ = utc ? "getUTC" : "get",
            d = date[_ + "Date"](),
            D = date[_ + "Day"](),
            m = date[_ + "Month"](),
            y = date[_ + "FullYear"](),
            H = date[_ + "Hours"](),
            M = date[_ + "Minutes"](),
            s = date[_ + "Seconds"](),
            L = date[_ + "Milliseconds"](),
            o = utc ? 0 : date.getTimezoneOffset(),
            flags = {
                d:    d,
                dd:   pad(d),
                ddd:  dF.i18n.dayNames[D],
                dddd: dF.i18n.dayNames[D + 7],
                m:    m + 1,
                mm:   pad(m + 1),
                mmm:  dF.i18n.monthNames[m],
                mmmm: dF.i18n.monthNames[m + 12],
                yy:   String(y).slice(2),
                yyyy: y,
                h:    H % 12 || 12,
                hh:   pad(H % 12 || 12),
                H:    H,
                HH:   pad(H),
                M:    M,
                MM:   pad(M),
                s:    s,
                ss:   pad(s),
                l:    pad(L, 3),
                L:    pad(L > 99 ? Math.round(L / 10) : L),
                t:    H < 12 ? "a"  : "p",
                tt:   H < 12 ? "am" : "pm",
                T:    H < 12 ? "A"  : "P",
                TT:   H < 12 ? "AM" : "PM",
                Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default":      "ddd mmm dd yyyy HH:MM:ss",
    shortDate:      "m/d/yy",
    mediumDate:     "mmm d, yyyy",
    longDate:       "mmmm d, yyyy",
    fullDate:       "dddd, mmmm d, yyyy",
    shortTime:      "h:MM TT",
    mediumTime:     "h:MM:ss TT",
    longTime:       "h:MM:ss TT Z",
    isoDate:        "yyyy-mm-dd",
    isoTime:        "HH:MM:ss",
    isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
    dayNames: [
        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ],
    monthNames: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};
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
            year: 1 + parseInt(new Date("{{$dateRentree}}").format("yyyy")),

            firstMonth: parseInt(new Date("{{$dateRentree}}").format("mm")) - 1,
            firstDay: parseInt(new Date("{{$dateRentree}}").format("dd")),
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
                        content: "Le statut de l'enseignant a bien été modifié !",
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