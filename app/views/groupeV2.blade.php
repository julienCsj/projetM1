
@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Gestion des groupes <small>@if(isset($formation)){{$formation->long_title}}@endif</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("groupe")}}
        </div>
        {{ Form::open(array('route' => 'module.postModifierModule')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">

                <ul id="menu" style="width: 100%">
                    @foreach ($lesFormations as $f)
                        <li>
                            <a href="{{route('groupeModification', array($f->id))}}">{{$f->short_title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                @if($idFormation != -1)
                    <div id="tabs">
                        <ul>
                            <li>
                                <a href="#tabs-a">Gestion des groupes</a>
                            </li>
                        </ul>
                        <div id="tabs-a">
                            <div class="row padding-10">
                                <div class="tree smart-form">
                                    <ul>
                                        <li>
                                            <span><i class="fa fa-lg fa-folder-open"></i> Groupes</span>
                                            <ul>
                                                @foreach ($groupes as $g)
                                                    <li>
                                                        <span><i class="fa fa-lg fa-plus-circle"></i> Groupe {{$g->nom}}</span> &ndash; <a href="{{ route('groupe.supprimerGroupe', array($formation->id, $g->id)); }}">Supprimer</a> &ndash; <a data-toggle="modal" data-target="#modifierGroupe-{{$g->id}}" href="javascript(void);">Modifier</a>
                                                        @if ($g->sous_groupe > 1)
                                                            <ul>
                                                                <li style="display:none">
                                                                    <span>Groupe {{$g->nom}} A</span>
                                                                </li>
                                                                <li style="display:none">
                                                                    <span>Groupe {{$g->nom}} B</span>
                                                                </li>
                                                                @if ($g->sous_groupe == 3)
                                                                    <li style="display:none">
                                                                        <span>Groupe {{$g->nom}} C</span>
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
                        </div>
                    </div>
                    <br />
                @else
                    <p class="text-center well">Veuillez selectionner une formation...</p>
                @endif
            </div>
        </div>
        {{Form::close()}}
    </div>
</section>

@include('layout.footer')

@if($idFormation != -1)
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
            <input type="hidden" name="idFormation" value="{{$formation->id}}" />
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
                            <option value="2" selected>2</option>
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

@foreach($groupes as $groupe)
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
                <input type="hidden" name="idGroupe" value="{{$groupe->id}}" />
                <input type="hidden" name="idFormation" value="{{$idFormation}}">
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
@endif
<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    $(document).ready(function () {
        //pageSetUp();
        $('#tabs').tabs();
        $("#menu").menu();

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
    });



</script>