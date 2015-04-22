@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Complément de service <small></small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("heuresExternes")}}
        </div>
    </div>
    <div class="row">  
        <table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
            <tr>
                <th>Intitulé</th>
                <th>Etablissement</th>
                <th>Diplome</th>
                <th>N° UE</th>
                <th>Type</th>
                <th>CM</th>
                <th>TD</th>
                <th>TP</th>
                <th>Supprimer </th>
            </tr>
            </thead>
            <tbody>

            @if (!empty($lesHeures))
                @foreach ($lesHeures as $heure)
                    <tr>
                        <td>{{ $heure->intitule }}</td>
                        <td>{{ $heure->etablissement }}</td>
                        <td>{{ $heure->diplome }}</td>
                        <td>{{ $heure->numeroUE }}</td>
                        <td>{{ $heure->type }}</td>
                        <td>{{ $heure->nbHeureCM }}</td>
                        <td>{{ $heure->nbHeureTD }}</td>
                        <td>{{ $heure->nbHeureTP }}</td>

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
            <div class="form-group col-md-2 col-lg-2">
                <label>Intitule enseignement</label>
                <input class="form-control spinner-both" type="text" name="intitule" value="">
            </div>
            <div class="form-group col-md-2 col-lg-2">
                <label>Etablissement</label>
                <input class="form-control spinner-both" type="text" name="etablissement" value="">
            </div>
            <div class="form-group col-md-2 col-lg-2">
                <label>Diplome</label>
                <input class="form-control spinner-both" type="text" name="diplome" value="">
            </div>
            <div class="form-group col-md-1 col-lg-1">
                <label>No UE</label>
                <input class="form-control spinner-both" type="text" name="numeroUE" value="">
            </div>
            <div class="form-group col-md-1 col-lg-1">
                <label>Type</label>
                <select class="form-control" name="type">
                    <option value="iut">Services IUT</option>
                    <option value="mfca">Services MFCA</option>
                    <option value="ups hors iut mfca">Services UPS hors IUT et MFCA</option>
                    <option value="pres">Service PRES hors UPS</option>
                    <option value="hors pres et ups">Service hors PRES et UPS</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            <div class="form-group col-md-1 col-lg-1">
                <label>CM (en h)</label>
                <input class="form-control spinner-both" type="number" name="nbHeureCM" value="">
            </div>
            <div class="form-group col-md-1 col-lg-1">
                <label>TD (en h)</label>
                    <input class="form-control spinner-both" type="number" name="nbHeureTD" value="">
            </div>
            <div class="form-group col-md-1 col-lg-1">
                <label>TP (en h)</label>
                    <input class="form-control spinner-both" type="number" name="nbHeureTP" value="">
            </div>
            <div class="form-group col-md-1 col-lg-1">
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