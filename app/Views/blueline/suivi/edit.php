<link rel="stylesheet" href="<?=base_url()?>assets/suivi/css/style.css">
<div class="col-sm-12  col-md-12 main">  
	
<div class="row">
		<a href="<?=base_url()?>projects" class="btn btn-primary right">Liste des projets </a>
		<div class="col-sm-3">
            <!-- salariés -->
            <div class="form-group">
                <label for="service_filter">Service</label>
                <select class="chosen-select" aria-label="Default select example" id="service_filter" >
                        <option value="all" selected>Tous les services</option>
						<option value="MMS" >MMS</option>
                        <option value="BIM 2D" >BIM 2D</option>
                        <option value="BIM 3D" >BIM 3D</option>
                </select>
		        </div>
        </div>
</div>  
<div class="row">
		<div class="table-head"><?=$this->lang->line('application_calendar');?></div>
			<div class="table-div">
                <!--HEADER BUTTON -->
                <div class="header-button">
                <a href="<?php echo site_url('suivi/edit/'.$data['year_prev'].'/'. $data['month_prev']) ?>" class="btn btn-light btn-sm" >
                <span class="mr-2"><<</span>Previous month 
            </a><!--
            --><a href="<?php echo site_url('suivi/edit/'.$data['year_prev'].'/'. $data['month_next']) ?>" class="btn btn-light btn-sm" >
            Next month<span class="mr-2">>></span>
            </a>
                <button type="button" class="btn btn-light btn-sm last-in-row" onclick="select();" data-bs-toggle="popover"><img src="<?php echo base_url('./assets/suivi/img/icon1.png'); ?>" class="icon small"></img><span>Select...</span> </button>
                </div>
          
                <!------CALENDRES--->
                <div class="calendars"> 
                    <div class="cali" data-year="" data-month="" >
                    <div class="header"> 
                        <div class="name-column"> 
                        <div class="wrap"><?php echo $data['name'] ?> <?php echo $data['year'] ?></div> 
                        </div> 
                        <div class="days">
                            <?php foreach ($data['data_m'] as $day): ?>
                                <?php foreach ( $day as $d): ?>
                                
                                <div 
                                    class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"
                                    >
                                    <div class="num"><?php echo $d['num'] ?></div>
                                    <div class="week-name"><?php echo $d['name'] ?></div>
                                </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>  
                    <div class="user">
                    <?php foreach($data['users'] as $user): ?>   
                            <div class="item" data-id="<?php echo($user->id) ?>" >
                            
                                <div class="name-column" >
                                <div class="name-wrap">
                                
                                <span class="name itemname" data-bs-toggle="popover"
                        data-placement="right"
                        data-trigger="focus" 
                        data-html="true"
                        data-title ="<?php echo($user->nom .' '.$user->prenom) ?>"
                         data-ville ="<?php echo($user->ville) ?>"
                         data-affectation ="<?php echo($user->seraffectation) ?>"
                         data-phone ="<?php echo($user->tel1) ?>"
                         data-file ="<?php echo($user->file); ?>"

                          ><?php echo get_salaries_icon($user->genre)?><?php echo($user->nom .' '.$user->prenom) ?></span>
                                </div>
                                 </div>
                                 
                                 <div class="days">
                                    <?php foreach ($data['data_m'] as $day): ?>
                                        <?php foreach( $day as $d):
                                            if(($d['week_num'] == 6)||($d['week_num'] == 7)):
                                            ?>
                                          <div 
                                            class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"
                                            >
                                            <div class="num"></div>
                                        
                                          </div>   
                                                
                                                <?php else: ?>
                                                    
                                        <div class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>">
                                            
                                                    <?php
                                                $dateoff = get_dayoff_icon($user->id);
                                                foreach( $dateoff as $off):  
                                                    $f=array_values($off); 
                                                                              
                                                    $date_s = date_parts_iso($f[0]);
                                                    // var_dump(find_project_name($f[1],$user->id,$f[0]));
                                                if(($d['num'] == $date_s[2])&&($data['month'] == $date_s[1])&&($data['year'] == $date_s[0])):
                                                    
                                                ?>
                                                
                                                    <div class="num iconnume"  data-value="<?php echo find_project_name($f[1],$user->id,$f[0]) ?>"  >
                                                    <?php if($f[1]=="planification"){
                                                     echo chouseIconPlanification($user->id,$f[0]);}
                                                    else{
                                                     echo chouse_icon($f[1]);
                                                    }
                                                     ?>
                                                    </div>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                                </div>
                                                    <?php endif  ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div> 
                                </div>
                                <?php endforeach; ?>
                    </div>
                </div>
                </div>  
                </div>

                <div id="monthSelector" data-month="<?php echo $data['month'] ?>" >
                    <div class="controls d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-light btn-sm" onclick="decrement();" data-prev>&laquo;</button>
                            <div class="year text-center mx-4" id="#mx-4"><p id="id"><?php echo $data['year'] ?></p></div>
                        <button type="button" class="btn btn-light btn-sm" onclick="increment();" data-next>&raquo;</button>
                    </div>
                    <div class="months mt-2" >
                        <?php for ($i=1; $i<=12; $i++): ?>
                                    <a class="dropdown-item px-2 <?php echo (($i == $data['month'] ) ? 'active' : ''); ?>" href="<?php echo site_url('suivi/edit/'.$data['year'].'/'. $i) ?>" data-id="<?php echo($i); ?>" data-num="<?php echo $i; ?>" ><?php echo get_month_name($i); ?></a>
                        <?php endfor; ?>
                    </div>
                </div>
             
                
