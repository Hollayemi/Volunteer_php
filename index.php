<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Volunteer</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='auth/index.css' rel='stylesheet'>
    </head>
    <body className='snippet-body'>
        <div class="container">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                        <li class="signin-inactive"><a class="btn" id="signinBtn">Sign in</a></li>
                        <li class="signup-inactive"><a class="btn" id="signupBtn">Sign up </a></li>
                    </ul>
                </div>
                <div>
                    <div id="signinBox">
                        <form class="form-signin"  method="post" name="form">
                        <label for="username">Username</label>
                        <input class="form-styling" type="password" name="username" placeholder=""/>
                        <label for="password">Password</label>
                        <input class="form-styling" id type="password" name="password" placeholder=""/>
                        
                        <div class="btn-animate">
                            <button id="login-btn" class="btn-signin">Sign in</button>
                        </div>
                        </form>
                    </div>
                    <div id="signupBox">
                        <form class="form-signup" id="register-form" method="POST">
                            <div id="passMsg"></div>
                            <label for="email">Email</label>
                            <input class="form-styling" type="text" name="email" placeholder=""/>
                            <label for="password">Password</label>
                            <input class="form-styling" id="r-password" type="password" name="password" placeholder=""/>
                            <label for="confirmpassword">Confirm password</label>
                            <input class="form-styling" id="cpassword" type="password" name="confirmpassword" placeholder=""/>
                            <button id="register-btn" type="submit" name="signup" class="btn-signup">Register</button>
                        </form>
                    </div>
                </div>
              
                <div class="forgot" id="forgotP">
                    <a href="#">Forgot your password?</a>
                </div>
                <div>
                <div class="cover-photo"></div>
                <div class="profile-photo"></div>
                <h1 class="welcome">Welcome, Friend</h1><br />
                <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
            </div>
        </div>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='auth/auth.js'></script>
    </body>
</html>