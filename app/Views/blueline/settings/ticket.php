<div id="row">
	
		<div class="col-md-3">
			<div class="list-group">
				<?php foreach ($submenu as $name=>$value):
				$badge = "";
				$active = "";
				if($value == "settings/updates"){ $badge = '<span class="badge badge-success">'.$update_count.'</span>';}
				if($name == $breadcrumb){ $active = 'active';}?>
	               <a class="list-group-item <?=$active;?>" id="<?php $val_id = explode("/", $value); if(!is_numeric(end($val_id))){echo end($val_id);}else{$num = count($val_id)-2; echo $val_id[$num];} ?>" href="<?=site_url($value);?>"><?=$badge?> <?=$name?></a>
	            <?php endforeach;?>
			</div>
		</div>


<div class="col-md-9">
		<?php if(!$imap_loaded){ ?>
		<div class='alert alert-danger'><i class="fa fa-exclamation-circle"></i> Your server is missing the php_imap extension! Please contact your web host in order to activate this php extension.</div>
		<?php } ?>
		<div class="table-head"><?=$this->lang->line('application_email');?> <?=$this->lang->line('application_settings');?></div>
		<div class="table-div">
		<?php   
		$attributes = array('class' => '', 'id' => 'ticket');
		echo form_open_multipart($form_action, $attributes); 
		?>

<br>
		<div class="form-group tt" title="<?=$this->lang->line('application_postmaster_help');?>">
		<label><?=$this->lang->line('application_postmaster_active');?></label>
	     <input name="ticket_config_active" type="checkbox" class="checkbox" data-labelauty="<?=$this->lang->line('application_postmaster_active');?>"  value="1" <?php if($settings->ticket_config_active == "1"){ ?> checked="checked" <?php } ?>>
        </div>
		
		
		<div class="form-group">
		<label><?=$this->lang->line('application_imap_or_pop');?></label>
	      <input name="ticket_config_imap" type="radio" class="checkbox" data-labelauty="<?=$this->lang->line('application_imap');?>"  value="1" <?php if($settings->ticket_config_imap == "1"){ ?> checked="checked" <?php } ?>>
	      <input name="ticket_config_imap" type="radio" class="checkbox" data-labelauty="<?=$this->lang->line('application_pop3');?>"  value="0" <?php if($settings->ticket_config_imap == "0"){ ?> checked="checked" <?php } ?>>
        </div>
		
		
		
		<div class="form-group">
		<label><?=$this->lang->line('application_ssl');?></label>
	        <input name="ticket_config_ssl" type="checkbox" class="checkbox" data-labelauty="<?=$this->lang->line('application_ssl');?>"  value="1" <?php if($settings->ticket_config_ssl == "1"){ ?> checked="checked" <?php } ?>>
        </div>
		
		

		<div class="form-group tt" title="<?=$this->lang->line('application_delete_from_mailbox_help');?>">
		<label><?=$this->lang->line('application_delete_from_mailbox');?></label>
	        <input name="ticket_config_delete" type="checkbox" class="checkbox" data-labelauty="<?=$this->lang->line('application_delete_from_mailbox');?>"  value="1" <?php if($settings->ticket_config_delete == "1"){ ?> checked="checked" <?php } ?>>
        </div>
		
		

		<div class="form-group">
			<label><?=$this->lang->line('application_email');?></label>
			<input type="text" class="form-control" name="ticket_config_email" value="<?=$settings->ticket_config_email;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_host');?></label>
			<input type="text" class="form-control" name="ticket_config_host" value="<?=$settings->ticket_config_host;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_username');?></label>
			<input type="text" class="form-control" name="ticket_config_login" value="<?=$settings->ticket_config_login;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_password');?></label>
			<input type="password" class="form-control" name="ticket_config_pass" value="<?=$settings->ticket_config_pass;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_port');?> (143 or 110) (Gmail: 993)</label>
			<input type="text" class="form-control" name="ticket_config_port" value="<?=$settings->ticket_config_port;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_mailbox');?> (Gmail: INBOX)</label>
			<input type="text" class="form-control" name="ticket_config_mailbox" value="<?=$settings->ticket_config_mailbox;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_additional_flags');?> (/notls or /novalidate-cert) (Gmail: /novalidate-cert)</label>
			<input type="text" class="form-control" name="ticket_config_flags" value="<?=$settings->ticket_config_flags;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_imap_search');?> <a class="cursor po" rel="popover" data-bs-toggle="popover" data-placement="right" data-content="<?=$this->lang->line('application_imap_search_help');?>" data-original-title="<?=$this->lang->line('application_imap_search');?>"><i class="ion-help-circled"></i></a></label>
			<input type="text" class="form-control" name="ticket_config_search" value="<?=$settings->ticket_config_search;?>">
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_postmaster_address');?>  <a class="cursor po" rel="popover" data-bs-toggle="popover" data-placement="right" data-content="<?=$this->lang->line('application_postmaster_help');?>  <a target='_blank' href='https://luxsys.helpscoutdocs.com/article/16-cronjob-configuration'>More help!</a>" data-original-title="<?=$this->lang->line('application_postmaster_address');?>"><i class="ion-help-circled"></i></a></label><br>
			<small style="padding-left:10px"> 
				<span class="tag">wget <?=base_url()?>postmaster</span>
			</small>
		</div>

		<div class="form-group">
			<label><?=$this->lang->line('application_last_postmaster_run');?></label>
			<small style="padding-left:10px"> <br>
				<span class="tag tag--grey"><?php if(!empty($settings->ticket_config_timestamp)){echo date("Y-m-d H:i", $settings->ticket_config_timestamp); }else {echo "The postmaster has not been executed yet! Check your postmaster cronjob!";}?></span>
			</small>
		</div>

		<div class="form-group no-border">
			 <input type="submit" name="send" class="btn btn-primary" value="<?=$this->lang->line('application_save');?>"/>
			 <a href="<?=base_url()?>settings/testpostmaster" class="btn btn-success" data-toggle="mainmodal"><?=$this->lang->line('application_postmaster_test');?></a>
	
	 	 
			 </div>
			 <br>
		</div>
		<br>

		<div class="table-head"><?=$this->lang->line('application_ticket');?> <?=$this->lang->line('application_settings');?></div>
		<div class="table-div">
