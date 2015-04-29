<!DOCTYPE html>
<html lang="en-us">
<head>
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/font-awesome.min.css') }}">
    <style>
        .form-signin
        {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading, .form-signin .checkbox
        {
            margin-bottom: 10px;
        }
        .form-signin .checkbox
        {
            font-weight: normal;
        }
        .form-signin .form-control
        {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .form-signin .form-control:focus
        {
            z-index: 2;
        }
        .form-signin input[type="text"]
        {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-signin input[type="password"]
        {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .account-wall
        {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .login-title
        {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }
        .profile-img
        {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        .need-help
        {
            margin-top: 10px;
        }
        .new-account
        {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">

        <div class="col-sm-6 col-md-4 col-md-offset-4  col-sm-offset-3">
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
                        <h1 class="text-center login-title">Scolarel - Formulaire de connexion</h1>
                        <div class="account-wall">
                            <img class="profile-img" src="./img/icon-profile.png"
                                 alt="">
                            {{ Form::open(array('route' => 'post.connexion', 'class' => 'form-signin')) }}
                                <input type="text" class="form-control" name="login" placeholder="Login" @if(isset($login)) value="{{$login}}" @endif required autofocus>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    Connexion</button>
                            </form>
                        </div>
                <h3>Pour les tests</h3>
                <pre>
                           |    Login    |  mdp
Compte resp. planification : resp        - 1234
Compte enseignant          : didier.bede - 1234
Compte etudiant            : 20102772    - 1234
                </pre>

        </div>
    </div>
</div>
</body>
</html>