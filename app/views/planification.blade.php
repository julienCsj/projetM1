@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
    	<h1>Planification</h1>
        <br>
        <br>
        <!-- WIDGET END -->
    </div>
                    
    <div class="row" id="drag">
        <div class="col-sm-12">
            <h3>Planification des cours sur les périodes d'enseignement</h3>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3">
            <form>
                <ul id="external-events" class="list-unstyled">
                    <li style="position: relative;">
                        <span id="COURS1" class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">TD Archi (6)</span>
                    </li>
                    <li style="position: relative;">
                        <span id="COURS2" class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">CM Management (3)</span>
                    </li>
                </ul>
            </form>
        </div>

        <div id="periodes" class="col-sm-12 col-md-9 col-lg-9">
            <div class="col-sm-12">
                <span>Période du x/x/x au x/x/x : x semaines</span>
            </div>
            <div class="col-sm-12">
                <div class="droppable col-sm-12 well">Déposez les cours ici</div>
            </div>
            <div class="col-sm-12">
                <span>Période du x/x/x au x/x/x : x semaines</span>
            </div>
            <div class="col-sm-12">
                <div class="droppable col-sm-12 well">Déposez les cours ici</div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();

        $('#tabs').tabs();

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
                    html: "<i class='fa fa-check'></i>&nbsp; Valider",
                    "class": "btn btn-primary",
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
        });
    });

    $(init);

    function init() {
	    $('.draggable').draggable({
	    	containment: '#drag',
	    	stack: '.droppable',
	    	cursor: 'move',
	    	revert: 'invalid',
		    helper: 'original'
		});
		$('.droppable').droppable({
			drop: handleDropEvent,
			activeClass: "well-light",
			hoverClass: "bg-color-teal",
    		accept: ".draggable"
		});
	}

	function handleDropEvent(event, ui){
		var draggable = ui.draggable;
		//$('#dialog-message').dialog('open');
		draggable.data("draggable").originalPosition = {top:0, left:0};
		//alert( 'Le cours ayant pour id "' + draggable.attr('id') + '" est tombé sur oim, "'+droppable.attr('id')+'" !' );
	}
</script>