@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <?php
			$user = Session::get('user');
            $nom = $user->LASTNAME;
            $prenom = $user->FIRSTNAME;
        ?>
                    
        <h1>Bienvenue <small>@if(!empty($nom) && !empty($prenom)) {{$nom}} {{$prenom}} @endif</small></h1>
        <br/>
        <!-- WIDGET END -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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
                        <h2>Liste des enseignants ayant formulé un voeux </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Voeux </th>
                                        <th>Voir </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>{{ $nom }}</td>
                                        <td>{{ $prenom }}</td>
                                        <td>
                                        	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </td>
                                        <td>
                                        	<a href="#">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>

        <hr>
        <br/>
        <!-- WIDGET END -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="false"
                    data-widget-sortable="false"

                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Liste des enseignants ayant formulé un voeux </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Voeux </th>
                                        <th>Voir </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>{{ $nom }}</td>
                                        <td>{{ $prenom }}</td>
                                        <td>
                                        	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </td>
                                        <td>
                                        	<a href="#">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>

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