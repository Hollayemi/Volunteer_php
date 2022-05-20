<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Porlts</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='./index.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    </head>
    <body className='snippet-body'>
        <div class="container">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                        <li class="signin-active"><a class="btn">Sign in</a></li>
                        <li class="signup-inactive"><a class="btn">Sign up </a></li>
                    </ul>
                </div>
                <div ng-app ng-init="checked = false">
                    <form class="form-signin" action="" method="post" name="form">
                      <label for="username">Username</label>
                      <input class="form-styling" type="text" name="username" placeholder=""/>
                      <label for="password">Password</label>
                      <input class="form-styling" type="text" name="password" placeholder=""/>
                      <div class="btn-animate">
                        <a class="btn-signin">Sign in</a>
                      </div>
                    </form>
                
                    <form class="form-signup" action="" method="post" name="form">
                      <label for="email">Email</label>
                      <input class="form-styling" type="text" name="email" placeholder=""/>
                      <label for="password">Password</label>
                      <input class="form-styling" type="text" name="password" placeholder=""/>
                      <label for="confirmpassword">Confirm password</label>
                      <input class="form-styling" type="text" name="confirmpassword" placeholder=""/>
                      <a ng-click="checked = !checked" class="btn-signup">Sign Up</a>
                    </form>
                </div>
              
                <div class="forgot">
                    <a href="#">Forgot your password?</a>
                </div>
                <div>
                <div class="cover-photo"></div>
                <div class="profile-photo"></div>
                <h1 class="welcome">Welcome, Friend</h1>
                <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
            </div>
        </div>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='./auth.js'></script>
    </body>
</html>