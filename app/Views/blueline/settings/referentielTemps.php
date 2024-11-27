<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
	<?php   
		$attributes = array('class' => '', 'id' => '_company', 'autocomplete' => 'off');
		//echo form_open_multipart($form_action, $attributes); 
	?>
	<div class="span12 marginbottom20">
		<div class="table-head">
			<?=$view_data['libelle']?>
			<span class="pull-right">
				<input type="submit" name="send" class="btn btn-success" value="<?=lang('application.application_save');?>"/>
    		</span>
		</div>
		<div class="subcont">
			<table class="data-no-search table dataTable no-footer" cellspacing="0" cellpadding="0" role="grid" >
				<thead> 
					<tr> 
						<th><?=lang('application.application_libelle_occurrence')?></th>
						<th><?=lang('application.application_description_occurrence')?></th>
						<th class="hidden-480"><?=lang('application.application_statut')?></th>
					</tr>
				</thead>
				<tbody>
			   <?php foreach ($view_data['tab'] as $key ) :?>
					<tr class="odd gradeX">
						<td><?=$key->name?></td>
						<td><?=$key->description?></td>
						<td>
							<input type="radio" class="form-group" name="visible" value="<?=$key->id; ?>" <?php if($key->visible) echo "checked" ?>>
                        </td>
					</tr>
				<?php endforeach; ?>
				</tbody>
            </table>
			<br clear="all">
		</div>
	</div>
	<?php //echo form_close(); ?>
</div>
<?= $this->endSection() ?>