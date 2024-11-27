<?php
// Helper functions for date and time utilities

/**
 * Get current time
 *
 * Returns current time based on GMT or local setting
 *
 * @return int
 */
function now()
{
    return time();
}

/**
 * Format date with MySQL-style format
 *
 * Allows MySQL-style formatting like %Y-%m-%d instead of PHP format.
 *
 * @param string $datestr
 * @param int $time
 * @return string
 */
function mdate($datestr = '', $time = '')
{
    if ($datestr == '') {
        return '';
    }
    if ($time == '') {
        $time = now();
    }
    $datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
    return date($datestr, $time);
}
if ( ! function_exists('human_to_unix'))
{
	function human_to_unix($datestr = '')
	{
		if ($datestr == '')
		{
			return FALSE;
		}

		$datestr = trim($datestr);
		$datestr = preg_replace("/\040+/", ' ', $datestr);

		if ( ! preg_match('/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr))
		{
			return FALSE;
		}

		$split = explode(' ', $datestr);

		$ex = explode("-", $split['0']);

		$year  = (strlen($ex['0']) == 2) ? '20'.$ex['0'] : $ex['0'];
		$month = (strlen($ex['1']) == 1) ? '0'.$ex['1']  : $ex['1'];
		$day   = (strlen($ex['2']) == 1) ? '0'.$ex['2']  : $ex['2'];

		$ex = explode(":", $split['1']);

		$hour = (strlen($ex['0']) == 1) ? '0'.$ex['0'] : $ex['0'];
		$min  = (strlen($ex['1']) == 1) ? '0'.$ex['1'] : $ex['1'];

		if (isset($ex['2']) && preg_match('/[0-9]{1,2}/', $ex['2']))
		{
			$sec  = (strlen($ex['2']) == 1) ? '0'.$ex['2'] : $ex['2'];
		}
		else
		{
			// Unless specified, seconds get set to zero.
			$sec = '00';
		}

		if (isset($split['2']))
		{
			$ampm = strtolower($split['2']);

			if (substr($ampm, 0, 1) == 'p' AND $hour < 12)
				$hour = $hour + 12;

			if (substr($ampm, 0, 1) == 'a' AND $hour == 12)
				$hour =  '00';

			if (strlen($hour) == 1)
				$hour = '0'.$hour;
		}

		return mktime($hour, $min, $sec, $month, $day, $year);
	}
}

/**
 * Returns formatted date based on standard constants (like DATE_RFC822)
 *
 * @param string $fmt
 * @param int $time
 * @return string|bool
 */
function standard_date($fmt = 'DATE_RFC822', $time = '')
{
    $formats = array(
        'DATE_ATOM' => '%Y-%m-%dT%H:%i:%s%Q',
        'DATE_COOKIE' => '%l, %d-%M-%y %H:%i:%s UTC',
        'DATE_ISO8601' => '%Y-%m-%dT%H:%i:%s%Q',
        'DATE_RFC822' => '%D, %d %M %y %H:%i:%s %O',
        'DATE_RFC850' => '%l, %d-%M-%y %H:%i:%s UTC',
        'DATE_RFC1036' => '%D, %d %M %y %H:%i:%s %O',
        'DATE_RFC1123' => '%D, %d %M %Y %H:%i:%s %O',
        'DATE_RSS' => '%D, %d %M %Y %H:%i:%s %O',
        'DATE_W3C' => '%Y-%m-%dT%H:%i:%s%Q'
    );
    return isset($formats[$fmt]) ? mdate($formats[$fmt], $time) : false;
}

/**
 * Converts seconds into human-readable timespan
 *
 * @param int $seconds
 * @param int $time
 * @return string
 */
function timespan($seconds = 1, $time = '')
{
    $time = is_numeric($time) ? $time : time();
    $seconds = $time <= $seconds ? 1 : $time - $seconds;
    
    $units = [
        'year' => 31536000, 'month' => 2628000, 'week' => 604800,
        'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1
    ];
    $str = '';
    foreach ($units as $name => $divisor) {
        $quotient = floor($seconds / $divisor);
        if ($quotient > 0) {
            $str .= $quotient . ' ' . $name . ($quotient > 1 ? 's' : '') . ', ';
            $seconds -= $quotient * $divisor;
        }
    }
    return rtrim($str, ', ');
}

/**
 * Returns the number of days in a specific month
 *
 * @param int $month
 * @param int $year
 * @return int
 */
function days_in_month($month = 0, $year = '')
{
    if ($month < 1 || $month > 12) return 0;
    $year = is_numeric($year) && strlen($year) == 4 ? $year : date('Y');
    return $month == 2 && ($year % 400 == 0 || ($year % 4 == 0 && $year % 100 != 0)) ? 29 : [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][$month - 1];
}

/**
 * Converts local Unix timestamp to GMT
 *
 * @param int $time
 * @return int
 */
function local_to_gmt($time = '')
{
    return gmdate("U", $time ? $time : time());
}

/**
 * Converts GMT timestamp to local based on timezone offset
 *
 * @param int $time
 * @param string $timezone
 * @param bool $dst
 * @return int
 */
function gmt_to_local($time = '', $timezone = 'UTC', $dst = false)
{
    $time += timezones($timezone) * 3600;
    return $dst ? $time + 3600 : $time;
}

/**
 * Converts a MySQL timestamp (YYYY-MM-DD HH:MM:SS) to Unix timestamp
 *
 * @param string $time
 * @return int
 */
function mysql_to_unix($time = '')
{
    $time = str_replace(['-', ':', ' '], '', $time);
    return mktime(substr($time, 8, 2), substr($time, 10, 2), substr($time, 12, 2), substr($time, 4, 2), substr($time, 6, 2), substr($time, 0, 4));
}

/**
 * Converts Unix timestamp to human-readable format
 *
 * @param int $time
 * @param bool $seconds
 * @param string $fmt
 * @return string
 */
function unix_to_human($time = '', $seconds = false, $fmt = 'us')
{
    $format = $fmt === 'us' ? 'Y-m-d h:i' . ($seconds ? ':s' : '') . ' A' : 'Y-m-d H:i' . ($seconds ? ':s' : '');
    return date($format, $time);
}
if ( ! function_exists('timezones'))
{
	function timezones($tz = '')
	{
		// Note: Don't change the order of these even though
		// some items appear to be in the wrong order

		$zones = array(
						'UM12'		=> -12,
						'UM11'		=> -11,
						'UM10'		=> -10,
						'UM95'		=> -9.5,
						'UM9'		=> -9,
						'UM8'		=> -8,
						'UM7'		=> -7,
						'UM6'		=> -6,
						'UM5'		=> -5,
						'UM45'		=> -4.5,
						'UM4'		=> -4,
						'UM35'		=> -3.5,
						'UM3'		=> -3,
						'UM2'		=> -2,
						'UM1'		=> -1,
						'UTC'		=> 0,
						'UP1'		=> +1,
						'UP2'		=> +2,
						'UP3'		=> +3,
						'UP35'		=> +3.5,
						'UP4'		=> +4,
						'UP45'		=> +4.5,
						'UP5'		=> +5,
						'UP55'		=> +5.5,
						'UP575'		=> +5.75,
						'UP6'		=> +6,
						'UP65'		=> +6.5,
						'UP7'		=> +7,
						'UP8'		=> +8,
						'UP875'		=> +8.75,
						'UP9'		=> +9,
						'UP95'		=> +9.5,
						'UP10'		=> +10,
						'UP105'		=> +10.5,
						'UP11'		=> +11,
						'UP115'		=> +11.5,
						'UP12'		=> +12,
						'UP1275'	=> +12.75,
						'UP13'		=> +13,
						'UP14'		=> +14
					);

		if ($tz == '')
		{
			return $zones;
		}

		if ($tz == 'GMT')
			$tz = 'UTC';

		return ( ! isset($zones[$tz])) ? 0 : $zones[$tz];
	}
}