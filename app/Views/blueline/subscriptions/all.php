<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
	<div class="col-sm-12  col-md-12 main">  
     <div class="mb-3">
			<a href="<?=base_url()?>subscriptions/create" class="btn btn-primary" data-toggle="mainmodal"> <?=lang('application.application_create_subscription');?></a>
			<div class="btn-group pull-right-responsive margin-right-3">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <?php $last_uri = $view_data['act_uri']; if($last_uri != "subscriptions"){echo lang('application.application_'.$last_uri);}else{echo lang('application.application_all');} ?> <span class="caret"></span>
          </button>
      </div>
		</div>
		<div class="row">
		<div class="table-head"><?=lang('application.application_subscriptions');?></div>
		<div class="table-div">
		<table class="dataSorting table" id="subscriptions" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<!--<table class="data table" id="subscriptions" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">-->
		<thead>
			<th class="hidden-xs" width="70px"><?=lang('application.application_subscription');?></th>
			<th><?=lang('application.application_client');?></th>
			<th class="hidden-xs"><?=lang('application.application_issue_date');?></th>
			<th class="hidden-xs"><?=lang('application.application_end_date');?></th>
			<th><?=lang('application.application_next_payment');?></th>
			<th class="hidden-xs"><?=lang('application.application_status');?></th>
			<th><?=lang('application.application_action');?></th>
		</thead>
		<?php foreach ($view_data['subscriptions'] as $value):?>

		<tr id="<?=$value['id'];?>" >
			<td class="hidden-xs"><?=$value['subscription_num'];?></td>
			<td><span class="label label-info"><?php if(!isset($value['company_id'])){echo lang('application.application_no_client_assigned'); 
			}else{ 
				/*$max = 10;
				 if (strlen($value->company_id->name) >= $max) {
				$chaine = substr($value->company_id->name, 0, $max).'...';
				 }else{
					$chaine = $value->company_id->name; 
				 }*echo $chaine;  */	 	
			}?></span></td>
			<td class="hidden-xs"><span><?php $unix = human_to_unix($value['issue_date'].' 00:00'); echo '<span class="hidden">'.$unix.'</span> '; echo date($view_data['core_settings']['date_format'], $unix);?></span></td>
			<td>
					<span class="label <?php if($value['status'] == "Active"){echo ' ';} 
							if($value['end_date'] <= date('Y-m-d') && $value['']!= "" && $value->status != "Inactive"){ $ended = true; echo ' label-success tt" title="'.lang('application.application_subscription_has_ended'); }elseif($value['end_date'] == ""){ echo ' label-success tt" title="'.lang('application.application_unlimited'); } ?>">
							<?php if($value['end_date']!= "" ){ $unix = human_to_unix($value['end_date'].' 00:00'); echo '<span class="hidden">'.$unix.'</span> '; echo date($view_data['core_settings']['date_format'], $unix); }else{
								echo '<i class="ion-ios-infinite row_icon"></i>';
								}?>
					</span>
			</td>
			<td class="hidden-xs"><span class="label <?php if( $value['status']== "Active" && $value['next_payment'] > date('Y-m-d')){echo 'label-success';} if($value['next_payment']< date('Y-m-d') && $value['status'] != "Inactive" && ($value['end_date'] > date('Y-m-d') || $value['end_date'] == "") ){ echo 'label-important tt" title="'.lang('application.application_new_invoice_required'); } ?>"><?php $unix = human_to_unix($value['next_payment'].' 00:00'); echo '<span class="hidden">'.$unix.'</span> '; if(($value['end_date'] < date('Y-m-d') && $value['end_date'] != "") && $value['next_payment'] > date('Y-m-d')){ echo lang('application.application_payments_closed');}else{echo date($view_data['core_settings']['date_format'], $unix);}?></span></td>
			<td><span class="label <?php if($value['status'] == "Active"){echo 'label-success';}else{echo "label-important";} ?>"><?php if(($value['end_date'] <= date('Y-m-d') && $value['end_date']!= "") && $value['status'] != "Inactive"){ echo lang('application.application_ended'); }else{ echo lang('application.application_'.$value['status']); } ?></span></td>
			 <td class="option action">
				        <a href="<?=base_url()?>subscriptions/update/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
						<a href="<?=base_url()?>subscriptions/view/<?=$value['id'];?>" class="btn-option"><i class="fa fa-eye"></i></a>
						<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>subscriptions/delete/<?=$value['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>
			       </td>
		</tr>

		<?php endforeach;?>
	 	</table>
	 	</div>
	 	</div>

		
	</div>
	<?= $this->endSection() ?>