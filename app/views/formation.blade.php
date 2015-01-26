@include('layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
            <h1>Formation</h1>

            <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-1" data-widget-sortable="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
                    <header>
                        <h2 class="font-md"><strong>1ère année</strong></h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            <h2 class="alert alert-warning"> This widget is opened by default </h2>
                            <code>data-widget-togglebutton</code>
                            <br><br>
                            <p>Notice the header text size slightly larger than other widget headers</p>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>

            <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="formation-2" data-widget-sortable="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
                    <header>
                        <h2 class="font-md"><strong>2ème année</strong></h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            <div class="tree">
                                <ul>
                                    <li>
                                        <span><i class="fa fa-lg fa-calendar"></i>Groupes</span>
                                        <ul>
                                            <li>
                                                <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> Groupes TD</span>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-clock-o"></i> 8.00</span> &ndash; <a href="javascript:void(0);">Groupe 1</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> Groupes TP</span>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-clock-o"></i> 8.00</span> &ndash; <a href="javascript:void(0);">Groupe 1.1</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> Groupes CM</span>
                                                <ul>
                                                    <li>
                                                        <span><i class="fa fa-clock-o"></i> 8.00</span> &ndash; <a href="javascript:void(0);">Groupe 1</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>


            <p> Par Julien : Permettre d'ajouter des groupes de TD / TP pour chaque formation dans cette vue</p>
        <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>