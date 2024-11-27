<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php foreach ($view_data['submenu'] as $name=>$value):
			$badge = "";
			$active = "";
			if($value == "settings/achat"){ $badge = '<span class="badge badge-success">'.$update_count.'</span>';}
			if($name == $view_data['breadcrumb']){ $active = 'active';}?>
			   <a class="list-group-item <?=$active;?>" id="<?php $val_id = explode("/", $value); if(!is_numeric(end($val_id))){echo end($val_id);}else{$num = count($val_id)-2; echo $val_id[$num];} ?>" href="<?=site_url($value);?>"><?=$badge?> <?=lang('application.'.$name);?></a>
			<?php endforeach;?>
		</div>
	</div>

<div class="col-md-9">
<div class="row">
		<div class="span12 marginbottom20">
		<div class="table-head"><?=lang('application.application_edit_company')?></div>
		<div class="subcont">
           <?php   
			$attributes = array('class' => '', 'id' => 'user_form');
			echo form_open_multipart($view_data['form_action'], $attributes); 
			?>

<div class="form-group">
        <label for="name"><?=lang('application.application_company_name');?> *</label>
        <input id="name" type="text" name="name" class="required form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['name'];} ?>"  required/>
</div>
<div class="row">
	
    <div class="col-md-12">
        <div class="form-group">
            <label for="cnss">CNSS</label>
            <input id="cnss" type="text" name="cnss" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['cnss'];} ?>" />
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
				<label for="phone"><?=lang('application.application_phone');?></label>
				<input id="phone" type="tel" name="phone" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['phone'];} ?>" />
		</div>
	</div>
    <div class="col-md-6">	
		<div class="form-group">
				<label for="mobile"><?=lang('application.application_mobile');?></label>
				<input id="mobile" type="tel" name="mobile" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['mobile'];} ?>" />
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
				<label for="address"><?=lang('application.application_address');?></label>
				<input id="address" type="text" name="address" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['address'];} ?>" />
		</div>
	</div>
	<div class="col-md-6">	
		<div class="form-group">
				<label for="zipcode"><?=lang('application.application_zip_code');?></label>
				<input id="zipcode" type="text" name="zipcode" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['zipcode'];} ?>" />
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
        <div class="form-group">
			<label for="city"><?=lang('application.application_city');?></label>
			<input id="city" type="text" name="city" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['city'];} ?>" />
	    </div>
	</div>
	<div class="col-md-6">
        <div class="form-group">
			<label for="website"><?=lang('application.application_website');?></label>
			<input id="website" type="text" name="website" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['website'];} ?>" />
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
        <div class="form-group">
			<label for="country"><?=lang('application.application_country');?></label>
			<input id="country" type="text" name="country" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['country'];} ?>" />
	    </div>
	</div>
	<div class="col-md-6">
        <div class="form-group">
			<label for="vat"><?=lang('application.application_vat');?></label>
			<input id="vat" type="text" name="vat" class="form-control"  value="<?php if(isset($view_data['company'])){echo $view_data['company']['vat'];} ?>" />
		</div>
	</div>
</div>
<div class="form-groupe">
<img src="<?=base_url().'/files/media/'.$view_data['company']['picture']?>" width="100"  class="picture" alt="">
</div>
<div class="form-group">
	<label for="userfile"><?=lang('application.application_company_picture');?></label>
	<div>
		<div id="image"></div>
		<input id="uploadFile" type="text" name="dummy" class="form-control uploadFile" placeholder="Choose File" disabled="disabled"/>
		<div class="fileUpload btn btn-primary">
			<span><i class="fa fa-upload"></i><span class="hidden-xs"> <?=lang('application.application_select');?></span></span>
			<input id="uploadBtn" type="file" name="userfile" class="upload" />
		</div>
	</div>
</div> 
	
<div class="modal-footer">
        <input type="submit" name="send" class="btn btn-primary" value="<?=lang('application.application_save');?>"/>
        <a class="btn" data-dismiss="modal"><?=lang('application.application_close');?></a>
        </div>
<div class="alert alert-danger notification" hidden></div>
<?php echo form_close(); ?>
		<br clear="all">
		</div>
		</div>
		</div>
</div>
<!--<script>

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
 </script>-->
 <?= $this->endSection() ?>