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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enseignant as $e)
                                    <tr>
                                        <td>{{ $e->LASTNAME }}</td>
                                        <td>{{ $e->FIRSTNAME }}</td>
                                        <td><a class="enseignant-statut" href="#">{{ $typeStatus[intval($e->ROLES)]->label }} - {{ $typeStatus[intval($e->ROLES)]->heure }} h</a></td>
                                        <td>
                                            <div class="easy-pie-chart text-danger easyPieChart" data-percent="0" data-pie-size="25" data-pie-track-color="rgba(169, 3, 41,0.07)" style="width: 30px; height: 30px; line-height: 30px;">
                                                <span class="percent txt-color-red">0</span>
                                            </div>
                                            % heures planifiées
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
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

    <div class="hr hr-12 hr-double"></div>
    <form id="form-status-enseignant" class="smart-form" novalidate="novalidate">

        <fieldset>
            <div class="row">
                <section> Valeur classique
                    <label class="select">
                        <select name="status" id="input-status">
                            @foreach ($typeStatus as $t)
                            <option value="{{$t->id}}">{{$t->label}} - {{$t->heure}} heures </option>
                            @endforeach
                        </select> <i></i> </label>
                </section>
            </div>  

            <hr>
            <br>
            <div class="row">
                <section>
                    <label class="input"> Ou saissisez le volume horaire
                        <input type="text" name="volumeHoraire" placeholder="192" id="input-volumeHoraire">
                    </label>
                </section>
            </div>
            
        </fieldset>
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
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

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

        $(".enseignant-statut").bind('click', function () {
            $('#dialog-message').dialog('open');
            return false;

        })
    });

    function modifier_statut() {
        var from_data =  {"volumeHoraire" : $("#input-volumeHoraire").val(),
                        "status" : $("#input-status").val()};
                        console.log(from_data);
        $.ajax({
            url: "test.html",
            data: from_data
        })
        .done(function( html ) {
            $.bigBox({
                title : "Modification réalisé",
                content : "Le status de l'enseignant a bien été modifié !",
                color : "#3276B1",
                icon : "fa fa-bell swing animated",
                number : "2",
                timeout : 6000
            });
        })
        .fail(function( html ) {
            $.bigBox({
                title : "Modification réalisé",
                content : "Un problème est survenu !",
                color : "#C46A69",
                icon : "fa fa-warning shake animated",
                number : "2",
                timeout : 6000
            });
        });
    }
</script>