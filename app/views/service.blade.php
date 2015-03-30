@include('layout.header')
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
                <div class="well well-sm" id="event-container">

			    		<span class="text">
			    			Service minimal
			    			<span class="pull-right">
			    				130/200 heures
			    			</span>
			    		</span>
                    <div class="progress">
                        <div class="progress-bar bg-color-greenLight" style="width: 65%;"></div>
                    </div>
			    		<span class="text">
			    			Service maximal
			    			<span class="pull-right">
			    				130/400 heures
			    			</span>
			    		</span>
                    <div class="progress">
                        <div class="progress-bar bg-color-blue" style="width: 32%;"></div>
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
                            <ul>
                            @foreach($service as $s)
                                <label>Semaine #{{$s['numSemaine']}} - {{$s['label']}}</label>
                                <ul>
                                    <li>CM : {{$s['cm']}}</li>
                                    <li>TD : {{$s['td']}}</li>
                                    <li>TP : {{$s['tp']}}</li>
                                    <li>Total : {{intval($s['cm'] + $s['td'] + $s['tp'])}}</li>
                                </ul>
                            @endforeach
                            </ul>
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