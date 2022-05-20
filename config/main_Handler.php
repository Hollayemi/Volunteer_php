<?php

    if(!empty(marketersInfo($conn,$myIdFetch['id']))){
        $marketersInfo      =   marketersInfo($conn,$myIdFetch['id']);
        $shop_nick          =   $marketersInfo['shop_nick'];
        $webType            =   $marketersInfo['webType'];

        $allCateg           =   explode(',',$marketersInfo['category']);


    }

    $_SESSION['year1'] = 25000;
    $_SESSION['month6'] = 12000;
    $_SESSION['month3'] = 6000;
    $_SESSION['ProfilePayment'] = 3000;



    
    

    if(isset($_POST['CreatePage'])){
        $countPagess = glob("../up/".$shop_nick."/pg/*.php");
        $numOfPages = count($countPagess);

        $CreatePageName     =  testInput($_POST['CreatePageName']);
        if($CreatePageName != ""){
            $Newpagename =  ucwords(strtolower($CreatePageName));
            $NewPageFile  =  '../up/'.$shop_nick.'/pg/'.$Newpagename . ".php";
            $contents ="<?php  
            require_once('../webTemp.php');
            $"."name"." = '$Newpagename';
            include('../../".$webType."/st/sc.php'); 
            ?>
              ";
            if(!in_array($NewPageFile,$countPagess)){
              if($myIdFetch['num_Page'] > 0 && $numOfPages <= 11){
                  if(file_put_contents($NewPageFile,$contents)){
                    $to = ($myIdFetch['num_Page'] -1);
                    update_numPage($conn,$myId,$to);
                  }else{
                  }
              }else{
               $knwO = "popo";
                echo "<div class='loginStatus'>
                <h4>Sorry,</h4><br>
                <h5>Maximum number of page reached, you can do a better subscription to create more links </h5>
                <p>( Unable to add Brand name )</p>
                </div>"; 
              }
          }else{
            $knwO = "popo";
				    echo "<div class='loginStatus'>
            <h4>Sorry,</h4><br>
            <h5>Brand name is existing, you can try using another Brand name </h5>
            <p>( Unable to add Brand name )</p>
            </div>";
          }
        }
    }

    if(isset($shop_nick)){
        $countTabss = glob("../up/".$shop_nick."/tb/*.php");
    }
    if(isset($_POST['CreatTab'])){
        
        $CreateTabName     =  testInput($_POST['CreateTabName']);
        $selectedTab       =  testInput($_POST['selectedTab']);
            if($CreateTabName != "" && $selectedTab != "" && $selectedTab != "select page"){
              $NewTabname =  $CreateTabName;
              $NewTabnameSmall = strtolower($CreateTabName);
              $NewTabFile  =  '../up/'.$shop_nick.'/tb/'.strtolower($selectedTab).'-'.strtolower($NewTabname). ".php";
              $contents ="<?php  
              require_once('../webTemp.php');
              $"."sc = 'uiii';
              $"."name = '$NewTabnameSmall';
              $"."namePage = '$selectedTab';
              $"."tab = 'true';
              include('../../".$webType."/st/pagebody.php'); 
        ?>";

        if(!in_array($NewTabFile,$countTabss)){
            if($myIdFetch['num_Tab'] > 0 ){
                  if(file_put_contents($NewTabFile,$contents)){
                    $to = ($myIdFetch['num_Tab'] -1);
                    update_numTab($conn,$myId,$to);
                  }else{
                      echo "nothing happened";
                  }
            }
        }else{
          $knwO = "popo";
          echo "<div class='loginStatus'>
          <h4>Sorry,</h4><br>
          <h5>Product name is existing, you can try using another product name </h5>
          <p>( Unable to add product name )</p>
          </div>";
        }
    }
    }
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    function generate_string($input, $strength = 16) {
      $input_length = strlen($input);
      $random_string = '';
      for($i = 0; $i < $strength; $i++) {
          $random_character = $input[mt_rand(0, $input_length - 1)];
          $random_string .= $random_character;
      }
      return $random_string;
  }

    

?>