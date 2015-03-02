@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Affectation</h1>
        <!-- WIDGET END -->
    </div>
    <div class="row" id="drag">
    	<div class="col-sm-12 col-md-3 col-lg-3">
    		<div class="jarviswidget jarviswidget-color-blueDark" role="widget">
				<header>
					<h2>Cours</h2>
				</header>
				<div class="well well-sm" id="event-container">
					<form>
						<fieldset>
							<ul id="external-events" class="list-unstyled">
	                            <li style="position: relative;">
	                                <span id="COURS1" class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">Cours#1</span>
	                            </li>
	                            <li style="position: relative;">
	                                <span id="COURS2" class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">Cours#2</span>
	                            </li>
							</ul>
							<ul id="external-events" class="list-unstyled">
	                            <li style="position: relative;">
	                                <span id="TD1" class="draggable bg-color-blue txt-color-white external-event" data-icon="fa-pie">TD#1</span>
	                            </li>
	                            <li style="position: relative;">
	                                <span id="TD2" class="draggable bg-color-blue txt-color-white external-event" data-icon="fa-pie">TD#2</span>
	                            </li>
							</ul>
							<ul id="external-events" class="list-unstyled">
	                            <li style="position: relative;">
	                                <span id="TP1" class="draggable bg-color-red txt-color-white external-event" data-icon="fa-pie">TP#1</span>
	                            </li>
	                            <li style="position: relative;">
	                                <span id="TP2" class="draggable bg-color-red txt-color-white external-event" data-icon="fa-pie">TP#2</span>
	                            </li>
							</ul>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<div id="periodes" class="col-sm-12 col-md-9 col-lg-9">
			<!-- new widget -->
			<div class="jarviswidget jarviswidget-color-blueDark" role="widget">
        		<header>
					<h2>Périodes</h2>
				</header>
				<div class="well well-sm" id="event-container">
					<div class="row">
						<div class="col-sm-12">
							<span>Période du x/x/x au x/x/x : x semaines</span>
						</div>
						<div class="col-sm-12">
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
						</div>
						<div class="col-sm-12">
							<span>Période du x/x/x au x/x/x : x semaines</span>
						</div>
						<div class="col-sm-12">
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
							<div class="droppable col-sm-3 well">Semaine</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- #dialog-message -->
<div id="dialog-message" title="Affecter">
    <p>
        Vous pouvez changer le statut de l'enseignant pour définir le volume horaire, ou le renseigner à la main
    </p>

    <form id="form-status-enseignant" class="smart-form" novalidate="novalidate">

        <fieldset>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" class="checkbox style-3" name="choix" id="input-choix">
                      <span>Appliquer un volume horaire spécifique</span>
                    </label>
                </div>
                <section id="section-status-select">
                    <label class="select">Type de status
                        <select name="status" id="input-status">
                           
                        </select> </label>
                </section>
                <section id="section-status-input">
                    <label class="input">Volume horaire
                        <input type="text" name="volumeHoraire" placeholder="192" id="input-volumeHoraire">
                    </label>
                </section>

        </fieldset>
        <input type="hidden" name="idEnseignant" id="input-idEnseignant">
        <input type="hidden" name="id" id="input-id-statusenseignant">
    </form>
</div>
<!-- #dialog-message -->

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();

        $('#dialog-message').dialog({
            autoOpen: false,
            modal: true,
            title: "Planifier un cours",
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
                        $(this).dialog("close");
                        //modifier_statut();
                    }
                }]
        });
    });

    $(init);

    function init() {
	    $('.draggable').draggable({
	    	containment: '#drag',
	    	cursor: 'move',
	    	zIndex: 100,
	    	revert: 'invalid',
		    helper: 'original'
		});
		$('.droppable').droppable({
			drop: handleDropEvent,
			hoverClass: "hover",
    		accept: ".draggable"
		});
	}

	function myHelper( event ) {
		return '<span class="bg-color-green txt-color-white external-event" data-icon="fa-pie">Cours</span>';
	}

	function handleDropEvent( event, ui ) {
		var draggable = ui.draggable;
		$('#dialog-message').dialog('open');
		//var droppable = ui.droppable
		//alert( 'Le cours ayant pour id "' + draggable.attr('id') + '" est tombé sur oim, "'+droppable.attr('id')+'" !' );
	}
</script>