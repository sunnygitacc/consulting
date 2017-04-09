    <div class="right-extended">    
        <ul class="filter-cr">

            <li  <?php if($this->params['pass'][0]=='media-images') {?>class='filterSel'<?php } ?>  ><span class="camera"></span>
                
            <?php 
            echo $this->Html->link('Images',
                array('controller'=>'team','action'=>$mygroup['Group']['id'],'media-images'));
            ?>
            </li>
            <li  <?php if($this->params['pass'][0]=='media-videos') {?>class='filterSel'<?php } ?> ><span class="video-camera"></span>
            <?php 
            echo $this->Html->link('Videos',
                array('controller'=>'team','action'=>$mygroup['Group']['id'],'media-videos'));
            ?> 
                </li>
            <li <?php if($this->params['pass'][0]=='media-documents') {?>class='filterSel'<?php } ?>  ><span class="file-text"></span>
            <?php 
            echo $this->Html->link('Documents',
                array('controller'=>'team','action'=>$mygroup['Group']['id'],'media-documents'));
            ?>   
                </li>
            <li  <?php if($this->params['pass'][0]=='media-audio') {?>class='filterSel'<?php } ?>><span class="volume-off"></span>
            <?php 
            echo $this->Html->link('Audios',
                array('controller'=>'team','action'=>$mygroup['Group']['id'],'media-audio'));
            ?>    
                </li>
        </ul>
        <hr></hr>
    </div>