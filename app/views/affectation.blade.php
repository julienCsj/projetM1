@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Affectation</h1>
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
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <form>
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
                            </form>
                        </div>

                        <div id="groupes" class="col-sm-12">
                            <div class="col-sm-12">
                                <i class="fa fa-cog"></i>
                                <div class="droppable col-sm-12 well">TD archi</div>
                                <i class="fa fa-plus-circle"></i>
                                <i class="fa fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div id="tabs-b">
                    <div class="row" id="drag">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <form>
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

<!-- #dialog-message -->
<div id="dialog-message" title="Affecter">
    <span>Vous pouvez changer le statut de l'enseignant pour définir le volume horaire, ou le renseigner à la main</span>
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
                        //valider_affectation();
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