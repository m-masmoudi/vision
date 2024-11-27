
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php foreach ($view_data['submenu'] as $name=>$value):
			$badge = "";
			$active = "";
			if($value == "settings/achat"){ $badge = '<span class="badge badge-success">'.$update_count.'</span>';}
			if($name == $view_data['breadcrumb']){ $active = 'active';}?>
			   <a class="list-group-item <?=$active;?>" id="<?php $val_id = explode("/", $value); if(!is_numeric(end($val_id))){echo end($val_id);}else{$num = count($val_id)-2; echo $val_id[$num];} ?>" href="<?=site_url($value);?>"><?=$badge?> <?=lang('application.'.$name)?></a>
			<?php endforeach;?>
		</div>
	</div>

<div class="col-md-9">
<div class="row">	
	<div class="subcont">
	   <?php   
		$attributes = array('class' => '', 'id' => 'user_form');
		echo form_open_multipart($view_data['form_action'], $attributes); 
		?>
	<!-- Banque -->
	<div class="col-md-12">
		<div class="row">
			<div class="span12 marginbottom20">
				<div class="table-head"><?=lang('application.application_compte_bancaire')?><span class="pull-right"><a href="<?=base_url()?>settings/ajoutCompteBancaire" data-toggle="mainmodal" class="btn btn-success"><?=lang('application.application-add');?></a> </span></div>
				<div class="subcont">
					<table class="data-no-search table dataTable no-footer" cellspacing="0" cellpadding="0" role="grid" id="sample_1">
						<thead> 
							<tr> 
								<th><?=lang('application.application_name_bank');?></th>
								<th><?=lang('application.application_RIB');?></th>
								<th><?=lang('application.application_adress');?></th>
								<th><?=lang('application.application_default_compte_bancaire');?></th>
								<th>Actions </th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($view_data['compteBancaire'] as $key ) {
								if($key['visible'] == 1){	?>
							<tr class="odd gradeX">
								<?php                                              
								echo("<td>".$key['nom']."</td>");
								echo("<td width='50%'>".$key['RIB']."</td>");
								echo("<td width='50%'>".$key['adr_banque']."</td>"); ?>
								<?php if( $key['id']){ ?>
									<td><center><span class="menu-icon">
									<i class="fa fa-check"></i></span></center></td>
								<?php }else { ?>
									<td></td>
								<?php }
								
								echo('<td width="8%"><a href="editCompteBancaire/'.$key['id'].'" data-toggle="mainmodal" class="btn-option"><i class="fa fa-edit" title="Modifier"></i></a>');
								?> 
								<!-- pdf RIB-->
								<a target="_blank" href="<?=base_url()?>settings/compteBancairePreview/<?=$key['id'];?>/show" class="btn-option"><i class="" title="PDF"><img src="<?=base_url()?>assets/blueline/images/pdf.png" alt=""></i></a>
								 <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>settings/deleteCompteBancaire/<?=$key['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$key['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>
								 
							</tr>
						<?php } } ?>
						</tbody>
					</table>
					<br clear="all">
				</div>
			</div>
		</div>
	</div>
		<!-- ------------->
	<div class="modal-footer">
		<!--	<input type="submit" name="send" class="btn btn-primary" value="<?=lang('application.application_save');?>"/>
			<a class="btn" data-dismiss="modal"><?=lang('application.application_close');?></a>
	</div>
		<div class="alert alert-danger notification" hidden></div>
			<?php echo form_close(); ?>
			<br clear="all">
		</div>
		!-->
	</div>
	</div>
</div>
<script>
$('#uploadBtn').on('change', function(){     
	var _URL = window.URL || window.webkitURL;
	img = new Image();
	file=$('#uploadBtn')[0].files[0];
	img.src = _URL.createObjectURL(file);
	img.onload = function() {
	if(img.height>200 && img.width>200){
		$(".notification").fadeIn(3000).html("La taille de votre image est trop élevée");
		$( ":input[type=submit]" ).prop( "disabled", true );
	}else{
	    $(".notification").fadeOut(3000);
		//document.getElementById("image").innerHTML="<img src='images/be-drapeau.jpg'>";
         $( ":input[type=submit]" ).prop( "disabled", false );
		}
    }
 });
</script>
 
 
<script>
	
 
</script>
<?= $this->endSection() ?>