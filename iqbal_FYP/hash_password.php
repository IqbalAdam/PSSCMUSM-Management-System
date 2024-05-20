<?php
$passwords = ['password1', 'password2', 'password3']; // replace with your actual passwords
$hashed_passwords = [];

foreach ($passwords as $password) {
    $hashed_passwords[] = password_hash($password, PASSWORD_BCRYPT);
}

foreach ($hashed_passwords as $hashed_password) {
    echo $hashed_password . "<br>";
}
?>
