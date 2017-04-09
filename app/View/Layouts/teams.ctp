<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
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
<link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="/wizspeak/app/webroot/arrowchat/external.php?type=css" charset="utf-8" />
<script type="text/javascript" src="/wizspeak/app/webroot/arrowchat/includes/js/jquery.js"></script>
<script type="text/javascript" src="/wizspeak/app/webroot/arrowchat/includes/js/jquery-ui.js"></script>
<?php //echo $this->element('sql_dump'); ?>
<body>
    <div class="main-container">
        <div class="header-wrapper">
            <div class="full-container header">
                <div class="fixed-container">
                    <div class="logo">
                        <a href="#">
                            <?php 
                            echo $this->Html->image('logo.png');
                            ?>
                            
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
                        <ul class="ulist-secondaynav">
                            <li class="selected-menu ">
                                <span>&nbsp;</span>
                                <?php echo $this->html->link('Ambitions', array('controller'=>'ambitions','action'=>'index'));?>

                            </li>
                            <li class="selected-menu ">
                                <span>&nbsp;</span>
                                <?php echo $this->html->link('Hobbies', array('controller'=>'hobbies','action'=>'index'));?>

                            </li>
                        </ul>
                        <div class="left-toggle-button line-menu">&nbsp;</div>
                        <div class="ambition-main">
                            <div class="ambition">Teams</div>
                        </div>
                        <ul class="ulist-secondaynav">
                            <li class="ambition-drop">
                                <ul class="ambition-drop-ulist">
                                    <li>
                                        <a data-rel="creategroup" class="edit popup" href="#">Create a Group</a>
                                    </li>
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
                            <li class='mobile-view' >
                                <span>&nbsp;</span>
                                <?php echo $this->html->link('Ambitions', array('controller'=>'ambitions','action'=>'index'));?>
                            </li>                            
                            <li class='mobile-view' >
                                <span>&nbsp;</span>
                                <?php echo $this->html->link('Hobbies', array('controller'=>'hobbies','action'=>'index'));?>
                            </li>
                            <li class="selected-menu mobile-view">
                                <span class="seclectdot">&nbsp;</span>
                                <?php echo $this->html->link('Teams', array('controller'=>'teams','action'=>'index'));?>
                            </li>

                            <li class="mobile-view">
                                <span>&nbsp;</span>
                                <?php echo $this->html->link('Creativity', array('controller'=>'creativity','action'=>'index'));?>
                               
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
                                <?php echo $this->html->link('Creativity', array('controller'=>'creativity','action'=>'index'));?>
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
			
        <!-- Here page fetches Start  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
        
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
                echo $this->Html->script('jquery.ui.datepicker.js');
        echo $this->Html->script('init.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('scroll/jquery.infinitescroll.min.js');
        echo $this->Html->script('JsFunctions');
        echo $this->Html->script('added_script');
            echo $this->Html->script('jquery-ui_dialog.js');
        echo $this->Html->script('eventCalendar/moment.min');
        echo $this->Html->script('eventCalendar/fullcalendar');
        echo $this->Html->script('eventCalendar/edited'); 
        
        echo $this->element('hidden_forms');
        echo $this->element('create_team');
        

        ?>
</body>

</html>