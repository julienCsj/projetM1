<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title>Scolarel - @if(isset($titre)) {{$titre}} @else IUT GEAP @endif</title>
    <meta name="description" content="">
    <meta name="author" content="Nil Software">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/font-awesome.min.css') }}">

    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-production.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-skins.min.css') }}">

    <!-- SmartAdmin RTL Support is under construction
         This RTL CSS will be released in version 1.5
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> -->

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/style.css') }}">


    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{asset('img/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{asset('img/splash/sptouch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/splash/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/splash/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/splash/touch-icon-ipad-retina.png') }}">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{asset('img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{asset('img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{asset('img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">

</head>
<body class="fixed-header smart-style-0">

<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img src="{{asset('img/logo.png') }}" alt="Scolarel"> </span>
        <!-- END LOGO PLACEHOLDER -->

        <!-- Note: The activity badge color changes when clicked and resets the number to 0
        Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
       <!-- <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>-->
    </div>


    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->



    </div>
    <!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->

@include('layout.menu')

<!-- MAIN PANEL -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            @foreach($breadcrumb as $b)
                @if(is_array($b))
                <li><a href="{{$b["link"]}}">{{$b["label"]}}</a></li>
                @else
                <li>{{$b}}</li>
                @endif
            @endforeach
        </ol>
    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-light">
                    <!-- ALERT BOX -->
                    @if(isset($alerts))
                        @foreach($alerts as $alert)
                            @if($alert['type'] == 'warning')
                                <div class="alert alert-warning fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Attention</strong> {{$alert['message']}}
                                </div>
                            @endif
                            @if($alert['type'] == 'success')
                                <div class="alert alert-success fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Succès</strong> {{$alert['message']}}
                                </div>
                            @endif
                            @if($alert['type'] == 'info')
                                <div class="alert alert-info fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Information</strong> {{$alert['message']}}
                                </div>
                            @endif
                            @if($alert['type'] == 'error')
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Erreur</strong> {{$alert['message']}}
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <!-- FIN ALERT BOX -->
