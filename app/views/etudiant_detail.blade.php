
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Gestion des modules <small>@if(isset($formation)){{$formation->long_title}}@endif</small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
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
                        <h2>Liste des matières et volume horaire associé</h2>

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
                                        <th>UE</th>
                                        <th>CM</th>
                                        <th>TD </th>
                                        <th>TP </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($UElist as $ue)
                                    <tr>
                                <td>{{$ue["module"]->LONG_TITLE}}</td>
                                <td>{{$ue["totalCM"]}} ({{$ue["module"]->CM_PPN}} dans le PPN)</td>
                                <td>{{$ue["totalTD"]}} ({{$ue["module"]->TD_PPN}} dans le PPN)</td>
                                <td>{{$ue["totalTP"]}} ({{$ue["module"]->TP_PPN}} dans le PPN)</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!


    function computeCM() {
        var nbCm = parseFloat($("#spinner-cm60").val())
                + parseFloat($("#spinner-cm90").val()) * 1.5
                + parseFloat($("#spinner-cm120").val()) * 2;
        $("#CMeff").html(""+nbCm);
    }

    function computeTD() {
        var nbTd = parseFloat($("#spinner-td60").val())
                + parseFloat($("#spinner-td90").val()) * 1.5
                + parseFloat($("#spinner-td120").val()) * 2;
        $("#TDeff").html(""+nbTd);
    }

    function computeTP() {
        var nbTp = parseFloat($("#spinner-tp60").val())
                + parseFloat($("#spinner-tp90").val()) * 1.5
                + parseFloat($("#spinner-tp120").val()) * 2;
        $("#TPeff").html(""+nbTp);
    }
    $(document).ready(function () {
        //pageSetUp();

        $('#tabs').tabs();
        $("#menu").menu();

        computeCM();
        computeTD();
        computeTP();

        $("#spinner-cm60").change( function() { computeCM();});
        $("#spinner-cm90").change( function() { computeCM(); } );
        $("#spinner-cm120").change( function() { computeCM(); } );

        $("#spinner-td60").change( function() { computeTD(); } );
        $("#spinner-td90").change( function() { computeTD(); } );
        $("#spinner-td120").change( function() { computeTD(); } );

        $("#spinner-tp60").change( function() { computeTP(); } );
        $("#spinner-tp90").change( function() { computeTP(); } );
        $("#spinner-tp120").change( function() { computeTP(); } );
    });



</script>