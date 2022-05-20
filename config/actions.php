<?php
    require_once "db.php";

    function testInput($data){
        $data = trim($data);
        $data = stripslashes($data); 
        $data = htmlspecialchars($data);
        return $data;
    }

        // Message 
    function displayMessage($type,$msg){
        return '<div class="alert alert-'.$type.' alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong class="text-center">'.$msg.'</strong>
        </div>';
    }

    function register($conn,$username,$email,$password,$phone, $token)
    {
        $sql = "INSERT INTO users(username,email,password, phone, token) VALUES(:username,:email,:password,:phone,:token)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['username'=>$username, 'email'=>$email,'password'=>$password, 'phone'=>$phone,'token'=>$token]);
        return true;
    }

    // check if email exist
    function userExist($conn,$email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // login existing user
    function login($conn,$email)
    {
        $sql = "SELECT email, password FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // retreiving current users detatil
    function currentUser($conn,$email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    // forgot password
    function forgot_password($conn,$token,$email)
    {
        $sql='UPDATE users SET token = :token WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        return true;
    }


    //reset password
    function resetPassword($conn,$token)
    {
        $sql = "SELECT * FROM users WHERE token =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    // Update Password
    function updatePassword($conn,$token,$password)
    {
        $sql = 'UPDATE users SET token=?,password=? WHERE token=?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$token,$password,$token]);
        return true;
    
    }
    function afterVerify($conn,$email)
    {
        $sql = 'UPDATE users SET token="" WHERE email=:email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        return true;
    
    }






    
?>