@include('layout.header')
<div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <!-- NEW WIDGET START -->
            <h1>Formation / UE / Matières <small>Cette page permet de gérer le volume de CM/TD/TP</small></h1>
            <br/>
            <br/>
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
                        <h2 class="font-md"><strong>D.U.T</strong> <i>Première année</i></h2>
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
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                UE  1<span>- Nom de l'UE #1</span>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2">
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle">
                                                        Matiere #1.1
                                                      
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                    </div>
                                                </li>
                                                <li class="dd-item" data-id="3">
                                                    <div class="dd-handle">
                                                        Matiere #1.2
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="4">
                                                    <div class="dd-handle">
                                                        Matiere #1.3
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="5">
                                                    <div class="dd-handle">
                                                        Matiere #1.4
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="6">
                                                    <div class="dd-handle">
                                                        Matiere #1.5
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                UE  1<span>- Nom de l'UE #2</span>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="7">
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="8">
                                                    <div class="dd-handle">
                                                        Matiere #2.1
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="9">
                                                    <div class="dd-handle">
                                                        Matiere #2.2
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="10">
                                                    <div class="dd-handle">
                                                        Matiere #2.3
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="11">
                                                    <div class="dd-handle">
                                                        Matiere #2.4
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                                <li class="dd-item" data-id="12">
                                                    <div class="dd-handle">
                                                        Matiere #2.5
                                                        <div class="pull-right"><span>&nbsp;TP : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;TD : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div>
                                                        <div class="pull-right"><span>&nbsp;CM : </span><input  class="form-control spinner-left" id="spinner" name="spinner" value="1" type="text"></div></div>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="formation-2" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"

             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>D.U.T</strong> <i>Deuxième année</i></h2>
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
                    <p>DUT DEUXIEME ANNEE</p>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-greenLight" id="formation-3" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"
             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>D.U.T</strong> <i>Année spéciale</i></h2>
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
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blue" id="formation-4" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"
             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>D.U.T</strong> <i>Cours du soir</i></h2>
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
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-purple" id="formation-5" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"
             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>D.U.T</strong> <i>Cours à distance</i></h2>
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
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-red" id="formation-6" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"
             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Licence professionelle</strong> <i>Licence #1</i></h2>
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
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-red" id="formation-7" 
             data-widget-editbutton="false" 
             data-widget-colorbutton="false" 
             data-widget-deletebutton="false" 
             data-widget-fullscreenbutton="false" 
             data-widget-collapsed="true"
             data-widget-sortable="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>

                <!-- widget div-->
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body">
                        <!-- ICI CODE DES UE-->
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
        </div>
        <!-- end widget -->
        </article>
</div>
</section>
</div>
@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->




<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {
        pageSetUp();

        $(".spinner-left").spinner();
    });
</script>

<style>
    .ui-spinner {
        line-height: 15px;
        width: 50px;
    }
    .ui-spinner-button {
        width: 15px;
    }
    .ui-spinner-input.spinner-left {
        height: 24px;
        padding-left: 18px;
        padding-right: 0px;
    }
    
    .dd-handle {
        line-height: 30px;
    }
</style>
