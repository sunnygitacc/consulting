<?php 
foreach($posts as $post){
    $liked = 'thumbs-down';
    $id = '';
    
//    echo $post['Post']['postby_id'];
//    echo $post['Post']['postto_id'];
//    echo AuthComponent::user('id');
    $editable = FALSE;
    $delete = FALSE;
    
    //editable for owner
    if(AuthComponent::user('id') == $post['Post']['postby_id']){
        $editable = TRUE;
    }
    //delete for owner
    if((AuthComponent::user('id') == $post['Post']['postby_id'])||(AuthComponent::user('id') == $post['Post']['postto_id'])){
        $delete = TRUE;
    }
    
    for($l=0;$l < count($post['PostUserLike']);$l++){
        if($post['PostUserLike'][$l]['user_id'] == $user['User']['id']){ $liked='thumbs-up';  $id='id="'.$post['PostUserLike'][$l]['id'].'"';}
    }
?>    
                    <div class="post-users" id="post-user-<?php echo $post['Post']['id']; ?>" >
                        <div class="post-users-head">
                            

                            
                            <?php  
                            echo $this->requestAction('/users/post_auther/'.$post['Postby']['id']);
                            
                            ?>
                            <div class="post-edit-wrap" id="<?php echo $post['Post']['id']; ?>" >
                                <div class="edit pencil">&nbsp;</div>
                                <div class="postEdit-drop">
                                    <ul>
                                       <!-- <li><a href="#">Hide</a> -->
                                        </li>
                                       <?php if($delete){ ?><li><a href="#">Delete this post</a><?php } ?>
                                        </li>
                                        </li>
                                       <?php if($editable){ ?><li><a href="#">Edit this post</a><?php } ?>
                                        </li>
                                        <li><a href="#">Report this post</a>
                                        </li>
                                       <!-- <li><a href="#">Unfollow alex</a>  -->
                                        </li>
                                       <!-- <li><a href="#">Get Notification</a>  -->
                                        </li>
                                       <!-- <li><a href="#">Embed post</a> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="post-user-head-details">
                                <p class="post-text" ><?php echo $post['Post']['title']; ?>
                            </div>
                            
                            

                        </div>       
  
                     
                  
                        
                        <div class="post-users-option">
                            <ul class="post-option-ulist">
                                <li>
                                    <span <?php echo $post['Post']['id']; ?> class="<?Php echo count($post['PostUserLike']); ?>">&nbsp;</span>
                                </li>
                                <li>
                                    <span data-rel="sharepopup"  data-ajax="<?php echo $post['Post']['id']; ?>"  value="Share"  class="share-icon popup">&nbsp;</span>

                                    <span data-rel="sharepopup" <?php echo $id; ?>   class="<?php echo $liked; ?>">&nbsp;</span>
                                </li>
                            </ul>

                            <div class="post-likes"><?php  echo count($post['PostUserLike']); ?> likes</div>
                            <div class="time-post"><?php echo $post['Post']['date_posted']; ?></div>
                        </div>
                        <div class="more_comments">
                            
                        <?php
                            $cmts = array_reverse($post['PostUserComment']);
                        if(sizeof($cmts)>3){echo (sizeof($cmts)-3).' more comments';}
                        echo '</div>'; ?>
                        <div class="post-users-comment-div">
<?php 
                        $max_cnt=0;
                        foreach($cmts as $comment ){  ?>
                        <div class="post-users-comments" id="post-users-comment-<?php echo $comment['id']; ?>" >
                            
                            <?php  
                            echo $this->requestAction('/users/post_auther/'.$comment['user_id']);
                            ?>
                            <div class="commnetedby">
                            <p><?php echo  $comment['comment'] ?></p>
                            </div>
                        </div>
                        <?php  $max_cnt++; if($max_cnt>2)break;   } ?>
                        </div>
                            <?php  if(in_array(5,$permission)) { ?>
                        <div class="post-users-comments">
                            <div class="postedby-image">
                                <?php
                                 //echo $this->Html->image('../'.CakeSession::read("Auth.User.UserProfile.photo"));                              
                                ?>
                            </div>
                            
                            <div class="commnetedby">
                                <input type="text" class="postedby-input" placeholder="Type your Comment" />
                                <i class="comment-post icon-rotate-90">&nbsp;</i>
                                
                            </div>
                            
                            
                        </div>
                            <?php } ?>
                    </div>        
      
                    
                    
                    
<?php } ?>