<?php

use Config\OccConfig;
use App\Models\CompanyModel;
use App\Models\SettingModel;


    function display_money($value, $currency = FALSE,$decimal= FALSE)
    {
        
        $settingModel=new SettingModel();
        $settings = $settingModel->first();
        
        if($decimal == FALSE){ 
            $decimal=$settings['money_display'];
        }
        
        switch ($settings['money_format']) {
            case 1:
                $value = number_format($value, $decimal, '.', '');
                break;
            case 2:
                $value = number_format($value, $decimal, '.', '');
                break;
            case 3:
                $value = number_format($value, $decimal, '.', '');
                break;
            case 4:
                $value = number_format($value, $decimal, '.', '');
                break;
            default:
                $value = number_format($value, $decimal, '.', '');
                break;
        }
        switch ($settings['money_currency_position']) {
            case 1:
                $return = $currency.' '.$value;
                break;
            case 2:
                $return = $value.' '.$currency;
                break; 
            case false:
                $return = $value;
                break;          
            default:
                $return = $currency.' '.$value;
                break;
        }

        return $return;
    }
if ( ! function_exists('form_dropdown'))
{
	function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
	{
		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}

		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0)
		{
			// If the form name appears in the $_POST array we have a winner!
			if (isset($_POST[$name]))
			{
				$selected = array($_POST[$name]);
			}
		}

		if ($extra != '') $extra = ' '.$extra;

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val) && ! empty($val))
			{
				$form .= '<optgroup label="'.$key.'">'."\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}

				$form .= '</optgroup>'."\n";
			}
			else
			{
				$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

				$form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
			}
		}

		$form .= '</select>';

		return $form;
	}
}


if (!function_exists('display_money')) {
    function display_money($value, $currency = false, $decimal = false)
    {
        $settingModel = model(SettingModel::class);  // Use model() helper
        $settings = $settingModel->first();

        if ($decimal === false) {
            $decimal = $settings->money_display ?? 2;  // Use default decimal if setting is not set
        }

        // Format money according to money format setting
        $separator = '.';
        $decimalPoint = ',';
        
        switch ($settings->money_format ?? 1) {
            case 2:
                $separator = '.';
                $decimalPoint = ',';
                break;
            case 3:
                $separator = '';
                $decimalPoint = '.';
                break;
            case 4:
                $separator = '';
                $decimalPoint = ',';
                break;
            default:
                $separator = ',';
                $decimalPoint = '.';
        }

        $value = number_format($value, $decimal, $decimalPoint, $separator);

        // Currency position formatting
        switch ($settings->money_currency_position ?? 1) {
            case 1:
                return $currency . ' ' . $value;
            case 2:
                return $value . ' ' . $currency;
            default:
                return $value;
        }
    }
}
function getTotalHeures($sum_heures, $sum_minutes){
    return $sum_heures + FLOOR($sum_minutes/60);
}
function getResteMinutes($sum_minutes){
    return $sum_minutes % 60;
}
if ( ! function_exists('form_open_multipart'))
{
	function form_open_multipart($action = '', $attributes = array(), $hidden = array())
	{
		if (is_string($attributes))
		{
			$attributes .= ' enctype="multipart/form-data"';
		}
		else
		{
			$attributes['enctype'] = 'multipart/form-data';
		}

		return form_open($action, $attributes, $hidden);
	}
}
if ( ! function_exists('_attributes_to_string'))
{
    function _attributes_to_string($attributes, $formtag = FALSE)
    {
        if (is_string($attributes) AND strlen($attributes) > 0)
        {
            if ($formtag == TRUE AND strpos($attributes, 'method=') === FALSE)
            {
                $attributes .= ' method="post"';
            }

            if ($formtag == TRUE AND strpos($attributes, 'accept-charset=') === FALSE)
            {
                $attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
            }

        return ' '.$attributes;
        }

        if (is_object($attributes) AND count($attributes) > 0)
        {
            $attributes = (array)$attributes;
        }

        if (is_array($attributes) AND count($attributes) > 0)
        {
            $atts = '';

            if ( ! isset($attributes['method']) AND $formtag === TRUE)
            {
                $atts .= ' method="post"';
            }

            if ( ! isset($attributes['accept-charset']) AND $formtag === TRUE)
            {
                $atts .= ' accept-charset="'.strtolower(config_item('charset')).'"';
            }

            foreach ($attributes as $key => $val)
            {
                $atts .= ' '.$key.'="'.$val.'"';
            }

            return $atts;
        }
    }
}
if ( ! function_exists('config_item'))
{
	function config_item($item)
	{
		static $_config_item = array();

		if ( ! isset($_config_item[$item]))
		{
			$config =& get_config();

			if ( ! isset($config[$item]))
			{
				return FALSE;
			}
			$_config_item[$item] = $config[$item];
		}

		return $_config_item[$item];
	}
}
if ( ! function_exists('get_config'))
{
	function &get_config($replace = array())
	{
		static $_config;

		if (isset($_config))
		{
			return $_config[0];
		}

	
		//require($file_path);

		// Does the $config array exist in the file?
		

		// Are any values being dynamically replaced?
		if (count($replace) > 0)
		{
			foreach ($replace as $key => $val)
			{
				if (isset($config[$key]))
				{
					$config[$key] = $val;
				}
			}
		}

		$_config[0] =& $config;
		return $_config[0];
	}
}
if ( ! function_exists('form_open'))
{
	function form_open(string $action = '', mixed $attributes = '', array $hidden = []): string
{
    // Accessing the configuration and services
    $config = config('App'); // Access the App config
    $security = service('security'); // Access the security service
    $uri = service('uri'); // Access the URI service

    // Set default method to POST if no attributes are provided
    if (empty($attributes)) {
        $attributes = 'method="post"';
    }

    // If an action is not a full URL, convert it into one
    if ($action && strpos($action, '://') === false) {
        $action = site_url($action);
    }

    // If no action is provided, set it to the current URL
    if (empty($action)) {
        $action = site_url($uri->getPath());
    }

    // Begin form tag
    $form = '<form action="' . $action . '"';

    // Add additional attributes if present
    if (!empty($attributes)) {
        $form .= _attributes_to_string($attributes, true);
    }

    $form .= '>';

    // Add CSRF protection field if enabled, but not for GET requests or external URLs
    if (strpos($action, base_url()) !== false && strpos($form, 'method="get"') === false) {
       // $hidden[$security->getCSRFTokenName()] = $security->getCSRFHash();
    }
   
    // Add hidden fields if provided
    if (!empty($hidden)) {
        $form .= sprintf('<div style="display:none">%s</div>', form_hidden($hidden));
    }

    return $form;
}


}

