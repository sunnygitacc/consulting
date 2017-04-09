
        <div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-panel">
                    <div class="content-left">
                        <div class="profile">
                            <div class="profile-pic">
                                <?php echo $this->Html->image('/'.$avathar,array(
                                'url' => array('controller' =>'profiles',"action" => "index")
                                )); ?>
                            </div>
                            <h2 class="profile-name"><?php echo ( $user['User']['first_name'].' '.$user['User']['last_name']); ?></h2>
                            <p class="profile-abition">become a doctor</p>
                            <ul class="rating">
                                <li class="active">&nbsp;</li>
                                <li class="active">&nbsp;</li>
                                <li class="active">&nbsp;</li>
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                            </ul>
                        </div>
                        <div class="groups">
                            <?php echo $this->element('group_list',array("helptext" => "Oh, this text is very helpful.")); ?>
                            

                        </div>
                    </div>
                </div>
 
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->  
                <!-- POst Section Start -->
                
                <div class="mid-section" id="mid-section" >

                            <div class="profile-row-mids" id="User_Log">
                                <?php  foreach($log as $log_one){   ?>
                                <div class="notification-list-row">
                                    <div class="search-row-sugg">
                                        <div class="sugg-image">
                                            <img src="assets/images/uploads/pic1.jpg" />
                                        </div>
                                        <div class="sugg-details">
                                            <?Php
                                            $text = $log_one['ToWall']['name'].' Group';
                                            if($log_one['UserLog']['wall_type']==1){
                                                
                                                $text = $log_one['ToUser']['first_name'].' '.$log_one['ToUser']['last_name'];
                                            }
                                                
                                                ?>
                                            
                                            <p><?php echo $log_one['Action']['description'].$text ?></p>
                                        </div>
                                    </div>

                                </div>
                                <?php } ?>
                            </div>
                                        <?php
                        echo $this->Paginator->next('Show more star wars posts...');
                    ?>

                </div>
                
                
                <!-- POst Section Ends -->
    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->              
                
                <div class="right-panel">
                    <div class="right-toggle-button">X</div>
                    <div class="content-right">
                        <div class="friend-mentors">
                            
                            <?php echo $this->element('friend'); ?>
                            <?php echo $this->element('mentor'); ?>

                        </div>
                        <div class="adds-main">
                            <div class="adds-row">ADDS</div>
                            <div class="adds-row">ADDS</div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
<?php 

  echo $this->element('popUp');

  echo $this->element('hidden_forms'); 
?>
