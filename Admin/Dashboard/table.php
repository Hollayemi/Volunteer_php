<?php
    require('../config/actions.php');
        if(array_key_exists('deactivate', $_POST)) {
            deactivateUser($conn, $_POST['getUser'], 'deactivated');
        }
        if(array_key_exists('active', $_POST)) {
            deactivateUser($conn, $_POST['getUser'], 'active');
        }
    ?>
<div class="myTable">
    <table id="t01">
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>	
            <th colspan="2">Deactivate</th>
        </tr>
        <?php
            for($i = 0; $i < count($allUsers); $i++){
        ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $allUsers[$i]['fullname']; ?></td>		
                <td><a href=<?php echo "mailto:".$allUsers[$i]['email']; ?>><?php echo $allUsers[$i]['email']; ?></a></td>
                <td class="funcTD">
                    <form method="post">
                        <input type="hidden" name="getUser" 
                            value=<?php echo $allUsers[$i]['id']; ?> />
                        <?php if($allUsers[$i]['status']=='active'){?>
                            <input type="submit" name="deactivate"
                                class="tableButton" 
                                value="Deactivate" />

                            <input type="submit" name="active"
                                class="tableButton tableButton_deactivated" 
                                value="Activate" disabled= "true" />
                        <?php }else{ ?>
                            <input type="submit" name="deactivate"
                                class="tableButton tableButton_deactivated" 
                                disabled= "true"
                                value="Deactivate" />

                            <input type="submit" name="active"
                                class="tableButton" 
                                value="Activate" />
                        
                        <?php } ?>
                    </form>
                </td>
            </tr>
        <?php 
            }            
        ?>
    </table>
</div>