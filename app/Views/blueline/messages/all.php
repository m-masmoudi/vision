<link href="<?=base_url()?>assets/blueline/css/plugins/messages.css" rel="stylesheet">               
<div class="col-sm-13  col-md-12 messages" onmouseover="document.body.style.overflow='hidden';" onmouseout="document.body.style.overflow='auto';">  
<main id="main" >
	<div class="overlay"></div>
	<header class="header">
		<h1 class="page-title">
		<div class="message-list-header">
			<span id="inbox-folder"><i class="fa fa-inbox"></i> <?=$this->lang->line('application_INBOX');?></span>
			<span id="sent-folder"><i class="fa fa-mail-forward"></i> <?=$this->lang->line('application_sent');?></span>
			<span id="deleted-folder"><i class="fa fa-trash"></i> <?=$this->lang->line('application_Deleted');?></span>
			<span id="marked-folder"><i class="fa fa-star"></i> <?=$this->lang->line('application_Marked');?></span>
		</div>
		</h1>
	</header>
	<!-- la barre des actions -->
	<div class="action-bar">
		<ul>
			<li><a class="btn btn-success" data-toggle="mainmodal" role="button" href="<?=base_url()?>messages/write" title="<?=$this->lang->line('application_write_message');?>"><i class="fa fa-envelope space"></i> <span class="hidden-xs"><?=$this->lang->line('application_write_message');?></span></a></li>
			<li>
			<div class="btn-group">
				 <a class="btn btn-primary message-list-load inbox-folder" id="message-trigger" role="button" href="<?=base_url()?>messages/messagelist" title="Inbox"><i class="fa fa-inbox space"></i> <span class="hidden-xs"><?=$this->lang->line('application_INBOX');?></span></a>
				
				<a class="btn btn-primary message-list-load sent-folder" role="button" href="<?=base_url()?>messages/filter/sent/0" title="Sent Folder"><i class="fa fa-share space"></i> <span class="hidden-xs"><?=$this->lang->line('application_sent');?></span></a>
				
				 <a class="btn btn-primary message-list-load deleted-folder" role="button" href="<?=base_url()?>messages/filter/deleted/0" title="<?=$this->lang->line('application_messages_show_deleted');?>"><i class="fa fa-trash space"></i> <span class="hidden-xs"><?=$this->lang->line('application_Deleted');?></span></a>
				 <a class="btn btn-primary message-list-load marked-folder" role="button" href="<?=base_url()?>messages/filter/marked/0" title="<?=$this->lang->line('application_Marked');?>"><i class="fa fa-star space"></i> <span class="hidden-xs"><?=$this->lang->line('application_Marked');?></span></a>
			</div>
			</li>           
		</ul>
	</div>
  <div id="main-nano-wrapper" class="nano">
    <div class="nano-content">
		<ul id="message-list" class="message-list">
        
		</ul>
    </div>
	  </div>
</main>
<div id="message"> 
</div>
</div>
</div>
<script>
jQuery(document).ready(function($) {
$(document).on("click", '.message-list-load', function (e) {
  e.preventDefault();
  NProgress.start();
  messageheader(this);
  $('.message-list-footer').fadeOut('fast');
  var url = $(this).attr('href');
  if (url.indexOf('#') === 0) {
    
  } else {
    $.get(url, function(data) { 
		$('#message-list').html(data);
		}).done(function() 
			{   NProgress.done(); 
	});
  }
});  
$('#message-trigger').click();
	function messageheader(active) {
		var classes = $(active).attr("class").split(/\s/);
			if(classes[3]){
				$('.message-list-header span').hide();
					$('.message-list-header #'+classes[3]).fadeIn('slow');
			}   
	}
	$('.search-box input').on('focus', function() {
		if($(window).width() <= 1360) {
			cols.hideMessage();
		}
	});
});
</script>