if ( ! function_exists('form_close'))
{
	function form_close($extra = '')
	{
		return "</form>".$extra;
	}
}

function libelleMois(){
    
    return array("01" => lang('application.application_Jan'),
        "02" => lang('application.application_Feb'),
        "03" => lang('application.application_Mar'),
        "04" => lang('application.application_Apr'),
        "05" => lang('application.application_May'),
        "06" => lang('application.application_Jun'),
        "07" => lang('application.application_Jul'),
        "08" => lang('application.application_Aug'),
        "09" => lang('application.application_Sep'),
        "10" => lang('application.application_Oct'),
        "11" => lang('application.application_Nov'),
        "12" => lang('application.application_Dec'));
}
 function suiviTooltipContent(array $projets, array $sujets, int $id_user, string $date): string
{
    // Find the project for the user and date
    $projet = collect($projets)->filter(function ($projet) use ($id_user, $date) {
        $start = $projet->start;
        $end = $projet->end;

        return $projet->salaries_id == $id_user && $date >= $start && $date <= $end;
    })->first();

    // Filter the subjects for the user and date
    $sujet = collect($sujets)->filter(function ($sujet) use ($id_user, $date) {
        return $sujet->salaries_id == $id_user && $sujet->date == $date;
    });

    // If there are subjects, build the result
    if ($sujet->count() > 0) {
        $result = "Les tâches du jour : <br>";

        foreach ($sujet as $s) {
            $ch = '';

            if (!is_null($s->code)) {
                $ch = "-" . $s->code . " " . ($s->heures_pointees) . "h" . "<br>";
            } elseif (!is_null($s->subject)) {
                $ch = "-" . $s->subject . " -- " . ($projet->name ?? 'N/A') . " " . ($s->heures_pointees) . "h" . "<br>";
            }

            $result .= $ch;
        }

        return $result;
    }

    return ''; // Return empty string if no subjects found
}
function iconeDeSuivi(array $events, int $id_user, string $date): string
{
    $imgTag = '<img class="iconsimg" id="icons" src="';

    // Find the matching event for the user and date
    $filteredEvents = array_filter($events, function ($event) use ($id_user, $date) {
        return $event['salaries_id'] == $id_user && $event['date'] == $date;
    });

    // Get the first matching event
    $event = reset($filteredEvents); // Returns the first element or false if empty

    // If no event is found, return an empty string
    if ($event === false) {
        return "";
    }

    // Determine the icon based on the event's code and hours
    if ($event['code'] === "TICKET_JFERIER" && $event['heures_pointees'] === "8.00") {
        return $imgTag . base_url('/assets/suivi/img/efface.png') . '">';
    } elseif ($event['code'] === "TICKET_CONGES" && $event['heures_pointees'] > "4.00") {
        return $imgTag . base_url('/assets/suivi/img/holliday.png') . '">';
    } elseif ($event['code'] === "TICKET_MALADIE" && $event['heures_pointees'] >= "4.00") {
        return $imgTag . base_url('/assets/suivi/img/maladie.png') . '">';
    } else {
        return $imgTag . base_url('/assets/suivi/img/workspace.png') . '">';
    }
}
if (!function_exists('GetType_txt')) {
    function GetType_txt($id_type)
    {
        // Get the database instance
        $db = \Config\Database::connect(); // CI4 database connection

        // Query the database
        $builder = $db->table('ref_type_occurences');
        $builder->select('name');
        $builder->where('id', $id_type);
        $query = $builder->get();

        // Check if the result exists and return the name or an empty string
        $row = $query->getRow(); // Get the first row from the result
        if ($row) {
            return $row->name; // Return the 'name' field if it exists
        } else {
            return ''; // Return empty string if no result
        }
    }
}
function numberFormatPrecision($number, $decimals = 3, $sep = " ", $k = ",")
{
    $number = bcdiv($number, 1, $decimals); // Truncate decimals without rounding
    return number_format($number, $decimals, $sep, $k); // Format the number
}
function get_month_name($month)
{
    $month_name_format = new IntlDateFormatter(
        'en_US.UTF8',
        IntlDateFormatter::NONE,
        IntlDateFormatter::NONE,
        NULL,
        NULL,
        "LLLL"
    );

    return datefmt_format($month_name_format, mktime(0, 0, 0, $month));
}
function get_salaries_icon($id_type)
{

    if ($id_type == 82) {

        $icon = '<img class="itemimg" data-toggle="popover" src="' . base_url('/assets/suivi/img/femme.png') . '">';
    } else {
        $icon = '<img class="itemimg" data-toggle="popover" src="' . base_url('/assets/suivi/img/avatar.png') . '">';
    }

    return $icon;
}
function get_etat_color($id_statut)
{
    $config = new OccConfig();
  

    switch ($id_statut) {
        // OUVERT
        case $config->occ_facture_ouvert:
        case $config->occ_devis_ouvert:
        case $config->occ_avoir_ouvert:
            return "<span class='label label-warning'>Ouvert</span>";
        
        // ENVOYE
        case $config->occ_avoir_envoye:
        case $config->occ_devis_envoye:
        case $config->occ_facture_envoye:
            return "<span class='label label-info'>Envoyé</span>";
        
        // PARTIELLEMENT PAYE
        case $config->occ_avoir_p_paye:
        case $config->occ_facture_p_paye:
            return "<span class='label label-chilled'>Partiellement Payé</span>";
        
        // PAYE
        case $config->occ_avoir_paye:
        case $config->occ_facture_paye:
            return "<span class='label label-success'>Payé</span>";
        
        // ACCEPTE
        case $config->occ_devis_accepte:
            return "<span class='label label-chilled'>Accepté</span>";
        
        // REFUSE
        case $config->occ_devis_refuse:
            return "<span class='label label-important'>Refusé</span>";
        
        // DEVIS FACTURE
        case $config->occ_devis_facture:
            return "<span class='label label-success'>Facturé</span>";
        
        // FACTURE -> Avoir
        case $config->occ_facture_avoir:
            // var_dump('hi');
            // die;
            return "<span class='label label-info'>Avoir</span>";

        // Default case if no match found
        default:
            return "<span class='label label-warning'>??</span>";
    }
}
function salaries_fun($id)
{
    $db = db_connect(); // Load the database connection
    $builder = $db->table('salaries');
    $builder->select('ref_type_occurences.name');
    $builder->join('ref_type_occurences', 'salaries.idfonction = ref_type_occurences.id');
    $builder->where('salaries.id', $id);
    $query = $builder->get();

    $result = $query->getRow();
    return $result ? $result->name : null; // Return name or null if not found
}

