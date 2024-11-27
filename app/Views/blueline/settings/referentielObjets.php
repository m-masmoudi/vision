<div class="row">
	<div class="span12 marginbottom20">
		<div class="table-head">
			<?=$libelle?>
			<span class="pull-right">
				<a href="<?=base_url().(isset($url_add_ref)? $url_add_ref:'#') ?>" data-toggle="mainmodal" class="to-modal btn btn-success"><?=lang('application.application-add');?>
				</a> 
			</span>
		</div>
		<div class="subcont">
			<table class="data-no-search table dataTable no-footer" cellspacing="0" cellpadding="0" role="grid">
				<thead> 
					<tr> 
						<th><?=lang('application.application_libelle_occurrence')?></th>
						<th class="hidden-480"><?=lang('application.application_description_occurrence')?></th>
						<!--<?php if(! isset($masquer_statut)): ?>
							<th class="hidden-480"><?=lang('application.application_statut')?></th>
						<?php endif; ?> -->
						<th>Actions </th>

					</tr>
				</thead>
				<tbody>
			   <?php foreach ($tab as $key ) :?>
					<tr class="odd gradeX">
						<td><?=$key['name']?></td>
						<td><?=$key['description']?></td>
						<!--<?php if(! isset($masquer_statut)): ?>
							<td>
								<?php if(isset($key['visible'])) : ?>
									<?php if($key['visible'] == '1') :?>
										<center><span class="menu-icon"><i class="fa fa-check"></i></span></center>
									<?php  endif;?>
								<?php  endif;?>
							</td>
						<?php endif; ?> -->
						<td width="8%">
							<a href="<?=(isset($url_update_ref)? site_url($url_update_ref.'/'.$key['id']):'#')?>" data-toggle="mainmodal" class="btn-option">
								<i class="fa fa-edit" title="Modifier"></i>
							</a>

							<button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="
									 <a class='btn btn-danger po-delete ajax-silent' href='<?=base_url().(isset($url_delete_ref)? $url_delete_ref.'/'.$key['id']:'#') ?>'>
									 	<?=lang('application.application_yes_im_sure');?>
									 </a> 
									 <button class='btn po-close'><?=lang('application.application_no');?></button> 
									 <input type='hidden' name='td-id' class='id' value='<?=$key['id'];?>'>" 
							 data-original-title="<b><?=lang('application.application_really_delete');?></b>">
							 	<i class="fa fa-trash" title="Supprimer"></i>
							</button>
						</td> 
					</tr>
				<?php endforeach; ?>
				</tbody>
            </table>
			<br clear="all">
		</div>
	</div>
</div>
