
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Gestion des modules <small>@if(isset($module)){{$formation->long_title}} > {{$ue->long_title}} > {{$module->LONG_TITLE}}@endif</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("uemodule")}}
        </div>
        {{ Form::open(array('route' => 'module.postModifierModule')) }}
        <input type="hidden" name="idModule" value="{{$idModule}}" />
        <input type="hidden" name="idFormation" value="{{$idFormation}}">
        <input type="hidden" name="idUe" value="{{$idUe}}">

        <div class="row">
            @if($idModule != -1)
            <div class="row pull-right padding-10 margin-right-5">
                <a href="{{ route('affectation.affectationFormation', array($formation->id, $ue->id, $module->ID))}}" class="btn btn-primary">Aller à l'affectation</a>
                <a href="{{ route('planification.planificationFormation', array($formation->id))}}" class="btn btn-primary">Aller à la planification</a>
            </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <ul id="menu" style="width: 100%">
                    @foreach ($lesFormations as $formation_liste)
                    <li>
                        <a href="javascript:void(0);">{{$formation_liste->short_title}}</a>
                        <ul>
                            @foreach($formation_liste->lesUE as $ue)
                                <li>
                                    <a href="javascript:void(0);">{{$ue->short_title}}</a>
                                    <ul>
                                        @foreach($ue->lesModules as $mod)
                                            <li>
                                                <a href="{{ route('moduleModification', array($formation_liste->id, $ue->id, $mod->ID))}}">{{$mod->SHORT_TITLE}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                @if($idModule != -1)
                    <div id="tabs">
                        <ul>
                            <li>
                                <a href="#tabs-a">Volume horaire</a>
                            </li>
                            <li>
                                <a href="#tabs-b">Effectifs</a>
                            </li>
                            <li>
                                <a href="#tabs-c">Financements</a>
                            </li>
                            <li>
                                <a href="#tabs-d">Enseignants</a>
                            </li>
                        </ul>
                        <div id="tabs-a">
                            <div class="row padding-10">
                                <p class="alert alert-info">Valeur du PPN : CM : {{$module->CM_PPN}}h -  TD : {{$module->TD_PPN}}h -  TP : {{$module->TP_PPN}}h</p>

                                <div class="col-centered" style="height: 120px;">
                                    <div class="col-xs-3 col-sm-2">
                                    </div>
                                    <div class="col-xs-2 col-sm-2 ">
                                        <time datetime="" class="icon" style="width: 100%">
                                            <strong>CM</strong>
                                            <span>{{$totalCM}}</span>
                                        </time>
                                    </div>
                                    <div class="col-xs-2 col-sm-2">
                                        <time datetime="" class="icon" style="width: 100%;">
                                            <strong>TD</strong>
                                            <span>{{$totalTD}}</span>
                                        </time>
                                    </div>
                                    <div class="col-xs-2 col-sm-2">
                                        <time datetime="" class="icon" style="width: 100%">
                                            <strong>TP</strong>
                                            <span>{{$totalTP}}</span>
                                        </time>
                                    </div>
                                    <div class="col-xs-2 col-sm-2">
                                        <time datetime="" class="icon" style="width: 100%">
                                            <strong>HETD</strong>
                                            <span>{{$totalCM*1.5 + $totalTD*$formation->nbgroupestd + $totalTP*$formation->nbgroupestp}}</span>
                                        </time>
                                    </div>
                                    <div class="col-xs-3 col-sm-2">
                                    </div>
                                </div>
                                <table class="table table-bordered padding-top-10">
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Durée</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lesCours as $c)
                                        <tr>
                                            <td>{{strtoupper($c->type)}}</td>
                                            <td>{{$c->duree}} minutes</td>
                                            <td><a class="btn btn-xs btn-danger" href="{{ route('module.supprimerCours', array($idFormation, $idUe, $idModule, $c->id)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    Ajouter
                                    <select name="nb">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                    </select>
                                    <select name="type">
                                        <option value="cm">CM</option>
                                        <option value="td">TD</option>
                                        <option value="tp">TP</option>
                                    </select>
                                    de
                                    <select name="duree">
                                        <option value="60">01h00</option>
                                        <option value="90" selected>01h30</option>
                                        <option value="120">02h00</option>
                                        <option value="180">03h00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="tabs-b">
                            <div class="row padding-10">
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>Groupe CM (1)</label>
                                    <input class="form-control spinner-both" type="number" name="groupeCM" value="{{$module->GROUPE_CM}}">
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>Groupe TD ({{$formation->nbgroupestd}} groupe(s) définis)</label>
                                    <input class="form-control spinner-both"  type="number" name="groupeTD" value="{{$module->GROUPE_TD}}">
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <label>Groupe TP ({{$formation->nbgroupestp}} groupe(s) définis)</label>
                                    <input class="form-control spinner-both"  type="number" name="groupeTP" value="{{$module->GROUPE_TP}}">
                                </div>
                            </div>
                        </div>
                        <div id="tabs-c">
                            <div class="row padding-10">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Libelle</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($module->lesFinancements as $f)
                                        <tr>
                                            <td>{{$f->libelle}}</td>
                                            <td><a class="btn btn-xs btn-danger" href="{{ route('module.supprimerFinancement', array($idFormation, $idUe, $idModule, $f->id)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
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
                        <div id="tabs-d">
                            <div class="row padding-10">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Enseignant</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($module->lesEnseignants as $e)
                                        <tr>
                                            <td>{{ucfirst($e->firstname)}} {{ucfirst($e->lastname)}}</td>
                                            <td><a class="btn btn-xs btn-danger" href="{{ route('module.supprimerEnseignant', array($idFormation, $idUe, $idModule, $e->login)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label>Ajouter des enseignants :</label>
                                    <select multiple style="width:100%" name="lesEnseignants[]" class="select2">
                                        @foreach($lesEnseignants as $enseignant)
                                            <option value="{{$enseignant->LOGIN}}">{{ucfirst($enseignant->FIRSTNAME)}} {{ucfirst($enseignant->LASTNAME)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <br />
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Valider" />
                </div>
                @else
                    <p class="text-center well">Veuillez selectionner un module...</p>
                @endif
            </div>
        </div>
        {{Form::close()}}
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