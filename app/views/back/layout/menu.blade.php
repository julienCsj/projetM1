<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

<!-- User info -->
<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it -->

					<a id="show-shortcut" data-action="toggleShortcut">
                        <img src="{{ asset('back/img/avatars/sunny.png') }}" alt="me" class="online" />
						<span>
                             <?php
                            // $nom = Session::get('utilisateur')->nom;
                            // $prenom = Session::get('utilisateur')->prenom;
                            ?>
							{{--@if(!empty($nom) && !empty($prenom)) {{$nom}} {{$prenom}} @else {{Session::get('utilisateur')->email}} @endif --}}
						</span>
                    </a>

				</span>
</div>
<!-- end user info -->

<!-- NAVIGATION : This navigation is also responsive

To make this navigation dynamic please make sure to link the node
(the reference to the nav > ul) after page load. Or the navigation
will not initialize.
-->
<nav>
<!-- NOTE: Notice the gaps after each icon usage <i></i>..
Please note that these links work a bit different than
traditional href="" links. See documentation for details.
-->

<ul>
    @if(isset($premiere_connexion) && $premiere_connexion == true)
    <li><a class="disabled"> <span class="menu-item-parent">Pour activer le menu, merci de remplir le formulaire de première connexion.</span></a></li>
    @else
    <li>
        <a href="{{URL::route('dashboard')}}" class="" title="Dashboard"><i class="fa fa-lg fa-fw fa-dashboard "></i> <span class="menu-item-parent">Tableau de bord</span></a>
    </li>
    <li>
        <a href="{{URL::route('trajet_liste')}}" class=""><i class="fa fa-lg fa-fw fa-road"></i> <span class="menu-item-parent">Mes trajets</span><span class="badge pull-right inbox-badge">2</span></a>
    </li>
    <li>
        <a href="{{URL::route('trajet_ajouter')}}" class=""><i class="fa fa-lg fa-fw fa-automobile "></i> <span class="menu-item-parent">Ajouter un trajet</span></a>
    </li>
    <li>
        <a href="{{URL::route('exporter')}}" title="Exporter"><i class="fa fa-lg fa-fw fa-cloud-download"></i> <span class="menu-item-parent">Exporter</span></a>
    </li>
    <li>
        <a href="{{URL::route('journal')}}" title="Journal"><i class="fa fa-lg fa-fw fa-cogs  "></i> <span class="menu-item-parent">Gérer mon journal</span></a>
    </li>
    <li>
        <a href="{{URL::route('adresse')}}" title="Adresses"><i class="fa fa-lg fa-fw fa-location-arrow "></i> <span class="menu-item-parent">Gérer mes adresses</span></a>
    </li>
    <li>
        <a href="{{URL::route('timeline')}}" title="Timeline"><i class="fa fa-lg fa-fw fa-send-o"></i> <span class="menu-item-parent">Ma Timeline</span></a>
    </li>
    <li>
        <a href="{{URL::route('contact')}}" title="Contact"><i class="fa fa-lg fa-fw fa-envelope"></i> <span class="menu-item-parent">Contact</span></a>
    </li>
    <li>
        <a href="{{URL::route('profil')}}" title="Profil"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Profil</span></a>
    </li>
    <li>
        <a href="{{URL::route('deconnexion')}}" title="Déconnexion"><i class="fa fa-lg fa-fw fa-external-link-square"></i> <span class="menu-item-parent">Déconnexion</span></a>
    </li>
    @endif
</ul>
</nav>
			<span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>
<!-- END NAVIGATION -->
