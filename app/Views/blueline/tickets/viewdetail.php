<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row tab-pane active" role="tabpanel" id="projectdetails-tab">
   <div class="col-xs-12 col-md-3">
	 	<div class="table-head"><?=lang('application.application_ticket_details');?>
		 <div class="col-md-1 col-xs-6" style="float:right;  ">
				<a style=""  href="<?=base_url()?>ctickets/editTicket/<?=$view_data['ticket']['id'];?>" data-toggle="mainmodal" title="Modifier la tâche " data-target="#mainModal"><i class='fa fa-edit' aria-hidden='true'></i></a>
				</div>
		 </div>

			<div class="subcont">
				<!-- Détail du projet -->
				<ul class="details">
				<?php

use App\Models\ProjectModel;                            
use App\Models\RefTypeOccurencesModel ;                                       
use App\Models\ProjectHasSubProjectModel;                           

 $lable = ""; 
				//var_dump($view_data['ticket']->from);?>

				<!-- Projet -->
					<li><span><?=lang('application.application_project');?> 
					</span>
						<?php

				         
						if(!isset($view_data['ticket']['project_id']['name'])): ?> 	
							<a  data-toggle="tooltip" title="<?php echo$view_data['ticket']['project_id']["name"] ?>" href="#" class="label label-info"><?php echo lang('application.application_no_project_assigned');  ?>
						</a>
						<?php else : ?>
							<a data-toggle="tooltip" data-placement="left" title="<?php echo $view_data['ticket']['project_id']["name"] ?>" class="label label-info"
							href="<?=base_url() .'projects/view/'.$view_data['ticket']['project_id']['id']?>">
							<?php echo $view_data['ticket']['project_id']['project_num'].'--'.$view_data['ticket']['project_id']['name']; ?>
							</a>
						<?php endif; ?>
					</li> 

			<!-- Sous Projet -->
			<?php 
			?>
					<li><span><?=lang('application.application_sous_projets');?> </span>
						<?php 
					
						if(isset( $view_data['ticket']['sub_project_id'])): ?> 
					
							<a  data-toggle="tooltip" title="<?php echo $view_data['ticket']['sub_project_id']['name']?>" href="#" class="label label-warning">
								<?php echo lang('application.application_no_project_assigned'); ?>
							</a>
						
						<?php endif;  ?>
					</li>

					<li>
    <span>Priorité</span>
    <span class="label label-important <?= esc($lable) ?>">
        <?php 
        $referentiels = new \App\Models\RefTypeOccurencesModel();
        $priorityName = $referentiels->getReferentielsById($view_data['ticket']['priority'])['name'] ?? 'N/A';
        echo esc($priorityName);
        ?>
    </span>
