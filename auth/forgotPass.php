<?php
    $by = $_GET['by']
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
                <form class="admin-signup fp_Page" id="forgot-form" method="POST" style="padding:0px 10px ;">
                    <div id="passMsg"></div>
                    <div class="fp_emailInput">
                        <label for="email">Email</label>
                        <input class="form-styling" type="email" name="email" placeholder=""/>
                        <input class="form-styling" value=<?php echo $by ?> type="hidden" name="hide" placeholder=""/>
                    </div>
                    <button id="forgot-btn" type="submit" name="signup" style="margin-top:-5px;" class="btn-signup">Send</button>
                    <br>
                    <div class="fp_back" id="forgotP">
                        <?php 
                            if($by == 'admin1'){
                                echo '<a href="../Admin">Back to login</a>';
                            }else{
                                echo '<a href="../">Back to login</a>';
                            }
                        ?>
                        
                    </div>
                </form>
                    
            </div>
        </div>
        <script type='text/javascript' src='../jquery.min.js'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='auth.js'></script>
    </body>
</html>