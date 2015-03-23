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
        <div id="tabs" class="">
            <ul>
                <li>
                    <a href="#tabs-a">Configuration</a>
                </li>
            </ul>
            <div id="tabs-a">
                <div class="row padding-10">
                    <p>Ici la config</p>
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