</li>

					<li><span><?=lang('application.application_status');?></span> 
						<span class="label <?php echo $lable; ?>"><?=$view_data['ticket']['status'];?></span>
					</li>
					<li><span><?=lang('application.application_etat');?></span>
					<?php
					$referentiels=new RefTypeOccurencesModel();
					?>
						<span class="label <?php echo $lable; ?>"><?=$referentiels->getReferentielsById($view_data['ticket']['etat_id'])['name'];?></span>
					</li>	
					<li ><span>Date début</span> <?php $unix = human_to_unix($view_data['ticket']['start'].' 00:00'); echo date($view_data['core_settings']['date_format'], $unix); ?></li>

					<li ><span><?=lang('application.application_deadline');?></span> <?php $unix = human_to_unix($view_data['ticket']['end'].' 00:00'); echo date($view_data['core_settings']['date_format'], $unix); ?></li>

					<li><span><?=lang('application.application_owner');?></span> <?php if(isset($view_data['ticket'])){ ?><?=$view_data['ticket']['collaborater_id']['firstname'];?> <?=$view_data['ticket']['collaborater_id']['lastname'];?> <?php } else{ echo "-";} ?></li>
					<li><span>Temps</span><p class="label label-info"><?=$view_data['periode'];?></p></li>
					<li><span>Quantité :</span><p class="label label-info">
						<?php 
							if($view_data['ticket']['surface']!= 0 && $view_data['ticket']['longueur']!= 0) echo ($view_data['ticket']['surface'].' m²'.'&nbsp&nbsp'. $view_data['ticket']['longueur'].' ml'); 
							elseif($view_data['ticket']['surface']!= 0) echo ($view_data['ticket']['surface'].' m²') ;   
							 else echo ($view_data['ticket']['longueur'].' ml') ;
						?>
					</p></li>

					<li><span>Rendement :</span><p class="label label-info">
						<?php 
							if($view_data['ticket']['surface']!= 0 && $view_data['ticket']['longueur']!= 0) echo (round($view_data['ticket']['surface']/$view_data['periode']).' m² /heures'.'&nbsp&nbsp&nbsp&nbsp&nbsp'. round($view_data['ticket']['longueur']/$nb_heures).' ml / heures'); 
							elseif($view_data['ticket']['surface']!= 0) echo (round($view_data['ticket']->surface/$view_data['periode']).' m² / heures');   
							
						?>
					</p></li>

					<li><span>CRÉÉ PAR<br><p class="label label-info"><?=$view_data['ticket']['from'];?></li>
					<li><span>CRÉÉ LE<br><p class="label label-info"><p class="label label-info"> <?php echo date($view_data['core_settings']['date_format'].'  '.$view_data['core_settings']['date_format'], $view_data['ticket']['created']); ?></li>

				</ul>

			</div>
		</div>
			<div class="col-xs-12 col-md-9">
				<?php if($view_data['ticket']['status'] != 'closed'){ ?>
					<a class="btn btn-success" style="margin-top: -2px;" id="note" data-toggle="mainmodal" href="<?=base_url()?>ctickets/article/<?=$view_data['ticket']['id'];?>/add"><?=lang('application.application_add_note');?></a>
				<?php } ?>
	 		 	<div class="btn-group nav-tabs hidden-xs ">
					<!--<a class="btn btn-primary backlink" id="back" href="<?=base_url()?>ctickets"><?=lang('application.application_back');?></a>-->
					<?php if($view_data['ticket']['status']!= 'closed'){ ?>
						<a class="btn btn-primary" id="assign" data-toggle="mainmodal" href="<?=base_url()?>ctickets/assign/<?=$view_data['ticket']['id'];?>"><?=lang('application.application_assign');?></a>
						<a class="btn btn-primary" id="type" data-toggle="mainmodal" href="<?=base_url()?>ctickets/etat/<?=$view_data['ticket']['id'];?>"><?=lang('application.application_etat');?></a>
						<a class="btn btn-primary" id="status" data-toggle="mainmodal" href="<?=base_url()?>ctickets/status/<?=$view_data['ticket']['id'];?>"><?=lang('application.application_status');?></a>
						<a class="btn btn-primary" id="close" data-toggle="mainmodal" href="<?=base_url()?>ctickets/close/<?=$view_data['ticket']['id'];?>"><?=lang('application.application_close');?></a>
					<?php } ?>
				</div>

				<div class="col-md-3 col-xs-3" style="float:right; ">

