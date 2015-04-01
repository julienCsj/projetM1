@include('layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <h1>Voeux <small>Cette page permet de gerer vos indisponibilités dans la semaine</small></h1>
        <div class="alert alert-info fade in">
            <button class="close" data-dismiss="alert">×</button>
            <strong>A propos de cette page.</strong> {{TipsService::getTip("voeux")}}
        </div>
    </div>
    <div class="row">
        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
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
                    <th><button class="btn"></button></th>
                </tr>
            	<tr>
                    <th>9h30 - 11h</th>
                    <th><button class="btn"></button></th>
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
                    <th><button class="btn"></button></th>
                </tr>
            	<tr>
                    <th>12h30 - 13h30</th>
                    <th><button class="btn"></button></th>
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
                    <th><button class="btn"></button></th>
                </tr>
            	<tr>
                    <th>15h - 16h30</th>
                    <th><button class="btn"></button></th>
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
                    <th><button class="btn"></button></th>
                </tr>
                <tr>
                    <th>18h00 - 19h30</th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                </tr>
                <tr>
                    <th>19h30 - 21h</th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                    <th><button class="btn"></button></th>
                </tr>
            </tbody>
        </table>
    </div>
</section>

@include('layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->



<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    function initializeButton(data) {
        for (var j = 0; j < 6; j++) { // chaque jour
		  for (var i = 0; i < 9; i++) { // chaque créneau horaire
				var button = $("#tab_voeux tr:eq("+i+") th:eq("+(j+1)+") button");
				if (data[j][i]) {
					button.html("Disponible")
					.addClass("btn-success btn-disponibilite")
					.attr("data-dispo", 1);
				} else {
					button.html("Indisponible")
					.addClass("btn-warning btn-disponibilite")
					.attr("data-dispo", 0);
				}
				button.attr("data-jour",j).attr("data-creneau", i);
			}
		}
		$(".btn-disponibilite").bind('click', function () {
			var dispo = ($(this).attr("data-dispo") == 0 ? 1 : 0);
			modifier_voeux(dispo,
			$(this).attr("data-jour"),
			$(this).attr("data-creneau"));
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