<?php
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        echo "RESS";
        print_r($_POST);
        $email = testInput($_POST['email']);
        $password = testInput($_POST['password']);
        $conf_pass = testInput($_POST['conf_pass']);

        echo userExist($conn,$email);
        createNewUser($conn,$email,$password,'dfjknldjknf');
    };

    if(isset($_POST['loginBtn'])){
        $email = testInput($_POST['email']);
        $email = testInput($_POST['password']);
    };

?>