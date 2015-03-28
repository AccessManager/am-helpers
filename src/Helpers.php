<?php

function isValidDate($date)
{
	return $date == '0000-00-00 00:00:00' || $date == NULL ? FALSE : TRUE;
}

function calculateCostPerDay( $price )
{
	$cost_per_day = $price / 30;
	return number_format( (float) $cost_per_day,2,'.','');

}

function pr($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	exit;
}

function makeExpiry($units, $unit, $format = 'Y-m-d H:i:s')
{
  $val = Carbon\Carbon::now();
  $add = "add".$unit;
  $val->$add( $units );
  return $val->format($format);
}

function mikrotikRateLimit($object, $prefix = NULL)
{
    $v = (array) $object;
    
    return         "{$v[$prefix.'max_up']}{$v[$prefix.'max_up_unit'][0]}/".
                   "{$v[$prefix.'max_down']}{$v[$prefix.'max_down_unit'][0]} ".
                   "{$v[$prefix.'max_up']}{$v[$prefix.'max_up_unit'][0]}/".
                   "{$v[$prefix.'max_down']}{$v[$prefix.'max_down_unit'][0]} ".
                   "{$v[$prefix.'max_up']}{$v[$prefix.'max_up_unit'][0]}/".
                   "{$v[$prefix.'max_down']}{$v[$prefix.'max_down_unit'][0]} ".
                   "1/1 1 ".
                   "{$v[$prefix.'min_up']}{$v[$prefix.'min_up_unit'][0]}/".
                   "{$v[$prefix.'min_down']}{$v[$prefix.'min_down_unit'][0]}";
}

function formatTime($seconds)
{
  $mins = intval($seconds/60);
  $seconds = $seconds%60;
  $Hrs = intval($mins/60);
  $mins = $mins%60;
  $result = NULL;

  if( $Hrs != 0 ) {
    $result .= " $Hrs Hrs";
  }
  if( $mins != 0 ) {
    $result .= " $mins Mins";
  }
  if( $seconds != 0 ) {
    $result .= " $seconds Secs";
  }
  return $result;
}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
}

function reject($string)
{
      echo "Reply-Message := \"$string\"";
      exit(1);
}

function parseAttributes($z)
{
  $output = preg_replace("/\s+[=]\s+/",'=', $z);
  $output = preg_replace("/\s+/",' ',$output);
  $output = explode(' ',$output);
  $result = [];
    foreach($output as $pair) {
            if(strpos($pair,'=') ){
                    list($k,$v) = explode('=',$pair);
                    $result[$k] = trim($v,'"');
            }
    }
    return $result;
}