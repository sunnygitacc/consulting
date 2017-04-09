<div class="friend-list">
    <h2>
        <span class="iocnfr"></span>Friends list</h2>
       <div class="custom-scroll friend-list-row-main">
       	
       	   
		       <?php //pr($user);
                       $userFriends = $this->requestAction('user_friends/get_friend_list/'.$user['User']['id']);
			     foreach($userFriends as $index=>$post){ 
                                 
                                if($index % 3 == 0) {
                                if($index != 0){ 
                                 echo '</div>';
                                   } 
                                
                                echo '<div class="group-row">';
                                  } ?>	
               		  	 
                            <div class="group-row-box">
		                <div class="online">&nbsp;</div>
		                <div class="row-pic">
		                	<?php 
		                	$imagePath = "../img/userReg.jpg";
		                	if($post['UserGroupProfilePic']['link']) {
		                		$imagePath = '/'.PROFILE_IMAGE_PATH_FINAL.$post['UserGroupProfilePic']['link'].'_sml.jpeg';
		                	}
		                	echo $this->Html->image($imagePath,array('url'=>array(
                                            'controller'=>'profiles','action'=>'index',$post['User']['id']
                                        ))); 
		                	?>
		                </div>
		                <div class="row-pic-name">
		                	<?php echo $post['User']['first_name'];?> <?php echo $post['User']['last_name'];?>
		                </div>
		            </div>
               
                                <?php 
                                if( ($index+1)  == count($userFriends)){
                                    echo '</div>';
                                } }    ?>
				
		     
      </div>
</div>