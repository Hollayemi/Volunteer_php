<?php
    session_start();
    require('actions.php');
    if(isset($_POST['action']) && $_POST['action'] == 'admin_login'){
        $email = ($_POST['email']);
        $password = testInput($_POST['password']);
        $loggedInUser = login($conn,$email);
        if($loggedInUser != null){
            if(password_verify($password,$loggedInUser['password'])){
                echo "logged in";
                $_SESSION['user'] = $loggedInUser['email'];
            }else{
                echo "Incorrect password";
            }
        }else{
            echo "Email not registered";
        }
    };


    // add admin
    if(isset($_POST['action']) && $_POST['action'] == 'addAdmin'){
        $name = testInput($_POST['name']);
        $email = testInput($_POST['email']);
        $password = testInput($_POST['pass']);
        $conf_pass = testInput($_POST['conf_pass']);

        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        $checkExistence = adminExist($conn,$email);

        if(strlen($name) > 1 && strlen($email) > 1){
            if(strlen($password) > 5){
                if(!$checkExistence){
                    if(createNewAdmin($conn, $email, $hashPwd, $name, $token)){
                        echo "Registered";
                    }else{
                        echo "server error";
                    };
                }else{
                    echo "Email already exist";
                }
            }else{
                echo "Password too short";
            }
        }else{
            echo "All fieldS are required";
        }
    };


    if(isset($_POST['action']) && $_POST['action'] == 'deleteAdmin'){
        $email = ($_POST['email']);
        $password = testInput($_POST['password']);
        $loggedInUser = login($conn,$email);
        if($loggedInUser != null){
            if(password_verify($password,$loggedInUser['password'])){
                echo "logged in";
                $_SESSION['user'] = $loggedInUser['email'];
            }else{
                echo "Incorrect password";
            }
        }else{
            echo "Email not registered";
        }
    };
?>