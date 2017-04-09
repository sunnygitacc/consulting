<style>
    .tab1{
        width:24%;

    }
    .tab1 li{
        padding-bottom: 15px;

    }
    .tab2{
        width:67%;
        padding-left: 5px;
        border-left: 3px solid #DBDBDB;
        min-height: 160px;
    }

    .profile-row-mids .education-desc {

        width: 100%;
    }
</style>

                <div class="left-panel">
                    <div class="content-left">
                        <div class="profile">
                            <div class="profile-pic">
                                <?php
                                $pic = "img/uploads/mentor_profile.jpg";
                                if(isset($user->link) && $user->link !=''){
                                    $pic = PROFILE_IMAGE_PATH_FINAL.$user->link.'_mid.jpeg';
                                }
                                echo $this->Html->image('/'.$pic);
                                ?>

                            </div>
                            <h2 class="profile-name"><?php echo $user->first_name.' '.$user->last_name ?></h2>
                            <p class="profile-abition"></p>
                            <ul class="rating">
                                <li class="active">&nbsp;</li>
                                <li class="active">&nbsp;</li>
                                <li class="active">&nbsp;</li>
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                            </ul>



                        </div>
                        <div class="groups">
                            <?php echo $this->element('menti'); ?>


                        </div>
                    </div>
                </div>
                <div class="mid-section">
                    <?php echo $this->element('mentor/about'); ?>

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

                            <div class="mentors">
                                <h2>Messages</h2>
                                <div class="custom-scroll mentors-list-main">
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Robert Jemes</h4>
                                            <p>Sr. Surgon</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors2.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Jacob Robinson</h4>
                                            <p>Sr. Surgon</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors3.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Erik Mc Williams</h4>
                                            <p>Sr. Surgon</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors4.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Jake Sullivan</h4>
                                            <p>Physicist</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors5.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Aaron Washington</h4>
                                            <p>Gynecologist</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors5.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Aaron Washington</h4>
                                            <p>Gynecologist</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>
                                    <div class="mentor-row">
                                        <div class="mentor-pic">
                                            <img src="img/uploads/mentors5.jpg" />
                                        </div>
                                        <div class="mentor-detail">
                                            <h4>Aaron Washington</h4>
                                            <p>Gynecologist</p>
                                        </div>
                                        <div class="mentor-mail">
                                            <a href="#" class="envelope"></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="clear"></div>
<?php

  //  echo $this->Html->script('jquery/jquery.js');
  echo $this->element('popUp');
  echo $this->element('video_popup');
  echo $this->element('hidden_forms');
  echo $this->element('create_group');
?>
