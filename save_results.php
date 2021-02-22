<?php
date_default_timezone_set('Etc/GMT-3');

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

if (isValidEmail($email)) { 
    $dir = "logs";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $file = fopen("logs/results.txt", "a");
    
    if (!isExistingEmail($email, $users) && isEqual($repeatedPassword, $password)) {
        $result = "\tПочта " . $email . " не занята \n";

        echo 'true';
    } else if (isExistingEmail($email, $users) && isEqual($repeatedPassword, $password)) {
        $result = "\tПочта " . $email . " не занята \n";

        echo 'email already exists';
    } else if (!isExistingEmail($email, $users) && !isEqual($repeatedPassword, $password)) {
        $result = "\tПочта " . $email . " занята \n";

        echo 'passwords are not equal';
    } else {        
        $result = "\tПочта " . $email . " занята \n";

        echo 'false';
    }
    
    fwrite($file, date("H:i:s") . $result);
    fclose($file);

} else echo 'email is not valid';

//-- Проверяем валидность введеннойпочты --//
function isValidEmail($email)
{
    //  обычно используется filter_var($email, FILTER_VALIDATE_EMAIL), 
    // но, по условию тестового задания, мне нужно самому отследить '@' , поэтому 
    if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
        return true;
    } else {
        return false;
    }
}

//-- Проверяем существование введённой почты уже в "базе" --//
function isExistingEmail($email, $users)
{
    $countOfUsers = count($users);

    for ($indexOfUser = 0; $indexOfUser < $countOfUsers; $indexOfUser++) {
        if ($email == $users[$indexOfUser]["email"]) {
            return true;
        }
    }
    return false;
}

//-- Сравниваем на соответствия введённые пароли --//
function isEqual($repeatedPassword, $password)
{
    return ($repeatedPassword == $password) ? true : false;
}