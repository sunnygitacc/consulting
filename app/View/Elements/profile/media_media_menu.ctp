    <div class="right-extended">    
        <ul class="filter-cr">

            <li  <?php if($select =='media-images') {?>class='filterSel'<?php } ?>  ><span class="camera"></span>
                
            <?php 
            echo $this->Html->link('Images',
                array('controller'=>'profiles','action'=> $user['User']['id'] , 'media-images'));
            ?>
            </li>
            <li  <?php if($select=='media-videos') {?>class='filterSel'<?php } ?> ><span class="video-camera"></span>
            <?php 
            echo $this->Html->link('Videos',
                array('controller'=>'profiles','action'=> $user['User']['id'] , 'media-videos'));
            ?> 
                </li>
            <li  <?php if($select=='media-documents') {?>class='filterSel'<?php } ?>  ><span class="file-text"></span>
            <?php 
            echo $this->Html->link('Documents',
                array('controller'=>'profiles','action'=> $user['User']['id'] ,'media-documents'));
            ?>   
                </li>
            <li  <?php if($select=='media-audio') {?>class='filterSel'<?php } ?>><span class="volume-off"></span>
            <?php 
            echo $this->Html->link('Audios',
                array('controller'=>'profiles','action'=> $user['User']['id'] ,'media-audio'));
            ?>    
                </li>
        </ul>
        <hr></hr>
    </div>