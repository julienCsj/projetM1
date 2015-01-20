@include('back.layout.header')
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-8">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Formulaire de contact </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body" style="padding:0;">
                    <form class="smart-form" id="contact-form" method="post" action=".php" novalidate="novalidate">
                        <header>Contacts form</header>

                        <fieldset>
                            <section class="">
                                <label class="label">Sujet</label>
                                <label class="input">
                                    <i class="icon-append fa fa-tag"></i>
                                    <input type="text" id="subject" name="subject">
                                </label>
                            </section>

                            <section>
                                <label class="label">Message</label>
                                <label class="textarea">
                                    <i class="icon-append fa fa-comment"></i>
                                    <textarea id="message" name="message" rows="4"></textarea>
                                </label>
                            </section>

                            <section>
                                <label class="checkbox"><input type="checkbox" id="copy" name="copy"><i></i>Send a copy to my e-mail address</label>
                            </section>
                        </fieldset>

                        <footer>
                            <button class="btn btn-primary" type="submit">Validate Form</button>
                        </footer>

                        <div class="message">
                            <i class="fa fa-thumbs-up"></i>
                            <p>Your message was successfully sent!</p>
                        </div>
                    </form>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
        <article class="col-sm-4">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> Pourquoi nous contacter ? </h2>
                </header>
                <!-- widget content -->
                <div class="widget-body" style="padding:0;">

                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </article>
    </div>
</section>


@include('back.layout.footer')
<!-- PAGE RELATED PLUGIN(S) -->

<script src="http://maps.google.com/maps/api/js?libraries=places&amp;?sensor=false"></script>




<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();


    });

</script>

</script>