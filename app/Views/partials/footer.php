<!-- TODO I will delete margin-left  when i re-orginize the sider bar -->
<footer class=" main-footer col-md-12 col-xs-12" style="width: 100% position: fixed; bottom: 0; " ;>

    <div class="container" style="width: 100%;position: fixed; bottom:10px;  color: black;  text-align: center; ">
        <div class="row" style="opacity: 1;">

            <div style="position: fixed ; right: 0;">

                <div class="btn-group dropup float-end" style="margin-right: 10px;">


                    <button type="button" class="btn btn-primary dropdown-toggle  " data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu " class="width: 100%; "
                        style="background: white;  opacity:1;position: absolute; z-index:1; margin-left: -100px; weight:700;">

                        <div class=" btn-primary col-md-8" style="color: white; text-align: center ;opacity:1;">
                            <h2 class="col-md-8" style=" color: white;text-align: center;weight: 700;"> Assistance </h2>
                        </div>


                        <!---- form -->

                        <div class="scrollable  container"
                            style=" z-index:1; padding-left: 0!important; padding-right: 0!important;">



                            <form class=" col-md-12 well well-md well well-xs well well-lg "
                                style=" z-index:1; margin-bottom: -5px;">

                                <div class="row">
                                    <p style="color: #0099cc; weight: 300; margin-left:-10px; padding: 20px;">
                                        Laissez-nous un message et nous vous recontacterons! </p>

                                    <div class="form-group  col-md-11 col-xs-11">
                                        <label for="name">
                                            Présentez-vous *</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nom, e-mail"
                                            required="required" />
                                    </div>
                                    <div class="form-group  col-md-9 col-xs-11">
                                        <label for="name">
                                            Nom de téléphone</label>
                                        <input type="text" class="form-control" id="name" placeholder=""
                                            required="required" />
                                    </div>


                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">
                                                Message *</label>
                                            <textarea name="message" id="message" class="form-control" rows="12"
                                                cols="25" required="required" placeholder="Message"></textarea>
                                        </div>


                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <button type="submit" class="btn btn-danger " id="btnContactUs">
                                            Envoyer un message</button>
                                    </div>
                                </div>
                            </form>



                        </div>

                        <!-- end form -->

                    </div>

                </div>


            </div>
        </div>
    </div>
    </div>



</footer>
<!-- Modal -->
<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<?php if ($view_data['act_uri'] != 'login') { ?>
    </div> <!-- content area div closing
<?php } ?>
<?= $this->include('partials/scripts') ?>

</body>

</html>