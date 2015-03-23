@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info fade in">
                <strong>A propos de cette page.</strong> {{TipsService::getTip("calendrier")}}
            </div>
        </div>
        <!-- NEW WIDGET START -->
        <h1>Calendrier de formation</h1>
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-a">Choisir une formation</a>
                </li>
                <li>
                    <a href="#tabs-b">Copie de calendrier</a>
                </li>
            </ul>
            <div id="tabs-a">
                <div class="row padding-10">
                    @foreach ($lesFormations as $f)
                        <a href="{{ route('calendrier.calendrierFormation', array($f->id))}}" class="btn btn-primary" style="width: 600px">{{$f->long_title}}</a><br />
                        <br />
                    @endforeach
                </div>
            </div>

            <div id="tabs-b">
                <div class="row padding-10">
                    <div class="alert alert-danger" role="alert">Attention, le calendrier destination sera completement écrasé par la copie !</div>
                    {{ Form::open(array('route' => 'calendrier.copierCalendrier')) }}
                    <label>Copier le calendrier de </label>
                    <select name="idFormationSrc">
                        @foreach ($lesFormations as $f2)
                            <option value="{{$f2->id}}">{{$f2->short_title}}</option>
                        @endforeach
                    </select>
                    <label> dans </label>
                    <select name="idFormationDst">
                        @foreach ($lesFormations as $f3)
                            <option value="{{$f3->id}}">{{$f3->short_title}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Valider" />
                    {{ Form::close() }}
                </div>
            </div>
        </div>
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