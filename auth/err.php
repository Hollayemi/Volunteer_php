<?php
    require('../config/actions.php');
    $code = $_GET['err_code'];
    if($code === 'icd4'){
        $error = "The url does not exist or expired";
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
            <h5><?php echo $error ?> </h5>
            <a href="../">Back to login</a>
        </div>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='auth/auth.js'></script>
    </body>
</html>