function situation_familiale($id)
{
    $db = db_connect(); // Load the database connection
    $builder = $db->table('salaries');
    $builder->select('ref_type_occurences.name');
    $builder->join('ref_type_occurences', 'salaries.situationfamiliale = ref_type_occurences.id');
    $builder->where('salaries.id', $id);
    $query = $builder->get();

    $result = $query->getRow();
    return $result ? $result->name : null; // Return name or null if not found
}

if (!function_exists('get_money_format')) {
    function get_money_format()
    {
        $settingModel = model(SettingModel::class);
        $settings = $settingModel->first();

        $currency = $settings->currency ?? '';
        $separator = ',';
        $decimalPoint = '.';

        switch ($settings->money_format ?? 1) {
            case 2:
                $separator = '.';
                $decimalPoint = ',';
                break;
            case 3:
                $separator = '';
                $decimalPoint = '.';
                break;
            case 4:
                $separator = '';
                $decimalPoint = ',';
                break;
            default:
                $separator = ',';
                $decimalPoint = '.';
        }

        $prefix = $suffix = "";
        switch ($settings->money_currency_position ?? 1) {
            case 1:
                $prefix = $currency . " ";
                break;
            case 2:
                $suffix = " " . $currency;
                break;
            default:
                $prefix = $currency . " ";
        }

        return "separator : '$separator', decimal : '$decimalPoint', prefix : '$prefix', suffix : '$suffix'";
    }
}

