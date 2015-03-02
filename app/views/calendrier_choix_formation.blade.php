@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Calendrier de formation</h1>
        @foreach ($lesFormations as $f)
            <a href="{{ route('calendrier.calendrierFormation', array($f->id))}}" class="btn btn-primary">{{$f->short_title}}</a><br />
        @endforeach
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