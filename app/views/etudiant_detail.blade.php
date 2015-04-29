
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Detail emploi du temps <small>@if(isset($formation)){{$formation->long_title}}@endif</small></h1>
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
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
            
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!


    $(document).ready(function () {
        //pageSetUp();

        $('#tabs').tabs();

    });



</script>