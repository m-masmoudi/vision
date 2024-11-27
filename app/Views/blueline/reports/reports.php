<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<style>
  @media (max-width: 767px){
  .content-area {
      padding: 0;
  }
  .row.mainnavbar {
    margin-bottom: 0px;
    margin-right: 0px;
  }
}
span.flatpickr-current-month {
    position: static;
    padding: 0;
}
.flatpickr-calendar {
    opacity: 1;
    visibility: visible;
}
.flatpickr-days {
    display: block;
    text-align: start;
    width: auto;
}

</style>

<div class="grid" style="background-color: #fff">


    <div class="grid__col-sm-12 grid__col-md-12 grid__col--bleed">
      <div class="grid grid--align-content-start">


        <div class="grid__col-12">
            <div class="tile-base no-padding" > 
             <?php  $attributes = array('class' => '', 'method' => 'POST', 'id' => '_reports');
             // echo form_open($form_action, $attributes); ?>
                <div class="grid tile-base__form-heading">
                  <div class="grid__col-md-4">
                          <div class="form-group tt">
                              <label for="reports"><?=lang('application.application_reports');?> </label>
                              <select id="report" name="report" class="formcontrol chosen-select ">
                                    <option value="income"><?=lang('application.application_income_and_expenses');?></option>
                                    <option value="clients" <?php if(isset($view_data['report_selected'])){ echo "selected";}?>><?=lang('application.application_income_by_client');?></option>          

                              </select>
                          </div>    
                  </div>
           

                  <div class="grid__col-md-2">
                        <div class="form-group filled">
                              <label for="start"><?=lang('application.application_start_date');?> *</label>
                              <input class="form-control datepicker" name="start" id="start" type="text" value="<?=$view_data['stats_start_short'];?>" placeholder="<?=lang('application.application_start_date');?>" required/>
                        </div>
                  </div>
                  <div class="grid__col-md-2">
                        <div class="form-group filled">
                              <label for="end"><?=lang('application.application_end_date');?> *</label>
                              <input class="form-control datepicker-linked" name="end" id="end" type="text" value="<?=$view_data['stats_end_short'];?>" placeholder="<?=lang('application.application_end_date');?>" required/>
                        </div>
                  </div>
                   <div class="grid__col-md-2 grid--align-self-end">
                        
                              <input class="btn btn-primary" name="send" type="submit" value="<?=lang('application.application_apply');?>" placeholder="" required/>
                       
                  </div>
              </div>
              <?php //form_close();?>
              <div class="tile-extended-header">
                  <div class="grid tile-extended-header">
                      <div class="grid__col-4">
                          <h5><?=lang('application.application_statistics');?> </h5>
                          <div class="btn-group">
                        <button type="button" class="tile-year-selector dropdown-toggle" data-toggle="dropdown">
                          <?=$view_data['stats_start'];?> - <?=$view_data['stats_end'];?>
                        </button>
                        
                  </div>
                      </div>
                      <div class="grid__col-8">
                            <?php if(!isset($report_selected)){ ?>
                            <div class="grid grid--bleed grid--justify-end">
                                <div class="grid__col-md-3 tile-text-right">
                                    <h5><?=lang('application.application_income');?></h5>
                                    <h1><?=display_money($view_data['totalIncomeForYear'], false, $view_data['core_settings']['chiffre']);?></h1>
                                </div>
                                <div class="grid__col-md-3 tile-text-right tile-negative">
                                    <h5><?=lang('application.application_expenses');?></h5>
                                    <h1><?=display_money($view_data['totalExpenses'], false, $view_data['core_settings']['chiffre']);?></h1>
                                </div>
                                <div class="grid__col-md-3 tile-text-right tile-positive">
                                    <h5><?=lang('application.application_profit');?></h5>
                                    <h1><?=display_money($view_data['totalProfit'], false, $view_data['core_settings']['chiffre']);?></h1>
                                </div>
                          </div>
                          <?php } ?>
                      </div>
                      <div class="grid__col-12 grid--align-self-end">
                          <div class="tile-body">
                             
                          </div>
                      </div>
                    </div>
                  </div>   
            </div>
</div> 

        


      </div>
    </div>


</div>


 
<canvas id="tileChart" width="auto" height="80" style="background-color: #fff"></canvas>
<?php
$labels = [];
if (isset($view_data['labels'])) {
    $labels = is_array($view_data['labels']) 
        ? array_map('strtoupper', $view_data['labels'])
        : array_map('strtoupper', explode(',', $view_data['labels']));
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">


  //chartjs

  var ctx = document.getElementById("tileChart");

  // Prepare data variables from PHP
  var labels = <?= json_encode( $labels) ?>;
  var dataLine1 = <?= json_encode($view_data['line1']) ?>;
  var dataLine2 = <?= json_encode($view_data['line2']) ?>;

  // Chart.js configuration
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,  // Use JSON-encoded labels
      datasets: [
       
          {
            label: "<?= lang("application.application_owed"); ?>",
            backgroundColor: "rgba(237,85,101,0.6)",
            borderColor: "rgba(237,85,101,1)",
            pointBorderColor: "rgba(0,0,0,0)",
            pointBackgroundColor: "#ffffff",
            pointHoverBackgroundColor: "rgba(237, 85, 101, 0.5)",
            pointHitRadius: 25,
            pointRadius: 1,
            data: dataLine2  // Use JSON-encoded data
          },
     
        {
          label: "<?= lang("application.application_received"); ?>",
          backgroundColor: "rgba(46,204,113,0.6)",
          borderColor: "rgba(46,204,113,1)",
          pointBorderColor: "rgba(0,0,0,0)",
          pointBackgroundColor: "#ffffff",
          pointHoverBackgroundColor: "rgba(79, 193, 233, 1)",
          pointHitRadius: 25,
          pointRadius: 1,
          data: dataLine1  // Use JSON-encoded data
        }
      ]
    },
    options: {
      tooltips: {
        xPadding: 10,
        yPadding: 10,
        cornerRadius: 2,
        mode: 'label',
        multiKeyBackground: 'rgba(0,0,0,0.2)'
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          display: true,
          gridLines: {
            drawOnChartArea: false,
          },
          ticks: {
            fontColor: "#A4A5A9",
            fontFamily: "Open Sans",
            fontSize: 11,
            beginAtZero: true,
            maxTicksLimit: 6,
          }
        }],
        xAxes: [{
          display: true,
          ticks: {
            fontColor: "#A4A5A9",
            fontFamily: "Open Sans",
            fontSize: 11,
          }
        }]
      }
    }
  });




</script>




<?= $this->endSection() ?>

 