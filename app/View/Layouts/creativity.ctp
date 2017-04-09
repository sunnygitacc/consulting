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
    echo $this->Html->css('jquery.mCustomScrollbar.css');
   // echo $this->Html->css('slimbox2.css');
//    echo $this->Html->css('screen.css');
    echo $this->Html->css('styles.css');
    echo $this->Html->script('modernizr.custom.56100.js');

 echo $this->Html->css('slimbox2.css');
    echo $this->Html->css('addedstyles.css');
    echo $this->Html->css('jquery.ui.datepicker.css');
    echo $this->Html->css('slider/jquery.bxslider.css');
    echo $this->Html->css('video/video-js.css');
    echo $this->Html->css('jquery-ui_dialog.css');
     echo $this->Html->css('jquery-ui.css');

    ?>
    
</head>

<body>
    <div class="main-container">
        <div class="header-wrapper">
            <div class="full-container header">
            <div class="full-container header">
                <div class="fixed-container">
                    <div class="logo">
                        <a href="#">
                            <?php echo $this->Html->image('merge/logo.png'); ?>
                        </a>
                    </div>
                    <div class="search-main">
                            
                        

                    </div>
                    <?php echo $this->element('notification'); ?>
                    <div class="clear"></div>
                </div>
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
                               <?php  echo $this->HTMl->link('Creativity',array('controller'=>'creativity', 'action' => 'index')); ?>
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
        <div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-panel">
                    <div class="content-left">
                        <h2 class="whats-avail">What's Available</h2>
                        <ul class="available-menu">
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/mostviewed">
                                    <span class="left-icon icon-star"></span>
                                    <span>Most Viewed</span>
                                </a>
                            </li>
                            
                           
                            <li><a href=" http://gopuonline.com/tec1/creativity/music">
                                 <span class="left-icon  icon-music"></span>
                                 <span>Music</span>
                                    </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/movies">
                                    <span class="left-icon  icon-movies"></span>
                                    <span>Movies</span>
                                </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/sports">
                                    <span class="left-icon  icon-sports"></span>
                                    <span>Sports</span>
                                </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/nature">
                                    <span class="left-icon  icon-nature"></span>
                                    <span>Nature</span>
                                </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/science">
                                    <span class="left-icon  icon-science"></span>
                                    <span>Science</span>
                                </a>
                            </li>

                            <li>
                               <a href=" http://gopuonline.com/tec1/creativity/comedy">
                                    <span class="left-icon  icon-comedy"></span>
                                    <span>Comedy</span>
                                </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/tutorials">
                                    <span class="left-icon  icon-tutorials"></span>
                                    <span>Tutorials</span>
                                </a>
                            </li>
                            <li>
                                <a href=" http://gopuonline.com/tec1/creativity/animation">
                                    <span class="left-icon icon-animation"></span>
                                    <span>Animation</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

 
        <?php echo $this->fetch('content'); ?>
                
        <?php 

        echo $this->Html->script('script.js');
        echo $this->Html->script('jquery.mCustomScrollbar.concat.min.js');
		echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
        echo $this->Html->script('init.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('scroll/jquery.infinitescroll.min.js');
        echo $this->Html->script('JsFunctions');
   echo $this->Html->script('slimbox2.js');
        echo $this->Html->script('jquery-ui'); 
            


        
		echo $this->Html->script('creativity.js');
echo $this->element('sql_dump'); 
	
        ?>


                


</div>

</body>

</html>