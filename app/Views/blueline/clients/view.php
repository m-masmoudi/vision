<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
 
 <div class="row">
	<div class="col-md-8">
		<h2><?=$view_data['company']['name'];?></h2>
	</div> 	
	<div class="col-md-4">
		<a style="    margin-top: 22px;" href="<?=base_url()?>clients" class="btn btn-warning right"><?=lang('application.application_client_list');?></a>
	</div>
</div>

<div class="row">
	<div class="col-md-12 marginbottom20">
		<div class="table-head">
			<?=lang('application.application_company_details');?>
			<span class="pull-right"><a href="<?=base_url()?>clients/company/update/<?=$view_data['company']['id'];?>/view" class="btn btn-primary" data-toggle="mainmodal"><i class="icon-edit"></i> <?=lang('application.application_edit');?></a></span>
		</div>

		<div class="subcont">
	
			<ul class="details col-md-6">
				<li><span><?=lang('application.application_company_name');?>:</span> <?php echo $view_data['company']['name'] = empty($view_data['company']['name'] ) ? "-" : $view_data['company']['name'] ; ?></li>
				<li><span><?=lang('application.application_primary_contact');?>:</span> 
				<li><span><?=lang('application.application_email');?>:</span> <?php if(isset($view_data['company']['email'])){ echo $view_data['company']['email']; }else{ echo "-"; } ?></li>
				<li><span><?=lang('application.application_website');?>:</span> <?php echo $view_data['company']['website'] = empty($view_data['company']['website']) ? "-" : '<a target="_blank" href="http://'.$view_data['company']['website'].'">'.$view_data['company']['website'].'</a>' ?></li>
				<li><span><?=lang('application.application_phone');?>:</span> <?php echo $view_data['company']['phone'] = empty($view_data['company']['phone']) ? "-" : $view_data['company']['phone']; ?></li>
				<li><span><?=lang('application.application_mobile');?>:</span> <?php echo $view_data['company']['mobile'] = empty($view_data['company']['mobile']) ? "-" : $view_data['company']['mobile']; ?>
				<!-- TVA -->
				<?php if($view_data['company']['tva'] == 1){ 
				echo "<li><span>".lang('application.application_tva')." : <span><br>";
				echo "<span style='color:red !important;'>".lang('application.application_exoneration_tva')."<span></li>";} ?></li>
			</ul>

			<span class="visible-xs"></span>

			<ul class="details col-md-6">
				<?php if($view_data['company']['vat'] != ""){?>
				<li><span><?=lang('application.application_vat');?>:</span> <?php echo $view_data['company']['vat']; ?></li>
				<?php } ?>
				<li><span><?=lang('application.application_address');?>:</span> <?php echo $view_data['company']['address'] = empty($view_data['company']['address']) ? "-" : $view_data['company']['address']; ?></li>
				<li><span><?=lang('application.application_zip_code');?>:</span> <?php echo $view_data['company']['zipcode']= empty($view_data['company']['zipcode']) ? "-" : $view_data['company']['zipcode']; ?></li>
				<li><span><?=lang('application.application_city');?>:</span> <?php echo $view_data['company']['city']= empty($view_data['company']['city']) ? "-" :$view_data['company']['city']; ?></li>
				<li><span><?=lang('application.application_country');?>:</span> <?php echo $view_data['company']['country ']= empty($view_data['company']['country ']) ? "-" : $view_data['company']['country ']; ?></li>
				<?php if($view_data['company']['timbre_fiscal'] > 0){ 
				echo "<li><span>".lang('application.application_timbre')." : <span><br>";
				echo "<span style='color:red !important;'>".lang('application.application_exoneration_timbre')."<span></li>";} ?>
				<!-- Guarantee client -->
				<?php if($view_data['company']['guarantee'] == 1){ 
				echo "<li><span>".lang('application.application_guarantee')." : <span><br>";
				echo "<span style='color:red !important;'>".'Client qui bénéfici de la retenue de garantie'."<span></li>";} ?>

			</ul>
			<br clear="all">
		</div>
	</div>
</div>

