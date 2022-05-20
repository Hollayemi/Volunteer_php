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

        //  fetch marketers in assoc
        function marketersInfo($conn,$myId)
        {
            $sql    ="SELECT * FROM marketers WHERE id=:id";
            $stmt   = $conn->prepare($sql);
            $stmt->execute(['id'=>$myId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function usersInfoById($conn,$id)
        {
            $sql="SELECT * FROM users WHERE id= ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }


        function marketersInfoByShopNick($conn,$shop_nick)
        {
            $sql    ="SELECT * FROM marketers WHERE shop_nick=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$shop_nick]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //  fetch marketers in assoc
        function ratingStar($conn,$myId)
        {
            $sql    = "SELECT id, star FROM rating WHERE F_id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$myId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


        function getActivities($conn,$myId)
        {
            $sql = "SELECT * FROM activity WHERE Fid=? ORDER BY date DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


        function allAgentByName($conn,$myId,$agnName)
        {
            $sql = "SELECT * FROM agent where agnUsername=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$agnName]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }


        function allAgentById($conn,$myId)
        {
            $sql = "SELECT * FROM agent where regID=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }


        function allAgentByPic($conn,$agnPic)
        {
            $sql = "SELECT * FROM agent where agnPic=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$agnPic]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function allPagesUp($conn,$readID)
        {
            $sql = "SELECT page FROM Trackk where real_ID=? ";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$readID]);
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $result;
        }

        function allSubscribers($conn,$myId)
        {
            $sql = "SELECT * FROM subscribers WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function allCategories($conn,$myId)
        {
            $sql = "SELECT * FROM subscribers WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function getMyOrdered($conn,$shopnick)
        {
            $sql = "SELECT * FROM orderedprods_ WHERE shopnick=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$shopnick]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        function getMyOrderedBySkey($conn,$sKey,$buyerID)
        {
            $sql = "SELECT * FROM orderedprods_ WHERE prodSkey=? AND buyerID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$sKey,$buyerID]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function getFromTrack($conn,$sKey)
        {
            $sql = "SELECT * FROM Trackk WHERE Skey = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$sKey]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }






        //  set default storage----------------------------------

        
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

        function setDefaultTemplate($conn,$myId,$type)
        {
            $sql    = "UPDATE marketers SET webType=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$type,$myId]);
            return true;
            
        }


        function setDefaultStorage($conn,$myId)
        {
            $userS  =   41943040;
            $numP   =   2;
            $numT   =   2;
            $sql    = "UPDATE users SET userStorage=?,num_Page=?,num_Tab=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$userS,$numP,$numT,$myId]);
            return true;
        }


        function updateSub_User($conn,$n,$newNumPage,$newNumTab,$newStorage,$myId)
        {
            $sql    = "UPDATE users Set Subscribed=?,num_Page=?,num_Tab=?, userStorage=? WHERE id =?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$n,$newNumPage,$newNumTab,$newStorage,$myId]);
            return true;
        }

        function updateKey($conn,$newSkey,$oldSKey)
        {
            $sql    = "UPDATE users Set sKey=? WHERE sKey =?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$newSkey,$oldSKey]);
            return true;
        }

        function setPageExistence($conn,$myId)
        {
            $sql    = "UPDATE users SET page_exist='1' WHERE id=:id";
            $stmt   = $conn->prepare($sql);
            $stmt->execute(['id'=>$myId]);
            return true;
        }

        // ------------------updation----------------------------------------




        function update_Profile($conn,$myId,$shopName,$shopOp,$shopCl,$shopState,$shopCountry,
                                $shopVCT,$shopBustop,$shopJunction,$shopCity,$shopFb,$shopWhat,$shopPhn,$shopLi)
        {
            $sql="UPDATE marketers SET shop_name=?,opening_hour=?,closing_hour=?,state=?,country=?,very_close_to=?,bustop=?,
                junction=?,city=?,facebook=?,whatsapp=?,phone=?,linked_in=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([
                $shopName, $shopOp, $shopCl,  $shopState,  $shopCountry,  $shopVCT,  $shopBustop, $shopJunction, $shopCity, $shopFb, $shopWhat,
                $shopPhn, $shopLi, $myId
           ]);
            return true;
        }


        
        function update_ProfileOffer($conn,$myId,$shopName,$shopOp,$shopCl,$shopState,$shopCountry,
                                $shopVCT,$shopBustop,$shopJunction,$shopCity,$shopFb,$shopWhat,$shopPhn,$shopLi,$our_offer)
        {
            $sql="UPDATE marketers SET shop_name=?,opening_hour=?,closing_hour=?,state=?,country=?,very_close_to=?,bustop=?,
                junction=?,city=?,facebook=?,whatsapp=?,phone=?,linked_in=?,our_offer=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([
                $shopName, $shopOp, $shopCl,  $shopState,  $shopCountry,  $shopVCT,  $shopBustop, $shopJunction, $shopCity, $shopFb, $shopWhat,
                $shopPhn, $shopLi,$our_offer,$myId
           ]);
            return true;
        }





        function update_VerifyPayment($conn,$myId)
        {
            $sql    = "UPDATE users SET veri_payment='True' WHERE id=:id";
            $stmt   = $conn->prepare($sql);
            $stmt->execute(['id'=>$myId]);
            return true;
        }

        function update_accountReady($conn,$myId,$param)
        {
            $sql    = "UPDATE users SET acc_ready=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$param,$myId]);
            return true;
        }

        function update_bgPicStyle($conn,$myId,$chooseBgType)
        {
            $sql    = "UPDATE marketers SET bgPic=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$chooseBgType,$myId]);
            return true;
        }

        function update_websiteColor($conn,$myId,$MainColor,$TextColor,$SubColor,$LinkColor)
        {
            $sql    = "UPDATE marketers SET MainColor=?, TextColor=?, SubColor=?, LinkColor=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$MainColor,$TextColor,$SubColor,$LinkColor,$myId]);
            return true;
        }



        function update_numPage($conn,$myId,$to)
        {
            $sql    = "UPDATE users SET num_Page=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$to,$myId]);
            return true;
        }

        function update_numTab($conn,$myId,$to)
        {
            $sql    = "UPDATE users SET num_Tab=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$to,$myId]);
            return true;
        }


        function updateAgentName($conn,$myId,$updateAgnAccName,$updateAccNum,$updatePhone,$updateAgnBank,$updateAgnMail)
        {
            $sql    = "UPDATE agent SET agnAccName=?,agnAccNumber=?,accPhoneNumber=?,Bank=?,mail=? WHERE regID=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$updateAgnAccName,$updateAccNum,$updatePhone,$updateAgnBank,$updateAgnMail,$myId]);
            return true;
        }


        function updateAgent_ReferAgent($conn,$new,$id)
        {
            $sql    = "UPDATE agent SET ref_agent=? WHERE id=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$new,$id]);
            return true;
        }

        

        function updateAgentPic($conn,$myId,$fileDestination)
        {
            $sql    = "UPDATE agent SET agnPic=? WHERE regID=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$fileDestination,$myId]);
            return true;
        }


        // -------------------------uploads------------------

        function catchUploads($buzzConn,$myId,$caption,$picture,$Skey,$amount,$page,$category,$variation_desc,$Title)
        {
            $prod = explode('-',$page);
            $product = $prod[1];
            $sql = "INSERT INTO Trackk (Skey,caption,picture,amount,real_ID,page,product,category,variation_desc,title)VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt2 = $buzzConn->prepare($sql);
            $stmt2->execute([$Skey,$caption,$picture,$amount,$myId,$page,$product,$category,$variation_desc,$Title]);
            return true;
        }

        function deleteUploads($conn,$picture)
        {
            $deleteSql = "DELETE FROM Trackk WHERE picture = ?";
            $stmt      = $conn->prepare($deleteSql);
            $stmt->execute([$picture]);
            return true;
        }

        
        
        // ----------------------------------------------------------

        

        function newSubscriber($conn,$myId,$sub_username,$sub_emails,$sub_shop,$date_expired,$date_subscribed,$type)
        {
            $sql = "INSERT INTO subscribers (id,username,email,shop,Date_expired,Date_subscribed,type_of_sub)VALUES(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId,$sub_username,$sub_emails,$sub_shop,$date_expired,$date_subscribed,$type]);
            return true;
        }



        function updateActivite($conn,$eventType,$myAction,$myId,$activity)
        {
            $sql = "INSERT INTO activity (Fid,eventType,myAction,activity)VALUES(?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$myId,$eventType,$myAction,$activity]);
            return true;
        }


        function insertIntoAgent($conn,$AgnUsername,$AgnAccName,$AccNum,$AgnBank,$AgnPhone,$AgnMail,$myId,$fileDestination,$referralLink)
        {
            $sql = "INSERT INTO agent (agnUsername,agnAccName,agnAccNumber,Bank,accPhoneNumber,mail,regID,agnPic,referralLink)
            VALUES(?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$AgnUsername,$AgnAccName,$AccNum,$AgnBank,$AgnPhone,$AgnMail,$myId,$fileDestination,$referralLink]);
            return true;
        }


        function registerCategory($conn,$myId,$category)
        {
            $sql = "INSERT INTO category (id,category)VALUES(:myId,:category)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['myId'=>$myId,'category'=>$category]);
            return true;
        }


        function setRegisteration($conn,$Shop_Name,$shop_nick,$website,$country,$state,$City,$Junction,$Bustop,$VCT,$facebook,
                                  $whatsapp,$Phone,$Offer,$myId,$longitude,$latitude,$category)
        {
            $OPH=7;
            $CLH=7;
            $sql="INSERT INTO marketers (shop_name,shop_nick,shop_website,opening_hour,closing_hour,country,state,city,junction,
            bustop,very_close_to,facebook,whatsapp,phone,our_offer,id,longitude,latitude,category) VALUES (:Shop_Name,:shop_nick,:website,:OPH,:CLH,:country,:states,:City,:Junction,:Bustop,:VCT,
            :facebook,:whatsapp,:Phone,:Offer,:real_id,:longitude,:latitude,:category)";

            $stmt = $conn->prepare($sql);

            $stmt->execute
            ([
                'Shop_Name' =>$Shop_Name,
                'shop_nick' =>$shop_nick,
                'website'   =>$website,
                'OPH'       =>$OPH,
                'CLH'       =>$CLH,
                'country'   =>$country,
                'states'    =>$state,
                'City'      =>$City,
                'Junction'  =>$Junction,
                'Bustop'    =>$Bustop,
                'VCT'       =>$VCT,
                'facebook'  =>$facebook,
                'whatsapp'  =>$whatsapp,
                'Phone'     =>$Phone,
                'Offer'     =>$Offer,
                'real_id'   =>$myId,
                'longitude' =>$longitude,
                'latitude'  =>$latitude,
                'category'  =>$category
                ]);
            return true;
        }
    





                
        function updateAgn_3($conn,$NewCountMonth,$NewCount,$AgnUser)
        {
            $sql    = "UPDATE agent SET 3_months=?, Total_reg =? WHERE agnPic=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$NewCountMonth,$NewCount,$AgnUser]);
            return true; 
        }

        function updateAgn_6($conn,$NewCountMonth,$NewCount,$AgnUser)
        {
            $sql    = "UPDATE agent SET 6_months=?, Total_reg =? WHERE agnPic=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$NewCountMonth,$NewCount,$AgnUser]);
            return true; 
        }

        function updateAgn_year($conn,$NewCountMonth,$NewCount,$AgnUser)
        {
            $sql    = "UPDATE agent SET 1_year=?, Total_reg =? WHERE agnPic=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$NewCountMonth,$NewCount,$AgnUser]);
            return true; 
        }
        
        function updateAgn_norm($conn,$NewCount,$NewTot,$AgnUser)
        {
            $sql    = "UPDATE agent SET counting=?, Total_reg =? WHERE agnPic=?";
            $stmt   = $conn->prepare($sql);
            $stmt->execute([$NewCount,$NewTot,$AgnUser]);
            return true;
        }





/////////////// //////////////////////////// //////////////// /////////////////// //////////////////////////// //////////////////////



    // ///////////My page Update (DERIVED FORM EMAIL)///////////////

        function updatePage_func($conn,$myId,$emailName)
            {
                $sql    = "UPDATE users SET My_page=? WHERE id=?";
                $stmt   = $conn->prepare($sql);
                $stmt->execute([$emailName,$myId]);
                return true;
            }

    // ///////////FetchAll to know amount (FetchAll)///////////////
            
            // function fetchAll_Sql($conn,$sql)
            // {
            //     $stmt = $conn->prepare($sql);
            //     $stmt->execute();
            //     $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            //     return $result;
            // }
            

            function updateCategory($conn,$myId,$category)
            {
                $sql    = "UPDATE category SET id=?,category=? WHERE id=?";
                $stmt   = $conn->prepare($sql);
                $stmt->execute([$myId,$category,$myId]);
                return true;
            }

            function updateMarketersCategory($conn,$myId,$category){
                $sql    = "UPDATE marketers SET category=? WHERE id=?";
                $stmt   = $conn->prepare($sql);
                $stmt->execute([$myId,$category]);
                return true;
            }

            function update_payRef($conn,$n,$myId)
            {
                $sql    = "UPDATE marketers SET payRef=? WHERE id=?";
                $stmt   = $conn->prepare($sql);
                $stmt->execute([$n,$myId]);
                return true;
            }

            function update_SubRef($conn,$n,$myId)
            {
                $sql    = "UPDATE marketers SET subRef=? WHERE id=?";
                $stmt   = $conn->prepare($sql);
                $stmt->execute([$n,$myId]);
                return true;
            }
    // ///////////Fetch all subscribers (ASSOCICALLY)///////////////

              
    function updateFunc_Subscribers($conn,$myId,$myIdFetch)
    {
        $sql = "SELECT * FROM subscribers WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$myId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($result))
        {

            $exp=strtotime($result['Date_expired']);
            $sub=strtotime($result['Date_subscribed']);
            
            $NewD  = date("20".'y/m/d');
            $NewDate = strtotime($NewD);
            $dif = $exp - $NewDate;

            $newExpiry = abs(floor($dif/(60 * 60 * 24))); 




            $daysLeft_Sql = "UPDATE subscribers SET Days_left = ? WHERE id = ?";
            $stmt = $conn->prepare($daysLeft_Sql);
            $stmt->execute([$newExpiry,$myId]);
            $_SESSION['daysLeft'] = $newExpiry;



            
            if($myIdFetch['Subscribed']==1){
            
                if($newExpiry == 0){
                    $zero = 0;
                    $expiredSql = "UPDATE users SET Subscribed = ? WHERE id = ?";
                    $stmt = $conn->prepare($expiredSql);
                    $stmt->execute([$zero,$myId]);


                    $deleteSql = "DELETE FROM subscribers WHERE id = ?";
                    $stmt      = $conn->prepare($deleteSql);
                    $stmt->execute([$myId]);
                }

            }
        }

    }






    // ///////////My page Update (DERIVED FORM EMAIL)///////////////

    function fetchEmail_func($conn,$email)
    {
        $sql    =   "SELECT receiverEmail,receiverName,senderShop From newsletters Where senderEmail=?";
        $stmt   = $conn->prepare($sql);
        $stmt->execute([$email]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    function getAll_posts($buzzConn,$myId)
    {
        $sql    =   "SELECT * From Trackk WHERE real_ID=?";
        $stmt   = $buzzConn->prepare($sql);
        $stmt->execute([$myId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_trackUploads($conn,$page,$caption,$amount,$picture,$new_Skey,$real_ID,$old_Skey)
    {
        $sql    = "UPDATE Trackk SET page=?,caption=?,amount=?,picture=?,Skey=?,real_ID=? WHERE Skey=?";
        $stmt   = $conn->prepare($sql);
        $stmt->execute([$page,$caption,$amount,$picture,$new_Skey,$real_ID,$old_Skey]);
        return true;
    }

    function delete_posts_($conn,$Skey)
    {
        $deleteSql = "DELETE FROM Trackk WHERE Skey = ?";
        $stmt      = $conn->prepare($deleteSql);
        $stmt->execute([$Skey]);
        return true;
    }








    function foldersize($path) {
        $total_size = 0;
        $files = scandir($path);
        foreach($files as $t) {
          if (is_dir(rtrim($path, '/') . '/' . $t)) {
            if ($t<>"." && $t<>"..") {
                $size = foldersize(rtrim($path, '/') . '/' . $t);
                $total_size += $size;
            }
          } else {
            $size = filesize(rtrim($path, '/') . '/' . $t);
            $total_size += $size;
          }
        }
        return $total_size;
      }
      
      function format_size($size) {
    
        $mainSiz   =   $size*9.5367*(10**-7);
        $mainSize  =   explode('.',$mainSiz);
        if($mainSize[0] >1023){
            $mainSiz   =   $size*9.5367*(10**-7);
            return round($mainSiz,2);
        }     
        return round($mainSiz, 2) . " MB";
      }
      


}else{
    // header('Location:../exp.php');
}



?>