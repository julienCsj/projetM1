
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Gestion des modules <small>@if(isset($module)){{$formation->long_title}} > {{$ue->long_title}} > {{$module->LONG_TITLE}}@endif</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong>
        </div>
        <div class="row">
            @if(!isset($lesFormations))
                <div class="row pull-right padding-10 margin-right-5">
                    <a href="{{ route('affectation.affectationFormation', array($formation->id, $ue->id, $module->ID))}}" class="btn btn-primary">Aller à l'affectation</a>
                    <a href="{{ route('planification.planificationFormation', array($formation->id))}}" class="btn btn-primary">Aller à la planification</a>
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <ul id="menu" style="width: 100%">
                    @foreach ($lesFormations as $formation_liste)
                        <li>
                            <a href="{{ route('emploiDuTempsFormation', array($formation_liste->id)) }}">{{$formation_liste->short_title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                @if($idFormation != -1)
                    <div id="tabs">
                        <ul>
                            @foreach($service as $s)
                            <li>
                                <a href="#tabs-{{$s['numSemaine']}}">{{$s['numSemaine']}}</a>
                            </li>
                            @endforeach
                        </ul>
                        @foreach($service as $s)
                        <div id="tabs-{{$s['numSemaine']}}">
                            <div class="row padding-10">
                                <h6 class="text-center">{{$s['label']}}</h6>
                                <ul>
                                    <?php
                                    if(count($s) <= 6) {
                                        echo "<p class=\"text-center\">Aucun cours a placer cette semaine</p>";
                                    } else {
                                        for($i=0; $i<count($s)-6; $i++) {
                                            //exit(var_dump($s[$i][0]));
                                            $intitule = $s[$i][0];
                                            echo "<li>$intitule</li>";
                                            echo "<ul>";
                                            foreach($s[$i][1] as $repartition) {
                                                echo "<li>$repartition</li>";
                                            }
                                            echo "</ul>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br />
                @else
                    <p class="text-center well">Veuillez selectionner une formation...</p>
                @endif
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    $('#tabs').tabs();
    $("#menu").menu();
</script>