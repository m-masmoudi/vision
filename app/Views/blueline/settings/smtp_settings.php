<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php foreach ($view_data['submenu'] as $name => $value):
				$badge = "";
				$active = "";
				if ($value == "settings/updates") {
					$badge = '<span class="badge badge-success">' . $update_count . '</span>';
				}
				if ($name == $view_data['breadcrumb']) {
					$active = 'active';
				} ?>
				<a class="list-group-item <?= $active; ?>"
					id="<?php $val_id = explode("/", $value);
					if (!is_numeric(end($val_id))) {
						echo end($val_id);
					} else {
						$num = count($val_id) - 2;
						echo $val_id[$num];
					} ?>"
					href="<?= site_url($value); ?>"><?= $badge ?> 	<?= lang('application.' . $name) ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-md-9">
		<div class="table-head"><?= lang('application.application_smtp_settings'); ?></div>
		<div class="table-div settings">
			<form action="<?= $view_data['form_action']; ?>" method="POST" id="smtpsettings">
				<div class="form-header"><?= lang('application.application_SMTP_settings_for_outgoing_emails'); ?></div>
				<span class="highlight-text"><?= lang('application.application_SMTP_settings_not_changed'); ?></span>
				<br>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_protocol'); ?></label>
							<select name="protocol" class="formcontrol chosen-select ">
								<?php if ($view_data['config']["protocol"] != "") { ?>
									<option value="<?= $view_data['config']["protocol"]; ?>" selected="">
										<?= $view_data['config']["protocol"]; ?></option>
								<?php } ?>
								<option value="smtp">SMTP</option>
								<option value="sendmail">sendmail</option>
								<option value="mail">mail</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_hostname'); ?></label>
							<input type="text" name="smtp_host" class="form-control"
								value="<?= $view_data['config']["smtp_host"]; ?>">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_username'); ?></label>
							<input type="text" name="smtp_user" autocomplete="off" class="form-control"
								value="<?= $view_data['config']["smtp_user"]; ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_password'); ?></label>
							<input type="password" autocomplete="off" name="smtp_pass" class="form-control"
								value="<?= $view_data['config']["smtp_pass"]; ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_port'); ?> (25, 465, 587)</label>
							<input type="text" name="smtp_port" class="form-control"
								value="<?= $view_data['config']["smtp_port"]; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_security'); ?></label>
							<select name="smtp_crypto" class="formcontrol chosen-select ">
								<option value="" <?php if ($view_data['config']["smtp_crypto"] == "") {
									echo 'selected="selected"';
								} ?>>None</option>
								<option value="tls" <?php if ($view_data['config']["smtp_crypto"] == "tls") {
									echo 'selected="selected"';
								} ?>>TLS</option>
								<option value="ssl" <?php if ($view_data['config']["smtp_crypto"] == "ssl") {
									echo 'selected="selected"';
								} ?>>SSL</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_timeout'); ?></label>
							<input type="text" name="smtp_timeout" class="form-control" value="5">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label><?= lang('application.application_debug'); ?> (Enable only for Testing!)</label>
							<select name="smtp_debug" class="formcontrol chosen-select ">
								<option value="0" <?php if ($view_data['config']["smtp_debug"] == "0") {
									echo 'selected="selected"';
								} ?>>Off</option>
								<option value="1" <?php if ($view_data['config']["smtp_debug"] == "1") {
									echo 'selected="selected"';
								} ?>>Commands</option>
								<option value="2" <?php if ($view_data['config']["smtp_debug"] == "2") {
									echo 'selected="selected"';
								} ?>>Commands and data</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group no-border">
					<input type="submit" name="send" class="btn btn-primary"
						value="<?= lang('application.application_save'); ?>" />
				</div>
			</form>
			<form action="<?= $view_data['form_action2']; ?>" method="POST" id="smtpsettings"></form>
			<div class="form-header"><?= lang('application.application_send_test_email'); ?></div>
			<div class="form-group">
				<label><?= lang('application.application_email'); ?></label>
				<input type="email" name="dist" class="form-control" value="" required>
			</div>
			<div class="form-group no-border">
				<input type="submit" name="send" class="btn btn-primary"
					value="<?= lang('application.application_send_test_email'); ?>" />
			</div>

			</form>
		</div>
	</div>
</div>
<?= $this->endSection() ?>