<br>
		<div class="form-group">
        <label><?=$this->lang->line('application_ticket_default_status');?></label>
        
        <?php $options = array(); 
                $options['new'] = $this->lang->line('application_ticket_status_new');
                $options['open'] = $this->lang->line('application_ticket_status_open');
                $options['inprogress'] = $this->lang->line('application_ticket_status_inprogress');
                $options['reopened'] = $this->lang->line('application_ticket_status_reopened');
                $options['onhold'] = $this->lang->line('application_ticket_status_onhold');
                $options['closed'] = $this->lang->line('application_ticket_status_closed');

        if(isset($settings->ticket_default_status)){$status = $settings->ticket_default_status;}else{$status = "";}
        echo form_dropdown('ticket_default_status', $options, $status, 'style="width:100%" class="chosen-select"');?>
		</div>

		<div class="form-group"> 

        <label><?=$this->lang->line('application_ticket_default_type');?></label>
        
        <?php $options = array();
                foreach ($types as $value):  
                $options[$value->id] = $value->name;
                endforeach;
        if(isset($settings->ticket_default_type)){$type = $settings->ticket_default_type;}else{$type = "";}
        echo form_dropdown('ticket_default_type', $options, $type, 'style="width:100%" class="chosen-select"');?>
		 </div>

		<div class="form-group">
        <label><?=$this->lang->line('application_ticket_default_owner');?></label>
        
        <?php $options = array(); 
               foreach ($owners as $value):  
                $options[$value->id] = $value->firstname.' '.$value->lastname;
                endforeach;

        if(isset($settings->ticket_default_owner)){$owner = $settings->ticket_default_owner;}else{$owner = "";}
        echo form_dropdown('ticket_default_owner', $options, $owner, 'style="width:100%" class="chosen-select"');?>
		 </div>

		<div class="form-group">
        <label><?=$this->lang->line('application_ticket_default_queue');?></label>
        
        <?php $options = array(); 
               foreach ($queues as $value):  
                $options[$value->id] = $value->name;
                endforeach;

        if(isset($settings->ticket_default_queue)){$queue = $settings->ticket_default_queue;}else{$queue = "";}
        echo form_dropdown('ticket_default_queue', $options, $queue, 'style="width:100%" class="chosen-select"');?>
		 </div>

		<div class="form-group no-border">
			 <input type="submit" name="send" class="btn btn-primary" value="<?=$this->lang->line('application_save');?>"/>
		</div>
	
	 	 
		<?php echo form_close(); ?>
		</div>
<br>

	<div class="table-head"><?=$this->lang->line('application_types');?><span class="pull-right"><a href="<?=base_url()?>settings/ticket_type" class="btn btn-primary" data-toggle="mainmodal"><?=$this->lang->line('application_add_type');?></a></span></div>
			<div class="table-div">
			<table class="table" id="types" cellspacing="0" cellpadding="0">
			<thead>
				<th><?=$this->lang->line('application_name');?></th>
				<th><?=$this->lang->line('application_description');?></th>
				<th><?=$this->lang->line('application_action');?></th>
			</thead>
			<?php foreach ($types as $value):?>

			<tr id="t<?=$value->id;?>" >
				<td><?=$value->name;?></td>
				<td><?=$value->description;?></td>
				
				<td class="option" width="8%">
				        <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>settings/ticket_type/<?=$value->id;?>/delete'><?=$this->lang->line('application_yes_im_sure');?></a> <button class='btn po-close'><?=$this->lang->line('application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value->id;?>'>" data-original-title="<b><?=$this->lang->line('application_really_delete');?></b>"><i class="fa fa-times"></i></button>
				        <a href="<?=base_url()?>settings/ticket_type/<?=$value->id;?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
			</td>
			

			<?php endforeach;?>
		 	</table>
		 
	</div>


	<div class="table-head"><?=$this->lang->line('application_queues');?> <span class="pull-right"><a href="<?=base_url()?>settings/ticket_queue" class="btn btn-primary" data-toggle="mainmodal"><?=$this->lang->line('application_add_queue');?></a></span></div>
			<div class="table-div">
			<table class="table" id="queues" cellspacing="0" cellpadding="0">
			<thead>
				<th><?=$this->lang->line('application_name');?></th>
				<th><?=$this->lang->line('application_description');?></th>
				<th><?=$this->lang->line('application_action');?></th>
			</thead>
			<?php foreach ($queues as $value):?>

			<tr id="q<?=$value->id;?>" >
				<td><?=$value->name;?></td>
				<td><?=$value->description;?></td>
				
				<td class="option" width="8%">
				        <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>settings/ticket_queue/<?=$value->id;?>/delete'><?=$this->lang->line('application_yes_im_sure');?></a> <button class='btn po-close'><?=$this->lang->line('application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value->id;?>'>" data-original-title="<b><?=$this->lang->line('application_really_delete');?></b>"><i class="fa fa-times"></i></button>
				        <a href="<?=base_url()?>settings/ticket_queue/<?=$value->id;?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
			</td>
			

			<?php endforeach;?>
		 	</table>
	</div>


	 	<br clear="all">



	
	</div>
	</div>