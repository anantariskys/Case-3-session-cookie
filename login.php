<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) && $_POST['rememberMe'] === 'true';

  
    $validEmail = 'kelompok3@gmail.com';
    $validPassword = 'Kelompok3hebat@';
    $fullName = 'Kelompok3';
    $username = 'johndoe';
    $description = 'This is my profile description.';

    if ($email === $validEmail && $password === $validPassword) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $fullName;
        $_SESSION['username'] = $username;
        $_SESSION['description'] = $description;

        if ($rememberMe) {
            setcookie('email', $email,time() + (24 * 60 * 60), '/');
            setcookie('password', $password,time() + (24 * 60 * 60), '/');
        }
        echo 'success';
    } else {
        if ($email !== $validEmail) {
            echo 'Email salah';
        } else {
            echo 'Password salah';
        }
    }
}



