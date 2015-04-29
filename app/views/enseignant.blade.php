@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Enseignants <small>Cette page permet de gérer les enseignants</small></h1>
        <!-- NEW WIDGET START -->
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("enseignant")}}
        </div>
    </div>
    <div class="row">
        <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Statut horaire </th>
                    <th>Voir attribution heure</th>
                    <th>Voeux enseignant</th>
                </tr>
            </thead>
            <tbody>
                
                @if (!empty($enseignant))
                @foreach ($enseignant as $e)
                <tr>
                    <td>{{ ucfirst($e->LASTNAME) }}</td>
                    <td>{{ ucfirst($e->FIRSTNAME) }}</td>
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
                    <td><a href="{{ route('generationFicheProf', array($e->LOGIN))}}#tabs-c">Voir fiche enseignant</a></td>
                    <td><a href="{{ route('generationFicheProf', array($e->LOGIN))}}">Voir voeux</a></td>
                </tr>
                @endforeach
            @else
            <p>Aucun enseignant à afficher</p>
            @endif
            </tbody>
        </table>
    </div>
</section>

<div id="modalstatut" class="modal fade" title="Statut" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier le statut</h4>
            </div>
            <div class="modal-body">
                <div class="row form-horizontal">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="input">Appliquer un volume horaire spécifique</label>
                            <input name="choix" id="input-choix" class="form-control" type="checkbox" />
                        </div>
                        <div id="section-status-select" class="form-group">
                            <label class="select">Type de statut</label>
                            <select name="status" class="form-control" id="input-status">
                                @foreach ($typeStatus as $t)
                                @if($t['id'] != 1)
                                <option value="{{$t['id']}}">{{$t['label']}} - {{$t['heure']}} à {{$t['heure_max']}} heures </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div id="section-status-input" class="form-group">
                            <label class="input">Volume horaire</label>
                            <input type="text" name="volumeHoraire" class="form-control" placeholder="Exemple : 192" id="input-volumeHoraire">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idEnseignant" id="input-idEnseignant">
                <input type="hidden" name="id" id="input-id-statusenseignant">
            </div>
            <div class="modal-footer">
                <button id="annuler" type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input id="validerstatut" type="submit" class="btn btn-primary" value="Valider" />
            </div>
        </div>
    </div>
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
        $("#modalstatut").modal('toggle');
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
        
        $("#input-choix").bind('change', function() {
            if ($(this).is(':checked')) {
                toggleVisibilityFormChoix(true);
            } else {
                toggleVisibilityFormChoix(false);
            }
        })

        $("#annuler").click(function() {
            $("#modalstatut").modal('toggle');
        });

        $("#validerstatut").click(function() {
            modifier_statut();
            $("#modalstatut").modal('toggle');
        });
    });
</script>