<?php //debug($user); ?>            
<div class="cover-inner-right">
                <ul class="ulist-covermenu">
                    <li <?php if($select == '' || $select == 'index' ) { echo 'class="profileSel"';} ?>  >
                            <?php echo $this->Html->link(__('About'), array('controller' => 'profiles', 'action' => $user['User']['id'])); ?>
                            <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'my_wall') { echo 'class="profileSel"';} ?> >
                            <?php echo $this->Html->link(__('My Wall'), array('controller' => 'profiles', 'action' => $user['User']['id'], 'my_wall' )); ?>
                            <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'friends') { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Friends'), array('controller' => 'profiles', 'action' => $user['User']['id'], 'friends')); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'mentors') { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Mentors'), array('controller' => 'profiles', 'action' => $user['User']['id'], 'mentors' )); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li <?php
                    $list = array('media-audio','media-documents','media-videos','media-images');
                    if(in_array($select,$list)) { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Media'), array('controller' => 'profiles', 'action' => $user['User']['id'], 'media-images' )); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li>
                        <a href="#">More </a>
                        <span>&nbsp;</span>
                    </li>
                </ul>
            </div>