

<div id="mainwrapper">
    <div class="side">
        <div class="sidebar-bg"></div>
        <?php if ($view_data['act_uri'] != 'forgotpass') { ?>

            <div class="sidebar">
                <!-- logo vision -->
                <div class="companyName">
                    <img src="<?php echo base_url() . "assets/blueline/images/logo-vision-blanc.png" ?>">
                </div>
                <!-- le nouveau menu -->

                <div class="gw-sidebar">
                    <div id="gw-sidebar" class="gw-sidebar">
                        <div class="nano-content">
                            <ul class="gw-nav gw-nav-list">
                                <?php
                                foreach ($view_data['menu'] as $key => $value) {

                                    //Vérifier les sous modules -->
                                    //$s_modules = $this->db->query("SELECT * FROM `modules_sous`  WHERE `id_modules` =" . $value->id . " and id IN (" . implode(',', $accessSubmenu) . ")")->result();
                                    $s_modules = [];
                                    if (empty($s_modules)) { ?>
                                        <!-- les modules -->

                                        <li class="init-un-active <?php if (($view_data['act_uri'] == strtolower($value['link'])) || (substr(strtolower($value['link']), 0, strlen($view_data['act_uri']) + 1) == $view_data['act_uri'] . '/')) {
                                            echo 'active';
                                        } ?>">
                                            <a href="<?= $value['link'] ?>">
                                                <span class="gw-menu-text">
                                                    <?= lang('application.application_' . ($value['name'])); ?>
                                                    <!-- Notification menu -->
                                                    <?php if ($value['name'] == 'ctickets') { ?>
                                                        <span class="notification-badge" id="countTickets"
                                                            style="background: #ed5564;"><?= $count_ticket; ?></span>
                                                    <?php }
                                                    if ($value['name'] == 'messages') { ?>
                                                        <p class="notification-badge" id="countMessages" style="background: #ed5564;">
                                                            <?= $count_messages; ?></p>
                                                    <?php } ?>
                                                    <!-- Fin Notification menu -->
                                                </span>
                                            </a>
                                        </li>

                                    <?php } else { ?>
                                        <!-- possède des sous menu -->

                                        <li class="init-arrow-down"><a href="javascript:void(0)">
                                                <span class="gw-menu-text">
                                                    <?= lang('application.application_' . ($value['name'])); ?>
                                                </span> <b class="gw-arrow icon-arrow-up8"></b> </a>

                                            <!----- afficher les sous menus -->

                                            <ul class="gw-submenu">

                                                <?php if (!empty($s_modules)){ foreach ($s_modules as $key => $value) { ?>

                                                    <li <?php if ($view_data['act_uri'] == strtolower($value['link'])) {
                                                        echo "class='active'";
                                                    } ?>><a href="<?= site_url($value['link']); ?>">
                                                            <?= lang('application.application_' . ($value['name'])); ?></a>
                                                    </li>


                                                <?php } }?>

                                            </ul>

                                        </li>


                                    <?php } ?>

                                <?php }
                                $idadmin =$view_data['user_id'];

                                if ($idadmin == 1) {

                                    ?>

                                    <li> <a href="https://vision.bimmapping.com/saisietmp"><i class="fa fa-plane"></i><span>
                                                jours fériés </span></a>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>

                </div>

                <!-- widget utilisateur en ligne -->
                <?php foreach ($view_data['widgets'] as $key => $val) {

                    if ($view_data['user_online'] && $val->link == "useronline") { ?>

                        <ul class="nav nav-sidebar user-online menu-sub hidden-sm hidden-xs  enLigne">
                            <ul id="menu-accordeon">
                                <li><a href="#">
                                        <h4 style="margin-top:0;"><?= lang('application.application_user_online'); ?></h4>
                                    </a>
                                    <ul>
                                        <?php foreach ($user_online as $value):
                                            if ($value->last_active + (15 * 60) > time()) {
                                                $status = "online";
                                            } else {
                                                $status = "away";
                                            } ?>
                                            <li>
                                                <a href="#">
                                                    <p class="truncate"><img class="img-circle"
                                                            src="<?= get_user_pic($value->userpic, $value->email); ?>" width="21px" />
                                                        <span
                                                            class="user_online__indicator user_online__indicator--<?= $status; ?>"></span>
                                                        <?php echo $value->firstname . " " . $value->lastname; ?>
                                                    </p>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>


                        </ul>
                    <?php }
                }
        } ?>

        </div>
    </div>
</div>