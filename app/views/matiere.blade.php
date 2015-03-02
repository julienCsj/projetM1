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
                                                        <span class="dd-handle-title" title="{{$module->LONG_TITLE}}">
                                                            {{$module->LONG_TITLE}}
                                                        </span>
                                                        <div class="pull-right">
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Financement</h6>
                                                                    <ul>
                                                                    @foreach($module->lesFinancements as $f)
                                                                    <li>{{$f->libelle}}</li>
                                                                    @endforeach
                                                                    </ul>" 
                                                                    data-html="true">Financement
                                                            </button>
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Effectifs</h6>
                                                                    <ul>
                                                                    <li>Groupe CM - {{$module->GROUPE_CM}}</li>
                                                                    <li>Groupe TD - {{$module->GROUPE_CM}}</li>
                                                                    <li>Groupe TP - {{$module->GROUPE_TP}}</li>
                                                                    </ul>" 
                                                                    data-html="true">Effectifs
                                                            </button>
                                                            <button class="btn btn-success btn-xs" 
                                                                    rel="tooltip" data-placement="bottom" 
                                                                    data-original-title="<h6>Volume horaire</h6>
                                                                    <ul>
                                                                    <li>CM 1h00 - {{$module->CM_60}}</li>
                                                                    <li>CM 1h30 - {{$module->CM_90}}</li>
                                                                    <li>CM 2h00 - {{$module->CM_120}}</li>
                                                                    <li>TD 1h00 - {{$module->TD_60}}</li>
                                                                    <li>TD 1h30 - {{$module->TD_90}}</li>
                                                                    <li>TD 2h00 - {{$module->TD_120}}</li>
                                                                    <li>TP 1h00 - {{$module->TP_60}}</li>
                                                                    <li>TP 1h30 - {{$module->TP_90}}</li>
                                                                    <li>TP 2h00 - {{$module->TP_120}}</li>
                                                                    </ul>" 
                                                                    data-html="true">Volume horaire
                                                            </button>
                                                            <button class="btn btn-success btn-xs"
                                                                    rel="tooltip" data-placement="bottom"
                                                                    data-original-title="<h6>Volume horaire</h6>
                                                                    <ul>
                                                                     @foreach($module->lesEnseignants as $e)
                                                                    <li>{{$e->firstname}} {{$e->lastname}}</li>
                                                                    @endforeach
                                                                    </ul>"
                                                                    data-html="true">Enseignants
                                                            </button>
                                                            <a class="btn btn-primary btn-xs" href="{{ route('matiere.modifier', array($formation->id, $module->ID)); }}">Modifier</a>
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
