<?php
  include('prof_header.php');
?>
    <main role="man">
    <?php
      
          $checker  =   allPagesUp($conn,$myId);
          $discoverErrLinkArray=  array();
          $discoverErrLink = glob("../up/".$shop_nick."/tb/*.*");
          for($i=0; $i<count($discoverErrLink);$i++){
            $disE  = explode('/',$discoverErrLink[$i]);
            $disEr = explode('.',$disE[4]);
              $discoverErrLinkArray[]= $disEr[0];
          }
      
      $allErrArr = array();

      for($i=0; $i<count($discoverErrLinkArray);$i++){
        if(!in_array($discoverErrLinkArray[$i],$checker)){
           $allErrArr[] = $discoverErrLinkArray[$i];
        }
      }
    
    ?>
      <article>
       <header class="background-dark profDash">
       
          <div class="line">        
            <p class="cla"><br><br><br><br><h3 class="tab-head"></h3></p>
          </div>  
        </header>
      </article>
    </main>
    <i class="questionInfo fa fa-inbox"><span class="spanErr">1</span></i>
          <div class='is-active'></div>
        </header>



<?php
    if(!isset($marketersInfo['shop_name'])){
      $myShopName       =   "Not Registered";
      $myShopNick       =   "Not Registered";
      $myShopOpen       =   "Not Registered";
      $myShopClose      =   "Not Registered";
      $myShopCountry    =   "Not Registered";
      $myShopState      =   "Not Registered";
      $myShopCity       =   "Not Registered";
      $myShopJunction   =   "Not Registered";
      $myShopBustop     =   "Not Registered";
      $myShopVCT        =   "Not Registered";
      $myShopFacebook   =   "Not Registered";
      $myShopWhatsapp   =   "Not Registered";
      $myShopPhone      =   "Not Registered";
      $myShopLinkedin   =   "Not Registered";
      $myShopOffer      =   "Not Registered";
    }else{
      $myShopName       =   $marketersInfo['shop_name'];
      $myShopNick       =   $marketersInfo['shop_nick'];
      $myShopOpen       =   $marketersInfo['opening_hour'];
      $myShopClose      =   $marketersInfo['closing_hour'];
      $myShopCountry    =   $marketersInfo['country'];
      $myShopState      =   $marketersInfo['state'];
      $myShopCity       =   $marketersInfo['city'];
      $myShopJunction   =   $marketersInfo['junction'];
      $myShopBustop     =   $marketersInfo['bustop'];
      $myShopVCT        =   $marketersInfo['very_close_to'];
      $myShopFacebook   =   $marketersInfo['facebook'];
      $myShopWhatsapp   =   $marketersInfo['whatsapp'];
      $myShopPhone      =   $marketersInfo['phone'];
      $myShopLinkedin   =   $marketersInfo['linked_in'];
      $myShopOffer      =   $marketersInfo['our_offer'];
    }

    $allMyEmail = fetchEmail_func($conn,$email);

    $newsNames = array();
    $newsEmails = array();
    $newsShops = array();
    for($a=0; $a < sizeof($allMyEmail); $a++)
    {
        $newsEmails[] = $allMyEmail[$a]['receiverEmail'];
        $newsNames[]  = $allMyEmail[$a]['receiverName'];
        $newsShops[]  = $allMyEmail[$a]['senderShop'];
    };

    $emailName = "v";
    $allPages = array();
    $proPages = glob("../up/".$shop_nick."/pg/*.php");
    for ($i=0; $i<count($proPages); $i++){
        $page = $proPages[$i];
        $pageCheck = explode('.',$page);
        if($pageCheck[3] ==  'php'){
            $ext=explode('/',$pageCheck[2]);
            if($ext[4]!=$emailName){
                if($ext[4] !="pageFrame")
                $allPages[]=$ext[4];
            }
        }
    }
    if(!function_exists(require_once('functions.php')))
      if(isset($_POST['sendNews'])){
        if(isset($_POST['cnt']) && isset($_POST['sub'])){
          for ($u=0; $u<count($newsEmails); $u++){
              $conte          = $_POST['cnt'];
              $Topic          = $_POST['sub'];
              $Reciever         =  $newsEmails[$u];
              $usernameOnEmail  =  $newsNames[$u];
              $shopNameEmail    =  $newsShops[$u];
              
              $content  = "
              <div style='border:1px solid #eee;padding:30px;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;'>
              <h2 style='text-align:center;'>From ".ucwords($shopNameEmail)."<p style='font-size:18px;color:#5499e2;'>(kemon market)</p></h2><br>
                <h4 style='text-align:left; font-size:18px; color:#fff;'>Hi ".$usernameOnEmail.",</h4><br>
                  ".$conte."<br><br>
                    <a href='https://api.whatsapp.com/send?phone=+".$marketersInfo['whatsapp']."&text=Hi,%20from%20Kemon-Market, %20I%20just%20joined%20Kemon%20today.%20my%20name%20is%20__'>whatsapp </a>or you give me a
                    <a href='tel:".$marketersInfo['phone']."'>Call</a>.<br><br> i will be very happy to help you
                  </h5>
              </div>
            ";
            if(MyMailer($Topic,$Reciever,$content)){
              $alertEmail = "Email sent";
            }else{
              
            }
          }
        }
    }
    $averageStars = 0;

    $starArr = array();
    $row_star =  ratingStar($conn,$myId);
    
    for($i = 0; $i < count($row_star); $i++){
        $starArr[]  = $row_star[$i]['star'];
    }

    if(array_sum($starArr) > 0){
        $averageStars = array_sum($starArr)/(count($starArr));
    }
   







    // echo $shop_nick;

    $allTabs = array();
    $protabs = glob("../up/".$shop_nick."/tb/*.php");
    for ($i=0; $i<count($protabs); $i++){
        $tab = $protabs[$i];
        $TabChecked = explode('.',$tab);
        if($TabChecked[3] ==  'php'){
          // echo $TabChecked[2];
          $extTab=explode('/',$TabChecked[2]);
          // echo $extTab[4]."------------";
          if($extTab[4]!=$emailName){
              if($extTab[4] !="pageFrame")
              $allTabs[]=$extTab[4];
          }
          
        }
    }
    $_SESSION['allPages'] = $allPages;
    $numPages = sizeof($allPages);

    // =============================--------------Pages--------------=======================




    // $myPagetxt          =   fopen("$emailName".'.txt', "w");
    // $_SESSION['myPagetxt']   =  $myPagetxt;
    // //fwrite($myPagetxt,$myPage_codetxt);
    // $myPage         =       fopen("./up/$emailName/$emailName".'.php','w');
    // $getMyCode      =       '<?php
    // include("../../notPaid.php");
    //       
    // ';
    // fwrite($myPage,$getMyCode);

    if(isset($_POST['lowStorage'])){
      $knwO = "popo";
				    echo "<div class='loginStatus'>
            <h4>Sorry,</h4><br>
            <h5>Unable to upload, subscribe or purchase a xtra space</h5>
            <p>( insufficent memory )</p>
            </div>";

    }


    $Fetch_tabs = array();
    $Main_tabs  = array();
    $FetchAllTans = glob("../up/".ucwords($shop_nick)."/tb/*.php");
    for ($i=0; $i<count($FetchAllTans); $i++){
        $Tabpage = $FetchAllTans[$i];
        $TabpageCheck = explode('.',$Tabpage);
        if($TabpageCheck[3] ==  'php'){
          $Tabsext=explode('/',$TabpageCheck[2]);
            $Fetch_tabs[]=$Tabsext[4];
            $mainT = explode('-',$Tabsext[4]);
            $Main_tabs[] = $mainT[1];
        }
    }
    $countAllTabs=sizeof($Fetch_tabs);
    $_SESSION['allTabs'] = $Fetch_tabs;



    update_VerifyPayment($conn,$myId);


    if(isset($_POST['submitProf'])){
       include('../EditProfile.php');
    }
    if(isset($_POST['submitProfPic'])){
        $myPath         = $_FILES['myfile'];
        $fileName       = $_FILES['myfile']['name'];
        $fileSize       = $_FILES['myfile']['size'];
        $fileTempName   = $_FILES['myfile']['tmp_name'];
        $fileType       = $_FILES['myfile']['type'];
        $fileError      = $_FILES['myfile']['error'];

        $fileExt        =   explode('.',$fileName);
        $fileActualExt  =   strtolower(end($fileExt));
        $allowed    =   array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed)){
            if($fileError === 0){
                if($fileSize > 10){
                    $real_id       =  $_SESSION['user_info_id'];
                    $fileDestination = '../up/'.$shop_nick.'/profile.png';
                      move_uploaded_file($fileTempName,$fileDestination);
                      $_SESSION['profileEdited'] =   displayMessage('success',"Businessb picture changed");
                    }else{
                      $_SESSION['profileEdited'] =   displayMessage('danger',"Picture was not uploaded");
                      }
                }else{
                  $_SESSION['profileEdited'] =   displayMessage('danger',"This file is too big, try with a lesser file size");
                }
            }else{
              $_SESSION['profileEdited'] =   displayMessage('danger',"An error has occured, try again with another file");
            }
        }else{
          $_SESSION['profileEdited'] =   displayMessage('danger',"File was not changed");
        }
    
    $Num_file = array();
    $files = glob("../up/".$shop_nick."/pic/*.php");
    for ($i=1; $i<count($files); $i++){
      $num = $files[$i];
      $filepi= explode('-',$num);
      $filepic=explode('/',$filepi[0]);
      if($_SESSION['emailName']==  $filepic[1]){
        $Num_file[] = $num;
      }
    }
    $Total_files_uploaded = sizeof($Num_file);
