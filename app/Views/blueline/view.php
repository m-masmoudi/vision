 
          <div class="row">
              <div class="col-xs-12 col-sm-12">
            <a href="<?=base_url()?>invoices/update/<?=$invoice->id;?>/view" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-edit visible-xs" title="Modifier"></i><span class="hidden-xs"><?=$this->lang->line('application_edit_invoice');?></span></a>
			<?php if($invoice->estimate_status != "Invoiced"){ ?><a href="<?=base_url()?>invoices/item/<?=$invoice->id;?>" class="btn btn-primary" data-toggle="mainmodal"><i class="fa fa-plus visible-xs"></i><span class="hidden-xs"><?=$this->lang->line('application_add_item');?></span></a><?php } ?>
			<a href="<?=base_url()?>invoices/preview/<?=$invoice->id;?>" class="btn btn-primary"><i class="fa fa-file visible-xs"></i><span class="hidden-xs"><?=$this->lang->line('application_preview');?></span></a>
			<!-- <a href="<?=base_url()?>invoices/previewHTML/<?=$invoice->id;?>" class="btn btn-primary" target="_blank"><i class="fa fa-file visible-xs"></i><span class="hidden-xs"><?=$this->lang->line('application_HTML_Preview');?></span></a>-->
			<?php if($invoice->status != "Paid" && isset($invoice->company->name)){ ?><a href="<?=base_url()?>invoices/sendinvoice/<?=$invoice->id;?>" class="btn btn-primary"><i class="fa fa-envelope visible-xs"></i><span class="hidden-xs"><?=$this->lang->line('application_send_invoice_to_client');?></span></a><?php } ?>

              </div>
          </div>
          <div class="row">

		<div class="col-md-12">
		<div class="table-head"><?=$this->lang->line('application_invoice_details');?></div>
		<div class="subcont">
		<ul class="details col-xs-12 col-sm-6">
			<li><span><?=$this->lang->line('application_invoice_id');?>:</span> <?=$invoice->reference;?></li>
			<li class="<?=$invoice->status;?>"><span><?=$this->lang->line('application_status');?>:</span>
			<a class="label label-default <?php $unix = human_to_unix($invoice->sent_date.' 00:00'); $unix2 = human_to_unix($invoice->paid_date.' 00:00'); if($invoice->status == "Paid"){echo 'label-success tt" title="'.date($core_settings->date_format, $unix2);}elseif($invoice->status == "Sent"){ echo 'label-warning tt" title="'.date($core_settings->date_format, $unix);} ?>"><?=$this->lang->line('application_'.$invoice->status);?>
			</a>
			</li>
			<li><span><?=$this->lang->line('application_issue_date');?>:</span> <?php $unix = human_to_unix($invoice->issue_date.' 00:00'); echo date($core_settings->date_format, $unix);?></li>
			<li><span><?=$this->lang->line('application_due_date');?>:</span> <a class="label label-default <?php if($invoice->status == "Paid"){echo 'label-success';} if($invoice->due_date <= date('Y-m-d') && $invoice->status != "Paid"){ echo 'label-important tt" title="'.$this->lang->line('application_overdue'); } ?>"><?php $unix = human_to_unix($invoice->due_date.' 00:00'); echo date($core_settings->date_format, $unix);?></a></li>
			<?php if(isset($invoice->company->vat)){?> 
			<li><span><?=$this->lang->line('application_vat');?>:</span> <?php echo $invoice->company->vat; ?></li>
			<?php } ?>
			<?php if(isset($invoice->project->name)){?>
			<li><span><?=$this->lang->line('application_projects');?>:</span> <?php echo $invoice->project->name; ?></li>
			<?php } ?>
			<span class="visible-xs"></span>
		</ul>
		<ul class="details col-xs-12 col-sm-6">
			<?php if(isset($invoice->company->name)){ ?>
			<li><span><?=$this->lang->line('application_company');?>:</span> <a href="<?=base_url()?>clients/view/<?=$invoice->company->id;?>" class="label label-info"><?=$invoice->company->name;?></a></li>
			<li><span><?=$this->lang->line('application_contact');?>:</span> <?php if(isset($invoice->company->client->firstname)){ ?><?=$invoice->company->client->firstname;?> <?=$invoice->company->client->lastname;?> <?php }else{echo "-";} ?></li>
			<li><span><?=$this->lang->line('application_street');?>:</span> <?=$invoice->company->address;?></li>
			<li><span><?=$this->lang->line('application_city');?>:</span> <?=$invoice->company->zipcode;?> <?=$invoice->company->city;?></li>
			
			<?php }else{ ?>
				<li><?=$this->lang->line('application_no_client_assigned');?></li>
			<?php } ?>
		</ul>
		<br clear="all">
		</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-12">
		<div class="table-head"><?=$this->lang->line('application_invoice_items');?> <?php if($invoice->estimate_status != "Invoiced"){ ?><span class=" pull-right"><a href="<?=base_url()?>invoices/item/<?=$invoice->id;?>" class="btn btn-md btn-primary" data-toggle="mainmodal"><i class="fa fa fa-plus visible-xs"></i><span class="hidden-xs"><?=$this->lang->line('application_add_item');?></span></a></span><?php } ?></div>
		<div class="table-div min-height-200">
		<table class="table noclick" id="items" rel="<?=base_url()?>" cellspacing="0" cellpadding="0">
		<thead>
		<th width="4%"><?=$this->lang->line('application_action');?></th>
			<th><?=$this->lang->line('application_name');?></th>
			<th class="hidden-xs"><?=$this->lang->line('application_description');?></th>
			<th class="hidden-xs" width="8%"><?=$this->lang->line('application_hrs_qty');?></th>
			<th class="hidden-xs" width="12%"><?=$this->lang->line('application_unit_price');?></th>
			<th class="hidden-xs" width="12%"><?=$this->lang->line('application_sub_total');?></th>
		</thead>
		<?php $i = 0; $sum = 0;?>
		<?php foreach ($items as $value):?>
		<tr id="<?=$value->id;?>" >
		<td class="option" style="text-align:left;" width="8%">
		<?php if($invoice->estimate_status != "Invoiced"){ ?>
				        <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left" data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?=base_url()?>invoices/item_delete/<?=$invoice->invoice_has_items[$i]->id;?>/<?=$invoice->id;?>'><?=$this->lang->line('application_yes_im_sure');?></a> <button class='btn po-close'><?=$this->lang->line('application_no');?></button> <input type='hidden' name='td-id' class='id' value='<?=$value->id;?>'>" data-original-title="<b><?=$this->lang->line('application_really_delete');?></b>"><i class="fa fa-edit" title="Modifier"></i></button>
				        <a href="<?=base_url()?>invoices/item_update/<?=$invoice->invoice_has_items[$i]->id;?>" title="<?=$this->lang->line('application_edit');?>" class="btn-option" data-toggle="mainmodal"><i class="fa fa-edit" title="Modifier"></i></a>
						<?php } else{ echo '<i class="btn-option fa fa-lock"></i>';}?>
			</td>
	
			<td><?php if(!empty($value->name)){echo $value->name;}else{ echo $invoice->invoice_has_items[$i]->item->name; }?></td>
			<td class="hidden-xs"><?=$invoice->invoice_has_items[$i]->description;?></td>
			<td class="hidden-xs" align="center"><?=$invoice->invoice_has_items[$i]->amount;?></td>
			<td class="hidden-xs"><?php echo sprintf("%01.2f",$invoice->invoice_has_items[$i]->value);?></td>
			<td class="hidden-xs"><?php echo sprintf("%01.2f",$invoice->invoice_has_items[$i]->amount*$invoice->invoice_has_items[$i]->value);?></td>

		</tr>
		
		<?php $sum = $sum+$invoice->invoice_has_items[$i]->amount*$invoice->invoice_has_items[$i]->value; $i++;?>
		
		<?php endforeach;
		if(empty($items)){ echo "<tr><td colspan='6'>".$this->lang->line('application_no_items_yet')."</td></tr>";}
		if(substr($invoice->discount, -1) == "%"){ $discount = sprintf("%01.2f", round(($sum/100)*substr($invoice->discount, 0, -1), 2)); }
		else{$discount = $invoice->discount;}
		$sum = $sum-$discount;

		if($invoice->tax != ""){
			$tax_value = $invoice->tax;
		}else{
			$tax_value = $core_settings->tax;
		}

		$tax = sprintf("%01.2f", round(($sum/100)*$tax_value, 2));
		$sum = sprintf("%01.2f", round($sum+$tax, 2));
		?>
		<?php if ($discount != 0): ?>
		<tr>
			<td colspan="5" align="right"><?=$this->lang->line('application_discount');?></td>
			<td>- <?=$invoice->discount;?></td>
		</tr>	
		<?php endif ?>
		<?php if ($tax_value != "0"){ ?>
		<tr>
			<td colspan="5" align="right"><?=$this->lang->line('application_tax');?> (<?= $tax_value?>%)</td>
			<td><?=$tax?></td>
		</tr>
		<?php } ?>
		<tr class="active">
			<td colspan="5" align="right"><?=$this->lang->line('application_total');?></td>
			<td> <?=$invoice->currency?> <?=$sum;?></td>
		</tr>
		</table>
		
		</div>
		<div class="row">


