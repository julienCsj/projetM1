@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Gestion du financement <small>Gestion des sources de financement</small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" 
                     data-widget-colorbutton="false"
                     data-widget-editbutton="false"
                     data-widget-togglebutton="false"
                     data-widget-deletebutton="false"
                     data-widget-fullscreenbutton="false"
                     data-widget-custombutton="false"
                     data-widget-collapsed="false"
                     data-widget-sortable="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Liste des financements existants </h2>

                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="dt_basic_financement" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Libellé</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($financements as $f)
                                    <tr>
                                        <td>{{ $f['id'] }}</td>
                                        <td>{{ $f['libelle'] }}</td>
                                        <td>
                                            <a class="btn btn-xs btn-danger" href="{{ route('financement.supprimerFinancement', array($f['id'])); }}"> <i class="glyphicon glyphicon-trash"></i></a>
                                            <a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modifierFinancement-{{$f['id']}}" href="javascript:void(0);"> <i class="glyphicon glyphicon-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">
                                <a class="btn btn-labeled btn-success" data-toggle="modal" data-target="#ajouterFinancement" href="#">
                                    <span class="btn-label">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </span>Ajouter une source de financement 
                                </a>
                            </div>
                        </div> 
                        <!-- end widget div -->
                    </div>
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->


<!-- Modal -->
<div class="modal fade" id="ajouterFinancement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Ajouter une source de financement</h4>
            </div>
            {{ Form::open(array('route' => 'financement.ajouterFinancement')) }}
            <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="libelle" class="form-control" placeholder="Libelle" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <input type="submit" class="btn btn-primary" value="Ajouter" />
            </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@foreach ($financements as $f)
<!-- Modal -->
<div class="modal fade" id="modifierFinancement-{{$f['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Modifier la source de financement n°{{$f['id']}}</h4>
            </div>
            {{ Form::open(array('route' => 'financement.modifierFinancement')) }}
            <input type="hidden" name="id" value="{{$f['id']}}" />
            <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="libelle" class="form-control" placeholder="Libelle" value="{{$f['libelle']}}" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <input type="submit" class="btn btn-primary" value="Ajouter" />
            </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach

<style>

    .widget-body{
        padding: 0px 0px 0;
    }
</style>


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {
        pageSetUp();
        $('#dt_basic_financement').DataTable();
    });
</script>