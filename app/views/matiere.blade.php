@include('layout.header')
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <!-- NEW WIDGET START -->
            <h1>Formation / UE / Matières <small>Cette page permet de gérer le volume de CM/TD/TP</small></h1>
            <br/>
            <br/>

            @foreach ($lesFormations as $formation)
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-1" 
                     data-widget-editbutton="false" 
                     data-widget-colorbutton="false" 
                     data-widget-deletebutton="false" 
                     data-widget-fullscreenbutton="false" 
                     data-widget-collapsed="true"
                     data-widget-sortable="false">


                 

                    <header>
                        <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                        <h2 class="font-md"><strong>{{$formation->short_title}}</strong> <i>{{$formation->long_title}}</i></h2>
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
                                <div id="nestable">
                                    @foreach($formation->lesUE as $ue)
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                {{$ue->long_title}}
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2">
                                            <ol class="dd-list">
                                                @foreach($ue->lesModules as $module)
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle">
                                                        <span class="dd-handle-title" title="{{$module->long_title}}">
                                                            {{$module->long_title}}
                                                        </span>
                                                        <div class="pull-right">
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Financement</h6>
                                                                    <ul>
                                                                    <li>Source #1 - 12000$</li>
                                                                    <li>Source #2 - 12000$</li>
                                                                    </ul>" 
                                                                    data-html="true">Financement
                                                            </button>
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Effectifs</h6>
                                                                    <ul>
                                                                    <li>Groupe CM - 1</li>
                                                                    <li>Groupe TD - 5</li>
                                                                    <li>Groupe TP - 10</li>
                                                                    </ul>" 
                                                                    data-html="true">Volume horaire
                                                            </button>
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Volume horaire</h6>
                                                                    <ul>
                                                                    <li>CM - 12h</li>
                                                                    <li>TD - 12h</li>
                                                                    <li>TP - 06h</li>
                                                                    </ul>" 
                                                                    data-html="true">Volume horaire
                                                            </button>
                                                            <button class="btn btn-primary btn-xs">Modifier</button>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    </ol>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
            @endforeach
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

    $(document).ready(function () {
        pageSetUp();
    });
</script>

<style>
   
</style>
