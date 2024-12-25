<?php
function getUsersList() {
    $file = '../data/data.php';
    if (file_exists($file)) {
        $data = include $file;
        if (!empty($data)) {
            return $data;
        } else {
            return [];
        }
    } 
}

function existsUser($login){
    $data = getUsersList();
    foreach($data as $user){
        if($user['login'] === $login){
            return true;
        }
    }
}

function checkPassword($login, $password){
    $data = getUsersList();
    if(existsUser($login)){
        foreach($data as $user){
            if(password_verify($password, $user['password'])){
                return true;
            }
        }
    }
    else{
        return false;
    }

    return false;
}

function getCurrentUser(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        return $_SESSION['username'];
    }

    return null;
}

function dateBirthday($login){
    $data = include 'data/data.php';
    foreach($data as $user){
        if($user['login'] === $login){
            return $user['birthday'];
        }
    }
    return null;
}

?>