<script>
    $(function () {
   
  $('.last-in-row').popover({
    html: true,
    content: $("#monthSelector").html()
  });
  $year =$('#id').html();
    $length = $(".dropdown-item").length;
 for (var i = 0; i < $length ; i++) {
  
   $(".dropdown-item").eq(i).attr("href", "http://127.0.0.1:8090/visionBIM/suivi/edit/"+$year+"/"+[i]);

   
}

    

$( document ).ready(function() {
    
    var base_url = '<?php echo base_url() ?>';
    
    $(".itemname").each(function(){
    let seraffectation =$(this).data('affectation');
    let ville =$(this).data('ville');
    let phone = $(this).data('phone');
    let image =$(this).data('file');
    
    $(this).popover({
    trigger: 'hover',
    html: true,
    content:'<div class="details"><div  style="display: flex!important;"><div class="container-b"><img src="'+base_url+'files/media/'+image+'"  id="profilimg" ></div><div class="container-c"><div class="field type-text"><div id="labelp" >Department:</div><div class="value" lang="en">'+seraffectation+'</div></div><div class="field type-text"><div id="labelp">Phone:</div><div class="value" lang="en">'+phone+'</div></div><div class="field type-link"><div id="labelp" >Ville:</div>'+ville+'</div></div></div></div>'

 
});


    
});
$(".iconnume").each(function(){

let  content =$(this).data('value');
let  icon =$(this).html();

$(this).popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    constraints: [{
        to: 'scrollParent',
        attachment: 'together',
        pin: true
    }],
    container: 'body',
    content   :'<div>'+icon+content+'</div>' ,
       
   });


}); 
 
 
});

});

