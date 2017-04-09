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
    //pr($notificatons);
    echo $this->Html->scriptBlock('var jsVars = '.$this->Js->object($jsVars).';');
    echo $this->Html->css('jquery.mCustomScrollbar.css');
    echo $this->Html->css('styles.css');
    echo $this->Html->script('modernizr.custom.56100.js');
	echo $this->Html->css('addedstyles.css');
	echo $this->Html->css('jquery.ui.datepicker.css');
    echo $this->Html->css('slider/jquery.bxslider.css');
    echo $this->Html->css('video/video-js.css');
    echo $this->Html->css('audio/audioplayer.css');
    echo $this->Html->css('audio/style.css');
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
                            <?Php echo $this->Html->image('logo.png'); ?>
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
                        <div class="left-toggle-button line-menu">&nbsp;</div>
                        <div class="ambition-main mobile-view">
                            <div class="ambition">Ambition</div>
                        </div>
                        <ul class="ulist-secondaynav">
                            <li class="selected-menu">
                                <span >&nbsp;</span>
                                <?php  echo $this->HTMl->link('Ambition',array('controller'=>'ambitions', 'action' => 'index')); ?>
                                
                            </li>
                            <li class="selected-menu">
                                <span>&nbsp;</span>
                                <?php  echo $this->HTMl->link('Hobbies',array('controller'=>'hobbies', 'action' => 'index')); ?>

                            </li>
                            <li>
                                <span>&nbsp;</span>
                                <?php  echo $this->HTMl->link('Team',array('controller'=>'teams', 'action' => 'index')); ?>
                            </li>


                            <li class="mobile-view">
                                <span class="seclectdot" >&nbsp;</span>
                                <?php  echo $this->HTMl->link('Creativity',array('controller'=>'creativity', 'action' => 'index')); ?>
                            </li>
                            <li class="mobile-view">
                                <span>&nbsp;</span>
                                <?php  echo $this->HTMl->link('Entertainment',array('controller'=>'entertainment', 'action' => 'index')); ?>
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
                    <div class="clear"></div>
                </div>
            </div>
        </div>
		
        <!-- Here page fetches Start  xxxxxxxxx xxxxxxxxxxxx xxxxxxxxxxx xxxxxxx xxxxxxxx  -->
        
        <div id="content">
                            
                        <?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
	</div>
        
        <!-- Here page fetches End    xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->	
    </div>
    <div class="clear"></div>
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
        echo $this->element('create_group');
        pr($this->request->params['action']);
        if($this->request->params['action'] == 'advance'){
            echo $this->Html->script('search_page.js');
            echo $this->Html->script('jquery-ui_dialog.js');
        }

        ?>

</body>

</html>
