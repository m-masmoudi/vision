<?php   
$attributes = array('class' => 'dynamic-form', 'data-reload' => 'milestones-list', 'id' => '_milestone');
echo form_open($form_action, $attributes); 
$public = "0";
?>

<?php if(isset($milestone)){ $public = $milestone->public; ?>
  <input id="id" type="hidden" name="id" value="<?php echo $milestone->id; ?>" />
<?php } ?>
 <div class="form-group">
        <label for="name"><?=$this->lang->line('application_name');?> *</label>
        <input id="name" type="text" name="name" class="form-control resetvalue" value="<?php if(isset($milestone)){echo $milestone->name;} ?>"  required/>
</div>
<div class="form-group">
        <label for="due_date"><?=$this->lang->line('application_due_date');?></label>
        <input class="form-control datepicker not-required" name="due_date" id="due_date" type="text" value="<?php if(isset($milestone)){echo $milestone->due_date;} ?>" data-date-format="yyyy-mm-dd"/>
</div>

<div class="form-group">
        <label for="textfield"><?=$this->lang->line('application_description');?></label>
        <textarea class="input-block-level summernote-modal"  id="textfield" name="description"><?php if(isset($milestone)){echo $milestone->description;} ?></textarea>
</div>
<div class="form-group">
        <label for="orderindex"><?=$this->lang->line('application_due_date');?></label>
        <input class="form-control" name="orderindex" id="orderindex" type="number" value="<?php if(isset($milestone)){echo $milestone->orderindex;} ?>" />
</div>


        <div class="modal-footer">
          <?php if(isset($milestone)){ ?>
            <a href="<?=base_url()?>projects/milestones/<?=$milestone->project_id;?>/delete/<?=$milestone->id;?>" class="btn btn-danger pull-left button-loader" ><?=$this->lang->line('application_delete');?></a>
          <?php }else{  ?>
         <a class="btn btn-default pull-left" data-dismiss="modal"><?=$this->lang->line('application_close');?></a>
        <i class="fa fa-spinner fa-spin" id="showloader" style="display:none"></i> 
        <button id="send" name="send" data-keepModal="true" class="btn btn-primary send button-loader"><?=$this->lang->line('application_save_and_add');?></button>
        <?php } ?>
        <button name="send" class="btn btn-primary send button-loader"><?=$this->lang->line('application_save');?></button>
        </div>
<?php echo form_close(); ?>