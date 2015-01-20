
<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="back/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');} </script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="back/js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="back/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="back/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="back/js/notification/SmartNotification.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="back/js/app.min.js"></script>

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
    })

</script>
