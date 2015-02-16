                </div>
            </div>
        </div>
    </div>
<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <span class="txt-color-white">Application développée par Julien Custoja, Elliot Felgines & Léo Mieulet. NIL SOFTWARE</span>
            <span class="txt-color-white"><a href="">Mentions légales</a> - <a href="">Conditions d'utilisation</a></span>
        </div>
    </div>
</div>
<!-- END PAGE FOOTER -->


<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">

</div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ asset('js/plugin/pace/pace.min.js') }}"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{{ asset('js/libs/jquery-2.0.2.min.js') }}"><\/script>');
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{{ asset('js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
    }
</script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('js/notification/SmartNotification.min.js') }}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{ asset('js/smartwidgets/jarvis.widget.min.js') }}"></script>

<!-- EASY PIE CHARTS -->
<script src="{{ asset('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>

<!-- SPARKLINES -->
<script src="{{ asset('js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{ asset('js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{ asset('js/plugin/select2/select2.min.js') }}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{ asset('js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<!-- browser msie issue fix -->
<script src="{{ asset('js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{ asset('js/plugin/fastclick/fastclick.min.js') }}"></script>

<!-- Datatables: Display tables with some usefull functions -->
<script src="{{ asset('js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
<script src="{{ asset('js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>


<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->


<!-- MAIN APP JS FILE -->
<script src="{{ asset('js/app.min.js') }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>



<!-- AFFICHAGE DES NOTIFICATION -->
<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    $(document).ready(function() {
        pageSetUp();
        
        @if(isset($notifications))
            @foreach($notifications as $notification)
            $.bigBox({
                title : "{{$notification['titre']}}",
                content : "{{$notification['message']}}",
                @if($notification['type'] == "error")
                    color : "#C46A69",
                    icon : "fa fa-warning shake animated",
                @endif
                @if($notification['type'] == "info")
                    color : "#3276B1",
                    icon : "fa fa-bell swing animated",
                @endif
                @if($notification['type'] == "warning")
                    color : "#C46A69",
                    icon : "fa fa-warning shake animated",
                @endif
                @if($notification['type'] == "success")
                    color : "#739E73",
                    //timeout: 8000,
                    icon : "fa fa-check",
                @endif
                number : "1",
                timeout : 6000
            });
            @endforeach
        @endif
        
        // switch style change
			$('input[name="checkbox-style"]').change(function() {
				//alert($(this).val())
				$this = $(this);

				if ($this.attr('value') === "switch-1") {
					$("#switch-1").show();
					$("#switch-2").hide();
				} else if ($this.attr('value') === "switch-2") {
					$("#switch-1").hide();
					$("#switch-2").show();
				}

			});

			// tab - pills toggle
			$('#show-tabs').click(function() {
				$this = $(this);
				if($this.prop('checked')){
					$("#widget-tab-1").removeClass("nav-pills").addClass("nav-tabs");
				} else {
					$("#widget-tab-1").removeClass("nav-tabs").addClass("nav-pills");
				}

			});
    })

</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">

</script>
</body>
</html>
