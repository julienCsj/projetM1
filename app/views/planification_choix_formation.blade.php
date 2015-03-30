@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <h1>Planification</h1>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info fade in">
                
            </div>
        </div>
        
        <div class="row padding-10">
            @foreach ($lesFormations as $f)
                <a href="{{ route('planification.planificationFormation', array($f->id))}}" class="btn btn-primary" style="width: 600px">{{$f->long_title}}</a><br />
                <br />
            @endforeach
        </div>
        
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