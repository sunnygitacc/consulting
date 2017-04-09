<?php   echo $this->element('group/'.'media_media_menu'); ?>

    <div class="clear"></div>
    <div class="filter-contents">
        

                        <!------------- Audio --------------->
                     
        <div id="filter-audios" class="filter-con-row">
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Audio</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="visitor-audio-filter" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>
            <div class="profile-row-mids">
            <div class="filter-con-row-inner" id="user_media_audios">

                <?php foreach( $audioArray as $index => $aud ){ ; ?>
                <div class="filter-box user_media_audio">
                    <div class="filter-box-thumb">
                        <?php echo $this->Html->image('uploads/video-thumb_03.jpg'); ?>
                        <span class="icon-music">&#xf025;</span>
                    </div>
                    <div class="filter-box-details">
                        <h3><?php echo $aud ['Post']['text_content']  ?></h3>
                        <div class="details-thumb">Uploaded by <b><?php echo $aud['User']['first_name'].' '.$aud['User']['last_name'] ?></b>
                        </div>
                    </div>
                </div>
                <?php }
                    if( count($audioArray) > 0 ){
                        
                            echo $this->Paginator->next('Show more Audio...',array());
                    }else{
                            echo '<p style="text-align:center;" >No Audio Found...</p>';
                    }
                    ?>
                
            </div>
            
            </div>
        </div>
                        
    </div>