function increment(){
    $year =$('#id').html();
    $res = parseInt($year) + 1;
    $('#id').html($res);
   console.log($res);
   $year =$('#id').html();
 
 $length = $(".dropdown-item").length;
 for (var i = 0; i < $length ; i++) {

   $(".dropdown-item").eq(i).attr("href", "http://127.0.0.1:8090/visionBIM/suivi/edit/"+$year+"/"+[i]);;
   
}
}
function decrement(){
    $year =$('#id').html();
    $res = parseInt($year) - 1;
    $('#id').html($res);
   console.log($res);
   $year =$('#id').html();
 
 $length = $(".dropdown-item").length;
 for (var i = 0; i < $length ; i++) {
   $(".dropdown-item").eq(i).attr("href", "http://127.0.0.1:8090/visionBIM/suivi/edit/"+$year+"/"+[i]);;
}

}
function select(){
  $year =$('#id').html();
 
  $length = $(".dropdown-item").length;
  for (var i = 0; i < $length ; i++) {
    $(".dropdown-item").eq(i).attr("href", "http://127.0.0.1:8090/visionBIM/suivi/edit/"+$year+"/"+[i]);;
}
  
 
}

$(document).ready(function(){

 $('#service_filter').change(function(){
   var select = $(this).val();
   var base_url = '<?php echo base_url() ?>';
   console.log(select);
   if(select == 'MMS')
   {
    $(".user").empty();
      $('.user').append('<?php foreach($data["usersmms"] as $user): ?>'+   
                            '<div class="item">'+
                               '<div class="name-column">'+
                                '<div class="name-wrap">'+
                                '<span class="name itemname" data-bs-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" data-title ="<?php echo($user->nom .' '.$user->prenom) ?>" data-ville ="<?php echo($user->ville) ?>"  data-affectation ="<?php echo($user->seraffectation) ?>"  data-file ="<?php echo($user->file); ?>" data-phone ="<?php echo($user->tel1) ?>"><?php echo get_salaries_icon($user->genre)?><?php echo($user->nom .' '.$user->prenom) ?></span>'+
                               '</div>'+
                                 '</div>'+
                                 '<div class="days">'+
                                    '<?php foreach ($data["data_m"] as $day): ?>'+
                                        '<?php foreach ( $day as $d):
                                            if(($d['week_num'] == 6)||($d['week_num'] == 7)):
                                            ?>'+
                                          '<div class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"><div class="num">'+'</div>'+
                                        
                                            '</div>'+   
                                                
                                            '<?php else: ?>'+
                                        '<div class="day week-num-<?php echo $d["week_num"] ?> <?php echo ($d["is_today"] ? "today" : ""); ?>">'+
                                               '<?php
                                                $dateoff = get_dayoff_icon($user->id);
                                                foreach( $dateoff as $off):  
                                                    $f=array_values($off); 
                                                                              
                                                    $date_s = date_parts_iso($f[0]);
                                                    
                                                if(($d["num"] == $date_s[2])&&($data["month"] == $date_s[1])&&($data["year"] == $date_s[0])):
                                                ?>'+
                                                    '<div class="num iconnume" data-value="<?php echo find_project_name($f[1],$user->id,$f[0]) ?>">'+
                                                '<?php if($f[1]=="planification"){
                                                     echo chouseIconPlanification($user->id,$f[0]);}
                                                    else{
                                                     echo chouse_icon($f[1]);
                                                    }
                                                     ?></div>'+
                                                    '<?php endif ?>'+
                                                '<?php endforeach; ?>'+
                                                '</div>'+
                                                '<?php endif  ?>'+
                                        '<?php endforeach; ?>'+
                                    '<?php endforeach; ?>'+
                                '</div>'+ 
                                '</div>'+
                                '<?php endforeach; ?>'); 
    
    
    $(".itemname").each(function(){
    let seraffectation =$(this).data('affectation');
    let ville =$(this).data('ville');
    let phone = $(this).data('phone');
    let image =$(this).data('file');
    
    $(this).popover({
    trigger: 'hover',
    html: true,
    content:'<div class="details"><div  style="display: flex!important;"><div class="container-b"><img src="'+base_url+'files/media/'+image+'"  id="profilimg" ></div><div class="container-c"><div class="field type-text"><div id="labelp" >Department:</div><div class="value" lang="en">'+seraffectation+'</div></div><div class="field type-text"><div id="labelp">Phone:</div><div class="value" lang="en">'+phone+'</div></div><div class="field type-link"><div id="labelp" >Ville:</div>'+ville+'</div></div></div></div>'

 
});
    
});   
$(".iconnume").each(function(){

let  content =$(this).data('value');
let  icon =$(this).html();

$(this).popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    constraints: [{
        to: 'scrollParent',
        attachment: 'together',
        pin: true
    }],
    container: 'body',
    content   :'<div>'+icon+content+'</div>' ,
       
   });


}); 
   }
  if(select == 'BIM 2D')
   {
    $(".user").empty();
    $('.user').append('<?php foreach($data["users2d"] as $user): ?>'+   
                            '<div class="item">'+
                               '<div class="name-column">'+
                                '<div class="name-wrap">'+
                                '<span class="name itemname" data-bs-toggle="popover"  data-file ="<?php echo($user->file); ?>" data-placement="right" data-trigger="focus" data-html="true" data-title ="<?php echo($user->nom .' '.$user->prenom) ?>" data-ville ="<?php echo($user->ville) ?>"  data-affectation ="<?php echo($user->seraffectation) ?>"  data-phone ="<?php echo($user->tel1) ?>"><?php echo get_salaries_icon($user->genre)?><?php echo($user->nom .' '.$user->prenom) ?></span>'+
                               '</div>'+
                                 '</div>'+
                                 '<div class="days">'+
                                    '<?php foreach ($data["data_m"] as $day): ?>'+
                                        '<?php foreach ( $day as $d):
                                            if(($d['week_num'] == 6)||($d['week_num'] == 7)):
                                            ?>'+
                                          '<div class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"><div class="num">'+'</div>'+
                                        
                                            '</div>'+   
                                                
                                            '<?php else: ?>'+
                                        '<div class="day week-num-<?php echo $d["week_num"] ?> <?php echo ($d["is_today"] ? "today" : ""); ?>">'+

                                               '<?php
                                                $dateoff = get_dayoff_icon($user->id);
                                                foreach( $dateoff as $off):  
                                                    $f=array_values($off); 
                                                                              
                                                    $date_s = date_parts_iso($f[0]);
                                                    
                                                if(($d["num"] == $date_s[2])&&($data["month"] == $date_s[1])&&($data["year"] == $date_s[0])):
                                                ?>'+
                                                    '<div class="num iconnume" data-value="<?php echo find_project_name($f[1],$user->id,$f[0]) ?>">'+
                                                    '<?php if($f[1]=="planification"){
                                                     echo chouseIconPlanification($user->id,$f[0]);}
                                                    else{
                                                     echo chouse_icon($f[1]);
                                                    }
                                                     ?></div>'+
                                                    '<?php endif ?>'+
                                                '<?php endforeach; ?>'+
                                                '</div>'+
                                                '<?php endif  ?>'+
                                        '<?php endforeach; ?>'+
                                    '<?php endforeach; ?>'+
                                '</div>'+ 
                                '</div>'+
                                '<?php endforeach; ?>'); 
     
     
    
    $(".itemname").each(function(){
    let seraffectation =$(this).data('affectation');
    let ville =$(this).data('ville');
    let phone = $(this).data('phone');
    let image =$(this).data('file');
    
    $(this).popover({
    trigger: 'hover',
    html: true,
    content:'<div class="details"><div  style="display: flex!important;"><div class="container-b"><img src="'+base_url+'files/media/'+image+'"  id="profilimg" ></div><div class="container-c"><div class="field type-text"><div id="labelp" >Department:</div><div class="value" lang="en">'+seraffectation+'</div></div><div class="field type-text"><div id="labelp">Phone:</div><div class="value" lang="en">'+phone+'</div></div><div class="field type-link"><div id="labelp" >Ville:</div>'+ville+'</div></div></div></div>'

 
});
    
});  
$(".iconnume").each(function(){

let  content =$(this).data('value');
let  icon =$(this).html();

$(this).popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    constraints: [{
        to: 'scrollParent',
        attachment: 'together',
        pin: true
    }],
    container: 'body',
    content   :'<div>'+icon+content+'</div>' ,
       
   });


}); 
   }
   if(select == 'BIM 3D')
   {
    
    $(".user").empty();
    $('.user').append('<?php foreach($data["users3d"] as $user): ?>'+   
                            '<div class="item">'+
                               '<div class="name-column">'+
                                '<div class="name-wrap">'+
                                '<span class="name itemname" data-bs-toggle="popover"  data-file ="<?php echo($user->file); ?>" data-placement="right" data-trigger="focus" data-html="true" data-title ="<?php echo($user->nom .' '.$user->prenom) ?>" data-ville ="<?php echo($user->ville) ?>"  data-affectation ="<?php echo($user->seraffectation) ?>"  data-phone ="<?php echo($user->tel1) ?>"><?php echo get_salaries_icon($user->genre)?><?php echo($user->nom .' '.$user->prenom) ?></span>'+
                               '</div>'+
                                 '</div>'+
                                 '<div class="days">'+
                                    '<?php foreach ($data["data_m"] as $day): ?>'+
                                        '<?php foreach ( $day as $d):
                                            if(($d['week_num'] == 6)||($d['week_num'] == 7)):
                                            ?>'+
                                          '<div class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"><div class="num">'+'</div>'+
                                        
                                            '</div>'+   
                                                
                                            '<?php else: ?>'+
                                        '<div class="day week-num-<?php echo $d["week_num"] ?> <?php echo ($d["is_today"] ? "today" : ""); ?>">'+

                                               '<?php
                                                $dateoff = get_dayoff_icon($user->id);
                                                foreach( $dateoff as $off):  
                                                    $f=array_values($off); 
                                                                              
                                                    $date_s = date_parts_iso($f[0]);
                                                    
                                                if(($d["num"] == $date_s[2])&&($data["month"] == $date_s[1])&&($data["year"] == $date_s[0])):
                                                ?>'+
                                                    '<div class="num iconnume" data-value="<?php echo find_project_name($f[1],$user->id,$f[0]) ?>">'+
                                                    '<?php if($f[1]=="planification"){
                                                     echo chouseIconPlanification($user->id,$f[0]);}
                                                    else{
                                                     echo chouse_icon($f[1]);
                                                    }
                                                     ?></div>'+
                                                    '<?php endif ?>'+
                                                '<?php endforeach; ?>'+
                                                '</div>'+
                                                '<?php endif  ?>'+
                                        '<?php endforeach; ?>'+
                                    '<?php endforeach; ?>'+
                                '</div>'+ 
                                '</div>'+
                                '<?php endforeach; ?>'); 
    
 
    
    $(".itemname").each(function(){
    let seraffectation =$(this).data('affectation');
    let ville =$(this).data('ville');
    let phone = $(this).data('phone');
    let image =$(this).data('file');
    
    $(this).popover({
    trigger: 'hover',
    html: true,
    content:'<div class="details"><div  style="display: flex!important;"><div class="container-b"><img src="'+base_url+'files/media/'+image+'"  id="profilimg" ></div><div class="container-c"><div class="field type-text"><div id="labelp" >Department:</div><div class="value" lang="en">'+seraffectation+'</div></div><div class="field type-text"><div id="labelp">Phone:</div><div class="value" lang="en">'+phone+'</div></div><div class="field type-link"><div id="labelp" >Ville:</div>'+ville+'</div></div></div></div>'

 
});
    
});
$(".iconnume").each(function(){

let  content =$(this).data('value');
let  icon =$(this).html();

$(this).popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    constraints: [{
        to: 'scrollParent',
        attachment: 'together',
        pin: true
    }],
    container: 'body',
    content   :'<div>'+icon+content+'</div>' ,
       
   });


}); 
      
   }
   if(select == 'all')
   {
    $(".user").empty();
    $('.user').append('<?php foreach($data["users"] as $user): ?>'+   
                            '<div class="item">'+
                               '<div class="name-column">'+
                                '<div class="name-wrap">'+
                                '<span class="name itemname" data-bs-toggle="popover"  data-file ="<?php echo($user->file); ?>" data-placement="right" data-trigger="focus" data-html="true" data-title ="<?php echo($user->nom .' '.$user->prenom) ?>" data-ville ="<?php echo($user->ville) ?>"  data-affectation ="<?php echo($user->seraffectation) ?>"  data-phone ="<?php echo($user->tel1) ?>"><?php echo get_salaries_icon($user->genre)?><?php echo($user->nom .' '.$user->prenom) ?></span>'+
                               '</div>'+
                                 '</div>'+
                                 '<div class="days">'+
                                    '<?php foreach ($data["data_m"] as $day): ?>'+
                                        '<?php foreach ( $day as $d):
                                            if(($d['week_num'] == 6)||($d['week_num'] == 7)):
                                            ?>'+
                                          '<div class="day week-num-<?php echo $d['week_num'] ?> <?php echo ($d['is_today'] ? 'today' : ''); ?>"><div class="num">'+'</div>'+
                                        
                                            '</div>'+   
                                                
                                            '<?php else: ?>'+
                                        '<div class="day week-num-<?php echo $d["week_num"] ?> <?php echo ($d["is_today"] ? "today" : ""); ?>">'+

                                               '<?php
                                                $dateoff = get_dayoff_icon($user->id);
                                                foreach( $dateoff as $off):  
                                                    $f=array_values($off); 
                                                                              
                                                    $date_s = date_parts_iso($f[0]);
                                                    
                                                if(($d["num"] == $date_s[2])&&($data["month"] == $date_s[1])&&($data["year"] == $date_s[0])):
                                                ?>'+
                                                    '<div class="num iconnume" data-value="<?php echo find_project_name($f[1],$user->id,$f[0]) ?>">'+
                                                    '<?php if($f[1]=="planification"){
                                                     echo chouseIconPlanification($user->id,$f[0]);}
                                                    else{
                                                     echo chouse_icon($f[1]);
                                                    }
                                                     ?></div>'+
                                                    '<?php endif ?>'+
                                                '<?php endforeach; ?>'+
                                                '</div>'+
                                                '<?php endif  ?>'+
                                        '<?php endforeach; ?>'+
                                    '<?php endforeach; ?>'+
                                '</div>'+ 
                                '</div>'+
                                '<?php endforeach; ?>'); 
    $(".itemname").each(function(){
    let seraffectation =$(this).data('affectation');
    let ville =$(this).data('ville');
    let phone = $(this).data('phone');
    
    $(this).popover({
    trigger: 'hover',
    html: true,
    content:'<div class="details"><div><div class="plabel" style=" font-style: italic;color:blue">Department:</div><div class="pvalue" lang="en" style="overflow-wrap: break-word">'+seraffectation+'</div></div><div><div class="plabel" style=" font-style: italic;color:blue">Phone:</div><div class="pvalue" lang="en" style="overflow-wrap: break-word">'+phone+'</div></div><div>'+
    '<div class="plabel" style=" font-style: italic;color:blue" >Ville:</div>'+ville+'</div></div></div></div>' 

 
});
    
}); 
$(".iconnume").each(function(){

let  content =$(this).data('value');
let  icon =$(this).html();

$(this).popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    constraints: [{
        to: 'scrollParent',
        attachment: 'together',
        pin: true
    }],
    container: 'body',
    content   :'<div>'+icon+content+'</div>' ,
       
   });


}); 
   }

 });
})


</script>


              

