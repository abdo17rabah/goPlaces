<?php

include_once(__DIR__ . '/../controllers/usersController.php');

if (isset($_GET['action'])) {
    redirect($_GET['action'], $_GET['sess']);
} else {
    redirect();
}

function redirect(String $action = null, String $session = null)
{
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
            header('Location: http://localhost/coursphp/goPlaces/app/');
            exit();
            break;
    }
}

function login()
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = findUserByEmail($email);
    var_dump($user);

    if ($user) {
        if ($user->getPassWord() == $password) {
            session_start();

            // var_dump($_SESSION);
            $_SESSION['sess_' . $user->getEmail()] = serialize($user);
            // var_dump($user);

            header('Location: ./../frontend/trips/index.php?sess=sess_'.$user->getEmail().'');
            exit();
        } else {
            header('Location: ./../frontend/trips/index.phpfrontend/authentification/login.php?msg_error="Password wrong"');
            exit();
        }
    } else {
        header('Location: ./../frontend/trips/index.phpfrontend/authentification/login.php?msg_error="User not found"');
        exit();
    }
}

function logout($sessionToLogout)
{
    session_start();

    $sessions = $_SESSION;

    foreach ($sessions as $key => $value) {
        $sessionUser = unserialize($value);
        var_dump($sessionToLogout);
        var_dump($sessionUser);
        if ('sess_' . $sessionUser->getEmail() == $sessionToLogout) {
            unset($_SESSION['sess_'.$sessionUser->getEmail()]);
        }
    }

    header('Location: ./../frontend/trips/index.php');
    exit();
}

function registration()
{
    addUser($_GET['sess']);
}
