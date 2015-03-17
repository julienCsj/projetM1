
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Aide Génération fiche <small></small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                
	            <div class="form-group">
	                <label>Rechercher un enseignant</label>
	                <input class="form-control" type="text" name="nom" placeholder="Nom de la période" id="nomPeriode">
	            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#tabs-a">Voeux</a>
                        </li>
                        <li>
                            <a href="#tabs-b">Heures extérieures</a>
                        </li>
                        <li>
                            <a href="#tabs-c">Calendrier</a>
                        </li>
                    </ul>
                    <div id="tabs-a">
                        <div class="row padding-10">
                            Voeux
                        </div>
                    </div>
                    <div id="tabs-b">
                        <div class="row padding-10">
                            Heures extérieures
                        </div>
                    </div>
                    <div id="tabs-c">
                        <div class="row padding-10">
                            Calendrier
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
        $("#menu").menu();

        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
    });



</script>