@include('layout.header')
<section id="widget-grid" class="">
        <?php
			$user = Session::get('user');
            $nom = $user->LASTNAME;
            $prenom = $user->FIRSTNAME;
        ?>
                    
        <!-- NEW WIDGET START -->
        <div class="">
            <div role="content">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">
                    
                    <h2>Bonjour, @if(!empty($nom) && !empty($prenom)) {{ucfirst($prenom)}} {{ucfirst($nom)}} @endif</h2>
                    <br>
                    <br>
                    <p>
                        Bienvenue sur Scolarel. Cette application a été développé dans le cadre des projets tutorés du
                        Master 1 Développement Logiciel de l'Université Paul Sabatier.<br />
                        Cette application vous offre la possibilité de planifier un ensemble de cours avant l'élaboration de
                        l'emploi du temps afin de s'assurer que la charge de travail des enseignants et des étudiants ne dépasse
                        pas un certain seuil.<br />
                        Cette application permet également d'aider la génération des fiches.

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    </p>
                    <!-- end widget content -->

                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="well well-sm bg-color-darken txt-color-white text-center">
                <h5>Documentation utilisateur</h5>
                <button class="btn btn-default">Voir</button>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="well well-sm bg-color-teal txt-color-white text-center">
                <h5>Documentation technique</h5>
                <button class="btn btn-default">Voir</button>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="well well-sm bg-color-pinkDark txt-color-white text-center">
                <h5>Documentation du framework</h5>
                <button class="btn btn-default">Voir</button>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
</script>