?>
    <section id="Profile" style="display:non">
        <div class="My_Prof_cont">        
            <div id="prof" class="ant ant_close">
              <button id="" class="lArr">x</button>
              <div class="prof-pic">
                <div class="myAdminTop">
                  <img src="../up/<?php echo $shop_nick?>/profile.png" alt="no picture"  class="ProfPicture">
                  <h2>ADMIN</h2>
                </div>
                  <?php 
                  if($myIdFetch['acc_ready'] < 1 ){
                    echo '<div class="visitWeb"><i class="fa fa-external-link"></i><a target="_blank" href="https://'.$shop_nick.'.kemon-market.com?status=not-active&edit=OK&webFec='.$myIdFetch['token'].'">Preview</a></div>';
                  }else{
                    echo '<div class="visitWeb"><i class="fa fa-external-link"></i><a target="_blank" href="https://'.$shop_nick.'.kemon-market.comedit=OK&webFec='.$myIdFetch['token'].'">Preview</a></div>';
                  }
                  ?>
              </div>        
              <div class="input_side">
                <div class="knownAs slideeditInput-ee" onclick="switchPage('slideeditInput')" id="genEditInput" ><h4><i class="fa fa-user"></i> My Profile </h4> <i class="fa fa-caret-right genEditInput-fa" style="transform:scale(1)"></i></div><br>
                <form action="" method="POST" enctype="multipart/form-data">
                      <div id="entries" class='genEditInput-d' style="height:0px;"><br>
                          <input type="text" id="snInput" disabled="true" name="Shop_Name" value='<?php echo $myShopName ?>'class='editInput'><br>
                          <input type="text" id="slInput" disabled="true" name="Shop_Line" value='<?php echo $myShopPhone ?>' class='editInput'><br>
                          <input type="text" id="emailInput" disabled="true" name="Shop_City"  value='<?php echo $myShopCity ?>' class='editInput'><br>
                          <input type="text" id="phInput" disabled="true" name="Edit shop name" value='<?php echo $myShopNick ?>' class='editInput' ><br>
                          <input type="text" id="njInput" disabled="true" name="Junction" value='<?php echo $myShopJunction ?>' class='editInput' ><br>
                          <input type="text" id="nbInput" disabled="true" name="Bustop" value='<?php echo $myShopBustop ?>' class='editInput' ><br>
                      </div>
                      <div class="knownAs modify-ee" onclick="switchPage('modify')" id="brandsCreated"><h4><i class="fa fa-files-o"></i> Modify Website </h4> <i class="fa fa-caret-right brandsCreated-fa"></i></div>
                      <div class="knownAs uploadSec-ee" onclick="switchPage('uploadSec')" id="brandsCreated"><h4><i class="fa fa-upload"></i> Upload </h4> <i class="fa fa-caret-right brandsCreated-fa"></i></div>
                      <div class="knownAs portfolio-ee" onclick="switchPage('portfolio')" id="brandsCreated"><h4><i class="fa fa-desktop"></i> Templates </h4> <i class="fa fa-caret-right brandsCreated-fa"></i></div>
                  

                    <div class="knownAs Activity-ee" onclick="switchPage('Activity')"><h4><i class="fa fa-th"></i> Activities </h4><i class="fa fa-caret-right"></i></div>
                    <div class="knownAs Chances-ee" onclick="switchPage('Chances')"><h4><i class="fa fa-shopping-bag"></i> Chances </h4> <i class="fa fa-caret-right"></i></div>
                    <br>
                    <div class="knownAs" onclick="switchPage('inactive_page')" id="inactiveLinks"><h4><i class="fa fa-exclamation-circle"></i> Inactive pages </h4> <i class="fa fa-caret-right inactiveLinks-fa"></i></div>
                                        
                    <div class="knownAs" onclick="switchPage('Brands_s')" id="brandsCreated"><h4><i class="fa fa-files-o"></i> Brands Created </h4> <i class="fa fa-caret-right brandsCreated-fa"></i></div>
                    
              
                    <div class="knownAs" onclick="switchPage('Product_s')" id="productsCreated"><h4><i class="fa fa-files-o"></i> Products Created </h4> <i class="fa fa-caret-right productsCreated-fa"></i></div>
                  
                  	<div class="knownAs" onclick="switchPage('editPost')" id="editMyPost"><h4><i class="fa fa-files-o"></i> Edit Post </h4> <i class="fa fa-caret-right editMyPost-fa"></i></div>
                
                    <div class="knownAs" onclick="toggle(this)" id="ratingStar"><h4><i class="fa fa-star"></i> Rating Star </h4> <i class="fa fa-caret-right ratingStar-fa"></i></div>
                    <div class="ratingStar-d sCro" style="height:0px; overflow:hidden">
                        <h5>Rated by <?php echo count($starArr) ?> people</h5>
                        <h5><div class="rateyo-readonly-widg"></div></h5>
                    </div>


                    <div class="knownAs" onclick="toggle(this)" id="myCustomers"><h4><i class="fa fa-globe"></i> Customers </h4><i class="fa fa-caret-right myCustomers-fa"></i></div>
                    <div class="myCustomers-d sCro" style="height:0px; overflow:hidden">
                        <h5><?php echo $_SESSION['noOFCustomers']?> Subscribers</h5>
                    </div>
                    <!-- <h5 style="margin-bottom:-20px;color:#fff">Upload Info</h5>
                    <h4 class="knownAs profContact2"><i class="fa fa-upload"></i> files uploaded <i class="id">></i></h4> -->

                </form><br><br>
            </div>
          </div>
       </div>
          <div class="referralIDClass">
                <h4>Reference 1 Key:<br> <?php echo $marketersInfo['payRef'] ?></h4>
                <h4>Reference 2 Key:<br> <?php echo $marketersInfo['subRef'] ?></h4>
          </div>
      </section>
       

    
    </section>
  <div class="contentShow">
    <section id="modify" class="main_side" style="display:none;">
                  
    <section style="width:100%">
            <div class="progBar">
                <?php

                    if($countAllTabs>2){
                      $countAllTabs = 2;
                    }else{
                      $countAllTabs = $countAllTabs;
                    }

                    $tot_num_pic=[];
                    $numpi = glob("../up/".ucwords($shop_nick)."/pic/*.*");
                    for ($i=0; $i<count($numpi); $i++){
                        $Tabpage = $numpi[$i];
                        $tot_num_pic[] = $Tabpage;
                    }
                    $countAllPic = sizeof($tot_num_pic);

                    if($countAllPic >10){
                        $countAllPic = 10;
                    }
                    
                    $val = $countAllPic*7 + $countAllTabs*15;
                    // echo $val;
                      if($countAllPic<10 || $countAllTabs <2){
                ?>

                  <progress
                    value=<?php echo $val ?> max="100">
                  </progress>
                  <?php $message = '<h5 class="not-active"> account is not active, required(($countAllPic<10)?(10 - $countAllPic)."picture(s)":"";($countAllPic<10 && $countAllTabs <2)?"and ":""; ($countAllTabs<2)?2 - $countAllTabs." product(s)to activate your account":"";</h5>'; ?>
                  <br><br>
                <?php
                    update_accountReady($conn,$myId,'0');
                  }else{
                    // $fake=0;
                    for($i=100; $i<=10; $i++){
                      ?>
                      <progress
                      value=<?php echo $val ?> max="100">
                    </progress>
                  <?php
                    sleep(.2);
                    // $fake+=10;
                    }
                    $message =  '
                    <div style="position:relative" id=" mymess">
                      <h5 class="is-active";>Your account is active</h5>
                     </div> 
                      ';
                    update_accountReady($conn,$myId,'1');
                  }

                ?>
            </div>
            
          </section>
            

          <div class="sec_side">
                    <?php
                      // include('../new_upload.php') ;
                      if(isset($piUpload)){
                        echo $piUpload."pop";
                      }
                      // echo $piUpload."pop";
                    ?>
                    
                    <div class="pages_info">
                          <h4 class="Delete-h4 Delete-h4-small">Delete section</h4>
                          <br>
                            <form action="../action.php" method="POST" class="centt_col">
                                  <select class="select-css" name="deleteSelectedPage">
                                  <option  selected="selected" class="select" style='line-height:5px;color:blue;width:15px'>select brand name</option>
                                  <?php
                                  foreach($allPages as $allpag){
                                  ?>
                                  <option value="<?php echo strtolower($allpag);?>"><?php echo $allpag?></option> ;
                                <?php
                                  }
                                  ?>
                                  </select>
                          <a href="#"><button name="deleteSelectedPageBtn" type="submit" class="DeletePagesBtn ">Delete a Brand</button></a>
                        </form>                            
                        <form action="../action.php" method="POST" enctype="multipart/form-data" class="centt_col">
                          <select class="select-css" style="height:35px" name="deleteSelectedTab">
                          <option  selected="selected" class="select" style='line-height:20px;color:blue'>select product name</option>
                          <?php
                            foreach($Fetch_tabs as $Fetch_tab){
                          ?>
                          <option value="<?php echo strtolower($Fetch_tab);?>"><?php echo $Fetch_tab?></option> ;
                        <?php
                          }
                          ?>
                          </select>
                            
                              <button type='post' name='deleteSelectedTabBtn' class="DeletePagesBtn">Delete a Product</button>
                      </form>
                      
                  </div>
                  <div></div>
                  <div class="updatePages">
                        <h4 class="Delete-h4 cr_brand">Create a Brand</h4>
                        <form action="<?php echo $_SERVER['PHP_SELF'].'?view=modify' ?>" method="POST" class="centt_col">
                              <input type="text"  class="editInput2 " name="CreatePageName"><br>
                              <a href="#" class="centt_col"><button name="CreatePage" type="submit" class="updatePagesBtn" onclick="switchPage('modify')">Create</button></a>
                        </form>
                  </div>
          </div>
            <?php

                $tot_num_file=[];
                $numf = glob("../up/".ucwords($shop_nick)."/pic/*.*");
                $tot_num1 = count($numf)-2;
                for ($i=0; $i<count($numf); $i++){
                    $Tabpage = $numf[$i];
                    $tot_num_file[] = $Tabpage;
                }
                $hoho = array_reverse($tot_num_file);
                // echo "<img src='$hoho[0]'>";
                if($_SESSION['veri_payment']== 'True'){
                  echo "<div class='notify'>";
                  echo '<button onclick="moveNotify()" class="sho_x">X</button>';
                  if(isset($_SESSION['daysLeft']) && $_SESSION['daysLeft'] != 0){
                      echo "<h5><i class='fa fa-bell bg-c'></i>". $_SESSION['daysLeft']." days left</h5>";
                  }else{
                    echo "<h5 class='nevaSub'><i class='fa fa-bell-slash-o bg-c'></i> <p>never subscribed</p></h5>";
                  }
                  if(count($numf)>2){
                    echo  "<h5 class='lowPic'><span class='tot_num1'><h5 class='real-num'>+".$tot_num1."</h5></span><img src='$hoho[2]' class='tot_num1 fi'><img src='$hoho[0]' class='tot_num las'>";
                  }elseif(count($numf)==0){
                    echo "<h5 style='margin-top:20px'>0 picture</h5>";
                  }elseif(count($numf)==1){
                    echo "<h5 style='margin-top:20px'>1 picture</h5>";
                  }else{
                    echo "<h5 style='margin-top:20px'>2 pictures </h5>";
                  }
                  echo "<h5 style='margin-top:20px'>".$_SESSION['spaceLeft']." free</h5>";
                  echo "<h5><i class='fa fa-file'></i></span><span class'file-created-num'>".$numPages ."</span></h5>";
                  //echo "<span id='blab' style='display:none'><img id='blah' src='#' display='none' class='tot_num tum' style='margin-top:7px;display:block'> <span class='my_cir'></span></span>";
                  echo "</div>";
              }else{
                  echo "<div class='notify'>";
                    echo "<h5 class='nevaSub'><i class='fa fa-bell-slash-o bg-c'></i> <p>never subscribed</p></h5>";
                  if(count($numf)>2){
                    echo  "<h5 class='lowPic'><span class='tot_num1'><h5 class='real-num'>+".$tot_num1."</h5></span><img src='$hoho[2]' class='tot_num1 fi'><img src='$hoho[0]' class='tot_num las'>";
                  }elseif(count($numf)==0){
                    echo "<h5 style='margin-top:20px'>0 picture</h5>";
                  }elseif(count($numf)==1){
                    echo "<h5 style='margin-top:20px'>1 picture</h5>";
                  }else{
                    echo "<h5 style='margin-top:20px'>2 pictures </h5>";
                  }
                  echo "<h5 style='margin-top:20px'>".$_SESSION['spaceLeft']." free</h5>";
                  echo "<h5><i class='fa fa-file'></i></span><span class'file-created-num'>".$numPages ."</span></h5>";
                  //echo "<span id='blab' style='display:none'><img id='blah' src='#' display='none' class='tot_num tum' style='margin-top:7px;display:block'> <span class='my_cir'></span></span>";
                  echo "</div>";
                }
            ?>
      <br>
          <div class="second-flex">
            <div class="flexin-1">
            <h4 class="cr-h4">Create a Product</h4>
              <form action="<?php echo $_SERVER['PHP_SELF'].'?view=modify' ?>" method="POST" class="centt_col">
                    <select class="select-css" name="selectedTab">
                            <option  selected="selected" disabled class="select" style='line-height:20px;color:blue'>Select Brand</option>
                            <?php
                            foreach($allPages as $allpag){
                            ?>
                            <option value="<?php echo strtolower($allpag);?>"><?php echo $allpag?></option> ;
                          <?php
                            }
                            ?>
                            </select><br>
                    <input type="text"  class="editInput3" name="CreateTabName">
                    <a href="#"><button name="CreatTab" type="submit" class="updatePagesBtn">Create</button></a>
              </form>
            </div>
            <?php
              echo "<span id='blab-sec' style='display:none'><img id='blah2' src='#' display='none' class='tot_num2 tum'> <span ></span></span>";
            ?>
            <div class="flexin-2">
              <h5 class="cr-h5">Compose Email</h5>
                <form action="" method="POST" id="uploader" class="centt_col"><br><br>
                    <input type="text" name="sub" class="editInput3 text-marg" id="amount" placeholder="Subject"><br>
                    <textarea name="cnt" id="myPageCaption"  class=" textarea" placeholder="Description" style="border:none;width:80%; height:150px;resize:none;outline:none"></textarea><br>
                    <h5 class="subNote">Note: this email will be sent to all your subscribers</h5>
                     <button type='submit' name='sendNews'  class="updatePagesBtn">Send Email</button>
                </form>
            </div>
          </div>
          <br><br>
        </div>
      </div>
      
      
    </section>


    <?php include('../new_upload.php');?>
    <section class="uploadSec main_side" id="uploadSec" style="display:none;">
      <div >
        <div class="CreateDropdown">
              <div class="dropCreate">
                  <i class="fa fa-plus createPlus"></i>
              </div>
              <div class="dropee">
                <div class="CreateDropdown_btns">
                  <div class='top forPointer' data-toggle="modal" data-target="#CreateBrandModal">New Brand</div>
                  <div class='top forPointer' data-toggle="modal" data-target="#CreateProductModal">New Product</div>
                </div>
              </div>
        </div>
        <div class="uploadInstru">
            <h2>Add Listings</h2>
            <h4>This is your dashboard for selling your products on the marketplace and manage their listings. 
                Create new listings and manage them here. Use the Orders tab to track and process orders from your customers.
            </h4>
            <p>Note: All listing created here will be publicly available on the marketplace</p>
        </div>
              <form action="<?php echo $_SERVER['PHP_SELF'].'?view=uploadSec' ?>" method="POST" enctype="multipart/form-data" id="uploader">
                  <div class="Basic_info">
                    <h5>Product <i style="color:red">*</i></h5>
                    <select class="select-css shortSelect" name="selected">
                    <option  selected="selected" class="select"  style='line-height:20px;color:blue;'>Product to Upload</option>
                    <?php
                    foreach($Fetch_tabs as $Fetch_tab){
                    ?>
                    <option value="<?php echo strtolower($Fetch_tab);?>"><?php echo $Fetch_tab?></option> ;
                  <?php
                    }
                    ?>
                    </select><br>
                    <!-- <input type="file" name="myPageFile" class="pg-file" onchange="readURL(this)" id="myPageFile"><br><br> -->
                    <div class="myLegends">
                        <!-- <p style="width:100px">Price <i style="color:red">*</i></p> -->
                        <input type="number" name="amount" id="amount" value="&#x20A6" placeholder="&#x20A6 default price"><br><br>
                    </div>
                    <div class="myLegends">
                        <!-- <p style="width:100px">Price <i style="color:red">*</i></p> -->
                        <input type="text" name="title" id="title" placeholder="Product name"><br><br>
                    </div>
                    <div class="myLegends">
                        <!-- <p style="width:150px">Description <i style="color:red">*</i></p> -->
                        <textarea name="myPageCaption" id="myPageCaption"placeholder="Description"></textarea><br>
                    </div>

                    <div class="inp">
                        <label class="new-button Up_New-btn" for="myPageFile" style=""><i class="fa fa-upload"></i> Add Picture</label>
                        <input type="file" name="myPageFile" id="myPageFile" onchange="readURL(this)" class="new-button" style="padding:10px;"> 
                    </div>
                    <div class="tumaDiv" id="secblab" >
                        <i class="fa fa-camera fa-2x myCme"></i>
                        <img id='myblab' src='#' class='tuma' style="display:none">
                    </div>
                    <input type="text" name="imgLocGet" id="imgLoc" value=""><br>
                  </div>

                  <div class="Other_info" style="display:none">
                      <h5>optional:</h5><br>

                      <div class="myLegends">
                        <p style="width:150px">UPC</p>
                        <input type="text" name="UPC" id="amount" placeholder="UPC"><br>
                      </div>

                      <div class="myLegends">
                        <p style="width:150px">EPC</p>
                        <input type="text" name="EPC" id="amount" placeholder="EPC "><br>
                      </div>

                      <div class="myLegends">
                        <p style="width:150px">PKEY</p>
                        <input type="text" name="PKEY" id="amount" placeholder="Product key"><br>
                      </div>

                      <div class="myLegends">
                        <p style="width:150px">MPN</p>
                        <input type="text" name="MPN" id="amount" placeholder="MPN "><br>
                      </div>

                      <div class="myLegends">
                        <p style="width:150px">PN</p>
                        <input type="text" name="PN" id="amount" placeholder="PN"><br>
                      </div>
                      </div> 
                      <button type='post' name='post' class="updatePagesBtn addToPage">Upload</button>
                    
              </form>
          </div>
          <br><br><br>
      </div>
    </section>
    </div>

    <?php include('profileSetting.php'); ?>


    <section id="portfolio" class="section-bg main_side" style="display:block">
      <div class="container">
                   
        <header class="section-header">
        <?php 
      
              if(isset($picUpMessage)){
                  echo $picUpMessage;
              }
          ?>
          <h3 class="section-title">Explore Templates</h3>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">3 months subscribers</li>
              <li data-filter=".filter-card">6 months subscribers</li>
              <li data-filter=".filter-web">1 year subscribers</li>
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/app1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Strong</a></h4>
                <p>Phone</p>
                <div>
                  <a href="../img/portfolio/app1.jpg" data-lightbox="portfolio" data-title="App 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="sugu" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/web3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Strong</a></h4>
                <p>desktop</p>
                <div>
                  <a href="../img/portfolio/web3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="sugu" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card filter-web">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/card3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Gaint Black-Red</a></h4>
                <p>Laptop</p>
                <div>
                  <a href="../img/portfolio/card2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="event" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>/
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-card filter-web">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/card2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Gaint Black-Red</a></h4>
                <p>phone</p>
                <div>
                  <a href="../img/portfolio/card2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="event" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6 portfolio-item filter-app" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/app3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Strong</a></h4>
                <p>tablet</p>
                <div>
                  <a href="../img/portfolio/app3.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 3" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="sugu" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card filter-web">
            <div class="portfolio-wrap">
              <img src="../img/portfolio/card1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Gaint Black-Red</a></h4>
                <p>Tablet</p>
                <div>
                  <a href="../img/portfolio/card1.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 1" title="Preview"><i class="ion ion-eye"></i></a>
                  <form action="changeTemp.php" method="POST">
                        <input type="text" value="event" name="sugu" style="display:none;">
                        <button type="submit" name="changeTemp" style="border:none;background-color:transparent"><a href="#" class="link-details" title="Apply"><i class="ion ion-android-open"></i></a></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
    include('./myDetails.php');
  ?>
 <?php
  include('prof_footer.php')
?>

<?php 

if(isset($_GET['transaction'])){
  $tran = "iui";
  include_once('functions.php');
  if(isset($_GET['ref_sub'])){
    $n = $_GET['ref_sub'];
    $id = $_SESSION['user_info_id'];
    update_SubRef($conn,$n,$myId);
  }
  if(isset($_GET['type'])){
    $n = $_GET['ref'];
    $id = $_SESSION['user_info_id'];
    update_payRef($conn,$n,$myId);
    }
  $success = "Your payment has been received with reference ID: ".$n;
  myMessage("success","Transaction was Successful",$success,"ion-android-checkmark-circle");
}
?>
<script>
<?php
  if(isset($tran)){
?>
      window.addEventListener('mouseup', function(event){
      if(event.target != document.querySelector('.myAlertbox') && event.target.parentNode != document.querySelector('.myAlertbox')){
      document.querySelector('.mainBox').style.display='none'
      document.querySelector('.profBody').style.overflow='auto'
    }
})
<?php
  }

  if(isset($_SESSION['lowStorage'])){
    ?>
    // document.querySelector('.addToPage').name="lowStorage"



  
  </script>
  <?php
  }


?>