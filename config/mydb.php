<?php

    // localhost
    $servername = "localhost";
    $dbName = "market";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


  
    $d_id   =   $_SESSION['user_info_id'];
    function getMarketers($conn,$d_id)
    {
        $sql    ="SELECT * FROM marketers WHERE id=:id";
        $stmt   = $conn->prepare($sql);
        $stmt->execute(['id'=>$d_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    
    $myFuckinBuzz   =   getMarketers($conn,$myId);
    $shop_nick  = $myFuckinBuzz['shop_nick'];
    // localhost
    $servername = "localhost";
    $dbName = $shop_nick."_iodb";
    $username = "root";
    $password = "";

    try {
        $buzzConn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $buzzConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $buzzConn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $buzzConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
  
  
?>


<!-- online db  -->
<?php

// localhost
// $servername = "db5004513519.hosting-data.io";
// $dbName = "dbs3770229";
// $username = "dbu584115";
// $password = "Holla83626:::Sholly0123";


//   try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//     $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//   } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
//   }
?>