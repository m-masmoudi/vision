<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
  <div class="col-sm-12  col-md-12 main">  
    <div class="row tile-row">
    <?php

    $view_data['month'] = $view_data['month'] != 0 ? $view_data['month'] : date('m'); $view_data['month'] =  $view_data['year'] ? $view_data['year']: date("Y")?>
      <div class="col-md-3 col-xs-6 tile"><div class="icon-frame hidden-xs"><i class="ion-ios-calendar-outline"></i> </div><h1> <?php if(isset($view_data['expenses_this_month'])){echo $view_data['expenses_this_month'];} ?> <span><?=lang('application.application_expenses');?></span></h1><h2><?php echo $view_data['days_in_this_month'] == 12 ? lang('application.application_in')." ".$view_data['year'] : lang('application.application_in')." ".lang('application.application_'.date("M", strtotime($view_data['year']."-".$view_data['month']."-01"))); ?></h2></div>
      <div class="col-md-3 col-xs-6 tile">
        <div class="icon-frame secondary hidden-xs">
          <i class="ion-ios-cart"></i> 
        </div>
      
         </h1>
         <h2><?=lang('application.application_owed_in');?> <?php echo $view_data['days_in_this_month'] == 12 ? $view_data["year"]: lang('application.application_'.date("M", strtotime($view_data['year']."-".$view_data['month']."-01")));?>
          </h2>
      </div>
      <div class="col-md-6 col-xs-12 tile hidden-xs">
      <div style="width:97%; margin-top: -4px; margin-bottom: 17px; height: 80px;">
            <canvas id="tileChart" width="auto" height="80"></canvas>
        </div>
      </div>
    
    </div>   
     <div class="d-flex align-items-center justify-content-between mb-3">
      <a href="<?=base_url()?>expenses/create" class="btn btn-primary" data-toggle="mainmodal"><?=lang('application.application_create_expense');?></a>
     
      <div class="right-expenses">
      <div class="btn-group pull-right-responsive margin-right-3">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <?php echo $view_data["year"]; ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y");?>/<?=$view_data['month']?>"><?=date("Y");?></a></li>

                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y")-1;?>/<?=$view_data['month']?>"><?=date("Y")-1;?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y")-2;?>/<?=$view_data['month']?>"><?=date("Y")-2;?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y")-3;?>/<?=$view_data['month']?>"><?=date("Y")-3;?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y")-4;?>/<?=$view_data['month']?>"><?=date("Y")-4;?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=date("Y")-5;?>/<?=$view_data['month']?>"><?=date("Y")-5;?></a></li>
          </ul>
      </div>
      <div class="btn-group pull-right-responsive margin-right-3">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <?php echo $view_data['month'] != 0 ? lang('application.application_'.date("M", strtotime("2015-".$view_data['month']."-01"))) : lang('application.application_all'); ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/0"><?=lang('application.application_all');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/01"><?=lang('application.application_Jan');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/02"><?=lang('application.application_Feb');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/03"><?=lang('application.application_Mar');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/04"><?=lang('application.application_Apr');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/05"><?=lang('application.application_May');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/06"><?=lang('application.application_Jun');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/07"><?=lang('application.application_Jul');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/08"><?=lang('application.application_Aug');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/09"><?=lang('application.application_Sep');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/10"><?=lang('application.application_Oct');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/11"><?=lang('application.application_Nov');?></a></li>
                    <li><a href="<?=base_url()?>expenses/filter/<?=$view_data['user_id']?>/<?=$view_data["year"]?>/12"><?=lang('application.application_Dec');?></a></li>

          </ul>
      </div>
      <div class="btn-group pull-right-responsive margin-right-3">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <?php if(isset($view_data["username"])){echo $view_data["username"]['firstname'].' '.$view_data["username"]['lastname'];}else{echo lang('application.application_show_expenses_from_agent');} ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
          <li><a href="<?=base_url()?>expenses/filter/0/<?=$view_data["year"]?>/<?=$view_data['month']?>"><?=lang('application.application_all');?></a></li>
            <?php foreach ($view_data["userlist"] as $user):?>
                  <li><a href="<?=base_url()?>expenses/filter/<?=$user['id']?>/<?=$view_data["year"]?>/<?=$view_data['month']?>"><?=$user['firstname'].' '.$user['lastname']?></a></li>
              <?php endforeach;?>
          </ul>
      </div>
      </div>
    </div>  
      <div class="row">

         <div class="table-head"><?=lang('application.application_expenses');?></div>
         <div class="table-div">
		<table class="data table noclick" id="expenses" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
			<th width="30px" class="hidden-xs"><?=lang('application.application_id');?></th>
      <th width="5px" class="no-sort"></th>
			<th ><?=lang('application.application_description');?></th>
      <th class="hidden-xs"><?=lang('application.application_category');?></th>
			<th class="hidden-xs"><?=lang('application.application_date');?></th>
			<th class="hidden-xs"><?=lang('application.application_value');?></th>
      <th class="hidden-xs"><?=lang('application.application_balance');?></th>

			<th><?=lang('application.application_action');?></th>
		</thead>
		<?php 
    $sum = 0;
    foreach ($view_data['expenses'] as $value):
      $sum = $sum+$value['value'];
      ?>
		<tr id="<?=$value['id'];?>" >
			<td class="hidden-xs"><?=$value['id'];?></td>
      <td><?php if($value['attachment'] != ""){echo '<a href="'.base_url().'expenses/attachment/'.$value['id'].'" style="color: #505458;"><i class="fa fa-paperclip tt" title="'.$value['attachment_description'].'"></i></a>'; }?></td>
			<td><?php if(isset($value['description'])){echo $value['description']; }?></td>
      <td class="hidden-xs" ><span class="label label-info"><?=$value['category']['name'];?></span></td>
      <td class="hidden-xs"><span><?php $unix = human_to_unix($value['date'].' 00:00'); echo '<span class="hidden">'.$unix.'</span> '; echo date($view_data['core_settings']['date_format'], $unix);?></span></td>



		
			<td class="option" width="8%">
				        <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>expenses/delete/<?=$value['id'];?>'><?=lang('application.application_yes_im_sure');?></a> <button class='btn po-close'><?=lang('application.application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value['id'];?>'>" data-original-title="<b><?=lang('application.application_really_delete');?></b>"><i class="fa fa-times"></i></button>
				        <a href="<?=base_url()?>expenses/update/<?=$value['id'];?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
			</td>
		</tr>

		<?php endforeach;?>
	 	</table>


            </div>


      </div>

