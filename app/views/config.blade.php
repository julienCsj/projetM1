@include('layout.header')
<section id="widget-grid" class="">
    <div class="row padding-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info fade in">
                <strong>A propos de cette page.</strong> {{TipsService::getTip("config")}}
            </div>
        </div>
        <!-- NEW WIDGET START -->
        <h1>Configuration de l'application</h1>
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
                        <select name="annee">
                            <option @if($config->annee == 2014) selected @endif value="2014">2014-2015</option>
                            <option @if($config->annee == 2015) selected @endif value="2015">2015-2016</option>
                            <option @if($config->annee == 2016) selected @endif value="2016">2016-2017</option>
                            <option @if($config->annee == 2017) selected @endif value="2017">2017-2018</option>
                            <option @if($config->annee == 2018) selected @endif value="2018">2018-2019</option>
                            <option @if($config->annee == 2019) selected @endif value="2019">2019-2020</option>
                        </select>
                </div>
            </div>
        </div>
            <input type="submit" value="Sauvegarder" />
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