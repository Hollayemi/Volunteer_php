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
                <form class="form-signup fp_Page" method="POST">
                    <div id="passMsg"></div>
                    <div class="fp_emailInput">
                        <label for="email">Email</label>
                        <input class="form-styling" type="email" name="fullname" placeholder=""/>
                    </div>
                    <button id="register-btn3" type="submit" name="signup" class="btn-signup">Send Email</button>
                    <div class="fp_back" id="forgotP">
                        <a href="../">Back to login</a>
                    </div>
                </form>
                    
            </div>
        </div>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='auth/auth.js'></script>
    </body>
</html>