<script>
$(document).ready(function(){ 

//chartjs
<?php
                           
                                $days = array();
                                $data = ""; 
                                $labels = "";
                                foreach ($view_data['expenses_due_this_month_graph'] as $value) 
                                {
                                    $days[$value['date']] = $value['owed'];  
                                }
                                $i = 1;
                                while ($i <= $view_data['days_in_this_month']) 
                                {
                                    $selected_day = $view_data['days_in_this_month'] == 12 ? $i : $view_data["year"].'-'.$view_data['month'].'-'.$i;
                                    $y = 0;
                                    if(isset($days[$selected_day])){ $y = $days[$selected_day];} 
                                    $d = date_parse_from_format("Y-m-d", $selected_day);
                                    $labels .= $view_data['days_in_this_month'] == 12 ? '"'.sprintf("%1$02d", $selected_day).'",' : '"'.$d["day"].'",';
                                    $data .= '"'.sprintf("%01.2f", round($y, 2)).'",';
                                    $i++; 
                                } 
                                ?>

    var ctx = document.getElementById("tileChart").getContext("2d");
    var myBarChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?=$labels?>],
        datasets: [
        {
          label: "<?=lang('application.application_owed');?>",
          backgroundColor: "rgba(237, 85, 101, 0.3)",
          borderColor: "rgba(237, 85, 101, 1)",
          pointBorderColor: "rgba(51, 195, 218, 0)",
          pointBackgroundColor: "rgba(237, 85, 101, 1)",
          pointHoverBackgroundColor: "rgba(237, 85, 101, 1)",
          pointHitRadius: 25,
          pointRadius: 2,
          borderWidth: 2,
          data: [<?=$data;?>]
        }]
      },
       options: {
        title: {
            display: true,
            text: ' '
        },
        maintainAspectRatio: false,
        tooltips:{
          enabled: true,
        },
        legend:{
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: { 
                        display: false, 
                        lineWidth: 2,
                        color: "rgba(237, 85, 101, 0)"
                      },
            ticks: {
                        beginAtZero:true,
                        display: false,
                    }
          }],
          xAxes: [{
             gridLines: { 
                        display: false, 
                        lineWidth: 2,
                        color: "rgba(237, 85, 101, 0)"
                      },
            ticks: {
                        beginAtZero:true,
                        display: false,
                    }
          }]
        }
      }

    });
});
</script>
<?= $this->endSection() ?>