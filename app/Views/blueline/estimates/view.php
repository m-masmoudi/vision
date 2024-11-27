
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<!-- Editer -->
		<a href="<?=base_url()?>estimates/update/<?=$view_data['estimate']['id'];?>/view" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-edit visible-xs" title="Modifier"></i><span class="hidden-xs"><?=lang('application.application_edit_estimate');?></span>
		</a>
		<!-- PDF -->
		<a type="button" class="btn btn-primary" href="<?=base_url()?>estimates/preview/<?=$view_data['estimate']['id'];?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> DEVIS
		</a>
		<a type="button" class="btn btn-primary" href="<?=base_url()?>estimates/previewe/<?=$view_data['estimate']['id'];?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> ATT-DV
		</a>
			<a type="button" class="btn btn-primary" href="<?=base_url()?>estimates/previewb/<?=$view_data['estimate']['id'];?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> ATT-PRJ
		</a>
        <a href="<?=base_url()?>estimates" class="btn btn-warning right"><?=lang('application.application_devis_list');?></a>
		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="table-head"><?=lang('application.application_estimate_details');?></div>
		<div class="subcont d-flex">
			<ul class="details col-xs-12 col-sm-6">
				<li><span><?=lang('application.application_estimate_id');?>:</span> <?=$view_data['estimate']['estimate_num'];?></li>
				<li><span><?=lang('application.application_subject');?>:</span> <?php echo $view_data['estimate']['project_name']; ?> cc<?php if (empty($view_data['estimate']['subject'])) {echo "-";} else echo $view_data['estimate']['subject']?></li>
				<li><span>Etat :</span>
				<?php   
				$change_date = "";
				$change= "";
				
				?>
				<?php get_etat_color(intval($view_data['estimate']['status'])) ?>
				</li>
			
				<li><span><?=lang('application.application_issue_date');?>:</span> <?php $unix = human_to_unix($view_data['estimate']['issue_date'].' 00:00'); echo date($view_data['core_settings']['date_format'], $unix);?></li>
				<li><span><?=lang('application.application_due_date');?>:</span> <?php $unix = human_to_unix($view_data['estimate']['due_date'].' 00:00'); echo date($view_data['core_settings']['date_format'], $unix);?></li>
				<?php 
			
				if($view_data['company']['timbre_fiscal'] > 0){ 
				echo "<li><span>".lang('application.application_timbre')." : <span><br>";
				echo "<span style='color:red !important;'>".lang('application.application_exoneration_timbre')."<span></li>";} ?>
				<?php if(isset($view_data['company']['vat'])){?> 
				<?php if($view_data['company']['tva'] == 0){ ?>
				<li><span><?=lang('application.application_vat');?>:</span> <?php if (empty($view_data['company']['vat'])) {echo "-";} else echo $view_data['company']['vat'] ?></li>

				<?php } ?>
				<?php } ?>
				<?php if(isset($view_data['project'])){?>
				<li><span><?=lang('application.application_projects');?>:</span> <?php echo $project['project_num'].' : '.$project['name']; ?></li>
				<?php } ?>
				<span class="visible-xs"></span>
			</ul>
			<ul class="details col-xs-12 col-sm-6">
				<?php  if(isset($view_data['company']['name'])){ ?>	
				<li><span><?=lang('application.application_company');?>:</span> <a href="<?=base_url()?>clients/view/<?=$view_data['company']['id'];?>" class="label label-info">
				<?php echo $view_data['company']['name'] ?>
				</a>
				
				</li>
				<li><span>CONTACT PRINCIPAL:</span> 
					<?php if(isset($view_data['contact_principale']['firstname'])){ 
						echo $view_data['contact_principale']['firstname'].' '.$view_data['contact_principale']['lastname'];?> <?php }else{echo "-";} ?></li>
				<li><span><?=lang('application.application_street');?>:</span> <?php echo $view_data['company']['address'] ?></li>
				<li><span><?=lang('application.application_city');?>:</span> <?php echo $view_data['company']['city'] ?></li>

				<?php }else{ ?>
				<li><?=lang('application.application_no_client_assigned');?></li>
				<?php } ?>
				<!-- Guarantee client -->
				<?php if($view_data['company']['guarantee'] == 1){ 
				echo "<li><span>".lang('application.application_guarantee')." : <span><br>";
				echo "<span style='color:red !important;'>".'Client bénéficié de la retenue de garantie'."<span></li>";} ?>
				<!-- tva -->
				<?php if($view_data['company']['tva'] == 1){ 
				echo "<li><span>".lang('application.application_TVA')." : <span><br>";
				echo "<span style='color:red !important;'>".lang('application.application_exoneration_tva')."<span></li>";} ?>
			</ul>
			<br clear="all">
		</div>
	</div>