<div class=" col-md-12" align="right">
			<?php if($core_settings->paypal == "1" && $sum != "0.00" && $invoice->status != "paid"){ 

				//Get currency
				# PHP ISO currency => name list
				$currency = $invoice->currency;
			    $currency_codes = array("AFA"=>"Afghani","AFN"=>"Afghani","ALK"=>"Albanian old lek","ALL"=>"Lek","DZD"=>"Algerian Dinar","USD"=>"US Dollar","ADF"=>"Andorran Franc","ADP"=>"Andorran Peseta","EUR"=>"Euro","AOR"=>"Angolan Kwanza Readjustado","AON"=>"Angolan New Kwanza","AOA"=>"Kwanza","XCD"=>"East Caribbean Dollar","ARA"=>"Argentine austral","ARS"=>"Argentine Peso","ARL"=>"Argentine peso ley","ARM"=>"Argentine peso moneda nacional","ARP"=>"Peso argentino","AMD"=>"Armenian Dram","AWG"=>"Aruban Guilder","AUD"=>"Australian Dollar","ATS"=>"Austrian Schilling","AZM"=>"Azerbaijani manat","AZN"=>"Azerbaijanian Manat","BSD"=>"Bahamian Dollar","BHD"=>"Bahraini Dinar","BDT"=>"Taka","BBD"=>"Barbados Dollar","BYR"=>"Belarussian Ruble","BEC"=>"Belgian Franc (convertible)","BEF"=>"Belgian Franc (currency union with LUF)","BEL"=>"Belgian Franc (financial)","BZD"=>"Belize Dollar","XOF"=>"CFA Franc BCEAO","BMD"=>"Bermudian Dollar","INR"=>"Indian Rupee","BTN"=>"Ngultrum","BOP"=>"Bolivian peso","BOB"=>"Boliviano","BOV"=>"Mvdol","BAM"=>"Convertible Marks","BWP"=>"Pula","NOK"=>"Norwegian Krone","BRC"=>"Brazilian cruzado","BRB"=>"Brazilian cruzeiro","BRL"=>"Brazilian Real","BND"=>"Brunei Dollar","BGN"=>"Bulgarian Lev","BGJ"=>"Bulgarian lev A/52","BGK"=>"Bulgarian lev A/62","BGL"=>"Bulgarian lev A/99","BIF"=>"Burundi Franc","KHR"=>"Riel","XAF"=>"CFA Franc BEAC","CAD"=>"Canadian Dollar","CVE"=>"Cape Verde Escudo","KYD"=>"Cayman Islands Dollar","CLP"=>"Chilean Peso","CLF"=>"Unidades de fomento","CNX"=>"Chinese People's Bank dollar","CNY"=>"Yuan Renminbi","COP"=>"Colombian Peso","COU"=>"Unidad de Valor real","KMF"=>"Comoro Franc","CDF"=>"Franc Congolais","NZD"=>"New Zealand Dollar","CRC"=>"Costa Rican Colon","HRK"=>"Croatian Kuna","CUP"=>"Cuban Peso","CYP"=>"Cyprus Pound","CZK"=>"Czech Koruna","CSK"=>"Czechoslovak koruna","CSJ"=>"Czechoslovak koruna A/53","DKK"=>"Danish Krone","DJF"=>"Djibouti Franc","DOP"=>"Dominican Peso","ECS"=>"Ecuador sucre","EGP"=>"Egyptian Pound","SVC"=>"Salvadoran colón","EQE"=>"Equatorial Guinean ekwele","ERN"=>"Nakfa","EEK"=>"Kroon","ETB"=>"Ethiopian Birr","FKP"=>"Falkland Island Pound","FJD"=>"Fiji Dollar","FIM"=>"Finnish Markka","FRF"=>"French Franc","XFO"=>"Gold-Franc","XPF"=>"CFP Franc","GMD"=>"Dalasi","GEL"=>"Lari","DDM"=>"East German Mark of the GDR (East Germany)","DEM"=>"Deutsche Mark","GHS"=>"Ghana Cedi","GHC"=>"Ghanaian cedi","GIP"=>"Gibraltar Pound","GRD"=>"Greek Drachma","GTQ"=>"Quetzal","GNF"=>"Guinea Franc","GNE"=>"Guinean syli","GWP"=>"Guinea-Bissau Peso","GYD"=>"Guyana Dollar","HTG"=>"Gourde","HNL"=>"Lempira","HKD"=>"Hong Kong Dollar","HUF"=>"Forint","ISK"=>"Iceland Krona","ISJ"=>"Icelandic old krona","IDR"=>"Rupiah","IRR"=>"Iranian Rial","IQD"=>"Iraqi Dinar","IEP"=>"Irish Pound (Punt in Irish language)","ILP"=>"Israeli lira","ILR"=>"Israeli old sheqel","ILS"=>"New Israeli Sheqel","ITL"=>"Italian Lira","JMD"=>"Jamaican Dollar","JPY"=>"Yen","JOD"=>"Jordanian Dinar","KZT"=>"Tenge","KES"=>"Kenyan Shilling","KPW"=>"North Korean Won","KRW"=>"Won","KWD"=>"Kuwaiti Dinar","KGS"=>"Som","LAK"=>"Kip","LAJ"=>"Lao kip","LVL"=>"Latvian Lats","LBP"=>"Lebanese Pound","LSL"=>"Loti","ZAR"=>"Rand","LRD"=>"Liberian Dollar","LYD"=>"Libyan Dinar","CHF"=>"Swiss Franc","LTL"=>"Lithuanian Litas","LUF"=>"Luxembourg Franc (currency union with BEF)","MOP"=>"Pataca","MKD"=>"Denar","MKN"=>"Former Yugoslav Republic of Macedonia denar A/93","MGA"=>"Malagasy Ariary","MGF"=>"Malagasy franc","MWK"=>"Kwacha","MYR"=>"Malaysian Ringgit","MVQ"=>"Maldive rupee","MVR"=>"Rufiyaa","MAF"=>"Mali franc","MTL"=>"Maltese Lira","MRO"=>"Ouguiya","MUR"=>"Mauritius Rupee","MXN"=>"Mexican Peso","MXP"=>"Mexican peso","MXV"=>"Mexican Unidad de Inversion (UDI)","MDL"=>"Moldovan Leu","MCF"=>"Monegasque franc (currency union with FRF)","MNT"=>"Tugrik","MAD"=>"Moroccan Dirham","MZN"=>"Metical","MZM"=>"Mozambican metical","MMK"=>"Kyat","NAD"=>"Namibia Dollar","NPR"=>"Nepalese Rupee","NLG"=>"Netherlands Guilder","ANG"=>"Netherlands Antillian Guilder","NIO"=>"Cordoba Oro","NGN"=>"Naira","OMR"=>"Rial Omani","PKR"=>"Pakistan Rupee","PAB"=>"Balboa","PGK"=>"Kina","PYG"=>"Guarani","YDD"=>"South Yemeni dinar","PEN"=>"Nuevo Sol","PEI"=>"Peruvian inti","PEH"=>"Peruvian sol","PHP"=>"Philippine Peso","PLZ"=>"Polish zloty A/94","PLN"=>"Zloty","PTE"=>"Portuguese Escudo","TPE"=>"Portuguese Timorese escudo","QAR"=>"Qatari Rial","RON"=>"New Leu","ROL"=>"Romanian leu A/05","ROK"=>"Romanian leu A/52","RUB"=>"Russian Ruble","RWF"=>"Rwanda Franc","SHP"=>"Saint Helena Pound","WST"=>"Tala","STD"=>"Dobra","SAR"=>"Saudi Riyal","RSD"=>"Serbian Dinar","CSD"=>"Serbian Dinar","SCR"=>"Seychelles Rupee","SLL"=>"Leone","SGD"=>"Singapore Dollar","SKK"=>"Slovak Koruna","SIT"=>"Slovenian Tolar","SBD"=>"Solomon Islands Dollar","SOS"=>"Somali Shilling","ZAL"=>"South African financial rand (Funds code) (discont","ESP"=>"Spanish Peseta","ESA"=>"Spanish peseta (account A)","ESB"=>"Spanish peseta (account B)","LKR"=>"Sri Lanka Rupee","SDD"=>"Sudanese Dinar","SDP"=>"Sudanese Pound","SDG"=>"Sudanese Pound","SRD"=>"Surinam Dollar","SRG"=>"Suriname guilder","SZL"=>"Lilangeni","SEK"=>"Swedish Krona","CHE"=>"WIR Euro","CHW"=>"WIR Franc","SYP"=>"Syrian Pound","TWD"=>"New Taiwan Dollar","TJS"=>"Somoni","TJR"=>"Tajikistan ruble","TZS"=>"Tanzanian Shilling","THB"=>"Baht","TOP"=>"Pa'anga","TTD"=>"Trinidata and Tobago Dollar","TND"=>"Tunisian Dinar","TRY"=>"New Turkish Lira","TRL"=>"Turkish lira A/05","TMM"=>"Manat","RUR"=>"Russian rubleA/97","SUR"=>"Soviet Union ruble","UGX"=>"Uganda Shilling","UGS"=>"Ugandan shilling A/87","UAH"=>"Hryvnia","UAK"=>"Ukrainian karbovanets","AED"=>"UAE Dirham","GBP"=>"Pound Sterling","USN"=>"US Dollar (Next Day)","USS"=>"US Dollar (Same Day)","UYU"=>"Peso Uruguayo","UYN"=>"Uruguay old peso","UYI"=>"Uruguay Peso en Unidades Indexadas","UZS"=>"Uzbekistan Sum","VUV"=>"Vatu","VEF"=>"Bolivar Fuerte","VEB"=>"Venezuelan Bolivar","VND"=>"Dong","VNC"=>"Vietnamese old dong","YER"=>"Yemeni Rial","YUD"=>"Yugoslav Dinar","YUM"=>"Yugoslav dinar (new)","ZRN"=>"Zairean New Zaire","ZRZ"=>"Zairean Zaire","ZMK"=>"Kwacha","ZWD"=>"Zimbabwe Dollar","ZWC"=>"Zimbabwe Rhodesian dollar");
				if(!array_key_exists($currency, $currency_codes)){
					$currency = $core_settings->paypal_currency;
				}

				?>
						<form action="https://www.paypal.com/cgi-bin/webscr" id="paypal" method="post">
						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="business" value="<?=$core_settings->paypal_account;?>">
						<input type="hidden" name="item_name" value="<?=$invoice->reference;?>">
						<input type="hidden" name="item_number" value="<?=$invoice->reference;?>">
						<input type="hidden" name="image_url" value="<?=base_url()?><?=$core_settings->invoice_logo;?>">
						<input type="hidden" name="amount" value="<?=$sum;?>">
						<input type="hidden" name="no_shipping" value="1">
						<input type="hidden" name="no_note" value="1">
						<input type="hidden" name="currency_code" value="<?=$currency;?>">
						<input type="hidden" name="bn" value="FC-BuyNow">
						<input type="hidden" name="return" value="<?=base_url()?>invoices/view/<?=$invoice->id;?>"> 
						<input type="hidden" name="cancel_return" value="<?=base_url()?>invoices/view/<?=$invoice->id;?>">
						<input type="hidden" name="rm" value="2">
						<input type="hidden" name="notify_url" value="<?=base_url()?>paypalipn" /> 
						<input type="hidden" name="custom" value="invoice-<?=$sum;?>">     
						</form>
						<?php } ?>

	<div class="btn-group dropup">
	  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	    <?=$this->lang->line('application_pay_invoice');?> <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu dropdown-menu-right" role="menu">
	  <?php if($core_settings->bank_transfer == "1" && $sum != "0.00" && $invoice->status != "paid" ){ ?>
	    <li><a id="pay_bank_transfer" data-toggle="mainmodal" href="<?=base_url()?>invoices/banktransfer/<?=$invoice->id;?>/<?=$sum;?>"><i class="fa fa-money" style="margin-right:5px"></i>  <?=$this->lang->line('application_bank_transfer');?></a></li>
	  <?php } ?>

	  <?php if($core_settings->paypal == "1" && $sum != "0.00" && $invoice->status != "paid" ){ ?>  
	    <li><a id="pay_paypal" onclick="javascript:document.forms['paypal'].submit();" href="#"><i class="fa fa-paypal" style="margin-right:5px"></i>  <?=$this->lang->line('application_paypal');?></a></li>
	  <?php } ?>

	  <?php if($core_settings->stripe == "1" && $sum != "0.00" && $invoice->status != "paid" ){ ?>  
	    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	    <li><a id="pay_credit_card" data-toggle="mainmodal" href="<?=base_url()?>invoices/stripepay/<?=$invoice->id;?>/<?=$sum;?>"><i class="fa fa-credit-card" style="margin-right:5px"></i> <?=$this->lang->line('application_credit_card');?></a></li>
	  <?php } ?>
	  </ul>
	</div>

</div>	
</div>




<br>



		</div>
		</div>

		

