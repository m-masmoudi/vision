<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
	<div class="col-sm-12  col-md-12 main"> 
		<div class="mb-3">

			<a href="<?=base_url()?>gestionprime/create" class="btn btn-success" data-toggle="mainmodal"><?=lang('application.application-add');?></a>

			<a href="<?=base_url()?>gestionaffecterprime" class="btn btn-default" data-toggle="mainmodal"><?=lang('application.application_prime_affecter');?></a>
<!-- 
			<a type="button" class="btn btn-success" href="<?=base_url()?>exporter/conges_as_excel"><?=lang('application.application_export')?></a> -->

			</div>
			</div>


	<div class="col-sm-12  col-md-12 main"> 

		<div class="row"> 

		<div class="table-head" style="background-color: #DE2821 ; color: white" > <img src="https://image.flaticon.com/icons/svg/180/180012.svg" width="25px"> <?=lang('application.application_liste_gestionprime');?></div>


	<div class="table-div">
		<table class="dataSorting table" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<!--<table class="data table"  rel="<?=base_url()?>" cellspacing="0" cellpadding="0">-->
		<thead>
			<th><?=lang('application.application_titre_prime');?></th>
			<th><?=lang('application.application_valeur_prime');?></th>
			<th><?=lang('application.application_cotisable');?></th>
			<th><?=lang('application.application_imposable');?></th>
			<th><?=lang('application.application_action');?></th>
		</thead>

		<?php foreach ($view_data['primes'] as $value):?>

		<tr  id="<?=$value['id'];?>" >


			<td class="hidden-xs">
				<?php if(isset($value['description'])){ echo $value['description'];}else{ echo "-";} ?>
				
				</td>

							<td class="hidden-xs">
				<?php if(isset($value['valeur'])){ echo $value['valeur'];}else{ echo "-";} ?>
				
				</td>




				<td class="hidden-xs">
				<?php 

						if($value['cotisable'] == "on")
						{
							echo ("<input type='checkbox' id='cbox1' checked='$value[cotisable]' disabled='disabled' style='background-color: #DE2821 ; color: white'>");
						}
						else
						{
							echo ("<input type='checkbox' id='cbox1' disabled='disabled' style='background-color: #DE2821 ; color: white' >");
						}

					

					 ?>
				
				</td>


				
				<td class="hidden-xs">
				<?php 


						if($value['Imposable'] == "on")
						{
							echo ("<input type='checkbox' id='cbox1' checked='$value[Imposable]' disabled='disabled'  style='background-color: #DE2821 ; color: white' >");
						}
						else
						{
							echo ("<input type='checkbox' id='cbox1' disabled='disabled' style='background-color: #DE2821 ; color: white' >");
						}


					

					 ?>
				
				</td>



			<td class="option action">

							<a 
				
				
				href="<?=base_url()?>gestionprime/affecterprime/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"
				>
				<button class="btn btn-success" type="button" style="
				background: #852B99;
				color: white">
				<i class="fa fa-edit" title="Modifier"></i>
				<?=lang('application.application_affectation');?>
					

				</button>
				</a>
			            <a href="<?=base_url()?>gestionprime/update/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit"></i></a>


				        <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>gestionprime/delete/<?=$value['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button> 
				        
			</td>

		</tr>
		<?php endforeach;?>



	 	</table>
	 	<br clear="all">		
	</div>

	<?= $this->endSection() ?>