<a style="" href="<?=base_url()?>ctickets" class="btn btn-warning right">Liste des <?=lang('application.application_ctickets');?></a>
</div>
				
			




	        <div class="btn-group pull-left visible-xs">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <i class="fa fa-edit" title="Modifier"></i> <!--<span class="caret"></span>-->
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a class=" backlink" id="back" href="#"><?=lang('application.application_back');?></a>
					<li><a id="note" data-toggle="mainmodal" href="<?=base_url()?>ctickets/article/<?=$view_data['ticket']['id'];?>/add"><?=lang('application.application_add_note');?></a></li>

				</ul>
			</div>
			<!--Reply-->
	        <div class="message-content-reply fadein no-padding">
				<?php
				$attributes = array('class' => '', 'id' => '_article');
				echo form_open('ctickets/article/'.$view_data['ticket']['id'].'/add', $attributes);
				?>
				<input id="ticket_id" type="hidden" name="ticket_id" value="<?php echo $view_data['ticket']['id']; ?>" />
			
				<input type="hidden" name="to" value="<?php if($view_data['ticket']["user_id"]!= 0){echo addslashes($view_data['user']['email']);}?>">
				<input type="hidden" name="notify" value="yes">
				<input type="hidden" name="subject" value="<?=$view_data['ticket']['subject'];?>">
				<textarea id="reply" name="message" class="summernote" placeholder="<?=lang('application.application_quick_reply');?>"></textarea>
				<!-- file-->
				<input id="uploadBtn" type="file" name="userfile" class="upload" />
				<div class="textarea-footer">
				<button id="send" name="send" class="btn btn-primary button-loader"><?=lang('application.application_send');?></button>
				</div>
				<?php echo form_close(); ?>
			</div>



	        <div class="article-content">
				<h4><p class="truncate">[#<?=$view_data['ticket']['reference'];?>] <?=$view_data['ticket']['subject'];?>			
					<a href="<?=base_url()?>ctickets/copyTicket/<?=$view_data['ticket']['id'];?>" class="btn-option tt right" title="Copier la tache " data-toggle="mainmodal"><i class="fa fa-copy"></i></a>
</p></h4>

				<hr>

				<div class="article">

					<?=$view_data['ticket']['text'];?>
					<?php if(isset($view_data['ticket_has_attachments'])){echo '<hr>'; } ?>

					<?php foreach ($view_data['ticket_has_attachments']as $ticket_attachments):  ?>
                            <!--<a class="label label-info" href="<?=base_url()?>ctickets/attachment/<?php echo $ticket_attachments['savename']; ?>"><?php echo $ticket_attachments['filename']; ?></a>-->
                            <img style="width:100px;display:block;margin-top:4px;cursor: pointer;" src="<?=base_url()?>files/media/<?php echo $ticket_attachments['savename']; ?>"/>
                            <a class="label label-info" href="<?=base_url()?>files/media/<?php echo $ticket_attachments['savename']; ?>"><?php echo $ticket_attachments['filename']; ?></a>
                    <?php endforeach;?>

				</div>
			</div>
				<?php
			    $i = 0;
			    foreach ($view_data['ticket_has_articles'] as $value):
					$i = $i+1;
					if($i == 1){ ?>

					<?php } ?>
					<?php if($value['internal'] == "0"){ ?>
					<div class="article-content">
						<div class="article-header">
							<div class="article-title"><?=$value['subject'];?>
							</div>
							<span class="article-sub"><?php $from_explode = explode(' - ', $value['from']); echo '<span class="tt" title="'.$from_explode[1].'">'.$from_explode[0].'</span>'; ?></span>
							<span class="article-sub"><?php echo date($view_data['core_settings']['date_format'].' '.$view_data['core_settings']['date_time_format'], $value['datetime']); ?></span>
						</div>
						<div class="article-body">
							<?php $text = preg_replace('#(^\w.+:\n)?(^>.*(\n|$))+#mi', "", $value['message']); echo $text;?>

							<?php if(isset($value['article_has_attachments'][0])){echo "<hr>"; } ?>
							<?php foreach ($value['article_has_attachments'] as $attachments):  ?>
									<!--<a class="label label-success" href="<?=base_url()?>ctickets/articleattachment/<?php echo $attachments['savename']; ?>"><?php echo $attachments['filename']; ?></a>-->
									<img src="<?=base_url()?>ctickets/articleattachment/<?php echo $attachments['savename']; ?>" style="width:100px;margin-top:4px;cursor: pointer;display:block;">
									<div class="label label-info"><?php echo $attachments['filename']; ?></div>






							<?php endforeach;?>
						</div>
					</div>
			 		<?php } ?>
			  <?php endforeach;?>
			</div>
</div>


<style>
.modal{
	white-space:normal;

}
.product-image-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    display: none;
}

.product-image-overlay .product-image-overlay-close {
    display: block;
    position: absolute;
    bottom: 16%;
    right: 5%;
    width: 40px;
    height: 40px;
    border-radius: 100%;
    border: 1px solid #eee;
    line-height: 35px;
    font-size: 20px;
    color: #eee;
    text-align: center;
    cursor: pointer;
    z-index:111;
}

.product-image-overlay img {
    width: auto;
    max-width: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
</style>


<script type="text/javascript">
		$('.content-area').append('<div class="product-image-overlay"><span class="product-image-overlay-close">x</span><img src="" /></div>');
		var productImage = $('.article-content img');
		var productOverlay = $('.product-image-overlay');
		var productOverlayImage = $('.product-image-overlay img');

		productImage.click(function () {
	    	var productImageSource = $(this).attr('src');

	    productOverlayImage.attr('src', productImageSource);
	    productOverlay.fadeIn(100);
	    	$('.content-area').css('overflow', 'hidden');

	    $('.product-image-overlay-close').click(function () {
	        productOverlay.fadeOut(100);
	        $('.content-area').css('overflow', 'auto');
	    });


	});

</script>

<?= $this->endSection() ?>