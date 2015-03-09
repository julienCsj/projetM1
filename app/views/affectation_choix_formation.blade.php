@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Affectation et planification</h1>
        <br>
        <br>
        @foreach ($lesFormations as $f)
            <a href="{{ route('affectation.affectationFormation', array($f->id))}}" class="btn btn-primary">{{$f->short_title}}</a><br />
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