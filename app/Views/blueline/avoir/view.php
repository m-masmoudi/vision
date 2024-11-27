<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php

use Config\OccConfig;

header("");
?>
<style>
	td {
		white-space: nowrap;
	}
</style>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<?php
		$config = new OccConfig();
		if (
			$view_data['avoir']['status']!= $config->occ_avoir_p_paye
			&& $view_data['avoir']['status'] != $config->occ_avoir_p_paye
		) { ?>
			<a href="<?= base_url() ?>avoir/update/<?= $view_data['avoir']['id']; ?>/view" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-edit visible-xs" title="Modifier"></i><span class="hidden-xs"><?= lang('application.application_edit_avoir'); ?></span></a>
		<?php } ?>

		<!-- add payement if facture not paid-->
		<?php if ($view_data['avoir']['status'] != $config->occ_avoir_p_paye) { ?>
			<a href="<?= base_url() ?>avoir/payment/<?= $view_data['avoir']['id']; ?>" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-credit-card visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_payment'); ?></span></a>
		<?php } ?>
		<!-- PDF -->
		<a type="button" class="btn btn-primary" href="<?= base_url() ?>avoir/preview/<?= $view_data['avoir']['id']; ?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> PDF
		</a>

		<a href="<?= base_url() ?>avoir" class="btn btn-warning right"><?= lang('application.application_avoir_list'); ?></a>
		<?php if ($view_data['avoir']['status'] != "Paid" && isset($view_data['company']['name'])) { ?><a href="<?= base_url() ?>avoir/sendavoir/<?= $view_data['avoir']['id']; ?>" class="btn btn-primary"><i class="fa fa-envelope visible-xs"></i><span class="hidden-xs"><?= lang('application.application_send_invoice_to_client'); ?></span></a><?php } ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-head"><?= lang('application.application_avoir_details'); ?></div>
		<div class="subcont d-flex ">
			<ul class="details col-xs-12 col-sm-6">
				<li><span><?= lang('application.application_avoir_id'); ?>:</span> <?= $view_data['avoir']['avoir_num']; ?></li>

				<li><span><?= lang('application.application_subject'); ?>:</span> <?php if (empty($view_data['avoir']['subject'])) {
																					echo "-";
																				} else echo $view_data['avoir']['subject'] ?></li>

				<li class=""><span>Etat :</span>
					<?php get_etat_color(intval($view_data['avoir']['status'])) ?>
				</li>
				<li><span><?= lang('application.application_issue_date'); ?>:</span> <?php $unix = human_to_unix($view_data['avoir']['issue_date'] . ' 00:00');
																					echo date($view_data['core_settings']['date_format'], $unix); ?></li>

				<?php if (isset($view_data['company']['vat'])) { ?>
					<li><span><?= lang('application.application_vat'); ?>:</span> <?php echo $view_data['company']['vat']; ?></li>
				<?php } ?>

				<span class="visible-xs"></span>
			</ul>
			<ul class="details col-xs-12 col-sm-6">
				<?php if (isset($view_data['company']['name'])) { ?>
					<li><span><?= lang('application.application_company'); ?>:</span> <a href="<?= base_url() ?>clients/view/<?= $view_data['company']['id']; ?>" class="label label-info">
							<!--<?php $max = 30;
								if (strlen($view_data['company']['name']) >= $max) {
									$chaine = substr($view_data['company']['name'], 0, $max) . '...';
								} else {
									$chaine = $view_data['company']['name'];
								}
								echo $chaine; ?>-->
							<?php echo $view_data['company']['name'] ?>
						</a>
					</li>
					<li><span><?= lang('application.application_contact'); ?>:</span> <?php if (isset($view_data['client']['firstname'])) { ?><?= $view_data['client']['firstname']; ?> <?= $view_data['client']['lastname']; ?> <?php } else {
																																																							echo "-";
																																																						} ?></li>

					<li><span><?= lang('application.application_street'); ?>:</span> <?php if (empty($view_adta['company']['address'])) {
																						echo "-";
																					} else echo $view_adta['company']['address'] ?></li>
					<li><span><?= lang('application.application_city'); ?>:</span> <?php if (empty($view_adta['company']['city'])) {
																						echo "-";
																					} else echo $view_adta['company']['city'] ?></li>
				<?php } else { ?>
					<li><?= lang('application.application_no_client_assigned'); ?></li>
				<?php } ?>
			</ul>
			</ul>
			<br clear="all">
		</div>
	</div>
