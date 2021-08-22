<?php
function searchUserByEmail($link, $email) {
    $result = null;
    $email = mysqli_real_escape_string($link, $email);
    $sql = "SELECT * FROM `users` WHERE `UserEmail` = '$email'";
    $sql_query = mysqli_query($link, $sql);

    if(!$sql_query) {
        $errorMsg = 'Error: ' . mysqli_error($db_connection);
        die($errorMsg);
    }

    $comparation_result = mysqli_fetch_assoc ($sql_query);

    if ($comparation_result !== NULL) {
        $result = $comparation_result;
    }

    return $result;
};

function include_template($name, $data) {
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

function calculateTimeBids($ts) {
    $time_diff = $_SERVER['REQUEST_TIME'] - $ts;
    if ($time_diff > 86400) { // difference is more than 24h
        $time_return = date('d.m.Y H:i', $ts);
    }
    else if ($time_diff > 3600) { // difference Bidween 1h-24h
        $time_return = date('G', $ts) . ' hours ago';
    }
    else { // less than 1h
        $time_return = intval(date('i', $ts)) . ' minuts ago';
    }
    return $time_return;
}
?>
