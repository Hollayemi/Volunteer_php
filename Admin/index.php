<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Volunteer</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='../auth/index.css' rel='stylesheet'>
    </head>
    <body className='snippet-body'>
        <div class="container2" style="height:100%;">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                        <li class="signin-inactive"><a class="btn" id="signinBtn">Admin Login</a></li>
                    </ul>
                </div>
                <div>
                    <div id="signinBox">
                        <form class="form-signin" id="admin-form"  method="post" name="form">
                            <div id="passMsg"></div>
                            <label for="username">Email</label>
                            <input class="form-styling" type="email" name="email" placeholder=""/>
                            <label for="password">Password</label>
                            <input class="form-styling" id type="password" name="password" placeholder=""/>
                            <div class="btn-animate">
                                <button id="admin-btn" class="btn-signin">Sign in</button>
                            </div>
                            <a href="../auth/forgotPass.php?by=admin1" class="forgot">Forgot your password?</a>
                        </form>
                    </div>
                </div>
            
        </div>
        <!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> -->
        <script src="../jquery.min.js"></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='config/admin.js'></script>
    </body>
</html>