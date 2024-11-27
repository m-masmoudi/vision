<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="col-sm-12  col-md-12 main"> 
	<!-- Titre de la page -->
	<div class="row tile-row">
		<div class="col-md-2 col-xs-12 tile blue"><h1><span>Clients</span></h1></div>
	</div>
	<!-- Boutons d'actions -->
	<div class="d-flex align-items-center gap-4 mb-2">
		<a href="<?=base_url()?>clients/company/create" class="btn btn-primary px-3" data-toggle="mainmodal"><?=lang('application.application_add_client');?></a>
		<a type="button" class="btn btn-success px-3" href="<?=base_url()?>exporter/clients_as_excel"><i class="fa fa-file-excel-o"></i> <?=lang('application.application_export')?></a>
		
		<a type="button" class="btn btn-info px-3" href="<?=base_url()?>clients/ClientPassager"><?=lang('application.application_clients_passagers')?></a>
	</div>
	<!-- tableau -->
	<div class="row">
		<div class="table-head"><?=lang('application.application_clients');?></div>
			<div class="table-div">
				<table class="dataSorting table" id="clients" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
					<thead>
				<th class="" style="width:70px"><?=lang('application.application_quotation_id');?></th>
				<th><?=lang('application.application_company_name');?></th>
				<th class=""><?=lang('application.application_primary_contact');?></th>
				<th class=""><?=lang('application.application_email');?></th>
				<th class=""><?=lang('application.application_website');?></th>
				<th><?=lang('application.application_action');?></th>
			</thead>

			
			
			<?php foreach ($view_data['companies'] as $value):?>
				


				
			
			
				
					<tr  id="<?=$value['company_id'];?>" >.
						

						<!-- id -->
						<td class="" style="width:70px"><?=$view_data['core_settings']['company_prefix'];?><?php if(isset($value['company_id'])){ echo sprintf("%04d",$value['company_id']);} ?></td>			
						<!-- Nom -->
						<td>
						 <span class="label label-info">
							 <?php 
									$max = 40;
										 if (strlen($value['name']) >= $max) {
										$chaine = substr($value['name'], 0, $max).'...';
										 }else{
											$chaine = $value['name']; 
										 }
										 echo $chaine;
							 ?>
						 </span>
						</td>
						<!-- contact -->
						<td class=""><?php if(isset($value['firstname'])){ echo $value['firstname'].$value['lastname'];}else{ echo "-";} ?></td>
						<td class=""><?php if(isset($value['email'])){ echo $value['email'];}else{ echo "-";}?></td>
						<td class=""><?php echo $value['website'] = empty($value['website'] ) ? "-" : '<a target="_blank" href="http://'.$value['website'].'">'.$value['website'].'</a>' ?></td>
						<td class="option action">
									<a href="<?=base_url()?>clients/company/update/<?=$value['company_id'];?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
									<a href="<?=base_url()?>clients/view/<?=$value['company_id'];?>" class="btn-option" ><i class="fa fa-eye"></i></a>
									<button type="button" class="btn-option delete po" data-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>clients/company/delete/<?=$value['company_id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['company_id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>

						</td>
					</tr>
			
			<?php endforeach;?>
			</table>
			<br clear="all">		
		</div>
	</div>
</div>
<?= $this->endSection() ?>