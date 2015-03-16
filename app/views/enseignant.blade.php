@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Enseignant <small>Cette page permet de gérer les enseignants</small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Liste des enseignants </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Statut horaire </th>
                                        <th>Pourcentage </th>
                                        <th>Voir attribution heure</th>
                                        <th>Voeux enseignant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if (!empty($enseignant))
                                    @foreach ($enseignant as $e)
                                    <tr>
                                        <td>{{ $e->LASTNAME }}</td>
                                        <td>{{ $e->FIRSTNAME }}</td>
                                        <td>
                                            <a id="enseignant-statut-{{ str_replace('.', '', $e->LOGIN) }}" class="enseignant-statut" href="#" onclick="handleEnseignantStatus(this);return false;" data-taux-horaire-specifique="{{$e->taux_horaire_specifique}}" data-idEnseignant="{{ $e->LOGIN }}">
                                            @if(!empty($typeStatus) && $e->id != NULL)
                                                @if($e->taux_horaire_specifique == 0)
                                                    <span data-status="{{ intval($e->typestatus_id) }}" data-volumeHoraire="{{ intval($e->volume_horaire) }}">
                                                    {{ $typeStatus[intval($e->typestatus_id)]["label"] }} -
                                                    {{ $typeStatus[intval($e->typestatus_id)]["heure"] }} h</span>
                                                @else
                                                    <span data-status="{{ intval($e->typestatus_id) }}" data-volumeHoraire="{{ intval($e->volume_horaire) }}">
                                                    {{ $e->volume_horaire }} h</span>
                                                @endif
                                            @else
                                            <span data-id="-1" data-status="0" data-volumeHoraire="-1">Statut non renseigné</span>
                                            @endif
                                            </a>
                                        </td>
                                        <td>
                                            <div class="easy-pie-chart text-danger easyPieChart" data-percent="0" data-pie-size="25" data-pie-track-color="rgba(169, 3, 41,0.07)" style="width: 30px; height: 30px; line-height: 30px;">
                                                <span class="percent txt-color-red">0</span>
                                            </div>
                                            % heures planifiées
                                        </td>
                                        <td></td>
                                        <td><a href="/enseignant/{{$e->LOGIN}}/voeux">Voir voeux</a></td>
                                    </tr>
                                    @endforeach
                                @else
                                <p>Aucun enseignant à afficher</p>
                                @endif
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
</section>

<!-- #dialog-message -->
<div id="dialog-message" title="Dialog Simple Title">
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
                            @foreach ($typeStatus as $t)
                            @if($t['id'] != 1)
                            <option value="{{$t['id']}}">{{$t['label']}} - {{$t['heure']}} à {{$t['heure_max']}} heures </option>
                            @endif
                            @endforeach
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

<style>

    .widget-body{
        padding: 0px 0px 0;
    }
</style>


<script type="text/javascript">
    function handleEnseignantStatus(el) {
        var idStatus = parseInt($(el).find("span").attr("data-status"));
        var volumeHoraire = parseInt($(el).find("span").attr("data-volumeHoraire"));
        var idEnseignant = $(el).attr("data-idEnseignant");
        var tauxHoraireSpecifique = $(el).attr("data-taux-horaire-specifique");

        $("#input-idEnseignant").val(idEnseignant);

        if (idStatus <= 1) { // cet enseignant n'a pas de status
            $("#input-status").val(-1);
            if (tauxHoraireSpecifique == 0) {
                // nouvel enseignant ?
                $("#input-volumeHoraire").val("");
                $("#input-choix").prop("checked", false);
                toggleVisibilityFormChoix(false);
            } else {
                // il a un volume horaire spécifique
                $("#input-volumeHoraire").val(volumeHoraire);
                $("#input-choix").prop("checked", true);
                toggleVisibilityFormChoix(true);
            }
        } else {
            $("#input-volumeHoraire").val("");
            $("#input-status").val(idStatus);
            $("#input-choix").prop("checked", false);
            toggleVisibilityFormChoix(false);
        }
        $('#dialog-message').dialog('open');
        return false;
    }
    function modifier_statut() {
        var from_data = {
            "volumeHoraire": $("#input-volumeHoraire").val(),
            "status": $("#input-status").val(),
            "idEnseignant":$("#input-idEnseignant").val(),
            "choix" : $("#input-choix").is(':checked') ? "1" : "0",
        };
        $.ajax({
            url: "enseignant/status",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            $.bigBox({
                title: "Modification réalisé",
                content: "Le status de l'enseignant a bien été modifié !",
                color: "#3276B1",
                icon: "fa fa-bell swing animated",
                timeout: 2000
            });
            // modifie la valeur dans le tableau
            if (from_data["choix"] == "0") {
                $("#enseignant-statut-"+from_data["idEnseignant"].replace(/\./g,'')).html($("#input-status > option[value="+from_data["status"]+"]").html())
            } else {
                $("#enseignant-statut-"+from_data["idEnseignant"].replace(/\./g,'')).html(from_data["volumeHoraire"]+"h")
            }
        })
        .fail(function (html) {
            $.bigBox({
                title: "Modification réalisé",
                content: "Un problème est survenu !",
                color: "#C46A69",
                icon: "fa fa-warning swing animated",
                timeout: 3000
            });
        });
    }
    function toggleVisibilityFormChoix(bool) {
        if (bool) {
            $("#section-status-input").show();
            $("#section-status-select").hide();
        } else {
            $("#section-status-input").hide();
            $("#section-status-select").show();
        }
    }
    $(document).ready(function () {
        pageSetUp();
        $('#dt_basic_enseignant').DataTable();

        $('#dialog-message').dialog({
            autoOpen: false,
            modal: true,
            title: "Modifier le statut",
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
                        modifier_statut();
                    }
                }]
        });
        // au click sur le statut d'un enseignant
        // recupere idStatus et le volume horaire
        // et ouvre la pop up selon ces vars
        
        $("#input-choix").bind('change', function() {
            if ($(this).is(':checked')) {
                toggleVisibilityFormChoix(true);
            } else {
                toggleVisibilityFormChoix(false);
            }
        })
    });
</script>