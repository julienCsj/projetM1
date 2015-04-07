@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Configuration de l'application</h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("config")}}
        </div>
    </div>
    <div class="row">
        {{ Form::open(array('route' => 'config.postConfig')) }}
        <div id="tabs" class="">
            <ul>
                <li>
                    <a href="#tabs-a">Configuration</a>
                </li>
            </ul>
            <div id="tabs-a">
                <div class="row padding-10">
                    <div class="form-group">
                        Année scolaire
                        <select class="form-control" name="annee">
                            <option @if($config->annee == 2014) selected @endif value="2014">2014-2015</option>
                            <option @if($config->annee == 2015) selected @endif value="2015">2015-2016</option>
                            <option @if($config->annee == 2016) selected @endif value="2016">2016-2017</option>
                            <option @if($config->annee == 2017) selected @endif value="2017">2017-2018</option>
                            <option @if($config->annee == 2018) selected @endif value="2018">2018-2019</option>
                            <option @if($config->annee == 2019) selected @endif value="2019">2019-2020</option>
                        </select>
                </div>
                    <div class="form-group">
                        Date de la rentrée
                        <input type="text" class="form-control" name="dateRentree" placeholder="jj/mm/aaaa" value="{{$config->dateRentree}}"/>
                    </div>
                    <div class="form-group">
                        Date de fin des cours
                        <input type="text" class="form-control" name="dateFin" placeholder="jj/mm/aaaa" value="{{$config->dateFin}}" />
                    </div>
                    <hr>
                    <div class="form-group">
                        Coefficient service CM
                        <input type="text" class="form-control" name="valeurCMEnHService" placeholder="1.5" value="{{$config->valeurCMEnHService}}" />
                        Coefficient service TD
                        <input type="text" class="form-control" name="valeurTDEnHService" placeholder="1" value="{{$config->valeurTDEnHService}}" />
                        Coefficient service TP
                        <input type="text" class="form-control" name="valeurTPEnHService" placeholder="1" value="{{$config->valeurTPEnHService}}" />
                    </div>
                    <hr>
                    <div class="form-group">
                        Coefficient service CM HCC
                        <input type="text" class="form-control" name="valeurCMEnHServiceHCC" placeholder="1.5" value="{{$config->valeurCMEnHServiceHCC}}" />
                        Coefficient service TD HCC
                        <input type="text" class="form-control" name="valeurTDEnHServiceHCC" placeholder="1" value="{{$config->valeurTDEnHServiceHCC}}" />
                        Coefficient service TP HCC
                        <input type="text" class="form-control" name="valeurTPEnHServiceHCC" placeholder="0.66" value="{{$config->valeurTPEnHServiceHCC}}" />
                    </div>
                    <input type="submit" class="form-control" value="Sauvegarder" />

                </div>
        </div>
        {{Form::close()}}
        <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
        $('#tabs').tabs();

    });
</script>