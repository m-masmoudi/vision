
<header class="row mainnavbar">
     <div class="inner-header">
     <div class="topbar__left noselect d-md-none d-block">
            <i class="ion-ios-keypad topbar__icon fc-dropdown--trigger hidden"></i>
            <div class="fc-dropdown shortcut-menu grid">
                  <div class="grid__col-6 shortcut--item"><i class="ion-ios-paper-outline shortcut--icon"></i>
                        <?= lang('application.application_create_invoice'); ?>
                  </div>
                  <div class="grid__col-6 shortcut--item"><i class="ion-ios-pricetags shortcut--icon"></i>
                        <?= lang('application.application_create_ticket'); ?>
                  </div>
                  <div class="grid__col-6 shortcut--item"><i class="ion-ios-email shortcut--icon"></i>
                        <?= lang('application.application_write_messages'); ?>
                  </div>
            </div>
            <!-- nom de la société -->
           


      </div>

      <!-- help(?) into menu bar  -->
       <div class="rigt-profile">
     
      <?php

use App\Models\CongesModel;

if ($view_data['act_uri'] != 'forgotpass') { ?>
<div class="topbar noselect d-flex position-relative">


            <!-- <span class="inline visible-xs">
            <a href="<?= site_url("agent"); ?>" data-toggle="mainmodal"
                  title="<?= lang('application.application_profile'); ?>">
                  <img class="img-circle topbar-userpic" src="" height="21px"> <i
                        class="ion-chevron-down" style="padding-left: 2px;"></i>
            </a>
            </span> -->
            <img class="img-circle topbar-userpic hidden-xs" src="" height="21px">
            <div class="marg-15">
               
               <?= $view_data['nom_licence'][0]['name']; ?>
            </div>
            <span class="hidden-xs topbar__name fc-dropdown--trigger">
            <i class="ion-chevron-down" style="padding-left: 2px;"></i>
            </span>
            <div class="fc-dropdown profile-dropdown">
            <ul>
                  <li>
                        <a href="<?= site_url("agent"); ?>" data-toggle="mainmodal">
                              <span class="icon-wrapper"><i class="ion-gear-a"></i></span>
                              <?= lang('application.application_profile'); ?>
                        </a>
                  </li>
                  <li class="profile-dropdown__logout">
                        <a href="<?= site_url("logout"); ?>"
                              title="<?= lang('application.application_logout'); ?>">
                              <span class="icon-wrapper"><i class="ion-power pull-right"></i></span>
                              <?= lang('application.application_logout'); ?>
                        </a>
                  </li>
            </ul>
            </div>
</div>

<?php } ?>
<div class="topbar noselect">
            <!-- features for only small devices -->
            <span class="inline visible-xs">

            </span>
            <div class="btn-group" class="inline visible-xs">
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" type="button"
                        style=" margin: 4px; border-radius: 5px ;opacity: 1;">
                        <a style="text-decoration: none;" target="_blank" href="<?= site_url("support"); ?>"><span
                                    style="color: whitesmoke ; ">Support<span
                                          style=" margin-right: -10px ; margin-left: 6px"
                                          class="glyphicon glyphicon-question-sign"
                                          aria-hidden="true"></span></span></a> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                        <li><a href="<?= site_url("support"); ?>">Guide utilisateur</a></li>
                        <li><a href="<?= site_url("faq"); ?>">FAQ</a></li>
                  </ul>
            </div>
            <?php
          
            

            if ($view_data['user_online'] && $view_data['user_online'][0]['admin'] == "1") {
                  ?>
                  <div class="btn-group" class="inline visible-xs">
                        <div id="notification-header">
                              <button type="button" class="btn btn-warning notification" type="button">
                                    <?php
                                    $options = array('conditions' => array('statut=?', '162'));
                                    $congesModel = new \App\Models\CongesModel();
                                    $conges=$congesModel->find(162);
                              

                                    ?>
                                    <a style="text-decoration: none;" href="<?= base_url() ?>gestionconge/all_attente"><span
                                                style="color: whitesmoke ; ">Demandes de congés<span
                                                      id="notification-count"></span></span></span></a>
                                    <span class="caret"></span>

                              </button>
                        </div>
                  </div>
                  <?php
            }
            ?>
      </div>
       </div>
     </div>
 
</header>