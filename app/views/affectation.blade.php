@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
    	<h1>Affectation et planification</h1>
        <br>
        <br>
        <!-- WIDGET END -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="tabs">
                <ul>
                    <li>
                        <a href="#tabs-a">Affecter</a>
                    </li>
                    <li>
                        <a href="#tabs-b">Planifier</a>
                    </li>
                </ul>
                <div id="tabs-a">
                    <div class="row" id="drag">
                        <div id="groupes" class="col-sm-12">
                            <h3>Création et affectation des groupes de cours</h3>
                            @foreach ($groupesCours as $groupeCours)
                            <div class="row col-sm-12">
                                <div class="well">
                                    TD {{$groupeCours->short_title}} : 6 séances
                                    <a class="btn btn-xs btn-danger pull-right" href="{{ route('affectation.supprimerGroupeCours', array($groupeCours->id)); }}">Supprimer</a>
                                    <button data-toggle="modal" data-target="#affecter-{{$groupeCours->id}}" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-tags"></i> Affectation</button>
                                    <button data-toggle="modal" data-target="#gerer-{{$groupeCours->id}}" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-cog"></i> Gestion des séances</button>
                                </div>
                            </div>
                            @endforeach
                            <button class="btn btn-success" data-toggle="modal" data-target="#ajouter" href="javascript(void);"><i class="fa fa-plus"></i> Ajouter un groupe</button>
                        </div>

                    </div>                  
                </div>
                <div id="tabs-b">
                    <div class="row" id="drag">
                        <div class="col-sm-12">
                            <h3>Planification des cours sur les périodes d'enseignement</h3>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <form>
                                <ul id="external-events" class="list-unstyled">
                                    @foreach ($groupesCours as $groupeCours)
                                    <li style="position: relative;">
                                        <span id="groupecours_{{$groupeCours->id}}" class="draggable bg-color-green txt-color-white external-event" data-icon="fa-pie">TD {{$groupeCours->short_title}} (6)</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>

                        <div id="periodes" class="col-sm-12 col-md-9 col-lg-9">
                            @foreach ($periodes as $periode)
                            <div class="col-sm-12">
                                <span>Période du {{$periode->dateDebut}} au {{$periode->dateFin}} : x semaines</span>
                            </div>
                            <div class="col-sm-12">
                                <div class="droppable col-sm-12 well">Déposez les cours ici</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'un groupe de cours</h4>
            </div>
            {{ Form::open(array('route' => 'affectation.ajouterGroupeCours')) }}
            <input type="hidden" name="formation" value="{{$formation->id}}" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label class="input">Module</label>
                            <select name="module" class="form-control" required/>
                                @foreach ($modules[0] as $module)
                                <option value="{{$module->id}}">{{$module->short_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="gerer-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Gestion des séances</h4>
            </div>
            {{ Form::open(array('route' => 'groupe.ajouterGroupe')) }}
            <input type="hidden" name="id" value="" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label class="input">Séances de 1h
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>  
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label class="input">Séances de 1h30
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group" required>
                            <label class="input">Séances de 2h
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="affecter-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Affectation des séances</h4>
            </div>
            {{ Form::open(array('route' => 'groupe.ajouterGroupe')) }}
            <input type="hidden" name="id" value="" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Séances de 1h
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Séances de 1h30
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" required>
                            <label class="input">Séances de 2h
                            </label>
                            <input class="form-control spinner-both" type="number" name="groupeCM" value="7">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Valider" />
            </div>
            {{ Form::close() }}
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