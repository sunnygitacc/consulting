            <div class="cover-inner-right">
                <ul class="ulist-covermenu">
                    <li <?php if($select == '' || $select == 'about' ) { echo 'class="profileSel"';} ?>  >
                            <?php echo $this->Html->link(__('About'), array('controller' => 'userprofiles', 'action' => 'visitor', $user['User']['id'] )); ?>
                            <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'wall') { echo 'class="profileSel"';} ?> >
                            <?php echo $this->Html->link(__('Wall'), array('controller' => 'userprofiles', 'action' => 'visitor', $user['User']['id'],'wall' )); ?>
                            <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'friends') { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Friends'), array('controller' => 'userprofiles', 'action' => 'visitor', $user['User']['id'],'friends' )); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li <?php if($select == 'mentors') { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Mentors'), array('controller' => 'userprofiles', 'action' => 'visitor', $user['User']['id'],'mentors' )); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li <?php if(in_array($select,array('media-images','media-videos','media-audio','media-documents'))) { echo 'class="profileSel"';} ?> >
                         <?php echo $this->Html->link(__('Media'), array('controller' => 'userprofiles', 'action' => 'visitor', $user['User']['id'],'media-images' )); ?>
                        <span>&nbsp;</span>
                    </li>
                    <li>
                        <a href="#">More </a>
                        <span>&nbsp;</span>
                    </li>
                </ul>
            </div>