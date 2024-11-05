<?php

//var_dump($view_data['nom_licence']);
//die;
$act_uri = $view_data['act_uri'];
$lastsec = $view_data['lastsec'];
$act_uri_submenu = $view_data['act_uri_submenu'];
if (!$act_uri) {
    $act_uri = 'dashboard';
}
if (is_numeric($act_uri_submenu)) {
    $lastsec = $lastsec - 1;
    $act_uri_submenu = $this->uri->segment($lastsec);
}
$message_icon = false;
?>
<?= $this->include('partials/header') ?>
<?php if(isset($view_data['menu']) && !empty($view_data['menu'])){ ?>
<?= $this->include('partials/sidebar') ?>
<?php } ?>
<?php if($view_data['act_uri'] != 'login' && $view_data['act_uri'] != 'forgotpass'){ ?>
<div class="content-area">

<?php } ?>
    <?= $this->renderSection('content') ?>
<?php if($view_data['act_uri'] == 'login' || $view_data['act_uri'] == 'forgotpass'){ ?>
</div>
</div>
<?php } ?>

    <?= $this->include('partials/footer') ?>