<?php
    session_start();
    require('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Volunteer Dashboard</title>
</head>
<body>
    <section class="dashboardBox">
        <div class="flex">
            <div class="smallSide">
                <img src="avatar2.png" alt="">
                <a href="../config/expire.php" class="bottom">Logout</a>
            </div>
            <div class="bigSide">
                <div class="dasboardTop">
                    welcome, <?php echo $name ?>
                </div>
                <div class="dashboard-content">
                    <h5><?php echo $email ?></h5>
                    <button id="editButton">Edit Infomation</button>
                </div>
                <div class="editInfo" id="editForm">
                    <form action="" id="edit-form" method="POST">
                        <div id="passMsg3"></div>
                        <input type="text" name="name" value=<?php echo $fullname ?> placeholder="Full name">
                        <input type="email" name="email" value=<?php echo $email ?> placeholder="Email">
                        <input type="password" name="pass" id="pass" placeholder="New Password">
                        <input type="password" name="conf_pass" id="cpass" placeholder="Re-type password">
                        <input type="submit" id="form-submit" name="change" value="Save">
                        <button class="formBack" id="formBack">Back</button>
                    </form>
                </div>
                <div class="Submitted">
                    <h5>Successfully changed</h5>
                    <button id="goBack">Go Back</button>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../jquery.min.js"></script>
<script src="dashboard.js"></script>
<script src="../auth/auth.js"></script>
</html>