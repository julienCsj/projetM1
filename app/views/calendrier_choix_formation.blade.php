@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Calendrier de formation</h1>
        @foreach ($lesFormations as $f)
            <a href="{{ route('calendrier.calendrierFormation', array($f->id))}}" class="btn btn-primary">{{$f->short_title}}</a><br />
        @endforeach

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
        <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();


    });
</script>