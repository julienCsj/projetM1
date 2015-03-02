@include('layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Calendrier <small>Cette page permet de gérer XX de XX</small></h1>
        <!-- WIDGET END -->

        <!-- NEW WIDGET START -->
        <div class="row">
        	<div class="col-sm-12 col-md-12 col-lg-3">
        		<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" role="widget">
				<header>
					<h2> Draggable Events </h2>
				</header>
                    <button id="ajouterPeriode" class="btn btn-primary ui-btn-sm">Ajouter une période</button>
                    <input type="hidden" name="nbPeriode" id="nbPeriode" value="1" />
				<div class="well well-sm" id="event-container">
					<form>
						<fieldset>
							<ul id="external-events" class="list-unstyled">
                                <li class="ui-draggable" style="position: relative;">
                                    <span class="bg-color-green txt-color-white external-event" data-description="Période réservée aux vacances" data-icon="fa-pie">Vacances</span>
                                </li>
                                
                                <li class="ui-draggable" style="position: relative;">
                                    <span class="bg-color-darken txt-color-white external-event" data-description="Période réservée à l'enseignement" data-icon="fa-time">Période #1</span>
                                </li>
								<!--<li class="ui-draggable" style="position: relative;">
									<span class="bg-color-red txt-color-white external-event" data-description="Urgent Tasks" data-icon="fa-alert">URGENT</span>
								</li>-->
							</ul>
						</fieldset>
					</form>
		
				</div>
				</div>
				
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<!-- new widget -->
				<div class="jarviswidget jarviswidget-color-blueDark"
                    data-widget-colorbutton="false"
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="false"
					data-widget-sortable="false">
					<header>
						<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
						<h2> My Events </h2>
					</header>
		
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

    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<link href='{{asset('js/plugin/fullcalendar-school/fullcalendar.css') }}' rel='stylesheet' />
<link href='{{asset('js/plugin/fullcalendar-school/fullcalendar.print.css') }}' rel='stylesheet' media='print' />
<script src='{{asset('js/plugin/fullcalendar-school/fullcalendar.js') }}'></script>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();


        $("#ajouterPeriode").click(function() {
            nbPeriode = $("#nbPeriode").val();
            nbPeriode++;
            $("#external-events").append("<li class=\"ui-draggable\" style=\"position: relative;\"><span class=\"bg-color-darken txt-color-white external-event\" data-description=\"Période réservée à l'enseignement\" data-icon=\"fa-time\">Période #"+nbPeriode+"</span> </li>");
            makeDraggable();
            $("#nbPeriode").val(nbPeriode);
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
            weekends : false,
			defaultView: 'year',
            firstDay: 1,
            firstMonth: 8,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

                console.log(originalEventObject);
                console.log(copiedEventObject);
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
			},
            eventResizeStop: function (event, jsEvent, ui, view) {
                console.log(event);

            }
		});
		
		
	});

</script>