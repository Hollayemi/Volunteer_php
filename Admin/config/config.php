<?php
    include("../../config/db.php");
    if(isset($_SESSION['user']))
    {
        $user_email = $_SESSION['user'];

        function usersInfo($conn,$user_email)
        {
            $sql="SELECT * FROM vol_admin WHERE email=:email";
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

        if(!$myInfo){
            header('Location:../config/expire.php');
        }

        function allUsers($conn)
        {
            $sql="SELECT * FROM auth";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }else{
        header('Location:../config/expire.php');
    }



?>