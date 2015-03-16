@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <!-- NEW WIDGET START -->
        	<h1>Voeux  <small>Cette page permet de visionner les indisponibilités de l'enseignant</small></h1>
        <br/>
        <br/>
        <!-- NEW WIDGET START -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
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
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Voeux </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Lundi</th>
                                        <th>Mardi</th>
                                        <th>Mercredi</th>
                                        <th>Jeudi</th>
                                        <th>Vendredi</th>
                                    </tr>
                                </thead>
                                <tbody id="tab_voeux">
                                	<tr>
                                        <th>8h - 9h30</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>9h30 - 11h</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>11h - 12h30</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>12h30 - 13h30</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>13h30 - 15h</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>15h - 16h30</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                	<tr>
                                        <th>16h30 - 18h</th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                        <th><button class="btn"></button></th>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
        <!-- WIDGET END -->
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->



<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    function initializeButton(data) {
        for (var j = 0; j < 5; j++) { // chaque jour
		  for (var i = 0; i < 7; i++) { // chaque créneau horaire
				var button = $("#tab_voeux tr:eq("+i+") th:eq("+(j+1)+") button");
				if (data[j][i]) {
					button.html("Disponible")
					.addClass("btn-success btn-disponibilite disabled")
					.attr("data-dispo", 1);
				} else {
					button.html("Indisponible")
					.addClass("btn-warning btn-disponibilite disabled")
					.attr("data-dispo", 0);
				}
				button.attr("data-jour",j).attr("data-creneau", i);
			}
		}
		$(".btn-disponibilite").bind('click', function () {
            return false;
        })
    }
    function modifier_voeux(dispo, jour, creneau) {
        var from_data = {
            "dispo" : parseInt(dispo),
            "jour" : parseInt(jour),
            "creneau" : parseInt(creneau),
        };
        $.ajax({
            url: "voeux",
            data: from_data,
            type: "POST"
        })
        .done(function (html) {
            $.bigBox({
                title: "Modification réalisé",
                content: "Vos voeux ont bien été mis à jour !",
                color: "#3276B1",
                icon: "fa fa-bell swing animated",
                timeout: 2000
            });
            // modifie la valeur dans le tableau
			var button = $("#tab_voeux tr:eq("+from_data["creneau"] +") th:eq("+(from_data["jour"]+1)+") button");
            if (from_data["dispo"] == 1) {
            	button
            	.attr("data-dispo", 1)
            	.removeClass("btn-warning")
            	.addClass("btn-success")
            	.html("Disponible");
            } else {
            	button
            	.attr("data-dispo", 0)
            	.removeClass("btn-success")
            	.addClass("btn-warning")
            	.html("Indisponible");
            }
        })
        .fail(function (html) {
            $.bigBox({
                title: "Echec de la modification",
                content: "Un problème est survenu !",
                color: "#C46A69",
                icon: "fa fa-warning swing animated",
                timeout: 3000
            });
        });
    }
    $(document).ready(function() {
        pageSetUp();
        var data = {{json_encode($voeux)}};
        initializeButton(data);
    });
</script>