
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
        <h1>Aide Génération fiche <small></small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("generationFiche")}}
        </div>
        <!-- NEW WIDGET START -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#tabs-a">Charge par Formation</a>
                        </li>
                        <li>
                            <a href="#tabs-b">Charge par Module</a>
                        </li>
                    </ul>

                    <div id="tabs-a">
                        <div class="row padding-10">
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                <tr>
                                    <th>Formation</th>
                                    <th>CM</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                    <th>TOTAL</th>
                                </tr>
                                <?php
                                    $total = array();
                                    $total['cm'] = 0;
                                    $total['td'] = 0;
                                    $total['tp'] = 0;
                                ?>
                                @foreach($lesFormations as $f)
                                    <?php
                                        $service = CalculerChargeService::calculerServiceFormationGlobal($f->id);
                                        $total['cm'] += intval($service['cm']);
                                        $total['td'] += intval($service['td']);
                                        $total['tp'] += intval($service['tp']);
                                    ?>
                                <tr>
                                    <td>{{$f->long_title}}</td>
                                    <td>{{$service['cm'] / 60}}</td>
                                    <td>{{$service['td'] / 60}}</td>
                                    <td>{{$service['tp'] / 60}}</td>
                                    <td><strong>{{intval(($service['cm'] + $service['td'] + $service['tp'])/60)}}</strong></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td><strong>TOTAL IUT</strong></td>
                                    <td><strong>{{$total['cm'] / 60}}</strong></td>
                                    <td><strong>{{$total['td'] / 60}}</strong></td>
                                    <td><strong>{{$total['tp'] / 60}}</strong></td>
                                    <td><strong>{{intval(($total['cm'] + $total['td'] + $total['tp'])/60)}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="tabs-b">
                        <div class="row padding-10">
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                @foreach($lesFormations as $f)
                                    <tr>
                                        <th colspan="5" class="text-align-center">{{$f->long_title}}</th>
                                    </tr>
                                    @foreach($f->lesUE as $ue)
                                        @foreach($ue->lesModules as $mod)
                                            <?php
                                            $service = CalculerChargeService::calculerServiceModuleGlobal($mod->ID);
                                            ?>
                                            <tr>
                                                <td>{{$mod->LONG_TITLE}}</td>
                                                <td>{{$service['cm'] / 60}}</td>
                                                <td>{{$service['td'] / 60}}</td>
                                                <td>{{$service['tp'] / 60}}</td>
                                                <td><strong>{{intval(($service['cm'] + $service['td'] + $service['tp'])/60)}}</strong></td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {
        pageSetUp();
        $('#tabs').tabs();
    });





</script>