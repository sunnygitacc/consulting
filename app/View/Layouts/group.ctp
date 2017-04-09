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
    
    echo $this->Html->css('jquery.mCustomScrollbar.css');
    echo $this->Html->css('styles.css');
    echo $this->Html->script('modernizr.custom.56100.js');
	echo $this->Html->css('addedstyles.css');
	echo $this->Html->css('jquery.ui.datepicker.css');
    echo $this->Html->css('slider/jquery.bxslider.css');
    echo $this->Html->css('video/video-js.css');
	echo $this->Html->css('jquery-ui_dialog.css');

    ?>
    
</head>

<body>
    <div class="main-container profile-page">
        <div class="header-wrapper">
            <div class="full-container header">
                <div class="fixed-container">
                    <div class="logo">
                        <a href="#">
                            <?php echo $this->Html->image('merge/logo.png'); ?>
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
                        <ul class="ulist-secondaynav">
                            <li class="selected-menu">
                                <span class="seclectdot">&nbsp;</span>
                                <?php echo $this->HTMl->link('Ambition',array('controller'=>'ambitions', 'action' => 'index')); ?>
                                
                            </li>
                            <li class="selected-menu">
                                <span class="seclectdot">&nbsp;</span>
                                <?php echo $this->HTMl->link('Hobbies',array('controller'=>'hobbies', 'action' => 'index')); ?>

                            </li>
                            <li>
                                <span>&nbsp;</span>
                                <?php echo $this->HTMl->link('Teams',array('controller'=>'teams', 'action' => 'index')); ?>
                            </li>
                            <li class="mobile-view">
                                <span>&nbsp;</span>
                                <?php 
                                echo $this->HTMl->link('Creativity',array('controller'=>'creativity', 'action' => 'index'));
                                ?>
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
                                <?php 
                                echo $this->HTMl->link('Creativity',array('controller'=>'creativity', 'action' => 'index'));
                                ?>
                            </li>
                            <li>
                                <a href="#">Entertainment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="toggle-friend-mentor">
                        <ul>
                            <li class="friend-toggle">
                                Friends
                            </li>
                            <li class="mentors-toggle">
                                Mentors
                            </li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
    </div>
    <div class="clear"></div>

    	<?php 
        echo $this->Html->script('script.js');
        echo $this->Html->script('jquery.mCustomScrollbar.concat.min.js');
		echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
		echo $this->Html->script('jquery.ui.datepicker.js');
        echo $this->Html->script('init.js');
        echo $this->Html->script('scroll/jquery.infinitescroll.min.js');
		echo $this->Html->script('script-added.js');

		echo $this->Html->script('jquery-ui_dialog.js');
	echo $this->element('php_js_variables');	
            echo $this->Html->script('jquery-ui_dialog.js');

        ?>

</body>
</html>