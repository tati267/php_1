<?php
function includeTemplate($name, $data) {
    $name = 'templates/' . $name;
    if(file_exists($name)) {
        ob_start();
        extract($data);
        require_once $name;
        $result = ob_get_clean();
    } else {
        $result = '';
    }
return $result;
};

function calculatePrice($price) {
    $price_round = ceil($price);
    if ($price_round<1000) {
        return $price_round;
    } else if($price_round>1000) {
        $price_format = number_format($price_round);
        return $price_format. '<b class="rub">р</b>';
    }
}

function calculateTimer() {
    date_default_timezone_set('Australia/Sydney');
    $curtime = date('H:i:s');
    $future   = strtotime('tomorrow');
    $diff = $future - strtotime($curtime);
    $hours = floor($diff / 3600);
    $min = date('i', $diff);
    print($hours.':'.$min);
}

function calculateTimeBets($ts) {
    $time_diff = $_SERVER['REQUEST_TIME'] - $ts;
    if ($time_diff > 86400) { // difference is more than 24h
        $time_return = date('d.m.Y H:i', $ts);
    }
    else if ($time_diff > 3600) { // difference between 1h-24h
        $time_return = date('G', $ts) . ' hours ago';
    }
    else { // less than 1h
        $time_return = intval(date('i', $ts)) . ' minuts ago';
    }
    return $time_return;
}
?>
