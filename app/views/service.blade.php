@include('layout.header')
<?php
$arrayMonthTotext = array(
    "1" => "jan",
    "2" => "fév",
    "3" => "mars",
    "4" => "avr",
    "5" => "mai",
    "6" => "juin",
    "7" => "juil",
    "8" => "août",
    "9" => "sept",
    "10" => "oct",
    "11" => "nov",
    "12" => "déc"
);
?>
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Service</h1>
        <br/>
    </div>
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" role="widget">
                <header>
                    <h2> Paliers </h2>
                </header>
                <?php
                    $hGlobal = $service_global["cm"]*$VALEUR_CM_HSERVICE + $service_global["td"]*$VALEUR_TD_HSERVICE + $service_global["tp"];
                    $nbHeures = 200;
                    $pourcentServiceMinimal = $hGlobal / $nbHeures;
                    if ($pourcentServiceMinimal > 1) {
                        $pourcentServiceMinimal = 1;
                    }
                    $nbHeuresMaxi = $nbHeures * 2;
                    $pourcentServiceMaxi = $hGlobal / $nbHeuresMaxi;
                ?>
                <div class="well well-sm" id="event-container">
			    		<span class="text">
			    			Service minimal
			    			<span class="pull-right">
			    				{{$hGlobal}}/{{$nbHeures}} heures
			    			</span>
			    		</span>
                    <div class="progress">
                        <div class="progress-bar bg-color-greenLight" style="width: {{$pourcentServiceMinimal*100}}%;"></div>
                    </div>
			    		<span class="text">
			    			Service maximal
			    			<span class="pull-right">
			    				{{$hGlobal}}/{{$nbHeuresMaxi}} heures
			    			</span>
			    		</span>
                    <div class="progress">
                        <div class="progress-bar bg-color-blue" style="width: {{$pourcentServiceMaxi*100}}%;"></div>
                    </div>

                </div>
            </div>
        </article>
    </div>

    <div class="row">
        <?php $i = 0; ?>

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false"
                     data-widget-colorbutton="false"
                     data-widget-editbutton="false"
                     data-widget-togglebutton="false"
                     data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false"
                     data-widget-custombutton="false"
                     data-widget-collapsed="false"
                     data-widget-sortable="false"
                        >
                    <header>
                        <h2>Répartition de la charge par semaine</h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Mois</th>
                                            <th><i class="fa fa-calendar"></i> N° Semaine</th>
                                            <th>Charge de travail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $printMonth = true;
                                            $precedentMonth = -1;
                                        ?>
                                        @foreach($service as $s)
                                            <tr class="@if(intval($s['cm'] + $s['td'] + $s['tp']) == 0)
                                                    info
                                                    @else
                                                    success
                                                    @endif
                                            ">
                                                <td>
                                                    <?php
                                                        $d = new DateTime();
                                                        $d->setISODate($s['annee'],$s['numSemaine'],1);    
                                                        $mois = date("n", $d->getTimestamp());
                                                        if ($mois != $precedentMonth) {
                                                            $printMonth = true;
                                                        }
                                                        $precedentMonth = $mois;
                                                    ?>
                                                    @if($printMonth)
                                                        {{$arrayMonthTotext[$mois]}}
                                                        <?php $printMonth = false; ?>
                                                    @endif
                                                </td>
                                                <td>Semaine #{{$s['numSemaine']}} - {{$s['label']}}</td>
                                                <td>
                                                    @if(intval($s['cm'] + $s['td'] + $s['tp']) != 0)
                                                    CM : {{$s['cm']}}m<br>
                                                    TD : {{$s['td']}}m<br>
                                                    TP : {{$s['tp']}}m<br>
                                                    Total service : {{intval($s['cm']*$VALEUR_CM_HSERVICE + $s['td']*$VALEUR_TD_HSERVICE + $s['tp'])}}m<br/>
                                                    Total heures placées : {{intval($s['cm'] + $s['td'] + $s['tp'])}}m<br>
                                                    @else
                                                    Pas de cours assigné
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
                    <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>