<?php
function searchUserByEmail($link, $email) {
    $result = null;
    $email = mysqli_real_escape_string($link, $email);
    $sql = "SELECT * FROM `users` WHERE `UserEmail` = '$email'";
    $sql_query = mysqli_query($link, $sql);

    if(!$sql_query) {
        $errorMsg = 'Error: ' . mysqli_error($link_connection);
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

function calculate_TimeBids($date) {
    $ts=strtotime($date);
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

function search_id_by_category($link, $category) {
    $sqlCategory = "SELECT CategoryID FROM categories WHERE `CategoryName` = '$category'";
    $category_id = mysqli_query($link, $sqlCategory);

    if(!$category_id) {
        $errorMsg = 'Error: ' . mysqli_error($db_connection);
        die($errorMsg);
    }

    $id = mysqli_fetch_assoc($category_id)['CategoryID'];

    return $id;
}

function search_id_by_user($link, $user_name) {
    $sqlUser = "SELECT UserID FROM users WHERE `UserName` = '$user_name'";
    $user_id = mysqli_query($link, $sqlUser);

    if(!$user_id) {
        $errorMsg = 'Error: ' . mysqli_error($db_connection);
        die($errorMsg);
    }

    $id = mysqli_fetch_assoc($user_id)['UserID'];

    return $id;
}

function validate_form_sign_up($form) {
    require 'init.php';
    $errors = [];
    foreach ($form as $field => $value) {
        if ($field == 'email') {
            $email = mysqli_real_escape_string($link, $value);
            $sql = "SELECT `UserEmail` FROM `Users` WHERE `UserEmail` = '$email'";
            $sql_query = mysqli_query($link, $sql);
            $result = mysqli_fetch_array ($sql_query);

            if ($result !== NULL) {
                $errors[$field] = 'This email is already been used';
            }

            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Email has to be correct';
            }
        }

        if ($field=== 'password') {
            if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/', $value)) {
                $errors['password'] = 'Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters';
            }
        }

        if ($field === 'name') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['name'] = 'Should contain only alphanumeric!';
            }
        }

        if ($field === 'message') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['message'] = 'Should contain only alphanumeric!';
            }
        }

        if (empty($value)) {
            $errors[$field] = 'Fill up this field';
        }
    }
    return $errors;
}

function validate_form_add($form) {
    $errors = [];

    foreach ($form as $field => $value) {
        if ($field=== 'category') {
            if($value==='Select category') {
                $errors['category'] = 'Choose category';
            }
        }

        if ($field=== 'lot-price') {
            if(!filter_var($value, FILTER_VALIDATE_INT)) {
                $errors['lot-price'] = 'Insert integer';
            }
        }

        if ($field === 'lot-step') {
            if(!filter_var($value, FILTER_VALIDATE_INT)) {
                $errors['lot-step'] = 'Insert integer';
            }
        }

        if ($field === 'lot-name') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['lot-name'] = 'should contain only alphanumeric!';
            }
        }

        if ($field === 'message') {
            if (!preg_match('/^[a-zA-Z0-9-_]+$/', $value)) {
                $errors['message'] = 'should contain only alphanumeric!';
            }
        }
        if (empty($value)) {
            $errors[$field] = 'Fill up this field';
        }
    }
    return $errors;
}
?>
