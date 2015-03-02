@include('layout.header')
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <!-- NEW WIDGET START -->
            <h1>{{$matiere->LONG_TITLE}}</h1>
            <br/>
            <br/>
            {{ Form::open(array('route' => 'matiere.postModifierMatiere')) }}
                <input type="hidden" name="idFormation" value="{{$idFormation}}">
                <input type="hidden" name="idMatiere" value="{{$matiere->ID}}">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-1"
                     data-widget-editbutton="false"
                     data-widget-colorbutton="false"
                     data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false"
                     data-widget-collapsed="false"
                     data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                        <h2 class="font-md"><strong>Financements</strong></h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            <!-- ICI CODE DES UE-->
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Libelle</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($matiere->lesFinancements as $f)
                                    <tr>
                                        <td>{{$f->libelle}}</td>
                                        <td><a class="btn btn-xs btn-danger" href="{{ route('matiere.supprimerFinancement', array($idFormation, $matiere->ID, $f->id)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label>Ajouter des financements :</label>
                                    <select multiple style="width:100%" name="lesFinancements[]" class="select2">
                                        @foreach($lesFinancements as $financement)
                                        <option value="{{$financement->id}}">{{$financement->libelle}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-1"
                     data-widget-editbutton="false"
                     data-widget-colorbutton="false"
                     data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false"
                     data-widget-collapsed="false"
                     data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                        <h2 class="font-md"><strong>Effectifs & volume horaire</strong></h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            <p class="alert alert-info">Valeur du PPN : CM : {{$matiere->CM_PPN}}h -  TD : {{$matiere->TD_PPN}}h -  TP : {{$matiere->TP_PPN}}h</p>
                            <p class="alert alert-info">Valeur effective : CM : <span id="CMeff"></span> -  TD : <span id="TDeff"></span> -  TP : <span id="TPeff"></span></p>
                            <div class="table-responsive col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Groupe CM</label>
                                    <input class="form-control spinner-both"  id="spinner-Grcm" name="groupeCM" value="{{$matiere->GROUPE_CM}}">
                                </div>
                                <div class="form-group">
                                    <label>Groupe TD</label>
                                    <input class="form-control spinner-both"  id="spinner-Grtd" name="groupeTD" value="{{$matiere->GROUPE_TD}}">
                                </div>
                                <div class="form-group">
                                    <label>Groupe TP</label>
                                    <input class="form-control spinner-both"  id="spinner-Grtp" name="groupeTP" value="{{$matiere->GROUPE_TP}}">
                                </div>
                            </div>
                            <div class="table-responsive col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Séance CM (1h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-cm60" name="heureCM60" value="{{$matiere->CM_60}}">
                                    <label>Séance CM (1h30)</label>
                                    <input class="form-control spinner-both"  id="spinner-cm90" name="heureCM90" value="{{$matiere->CM_90}}">
                                    <label>Séance CM (2h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-cm120" name="heureCM120" value="{{$matiere->CM_120}}">
                                </div>
                                <div class="form-group">
                                    <label>Séance TD (1h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-td60" name="heureTD60" value="{{$matiere->TD_60}}">
                                    <label>Séance TD (1h30)</label>
                                    <input class="form-control spinner-both"  id="spinner-td90" name="heureTD90" value="{{$matiere->TD_90}}">
                                    <label>Séance TD (2h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-td120" name="heureTD120" value="{{$matiere->TD_120}}">
                                </div>
                                <div class="form-group">
                                    <label>Séance TP (1h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-tp60" name="heureTP60" value="{{$matiere->TP_60}}">
                                    <label>Séance TP (1h30)</label>
                                    <input class="form-control spinner-both"  id="spinner-tp90" name="heureTP90" value="{{$matiere->TP_90}}">
                                    <label>Séance TP (2h00)</label>
                                    <input class="form-control spinner-both"  id="spinner-tp120" name="heureTP120" value="{{$matiere->TP_120}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-1"
                     data-widget-editbutton="false"
                     data-widget-colorbutton="false"
                     data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false"
                     data-widget-collapsed="false"
                     data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                        <h2 class="font-md"><strong>Professeurs</strong></h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            <!-- ICI CODE DES UE-->
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Enseignant</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($matiere->lesEnseignants as $e)
                                        <tr>
                                            <td>{{$e->lastname}} {{$e->firstname}}</td>
                                            <td><a class="btn btn-xs btn-danger" href="{{ route('matiere.supprimerEnseignant', array($idFormation, $matiere->ID, $e->login)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label>Ajouter des enseignants :</label>
                                    <select multiple style="width:100%" name="lesEnseignants[]" class="select2">
                                        @foreach($lesEnseignants as $enseignant)
                                            <option value="{{$enseignant->LOGIN}}">{{$enseignant->LASTNAME}} {{$enseignant->FIRSTNAME}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Valider" />
                </div>
            </div>

            {{Form::close()}}
        </div>
    </section>
</div>
@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<style type="text/css">
    .dd-handle-title {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 40%;
        display: block;
        float:left;
    }
    .dd-handle {
        height: 40px;
    }
</style>


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!


    function computeCM() {
        var nbCm = parseInt($("#spinner-cm60").val())
                + parseInt($("#spinner-cm90").val())
                + parseInt($("#spinner-cm120").val());
        $("#CMeff").html(""+nbCm);
    }

    function computeTD() {
        var nbTd = parseInt($("#spinner-td60").val())
                + parseInt($("#spinner-td90").val())
                + parseInt($("#spinner-td120").val());
        $("#TDeff").html(""+nbTd);
    }

    function computeTP() {
        var nbTp = parseInt($("#spinner-tp60").val())
                + parseInt($("#spinner-tp90").val())
                + parseInt($("#spinner-tp120").val());
        $("#TPeff").html(""+nbTp);
    }
    $(document).ready(function () {
        //pageSetUp();


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

<style>

</style>