<!-- Contacts clients -->		
<div class="row">
	 	<div class="col-md-12">
		
	 		
	 	<div class="data-table-marginbottom">

		<div class="table-head"><?=lang('application.application_contacts');?> <span class="pull-right"><a href="<?=base_url()?>clients/create/<?=$view_data['company']['id'];?>" class="btn btn-primary" data-toggle="mainmodal"><?=lang('application.application_add_new_contact');?></a></span></div>
		<div class="table-div">
		<table id="contacts" class="data-no-search table" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
			<th style="width:10px"></th>
			<th><?=lang('application.application_name');?></th>
			<th class="hidden-xs"><?=lang('application.application_email');?></th>
			<th class="hidden-xs"><?=lang('application.application_phone');?></th>
			<th class="hidden-xs"><?=lang('application.application_mobile');?></th>
			<th><?=lang('application.application_action');?></th>
		</thead>
		
			
          <?php foreach($view_data['contact_principale'] as $contactprinciple): ?>
		<tr id="<?=$contactprinciple['id'];?>" >
			<?php $avatar = $contactprinciple['userpic'] != 'no-pic.png' ? base_url() . "files/media/" . $contactprinciple['userpic'] : $contactprinciple['email']; ?>
			<td style="width:10px" class="sorting_disabled"><img class="minipic" src="<? //$avatar?>"/></td>
			<td><?=$contactprinciple['firstname'];?> <?=$contactprinciple['lastname'];?></td>
			<td class="hidden-xs"><?php echo $contactprinciple['email'] = empty($contactprinciple['email']) ? "-" : $contactprinciple['email']; ?></td>
			<td class="hidden-xs"><?=$contactprinciple['phone'];?></td>
			<td class="hidden-xs"><?=$contactprinciple['mobile'];?></td>

			<td class="option" style="text-align:left; text-wrap:nowrap " width="9%">
				
				<a href="<?=base_url()?>clients/update/<?=$contactprinciple['id'];?>" title="<?=lang('application.application_edit');?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
				<button type="button" class="btn-option delete po" data-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>clients/delete/<?=$contactprinciple['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$contactprinciple['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-trash" title="Supprimer"></i></button>        
			</td>
		</tr>
		<?php endforeach ?>

		
		</table>
		</div>
	</div>
	</div>
</div>

<!-- Notes à propos le client -->
<div class="row">
	<div class="col-md-6 col-xs-12 col-sm-12">
		<?php $attributes = array('class' => 'note-form', 'id' => '_notes');
		 ?>
		<div class="table-head"><?=lang('application.application_notes');?> <span class=" pull-right"><a id="send" name="send" class="btn btn-primary"><?=lang('application.application_save');?></a></span><span id="changed" class="pull-right label label-warning"><?=lang('application.application_unsaved');?></span>
		</div>
		<textarea class="input-block-level summernote-note" name="note" id="textfield" ><?=$view_data['company']['note'];?></textarea>
		</form>
	</div>
		<?php if($view_data['project_access']== TRUE){ ?>
	 	<div class="col-md-6" >
	 	<div class="data-table-marginbottom">

		<div class="table-head"><?=lang('application.application_projects');?></div>
		<div class="table-div">
		<table id="projects" class="data-no-search table" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
			<th class="hidden-xs" style="width:70px"><?=lang('application.application_project_id');?></th>
			<th><?=lang('application.application_name');?></th>
			<th><?=lang('application.application_progress');?></th>
		</thead>
		<?php foreach ($view_data['company']['projects']as $value):?>

		<tr id="<?=$value->id;?>" >
			<td class="hidden-xs" style="width:70px"><?=$core_settings->project_prefix;?><?=$value->reference;?></td>
			<td><?=$value->name;?></td>
            <td class="hidden-xs"><div class="progress progress-striped active progress-medium tt <?php if($value->progress== "100"){ ?>progress-success<?php } ?>" title="<?=$value->progress;?>%">
                      <div class="bar" style="width:<?=$value->progress;?>%"></div>
                </div></td>
		</tr>

		<?php endforeach;?>
		</table>
		<?php if(!$view_data['company']->projects) { ?>
        <div class="no-files">  
            <i class="fa fa-lightbulb-o"></i><br>
            
            <?=lang('application.application_no_projects_yet');?>
        </div>
         <?php } ?>
		</div>
		</div>
		</div>
		<?php } ?>
		<?php if($view_data['invoice_access']== TRUE){ ?>
		<div class="col-md-6">
	 	<div class="data-table-marginbottom">
		<div class="table-head"><?=lang('application.application_invoices');?></div>
		<div class="table-div">
		<table id="invoices" class="data-no-search table" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
			<th width="70px"><?=lang('application.application_invoice_id');?></th>
			<th class="hidden-xs"><?=lang('application.application_issue_date');?></th>
			<th class="hidden-xs"><?=lang('application.application_due_date');?></th>
			<th><?=lang('application.application_status');?></th>
		</thead>
		<?php foreach ($invoices as $value):?>

		<tr id="<?=$value->id;?>" >
			<td><?=$core_settings->invoice_prefix;?><?=$value->reference;?></td>
			<td class="hidden-xs"><span class="label"><?php $unix = human_to_unix($value->issue_date.' 00:00'); echo date($core_settings->date_format, $unix);?></span></td>
			<td class="hidden-xs"><span class="label <?php if($value->status == "Paid"){echo 'label-success';} if($value->due_date <= date('Y-m-d') && $value->status != "Paid"){ echo 'label-important tt" title="'.lang('application.application_overdue'); } ?>"><?php $unix = human_to_unix($value->due_date.' 00:00'); echo date($core_settings->date_format, $unix);?></span></td>
			<td><span class="label <?php $unix = human_to_unix($value->sent_date.' 00:00'); if($value->status == "Paid"){echo 'label-success';}elseif($value->status == "Sent"){ echo 'label-warning tt" title="'.date($core_settings->date_format, $unix);} ?>"><?=lang('application.application_'.$value->status);?></span></td>
		</tr>
		<?php endforeach;?>
		</table>
		<?php if(!$view_data['company']->invoices) { ?>
        <div class="no-files">  
            <i class="fa fa-file-text"></i><br>
            
            <?=lang('application.application_no_invoices_yet');?>
        </div>
         <?php } ?>
		</div>
		</div>
		</div>
		<?php } ?>
		</div>


<div class="row">
	<?php //var_dump($this->user);exit; ?>
	<!-- liste des devis -->
	<div class="col-md-6">
		<div class="table-head"><?=lang('application.application_estimate');?></div>
		<div class="table-div">
			<table class="data-devFact table" id="estimates" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
				<thead>
					<th width="70px" class="hidden-xs"><?=lang('application.application_estimate_id');?></th>
					<th class="hidden-xs"><?=lang('application.application_issue_date');?></th>
					<th class="hidden-xs"><?=lang('application.application_total');?></th>
					
				</thead>
				<?php
				foreach ($view_data['estimates'] as $value):
					$change_date = "";				
					?>
					<tr id="<?=$value->id;?>" >
						<td class="hidden-xs"><?php echo $value->estimate_num;?></td>
						<td class="hidden-xs"><span><?php $unix = $value->issue_date.' 00:00'; echo '<span class="hidden">'.$unix.'</span> ';?></span></td>
						<td class="hidden-xs"><?=sprintf("%01.2f", round($value->sum, 2),$value->currency,$view_data['core_settings']['chiffre']);?></td>
						
					</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
	
	<?php  if($view_data['invoice_access'] == true ){ ?>
	<!-- liste des factures -->	
	<div class="col-md-6">
		<div class="table-head"><?=lang('application.application_invoice');?></div>
		<div class="table-div">
			<table class="data-devFact table" id="estimates" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
				<thead>
					<th width="70px" class="hidden-xs"><?=lang('application.application_estimate_id');?></th>
					<th class="hidden-xs"><?=lang('application.application_issue_date');?></th>
					<th class="hidden-xs"><?=lang('application.application_total');?></th>
					<th><?=lang('application.application_status');?></th>
				</thead>
				<?php
				foreach ($invoices as $value):
					$change_date = "";				
					switch ($value->invoice_status) {
						case "Open": $label = "label-default"; break;
						case "Accepted": $label = "label-success"; $change_date = 'title="'.lang('application.application_Accepted').' le '.date($core_settings->date_format, human_to_unix($value->estimate_accepted_date.' 00:00')).'"'; break;
						case "Sent": $label = "label-warning"; $change_date = 'title="'.lang('application.application_Sent').' le '.date($core_settings->date_format, human_to_unix($value->estimate_sent.' 00:00')).'"'; break; 
						case "Declined": $label = "label-important"; $change_date = 'title="'.lang('application.application_Declined').' le '.date($core_settings->date_format, human_to_unix($value->estimate_accepted_date.' 00:00')).'"'; break;
						case "Invoiced": $label = "label-chilled"; $change_date = 'title="'.lang('application.application_Invoiced').' le '.date($core_settings->date_format, human_to_unix($value->estimate_accepted_date.' 00:00')).'"'; break;
						case "Revised": $label = "label-warning"; $change_date = 'title="'.lang('application.application_Revised').' le '.date($core_settings->date_format, human_to_unix($value->estimate_accepted_date.' 00:00')).'"'; break;
						default: $label = "label-default"; break;
					} ?>
					<tr id="<?=$value->id;?>" >
						<td class="hidden-xs"><?=$value->estimate_num;?></td>
						<td class="hidden-xs"><span><?php $unix = human_to_unix($value->issue_date.' 00:00'); echo '<span class="hidden">'.$unix.'</span> '; echo date($core_settings->date_format, $unix);?></span></td>
						<td class="hidden-xs"><?=display_money(sprintf("%01.2f", round($value->sum, 2)),$value->currency,$core_settings->chiffre);?></td>
						<td><span class="label  <?=$label?> tt" <?=$change_date;?>><?=lang('application.application_'.$value->estimate_status);?></span></td>
					</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
	<?php } ?>
</div>

<?= $this->endSection() ?>