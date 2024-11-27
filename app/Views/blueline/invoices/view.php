<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php

use Config\OccConfig;

header("");
?>
<div class="row">
	<div class="col-xs-12 col-sm-12">

		<?php
		$config = new OccConfig();
		if (
			$config->occ_facture_p_paye
			&& $view_data['invoice']['status'] != $config->occ_facture_p_paye
			&& $view_data['invoice']['status'] != $config->occ_facture_avoir
		) { ?>
			<a href="<?= base_url() ?>invoices/update/<?= $view_data['invoice']['id']; ?>/view" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-edit visible-xs" title="Modifier"></i><span class="hidden-xs"><?= lang('application.application_edit_invoice'); ?></span></a>
		<?php } ?>
		<!-- add payement if facture not paid-->
		<?php if (
			$view_data['invoice']['status'] != $config->occ_facture_p_paye
			&& $view_data['invoice']['status'] != $config->occ_facture_avoir
		) { ?>
			<a href="<?= base_url() ?>invoices/payment/<?= $view_data['invoice']['id']; ?>" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-credit-card visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_payment'); ?></span></a>
		<?php } ?>
		<a type="button" class="btn btn-primary" href="<?= base_url() ?>invoices/preview/<?= $view_data['invoice']['id']; ?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> PDF
		</a>

		<a href="<?= base_url() ?>invoices" class="btn btn-warning right"><?= lang('application.application_facture_list'); ?></a>
		<?php if (
			$view_data['invoice']['status'] != $config->occ_facture_p_paye
			&& isset($view_data['company']['name'])
		) { ?><a href="<?= base_url() ?>invoices/sendinvoice/<?= $view_data['invoice']['id']; ?>" class="btn btn-primary"><i class="fa fa-envelope visible-xs"></i><span class="hidden-xs"><?= lang('application.application_send_invoice_to_client'); ?></span></a><?php } ?>
	</div>
</div>
<!-- détail de la facture -->
<div class="row">
	<div class="col-md-12">
		<div class="table-head"></div>
		<div class="subcont d-flex">
			<ul class="details col-xs-12 col-sm-6">
				<li><span><?= lang('application.application_invoice_id'); ?> :</span> <span data-toggle="tooltip" title="<?= $view_data['invoice']['estimate_num']; ?>"><?= $view_data['invoice']['estimate_num']; ?></span></li>
				<li><span><?= lang('application.application_subject'); ?> :</span><?php if (empty($view_data['invoice']['subject'])) {
																					echo "-";
																				} else echo $view_data['invoice']['subject'] ?></li>
				<li class="<?= $view_data['invoice']['status']; ?>"><span>Etat :</span>
					<?php get_etat_color(intval($view_data['invoice']['status'])) ?>
				</li>
				<li><span><?= lang('application.application_issue_date'); ?>:</span> <?php $unix = human_to_unix($view_data['invoice']['creation_date'] . ' 00:00');
																					echo date($view_data['core_settings']['date_format'], $unix); ?></li>
				<?php if ($view_data['company']['timbre_fiscal'] > 0) {
					echo "<li><span>" . lang('application.application_timbre') . " : <span><br>";
					echo "<span style='color:red !important;'>" . lang('application.application_exoneration_timbre') . "<span></li>";
				} ?>
				<!-- Guarantee client -->
				<?php if ($view_data['company']['guarantee'] == 1) {
					echo "<li><span>" . lang('application.application_guarantee') . " : <span><br>";
					echo "<span style='color:red !important;'>" . 'Client bénéficié du retenue de garantie' . "<span></li>";
				} ?>
				<?php if (isset($view_data['company']['vat'])) { ?>
					<li><span><?= lang('application.application_vat'); ?>:</span> <?php echo $view_data['company']['vat']; ?></li>
				<?php } ?>
				<?php if (isset($view_data['project'])) { ?>
					<li><span><?= lang('application.application_projects'); ?>:</span><?php echo $view_data['project']['project_num'] . ' : ' . $view_data['project']['name'] ?></li>
				<?php } ?>
				<span class="visible-xs"></span>
			</ul>
			<ul class="details col-xs-12 col-sm-6">
				<?php if (isset($view_data['company']['name'])) { ?>
					<li><span><?= lang('application.application_company'); ?>:</span>
						<a href="<?= base_url() ?>clients/view/<?= $view_data['company']['id']; ?>" class="label label-info">
							<?php echo $view_data['company']['name'] ?>
						</a>
					</li>
					<li><span><?= lang('application.application_contact'); ?>:</span> <?php if (isset($view_data['client']['firstname'])) { ?><?= $view_data['client']['firstname']; ?> <?= $view_data['client']['lastname']; ?> <?php } else {
																																																							echo "-";
																																																						} ?></li>
					<li><span><?= lang('application.application_street'); ?>:</span> <?php echo $view_data['company']['address'] = empty($view_data['company']['address']) ? "-" : $view_data['company']['address']; ?></li>
					<li><span><?= lang('application.application_city'); ?>:</span><?php echo $view_data['company']['zipcode'] = empty($view_data['company']['city']) ? "-" : $view_data['company']['city']; ?> </li>
				<?php } else { ?>
					<li><?= lang('application.application_no_client_assigned'); ?></li>
				<?php } ?>
				<!-- tva -->
				<?php if ($view_data['company']['tva'] == 1) {
					echo "<li><span>" . lang('application.application_TVA') . " : <span><br>";
					echo "<span style='color:red !important;'>" . lang('application.application_exoneration_tva') . "<span></li>";
				} ?>
			</ul>
			</ul>
			<br clear="all">
		</div>
	</div>
