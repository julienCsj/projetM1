
@include('front.layout.header')

<body class="animated fadeInDown">

<header id="header">

    <div id="logo-group">
        <span id="logo"> <img src="back/img/logo.png" alt="SmartAdmin"> </span>
    </div>

    <span id="extr-page-header-space"> <span class="hidden-mobile">Pas encore inscrit ?</span> <a href="{{URL::route('inscription')}}" class="btn btn-danger">INSCRIPTION</a> </span>

</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                <h1 class="txt-color-red login-header-big">Suivi-AAC.fr</h1>
                <div class="hero">

                    <div class="pull-left login-desc-box-l">
                        <h4 class="paragraph-header">It's Okay to be Smart. Experience the simplicity of SmartAdmin, everywhere you go!</h4>
                        <div class="login-app-icons">
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>
                        </div>
                    </div>

                    <img src="back/img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">About SmartAdmin - Are you up to date?</h5>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">Not just your average template!</h5>
                        <p>
                            Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi voluptatem accusantium!
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    {{ Form::open(array('route' => 'post.connexion', 'id' => 'login-form', 'class' => 'smart-form client-form')) }}
                        <header>
                            Sign In
                        </header>

                        @if(isset($message))
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @endif

                        <fieldset>
                            <section>
                                <label class="label">E-mail</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="email" name="email" value="{{$email or ''}}">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Entrer votre adresse email</b></label>
                            </section>

                            <section>
                                <label class="label">Mot de passe</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Entrer votre mot de passe</b> </label>
                                <div class="note">
                                    <a href="forgotpassword.html">Mot de passe oublié ?</a>
                                </div>
                            </section>

                            <section>
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" checked="">
                                    <i></i>Se rappeler de moi</label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                            </button>
                        </footer>
                    {{ Form::close() }}

                </div>

                <h5 class="text-center"> - Or sign in using -</h5>

                <ul class="list-inline text-center">
                    <li>
                        <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

@include('front.layout.footer')

<script type="text/javascript">
    runAllForms();

    $(function() {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules : {
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true,
                    minlength : 3,
                    maxlength : 20
                }
            },

            // Messages for form validation
            messages : {
                email : {
                    required : 'Veuillez entrer une adresse email',
                    email : 'Veuillez entrer une adresse email valide'
                },
                password : {
                    required : 'Veuillez entrer votre mot de passe'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>