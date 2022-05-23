<?php
    require_once "actions.php";


    // Load Composer's autoloader
    if(isset($loader)){
        require '../vendor/autoload.php';
    }else{
        require 'vendor/autoload.php';
    }

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    // // Instantiation and passing `true` enables exceptions
    // $mail = new PHPMailer(true);

    if(isset($_POST['action']) && $_POST['action'] === 'Register'){
        $username           = testInput($_POST['username']);
        $email              = testInput($_POST['email']);
        $phone              = testInput($_POST['phone']);
        $password           = testInput($_POST['password']);
        $confirmPassword    = testInput($_POST['confirmPassword']);

        $token = bin2hex(random_bytes(50));        

        $hashPwd = password_hash($password,PASSWORD_DEFAULT);

        if($password === $confirmPassword){
            if(userExist($conn,$email)){
                echo displayMessage('warning',"This E-mail is already registered!");
            }else{
                $register = register($conn,$username,$email,$hashPwd,$phone, $token);
                if($register){
                    echo displayMessage('success', "Registered SuccessFully");
                    $_SESSION['user'] = $email;
                    $Reciever =  $Mailresult['email'];
                    $Topic  = "Password Changed";
                    $content  = "
                        <section style='background-color:rgb(31, 31, 31);display:flex;align-items:center;justify-content:center;font-family:Tahoma, Geneva, Verdana, sans-serif; height:auto;position:relative;'>
                            <div style='border:1px solid rgba(165, 165, 165, 0.534);width:85%;background-color:#000;padding:20px 10px;'>
                            <img src='img/kemon.png' height='60px' width='120px'>
                            <h4 style='font-size:18px;font-weight:normal; color:#fff;'>Hi there, ".$Mailresult['username']."!</h4><br>
                            <h5 style='font-size:15px;color:rgb(199, 199, 199);font-weight:normal;line-height:28px;x'>Thanks on signing up with Kemon-Market, <br> My name is Oluwasusi Stephen and i will be at your service. <br><br>Whenever you are stuck, I could be of help.<br> If
                                you have few minutes to spare this week, i will be ecstastic to take you a tour on how to use Kemon-Market. You can as well chat me on 
                                <a style='background-color:rgb(28, 99, 230);color:#fff; padding:10px 15px; border-radius:4px;text-decoration:none;' href='https://api.whatsapp.com/send?phone=+2348147702684&text=Hi,%20from%20Kemon-Market, %20I%20just%20joined%20Kemon%20today.%20my%20name%20is%20__'>Whatsapp </a><br><br> or you give me a call
                                <a style='background-color:rgb(28, 99, 230);color:#fff; padding:12px 18px; border-radius:4px;text-decoration:none;' href='tel:08147702684'>+2348147702684</a><br><br>
                            </h5>
                            <h4 style='font-size:18px;font-weight:normal; color:#fff;'>Cheers, <br><span style='display:flex;align-items:center;justify-left:center;'>Oluwasusi stephen <img src='img/amb1.png' style='width:30px;height:30px;border-radius:50%;margin-left:10px'></h4>
                            <h5 style='font-size:13px;color:rgba(165, 165, 165, 0.534);'><i>Manager</i></h5>
                            </span>
                            </div>
                        </section>
                    ";
				MyMailer($Topic,$Reciever,$content,$newToken);                   
                }else{
                    echo displayMessage('warning',"Server Error");
                }
            }
        }
    }



    // handle login
    if(isset($_POST['action']) && $_POST['action'] === 'login'){
        print_r($_POST);
        $email = testInput(($_POST['username']));
        $pass = testInput(($_POST['login-password']));

        $loggedInUser = login($conn,$email);
        if($loggedInUser != null){
            if(password_verify($pass,$loggedInUser['password'])){
                if(!empty($_POST['rem'])){
                    setcookie('email',$email,time()+(30*24*60*60),'/');
                    setcookie('password',$pass,time()+(30*24*60*60),'/');
                }else{
                    setcookie('email','',1,'/');
                    setcookie('password','',1,'/');
                }
                echo $email;;
                $_SESSION['user'] = $email;
                // header("location:Register.php");
            }else{
                echo displayMessage('danger','Password is incorrect');
            }
        }else{
            echo displayMessage('danger','User not found!');
        }
    }






    function loginChkDara($conn,$email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    



if(isset($_GET['loc'])){
    $redirLoc   =   $_GET['loc'];
}else{
    $redirLoc   =   'Register.php';
}


    
if(isset($_POST['loginBtn'])){
    echo "fdfd";
	$myInputEmail=testInput($_POST['Email']);
	$inputPassword=testInput($_POST['Password']);
    $result =   loginChkDara($conn,$myInputEmail);

    // echo password_hash($inputPassword,PASSWORD_DEFAULT);
	if(!empty($result)){
		$chk_password   =$result['password'];
		$chk_email      =$result['email'];
		$inputUsername  = $result['username'];

        if(password_verify($inputPassword,$result['password'])){
            echo "yes";
            $chk_id=$result['id'];
            $_SESSION['user_info_id'] = $chk_id;
            if($inputUsername=="OnlyTheAdmin")
            {
                $chk_email=$result['email'];
                echo "Status:Logged in";
                header("location:Admin2.php");
            }
            else{
                $chk_username=$result['username'];
                $_SESSION['user_info_id']=$chk_id;
                $_SESSION['user']=$chk_email;
                echo "good";
                header("location:".$redirLoc);
            }
        }
        else{
            $knwO = "popo";
            echo "<div class='loginStatus'>
                <h4>Status:</h4><br><br>
                <h5>you are not logged in</h5><br>
                <p>( Incorrect Password or Email )</p>
            </div>";
        }
	}else{
		$knwO = "popo";
		echo "<div class='loginStatus'>
			    	<h4>Status:</h4><br><br>
					<h5>you are not logged in </h5><br>
					<p>(Email not registered)</p>
			  </div>";
	}
}

if(isset($_GET['err-using-google'])){
	$knwO = "popo";
	echo "<div class='loginStatus'>
			<h4>Status:</h4>
			<h5>you are not logged in </h5>
			<p>( G-mail not registered )</p>
		</div>";
}

?>