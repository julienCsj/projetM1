@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Formation / UE / Matières <small>Cette page permet de gérer le volume de CM/TD/TP</small></h1>
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
                                        <td>{{ $e['nom'] }}</td>
                                        <td>{{ $e['prenom'] }}</td>
                                        <td><a class="enseignant-statut" href="#">Statut 1</a></td>
                                        <td>
                                            <div class="easy-pie-chart text-danger easyPieChart" data-percent="33" data-pie-size="25" data-pie-track-color="rgba(169, 3, 41,0.07)" style="width: 30px; height: 30px; line-height: 30px;">
                                                <span class="percent txt-color-red">66</span>
                                            </div>
                                            quota d'heure réalisé
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
        This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.
    </p>

    <div class="hr hr-12 hr-double"></div>


    Currently using
    <b>36% of your storage space</b>
    <div class="progress progress-striped active no-margin">
        <div class="progress-bar progress-primary" role="progressbar" style="width: 36%"></div>
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
        alert("Fonctionnel");
    }
</script>