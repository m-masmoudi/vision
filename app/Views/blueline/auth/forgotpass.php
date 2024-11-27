<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="forgot-page">
<?php //$attributes = array('class' => 'form-signin', 'role' => 'form', 'id' => 'forgotpass'); ?>
<div class="col-lg-4 col-md-5">
<form class="form-signin" role="form" id="forgotpass" action="<?= site_url('forgotpass'); ?>" method="post">
  <div class="logo text-center mb-5"><img src="<?= base_url() ?><?= $view_data['core_settings']['invoice_logo']; ?>"
      alt="<?= $view_data['core_settings']['company']; ?>">
  </div>
  <div class="forgotpass-info"><?= lang('application.application_identify_account'); ?></div>

  <div class="form-group">
    <label for="email"><?= lang('application.application_email'); ?></label>
    <input type="text" class="form-control" name="email" id="email"
      placeholder="<?= lang('application.application_email'); ?>">
  </div>

  <input type="submit" style="text-align: center; width:100%; " class="btn btn-primary py-2"
    value="<?= lang('application.application_reset_password'); ?>" />

  <div class="forgotpassword text-end"><a
      href="<?= site_url("login"); ?>"><?= lang('application.application_go_to_login'); ?></a>
  </div>
</form>
  </div>

</div>

<?= $this->endSection() ?>