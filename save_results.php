<?php

$users = array(
    array("id" => "1", "name" => "Степан", "email" => "stz.hom@gmail.com"),
    array("id" => "2", "name" => "Ирина", "email" => "iro4ka@yandex.ru"),
    array("id" => "3", "name" => "Константин", "email" => "kostobot@yahoo.com"),
    array("id" => "4", "name" => "Михаил", "email" => "karpovma@mail.ru"),
    array("id" => "5", "name" => "Мария", "email" => "marymoon@inbox.ru")
);

$email = $_POST['email'];
$password = $_POST['password'];
$repeatedPassword = $_POST['repeatedPassword'];

if (checkValidOfEmail($email)) { // если почта в итоге валидна для работы, то

    checkExistOfEmail($email, $users);
    comparePasswords($repeatedPassword, $password);
    
    //---- А дальше смотрим просто по результатам проверок ----//

    $dir = "logs"; 
    if(!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    $file = fopen("logs/results.txt", "a"); 

    if (!checkExistOfEmail($email, $users) && comparePasswords($repeatedPassword, $password)) {
        fwrite($file, date("H:m:s") . "\tПочта " . $email . " не занята\n");
        fclose($file);

        echo 'true';
    } else if (checkExistOfEmail($email, $users) && comparePasswords($repeatedPassword, $password)) {
        fwrite($file, date("H:m:s") . "\tПочта " . $email . " не занята \n");
        fclose($file);

        echo 'email already exists';
    } else if (!checkExistOfEmail($email, $users) && !comparePasswords($repeatedPassword, $password)) {
        fwrite($file, date("H:m:s") . "\tПочта " . $email . " занята \n");
        fclose($file);

        echo 'passwords are not equal';
    } else {
        fwrite($file, date("H:m:s") . "\tПочта " . $email . " занята \n");
        fclose($file);

        echo 'false';
    }
}

else echo 'email is not valid';

//-- Проверяем валидность введеннойпочты --//
function checkValidOfEmail($email) {
    //  обычно используется filter_var($email, FILTER_VALIDATE_EMAIL), 
    // но, по условию тестового задания, мне нужно самому отследить '@' , поэтому 
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
        return true;
    } else {
        return false;
    }
}

//-- Проверяем существование введённой почты уже в "базе" --//
function checkExistOfEmail($email, $users) {
    $countOfUsers = count($users);

    for ($indexOfUser = 0; $indexOfUser < $countOfUsers; $indexOfUser++) {
        if ($email == $users[$indexOfUser]["email"]) {
            return true;
        }            
    }
    return false;
}

//-- Сравниваем на соответствия введённые пароли --//
function comparePasswords($repeatedPassword, $password)
{
    if ($repeatedPassword == $password) {
        return true;
    } else return false;
}