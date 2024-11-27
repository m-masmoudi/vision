<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php foreach ($view_data['submenu'] as $name=>$value): 
				$badge = "";
				$active = "";
				
				if($value == $view_data['breadcrumb']){ $active = 'active';}?>
				   <a class="list-group-item <?=$active;?>"
				   id="<?php $val_id = explode("/", $value);
					    if(!is_numeric(end($val_id))):
						   echo end($val_id);
						else: 
							$num = count($val_id)-2; echo $val_id[$num];
						endif ?>"
					 href="<?=site_url($value);?>"><?=$badge?> <?=lang('application.'.$name)?></a>
			<?php endforeach;?>

		</div>
	</div>
	<div class="col-md-9">
		<?php view('blueline/settings/referentielObjets', $view_data['refTab']['MoyensPaiement'])?>
		
		<!-- TVA -->
		<div class="row">
		<div class="span12 marginbottom20">
			<div class="table-head"><?=lang('application.application_taxe_tva')?><span class="pull-right"><a href="<?=base_url()?>settings/ajoutTaxe" data-toggle="mainmodal" class="btn btn-success"><?=lang('application.application-add');?></a> </span></div>
				<div class="subcont">
				<table class="data-no-search table dataTable no-footer" cellspacing="0" cellpadding="0" role="grid" id="sample_1">
					<thead> 
						<tr> 
							<th>Libelle de l'occurrence du référentiel</th>
							<th class="hidden-480">Description</th>
							<th class="hidden-480"><?=lang('application.application_default_taxe')?></th>
							<th>Actions </th>
	
						</tr>
					</thead>
					<tbody>
						
				   <?php foreach ($view_data['taxe'] as $key ) {
						?>
						<tr class="odd gradeX">
							 <?php
							echo("<td>".$key['name']."%</td>");
							echo("<td>".$key['description']."</td>"); 
							if($key['id']){ ?>
								<td><center><span class="menu-icon"><i class="fa fa-check"></i></span></center></td>
							<?php }else { ?>
								<td></td>
							<?php } 
							 echo('<td width="8%"><a href="editTaxe/'.$key['id'].'" data-toggle="mainmodal" class="btn-option"><i class="fa fa-edit" title="Modifier"></i></a>');
					?>
					<?php $itemid=$key['id'] ?>
					<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>settings/deleteTaxe/<?=$itemid;?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$itemid;?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>
					</tr>
					<?php } ?>
					</tbody>
                </table>
				<br clear="all">
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>