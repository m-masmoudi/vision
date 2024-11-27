<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">

			<?php
			foreach ($view_data['submenu'] as $name=>$value):
				//var_dump($value);die;
			$badge = "";
			$active = "";
			if($value == "settings/updates" && $update_count){ $badge = '<span class="badge badge-success">'.$update_count.'</span>';}
			if($value == "settings"){ $active = 'active';}?>
			   <a class="list-group-item <?=$active;?>"
			   id="<?php $val_id = explode("/", $value); if(!is_numeric(end($val_id))){
				   echo end($val_id);}else{$num = count($val_id)-2; echo $val_id[$num];
				   } ?>" href="<?=site_url($value);?>"><?=$badge?> <?=lang('application.'.$name);?></a>
			<?php endforeach;?>

		</div>
	</div>
	<div class="col-md-9">
		<div class="table-head"><?=lang('application.application_settings');?></div>
		<?php   
		$attributes = array('class' => '', 'id' => 'settings_form');
		//echo form_open_multipart($form_action, $attributes); 
		?>
		<div class="table-div">	
			<!-- infos générale -->
			<div class="form-header"><?=lang('application.application_general_info');?></div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label><?=lang('application.application_email');?> *</label>
						<input type="email" name="email" class="required form-control" value="<?=$view_data['settings'][0]['email'];?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label><?=lang('application.application_domain');?> <button type="button" class="btn-option po pull-right" data-bs-toggle="popover" data-placement="left" data-content="URL complète de votre installation vision ERP." data-original-title="URL"> <i class="fa fa-info-circle"></i></button>
						</label>
						<input type="text" name="domain" class="required form-control" value="<?=$view_data['settings'][0]['domain'];?>" disabled required>
					</div>
				</div>
			</div>
			<!-- signataire des documents -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Signataire des documents<button type="button" class="btn-option po pull-right" data-bs-toggle="popover" data-placement="left" data-content="Nom de la personne responsable de signer les docuemnts administratifs." data-original-title="URL"> <i class="fa fa-info-circle"></i></button>
						</label>
						<input type="text" name="signataire" class="form-control" value="<?=$view_data['settings'][0]['signataire'];?>" >
					</div>
				</div>
			</div>
		
		<!-- Formats -->
		<div class="form-header"><?=lang('application.application_formats');?></div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="currency"><?=lang('application.application_default_currency');?></label>
						<div class="input-group col-md-12">
						  <select name="currency" id="currency" class="chosen-select" onchange="myFunction()">
							  <option value="<?=$view_data['settings'][0]['currency'];?>"><?=$view_data['settings'][0]['currency'];?></option>

						  </select> 
						</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="chiffre"><?=lang('application.application_chiffre_apvergule');?></label>
						<input type="number" name="chiffre" id="chiffre" min= "0" max = "5" class="form-control" value="<?=$view_data['settings'][0]['chiffre'];?>"  disabled required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="echeances"><?=lang('application.application_due_date');?></label>
						<div class="input-group col-md-12">
						  <select name="echeance" id="echeances" class="chosen-select">
						  <option value="<?=$view_data['settings'][0]['echeance'];?>"><?=lang('application.application_issue_date').' + '.$view_data['settings'][0]['echeance'].' Jours';?></option>
						
						  </select> 
						</div>
				</div>
			</div>
			<div class="col-md-6">
					<div class="form-group">
						<label><?=lang('application.application_date_format');?></label>
						 <?php $options = array(
							'Y/m/d'    => date("Y/m/d"),
							'm/d/Y' => date("m/d/Y"),
							'd/m/Y' => date("d/m/Y"));
							echo form_dropdown('date_format', $options, $view_data['settings'][0]['date_format'], 'style="width:250px" class="chosen-select"'); ?>
						
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
					<div class="form-group">
						<label><?=lang('application.application_date_time_format');?></label>
						 <?php $options = array(
							'g:i a'  => date("g:i a"),
							'H:i' => date("H:i")
							);
							echo form_dropdown('date_time_format', $options, $view_data['settings'][0]['date_time_format'], 'style="width:250px" class="chosen-select"'); ?>
						
					</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?=lang('application.application_currency_position');?></label>
					 <?php $options = array(
						'1'  => $view_data['settings'][0]['currency']." 100",
						'2' => "100 ".$view_data['settings'][0]['currency']
						);
						echo form_dropdown('money_currency_position', $options, $view_data['settings'][0]['money_currency_position'], 'style="width:250px" class="chosen-select"'); ?>
					
				</div>
			</div>
		</div>
		
			<!-- logo -->
			<div class="form-header"><?=lang('application.application_logo');?></div>
			<div class="row">
			<div class="col-md-3">
				<div class="form-group" style="padding: 20px 9px;">
					<span><?=lang('application.application_display_logo_facture');?></span><br><br>
					<div class="form-check form-switch">
						<?php if($view_data['settings'][0]['display_logo_facture']==1){ ?>
					<input class="form-check-input" type="checkbox"  name="display_logo_facture" role="switch"  checked>
						<?php	}else{ ?>  
						<input type="checkbox" name="display_logo_facture" class="form-check-input" role="switch">
					<?php  } ?>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group" style="padding: 20px 9px;">
					<span><?=lang('application.application_display_logo_devis');?></span><br><br>
					<div class="form-check form-switch">
						<?php 
						if($view_data['settings'][0]['display_logo_devis']==1){ ?>

						<input class="form-check-input" type="checkbox"  name="display_logo_devis" role="switch"  checked>
						<?php	}else{ ?>  
						<input type="checkbox" name="display_logo_devis" class="form-check-input" role="switch">
						<?php  } ?>
				
						</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group" style="padding: 20px 9px;">
					<span><?=lang('application.application_display_logo_commande');?></span><br><br>
					<div class="form-check form-switch">
						<?php if($view_data['settings'][0]['display_logo_commande']==1){ ?>
						
						<input class="form-check-input" type="checkbox"  name="display_logo_commande" role="switch"  checked>
						<?php	}else{ ?>  
						<input type="checkbox" name="display_logo_commande" class="form-check-input" role="switch">
						<?php  } ?>
					
						</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group" style="padding: 20px 9px;">
					<span><?=lang('application.application_display_logo_livraison');?></span><br><br>
					<div class="form-check form-switch">
						<?php if($view_data['settings'][0]['display_logo_livraison']==1){ ?>
						<input class="form-check-input" type="checkbox"  name="display_logo_livraison" role="switch"  checked>
						<?php	}else{ ?>  
						<input type="checkbox" name="display_logo_livraison" class="form-check-input" role="switch">
						<?php  } ?>
					</div>
				</div>
			</div>
			<!-- logo avoir -->
			<div class="col-md-3">
				<div class="form-group" style="padding: 20px 9px;">
					<span><?=lang('application.application_display_logo_avoir');?></span><br><br>
					<div class="form-check form-switch">
						<?php if($view_data['settings'][0]['display_logo_avoir']==1){ ?>
					<input class="form-check-input" type="checkbox" name="display_logo_avoir" role="switch"  checked>
					<?php	}else{ ?>  
					<input type="checkbox" name="display_logo_avoir" class="form-check-input" role="switch">
					<?php  } ?>
					
					</div>
					
				</div>
			</div>
	</div>
		<div class="form-group no-border">
			 <input type="submit" name="send" class="btn btn-primary" value="<?=lang('application.application_save');?>"/>
			
		</div>
	
	<?php //echo form_close(); ?>
	</div>
	</div>

	</div>
	<style>
	/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  margin: -13px 0;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.form-switch .form-check-input {
  width: 4rem;
  height: 2rem;
}

.form-check-input:checked {
  background-color: #28bada;
  border-color: #28bada;
}
</style>

<script>
function myFunction() {
	var currency = document.getElementById('currency').value; 
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: '/settings/chiffreDevise/' + currency,
		success: function (response) {
			if (response.indexOf('{') > -1) {
				response = response.substr(response.indexOf('{'))
			} else if (response.indexOf('[') > -1) {
				response = response.substr(response.indexOf('['))
			} else {
				response = response.substr(response.indexOf('"'))
			}
			var responsesplit = JSON.parse(response);
			document.getElementById("chiffre").value = responsesplit;
		}
	});	
}
  
</script>
<?= $this->endSection() ?>