    <div class="right-extended">    
        <ul class="filter-cr">

            <li  <?php if($this->params['pass'][1]=='media-images') {?>class='filterSel'<?php } ?>  ><span class="camera"></span>
                
            <?php 
            echo $this->Html->link('Images',
                array('controller'=>'userprofiles','action'=>'visitor',$user['User']['id'],'media-images'));
            ?>
            </li>
            <li  <?php if($this->params['pass'][1]=='media-videos') {?>class='filterSel'<?php } ?> ><span class="video-camera"></span>
            <?php 
            echo $this->Html->link('Videos',
                array('controller'=>'userprofiles','action'=>'visitor',$user['User']['id'],'media-videos'));
            ?> 
                </li>
            <li <?php if($this->params['pass'][1]=='media-documents') {?>class='filterSel'<?php } ?>  ><span class="file-text"></span>
            <?php 
            echo $this->Html->link('Documents',
                array('controller'=>'userprofiles','action'=>'visitor',$user['User']['id'],'media-documents'));
            ?>   
                </li>
            <li  <?php if($this->params['pass'][1]=='media-audio') {?>class='filterSel'<?php } ?>><span class="volume-off"></span>
            <?php 
            echo $this->Html->link('Audios',
                array('controller'=>'userprofiles','action'=>'visitor',$user['User']['id'],'media-audio'));
            ?>    
                </li>
        </ul>
        <hr></hr>
    </div>