<?php 
foreach($posts as $post){
    $liked = 'thumbs-down';
    $id = '';
    $var_class = count($post['PostUserComment']).'_'.count($post['PostUserLike']);
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
        
        if($post['PostUserLike'][$l]['user_id'] == AuthComponent::user('id')){ $liked='thumbs-up';  $id='id="'.$post['PostUserLike'][$l]['id'].'"';}
    }
?>    
                    <div class="post-users" data-id="<?php echo $var_class; ?>" id="post-user-<?php echo $post['Post']['id']; ?>" >
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
   <?php if($post['Post']['post_type_id']== 3) { ?>
                        
<div class="post-users-video">
  <video id="example_video_<?php echo $post['Post']['id']; ?>" class="video-js vjs-default-skin" poster='<?php echo APPURL.POST_VIDEO_THUMBNAIL_UPLOAD_FOLDER.$post['Post']['link'].'_196x110_thumb.png'; ?>' width="100%" height="400px" controls preload="none" data-setup="{}">
    <source src="<?php echo APPURL.POST_VIDEO_FOLDER.$post['Post']['link'].'_720x576_video.mp4' ?>" type='video/mp4' />
 <p >To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>
    
</div>
                        <?php } 
                       if($post['Post']['post_type_id']== 5) { ?>
<div class="post-users-video">

    <div class="span12">
        <div id="ap2_<?php echo $post['Post']['id']; ?>" >
            <audio controls>
              <source src="<?php echo APPURL.POST_AUDIO_FOLDER.$post['Post']['link'].'.mp3' ?>" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
            <span class="volume-full">&nbsp;</span>
         </div>


    </div>
</div>
                           <?php 
                       } 
                        if($post['Post']['post_type_id']== 2) { ?>
                        <div class="post-users-image">

                                
                            <?php echo $this->Html->image('/'.POST_IMAGE_UPLOAD_FOLDER.$post['Post']['link']);?>


                        </div>
                        <?php }
                 if($post['Post']['post_type_id']== 4) { ?>
                <div class="post-users-video" >
                    
                    <a target="_blank" href="<?php echo Configure::read('app_url').POST_DOC_UPLOAD_FOLDER.$post['Post']['link'] ?>"  >&nbsp;&nbsp;&nbsp;<span class="text-file sel-copy">&nbsp;</span></a>

                </div>   
                 <?php } ?>
                        
                        
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
                        
                            
                        <?php
                            $cmts = array_reverse($post['PostUserComment']);
                        
                        ?>
                        <div class="post-users-comment-div">
                        <?php 
                        $max_cnt=0;
                        foreach($cmts as $comment ){  ?>
                        <div class="post-users-comments" data-id="<?php echo $comment['id']; ?>" id="post-users-comment-<?php echo $comment['id']; ?>" >
                            
                            <?php  
                            //echo $this->requestAction('/users/comment_auther/'.$comment['user_id'].'/'.$comment['comment'].'/'.$comment['id']);
                             if( empty($this->requestAction('/post_user_comments/comment/'.$comment['id']))){
                            echo 'error';    
                            }else{
                                $comt['cmt_auther'] = $this->requestAction('/post_user_comments/comment/'.$comment['id']);
                                echo $this->element('comment',$comt);
                            }
                            ?>

                        </div>
                        <?php  $max_cnt++; if($max_cnt>2)break;   } 
                         if(sizeof($cmts)>3){
                        ?>
                        <div class="post-users-comments" data-id="<?php echo $comment['id']; ?>" >
                          <span class="more_cmt" > more comments</span>
                        </div>
                        <?php } ?>
                        </div>
                            <?php   if(in_array(5,$permission)) { ?>
                        <div class="post-users-comments">
                            <div class="postedby-image">
                                <?php
                                 //echo $this->Html->image('../'.CakeSession::read("Auth.User.UserProfile.photo"));                              
                                ?>
                            </div>
                            
                            <div class="commnetedby">
                                <input type="text" class="postedby-input" placeholder="Type your Comment" />
                                <i class="comment-post">&nbsp;</i>
                                
                            </div>
                            
                            
                        </div>
                            <?php } ?>
                    </div>        
      
                    
                    
                    
<?php } ?>