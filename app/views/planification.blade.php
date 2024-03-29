@include('layout.header')
<section id="widget-grid" class="">
    <div class="row" id="drag">
        <!-- NEW WIDGET START -->
    	<h1>Planification <small>{{$formation->long_title}}</small></h1>
        <!-- WIDGET END -->
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("planification")}}
        </div>

        <div class="row">

            <div class="col-sm-12">
                <a href="{{ route('module')}}" class="btn btn-primary pull-right" style="margin-left:3px;">Aller à la configuration</a>
                <a href="{{ route('affectation')}}" class="btn btn-primary pull-right">Aller à l'affectation</a>
            </div>
                        
            <div class="col-sm-12 col-md-3 col-lg-3">
                <h3>Groupes de cours à planifier</h3>
                <form>
                    <div data-id="supprimer" data-size="1000" class="droppable col-sm-12 well">
                        <ul id="liste" class="list-unstyled">
                            @foreach ($groupesCoursLibres as $groupeCours)
                            <li>
                                <div data-id="{{$groupeCours->id}}" data-size="{{$groupeCours->nbcours}}" class="draggable bg-color-green txt-color-white">
                                    {{$groupeCours->libelle}} ({{$groupeCours->nbcours}} séance(s))
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>

            <div id="periodes" class="col-sm-12 col-md-9 col-lg-9">
                <h3>Périodes d'enseignements</h3>
                <div class="row">
                    @foreach ($periodes as $periode)
                    <div class="col-sm-12">
                        <span>Période {{$periode["nom"]}} du {{$periode["dateDebut"]}} au {{$periode["dateFin"]}} : {{count($periode['sem'])}} semaine(s)</span>
                    </div>
                    <div class="col-sm-12">
                        <div data-id="{{$periode["id"]}}" data-size="{{count($periode['sem'])}}" class="droppable col-sm-12 well">
                            Déposez les cours ici
                            <ul id="liste" class="list-unstyled">
                                @foreach ($periode["groupesCours"] as $groupeCours)
                                <li>
                                    <div data-id="{{$groupeCours->id}}" data-size="{{$groupeCours->nbcours}}" class="draggable bg-color-green txt-color-white" style="width: 50%;">
                                        {{$groupeCours->libelle}} ({{$groupeCours->nbcours}} séance(s))
                                        @if ($groupeCours->nbcours != count($periode['sem']))
                                        &nbsp;Semaine {{$groupeCours->semaine}}
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modaldecalage" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button id="annuler" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input id="validerdecalage" type="submit" class="btn btn-primary" value="Valider" />
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
    });

    $(init);

    // Initialisation du drag and drop
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
        var calendrierID = droppable.attr('data-id');
        var sizeGroupeCours = parseInt(draggable.attr('data-size')); 
        var sizeCalendrier = parseInt(droppable.attr('data-size'));

        if(sizeGroupeCours == sizeCalendrier || calendrierID == "supprimer") {
            planificationSimple(draggable, droppable);
        } else if(sizeGroupeCours < sizeCalendrier) {
            planificationDecalage(draggable, droppable);
        } else {
            planificationImpossible(draggable, droppable);
        }
    }

    function planificationSimple(groupecours, calendrier) {
        envoyerPlanification(groupecours, calendrier, 1, "simple");
	}

    function planificationImpossible(groupecours, calendrier) {
        $.bigBox({
            title: "Erreur",
            content: "Il y a trop de cours pour affecter ce groupe à cette période.",
            color: "#C46A69",
            icon: "fa fa-warning swing animated",
            timeout: 3000
        });

        mettreAJourAffichageRevert(groupecours);
    }

    var dernierGroupeCours;
    var dernierCalendrier;

    function planificationDecalage(groupecours, calendrier) {
        dernierCalendrier = calendrier;
        dernierGroupeCours = groupecours;

        //Récupération des dates des semaines en ajax
        var from_data = {
            "calendrierID": calendrier.attr('data-id'),
        };
        $.ajax({
            url: "datesSemaines",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            // Ajout des dates des semaines au dropdown
            dates = JSON.parse(html);
            $('#decalage').empty();
            var limite = calendrier.attr('data-size')-groupecours.attr('data-size');
            for(var i = 1; i<=limite+1; i++){
                $('#decalage').append("<option value='"+i+"'>Semaine "+i+" commençant le "+dates[i-1]+"</option>");
            }

            $('#modaldecalage').modal('toggle');

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

    $('#validerdecalage').click(function(){
        $('#modaldecalage').modal('toggle');
        envoyerPlanification(dernierGroupeCours, dernierCalendrier, $('#decalage').val(), "decalage");
    });

    $('#annuler').click(function(){
        $('#modaldecalage').modal('toggle');
        mettreAJourAffichageRevert(dernierGroupeCours);
    });

    //Envoie de la planification en ajax au controleur
    function envoyerPlanification(groupecours, calendrier, semaine, type) {
        var from_data = {
            "groupecoursID": groupecours.attr('data-id'),
            "calendrierID": calendrier.attr('data-id'),
            "semaine": semaine,
        };
        $.ajax({
            url: "ajouterPlanification",
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

            mettreAJourAffichage(groupecours, calendrier, type);
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

    // Gestion de l'affichage des listes lors d'un drag and drop
    function mettreAJourAffichage(groupecours, calendrier, type) {
        var elem = groupecours.parent();
        var liste = calendrier.find('#liste');
        var texte = groupecours.text();
        if(texte.substr(0,texte.indexOf("Semaine")) != "") {
            texte = texte.substr(0,texte.indexOf("Semaine"));
        }

        if(liste.parent().attr('data-size') == "1000") {
            var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white">'+texte+'</div></li>';   
        } else {
            if(type=="simple") {
                var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white" style="width: 50%;">'+texte+'</div></li>';
            } else {
                var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white" style="width: 50%;">'+texte+' Semaine '+$('#decalage').val()+'</div></li>';
            } 
        }
        liste.append(html_element);
        elem.remove();

        $(init);
    }

    function mettreAJourAffichageRevert(groupecours) {
        var elem = groupecours.parent();
        var liste = elem.parent();
        var texte = groupecours.text();

        if(liste.parent().attr('data-size') == "1000") {
            var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white">'+texte+'</div></li>';   
        } else {
            var html_element='<li><div data-id="'+groupecours.attr('data-id')+'" data-size="'+groupecours.attr('data-size')+'" class="draggable bg-color-green txt-color-white" style="width: 50%;">'+texte+'</div></li>';
        }
        liste.append(html_element);
        elem.remove();

        $(init);
    }
</script>