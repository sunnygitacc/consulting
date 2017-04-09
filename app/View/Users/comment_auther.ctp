        <div class="postedby-image">
            <?php
            
             echo $this->Html->image('/'.$cmt_auther['pic']);                              
            ?>
        </div>
        <div class="commnetedby">
            <h2><?php echo $cmt_auther['name']; ?>
            </h2>
            <p><?php echo  $cmt_auther['comment'] ?></p>
            <span class="<?php echo $cmt_auther['ilike']; ?>" >&nbsp;&nbsp;&nbsp;</span>
            <span class="cmt_like_count" ><?php echo $cmt_auther['count']; ?> like</span>
        </div>
