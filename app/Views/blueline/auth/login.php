<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="login-page ">
  <div class="">
    <div class="">
      <form class="form-signin  " method="post" action="<?= site_url('login') ?>" id="login">
        <div class="logo mb-5 text-center">
          <img src="<?= base_url('assets/blueline/images/logo-vision.png') ?>" alt="Vision logo" />
        </div>

        <?php if (isset($send_email)): ?>
          <?php if ($send_email): ?>
            <div class="tile-base no-padding" style="text-align: justify !important;">
              <h4 style="text-align: center!important; width: 100%; margin-bottom: 30px;">
                <?= lang('application.reset_password_request') ?>
              </h4>
              <p style="text-align: center; margin-bottom: 30px;">
                <?= lang('application.password_reset_email_sent') ?>
              </p>
              <input type="submit" style="text-align: center; width: 100%;" class="btn btn-primary"
                value="<?= lang('application.application_go_to_login') ?>" />
            </div>
          <?php else: ?>
            <div class="tile-base no-padding">
              <div class="tile-extended-header">
                <div class="grid tile-extended-header">
                  <div class="grid__col-6 grid--justify-end" style="text-align: justify !important;">
                    <p><?= lang('application.reset_password_request') ?></p>
                    <p>
                      <?= lang('application.no_email_sent') ?><br>
                      <?= lang('application.contact_admin') ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <div class="form-group">
            <label for="email"><?= lang('application.application_email') ?></label>
            <input type="email" class="form-control" id="email" name="email"
              placeholder="<?= lang('application.application_enter_your_email') ?>" required />
          </div>
          <div class="form-group">
            <label for="password"><?= lang('application.application_password') ?></label>
            <input type="password" class="form-control" id="password" name="password"
              placeholder="<?= lang('application.application_enter_your_password') ?>" required />
          </div>

          <div class="bottom-buttons d-flex justify-content-between align-items-center text-center text-lg-start">

            <input type="submit" class="btn btn-primary fadeoutOnClick px-5 py-2" value="<?= lang('login') ?>" />
            <div class="forgotpassword">
              <a href="<?= site_url("forgotpass") ?>"><?= lang('application.application_forgot_password') ?></a>
            </div>
          </div>

          <!-- <center>
          <div class="form-header"><?= lang('secure_connection') ?><br><?= esc($version ?? 'Version not defined') ?></div>
        </center> -->
          <?php if (isset($expiration)): ?>
            <div id="error"><?= esc($expiration) ?></div>
          <?php endif; ?>
        <?php endif; ?>
      </form>
    </div>
  </div>


</div>


<?= $this->endSection() ?>