if (!function_exists('get_dates_of_week')) {
    function get_dates_of_week()
    {
        $days = [];
        $days[] = date("Y-m-d", strtotime('this week monday'));
        $days[] = date("Y-m-d", strtotime('this week tuesday'));
        $days[] = date("Y-m-d", strtotime('this week wednesday'));
        $days[] = date("Y-m-d", strtotime('this week thursday'));
        $days[] = date("Y-m-d", strtotime('this week friday'));
        $days[] = date("Y-m-d", strtotime('this week saturday'));
        $days[] = date("Y-m-d", strtotime('this week sunday'));
        return $days;
    }
}
function get_user_pic($pic = FALSE, $email = FALSE, $pixel = FALSE){
    if($pic != 'no-pic.png')
    {
        $image = base_url()."files/media/".$pic;
            if($pixel)
            {
                $pic_in_pixel = base_url()."files/media/".$pixel."_".$pic;
                if(!file_exists($pic_in_pixel)){
                    
                }
                return $pic_in_pixel;
            }else{
                return $image;
            }
            
    }
    else
    {
            return get_gravatar($email);
    }
}
function get_gravatar( $email, $s = 40, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {

    $url = '//www.gravatar.com/avatar/';

    $url .= md5( strtolower( trim( $email ) ) );

    $url .= "?s=$s&d=$d&r=$r";

    if ( !$url ) {
      $url = base_url()."files/media/no-pic.png";
    }

    return $url;

}
   
    function getcompany($iditem)
    {
        $companyModel = new CompanyModel();
        $company = $companyModel->find($iditem); // Retrieves the record by primary key (id)
        
        return $company;
    }
if (!function_exists('get_currency_codes')) {
    function get_currency_codes()
    {
        return [
            "AFA" => "Afghani",
            "AFN" => "Afghani",
            "ALL" => "Lek",
            "DZD" => "Algerian Dinar",
            "USD" => "US Dollar",
            "EUR" => "Euro",
            "AUD" => "Australian Dollar",
            "CAD" => "Canadian Dollar",
            "GBP" => "Pound Sterling",
            "JPY" => "Yen",
            // Add more currency codes as needed
        ];
    }
}

if (!function_exists('get_currency_codes_for_twocheckout')) {
    function get_currency_codes_for_twocheckout()
    {
        return [
            "ARS" => "Argentina Peso",
            "AUD" => "Australian Dollars",
            "BRL" => "Brazilian Real",
            "GBP" => "British Pounds Sterling",
            "CAD" => "Canadian Dollars",
            "EUR" => "Euros",
            "INR" => "Indian Rupee",
            // Add more currency codes as needed
        ];
    }
}
