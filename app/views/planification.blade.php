@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
    	<h1>Planification</h1>
        <!-- WIDGET END -->
    </div>
                    
    <div class="row" id="drag">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <h3>Groupe de cours à planifier</h3>
            <form>
                <div data-id="supprimer" class="droppable col-sm-12 well">
                    <ul id="external-events" class="list-unstyled">
                        @foreach ($groupesCoursLibres as $groupeCours)
                        <li style="position: relative;">
                            <span data-id="{{$groupeCours->id}}"  class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">TD {{$groupeCours->short_title}} (6)</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </div>

        <div id="periodes" class="col-sm-12 col-md-9 col-lg-9">
            <h3>Périodes d'enseignements</h3>
            @foreach ($periodes as $periode)
            <div class="col-sm-12">
                <span>Période du {{$periode["dateDebut"]}} au {{$periode["dateFin"]}} : x semaines</span>
            </div>
            <div class="col-sm-12">
                <div data-id="{{$periode["id"]}}" class="droppable col-sm-12 well">
                    Déposez les cours ici
                    <ul id="external-events" class="list-unstyled">
                        @foreach ($periode["groupesCours"] as $groupeCours)
                        <li style="position: relative;">
                            <span data-id="{{$groupeCours->id}}"  class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">TD {{$groupeCours->short_title}} (6)</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
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
	    	zIndex: 1000,
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
        var droppable = $(this);

        var groupecoursID = draggable.attr('data-id');
        var calendrierID = droppable.attr('data-id');;
        alert( '"'+droppable.attr('data-id')+'" !' );

        var from_data = {
            "groupecoursID": groupecoursID,
            "calendrierID": calendrierID,
        };
        $.ajax({
            url: "{{$formation->id}}/ajouterPlanification",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            $.bigBox({
                title: "Planification réussie",
                content: 'La groupe de cours a été affecté à la période choisie.',
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
	}
</script>