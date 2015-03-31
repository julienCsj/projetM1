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
                    </p>
                    <h3>Retour de bugs</h3>
                    <p>Nous avons mis en place un Trello pour vous permettre de nous remonter des bugs ou problèmes.
                    <br>
                    <div style=" text-align:center">
                        <a href="https://trello.com/b/7AM3JLAk/scolarel-bug-tracker" target="_blank" class="btn btn-primary ui-btn-lg" style="align:center;width:100%;">Le Trello</a>
                        <br><br>
                    </div>
                    Pour nous faire parvenir un bug, il suffit d'ajouter une carte dans la colonne "Signaler un bug" en cliquant sur "Add a card".<br>
                    Vous avez ensuite la possibilité de donner un titre a votre carte. Appuyer sur entrer pour valider.
                    Une fois la carte ajoutée, vous pouvez ajouter une description, une image, un fichier, etc... en cliquant
                    sur la carte.<br><br>
                    <img src="trello.png" style="width: 100%;" />

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
                <button class="btn btn-default disabled">Voir</button>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="well well-sm bg-color-teal txt-color-white text-center">
                <h5>Documentation technique</h5>
                <button class="btn btn-default disabled">Voir</button>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="well well-sm bg-color-pinkDark txt-color-white text-center">
                <h5>Documentation du framework</h5>
                <a class="btn btn-default" href="http://laravel.com/docs/4.2">Voir</a>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
</script>