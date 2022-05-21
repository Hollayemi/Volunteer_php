<?php 
    // require('db.php');
    session_start();
    function testInput($data){
        $data = trim($data);
        $data = stripslashes($data); 
        $data = htmlspecialchars($data);
        return $data;
    }

    function BusinessInfo($conn,$id)
    {
        $sql="SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function AllCategory($conn)
    {
        $sql="SELECT category FROM category";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

  
    function distance($lat1, $lon1, $lat2, $lon2) { 
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // mean radius of Earth in km 
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        //echo ' '.$km; 
        return $km; 
    }




    function searchBusiness($conn,$searchBy)
    {
        $sql = "SELECT * FROM trackk 
        WHERE page LIKE ? OR caption LIKE ? OR category LIKE ? ORDER BY date ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            "%".$searchBy."%","%".$searchBy."%","%".$searchBy."%"
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
  
    function searchBusiness_cord($conn,$buzz_id){

        $sql = "SELECT latitude,longitude,shop_nick FROM marketers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$buzz_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    // $rez    =   searchBusiness($conn,'wear');
   
    function searchProdby_Skey($conn,$Skey)
    {
        $sql = "SELECT * FROM trackk WHERE Skey = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$Skey]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function searchProdby_id($conn,$id)
    {
        $sql = "SELECT * FROM trackk WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function searchBusinessBy_ID($conn,$shopOwner)
    {
        $sql = "SELECT * FROM marketers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopOwner]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }




    
    
    


    // add favourite

    function add_Fav($conn,$product,$skey,$userID,$prod_img,$prod_amt,$vary_desc,$shopnick,$prod_title)
    {
        $sql = "INSERT INTO prod_fav (product,skey,userID,prod_img,prod_amt,variation_desc,shopnick,prod_title)VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product,$skey,$userID,$prod_img,$prod_amt,$vary_desc,$shopnick,$prod_title]);
        return true;
    }

    function del_Fav($conn,$skey,$uID)
    {
        $deleteSql = "DELETE FROM prod_fav WHERE skey = ? AND userID = ?";
        $stmt      = $conn->prepare($deleteSql);
        $stmt->execute([$skey,$uID]);
        return true;
    }
    

    function fetch_myFav($conn,$userID)
    {
        $sql = "SELECT * FROM prod_fav WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function Fav_sortByPrice($conn,$userID)
    {
        $sql = "SELECT * FROM prod_fav WHERE userID = ? ORDER BY prod_amt ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function Fav_sortByProduct($conn,$userID)
    {
        $sql = "SELECT * FROM prod_fav WHERE userID = ? ORDER BY product ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function check_myFav($conn,$userID,$skey)
    {
        $sql = "SELECT * FROM prod_fav WHERE userID = ? AND skey = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID,$skey]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }






      // add cart
      function cartProduct_func($conn,$prodName,$prodAmt,$skey,$userID,$prod_img,$variation_desc,$shopnick,$prod_title)
      {
          $sql = "INSERT INTO prod_cart (prodName,prodAmt,skey,userID,prod_img,variation_desc,shopnick,prod_title)VALUES(?,?,?,?,?,?,?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$prodName,$prodAmt,$skey,$userID,$prod_img,$variation_desc,$shopnick,$prod_title]);
          return true;
      }

      function check_prodCart($conn,$userID,$skey)
    {
        $sql = "SELECT * FROM prod_cart WHERE userID = ? AND Skey = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID,$skey]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_allCart($conn,$userID)
    {
        $sql = "SELECT * FROM prod_cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // remove cart item
    function del_cartProd($conn,$skey,$uID)
    {
        $deleteSql = "DELETE FROM prod_cart WHERE Skey = ? AND userID = ?";
        $stmt      = $conn->prepare($deleteSql);
        $stmt->execute([$skey,$uID]);
        return true;
    }

    function fetch_cart($conn,$userID)
    {
        $sql = "SELECT * FROM prod_cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    if(isset($_SESSION['user_info_id'])){
        $userID     =   $_SESSION['user_info_id'];
        $countCart  =   count(fetch_cart($conn,$userID));
        $countfavo  =   count(fetch_myFav($conn,$userID));
    }








// get myAmountToPay


function myAmountToPay($conn,$id)
{
    $sql = "SELECT prodAmt FROM prod_cart WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


// getAllSkey
function myCartSkey($conn,$id)
{
    $sql = "SELECT * FROM prod_cart WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function updateUsersToken($conn,$token,$myId)
{
    $sql    = "UPDATE users SET token=? WHERE id=?";
    $stmt   = $conn->prepare($sql);
    $stmt->execute([$token,$myId]);
    return true;
}



function searchProdby_AllSkey($conn,$Skey)
{
    $sql = "SELECT * FROM trackk WHERE Skey = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Skey]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}



// set ordered

function orderedprods($conn,$shopnick,$buyerID,$sKey,$code,$address)
{
    $sql = "INSERT INTO orderedprods_ (shopnick,buyerID,prodSkey,orderCode,buyerAddress)VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$shopnick,$buyerID,$sKey,$code,$address]);
    return true;
}


































// send email


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMPT;
use PHPMailer\PHPMailer\Exception; 
function MyMailer($subject,$to,$message){
    require '../Mailer2/PHPMailer.php';
    require '../Mailer2/Exception.php';
    require '../Mailer2/SMTP.php';
    $mail = new PHPMailer(true);
    $email  ='stephanyemmitty@gmail.com';
    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPDebug  = 0;
        $mail->Username   = "Stephanyemmitty@gmail.com";                    
        $mail->Password   = "sholly0123";                    
        $mail->AddEmbeddedImage('../img/kemon.png','myImg');          
        $mail->AddEmbeddedImage('../img/chatStep.PNG','me');   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;

        $mail->setFrom("stephanyemmitty@gmail.com",'Volunteer');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if($mail->send()){
            echo "sent";
        }
    }catch(Exception $e){
        // echo displayMessage('danger','Oops something went wrong! please try again');
    }

}


?>