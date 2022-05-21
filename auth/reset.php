<?php
    require('../config/actions.php');
    $token = $_GET['token'];
    $myTokenFetch = resetPassword($conn,$token);
    if($myTokenFetch['email']){
        $email = $myTokenFetch['email'];
    }else{
        header('Location:./err.php?err_code=icd4');
    }

?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Volunteer</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='index.css' rel='stylesheet'>
    </head>
    <body className='snippet-body'>
        <div class="container2" style="height:100%;">
            <div class="frame">                    
                <form class="form-signup fp_Page" id="reset-form" method="POST">
                    <div class="derivedEmail"><?php echo $email; ?></div>
                    <div id="passMsg"></div>
                        <div class="inputDiv">
                            <label for="email">New password</label>
                            <input class="form-styling" type="password" name="pass" placeholder=""/>
                        </div>
                        <div class="inputDiv">
                            <label for="email">Confirm password</label>
                            <input class="form-styling" type="password" name="cpass" placeholder=""/>
                        </div>
                        <input type="hidden" name="myToken" value=<?php echo $token ?> />
                    <button id="reset-btn" type="submit" name="signup" class="btn-signup">Reset</button>
                </form>
                    
            </div>
        </div>
        <script type='text/javascript' src='../jquery.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='auth.js'></script>
    </body>
</html>