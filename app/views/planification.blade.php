//FIXER LA TAILLE DES GROUPESCOURS
// FAIRE MARCHER LA MODALE

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
                <div data-id="supprimer" data-size="1000" class="droppable col-sm-12 well">
                    <ul id="liste" class="list-unstyled">
                        @foreach ($groupesCoursLibres as $groupeCours)
                        <li>
                            <div data-id="{{$groupeCours->id}}" data-size="{{$groupeCours->nbcours}}" class="draggable bg-color-green txt-color-white">{{$groupeCours->libelle}} ({{$groupeCours->nbcours}})</div>
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
                <span>Période du {{$periode["dateDebut"]}} au {{$periode["dateFin"]}} : {{count($periode['sem'])}} semaines</span>
            </div>
            <div class="col-sm-12">
                <div data-id="{{$periode["id"]}}" data-size="{{count($periode['sem'])}}" class="droppable col-sm-12 well">
                    Déposez les cours ici
                    <ul id="liste" class="list-unstyled">
                        @foreach ($periode["groupesCours"] as $groupeCours)
                        <li>
                            <div data-id="{{$groupeCours->id}}" data-size="{{$groupeCours->nbcours}}" class="draggable bg-color-green txt-color-white">{{$groupeCours->libelle}} ({{$groupeCours->nbcours}})</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="modaledecalage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Planification avec décalage</h4>
            </div>
            <div class="modal-body">
                <div class="row form-horizontal">
                    <div id="planification-formulaire" class="col-md-12">
                        <label class="input">Sélectionnez la semaine du premier cours</label>
                        <select id="decalage" name="decalage" class="form-control" required/>
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
        </div>
    </div>
</div>

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
                        //affec
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
    		accept: ".draggable"/*function(elem) { 
                if(elem.attr('data-size') <= $(this).parent().attr('data-size')){
                    return true;
                }
            }*/
		});
	}

	function handleDropEvent(event, ui){
		var draggable = ui.draggable;
        var droppable = $(this);

        var groupecoursID = draggable.attr('data-id');
        var calendrierID = droppable.attr('data-id');
        var sizeGroupeCours = draggable.attr('data-size'); 
        var sizeCalendrier = droppable.attr('data-size');

        if(sizeGroupeCours < sizeCalendrier) {
            planificationDecalage(draggable, droppable);
        } else if(sizeGroupeCours == sizeCalendrier || calendrierID == "supprimer") {
            planificationSimple(draggable, droppable);
        } else {
            planificationImpossible(draggable, droppable);
        }
    }

    function planificationSimple(groupecours, calendrier) {
        var from_data = {
            "groupecoursID": groupecours.attr('data-id'),
            "calendrierID": calendrier.attr('data-id'),
        };
        $.ajax({
            url: "{{$formation->id}}/ajouterPlanification",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            $.bigBox({
                title: "Planification réussie",
                content: 'Le groupe de cours a été affecté à la période choisie.',
                color: "#3276B1",
                icon: "fa fa-bell swing animated",
                timeout: 2000
            });
            var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white">'+groupecours.text()+'</div></li>';
            
            var elem = groupecours.parent();
            var liste = calendrier.find('#liste');
            liste.append(html_element);
            elem.remove();

            $(init);

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

    function planificationDecalage(groupecours, calendrier) {
        $('#modaledecalage').modal('toggle');

        var from_data = {
            "groupecoursID": groupecours.attr('data-id'),
            "calendrierID": calendrier.attr('data-id'),
           // "decalage": 
        };
        $.ajax({
            url: "{{$formation->id}}/ajouterPlanification",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            $.bigBox({
                title: "Planification réussie",
                content: 'Le groupe de cours a été affecté à la période choisie.',
                color: "#3276B1",
                icon: "fa fa-bell swing animated",
                timeout: 2000
            });
            var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white">'+groupecours.text()+'</div></li>';   

            var elem = groupecours.parent();
            var liste = calendrier.find('#liste');
            liste.append(html_element);
            elem.remove();

            $(init);

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

    function planificationImpossible(groupecours, calendrier) {
        //$('#modaledecalage').modal('toggle');

        $.bigBox({
            title: "Erreur",
            content: "Il y a trop de cours pour affecter ce groupe à cette période.",
            color: "#C46A69",
            icon: "fa fa-warning swing animated",
            timeout: 3000
        });

        var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white">'+groupecours.text()+'</div></li>';

        var elem = groupecours.parent();
        var liste = elem.parent();
        liste.append(html_element);
        elem.remove();

        $(init);
    }
</script>