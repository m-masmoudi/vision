<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="col-sm-12  col-md-12 main"> 
	<!-- Titre de la page -->
	<div class="row tile-row">
		<div class="col-md-2 col-xs-12 tile blue" style="padding-right: 10px !important;
    padding-left: 10px !important;"><h1><span>clients passagers</span></h1></div>
	</div>
	<!-- Boutons d'actions -->
	<div class="row">
		<a href="<?=base_url()?>clients/company/create" class="btn btn-primary" data-toggle="mainmodal"><?=lang('application.application_add_client');?></a>
		<a type="button" class="btn btn-success" href="<?=base_url()?>exporter/clients_as_excel/passagers"><i class="fa fa-file-excel-o"></i> <?=lang('application.application_export')?></a>
		
		<a type="button" class="btn btn-info" href="<?=base_url()?>clients/clients">Clients</a>
	</div>
	<!-- tableau -->
	<div class="row">
		<div class="table-head"> <?=lang('application.application_companies');?></div>
			<div class="table-div">
		<table class="dataSorting table" id="clients" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
			<th class="hidden-xs" style="width:70px"><?=lang('application.application_quotation_id');?></th>
			<th><?=lang('application.application_company_name');?></th>
			<th><?=lang('application.application_action');?></th>
		</thead>
		<?php foreach ($view_data['companies'] as $value):?>
			<?php if ($value['passager'] == 1){ ?>
				<tr  id="<?=$value['id'];?>" ><td class="hidden-xs" style="width:70px"><?=$view_data['core_settings']['company_prefix'];?><?php if(isset($value->reference)){ echo sprintf("%04d",$value->reference);} ?></td>			
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
					<td class="option action">
						<!-- passer le client à persistant -->
						<a href="<?=base_url()?>clients/company/passToPersistent/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"
						data-toggle="tooltip" title="Persistez client !"><i class="fa fa-database"></i>
						</a>
						<a href="<?=base_url()?>clients/company/update/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i>
						</a>
						<a href="<?=base_url()?>clients/view/<?=$value['id'];?>" class="btn-option" ><i class="fa fa-eye"></i>
						</a>
						<button type="button" class="btn-option delete po" data-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>clients/company/delete/<?=$value['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="supprimer"></i>
						</button>
								
					</td>
				</tr>
			<?php } ?>
		<?php endforeach;?>
	 	</table>
	 	<br clear="all">		
	</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?= $this->endSection() ?>