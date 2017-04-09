
<div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-container-profile">
                    <div class="profile-top-section">
                        <div class="cover-image">
                            
                            <?php echo $this->Html->image('banner_profile.jpg'); ?> 
                        </div>
                        
                            <div  class="cover-image" id="cover_image_upload" >

  
                                
                            </div>
                        <div class="cover-desc">
                            <div class="cover-inner">
                                <div class="cover-inner-left">
                                    <div class="cover-profile-Pic">
                                        <?php echo $this->Html->image('/'.PROFILE_IMAGE_PATH_FINAL.$mygroup['Group']['avatar'].'_mid.jpeg'); ?>
                                    </div>
                                    <div class="cover-pic-Disc">
                                        <div class="cover-pic-disc-name">
                                            <h3><?php echo $mygroup['Group']['name'] ?></h3>
                                            <h5><?php echo substr($mygroup['Group']['description'],-20); ?></h5>

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
                                            <input type="button" value="filter" />
                                            

                                            <span class="pencil">&nbsp;</span>
                                            

                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php echo $this->element('group/menu') ?>
                            </div>
                        </div>
                    </div>
                    <div class="profile-main-section">
                        <div class="left-panel">
                            <div class="content-left">
                                <div class="groups">
                                    
                                  <?php echo $this->element('group_list',array("helptext" => "Oh, this text is very helpful.")); ?>   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="profile-mid-section">
                            
                            <?php 
                                if($this->elementExists('group/'.$select)) { 
                                    echo $this->element('group/'.$select);
                                }else{
                                    echo 'Sorry some thing went Wroung !!!';
                                }
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
<?php 

  //  echo $this->Html->script('jquery/jquery.js');

  echo $this->element('hidden_forms'); 
  echo $this->element('create_group'); 
?>