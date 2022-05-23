<?php
    require('../config/actions.php');
    session_start();
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $name = testInput($_POST['fullname']);
        $email = testInput($_POST['email']);
        $password = testInput($_POST['password']);
        $conf_pass = testInput($_POST['conf_pass']);

        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        $checkExistence = userExist($conn,$email);

        if(strlen($name) > 1 && strlen($email) > 1){
            if(strlen($password) > 5){
                if(!$checkExistence){
                    if(createNewUser($conn, $email, $hashPwd, $name, $token)){
                        echo "Registered";
                    }else{
                        echo "server error";
                    };
                }else{
                    echo "Email already exist";
                }
            }else{
                echo "Password too short";
            }
        }else{
            echo "All fieldS are required";
        }
    };





    if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $email = ($_POST['email']);
        $password = testInput($_POST['password']);
        $loggedInUser = login($conn,$email);
        if($loggedInUser != null){
            if($loggedInUser['status'] != 'deactivated'){
                if(password_verify($password,$loggedInUser['password'])){
                    echo "logged in";
                    $_SESSION['user'] = $loggedInUser['email'];
                }else{
                    echo "Incorrect password";
                }
            }else{
                echo "Account deactivated";
            }
        }else{
            echo "Email not registered";
        }
    };




    if(isset($_POST['action']) && $_POST['action'] == 'edit'){
        $name = ($_POST['name']);
        $email = ($_POST['email']);
        $password = testInput($_POST['pass']);
        $conf_pass = ($_POST['email']);
        $currentUser = currentUser($conn,$_SESSION['user']);
        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        if($currentUser){
            if(strlen($name) > 1 && strlen($email) > 1){
                if(strlen($password) > 6){
                    if(editUser($conn,$name,$hashPwd,$email,$currentUser['id'])){
                        $_SESSION['user'] = $email;
                        echo "done";
                    }else{
                        echo "server error";
                    };
                }else{
                    echo "Password too short";
                }
            }else{
                echo "All field are required";
            }
        }
    };





    if(isset($_POST['action']) && $_POST['action'] === 'forgot'){
        $email = testInput($_POST['email']);
        $by = testInput($_POST['hide']);
        $token = bin2hex(random_bytes(50));
        if($by === 'user'){
            $checkUser = currentUser($conn,$email);
        }else{
            $checkUser = currentAdmin($conn,$email);
        }
        if(!empty($email)){
            if($checkUser){
                $Reciever = $email;
                $name= $checkUser['fullname'];
                $Topic = "Change of password";
                $resetUrl = "http://localhost:10000/dashboard/volunteer/auth/reset.php?token=".$checkUser['authToken'];
                $content = '<!DOCTYPE html>
                <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
                <head><title>Volunteer</title><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/><meta content="width=device-width,initial-scale=1" name="viewport"/><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/><link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/><!--<![endif]-->
                    <style>*{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}@media (max-width:620px){.desktop_hide table.icons-inner{display:inline-block!important}.icons-inner{text-align:center}.icons-inner td{margin:0 auto}.row-content{width:100%!important}.image_block img.big{width:auto!important}.column .border,.mobile_hide{display:none}table{table-layout:fixed!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}</style>
                </head>
                <body style="background-color:#d9dffa;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#d9dffa" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#cfd6f4" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600"><tbody><tr><td class="column column-1" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:20px;padding-bottom:0;border-top:0;border-right:0;border-bottom:0;border-left:0" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="width:100%;padding-right:0;padding-left:0"><div align="center" style="line-height:10px"></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#d9dffa;background-image:url(images/body_background_2.png);background-position:top center;background-repeat:repeat" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600"><tbody><tr><td class="column column-1" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-left:50px;padding-right:50px;padding-top:15px;padding-bottom:15px;border-top:0;border-right:0;border-bottom:0;border-left:0" width="100%"><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#506bec;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px"><strong><span style="font-size:38px;">Forgot your password?</span></strong></p></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#40507a;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px"><span style="font-size:16px;">Hi '.$name.', we received a request to reset your password.</span></p></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#40507a;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px"><span style="font-size:16px;">Let’s get you a new one!</span></p></div></div></td></tr></table><table border="0" cellpadding="0" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:20px;text-align:left"><!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.example.com/" style="height:48px;width:212px;v-text-anchor:middle;" arcsize="34%" stroke="false" fillcolor="#506bec"><w:anchorlock/><v:textbox inset="5px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:15px"><![endif]-->
            <a href='.$resetUrl.' style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#506bec;border-radius:16px;width:auto;border-top:0px solid TRANSPARENT;font-weight:undefined;border-right:0px solid TRANSPARENT;border-bottom:0px solid TRANSPARENT;border-left:0px solid TRANSPARENT;padding-top:8px;padding-bottom:8px;font-family:Helvetica Neue, Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:25px;padding-right:20px;font-size:15px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span data-mce-style="font-size: 15px; line-height: 30px;" style="font-size: 15px; line-height: 30px;"><strong>RESET MY PASSWORD</strong></span></span></span></a>
            <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#40507a;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px">
            <span style="font-size:14px;">Having trouble? <a href="http://www.example.com/" rel="noopener" style="text-decoration: none; color: #40507a;" target="_blank" title="@socialaccount"><strong>@volunteerprogram</strong></a></span></p></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#40507a;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px">Didn’t request a password reset? You can ignore this message.</p></div></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600"><tbody><tr><td class="column column-1" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:0;padding-bottom:5px;border-top:0;border-right:0;border-bottom:0;border-left:0" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="width:100%;padding-right:0;padding-left:0"><div align="center" style="line-height:10px"></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600">
            <tbody><tr><td class="column column-1" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:20px;border-top:0;border-right:0;border-bottom:0;border-left:0" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="width:100%;text-align:center"><h1 style="margin:0;color:#555;font-size:23px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;line-height:120%;text-align:center;direction:ltr;font-weight:700;letter-spacing:normal;margin-top:0;margin-bottom:0"><span class="tinyMce-placeholder">Volunteer </span></h1></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="social_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="72px"><tr><td style="padding:0 2px 0 2px"><a href="https://www.instagram.com/" target="_blank"><img alt="Instagram" height="32" src="images/instagram2x.png" style="display:block;height:auto;border:0" title="instagram" width="32"/></a></td><td style="padding:0 2px 0 2px">
            <a href="https://www.twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter2x.png" style="display:block;height:auto;border:0" title="twitter" width="32"/></a></td></tr></table></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#97a2da;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px;text-align:center">+(123) 456–7890</p></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#97a2da;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;font-size:14px;text-align:center">This link will expire in the next 24 hours.<br/>Please feel free to contact us at email@volunteer.com.</p></div></div></td></tr></table><table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word" width="100%"><tr><td><div style="font-family:sans-serif"><div class="txtTinyMce-wrapper" style="font-size:14px;mso-line-height-alt:16.8px;color:#97a2da;line-height:1.2;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><p style="margin:0;text-align:center;font-size:12px"><span style="font-size:12px;">Copyright© 2022 volunteer program</span></p><p id="m_8010100107078456808text01" style="margin:0;text-align:center;font-size:12px;mso-line-height-alt:16.8px"> </p></div></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tbody><tr><td><table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;width:600px" width="600"><tbody><tr><td class="column column-1" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:5px;padding-bottom:5px;border-top:0;border-right:0;border-bottom:0;border-left:0" width="100%"><table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="vertical-align:middle;color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center"><table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0" width="100%"><tr><td style="vertical-align:middle;text-align:center">
            <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]--><!--[if !vml]><!--><table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;display:inline-block;margin-right:-4px;padding-left:0;padding-right:0"><!--<![endif]--><tr><td style="vertical-align:middle;text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:6px"><a href="https://www.designedwithbee.com/" style="text-decoration: none;" target="_blank"></a></td><td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:15px;color:#9d9d9d;vertical-align:middle;letter-spacing:undefined;text-align:center"><a href="https://www.designedwithbee.com/" style="color: #9d9d9d; text-decoration: none;" target="_blank"></a></td></tr></table></td></tr></table></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --></body></html>';

                MyMailer($Topic,$Reciever,$content,'hj');                   
            
            }else{
                echo "Email does not exist";
            }
        }else{
            echo "Email field is required";
        }
    }




    if(isset($_POST['action']) && $_POST['action'] == 'reset'){
        $password = testInput($_POST['pass']);
        $conf_pass = ($_POST['cpass']);
        $myToken = ($_POST['myToken']);
        $getAccess = ($_POST['getAccess']);
        echo $getAccess;
        if($getAccess === 'user'){
            $currentUser = resetPassword($conn,$myToken);
        }else{
            $currentUser = resetPassword2($conn,$myToken);
        }
        $token = bin2hex(random_bytes(50));        
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);
        if($currentUser){
            if(strlen($password) > 6){
                if($getAccess === 'user'){
                    if(updatePassword($conn,$token,$hashPwd,$myToken)){
                        echo "done";
                    }else{
                        echo "server error";
                    };
                }elseif($getAccess === 'admin'){
                    if(updatePassword2($conn,$token,$hashPwd,$myToken)){
                        echo "done";
                    }else{
                        echo "server error";
                    };
                }else{
                    echo "Access not granted";
                }

            }else{
                echo "Password too short";
            }
            
        }else{
            echo "not exist";
        }
    };


?>