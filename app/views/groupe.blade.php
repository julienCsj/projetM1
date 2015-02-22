@include('layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Groupes <small>Cette page permet de gérer les groupes des différentes formations</small></h1>
        <br/>
    </div>
    @foreach ($lesGroupesParFormation as $formation)
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="formation-1" data-widget-collapsed="true" data-widget-colorbutton="false" data-widget-sortable="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
                <header>
                    <h2 class="font-md"><strong>{{$formation->short_title}}</strong> <i>{{$formation->long_title}}</i></h2>
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
                        <div class="tree smart-form">
                            <ul>
                                <li>
                                    <span><i class="fa fa-lg fa-folder-open"></i> Groupes</span>
                                    <ul>
                                        @foreach ($formation->lesGroupes as $groupe)
                                        <li>
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Groupe {{$groupe->nom}}</span> &ndash; <a href="{{ route('groupe.supprimerGroupe', array($groupe->id)); }}">Supprimer</a> &ndash; <a data-toggle="modal" data-target="#modifierGroupe-{{$groupe->id}}" href="javascript(void);">Modifier</a>
                                            @if ($groupe->sous_groupe > 1)
                                            <ul>
                                                <li style="display:none">
                                                    <span>Groupe {{$groupe->nom}} A</span>
                                                </li>
                                                <li style="display:none">
                                                    <span>Groupe {{$groupe->nom}} B</span>
                                                </li>
                                                @if ($groupe->sous_groupe == 3)
                                                <li style="display:none">
                                                    <span>Groupe {{$groupe->nom}} C</span>
                                                </li>
                                                @endif
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                        <li>
                                            <span><a href="#" data-toggle="modal" data-target="#ajouterGroupe-{{$formation->id}}">Ajouter</a></span>
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
    </div>
    @endforeach
</section>

@foreach($lesGroupesParFormation as $formation)
<div class="modal fade" id="ajouterGroupe-{{$formation->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un groupe à {{$formation->short_title}}</h4>
            </div>
            {{ Form::open(array('route' => 'groupe.ajouterGroupe')) }}
            <input type="hidden" name="id" value="{{$formation->id}}" />
            <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="nom" class="form-control" placeholder="Nom du groupe" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" required>
                            <select name="sous_groupe" class="form-control" required/>
                                <option value="" selected disabled>Nombre de sous-groupes</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-primary" value="Ajouter" />
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endforeach

@foreach($lesGroupesParFormation as $formation)
    @foreach($formation->lesGroupes as $groupe)
    <div class="modal fade" id="modifierGroupe-{{$groupe->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modifier le groupe {{$groupe->nom}}</h4>
                </div>
                {{ Form::open(array('route' => 'groupe.modifierGroupe')) }}
                <input type="hidden" name="id" value="{{$groupe->id}}" />
                <div class="modal-body">
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="nom" value="{{$groupe->nom}}" class="form-control" placeholder="Nom du groupe" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" required>
                                <select name="sous_groupe" class="form-control" required/>
                                    <option value="" disabled>Nombre de sous-groupes</option>
                                    @if($groupe->sous_groupe == 1)
                                        <option value="1" selected>1</option>
                                    @else
                                        <option value="1">1</option>
                                    @endif
                                    @if($groupe->sous_groupe == 2)
                                        <option value="2" selected>2</option>
                                    @else
                                        <option value="2">2</option>
                                    @endif
                                    @if($groupe->sous_groupe == 3)
                                        <option value="3" selected>3</option>
                                    @else
                                        <option value="3">3</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-primary" value="Confirmer" />
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @endforeach
@endforeach

@include('layout.footer')

<script type="text/javascript">     
// DO NOT REMOVE : GLOBAL FUNCTIONS!
$(document).ready(function() {
    
    pageSetUp();
    
    // PAGE RELATED SCRIPTS

    $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
    $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(':visible')) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
        }
        e.stopPropagation();
    });
})
</script>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>