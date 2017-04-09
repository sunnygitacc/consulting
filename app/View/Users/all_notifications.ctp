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
                <div class="mid-section">
                   <div class="row-mid-notification search-notification" >
                       <input class="search-notif-input" />
                       <input class="search-notif-button" type="submit" value="&#xf002;" name="search">
                   </div>               

                    <div class="row-mid-notification list-notif-search" >
                        <ul>
                            
                            <?Php pr($note);
                            foreach ($note as $oneNote){

                              ?>   

                            <li>
                                <div class="notif-image">
                                    <img src="assets/images/uploads/pic1.jpg" />
                                </div>
                                <div class="notif-copy">
                                    <h3>Hentry Json</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <span>19 JUN , 11:42 AM</span>
                                </div>
                            </li>
                           <?php
                            }
                            
                            ?>
                            
                           
                        </ul>
                    </div>

                </div>
                <div class="mid-sec-add">
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
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