</div>
<div class="d-flex justify-content-end mb-2"><strong><?= lang('application.application_currency'); ?> :<?php echo $view_data['avoir']['currency']; ?></strong></div>
<div class="row">
	<div class="col-md-12">
		<div class="table-head">
			<?= lang('application.application_invoice_items'); ?> <?php if ($view_data['avoir']['status'] != "Invoiced") { ?>
				<span class=" pull-right">
					<?php if ($view_data['avoir']['status']!= "Paid" && $view_data['avoir']['status'] != "PartiallyPaid") { ?>
						<a class="status-btn text-success btn-sm"><?= lang("application.application_up_to_date") ?></a>
						<a href="<?= base_url() ?>avoir/item/<?= $view_data['avoir']['id']; ?>" class="btn btn-md btn-primary" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_item'); ?></span></a>
						<a href="<?= base_url() ?>avoir/itemEmpty/<?= $view_data['avoir']['id']; ?>" class="btn btn-danger" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i><span class="hidden-xs"><?= lang('application.application_add_item_empty'); ?></span></a>
				</span><?php } ?>
		</div>
	<?php } ?>
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
				<?php foreach ($view_data['items'] as $value): ?>
					<tr id="<?= $value['id']; ?>" class="droppable">
						<td class="option" style="text-align:left;" width="8%">
							<?php if ($view_data['avoir']['status']!= "Paid" && $view_data['avoir']['status'] != "PartiallyPaid") { ?>
								<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="right" data-content="<a class='btn btn-danger po-delete' href='<?= base_url() ?>avoir/item_delete/<?= $value['id']; ?>/<?= $view_data['avoir']['id']; ?>'><?= lang('application.application_yes_im_sure'); ?></a> <button class='btn po-close'><?= lang('application.application_no'); ?></button>" data-original-title="<b><?= lang('application.application_really_delete'); ?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>
								<!-- duplicate -->
								<a href="<?= base_url() ?>avoir/duplicateItemEmpty/<?= $value['id']; ?>" title="<?= lang('application.application_dupliacte'); ?>" class="btn-option"><i class="fa fa-files-o"></i></a>
							<?php } else {
								echo '<i class="btn-option fa fa-lock"></i>';
							} ?>
							<!-- update  item -->
							<a href="<?= base_url() ?>avoir/item_update/<?= $value['id']; ?>" title="<?= lang('application.application_edit'); ?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>


						</td>
						<td class="hidden-xs" width="1%"><?php echo $i + 1; ?></td>
						<td><?php if (!empty($value['name'])) {
								echo $value['name'];
							} else {
								echo $value['name'];
							} ?></td>
						<td class="hidden-xs"><?= nl2br($value['description']); ?></td>
						<td class="hidden-xs"><?= $value['unit']; ?></td>
						<td class="hidden-xs RightTd"><?php echo display_money($value['value'], "", $view_data['chiffre']); ?></td>
						<td class="hidden-xs center"><?= $value['amount']; ?></td>
						<td class="hidden-xs RightTd"><?php echo $value['discount'] . "%"; ?></td>
						<!-- TVA-->
						<?php if ($view_data['company']['tva']== 0) { ?>
							<td class="hidden-xs"><?php echo $value['tva'] . "%"; ?></td>
						<?php } else { ?>
							<td></td>
						<?php } ?>
						<td class="hidden-xs RightTd">
							<?php
							$totalTVA=0;
							$total=0;
							$SousTotal = ($value['amount'] * $value['value']) - ($value['amount'] * $value['value'] * $value['discount']) / 100;
							$SousTotalTVA = $SousTotal + ($SousTotal * $value['tva']) / 100;
							$totalTVA += $SousTotalTVA;
							$total += $SousTotal;
							echo '+' . display_money($SousTotal, "", $view_data['chiffre']);
							?>
						</td>
					</tr>
					<?php $sum = $sum + $value['amount'] * $value['value'];
					$i++ ?>
				<?php endforeach; ?>
			</tbody>
			<tbody>
				<?php
				if (empty($view_data['items'])) {
					echo "<tr><td colspan='7'>" . lang('application.application_no_items_yet') . "</td></tr>";
				}
				$discount = sprintf("%01.2f", round(($sum / 100) * $view_data['avoir']['discount'], 2));
				$sum = $sum - $discount;
				$sumRest = sprintf("%01.2f", round($sum - $view_data['avoir']['paid'], 2));
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
						<td><?= lang('application.application_discount'); ?> <?php if (isset($view_data['discountpercent'])) {
																				echo "(" . $view_data['avoir']['discount'] . ")";
																			} ?></td>
						<td class="RightTd">-<?= display_money($discount, "", $view_data['chiffre']); ?></td>
					</tr>
				<?php } ?>
				<?php
				$taxes = array();
				foreach ($view_data['items'] as $item) {
					if ($item['tva'] != 0) {
						$discount = ($item['amount'] * $item['value']) - ($item['amount']* $item['value'] * $item['discount']) / 100;
						$value = ($discount) * $item['tva'] / 100;
						if (array_key_exists($item['tva'], $taxes)) {
							$taxes[$item['tva']] += $value;
						} else {
							$taxes[$item['tva']] = $value;
						}
						$sum = sprintf("%01.2f", round($sum + $value, 2));
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
					<td style="white-space:nowrap;"><?= lang('application.application_total_ht'); ?></td>
					<?php if ($sum > 0) { ?>
						<td class="RightTd"><?php echo '+' . number_format($total, $view_data['chiffre'], '.', ' '); ?></td>
					<?php } else { ?>
						<td><?= display_money("0", "", $view_data['chiffre']); ?></td>
					<?php } ?>
				</tr>
				<!-- TVA-->
				<?php if ($view_data['company']['tva'] == 0) { ?>
					<?php foreach ($taxes as $tax => $value): ?>
						<tr>
							<td colspan="8"></td>
							<td style="white-space:nowrap;"><?= lang('application.application_tax'); ?> (<?= $tax ?>%)</td>
							<td class="RightTd"><?php echo '+' . number_format($value, $view_data['chiffre'], '.', ' '); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php } ?>
				<!-- retenue guarantee -->
				<?php
				if ($view_data['company']['guarantee']== 1) {
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
						<td style="white-space:nowrap;"><?= lang('application.application_guarantee'); ?></td>
						<?php if ($view_data['company']['tva'] == 1) { ?>
							<td class="RightTd">
								<?php $guarantee = ($total * 10) / 100; ?>
								<?php echo '+' . number_format($guarantee, $view_data['chiffre'], '.', ' '); ?>
							<?php } else { ?>
							<td class="RightTd">
								<?php $guarantee = ($totalTVA * 10) / 100; ?>
								<?php echo '+' . number_format($guarantee, $view_data['chiffre'], '.', ' '); ?>
							<?php } ?>
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
							<?php $guarantee = ($totalTVA * 10) / 100; ?>
							<td class="RightTd" id="ttc"><?php echo '+' . number_format($total - $guarantee, $view_data['chiffre'], '.', ' '); ?></td>
						<?php } else { ?>
							<td><?= display_money("0", "", $view_data['chiffre']); ?></td>
						<?php }
					} else { ?>
						<?php if ($sum > 0) { ?>
							<td class="RightTd" id="ttc"><?php echo '+' . number_format($totalTVA - $guarantee, $view_data['chiffre'], '.', ' '); ?></td>
						<?php } else { ?>
							<td><?= display_money("0", "", $view_data['chiffre']); ?></td>
					<?php }
					} ?>
		</table>
	</div>

	<!-- note -->
	<?php if ($view_data['avoir']['notes']) { ?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-head"><?= lang('application.application_notes'); ?></div>
				<div class="subcont" id="notes">
					<ul>
						<?php echo $view_data['avoir']['notes']; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- ------->
	<?php if (!empty($view_data['payments'])) {
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-head"><?= lang('application.application_payments'); ?> </div>
				<div class="table-div min-height-200">
					<table class="table noclick" id="payments" rel="<?= base_url() ?>" cellspacing="0" cellpadding="0">
						<thead>
							<th><?= lang('application.application_action'); ?></th>
							<th><?= lang('application.application_description'); ?></th>
							<th><?= lang('application.application_type'); ?></th>
							<th><?= lang('application.application_payment_date'); ?></th>
							<th colspan="2" class="RightTd"><?= lang('application.application_value'); ?></th>
						</thead>
						<?php
						$i = 0;
						foreach ($view_data['payments'] as $value) { ?>
							<tr class="sec">
								<td class="option" style="text-align:left;" width="8%">
									<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="right" data-content="<a class='btn btn-danger po-delete' href='<?= base_url() ?>avoir/payment_delete/<?= $value['id']; ?>/<?= $view_data['avoir']->id; ?>'><?= lang('application.application_yes_im_sure'); ?></a> <button class='btn po-close'><?= lang('application.application_no'); ?></button> <input type='hidden' name='td-id' class='id' value='<?= $value['id']; ?>'>" data-original-title="<b><?= lang('application.application_really_delete'); ?></b>"><i class="fa fa-times"></i></button>
									<a href="<?= base_url() ?>avoir/payment_update/<?= $value['id']; ?>" title="<?= lang('application.application_edit'); ?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit"></i></a>
								</td>
								<td><?= $value['notes']; ?></td>
								<td><?php if (lang('application.application_' . $value['type']) == false) {
										echo $value['type'];
									} else {
										echo lang('application.application_' . $value['type']);
									} ?></td>
								<td><?php $unix = human_to_unix($value['date'] . ' 00:00');
									echo date($view_data['core_settings']['date_format'], $unix); ?></td>

								<td colspan="2" class="RightTd">- <?= display_money($value['amount'], "", $view_data['chiffre']); ?></td>
							</tr>
						<?php $i++;
						} ?>
						<tr class="payments">
							<td colspan="5" align="right"><?= lang('application.application_payments_received'); ?></td>
							<td class="RightTd">- <?= display_money($view_data['avoir']->paid, "", $view_data['chiffre']); ?></td>
						</tr>
						<tr class="active">
							<td colspan="5" align="right"><?= lang('application.application_total_outstanding'); ?></td>
							<td class="RightTd ajax-silent" id="outstanding"><?= display_money($view_data['avoir']['outstanding'], "", $view_data['chiffre']); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		<div class=" col-md-12" align="right">
			<?php if ($view_data['core_settings']['paypal'] == "1" && $sum != "0.00" && $view_data['avoir']['status'] != "Paid") {
				//Get currency
				# PHP ISO currency => name list
				$currency = $view_data['avoir']['currency'];
				$currency_codes = array("AFA" => "Afghani", "AFN" => "Afghani", "ALK" => "Albanian old lek", "ALL" => "Lek", "DZD" => "Algerian Dinar", "USD" => "US Dollar", "ADF" => "Andorran Franc", "ADP" => "Andorran Peseta", "EUR" => "Euro", "AOR" => "Angolan Kwanza Readjustado", "AON" => "Angolan New Kwanza", "AOA" => "Kwanza", "XCD" => "East Caribbean Dollar", "ARA" => "Argentine austral", "ARS" => "Argentine Peso", "ARL" => "Argentine peso ley", "ARM" => "Argentine peso moneda nacional", "ARP" => "Peso argentino", "AMD" => "Armenian Dram", "AWG" => "Aruban Guilder", "AUD" => "Australian Dollar", "ATS" => "Austrian Schilling", "AZM" => "Azerbaijani manat", "AZN" => "Azerbaijanian Manat", "BSD" => "Bahamian Dollar", "BHD" => "Bahraini Dinar", "BDT" => "Taka", "BBD" => "Barbados Dollar", "BYR" => "Belarussian Ruble", "BEC" => "Belgian Franc (convertible)", "BEF" => "Belgian Franc (currency union with LUF)", "BEL" => "Belgian Franc (financial)", "BZD" => "Belize Dollar", "XOF" => "CFA Franc BCEAO", "BMD" => "Bermudian Dollar", "INR" => "Indian Rupee", "BTN" => "Ngultrum", "BOP" => "Bolivian peso", "BOB" => "Boliviano", "BOV" => "Mvdol", "BAM" => "Convertible Marks", "BWP" => "Pula", "NOK" => "Norwegian Krone", "BRC" => "Brazilian cruzado", "BRB" => "Brazilian cruzeiro", "BRL" => "Brazilian Real", "BND" => "Brunei Dollar", "BGN" => "Bulgarian Lev", "BGJ" => "Bulgarian lev A/52", "BGK" => "Bulgarian lev A/62", "BGL" => "Bulgarian lev A/99", "BIF" => "Burundi Franc", "KHR" => "Riel", "XAF" => "CFA Franc BEAC", "CAD" => "Canadian Dollar", "CVE" => "Cape Verde Escudo", "KYD" => "Cayman Islands Dollar", "CLP" => "Chilean Peso", "CLF" => "Unidades de fomento", "CNX" => "Chinese People's Bank dollar", "CNY" => "Yuan Renminbi", "COP" => "Colombian Peso", "COU" => "Unidad de Valor real", "KMF" => "Comoro Franc", "CDF" => "Franc Congolais", "NZD" => "New Zealand Dollar", "CRC" => "Costa Rican Colon", "HRK" => "Croatian Kuna", "CUP" => "Cuban Peso", "CYP" => "Cyprus Pound", "CZK" => "Czech Koruna", "CSK" => "Czechoslovak koruna", "CSJ" => "Czechoslovak koruna A/53", "DKK" => "Danish Krone", "DJF" => "Djibouti Franc", "DOP" => "Dominican Peso", "ECS" => "Ecuador sucre", "EGP" => "Egyptian Pound", "SVC" => "Salvadoran colón", "EQE" => "Equatorial Guinean ekwele", "ERN" => "Nakfa", "EEK" => "Kroon", "ETB" => "Ethiopian Birr", "FKP" => "Falkland Island Pound", "FJD" => "Fiji Dollar", "FIM" => "Finnish Markka", "FRF" => "French Franc", "XFO" => "Gold-Franc", "XPF" => "CFP Franc", "GMD" => "Dalasi", "GEL" => "Lari", "DDM" => "East German Mark of the GDR (East Germany)", "DEM" => "Deutsche Mark", "GHS" => "Ghana Cedi", "GHC" => "Ghanaian cedi", "GIP" => "Gibraltar Pound", "GRD" => "Greek Drachma", "GTQ" => "Quetzal", "GNF" => "Guinea Franc", "GNE" => "Guinean syli", "GWP" => "Guinea-Bissau Peso", "GYD" => "Guyana Dollar", "HTG" => "Gourde", "HNL" => "Lempira", "HKD" => "Hong Kong Dollar", "HUF" => "Forint", "ISK" => "Iceland Krona", "ISJ" => "Icelandic old krona", "IDR" => "Rupiah", "IRR" => "Iranian Rial", "IQD" => "Iraqi Dinar", "IEP" => "Irish Pound (Punt in Irish language)", "ILP" => "Israeli lira", "ILR" => "Israeli old sheqel", "ILS" => "New Israeli Sheqel", "ITL" => "Italian Lira", "JMD" => "Jamaican Dollar", "JPY" => "Yen", "JOD" => "Jordanian Dinar", "KZT" => "Tenge", "KES" => "Kenyan Shilling", "KPW" => "North Korean Won", "KRW" => "Won", "KWD" => "Kuwaiti Dinar", "KGS" => "Som", "LAK" => "Kip", "LAJ" => "Lao kip", "LVL" => "Latvian Lats", "LBP" => "Lebanese Pound", "LSL" => "Loti", "ZAR" => "Rand", "LRD" => "Liberian Dollar", "LYD" => "Libyan Dinar", "CHF" => "Swiss Franc", "LTL" => "Lithuanian Litas", "LUF" => "Luxembourg Franc (currency union with BEF)", "MOP" => "Pataca", "MKD" => "Denar", "MKN" => "Former Yugoslav Republic of Macedonia denar A/93", "MGA" => "Malagasy Ariary", "MGF" => "Malagasy franc", "MWK" => "Kwacha", "MYR" => "Malaysian Ringgit", "MVQ" => "Maldive rupee", "MVR" => "Rufiyaa", "MAF" => "Mali franc", "MTL" => "Maltese Lira", "MRO" => "Ouguiya", "MUR" => "Mauritius Rupee", "MXN" => "Mexican Peso", "MXP" => "Mexican peso", "MXV" => "Mexican Unidad de Inversion (UDI)", "MDL" => "Moldovan Leu", "MCF" => "Monegasque franc (currency union with FRF)", "MNT" => "Tugrik", "MAD" => "Moroccan Dirham", "MZN" => "Metical", "MZM" => "Mozambican metical", "MMK" => "Kyat", "NAD" => "Namibia Dollar", "NPR" => "Nepalese Rupee", "NLG" => "Netherlands Guilder", "ANG" => "Netherlands Antillian Guilder", "NIO" => "Cordoba Oro", "NGN" => "Naira", "OMR" => "Rial Omani", "PKR" => "Pakistan Rupee", "PAB" => "Balboa", "PGK" => "Kina", "PYG" => "Guarani", "YDD" => "South Yemeni dinar", "PEN" => "Nuevo Sol", "PEI" => "Peruvian inti", "PEH" => "Peruvian sol", "PHP" => "Philippine Peso", "PLZ" => "Polish zloty A/94", "PLN" => "Zloty", "PTE" => "Portuguese Escudo", "TPE" => "Portuguese Timorese escudo", "QAR" => "Qatari Rial", "RON" => "New Leu", "ROL" => "Romanian leu A/05", "ROK" => "Romanian leu A/52", "RUB" => "Russian Ruble", "RWF" => "Rwanda Franc", "SHP" => "Saint Helena Pound", "WST" => "Tala", "STD" => "Dobra", "SAR" => "Saudi Riyal", "RSD" => "Serbian Dinar", "CSD" => "Serbian Dinar", "SCR" => "Seychelles Rupee", "SLL" => "Leone", "SGD" => "Singapore Dollar", "SKK" => "Slovak Koruna", "SIT" => "Slovenian Tolar", "SBD" => "Solomon Islands Dollar", "SOS" => "Somali Shilling", "ZAL" => "South African financial rand (Funds code) (discont", "ESP" => "Spanish Peseta", "ESA" => "Spanish peseta (account A)", "ESB" => "Spanish peseta (account B)", "LKR" => "Sri Lanka Rupee", "SDD" => "Sudanese Dinar", "SDP" => "Sudanese Pound", "SDG" => "Sudanese Pound", "SRD" => "Surinam Dollar", "SRG" => "Suriname guilder", "SZL" => "Lilangeni", "SEK" => "Swedish Krona", "CHE" => "WIR Euro", "CHW" => "WIR Franc", "SYP" => "Syrian Pound", "TWD" => "New Taiwan Dollar", "TJS" => "Somoni", "TJR" => "Tajikistan ruble", "TZS" => "Tanzanian Shilling", "THB" => "Baht", "TOP" => "Pa'anga", "TTD" => "Trinidata and Tobago Dollar", "TND" => "Tunisian Dinar", "TRY" => "New Turkish Lira", "TRL" => "Turkish lira A/05", "TMM" => "Manat", "RUR" => "Russian rubleA/97", "SUR" => "Soviet Union ruble", "UGX" => "Uganda Shilling", "UGS" => "Ugandan shilling A/87", "UAH" => "Hryvnia", "UAK" => "Ukrainian karbovanets", "AED" => "UAE Dirham", "GBP" => "Pound Sterling", "USN" => "US Dollar (Next Day)", "USS" => "US Dollar (Same Day)", "UYU" => "Peso Uruguayo", "UYN" => "Uruguay old peso", "UYI" => "Uruguay Peso en Unidades Indexadas", "UZS" => "Uzbekistan Sum", "VUV" => "Vatu", "VEF" => "Bolivar Fuerte", "VEB" => "Venezuelan Bolivar", "VND" => "Dong", "VNC" => "Vietnamese old dong", "YER" => "Yemeni Rial", "YUD" => "Yugoslav Dinar", "YUM" => "Yugoslav dinar (new)", "ZRN" => "Zairean New Zaire", "ZRZ" => "Zairean Zaire", "ZMK" => "Kwacha", "ZWD" => "Zimbabwe Dollar", "ZWC" => "Zimbabwe Rhodesian dollar");
				if (!array_key_exists($currency, $currency_codes)) {
					$currency = $view_data['core_settings']['paypal_currency'];
				}

			?>
				<form action="https://www.paypal.com/cgi-bin/webscr" id="paypal" method="post">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="<?= $view_data['core_settings']['paypal_account']; ?>">
					<input type="hidden" name="item_name" value="<?= $view_data['avoir']['reference']; ?>">
					<input type="hidden" name="item_number" value="<?= $view_data['avoir']['reference']; ?>">
					<input type="hidden" name="image_url" value="<?= base_url() ?><?= $view_data['core_settings']['invoice_logo']; ?>">
					<input type="hidden" name="amount" value="<?= $sumRest; ?>">
					<input type="hidden" name="no_shipping" value="1">
					<input type="hidden" name="no_note" value="1">
					<input type="hidden" name="currency_code" value="<?= $currency; ?>">
					<input type="hidden" name="bn" value="FC-BuyNow">
					<input type="hidden" name="return" value="<?= base_url() ?>avoir/view/<?= $view_data['avoir']['id']; ?>">
					<input type="hidden" name="cancel_return" value="<?= base_url() ?>avoir/view/<?= $view_data['avoir']['id']; ?>">
					<input type="hidden" name="rm" value="2">
					<input type="hidden" name="notify_url" value="<?= base_url() ?>paypalipn" />
					<input type="hidden" name="custom" value="avoir-<?= $sumRest; ?>">
				</form>
			<?php } ?>
		</div>
	</div>
	<br>
	</div>
</div>

<?php if ($view_data['avoir']['status'] == "Open"): ?>
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