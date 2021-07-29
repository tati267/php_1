<?php
function renderTemplate($name, $data) {
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
?>
