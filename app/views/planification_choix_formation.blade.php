@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Planification</h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("planification_choix")}}
        </div>
    </div>
    <div class="row">
            @foreach ($lesFormations as $f)
                <a href="{{ route('planification.planificationFormation', array($f->id))}}" class="btn btn-primary" style="width: 600px">{{$f->long_title}}</a><br />
                <br />
            @endforeach
    </div>
</section>

@include('layout.footer')


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>