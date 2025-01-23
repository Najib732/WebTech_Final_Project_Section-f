<?php
session_start();
require_once('../model/sql.php');

function isValidUsername($username) {
   
    for ($i = 0; isset($username[$i]); $i++) {
        $char = $username[$i];
        if (!(($char >= 'A' && $char <= 'Z') || ($char >= 'a' && $char <= 'z') || $char == ' ')) {
            return false; 
        }
    }
    return true;
}

function isValidPassword($password) {
    $length = 0;
    $hasSpecialChar = false;
    $specialChars = ['&', '$', '@', '!', '%', '*', '?'];

    for ($i = 0; isset($password[$i]); $i++) {
        $length++;
        for ($j = 0; isset($specialChars[$j]); $j++) {
            if ($password[$i] === $specialChars[$j]) {
                $hasSpecialChar = true;
                break;
            }
        }
    }

    if ($length > 5 && $hasSpecialChar) {
        return true; 
    }
    return false; 
}

function isValidEmail($email) {
  
    $hasAtSymbol = false;
    $hasDot = false;

    for ($i = 0; isset($email[$i]); $i++) {
        if ($email[$i] === '@') {
            $hasAtSymbol = true;
        } elseif ($hasAtSymbol && $email[$i] === '.') {
            $hasDot = true;
        }
    }

    return $hasAtSymbol && $hasDot; 
}

function isValidDate($date) {
   
    $parts = explodeDate($date, '-');
    if (count($parts) !== 3) return false; 

    $year = $parts[0];
    $month = $parts[1];
    $day = $parts[2];

    if (!isNumeric($year) || !isNumeric($month) || !isNumeric($day)) return false;
    if ($month < 1 || $month > 12) return false;
    if ($day < 1 || $day > 31) return false; 

    return true;
}

function isNumeric($value) {
    
    for ($i = 0; isset($value[$i]); $i++) {
        if ($value[$i] < '0' || $value[$i] > '9') {
            return false;
        }
    }
    return true;
}

function explodeDate($string, $delimiter) {
    
    $parts = [];
    $temp = "";

    for ($i = 0; isset($string[$i]); $i++) {
        if ($string[$i] === $delimiter) {
            $parts[] = $temp;
            $temp = "";
        } else {
            $temp .= $string[$i];
        }
    }
    $parts[] = $temp; 
    return $parts;
}

if (isset($_REQUEST['submit'])) {
    $username  = $_REQUEST['username'];
    $password  = $_REQUEST['password'];
    $email     = $_REQUEST['email'];
    $dob       = $_REQUEST['date']; 

    $username = removeSpaces($username);
    $password = removeSpaces($password);
    $email = removeSpaces($email);
    $dob = removeSpaces($dob);

    if ($username === "" || $password === "" || $email === "" || $dob === "") {
        echo "Null data found!";
    } else if (!isValidUsername($username)) {
        echo "Username can only contain letters and spaces.";
    } else if (!isValidPassword($password)) {
        echo "Password must be at least 6 characters long and contain one special character.";
    } else if (!isValidEmail($email)) {
        echo "Invalid email format.";
    } else if (!isValidDate($dob)) {
        echo "Invalid date format!";
    } else {
        $status = addUser($username, $password, $email, $dob); 
        if ($status) {
            header('location: ../view/login.html');
        } else {
            header('location: ../view/signup.html');
        }
    }
} else {
    header('location: ../view/sign.html');
}

function removeSpaces($string) {
    $start = 0;
    $end = countString($string) - 1;

    while ($start <= $end && $string[$start] === ' ') {
        $start++;
    }

  
    while ($end >= $start && $string[$end] === ' ') {
        $end--;
    }

    $trimmed = "";
    for ($i = $start; $i <= $end; $i++) {
        $trimmed .= $string[$i];
    }
    return $trimmed;
}

function countString($string) {
    $length = 0;
    while (isset($string[$length])) {
        $length++;
    }
    return $length;
}
?>
