
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

                            <div class="profile-row-mids">
                                <div class="editPencil pencil">&nbsp;</div>

                                <div class="education-desc">
                                    <h3>Settings</h3>
                                    <div class="edu-desc-row">
                                        <h4>St. Alberts university Alba</h4>
                                        <p>2013 current</p>
                                    </div>
                                    <div class="edu-desc-row">
                                        <h4>Noth stair middle school, Alba</h4>
                                        <p>2011 - 2013</p>
                                    </div>
                                    <div class="edu-desc-row">
                                        <h4>Praire star school, Alba</h4>
                                        <p>2009 - 2011</p>
                                    </div>
                                </div>
                            </div>

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
