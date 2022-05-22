<datalist id="browsers">
    
    <?php
        for($i = 0; $i < count($allUsers); $i++){
    ?>
            <option value=<?php echo $allUsers[$i]['email']; ?>>
    <?php 
        }            
    ?>
</datalist>