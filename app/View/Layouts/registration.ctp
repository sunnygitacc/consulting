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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php 
    
    if($this->request->params['action']=='profile_photo'){
    echo $this->Html->script('script');
    echo $this->Html->script('registration/crop/jquery.Jcrop.js');
    }
    echo $this->Html->css('styles');
    echo $this->Html->css('addedstyles');
    echo $this->Html->script('modernizr.custom.56100');

    ?>

</head>

<body>
    <div class="main-container">
        <div class="header-wrapper2">
            <header class="full-container header">
                <div class="fixed-container">
                    <div class="logo">
                        <a href="#">
                            <?php 
                            
                            echo $this->Html->image("logo.png", array(
                            "alt" => "WIZSPEAK",
                            'url' => array('controller' => 'pages', 'action' => 'home')
                            ));
                            ?>
                            
                        </a>

                    </div>
                    <div class="clear"></div>
                </div>
            </header>
        </div>
        <div class="full-container login">
        <!-- Here page fetches Start  -->
        
        <div id="content">
                            
                        <?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
	</div>
        
        <!-- Here page fetches End    -->
        
        
            <footer>
                <ul class="footer_ulist">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Developers</a>
                    </li>
                    <li>
                        <a href="#">Create Page</a>
                    </li>
                    <li>
                        <a href="#">Utility</a>
                    </li>
                    <li>
                        <a href="#">Entertainment</a>
                    </li>
                    <li>
                        <a href="#">Games</a>
                    </li>
                    <li>
                        <a href="#">Privacy</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                </ul>
                <div class="copyrite">Wizspeak &copy; 2014</div>
            </footer>
        </div>

        <div class="clear"></div>
    </div>
    <?php 
    
    echo $this->Html->script('script');
    echo $this->Html->script('jquery-ui-1.10.3.custom.min');
    echo $this->Html->script('init');
         echo $this->Html->script('JsFunctions');
         echo $this->Html->script('jquery-ui.js'); 
         echo $this->Html->script('registration');
         

    ?>


</body>

</html>