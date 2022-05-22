<div class="myTable">
    <table id="t01">
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>		
        </tr>
        <?php
            for($i = 0; $i < count($allUsers); $i++){
        ?>
                <tr>
                    <td><?php echo $i+1 ?></td>
                    <td><?php echo $allUsers[$i]['fullname']; ?></td>		
                    <td><?php echo $allUsers[$i]['email']; ?></td>
                </tr>
        <?php 
            }            
        ?>
    </table>
</div>