<?php
    require('../config/actions.php');
    session_start();
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $name = testInput($_POST['fullname']);
        $email = testInput($_POST['email']);
        $password = testInput($_POST['password']);
        $conf_pass = testInput($_POST['conf_pass']);

        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        $checkExistence = userExist($conn,$email);

        if(strlen($name) > 1 && strlen($email) > 1){
            if(strlen($password) > 6){
                if(!$checkExistence){
                    if(createNewUser($conn, $email, $hashPwd, $name, $token)){
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





    if(isset($_POST['action']) && $_POST['action'] == 'login'){
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




    if(isset($_POST['action']) && $_POST['action'] == 'edit'){
        $name = ($_POST['name']);
        $email = ($_POST['email']);
        $password = testInput($_POST['pass']);
        $conf_pass = ($_POST['email']);
        $currentUser = currentUser($conn,$_SESSION['user']);
        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        if($currentUser){
            if(strlen($name) > 1 && strlen($email) > 1){
                if(strlen($password) > 6){
                    if(editUser($conn,$name,$hashPwd,$email,$currentUser['id'])){
                        $_SESSION['user'] = $email;
                        echo "done";
                    }else{
                        echo "server error";
                    };
                }else{
                    echo "Password too short";
                }
            }else{
                echo "All field are required";
            }
        }
    };





    if(isset($_POST['action']) && $_POST['action'] === 'forgot'){
        $email = testInput($_POST['email']);
        $by = testInput($_POST['hide']);
        $token = bin2hex(random_bytes(50));
        if($by === 'user'){
            $checkUser = currentUser($conn,$email);
        }else{
            $checkUser = currentAdmin($conn,$email);
        }
        print_r($checkUser);
        if(!empty($email)){
            if($checkUser){
                $link = "/auth/reset?token".$checkUser['authToken'];
                $Reciever = $email;
                $Topic = "Change of password";
                $content = "
                <section style = 'background-color:rgb(31, 31, 31);display:flex;align-items:center;justify-content:center;font-family:Tahoma, Geneva, Verdana, sans-serif; height:auto;position:relative;'>
                        <div style='border:1px solid rgba(165, 165, 165, 0.534);width:85%;background-color:#000;padding:20px 10px;'>
                        <img src='img/kemon.png' height='60px' width='120px'>
                        <h4 style='font-size:18px;font-weight:normal; color:#fff;'>Hello, ".$checkUser['fullname']."!</h4><br>
                        <h5 style='font-size:15px;color:rgb(199, 199, 199);font-weight:normal;line-height:28px;x'>Thanks on signing up with Kemon-Market, <br> My name is Oluwasusi Stephen and i will be at your service. <br><br>Whenever you are stuck, I could be of help.<br> If
                            you have few minutes to spare this week, i will be ecstastic to take you a tour on how to use Kemon-Market. You can as well chat me on 
                            <a style='background-color:rgb(28, 99, 230);color:#fff; padding:10px 15px; border-radius:4px;text-decoration:none;' href='https://api.whatsapp.com/send?phone=+2348147702684&text=Hi,%20from%20Kemon-Market, %20I%20just%20joined%20Kemon%20today.%20my%20name%20is%20__'>Whatsapp </a><br><br> or you give me a call
                            <a style='background-color:rgb(28, 99, 230);color:#fff; padding:12px 18px; border-radius:4px;text-decoration:none;' href='tel:08147702684'>+2348147702684</a><br><br>
                        </h5>
                        <h4 style='font-size:18px;font-weight:normal; color:#fff;'>Cheers, <br><span style='display:flex;align-items:center;justify-left:center;'>Oluwasusi stephen <img src='img/amb1.png' style='width:30px;height:30px;border-radius:50%;margin-left:10px'></h4>
                        <h5 style='font-size:13px;color:rgba(165, 165, 165, 0.534);'><i>Manager</i></h5>
                        </span>
                        </div>
                    </section>
                    ";
                MyMailer($Topic,$Reciever,$content,'hj');                   
            
            }else{
                echo "Email does not exist";
            }
        }else{
            echo "Email field is required";
        }
    }




    if(isset($_POST['action']) && $_POST['action'] == 'reset'){
        $password = testInput($_POST['pass']);
        $conf_pass = ($_POST['cpass']);
        $myToken = ($_POST['myToken']);
        $currentUser = currentUser($conn,$_SESSION['user']);
        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        if($currentUser){
            if(strlen($password) > 6){
                if(updatePassword($conn,$token,$hashPwd,$myToken)){
                    echo "done";
                }else{
                    echo "server error";
                };
            }else{
                echo "Password too short";
            }
            
        }else{
            echo "not exist";
        }
    };


?>