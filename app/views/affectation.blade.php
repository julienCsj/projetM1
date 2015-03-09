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
                            <div class="row col-sm-12">
                                <div class="well">
                                    TD archi : 6 séances
                                    <button data-toggle="modal" data-target="#affecter-1" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-tags"></i> Affectation</button>
                                    <button data-toggle="modal" data-target="#gerer-1" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-cog"></i> Gestion des séances</button>
                                </div>
                            </div>
                            <div class="row col-sm-12">
                                <div class="well">
                                    CM Management : 3 séances
                                    <button data-toggle="modal" data-target="" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-tags"></i> Affectation</button>
                                    <button data-toggle="modal" data-target="" href="javascript(void);" class="btn btn-xs btn-default pull-right"><i class="fa fa-cog"></i> Gestion des séances</button>
                                </div>
                            </div>
                            <button class="btn btn-success"><i class="fa fa-plus"></i> Ajouter un groupe</button>
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
                </div>
            </div>
        </div>
    </div>
</section>

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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Séances de 1h
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Séances de 1h30
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" required>
                            <label class="input">Séances de 2h
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
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
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
                        </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Séances de 1h30
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" required>
                            <label class="input">Séances de 2h
                                <input class="form-control ui-spinner-input" id="spinner-decimal" name="spinner-decimal" value="7.99" aria-valuenow="7.99" autocomplete="off" role="spinbutton">
                            </label>
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