<?php
    include("controller.php");
    if(isset($_SESSION['user']))
    {
        $user_email = $_SESSION['user'];

        function usersInfo($conn,$user_email)
        {
            $sql="SELECT * FROM users WHERE email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['email'=>$user_email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        

        if(usersInfo($conn,$user_email) != null){
            $myIdFetch  = usersInfo($conn,$user_email);
            $myId       =   $myIdFetch['id'];
            $email      =   $myIdFetch['email'];
        }

        
        function setDefaultPicture($conn,$myId)
        {
            $user_email = $_SESSION['user'];
            $myIdFetch  = usersInfo($conn,$myId);
            // if($myIdFetch['my_pic'] == ""){
                $sql    = "UPDATE users SET my_pic='img/profile.png' WHERE id=:id";
                $stmt   = $conn->prepare($sql);
                $stmt->execute(['id'=>$myId]);
            // }
            return true;
        }


}else{
    // header('Location:../exp.php');
}



?>