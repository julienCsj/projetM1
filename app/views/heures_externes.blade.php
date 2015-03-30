@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Heures exterieures <small></small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("heuresExternes")}}
        </div>
    </div>
    <div class="row">  
        <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
            <tr>
                <th>Libelle</th>
                <th>Type</th>
                <th>Nombre d'heure </th>
                <th>Supprimer </th>
            </tr>
            </thead>
            <tbody>

            @if (!empty($lesHeures))
                @foreach ($lesHeures as $heure)
                    <tr>
                        <td>{{ $heure->libelle }}</td>
                        <td>{{ $heure->type }}</td>
                        <td>{{ $heure->nbHeure }}</td>
                        <td><a class="btn btn-xs btn-danger" href="{{ route('heuresexterieures.supprimer', array($heure->id)); }}"> <i class="glyphicon glyphicon-trash"></i></a></td>
                    </tr>
                @endforeach
            @else
                <p>Aucun enseignant à afficher</p>
            @endif
            </tbody>
        </table>
        <?php
            $user = Session::get('user');
           // exit(var_dump($user));
        ?>
        {{ Form::open(array('route' => 'heuresexterieures.ajouter')) }}
        <input type="hidden" name="enseignantID" value="{{$user->LOGIN}}">
        <div class="row padding-10">
            <div class="form-group col-md-3 col-lg-3">
                <label>Libelle</label>
                <input class="form-control spinner-both" type="text" name="libelle" value="">
            </div>
            <div class="form-group col-md-3 col-lg-3">
                <label>Type</label>
                <select class="form-control" name="type">
                    <option value="ups">Heure(s) UPS</option>
                    <option value="mfca">Heure(s) MFCA</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                <label>Nombre d'heure</label>
                <input class="form-control spinner-both" type="number" name="nbHeure" value="">
            </div>
            <div class="form-group col-md-3 col-lg-3">
                <label>&nbsp;</label>
                <input class="form-control" type="submit"  value="Ajouter">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->


<script type="text/javascript">

</script>