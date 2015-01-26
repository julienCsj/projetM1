@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Enseignant</h1>
        	<div role="content">


				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">

						<table id="dt_basic_enseignant" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Statut horaire </th>
									<th>Pourcentage </th>
									<th>Voir attribution heure</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($enseignant as $e)
								<tr>
									<td>{{ $e['nom'] }}</td>
									<td>{{ $e['prenom'] }}</td>
									<td>Statut 1</td>
									<td>
										<div class="easy-pie-chart text-danger easyPieChart" data-percent="33" data-pie-size="25" data-pie-track-color="rgba(169, 3, 41,0.07)" style="width: 30px; height: 30px; line-height: 30px;">
										<span class="percent txt-color-green">66</span>
										</div>
										heures réalisés 
									</td>
									<td>Statut 1</td>
								</tr>
								@endforeach
							</tbody>
						</table>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->




				<!-- end widget content -->

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
    	$('#dt_basic_enseignant').DataTable();
    });
</script>