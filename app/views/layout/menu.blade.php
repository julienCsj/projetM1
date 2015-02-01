<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

            <a id="show-shortcut" data-action="toggleShortcut">
                <span>
                    <?php
                        $nom = "Dupond";
                        $prenom = "Jacques";
                    ?>
                    @if(!empty($nom) && !empty($prenom)) {{$nom}} {{$prenom}} @else {{Session::get('utilisateur')->email}} @endif
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
            <li class="{{ URL::route('financement') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('financement')}}" class="" title="FInancement"><i class="fa fa-lg fa-fw fa-dashboard "></i> <span class="menu-item-parent">Financement</span></a>
            </li>
            <li class="{{ URL::route('groupe') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('groupe')}}" class="" title="Groupe"><i class="fa fa-lg fa-fw fa-dashboard "></i> <span class="menu-item-parent">Groupes</span></a>
            </li>
            <li class="{{ URL::route('matiere') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('matiere')}}" class=""><i class="fa fa-lg fa-fw fa-road"></i> <span class="menu-item-parent">UEs / Matières</span><span class="badge pull-right inbox-badge">2</span></a>
            </li>
            <li class="{{ URL::route('enseignant') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('enseignant')}}" class=""><i class="fa fa-lg fa-fw fa-users "></i> <span class="menu-item-parent">Enseignants</span></a>
            </li>
            <li class="{{ URL::route('calendrier') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('calendrier')}}" title="Calendrier"><i class="fa fa-lg fa-fw fa-cloud-download"></i> <span class="menu-item-parent">Calendrier</span></a>
            </li>
            <li class="{{ URL::route('affectation') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('affectation')}}" title="Affectation"><i class="fa fa-lg fa-fw fa-cogs  "></i> <span class="menu-item-parent">Affectater et planifier</span></a>
            </li>
            <li class="{{ URL::route('voeux') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('voeux')}}" title="Adresses"><i class="fa fa-lg fa-fw fa-location-arrow "></i> <span class="menu-item-parent">Voeux</span></a>
            </li>
            <li class="{{ URL::route('monservice') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('monservice')}}" title="Timeline"><i class="fa fa-lg fa-fw fa-send-o"></i> <span class="menu-item-parent">Mon service</span></a>
            </li>
            <li class="{{ URL::route('heuresexterieures') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('heuresexterieures')}}" title="Timeline"><i class="fa fa-lg fa-fw fa-send-o"></i> <span class="menu-item-parent">Heures exterieures</span></a>
            </li>
            <li class="{{ URL::route('deconnexion') === URL::current() ? 'active' : '' }}">
                <a href="{{URL::route('deconnexion')}}" title="Déconnexion"><i class="fa fa-lg fa-fw fa-external-link-square"></i> <span class="menu-item-parent">Déconnexion</span></a>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>
<!-- END NAVIGATION -->
