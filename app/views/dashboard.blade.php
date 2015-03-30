@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <?php
			$user = Session::get('user');
            $nom = $user->LASTNAME;
            $prenom = $user->FIRSTNAME;
        ?>
                    
        <!-- NEW WIDGET START -->
        <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="jumbotron" style="padding-bottom: 200px;">
                    <h1>Bonjour, @if(!empty($nom) && !empty($prenom)) {{ucfirst($prenom)}} {{ucfirst($nom)}} @endif</h1>
                    <p>
                        Bienvenue sur Scolarel. Cette application a été développé dans le cadre des projets tutorés du
                        Master 1 Développement Logiciel de l'Université Paul Sabatier.<br />
                        Cette application vous offre la possibilité de planifier un ensemble de cours avant l'élaboration de
                        l'emploi du temps afin de s'assurer que la charge de travail des enseignants et des étudiants ne dépasse
                        pas un certain seuil.<br />
                        Cette application permet également d'aider la génération des fiches.

                    </p>
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