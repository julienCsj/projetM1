@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Heures externes <small>Cette page permet a un enseignant de mettre a jour son service exterieur à l'IUT.</small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->
        <div class="row">
            <?php $i = 0; ?>
            @foreach($lesSemaines as $sem)
            <!-- NEW WIDGET START -->
            <article class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

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
                        <h2>Mois de {{$sem[0]['mois']}}</h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <div class="widget-body">
                        @foreach($sem as $s)
                            <label>Semaine #{{$s['numero_semaine']}} ({{$s['jour']}}  {{$s['mois']}})</label>
                            <input class="form-control spinner-both"  id="spinner-cm60" name="heureCM60" value="">
                        @endforeach
                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
                <?php
                    $i++;
                    if($i == 4 || $i == 8 || $i == 12) {
                        echo "</div><div class=\"row\">";
                    }
                    ?>
            @endforeach
            <!-- WIDGET END -->
        </div>
</section>


@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