</div>

<!-- devise de la facture -->
<div class="d-flex align-items-center mb-2 justify-content-end">
	<strong><?= lang('application.application_currency'); ?> : <?php echo $view_data['invoice']['currency']; ?></strong>
</div>

<!-- tableau des articles -->
<div class="row">
	<div class="col-md-12">
		<div class="table-head">
			<?= lang('application.application_invoice_items'); ?>
			<span class=" pull-right">
				<?php
				$config = new OccConfig();
				if (
					$view_data['invoice']['status'] != $config->occ_facture_p_paye
					&& $view_data['invoice']['status'] != $config->occ_facture_p_paye
					&& $view_data['invoice']['status'] != $config->occ_facture_avoir
				) {  ?>
					<a class="status-btn text-success btn-sm"><?= lang("application.application_up_to_date") ?></a>
					<a href="<?= base_url() ?>invoices/item/<?= $view_data['invoice']['id']; ?>" class="btn btn-md btn-primary" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_item'); ?></span></a>
					<a href="<?= base_url() ?>invoices/itemEmpty/<?= $view_data['invoice']['id']; ?>" class="btn btn-danger" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_item_empty'); ?></span></a>
			</span><?php } ?>
		</div>

		<div class="table-div min-height-200 table-responsive">
			<table class="table noclick" id="items" rel="<?= base_url() ?>" cellspacing="0" cellpadding="0">
				<thead>
					<th width="4%"><?= lang('application.application_action'); ?></th>
					<th width="1%">#</th>
					<th><?= lang('application.application_name'); ?></th>
					<th class="hidden-xs"><?= lang('application.application_description'); ?></th>
					<th class="hidden-xs" width="5%"><?= lang('application.application_unit'); ?></th>
					<th class="hidden-xs RightTd" width="12%"><?= lang('application.application_unit_price_ht'); ?></th>
					<th class="hidden-xs center" width="8%"><?= lang('application.application_quantity'); ?></th>
					<th class="hidden-xs RightTd" width="12%"><?= lang('application.application_discount'); ?></th>
					<!-- TVA-->
					<?php if ($view_data['company']['tva'] == 0) { ?>
						<th class="hidden-xs" width="12%"><?= lang('application.application_tva'); ?></th>
					<?php } else { ?>
						<th></th>
					<?php } ?>
					<th class="hidden-xs RightTd" width="12%"><?= lang('application.application_sub_total_HT'); ?></th>
				</thead>
				<tbody class="sortable">
					<?php $i = 0;
					$sum = 0; ?>
					<?php

					foreach ($view_data['items'] as $value): ?>
						<tr id="<?= $value['id']; ?>" class="droppable">
							<td class="option" style="text-align:left;" width="8%">
								<?php if (
									$view_data['invoice']['status '] != $config->occ_facture_p_paye
									&& $view_data['invoice']['status '] != $$config->occ_facture_p_paye
								) { ?>
									<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="right" data-content="<a class='btn btn-danger po-delete' href='<?= base_url() ?>invoices/item_delete/<?= $value['id']; ?>/<?= $view_data['invoice']->id; ?>'><?= lang('application.application_yes_im_sure'); ?></a> <button class='btn po-close'><?= lang('application.application_no'); ?></button>" data-original-title="<b><?= lang('application.application_really_delete'); ?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>

								<?php } else {
									echo '<i class="btn-option fa fa-lock"></i>';
								} ?>

								<a href="<?= base_url() ?>invoices/item_update_empty/<?= $value['id']; ?>" title="<?= lang('application.application_edit'); ?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>

								<a href="<?= base_url() ?>invoices/duplicateItemEmpty/<?= $value['id']; ?>" title="<?= lang('application.application_dupliacte'); ?>" class="btn-option"><i class="fa fa-files-o"></i></a>

							</td>
							<td class="hidden-xs" width="1%"><?php echo $i + 1; ?></td>
							<td><?php if (!empty($value['name'])) {
									echo $value['name'];
								} else {
									echo $value['name'];
								} ?></td>
							<td class="hidden-xs"><?= nl2br($value['description']); ?></td>
							<td class="hidden-xs"><?= $value['unit']; ?></td>
							<td class="hidden-xs RightTd"><?php echo numberFormatPrecision($value['value'], $view_data['chiffre'], '.', ' '); ?></td>
							<td class="hidden-xs center"><?= $value['amount']; ?></td>
							<td class="hidden-xs RightTd"><?php echo $value['discount'] . "%"; ?></td>
							<!-- TVA-->
							<?php if ($view_data['company']['tva'] == 0) { ?>
								<td class="hidden-xs"><?php echo $value['tva'] . "%"; ?></td>
							<?php } else { ?>
								<td></td>
							<?php } ?>
							<td class="hidden-xs RightTd">
								<?php
								$total = 0;
								$totalTVA = 0;
								$SousTotal = ($value['amount'] * $value['value']) - ($value['amount'] * $value['value'] * $value['discount']) / 100;
								$SousTotalTVA = $SousTotal + ($SousTotal * $value['tva']) / 100;
								$totalTVA += $SousTotalTVA;
								$total += $SousTotal;
								echo numberFormatPrecision($SousTotal, $view_data['chiffre'], '.', ' '); ?>
							</td>
						</tr>
						<?php $sum = $sum + $value['amount'] * $value['value'];
						$i++ ?>
					<?php endforeach;
					if (!isset($view_data['discountpercent'])) {
						$totalTVA = 0;
						$dis = ($totalTVA / 100) * $view_data['invoice']['discount'];
						$totalTVA = $totalTVA - $dis;
					}
					?>
				</tbody>
				<tbody>
					<?php
					if (empty($items)) {
						echo "<tr><td colspan='7'>" . lang('application.application_no_items_yet') . "</td></tr>";
					}
					$discount = ($sum / 100) * $view_data['invoice']['discount'];
					$sum = $sum - $discount;
					$sumRest = $sum - $view_data['invoice']['paid'];
					?>
					<?php if ($discount != 0 && $sum > 0) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?= lang('application.application_discount');
								echo ('(' . $view_data['invoice']['discount'] . '%)'); ?> <?php if (isset($view_data['discountpercent'])) {
																																		echo "(" . $view_data['invoice']['discount'] . ")";
																																	} ?></td>
							<td class="RightTd">-<?= display_money($discount, "", $view_data['chiffre']); ?></td>
						</tr>
					<?php } ?>
					<?php
					$taxes = array();
					foreach ($view_data['items'] as $item) {
						if ($item->tva != 0) {
							$discount = ($item['amount'] * $item['value']) - ($item['value'] * $item['value'] * $item['discount']) / 100;
							if (!isset($view_data['discountpercent'])) {
								$discount = $discount - ($discount / 100) * $view_data['invoice']['discount'];
							}
							$value = ($discount) * $item['tva'] / 100;
							if (array_key_exists($item['tva'], $taxes)) {
								$taxes[$item['tva']] += $value;
							} else {
								$taxes[$item['tva']] = $value;
							}
							$sum = $sum + $value;
						}
					}

					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>

						<!-- discount-->
						<?php if (!isset($view_data['discountpercent'])) {
							$total = 0;
							$discountHt = ($total / 100) * $view_data['invoice']['discount'];
							$total = $total - $discountHt;
						}
						?>
						<td style="white-space:nowrap;"><?= lang('application.application_total_ht'); ?></td>
						<?php if ($sum > 0) { ?>
							<td class="RightTd"><?= numberFormatPrecision($total, $view_data['chiffre'], '.', ' '); ?></td>
						<?php } else { ?>
							<td class="RightTd"><?= numberFormatPrecision("0", $view_data['chiffre'], '.', ' '); ?></td>
						<?php } ?>
					</tr>

					<!-- TVA-->
					<?php if ($view_data['company']['tva'] == 0) { ?>
						<?php foreach ($taxes as $tax => $value): ?>
							<tr>
								<td colspan="8"></td>
								<td style="white-space:nowrap;"><?= lang('application.application_tax'); ?> (<?= $tax ?>%)</td>
								<td class="RightTd"><?= numberFormatPrecision($value, $view_data['chiffre'], '.', ' '); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php } ?>
					<!-- retenue guarantee -->
					<?php
					if ($view_data['company']['guarantee'] == 1) {
					?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?= lang('application.application_guarantee'); ?></td>
							<?php if ($view_data['company']['tva'] == 1) { ?>
								<td class="RightTd">
									<?php $guarantee = round(($total * 10) / 100, $view_data['chiffre']); ?>
									<?= numberFormatPrecision($guarantee, $view_data['chiffre'], '.', ' '); ?>
								<?php } else { ?>
								<td class="RightTd">
									<?php $guarantee = round(($totalTVA * 10) / 100, $view_data['chiffre']); ?>
									<?= numberFormatPrecision($guarantee, $view_data['chiffre'], '.', ' '); ?>
								<?php } ?>
						</tr>
					<?php } ?>
					<!-- Retenue -->
					<?php if ($view_data['invoice']['deduction'] > 0) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="white-space:nowrap;"><?= lang('application.application_deduction'); ?>
								(<?= $view_data['invoice']['deduction'] ?>%) </td>
							<td class="RightTd"><?php
												if ($company['tva'] == 1) {
													echo ('-' . numberFormatPrecision($view_data['invoice']['deduction'], $view_data['chiffre'], '.', ' '));
													$total = $total - $view_data['invoice']['deduction'];
												} else {
													echo ('-' . numberFormatPrecision($view_data['invoice']['deduction'], $view_data['chiffre'], '.', ' '));
													$totalTVA = $totalTVA - $view_data['invoice']['deduction'];
												}
												?>
							</td>
						</tr>
					<?php } ?>
					<!-- timbre_fiscal -->
					<?php if ($view_data['company']['timbre_fiscal'] == 0) { ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="white-space:nowrap;"><?= lang('application.application_timbre'); ?></td>
							<td class="RightTd"><?=
												display_money($view_data['invoice']['timbre_fiscal'], "", $view_data['chiffre']);
												$totalTVA = $totalTVA + $view_data['invoice']['timbre_fiscal'];
												$total = $total + $view_data['invoice']['timbre_fiscal'];

												?>
							</td>
						</tr>
					<?php } ?>

					<tr class="active">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="white-space:nowrap;"><?= lang('application.application_total_ttc'); ?></td>
						<?php if ($view_data['company']['tva'] == 1) { ?>
							<?php if ($sum > 0) { ?>

								<td class="RightTd" id="ttc"><?= numberFormatPrecision($total - $guarantee, $view_data['chiffre'], '.', ' '); ?>

								</td>
							<?php } else { ?>
								<td><?= display_money("0"); ?></td>
							<?php }
						} else { ?>
							<?php if ($sum > 0) { ?>
								<td class="RightTd" id="ttc"><?= numberFormatPrecision($totalTVA - $guarantee, $view_data['chiffre'], '.', ' '); ?>
								</td>
							<?php } else { ?>
								<td class="RightTd"><?= numberFormatPrecision("0", $view_data['chiffre'], '.', ' '); ?></td>
						<?php }
						} ?>
			</table>

		</div>






		<!-- note -->
		<?php if ($view_data['invoice']['notes']) { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-head"><?= lang('application.application_notes'); ?></div>
					<div class="subcont" id="notes">
						<ul>
							<?php echo $view_data['invoice']['notes']; ?>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>
		<!-- ------->
	

	</div>
</div>













<?php if ($view_data['invoice']['status'] == "Open"): ?>
	<script>
		$(document).ready(() => {
			var shadowUpdate = function() {
				var order = ""
				setTimeout(function() {
					$('.sortable').children().each(function() {
						order += $(this).attr('id') + ","
					})
					order = order.substring(0, order.length - 1)

					$('.status-btn').html('<i class="fa fa-spinner fa-spin"></i> <?= lang("application.application_saving") ?>')
					$.get("<?= base_url() ?>api/sort_factures?items=" + order, function(data) {
						$('.status-btn').html('<?= lang("application.application_up_to_date") ?>')
						location.reload()
					});
				}, 0)
			}

			$('.sortable').sortable({
				placeholder: "sortable-highlight"
			})

			$('.droppable').droppable({
				drop: shadowUpdate
			})
		});
	</script>
<?php endif; ?>

<style>
	.sortable-highlight {
		background: #ecf0f1;
	}
</style>
<script>
	window.onload = function() {
		if (!window.location.hash) {
			window.location = window.location + '#loaded';
			window.location.reload();
		}
	}
</script>
<?= $this->endSection() ?>