</div>
<div class="d-flex justify-content-end mb-2"><strong><?=lang('application.application_currency');?> : <?php echo $view_data['estimate']['currency']; ?></strong></div>
<div class="row">
	<div class="col-md-12">
		<div class="table-head">
			<?=lang('application.application_items');?>
			<span class=" pull-right">
				<a class="status-btn text-success btn-sm"><?=lang("application.application_up_to_date")?></a>
				<a href="<?=base_url()?>estimates/item/<?=$view_data['estimate']['id'];?>" class="btn btn-md btn-primary" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i>
				<span class="hidden-xs"><?=lang('application.application_add_item');?></span></a>
				<a href="<?=base_url()?>estimates/itemEmpty/<?=$view_data['estimate']['id'];?>" class="btn btn-md btn-danger" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i>
				<span class="hidden-xs"><?=lang('application.application_add_item_empty');?></span></a>
			</span>
	</div>
	<div class="table-div min-height-200 table-responsive">
		<table class="table noclick" id="items" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
			<thead>
				<th width="8%"><?=lang('application.application_action');?></th>
				<th width="1%">#</th>
				<th><?=lang('application.application_name');?></th>
				<th class="hidden-xs"><?=lang('application.application_description');?></th>
				<th class="hidden-xs" width="5%"><?=lang('application.application_unit');?></th>
				<th class="hidden-xs RightTd" width="12%"><?=lang('application.application_unit_price_ht');?></th>
				<th class="hidden-xs center" width="8%"><?=lang('application.application_quantity');?></th>
				<th class="hidden-xs RightTd" width="8%"><?=lang('application.application_discount');?></th>
				<!-- TVA-->
				<?php if($view_data['company']['tva'] == 0){?>
					<th class="hidden-xs" width="12%"><?=lang('application.application_tva');?></th>
				<?php } else {?>
					<th></th>
				<?php } ?>
				
				<th class="hidden-xs RightTd" width="12%"><?=lang('application.application_sub_total_HT');?></th>
			</thead>
			<tbody class="sortable">
			<?php $i = 0; $sum = 0;?>
			<?php foreach ($view_data['items'] as $value):?>
			<tr id="<?=$value['id'];?>" class="droppable">
			<td class="option" style="text-align:left;" width="4%">
			<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a id='delete' class='btn btn-danger po-delete' href='<?=base_url()?>estimates/item_delete/<?=$value['id'];?>/<?=$view_data['estimate']['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>
			<?php if($value['type'] != NULL ){?>
			<a href="<?=base_url()?>estimates/item_update/<?=$value['id'];?>" title="<?=lang('application.application_edit');?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit"></i></a>
			<?php }else{?>
			<a href="<?=base_url()?>estimates/item_update_empty/<?=$value['id'];?>" title="<?=lang('application.application_edit');?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit"></i></a>
			<?php } ?>
			<!-- duplicate -->
			<a href="<?=base_url()?>estimates/duplicateItemEmpty/<?=$value['id'];?>" title="<?=lang('application.application_dupliacte');?>" class="btn-option"><i class="fa fa-files-o"></i></a>
			
			</td>
            <td class="hidden-xs" width="1%"><?php echo $i+1;?></td>
			<td><?php if(!empty($value['name'])){echo $value['name'];}else{ echo $value['name']; }?></td>
			<td class="hidden-xs"><?=nl2br($value['description']);?></td>
			<td class="hidden-xs"><?=$value['unit'];?></td>
			<td class="hidden-xs RightTd"><?php echo display_money($value['value'],"",$view_data['chiffre']);?></td>
			<td class="hidden-xs center"><?=$value['amount'];?></td>
			<td class="hidden-xs RightTd"><?php echo $value['discount']."%";?></td>
			<!-- TVA-->
			<?php 
			
			if($view_data['company']['tva']== 0){?>
			<td class="hidden-xs"><?php echo $value['tva']."%";?></td>
			<?php } else {?>
			<td></td>
			<?php } ?>
			<td class="hidden-xs RightTd">
			<?php
			$total = 0;
			$totalTVA = 0;
					$SousTotal = ($value['amount'] * $value['value'] ) - ( $value['amount']* $value['value'] * $value['discount']) / 100;
					$SousTotalTVA = $SousTotal + ($SousTotal * $value['tva']) / 100;
					$totalTVA += $SousTotalTVA;
					$total += $SousTotal;
					echo display_money($SousTotal,"",$view_data['chiffre']);
					?>
			</td>
			</tr>
			<?php
		
			$sum = $sum+$view_data['items'][$i]['amount']*$view_data['items'][$i]['value']; $i++;?>
			<?php endforeach;?>
			</tbody>
			<tbody>
				<?php
			if(empty($items)){ echo "<tr><td colspan='7'>".lang('application.application_no_items_yet')."</td></tr>";}
			$discount = ($sum/100)*$view_data['estimate']['discount']; 
			$sum = $sum-$discount;
			?>
			<?php if ($discount != 0 && $sum>0){ ?>
			<tr>
			<td></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td><?=lang('application.application_discount');echo('('.$view_data['estimate']['discount'].'%)');?>  <?php if(isset($value['discountpercent'])){ echo "(".$view_data['estimate']['discount'].")";}?></td>
			<td class="RightTd">-<?=display_money($discount,"",$view_data['chiffre']);?></td>
			</tr>	
			<?php } ?>
			<?php
			$taxes = array();
			foreach ($view_data['items'] as $item) {
			if ($item['tva'] != 0) {
				$discount = ($item['amount'] * $item['value ']) - ( $item['amount']* $item['value'] * $item['discount']) / 100;
				if(!isset($value['discountpercent']))
				{
					$discount =$discount - ($discount/100)*$view_data['estimate']['discount']; 
				}
				$value = ($discount) * $item['tva'] / 100;

				if (array_key_exists ($item['tva'], $taxes)) {
					$taxes[$item['tva']] += $value;
				} else {
					$taxes[$item['tva']] = $value;
				}
				$sum = $sum + $value;
				}
			}
			?>
			
			<!-- discount-->
			<?php if(!isset($value['discountpercent'])){ 
				$discountHt = ($total/100)*$view_data['estimate']['discount']; 
				$total = $total-$discountHt; 
				$dis = ($totalTVA/100)*$view_data['estimate']['discount']; 
				$totalTVA = $totalTVA-$dis; 
			}
			?>
			<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td style="white-space:nowrap;"><?=lang('application.application_total_ht');?></td>
			<?php if($sum>0){?>
			<td class="RightTd"><?=number_format($total,$view_data['chiffre'],'.',' ');?></td>
			<?php } else {?>
			<td><?=display_money("0",'', $view_data['core_settings']['chiffre']);?></td>
			<?php } ?>
			</tr>
			<!-- TVA-->
			<?php if($view_data['company']['tva'] == 0){?>
				<?php foreach ($taxes as $tax => $value): ?>
			<tr>
				<td colspan="8"></td><td style="white-space:nowrap;"><?=lang('application.application_tax');?> (<?=$tax?>%)</td><td class="RightTd"><?=number_format($value,$view_data['chiffre'],'.',' ');?></td>
			</tr>
			<?php endforeach; ?>
			<?php } ?>
		
			<!-- retenue guarantee -->
			<?php if($view_data['company']['guarantee'] == 1){ ?>
			<tr>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				<td style="white-space:nowrap;"><?=lang('application.application_guarantee');?></td>
				<?php if ($view_data['company']['tva'] == 1) { ?>
					<td class="RightTd">
					<?php $guarantee = ($total * 10)/100; ?>
					<?=number_format($guarantee,$view_data['chiffre'],'.',' ');?>
				<?php } else { ?>
					<td class="RightTd">
					<?php $guarantee = ($totalTVA * 10)/100;?>
					<?=number_format($guarantee,$view_data['chiffre'],'.',' ');?>
				<?php } ?>
			</tr>
			<?php } ?>
			<!-- timbre fiscal-->
			<?php
		/*if($company->timbre_fiscal<1){
			
					/*display_money($view_data['estimate']->timbre_fiscal,"",$chiffre);
					$totalTVA = $totalTVA+$view_data['estimate']->timbre_fiscal;
		$total = $total +$view_data['estimate']->timbre_fiscal;}*/
			?> 
			<tr class="active">
			<td colspan="8"></td><td style="white-space:nowrap;"><?=lang('application.application_total_ttc');?></td>
			<?php if($view_data['company']['tva'] == 1){?>
				<?php if($sum>0){?>
					<?php $guarantee = ($totalTVA * 10)/100;?>
				<td class="RightTd"><?=number_format($total - $guarantee,$view_data['chiffre'],'.',' ');?></td>
				<?php }else{?>
				<td><?=display_money("0",'', $view_data['core_settings']['chiffre']);?></td>
				<?php } }  else {?>
				<?php if($sum>0){?>
				<td class="RightTd"><?=number_format($totalTVA - $guarantee,$view_data['chiffre'],'.',' ');?></td>
					<?php }else{?>
					<td><?=display_money("0",'', $view_data['core_settings']['chiffre']);?></td>
				<?php } }?>
			</tr>
			</table>
		</div>
	</div>
<!-- note -->
<?php if($view_data['estimate']['notes']){?>
<div class="col-md-12" >
	<div class="table-head"><?=lang('application.application_notes');?></div>
	<div class="subcont" id="notes">
		<ul>
		<?php echo $view_data['estimate']['notes']; ?>
		</ul>	
	</div>
</div>
<?php } ?>
		<!-- ------->
<script>
	$(document).ready(() => {
		var shadowUpdate = function() {
			var order = ""
			setTimeout(function() {
				$('.sortable').children().each(function() {
					order += $(this).attr('id') + ","
				})
				order = order.substring(0, order.length -1)
				$('.status-btn').html('<i class="fa fa-spinner fa-spin"></i> <?=lang("application.application_saving")?>')
				$.get("<?=base_url()?>api/sort_estimates?items=" + order, function(data) {
					$('.status-btn').html('<?=lang("application.application_up_to_date")?>')
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

<style>
	.sortable-highlight {
		background: #ecf0f1;
	}
</style>
<?= $this->endSection() ?>