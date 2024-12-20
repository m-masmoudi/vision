<?php   
$attributes = array('class' => '', 'id' => '_item');
echo form_open($form_action, $attributes); 
?>

<?php if(isset($subscription)){ ?>
<input id="subscription_id" type="hidden" name="subscription_id" value="<?=$subscription->id;?>" />
<?php } 
if(isset($subscription_has_items)){ ?>
<input id="id" type="hidden" name="id" value="<?=$subscription_has_items->id;?>" />
<input id="subscription_id" type="hidden" name="subscription_id" value="<?=$subscription_has_items->subscription_id;?>" />
<div class="form-group">
	<label for="name"><?=$this->lang->line('application_name');?></label>
	<input id="name" name="name" type="text" class="form-control"  value="<?php if(isset($subscription_has_items)){ echo $subscription_has_items->name; } ?>"  />
</div> 
<div class="form-group">
	<label for="value"><?=$this->lang->line('application_value');?></label>
	<input id="value" type="text" name="value" class="form-control number"  value="<?php if(isset($subscription_has_items)){ echo $subscription_has_items->value; } ?>"  />
</div> 
<div class="form-group">
	<label for="type"><?=$this->lang->line('application_type');?></label>
	<input id="type" type="text" name="type" class="form-control"  value="<?php if(isset($subscription_has_items)){ echo $subscription_has_items->type; } ?>" />
</div> 
<?php } else{ ?>
<div id="item-selector">
	<div class="form-group">
		<label for="item_id"><?=$this->lang->line('application_item');?></label><br>
		<?php $options = array(); 
		$options['-'] = '-';
		foreach ($items as $value):
		$options[$value->id] = $value->name." - ".$value->value." ".$subscription->currency;
		?><span class="hidden" id="item<?=$value->id;?>"><?=$value->description;?></span><?php
		endforeach;
		echo form_dropdown('item_id', $options, '', 'style="width:85%" class="chosen-select description-setter"');?>
		<a class="btn btn-primary tt additem" titel="<?=$this->lang->line('application_custom_item');?>"><i class="fa fa-plus"></i></a>      
	</div>
</div> 
<div id="item-editor">
	<div class="form-group">
		<label for="name"><?=$this->lang->line('application_name');?></label>
		<input id="name" name="name" type="text" class="form-control"  value=""  />
	</div> 
	<div class="form-group">
		<label for="value"><?=$this->lang->line('application_value');?></label>
		<input id="value" type="text" name="value" class="form-control number"  value=""  />
	</div> 
	<div class="form-group">
		<label for="type"><?=$this->lang->line('application_type');?></label>
		<input id="type" type="text" name="type" class="form-control"  value="" />
	</div> 
</div>
<?php } ?>

<div class="form-group">
	<label for="TVA"><?=$this->lang->line('application_taxe_tva');?></label>
	<select name="tva" id="TVA" class="chosen-select">
	<?php 
	foreach($tva as $key){
		if($key->name == $subscription_has_items->tva){?>
			<option value="<?=$key->name?>" selected><?=$key->name?>%</option>
			<?php }else{?> 
			<option value="<?=$key->name?>"><?=$key->name?>%</option>
			<?php
		}
	}?>
	</select>
</div>	
		
<div class="form-group">
	<label for="amount"><?=$this->lang->line('application_quantity_hours');?></label>
	<input id="amount" type="text" name="amount" class="form-control number"  value="<?php if(isset($subscription_has_items)){ echo $subscription_has_items->amount; }else{echo '1';} ?>"  required/>
</div> 
<div class="form-group">
	<label for="description"><?=$this->lang->line('application_description');?></label>
	<textarea id="description" class="form-control" name="description"><?php if(isset($subscription_has_items)){ echo $subscription_has_items->description; } ?></textarea>
</div>
<div class="modal-footer">
	<input type="submit" name="send" class="btn btn-primary" value="<?=$this->lang->line('application_save');?>"/>
	<a class="btn" data-dismiss="modal"><?=$this->lang->line('application_close');?></a>
</div>
<?php echo form_close(); ?>