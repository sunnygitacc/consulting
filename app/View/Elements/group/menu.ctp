        <div class="cover-inner-right">
            <ul class="ulist-covermenu">
                <li <?php if($select == 'about') { echo 'class="profileSel" '; }   ?> >
                    <?php echo $this->html->link(__('About'), array('controller' => $this->params['controller'], 'action' => $mygroup['Group']['id'], 'about' )) ?>
                    <span>&nbsp;</span>
                </li>
                <li <?php if($select == 'wall') { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('Wall'), array('controller' => $this->params['controller'], 'action' => $mygroup['Group']['id'], 'wall' )) ?>
                    <span>&nbsp;</span>
                </li>
                <li <?php $med_array = array('media-audio','media-images','media-videos','media-documents');
                if(in_array($select, $med_array)) { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('Media'), array('controller' => $this->params['controller'], 'action' => $mygroup['Group']['id'], 'media-images' )) ?>
                    <span>&nbsp;</span>
                </li>
                <?php if(in_array(12, $permission)){ ?>
                <li <?php if($select == 'more') { echo 'class="profileSel" '; } ?> >
                    <?php echo $this->html->link(__('More'), array('controller' => $this->params['controller'], 'action' => $mygroup['Group']['id'], 'more' )) ?>
                    <span>&nbsp;</span>
                </li>
                <?php } ?>

            </ul>
        </div>