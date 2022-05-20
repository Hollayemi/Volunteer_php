<?php
//   session_start();
    // localhost
    $servername = "localhost";
    $dbName = "market";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // echo 'set the PDO error mode to exception';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    if(isset($_SESSION['user_info_id'])){
  
        $d_id   =   $_SESSION['user_info_id'];
        function getMarketers($conn,$d_id)
        {
            $sql    ="SELECT * FROM marketers WHERE id=:id";
            $stmt   = $conn->prepare($sql);
            $stmt->execute(['id'=>$d_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        

        


        $myFuckinBuzz   =   getMarketers($conn,$d_id);
        if(!empty($myFuckinBuzz)){
            $shop_nick  = $myFuckinBuzz['shop_nick'];
        



        
            $servername2 = "localhost";
            $dbName2 = strtolower($shop_nick)."_iodb";
            $username2 = "root";
            $password2 = "";
            try {
                $buzzConn = new PDO("mysql:host=$servername2;dbname=$dbName2", $username2, $password2);
                // set the PDO error mode to exception
                $buzzConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $buzzConn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $buzzConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch(PDOException $e) {
                // echo "Connection failed: " . $e->getMessage();
            }
        }
    }    
  
?>