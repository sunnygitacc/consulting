        <div class="cover-inner-right">
            <ul class="ulist-covermenu">
                <li <?php if($select == 'about') { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('About'), array('controller' => 'team', 'action' => $mygroup['Group']['id'] )) ?>
                    <span>&nbsp;</span>
                </li>
                <li <?php if($select == 'wall') { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('Post'), array('controller' => 'team', 'action' => $mygroup['Group']['id'] , 'wall' )) ?>
                    <span>&nbsp;</span>
                </li>
                <li <?php if($select == 'roster') { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('Roosters'), array('controller' => 'team', 'action' => $mygroup['Group']['id'], 'roster' )) ?>
                    <span>&nbsp;</span>
                </li>
                <?php if(in_array(18,$permission)){ ?>
                <li <?php if($select == 'schedules') { echo 'class="profileSel" '; } ?> >
                    <i class="count">(<?php echo $event_count; ?>)</i>
                     <?php echo $this->html->link(__('Schedules'), array('controller' => 'team', 'action' => $mygroup['Group']['id'], 'schedules' )) ?>
                    <span>&nbsp;</span>
                </li>
                <?php }
                if(in_array(12,$permission)) {
                ?>
                <li <?php if($select == 'settings') { echo 'class="profileSel" '; } ?> >
                    <i class="count">(300)</i>
                     <?php echo $this->html->link(__('Settings'), array('controller' => 'team', 'action' => $mygroup['Group']['id'] , 'settings' )) ?>
                    <span>&nbsp;</span>
                </li>
                <?php } ?>
                <li <?php if(in_array($select,array('media-images','media-videos','media-audio','media-documents'))) { echo 'class="profileSel"';} ?> >
                     <?php echo $this->html->link(__('Media'), array('controller' => 'team', 'action' => $mygroup['Group']['id'], 'media-images' )) ?>
                    <span>&nbsp;</span>
                </li>
                <li <?php if($select == 'about') { echo 'class="profileSel" '; } ?> >
                    <a class="gear" href="#">&nbsp;</a>
                    <span>&nbsp;</span>
                </li>
            </ul>
        </div>