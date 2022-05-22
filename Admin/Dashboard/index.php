<?php
    session_start();
    require('../config/config.php');
    $allUsers = (allUsers($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../font-awesome.min.css">
    <title>Volunteer Dashboard</title>
</head>
<body>
    <section class="dashboardBox">
        <div class="flex">
            <div class="smallSide">
                <img src="avatar2.png" alt="">
                <div class="bottom">
                    <i class="fa fa-cog" id="dropMenu">o</i>
                    <a href="../config/expire.php" class="bottom">Logout</a>
                </div>
            </div>
            <div class="bigSide">
                <div class="dasboardTop">
                    welcome,<?php echo $name ?>
                </div>
                <div class="dashboard-content">
                    <div class="myCard">
                        <div class="userCard">
                            <img src="./avatar2.png" alt="">
                            <p><?php echo count($allUsers) ?> users Registered</p>
                        </div>
                    </div>
                    <?php
                        require('./table.php');
                    ?>
                </div>
                <div class="addAdminForm">
                    <div class="editInfo" id="editForm">
                        <form id="addAdmin-form" method="POST">
                            <div id="passMsg3"></div>
                            <input type="text" name="name" value="" placeholder="Admin Name">
                            <input type="email" name="email" value="" placeholder="Admin Email">
                            <input type="password" name="pass" id="pass" placeholder="New Password">
                            <input type="password" name="conf_pass" id="cpass" placeholder="Re-type password">
                            <input type="submit" id="addAdmin-btn" name="addNew" value="Add">
                            <button class="formBack" id="formBack">Back</button>
                        </form>
                    </div>

                    <div class="editInfo" id="deleteForm">
                        <form id="deleteAdmin-form" method="POST">
                            <div id="passMsg4"></div>
                            <input list="browsers" name="getAdmin">
                                <?php require('admins.php') ?></php>
                            <input type="submit" id="deleteAdmin-btn " class="removeAdmin" name="addNew" value="Remove">
                            <button class="formBack" id="formBack2">Back</button>
                        </form>
                    </div>
                </div>
                <ul class="myDropDown hideMenu">
                    <h5><?php echo $email ?></h5>
                    <br>
                    <li id="editButton">Add new admin</li>
                    <li id="deleteButton">Delete admin</li>
                </ul>
                <div class="Submitted">
                    <h5>Successfully changed</h5>
                    <button id="goBack">Go Back</button>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../../jquery.min.js"></script>
<script src="dashboard.js"></script>
<script src="../config/auth.js"></script>
</html>