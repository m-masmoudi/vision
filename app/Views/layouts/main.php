<?php
$act_uri = $view_data['act_uri'];
$lastsec = $view_data['lastsec'];
$act_uri_submenu = $view_data['act_uri_submenu'];

// Set default value for $act_uri if not provided
if (!$act_uri) {
    $act_uri = 'dashboard';
}

// Adjust $lastsec if $act_uri_submenu is numeric
if (is_numeric($act_uri_submenu)) {
    $lastsec -= 1;
}

$message_icon = false;
?>
<?= $this->include('partials/header') ?>

<?php if (isset($view_data['user_online']) && isset($view_data['menu']) && !empty($view_data['menu'])): ?>
    <?= $this->include('partials/sidebar') ?>
<?php endif; ?>

<?php if (isset($view_data['user_online']) && $act_uri != 'login' && $act_uri != 'forgotpass'): ?>
    <div class="content-area">
    <?= $this->include('partials/subHeader') ?>
<?php endif; ?>


    <?= $this->renderSection('content') ?>

<?php if ($act_uri != 'login' && $act_uri != 'forgotpass'): ?>
    </div> <!-- Close content-area div only if not login or forgotpass -->
<?php endif; ?>

<?= $this->include('partials/footer') ?>
