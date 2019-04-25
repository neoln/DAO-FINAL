<?php
require 'UserDao.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $data = [
    	'firstname' => $_POST['firstname'],
    	'lastname' => $_POST['lastname'],
        'modified' => date("Y-m-d H:i:s")
    ];
    if (! empty($_POST['password']) ) {
        $data['password'] = password_hash($_POST['password'] . 'Nh-Tw3M-cRW)', PASSWORD_DEFAULT);
    }

    $userDao = new UserDao();
    if ($userDao->update($_POST['id'], $data)) {
        header("Location: /index.php");
        exit;
    } else {
        echo "An error occurred";
        exit;
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "You did not pass in an ID.";
    exit;
}

$userDao = new UserDao();
$user = $userDao->findById($_GET['id']);

if ($user === false) {
    echo "User not found!";
    exit;
}

require '../views/inc/header.phtml';
require '../views/users/edit.phtml';
require '../views/inc/footer.phtml';