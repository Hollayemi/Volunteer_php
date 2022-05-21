<?php
    include("db.php");
    if(isset($_SESSION['user']))
    {
        $user_email = $_SESSION['user'];

        function usersInfo($conn,$user_email)
        {
            $sql="SELECT * FROM auth WHERE email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['email'=>$user_email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        if(usersInfo($conn,$user_email) != null){
            $myInfo   = usersInfo($conn,$user_email);
            $id       =   $myInfo['id'];
            $email    =   $myInfo['email'];
            $fullname =   $myInfo['fullname'];
            $name     =   explode(' ',$myInfo['fullname'])[0];
        }

    }else{
        header('Location:../config/expire.php');
    }



?>