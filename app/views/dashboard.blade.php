@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        <?php
			$user = Session::get('user');
            $nom = $user->LASTNAME;
            $prenom = $user->FIRSTNAME;
        ?>
                    
        <h1>Bienvenue <small>@if(!empty($nom) && !empty($prenom)) {{$nom}} {{$prenom}} @endif</small></h1>
        <br/>
        <br/>
        <div class="row">
        	<div class="col-md-4">
		        <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false" role="widget" style="">

					<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

					data-widget-colorbutton="false"
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true"
					data-widget-sortable="false"

					-->

					<header role="heading">
						<div class="jarviswidget-ctrls" role="menu"></div>
						<h2>Voeux d'enseignant</h2>
					</header>

					<!-- widget div-->
					<div role="content">
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<div class="widget-body no-padding">
								<label>Voeux d'enseignant</label>
								<input type="text">
							</div>
						</div>
						<!-- end widget edit box -->

						<div class="widget-body widget-hide-overflow no-padding">
							<!-- content goes here -->
							Vous n'avez pas de voeux d'enseignant à valider
							<!-- end content -->
						</div>

					</div>
					<!-- end widget div -->
				</div>

        	</div>
        </div>
        <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->



<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {
        pageSetUp();
    });
</script>