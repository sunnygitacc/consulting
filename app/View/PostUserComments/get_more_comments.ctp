<?php 
$max_cnt=0;
foreach($cmt as $comment ){  ?>
<div class="post-users-comments" data-id="<?php echo $comment['PostUserComment']['id']; ?>" id="post-users-comment-<?php echo $comment['PostUserComment']['id']; ?>" >

    <?php  
    echo $this->requestAction('/users/comment_auther/'.$comment['PostUserComment']['user_id'].'/'.$comment['PostUserComment']['comment'].'/'.$comment['PostUserComment']['id']);
    ?>

</div>
<?php
$max_cnt++; if($max_cnt>2) break; 

} if(count($cmt)>3) { ?>
<div class="post-users-comments" data-id="<?php echo $comment['PostUserComment']['id']; ?>">
<span> more comments</span>
</div>
<?php } ?>