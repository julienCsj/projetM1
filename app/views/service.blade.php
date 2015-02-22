@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Service</h1>
        	<br/>
    </div>
    <div class="row">
    	<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" role="widget">
				<header>
					<h2> Paliers </h2>
				</header>
				<div class="well well-sm" id="event-container">

			    		<span class="text">
			    			Service minimal
			    			<span class="pull-right">
			    				130/200 heures
			    			</span>
			    		</span>
						<div class="progress">
							<div class="progress-bar bg-color-greenLight" style="width: 65%;"></div>
						</div>
			    		<span class="text">
			    			Service maximal
			    			<span class="pull-right">
			    				130/400 heures
			    			</span>
			    		</span>
						<div class="progress">
							<div class="progress-bar bg-color-blue" style="width: 32%;"></div>
						</div>

				</div>
			</div>
		</article>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
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


    
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->
<script src="back/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="back/js/plugin/fuelux/wizard/wizard.min.js"></script>
<script src="back/js/plugin/ion-slider/ion.rangeSlider.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="back/js/plugin/jquery.ui.addresspicker.js"></script>

<link href='/js/plugin/fullcalendar-school/fullcalendar.css' rel='stylesheet' />
<link href='/js/plugin/fullcalendar-school/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/js/plugin/fullcalendar-school/fullcalendar.js'></script>




<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();

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
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
			}
		});
    });
</script>