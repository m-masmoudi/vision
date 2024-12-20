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
					 href="<?=site_url($value);?>"><?=$badge?> <?=$name?></a>
			<?php endforeach;?>

		</div>
	</div>
	<div class="col-md-9">
		<div class="span12 marginbottom20">
			<div class="table-head">
				<?=lang('application.application_categories')?>
			</div>
			<div class="subcont">
				<div class="col-md-12">
					<!-- Choix du mois/année -->
		            <div class="form-group">
		                <label for="categorie">
		                    <div ><?=lang('application.application_ChangerCategorie');?></div>
		                </label>
		                <!-- id="categ-trigger" -->
		                <select id="categ-trigger" class="chosen-select inbox-folder" title="Inbox" >
   							<option>...</option>
	                        <?php foreach($view_data['projets_categ'] as $item):?>
		                        <option value="<?=$item['id'];?>" <?=($item['id'] == $view_data['categ_id'])?'selected':''?>>
		                            <?=$item['name'];?>
		                        </option>
		                    <?php  endforeach; ?>
		                </select>
					</div>
			    </div>
			    <?php if($view_data['categ_id']) : ?>
					<div id="tab-categ-ticket">
						<span class="pull-right">
							<a href="<?=base_url().(isset($view_data['url_add_ref'])? $view_data['url_add_ref']:'#') ?>" data-toggle="mainmodal" class="to-modal btn btn-success"><?=lang('application.application-add');?>
							</a> 
						</span>
						<table class=" table data-media dataTable no-footer" cellspacing="0" cellpadding="0" role="grid" id="sample_1">
							<thead> 
								<tr> 
									<th class="hidden-480"><?=lang('application.application_id')?></th>
									<th ><?=lang('application.application_subject')?></th>
									<th class="hidden-480"><?=lang('application.application_description')?></th>
									<th class="hidden-480"><?=lang('application.application_statut')?></th>
									<th>Actions </th>
								</tr>
							</thead>
							<tbody >
								<?php foreach ($view_data['categorie_tickets'] as $key ) : ?>
									<tr class="odd gradeX">
										<td><?=$key['id']?></td>
										<td><?=$key['name']?></td>
										<td><?=$key['description']?></td>
										<td>
											<?php if($key['status'] == '1') : ?>
												<center><span class="menu-icon"><i class="fa fa-check"></i></span></center>
											<?php  endif;?>
										</td>
										<td width="8%">
											<a href="<?=(isset($view_data['url_update_ref'])? site_url($view_data['url_update_ref'].'/'.$view_data['categ_id'].'/'.$key['id']):'#')?>" data-toggle="mainmodal" class="btn-option">
												<i class="fa fa-edit" title="Modifier"></i>
											</a>

											<button 
    type="button" 
    class="btn-option delete po" 
    data-bs-toggle="popover" 
    data-placement="left" 
    data-content="
        <a 
            class='btn btn-danger po-delete ajax-silent' 
            href='<?= isset($view_data['url_update_ref']) ? site_url($view_data['url_update_ref'] . '/' . $view_data['categ_id'] . '/' . $key['id']) : '#' ?>'>
            <?= lang('application.application_yes_im_sure'); ?>
        </a> 
        <button class='btn po-close'><?= lang('application.application_no'); ?></button> 
        <input 
            type='hidden' 
            name='td-id' 
            class='id' 
            value='<?= esc($key['id']); ?>'>" 
    data-original-title="<b><?= lang('application.application_really_delete'); ?></b>">
    <i class="fa fa-trash" title="Supprimer"></i>
</button>
										</td> 
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
				<br clear="all">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">


$('#categ-trigger').on('change',function (){
    var val = $("#categ-trigger option:selected").val(); 
    if(val){
    	window.location = "<?=site_url('projects-params/taches-par-defaut/view/') ?>"+"/"+val;
		
    }
    /**this.options[this.selectedIndex].value && (window.location = '<?=site_url('settings/ajax_selec') ?>'/"+this.options[this.selectedIndex].id);''
	var url = "<?=site_url('settings/ajax_select') ?>";
	//decodeURIComponent('../renderItem/' + name); 
	alert(url);
	$.ajax({
		type: 'POST',
		data:"categ_id="+val,
		url: url,
		success: function (response) { 
			$('#tab-categ-ticket').html(response);
		}
	});	**/
});

</script>    
<?= $this->endSection() ?>