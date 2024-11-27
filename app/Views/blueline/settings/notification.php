<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php foreach ($view_data['submenu'] as $name => $value):
				$badge = "";
				$active = "";
				if ($value == "settings/achat") {
					$badge = '<span class="badge badge-success">' . $view_data['update_count'] . '</span>';
				}
				if ($name == $view_data['breadcrumb']) {
					$active = 'active';
				} ?>
				<a class="list-group-item <?= $active; ?>" id="<?php $val_id = explode("/", $value);
				  if (!is_numeric(end($val_id))) {
					  echo end($val_id);
				  } else {
					  $num = count($val_id) - 2;
					  echo $val_id[$num];
				  } ?>" href="<?= site_url($value); ?>"><?= $badge ?> 	<?= lang('application.' . $name); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<!-- notification -->
	<div class="col-md-9">
		<div class="table-head"><?= lang('application.application-email-notification'); ?></div>

		<div class="span12 marginbottom20">
			<div class="subcont">
				<form action="<?= $view_data['form_action']; ?>" method="post" enctype="multipart/form-data"
					id="_company" autocomplete="off">
					<div class="form-group">
						<label for="description"><?= lang('application.application-notification'); ?> </label>
						<input id="email_notification" type="text" name="email_notification" value="<?php if (isset($data)) {
							echo $data['email_notification'];
						} ?>" class="form-control" />
					</div>
					<input type="submit" name="send" class="btn btn-primary"
						value="<?= lang('application.application_save'); ?>" />

				</form>
			</div>

		</div>
	</div>
</div>
<?= $this->endSection() ?>