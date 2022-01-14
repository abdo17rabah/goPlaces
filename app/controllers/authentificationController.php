<?php

include_once(__DIR__.'/../controllers/usersController.php');

if(isset($_GET['action'])){
    redirect($_GET['action'], $_GET['sess']);
} else {
    redirect();
}

function redirect(String $action = null, String $session = null){
    switch ($action) {
        case 'registration':
            registration();
            break;
        case 'login':
            login();
            break;
        case 'logout':
            logout($session);
        default:
            header('Location: ../');
            exit();
            break;
    }
}

function login(){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = findUserByEmail($email);
    if($user){
        if($user->getPassWord() == $password){
            session_start();

            $_SESSION['sess_'.$user->getEmail()] = serialize($user);
            
            header('Location: ../index.php?sess=sess_'.$user->getEmail());
            exit();
        } else {
            header('Location: ../frontend/authentification/login.php?msg_error="Password wrong"');
            exit();
        }
    } else {
        header('Location: ../frontend/authentification/login.php?msg_error="User not found"');
        exit();
    }

}

function logout($sessionToLogout){
    session_start();

    $sessions = $_SESSION;

    foreach ($sessions as $session) {
        $sessionUser = unserialize($session);
        if('sess_'.$sessionUser->getEmail() == $sessionToLogout){
            unset($_SESSION['sess_']);
        }
    }
}

function registration(){
    addUser();
}