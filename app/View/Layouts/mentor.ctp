<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0, user-scalable=no" />
    
    <?php 
    echo $this->Html->scriptBlock('var jsVars = '.$this->Js->object($jsVars).';');
    //pr($notificatons);
    echo $this->Html->css('addedstyles');
    echo $this->Html->css('jquery.mCustomScrollbar.css');
    echo $this->Html->css('styles.css');
    echo $this->Html->css('jquery-ui.css');
    echo $this->Html->script('modernizr.custom.56100');
        echo $this->Html->css('jquery-ui_dialog.css');

    ?>
    
</head>

<body>
    <div class="main-container mentor-page">
        <div class="header-wrapper">
            <div class="full-container header">
                <div class="fixed-container">
                    <div class="logo">
                        <a href="#">
                            <img alt='WIZSPEAK' title="WIZSPEAK" src="/wizspeakv254/img/logo.png" />
                        </a>

                    </div>
                    <div class="search-main">
                            
                            <?php echo $this->element('main_search'); ?>

                    </div>
                    <?php echo $this->element('notification'); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="full-container secondary-nav">
                <div class="fixed-container">
                    <div class="secodnav-left">
                        <div class="left-toggle-button users-icon">&nbsp;</div>
                        <div class="ambition-main">
                            <div class="ambition">Wall</div>
                        </div>
                        <ul class="ulist-secondaynav">
                            <li class="ambition-drop">
                                <ul class="ambition-drop-ulist">
                                    
                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Activity log</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="selected-menu">
                                <span class="seclectdot">&nbsp;</span>
                                <?php 
                                echo $this->Html->link('About' ,array(
                                    'controller' => 'mentor' ,'action' => $user_id ,'about' ));
                                ?>

                            </li>
                            <li>
                                <span>&nbsp;</span>
                                <?php 
                                echo $this->Html->link('Users' ,array(
                                    'controller' => 'mentor' ,'action' => $user_id , 'users' ));
                                ?>
                            </li>
                            

                            <li class="mobile-view">
                                <span>&nbsp;</span>
                                <a href="#">Creativity</a>
                            </li>
                            <li class="mobile-view">
                                <span>&nbsp;</span>
                                <a href="#">Entertainment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="secodnav-right">
                        <ul class="ulist-secondaynav-right">
                            <li>
                                <a href="#">Creativity</a>
                            </li>
                            <li>
                                <a href="#">Entertainment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="toggle-friend-mentor">
                        <ul>
                            <li class="mentors-toggle">
                                Messages
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="full-container main-content">
            <div class="fixed-container">
                <?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div>
    <div class="clear"></div>



    <div class="simple_overlay shareOverlay" id="sharepopup">
        <div class="share-top">

            <div class="postedby-image">
                <img src="assets/images/uploads/profPic.jpg">
            </div>
            <textarea class="comments-share"></textarea>


        </div>
        <div class="share-image">
            <img src="assets/images/uploads/share.jpg" />
        </div>
        <div class="share-with">
            <h3>Shared with:</h3>
            <div class="share-list">

                <div class="sel-hob-main">
                    <div class="sel-copy">Army doctors</div>
                    <div class="sel-close"></div>
                </div>
                <div class="sel-hob-main">
                    <div class="sel-copy">Mentors</div>
                    <div class="sel-close"></div>
                </div>
                <a class="more-people">More People</a>
            </div>

        </div>
        <div class="share-bottom overlay-button">
            <div class="disable-notification">
                <div class="checkbox-wrapper">
                    <div class="custom-check">
                        <div class="toogle-tick">
                        </div>
                        <input type="checkbox" />
                    </div>
                    <span class="label-chk">Disable Notification</span>
                </div>
            </div>
            <div class="share-button-wrapper">
                <input type="submit" class="common-button share" value="SHARE">
                <input type="submit" class="common-button cancel" value="CANCEL">
            </div>

        </div>
    </div>
        <?php 
        
        echo $this->element('sql_dump'); 
        echo $this->Html->script('script.js');
        echo $this->Html->script('jquery.mCustomScrollbar.concat.min.js');
		echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
        echo $this->Html->script('init.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('scroll/jquery.infinitescroll.min.js');
        echo $this->Html->script('JsFunctions');
        echo $this->Html->script('added_script');
        echo $this->Html->script('jquery-ui'); 
        echo $this->element('hidden_forms');
            echo $this->Html->script('jquery-ui_dialog.js');

        ?>
</body>
</html>