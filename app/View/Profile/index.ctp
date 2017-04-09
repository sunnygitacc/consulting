<div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-container-profile">
                    <div class="profile-top-section">
                        <div class="cover-image">
                            
                            <?php echo $this->Html->image('banner_profile.jpg'); ?> 
                            
                            <table>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      choose  
                                    </td>
                                    <td>
                                        <input type="File" name="img" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div  class="cover-image" id="cover_image_upload" >
                            <?Php  
                            $left=0;
                            $top=0;
                            if(isset($user['UserProfile']['top'])){ $top = $user['UserProfile']['top']; $left = $user['UserProfile']['left']; }
                            echo $this->Form->create('coverpic', array('type'=>'file','id'=>'cover_image_upload_form',
                                'url' => array('controller' => 'userprofiles', 'action' => 'index'  )));
                            echo $this->Form->input('cover',array('type' => 'hidden', 'value' => 'cover'));
                            echo $this->Form->input('file',array('type' => 'file','id' => 'cover_pic_upload','label' => false));    
                            echo $this->Form->input('top' ,array('type' => 'hidden', 'id' => 'cover_top' ,'value' => $top));
                            echo $this->Form->input('left' ,array('type' => 'hidden', 'id' => 'cover_left' ,'value' => $left ));
                            echo '<input type="button" value="Drag" id="enable_cover_drag"  />';
                            echo $this->Form->submit('save');
                            echo $this->form->end();
                            ?>

                        </div>
                        <div class="cover-desc">
                            <div class="cover-inner">
                                <div class="cover-inner-left">
                                    <div class="cover-profile-Pic">
                                        <?php echo $this->Html->image('/'.$avathar_sml,array(
                                        'url'=>array('controller'=>'users','action'=>'profile_photo')
                                        )); ?>
                                    </div>
                                    <div class="cover-pic-Disc">
                                        <div class="cover-pic-disc-name">
                                            <h3><?php echo $user['User']['first_name']. " ". $user['User']['last_name']?></h3>
                                            <h5 title="<?php echo $profile_status; ?>" ><?php echo substr($profile_status,0,35); ?></h5>
                                        </div>
                                        <div class="cover-pic-disc-award">
                                            <ul class="rating">
                                                <li class="active">&nbsp;</li>
                                                <li class="active">&nbsp;</li>
                                                <li class="active">&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cover-pic-Disc-right">
                                        <div class="share">
                                            <input type="button" id="friend" class="common-button share friend" data="<?php echo $friend_status['status']; ?>" data-id="<?php echo $friend_status['id']; ?>" value="<?php echo $friend_status['word']; ?>" style="margin:10px;" >
                                            <?php if($friend_status['status'] == 1) { ?>
                                            
                                                <input type="button" id="" class="common-button share friend" data="" data-id="<?php echo $friend_status['id']; ?>" value="Reject Friend Request" style="margin:10px;" >
                                            <?php } ?>
                                        </div>
                                        <div class="share">
                                            <span class="pencil">&nbsp;</span>  
                                        </div>
                                    </div>
                                </div>
                                
                                <?php echo $this->element('profile/user_menu'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="profile-main-section">
                        <div class="left-panel">
                            <div class="content-left">
                                <div class="groups">
                                    
                                    <?php echo $this->element('group_list'); ?> 
                                 
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-mid-section" id="media-tabs" >
                            <?php 
                            
                            
                                echo $this->element('profile/'.$select);
                            ?>         
                        </div>
                        
                        
                    </div>
                </div>
                <div class="right-panel">
                    <div class="right-toggle-button">X</div>
                    <div class="content-right">
                        <div class="friend-mentors">
                            <?php echo $this->element('friend'); ?>
                            <?php echo $this->element('mentor'); ?>
                        </div>
                    </div>
                </div>
    
                <div class="clear"></div>
            </div>
        </div>
        <?php   echo $this->element('hidden_forms');  ?>