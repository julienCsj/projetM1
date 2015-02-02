@include('layout.header')

<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Formation <small>Cette page permet de gérer les groupes des différentes formations</small></h1>
        <br/>
    </div>
    @foreach ($lesGroupes as $formation)
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
                                            <span><i class="fa fa-lg fa-plus-circle"></i> Groupe {{$groupe->nom}}</span> &ndash; <a href="#">Supprimer</a> &ndash; <a href="modifier_groupe">Modifier</a>
                                            <ul>
                                                <li style="display:none">
                                                    <span>Groupe {{$groupe->nom}} 1</span>
                                                </li>
                                                <li style="display:none">
                                                    <span>Groupe {{$groupe->nom}} 2</span>
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                        <li>
                                            <span><a href="ajouter_groupe">Ajouter</a></span>
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

<div id="ajouterGroupe" title="Ajouter un groupe">
    <form>
        <fieldset>
            <input name="authenticity_token" type="hidden">
            <div class="form-group">
                <label>Numéro de groupe</label>
                <input class="form-control" id="tab_title" value="" type="text">
            </div>
        </fieldset>
    </form>
</div>

<div id="modifierGroupe" title="Modifier un groupe">
    <form>
        <fieldset>
            <input name="authenticity_token" type="hidden">
            <div class="form-group">
                <label>Numéro de groupe</label>
                <input class="form-control" id="tab_title" value="" type="text">
            </div>
        </fieldset>
    </form>
</div>

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

    var ajouter = $("#ajouterGroupe").dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        buttons : [{
            html : "<i class='fa fa-times'></i>&nbsp; Annuler",
            "class" : "btn btn-default",
            click : function() {
                $(this).dialog("close");

            }
        }, {

            html : "<i class='fa fa-plus'></i>&nbsp; Ajouter",
            "class" : "btn btn-danger",
            click : function() {
                $(this).dialog("close");
            }
        }]
    });

    var modifier = $("#modifierGroupe").dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        buttons : [{
            html : "<i class='fa fa-times'></i>&nbsp; Annuler",
            "class" : "btn btn-default",
            click : function() {
                $(this).dialog("close");

            }
        }, {

            html : "<i class='fa fa-check'></i>&nbsp; Modifier",
            "class" : "btn btn-danger",
            click : function() {
                $(this).dialog("close");
            }
        }]
    });

    $("#ajouter_groupe").button().click(function() {
        ajouter.dialog("open");
    });

    $("#modifier_groupe").button().click(function() {
        modifier.dialog("open");
    });
})
</script>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>